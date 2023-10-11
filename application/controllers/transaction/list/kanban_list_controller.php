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
        $this->load->model('master/management_member_model');
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
        $manageAccess = $this->management_member_model->Get([$memberID, 1]);
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
        $collabMember = '';
        $collabName = '';

        if (!empty($ProjectRecords)) {
            foreach ($ProjectRecords as $key) {
                $tempstart = $key->start_date;
                $tempdue = $key->due_date;
                $creator = $key->creation_id;
                $collabMember = $key->collaboration_member;
                $collabName = $key->collaboration_name;
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

        $cekingCol = '';
        if ($collabMember) {
            $wordsCollabMember = explode(" ", $collabMember);
            $wordCountCollabMember = count($wordsCollabMember);

            if ($wordCountCollabMember > 0) {
                $wordsCollabName = explode(" ", $collabName);
                $wordCountCollabName = count($wordsCollabName);

                if ($wordCountCollabName > 0) {
                    $cekingCol = $collabMember;
                }
            }
        }

        if (empty($cekingCol)) {
            $cekingCol = json_encode($this->session->userdata('company_id'));
        }

        $aksessing = '';
        $batas_akses = '';
        if (!empty($manageAccess)) {
            foreach ($manageAccess as $key) {
                $manageAkses = $key->akses;
            }
            $batas_akses = ($manageAkses != '0');
        } else {
            $batas_akses = ($memberID == 'System' || $memberID == $creator || $lvlUser == 'MT-2' || $lvlUser != 'MT-4');
        }
        #===========================================================================================

        #TOOLS
        $data['member_id'] = $memberID ?? '-';
        $data['ProjectId'] = $p_project_id ?? '-';
        $data['tempstart'] = $tempstart ?? '-';
        $data['tempdue'] = $tempdue ?? '-';
        $data['creator'] = $creator ?? '-';
        $data['lvlUser'] = $lvlUser ?? '-';
        $data['stcukName'] = $stcukName ?? '-';
        $data['todoName'] = $todoName ?? '-';
        $data['inprogressName'] = $inprogressName ?? '-';
        $data['doneName'] = $doneName ?? '-';
        $data['collab_member'] = $cekingCol ?? '-';
        $data['batas_akses'] = $batas_akses;

        #AMBIL
        #============================================================================
        $data['ListRecords'] = $this->list_model->Get(['', $p_project_id, '', '', '', $memberID, ($lvlUser == 'MT-1' || $lvlUser == 'MT-2' || $lvlUser == 'MT-4' || $lvlUser == 'MT-I') ? 3 : 1]);
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);

        #===========================================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Detail';
        $this->loadViews('transaction/list/kanban_list', $this->global, $data, null);
    }
}
