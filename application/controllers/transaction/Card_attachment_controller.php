<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Card_attachment_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/Project_model');
        $this->load->model('transaction/Project_member_model');
        $this->load->model('transaction/Board_model');
        $this->load->model('transaction/List_model');
        $this->load->model('transaction/Card_model');
        $this->load->model('transaction/Card_member_model');
        $this->load->model('transaction/Card_comment_model');
        $this->load->model('transaction/Card_attachment_model');

        $this->load->helper(['url', 'download']);

        $this->IsLoggedIn();
    }

    function InsertCardAttachment()
    {
        #Header
        $project_id = $this->input->post('project_id');
        $card_id = $this->input->post('card_id');
        #Detail Member
        $card_attachment_id = '';
        $attachment_name = $this->input->post('attachment_name');
        $attachment_type = $this->input->post('attachment_type');
        //  $attachment_url = $this->input->post('attachment_url');
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';

        $fileExt = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        if ($fileExt != '') {
            $attachment_url = $project_id . '-' . time() . '.' . $fileExt;
        } else {
            $attachment_url = 'null';
        }

        $card_comment_parameter = [
            $card_attachment_id,
            $card_id,
            $attachment_name,
            $attachment_type,
            $attachment_url,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $record_status,
        ];

        $result = $this->Card_attachment_model->Insert($card_comment_parameter);

        if ($result > 0) {
            if ($fileExt != '') {
                $config['upload_path'] = './upload/';
                $config['allowed_types'] = 'jpeg|jpg|png|pdf|xlsx|xls|docx';
                $config['file_name'] = $project_id . '-' . time();
                $config['overwrite'] = true;
                $config['max_size'] = 100000;
                $config['max_width'] = 10000;
                $config['max_height'] = 10000;

                $this->load->library('upload', $config);
                //$this->upload->do_upload('image');

                if (!$this->upload->do_upload('image')) {
                    $error = ['error' => $this->upload->display_errors()];
                    $this->session->set_flashdata(
                        'error',
                        'Attachment cannot upload'
                    );
                } else {
                    $data = ['upload_data' => $this->upload->data()];
                    $this->session->set_flashdata(
                        'success',
                        'Attachment has been upload'
                    );
                }
            }
            $this->load->config('email');
            $this->email->from('pt.ujicobaku@gmail.com', 'PT Ujicoba');
            $this->email->to('rizki.mustafiyanto@gmail.com');
            $this->email->subject('New Project Member Created');
            $this->email->message('A new project member has been created successfully.');

            if ($this->email->send()) {
                $this->session->set_flashdata('success', 'New project member created successfully! Email notification sent.');
            } else {
                $this->session->set_flashdata('error', 'New project member created successfully! but Failed to send email notification.');
            }

            // $this->session->set_flashdata(
            //     'success',
            //     'Attachment has been submited !'
            // );
        } else {
            $this->session->set_flashdata(
                'error',
                'Attachment cannot submited !'
            );
        }
        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }

    function DeleteCardAttachment(
        $project_id = '',
        $card_id = '',
        $p_card_attachment_id = ''
    ) {
        $result = $this->Card_attachment_model->Delete($p_card_attachment_id);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Attachment has been deleted !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Attachment cannot deleted !'
            );
        }

        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }
    function upload($attachment_url)
    {
        $file = file_get_contents('./upload/' . $attachment_url);
        header('Content-Type: application/pdf');
        @readfile($file);
    }

    function Download(
        $project_id = '',
        $card_id = '',
        $p_card_attachment_id = '',
        $attachment_url = ''
    ) {
        force_download('./upload/' . $attachment_url, null);
        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }
}
