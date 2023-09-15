<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Log_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/tools/Log_model');
        $this->IsLoggedIn();
    }

    // ATTACHMENT
    #==============================================================
    function log_insert()
    {
        $log_text = $this->input->post('log_text');
        $group_id = $this->input->post('group_id');
        $creation_user_id = $this->session->userdata('member_id');

        $logData = [
            $log_text,
            $group_id,
            $creation_user_id
        ];

        $result = $this->Log_model->Insert($logData);
        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Log has been uploaded'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Log cannot be submitted!'
            );
        }
        header('Content type: application/json');
        echo json_encode($response);
    }
}
