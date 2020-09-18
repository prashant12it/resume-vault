<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error_Controller extends CI_Controller {

	function __construct()
	{
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Headers: Authorization');
        header("Access-Control-Allow-Methods: GET, POST");
		parent::__construct();
	}
	
	public function index()
	{
		$data['szMetaTagTitle'] = "Page Not Found";
        $data['pageName'] = "404";
        $data['success'] = false;
        $data['successMsg'] = '';
        $data['loggedInUser'] = getLoggedInUser();
        $data['role'] = getLoggedInUserrole();

        $this->load->view('layout/admin-header', $data);
        $this->load->view('page404');
        $this->load->view('layout/admin-footer');

	}
}
?>
