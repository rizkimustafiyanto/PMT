<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Messages_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('messages/Messages_model');
        $this->load->model('master/member_model');

        $this->IsLoggedIn();
    }

    function index()
    {
        // $data = $this->ColumnMessage();
        $memberID = $this->session->userdata('member_id');
        $data['profiles'] = $this->member_model->Get([$memberID, 1]);
        $data['listmember'] = $this->member_model->Get([0, 0]);
        $data['ColumnMember'] = $this->Messages_model->Get([$memberID, 0, 0, 0]);

        $this->global['pageTitle'] = 'CodeInsect : Item List Detail';
        $this->loadViews('message/message', $this->global, $data, null);
    }

    function ColumnMessage()
    {
        if (!$this->input->is_ajax_request()) {
            return;
        }
        $data = array();
        $memberID = $this->session->userdata('member_id');
        $data['ColumnMessages'] = $this->Messages_model->Get([$memberID, 0, 0, 0]);

        header("Cache-Control: no-cache, must-revalidate");
        echo json_encode($data);
    }


    public function get_messages()
    {
        if (!$this->input->is_ajax_request()) {
            return;
        }

        $data = array();
        $senderId = '';
        $current_member_id = '';
        $senderId = $this->input->post('senderId');
        $current_member_id = $this->session->userdata('member_id');
        $messages = $this->Messages_model->Get([$current_member_id, $senderId, 0, 1]);

        $this->ReadMessage($senderId, $current_member_id);

        $data['messages'] = $messages; // Mengambil pesan terakhir dari array $messages
        $data['current_member_id'] = $current_member_id;
        header("Cache-Control: no-cache, must-revalidate");
        echo json_encode($data);
    }



    public function insert_message()
    {
        if (!$this->input->is_ajax_request()) {
            return;
        }

        $senderId = $this->input->post('senderId');
        $receiverId = $this->input->post('currentMemberId');
        $message = $this->input->post('message');

        $insertMessage = [
            $receiverId,
            $senderId,
            $message,
            '',
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

    public function InsertNewMessages()
    {
        $senderId = $this->session->userdata('member_id');
        $receiverId = $this->input->post('message_to');
        // Pencarian member
        $insertMessage = [
            $receiverId,
            $senderId,
            '',
            '',
        ];

        $result = $this->Messages_model->Insert($insertMessage);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'New Project created successfully !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Project creation failed !'
            );
        }

        redirect('Message');
    }
    public function DeleteMessages()
    {
        $senderId = $this->session->userdata('member_id');
        $receiverId = $this->input->post('delete_sender');
        // Pencarian member
        $DeleteMessage = [
            '',
            $receiverId,
            $senderId,
            '',
            1,
        ];

        $result = $this->Messages_model->Delete($DeleteMessage);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'New Project created successfully !'
            );
        } else {
            $this->session->set_flashdata(
                'error',
                'Project creation failed !'
            );
        }

        redirect('Message');
    }

    function ReadMessage($senderId = '', $current_member_id = '')
    {
        $updateMessage = [
            '',
            $senderId,
            $current_member_id,
            '',
            '',
            '',
            1,
        ];

        $result = $this->Messages_model->Update($updateMessage);
    }
}
