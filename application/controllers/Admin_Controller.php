<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Controller extends CI_Controller
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
        $this->load->helper('file');
        $this->load->library('pagination');
        $this->load->library('email');
    }

    public function index()
    {
        $data['success'] = false;
        $data['error'] = false;
        $data['successMsg'] = '';
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Admin Login";
        $data['pageName'] = "Admin";
        $data['subpageName'] = "Admin";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        if ($data['role'] && $data['role'] > 0 && $data['role'] != 1) {
            redirect(__BASE_URL__ . '/logout');
        } elseif ($data['role'] && $data['role'] > 0 && $data['role'] == 1) {
            redirect(__BASE_URL__ . '/admin/resume_analysts');
        } else {
            $this->load->view('layout/admin-header', $data);
            $this->load->view('admin/login');
            $this->load->view('layout/admin-footer');
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
        /*if (preg_match_all($regex_lowercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^*'));
            return FALSE;
        }*/
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

    function add_new_analyst()
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Add Resume Analyst";
        $data['pageName'] = "AdminDashboard";
        $data['subpageName'] = "AddResumeAnalyst";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();

        if ($data['loggedInUser'] && $data['role'] == 1) {
            if (isset($_POST) && !empty($_POST)) {
                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['is_active'] = $this->input->post('is_active');
                $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[150]');
                $this->form_validation->set_rules('email', 'Email ID', 'trim|required|min_length[7]|max_length[255]|valid_email');
                $this->form_validation->set_rules('is_active', 'Active/Inactive', 'trim');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('layout/admin-header', $data);
                    $this->load->view('admin/new_analyst');
                    $this->load->view('layout/admin-footer');
                } else {
                    $password = generateRandomKey(8);
                    $encryptedPassword = $this->bcrypt->hash_password($password);
                    $insertArr = array(
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => $encryptedPassword,
                        'user_role' => 2,
                        'is_active' => (isset($data['is_active']) && !empty($data['is_active']) ? $data['is_active'] : 0)
                    );
                    $analystID = $this->Common_Model->insertData(__DBC_SCHEMATA_USERS__, $insertArr);
                    if ($analystID > 0) {
                        $this->email->from(__SUPPORT_MAIL__, __SITE_NAME__);
                        $this->email->to($data['email']);
                        $mailSubject = __SITE_NAME__ . ' | Resume Analyst Registration';
                        $this->email->subject($mailSubject);
                        $Htmlmessage = '<!DOCTYPE html>
                                    <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                                    <head>
                                        <meta charset="utf-8"> 
                                        <meta name="viewport" content="width=device-width">
                                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                        <meta name="x-apple-disable-message-reformatting">
                                        <title>' . $mailSubject . '</title>
                                    </head><body>
                                    <h2>Congratulations! You have been added as a Resume Analyst on ' . __SITE_NAME__ . '.</h2> <hr />
                                    <h4>Following are your login credentials.</h4>
                                    <h4>Login Email ID: ' . $data['email'] . '</h4>
                                    <h4>Password: ' . $password . '</h4>
                                    <p><a href="' . __BASE_URL__ . '/analyst_login" target="_blank">Click here</a> to login to your account. </p>
                                    </body></html>';
                        $this->email->message($Htmlmessage);
                        $this->email->set_mailtype('html');
                        if ($this->email->send()) {
                            $mailLog = array(
                                'sent_from' => __SUPPORT_MAIL__,
                                'sent_to' => $data['email'],
                                'subject' => $mailSubject,
                                'message_body' => $Htmlmessage,
                                'sent_on' => date('Y-m-d H:i:s')
                            );
                            $this->Common_Model->insertData(__DBC_SCHEMATA_EMAIL_LOG__, $mailLog);
                        }
                        $this->session->set_userdata('successMsg', 'Resume analyst added successfully.');
                        redirect(__BASE_URL__ . '/admin/resume_analysts');
                    } else {
                        $data['errorMsg'] = 'Something goes wrong while adding new analyst.';
                        $this->load->view('layout/admin-header', $data);
                        $this->load->view('admin/new_analyst');
                        $this->load->view('layout/admin-footer');
                    }
                }
            } else {
                $this->load->view('layout/admin-header', $data);
                $this->load->view('admin/new_analyst');
                $this->load->view('layout/admin-footer');
            }
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function add_job_role()
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Add Job Role";
        $data['pageName'] = "JobRoles";
        $data['subpageName'] = "AddJobRoles";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();

        if ($data['loggedInUser'] && $data['role'] == 1) {
            if (isset($_POST) && !empty($_POST)) {
                $data['name'] = $this->input->post('name');
                $data['description'] = $this->input->post('description');
                $data['tags'] = $this->input->post('searchTags');
                $data['profile_pic'] = $this->input->post('uploadedImage');
                $data['is_active'] = $this->input->post('is_active');
                $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[150]');
                $this->form_validation->set_rules('description', 'Description', 'trim|max_length[500]');
                $this->form_validation->set_rules('searchTags', 'Search Tags', 'trim');
                $this->form_validation->set_rules('uploadedImage', 'Candidate Photo', 'trim');
                $this->form_validation->set_rules('is_active', 'Active/Inactive', 'trim');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('layout/admin-header', $data);
                    $this->load->view('admin/new_job_role');
                    $this->load->view('layout/admin-footer');
                } else {
                    $tagString = '';
                    if (!empty($data['tags'])) {
                        foreach ($data['tags'] as $key => $tag) {
                            if ($key == 0) {
                                $tagString = $tag;
                            } else {
                                $tagString = $tagString . ', ' . $tag;
                            }
                        }
                    }
                    $insertArr = array(
                        'name' => $data['name'],
                        'description' => $data['description'],
                        'tags' => $tagString,
                        'profile_pic' => $data['profile_pic'],
                        'is_active' => (isset($data['is_active']) && !empty($data['is_active']) ? $data['is_active'] : 0)
                    );
                    $jobRoleId = $this->Common_Model->insertData(__DBC_SCHEMATA_JOB_ROLE__, $insertArr);
                    if ($jobRoleId > 0) {
                        $this->session->set_userdata('successMsg', 'Job role added successfully.');
                        redirect(__BASE_URL__ . '/job_roles');
                    } else {
                        $data['errorMsg'] = 'Something goes wrong while adding job role.';
                        $this->load->view('layout/admin-header', $data);
                        $this->load->view('admin/new_job_role');
                        $this->load->view('layout/admin-footer');
                    }
                }
            } else {
                $this->load->view('layout/admin-header', $data);
                $this->load->view('admin/new_job_role');
                $this->load->view('layout/admin-footer');
            }
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function edit_job_roles($roleID)
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Update Job Role";
        $data['pageName'] = "JobRoles";
        $data['subpageName'] = "UpdateJobRoles";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        $data['roleID'] = $roleID;

        if ($data['loggedInUser'] && ($data['role'] == 1 || $data['role'] == 2)) {
            $data['roleArr'] = $this->Common_Model->getCompleteData(__DBC_SCHEMATA_JOB_ROLE__, array('id' => $roleID));
            if (!empty($data['roleArr'])) {
                if (isset($_POST) && !empty($_POST)) {
                    $data['name'] = $this->input->post('name');
                    $data['description'] = $this->input->post('description');
                    $data['tags'] = $this->input->post('searchTags');
                    $data['profile_pic'] = $this->input->post('uploadedImage');
                    $data['is_active'] = $this->input->post('is_active');
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[150]');
                    $this->form_validation->set_rules('description', 'Description', 'trim|max_length[500]');
                    $this->form_validation->set_rules('searchTags', 'Search Tags', 'trim');
                    $this->form_validation->set_rules('uploadedImage', 'Candidate Photo', 'trim');
                    $this->form_validation->set_rules('is_active', 'Active/Inactive', 'trim');
                    if ($this->form_validation->run() == FALSE) {
                        $this->load->view('layout/admin-header', $data);
                        $this->load->view('admin/update_job_role');
                        $this->load->view('layout/admin-footer');
                    } else {
                        $tagString = '';
                        if (!empty($data['tags'])) {
                            foreach ($data['tags'] as $key => $tag) {
                                if ($key == 0) {
                                    $tagString = $tag;
                                } else {
                                    $tagString = $tagString . ', ' . $tag;
                                }
                            }
                        }
                        $updateArr = array(
                            'name' => $data['name'],
                            'description' => $data['description'],
                            'tags' => $tagString,
                            'profile_pic' => $data['profile_pic'],
                            'is_active' => (isset($data['is_active']) && !empty($data['is_active']) ? $data['is_active'] : 0)
                        );
                        if ($this->Common_Model->updateData(__DBC_SCHEMATA_JOB_ROLE__, $updateArr,array('id'=>$roleID))) {
                            $this->session->set_userdata('successMsg', 'Job role updated successfully.');
                            redirect(__BASE_URL__ . '/job_roles');
                        } else {
                            $data['errorMsg'] = 'Something goes wrong while updating job role.';
                            $this->load->view('layout/admin-header', $data);
                            $this->load->view('admin/update_job_role');
                            $this->load->view('layout/admin-footer');
                        }
                    }
                } else {
                    $this->load->view('layout/admin-header', $data);
                    $this->load->view('admin/update_job_role');
                    $this->load->view('layout/admin-footer');
                }
            }else{
                $this->session->set_userdata('errorMsg', 'Job role not found.');
                redirect(__BASE_URL__ . '/job_roles');
            }
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function add_candidate_profile()
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Add Candidate Profile";
        $data['pageName'] = "CandidateProfiles";
        $data['subpageName'] = "AddCandidateProfile";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();

        if ($data['loggedInUser'] && ($data['role'] == 1 || $data['role'] == 2)) {
            if (isset($_POST) && !empty($_POST)) {
                $insert['name'] = $this->input->post('name');
                $insert['email'] = $this->input->post('email');
                $insert['mobile_no'] = $this->input->post('mobile_no');
                $insert['address1'] = $this->input->post('address1');
                $insert['address2'] = $this->input->post('address2');
                $insert['address3'] = $this->input->post('address3');
                $insert['points_check'] = $this->input->post('points_check');
                $insert['skills'] = $this->input->post('skills');
                $insert['qualification'] = $this->input->post('qualification');
                $insert['experience'] = $this->input->post('experience');
                $insert['certifications'] = $this->input->post('certifications');
                $insert['memberships'] = $this->input->post('memberships');
                $insert['companies'] = $this->input->post('companies');
                $insert['bankruptcy'] = $this->input->post('bankruptcy');
                $insert['workers_compensation'] = $this->input->post('workers_compensation');
                $insert['police_criminal_check'] = $this->input->post('police_criminal_check');
                $insert['police_criminal_comment'] = $this->input->post('police_criminal_comment');
                $insert['reference_checks'] = $this->input->post('reference_checks');
                $insert['work_entitle'] = $this->input->post('work_entitle');
                $insert['social_media'] = $this->input->post('social_media');
                $insert['share_holdings'] = $this->input->post('share_holdings');
                $insert['employment_available'] = $this->input->post('employment_available');
                $insert['job_type'] = $this->input->post('job_type');
                $insert['pay_compensation_type'] = $this->input->post('pay_compensation_type');
                $insert['pay_compensation_val'] = $this->input->post('pay_compensation_val');
                $insert['work_challanges'] = $this->input->post('work_challanges');
                $insert['inspiration'] = $this->input->post('inspiration');
                $insert['work_arrangements'] = $this->input->post('work_arrangements');
                $insert['management'] = $this->input->post('management');
                $insert['job_security'] = $this->input->post('job_security');
                $insert['influence_over_priorities'] = $this->input->post('influence_over_priorities');
                $insert['success_impact'] = $this->input->post('success_impact');
                $insert['is_active'] = $this->input->post('is_active');
                $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[150]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|max_length[255]|valid_email');
                $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'trim|min_length[10]|max_length[15]');
                $this->form_validation->set_rules('address1', 'Address 1', 'trim|max_length[255]');
                $this->form_validation->set_rules('address2', 'Address 2', 'trim|max_length[255]');
                $this->form_validation->set_rules('address3', 'Address 3', 'trim|max_length[255]');
                $this->form_validation->set_rules('points_check', '100 points check', 'trim|max_length[1000]');
                $this->form_validation->set_rules('skills', 'Skills', 'trim|max_length[500]');
                $this->form_validation->set_rules('qualification', 'Qualification', 'trim|max_length[500]');
                $this->form_validation->set_rules('experience', 'Experience', 'trim|max_length[500]');
                $this->form_validation->set_rules('certifications', 'Certifications', 'trim|max_length[500]');
                $this->form_validation->set_rules('licenses', 'Licenses', 'trim|max_length[500]');
                $this->form_validation->set_rules('memberships', 'Memberships', 'trim|max_length[500]');
                $this->form_validation->set_rules('companies', 'Companies', 'trim|max_length[500]');
                $this->form_validation->set_rules('bankruptcy', 'Bankruptcy', 'trim|max_length[500]');
                $this->form_validation->set_rules('workers_compensation', 'Workers Compensation', 'trim|max_length[500]');
                $this->form_validation->set_rules('police_criminal_check', 'Police Criminal Record', 'trim');
                $this->form_validation->set_rules('police_criminal_comment', 'Comment', 'trim|max_length[500]');
                $this->form_validation->set_rules('reference_checks', 'Reference Checks', 'trim|max_length[500]');
                $this->form_validation->set_rules('work_entitle', 'Work Entitle', 'trim|max_length[500]');
                $this->form_validation->set_rules('social_media', 'Social Media', 'trim|max_length[500]');
                $this->form_validation->set_rules('share_holdings', 'Share Holdings', 'trim|max_length[500]');
                $this->form_validation->set_rules('employment_available', 'Employment Available', 'trim');
                $this->form_validation->set_rules('job_type', 'Job Type', 'trim');
                $this->form_validation->set_rules('pay_compensation_type', 'Pay & Compensation', 'trim|max_length[30]');
                $this->form_validation->set_rules('pay_compensation_val', 'Pay & Compensation expected value', 'trim|max_length[10]');
                $this->form_validation->set_rules('work_challanges', 'Work & Challanges', 'trim|max_length[500]');
                $this->form_validation->set_rules('inspiration', 'Inspiration', 'trim|max_length[500]');
                $this->form_validation->set_rules('work_arrangements', 'Work arrangements', 'trim|max_length[500]');
                $this->form_validation->set_rules('management', 'Management', 'trim|max_length[500]');
                $this->form_validation->set_rules('job_security', 'Job Security', 'trim|max_length[500]');
                $this->form_validation->set_rules('influence_over_priorities', 'Influence over priorities', 'trim|max_length[500]');
                $this->form_validation->set_rules('success_impact', 'Success impact', 'trim|max_length[500]');
                $this->form_validation->set_rules('is_active', 'Active/Inactive', 'trim');
                $this->form_validation->set_rules('file', 'Resume', 'callback_file_check');
                if ($this->form_validation->run() == FALSE) {
                    $this->load->view('layout/admin-header', $data);
                    $this->load->view('admin/add-candidate-profile');
                    $this->load->view('layout/admin-footer');
                } else {
                    $insert['resume_file'] = '';
                    if (isset($_FILES['file'])) {
                        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                            $target_dir = __FILE_UPLOAD_PATH__;
                            $timeStamp = time();
                            $filename = basename($timeStamp . $_FILES["file"]["name"]);
                            $target_file = $target_dir . $filename;
                            $uploadOk = 1;
                            $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check file size
                            if ($_FILES["file"]["size"] > 50000000) {
                                $this->session->set_userdata('errorMsg', 'Sorry, your file is too large.');
                                $uploadOk = 0;
                                $data['error'] = true;
                            }
// Allow certain file formats
                            if ($FileType != "pdf" && $FileType != "doc" && $FileType != "docx") {
                                $this->session->set_userdata('errorMsg', 'Sorry, only pdf, doc, docx files are allowed.');
                                $uploadOk = 0;
                                $data['error'] = true;
                            }
// Check if $uploadOk is set to 0 by an error
                            if ($uploadOk == 0) {
                                $this->session->set_userdata('errorMsg', 'Sorry, your file was not uploaded.');
                                $data['error'] = true;
// if everything is ok, try to upload file
                            } else {
                                if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                                    $insert['resume_file'] = $filename;
                                } else {
                                    $data['error'] = true;
                                }
                            }
                        }
                    }
                    if (!$data['error']) {
                        $insertArr = array(
                            'name' => $insert['name'],
                            'email' => $insert['email'],
                            'mobile_no' => (!empty($insert['mobile_no']) ? $insert['mobile_no'] : ''),
                            'address1' => (!empty($insert['address1']) ? $insert['address1'] : ''),
                            'address2' => (!empty($insert['address2']) ? $insert['address2'] : ''),
                            'address3' => (!empty($insert['address3']) ? $insert['address3'] : ''),
                            'points_check' => (!empty($insert['points_check']) ? $insert['points_check'] : ''),
                            'resume_file' => $insert['resume_file'],
                            'skills' => (!empty($insert['skills']) ? $insert['skills'] : ''),
                            'qualification' => (!empty($insert['qualification']) ? $insert['qualification'] : ''),
                            'experience' => (!empty($insert['experience']) ? $insert['experience'] : ''),
                            'certifications' => (!empty($insert['certifications']) ? $insert['certifications'] : ''),
                            'memberships' => (!empty($insert['memberships']) ? $insert['memberships'] : ''),
                            'companies' => (!empty($insert['companies']) ? $insert['companies'] : ''),
                            'bankruptcy' => (!empty($insert['bankruptcy']) ? $insert['bankruptcy'] : ''),
                            'workers_compensation' => (!empty($insert['workers_compensation']) ? $insert['workers_compensation'] : ''),
                            'police_criminal_check' => (!empty($insert['police_criminal_check']) ? $insert['police_criminal_check'] : 0),
                            'police_criminal_comment' => (!empty($insert['police_criminal_comment']) ? $insert['police_criminal_comment'] : ''),
                            'reference_checks' => (!empty($insert['reference_checks']) ? $insert['reference_checks'] : ''),
                            'work_entitle' => (!empty($insert['work_entitle']) ? $insert['work_entitle'] : ''),
                            'social_media' => (!empty($insert['social_media']) ? $insert['social_media'] : ''),
                            'share_holdings' => (!empty($insert['share_holdings']) ? $insert['share_holdings'] : ''),
                            'employment_available' => (!empty($insert['employment_available']) ? $insert['employment_available'] : 0),
                            'job_type' => (!empty($insert['job_type']) ? $insert['job_type'] : 1),
                            'pay_compensation' => (!empty($insert['pay_compensation_val']) ? $insert['pay_compensation_val'] . ' - ' . $insert['pay_compensation_type'] : ''),
                            'work_challanges' => (!empty($insert['work_challanges']) ? $insert['work_challanges'] : ''),
                            'inspiration' => (!empty($insert['inspiration']) ? $insert['inspiration'] : ''),
                            'work_arrangements' => (!empty($insert['work_arrangements']) ? $insert['work_arrangements'] : ''),
                            'management' => (!empty($insert['management']) ? $insert['management'] : ''),
                            'job_security' => (!empty($insert['job_security']) ? $insert['job_security'] : ''),
                            'influence_over_priorities' => (!empty($insert['influence_over_priorities']) ? $insert['influence_over_priorities'] : ''),
                            'success_impact' => (!empty($insert['success_impact']) ? $insert['success_impact'] : ''),
                            'is_active' => (!empty($insert['is_active']) ? $insert['is_active'] : 0)
                        );
                        $candidateID = $this->Common_Model->insertData(__DBC_SCHEMATA_CANDIDATE_PROFILE__, $insertArr);
                        if ($candidateID > 0) {
                            $this->session->set_userdata('successMsg', 'Candidate profile added successfully.');
                            redirect(__BASE_URL__ . '/candidate_profiles');
                        } else {
                            $data['errorMsg'] = 'Something goes wrong while adding candidate profile.';
                            $this->load->view('layout/admin-header', $data);
                            $this->load->view('admin/add-candidate-profile');
                            $this->load->view('layout/admin-footer');
                        }
                    } else {
                        $data['errorMsg'] = 'Something goes wrong while adding candidate profile.';
                        $this->load->view('layout/admin-header', $data);
                        $this->load->view('admin/add-candidate-profile');
                        $this->load->view('layout/admin-footer');
                    }
                }
            } else {
                $this->load->view('layout/admin-header', $data);
                $this->load->view('admin/add-candidate-profile');
                $this->load->view('layout/admin-footer');
            }
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function edit_candidate_profile($candidateID)
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Edit Candidate Profile";
        $data['pageName'] = "CandidateProfiles";
        $data['subpageName'] = "EditCandidateProfile";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        $data['candidateID'] = $candidateID;
        if ($data['loggedInUser'] && ($data['role'] == 1 || $data['role'] == 2)) {
            $data['candidateArr'] = $this->Common_Model->getCompleteData(__DBC_SCHEMATA_CANDIDATE_PROFILE__, array('id' => $candidateID));
            if (!empty($data['candidateArr'])) {
                if (isset($_POST) && !empty($_POST)) {
                    $update['name'] = $this->input->post('name');
                    $update['email'] = $this->input->post('email');
                    $update['mobile_no'] = $this->input->post('mobile_no');
                    $update['address1'] = $this->input->post('address1');
                    $update['address2'] = $this->input->post('address2');
                    $update['address3'] = $this->input->post('address3');
                    $update['resume_file'] = $this->input->post('resume_file');
                    $update['points_check'] = $this->input->post('points_check');
                    $update['skills'] = $this->input->post('skills');
                    $update['qualification'] = $this->input->post('qualification');
                    $update['experience'] = $this->input->post('experience');
                    $update['certifications'] = $this->input->post('certifications');
                    $update['memberships'] = $this->input->post('memberships');
                    $update['companies'] = $this->input->post('companies');
                    $update['bankruptcy'] = $this->input->post('bankruptcy');
                    $update['workers_compensation'] = $this->input->post('workers_compensation');
                    $update['police_criminal_check'] = $this->input->post('police_criminal_check');
                    $update['police_criminal_comment'] = $this->input->post('police_criminal_comment');
                    $update['reference_checks'] = $this->input->post('reference_checks');
                    $update['work_entitle'] = $this->input->post('work_entitle');
                    $update['social_media'] = $this->input->post('social_media');
                    $update['share_holdings'] = $this->input->post('share_holdings');
                    $update['employment_available'] = $this->input->post('employment_available');
                    $update['job_type'] = $this->input->post('job_type');
                    $update['pay_compensation_type'] = $this->input->post('pay_compensation_type');
                    $update['pay_compensation_val'] = $this->input->post('pay_compensation_val');
                    $update['work_challanges'] = $this->input->post('work_challanges');
                    $update['inspiration'] = $this->input->post('inspiration');
                    $update['work_arrangements'] = $this->input->post('work_arrangements');
                    $update['management'] = $this->input->post('management');
                    $update['job_security'] = $this->input->post('job_security');
                    $update['influence_over_priorities'] = $this->input->post('influence_over_priorities');
                    $update['success_impact'] = $this->input->post('success_impact');
                    $update['is_active'] = $this->input->post('is_active');
                    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[2]|max_length[150]');
                    $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|max_length[255]|valid_email');
                    $this->form_validation->set_rules('mobile_no', 'Mobile No.', 'trim|min_length[10]|max_length[15]');
                    $this->form_validation->set_rules('address1', 'Address 1', 'trim|max_length[255]');
                    $this->form_validation->set_rules('address2', 'Address 2', 'trim|max_length[255]');
                    $this->form_validation->set_rules('address3', 'Address 3', 'trim|max_length[255]');
                    $this->form_validation->set_rules('points_check', '100 points check', 'trim|max_length[1000]');
                    $this->form_validation->set_rules('skills', 'Skills', 'trim|max_length[500]');
                    $this->form_validation->set_rules('qualification', 'Qualification', 'trim|max_length[500]');
                    $this->form_validation->set_rules('experience', 'Experience', 'trim|max_length[500]');
                    $this->form_validation->set_rules('certifications', 'Certifications', 'trim|max_length[500]');
                    $this->form_validation->set_rules('licenses', 'Licenses', 'trim|max_length[500]');
                    $this->form_validation->set_rules('memberships', 'Memberships', 'trim|max_length[500]');
                    $this->form_validation->set_rules('companies', 'Companies', 'trim|max_length[500]');
                    $this->form_validation->set_rules('bankruptcy', 'Bankruptcy', 'trim|max_length[500]');
                    $this->form_validation->set_rules('workers_compensation', 'Workers Compensation', 'trim|max_length[500]');
                    $this->form_validation->set_rules('police_criminal_check', 'Police Criminal Record', 'trim');
                    $this->form_validation->set_rules('police_criminal_comment', 'Comment', 'trim|max_length[500]');
                    $this->form_validation->set_rules('reference_checks', 'Reference Checks', 'trim|max_length[500]');
                    $this->form_validation->set_rules('work_entitle', 'Work Entitle', 'trim|max_length[500]');
                    $this->form_validation->set_rules('social_media', 'Social Media', 'trim|max_length[500]');
                    $this->form_validation->set_rules('share_holdings', 'Share Holdings', 'trim|max_length[500]');
                    $this->form_validation->set_rules('employment_available', 'Employment Available', 'trim');
                    $this->form_validation->set_rules('job_type', 'Job Type', 'trim');
                    $this->form_validation->set_rules('pay_compensation_type', 'Pay & Compensation', 'trim|max_length[30]');
                    $this->form_validation->set_rules('pay_compensation_val', 'Pay & Compensation expected value', 'trim|max_length[10]');
                    $this->form_validation->set_rules('work_challanges', 'Work & Challanges', 'trim|max_length[500]');
                    $this->form_validation->set_rules('inspiration', 'Inspiration', 'trim|max_length[500]');
                    $this->form_validation->set_rules('work_arrangements', 'Work arrangements', 'trim|max_length[500]');
                    $this->form_validation->set_rules('management', 'Management', 'trim|max_length[500]');
                    $this->form_validation->set_rules('job_security', 'Job Security', 'trim|max_length[500]');
                    $this->form_validation->set_rules('influence_over_priorities', 'Influence over priorities', 'trim|max_length[500]');
                    $this->form_validation->set_rules('success_impact', 'Success impact', 'trim|max_length[500]');
                    $this->form_validation->set_rules('is_active', 'Active/Inactive', 'trim');
                    $this->form_validation->set_rules('file', 'Resume', 'callback_file_check');
                    if ($this->form_validation->run() == FALSE) {
                        $this->load->view('layout/admin-header', $data);
                        $this->load->view('admin/add-candidate-profile');
                        $this->load->view('layout/admin-footer');
                    } else {
                        if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
                            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                                $target_dir = __FILE_UPLOAD_PATH__;
                                $timeStamp = time();
                                $filename = basename($timeStamp . $_FILES["file"]["name"]);
                                $target_file = $target_dir . $filename;
                                $uploadOk = 1;
                                $FileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check file size
                                if ($_FILES["file"]["size"] > 50000000) {
                                    $this->session->set_userdata('errorMsg', 'Sorry, your file is too large.');
                                    $uploadOk = 0;
                                    $data['error'] = true;
                                }
// Allow certain file formats
                                if ($FileType != "pdf" && $FileType != "doc" && $FileType != "docx") {
                                    $this->session->set_userdata('errorMsg', 'Sorry, only pdf, doc, docx files are allowed.');
                                    $uploadOk = 0;
                                    $data['error'] = true;
                                }
// Check if $uploadOk is set to 0 by an error
                                if ($uploadOk == 0) {
                                    $this->session->set_userdata('errorMsg', 'Sorry, your file was not uploaded.');
                                    $data['error'] = true;
// if everything is ok, try to upload file
                                } else {
                                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                                        $update['resume_file'] = $filename;
                                    } else {
                                        $data['error'] = true;
                                    }
                                }
                            }
                        }
                        if (!$data['error']) {
                            $updateArr = array(
                                'name' => $update['name'],
                                'email' => $update['email'],
                                'mobile_no' => (!empty($update['mobile_no']) ? $update['mobile_no'] : ''),
                                'address1' => (!empty($update['address1']) ? $update['address1'] : ''),
                                'address2' => (!empty($update['address2']) ? $update['address2'] : ''),
                                'address3' => (!empty($update['address3']) ? $update['address3'] : ''),
                                'points_check' => (!empty($update['points_check']) ? $update['points_check'] : ''),
                                'resume_file' => $update['resume_file'],
                                'skills' => (!empty($update['skills']) ? $update['skills'] : ''),
                                'qualification' => (!empty($update['qualification']) ? $update['qualification'] : ''),
                                'experience' => (!empty($update['experience']) ? $update['experience'] : ''),
                                'certifications' => (!empty($update['certifications']) ? $update['certifications'] : ''),
                                'memberships' => (!empty($update['memberships']) ? $update['memberships'] : ''),
                                'companies' => (!empty($update['companies']) ? $update['companies'] : ''),
                                'bankruptcy' => (!empty($update['bankruptcy']) ? $update['bankruptcy'] : ''),
                                'workers_compensation' => (!empty($update['workers_compensation']) ? $update['workers_compensation'] : ''),
                                'police_criminal_check' => (!empty($update['police_criminal_check']) ? $update['police_criminal_check'] : 0),
                                'police_criminal_comment' => (!empty($update['police_criminal_comment']) ? $update['police_criminal_comment'] : ''),
                                'reference_checks' => (!empty($update['reference_checks']) ? $update['reference_checks'] : ''),
                                'work_entitle' => (!empty($update['work_entitle']) ? $update['work_entitle'] : ''),
                                'social_media' => (!empty($update['social_media']) ? $update['social_media'] : ''),
                                'share_holdings' => (!empty($update['share_holdings']) ? $update['share_holdings'] : ''),
                                'employment_available' => (!empty($update['employment_available']) ? $update['employment_available'] : 0),
                                'job_type' => (!empty($update['job_type']) ? $update['job_type'] : 1),
                                'pay_compensation' => (!empty($update['pay_compensation_val']) ? $update['pay_compensation_val'] . ' - ' . $update['pay_compensation_type'] : ''),
                                'work_challanges' => (!empty($update['work_challanges']) ? $update['work_challanges'] : ''),
                                'inspiration' => (!empty($update['inspiration']) ? $update['inspiration'] : ''),
                                'work_arrangements' => (!empty($update['work_arrangements']) ? $update['work_arrangements'] : ''),
                                'management' => (!empty($update['management']) ? $update['management'] : ''),
                                'job_security' => (!empty($update['job_security']) ? $update['job_security'] : ''),
                                'influence_over_priorities' => (!empty($update['influence_over_priorities']) ? $update['influence_over_priorities'] : ''),
                                'success_impact' => (!empty($update['success_impact']) ? $update['success_impact'] : ''),
                                'is_active' => (!empty($update['is_active']) ? $update['is_active'] : 0)
                            );
                            if ($this->Common_Model->updateData(__DBC_SCHEMATA_CANDIDATE_PROFILE__, $updateArr, array('id' => $candidateID))) {
                                $this->session->set_userdata('successMsg', 'Candidate profile updated successfully.');
                                redirect(__BASE_URL__ . '/candidate_profiles');
                            } else {
                                $data['errorMsg'] = 'Something goes wrong while updating candidate profile.';
                                $this->load->view('layout/admin-header', $data);
                                $this->load->view('admin/update-candidate-profile');
                                $this->load->view('layout/admin-footer');
                            }
                        } else {
                            $data['errorMsg'] = 'Something goes wrong while updating candidate profile.';
                            $this->load->view('layout/admin-header', $data);
                            $this->load->view('admin/update-candidate-profile');
                            $this->load->view('layout/admin-footer');
                        }
                    }
                } else {
                    $this->load->view('layout/admin-header', $data);
                    $this->load->view('admin/update-candidate-profile');
                    $this->load->view('layout/admin-footer');
                }
            } else {
                $this->session->set_userdata('errorMsg', 'Candidate profile not found.');
                redirect(__BASE_URL__ . '/candidate_profiles');
            }
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function candidate_profiles()
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Candidate Profile(s)";
        $data['pageName'] = "CandidateProfiles";
        $data['subpageName'] = "ListCandidateProfiles";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        if ($data['loggedInUser'] && ($data['role'] == 1 || $data['role'] == 2)) {

            if ($this->session->userdata('successMsg')) {
                $data['success'] = true;
                $data['successMsg'] = $this->session->userdata('successMsg');
                $this->session->unset_userdata('successMsg');
            }
            if ($this->session->userdata('errorMsg')) {
                $data['error'] = true;
                $data['errorMsg'] = $this->session->userdata('errorMsg');
                $this->session->unset_userdata('errorMsg');
            }
            $config = paginationConfig();
            $config["base_url"] = __BASE_URL__ . "/candidate_profiles";
            $config["total_rows"] = $this->Common_Model->dataCount(__DBC_SCHEMATA_CANDIDATE_PROFILE__);
            $config["per_page"] = 20;
            $config["uri_segment"] = 3;
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["links"] = $this->pagination->create_links();
            $data['candidateProfilesArr'] = $this->Common_Model->getCompleteData(__DBC_SCHEMATA_CANDIDATE_PROFILE__, array(), $config['per_page'], $page);
            $this->load->view('layout/admin-header', $data);
            $this->load->view('admin/candidate-profiles');
            $this->load->view('layout/admin-footer');
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function view_candidate_profile($candidateID)
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Candidate Profile Details";
        $data['pageName'] = "CandidateProfiles";
        $data['subpageName'] = "ViewCandidateProfiles";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        if ($data['loggedInUser'] && ($data['role'] == 1 || $data['role'] == 2)) {

            if ($this->session->userdata('successMsg')) {
                $data['success'] = true;
                $data['successMsg'] = $this->session->userdata('successMsg');
                $this->session->unset_userdata('successMsg');
            }
            if ($this->session->userdata('errorMsg')) {
                $data['error'] = true;
                $data['errorMsg'] = $this->session->userdata('errorMsg');
                $this->session->unset_userdata('errorMsg');
            }
            $data['candidateProfileDetArr'] = $this->Common_Model->getCompleteData(__DBC_SCHEMATA_CANDIDATE_PROFILE__, array('id' => $candidateID));
            $this->load->view('layout/admin-header', $data);
            $this->load->view('admin/candidate-profile-details');
            $this->load->view('layout/admin-footer');
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function job_roles()
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Job Role(s)";
        $data['pageName'] = "JobRoles";
        $data['subpageName'] = "ListJobRoles";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        if ($data['loggedInUser'] && ($data['role'] == 1 || $data['role'] == 2)) {

            if ($this->session->userdata('successMsg')) {
                $data['success'] = true;
                $data['successMsg'] = $this->session->userdata('successMsg');
                $this->session->unset_userdata('successMsg');
            }
            if ($this->session->userdata('errorMsg')) {
                $data['error'] = true;
                $data['errorMsg'] = $this->session->userdata('errorMsg');
                $this->session->unset_userdata('errorMsg');
            }
            $config = paginationConfig();
            $config["base_url"] = __BASE_URL__ . "/job_roles";
            $config["total_rows"] = $this->Common_Model->dataCount(__DBC_SCHEMATA_JOB_ROLE__);
            $config["per_page"] = 20;
            $config["uri_segment"] = 3;
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["links"] = $this->pagination->create_links();
            $data['jobrolesArr'] = $this->Common_Model->getCompleteData(__DBC_SCHEMATA_JOB_ROLE__, array(), $config['per_page'], $page);
            $this->load->view('layout/admin-header', $data);
            $this->load->view('admin/job-roles');
            $this->load->view('layout/admin-footer');
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function resume_analysts()
    {
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['error'] = false;
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Resume Analyst(s)";
        $data['pageName'] = "AdminDashboard";
        $data['subpageName'] = "AdminDashboard";
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();
        if ($data['loggedInUser'] && $data['role'] == 1) {

            if ($this->session->userdata('successMsg')) {
                $data['success'] = true;
                $data['successMsg'] = $this->session->userdata('successMsg');
                $this->session->unset_userdata('successMsg');
            }
            if ($this->session->userdata('errorMsg')) {
                $data['error'] = true;
                $data['errorMsg'] = $this->session->userdata('errorMsg');
                $this->session->unset_userdata('errorMsg');
            }
            $config = paginationConfig();
            $config["base_url"] = __BASE_URL__ . "/admin/resume_analysts";
            $config["total_rows"] = $this->Common_Model->dataCount(__DBC_SCHEMATA_USERS__, array('user_role' => 2));
            $config["per_page"] = 20;
            $config["uri_segment"] = 3;
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data["links"] = $this->pagination->create_links();
            $data['analystArr'] = $this->Common_Model->getCompleteData(__DBC_SCHEMATA_USERS__, array('user_role' => 2), $config['per_page'], $page);
            $this->load->view('layout/admin-header', $data);
            $this->load->view('admin/dashboard');
            $this->load->view('layout/admin-footer');
        } else {
            redirect(__BASE_URL__ . '/logout');
        }
    }

    function login()
    {
        $data['success'] = false;
        $data['error'] = false;
        $error = false;
        $data['successMsg'] = '';
        $data['errorMsg'] = '';
        $data['szMetaTagTitle'] = "Admin Login";
        $data['pageName'] = "Admin";
        $data['subpageName'] = "Admin";
        $data['emailid'] = $this->input->post('login');
        $data['password'] = $this->input->post('password');

        $this->form_validation->set_rules('login', 'Email ID', 'trim|required|min_length[7]|max_length[255]|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'callback_valid_password');
        if ($this->form_validation->run() == FALSE) {
            $error = true;
        } else {
            $checkUserExistArr = $this->Common_Model->getCompleteData(__DBC_SCHEMATA_USERS__, array('email' => $data['emailid']));
            if (!empty($checkUserExistArr) && $checkUserExistArr[0]['user_role'] == 1 && $checkUserExistArr[0]['is_active'] == 1) {
                $storedPassword = $checkUserExistArr[0]['password'];
                if ($this->bcrypt->check_password($data['password'], $storedPassword)) {
                    $this->session->set_userdata('user', $checkUserExistArr[0]['id']);
                    $this->session->set_userdata('userrole', $checkUserExistArr[0]['user_role']);
                    redirect(__BASE_URL__ . '/admin/resume_analysts');
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

    function file_check($str)
    {
        $allowed_mime_types = array('application/pdf', 'application/force-download', 'application/x-download', 'binary/octet-stream', 'application/vnd.ms-office',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/msword', 'application/x-zip', 'application/octet-stream');
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $mime = get_mime_by_extension($_FILES['file']['name']);
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if (($ext == 'pdf' || $ext == 'doc' || $ext == 'docx') && in_array($mime, $allowed_mime_types)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only pdf, doc, docx file to upload.');
                return false;
            }
        } else {
//            $this->form_validation->set_message('file_check', 'Please select a pdf, doc, docx file to upload.');
            return true;
        }
    }

    function image_check($str)
    {
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != "") {
            $fileAr = explode('.', $_FILES['file']['name']);
            $ext = end($fileAr);
            if (($ext == 'jpg') || ($ext == 'JPEG') || ($ext == 'png') || ($ext == 'gif') || ($ext == 'jpeg')) {
                return true;
            } else {
                $this->form_validation->set_message('image_check', 'Please select valid image. Allowed formats are jpg, jpeg, png and gif.');
                return false;
            }
        } else {
            $this->form_validation->set_message('image_check', 'Please select valid image. Allowed formats are jpg, jpeg, png and gif.');
            return false;
        }
    }

}
