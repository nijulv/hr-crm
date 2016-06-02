<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mobile extends CI_Controller {

    var $gen_contents = array();
    var $zipcode_details = array();
    
    var $account_type = '';
    var $switch_account_status = '';
    var $prviously_trainer = '0';
    var $push_badge = 1;
    
    var $failed_string = 'failed';
    
    var $success_string = 'success';
    
    
    public function __construct()
    {
        parent::__construct();       
        $this->load->model('Web_model');  
    }
    /* All request from mobile will come to this function */
    function request() {
        
        $decoded_data_array = file_get_contents('php://input');   
        $decoded_data_array = @json_decode($decoded_data_array);
        $decoded_data_array = @$decoded_data_array->mobile_data;
        
        $request_type = @$decoded_data_array->request_type;
       
        switch ($request_type) {
            case 'login' :
                $this->login($decoded_data_array);
                break;
            case 'forgot':
                $this->forgot($decoded_data_array);
                break;
            case 'agent_list':
                $this->manage_agent_list($decoded_data_array);
                break;
            case 'create_agent':
                $this->create_agent($decoded_data_array);
                break;
            case 'modify_agent':
                $this->modify_agent($decoded_data_array);
                break;
            case 'delete_agent':
                $this->delete_agent($decoded_data_array);
                break;
            case 'agent_change_status':
                $this->agent_change_status($decoded_data_array);
                break;
             case 'paymentlist':
                $this->manage_payment_list($decoded_data_array);
                break;
            case 'create_payment':
                $this->create_payment($decoded_data_array);
                break;
            case 'modify_payment':
                $this->modify_payment($decoded_data_array);
                break;
            case 'delete_payment':
                $this->delete_payment($decoded_data_array);
                break;
            case 'bankpaymentlist':
                $this->manage_bankpaymentlist($decoded_data_array);
                break;
            case 'create_bankpayment':
                $this->create_bankpayment($decoded_data_array);
                break;
            case 'modify_bankpayment':
                $this->modify_bankpayment($decoded_data_array);
                break;
            case 'delete_bankpayment':
                $this->delete_bankpayment($decoded_data_array);
                break;
            case 'agent_reports':
                $this->agent_reports($decoded_data_array);
                break;
            case 'agent_reports_popup':
                $this->agent_reports_popup($decoded_data_array);
                break;
            case 'user_reports':
                $this->user_reports($decoded_data_array);
                break;
            case 'user_reports_popup':
                $this->user_reports_popup($decoded_data_array);
                break;
            case 'payment_reports':
                $this->payment_reports($decoded_data_array);
                break;
            case 'payment_reports_popup':
                $this->payment_reports_popup($decoded_data_array);
                break;
            case 'dashboard':
                $this->dashboard($decoded_data_array);
                break;
            case 'create_todo':
                $this->create_todo($decoded_data_array);
                break;
            case 'modify_todo':
                $this->modify_todo($decoded_data_array);
                break;
            case 'delete_todo':
                $this->delete_todo($decoded_data_array);
                break;
            case 'update_admin_profile':
                $this->update_admin_profile($decoded_data_array);
                break;
            case 'update_agent_profile':
                $this->update_agent_profile($decoded_data_array);
                break;
            case 'change_password':
                $this->change_password($decoded_data_array);
                break;
            case 'userlist':
                $this->manage_user_list($decoded_data_array);
                break;
            case 'userlist_popup':
                $this->userlist_popup($decoded_data_array);
                break;
            case 'delete_user':
                $this->delete_user($decoded_data_array);
                break;
            case 'create_user':
                $this->create_user($decoded_data_array);
                break;
            case 'modify_user':
                $this->modify_user($decoded_data_array);
                break;
            case 'states_list':
                $this->states_list($decoded_data_array);
                break;
            case 'district_list':
                $this->district_list($decoded_data_array);
                break;
            case 'user_list':
                $this->user_list($decoded_data_array);
                break;
            case 'username_byid':
                $this->username_byid($decoded_data_array);
                break;
            default:
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Invalid request type'))));
                return;
        }
    }
    
    
    function username_byid ($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $user_id = $data->user_id;
        if($user_id != 0 && is_numeric($user_id)){
            $this->load->model('web_model'); 
            $userlist = $this->web_model->get_username($user_id);
            return $userlist;
        }
        else {   
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
    }
    
    function user_list ($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $userlist = $this->web_model->get_users();
        return $userlist;
    }
    
   function states_list($data = array()){
        $this->load->model('web_model'); 
        $states = $this->web_model->get_state_details();
        return $states;
    }
    
    function district_list ($data = array()){
        $this->load->model('web_model'); 
        $state_id = $data->state_id;
        if($state_id != 0 && is_numeric($state_id)){
            $district_details = $this->web_model->get_district_details($state_id);
            return $district_details;
        }
        else {   
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
    }
            
    function  modify_user($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $user_id = $data->user_id;
        if($user_id != 0 && is_numeric($user_id)){
            $update_data = array(
                        'first_name'            => $data->firstname,  
                        'last_name'             => $data->lastname,  
                        'email'                 => $data->email, 
                        'phone'                 => $data->phonenumber,  
                        'state_id'              => $data->state_id, 
                        'district_id'           => $data->district_id,  
                        'city'                  => $data->city, 
                        'address'               => $data->address,  
                        'pincode'               => $data->pincode, 
                        'status'                => $data->userstatus, 
                    );         
            
            $file_name = @$_POST['image_name'];
            if(!empty($file_name)){
                $newname = $_FILES['image_cam']['name'];
                $target = './attachment/'.$newname;
                if($_FILES['image_cam']['type'] != 'pdf|doc|docx'){
                    $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Unsupported filetype uploaded.'))));
                    return; 
                }
                if(move_uploaded_file($_FILES["image_cam"]["tmp_name"], $target)){
                    
                    $where = array('user_id' => $user_id);
                    $get_image_details = $this->web_model->get_imagedetails($where);		
                    $get_image_details = @$get_image_details[0]['attachments'];
                    unlink('attachment/'.$get_image_details);
                    
                    $update_data['attachments'] = $file_name;
                }
                else {
                    $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Attachment not uploaded,Please try again later.'))));
                    return;
                }
            }
            $where = array('user_id' => $user_id);
            $sts = $this->db->update('crm_users', $update_data,$where);
            if($sts) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'User details modified successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No modification done.'))));
                return;
            }
        }
        else {   
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }  
    }
    
    function  create_user($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        if(s('ADMIN_TYPE') == 1){
            $agent_id = s('ADMIN_USERID');
        }
        else {
            $agent_id = 0;
        }
        $update_data = array(
                    'agent_id'              => $agent_id,
                    'first_name'            => $data->firstname,  
                    'last_name'             => $data->lastname, 
                    'email'                 => $data->email, 
                    'state_id'              => $data->state_id,  
                    'district_id'           => $data->district_id,  
                    'city'                  => $data->city,  
                    'phone'                 => $data->phonenumber,  
                    'address'               => $data->address,  
                    'pincode'               => $data->pincode,  
                    'status'                => $data->userstatus,
                    'date'                  => date('Y-m-d')
                );
        $file_name = @$_POST['image_name'];
        if(!empty($file_name)){
            $newname = $_FILES['image_cam']['name'];
            $target = './attachment/'.$newname;
            if($_FILES['image_cam']['type'] != 'pdf|doc|docx'){
               $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Unsupported filetype uploaded.'))));
                return; 
            }
            if(move_uploaded_file($_FILES["image_cam"]["tmp_name"], $target)){
                $update_data['attachments'] = $file_name;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Attachment not uploaded,Please try again later.'))));
                return;
            }
        }
        
        $sts = $this->db->insert('crm_users', $update_data);
        if($sts) {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'User details added successfully.'))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Sorry. There is a problem to add details.'))));
            return;
        }
    }
    
    function  delete_user($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $user_id  = $data->user_id; 
        if($user_id != 0 && is_numeric($user_id)){
            $delete = 2;
            $update_data = array(
                        'status'   => $delete
                    );
            $where = array('user_id' => $user_id);
            $sts = $this->db->update('crm_users', $update_data,$where);
            if($sts) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'User details deleted successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'User details not deleted,Please try again later.'))));
                return;
            } 
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
    }
    
    function  userlist_popup($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $user_id  = $data->user_id; 
        if($user_id != 0 && is_numeric($user_id)){          
            $tbl_name = 'crm_users';
            $more_info = $this->web_model->get_user_details($user_id);  
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'more_info' => $more_info))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        
    }
    
    function  manage_user_list($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $where = array();
        if(s('ADMIN_TYPE') == 1){
            $where = array('agent_id' => s('ADMIN_USERID'));
        }
        $user_list = $this->web_model->get_userdetails($where,"","","0",1);
        $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'user_list' => $user_list))));
        return;
    }
    
    function  change_password($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $this->load->model('web_model'); 
        $userdata = array(
                    "password" => $data->newpassword
                );
        $id = s('ADMIN_USERID');
        $old_password =  $data->oldpassword;
        $check_oldpassword = $this->web_model->check_oldpassword($old_password,$id); 
        if($check_oldpassword){
            $result = $this->web_model->update_password($userdata,$id);
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Password modified successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No modification done.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Please check your old password.'))));
            return;
        }         
    }
    
    function  update_agent_profile($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $id = $data->id;
        if($id != 0 && is_numeric($id)){
            us('ADMIN_USERID','');
            ss('ADMIN_USERID',$id);
            $userdata = array(
                                "username"   => $data->username, 
                                "first_name" => $data->first_name, 
                                "last_name"  => $data->last_name, 
                                "email"      => $data->email,
                                "phone"      => $data->phone,  
                                "agent_code" => $data->agent_code, 
                                "address"    => $data->address,  
                                "pincode"    => $data->pincode,  
                            );
            $id = s('ADMIN_USERID');   
            $tbl_name = 'crm_agents';  
            $result = $this->web_model->update_profile($userdata,$id,$tbl_name); 
            if($result) {
                us('ADMIN_NAME','');
                ss('ADMIN_NAME',$data->first_name);
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Profile details updated successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No modification done.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
    }
    
    function  update_admin_profile($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $id = $data->id;
        if($id != 0 && is_numeric($id)){
            us('ADMIN_USERID','');
            ss('ADMIN_USERID',$id);
            
            $userdata = array(
                            "username"    => $data->username, 
                            "first_name"  => $data->first_name, 
                            "last_name"   => $data->last_name, 
                            "email"       => $data->email, 
                            "phone"       => $data->phone, 
                        );
            $id = s('ADMIN_USERID');   
            $tbl_name = 'crm_admin';
            $result = $this->web_model->update_profile($userdata,$id,$tbl_name); 
            if($result) {
                us('ADMIN_NAME','');
                ss('ADMIN_NAME',$data->first_name);
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Profile details updated successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No modification done.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
    }
    
    function  delete_todo($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $todo_id  = $data->todo_id;  
        if($todo_id != 0 && is_numeric($todo_id)){
            $result = $this->web_model->delete_todo_details($todo_id);
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'To-do details deleted successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'To-do details not deleted,Please try again later.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
    }
    
    function  modify_todo($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $todo_id  = $data->todo_id; 
        if($todo_id != 0 && is_numeric($todo_id)){
            $update_data = array(
                    'todo'                  => $data->todo,
                    'date'                  => $data->date
            );
            $tbl_name = 'todo';
            $result = $this->web_model->update_contents_todo($update_data,$todo_id,$tbl_name); 
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'To-do details modified successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No modification done.'))));
                return;
            }
        }  
    }
    
    function  create_todo($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        if(s('ADMIN_TYPE') == 0){
            $admin_id = 'admin';
        }
        else{
            $admin_id = $this->session->userdata("ADMIN_USERID");
        }
        $userdata = array(
                    'admin_id'              => $admin_id,
                    'todo'                  => $data->todo, 
                    'date'                  => $data->date
                );
        $tbl_name = 'todo';
        $result = $this->web_model->insert_datas($userdata,$tbl_name);
        if($result){      
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'To-do details inserted successfully.'))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'To-do details not inserted, Please try agin later.'))));
            return;
        }
    }
    
    function  dashboard($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $this->load->helper('date');
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $users_count  = $this->web_model->get_total_users_count($status = '1');
        $guest_count  = $this->web_model->get_total_users_count($status = '0');
        $payment_count  = $this->web_model->get_total_payment_count();
        $agent_count  = $this->web_model->get_total_agent_count();
        $todolist  = $this->web_model->get_todo();
        $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'users_count' => $users_count,'guest_count' => $guest_count,'payment_count' => $payment_count,'agent_count' => $agent_count,'todolist' => $todolist))));
        return;
    }
    
    function  payment_reports_popup($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $payment_id  = $data->payment_id; 
        if($payment_id != 0 && is_numeric($payment_id)){
            
            $tbl_name = 'payments';
            $more_info = $this->web_model->get_more_details($payment_id,$tbl_name);  
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'more_info' => $more_info))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
    }
    
    function  payment_reports($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $paymentlist = $this->web_model->get_payment_reportlist("", "","","","","",1);
        $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'paymentlist' => $paymentlist))));
        return;
    }
    
    function  user_reports_popup($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $user_id  = $data->user_id; 
        if($user_id != 0 && is_numeric($user_id)){
            
            $tbl_name = 'crm_users';
            $more_info = $this->web_model->get_more_details($user_id,$tbl_name);  
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'more_info' => $more_info))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
    }
    
    function  user_reports($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $userlist = $this->web_model->get_user_reportlist("","","","","","","","","",",1");
        $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'userlist' => $userlist))));
        return;
    }
    
    function  agent_reports_popup($data = array()){
      if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }  
        $this->load->model('web_model'); 
        $agent_id  = $data->agent_id; 
        if($agent_id != 0 && is_numeric($agent_id)){
            
            $tbl_name = 'crm_agents';
            $more_info = $this->web_model->get_more_details($agent_id,$tbl_name);  
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'more_info' => $more_info))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
    }
    
    function  agent_reports($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $agent_list = $this->web_model->get_agent_reportlist("", "","","","","","","","","",1);
        $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'agent_list' => $agent_list))));
        return;
    }
    
    function  delete_bankpayment($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $bank_payment_id  = $data->bank_payment_id;  
        if($bank_payment_id != 0 && is_numeric($bank_payment_id)){
            $userdata = array(
                    "status"   => '0'
            );
            $tbl_name = 'crm_bank_payment';
            $result = $this->web_model->update_contents_bankpayment($userdata,$bank_payment_id,$tbl_name);
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Bank payment details deleted successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Bank payment details not deleted,Please try again later.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
    }
    
    function  modify_bankpayment($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $bank_payment_id  = $data->bank_payment_id; 
        if($bank_payment_id != 0 && is_numeric($bank_payment_id)){
            //$user_id = implode(",",$data->user);
            $userdata = array(
                    "amount_hand"     => $data->amount_hand,  
                    "bank_payment"    => $data->bank_payment,   
                    "reason"          => $data->reason,
                    "user_id"         => $data->user_id
                );

            $tbl_name = 'crm_bank_payment';
            $result = $this->web_model->update_contents_bankpayment($userdata,$bank_payment_id,$tbl_name); 
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Bank payment details updated successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No modification done.'))));
                return;
            }
        }
        else {
             $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
    }
    
    function  create_bankpayment($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $this->load->model('web_model'); 
        if(s('ADMIN_TYPE') == 1){
            $agent_id = s('ADMIN_USERID');
        }
        else {
            $agent_id = 0;
        }
        //$user_id = implode(",",$data->user);
        $userdata = array(
                    "amount_hand"   => $data->amount_hand,  
                    "bank_payment"    => $data->bank_payment,   
                    "reason"          => $data->reason,   
                    "agent_id"        => $agent_id,
                    "user_id"         => $data->user_id,
                    "date"            => date('Y-m-d')
                );
        $tbl_name = 'crm_bank_payment';
        $result = $this->web_model->insert_datas($userdata,$tbl_name);
        if($result){      
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Bank payment details inserted successfully.'))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Bank payment details not inserted, Please try agin later.'))));
            return;
        }
    }
    
    function  manage_bankpaymentlist($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $this->load->model('web_model'); 
        $bankpayment_list = $this->web_model->get_bank_payments_api("","",1);
        
        $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'bankpayment_list' => $bankpayment_list))));
        return;
    }
    
    function  delete_payment($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $payment_id  = $data->payment_id; 
        if($payment_id != 0 && is_numeric($payment_id)){  
            $userdata = array(
                    "status"   => '0'
                );
            $tbl_name = 'payments';
            $result = $this->web_model->update_contents($userdata,$payment_id,$tbl_name);
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Payment details deleted successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Payment details not deleted,Please try again later.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
    }
    
    function  modify_payment($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $payment_id  = $data->payment_id; 
        if($payment_id != 0 && is_numeric($payment_id)){  
            $userdata = array(
                            "user_id"   => $data->user_id, 
                            "title"  => $data->title, 
                            "amount"  => $data->amount,
                            "comments"  => $data->comments 
                        );
            $tbl_name = 'payments';
            $result = $this->web_model->update_contents($userdata,$payment_id,$tbl_name);
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Payment details updated successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No modification done.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
    }
    
    function  create_payment($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        if(s('ADMIN_TYPE') == 1){
            $agent_id = s('ADMIN_USERID');
        }
        else {
            $agent_id = 0;
        }
        $userdata = array(
                    "user_id"  => $data->user_id,  
                    "title"    => $data->title,  
                    "amount"   => $data->amount,  
                    "comments" => $data->comments,  
                    "agent_id" => $agent_id,
                    'date'     => date('Y-m-d')
                );
        $tbl_name = 'payments';
        $result = $this->web_model->insert_datas($userdata,$tbl_name);
        if($result){
            $datas = array(
                        'status'  => '1'
                    );
            $change_user_status = $this->web_model->user_status_update($datas,$data->user);
            $admin_details = $this->web_model->get_admin_details();
            if($admin_details){
                $admin_email = $admin_details['email'];
                $admin_phone = $admin_details['phone'];
            }
            else {
                $admin_email = '';
                $admin_phone = '';
            }
            $get_user_data = $this->web_model->get_user_details($data->user);
            if($get_user_data){
                $user_name = $get_user_data['first_name'].' '.$get_user_data['last_name'];
                $user_phone = $get_user_data['phone'];
                $user_email = $get_user_data['email'];
            }
            else {
                $user_name = '';
                $user_phone = '';
                $user_email = '';
            }       
            $payment_amount = $data->amount;
            $payment_title = $data->title;       
                    
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Payment details inserted successfully.', 'admin_email' => $admin_email,'admin_phone' => $admin_phone,'user_name' => $user_name,'user_phone' => $user_phone, 'user_email' => $user_email,'payment_amount' => $payment_amount,'payment_title' => $payment_title))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Payment details not inserted, Please try agin later.'))));
            return;
        }
    }
    
    function  manage_payment_list($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model');
        $type = $data->type;
        $id = $data->id;
        us('ADMIN_TYPE','');
        us('ADMIN_USERID','');
        ss('ADMIN_TYPE',$type);
        ss('ADMIN_USERID',$id);
        
        $payment_list = $this->web_model->get_payments("","","","","","","",1);
        $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'payment_list' => $payment_list))));
        return;
    }
    
    function  agent_change_status($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $agent_id  = $data->agent_id; 
        if($agent_id != 0 && is_numeric($agent_id)){  
            $getstatus = $this->web_model->get_agent_status($agent_id);
            $getstatus = $getstatus[0]['status'];
            if($getstatus == 1){
                $status = 2;
            }
            else {
                $status = 1;
            }
            $update_data = array(
                            'status'   => $status
                          );
            $where = array('agent_id' => $agent_id);
            $result = $this->db->update('crm_agents', $update_data,$where);
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Status changed successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Sorry. There is a problem to modify details.'))));
                return;
            } 
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
        
    }
    
    function  delete_agent($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $agent_id  = $data->agent_id; 
        if($agent_id != 0 && is_numeric($agent_id)){  
            $userdata = array(
                            "status"   => '0'
                        );
            $tbl_name = 'crm_agents';
            $result = $this->web_model->update_contents_agents($userdata,$agent_id,$tbl_name);
            if($result) {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Agent details deleted successfully.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Agent details not deleted,Please try again later.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        } 
    }
    
    function  modify_agent($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $userdata = array(
            "agent_code"            => $data->agent_code, 
            "username"              => $data->username,
            "password"              => $data->password,
            "first_name"            => $data->first_name,
            "last_name"             => $data->last_name,
            "email"                 => $data->email,
            "phone"                 => $data->phone,
            "address"               => $data->address,
            "pincode"               => $data->pincode,
            'state_id'              => $data->state,
            'district_id'           => $data->district,
            'city'                  => $data->city
        );
        $agent_id  = $data->agent_id; 
        $tbl_name = 'crm_agents';
        
        $result = $this->web_model->update_contents_agents($userdata,$agent_id,$tbl_name);
        if($result) {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Agent details updated successfully.'))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No modification done.'))));
            return;
        }
    }
    
    function  create_agent($data = array()){
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model'); 
        $this->load->helper('string');
        $rand_no = random_string('alnum',20);
                    
        $userdata = array(
            "agent_code"            => $data->agent_code, 
            "username"              => $data->username,
            "password"              => $data->password,
            "first_name"            => $data->first_name,
            "last_name"             => $data->last_name,
            "email"                 => $data->email,
            "phone"                 => $data->phone,
            "address"               => $data->address,
            "pincode"               => $data->pincode,
            'state_id'              => $data->state,
            'district_id'           => $data->district,
            'city'                  => $data->city,
            'number'                => $rand_no,
            'date'                  => date('Y-m-d')
        );
        $tbl_name = 'crm_agents';
        $result = $this->web_model->insert_datas($userdata,$tbl_name);
        if($result){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Agents details inserted successfully.'))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Agents details not inserted, Please try agin later.'))));
            return;
        }
    }
    
    function manage_agent_list($data = array()){
        $this->load->model('web_model'); 
        $agent_list = $this->web_model->get_agents("","","","","","",1);
        $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'agent_list' => $agent_list))));
        return;
    }
        
    function login($data = array()) {
        if(empty($data)){
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
        $this->load->model('web_model');  
        $login_details['username'] = $data->username; 
        $login_details['password'] = $data->password; 
        $login_details['type'] = $data->type; 
        $status = $this->authentication->process_admin_login($login_details);
        if ($status == 'success') {
            $userdetails = $this->web_model->get_logged_user_details($data->type);
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Login Successful.','userdetails' => $userdetails ))));
            return;
        }
        else if ($status == 'waiting') {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Your account waiting for approval by admin.'))));
            return;
        }
        else if ($status == 'blocked') {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Your account blocked by admin.'))));
            return;
        }
        else if ($status == 'deleted') {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Invalid username or password.'))));
            return;
        }
        else if ($status == 'inactive') {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Your account is inactive.'))));
            return;
        }
        else if ($status == 'emailactivation') {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Your account is inactive. Please check your mail for activation link.'))));
            return;
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Email id or password provided is incorrect.'))));
            return;
        }
    }
    
    function forgot($data = array()) {
        $this->load->model('web_model'); 
        $this->load->helper('email_helper');
        $this->load->helper('string_helper');
        $this->load->model('web_model');
        if (!empty($data)) {
            $username = $data->username;
            $type = $data->type;
            $details = $this->web_model->get_details_byusername($username,$type);
            if (!empty($details)) {
                
                process_and_send_mail($details['email'], array('first_name' => $details['first_name'],
                    'user_name' => $details['username'],
                    'Password' => $details['password'],
                    'regards_name' => c('regards_name'),
                    'email_bottom_instruction' => c('email_bottom_instruction')
                        ), 'forgot_password', array(), array(), '', '');
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'success', 'message' => 'Your login details sended successfully,Please check your email.'))));
                return;
            }
            else {
                $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'Please check your username.'))));
                return;
            }
        }
        else {
            $this->load->view('ajax_view', array('ajax_response' => json_encode(array('status' => 'error', 'message' => 'No data found.'))));
            return;
        }
    }
    
    function isValidApiKey($apikey) {
        $api_keys = c('mobile_access_api_keys');
        if (in_array($apikey, $api_keys)) {
            return TRUE;
        }
        return FALSE;
    }
    
}

/* End of file Mobile.php */
/* Location: ./application/controllers/Mobile.php */