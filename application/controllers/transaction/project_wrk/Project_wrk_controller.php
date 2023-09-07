<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Project_wrk_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project_wrk/Project_wrk_model');
        $this->load->model('transaction/project_wrk/Project_wrk_member_model');
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->load->helper('log_helper');
        $this->IsLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Project Workspace';
        $this->loadViews('transaction/Project_wrk', $this->global, null, null);
    }

    function GetProjectWrk()
    {
        $memberID =  $this->session->userdata('member_id');
        $data['ProjectWrkRecords'] = $this->Project_wrk_model->Get(['', '', 0, $memberID]);
        $data['ProjectWrkMemberRecords'] = $this->Project_wrk_member_model->Get(['', '', '', '', 0]);
        $data['ProjectWrkTypeRecords'] = $this->variable_model->GetVariable(['', 4]);
        $data['tempmember'] = $this->member_model->Get([0, 0]);

        #============================================================================

        $data['member_id'] = $memberID;

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Workspace';
        $this->loadViews(
            'transaction/project_wrk/Project_wrk',
            $this->global,
            $data,
            null
        );
    }

    function InsertProjectWrk()
    {
        $project_wrk_id = '';
        $project_name = $this->input->post('title');
        $project_type = $this->input->post('projectType');
        $project_start = $this->input->post('start');
        $project_due = $this->input->post('due');
        $description = $this->input->post('description');
        $members_project = $this->input->post('membersProject');
        $creation_user_id = $this->session->userdata('member_id');
        $status_wrk_id = 'STW-1'; # status projectnya On process
        $Project_parameter = [
            $project_wrk_id,
            $project_name,
            $project_type,
            $project_start,
            $project_due,
            $description,
            $members_project,
            $creation_user_id,
            $status_wrk_id
        ];

        // Pencarian member
        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $memberRecords = $this->member_model->get($member_parameter);

        //Konfigurasi Email
        $penerima = 'pt.ujicobaku@gmail.com'; //Send Email Percobaan
        $namaMember = '';
        $userMail = '';

        foreach ($memberRecords as $member) {
            if ($member->member_id == $creation_user_id) {
                $namaMember = $member->member_name;
                $userMail = $member->email;
                break;
            }
        }

        $subject_email = 'Create New Project';
        //Isi pesan
        $isi_email = "Halo,\n\n\tAda projek baru di PMT. Berikut adalah detailnya:\n\n\tNama\t\t\t\t: " .
            $namaMember . "\n\tEmail\t\t\t\t: " . $userMail . "\n\tProject Name\t: " . $project_name . "\n\nTerima kasih.";
        $email = new Email(); //Pemanggilan fungsi email pada library

        $result = $this->Project_wrk_model->Insert($Project_parameter);

        if ($result > 0) {
            //Mengirim email
            // if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
            //     $this->session->set_flashdata('success', 'Project has been create ! Email notification sent.');
            // } else {
            //     $this->session->set_flashdata('error', 'Project has been create ! but Failed to send email notification.');
            //     //echo $email->getErrorInfo();
            // }
            // $logMessage = 'Project has been created. Project Name: ' . $project_name . ' Created By ' . $namaMember;
            // $operation = 'Create';
            // writeToLog($logMessage, $operation);
            $response = 'New Project created successfully !';
        } else {
            $response = 'Project creation failed !';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateProjectWrk()
    {
        $p_project_wrk_id = $this->input->post('id');
        $p_project_name = $this->input->post('title');
        $p_project_type = $this->input->post('projectType');
        $p_project_start = $this->input->post('start');
        $p_project_due = $this->input->post('due');
        $p_description = $this->input->post('description');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_status_id =  $this->input->post('status');
        $flag = $this->input->post('flag');

        $param = [
            $p_project_wrk_id,
            $p_project_name,
            $p_project_type,
            $p_project_start,
            $p_project_due,
            $p_description,
            $p_change_user_id,
            $p_status_id,
            $flag
        ];
        // Pencarian member
        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $memberRecords = $this->member_model->get($member_parameter);

        //Konfigurasi Email
        $penerima = 'pt.ujicobaku@gmail.com'; //Send Email Percobaan
        $namaMember = '';
        $userMail = '';

        foreach ($memberRecords as $member) {
            if ($member->member_id == $p_change_user_id) {
                $namaMember = $member->member_name;
                $userMail = $member->email;
                break;
            }
        }

        $subject_email = 'Updated Project';
        //Isi pesan
        $isi_email = "Halo,\n\n\tAda projek update di PMT. Berikut adalah detailnya:\n\n\tNama\t\t\t\t: " .
            $namaMember . "\n\tEmail\t\t\t\t: " . $userMail . "\n\tProject Name\t: " . $p_project_name . "\n\nTerima kasih.";
        $email = new Email(); //Pemanggilan fungsi email pada library

        $result = $this->Project_wrk_model->Update($param);

        if ($result > 0) {
            //Mengirim email
            // if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
            //     $this->session->set_flashdata('success', 'Project has been update ! Email notification sent.');
            // } else {
            //     $this->session->set_flashdata('error', 'Project has been update ! but Failed to send email notification.');
            //     //echo $email->getErrorInfo();
            // }
            // $logMessage = 'Project has been updated. Project Name: ' . $project_name . ' updated By ' . $namaMember;
            // $operation = 'Update';
            // writeToLog($logMessage, $operation);
            // $this->session->set_flashdata('success', 'Project Updated');
            // echo json_encode($result);
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project Workspace updated successfully'
            );
        } else {
            // $this->session->set_flashdata('error', 'Project Cannot Update');
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Project Workspace updated failed!'
            );
        }
        // redirect('Project');
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteProjectWrk()
    {
        $Project_id = $this->input->post('project_wrk_id');
        $result = $this->Project_wrk_model->Delete($Project_id);

        if ($result > 0) {
            $response = 'Project has been deleted !';
        } else {
            $response = 'Project cannot deleted !';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // ATTACHMENT
    #==============================================================
    function InsertAttachmentWrk()
    {
        #Header
        $project_wrk_id = $this->input->post('project_wrk_id');
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
            $attachment_url = $project_wrk_id . '-' . time() . '.' . $fileExt;
        } else {
            $attachment_url = 'null';
        }

        $card_comment_parameter = [
            $attachment_name,
            $attachment_type,
            $attachment_url,
            $project_wrk_id,
            $creation_user_id
        ];

        $result = $this->Attachment_model->Insert($card_comment_parameter);

        if ($result > 0) {
            if ($fileExt != '') {
                $config['upload_path'] = './upload/';
                $config['allowed_types'] = 'jpeg|jpg|png|pdf|xlsx|xls|docx';
                $config['file_name'] = $project_wrk_id . '-' . time();
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
        redirect(base_url() . 'Project/' . $project_wrk_id);
    }

    function DeleteAttachmentWrk($project_wrk_id = '', $project_wrk_attachment_id = '')
    {
        $result = $this->Attachment_model->Delete($project_wrk_attachment_id);

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
        redirect(base_url() . 'Project/' . $project_wrk_id);
    }

    function UploadAttachmentWrk($attachment_url)
    {
        $file = file_get_contents('./upload/' . $attachment_url);
        header('Content-Type: application/pdf');
        @readfile($file);
    }

    function DownloadAttachmentWrk($project_wrk_id = '', $attachment_url = '')
    {
        force_download('./upload/' . $attachment_url, null);
        redirect(base_url() . 'Project/' . $project_wrk_id);
    }
    // END ATTAHCMENT
    #===========================================================================

    // PROJECT MEMBER
    #===========================================================================
    function InsertProjectWrkMember()
    {
        #Header
        $project_wrk_id = $this->input->post('project_wrk_id');
        #Detail Member
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $creation_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $Project_member_parameter = [
            $project_wrk_id,
            $member_id,
            $member_type_id,
            $creation_user_id,
            $record_status
        ];

        $result = $this->Project_wrk_member_model->Insert($Project_member_parameter);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'project member creation success !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'project member creation failed !'
            );
        }
        redirect(base_url() . 'Project/' . $project_wrk_id);
    }

    function UpdateProjectWrkMember()
    {
        //Bikin pengecekan array
        $project_member_id = $this->input->post('project_member_id');
        $project_wrk_id = $this->input->post('project_wrk_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';

        $param = [
            $project_member_id,
            $project_wrk_id,
            $member_id,
            $member_type_id,
            $p_change_user_id,
            $p_record_status,
        ];

        //eksekusi query
        $result = $this->Project_wrk_member_model->Update($param);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Project member Updated'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Project member Cannot Update'
            );
        }

        redirect(base_url() . 'Project/' . $project_wrk_id);
    }

    function DeleteProjectWrkMember($project_wrk_member_id = '', $project_wrk_id = '')
    {
        $result = $this->Project_wrk_member_model->Delete($project_wrk_member_id);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Card Member has been deleted !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Card member cannot deleted !'
            );
        }

        redirect(base_url() . 'Project/' . $project_wrk_id);
    }
    // END EORKSPACE MEMBER
    #===========================================================================

}
