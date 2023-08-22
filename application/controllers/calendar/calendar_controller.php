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

        $this->IsLoggedIn();
    }

    function index()
    {


        $this->global['pageTitle'] = 'CodeInsect : List Events';
        $this->loadViews('calendar/calendar', $this->global, null, null);
    }

    function GetEvent()
    {

        $result = $this->Calendar_model->GetEvent([0, 0]);
        $events = array();
        foreach ($result as $key) {
            $event = array(
                "id" => $key->id,
                "title" => $key->title,
                "start" => $key->start_date,
                "end" => $key->end_date,
                "colorId" => $key->color_id,
                "backgroundColor" => $key->background_color,
                "borderColor" => $key->border_color,
                "allDay" => (bool)$key->all_day

            );
            array_push($events, $event);
        }
        echo json_encode($events);
    }
    function GetExternalEvent()
    {
        $result = $this->Calendar_model->GetEventExternal([0, 0]);
        $events = array();
        foreach ($result as $key) {
            $event = array(
                "ex_id" => $key->id,
                "title" => $key->title,
                "colorId" => $key->color_id,
                "backgroundColor" => $key->background_color,
                "borderColor" => $key->border_color,
                "colorId" => $key->color_id
            );
            array_push($events, $event);
        }
        echo json_encode($events);
    }

    function DeleteEvent()
    {
        $p_event_id = $this->input->post('event_id');
        $result = $this->Calendar_model->DeleteEvent([$p_event_id]);

        echo json_encode($result);
    }

    public function UpdateEvent()
    {
        $p_eventID = $this->input->post("event_id");
        $p_title = $this->input->post("title");
        $p_start_date = $this->input->post("start_date");
        $p_end_date = $this->input->post("end_date");
        $p_all_day = $this->input->post("all_day");
        $p_color_id = $this->input->post("color_id");
        $p_flag = $this->input->post("flag");

        $updateEvent = [
            'p_id' => $p_eventID,
            'p_title' => $p_title,
            'p_start_date' => $p_start_date,
            'p_end_date' => $p_end_date,
            'p_all_day' => $p_all_day,
            'p_color_id' => $p_color_id,
            'p_flag' => $p_flag,
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

    function AddEventColor()
    {
        $eventTitle = $this->input->post("eventTitle");
        $backgroundColor = $this->input->post("backgroundColor");
        $borderColor = $this->input->post("borderColor");

        $addColors = [
            'background_color' => $backgroundColor,
            'border_color' => $borderColor,
        ];

        // Panggil model Anda untuk melakukan operasi INSERT
        $result = $this->Messages_model->InsertEventColor($addColors);

        if ($result) {
            // Gunakan response JSON untuk memberikan feedback ke frontend
            $response = array(
                'success' => true,
                'message' => 'New event color created successfully'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'New event color creation failed'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function UpdateEventColor()
    {
        $eventTitle = $this->input->post("eventTitle");
        $backgroundColor = $this->input->post("backgroundColor");
        $borderColor = $this->input->post("borderColor");

        $addColors = [
            'background_color' => $backgroundColor,
            'border_color' => $borderColor,
        ];

        // Panggil model Anda untuk melakukan operasi INSERT
        $result = $this->Messages_model->UpdateEventColor($addColors);

        if ($result) {
            // Gunakan response JSON untuk memberikan feedback ke frontend
            $response = array(
                'success' => true,
                'message' => 'New event color created successfully'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'New event color creation failed'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    function DeleteExternalEvent()
    {
        $p_event_id = $this->input->post('event_id');
        $result = $this->Calendar_model->DeleteEventExternal([$p_event_id, 0, 0]);

        $response = array(
            'success' => $result, // Menyimpan status berhasil atau tidak
            'message' => $result ? 'Hapus ' . $p_event_id . ' berhasil' : 'Gagal hapus acara'
        );

        echo json_encode($response);
    }

    function AddEvent()
    {
        $eventTitle = $this->input->post("title");
        $backgroundColor = $this->input->post("color");
        $borderColor = $this->input->post("color");
        $startDate = $this->input->post("start");
        $endDate = $this->input->post("end");
        $allDay = $this->input->post("allDay");

        $addEvent = [
            'p_title' => $eventTitle,
            'p_start_date' => $startDate,
            'p_end_date' => $endDate,
            'p_all_day' => $allDay,
            'p_background_color' => $backgroundColor,
            'p_border_color' => $borderColor,
            'p_color_id' => '',
        ];

        $result = $this->Calendar_model->InsertEvent($addEvent);

        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Acara baru berhasil dibuat'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Acara baru gagal dibuat'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    function AddExternalEvent()
    {
        $eventTitle = $this->input->post("eventTitle");
        $backgroundColor = $this->input->post("background_color");
        $borderColor = $this->input->post("border_color");

        $addExternalEvent = [
            'p_title' => $eventTitle,
            'background_color' => $backgroundColor,
            'border_color' => $borderColor,
            'color_id' => '',
        ];

        $result = $this->Calendar_model->InsertEventExternal($addExternalEvent);

        if ($result) {
            $response = array(
                'success' => true,
                'message' => 'Warna acara baru berhasil dibuat'
            );
        } else {
            $response = array(
                'success' => false,
                'message' => 'Pembuatan warna acara baru gagal'
            );
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
