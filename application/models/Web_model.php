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
        //$this->db->where("status", '1');
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        $this->db->where("status !=", '2');
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
        //$this->db->where("status", '1');
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
     public function get_todo(){
        $date= date('Y-m-d');
        $type=admin;
        if(s('ADMIN_TYPE') == 0){
             $this->db->where('admin_id',$type);
        }else{
            $type=$this->session->userdata("ADMIN_USERID");
            $this->db->where('admin_id',$type);
        }
        $this->db->select('id,todo');
        $this->db->where('date',$date);
        $query = $this->db->get('todo');
        return $query->result_array();
    }
    public function get_agents ($limit, $start,$search_user = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('crm_agents');
        if($search_user != ''){
            //$this->db->where('agent_id',$search_user);
            $this->db->like('first_name',$search_user);
            $this->db->or_like('last_name',$search_user);
            $this->db->or_like('email',$search_user);
        }
        //$this->db->where_in('status',['1','2']);
        $this->db->where('status !=','0');
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
           if(is_numeric($search_user)) {
               $this->db->where('p.amount',$search_user);
           } 
           else {
               $this->db->like('p.title',$search_user); 
           }
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
    public function get_bank_payments ($limit, $start,$search_user = '') {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('crm_bank_payment');
        
        $this->db->where('status','1');
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        
        $this->db->order_by("bank_payment_id","desc");
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
        $this->db->where("status !=",'2');
        $query = $this->db->get('crm_users');
        $row = $query->row();
        return intval($row->cnt);
        
    }
    function get_userdetails($where, $start=0, $limit=25){
        $this->db->select('user_id,agent_id,first_name,last_name,email,phone,status');
        $this->db->where($where);
        //$this->db->where_in("status", ['0','1']);
        $this->db->where("status !=",'2');
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
    public function get_state_details(){
          $this->db->from('states');
          $query = $this->db->get(); 
          return $query->result_array();
     }
    public function get_district_details($state_id){
         $this->db->from('districts');
         $this->db->where('state_id',$state_id);
         $query = $this->db->get(); 
         return $query->result_array();

    }
    public function get_state($state_id){
          $this->db->select('name');
          $this->db->from('states');
          $this->db->where('id',$state_id);
          $query = $this->db->get(); 
          return $query->result_array();
         
    }
    public function get_district($district_id){
          $this->db->select('name');
          $this->db->from('districts');
          $this->db->where('id',$district_id);
          $query = $this->db->get(); 
          return $query->result_array();
         
    }
    public function get_imagedetails($where){
            $this->db->select('attachments');
            $this->db->from('crm_users');
            $this->db->where($where);
            $query = $this->db->get(); 
            return $query->result_array();
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
    
    public function update_contents_bankpayment ($data = array(),$id = 0,$tbl_name = '') {
        $this->db->where('bank_payment_id',$id);
        $this->db->update($tbl_name,$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function update_profile ($data = array(),$id = 0,$tbl_name = '') {
        if($tbl_name == 'crm_admin'){
            $this->db->where('admin_id',$id);
        }
        else {
            $this->db->where('agent_id',$id);
        }
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
    
    public function get_bankpayment_details($id = 0){
        $this->db->select('*');
        $this->db->where("bank_payment_id",$id);
        $this->db->from('crm_bank_payment');  
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
    public function get_agent_status($agent_id){
        if(empty($agent_id)) return false;
        else{
            $this->db->select('status');
            $this->db->from('crm_agents');
            $this->db->where('agent_id',$agent_id);
            $query = $this->db->get(); 
            return $query->result_array();
        }
    }
    public function get_total_users_count ($staus = '') {
        $this->db->where('status', $staus);
        $this->db->from('crm_users');
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        
        return $this->db->count_all_results();
    }
    
    public function get_total_payment_count () {
        
        $this->db->select_sum('amount', 'amount');
        $this->db->where('status','1');
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        $query = $this->db->get('payments');
        $result = $query->result();

        return $result[0]->amount;
    }
    
    public function get_profile_details ($id = 0) {
        $this->db->select('*');
        if(s('ADMIN_TYPE') == 1){
            $this->db->from('crm_agents');  
            $this->db->where("agent_id",$id);
        }
        else {
            $this->db->from('crm_admin');  
            $this->db->where("admin_id",$id);
        }
        
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function check_oldpassword($password,$id){
        
        if(s('ADMIN_TYPE') == 1){
            $this->db->from('crm_agents');  
            $this->db->where("agent_id",$id);
        }
        else {
            $this->db->from('crm_admin');  
            $this->db->where("admin_id",$id);
        }
        $this->db->where("password",$password);
        $query = $this->db->get();       
        if($query->num_rows () >0)
            return true;
        else
            return false;
    }
    
    public function update_password($data = array(), $id = 0) {
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where("agent_id",$id); 
            $this->db->update('crm_agents',$data);  
        }
        else {
            $this->db->where("admin_id",$id);
            $this->db->update('crm_admin',$data); 
        }
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function get_username ($user_id = 0) {
        $this->db->select('*'); 
        $this->db->from('crm_users'); 
        $this->db->where('user_id',$user_id); 
        $query = $this->db->get();    
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_details_byusername($username = '', $type = ''){
        $this->db->select('*');
        $this->db->where("username",$username);
        if($type == 'admin') 
            $this->db->from('crm_admin');
        else 
            $this->db->from('crm_agents');  
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    //get email template
    function get_mail_template($mail_template_id = FALSE) {
        if ($mail_template_id) {
            $this->db->where('mail_template_id', $mail_template_id);
        }

        $this->db->order_by('mail_template_id', 'DESC');
        $this->db->where(array('status' => 1));
        $query = $this->db->get('mail_template');
        return($query->row_array());
    }
}