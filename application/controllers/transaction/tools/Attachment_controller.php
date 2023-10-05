<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Attachment_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('transaction/tools/Log_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->load->helper('log_helper');
        $this->IsLoggedIn();
        $this->load->helper(array('url', 'download'));
    }

    // ATTACHMENT
    #==============================================================
    function InsertAttachment()
    {
        $attachment_name = $this->input->post('attachment_name');
        $attachment_type = $this->input->post('attachment_type');
        $group_id = $this->input->post('group_id');
        $creation_user_id = $this->session->userdata('member_id');

        // Mengambil file yang diunggah
        $file = $_FILES['attachment_file'];

        // Mengekstrak ekstensi file
        $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);

        if ($fileExt != '') {
            // Membuat nama unik untuk file
            //$attachment_url = $group_id . '-' . time() . '.' . $fileExt;

            $attachment_url = $group_id . '-' . str_replace(' ', '_', $attachment_name,) . '.' . $fileExt;

            // Konfigurasi untuk mengunggah file
            $config['upload_path'] = './upload/';
            $config['allowed_types'] = 'jpeg|jpg|png|pdf|xlsx|xls|docx';
            $config['file_name'] = $attachment_url;
            $config['overwrite'] = true;
            $config['max_size'] = 100000;
            $config['max_width'] = 10000;
            $config['max_height'] = 10000;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('attachment_file')) {
                // Gagal mengunggah file
                $error = ['error' => $this->upload->display_errors()];
                $response = array(
                    'status' => 'error',
                    'title' => 'Error',
                    'message' => 'Attachment cannot upload'
                );
            } else {
                // File berhasil diunggah
                $data = ['upload_data' => $this->upload->data()];

                $Attachment_param = [
                    $attachment_name,
                    //$attachment_type,
                    $fileExt,

                    $attachment_url,
                    $group_id,
                    $creation_user_id
                ];

                $result = $this->Attachment_model->Insert($Attachment_param);

                $memberName = $this->session->userdata('member_name');
                $text_log = 'Attachment "' . $attachment_name . '" uploaded by "' . $memberName . '"';
                $group_id = $this->input->post('group_id');
                $logging = [
                    $text_log,
                    $group_id,
                    $creation_user_id
                ];

                if ($result > 0) {
                    $response = array(
                        'status' => 'success',
                        'title' => 'Success',
                        'message' => 'Attachment has been uploaded'
                    );
                    $this->Log_model->Insert($logging);
                } else {
                    $response = array(
                        'status' => 'error',
                        'title' => 'Error',
                        'message' => 'Attachment cannot be submitted!'
                    );
                }
            }
        } else {
            // Tidak ada file yang diunggah
            $attachment_url = 'null';
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'No file uploaded!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    function DeleteAttachment()
    {
        $attachment_id = $this->input->post('attachment_id');
        $attachment_url = $this->input->post('attachment_url');

        // Hapus file fisik dari folder
        $file_path = './upload/' . $attachment_url;
        if (file_exists($file_path)) {
            unlink($file_path);
        }

        $data = $this->Attachment_model->Get([$attachment_id, '', '', 1]);
        $change_user_id = $this->session->userdata('member_id');

        if (!empty($data)) {
            foreach ($data as $key) {
                $attachment_name = $key->attachment_name;
            }
        }

        $result = $this->Attachment_model->Delete($attachment_id);

        $memberName = $this->session->userdata('member_name');
        $text_log = 'Attachment "' . $attachment_name . '" deleted by "' . $memberName . '"';
        $group_id = $this->input->post('group_id');
        $logging = [
            $text_log,
            $group_id,
            $change_user_id
        ];

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Attachment has been deleted!'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Attachment cannot be deleted!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }


    function ViewAttachment($attachment_url)
    {
        $file_path = './upload/' . $attachment_url;

        // if (file_exists($file_path)) {
        //     header('Content-Type: application/pdf');
        //     // header('Content-Transfer-Encoding: Binary');
        //     // header('Content-disposition: attachment; filename="' . basename($file_path) . '"');
        //     // header('Content-Length: ' . filesize($file_path));
        //     @readfile($file_path);
        //     exit;
        // } else {
        //     // Handle jika file tidak ditemukan
        //     echo "File not found.";
        // }


        if (file_exists($file_path)) {
            $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);

            // Check the file type and set appropriate headers
            switch ($file_extension) {
                case 'pdf':
                    header('Content-Type: application/pdf');
                    break;
                    // Add more cases for other file types (e.g., images, videos, etc.)
                default:
                    header('Content-Type: application/octet-stream');
                    break;
            }

            header('Content-Disposition: inline; filename="' . $attachment_url . '"');
            readfile($file_path);
        } else {
            echo 'File not found.';
        }
    }


    function DownloadAttachment($attachment_url = '')
    {
        $file_path = './upload/' . $attachment_url;

        if (file_exists($file_path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);

            // Menjalankan perintah ini setelah mengirimkan file
            exit;
        } else {
            // Handle jika file tidak ditemukan
            echo 'File not found.';
        }
    }
    // END ATTAHCMENT
    #===========================================================================
}
