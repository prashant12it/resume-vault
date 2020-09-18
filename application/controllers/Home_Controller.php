<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_Controller extends CI_Controller
{
    var $configUpload;

    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Authorization');
        header("Access-Control-Allow-Methods: GET, POST");
        parent::__construct();
        $this->load->model('Common_Model');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('pagination');
    }

    public function index()
    {
        $data['success'] = false;
        $data['error'] = false;
        $data['successMsg'] = '';
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Welcome";
        $data['pageName'] = "Home";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        if ($data['role'] == 1) {
            redirect(__BASE_URL__ . '/admin/resume_analysts');
        } elseif ($data['role'] == 2) {
            redirect(__BASE_URL__ . '/job_roles');
        } else {
            if ($this->session->userdata('SuccessMsg')) {
                $data['successMsg'] = $this->session->userdata('SuccessMsg');
                $this->session->unset_userdata('SuccessMsg');
            }

            if ($this->session->userdata('ErrMsg')) {
                $data['errorMsg'] = $this->session->userdata('ErrMsg');
                $this->session->unset_userdata('ErrMsg');
            }
            $data['shop'] = (isset($_GET['shop']) && !empty($_GET['shop']) ? $_GET['shop'] : '');
            $data['app'] = (isset($_GET['app']) && !empty($_GET['app']) ? $_GET['app'] : '');
            /*$data['charge_id'] = (isset($_GET['charge_id']) && !empty($_GET['charge_id']) ? $_GET['charge_id'] : '');

            $this->Common_Model->updateData(__DBC_SCHEMATA_SHOPIFY_TOKENS_REV__, array('charge_id'=>$data['charge_id']),array('shop'=>$data['shop']));*/
            $this->load->view('layout/header', $data);
            $this->load->view('home');
            $this->load->view('layout/footer');
        }
    }

    public function valid_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#\$%\^\*]/';
        if (empty($password)) {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }
        if (strlen($password) < 8) {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 8 characters in length.');
            return FALSE;
        }
        if (strlen($password) > 50) {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 50 characters in length.');
            return FALSE;
        }
        return TRUE;
    }
    function logout()
    {
        if (!$this->session->userdata('user')) {
            redirect(__BASE_URL__);
        } else {
            $this->session->unset_userdata('user');
            $this->session->unset_userdata('userrole');
            $this->session->sess_destroy();
            redirect(__BASE_URL__);
        }
    }
    function analyst_login()
    {
        $data['success'] = false;
        $data['error'] = false;
        $data['successMsg'] = '';
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Analyst Login";
        $data['pageName'] = "AnalystLogin";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        if ($data['role'] && $data['role'] > 0 && $data['role'] != 2) {
            redirect(__BASE_URL__.'/logout');
        } elseif ($data['role'] && $data['role'] > 0 && $data['role'] == 2) {
            redirect(__BASE_URL__ . '/job_roles');
        } else {
            $this->load->view('layout/admin-header', $data);
            $this->load->view('admin/login');
            $this->load->view('layout/admin-footer');
        }
    }
    function login()
    {
        $data['success'] = false;
        $data['error'] = false;
        $error = false;
        $data['successMsg'] = '';
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Analyst Login";
        $data['pageName'] = "AnalystLogin";
        $data['subpageName'] = "AnalystLogin";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        $data['emailid'] = $this->input->post('login');
        $data['password'] = $this->input->post('password');
        $this->form_validation->set_rules('login', 'Email ID', 'trim|required|min_length[7]|max_length[255]|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'callback_valid_password');
        if ($this->form_validation->run() == FALSE) {
            $error = true;
        } else {
            $checkUserExistArr = $this->Common_Model->getCompleteData(__DBC_SCHEMATA_USERS__,array('email'=>$data['emailid']));

            if (!empty($checkUserExistArr) && $checkUserExistArr[0]['user_role'] == 2 && $checkUserExistArr[0]['is_active'] == 1) {
                $storedPassword = $checkUserExistArr[0]['password'];
                if ($this->bcrypt->check_password($data['password'], $storedPassword)) {
                    $this->session->set_userdata('user', $checkUserExistArr[0]['id']);
                    $this->session->set_userdata('userrole', $checkUserExistArr[0]['user_role']);
                    redirect(__BASE_URL__ . '/job_roles');
                } else {
                    $error = true;
                }
            } else {
                $error = true;
            }
        }

        if ($error) {
            $data['errorMsg'] = 'Invalid Login ID or Password.';
            $this->load->view('layout/admin-header', $data);
            $this->load->view('admin/login');
            $this->load->view('layout/admin-footer');
        }
    }
}
