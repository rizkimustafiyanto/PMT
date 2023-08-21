<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Checklist_item_controller extends BaseController
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
        $this->load->model('transaction/Card_checklist_model');
        $this->load->model('transaction/Checklist_item_model');
        $this->load->model('master/member_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->load->helper('log_helper');

        $this->IsLoggedIn();
    }

    function InsertChecklistItem()
    {
        #Header
        $project_id = $this->input->post('project_id');
        $card_id = $this->input->post('card_id');
        #Detail Member
        $checklist_item_id = '';
        $checklist_item_name = $this->input->post('checklist_item_name');
        $flag_status = 0;
        $member_id = $this->input->post('member_id');
        $change_no = 0;
        $creation_user_id = $this->session->userdata('member_id');
        $change_user_id = $this->session->userdata('member_id');
        $record_status = 'A';
        $start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $due_date = date('Y-m-d H:i:s', strtotime($this->input->post('due_date')));
        $temp_start_date = date('Y-m-d H:i:s', strtotime($this->input->post('temp_start_date')));
        $temp_due_date = date('Y-m-d H:i:s', strtotime($this->input->post('temp_due_date')));

        if (
            $start_date < $temp_start_date ||
            $start_date > $temp_due_date ||
            ($due_date < $temp_start_date || $due_date > $temp_due_date)
        ) {
            $this->session->set_flashdata(
                'error',
                'Check interval date project , date project not valid!'
            );
        } else {
            $checklist_item_parameter = [
                $checklist_item_id,
                $card_id,
                $checklist_item_name,
                $flag_status,
                $member_id,
                $start_date,
                $due_date,
                $change_no,
                $creation_user_id,
                $change_user_id,
                $record_status,
            ];

            $Card_member = [
                'p_card_member_id' => '',
                'p_card_id' => $card_id,
                'p_member_id' => '',
                'p_flag' => 2,
                'p_project_id' => $project_id,
            ];
            $member_parameter = [
                'p_member_id' => '',
                'p_flag' => 0,
            ];

            $userAnggota = $this->Card_member_model->Get($Card_member);
            $memberRecords = $this->member_model->get($member_parameter);
            $MailTry = array('pt.ujicobaku@gmail.com', 'rizki.mustafiyanto@gmail.com'); //Email Coba
            $namaMember = '';
            $mailu = '';
            $userMail = [];

            foreach ($userAnggota as $anggota) {
                foreach ($memberRecords as $member) {
                    if ($member->member_id == $anggota->member_id) {
                        if ($anggota->member_id == $member_id) {
                            $namaMember = $member->member_name;
                            $mailu = $member->email;
                        }
                        $userMail[$member->member_id] = $member->email;
                        break;
                    }
                }
            }

            $subject_email = 'Create Project Item';
            $isi_email = "Halo,\n\n\tItem projek baru di PMT telah bertambah. Berikut adalah detailnya:\n\tNama\t\t\t: " .
                $namaMember . "\n\tEmail\t\t\t: " . $mailu . "\n\tProject ID\t: " . $project_id . "\n\nTerima kasih.";

            $email = new Email();
            $emailSent = true;

            // Log Activity Configuration
            date_default_timezone_set('Asia/Jakarta');
            $operation = 'Create';
            $logMessage = 'Item Project with name: ' . $checklist_item_name . ' with name of member: ' . $namaMember;
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

            $result = $this->Checklist_item_model->Insert($checklist_item_parameter);

            if ($result > 0) {
                // Mengirim email
                // foreach ($MailTry as $alamat_email) {
                //     if (!$email->sendEmail($alamat_email, $subject_email, $isi_email)) {
                //         $emailSent = false;
                //         break; // Menghentikan loop jika pengiriman email gagal
                //     }
                // }
                // if ($emailSent) {
                //     $this->session->set_flashdata('success', 'New checklist item Update successfully! Email notification sent.');
                // } else {
                //     $this->session->set_flashdata('error', 'New checklist item Update successfully, but failed to send email notification.');
                // }
                $this->session->set_flashdata('success', 'New projek item created successfully! Email notification sent.' . implode(', ', $userMail) . $mailu);
                $this->Card_log_model->Insert($card_log_parameter);
            } else {
                $this->session->set_flashdata('error', 'Checklist item creation failed !');
            }
        }
        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }

    function UpdateChecklistItem()
    {
        #Header
        $project_id = $this->input->post('project_id');
        $card_id = $this->input->post('card_id');
        #================================================
        $checklist_item_id = $this->input->post('checklist_item_id');
        $checklist_item_name = $this->input->post('checklist_item_name');
        $flag_status = $this->input->post('flag_status');
        $member_id = $this->input->post('member_id');
        $start_date = date('Y-m-d H:i:s', strtotime($this->input->post('start_date')));
        $due_date = date('Y-m-d H:i:s', strtotime($this->input->post('due_date')));
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = 0;
        //Batas Ambil Deadline
        $temp_start_date = date('Y-m-d H:i:s', strtotime($this->input->post('temp_start_date')));
        $temp_due_date = date('Y-m-d H:i:s', strtotime($this->input->post('temp_due_date')));

        if (
            $start_date < $temp_start_date ||
            $start_date > $temp_due_date ||
            ($due_date < $temp_start_date || $due_date > $temp_due_date)
        ) {
            $this->session->set_flashdata('error', 'Check interval date project , date project not valid!');
        } else {
            $param = [
                $checklist_item_id,
                $card_id,
                $checklist_item_name,
                $flag_status,
                $member_id,
                $start_date,
                $due_date,
                $p_change_user_id,
                $p_record_status,
                $flag,
            ];

            // Pencarian member
            $Card_member = [
                'p_card_member_id' => '',
                'p_card_id' => $card_id,
                'p_member_id' => '',
                'p_flag' => 2,
                'p_project_id' => $project_id,
            ];
            $member_parameter = [
                'p_member_id' => '',
                'p_flag' => 0,
            ];

            $userAnggota = $this->Card_member_model->Get($Card_member);
            $memberRecords = $this->member_model->get($member_parameter);
            $MailTry = array('pt.ujicobaku@gmail.com', 'rizki.mustafiyanto@gmail.com'); //Email Coba
            $namaMember = '';
            $mailu = '';
            $userMail = [];

            foreach ($userAnggota as $anggota) {
                foreach ($memberRecords as $member) {
                    if ($member->member_id == $anggota->member_id) {
                        if ($anggota->member_id == $member_id) {
                            $namaMember = $member->member_name;
                            $mailu = $member->email;
                        }
                        $userMail[$member->member_id] = $member->email;
                        break;
                    }
                }
            }

            $subject_email = 'Checklist Item Update';
            //Isi pesan
            $isi_email = "Halo,\n\n\tAda Update item projek baru di PMT. Berikut adalah detailnya:\n\tProject Item ID\t\t\t: " .
                $$checklist_item_id . "\n\tNama Item\t: " . $checklist_item_name . "\n\tNama Member\t: " . $namaMember . "\n\tStart Date\t: " . $start_date . "\n\tStart Date\t: " . $due_date . "\n\nTerima kasih.";
            $emailSent = true;
            $email = new Email(); //Pemanggilan fungsi email pada library

            // Log Activity Configuration
            date_default_timezone_set('Asia/Jakarta');
            $operation = 'Update';
            $logMessage = 'Item Project with name: ' . $checklist_item_name . ' with name of member: ' . $namaMember;
            $log = date('Y-m-d H:i:s') . ' [' . $operation . '] ' . $logMessage;
            $card_log_parameter = [
                $card_log_id = '',
                $card_id,
                $member_id,
                $log,
                $change_no = '',
                $creation_user_id = '',
                $change_user_id = '',
                $record_status = '',
            ];

            $result = $this->Checklist_item_model->Update($param); //Execute Function

            if ($result > 0) {
                // Mengirim email
                // foreach ($MailTry as $alamat_email) {
                //     if (!$email->sendEmail($alamat_email, $subject_email, $isi_email)) {
                //         $emailSent = false;
                //         break; // Menghentikan loop jika pengiriman email gagal
                //     }
                // }

                // if ($emailSent) {
                //     $this->session->set_flashdata('success', 'Projek item Update successfully! Email notification sent.');
                // } else {
                //     $this->session->set_flashdata('error', 'Projek item Update successfully, but failed to send email notification.');
                // }

                $this->session->set_flashdata('success', 'Checklist Item Updated');
                $this->Card_log_model->Insert($card_log_parameter);
            } else {
                $this->session->set_flashdata(
                    'error',
                    'Checklist Item Cannot Update'
                );
            }
        }

        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id);
    }

    function UpdateChecklistItemChecked()
    {
        $checklist_item_id = $this->input->post('checklist_item_id');
        $card_id = $this->input->post('card_id');
        $status = $this->input->post('status');
        $flag_status = ($status == 'checked') ? 100 : 0; // Menggunakan operator ternary untuk menentukan flag_status
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = 1;

        $param = [
            $checklist_item_id,
            $card_id,
            '',
            $flag_status,
            '',
            '',
            '',
            $p_change_user_id,
            $p_record_status,
            $flag,
        ];

        // Pencarian member
        $item_get_name = [
            'p_checklist_item_id' => '',
            'p_card_checklist_id' => $card_id,
            'p_member_id' => '',
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 2,
        ];
        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];
        $userAnggota = $this->Checklist_item_model->get($item_get_name);
        $memberRecords = $this->member_model->get($member_parameter);

        //Konfigurasi Email
        $MailTry = array('pt.ujicobaku@gmail.com', 'rizki.mustafiyanto@gmail.com'); //Email Coba
        //Diatas ini merupakan percobaan sedangkan yang bawah eksekusi
        $namaMember = '';
        $checklist_item_name = '';
        $member_checklist = '';
        $userMail = [];

        foreach ($userAnggota as $anggota) {
            foreach ($memberRecords as $member) {
                if ($member->member_id == $anggota->member_id) {
                    if ($anggota->checklist_item_id == $checklist_item_id) {
                        $namaMember = $member->member_name;
                        $checklist_item_name = $anggota->checklist_item_name;
                        $member_checklist = $anggota->member_id;
                    }
                    $userMail[$member->member_id] = $member->email;
                    break;
                }
            }
        }

        $subject_email = 'Checklist Item Update';
        //Isi pesan
        $isi_email = "Halo,\n\n\tTelah checked item list di PMT. Berikut adalah detailnya:\n\tNama\t\t\t: " .
            $namaMember . "\n\tCard ID\t: " . $card_id . "\n\nTerima kasih.";
        $emailSent = true;
        $email = new Email(); //Pengambilan Fungsi Email Pada Library

        // Log Activity Configuration
        date_default_timezone_set('Asia/Jakarta');
        $operation = 'Update';
        $logMessage = 'Checklist Item Project with name: ' . $checklist_item_name . ' with name of member: ' . $namaMember;
        $log = date('Y-m-d H:i:s') . ' [' . $operation . '] ' . $logMessage;
        $card_log_parameter = [
            $card_log_id = '',
            $card_id,
            $member_id = $member_checklist,
            $log,
            $change_no = '',
            $creation_user_id = '',
            $change_user_id = '',
            $record_status = '',
        ];

        $result = $this->Checklist_item_model->update($param);

        if ($result > 0) {
            $this->session->set_flashdata(
                'success',
                'Checklist item has been updated!'
            );
            // Mengirim email
            // foreach ($MailTry as $alamat_email) {
            //     if (!$email->sendEmail($alamat_email, $subject_email, $isi_email)) {
            //         $emailSent = false;
            //         break; // Menghentikan loop jika pengiriman email gagal
            //     }
            // }

            // if ($emailSent) {
            //     $this->session->set_flashdata('success', 'New checklist item created successfully! Email notification sent.');
            // } else {
            //     $this->session->set_flashdata('error', 'New checklist item created successfully, but failed to send email notification.');
            // }
            $this->Card_log_model->Insert($card_log_parameter);
            $response = array('success' => true);
        } else {
            $this->session->set_flashdata('error', 'List cannot be checked.');
            $response = array('success' => false);
        }
        echo json_encode($response);
    }


    function DeleteChecklistItem($project_id = '', $card_id = '', $checklist_item_id = '')
    {
        $param = [$checklist_item_id, $card_id];

        $item_get_name = [
            'p_checklist_item_id' => $checklist_item_id,
            'p_card_checklist_id' => '',
            'p_member_id' => '',
            'p_start_date' => '',
            'p_due_date' => '',
            'p_flag' => 1,
        ];
        $Card_member = [
            'p_card_member_id' => '',
            'p_card_id' => $card_id,
            'p_member_id' => '',
            'p_flag' => 2,
            'p_project_id' => $project_id,
        ];
        $member_parameter = [
            'p_member_id' => '',
            'p_flag' => 0,
        ];

        $userMember = $this->Checklist_item_model->get($item_get_name);
        $userAnggota = $this->Card_member_model->Get($Card_member);
        $memberRecords = $this->member_model->get($member_parameter);
        $userMail = [];
        $member_id = '';
        $namaMember = '';
        $checklist_item_name = '';

        foreach ($userAnggota as $anggota) {
            foreach ($memberRecords as $member) {
                if ($member->member_id == $anggota->member_id) {
                    $userMail[$member->member_id] = $member->email;
                    break;
                }
            }
        }

        foreach ($userMember as $uM) {
            foreach ($memberRecords as $member) {
                if ($uM->member_id == $member->member_id) {
                    $checklist_item_name = $uM->checklist_item_name;
                    $namaMember = $member->member_name;
                    $member_id = $uM->member_id;
                    break;
                }
            }
        }

        $subject_email = 'Item Project Delete';
        $isi_email = "Halo,\n\n\tTelah delete item list di PMT. Berikut adalah detailnya:\n\tNama\t\t\t: " .
            $namaMember . "\n\tCard ID\t: " . $card_id . "\n\nTerima kasih.";
        $emailSent = true;
        $email = new Email();

        date_default_timezone_set('Asia/Jakarta');
        $operation = 'Delete';
        $logMessage = 'Delete Item Project with name: ' . $checklist_item_name . ' with name of member: ' . $namaMember;
        $log = date('Y-m-d H:i:s') . ' [' . $operation . '] ' . $logMessage;
        $card_log_parameter = [
            $card_log_id = '',
            $card_id,
            $member_id,
            $log,
            $change_no = '',
            $creation_user_id = '',
            $change_user_id = '',
            $record_status = '',
        ];

        $result = $this->Checklist_item_model->Delete($param);

        if ($result > 0) {
            // // Mengirim email
            // foreach ($MailTry as $alamat_email) {
            //     if (!$email->sendEmail($alamat_email, $subject_email, $isi_email)) {
            //         $emailSent = false;
            //         break; // Menghentikan loop jika pengiriman email gagal
            //     }
            // }
            // if ($emailSent) {
            //     $this->session->set_flashdata('success', 'New checklist item deleted successfully! Email notification sent.');
            // } else {
            //     $this->session->set_flashdata('error', 'New checklist item deleted successfully, but failed to send email notification.');
            // }
            $this->session->set_flashdata('success', 'checklist item has been deleted !');
            $this->Card_log_model->Insert($card_log_parameter);
        } else {
            $this->session->set_flashdata('error', 'checklist item cannot be deleted !');
        }

        redirect(base_url() . 'DetailCard/' . $project_id . '/' . $card_id . '/');
    }
}
