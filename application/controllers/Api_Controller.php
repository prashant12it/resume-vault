<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_Controller extends CI_Controller
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
        ini_set('max_input_time', 900);
        ini_set('max_execution_time', 900);
        $this->configUpload['upload_path'] = __FILE_UPLOAD_PATH__;
        $this->configUpload['allowed_types'] = 'jpg|png|jpeg|xls|xlsx|doc|docx|pdf|zip|mov|mp4|mp3';
        $this->configUpload['max_size'] = '10000000';
        $this->configUpload['encrypt_name'] = TRUE;
    }

    public function index()
    {
        $responsedata = array("code" => 200, "response" => 'Welcome to Resume Analyst.');
        header('Content-Type: application/json');
        echo json_encode($responsedata);
    }

    function generateRandomString($length = 4)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function valid_password($password = '')
    {
        $password = trim($password);
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

    function delete_analyst(){
        $analystID = $this->input->post('analystID');
        $this->form_validation->set_rules('analystID', 'Analyst', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $errMsg = 'Invalid request';
            $this->session->set_userdata('errorMsg', $errMsg);
            $responseData = array("code" => 400, "response" => 'ERROR', 'message' => $errMsg);
        } else {
            if ($this->Common_Model->deleteRecord(__DBC_SCHEMATA_USERS__, array('id' => $analystID))) {
                $successMsg = 'Resume analyst deleted successfully.';
                $this->session->set_userdata('successMsg', $successMsg);
                $responseData = array("code" => 200, "response" => 'SUCCESS', 'message' => $successMsg);
            } else {
                $errMsg = 'Something goes wrong.Please try again.';
                $this->session->set_userdata('errorMsg', $errMsg);
                $responseData = array("code" => 201, "response" => 'ERROR', 'message' => $errMsg);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }
    function delete_role(){
        $roleID = $this->input->post('roleID');
        $this->form_validation->set_rules('roleID', 'Role', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $errMsg = 'Invalid request';
            $this->session->set_userdata('errorMsg', $errMsg);
            $responseData = array("code" => 400, "response" => 'ERROR', 'message' => $errMsg);
        } else {
            if ($this->Common_Model->deleteRecord(__DBC_SCHEMATA_JOB_ROLE__, array('id' => $roleID))) {
                $successMsg = 'Job Role deleted successfully.';
                $this->session->set_userdata('successMsg', $successMsg);
                $responseData = array("code" => 200, "response" => 'SUCCESS', 'message' => $successMsg);
            } else {
                $errMsg = 'Something goes wrong.Please try again.';
                $this->session->set_userdata('errorMsg', $errMsg);
                $responseData = array("code" => 201, "response" => 'ERROR', 'message' => $errMsg);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }
    function delete_candidate(){
        $candidateID = $this->input->post('candidateID');
        $this->form_validation->set_rules('candidateID', 'Candidate', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $errMsg = 'Invalid request';
            $this->session->set_userdata('errorMsg', $errMsg);
            $responseData = array("code" => 400, "response" => 'ERROR', 'message' => $errMsg);
        } else {
            if ($this->Common_Model->deleteRecord(__DBC_SCHEMATA_CANDIDATE_PROFILE__, array('id' => $candidateID))) {
                $successMsg = 'Candidate profile deleted successfully.';
                $this->session->set_userdata('successMsg', $successMsg);
                $responseData = array("code" => 200, "response" => 'SUCCESS', 'message' => $successMsg);
            } else {
                $errMsg = 'Something goes wrong.Please try again.';
                $this->session->set_userdata('errorMsg', $errMsg);
                $responseData = array("code" => 201, "response" => 'ERROR', 'message' => $errMsg);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }

    function analyst_active_inactive(){
        $id = $this->input->post('analystID');
        $isActive = $this->input->post('is_active');
        $this->form_validation->set_rules('analystID', 'Analyst', 'trim|required');
        $this->form_validation->set_rules('is_active', 'Active/Inactive', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $responseData = array("code" => 400, "response" => 'ERROR', 'message' => $this->form_validation->error_array());
        } else {
            if ($this->Common_Model->updateData(__DBC_SCHEMATA_USERS__, array('is_active' => $isActive),array('id' => $id))) {
                $successMsg = 'Resume analyst '.($isActive == 1?'activated':'deactivated').' successfully.';
                $responseData = array("code" => 200, "response" => 'SUCCESS', 'message' => $successMsg);
            } else {
                $errMsg = 'Something goes wrong.Please try again.';
                $responseData = array("code" => 201, "response" => 'ERROR', 'message' => $errMsg);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }

    function role_active_inactive(){
        $id = $this->input->post('roleID');
        $isActive = $this->input->post('is_active');
        $this->form_validation->set_rules('roleID', 'Job Role', 'trim|required');
        $this->form_validation->set_rules('is_active', 'Active/Inactive', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $responseData = array("code" => 400, "response" => 'ERROR', 'message' => $this->form_validation->error_array());
        } else {
            if ($this->Common_Model->updateData(__DBC_SCHEMATA_JOB_ROLE__, array('is_active' => $isActive),array('id' => $id))) {
                $successMsg = 'Job Role '.($isActive == 1?'activated':'deactivated').' successfully.';
                $responseData = array("code" => 200, "response" => 'SUCCESS', 'message' => $successMsg);
            } else {
                $errMsg = 'Something goes wrong.Please try again.';
                $responseData = array("code" => 201, "response" => 'ERROR', 'message' => $errMsg);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }

    function candidate_active_inactive(){
        $id = $this->input->post('candidateID');
        $isActive = $this->input->post('is_active');
        $this->form_validation->set_rules('candidateID', 'Candidate', 'trim|required');
        $this->form_validation->set_rules('is_active', 'Active/Inactive', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $responseData = array("code" => 400, "response" => 'ERROR', 'message' => $this->form_validation->error_array());
        } else {
            if ($this->Common_Model->updateData(__DBC_SCHEMATA_CANDIDATE_PROFILE__, array('is_active' => $isActive),array('id' => $id))) {
                $successMsg = 'Candidate profile '.($isActive == 1?'activated':'deactivated').' successfully.';
                $responseData = array("code" => 200, "response" => 'SUCCESS', 'message' => $successMsg);
            } else {
                $errMsg = 'Something goes wrong.Please try again.';
                $responseData = array("code" => 201, "response" => 'ERROR', 'message' => $errMsg);
            }
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }

    function upload_image(){
        $folderPath = __FILE_UPLOAD_PATH__;
        $profilePic = $this->input->post('image');
        $image_parts = explode(";base64,", $profilePic);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;

        file_put_contents($file, $image_base64);
        if(CheckFileUploaded($fileName)){
            $responseData = array("code" => 200, "response" => 'SUCCESS', 'Filename'=>$fileName, 'message' => 'Uploaded successfully');
        }else{
            $responseData = array("code" => 201, "response" => 'ERROR', 'message' => 'Something goes wrong.Please try again.');
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }
}
