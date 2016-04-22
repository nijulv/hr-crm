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
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        
        $this->db->order_by("user_id","asc");
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_user_details($user_id = 0) {
         $this->db->select('*');
        $this->db->from("crm_users");
        $this->db->where("user_id", $user_id);
        $this->db->where("status", '1');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }

        public function get_agents_names () {
        $this->db->select('*');
        $this->db->from("crm_agents");
        $this->db->where("status", '1');
        $this->db->order_by("agent_id","asc");
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
    
    public function get_agents ($limit, $start,$search_user = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('crm_agents');
        if($search_user != ''){
            $this->db->where('agent_id',$search_user);
        }
        $this->db->where('status','1');
        $this->db->order_by("agent_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();          
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
     public function get_payments ($limit, $start,$search_user = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('payments p');
        $this->db->join('crm_users u', 'u.user_id = p.user_id', 'left');
        if($search_user != ''){
            $this->db->where('p.user_id',$search_user);
        }
        $this->db->where('p.status','1');
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('p.agent_id',s('ADMIN_USERID'));
        }
        
        $this->db->order_by("p.payment_id","desc");
        $this->db->limit($limit, $start);
        $query = $this->db->get();          
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
        
    }
    function get_userdetails_count($where){
        
        $this->db->select("COUNT(user_id) AS cnt");
        $this->db->where($where);
        $query = $this->db->get('crm_users');
        $row = $query->row();
        return intval($row->cnt);
        
    }
    function get_userdetails($where, $start=0, $limit=25){
        $this->db->select('user_id,agent_id,first_name,last_name,email,phone,status');
        $this->db->where($where);
        $this->db->order_by('user_id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('crm_users');
        return $query->result_array();
    }
    public function get_user_detail($user_id){
        if(empty($user_id)) return false;
        else{
            $this->db->from('crm_users');
            $this->db->where('user_id',$user_id);
            $query = $this->db->get(); 
            return $query->result_array();
        }
    }
    public function insert_datas ($data = array(),$tbl_name = '') {
        $this->db->insert($tbl_name,$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false; 
    }
    
    public function update_contents ($data = array(),$id = 0,$tbl_name = '') {
        $this->db->where('payment_id',$id);
        $this->db->update($tbl_name,$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function update_contents_agents ($data = array(),$id = 0,$tbl_name = '') {
        $this->db->where('agent_id',$id);
        $this->db->update($tbl_name,$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function get_payment_details($id = 0){
        $this->db->select('*');
        $this->db->where("payment_id",$id);
        $this->db->from('payments');  
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_agent_details($id = 0){
        $this->db->select('*');
        $this->db->where("agent_id",$id);
        $this->db->from('crm_agents');  
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function delete_payments ($id = 0) {
         $this->db->where('payment_id',$id);
        $this->db->delete('payments');
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
}