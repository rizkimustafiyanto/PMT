<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class login_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('login_model');
    }

    public function index()
    {
        $this->IsLoggedIn();
    }

    function IsLoggedIn()
    {
        $IsLoggedIn = $this->session->userdata('IsLoggedIn');

        if (!isset($IsLoggedIn) || $IsLoggedIn != true) {
            $this->load->view('login');
        } else {
            redirect('/Dashboard');
        }
    }

    public function Login()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'user_account',
            'User Account',
            'required|max_length[128]'
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|max_length[32]'
        );

        if ($this->form_validation->run() == false) {
            $this->index();
        } else {
            $user_account = $this->input->post('user_account');
            $password = $this->input->post('password');

            // $result = $this->login_model->Login($user_account, $password);

            $login_parameter = [
                'p_user_account' => $user_account,
                'p_password' => $password,
            ];
            $result = $this->login_model->Login($login_parameter, $password);

            if (count($result) > 0) {
                foreach ($result as $res) {
                    $sessionArray = [
                        'member_id' => $res->member_id,
                        'member_name' => $res->member_name,
                        'role_id' => $res->role_id,
                        'role_name' => $res->role_name,
                        'gender_id' => $res->gender_id,
                        'company_id' => $res->company_id,
                        'division_id' => $res->division_id,
                        'department_id' => $res->department_id,
                        'IsLoggedIn' => true,
                    ];

                    $this->session->set_userdata($sessionArray);

                    redirect('/Dashboard');
                }
            } else {
                $this->session->set_flashdata(
                    'error',
                    'User account or password mismatch'
                );

                redirect('/login');
            }
        }
    }
}
