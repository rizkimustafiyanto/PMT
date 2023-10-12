<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class management_member_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/management_member_model');
        $this->load->model('master/member_model');
        $this->IsLoggedIn();
        $this->webSiteActive();
    }

    public function index()
    {
        $data['MemberSelect'] = $this->member_model->Get(['', 2]);
        $data['ManageRecord'] = $this->management_member_model->Get(['', 0]);

        $this->global['pageTitle'] = 'CodeInsect :  Management member';
        $this->loadViews('master/management_member', $this->global, $data, null);
    }
    function Insert()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $member_id = $this->input->post('member_id');
            $akses = $this->input->post('access');
            $creation_user_id = $this->session->userdata('member_id');
            $manage_parameter = [
                $member_id,
                $akses,
                $creation_user_id
            ];

            $result = $this->management_member_model->Insert($manage_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New manage created successfully'
                );
            } else {
                $this->session->set_flashdata('error', ' creation failed');
            }

            redirect('ManageMember');
        }
    }

    function Update()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $manage_id = $this->input->post('management_id_update');
            $akses = $this->input->post('access_update');
            $change_user_id = $this->session->userdata('member_id');

            $manage_parameter = [
                $manage_id,
                '',
                $akses,
                $change_user_id
            ];

            $this->load->model('master/management_member_model');
            $result = $this->management_member_model->Update($manage_parameter);

            if ($result > 0) {
                $this->session->set_flashdata('success', ' Updated');
            } else {
                $this->session->set_flashdata('error', ' Cannot Update');
            }

            redirect('ManageMember');
        }
    }

    function Delete($manage_id)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $result = $this->management_member_model->Delete($manage_id);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'Management member has been deleted !'
                );
            } else {
                $this->session->set_flashdata('error', ' cannot deleted !');
            }

            redirect('ManageMember');
        }
    }
}
