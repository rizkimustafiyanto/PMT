<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HeaderC extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/Card_comment_model');
    }

    public function index()
    {
        $data = $this->DCCard();
        $this->load->view('includes/header', $data);
    }

    private function DCCard()
    {
        $card_id = '898';
        $workspace_id = 'WRK0002';
        $card_comment_parameter = [
            'p_card_comment_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_flag' => 2,
        ];

        $data['CardCommentR'] = $this->Card_comment_model->Get($card_comment_parameter);
        $data['member_id'] = $this->session->userdata('member_id');

        return $data;
    }
}
