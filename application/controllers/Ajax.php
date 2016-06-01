<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
    
    var $gen_contents = array();
    // view more function to display popup data
    public function viewmore($from = "", $data_id = ""){
       
        $this->load->model('web_model');
        if($from == 'agent') {
            $tbl_name       = 'crm_agents';
            $data['from']   = "agent";
            $data['result']     = $this->web_model->get_more_details($data_id,$tbl_name);  
        }
        else if($from == 'payment'){
            $tbl_name       = 'payments';
            $data['from']   = "payment";
            $data['result']     = $this->web_model->get_more_details($data_id,$tbl_name); 
        }
        else if($from == 'user'){
            $tbl_name       = 'crm_users';
            $data['from']   = "user";
            $data['result']     = $this->web_model->get_more_details($data_id,$tbl_name); 
        }
        
        $this->load->view("ajax_data",$data); 
    }
    
    public function viewuserlist ($from = "", $data_id = ""){
        $this->load->model('web_model');
        
        if($from == 'agentuserlist'){
            $tbl_name       = 'crm_users';
            $data['from']   = "agentuserlist";
            $data['details']     = $this->web_model->get_userlist_byagent($data_id,$tbl_name); 
        }
        
        $this->load->view("ajax_data",$data); 
    }
    
}
