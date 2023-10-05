<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : User (UserController)
 * User Class to control all user related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Dashboard extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('transaction/project/project_model');
        $this->load->model('transaction/task/task_model');
        $this->load->model('user_model');
        $this->load->model('login_model');
        $this->IsLoggedIn();
    }

    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $data = $this->dataDash();

        $this->global['pageTitle'] = 'CodeInsect : Dashboard';
        $this->loadViews('dashboard', $this->global, $data, null);
    }

    public function cekRole()
    {
        // $result = $this->login_model->Login($user_account, $password);

        $cek_role_parameter = [
            'p_user_account' => $this->session->userdata('user_id'),
            'p_password' => '',
        ];
        $result = $this->login_model->cekRole($cek_role_parameter);

        if ($result > 0) {
            foreach ($result as $res) {
                $sessionArray = [
                    'member_id' => $res->member_id,
                    'member_name' => $res->member_name,
                    'role_id' => $res->role_id,
                    'role_name' => $res->role_name,
                    'gender_id' => $res->gender_id,
                    'company_id' => $res->company_id,
                    'division_id' => $res->division_id,
                    'department_id' => $res->department_id,
                    'photo_url' => $res->photo_url,
                    'company_brand_id' => $res->company_brand_id,
                    'IsLoggedIn' => true,
                ];
            }

            $this->session->set_userdata($sessionArray);

            redirect('/Dashboard');
        } else {
            redirect('../home/Dashboard');
        }
    }

    public function Home()
    {
        redirect('../home/Dashboard');
    }

    //batas

    /**
     * This function is used to load the user list
     */
    function userListing()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('user_model');

            $searchText = $this->input->post('searchText');
            $data['searchText'] = $searchText;
            $this->load->library('pagination');
            $count = $this->user_model->userListingCount($searchText);
            $returns = $this->paginationCompress('userListing/', $count, 5);
            $data['userRecords'] = $this->user_model->userListing(
                $searchText,
                $returns['page'],
                $returns['segment']
            );
            $this->global['pageTitle'] = 'CodeInsect : User Listing';
            $this->loadViews('users', $this->global, $data, null);
        }
    }

    /**
     * This function is used to load the add new form
     */
    function addNew()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();

            $this->global['pageTitle'] = 'CodeInsect : Add New User';

            $this->loadViews('addNew', $this->global, $data, null);
        }
    }

    /**
     * This function is used to check whether email already exist or not
     */
    function checkEmailExists()
    {
        $userId = $this->input->post('userId');
        $email = $this->input->post('email');

        if (empty($userId)) {
            $result = $this->user_model->checkEmailExists($email);
        } else {
            $result = $this->user_model->checkEmailExists($email, $userId);
        }

        if (empty($result)) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    /**
     * This function is used to add new user to the system
     */
    function addNewUser()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $this->form_validation->set_rules(
                'fname',
                'Full Name',
                'trim|required|max_length[128]|xss_clean'
            );
            $this->form_validation->set_rules(
                'email',
                'Email',
                'trim|required|valid_email|xss_clean|max_length[128]'
            );
            $this->form_validation->set_rules(
                'password',
                'Password',
                'required|max_length[20]'
            );
            $this->form_validation->set_rules(
                'cpassword',
                'Confirm Password',
                'trim|required|matches[password]|max_length[20]'
            );
            $this->form_validation->set_rules(
                'role',
                'Role',
                'trim|required|numeric'
            );
            $this->form_validation->set_rules(
                'mobile',
                'Mobile Number',
                'required|min_length[10]|xss_clean'
            );

            if ($this->form_validation->run() == false) {
                $this->addNew();
            } else {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $role_idId = $this->input->post('role');
                $mobile = $this->input->post('mobile');

                $userInfo = [
                    'email' => $email,
                    'password' => getHashedPassword($password),
                    'roleId' => $role_idId,
                    'name' => $name,
                    'mobile' => $mobile,
                    'createdBy' => $this->user_id,
                    'createdDtm' => date('Y-m-d H:i:s'),
                ];

                $this->load->model('user_model');
                $result = $this->user_model->addNewUser($userInfo);

                if ($result > 0) {
                    $this->session->set_flashdata(
                        'success',
                        'New User created successfully'
                    );
                } else {
                    $this->session->set_flashdata(
                        'error',
                        'User creation failed'
                    );
                }

                redirect('addNew');
            }
        }
    }

    /**
     * This function is used load user edit information
     * @param number $userId : Optional : This is user id
     */
    function editOld($userId = null)
    {
        if ($this->isAdmin() == true || $userId == 1) {
            $this->loadThis();
        } else {
            if ($userId == null) {
                redirect('userListing');
            }

            $data['roles'] = $this->user_model->getUserRoles();
            $data['userInfo'] = $this->user_model->getUserInfo($userId);

            $this->global['pageTitle'] = 'CodeInsect : Edit User';

            $this->loadViews('editOld', $this->global, $data, null);
        }
    }

    /**
     * This function is used to edit the user information
     */
    function editUser()
    {
        if ($this->isAdmin() == true) {
            $this->loadThis();
        } else {
            $this->load->library('form_validation');

            $userId = $this->input->post('userId');

            $this->form_validation->set_rules(
                'fname',
                'Full Name',
                'trim|required|max_length[128]|xss_clean'
            );
            $this->form_validation->set_rules(
                'email',
                'Email',
                'trim|required|valid_email|xss_clean|max_length[128]'
            );
            $this->form_validation->set_rules(
                'password',
                'Password',
                'matches[cpassword]|max_length[20]'
            );
            $this->form_validation->set_rules(
                'cpassword',
                'Confirm Password',
                'matches[password]|max_length[20]'
            );
            $this->form_validation->set_rules(
                'role',
                'Role',
                'trim|required|numeric'
            );
            $this->form_validation->set_rules(
                'mobile',
                'Mobile Number',
                'required|min_length[10]|xss_clean'
            );

            if ($this->form_validation->run() == false) {
                $this->editOld($userId);
            } else {
                $name = ucwords(strtolower($this->input->post('fname')));
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $role_idId = $this->input->post('role');
                $mobile = $this->input->post('mobile');

                $userInfo = [];

                if (empty($password)) {
                    $userInfo = [
                        'email' => $email,
                        'roleId' => $role_idId,
                        'name' => $name,
                        'mobile' => $mobile,
                        'updatedBy' => $this->user_id,
                        'updatedDtm' => date('Y-m-d H:i:s'),
                    ];
                } else {
                    $userInfo = [
                        'email' => $email,
                        'password' => getHashedPassword($password),
                        'roleId' => $role_idId,
                        'name' => ucwords($name),
                        'mobile' => $mobile,
                        'updatedBy' => $this->user_id,
                        'updatedDtm' => date('Y-m-d H:i:s'),
                    ];
                }

                $result = $this->user_model->editUser($userInfo, $userId);

                if ($result == true) {
                    $this->session->set_flashdata(
                        'success',
                        'User updated successfully'
                    );
                } else {
                    $this->session->set_flashdata(
                        'error',
                        'User updation failed'
                    );
                }

                redirect('userListing');
            }
        }
    }

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser()
    {
        if ($this->isAdmin() == true) {
            echo json_encode(['status' => 'access']);
        } else {
            $userId = $this->input->post('userId');
            $userInfo = [
                'isDeleted' => 1,
                'updatedBy' => $this->user_id,
                'updatedDtm' => date('Y-m-d H:i:s'),
            ];

            $result = $this->user_model->deleteUser($userId, $userInfo);

            if ($result > 0) {
                echo json_encode(['status' => true]);
            } else {
                echo json_encode(['status' => false]);
            }
        }
    }

    /**
     * This function is used to load the change password screen
     */
    function loadChangePass()
    {
        $this->global['pageTitle'] = 'CodeInsect : Change Password';

        $this->loadViews('changePassword', $this->global, null, null);
    }

    /**
     * This function is used to change the password of the user
     */
    function changePassword()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules(
            'oldPassword',
            'Old password',
            'required|max_length[20]'
        );
        $this->form_validation->set_rules(
            'newPassword',
            'New password',
            'required|max_length[20]'
        );
        $this->form_validation->set_rules(
            'cNewPassword',
            'Confirm new password',
            'required|matches[newPassword]|max_length[20]'
        );

        if ($this->form_validation->run() == false) {
            $this->loadChangePass();
        } else {
            $oldPassword = $this->input->post('oldPassword');
            $newPassword = $this->input->post('newPassword');

            $resultPas = $this->user_model->matchOldPassword(
                $this->user_id,
                $oldPassword
            );

            if (empty($resultPas)) {
                $this->session->set_flashdata(
                    'nomatch',
                    'Your old password not correct'
                );
                redirect('loadChangePass');
            } else {
                $usersData = [
                    'password' => getHashedPassword($newPassword),
                    'updatedBy' => $this->user_id,
                    'updatedDtm' => date('Y-m-d H:i:s'),
                ];

                $result = $this->user_model->changePassword(
                    $this->user_id,
                    $usersData
                );

                if ($result > 0) {
                    $this->session->set_flashdata(
                        'success',
                        'Password updation successful'
                    );
                } else {
                    $this->session->set_flashdata(
                        'error',
                        'Password updation failed'
                    );
                }

                redirect('loadChangePass');
            }
        }
    }

    function pageNotFound()
    {
        $this->global['pageTitle'] = 'CodeInsect : 404 - Page Not Found';

        $this->loadViews('404', $this->global, null, null);
    }

    public function dataDash()
    {
        $memberID = $this->session->userdata('member_id');
        // ambil data project
        $totalProject = '0';
        $doneProject = '0';
        $processProject = '0';
        $stuckProject = '0';
        $dashboardBox = [0, 0, ($memberID == 'System') ? 5 : 4, $memberID];
        $Countable = $this->project_model->Get($dashboardBox);

        if (!empty($Countable)) {
            foreach ($Countable as $key) {
                $totalProject = $key->tot_project;
                $doneProject =   $key->percentage_done;
                $processProject = $key->percentage_process;
                $stuckProject =  $key->percentage_stuck;
            }
        }

        #AMBIL
        #==================================================================================
        $data['MyTask'] = $this->task_model->Get(['', '', '', '', $memberID, 4]);
        $data['MyProject'] = $this->project_model->Get(['', '', 0, $memberID]);

        #AMBIL TOOLS
        #==================================================================================
        $data['totalProject'] = $totalProject;
        $data['doneProject'] = $doneProject;
        $data['processProject'] = $processProject;
        $data['stuckProject'] = $stuckProject;
        $data['dashboardBox'] = $dashboardBox;

        return $data;
    }
}
