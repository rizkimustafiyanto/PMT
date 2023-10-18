<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class variable_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/variable_model');
        $this->IsLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Variable';
        $this->loadViews('master/variable', $this->global, null, null);
    }

    function GetVariable()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/variable_model');
            $variable_parameter = [0, 0];
            $data['VariableRecords'] = $this->variable_model->GetVariable(
                $variable_parameter
            );
            $this->global['pageTitle'] = 'CodeInsect : Variable Listing';
            $this->loadViews('master/variable', $this->global, $data, null);
        }
    }

    function GetVariableById($variable_id, $flag)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('master/variable_model');
            $variable_parameter = [$variable_id, $flag];
            $data['VariableRecords'] = $this->variable_model->GetVariableById(
                $variable_parameter
            );
            $this->global['pageTitle'] = 'CodeInsect : Variable Listing';
            $this->loadViews('master/variable', $this->global, $data, null);
        }
    }

    function InsertVariable()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'variable_id',
                'Variable Id',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'variable_name',
                'Variable Name',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'variable_type',
                'Variable Type',
                'required|max_length[50]|xss_clean'
            );
            $variable_id = $this->input->post('variable_id');
            $variable_name = $this->input->post('variable_name');
            $variable_type = $this->input->post('variable_type');
            $change_no = 0;
            $creation_user_id = $this->session->userdata('member_id');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';
            $variable_parameter = [
                $variable_id,
                $variable_name,
                $variable_type,
                $change_no,
                $creation_user_id,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/variable_model');
            $result = $this->variable_model->InsertVariable(
                $variable_parameter
            );

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New variable created successfully !'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Variable creation failed !'
                );
            }

            redirect('Variable');
        }
    }

    function UpdateVariable()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');
            $this->form_validation->set_rules(
                'variable_id_update',
                'Variable Id',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'variable_name_update',
                'Variable Name',
                'required|max_length[50]|xss_clean'
            );
            $this->form_validation->set_rules(
                'variable_type_update',
                'Variable Type',
                'required|max_length[50]|xss_clean'
            );
            $variable_id = $this->input->post('variable_id_update');
            $variable_name = $this->input->post('variable_name_update');
            $variable_type = $this->input->post('variable_type_update');
            $change_user_id = $this->session->userdata('member_id');
            $record_status = 'A';
            $variable_parameter = [
                $variable_id,
                $variable_name,
                $variable_type,
                $change_user_id,
                $record_status,
            ];

            $this->load->model('master/variable_model');
            $result = $this->variable_model->UpdateVariable(
                $variable_parameter
            );

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Variable Updated !');
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Variable Cannot Update !'
                );
            }

            redirect('Variable');
        }
    }

    function DeleteVariable($variable_id)
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $result = $this->variable_model->DeleteVariable($variable_id);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'Variable has been deleted !'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Variable cannot deleted !'
                );
            }

            redirect('Variable');
        }
    }
}
