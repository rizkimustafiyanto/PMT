<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Kanban_project_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project_wrk/Project_wrk_model');
        $this->load->model('transaction/project_wrk/Project_wrk_member_model');
        $this->load->model('transaction/project/Project_model');
        $this->load->model('transaction/project/Project_member_model');
        $this->load->model('transaction/project/Item_model');
        $this->load->model('transaction/project/Item_member_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->IsLoggedIn();
    }

    public function KanbanProject($p_project_wrk_id = '')
    {
        $memberID = $this->session->userdata('member_id');
        #SELECT STATUS
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);
        #===========================================================================================
        #SELECT MEMBER
        $data['ProjectWrkMemberRecords'] = $this->Project_wrk_member_model->Get(['', $p_project_wrk_id, '', '', 2]);
        #===========================================================================================
        #VIEW PROJECT
        $data['ProjectList'] = $this->Project_model->Get(['', $p_project_wrk_id, '', '', '', '', 1]);
        $ProjectWrkRecords = $this->Project_wrk_model->Get([$p_project_wrk_id, '', 1, $memberID]);
        $data['ProjectMemberRecords'] = $this->Project_wrk_member_model->Get(['', $p_project_wrk_id, '', '', 6]);

        if (!empty($ProjectWrkRecords)) {
            foreach ($ProjectWrkRecords as $key) {
                $tempstart = $key->start_date;
                $tempdue = $key->due_date;
            }
        }
        #===========================================================================================

        #TOOLS
        $data['member_id'] = $memberID;
        $data['ProjectWrkId'] = $p_project_wrk_id;
        $data['tempstart'] = $tempstart;
        $data['tempdue'] = $tempdue;
        #===========================================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Detail';
        $this->loadViews('transaction/project/Kanban_project', $this->global, $data, null);
    }

    public function KanbanItem($p_project_wrk_id = '', $p_project_id = '')
    {
        $memberID = $this->session->userdata('member_id');
        #SELECT STATUS
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);
        #===========================================================================================
        #SELECT MEMBER
        $data['ProjectMemberRecords'] = $this->Project_wrk_member_model->Get(['', $p_project_wrk_id, '', '', 2]);
        #===========================================================================================
        #VIEW PROJECT
        $data['ItemList'] = $this->Item_model->Get(['', $p_project_id, '', '', $memberID, 1]);
        $data['ProjectList'] = $this->Project_model->Get([$p_project_id, $p_project_wrk_id, '', '', '', $memberID, 0]);
        $ProjectRecords = $this->Project_model->Get([$p_project_id, $p_project_wrk_id, '', '', '', $memberID, 0]);
        $data['ItemMemberRecords'] = $this->Project_member_model->Get(['', $p_project_id, '', 4]);

        if (!empty($ProjectRecords)) {
            foreach ($ProjectRecords as $key) {
                $tempstart = $key->start_date;
                $tempdue = $key->due_date;
            }
        }
        #===========================================================================================

        #TOOLS
        $data['member_id'] = $memberID;
        $data['ProjectId'] = $p_project_id;
        $data['tempstart'] = $tempstart;
        $data['tempdue'] = $tempdue;
        #===========================================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Detail';
        $this->loadViews('transaction/project_detail/Kanban_item', $this->global, $data, null);
    }
}
