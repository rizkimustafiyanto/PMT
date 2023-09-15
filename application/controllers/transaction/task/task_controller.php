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

        #TASK
        #============================================================================
        $data['TaskRecords'] = $this->task_model->Get(['', $p_list_id, '', '', $memberID, 0]);
        $data['StatusTaskRecords'] = $this->variable_model->GetVariable(['', 5]);

        #LIST
        #============================================================================
        $listData = $this->list_model->Get([$p_list_id, $p_project_id, '', '', '', $memberID, 0]);
        $data['ListRecords'] = $this->list_model->Get([$p_list_id, $p_project_id, '', '', '', $memberID, 0]);
        $data['ListMemberRecords'] = $this->list_member_model->Get(['', $p_list_id, '', 0]);
        $data['ListMemberTotalRecords'] = $this->list_member_model->Get(['', $p_list_id, '', 2]);
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

        #TOOLS
        #============================================================================
        $creatorList = '';
        if (!empty($listData)) {
            foreach ($listData as $key) {
                $creatorList = $key->creation_user_id;
            }
        }
        if (!empty($ProjectRecords)) {
            foreach ($ProjectRecords as $key) {
                $start = $key->start_date;
                $due = $key->due_date;
            }
        }

        $data['prj_start'] = $start;
        $data['prj_due'] = $due;
        $data['list_id'] = $p_list_id;
        $data['project_id'] = $p_project_id;
        $data['creator'] = $creatorList;

        #Cek user_level_project
        #============================================================================

        $data['UserMemberType'] = $this->list_member_model->Get(['', $p_project_id, $memberID, 3]);
        $data['member_id'] = $memberID;

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

        $memberName = $this->session->userdata('member_name');
        $object = $task_name;
        $text_log = 'New task "' . $object . '" created by "' . $memberName . '"';
        $group_id = $list_id;
        $logging = [
            $text_log,
            $group_id,
            $creation_user_id
        ];

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Task created successfully'
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
