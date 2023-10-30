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
        $this->load->model('notification/Notification_model');
        $this->load->model('transaction/list/list_member_model');
        $this->load->model('transaction/project/project_member_model');
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

        $statusNotif = 1;
        $notif = $this->Notification_model->Update([$current_member_id, $statusNotif, $groupId, 0]);
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
        $flag_notif = $this->input->post('flag_notif');

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

            // searchmember

            $memberID = [];
            if ($flag_notif == 0) {
                $typeNotif = 'Project';
                $memberRecords = $this->project_member_model->Get(['', $groupId, '', '', 8]);
                foreach ($memberRecords as $member) {
                    $memberID[] = $member->member_id;
                }

                $countMember = count($memberID); // Hitung jumlah $Member
                for ($i = 0; $i < $countMember; $i++) {
                    $notif = $this->Notification_model->Insert([$memberID[$i], $typeNotif, $message, $groupId, $receiverId]);
                }
            } else if ($flag_notif == 1) {
                $typeNotif = 'Card';
                $memberRecords = $this->list_member_model->Get(['', $groupId, '', 0]);
                foreach ($memberRecords as $member) {
                    $memberID[] = $member->member_id;
                }
                $countMember = count($memberID); // Hitung jumlah $Member
                for ($i = 0; $i < $countMember; $i++) {
                    $notif = $this->Notification_model->Insert([$memberID[$i], $typeNotif, $message, $groupId, $receiverId]);
                }
            } else {
            }
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
