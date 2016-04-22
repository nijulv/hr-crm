<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Web_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        ini_set("display_errors", "0");
        error_reporting(0);
    }
    
    public function get_users () {
        $this->db->select('*');
        $this->db->from("crm_users");
        $this->db->where("status", '1');
        $this->db->order_by("user_id","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    //funtion to get total rows
    public function get_total_rows(){
        $query = $this->db->query('SELECT FOUND_ROWS() AS `Count`');
        return $query->row()->Count;
    }
    
    public function get_payments ($limit, $start,$search_user = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('payments');
        if($search_user != ''){
            $this->db->where('user_id',$search_user);
        }
        
        $this->db->order_by("payment_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();          
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
}