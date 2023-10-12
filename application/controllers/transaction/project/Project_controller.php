<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class project_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project/project_model');
        $this->load->model('transaction/project/project_member_model');
        $this->load->model('transaction/tools/Attachment_model');
        $this->load->model('transaction/tools/Log_model');
        $this->load->model('master/member_model');
        $this->load->model('master/variable_model');
        $this->load->library('email');
        $this->load->library('email/Email');
        $this->load->helper('log_helper');
        $this->IsLoggedIn();
        $this->webSiteActive();
    }

    public function index()
    {
        $this->global['pageTitle'] = 'CodeInsect : Project Workspace';
        $this->loadViews('transaction/Project', $this->global, null, null);
    }

    function GetProject()
    {
        $memberID =  $this->session->userdata('member_id');
        $data['ProjectRecords'] = $this->project_model->Get(['', '', 0, $memberID]);
        $data['ProjectMemberRecords'] = $this->project_member_model->Get(['', '', '', '', 0]);
        $data['ProjectTypeRecords'] = $this->variable_model->GetVariable(['', 4]);
        $data['tempmember'] = $this->member_model->Get([0, 2]);
        $data['CollabGroup'] = $this->project_member_model->Get(['', '', '', '', 11]);

        #============================================================================

        $data['member_id'] = $memberID;

        #============================================================================

        $this->global['pageTitle'] = 'CodeInsect : Project Workspace';
        $this->loadViews(
            'transaction/project/project',
            $this->global,
            $data,
            null
        );
    }

    function InsertProject()
    {
        $project_id = '';
        $project_name = $this->input->post('title');
        $project_type = $this->input->post('projectType');
        $project_start = $this->input->post('start');
        $project_due = $this->input->post('due');
        $description = $this->input->post('description');
        $members_project = $this->input->post('membersProject');
        $creation_user_id = $this->session->userdata('member_id');
        $status_id = 'STW-1';
        $collaborate_member = $this->input->post('collab_member');
        $Project_parameter = [
            $project_id,
            $project_name,
            $project_type,
            $project_start,
            $project_due,
            $description,
            $members_project,
            $creation_user_id,
            $status_id,
            $collaborate_member
        ];

        $result = $this->project_model->Insert($Project_parameter);

        if ($result > 0) {
            // #EMAILING CONFIG
            // #==============================================================================================================
            $projectFind = $this->project_model->Get(['', '', 6, '']);
            foreach ($projectFind as $key) {
                $project_id = $key->project_id;
            }
            $memberRecords = $this->project_member_model->Get(['', $project_id, '', '', 8]);
            $penerima = 'rizkimurfer@gmail.com'; //Send Email Percobaan
            $subjectEmail = 'New Project';
            $urlmail = base_url() . 'home';
            // $urlmail = base_url() . 'Project/List/' . $project_id;
            $creator_name = '';
            $namaMember = [];
            $userMail = [];
            $creator_level = [];
            foreach ($memberRecords as $member) {
                $userMail[] = $member->email;
                $namaMember[] = $member->member_name;
                $creator_level[] = $member->member_type;
                if ($creation_user_id == $member->member_id) {
                    $creator_name = $member->member_name;
                }
            }
            $flagging = '1';
            $i = 0;
            $countNamaMember = count($namaMember); // Hitung jumlah $namaMember
            for ($i = 0; $i < $countNamaMember; $i++) {
                $this->sendingEmail($penerima, $namaMember[$i], $project_name, $creator_name, $creator_level[$i], $subjectEmail, $urlmail, $flagging);
            }
            // #END CONFIG
            // #==============================================================================================================
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project created successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to create project!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateProject()
    {
        $p_project_id = $this->input->post('id');
        $p_project_name = $this->input->post('title');
        $p_project_type = $this->input->post('projectType');
        $p_project_start = $this->input->post('start');
        $p_project_due = $this->input->post('due');
        $p_description = $this->input->post('description');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_status_id =  $this->input->post('status');
        $p_collab_member =  $this->input->post('collab_member');
        $flag = $this->input->post('flag');

        $param = [
            $p_project_id,
            $p_project_name,
            $p_project_type,
            $p_project_start,
            $p_project_due,
            $p_description,
            $p_change_user_id,
            $p_status_id,
            $p_collab_member,
            $flag
        ];

        $result = $this->project_model->Update($param);

        // #EMAILING CONFIG
        // #==============================================================================================================
        $memberRecords = $this->project_member_model->Get(['', $p_project_id, '', '', 8]);
        $penerima = 'rizkimurfer@gmail.com'; //Send Email Percobaan
        $subjectEmail = 'Update Project';
        $urlmail = base_url() . 'Project/List/' . $p_project_id;
        $creator_name = '';
        $namaMember = [];
        $userMail = [];
        $creator_level = [];
        foreach ($memberRecords as $member) {
            $userMail[] = $member->email;
            $namaMember[] = $member->member_name;
            $creator_level[] = $member->member_type;
            if ($p_change_user_id == $member->member_id) {
                $creator_name = $member->member_name;
            }
        }
        $flagging = '1';
        $i = 0;
        $countNamaMember = count($namaMember); // Hitung jumlah $namaMember
        for ($i = 0; $i < $countNamaMember; $i++) {
            $this->sendingEmail($penerima, $namaMember[$i], $p_project_name, $creator_name, $creator_level[$i], $subjectEmail, $urlmail, $flagging);
        }
        // #END CONFIG
        // #==============================================================================================================

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project updated successfully'
            );
        } else {
            // $this->session->set_flashdata('error', 'Project Cannot Update');
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Project updated failed!'
            );
        }
        // redirect('Project');
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteProject()
    {
        $Project_id = $this->input->post('project_id');
        $result = $this->project_model->Delete($Project_id);

        if ($result > 0) {
            $response = 'Project has been deleted !';
        } else {
            $response = 'Project cannot deleted !';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    // PROJECT MEMBER
    #===========================================================================
    function SelectProjectMember()
    {
        $group_project = $this->input->post('pro_group');
        $data['SelectM'] = $this->project_member_model->Get(['', $group_project, '', '', 10]);
        echo json_encode($data);
    }


    function InsertProjectMember()
    {
        $project_id = $this->input->post('project_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $creation_user_id = $this->session->userdata('member_id');
        $record_status = $this->input->post('r_status');

        $project_param = [
            $project_id,
            $member_id,
            $member_type_id,
            $creation_user_id,
            $record_status
        ];

        $result = $this->project_member_model->Insert($project_param);

        // #EMAILING CONFIG
        // #==============================================================================================================
        $project_name = '';
        $projectFind = $this->project_model->Get([$project_id, '', 1, '']);
        foreach ($projectFind as $key) {
            $project_name = $key->project_name;
        }
        $memberRecords = $this->project_member_model->Get(['', $project_id, '', '', 8]);
        $penerima = 'rizkimurfer@gmail.com'; //Send Email Percobaan
        $subjectEmail = 'Project Member';
        $urlmail = base_url() . 'home';
        // $urlmail = base_url() . 'Project/List/' . $project_id;
        $creator_name = '';
        $namaMember = [];
        $userMail = [];
        $creator_level = [];
        foreach ($memberRecords as $member) {
            $userMail[] = $member->email;
            $namaMember[] = $member->member_name;
            $creator_level[] = $member->member_type;
            if ($creation_user_id == $member->member_id) {
                $creator_name = $member->member_name;
            }
        }
        $flagging = '1';
        $i = 0;
        $countNamaMember = count($namaMember); // Hitung jumlah $namaMember
        // #END CONFIG
        // #==============================================================================================================

        if ($result === 'success') {
            for ($i = 0; $i < $countNamaMember; $i++) {
                $this->sendingEmail($penerima, $namaMember[$i], $project_name, $creator_name, $creator_level[$i], $subjectEmail, $urlmail, $flagging);
            }
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project member insert successfully'
            );
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

    function UpdateProjectMember()
    {
        //Bikin pengecekan array
        $project_member_id = $this->input->post('project_member_id');
        $project_id = $this->input->post('project_id');
        $member_id = $this->input->post('member_id');
        $member_type_id = $this->input->post('member_type_id');
        $p_change_user_id = $this->session->userdata('member_id');
        $p_record_status = $this->input->post('r_status');

        $param = [
            $project_member_id,
            $project_id,
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
        $group_id = $project_id;
        $logging = [
            $text_log,
            $group_id,
            $p_change_user_id
        ];

        //eksekusi query
        $result = $this->project_member_model->Update($param);

        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project member update successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to update project member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteProjectMember()
    {
        $project_member_id = $this->input->post('project_member_id');

        // LOGGING
        $dataMember = $this->project_member_model->Get([$project_member_id, '', '', '', 7]);
        foreach ($dataMember as $key) {
            $thismember = $key->member_name;
        }
        $memberName = $this->session->userdata('member_name');
        $memberID = $this->session->userdata('member_id');
        $object = $thismember;
        $text_log = 'Member "' . $object . '" removed by "' . $memberName . '"';
        $group_id = $this->input->post('group_id');
        $logging = [
            $text_log,
            $group_id,
            $memberID
        ];

        // EXCECUTION
        $result = $this->project_member_model->Delete($project_member_id);
        if ($result > 0) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project member deleted successfully'
            );
            $this->Log_model->Insert($logging);
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to delete project member!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    // END EORKSPACE MEMBER
    #===========================================================================

    // PINNED PROJECT
    #===========================================================================
    function PinorUnpinProject()
    {
        $project_id = $this->input->post('project_id');
        $member_id = $this->session->userdata('member_id');

        $Pin_parameter = [
            $project_id,
            $member_id
        ];
        $result = $this->project_model->Pinning($Pin_parameter);

        if ($result) {
            $response = array(
                'status' => 'success',
                'title' => 'Success',
                'message' => 'Project pin successfully'
            );
        } else {
            $response = array(
                'status' => 'error',
                'title' => 'Error',
                'message' => 'Failed to pin project!'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function sendingEmail($penerima, $namaPenerima, $namaProject, $creatorName, $creator_level, $subjectEmail, $urlmail, $flagging)
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
            <h2 style="text-align: center;"><strong>New&nbsp;Project</strong></h2>
            <p>&nbsp;</p>
            <p>Kepada Yth. Bapak/Ibu ' . $namaPenerima . '<br /> <br /> Di informasikan anda telah ditambahkan menjadi ' . $creator_level . ' pada Project ' . $namaProject . '.<br /> Untuk lebih lanjut anda bisa membuka aplikasi dengan melakukan klik link berikut ini : <a type="button" href="' . $urlmail . '" style="color: #ff0000; text-decoration: none;">Tautan ke Halaman</a>
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
            <h2 style="text-align: center;"><strong>New&nbsp;Project</strong></h2>
            <p>&nbsp;</p>
            <p>Kepada Yth. Bapak/Ibu ' . $namaPenerima . '<br /> <br /> Di informasikan anda telah ditambahkan menjadi ' . $creator_level . ' pada Project ' . $namaProject . '.<br /> Untuk lebih lanjut anda bisa membuka aplikasi dengan melakukan klik link berikut ini : <a type="button" href="' . $urlmail . '" style="color: #ff0000; text-decoration: none;">Tautan ke Halaman</a>
            </p>
            <p><em>Regards</em>,<br /> <strong>PMT || SYSTEM ADMINISTRATOR </strong></p>
            <p>&nbsp;</p>
        </body>
        </html>';
        } elseif ($flagging == '3') {
        } elseif ($flagging == '4') {
        } elseif ($flagging == '5') {
        } else {
        }

        $email = new Email();
        $email->sendEmail($emailPenerima, $subject_email, $isi_email);
    }
}
