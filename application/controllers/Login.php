<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Class : Login (LoginController)
 * Login class to control to authenticate user credentials and starts user's session.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Login extends CI_Controller
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        //  $this->load->model('login_model');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        $this->IsLoggedIn();
    }

    /**
     * This function used to check the user is logged in or not
     */
    function IsLoggedIn()
    {
        $IsLoggedIn = $this->session->userdata('IsLoggedIn');

        if (!isset($IsLoggedIn) || $IsLoggedIn != true) {
            $this->load->view('login');
        } else {
            redirect('/Dashboard');
        }
    }
}

?>
