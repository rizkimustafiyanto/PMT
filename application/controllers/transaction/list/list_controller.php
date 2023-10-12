<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class list_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project/project_model');
        $this->load->model('transaction/project/project_member_model');
        $this->load->model('transaction/list/list_model');
        $this->load->model('transaction/list/list_member_model');
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('transaction/tools/Log_model');
        $this->load->model('master/member_model');
        $this->load->model('master/management_member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->IsLoggedIn();
        $this->webSiteActive();
    }

    public function List($p_project_id = '')
    {
        $memberID =  $this->session->userdata('member_id');

        #Project List
        #============================================================================
        $projectData = $this->project_model->Get([$p_project_id, '', 1, $memberID,]);
        $cekRoling = $this->project_member_model->Get(['', $p_project_id, $memberID, '', 4]);
        $ProjectMemberTotalRecords = $this->project_member_model->Get(['', $p_project_id, '', '', 3,]);
        $ProjectTypeRecords = $this->variable_model->GetVariable(['', 4]);
        $manageAccess = $this->management_member_model->Get([$memberID, 1]);
        $data['ProjectTypeRecords'] = $ProjectTypeRecords;
        $data['ProjectMemberRecords'] = $this->project_member_model->Get(['', $p_project_id, '', '', 8]);
        $data['ProjectListRecords'] = $this->project_member_model->Get(['', $p_project_id, '', '', 6]);
        $data['MemberRecords'] = $this->member_model->Get(['', 2]);
        $data['MemberTypeRecords'] = $this->variable_model->GetVariable(['', 2]);
        $data['StatusProjectRecords'] = $this->variable_model->GetVariable(['', 11]);
        $data['MemberSelectRecord'] = $this->project_member_model->Get(['', $p_project_id, '', '', 2]);
        $data['CollabGroup'] = $this->project_member_model->Get(['', '', '', '', 11]);
        $data['ManageRecord'] = $this->management_member_model->Get(['', 0]);

        #Attachment
        #============================================================================
        $data['AttachmentRecord'] = $this->Attachment_model->Get(['', '', $p_project_id, 2]);
        $data['AttachmentTypeRecord'] = $this->variable_model->GetVariable(['', 3]);

        #Log
        #============================================================================
        $data['LogRecord'] = $this->Log_model->Get(['', $p_project_id, '', 2]);

        #Find Kebutuhan
        #============================================================================
        $creatorProject = '';
        $project_name = '';
        $project_type = '';
        $description = '';
        $record_status = '';
        $name_record_status = '';
        $creation_id = '';
        $status_id = '';
        $name_project_status = '';
        $start_date = '';
        $due_date = '';
        $percentage = 0;
        $total_member = 0;
        $member_type = '';
        $selected = '';
        $collabName = '';
        $collabMember = '';
        $manageAkses = '';
        $batas_akses = '';

        if (!empty($projectData)) {
            foreach ($projectData as $record) {
                $project_name = $record->project_name;
                $project_type = $record->project_type;
                $start_date = $record->start_date;
                $due_date = $record->due_date;
                $description = $record->description;
                $record_status = $record->record_status;
                $name_record_status = $record->name_record_status;
                $creation_id = $record->creation_id;
                $status_id = $record->status_id;
                $percentage = $record->percentage;
                $name_project_status = $record->name_project_status;
                $creatorProject = $record->creation_id;
                $collabName = $record->collaboration_name;
                $collabMember = $record->collaboration_member;
            }
            $percentage = (empty($percentage)) ? 0 : $percentage;
            if (strlen($percentage) > 4) {
                $percentage = number_format($percentage, 2);
            }
        }

        if (!empty($ProjectMemberTotalRecords)) {
            foreach ($ProjectMemberTotalRecords as $recordTotal) {
                $total_member = $recordTotal->total_member;
            }
        }

        if (!empty($cekRoling)) {
            foreach ($cekRoling as $key) {
                $member_type = $key->member_type;
            }
        }

        foreach ($ProjectTypeRecords as $row) {
            if ($row->variable_id == $project_type) {
                $selected = $row->variable_name;
            }
        }

        $cekingCol = '';
        if ($collabMember) {
            $wordsCollabMember = explode(" ", $collabMember);
            $wordCountCollabMember = count($wordsCollabMember);

            if ($wordCountCollabMember > 0) {
                $wordsCollabName = explode(" ", $collabName);
                $wordCountCollabName = count($wordsCollabName);

                if ($wordCountCollabName > 0) {
                    $cekingCol = $collabMember;
                }
            }
        }

        if (empty($cekingCol)) {
            $cekingCol = json_encode($this->session->userdata('company_id'));
        }

        if (!empty($manageAccess)) {
            foreach ($manageAccess as $key) {
                $manageAkses = $key->akses;
            }
            $batas_akses = ($manageAkses != '0' && $status_id != 'STW-2');
        } else {
            $batas_akses = (($memberID == 'System' || $memberID == $creatorProject || $member_type == 'MT-2' || $member_type != 'MT-4') && $status_id != 'STW-2');
        }


        #Cek Kebutuhan
        #============================================================================
        $data['member_id'] = $memberID ?? '-';
        $data['creator'] = $creatorProject ?? '-';
        $data['project_id'] = $p_project_id ?? '-';
        $data['project_name'] = $project_name ?? '-';
        $data['project_type'] = $project_type ?? '-';
        $data['description'] = $description ?? '-';
        $data['record_status'] = $record_status ?? '-';
        $data['name_record_status'] = $name_record_status ?? '-';
        $data['creation_id'] = $creation_id ?? '-';
        $data['status_id'] = $status_id ?? '-';
        $data['name_project_status'] = $name_project_status ?? '-';
        $data['start_date'] = $start_date ?? '-';
        $data['due_date'] = $due_date ?? '-';
        $data['percentage'] = $percentage ?? '-';
        $data['total_member'] = $total_member ?? '-';
        $data['member_type'] = $member_type ?? '-';
        $data['selected'] = $selected ?? '-';
        $data['collab_name'] = $collabName ?? '-';
        $data['collab_member'] = $cekingCol ?? '-';
        $data['manage_access'] = $manageAkses;
        $data['batas_akses'] = $batas_akses;

        #List List
        #============================================================================
        $roling = ($member_type == 'MT-1' || $member_type == 'MT-2' || $member_type == 'MT-4' || $member_type == 'MT-I');
        $data['ListRecords'] = $this->list_model->Get(['', $p_project_id, '', '', '', $memberID, ($roling) ? 3 : 1]);
        $data['StatusItemRecords'] = $this->variable_model->GetVariable(['', 5]);


        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : List';
        $this->loadViews('transaction/list/list', $this->global, $data, null);
    }

    // INSERT PROJECT
    function InsertList()
    {
        #Header
        $list_id = '';
        $project_id = $this->input->post('idProject');
        $list_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_description = $this->input->post('description');
        $member_id = $this->input->post('membersList');
        $p_list_status = $this->input->post('status');
        $creation_user_id = $this->session->userdata('member_id');
        $record_status = 'A';

        $list_param = [
            $list_id,
            $project_id,
            $list_name,
            $start_date,
            $due_date,
            $p_priority,
            $member_id,
            $p_list_status,
            $p_description,
            $creation_user_id,
            $record_status
        ];
        $result = $this->list_model->Insert($list_param);

        // #EMAILING CONFIG
        // #=============================================================================================================
        $project_name = '';
        $card_name = $list_name;
        $projectFind = $this->project_model->Get([$project_id, '', 1, '']);
        foreach ($projectFind as $key) {
            $project_name = $key->project_name;
        }
        $cardFind = $this->list_model->Get(['', $project_id, '', '', '', '', 4]);
        foreach ($cardFind as $key) {
            $list_id = $key->list_id;
        }
        $memberRecords = $this->list_member_model->Get(['', $list_id, '', 0]);
        $penerima = 'rizkimurfer@gmail.com'; //Send Email Percobaan
        $subjectEmail = 'New Card';
        $urlmail = base_url() . 'home';
        // $urlmail = base_url() . 'Project/List/Task' . $project_id . '/' . $list_id;
        $creator_name = $this->session->userdata('member_name');
        $namaMember = [];
        $userMail = [];
        $creator_level = [];
        $status = '';
        foreach ($memberRecords as $member) {
            $userMail[] = $member->email;
            $namaMember[] = $member->member_name;
            $creator_level[] = $member->member_type;
        }
        $flagging = '1';
        $i = 0;
        $countNamaMember = count($namaMember); // Hitung jumlah $namaMember
        for ($i = 0; $i < $countNamaMember; $i++) {
            $this->sendingEmail($penerima, $namaMember[$i], $project_name, $creator_name, $creator_level[$i], $subjectEmail, $urlmail, $card_name, $flagging, $status);
        }
        // #END CONFIG
        // #==============================================================================================================

        $memberName = $this->session->userdata('member_name');
        $object = $list_name;
        $text_log = 'New card "' . $object . '" created by "' . $memberName . '"';
        $group_id = $project_id;
        $logging = [
            $text_log,
            $group_id,
            $creation_user_id
        ];

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Card created successfully',
                'project' => $project_id,
                'card' => $list_id
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create card'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateList()
    {
        #Header
        #================================================
        $p_list_id = $this->input->post('id');
        $p_project_id = $this->input->post('idProject');
        $p_list_name = $this->input->post('title');
        $start_date = $this->input->post('start');
        $due_date = $this->input->post('due');
        $p_priority = $this->input->post('priority');
        $p_description = $this->input->post('description');
        $p_item_status = $this->input->post('status');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = 'A';
        $flag = $this->input->post('flag');

        $param = [
            $p_list_id,
            $p_project_id,
            $p_list_name,
            $start_date,
            $due_date,
            $p_priority,
            $p_item_status,
            $p_description,
            $p_change_user_id,
            $p_record_status,
            $flag
        ];


        $result = $this->list_model->Update($param); //Execute Function

        $var = $this->variable_model->GetVariable([$p_item_status, 12]);
        $TR = $this->list_model->Get([$p_list_id, '', '', '', '', '', 2]);
        $memberName = $this->session->userdata('member_name');

        if ($flag == '1') {
            foreach ($var as $key) {
                $var_name = $key->variable_name;
            }
            foreach ($TR as $key) {
                $p_list_name = $key->list_name;
            }
            $object = $p_list_name;
            $text_log = 'Card "' . $object . '" to be "' . $var_name . '" by "' . $memberName . '"';
        } else {
            $object = $p_list_name;
            $text_log = 'Card "' . $object . '" updated by "' . $memberName . '"';
        }

        $group_id = $p_project_id;
        $logging = [
            $text_log,
            $group_id,
            $p_change_user_id
        ];

        // #EMAILING CONFIG
        // #=============================================================================================================
        $project_name = '';
        $card_name = $p_list_name;
        $projectFind = $this->project_model->Get([$p_project_id, '', 1, '']);
        foreach ($projectFind as $key) {
            $project_name = $key->project_name;
        }
        $memberRecords = $this->list_member_model->Get(['', $p_list_id, '', 0]);
        $penerima = 'rizkimurfer@gmail.com'; //Send Email Percobaan
        $subjectEmail = ($flag == '1') ? 'Update Status Card' : 'Update Card';
        $urlmail = base_url() . 'Project/List/Task' . $p_project_id . '/' . $p_list_id;
        $creator_name = $this->session->userdata('member_name');
        $namaMember = [];
        $userMail = [];
        $creator_level = [];
        foreach ($memberRecords as $member) {
            $userMail[] = $member->email;
            $namaMember[] = $member->member_name;
            $creator_level[] = $member->member_type;
        }
        $status = ($flag == '1') ? $var_name : '';
        $flagging = ($flag == '1') ? '3' : '2';
        $i = 0;
        $countNamaMember = count($namaMember); // Hitung jumlah $namaMember
        for ($i = 0; $i < $countNamaMember; $i++) {
            $this->sendingEmail($penerima, $namaMember[$i], $project_name, $creator_name, $creator_level[$i], $subjectEmail, $urlmail, $card_name, $flagging, $status);
        }
        // #END CONFIG
        // #==============================================================================================================


        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Card Updated!'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Card Cannot Update!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteList()
    {
        $param = $this->input->post('list_id');
        $memberID = $this->session->userdata('member_id');
        $memberName = $this->session->userdata('member_name');
        $datalist = $this->list_model->Get([$param, '', '', '', '', '', 2]);
        foreach ($datalist as $key) {
            $p_list_name = $key->list_name;
        }
        $object = $p_list_name;
        $text_log = 'Card "' . $object . '" deleted by "' . $memberName . '"';
        $group_id = $this->input->post('group_id');
        $logging = [
            $text_log,
            $group_id,
            $memberID
        ];

        $result = $this->list_model->Delete($param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Card Deleted Successfully!'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Card Cannot Delete!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function InsertListMember()
    {
        $list_id = $this->input->post('list_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $creation_user_id = $this->session->userdata('member_id');

        $item_param = [
            $list_id,
            $member_id,
            $member_type_id,
            $creation_user_id
        ];

        $result = $this->list_member_model->Insert($item_param);

        // LOGGING
        $memberName = $this->session->userdata('member_name');
        $dataMember = $this->member_model->Get([$member_id, 1]);
        foreach ($dataMember as $key) {
            $thismember = $key->member_name;
        }
        $object = $thismember;
        $text_log = 'Member "' . $object . '" inserted by "' . $memberName . '"';
        $group_id = $list_id;
        $logging = [
            $text_log,
            $group_id,
            $creation_user_id
        ];

        // #EMAILING CONFIG
        // #=============================================================================================================
        $project_name = '';
        $card_name = '';
        $project_id = '';
        $cardFind = $this->list_model->Get([$list_id, '', '', '', '', '', 5]);
        foreach ($cardFind as $key) {
            $list_id = $key->list_id;
            $project_id = $key->project_id;
            $project_name = $key->project_name;
        }
        $memberRecords = $this->list_member_model->Get(['', $list_id, '', 0]);
        $penerima = 'rizkimurfer@gmail.com'; //Send Email Percobaan
        $subjectEmail = 'New Card';
        $urlmail = base_url() . 'home';
        // $urlmail = base_url() . 'Project/List/Task' . $project_id . '/' . $list_id;
        $creator_name = $this->session->userdata('member_name');
        $namaMember = [];
        $userMail = [];
        $creator_level = [];
        $status = '';
        foreach ($memberRecords as $member) {
            if ($member_id == $member->member_id) {
                $userMail[] = $member->email;
                $namaMember[] = $member->member_name;
                $creator_level[] = $member->member_type;
            }
        }
        $flagging = '1';
        $i = 0;
        $countNamaMember = count($namaMember);
        // #END CONFIG
        // #==============================================================================================================

        if ($result === 'success') {
            for ($i = 0; $i < $countNamaMember; $i++) {
                $this->sendingEmail($penerima, $namaMember[$i], $project_name, $creator_name, $creator_level[$i], $subjectEmail, $urlmail, $card_name, $flagging, $status);
            }
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Card member insert successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => $result
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateListMember()
    {
        //Bikin pengecekan array
        $list_member_id = $this->input->post('list_member_id');
        $list_id = $this->input->post('list_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = $this->input->post('r_status');

        $param = [
            $list_member_id,
            $list_id,
            $member_id,
            $member_type_id,
            $p_change_user_id,
            $p_record_status,
        ];

        // LOGGING
        $memberName = $this->session->userdata('member_name');
        $dataMember = $this->member_model->Get([$member_id, 1]);
        foreach ($dataMember as $key) {
            $thismember = $key->member_name;
        }
        $object = $thismember;
        $text_log = 'Member "' . $object . '" updated by "' . $memberName . '"';
        $group_id = $list_id;
        $logging = [
            $text_log,
            $group_id,
            $p_change_user_id
        ];

        //eksekusi query
        $result = $this->list_member_model->Update($param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Card member update successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to update card member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteListMember()
    {
        $list_member_id = $this->input->post('list_member_id');

        // LOGGING
        $dataMember = $this->list_member_model->Get([$list_member_id, '', '', 5]);

        foreach ($dataMember as $key) {
            $thismember = $key->member_name;
            $thisgroup = $key->list_id;
        }
        $memberName = $this->session->userdata('member_name');
        $memberID = $this->session->userdata('member_id');
        $object = $thismember;
        $text_log = 'Member "' . $object . '" removed by "' . $memberName . '"';
        $group_id = $thisgroup;
        $logging = [
            $text_log,
            $group_id,
            $memberID
        ];

        // EXCEUTION
        $result = $this->list_member_model->Delete($list_member_id);
        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Card member deleted successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to delete card member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    //TOOLS
    #====================================================================
    function sendingEmail($penerima, $namaPenerima, $namaProject, $creatorName, $creator_level, $subjectEmail, $urlmail, $card_name, $flagging, $status)
    {
        $subject_email = $subjectEmail;
        $namaPenerima = $namaPenerima;
        $namaProject = $namaProject;
        $creator = $creatorName;
        $emailPenerima = $penerima;
        $isi_email = '';

        if ($flagging == '1') {
            $isi_email = '
        <html>
        <head>
            <meta charset="utf-8">
        </head>
        <body>
            <h2 style="text-align: center;"><strong>New&nbsp;Card</strong></h2>
            <p>&nbsp;</p>
            <p>Kepada Yth. Bapak/Ibu ' . $namaPenerima . '<br /> <br /> Di informasikan anda telah ditambahkan menjadi ' . $creator_level . ' pada Card ' . $card_name . ' untuk Project ' . $namaProject . '.<br /> Untuk lebih lanjut anda bisa membuka aplikasi dengan melakukan klik link berikut ini : <a type="button" href="' . $urlmail . '" style="color: #ff0000; text-decoration: none;">Tautan ke Halaman</a>
            </p>
            <p><em>Regards</em>,<br /> <strong>PMT || SYSTEM ADMINISTRATOR </strong></p>
            <p>&nbsp;</p>
        </body>
        </html>';
        } elseif ($flagging == '2') {
            $isi_email = '
        <html>
        <head>
            <meta charset="utf-8">
        </head>
        <body>
            <h2 style="text-align: center;"><strong>Update&nbsp;Card</strong></h2>
            <p>&nbsp;</p>
            <p>Kepada Yth. Bapak/Ibu ' . $namaPenerima . '<br /> <br />
            Di informasikan untuk Card ' . $card_name . ' telah dilakukan perubahan data.<br /> Untuk lebih lanjut anda bisa membuka aplikasi dengan melakukan klik link berikut ini : <a type="button" href="' . $urlmail . '" style="color: #ff0000; text-decoration: none;">Tautan ke Halaman</a>
            </p>
            <p><em>Regards</em>,<br /> <strong>PMT || SYSTEM ADMINISTRATOR </strong></p>
            <p>&nbsp;</p>
        </body>
        </html>';
        } elseif ($flagging == '3') {
            $isi_email = '
        <html>
        <head>
            <meta charset="utf-8">
        </head>
        <body>
            <h2 style="text-align: center;"><strong>Update&nbsp;Card</strong></h2>
            <p>&nbsp;</p>
            <p>Kepada Yth. Bapak/Ibu ' . $namaPenerima . '<br /> <br />
            Di informasikan untuk Card ' . $card_name . ' saat ini untuk statusnya adalah ' . $status . '.<br /> Untuk lebih lanjut anda bisa membuka aplikasi dengan melakukan klik link berikut ini : <a type="button" href="' . $urlmail . '" style="color: #ff0000; text-decoration: none;">Tautan ke Halaman</a>
            </p>
            <p><em>Regards</em>,<br /> <strong>PMT || SYSTEM ADMINISTRATOR </strong></p>
            <p>&nbsp;</p>
        </body>
        </html>';
        } elseif ($flagging == '4') {
        } elseif ($flagging == '5') {
        } else {
        }

        $email = new Email();
        $email->sendEmail($emailPenerima, $subject_email, $isi_email);
    }
}
