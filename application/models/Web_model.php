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
        $this->db->order_by("user_id","desc");
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
        $this->db->where("status !=", '2');
        $query = $this->db->get();  
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_agents_names () {
        $this->db->select('*');
        $this->db->from("crm_agents");
        $this->db->where("status !=", '0');
        $this->db->order_by("agent_id","desc");
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
        $this->db->select('id,todo,status');
        $this->db->where('date',$date);
        $query = $this->db->get('todo');
        return $query->result_array();
    }
    public function edit_todo($todoid){
        $this->db->select('id,todo,date,status');
        $this->db->where('id',$todoid);
        $query = $this->db->get('todo');
        return $query->result_array();
        
        
    }
    
    public function get_agents ($limit = '', $start = '',$search_user = '',$state_search = '',$district_search = '',$city_search = '',$mobile = 0) {
        $this->db->select("SQL_CALC_FOUND_ROWS a.*,s.name as state,d.name as district",FALSE); 
        $this->db->from('crm_agents a');
        $this->db->join('states s', 's.id = a.state_id', 'left');
        $this->db->join('districts d', 'd.id = a.district_id', 'left');
        
        if($search_user != ''){
            //$this->db->where('agent_id',$search_user);
            $this->db->like('first_name',$search_user);
            $this->db->or_like('last_name',$search_user);
        }
        if($state_search != ''){
            $this->db->where('a.state_id',$state_search);
        }
        if($district_search != ''){
            $this->db->where('a.district_id',$district_search);
        }
        if($city_search != ''){
            $this->db->like('a.city',$city_search);
        }
        if($this->input->post("search_result") != "1") {
            $this->db->where('a.state_id','18');   // Default state kerala
        }
        $this->db->where('status !=','0');
        $this->db->order_by("agent_id","desc");
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();            //echo $this->db->last_query();    
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    public function get_userdetails ($limit = '', $start = '',$search_user = '',$state_search = '',$district_search = '',$city_search = '',$search_name_agent = '',$mobile = 0) {
        
        if(s('ADMIN_TYPE') == 0){
            $this->db->select("SQL_CALC_FOUND_ROWS u.*,s.name as state,d.name as district,a.first_name afirstname,a.last_name as alastname",FALSE);
            $this->db->from('crm_users u');
            $this->db->join('crm_agents a', 'a.agent_id = u.agent_id', 'left');
            $this->db->join('states s', 's.id = u.state_id', 'left');
            $this->db->join('districts d', 'd.id = u.district_id', 'left');
        }
        else {
            $this->db->select("SQL_CALC_FOUND_ROWS u.*,s.name as state,d.name as district",FALSE); 
            $this->db->from('crm_users u');
            $this->db->join('states s', 's.id = u.state_id', 'left');
            $this->db->join('districts d', 'd.id = u.district_id', 'left');
        }
        if($search_user != ''){
           // $this->db->where('u.user_id',$search_user);
            $this->db->like('u.first_name',$search_user);
            $this->db->or_like('u.last_name',$search_user);
        }
        if($search_name_agent != ''){
            //$this->db->where('u.agent_id',$search_name_agent);
            $this->db->like('a.first_name',$search_name_agent);
            $this->db->like('a.last_name',$search_name_agent);
        }
        if($state_search != ''){   
            $this->db->where('u.state_id',$state_search);
        }
        if($district_search != ''){
            $this->db->where('u.district_id',$district_search);
        }
        if($city_search != ''){
            $this->db->like('u.city',$city_search);
        }
        if($this->input->post("search_result") != "1") {
            $this->db->where('u.state_id','18');   // Default state kerala
        }
        $this->db->where('u.status !=','2');
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('u.agent_id',s('ADMIN_USERID'));
        }
        
        $this->db->order_by("u.user_id","desc");
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();            //echo $this->db->last_query();
        if($query->num_rows() > 0){
            return $query->result_array();
        } 
        else {
            return FALSE;
        }
    }
    
    public function get_payments ($limit = '', $start = '',$search_user = '',$search_name = '',$search_name_agent = '',$fromdate_search = '',$todate_search = '',$mobile = 0) {
        
        if(s('ADMIN_TYPE') == 0){
            $this->db->select("SQL_CALC_FOUND_ROWS p.*,u.first_name,u.last_name,u.phone,a.first_name afirstname,a.last_name as alastname",FALSE);
            $this->db->from('payments p');
            $this->db->join('crm_users u', 'u.user_id = p.user_id', 'left');
            $this->db->join('crm_agents a', 'a.agent_id = p.agent_id', 'left');
        }
        else {
            $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE);
            $this->db->from('payments p');
            $this->db->join('crm_users u', 'u.user_id = p.user_id', 'left');
        }
        
        if($search_user != ''){
           if(is_numeric($search_user)) {
               $this->db->where('p.amount',$search_user);
           } 
           else {
               $this->db->like('p.title',$search_user); 
           }
        }
        if($search_name != ''){
            //$this->db->where('p.user_id',$search_name);
            $this->db->like('u.first_name',$search_name);
            $this->db->or_like('u.last_name',$search_name);
        }
        if($search_name_agent != ''){
           // $this->db->where('p.agent_id',$search_name_agent);
            $this->db->like('a.first_name',$search_name_agent);
            $this->db->or_like('a.last_name',$search_name_agent);
        }
        if($fromdate_search != '') {
            $this->db->where('p.date >=', $fromdate_search);
        }
        if($todate_search != '')  {
            $this->db->where('p.date <=', $todate_search);
        }
        
        // Default current month details
        if($this->input->post("search_result") != "1") {
            
            $firstday = date('Y-m-01');
            $lastday  = date('Y-m-d');
            $this->db->where('p.date >=', $firstday);
            $this->db->where('p.date <=', $lastday);  
        }
        
        $this->db->where('p.status','1');
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('p.agent_id',s('ADMIN_USERID'));
        }
        
        $this->db->order_by("p.payment_id","desc");
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        } 
        $query = $this->db->get();          
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        } 
    }
    
    public function get_bank_payments_api ($limit = '', $start = '',$mobile = 0) {
        $this->db->select("SQL_CALC_FOUND_ROWS *",FALSE); 
        $this->db->from('crm_bank_payment');
        $this->db->where('status','1');
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        $this->db->order_by("bank_payment_id","desc");
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        } 
        $query = $this->db->get();          
        if($query->num_rows() > 0){
            
            $data = $query->result_array();
            if(!empty($data)){
                foreach($data as $key => $dt){
                    
                    $username = array();
                    $usernames = '';
                    $names = '';
                                        
                    $userids = $dt['user_id']; 
                    $user_id =  (explode(",",$userids));
                    if($user_id){
                        foreach ($user_id as $id){
                            $username[] = $this->get_username($id); 
                        }
                    }
                    if($username){   
                        foreach ($username as $name){
                            $names .= $name['first_name'].' '.$name['last_name'] .',';
                        }
                    }  
                    $usernames = rtrim($names, ",");      
                    
                    $data[$key]['usernames']   = $usernames;
                    
                }
            }
            return $data;
        } else {
            return FALSE;
        }
        
    }
    
    public function get_bank_payments ($limit = '', $start = '',$search_user = '',$search_name = '',$search_name_agent = '',$fromdate_search = '',$todate_search = '',$mobile = 0) {
        
        if(s('ADMIN_TYPE') == 0){
            $this->db->select("SQL_CALC_FOUND_ROWS p.*,a.first_name as afirstname,a.last_name as alastname",FALSE);
            $this->db->from('crm_bank_payment p');
            $this->db->join('crm_agents a', 'a.agent_id = p.agent_id', 'left');
        }
        else {
            $this->db->select("SQL_CALC_FOUND_ROWS p.*",FALSE);
            $this->db->from('crm_bank_payment p');
        }
        
        if($search_user != ''){
            $this->db->like('p.total_payment',$search_user); 
            $this->db->or_like('p.bank_payment',$search_user); 
        }
        if($search_name != ''){
            $this->db->like('p.user_id',$search_name);
        }
        if($search_name_agent != ''){
            //$this->db->where('p.agent_id',$search_name_agent);
            $this->db->like('a.first_name',$search_name_agent);
            $this->db->or_like('a.last_name',$search_name_agent);
        }
        if($fromdate_search != '') {
            $this->db->where('p.date >=', $fromdate_search);
        }
        if($todate_search != '')  {
            $this->db->where('p.date <=', $todate_search);
        }
        
        // Default current month details
        if($this->input->post("search_result") != "1") {
            
            $firstday = date('Y-m-01');
            $lastday  = date('Y-m-d');
            $this->db->where('p.date >=', $firstday);
            $this->db->where('p.date <=', $lastday);  
        }
        
        $this->db->where('p.status','1');
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        $this->db->order_by("bank_payment_id","desc");
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        } 
        $query = $this->db->get();          
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        } 
    }
    
    function get_userdetails_count($where,$user_search=''){
        
        $this->db->select("COUNT(user_id) AS cnt");
        $this->db->where($where);
        $this->db->where("status !=",'2');
        if($user_search){
            $this->db->where("(`first_name` LIKE '%$user_search%' OR  `last_name` LIKE '%$user_search%' OR `email` LIKE '%$user_search%')");
        }
        $query = $this->db->get('crm_users');
        $row = $query->row();
        return intval($row->cnt);
        
    }
    
    function get_logged_user_details ($type = '') {
        $this->db->select('*');
        if($type == 'admin'){
            $this->db->where('admin_id',s('ADMIN_USERID'));
            $query = $this->db->get('crm_admin');      
        }
        else {
            $this->db->where('agent_id',s('ADMIN_USERID'));
            $query = $this->db->get('crm_agents');
        }
        if($query->num_rows () > 0)
            return $query->row_array();
        else
            return false;
    }
    
    function get_userdetails_old($where, $start=0, $limit=25,$user_search='',$mobile = 0){
        $this->db->select('*'); 
        $this->db->where($where);
        $this->db->where("status <>",'2');
        if('0' != trim($user_search)){
            $this->db->where("(`first_name` LIKE '%$user_search%' OR  `last_name` LIKE '%$user_search%' OR `email` LIKE '%$user_search%')");
        }
        $this->db->order_by('user_id', 'DESC');
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        }
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
    
    public function get_category(){
        $this->db->where('status','1');
        $this->db->from('crm_category');
        $query = $this->db->get(); 
         if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
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
            $this->db->select('*');
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
    
    public function update_contents_todo ($data = array(),$id = 0,$tbl_name = '') {
        $this->db->where('id',$id);
        $this->db->update($tbl_name,$data);
        if($this->db->affected_rows() >0)
            return true;
        else
            return false;
    }
    
    public function delete_todo_details ($id = 0) {
        $this->db->where("id", $id);
        $query = $this->db->delete("todo");     
        if ($this->db->affected_rows() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

        public function user_status_update ($data = array(),$id = 0,$tbl_name = 'crm_users') {
        $this->db->where('user_id',$id);
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
    
    public function get_admin_details () {
        $this->db->where("status","1");
        $query = $this->db->get("crm_admin");      
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
    
    public function get_tot_users_count(){
        $this->db->where('status !=', '2');
        $this->db->from('crm_users');
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        return $this->db->count_all_results();
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
    
    public function get_new_clents_day($status = '') {
        $this->db->where('status', $status);
        $this->db->where('date', $date = date('Y-m-d'));   // check current date 
        $this->db->from('crm_users');
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        return $this->db->count_all_results();
    }
    
    public function todolist_serchlist ($date_val = '') {
        $this->db->where('date', $date_val);
        $query = $this->db->get("todo"); 
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }

        public function get_total_users_count ($status = '') {
        $this->db->where('status', $status);
        $this->db->from('crm_users');
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('agent_id',s('ADMIN_USERID'));
        }
        
        return $this->db->count_all_results();
    }
    
    public function get_active_agents_today () {
        $this->db->where('status', '1');
        $this->db->from('crm_agents');
        $this->db->like('last_login_date', $date = date('Y-m-d'));
        
       return $this->db->count_all_results();
    }
    
    public function get_total_agent_count () {
        $this->db->where('status', '1');
        $this->db->from('crm_agents');
        
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
    
    public function check_username_available ($username = '') {
        $this->db->where("username", $username);
        $query = $this->db->get("crm_agents");       
        if ($query->num_rows() > 0) {
                return false;
        } else {
                return true;
        }
    }
    
    public function check_user_payment ($id = 0) {
        $this->db->where("user_id", $id);
        $this->db->where("status", '1');
        $query = $this->db->get("payments");       
        if ($query->num_rows() > 0) {
            return true;
        } 
        else {
            return false;
        }
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
    
    public function get_agent_reportlist($limit = '', $start = '' , $search_term = '',$status_search = '' ,$fromdate_search = '' ,$todate_search = '',$search_phone = '',$state_search = '',$search_district = '',$search_city = '',$mobile = 0) {
        $this->db->select("SQL_CALC_FOUND_ROWS a.*,s.name as state,d.name as districts",FALSE); 
        $this->db->from('crm_agents a');
        $this->db->join('states s', 's.id = a.state_id', 'left');
        $this->db->join('districts d', 'd.id = a.district_id', 'left');
        $this->db->where('a.status !=','0');
         
        if($search_term != '') {
            $this->db->like('a.first_name',$search_term);
            $this->db->or_like('a.last_name',$search_term);
            $this->db->or_like('a.email',$search_term);
            //$this->db->or_like('phone',$search_term);
        }
        if($status_search != '') 
            $this->db->where('a.status',$status_search);
        if($fromdate_search != '') 
            $this->db->where('a.date >=', $fromdate_search);
        if($todate_search != '') 
        $this->db->where('a.date <=', $todate_search);
        
        if($search_phone != '') 
            $this->db->where('a.phone',$search_phone);
        if($state_search != '')
            $this->db->where('a.state_id',$state_search);
        if($search_district != '')
            $this->db->where('d.name',$search_district);
        
        if($search_city != '')
            $this->db->like('a.city',$search_city);       
            
        $this->db->order_by("agent_id","desc");
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        }   
        $query = $this->db->get();     //echo $this->db->last_query();
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_payment_reportlist($limit = '', $start = '', $search_term = '',$search_title = '' ,$fromdate_search = '' ,$todate_search = '',$mobile = 0) {
        
        if(s('ADMIN_TYPE') == 0){
            $this->db->select("SQL_CALC_FOUND_ROWS p.*,u.first_name,u.last_name,u.phone,a.first_name as afirstname,a.last_name as alastname",FALSE); 
            $this->db->from('payments p');
            $this->db->join('crm_users u', 'u.user_id = p.user_id', 'left');
            $this->db->join('crm_agents a', 'a.agent_id = p.agent_id', 'left');
        }
        else {
            $this->db->select("SQL_CALC_FOUND_ROWS p.*,u.first_name,u.last_name,u.phone",FALSE); 
            $this->db->from('payments p');
            $this->db->join('crm_users u', 'u.user_id = p.user_id', 'left');
        }
        
        if($search_term != '') {
            $this->db->like('u.first_name',$search_term);
            $this->db->or_like('u.last_name',$search_term);
            $this->db->or_like('phone',$search_term);
        }
        if($search_title != ''){
           if(is_numeric($search_title)) {
               $this->db->where('p.amount',$search_title);
           } 
           else {
               $this->db->like('p.title',$search_title); 
           }
        }
        if($fromdate_search != '') 
            $this->db->where('p.date >=', $fromdate_search);
        if($todate_search != '') 
        $this->db->where('p.date <=', $todate_search);
        
        $this->db->where('p.status','1');
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('p.agent_id',s('ADMIN_USERID'));
        }
        $this->db->order_by("p.payment_id","desc");
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        }
        $query = $this->db->get();     
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_user_reportlist($limit, $start , $search_term = '',$status_search = '' ,$fromdate_search = '' ,$todate_search = '',$state_search = '',$search_district = '',$search_city = '',$search_phone = '',$mobile = 0) {
        $this->db->select("SQL_CALC_FOUND_ROWS u.*,s.name as state,d.name as districts",FALSE); 
        $this->db->from('crm_users u');
        $this->db->join('states s', 's.id = u.state_id', 'left');
        $this->db->join('districts d', 'd.id = u.district_id', 'left');
            
        $this->db->where('status !=','2');
         
        if($search_term != '') {
            $this->db->like('u.first_name',$search_term);
            $this->db->or_like('u.last_name',$search_term);
            $this->db->or_like('u.email',$search_term);
            //$this->db->or_like('u.phone',$search_term);
        }
        if($status_search != '') 
            $this->db->where('u.status',$status_search);
        if($fromdate_search != '') 
            $this->db->where('u.date >=', $fromdate_search);
        if($todate_search != '') 
        $this->db->where('u.date <=', $todate_search);
        
        if($state_search != '')
            $this->db->where('u.state_id',$state_search);
        
        if($search_district != '')
            $this->db->where('d.name',$search_district);
        
        if($search_city != '')
            $this->db->like('u.city',$search_city);
        
        if($search_phone != '')
            $this->db->where('u.phone',$search_phone);
        
        
        if(s('ADMIN_TYPE') == 1){
             $this->db->where('u.agent_id',s('ADMIN_USERID'));
        }
        
        $this->db->order_by("u.user_id","desc");
        if($mobile == 0) {
            $this->db->limit($limit, $start);
        } 
        $query = $this->db->get();     //echo $this->db->last_query();
        if($query->num_rows () >0)
            return $query->result_array();
        else
            return false;
    }
    
    
    function get_userlist_byagent($id = 0,$tbl_name = ''){
        if($tbl_name == 'crm_users') {
            $this->db->select("u.*,s.name as state,d.name as districts");
            $where = array(
                'agent_id' => $id
            );
            $this->db->where('status !=','2');
            $this->db->from('crm_users u');
            $this->db->join('states s', 's.id = u.state_id', 'left');
            $this->db->join('districts d', 'd.id = u.district_id', 'left');
        }
        $this->db->where($where);
        $query = $this->db->get();    
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return FALSE;
        }
    }
    
    function get_more_details($id = 0,$tbl_name = ''){
        
        if($tbl_name == 'payments') {
            $this->db->select("p.*,u.first_name,u.last_name,u.phone,u.email,s.name as state,d.name as districts,u.city,u.address,u.pincode");
            $where = array(
                'payment_id' => $id
            );
            $this->db->from('payments p');
            $this->db->join('crm_users u', 'u.user_id = p.user_id', 'left');
            $this->db->join('states s', 's.id = u.state_id', 'left');
            $this->db->join('districts d', 'd.id = u.district_id', 'left');
        }
        else if($tbl_name == 'crm_users') {
            $this->db->select("u.*,s.name as state,d.name as districts");
            $where = array(
                'user_id' => $id
            );
            $this->db->from('crm_users u');
            $this->db->join('states s', 's.id = u.state_id', 'left');
            $this->db->join('districts d', 'd.id = u.district_id', 'left');
        }
        else {
            $this->db->select("a.*,s.name as state,d.name as districts"); 
            $where = array(
                'agent_id' => $id
            );
            $this->db->from('crm_agents a');
            $this->db->join('states s', 's.id = a.state_id', 'left');
            $this->db->join('districts d', 'd.id = a.district_id', 'left');
        }
       
        
        $this->db->where($where);
        $query = $this->db->get();     
        if($query->num_rows() > 0){
            return $query->row_array();
        } else {
            return FALSE;
        }
    }
    
     public function district_autocomplete($keyword = '') {
         
        $query = $this->db->query("SELECT name FROM districts WHERE name LIKE '$keyword%'");
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }
    
    function  enable_logging($no,$data) { 
        
         $this->db->where("number",$no);
         $query = $this->db->update("crm_agents", $data); 
        if($this->db->affected_rows() >0)
            return true;
        else 
            return false;
    }
    
    public function get_agentcode_previous () {
        $this->db->order_by("agent_id","desc");
        $query = $this->db->get("crm_agents");    
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_payment_code_previous () {
        $this->db->order_by("payment_id","desc");
        $query = $this->db->get("payments");    
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
    
    public function get_bank_payment_code_previous () {
        $this->db->order_by("bank_payment_id","desc");
        $query = $this->db->get("crm_bank_payment");    
        if($query->num_rows () >0)
            return $query->row_array();
        else
            return false;
    }
}