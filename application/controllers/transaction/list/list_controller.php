<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class list_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project/project_model');
        $this->load->model('transaction/project/project_member_model');
        $this->load->model('transaction/list/list_model');
        $this->load->model('transaction/list/list_member_model');
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('transaction/tools/Log_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->IsLoggedIn();
    }

    public function List($p_project_id = '')
    {
        $memberID =  $this->session->userdata('member_id');

        #List List
        #============================================================================
        $data['ListRecords'] = $this->list_model->Get(['', $p_project_id, '', '', '', $memberID, 1]);
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);

        #Project List
        #============================================================================
        $projectData = $this->project_model->Get([$p_project_id, '', 1, $memberID,]);
        $data['ProjectRecords'] = $projectData;
        $data['ProjectMemberRecords'] = $this->project_member_model->Get(['', $p_project_id, '', '', 2,]);
        $data['ProjectMemberTotalRecords'] = $this->project_member_model->Get(['', $p_project_id, '', '', 3,]);
        $data['MemberRecords'] = $this->member_model->Get(['', 0]);
        $data['MemberTypeRecords'] = $this->variable_model->GetVariable(['', 2]);
        $data['ProjectTypeRecords'] = $this->variable_model->GetVariable(['', 4]);
        $data['StatusProjectRecords'] = $this->variable_model->GetVariable(['', 9]);
        $data['MemberSelectRecord'] = $this->project_member_model->Get(['', $p_project_id, '', '', 2]);

        #Attachment
        #============================================================================
        $data['AttachmentRecord'] = $this->Attachment_model->Get(['', '', $p_project_id, 2]);
        $data['AttachmentTypeRecord'] = $this->variable_model->GetVariable(['', 3]);

        #Log
        #============================================================================
        $data['LogRecord'] = $this->Log_model->Get(['', $p_project_id, '', 2]);

        #Find Kebutuhan
        #============================================================================
        $creatorProject = '';
        if (!empty($projectData)) {
            foreach ($projectData as $key) {
                $creatorProject = $key->creation_id;
            }
        }

        #Cek Kebutuhan
        #============================================================================
        $data['UserMemberRoleList'] = $this->project_member_model->Get(['', $p_project_id, $memberID, '', 4]);
        $data['member_id'] = $memberID;
        $data['creator'] = $creatorProject;
        $data['project_id'] = $p_project_id;


        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : List';
        $this->loadViews('transaction/list/list', $this->global, $data, null);
    }

    // INSERT PROJECT
    function InsertList()
    {
        #Header
        $list_id = '';
        $project_id = $this->input->post('idProject');
        $list_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_description = $this->input->post('description');
        $member_id = $this->input->post('membersList');
        $p_list_status = $this->input->post('status');
        $creation_user_id = $this->session->userdata('member_id');
        $record_status = 'A';

        $list_param = [
            $list_id,
            $project_id,
            $list_name,
            $start_date,
            $due_date,
            $p_priority,
            $member_id,
            $p_list_status,
            $p_description,
            $creation_user_id,
            $record_status
        ];
        $result = $this->list_model->Insert($list_param);

        $memberName = $this->session->userdata('member_name');
        $object = $list_name;
        $text_log = 'New list "' . $object . '" created by "' . $memberName . '"';
        $group_id = $project_id;
        $logging = [
            $text_log,
            $group_id,
            $creation_user_id
        ];

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'List created successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create project'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateList()
    {
        #Header
        #================================================
        $p_list_id = $this->input->post('id');
        $p_project_id = $this->input->post('idProject');
        $p_list_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_description = $this->input->post('description');
        $p_item_status = $this->input->post('status');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = $this->input->post('flag');

        $param = [
            $p_list_id,
            $p_project_id,
            $p_list_name,
            $start_date,
            $due_date,
            $p_priority,
            $p_item_status,
            $p_description,
            $p_change_user_id,
            $p_record_status,
            $flag
        ];


        $result = $this->list_model->Update($param); //Execute Function

        $var = $this->variable_model->GetVariable([$p_item_status, 12]);
        $TR = $this->list_model->Get([$p_list_id, '', '', '', '', '', 2]);
        $memberName = $this->session->userdata('member_name');

        if ($flag == '1') {
            foreach ($var as $key) {
                $var_name = $key->variable_name;
            }
            foreach ($TR as $key) {
                $p_list_name = $key->list_name;
            }
            $object = $p_list_name;
            $text_log = 'List "' . $object . '" to be "' . $var_name . '" by "' . $memberName . '"';
        } else {
            $object = $p_list_name;
            $text_log = 'List "' . $object . '" updated by "' . $memberName . '"';
        }

        $group_id = $p_project_id;
        $logging = [
            $text_log,
            $group_id,
            $p_change_user_id
        ];

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'List Updated!'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'List Cannot Update!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteList()
    {
        $param = $this->input->post('list_id');
        $memberID = $this->session->userdata('member_id');
        $memberName = $this->session->userdata('member_name');
        $datalist = $this->list_model->Get([$param, '', '', '', '', '', 2]);
        foreach ($datalist as $key) {
            $p_list_name = $key->list_name;
        }
        $object = $p_list_name;
        $text_log = 'List "' . $object . '" deleted by "' . $memberName . '"';
        $group_id = $this->input->post('group_id');
        $logging = [
            $text_log,
            $group_id,
            $memberID
        ];

        $result = $this->list_model->Delete($param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'List Deleted Successfully!'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'List Cannot Delete!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function InsertListMember()
    {
        $list_id = $this->input->post('list_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $creation_user_id = $this->session->userdata('member_id');

        $item_param = [
            $list_id,
            $member_id,
            $member_type_id,
            $creation_user_id
        ];

        $result = $this->list_member_model->Insert($item_param);

        // LOGGING
        $memberName = $this->session->userdata('member_name');
        $dataMember = $this->member_model->Get([$member_id, 1]);
        foreach ($dataMember as $key) {
            $thismember = $key->member_name;
        }
        $object = $thismember;
        $text_log = 'Member "' . $object . '" inserted by "' . $memberName . '"';
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
                'message' => 'List member insert successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create list member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteListMember()
    {
        $list_member_id = $this->input->post('list_member_id');

        // LOGGING
        $dataMember = $this->list_member_model->Get([$list_member_id, '', '', 5]);

        foreach ($dataMember as $key) {
            $thismember = $key->member_name;
            $thisgroup = $key->list_id;
        }
        $memberName = $this->session->userdata('member_name');
        $memberID = $this->session->userdata('member_id');
        $object = $thismember;
        $text_log = 'Member "' . $object . '" removed by "' . $memberName . '"';
        $group_id = $thisgroup;
        $logging = [
            $text_log,
            $group_id,
            $memberID
        ];

        // EXCEUTION
        $result = $this->list_member_model->Delete($list_member_id);
        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'List member deleted successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to delete list member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}