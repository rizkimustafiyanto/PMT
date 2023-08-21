<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Card_log_controller extends CI_Controller
{
    public function insertCardLog($logMessage, $operation, $project_id, $card_id, $member_id)
    {
        #Header
        #Detail Member
        $card_log_id = '';
        // $member_id = $this->input->post('member_id');
        $member_id;
        $log = date('Y-m-d H:i:s') . ' [' . $operation . '] ' . $logMessage;
        $change_no = 0;
        $creation_user_id = $member_id;
        $change_user_id = $member_id;
        $record_status = 'A';
        $card_log_parameter = [
            $card_log_id,
            $card_id,
            $member_id,
            $log,
            $change_no,
            $creation_user_id,
            $change_user_id,
            $record_status,
        ];

        $result = $this->Card_log_model->Insert($card_log_parameter);

        if ($result > 0) {
            echo log("Sukses");
        } else {
        }
        redirect(base_url() . 'DetailProject/' . $project_id);
    }

    // function UpdateCardLog()
    // {
    //     #Header
    //     $project_id = $this->input->post('project_id');
    //     $board_id = $this->input->post('board_id');
    //     $list_id = $this->input->post('list_id');
    //     $card_id = $this->input->post('card_id');
    //     #Detail Member
    //     $card_log_id = $this->input->post('card_log_id');
    //     $member_id = $this->input->post('member_id');
    //     $log = $this->input->post('log');

    //     $record_status = 'A';
    //     $card_log_parameter = [
    //         $card_log_id,
    //         $card_id,
    //         $member_id,
    //         $log,
    //         $change_user_id,
    //         $record_status,
    //     ];

    //     $result = $this->Card_log_model->Update($card_log_parameter);

    //     if ($result > 0) {
    //         $this->session->set_flashdata(
    //             'success',
    //             'Update Card log created successfully !'
    //         );
    //     } else {
    //         $this->session->set_flashdata(
    //             'error',
    //             'Update card log creation failed !'
    //         );
    //     }
    //     redirect(
    //         base_url() .
    //             'DetailCard/' .
    //             $project_id .
    //             '/' .
    //             $board_id .
    //             '/' .
    //             $list_id .
    //             '/' .
    //             $card_id
    //     );
    // }

    // function DeleteCardLog(
    //     $project_id = '',
    //     $board_id = '',
    //     $list_id = '',
    //     $card_id = '',
    //     $card_log_id = ''
    // ) {
    //     $result = $this->Card_log_model->Delete($card_log_id);

    //     if ($result > 0) {
    //         $this->session->set_flashdata(
    //             'success',
    //             'Card member log has been deleted !'
    //         );
    //     } else {
    //         $this->session->set_flashdata(
    //             'error',
    //             'Card member log cannot deleted !'
    //         );
    //     }

    //     redirect(
    //         base_url() .
    //             'DetailCard/' .
    //             $project_id .
    //             '/' .
    //             $board_id .
    //             '/' .
    //             $list_id .
    //             '/' .
    //             $card_id
    //     );
    // }
}
