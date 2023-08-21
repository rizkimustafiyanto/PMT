<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Card_comment_controller extends BaseController
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

        $this->IsLoggedIn();
    }

    function InsertCardComment()
    {
        #Header
        $project_id = $this->input->post('project_id');
        $card_id = $this->input->post('card_id');
        #Detail Member
        $card_comment_id = '';
        // $member_id = $this->input->post('member_id');
        $member_id = $this->session->userdata('member_id');
        $comment = $this->input->post('comment');
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $card_comment_parameter = [
            $card_comment_id,
            $card_id,
            $member_id,
            $comment,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $record_status,
        ];

        $result = $this->Card_comment_model->Insert($card_comment_parameter);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'New Card comment created successfully !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Card comment creation failed !'
            );
        }
        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }

    function UpdateCardComment()
    {
        #Header
        $project_id = $this->input->post('project_id');
        $board_id = $this->input->post('board_id');
        $list_id = $this->input->post('list_id');
        $card_id = $this->input->post('card_id');
        #Detail Member
        $card_comment_id = $this->input->post('card_comment_id');
        $member_id = $this->input->post('member_id');
        $comment = $this->input->post('comment');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $card_comment_parameter = [
            $card_comment_id,
            $card_id,
            $member_id,
            $comment,
            $change_user_id,
            $record_status,
        ];

        $result = $this->Card_comment_model->Update($card_comment_parameter);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Update Card comment created successfully !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Update card comment creation failed !'
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

    function DeleteCardComment(
        $project_id = '',
        $board_id = '',
        $list_id = '',
        $card_id = '',
        $card_comment_id = ''
    ) {
        $result = $this->Card_comment_model->Delete($card_comment_id);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Card member comment has been deleted !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Card member comment cannot deleted !'
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
