<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Card_checklist_controller extends BaseController
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
        $this->load->model('transaction/Card_checklist_model');
        $this->load->model('transaction/Checklist_item_model');
        $this->load->model('master/variable_model');

        $this->IsLoggedIn();
    }

    function DetailChecklistItem(
        $project_id = '',
        $board_id = '',
        $list_id = '',
        $card_id = '',
        $card_checklist_id = ''
    ) {
        $card_checklist_parameter = [
            'p_card_checklist_id' => $card_checklist_id,
            'p_card_id' => '',
            'p_flag' => 3,
        ];

        $data['CardChecklistRecord'] = $this->Card_checklist_model->Get(
            $card_checklist_parameter
        );

        $card_member_parameter = [
            'p_card_member_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_flag' => 4,
            'p_project_id' => '',
        ];

        $data['CardMemberRecord'] = $this->Card_member_model->Get(
            $card_member_parameter
        );

        $checklist_item_parameter = [
            'p_checklist_item_id' => '',
            'p_card_checklist_id' => $card_checklist_id,
            'p_member_id' => '',
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 2,
        ];

        $data['ChecklistItemRecord'] = $this->Checklist_item_model->Get(
            $checklist_item_parameter
        );

        $variable_status_cheklist_item_parameter = [
            'p_variable_id' => '',
            'p_flag' => 1,
        ];

        $data['StatusChecklistItemRecord'] = $this->variable_model->GetVariable(
            $variable_status_cheklist_item_parameter
        );

        #cek user_level_project
        #============================================================================
        $Project_member_parameter = [
            'p_card_member_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => $this->session->userdata('member_id'),
            'p_flag' => 5,
            'p_project_id' => $project_id,
        ];

        $data['UserMemberRoleProject'] = $this->Card_member_model->Get(
            $Project_member_parameter
        );

        $cheklist_member = [
            'p_checklist_item_id' => '',
            'p_card_checklist_id' => $card_id,
            'p_member_id' => $this->session->userdata('member_id'),
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 3,
        ];

        $data['UserMemberChecklist'] = $this->Checklist_item_model->Get(
            $cheklist_member
        );

        $data['member_id'] = $this->session->userdata('member_id');
        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Card Detail';
        $this->loadViews(
            'transaction/Checklist_item_detail',
            $this->global,
            $data,
            null
        );
    }

    function InsertCardChecklist()
    {
        #Header
        $project_id = $this->input->post('project_id');
        $board_id = $this->input->post('board_id');
        $list_id = $this->input->post('list_id');
        $card_id = $this->input->post('card_id');
        #Detail Member
        $card_checklist_id = '';
        $checklist_name = $this->input->post('checklist_name');
        $percentage = '';
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $card_checklist_parameter = [
            $card_checklist_id,
            $card_id,
            $checklist_name,
            $percentage,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $record_status,
        ];

        $result = $this->Card_checklist_model->Insert(
            $card_checklist_parameter
        );

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'New Card checklist created successfully !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Card checklist creation failed !'
            );
        }
        redirect(
            base_url() .
                'DetailCard/' .
                $project_id .
                '/' .
                $board_id .
                '/' .
                $list_id .
                '/' .
                $card_id
        );
    }

    function UpdateCardChecklist()
    {
        $card_checklist_id = $this->input->post('card_checklist_id');
        $card_id = $this->input->post('card_id');
        $checklist_name = $this->input->post('checklist_name');
        $percentage = $this->input->post('percentage');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = 0;

        $param = [
            $card_checklist_id,
            $card_id,
            $checklist_name,
            $percentage,
            $p_change_user_id,
            $p_record_status,
            $flag,
        ];

        $result = $this->Card_checklist_model->Update($param);

        if ($result > 0) {
            $this->session->set_flashdata('success', 'Card Checklist Updated');
            echo json_encode($result);
        } else {
            $this->session->set_flashdata(
                'error',
                'Card Checklist Cannot Update'
            );
        }
    }

    function UpdateCardChecklistPercentage()
    {
        $card_checklist_id = $this->input->post('card_checklist_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = 1;

        $param = [
            $card_checklist_id,
            '',
            '',
            '',
            $p_change_user_id,
            $p_record_status,
            $flag,
        ];

        $result = $this->Card_checklist_model->Update($param);

        if ($result > 0) {
            echo json_encode($result);
        } else {
            $this->session->set_flashdata(
                'error',
                'Card Checklist Cannot Update'
            );
        }
    }

    function DeleteCardChecklist(
        $project_id = '',
        $board_id = '',
        $list_id = '',
        $card_id = '',
        $card_checklist_id = ''
    ) {
        $result = $this->Card_checklist_model->Delete($card_checklist_id);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Card checklist comment has been deleted !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Card checklist comment cannot deleted !'
            );
        }

        redirect(
            base_url() .
                'DetailCard/' .
                $project_id .
                '/' .
                $board_id .
                '/' .
                $list_id .
                '/' .
                $card_id
        );
    }
}
