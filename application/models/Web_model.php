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
  
}