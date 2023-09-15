<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Comment_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('messages/Messages_model');
        $this->load->model('master/member_model');

        $this->IsLoggedIn();
    }

    public function get_comments()
    {
        if (!$this->input->is_ajax_request()) {
            return;
        }

        $data = array();
        $senderId = '';
        $current_member_id = '';
        $senderId = $this->input->post('senderId');
        $groupId = $this->input->post('groupId');
        $current_member_id = $this->session->userdata('member_id');
        $messages = $this->Messages_model->Get([$current_member_id, $senderId, $groupId, 5]);

        $data['messages'] = $messages; // Mengambil pesan terakhir dari array $messages
        $data['current_member_id'] = $current_member_id;
        header("Cache-Control: no-cache, must-revalidate");
        echo json_encode($data);
    }



    public function insert_comment()
    {
        if (!$this->input->is_ajax_request()) {
            return;
        }

        $senderId = $this->input->post('senderId');
        $receiverId = $this->input->post('currentMemberId');
        $message = $this->input->post('message');
        $groupId = $this->input->post('groupId');

        $insertMessage = [
            $receiverId,
            $senderId,
            $message,
            $groupId
        ];

        $result = $this->Messages_model->Insert($insertMessage);

        if ($result > 0) {
            $response = array(
                'success' => true,
                'message' => array(
                    'sender_id' => $receiverId,
                    'sender_name' => 'Anda',
                    'created_at' => date('Y-m-d H:i:s'),
                    'message' => $message
                ),
                'current_member_id' => $receiverId
            );
        } else {
            $response = array(
                'error' => true,
                'message' => array(
                    'sender_id' => $receiverId,
                    'sender_name' => 'Anda',
                    'created_at' => date('Y-m-d H:i:s'),
                    'message' => $message
                ),
                'current_member_id' => $receiverId
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
