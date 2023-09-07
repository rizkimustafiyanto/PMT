<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Item_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project_wrk/Project_wrk_model');
        $this->load->model('transaction/project_wrk/Project_wrk_member_model');
        $this->load->model('transaction/project/Project_member_model');
        $this->load->model('transaction/project/Project_model');
        $this->load->model('transaction/project/Item_model');
        $this->load->model('transaction/project/Item_member_model');
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->load->helper('log_helper');
        $this->IsLoggedIn();
    }

    public function ProjectItem($p_project_wrk_id = '', $p_project_id = '')
    {
        $memberID =  $this->session->userdata('member_id');

        #Project List
        #============================================================================
        $data['ProjectRecords'] = $this->Project_model->Get([$p_project_id, '', '', '', '', $memberID, 0]);
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);
        $data['ProjectMemberRecords'] = $this->Project_member_model->Get(['', $p_project_id, '', 0]);
        $data['ProjectMemberTotalRecords'] = $this->Project_member_model->Get(['', $p_project_id, '', 2]);
        $data['MemberSelectRecord'] = $this->Project_member_model->Get(['', $p_project_id, '', 1]);

        #Item List
        #============================================================================
        $data['ItemRecords'] = $this->Item_model->Get(['', $p_project_id, '', '', $memberID, 1]);

        #Workspace Project
        #============================================================================
        $ProjectWrkRecords = $this->Project_wrk_model->Get([$p_project_wrk_id, '', 1, $memberID,]);
        $data['MemberTypeRecords'] = $this->variable_model->GetVariable(['', 2]);
        $data['ProjectTypeRecords'] = $this->variable_model->GetVariable(['', 4]);
        $data['ProjectWrkMemberRecords'] = $this->Project_wrk_member_model->Get(['', $p_project_wrk_id, '', '', 2]);


        #Attachment
        #============================================================================
        $data['AttachmentRecord'] = $this->Attachment_model->Get(['', '', $p_project_id, 2]);
        $data['AttachmentTypeRecord'] = $this->variable_model->GetVariable(['', 3]);

        #TOOLS
        #============================================================================
        if (!empty($ProjectWrkRecords)) {
            foreach ($ProjectWrkRecords as $key) {
                $start = $key->start_date;
                $due = $key->due_date;
            }
        }

        $data['wrk_start'] = $start;
        $data['wrk_due'] = $due;

        #Cek user_level_project
        #============================================================================

        $data['UserMemberType'] = $this->Project_member_model->Get(['', $p_project_id, $memberID, 3]);
        $data['member_id'] = $memberID;

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project';
        $this->loadViews('transaction/project_detail/Project_detail', $this->global, $data, null);
    }

    // INSERT PROJECT
    function InsertProjectItem()
    {
        $item_id = '';
        $project_id = $this->input->post('idProject');
        $project_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_description = $this->input->post('description');
        $member_id = $this->input->post('membersItem');
        $p_item_status = $this->input->post('status');
        $creation_user_id = $this->session->userdata('member_id');

        $item_param = [
            $item_id,
            $project_id,
            $project_name,
            $start_date,
            $due_date,
            $p_priority,
            $member_id,
            $p_item_status,
            $p_description,
            $creation_user_id
        ];
        $result = $this->Item_model->Insert($item_param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Item created successfully'
            );
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

    function UpdateProjectItem()
    {
        #Header
        #================================================
        $project_item_id = $this->input->post('id');
        $project_id = $this->input->post('idProject');
        $project_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_description = $this->input->post('description');
        $p_item_status = $this->input->post('status');
        $p_change_user_id = $this->session->userdata('member_id');
        $flag = $this->input->post('flag');

        $param = [
            $project_item_id,
            $project_id,
            $project_name,
            $start_date,
            $due_date,
            $p_priority,
            $p_item_status,
            $p_description,
            $p_change_user_id,
            $flag
        ];

        $result = $this->Item_model->Update($param); //Execute Function

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Item Updated!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Item Cannot Update!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteProjectItem()
    {
        $param = $this->input->post('item_id');
        $result = $this->Item_model->Delete($param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Item Deleted!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Item Cannot Deleted!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function InsertProjectItemMember()
    {
        $project_id = $this->input->post('project_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $creation_user_id = $this->session->userdata('member_id');

        $item_param = [
            $project_id,
            $member_id,
            $member_type_id,
            $creation_user_id
        ];
        $result = $this->Project_member_model->Insert($item_param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project member insert successfully'
            );
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

    function DeleteProjectItemMember()
    {
        $project_member_id = $this->input->post('project_member_id');
        $result = $this->Project_member_model->Delete($project_member_id);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project member deleted successfully'
            );
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

    #VIEWS ITEM
    #===================================================================
    public function Item($p_item_id = '', $p_project_id = '')
    {
        $memberID =  $this->session->userdata('member_id');

        #Item List
        #============================================================================
        $data['ItemRecords'] = $this->Item_model->Get([$p_item_id, $p_project_id, '', '', $memberID, 0]);
        $data['ItemMemberRecords'] = $this->Item_member_model->Get(['', $p_item_id, $memberID, 0]);
        $data['ItemMemberTotalRecords'] = $this->Item_member_model->Get(['', $p_item_id, '', 2]);

        #Project List
        #============================================================================
        $ProjectRecords = $this->Project_model->Get([$p_project_id, '', '', '', '', $memberID, 0]);
        $data['ProjectRecords'] = $ProjectRecords;
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);

        #Attachment
        #============================================================================
        $data['AttachmentRecord'] = $this->Attachment_model->Get(['', '', $p_item_id, 2]);
        $data['AttachmentTypeRecord'] = $this->variable_model->GetVariable(['', 3]);

        #Tools
        #============================================================================
        if (!empty($ProjectRecords)) {
            foreach ($ProjectRecords as $key) {
                $wrk = $key->project_wrk_id;
                $start = $key->start_date;
                $due = $key->due_date;
            }
        }

        $data['prj_start'] = $start;
        $data['prj_due'] = $due;
        $data['project_wrk_id'] = $wrk;
        $data['MemberSelectRecord'] = $this->Project_member_model->Get(['', $p_project_id, $memberID, 0]);
        $data['MemberTypeRecord'] = $this->variable_model->GetVariable(['', 2]);

        #Cek user_level_project
        #============================================================================
        $data['UserMemberType'] = $this->Project_member_model->Get(['', $p_project_id, $memberID, 3]);
        $data['member_id'] = $memberID;

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project';
        $this->loadViews('transaction/project_detail/Item', $this->global, $data, null);
    }

    function InsertItemMember()
    {
        $item_id = $this->input->post('item_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $creation_user_id = $this->session->userdata('member_id');

        $item_param = [
            $item_id,
            $member_id,
            $member_type_id,
            $creation_user_id
        ];
        $result = $this->Item_member_model->Insert($item_param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Item member insert successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create item member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
