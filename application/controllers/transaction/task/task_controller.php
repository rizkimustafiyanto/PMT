<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class task_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project/project_model');
        $this->load->model('transaction/project/project_member_model');
        $this->load->model('transaction/list/list_member_model');
        $this->load->model('transaction/list/list_model');
        $this->load->model('transaction/task/task_model');
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('transaction/tools/Log_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->IsLoggedIn();
    }

    public function Task($p_project_id = '', $p_list_id = '')
    {
        $memberID =  $this->session->userdata('member_id');

        #LIST
        #============================================================================
        $listData = $this->list_model->Get([$p_list_id, $p_project_id, '', '', '', $memberID, 0]);
        $ListMemberTotalRecords = $this->list_member_model->Get(['', $p_list_id, '', 2]);
        $data['ListMemberRecords'] = $this->list_member_model->Get(['', $p_list_id, '', 0]);
        $data['MemberSelectRecord'] = $this->list_member_model->Get(['', $p_list_id, '', 1]);

        #PROJECT
        #============================================================================
        $ProjectRecords = $this->project_model->Get([$p_project_id, '', 1, $memberID]);
        $data['MemberTypeRecords'] = $this->variable_model->GetVariable(['', 2]);
        $data['ProjectTypeRecords'] = $this->variable_model->GetVariable(['', 4]);
        $data['ProjectMemberRecords'] = $this->project_member_model->Get(['', $p_project_id, '', '', 2,]);

        #Log
        #============================================================================
        $data['LogRecord'] = $this->Log_model->Get(['', $p_list_id, '', 2]);

        #Attachment
        #============================================================================
        $data['AttachmentRecord'] = $this->Attachment_model->Get(['', '', $p_list_id, 2]);
        $data['AttachmentTypeRecord'] = $this->variable_model->GetVariable(['', 3]);

        #Cek user_level_project
        #============================================================================
        $UserMemberType = $this->list_member_model->Get(['', $p_list_id, $memberID, 3]);
        $cekRoling = $this->project_member_model->Get(['', $p_project_id, $memberID, '', 4]);

        #TOOLS
        #============================================================================
        $creatorList = '';
        $list_name = '';
        $start_date = '';
        $due_date = '';
        $priority_type = '';
        $status_id = '';
        $status_name = '';
        $percentage = 0;
        $description = '';
        $list_type = '';
        $total_member = 0;
        $member_type = '';
        $member_prj_type = '';

        if (!empty($listData)) {
            foreach ($listData as $key) {
                $creatorList = $key->creation_user_id;
                $list_name = $key->list_name;
                $priority_type = $key->priority_type_id;
                $start_date = $key->start_date;
                $due_date = $key->due_date;
                $description = $key->description;
                $status_name = $key->list_status;
                $status_id = $key->status_id;
                $percentage = $key->percentage;
                $list_type = $key->priority_type;
            }
            $percentage = (empty($percentage)) ? 0 : $percentage;
            if (strlen($percentage) > 4) {
                $percentage = number_format($percentage, 2);
            }
        }
        if (!empty($ProjectRecords)) {
            foreach ($ProjectRecords as $key) {
                $start = $key->start_date;
                $due = $key->due_date;
            }
        }

        if (!empty($ListMemberTotalRecords)) {
            foreach ($ListMemberTotalRecords as $recordTotal) {
                $total_member = $recordTotal->total_member;
            }
        }

        if (!empty($UserMemberType)) {
            foreach ($UserMemberType as $key) {
                $member_type = $key->member_type;
            }
        }

        if (!empty($cekRoling)) {
            foreach ($cekRoling as $key) {
                $member_prj_type = $key->member_type;
            }
        }

        #AMBIL
        #============================================================================
        $data['prj_start'] = $start;
        $data['prj_due'] = $due;
        $data['list_id'] = $p_list_id;
        $data['project_id'] = $p_project_id;
        $data['creator'] = $creatorList;
        $data['member_id'] = $memberID;
        $data['list_name'] = $list_name;
        $data['start_date'] = $start_date;
        $data['due_date'] = $due_date;
        $data['priority_type'] = $priority_type;
        $data['status_id'] = $status_id;
        $data['status_name'] = $status_name;
        $data['percentage'] = $percentage;
        $data['description'] = $description;
        $data['list_type'] = $list_type;
        $data['total_member'] = $total_member;
        $data['member_type'] = $member_type;
        $data['member_prj_type'] = $member_prj_type;

        #============================================================================

        #TASK
        #============================================================================
        $data['TaskRecords'] = $this->task_model->Get(['', $p_list_id, '', '', $memberID, ($member_type == 'MT-1' || $member_type == 'MT-2' || $member_prj_type == 'MT-1' || $member_prj_type == 'MT-4') ? 3 : 2]);
        $data['StatusTaskRecords'] = $this->variable_model->GetVariable(['', 5]);

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project';
        $this->loadViews('transaction/task/task', $this->global, $data, null);
    }

    // INSERT PROJECT
    function InsertTask()
    {
        $task_id = '';
        $list_id = $this->input->post('list_id');
        $task_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $member_id = $this->input->post('membersTask');
        $p_task_status = $this->input->post('status');
        $creation_user_id = $this->session->userdata('member_id');

        $task_param = [
            $task_id,
            $list_id,
            $task_name,
            $start_date,
            $due_date,
            $p_priority,
            $member_id,
            $p_task_status,
            $creation_user_id
        ];

        $result = $this->task_model->Insert($task_param);

        // #EMAILING CONFIG
        // #==============================================================================================================
        // $memberRecords = $this->list_member_model->Get(['', $list_id, '', 0]);

        // $penerima = 'pt.ujicobaku@gmail.com'; //Send Email Percobaan
        // $namaMember = '';
        // $userMail = [];

        // foreach ($memberRecords as $member) {
        //     $userMail[] = $member->email;
        // }

        // $subject_email = 'Create New Project';
        // $isi_email = "Halo,\n\n\tAda projek baru di PMT. Berikut adalah detailnya:\n\n\tNama\t\t\t\t: " .
        //     $namaMember . "\n\tEmail\t\t\t\t: " . $userMail . "\n\tTask Name\t: " . $task_name . "\n\nTerima kasih.";
        // $email = new Email();

        // #END EMAILING CONFIG
        // #==============================================================================================================

        #LOGGING
        #==============================================================================================================
        $memberName = $this->session->userdata('member_name');
        $object = $task_name;
        $text_log = 'New task "' . $object . '" created by "' . $memberName . '"';
        $group_id = $list_id;
        $logging = [
            $text_log,
            $group_id,
            $creation_user_id
        ];
        #END LOGGING
        #==============================================================================================================

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Task created successfully Email addresses: '
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create item'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateTask()
    {
        #Header
        #================================================
        $task_id = $this->input->post('id');
        $list_id = $this->input->post('list_id');
        $task_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_task_status = $this->input->post('status');
        $p_member_id = $this->input->post('memberId');
        $p_change_user_id = $this->session->userdata('member_id');
        $flag = $this->input->post('flag');

        $param = [
            $task_id,
            $list_id,
            $task_name,
            $start_date,
            $due_date,
            $p_priority,
            $p_task_status,
            $p_member_id,
            $p_change_user_id,
            $flag
        ];

        $result = $this->task_model->Update($param); //Execute Function

        $var = $this->variable_model->GetVariable([$p_task_status, 12]);
        $TR = $this->task_model->Get([$task_id, '', '', '', '', 1]);
        $memberName = $this->session->userdata('member_name');

        if ($flag == '1') {
            foreach ($var as $key) {
                $var_name = $key->variable_name;
            }
            foreach ($TR as $key) {
                $task_name = $key->task_name;
            }
            $object = $task_name;
            $text_log = 'Task status "' . $object . '" to be "' . $var_name . '" by "' . $memberName . '"';
        } else {
            $object = $task_name;
            $text_log = 'Task "' . $object . '" updated by "' . $memberName . '"';
        }
        $group_id = $list_id;
        $logging = [
            $text_log,
            $group_id,
            $p_change_user_id
        ];

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Task Updated!'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Task Cannot Update!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteTask()
    {
        $task_id = $this->input->post('id');
        $list_id = $this->input->post('list_id');
        $task_name = $this->input->post('title');
        $doer = $this->session->userdata('member_id');

        $memberName = $this->session->userdata('member_name');
        $object = $task_name;
        $text_log = 'Task "' . $object . '" deleted by "' . $memberName . '"';
        $group_id = $list_id;
        $logging = [
            $text_log,
            $group_id,
            $doer
        ];

        $result = $this->task_model->Delete($task_id);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Task Deleted!'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Task Cannot Deleted!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
