<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class role_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/role_model');
        $this->IsLoggedIn();
        $this->webSiteActive();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : role';
        $this->loadViews('master/role', $this->global, null, null);
    }

    function GetRole()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/role_model');
            $role_parameter = ['p_role_id' => 0, 'p_flag' => 0];
            $data['RoleRecords'] = $this->role_model->GetRole($role_parameter);
            $this->global['pageTitle'] = 'CodeInsect : role Listing';
            $this->loadViews('master/role', $this->global, $data, null);
        }
    }

    function GetRoleId($role_id, $flag)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/role_model');
            $company_parameter = [$role_id, $flag];
            $data['RoleRecords'] = $this->role_model->GetRole(
                $company_parameter
            );
            $this->global['pageTitle'] = 'CodeInsect : role Listing';
            $this->loadViews('master/role', $this->global, $data, null);
        }
    }

    function InsertRole()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'role_name',
                'Role Name',
                'required|max_length[50]|xss_clean'
            );
            $role_name = $this->input->post('role_name');
            $change_no = 0;
            $creation_user_id = $this->session->userdata('member_id');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';
            $role_parameter = [
                $role_name,
                $change_no,
                $creation_user_id,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/role_model');
            $result = $this->role_model->InsertRole($role_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New role created successfully'
                );
            } else {
                $this->session->set_flashdata('error', 'Role creation failed');
            }

            redirect('Role');
        }
    }

    function UpdateRole()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'role_name_update',
                'Counter Name',
                'required|max_length[50]|xss_clean'
            );
            $role_name = $this->input->post('role_name_update');
            $role_id = $this->input->post('role_id_update');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';

            $role_parameter = [
                $role_id,
                $role_name,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/role_model');
            $result = $this->role_model->UpdateRole($role_parameter);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Role Updated');
            } else {
                $this->session->set_flashdata('error', 'Role Cannot Update');
            }

            redirect('Role');
        }
    }

    function DeleteRole($role_id)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $role_parameter = [$role_id];

            $result = $this->role_model->DeleteRole($role_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'Counter has been deleted !'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Counter cannot deleted !'
                );
            }

            redirect('Role');
        }
    }
}
