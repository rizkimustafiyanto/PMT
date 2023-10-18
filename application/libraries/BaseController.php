<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class : BaseController
 * Base Class to control over all the classes
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class BaseController extends CI_Controller
{
    protected $role_id = '';
    protected $user_id = '';
    protected $user_name = '';
    protected $role_name = '';
    protected $global = [];

    /**
     * Takes mixed data and optionally a status code, then creates the response
     *
     * @access public
     * @param array|NULL $data
     *        	Data to output to the user
     *        	running the script; otherwise, exit
     */
    public function response($data = null)
    {
        $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(
                json_encode(
                    $data,
                    JSON_PRETTY_PRINT |
                        JSON_UNESCAPED_UNICODE |
                        JSON_UNESCAPED_SLASHES
                )
            )
            ->_display();
        exit();
    }

    /**
     * This function used to check the user is logged in or not
     */
    function IsLoggedIn()
    {
        $IsLoggedIn = $this->session->userdata('IsLoggedIn');

        if (!isset($IsLoggedIn) || $IsLoggedIn != true) {
            redirect('login');
        } else {
            $this->role_id = $this->session->userdata('role_id');
            $this->user_id = $this->session->userdata('user_id');
            $this->user_name = $this->session->userdata('user_name');
            $this->role_name = $this->session->userdata('role_name');

            $this->global['user_name'] = $this->user_name;
            $this->global['role_id'] = $this->role_id;
            $this->global['role_name'] = $this->role_name;

            $this->webSiteActive();
        }
    }

    /**
     * This function is used to check the access
     */
    function webSiteActive()
    {
        $userID = $this->session->userdata('user_id');
        $memberID = $this->session->userdata('member_id');
        if ($memberID != 'System' && $userID != 'System') {
            $this->load->model('maintenance/maintenance_model');
            $getting_maintenance = $this->maintenance_model->Get(['', 2]);
            $statusWebsite = '';
            if (!empty($getting_maintenance)) {
                foreach ($getting_maintenance as $key) {
                    $statusWebsite = $key->status_down;
                }
            }
            if ($statusWebsite == '1') {
                redirect('MaintenanceView');
            }
        }
    }
    function isAdmin()
    {
        if ($this->role_id != ROLE_ADMIN) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to check the access
     */
    function isTicketter()
    {
        if ($this->role_id != ROLE_ADMIN || $this->role_id != ROLE_MANAGER) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function is used to load the set of views
     */
    function loadThis()
    {
        $this->global['pageTitle'] = 'CodeInsect : Access Denied';

        $this->load->view('includes/header', $this->global);
        $this->load->view('access');
        $this->load->view('includes/footer');
    }

    /**
     * This function is used to logged out user from system
     */
    function logout()
    {
        $this->session->sess_destroy();

        redirect('../home/login');
    }

    /**
     * This function used to load views
     * @param {string} $viewName : This is view name
     * @param {mixed} $headerInfo : This is array of header information
     * @param {mixed} $pageInfo : This is array of page information
     * @param {mixed} $footerInfo : This is array of footer information
     * @return {null} $result : null
     */
    function loadViews(
        $viewName = '',
        $headerInfo = null,
        $pageInfo = null,
        $footerInfo = null
    ) {
        // // Memuat controller yang ingin dipanggil
        // $this->load->controller('');
        // // Memanggil fungsi pada controller tersebut
        // $this->controller_name->method_name();
        $this->load->model('messages/Messages_model');

        $this->load->view('includes/header', $headerInfo);
        $this->load->view($viewName, $pageInfo);
        $this->load->view('includes/footer', $footerInfo);
    }

    /**
     * This function used provide the pagination resources
     * @param {string} $link : This is page link
     * @param {number} $count : This is page count
     * @param {number} $perPage : This is records per page limit
     * @return {mixed} $result : This is array of records and pagination data
     */
    function paginationCompress($link, $count, $perPage = 10)
    {
        $this->load->library('pagination');

        $config['base_url'] = base_url() . $link;
        $config['total_rows'] = $count;
        $config['uri_segment'] = SEGMENT;
        $config['per_page'] = $perPage;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_tag_open'] = '<li class="arrow">';
        $config['first_link'] = 'First';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = 'Previous';
        $config['prev_tag_open'] = '<li class="arrow">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li class="arrow">';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="arrow">';
        $config['last_link'] = 'Last';
        $config['last_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $page = $config['per_page'];
        $segment = $this->uri->segment(SEGMENT);

        return [
            'page' => $page,
            'segment' => $segment,
        ];
    }
}
