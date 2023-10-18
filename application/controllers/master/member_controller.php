<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class member_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->model('transaction/point_transaction_model');

        $this->IsLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : member';
        $this->loadViews('master/memberlist', $this->global, null, null);
    }

    public function GetMember()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $parammember = [
                'p_member_id' => '',
                'p_flag' => 0,
            ];

            $data['tempmember'] = $this->member_model->Get($parammember);

            $member_type_parameter = [0, 1];
            $data['MemberType'] = $this->variable_model->GetVariable(
                $member_type_parameter
            );

            $member_status_parameter = [0, 2];
            $data['MemberStatus'] = $this->variable_model->GetVariable(
                $member_status_parameter
            );

            $member_login_parameter = [0, 3];
            $data['MemberLogin'] = $this->variable_model->GetVariable(
                $member_login_parameter
            );

            $member_grade_parameter = [0, 4];
            $data['MemberGrade'] = $this->variable_model->GetVariable(
                $member_grade_parameter
            );

            $this->global['pageTitle'] = 'CodeInsect : Member Listing';
            $this->loadViews('master/memberlist', $this->global, $data, null);
        }
    }

    public function DetailMember($p_member_id = '')
    {
        $parammember = [
            'p_member_id' => $p_member_id,
            'p_flag' => 1,
        ];
        $data['tempmember'] = $this->member_model->Get($parammember);

        $member_type_parameter = [0, 1];
        $data['MemberType'] = $this->variable_model->GetVariable(
            $member_type_parameter
        );

        $member_grade_parameter = [0, 4];
        $data['MemberGrade'] = $this->variable_model->GetVariable(
            $member_grade_parameter
        );

        $member_login_parameter = [0, 3];
        $data['MemberLogin'] = $this->variable_model->GetVariable(
            $member_login_parameter
        );

        $member_status_parameter = [0, 2];
        $data['MemberStatus'] = $this->variable_model->GetVariable(
            $member_status_parameter
        );

        //List Point
        $parampointtransaction = [
            'p_point_transaction_id' => '',
            'p_sender_id' => '',
            'p_receiver_id' => $p_member_id,
            'p_flag' => 1,
            'p_transaction_name_id' => '',
        ];
        $data['temppointtransaction'] = $this->point_transaction_model->Get(
            $parampointtransaction
        );

        $parampointtransactionout = [
            'p_point_transaction_id' => '',
            'p_sender_id' => $p_member_id,
            'p_receiver_id' => '',
            'p_flag' => 3,
            'p_transaction_name_id' => '',
        ];
        $data['temppointtransactionout'] = $this->point_transaction_model->Get(
            $parampointtransactionout
        );

        $this->global['pageTitle'] = 'CodeInsect : Member Listing';
        $this->loadViews('master/memberdetail', $this->global, $data, null);
    }

    public function InsertMember()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $member_id = '';
            $member_name = $this->input->post('member_name');
            $email = $this->input->post('email');
            $mobile_no = $this->input->post('mobile_no');
            $member_type_id = $this->input->post('member_type_id');
            $member_grade_id = $this->input->post('member_grade_id');
            $member_status_id = $this->input->post('member_status_id');
            $member_point = $this->input->post('member_point');
            $password = $this->input->post('password');
            $login_type_id = $this->input->post('login_type_id');
            $last_login_datetime = $this->input->post('last_login_datetime');
            $change_no = 0;
            $creation_user_id = $this->session->userdata('member_id');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';

            $member_parameter = [
                $member_id,
                $member_name,
                $email,
                $mobile_no,
                $member_type_id,
                $member_grade_id,
                $member_status_id,
                $member_point,
                getHashedPassword($password),
                $login_type_id,
                $last_login_datetime,
                $change_no,
                $creation_user_id,
                $change_user_id,
                $record_status,
            ];

            $result = $this->member_model->Insert($member_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New member created successfully'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Member creation failed'
                );
            }

            redirect('MemberList');
        }
    }

    function UpdateMember()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $p_member_id = $this->input->post('member_id');
            $p_member_name = $this->input->post('member_name');
            $p_email = $this->input->post('email');
            $p_mobile_no = $this->input->post('mobile_no');
            $p_member_type_id = $this->input->post('member_type_id');
            $p_member_grade_id = $this->input->post('member_grade_id');
            $p_member_status_id = $this->input->post('member_status_id');
            $p_member_point = $this->input->post('member_point');
            $p_password = '';
            $p_login_type_id = $this->input->post('login_type_id');
            $p_last_login_datetime = '';
            $p_change_user_id = $this->session->userdata('member_id');
            $p_record_status = 'A';
            $p_flag = 0;

            $param = [
                $p_member_id,
                $p_member_name,
                $p_email,
                $p_mobile_no,
                $p_member_type_id,
                $p_member_grade_id,
                $p_member_status_id,
                $p_member_point,
                getHashedPassword($p_password),
                $p_login_type_id,
                $p_last_login_datetime,
                $p_change_user_id,
                $p_record_status,
                $p_flag,
            ];

            $result = $this->member_model->Update($param);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Member Updated');
                echo json_encode($result);
            } else {
                $this->session->set_flashdata('error', 'Member Cannot Update');
            }

            // redirect('MemberList');
        }
    }

    function DeleteMember($param)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $parammember = [$param];

            $result = $this->member_model->Delete($parammember);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'Member has been deleted !'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Member cannot deleted !'
                );
            }

            redirect('MemberList');
        }
    }
}
