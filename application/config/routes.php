<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Home_Controller';
$route['home'] = "Home_Controller";
$route['login'] = "Home_Controller/login";
$route['logout'] = "Home_Controller/logout";
$route['analyst_login'] = "Home_Controller/analyst_login";
$route['admin'] = "Admin_Controller";
$route['job_roles'] = "Admin_Controller/job_roles";
$route['candidate_profiles'] = "Admin_Controller/candidate_profiles";
$route['add_candidate_profile'] = "Admin_Controller/add_candidate_profile";
$route['edit_job_roles/(:any)'] = "Admin_Controller/edit_job_roles/$1";
$route['view_candidate_profile/(:any)'] = "Admin_Controller/view_candidate_profile/$1";
$route['edit_candidate_profile/(:any)'] = "Admin_Controller/edit_candidate_profile/$1";
$route['admin/(:any)'] = "Admin_Controller/$1";
$route['admin/(:any)/(:any)'] = "Admin_Controller/$1/$2";
$route['api'] = "Api_Controller";
$route['api/(:any)'] = "Api_Controller/$1";
$route['api/(:any)/(:any)'] = "Api_Controller/$1/$2";
$route['api/(:any)/(:any)/(:any)'] = "Api_Controller/$1/$2/$3";
$route['404_override'] = 'Error_Controller';
$route['page-not-found'] = "Error_Controller";
$route['translate_uri_dashes'] = FALSE;
