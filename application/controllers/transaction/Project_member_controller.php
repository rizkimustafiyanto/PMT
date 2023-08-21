<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Project_member_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/Project_member_model');
        $this->load->model('transaction/Card_log_model');
        $this->load->model('master/member_model');
        $this->load->library('email'); // Untuk ke direktori libraries
        $this->load->library('email/Email'); // Untuk menempatkan file
        $this->load->helper('log_helper'); // Untuk pemanggilan fungsi log pada helper
        $this->IsLoggedIn();
    }
    //Untuk eksekusi query
    function InsertProjectMember()
    {

        #Header
        $project_id = $this->input->post('project_id');
        #Detail Member
        $project_member_id = '';
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $Project_member_parameter = [
            $project_member_id,
            $project_id,
            $member_id,
            $member_type_id,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $record_status,
        ];

        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $MemberRecords = $this->member_model->Get($member_parameter);

        //Variable pengambilan objek dari api
        $namamember = '';
        $usermail = '';

        foreach ($MemberRecords as $member) {
            if ($member->member_id == $member_id) {
                $namamember = $member->member_name;
                $usermail = $member->email;
                break;
            }
        }

        //Konfigurasi Email
        $penerima = 'pt.ujicobaku@gmail.com';
        //Diatas ini merupakan percobaan sedangkan yang bawah eksekusi
        //$penerima = $usermail;
        $subject_email = 'Project create Member';
        //Isi pesan
        $isi_email = 'Halo,

        Anda telah ditambahkan sebagai member project baru di PMT. Berikut adalah detailnya:
        
        Nama Member: ' . $namamember . '
        Email: ' . $usermail . '
        Project ID: ' . $project_id . '
        
        Terima kasih.';

        $email = new Email();

        //Log Activity Konfiguration
        date_default_timezone_set('Asia/Jakarta');
        $card_id = '';
        $operation = 'Create';
        $logMessage = 'Project member has been created for project ID: ' . $project_id . ' with name of member ' . $namamember;
        $log = date('Y-m-d H:i:s') . ' [' . $operation . '] ' . $logMessage;
        $card_log_parameter = [
            $card_log_id = '',
            $card_id,
            $member_id,
            $log,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $record_status,
        ];


        //eksekusi query
        $result = $this->Project_member_model->Insert(
            $Project_member_parameter
        );

        if ($result > 0) {
            //Mengirim email
            if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                $this->session->set_flashdata('success', 'Project member has been create ! Email notification sent.');
            } else {
                $this->session->set_flashdata('error', 'Project member has been create ! but Failed to send email notification.');
                //echo $email->getErrorInfo();
            }

            $this->Card_log_model->Insert($card_log_parameter);

            //$this->session->set_flashdata(
            //   'success',
            //   'New project member created successfully !'
            //);
        } else {
            $this->session->set_flashdata(
                'error',
                'project member creation failed !'
            );
        }
        redirect(base_url() . 'DetailProject/' . $project_id);
    }

    function UpdateProjectMember()
    {
        //Bikin pengecekan array
        $project_member_id = $this->input->post('project_member_id');
        $project_id = $this->input->post('project_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';

        $param = [
            $project_member_id,
            $project_id,
            $member_id,
            $member_type_id,
            $p_change_user_id,
            $p_record_status,
        ];

        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $MemberRecords = $this->member_model->Get($member_parameter);

        //Variable pengambilan objek dari api
        $namamember = '';
        $usermail = '';

        foreach ($MemberRecords as $member) {
            if ($member->member_id == $member_id) {
                $namamember = $member->member_name;
                $usermail = $member->email;
                break;
            }
        }


        //Konfigurasi Email
        $penerima = 'pt.ujicobaku@gmail.com';
        //Diatas ini merupakan percobaan sedangkan yang bawah eksekusi
        //$penerima = $usermail;
        $subject_email = 'Project Update Member';

        //Isi pesan
        $isi_email = 'Halo,

        Data Anda di PMT telah diperbarui. Berikut adalah detail perubahan:
        
        Nama Member: ' . $namamember . '
        Email: ' . $usermail . '
        Project ID: ' . $project_id . '
        
        Terima kasih.';

        $email = new Email();

        //eksekusi query
        $result = $this->Project_member_model->Update($param);

        if ($result > 0) {
            //Mengirim email
            if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                $this->session->set_flashdata('success', 'Project member has been update ! Email notification sent.');
            } else {
                $this->session->set_flashdata('error', 'Project member has been update ! but Failed to send email notification.');
                //echo $email->getErrorInfo();
            }
            $logMessage = 'Project member has been updated for project ID: ' . $project_id . ' with name of member ' . $namamember;
            $operation = 'Update';
            writeToLog($logMessage, $operation);
            //if ($result > 0) {
            //   $this->session->set_flashdata(
            //       'success',
            //       'Project member Updated'
            //   );
        } else {
            $this->session->set_flashdata(
                'error',
                'Project member Cannot Update'
            );
            $logMessage = 'Failed to update project member' . $project_member_id . ' with name of member ' . $namamember;
            $operation = 'Update';
            writeToLog($logMessage, $operation);
        }

        redirect(base_url() . 'DetailProject/' . $project_id);
    }

    function DeleteProjectMember($Project_member_id, $project_id)
    {
        //Bikin pengambilan array
        $Project_member_parameter = [
            'p_project_member_id' => $Project_member_id,
            'p_project_id' => $project_id,
            'p_member_id' => '',
            'p_member_type_id' => '',
            'p_flag' => 1,
        ];
        $WorkMembers = $this->Project_member_model->Get($Project_member_parameter);
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
        $result = $this->Project_member_model->Delete($Project_member_id);

        if ($result > 0) {
            //Mengirim email
            if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                $this->session->set_flashdata('success', 'Project member has been deleted ! Email notification sent.');
            } else {
                $this->session->set_flashdata('error', 'Project member has been deleted ! but Failed to send email notification.');
                //echo $email->getErrorInfo();
            }
            $logMessage = 'Project member has been deleted for project member: ' . $project_member_id . ' with name of member ' . $namamember;
            $operation = 'Delete';
            writeToLog($logMessage, $operation);
            //$this->session->set_flashdata(
            //   'success',
            //   'Project member has been deleted !' . $namamember . $Project_member_id
            //);
        } else {
            $this->session->set_flashdata(
                'error',
                'Project member cannot deleted !'
            );
            $logMessage = 'Failed to deleted project member' . $Project_member_id . ' with name of member ' . $namamember;
            $operation = 'Delete';
            writeToLog($logMessage, $operation);
        }

        redirect(base_url() . 'DetailProject/' . $project_id);
    }
}
