<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class kanban_list_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project/project_model');
        $this->load->model('transaction/project/project_member_model');
        $this->load->model('transaction/list/list_model');
        $this->load->model('transaction/list/list_member_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->IsLoggedIn();
    }

    public function KanbanList($p_project_id = '')
    {
        $memberID = $this->session->userdata('member_id');
        #SELECT MEMBER
        #===========================================================================================
        $data['MemberSelectRecord'] = $this->project_member_model->Get(['', $p_project_id, '', '', 2]);

        #VIEW PROJECT
        #===========================================================================================
        $ProjectRecords = $this->project_model->Get([$p_project_id, '', 1, $memberID]);
        $ProjectMembers = $this->project_member_model->Get(['', $p_project_id, '', '', 6]);
        $cekRoling = $this->project_member_model->Get(['', $p_project_id, $memberID, '', 4]);
        $StatusListing = $this->variable_model->GetVariable(['', 5]);
        $data['ProjectRecords'] = $ProjectRecords;
        $data['ProjectMemberRecords'] = $ProjectMembers;

        $tempstart = '';
        $tempdue = '';
        $creator = '';
        $lvlUser = '';
        $stcukName = '';
        $todoName = '';
        $inprogressName = '';
        $doneName = '';

        if (!empty($ProjectRecords)) {
            foreach ($ProjectRecords as $key) {
                $tempstart = $key->start_date;
                $tempdue = $key->due_date;
                $creator = $key->creation_id;
            }
        }
        if (!empty($cekRoling)) {
            foreach ($cekRoling as $key) {
                $lvlUser = $key->member_type;
            }
        }
        if (!empty($StatusListing)) {
            foreach ($StatusListing as $key) {
                if ($key->variable_id == 'STL-3') {
                    $stcukName = $key->list_name;
                }
                if ($key->variable_id == 'STL-2') {
                    $inprogressName = $key->list_name;
                }
                if ($key->variable_id == 'STL-1') {
                    $todoName = $key->list_name;
                }
                if ($key->variable_id == 'STL-4') {
                    $doneName = $key->list_name;
                }
            }
        }
        #===========================================================================================

        #TOOLS
        $data['member_id'] = $memberID;
        $data['ProjectId'] = $p_project_id;
        $data['tempstart'] = $tempstart;
        $data['tempdue'] = $tempdue;
        $data['creator'] = $creator;
        $data['lvlUser'] = $lvlUser;
        $data['stcukName'] = $stcukName;
        $data['todoName'] = $todoName;
        $data['inprogressName'] = $inprogressName;
        $data['doneName'] = $doneName;

        #AMBIL
        #============================================================================
        $data['ListRecords'] = $this->list_model->Get(['', $p_project_id, '', '', '', $memberID, ($lvlUser == 'MT-1' || $lvlUser == 'MT-2') ? 3 : 1]);
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);

        #===========================================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Detail';
        $this->loadViews('transaction/list/kanban_list', $this->global, $data, null);
    }
}
