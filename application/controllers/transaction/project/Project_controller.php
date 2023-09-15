<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class project_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project/project_model');
        $this->load->model('transaction/project/project_member_model');
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('transaction/tools/Log_model');
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
        $this->loadViews('transaction/Project', $this->global, null, null);
    }

    function GetProject()
    {
        $memberID =  $this->session->userdata('member_id');
        $data['ProjectRecords'] = $this->project_model->Get(['', '', 0, $memberID]);
        $data['ProjectMemberRecords'] = $this->project_member_model->Get(['', '', '', '', 0]);
        $data['ProjectTypeRecords'] = $this->variable_model->GetVariable(['', 4]);
        $data['tempmember'] = $this->member_model->Get([0, 0]);

        #============================================================================

        $data['member_id'] = $memberID;

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Workspace';
        $this->loadViews(
            'transaction/project/project',
            $this->global,
            $data,
            null
        );
    }

    function InsertProject()
    {
        $project_id = '';
        $project_name = $this->input->post('title');
        $project_type = $this->input->post('projectType');
        $project_start = $this->input->post('start');
        $project_due = $this->input->post('due');
        $description = $this->input->post('description');
        $members_project = $this->input->post('membersProject');
        $creation_user_id = $this->session->userdata('member_id');
        $status_id = 'STW-1'; # status projectnya On process
        $Project_parameter = [
            $project_id,
            $project_name,
            $project_type,
            $project_start,
            $project_due,
            $description,
            $members_project,
            $creation_user_id,
            $status_id
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

        $result = $this->project_model->Insert($Project_parameter);

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
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project created successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create project!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateProject()
    {
        $p_project_id = $this->input->post('id');
        $p_project_name = $this->input->post('title');
        $p_project_type = $this->input->post('projectType');
        $p_project_start = $this->input->post('start');
        $p_project_due = $this->input->post('due');
        $p_description = $this->input->post('description');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_status_id =  $this->input->post('status');
        $flag = $this->input->post('flag');

        $param = [
            $p_project_id,
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

        $result = $this->project_model->Update($param);

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
                'message' => 'Project updated successfully'
            );
        } else {
            // $this->session->set_flashdata('error', 'Project Cannot Update');
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Project updated failed!'
            );
        }
        // redirect('Project');
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteProject()
    {
        $Project_id = $this->input->post('project_id');
        $result = $this->project_model->Delete($Project_id);

        if ($result > 0) {
            $response = 'Project has been deleted !';
        } else {
            $response = 'Project cannot deleted !';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // PROJECT MEMBER
    #===========================================================================
    function InsertProjectMember()
    {
        $project_id = $this->input->post('project_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $creation_user_id = $this->session->userdata('member_id');
        $record_status = $this->input->post('r_status');

        $project_param = [
            $project_id,
            $member_id,
            $member_type_id,
            $creation_user_id,
            $record_status
        ];

        $result = $this->project_member_model->Insert($project_param);

        // LOGGING
        $memberName = $this->session->userdata('member_name');
        $dataMember = $this->member_model->Get([$member_id, 1]);
        foreach ($dataMember as $key) {
            $thismember = $key->member_name;
        }
        $object = $thismember;
        $text_log = 'Member "' . $object . '" inserted by "' . $memberName . '"';
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
                'message' => 'Project member insert successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create project member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateProjectMember()
    {
        //Bikin pengecekan array
        $project_member_id = $this->input->post('project_member_id');
        $project_id = $this->input->post('project_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';

        $param = [
            $project_member_id,
            $project_id,
            $member_id,
            $member_type_id,
            $p_change_user_id,
            $p_record_status,
        ];

        //eksekusi query
        $result = $this->project_member_model->Update($param);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Project workspace member Updated'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Project workspace member Cannot Update'
            );
        }

        redirect(base_url() . 'Project/' . $project_id);
    }

    function DeleteProjectMember()
    {
        $project_member_id = $this->input->post('project_member_id');

        // LOGGING
        $dataMember = $this->project_member_model->Get([$project_member_id, '', '', 7]);
        foreach ($dataMember as $key) {
            $thismember = $key->member_name;
            $thisgroup = $key->project_id;
        }
        $memberName = $this->session->userdata('member_name');
        $memberID = $this->session->userdata('member_id');
        $object = $thismember;
        $text_log = 'Member "' . $object . '" removed by "' . $memberName . '"';
        $group_id = $this->input->post('group_id');
        $logging = [
            $text_log,
            $group_id,
            $memberID
        ];

        // EXCECUTION
        $result = $this->project_member_model->Delete($project_member_id);
        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project member deleted successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to delete project member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    // END EORKSPACE MEMBER
    #===========================================================================

}
