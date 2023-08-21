<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Card_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/Project_model');
        $this->load->model('transaction/Project_member_model');
        $this->load->model('transaction/Board_model');
        $this->load->model('transaction/List_model');
        $this->load->model('transaction/Card_model');
        $this->load->model('transaction/Card_member_model');
        $this->load->model('transaction/Card_comment_model');
        $this->load->model('transaction/Card_log_model');
        $this->load->model('transaction/Card_attachment_model');
        $this->load->model('transaction/Card_checklist_model');
        $this->load->model('transaction/Checklist_item_model');
        $this->load->model('master/variable_model');

        $this->IsLoggedIn();
    }
    function DetailCard($project_id = '', $card_id = '')
    {
        $card_parameter = [
            'p_card_id' => $card_id,
            'p_project_id' => $project_id,
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 1,
            'p_priority_type_id' => '',
            'p_member_id' => '',
        ];

        $data['CardRecord'] = $this->Card_model->Get($card_parameter);

        $card_member_parameter = [
            'p_card_member_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_flag' => 2,
            'p_project_id' => $project_id,
        ];

        $data['CardMemberRecord'] = $this->Card_member_model->Get(
            $card_member_parameter
        );

        $Project_member_parameter = [
            'p_project_member_id' => '',
            'p_project_id' => $project_id,
            'p_member_id' => '',
            'p_member_type_id' => '',
            'p_flag' => 2,
        ];

        $data['ProjectMemberRecords'] = $this->Project_member_model->Get(
            $Project_member_parameter
        );

        $Card_member_parameter_total = [
            'p_card_member_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_flag' => 3,
            'p_project_id' => '',
        ];

        $data['CardMemberTotalRecords'] = $this->Card_member_model->Get(
            $Card_member_parameter_total
        );

        $card_comment_parameter = [
            'p_card_comment_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_flag' => 2,
        ];

        $data['CardCommentRecord'] = $this->Card_comment_model->Get(
            $card_comment_parameter
        );
        //Log Activity
        $card_log_parameter = [
            'p_card_log_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_flag' => 2,
        ];

        $data['CardLogRecord'] = $this->Card_log_model->Get(
            $card_log_parameter
        );
        //Batas Log Activity
        $variable_member_type_parameter = [
            'p_variable_id' => '',
            'p_flag' => 3,
        ];

        $data['AttachmentTypeRecord'] = $this->variable_model->GetVariable(
            $variable_member_type_parameter
        );

        $card_attachment_parameter = [
            'p_card_attachment_id' => '',
            'p_card_id' => $card_id,
            'p_attachment_type' => '',
            'p_flag' => 2,
        ];

        $data['CardAttachmentRecord'] = $this->Card_attachment_model->Get(
            $card_attachment_parameter
        );

        $checklist_item_parameter = [
            'p_checklist_item_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 2,
        ];

        $data['ChecklistItemRecord'] = $this->Checklist_item_model->Get(
            $checklist_item_parameter
        );

        $card_checklist_parameter = [
            'p_card_checklist_id' => '',
            'p_card_id' => $card_id,
            'p_flag' => 2,
        ];

        // $data['CardChecklistRecord'] = $this->Card_checklist_model->Get(
        //     $card_checklist_parameter
        // );

        // $list_card_parameter = [
        //     'p_list_id' => $list_id,
        //     'p_board_id' => $board_id,
        //     'p_flag' => 4,
        //     'p_member_id' => $this->session->userdata('member_id'),
        // ];

        // $data['ListCardRecords'] = $this->List_model->Get($list_card_parameter);

        $variable_status_parameter = [
            'p_variable_id' => '',
            'p_flag' => 5,
        ];

        $data['ListStatusRecords'] = $this->variable_model->GetVariable(
            $variable_status_parameter
        );

        $variable_priority_parameter = [
            'p_variable_id' => '',
            'p_flag' => 10,
        ];

        $data['PriorityTypeRecords'] = $this->variable_model->GetVariable(
            $variable_priority_parameter
        );

        #cek user_level_project
        #============================================================================
        $Project_member_parameter = [
            'p_project_member_id' => '',
            'p_project_id' => $project_id,
            'p_member_id' => '',
            'p_member_type_id' => 'MT-1',
            'p_flag' => 5,
        ];

        $data['UserMemberRoleProject'] = $this->Project_member_model->Get(
            $Project_member_parameter
        );

        #cek user_level_card
        #============================================================================
        $Card_member_parameter = [
            'p_card_member_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => $this->session->userdata('member_id'),
            'p_flag' => 5,
            'p_project_id' => $project_id,
        ];

        $data['UserMemberRoleCard'] = $this->Card_member_model->Get(
            $Card_member_parameter
        );

        $data['member_id'] = $this->session->userdata('member_id');
        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Card Detail';
        $this->loadViews('transaction/Card_detail', $this->global, $data, null);
    }

    function InsertCard()
    {
        #Header
        $project_id = $this->input->post('project_id');
        #Detail Member
        $card_id = '';
        $card_name = $this->input->post('card_name');
        $description = $this->input->post('description');
        $start_date = date(
            'Y-m-d H:i:s',
            strtotime($this->input->post('start_date'))
        );
        $due_date = date(
            'Y-m-d H:i:s',
            strtotime($this->input->post('due_date'))
        );
        $priority_type_id = $this->input->post('priority_type_id');
        $status_id = 'STL-2';
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $member_id = $this->session->userdata('member_id');
        if ($due_date < $start_date) {
            $this->session->set_flashdata(
                'error',
                'Check interval date project , date project not valid!'
            );
        } else {
            $card_parameter = [
                $card_id,
                $project_id,
                $card_name,
                $description,
                $start_date,
                $due_date,
                $priority_type_id,
                $status_id,
                $change_no,
                $creation_user_id,
                $change_user_id,
                $record_status,
                $member_id,
            ];

            $result = $this->Card_model->Insert($card_parameter);

            if ($result > 0) {
                $this->session->set_flashdata(
                    'success',
                    'New Card created successfully !'
                );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Card creation failed !'
                );
            }
        }

        redirect(base_url() . 'DetailProject/' . $project_id);
    }

    function UpdateCard()
    {
        $project_id = $this->input->post('project_id');
        $card_id = $this->input->post('card_id');
        $card_name = $this->input->post('card_name');
        $description = $this->input->post('description');
        $start_date = date(
            'Y-m-d H:i:s',
            strtotime($this->input->post('start_date'))
        );
        $due_date = date(
            'Y-m-d H:i:s',
            strtotime($this->input->post('due_date'))
        );
        $priority_type_id = $this->input->post('priority_type_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $p_flag = 0;

        if ($due_date < $start_date) {
            $this->session->set_flashdata(
                'error',
                'Check interval date project , date project not valid!'
            );
            $result_update_card = [];
        } else {
            $param = [
                $card_id,
                $project_id,
                $card_name,
                $description,
                $start_date,
                $due_date,
                $priority_type_id,
                '',
                $p_change_user_id,
                $p_record_status,
                $p_flag,
            ];

            $result_update_card = $this->Card_model->Update($param);

            if ($result_update_card > 0) {
                $this->session->set_flashdata('success', 'Card Updated');
            } else {
                $this->session->set_flashdata('error', 'Card Cannot Update');
            }
        }
        echo json_encode($result_update_card);
    }

    function MoveCardList(
        $project_id = '',
        $board_id = '',
        $list_id = '',
        $card_id = '',
        $list_id_move = ''
    ) {
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $p_flag = 1;

        #=============================================================
        #Mengambil Status List
        $param_list_status = [
            'p_list_id' => $list_id_move,
            'p_board_id' => '',
            'p_flag' => 5,
            'p_member_id' => '',
        ];

        $result_status = $this->List_model->Get($param_list_status);

        foreach ($result_status as $record) {
            $list_type_id = $record->list_type_id;
        }

        #==============================================================
        $paramCheckChecklist = [
            'p_card_id' => $card_id,
            'p_list_id' => '',
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 4,
            'p_member_id' => '',
        ];

        $result_check = $this->Card_model->Get($paramCheckChecklist);

        foreach ($result_check as $record) {
            $count_check = $record->count_check;
            $percentage = $record->percentage;
        }
        if ($count_check > 0) {
            if (
                #status List
                $list_type_id == 'STL-2' ||
                $list_type_id == 'STL-3' ||
                $list_type_id == 'STL-5'
            ) {
                $param = [
                    $card_id,
                    $list_id_move,
                    '',
                    '',
                    '',
                    '',
                    $p_change_user_id,
                    $p_record_status,
                    $p_flag,
                ];

                $result = $this->Card_model->Update($param);

                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Card Updated');
                } else {
                    $this->session->set_flashdata(
                        'error',
                        'Card Cannot Update'
                    );
                }
            } else {
                if ($percentage == 100) {
                    $param = [
                        $card_id,
                        $list_id_move,
                        '',
                        '',
                        '',
                        '',
                        $p_change_user_id,
                        $p_record_status,
                        $p_flag,
                    ];

                    $result = $this->Card_model->Update($param);

                    if ($result > 0) {
                        $this->session->set_flashdata(
                            'success',
                            'Card Updated'
                        );
                    } else {
                        $this->session->set_flashdata(
                            'error',
                            'Card Cannot Update'
                        );
                    }
                } else {
                    $this->session->set_flashdata(
                        'error',
                        'Progress Project Not Complete'
                    );
                }
            }
        } else {
            $param = [
                $card_id,
                $list_id_move,
                '',
                '',
                '',
                '',
                $p_change_user_id,
                $p_record_status,
                $p_flag,
            ];

            $result = $this->Card_model->Update($param);

            if ($result > 0) {
                $this->session->set_flashdata('success', 'Card Updated');
            } else {
                $this->session->set_flashdata('error', 'Card Cannot Update');
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

    function DeleteCard($card_id = '', $project_id = '')
    {
        $result = $this->Card_model->Delete($card_id);

        if ($result > 0) {
            $this->session->set_flashdata('success', 'Card has been deleted !');
        } else {
            $this->session->set_flashdata('error', 'Card cannot deleted !');
        }

        redirect(base_url() . 'DetailProject/' . $project_id);
    }

    function ChangeStatusProjectProjectBoardCard()
    {
        $project_id = $this->input->post('project_id');
        $card_id = $this->input->post('card_id');
        $status_id = $this->input->post('status_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $p_flag = 1;

        $paramCheckChecklist = [
            'p_card_id' => $card_id,
            'p_project_id' => '',
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 2,
            'p_priority_type_id' => '',
            'p_member_id' => '',
        ];

        $result_check = $this->Card_model->Get($paramCheckChecklist);

        foreach ($result_check as $record) {
            $count_check = $record->count_check;
            $percentage = $record->percentage;
        }

        if ($count_check > 0) {
            #status List
            if ($status_id == 'STL-4') {
                if ($percentage < 100) {
                    $this->session->set_flashdata(
                        'error',
                        'Progress Project Not Complete'
                    );
                } else {
                    $param = [
                        $card_id,
                        $project_id,
                        '',
                        '',
                        '',
                        '',
                        '',
                        $status_id,
                        $p_change_user_id,
                        $record_status,
                        $p_flag,
                    ];

                    $result = $this->Card_model->Update($param);
                    if ($result > 0) {
                        $this->session->set_flashdata(
                            'success',
                            'Card Updated'
                        );
                    } else {
                        $this->session->set_flashdata(
                            'error',
                            'Card Cannot Update'
                        );
                    }
                }
            } else {
                $param = [
                    $card_id,
                    $project_id,
                    '',
                    '',
                    '',
                    '',
                    '',
                    $status_id,
                    $p_change_user_id,
                    $record_status,
                    $p_flag,
                ];

                $result = $this->Card_model->Update($param);
                if ($result > 0) {
                    $this->session->set_flashdata('success', 'Card Updated');
                } else {
                    $this->session->set_flashdata(
                        'error',
                        'Card Cannot Update'
                    );
                }
            }
        } else {
            $param = [
                $card_id,
                $project_id,
                '',
                '',
                '',
                '',
                '',
                $status_id,
                $p_change_user_id,
                $record_status,
                $p_flag,
            ];

            $result = $this->Card_model->Update($param);
            if ($result > 0) {
                $this->session->set_flashdata('success', 'Card Updated');
            } else {
                $this->session->set_flashdata('error', 'Card Cannot Update');
            }
        }

        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }
}
