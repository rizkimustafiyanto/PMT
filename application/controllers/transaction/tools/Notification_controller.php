<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Notification_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('notification/Notification_model');
        $this->load->helper('enkripbro');
        $this->isLoggedIn();
    }

    public function get_notif()
    {
        $memberID = $this->session->userdata('member_id');
        $notiP = $this->Notification_model->Get([$memberID, '', 2]);
        $jmlP = $this->Notification_model->Get([$memberID, '', 1]);
        $data = array();

        if ($notiP) {
            foreach ($notiP as $row) {
                $notification = array(
                    'photo_url' => base_url() . '../api-hris/upload/' . $row->photo_url,
                    'url' => ($row->project_card)
                        ? base_url() . 'Project/List/Task/' . enkripbro($row->project_card) . '/' . enkripbro($row->group_id)
                        : base_url() . 'Project/List/' . enkripbro($row->group_id),
                    'sender_name' => $row->sender_name,
                    'isImportant' => '1',
                    'message' => $row->notif_value,
                    'gender_id' => $row->gender_id,
                    'created_at' => $row->created_at
                );
                array_push($data, $notification);
            }
        }

        $totalNotif = '';
        $totalNotif = count($data);
        $lengthIn = 0;

        if ($jmlP) {
            foreach ($jmlP as $key) {
                $lengthIn = $key->jumlah;
            }
        }



        // Response JSON
        $response = array(
            'totalNotif' => $totalNotif,
            'notifications' => $data,
            'lengthIn' => $lengthIn
        );
        header("Cache-Control: no-cache, must-revalidate");
        echo json_encode($response);
    }
}
