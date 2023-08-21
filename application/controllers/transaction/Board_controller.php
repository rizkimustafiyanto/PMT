<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Board_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/variable_model');
        $this->load->model('transaction/Project_model');
        $this->load->model('transaction/Project_member_model');
        $this->load->model('transaction/Board_model');
        $this->load->model('transaction/List_model');
        $this->load->model('transaction/Card_model');
        $this->load->model('transaction/Card_member_model');

        $this->IsLoggedIn();
    }
    function DetailBoardProject($project_id = '', $board_id = '')
    {
        $Project_board_parameter = [
            'p_board_id' => $board_id,
            'p_project_id' => $project_id,
            'p_flag' => 3,
            'p_member_id' => '',
        ];

        $data['ProjectBoardRecords'] = $this->Board_model->Get(
            $Project_board_parameter
        );

        $list_parameter = [
            'p_list_id' => '',
            'p_board_id' => $board_id,
            'p_flag' => 3,
            'p_member_id' => '',
        ];

        $data['BoardItemList'] = $this->List_model->Get($list_parameter);

        $card_parameter = [
            'p_card_id' => '',
            'p_list_id' => '',
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 0,
        ];

        $data['CardRecord'] = $this->Card_model->Get($card_parameter);

        $list_parameter = [
            'p_variable_id' => '',
            'p_flag' => 5,
        ];

        $data['ListRecords'] = $this->variable_model->GetVariable(
            $list_parameter
        );

        $status_parameter = [
            'p_variable_id' => '',
            'p_flag' => 7,
        ];

        $data['StatusRecords'] = $this->variable_model->GetVariable(
            $status_parameter
        );

        $board_status_parameter = [
            'p_variable_id' => '',
            'p_flag' => 8,
        ];

        $data['StatusBoardRecords'] = $this->variable_model->GetVariable(
            $board_status_parameter
        );

        #cek user_level_project
        #============================================================================
        $Project_member_parameter = [
            'p_project_member_id' => '',
            'p_project_id' => $project_id,
            'p_member_id' => $this->session->userdata('member_id'),
            'p_member_type_id' => '',
            'p_flag' => 4,
        ];

        $data['UserMemberRoleProject'] = $this->Project_member_model->Get(
            $Project_member_parameter
        );

        $Card_member_parameter = [
            'p_card_member_id' => '',
            'p_card_id' => '',
            'p_member_id' => $this->session->userdata('member_id'),
            'p_flag' => 6,
            'p_project_id' => $project_id,
        ];

        $data['UserMemberRoleCard'] = $this->Card_member_model->Get(
            $Card_member_parameter
        );

        $data['member_id'] = $this->session->userdata('member_id');
        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Board Detail';
        $this->loadViews(
            'transaction/Project_board_detail',
            $this->global,
            $data,
            null
        );
    }

    function InsertBoardProject()
    {
        #Header
        $project_id = $this->input->post('project_id');
        #Detail Member
        $board_id = '';
        $board_name = $this->input->post('board_name');
        $description = $this->input->post('description');
        $start_date = date(
            'Y-m-d',
            strtotime($this->input->post('start_date'))
        );
        $finish_date = date(
            'Y-m-d',
            strtotime($this->input->post('finish_date'))
        );

        $status_id = 'STB-1'; # status projectnya On process
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $Project_board_parameter = [
            $board_id,
            $project_id,
            $board_name,
            $description,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $record_status,
            $status_id,
            $start_date,
            $finish_date,
        ];

        $result = $this->Board_model->Insert($Project_board_parameter);

        if ($result > 0) {
            #Ambil board_id
            $board_parameter = [
                'p_board_id' => '',
                'p_project_id' => $project_id,
                'p_flag' => 4,
                'p_member_id' => '',
            ];

            $result_board = $this->Board_model->Get($board_parameter);

            foreach ($result_board as $record) {
                $temp_board_id = $record->board_id;
            }

            #Count list_status => variable
            $list_status_parameter = [
                'p_variable_id' => '',
                'p_flag' => 6,
            ];

            $result_count_status_list = $this->variable_model->GetVariable(
                $list_status_parameter
            );

            foreach ($result_count_status_list as $record) {
                $count_list_status = $record->count_list_status;
            }

            for ($i = 1; $i <= $count_list_status; $i++) {
                $list_type_id = 'STL-' . $i;

                $list_parameter = [
                    '', #list_id
                    $temp_board_id,
                    $list_type_id,
                    $change_no,
                    $creation_user_id,
                    $change_user_id,
                    $record_status,
                ];

                $result_list = $this->List_model->Insert($list_parameter);
            }

            if ($result_list > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New board created success!'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Project Board Cannot insert'
                );
            }
        } else {
            $this->session->set_flashdata(
                'error',
                'Board member creation failed !'
            );
        }
        redirect(base_url() . 'DetailProject/' . $project_id);
    }

    function UpdateBoardProject()
    {
        $board_id = $this->input->post('board_id');
        $project_id = $this->input->post('project_id');
        $board_name = $this->input->post('board_name');
        $start_date = date(
            'Y-m-d',
            strtotime($this->input->post('start_date_update'))
        );
        $finish_date = date(
            'Y-m-d',
            strtotime($this->input->post('finish_date_update'))
        );
        $description = $this->input->post('description');
        $p_change_user_id = $this->session->userdata('member_id');
        $record_status = $this->input->post('status');

        $param = [
            $board_id,
            $project_id,
            $board_name,
            $description,
            $p_change_user_id,
            $record_status,
            '',
            0,
            $start_date,
            $finish_date,
        ];

        $result = $this->Board_model->Update($param);

        if ($result > 0) {
            $this->session->set_flashdata('success', 'Project Board Updated');
            echo json_encode($result);
        } else {
            $this->session->set_flashdata(
                'error',
                'Project Board Cannot Update'
            );
        }
    }

    function DeleteBoardProject($Project_member_id, $project_id)
    {
        $result = $this->Board_model->Delete($Project_member_id);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Board has been deleted !'
            );
        } else {
            $this->session->set_flashdata('error', 'Board cannot deleted !');
        }

        redirect(base_url() . 'DetailProject/' . $project_id);
    }

    function UpdatePositionListBoard()
    {
        $board_id = $this->input->post('board_id');
        $base = $this->input->post('base');
        $prev = $this->input->post('prev');
        $next = $this->input->post('next');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $p_flag = 0;

        $param = [
            $board_id,
            $base,
            $prev,
            $next,
            $p_change_user_id,
            $p_record_status,
            $p_flag,
        ];

        $result = $this->List_model->UpdatePosition($param);

        if ($result > 0) {
            echo json_encode($result);
        } else {
            $this->session->set_flashdata(
                'error',
                'Postion List Cannot Update'
            );
        }
    }

    function ChangeStatusProjectProjectBoard()
    {
        $board_id = $this->input->post('board_id');
        $project_id = $this->input->post('project_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $status_id = $this->input->post('status_id');

        $Project_board_parameter = [
            'p_board_id' => $board_id,
            'p_project_id' => '',
            'p_flag' => 5,
            'p_member_id' => '',
        ];

        $resultCheckProject = $this->Board_model->Get(
            $Project_board_parameter
        );

        foreach ($resultCheckProject as $record) {
            $total_total_onProcess = $record->total_total_onProcess;
            $total_hold = $record->total_hold;
        }

        #jika status project want change to DONE
        if ($status_id == 'STB-2') {
            if ($total_total_onProcess != 0 || $total_hold != 0) {
                $this->session->set_flashdata(
                    'error',
                    'Project Board Cannot Change Status Project Done Because Card in On Process'
                );
            } else {
                $param = [
                    $board_id,
                    '',
                    '',
                    '',
                    $p_change_user_id,
                    '',
                    $status_id,
                    1,
                ];

                $result = $this->Board_model->Update($param);

                if ($result > 0) {
                    $this->session->set_flashdata(
                        'success',
                        'Status Project Changed'
                    );
                } else {
                    $this->session->set_flashdata(
                        'error',
                        'Status Project Cannot Changed Because Card in On Process'
                    );
                }
            }
        } else {
            $param = [
                $board_id,
                '',
                '',
                '',
                $p_change_user_id,
                '',
                $status_id,
                1,
            ];

            $result = $this->Board_model->Update($param);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'Status Project Changed'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Status Project Cannot Changed Because Card in On Process'
                );
            }
        }

        redirect(
            base_url() .
                'DetailBoardProject/' .
                $project_id .
                '/' .
                $board_id
        );
    }
}
