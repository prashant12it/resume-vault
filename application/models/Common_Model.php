<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: prashantsingh
 * Date: 16/03/20
 * Time: 4:35 PM
 */
class Common_Model extends CI_Model
{

    function __construct()
    {
        // Set table name
    }

    function registerUser($dataArr){
        $encryptedPassword = $this->bcrypt->hash_password($dataArr['password']);
        $insertArr = array(
            'name' => $dataArr['username'],
            'email' => $dataArr['emailid'],
            'shop_url' => $dataArr['weburl'],
            'password' => $encryptedPassword,
            'verification_key' => $dataArr['verificationKey'],
            'user_role' => $dataArr['role'],
            'contact_no' => $dataArr['contact_no'],
            'social_media_url' => (isset($dataArr['social_media_url']) && !empty($dataArr['social_media_url']) ? $dataArr['social_media_url'] : ''),
            'paypal' => (isset($dataArr['paypal']) && !empty($dataArr['paypal']) ? $dataArr['paypal'] : '')
        );
        $queryInsert = $this->db->insert(__DBC_SCHEMATA_USERS__, $insertArr);
        if ($queryInsert) {
            $userID = $this->db->insert_id();
            return $userID;
        } else {
            return false;
        }
    }

    function insertData($tableName,$insertArr){
        $queryInsert = $this->db->insert($tableName, $insertArr);
        if ($queryInsert) {
            $dataID = $this->db->insert_id();
            return $dataID;
        } else {
            return false;
        }
    }

    function getCompleteData($tableName,$searchArr=array(),$limit=0, $start=0,$orderBy=''){
        if($limit>0){
            $this->db->limit($limit, $start);
        }
        if(!empty($searchArr)){
            $this->db->where($searchArr);
        }
        if(!empty($orderBy)){
            $this->db->order_by('id',$orderBy);
        }
        $query = $this->db->get($tableName);
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function getLikeData($tableName,$searchArr=array(),$limit=0, $start=0){
        if($limit>0){
            $this->db->limit($limit, $start);
        }
        if(!empty($searchArr)){
            $this->db->like($searchArr);
        }
        $query = $this->db->get($tableName);
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function updateData($tableName,$updateArr, $whereArr=array())
    {
        $this->db->where($whereArr);
        $queryUpdate = $this->db->update($tableName, $updateArr);
        if ($queryUpdate) {
            return true;
        } else {
            return false;
        }
    }

    function dataCount($tableName,$searchArr=array(),$likeArray = array())
    {
        if(!empty($searchArr)){
            return $this->db->where($searchArr)->from($tableName)->count_all_results();
        }elseif(!empty($likeArray)){
            return $this->db->like($likeArray)->from($tableName)->count_all_results();
        }else{
            return $this->db->count_all($tableName);
        }
    }

    function FilterdataCount($tableName,$searchArr='')
    {
        if(!empty($searchArr)){
            return $this->db->where($searchArr)->from($tableName)->count_all_results();
        }else{
            return $this->db->count_all($tableName);
        }
    }

    function getFilterData($tableName,$searchArr='',$limit=0, $start=0){
        if($limit>0){
            $this->db->limit($limit, $start);
        }
        if(!empty($searchArr)){
            $this->db->where($searchArr);
        }
        $query = $this->db->get($tableName);
        if ($query->num_rows() > 0) {
            $row = $query->result_array();
            return $row;
        } else {
            return false;
        }
    }

    function deleteRecord($tableName,$filterArr){
        $query = $this->db->where($filterArr)->delete($tableName);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }


}
