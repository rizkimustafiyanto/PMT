<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class sub_menu_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/sub_menu_model');
        $this->load->model('master/menu_model');

        $this->IsLoggedIn();
        $this->webSiteActive();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : sub menu';
        $this->loadViews('master/sub_menu', $this->global, null, null);
    }

    function GetSubMenu()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/sub_menu_model');
            $sub_menu_parameter = ['p_sub_menu_id' => 0, 'p_flag' => 0];
            $data['SubMenuRecords'] = $this->sub_menu_model->GetSubMenu(
                $sub_menu_parameter
            );
            $menu_parameter = ['p_menu_id' => 0, 'p_flag' => 0];
            $data['MenuRecords'] = $this->menu_model->GetMenu($menu_parameter);
            $this->global['pageTitle'] = 'CodeInsect : Sub Menu Listing';
            $this->loadViews('master/sub_menu', $this->global, $data, null);
        }
    }

    function GetSubMenuId($sub_menu_id, $flag)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/sub_menu_model');
            $sub_menu_parameter = [$sub_menu_id, $flag];
            $data['SubMenuRecords'] = $this->sub_menu_model->GetSubMenu(
                $sub_menu_parameter
            );
            $this->global['pageTitle'] = 'CodeInsect : Sub Menu Listing';
            $this->loadViews('master/sub_menu', $this->global, $data, null);
        }
    }

    function GetSubMenuByMenuId()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $menu_id = $this->input->post('menu_id'); //receiving the ajax post from view
            //$menu_id = '7';
            $flag = '1';

            $sub_menu_parameter = [$menu_id, $flag];
            $records = $this->sub_menu_model->GetSubMenu($sub_menu_parameter);

            //$output = null;
            //foreach ($records->result() as $row)
            //{
            //    $output .= "<select><option value='".$row->sub_menu_id."'>".$row->sub_menu_name."</option></select>";
            //}

            //echo $output; // HTML example
            echo json_encode($records);
        }
    }

    function InsertSubMenu()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'sub_menu_name',
                'Sub Menu Name',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'sub_menu_url',
                'Sub Menu Url',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'sub_menu_icon',
                'Sub Menu Icon',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'menu_id',
                'Menu Id',
                'required|max_length[50]|xss_clean'
            );

            $sub_menu_name = $this->input->post('sub_menu_name');
            $sub_menu_url = $this->input->post('sub_menu_url');
            $sub_menu_icon = $this->input->post('sub_menu_icon');
            $menu_id = $this->input->post('menu_id');

            $change_no = 0;
            $creation_user_id = $this->session->userdata('member_id');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';
            $sub_menu_parameter = [
                $menu_id,
                $sub_menu_name,
                $sub_menu_url,
                $sub_menu_icon,
                $change_no,
                $creation_user_id,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/sub_menu_model');
            $result = $this->sub_menu_model->InsertSubMenu($sub_menu_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New sub menu created successfully'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Sub menu creation failed'
                );
            }

            redirect('SubMenu');
        }
    }

    function UpdateSubMenu()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'sub_menu_name',
                'Menu Name',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'sub_menu_url',
                'Menu Url',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'sub_menu_icon',
                'Menu Icon',
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

            $sub_menu_name = $this->input->post('sub_menu_name_update');
            $sub_menu_url = $this->input->post('sub_menu_url_update');
            $sub_menu_icon = $this->input->post('sub_menu_icon_update');
            $sub_menu_id = $this->input->post('sub_menu_id_update');
            $menu_id = $this->input->post('menu_id_update');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';
            $sub_menu_parameter = [
                $sub_menu_id,
                $menu_id,
                $sub_menu_name,
                $sub_menu_url,
                $sub_menu_icon,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/sub_menu_model');
            $result = $this->sub_menu_model->UpdateSubMenu($sub_menu_parameter);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Sub Menu Updated');
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Sub Menu Cannot Update'
                );
            }

            redirect('SubMenu');
        }
    }

    function DeleteSubMenu($sub_menu_id)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $sub_menu_parameter = [$sub_menu_id];

            $result = $this->sub_menu_model->DeleteSubMenu($sub_menu_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'Menu has been deleted !'
                );
            } else {
                $this->session->set_flashdata('error', 'Menu cannot deleted !');
            }

            redirect('SubMenu');
        }
    }
}
