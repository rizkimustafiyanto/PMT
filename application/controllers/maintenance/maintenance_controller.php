<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class maintenance_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('maintenance/maintenance_model');
        $this->load->model('master/member_model');
        $this->load->library('email');
        $this->load->library('email/Email');
    }

    public function index()
    {
        $this->IsLoggedIn();
        #AMBIL
        #============================================================================
        $data['MaintenanceRecords'] = $this->maintenance_model->Get(['', 0]);

        #===========================================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Detail';
        $this->loadViews('maintenance/maintenance', $this->global, $data, null);
    }

    function maintenance_view()
    {
        $getting_maintenance = $this->maintenance_model->Get(['', 2]);
        $id_maintenance = '';
        if (!empty($getting_maintenance)) {
            foreach ($getting_maintenance as $key) {
                $id_maintenance = $key->id_downtime;
            }
        }
        $data['downtimeID'] = $id_maintenance;
        $data['memberID'] = $this->session->userdata('member_id');


        $this->global['pageTitle'] = 'CodeInsect : Project Detail';
        $this->loadViews('maintenance/maintenance_view', $this->global, $data, null);
    }

    public function insertDowntime()
    {
        $this->IsLoggedIn();
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $reason = $this->input->post('reason');
            $p_creation_user_id = $this->session->userdata('member_id');

            $parameter = [
                $reason,
                $p_creation_user_id,
            ];

            $result = $this->maintenance_model->Insert($parameter);

            if ($result === 'success') {
                $response = array(
                    'status' => 'success',
                    'title' => 'Success',
                    'message' => 'Downtime progress is running'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'title' => 'Error',
                    'message' => $result
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }

    function updateDowntime()
    {
        $this->IsLoggedIn();
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $id = $this->input->post('downtime_id');
            $p_reason = $this->input->post('reason');
            $p_change_user_id = $this->session->userdata('member_id');
            $p_status = $this->input->post('status_down');
            $p_flag = $this->input->post('flag');

            $parameter = [
                $id,
                $p_reason,
                $p_change_user_id,
                $p_status,
                $p_flag
            ];

            $result = $this->maintenance_model->Update($parameter);

            if ($result) {
                $response = array(
                    'status' => 'success',
                    'title' => 'Success',
                    'message' => 'Downtime progress is closing and activating program'
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'title' => 'Error',
                    'message' => 'Failed closing and activating program'
                );
            }

            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}
