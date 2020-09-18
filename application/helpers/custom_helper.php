<?php
function CheckFileUploaded($filename)
{
    if (file_exists(__FILE_UPLOAD_PATH__ . $filename)) {
        return true;
    } else {
        CheckFileUploaded($filename);
    }
}
function generateRandomKey($length = 16)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function paginationConfig(){
    $config = array();

    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['num_tag_close'] = '</span></li>';
    $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['prev_tag_close'] = '</span></li>';
    $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['next_tag_close'] = '</span></li>';
    $config['prev_link'] = '<i  class="fa fa-long-arrow-left" title="Previous Page"></i>';
    $config['next_link'] = '<i  class="fa fa-long-arrow-right" title="Next Page"></i>';
    $config['last_link'] = '<i  class="fa fa-angle-double-right" title="Last Page"></i>';
    $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['last_tag_close'] = '</span></li>';
    $config['first_link'] = '<i  class="fa fa-angle-double-left" title="First Page"></i>';
    $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
    $config['first_tag_close'] = '</span></li>';
    return $config;
}
function ThemepaginationConfig(){
    $config = array();

    $config['full_tag_open'] = '<div class="page-nav mx-auto d-flex align-items-center">';
    $config['full_tag_close'] = '</div>';
    $config['num_tag_open'] = '<a href="#">';
    $config['num_tag_close'] = '</a>';
    $config['cur_tag_open'] = '<a class="active" href="#">';
    $config['cur_tag_close'] = '</a>';
    $config['prev_tag_open'] = '<a href="#">';
    $config['prev_tag_close'] = '</a>';
    $config['first_link'] = '<i class="fa fa-angle-double-left" title="First Page"></i>';
    $config['first_tag_open'] = '<a href="#">';
    $config['first_tag_close'] = '</a>';
    $config['last_link'] = '<i class="fa fa-angle-double-right" title="Last Page"></i>';
    $config['last_tag_open'] = '<a href="#">';
    $config['last_tag_close'] = '</a>';



    $config['prev_link'] = '<i class="fa fa-long-arrow-left" title="Previous Page"></i>';
    $config['prev_tag_open'] = '<a href="#">';
    $config['prev_tag_close'] = '</a>';


    $config['next_link'] = '<i class="fa fa-long-arrow-right" title="Next Page"></i>';
    $config['next_tag_open'] = '<a href="#">';
    $config['next_tag_close'] = '</a>';
    return $config;
}

function getLoggedInUser(){
    $CI = &get_instance();
    if($CI->session->userdata('user')){
        return $CI->session->userdata('user');
    }else{
        return false;
    }
}
function getLoggedInUserrole(){
    $CI = &get_instance();
    if($CI->session->userdata('userrole')){
        return $CI->session->userdata('userrole');
    }else{
        return false;
    }
}
