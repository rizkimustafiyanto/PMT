<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class calendar_controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('calendar/Calendar_model');
        $this->load->model('master/member_model');

        $this->IsLoggedIn();
    }

    function index()
    {
        $parammember = [0, 0];
        $data['memberRecords'] = $this->member_model->Get($parammember);
        $this->global['pageTitle'] = 'CodeInsect : List Events';
        $this->loadViews('calendar/calendar', $this->global, $data, null);
    }

    function GetEvent()
    {
        $memberId = $this->session->userdata('member_id');
        $roleId = $this->session->userdata('role_id');
        $result = $this->Calendar_model->GetEvent([0, $memberId, ($roleId == '1') ? 0 : 1]);
        $events = array();

        if ($result !== null) { // Tambahkan penanganan jika $result bukan null
            foreach ($result as $key) {
                $event = array(
                    "id" => $key->id,
                    "title" => $key->title,
                    "start" => $key->start_date,
                    "end" => $key->end_date,
                    "notes" => $key->notes,
                    "location" => $key->location,
                    "colorId" => $key->color_id,
                    "backgroundColor" => $key->background_color,
                    "borderColor" => $key->border_color,
                    "allDay" => (bool)$key->all_day,
                    "creator" => $key->creator,
                    "creationDate" => $key->creation_date
                );
                array_push($events, $event);
            }
        }

        echo json_encode($events);
    }

    function AddEvent()
    {
        $eventTitle = $this->input->post("title");
        $backgroundColor = $this->input->post("color");
        $borderColor = $this->input->post("color");
        $startDate = $this->input->post("start");
        $endDate = $this->input->post("end");
        $eventNote = $this->input->post("eventNote");
        $location = $this->input->post("eventLoc");
        $allDay = $this->input->post("allDay") === "true";
        $share_to = $this->input->post("shareTo");
        $group_id = $this->input->post("groupId");
        $creator = $this->session->userdata('member_id');

        $addEvent = [
            'p_title' => $eventTitle,
            'p_start_date' => $startDate,
            'p_end_date' => $endDate,
            'p_all_day' => $allDay,
            'p_notes' => $eventNote,
            'p_background_color' => $backgroundColor,
            'p_border_color' => $borderColor,
            'p_location' => $location,
            'p_share_to' => $share_to,
            'p_group_id' => $group_id,
            'p_creation_user_id' => $creator
        ];

        if ($allDay || (!empty($endDate) && ($endDate > $startDate))) {
            $result = $this->Calendar_model->InsertEvent($addEvent);
            if ($result) {
                $response = [
                    'success' => true,
                    'message' => 'Acara baru berhasil dibuat'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Acara baru gagal dibuat'
                ];
            }
        } else {
            $this->session->set_flashdata('error', 'End date is null or End date > Start Date');
            $response = [
                'success' => false,
                'message' => 'Acara baru gagal dibuat'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function UpdateEvent()
    {
        $p_eventID = $this->input->post("event_id");
        $p_title = $this->input->post("title");
        $p_start_date = $this->input->post("start");
        $p_end_date = $this->input->post("end");
        $p_color_id = $this->input->post("color_id");
        $p_notes = $this->input->post("eventNote");
        $p_location = $this->input->post("eventLoc");
        $p_creation_date = $this->input->post("creationDate");
        $p_flag = $this->input->post("flag");

        $updateEvent = [
            $p_eventID,
            $p_title,
            $p_start_date,
            $p_end_date,
            $p_notes,
            $p_color_id,
            $p_location,
            $p_creation_date,
            $p_flag
        ];

        // Panggil model Anda untuk melakukan operasi UPDATE
        $result = $this->Calendar_model->UpdateEvent($updateEvent);

        // Menggunakan response JSON untuk memberikan feedback ke frontend
        $response = array(
            'success' => $result, // Menyimpan status berhasil atau tidak
            'message' => $result ? 'Update event successfully' : 'Update event failed'
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }


    function DeleteEvent()
    {
        $p_eventTitle = $this->input->post('eventTitle');
        $p_start = $this->input->post('start');
        $p_eventNote = $this->input->post('eventNote');
        $p_flag = $this->input->post('p_flag');
        $delParam = [
            '',
            $p_eventTitle,
            $p_start,
            $p_eventNote,
            $p_flag
        ];
        $result = $this->Calendar_model->DeleteEvent($delParam);

        echo json_encode($result);
    }

    function GetEventColor()
    {

        $p_color_id = $this->input->post('color_id');
        // $p_color_id = '';
        if (!empty($p_color_id) || $p_color_id = '') {
            $p_flag = 1;
        } else {
            $p_flag = 0;
        }
        $result = $this->Calendar_model->GetEventColor([$p_color_id, $p_flag]);

        echo json_encode($result);
    }
}
