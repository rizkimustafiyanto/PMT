<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class List_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/Project_model');
        $this->load->model('transaction/Project_member_model');
        $this->load->model('transaction/Board_model');
        $this->load->model('transaction/List_model');
        $this->load->model('transaction/Card_model');

        $this->IsLoggedIn();
    }
    function DetailItemList($project_id = '', $board_id = '', $list_id = '')
    {
        $list_parameter = [
            'p_list_id' => $list_id,
            'p_board_id' => '',
            'p_flag' => 1,
            'p_member_id' => '',
        ];

        $data['BoardItemListRecord'] = $this->List_model->Get($list_parameter);

        $card_parameter = [
            'p_card_id' => '',
            'p_list_id' => $list_id,
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 2,
        ];

        $data['CardRecord'] = $this->Card_model->Get($card_parameter);

        $this->global['pageTitle'] = 'CodeInsect : Item List Detail';
        $this->loadViews(
            'transaction/Item_list_detail',
            $this->global,
            $data,
            null
        );
    }

    function InsertBoardItemList()
    {
        #Header
        $project_id = $this->input->post('project_id');
        $board_id = $this->input->post('board_id');
        #Detail Member
        $list_id = '';
        $list_name = $this->input->post('list_name');
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $list_parameter = [
            $list_id,
            $board_id,
            $list_name,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $record_status,
        ];

        $result = $this->List_model->Insert($list_parameter);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'New item list created successfully !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Item list creation failed !'
            );
        }
        redirect(
            base_url() .
                'DetailBoardProject/' .
                $project_id .
                '/' .
                $board_id
        );
    }

    function UpdateItemList()
    {
        $project_id = $this->input->post('project_id');
        $list_id = $this->input->post('list_id');
        $board_id = $this->input->post('board_id');
        $list_name = $this->input->post('list_name');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';

        $param = [
            $list_id,
            $board_id,
            $list_name,
            $p_change_user_id,
            $p_record_status,
        ];

        $result = $this->List_model->Update($param);

        if ($result > 0) {
            $this->session->set_flashdata('success', 'Item List Updated');
            //echo json_encode($result);
        } else {
            $this->session->set_flashdata('error', 'Item List Cannot Update');
        }
        redirect(
            base_url() .
                'DetailBoardProject/' .
                $project_id .
                '/' .
                $board_id
        );
    }

    function DeleteBoardItemList(
        $project_id = '',
        $board_id = '',
        $list_id = ''
    ) {
        $result = $this->List_model->Delete($list_id);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Board has been deleted !'
            );
        } else {
            $this->session->set_flashdata('error', 'Board cannot deleted !');
        }

        redirect(
            base_url() .
                'DetailBoardProject/' .
                $project_id .
                '/' .
                $board_id
        );
    }
}
