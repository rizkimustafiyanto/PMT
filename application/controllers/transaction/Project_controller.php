<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Project_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/Project_model');
        $this->load->model('transaction/Project_member_model');
        $this->load->model('transaction/Card_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->load->helper('log_helper');
        $this->IsLoggedIn();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Project';
        $this->loadViews('transaction/Project', $this->global, null, null);
    }

    function GetProject()
    {
        $Project_parameter = [
            'p_project_id' => '',
            'p_project_type' => '',
            'p_flag' => 0,
            'p_member_id' => $this->session->userdata('member_id'),
        ];

        $data['ProjectRecords'] = $this->Project_model->Get(
            $Project_parameter
        );

        if (!empty($this->Project_model->Get($Project_parameter))) {
            foreach ($this->Project_model->Get($Project_parameter) as $row) {
                $p_project_id = $row->project_id;
            }
        } else {
            $p_project_id = '';
        }

        $Project_member_parameter = ['', '', '', '', 0];
        $data['ProjectMemberRecords'] = $this->Project_member_model->Get(
            $Project_member_parameter
        );

        $variable_project_type_parameter = [
            'p_variable_id' => '',
            'p_flag' => 4,
        ];

        $data['ProjectTypeRecords'] = $this->variable_model->GetVariable(
            $variable_project_type_parameter
        );

        $data['StatusProjectRecords'] = $this->variable_model->GetVariable([0, 11]);
        $data['tempmember'] = $this->member_model->Get([0, 0]);

        #cek user_level_project
        #============================================================================

        $data['member_id'] = $this->session->userdata('member_id');

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Listing';
        $this->loadViews(
            'transaction/Project_list',
            $this->global,
            $data,
            null
        );
    }

    public function DetailProject($p_project_id = '')
    {
        $Project_parameter = [
            'p_project_id' => $p_project_id,
            'p_project_type' => '',
            'p_flag' => 1,
            'p_member_id' => $this->session->userdata('member_id'),
        ];

        $data['ProjectRecords'] = $this->Project_model->Get(
            $Project_parameter
        );

        $Project_member_parameter = [
            'p_project_member_id' => '',
            'p_project_id' => $p_project_id,
            'p_member_id' => '',
            'p_member_type_id' => '',
            'p_flag' => 2,
        ];

        $data['ProjectMemberRecords'] = $this->Project_member_model->Get(
            $Project_member_parameter
        );

        $Project_member_parameter_total = [
            'p_project_member_id' => '',
            'p_project_id' => $p_project_id,
            'p_member_id' => '',
            'p_member_type_id' => '',
            'p_flag' => 3,
        ];

        $data['ProjectMemberTotalRecords'] = $this->Project_member_model->Get(
            $Project_member_parameter_total
        );

        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];

        $data['MemberRecords'] = $this->member_model->Get($member_parameter);

        $card_height_parameter = [
            'p_card_id' => '',
            'p_project_id' => $p_project_id,
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 0,
            'p_priority_type_id' => 'PR-1', #priority Height
            'p_member_id' => $this->session->userdata('member_id'),
        ];

        $data['CardHeightRecord'] = $this->Card_model->Get(
            $card_height_parameter
        );

        $card_medium_parameter = [
            'p_card_id' => '',
            'p_project_id' => $p_project_id,
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 0,
            'p_priority_type_id' => 'PR-2', #priority Medium
            'p_member_id' => $this->session->userdata('member_id'),
        ];

        $data['CardMediumRecord'] = $this->Card_model->Get(
            $card_medium_parameter
        );

        $card_low_parameter = [
            'p_card_id' => '',
            'p_project_id' => $p_project_id,
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 0,
            'p_priority_type_id' => 'PR-3', #priority Low
            'p_member_id' => $this->session->userdata('member_id'),
        ];

        $data['CardLowRecord'] = $this->Card_model->Get($card_low_parameter);

        $variable_member_type_parameter = [
            'p_variable_id' => '',
            'p_flag' => 2,
        ];

        $data['MemberTypeRecords'] = $this->variable_model->GetVariable(
            $variable_member_type_parameter
        );

        $variable_project_type_parameter = [
            'p_variable_id' => '',
            'p_flag' => 4,
        ];

        $data['ProjectTypeRecords'] = $this->variable_model->GetVariable(
            $variable_project_type_parameter
        );

        $project_status_parameter = [
            'p_variable_id' => '',
            'p_flag' => 9,
        ];

        $data['StatusProjectRecords'] = $this->variable_model->GetVariable(
            $project_status_parameter
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
            'p_project_id' => $p_project_id,
            'p_member_id' => $this->session->userdata('member_id'),
            'p_member_type_id' => '',
            'p_flag' => 4,
        ];

        $data['UserMemberRoleProject'] = $this->Project_member_model->Get(
            $Project_member_parameter
        );

        $data['member_id'] = $this->session->userdata('member_id');

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Detail';
        $this->loadViews(
            'transaction/Project_detail',
            $this->global,
            $data,
            null
        );
    }

    public function KanbanDetail($p_project_id = '')
    {
        $card_status = [
            'p_card_id' => '',
            'p_project_id' => $p_project_id,
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 3,
            'p_priority_type_id' => '', #priority Low
            'p_member_id' => $this->session->userdata('member_id'),
        ];

        $data['CardStatus'] = $this->Card_model->Get($card_status);
        $data['member_id'] = $this->session->userdata('member_id');
        $data['project_id'] = $p_project_id;
        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Detail';
        $this->loadViews('transaction/Kanban_detail', $this->global, $data, null);
    }

    public function updateCardStatus()
    {
        $cardId = $this->input->post("card_id");
        $newStatus = $this->input->post("new_status");
        $member_id = $this->session->userdata("member_id");

        $param = [
            $cardId,
            '',
            '',
            '',
            '',
            '',
            '',
            $newStatus,
            $member_id,
            '',
            1,
        ];

        $result_update_card = $this->Card_model->Update($param);

        if ($result_update_card > 0) {
            $notif = $this->session->set_flashdata('success', 'Card Updated');
        } else {
            $notif = $this->session->set_flashdata('error', 'Card Cannot Update');
        }

        // Beri tanggapan sukses atau gagal
        echo json_encode($notif);
    }

    function InsertProject()
    {
        $project_id = '';
        $project_name = $this->input->post('project_name');
        $project_type = $this->input->post('project_type');
        $description = $this->input->post('description');
        $status_id = 'STW-1'; # status projectnya On process
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $Project_parameter = [
            $project_id,
            $project_name,
            $project_type,
            $description,
            $record_status,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $status_id,
        ];

        // Pencarian member
        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $memberRecords = $this->member_model->get($member_parameter);

        //Konfigurasi Email
        $penerima = 'pt.ujicobaku@gmail.com'; //Send Email Percobaan
        $namaMember = '';
        $userMail = '';

        foreach ($memberRecords as $member) {
            if ($member->member_id == $creation_user_id) {
                $namaMember = $member->member_name;
                $userMail = $member->email;
                break;
            }
        }

        $subject_email = 'Create New Project';
        //Isi pesan
        $isi_email = "Halo,\n\n\tAda projek baru di PMT. Berikut adalah detailnya:\n\n\tNama\t\t\t\t: " .
            $namaMember . "\n\tEmail\t\t\t\t: " . $userMail . "\n\tProject Name\t: " . $project_name . "\n\nTerima kasih.";
        $email = new Email(); //Pemanggilan fungsi email pada library

        $result = $this->Project_model->Insert($Project_parameter);

        if ($result > 0) {
            //Mengirim email
            if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                $this->session->set_flashdata('success', 'Project has been create ! Email notification sent.');
            } else {
                $this->session->set_flashdata('error', 'Project has been create ! but Failed to send email notification.');
                //echo $email->getErrorInfo();
            }
            $logMessage = 'Project has been created. Project Name: ' . $project_name . ' Created By ' . $namaMember;
            $operation = 'Create';
            writeToLog($logMessage, $operation);
            // $this->session->set_flashdata(
            //     'success',
            //     'New Project created successfully !'
            // );
        } else {
            $this->session->set_flashdata(
                'error',
                'Project creation failed !'
            );
        }

        redirect('Project');
    }

    function UpdateProject()
    {
        $project_id = $this->input->post('project_id');
        $project_name = $this->input->post('project_name');
        $project_type = $this->input->post('project_type');
        $description = $this->input->post('description');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = 0;

        $param = [
            $project_id,
            $project_name,
            $project_type,
            $description,
            $p_change_user_id,
            $p_record_status,
            '',
            $flag,
        ];
        // Pencarian member
        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $memberRecords = $this->member_model->get($member_parameter);

        //Konfigurasi Email
        $penerima = 'pt.ujicobaku@gmail.com'; //Send Email Percobaan
        $namaMember = '';
        $userMail = '';

        foreach ($memberRecords as $member) {
            if ($member->member_id == $p_change_user_id) {
                $namaMember = $member->member_name;
                $userMail = $member->email;
                break;
            }
        }

        $subject_email = 'Updated Project';
        //Isi pesan
        $isi_email = "Halo,\n\n\tAda projek update di PMT. Berikut adalah detailnya:\n\n\tNama\t\t\t\t: " .
            $namaMember . "\n\tEmail\t\t\t\t: " . $userMail . "\n\tProject Name\t: " . $project_name . "\n\nTerima kasih.";
        $email = new Email(); //Pemanggilan fungsi email pada library

        $result = $this->Project_model->Update($param);

        if ($result > 0) {
            //Mengirim email
            if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                $this->session->set_flashdata('success', 'Project has been update ! Email notification sent.');
            } else {
                $this->session->set_flashdata('error', 'Project has been update ! but Failed to send email notification.');
                //echo $email->getErrorInfo();
            }
            $logMessage = 'Project has been updated. Project Name: ' . $project_name . ' updated By ' . $namaMember;
            $operation = 'Update';
            writeToLog($logMessage, $operation);
            // $this->session->set_flashdata('success', 'Project Updated');
            // echo json_encode($result);
        } else {
            $this->session->set_flashdata('error', 'Project Cannot Update');
        }
        redirect('Project');
    }

    function DeleteProject($Project_id)
    {
        // Pencarian member
        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $memberRecords = $this->member_model->get($member_parameter);

        //Konfigurasi Email
        $penerima = 'pt.ujicobaku@gmail.com'; //Send Email Percobaan
        $user_id = $this->session->userdata('member_id');
        $namaMember = '';
        $userMail = '';

        foreach ($memberRecords as $member) {
            if ($member->member_id == $user_id) {
                $namaMember = $member->member_name;
                $userMail = $member->email;
                break;
            }
        }

        $subject_email = 'Deleted Project';
        //Isi pesan
        $isi_email = "Halo,\n\n\tAda projek delete di PMT. Berikut adalah detailnya:\n\n\tNama\t\t\t\t: " .
            $namaMember . "\n\tEmail\t\t\t\t: " . $userMail . "\n\tProject ID\t\t: " . $Project_id . "\n\nTerima kasih.";
        $email = new Email(); //Pemanggilan fungsi email pada library

        $result = $this->Project_model->Delete($Project_id);

        if ($result > 0) {
            //Mengirim email
            if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                $this->session->set_flashdata('success', 'Project has been delete ! Email notification sent.');
            } else {
                $this->session->set_flashdata('error', 'Project has been delete ! but Failed to send email notification.');
                //echo $email->getErrorInfo();
            }
            $logMessage = 'Project has been deleted. Project ID: ' . $Project_id . ' deleted By ' . $namaMember;
            $operation = 'Update';
            writeToLog($logMessage, $operation);
            // $this->session->set_flashdata(
            //     'success',
            //     'Project has been deleted !'
            // );
        } else {
            $this->session->set_flashdata(
                'error',
                'Project cannot deleted !'
            );
        }

        redirect('Project');
    }

    function ChangeStatusProjectProject()
    {
        $project_id = $this->input->post('project_id');
        $status_id = $this->input->post('status_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = 1;

        $Project_parameter = [
            'p_project_id' => $project_id,
            'p_project_type' => '',
            'p_flag' => 2,
            'p_member_id' => $this->session->userdata('member_id'),
        ];

        $resultCheckProject = $this->Project_model->Get($Project_parameter);

        foreach ($resultCheckProject as $record) {
            $total_onProcess = $record->total_onProcess;
        }

        #jika status project want change to DONE
        if ($status_id == 'STW-2') {
            if ($total_onProcess > 0) {
                $this->session->set_flashdata(
                    'error',
                    'Project Cannot Change Status Project Done Because Card in On Process'
                );
            } else {
                $param = [
                    $project_id,
                    '',
                    '',
                    '',
                    $p_change_user_id,
                    $p_record_status,
                    $status_id,
                    $flag,
                ];

                $result = $this->Project_model->Update($param);

                if ($result > 0) {
                    $this->session->set_flashdata(
                        'success',
                        'Status Project Changed'
                    );
                } else {
                    $this->session->set_flashdata(
                        'error',
                        'Status Project Cannot Changed Because Board in On Process'
                    );
                }
            }
        } else {
            $param = [
                $project_id,
                '',
                '',
                '',
                $p_change_user_id,
                $p_record_status,
                $status_id,
                $flag,
            ];

            // Pencarian member
            $member_parameter = [
                'p_member_id' => '',
                'p_flag' => 0,
            ];
            $memberRecords = $this->member_model->get($member_parameter);

            //Konfigurasi Email
            $penerima = 'pt.ujicobaku@gmail.com'; //Send Email Percobaan
            $user_id = $this->session->userdata('member_id');
            $namaMember = '';
            $userMail = '';

            foreach ($memberRecords as $member) {
                if ($member->member_id == $user_id) {
                    $namaMember = $member->member_name;
                    $userMail = $member->email;
                    break;
                }
            }

            $subject_email = 'Update Status Project';
            //Isi pesan
            $isi_email = "Halo,\n\n\tAda projek delete di PMT. Berikut adalah detailnya:\n\n\tNama\t\t\t\t: " .
                $namaMember . "\n\tEmail\t\t\t\t: " . $userMail . "\n\tProject ID\t\t: " . $Project_id . "\n\nTerima kasih.";
            $email = new Email(); //Pemanggilan fungsi email pada library

            $result = $this->Project_model->Update($param);

            if ($result > 0) {
                //Mengirim email
                if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                    $this->session->set_flashdata('success', 'Project has been delete ! Email notification sent.');
                } else {
                    $this->session->set_flashdata('error', 'Project has been delete ! but Failed to send email notification.');
                    //echo $email->getErrorInfo();
                }
                $logMessage = 'Project has been deleted. Project ID: ' . $Project_id . ' deleted By ' . $namaMember;
                $operation = 'Update';
                writeToLog($logMessage, $operation);
                // $this->session->set_flashdata(
                //     'success',
                //     'Status Project Changed'
                // );
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Status Project Cannot Changed Because Board in On Process'
                );
            }
        }

        redirect(base_url() . 'DetailProject/' . $project_id);
    }
}
