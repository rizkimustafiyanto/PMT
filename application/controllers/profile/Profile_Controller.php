<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

class Profile_Controller extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/member_model');
        $this->IsLoggedIn();
        $this->webSiteActive();
    }

    public function index()
    {
        $memberID = $this->session->userdata('member_id');
        $data['profiles'] = $this->member_model->Get([$memberID, 1]);

        $this->global['pageTitle'] = 'CodeInsect : Project';
        $this->loadViews('profile/profile', $this->global, $data, null);
    }
}
