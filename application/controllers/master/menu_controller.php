<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class menu_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/menu_model');
        $this->IsLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : menu';
        $this->loadViews('master/menu', $this->global, null, null);
    }

    function GetMenu()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/menu_model');
            $menu_parameter = ['p_menu_id' => 0, 'p_flag' => 0];
            $data['MenuRecords'] = $this->menu_model->GetMenu($menu_parameter);
            $this->global['pageTitle'] = 'CodeInsect : Menu Listing';
            $this->loadViews('master/menu', $this->global, $data, null);
        }
    }

    function GetMenuId($menu_id, $flag)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/menu_model');
            $menu_parameter = [$menu_id, $flag];
            $data['MenuRecords'] = $this->menu_model->GetMenu($menu_parameter);
            $this->global['pageTitle'] = 'CodeInsect : Menu Listing';
            $this->loadViews('master/menu', $this->global, $data, null);
        }
    }

    function InsertMenu()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'menu_name',
                'Menu Name',
                'required|max_length[50]|xss_clean'
            );

            $this->form_validation->set_rules(
                'menu_icon',
                'Menu Icon',
                'required|max_length[50]|xss_clean'
            );

            $menu_name = $this->input->post('menu_name');
            $menu_url = $this->input->post('menu_url');
            $menu_icon = $this->input->post('menu_icon');
            $change_no = 0;
            $creation_user_id = $this->session->userdata('member_id');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';
            $menu_parameter = [
                $menu_name,
                $menu_url,
                $menu_icon,
                $change_no,
                $creation_user_id,
                $change_user_id,
                $record_status,
            ];
            $this->load->model('master/menu_model');
            $result = $this->menu_model->InsertMenu($menu_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New menu created successfully'
                );
            } else {
                $this->session->set_flashdata('error', 'Menu creation failed');
            }

            redirect('Menu');
        }
    }

    function UpdateMenu()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'menu_name_update',
                'Menu Name',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'menu_url_update',
                'Menu Url',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'menu_icon_update',
                'Menu Icon',
                'required|max_length[50]|xss_clean'
            );

            $menu_name = $this->input->post('menu_name_update');
            $menu_url = $this->input->post('menu_url_update');
            $menu_icon = $this->input->post('menu_icon_update');
            $menu_id = $this->input->post('menu_id_update');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';

            $menu_parameter = [
                $menu_id,
                $menu_name,
                $menu_url,
                $menu_icon,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/menu_model');
            $result = $this->menu_model->UpdateMenu($menu_parameter);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Menu Updated');
            } else {
                $this->session->set_flashdata('error', 'Menu Cannot Update');
            }

            redirect('Menu');
        }
    }

    function DeleteMenu($menu_id)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $menu_parameter = [$menu_id];

            $result = $this->menu_model->DeleteMenu($menu_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'Menu has been deleted !'
                );
            } else {
                $this->session->set_flashdata('error', 'Menu cannot deleted !');
            }

            redirect('Menu');
        }
    }
}
