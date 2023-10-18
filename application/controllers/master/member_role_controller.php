<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class member_role_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/member_role_model');
        $this->load->model('master/member_model');
        $this->load->model('master/role_model');
        $this->IsLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : member role';
        $this->loadViews('master/member_role', $this->global, null, null);
    }

    function Get()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $parammember_role = [
                'p_member_role_id' => '',
                'p_flag' => 0,
            ];
            $parammember = [
                'p_member_id' => '',
                'p_flag' => 0,
            ];
            $paramrole = [
                'p_role_id' => '',
                'p_flag' => 0,
            ];

            $data['tempmember_role'] = $this->member_role_model->Get(
                $parammember_role
            );
            $data['tempmember'] = $this->member_model->Get($parammember);
            $data['temprole'] = $this->role_model->GetRole($paramrole);
            $this->global['pageTitle'] = 'CodeInsect : member role Listing';
            $this->loadViews('master/member_role', $this->global, $data, null);
        }
    }

    function Insert()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $p_member_role_id = '';
            $p_member_id = $this->input->post('p_member_id');
            $p_role_id = $this->input->post('p_role_id');
            $p_change_no = 0;
            $p_creation_user_id = $this->session->userdata('member_id');
            $p_change_user_id = $this->session->userdata('member_id');
            $p_record_status = 'A';

            $param = [
                $p_member_role_id,
                $p_member_id,
                $p_role_id,
                $p_change_no,
                $p_creation_user_id,
                $p_change_user_id,
                $p_record_status,
            ];

            $result = $this->member_role_model->Insert($param);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New member Role created successfully'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'member Role creation failed'
                );
            }

            redirect('MemberRole');
        }
    }

    function Update()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $p_member_role_id = $this->input->post('p_member_role_id');
            $p_member_id = $this->input->post('p_member_id');
            $p_role_id = $this->input->post('p_role_id');
            $p_record_status = $this->input->post('p_record_status');
            $p_change_user_id = $this->session->userdata('member_id');

            $param = [
                $p_member_role_id,
                $p_member_id,
                $p_role_id,
                $p_record_status,
                $p_change_user_id,
            ];

            $result = $this->member_role_model->Update($param);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'member Role Updated');
            } else {
                $this->session->set_flashdata(
                    'error',
                    'member Role Cannot Update'
                );
            }

            redirect('MemberRole');
        }
    }

    function Delete($param)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $parammemberRole = [$param];

            $result = $this->member_role_model->Delete($parammemberRole);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'member Role has been deleted !'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'member Role cannot deleted !'
                );
            }

            redirect('MemberRole');
        }
    }
}
