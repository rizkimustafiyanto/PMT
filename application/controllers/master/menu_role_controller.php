<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class menu_role_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/menu_role_model');
        $this->load->model('master/sub_menu_model');
        $this->load->model('master/role_model');
        $this->load->model('master/menu_model');
        $this->IsLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Menu Role';
        $this->loadViews('master/menu_role', $this->global, null, null);
    }

    function GetMenuRole()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/menu_role_model');
            $menu_parameter = ['p_menu_role_id' => 0, '', 'p_flag' => 2];
            $data['MenuRoleRecords'] = $this->menu_role_model->GetMenuRole(
                $menu_parameter
            );
            $sub_menu_parameter = ['p_sub_menu_id' => 0, 'p_flag' => 0];
            $data['SubMenuRecords'] = $this->sub_menu_model->GetSubMenu(
                $sub_menu_parameter
            );
            $menu_parameter = ['p_menu_id' => 0, 'p_flag' => 0];
            $data['MenuRecords'] = $this->menu_model->GetMenu($menu_parameter);
            $role_parameter = ['p_role_id' => 0, 'p_flag' => 0];
            $data['RoleRecords'] = $this->role_model->GetRole($role_parameter);
            $this->global['pageTitle'] = 'CodeInsect : Menu Listing';
            $this->loadViews('master/menu_role', $this->global, $data, null);
        }
    }

    function GetMenuRoleId($menu_role_id, $flag)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/menu_role_model');
            $menu_parameter = [$menu_role_id, $flag];
            $data['MenuRoleRecords'] = $this->menu_role_model->GetMenuRole(
                $menu_parameter
            );
            $this->global['pageTitle'] = 'CodeInsect : Menu Listing';
            $this->loadViews('master/menu_role', $this->global, $data, null);
        }
    }

    function InsertMenuRole()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'menu_id',
                'Menu Id',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'sub_menu_id',
                'Sub Menu Id',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'role_id',
                'Role Id',
                'required|max_length[50]|xss_clean'
            );

            $menu_id = $this->input->post('menu_id');
            $sub_menu_id = $this->input->post('sub_menu_id');
            $role_id = $this->input->post('role_id');
            $change_no = 0;
            $creation_user_id = $this->session->userdata('member_id');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';
            $menu_role_parameter = [
                $menu_id,
                $sub_menu_id,
                $role_id,
                $change_no,
                $creation_user_id,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/menu_role_model');
            $result = $this->menu_role_model->InsertMenuRole(
                $menu_role_parameter
            );

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New menu role created successfully'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Menu role creation failed'
                );
            }

            redirect('MenuRole');
        }
    }

    function UpdateMenuRole()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'menu_role_id',
                'Menu Role Id',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'menu_id',
                'Menu Id',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'sub_menu_id',
                'Sub Menu Id',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'role_id',
                'Role Id',
                'required|max_length[50]|xss_clean'
            );

            $menu_role_id = $this->input->post('menu_role_id');
            $menu_id = $this->input->post('menu_id');
            $sub_menu_id = $this->input->post('sub_menu_id');
            $role_id = $this->input->post('role_id');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';

            $menu_role_parameter = [
                $menu_role_id,
                $menu_id,
                $sub_menu_id,
                $role_id,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/menu_role_model');
            $result = $this->menu_role_model->UpdateMenuRole(
                $menu_role_parameter
            );

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Menu Role Updated');
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Menu Role Cannot Update'
                );
            }

            redirect('MenuRole');
        }
    }

    function DeleteMenuRole($menu_role_id)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $menu_role_parameter = [$menu_role_id];

            $result = $this->menu_role_model->DeleteMenuRole(
                $menu_role_parameter
            );

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'Menu role has been deleted !'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Menu role cannot deleted !'
                );
            }

            redirect('MenuRole');
        }
    }
}
