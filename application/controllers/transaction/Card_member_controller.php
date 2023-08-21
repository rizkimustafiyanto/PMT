<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Card_member_controller extends BaseController
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
        $this->load->model('master/member_model');
        $this->load->library('email'); // Untuk ke direktori libraries
        $this->load->library('email/Email'); // Untuk menempatkan file
        $this->load->helper('log_helper'); // Untuk pemanggilan fungsi log pada helper
        $this->IsLoggedIn();
    }

    function InsertCardMember()
    {
        #Header
        $project_id = $this->input->post('project_id');
        $board_id = $this->input->post('board_id');
        $list_id = $this->input->post('list_id');
        $card_id = $this->input->post('card_id');
        #Detail Member
        $p_card_member_id = '';
        $member_id = $this->input->post('member_id');
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $card_member_parameter = [
            $p_card_member_id,
            $card_id,
            $member_id,
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
        $subject_email = 'Card create Member';

        //Isi pesan
        $isi_email = 'Halo,

        Anda telah ditambahkan sebagai member card baru di ' . $project_id . '. Berikut adalah detailnya:
        
        Nama Member: ' . $namamember . '
        Email: ' . $usermail . '
        Card ID: ' . $card_id . '
        
        Terima kasih.';

        $email = new Email();

        $result = $this->Card_member_model->Insert($card_member_parameter);

        if ($result > 0) {
            // Untuk pengiriman email
            if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                $this->session->set_flashdata('success', 'Card member has been create ! Email has been send.');
            } else {
                $this->session->set_flashdata('danger', 'Card member has been create but Failed to send Email.');
            }
            $logMessage = 'Project member has been created for project ID: ' . $project_id . ' with name of member ' . $namamember;
            $operation = 'Create';
            writeToLog($logMessage, $operation);
            // $this->session->set_flashdata(
            //     'success',
            //     'New Card member created successfully !'
            // );
        } else {
            $this->session->set_flashdata(
                'error',
                'Card member creation failed !'
            );
            $logMessage = 'Card member failed to create for project ID: ' . $project_id . ' with name of member ' . $namamember;
            $operation = 'Create';
            writeToLog($logMessage, $operation);
        }
        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }

    #Region Methode Delete
    function DeleteCardMember(
        $project_id = '',
        $card_id = '',
        $card_member_id = ''
    ) {
        // konfigurasi untuk mencari member id dari modal
        $card_member_parameter = [
            'p_card_member_id' => $card_member_id,
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_flag' => 2,
            'p_project_id' => $project_id,
        ];
        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $MemberRecords = $this->member_model->Get($member_parameter);
        $cariproject = $this->Card_member_model->Get($card_member_parameter);
        //Variable pengambilan objek dari api
        $namamember = '';
        $usermail = '';
        //perulangan untuk pencarian member dari data
        foreach ($cariproject as $cari) {
            if ($cari->card_member_id == $card_member_id) {
                $member_id = $cari->member_id;
                foreach ($MemberRecords as $member) {
                    if ($member->member_id == $member_id) {
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
        $subject_email = 'Card delete Member';

        //Isi pesan
        $isi_email = 'Halo,

        Anda telah dihapus sebagai member card workshop pada ' . $project_id . '. Berikut adalah detailnya:
        
        Nama Member: ' . $namamember . '
        Email: ' . $usermail . '
        Card ID: ' . $card_id . '
        
        Terima kasih.';

        $email = new Email();

        $result = $this->Card_member_model->Delete($card_member_id);

        if ($result > 0) {
            //untuk send email
            if ($email->sendEmail($penerima, $subject_email, $isi_email)) {
                $this->session->set_flashdata('success', 'Card member' . $namamember . ' has been deleted and email sended');
            } else {
                $this->session->set_flashdata('success', 'Card member' . $namamember . ' has been deleted and email not send');
            }
            $logMessage = 'Project member has been deleted for project ID: ' . $project_id . ' with name of member ' . $namamember;
            $operation = 'Create';
            writeToLog($logMessage, $operation);
            // $this->session->set_flashdata(
            //     'success',
            //     'Card Member has been deleted !'
            // );
        } else {
            $this->session->set_flashdata(
                'error',
                'Card member cannot deleted !'
            );
            $logMessage = 'Project member failed to delete for project ID: ' . $project_id . ' with name of member ' . $namamember;
            $operation = 'Delete';
            writeToLog($logMessage, $operation);
        }

        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }
}
