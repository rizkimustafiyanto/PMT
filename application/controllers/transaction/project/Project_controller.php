<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Project_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project_wrk/Project_wrk_model');
        $this->load->model('transaction/project_wrk/Project_wrk_comment_model');
        $this->load->model('transaction/project_wrk/Project_wrk_member_model');
        $this->load->model('transaction/project/Project_model');
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->load->helper('log_helper');
        $this->IsLoggedIn();
    }

    public function Project($p_project_wrk_id = '')
    {
        $memberID =  $this->session->userdata('member_id');

        #Project List
        #============================================================================
        $data['ProjectRecords'] = $this->Project_model->Get(['', $p_project_wrk_id, '', '', '', '', 1]);
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);

        #Workspace Project
        #============================================================================
        $data['ProjectWrkRecords'] = $this->Project_wrk_model->Get([$p_project_wrk_id, '', 1, $memberID,]);
        $data['ProjectMemberRecords'] = $this->Project_wrk_member_model->Get(['', $p_project_wrk_id, '', '', 2,]);
        $data['ProjectMemberTotalRecords'] = $this->Project_wrk_member_model->Get(['', $p_project_wrk_id, '', '', 3,]);
        $data['MemberRecords'] = $this->member_model->Get(['', 0]);
        $data['MemberTypeRecords'] = $this->variable_model->GetVariable(['', 2]);
        $data['ProjectTypeRecords'] = $this->variable_model->GetVariable(['', 4]);
        $data['StatusProjectWrkRecords'] = $this->variable_model->GetVariable(['', 9]);
        $data['MemberSelectRecord'] = $this->Project_wrk_member_model->Get(['', $p_project_wrk_id, '', '', 2]);

        #Attachment
        #============================================================================
        $data['AttachmentRecord'] = $this->Attachment_model->Get(['', '', $p_project_wrk_id, 2]);
        $data['AttachmentTypeRecord'] = $this->variable_model->GetVariable(['', 3]);

        #Cek user_level_project
        #============================================================================
        $data['UserMemberRoleProject'] = $this->Project_wrk_member_model->Get(['', $p_project_wrk_id, $memberID, '', 4]);
        $data['member_id'] = $memberID;

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project';
        $this->loadViews('transaction/project/Project', $this->global, $data, null);
    }

    public function KanbanDetail($p_project_wrk_id = '')
    {
        $card_status = [
            'p_project_id' => '',
            'p_project_wrk_id' => $p_project_wrk_id,
            'p_start_date' => '',
            'p_due_date' => '',
            'p_priority_type_id' => '', #priority Low
            'p_member_id' => $this->session->userdata('member_id'),
            'p_flag' => 3
        ];

        $data['CardStatus'] = $this->Project_model->Get($card_status);
        $data['member_id'] = $this->session->userdata('member_id');
        $data['project_id'] = $p_project_wrk_id;
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

        $result_update_card = $this->Project_model->Update($param);

        if ($result_update_card > 0) {
            $notif = $this->session->set_flashdata('success', 'Card Updated');
        } else {
            $notif = $this->session->set_flashdata('error', 'Card Cannot Update');
        }

        // Beri tanggapan sukses atau gagal
        echo json_encode($notif);
    }

    function ChangeStatusProjectProject()
    {
        $project_id = $this->input->post('project_id');
        $status_id = $this->input->post('status_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = 1;

        $Project_parameter = [
            'p_project_wrk_id' => $project_id,
            'p_project_type' => '',
            'p_flag' => 2,
            'p_member_id' => $this->session->userdata('member_id'),
        ];

        $resultCheckProject = $this->Project_wrk_model->Get($Project_parameter);

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

                $result = $this->Project_wrk_model->Update($param);

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

            $result = $this->Project_wrk_model->Update($param);

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

        redirect(base_url() . 'Project/' . $project_id);
    }

    // PROJECT MEMBER
    function DeleteProjectMember($Project_member_id, $project_id)
    {
        //Bikin pengambilan array
        $Project_member_parameter = [
            'p_project_member_id' => $Project_member_id,
            'p_project_wrk_id' => $project_id,
            'p_member_id' => '',
            'p_member_type_id' => '',
            'p_flag' => 1,
        ];
        $WorkMembers = $this->Project_wrk_member_model->Get($Project_member_parameter);

        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $MemberRecords = $this->member_model->Get($member_parameter);

        //Variable pengambilan objek dari mysql
        $namamember = '';
        $usermail = '';

        foreach ($WorkMembers as $row) {
            if ($row->project_member_id == $Project_member_id) {
                foreach ($MemberRecords as $member) {
                    if ($member->member_id == $row->member_id) {
                        $namamember = $member->member_name;
                        $usermail = $member->email;
                        break;
                    }
                }
                break;
            }
        }

        //Konfigurasi Email
        $penerima = 'pt.ujicobaku@gmail.com';
        //Diatas ini merupakan percobaan sedangkan yang bawah eksekusi
        //$penerima = $usermail;
        $subject_email = 'Project Delete Member';

        //Isi Email
        $isi_email = 'Halo,

        Data Anda di PMT telah dihapus. Berikut adalah detail data yang dihapus:
        
        Nama Member: ' . $namamember . '
        Email: ' . $usermail . '
        Project ID: ' . $project_id . '
        
        Terima kasih.';

        $email = new Email();

        //eksekusi query
        $result = $this->Project_wrk_member_model->Delete($Project_member_id);

        if ($result > 0) {
            //Mengirim email
            // if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
            //     $this->session->set_flashdata('success', 'Project member has been deleted ! Email notification sent.');
            // } else {
            //     $this->session->set_flashdata('error', 'Project member has been deleted ! but Failed to send email notification.');
            //     //echo $email->getErrorInfo();
            // }
            // $logMessage = 'Project member has been deleted for project member: ' . $project_member_id . ' with name of member ' . $namamember;
            // $operation = 'Delete';
            // writeToLog($logMessage, $operation);
            // //$this->session->set_flashdata(
            //   'success',
            //   'Project member has been deleted !' . $namamember . $Project_member_id
            //);
        } else {
            $this->session->set_flashdata(
                'error',
                'Project member cannot deleted !'
            );
            // $logMessage = 'Failed to deleted project member' . $Project_member_id . ' with name of member ' . $namamember;
            // $operation = 'Delete';
            // writeToLog($logMessage, $operation);
        }

        redirect(base_url() . 'Project/' . $project_id);
    }

    // INSERT PROJECT
    function InsertProject()
    {
        #Header
        $project_id = '';
        $project_wrk_id = $this->input->post('idProjectWrk');
        $project_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_description = $this->input->post('description');
        $member_id = $this->input->post('membersItem');
        $p_item_status = $this->input->post('status');
        $creation_user_id = $this->session->userdata('member_id');
        $record_status = 'A';

        $project_parameter = [
            $project_id,
            $project_wrk_id,
            $project_name,
            $start_date,
            $due_date,
            $p_priority,
            $member_id,
            $p_item_status,
            $p_description,
            $creation_user_id,
            $record_status
        ];
        $result = $this->Project_model->Insert($project_parameter);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project created successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create project'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateProject()
    {
        #Header
        #================================================
        $project_item_id = $this->input->post('id');
        $project_id_wrk = $this->input->post('idProjectWrk');
        $project_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_description = $this->input->post('description');
        $p_item_status = $this->input->post('status');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = $this->input->post('flag');

        $param = [
            $project_item_id,
            $project_id_wrk,
            $project_name,
            $start_date,
            $due_date,
            $p_priority,
            $p_item_status,
            $p_description,
            $p_change_user_id,
            $p_record_status,
            $flag
        ];


        $result = $this->Project_model->Update($param); //Execute Function

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project Updated!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Project Cannot Update!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteProject()
    {
        $param = $this->input->post('project_id');
        $result = $this->Project_model->Delete($param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project Updated!'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Project Cannot Update!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
