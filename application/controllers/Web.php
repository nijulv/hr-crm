<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends CI_Controller {

    /**
     * Index Page for this controller.
     */
    var $username = "";
    var $password = "";
    var $gen_contents = array(
        
    );
    
    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        ini_set("display_errors", "0");
        error_reporting(0);
        $this->load->model('web_model');
    }

    //default index page
    public function index() {    
        
        
        $this->template->set_template('adminlogin');
        $this->template->write_view('content', 'login', $this->gen_contents);
        $this->template->render();
    }
    
    public function logincheck() {
       if (s('ADMIN_USERID')) {
            redirect('dashboard');
        } 
        else {
            //echo "here inside"; die();
            $this->gen_contents['user_id'] = $this->authentication->admin_logged_in();

            if (!empty($_POST)) {

                $this->load->library('form_validation');
                $this->_init_adminlogin_validation_rules();
                //server side validation of input values
                if ($this->form_validation->run() == TRUE) {// form validation
                    $this->_init_adminlogin_details();
                    $login_details['username'] = $this->username;
                    $login_details['password'] = $this->password;   
                    $login_details['type'] = $this->type;    
                    $msg = $this->authentication->process_admin_login($login_details);
                    
                    if ($msg == 'success') {
                        // Remember Password set here --- start here - added by syama
                        //$this->admin_model->setRememberPassword();
                        // Remember Password set here --- end here
                        redirect("dashboard");
                    } else if ($msg == 'inactive') {
                        sf('error_message', 'Your account has been inactivate');
                        redirect("web");
                    } else {
                        sf('error_message', 'Invalid username or password');
                        redirect("web");
                    }
                } else {
                    $this->merror = validation_errors();
                }
            }
            // Remember Password set here --- start here
            //$user_data = $this->admin_model->getRememberPassword();
            $this->session->set_userdata('c_username', @$user_data[1]);
            $this->session->set_userdata('c_password', @$user_data[0]);
            $this->session->set_userdata('c_remember', @$user_data[2]);
            // Remember Password set here --- end here
            
            $this->template->set_template('adminlogin');
            $this->template->write_view('content', 'login', $this->gen_contents);
            $this->template->render();
        }
    }
    
    function _init_adminlogin_validation_rules() {
        $this->form_validation->set_rules('username', 'username', 'required|max_length[50]');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[20]');
    }
    
    function _init_adminlogin_details() {
        $this->username = $this->input->post("username", true);
        $this->password = $this->input->post("password", true);
        $this->type = $this->input->post("type", true);
    }
    
    public function dashboard() {
        
        $this->gen_contents['link_dashboard']  = 'active';
        $this->template->write_view('content', 'dashboard', $this->gen_contents);
        $this->template->render();
    }
    
    function logout() {
        $this->authentication->admin_logout();
        redirect('web');
    }
    
    function manage_agents () {  
        
        $this->gen_contents['agents'] = $this->web_model->get_agents_names();
        $config['per_page']   = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
        if($this->input->post("search_user") != '')
            $search_user = trim($this->input->post("search_user",true));
        else 
            $search_user = '';
        
        $this->gen_contents['details'] = $this->web_model->get_agents($config['per_page'], $pagin,$search_user);
        
        $total_user = $this->web_model->get_total_rows();
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = base_url().'manage_agents';
        $config['total_rows']   = $total_user;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();     
        
        $this->gen_contents['link_agent']  = 'active';
        $this->template->write_view('content', 'agentlist', $this->gen_contents);
        $this->template->render();
    }
    
    function manage_payment () {  
        
        
        $this->gen_contents['users'] = $this->web_model->get_users();
        $config['per_page']   = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
        if($this->input->post("search_user") != '')
            $search_user = trim($this->input->post("search_user",true));
        else 
            $search_user = '';
        
        $this->gen_contents['details'] = $this->web_model->get_payments($config['per_page'], $pagin,$search_user);
        
        $total_user = $this->web_model->get_total_rows();
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = base_url().'manage_payment';
        $config['total_rows']   = $total_user;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();     
        
        $this->gen_contents['link_payment']  = 'active';
        $this->template->write_view('content', 'payment', $this->gen_contents);
        $this->template->render();
    }
    
    public function add_payments () {
        
        
        $this->form_validation->set_rules('user', 'User', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
            $page = 1;
            if($this->form_validation->run() == TRUE){
                
                $userdata = array(
                    "user_id"   => $this->input->post("user",true),
                    "title"  => $this->input->post("title",true),
                    "amount"  => $this->input->post("amount",true),
                    "comments"  => $this->input->post("comments",true),
                    "agent_id"  => s('ADMIN_USERID'),
                );
                
                $tbl_name = 'payments';
                $result = $this->web_model->insert_datas($userdata,$tbl_name);
                
                if($result){
                    sf( 'success_message', "Payment details inserted successfully" );
                    //redirect("manage_payment");
                    
                    $get_user_data = $this->web_model->get_user_details($this->input->post("user",true));
                    if($get_user_data){
                        $this->gen_contents['name'] = $get_user_data['first_name'].' '.$get_user_data['last_name'];
                        $this->gen_contents['phone'] = $get_user_data['phone'];
                        $this->gen_contents['email'] = $get_user_data['email'];
                    }
                    else {
                        $this->gen_contents['name'] = '';
                        $this->gen_contents['phone'] = '';
                        $this->gen_contents['email'] = '';
                    }
                    $this->gen_contents['amount'] = $this->input->post("amount",true);
                    $this->gen_contents['title'] = $this->input->post("title",true);
                    
                    $page = 2;
                    $this->template->write_view('content', 'invoice', $this->gen_contents);
                    //$this->template->render();
                    //exit;
                }
                else {
                    sf('error_message', 'Payment details not inserted, Please try agin later');
                    redirect("manage_payment");
                }
            }
            
            $this->gen_contents['users'] = $this->web_model->get_users();
            $this->gen_contents['link_payment']  = 'active';
            if($page == 1){
                $this->template->write_view('content', 'payment_add', $this->gen_contents);
            }
            $this->template->render();
    }
    
    public function add_agents () {
        
        
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('first_name', 'First name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'numeric');
        
            if($this->form_validation->run() == TRUE){
                
                $userdata = array(
                    "agent_code"   => $this->input->post("agent_code",true),
                    "username"  => $this->input->post("username",true),
                    "password"  => $this->input->post("password",true),
                    "first_name"  => $this->input->post("first_name",true),
                    "last_name"  => $this->input->post("last_name",true),
                    "email"  => $this->input->post("email",true),
                    "phone"  => $this->input->post("phone",true),
                    "address"  => $this->input->post("address",true),
                    "pincode"  => $this->input->post("pincode",true),
                    "address"  => $this->input->post("address",true)
                );
                
                $tbl_name = 'crm_agents';
                $result = $this->web_model->insert_datas($userdata,$tbl_name);
                if($result){
                    sf( 'success_message', "Agents details inserted successfully" );
                    redirect("manage_agents");
                }
                else {
                    sf('error_message', 'Agents details not inserted, Please try agin later');
                    redirect("manage_agents");
                }
            }
            
            $this->gen_contents['link_agent']  = 'active';
            $this->template->write_view('content', 'agents_add', $this->gen_contents);
            $this->template->render();
    }
    
    public function edit_agents ($id = 0) {  
        if($id != 0 && is_numeric($id)){
            
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('first_name', 'First name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'numeric');
 
            if($this->form_validation->run() == TRUE){ 
                
                $userdata = array(
                    "agent_code"   => $this->input->post("agent_code",true),
                    "username"  => $this->input->post("username",true),
                    "password"  => $this->input->post("password",true),
                    "first_name"  => $this->input->post("first_name",true),
                    "last_name"  => $this->input->post("last_name",true),
                    "email"  => $this->input->post("email",true),
                    "phone"  => $this->input->post("phone",true),
                    "address"  => $this->input->post("address",true),
                    "pincode"  => $this->input->post("pincode",true),
                    "address"  => $this->input->post("address",true)
                );
                
                $agent_id  = $this->input->post("id",true);  
                $tbl_name = 'crm_agents';
                $result = $this->web_model->update_contents_agents($userdata,$agent_id,$tbl_name);
                if($result) {
                    sf( 'success_message', "Agent details updated successfully" );
                    redirect("manage_agents");
                }
                else {
                    sf( 'error_message', "No modification done" );
                    redirect("manage_agents");
                }
            }
            
            $this->gen_contents['link_agent']  = 'active';
            $this->gen_contents['details'] = $this->web_model->get_agent_details($id);
            $this->template->write_view('content', 'modify_agents', $this->gen_contents);
            $this->template->render();   
            
        }
        else {
            redirect("manage_agents");
        }
    }
    
    public function edit_payments ($id = 0) {  
        if($id != 0 && is_numeric($id)){
            
            $this->form_validation->set_rules('user', 'User', 'required');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
 
            if($this->form_validation->run() == TRUE){ 
                
                $userdata = array(
                    "user_id"   => $this->input->post("user",true),
                    "title"  => $this->input->post("title",true),
                    "amount"  => $this->input->post("amount",true),
                    "comments"  => $this->input->post("comments",true)
                );
                
                $payment_id  = $this->input->post("id",true);  
                $tbl_name = 'payments';
                $result = $this->web_model->update_contents($userdata,$payment_id,$tbl_name);
                if($result) {
                    sf( 'success_message', "Payment details updated successfully" );
                    redirect("manage_payment");
                }
                else {
                    sf( 'error_message', "No modification done" );
                    redirect("manage_payment");
                }
            }
            
            $this->gen_contents['link_payment']  = 'active';
            $this->gen_contents['users'] = $this->web_model->get_users();
            $this->gen_contents['details'] = $this->web_model->get_payment_details($id);
            $this->template->write_view('content', 'modify_payments', $this->gen_contents);
            $this->template->render();   
            
        }
        else {
            redirect("manage_payment");
        }
    }
    
    public function deletepayments ($payment_id = 0) { 
        if($payment_id != 0 && is_numeric($payment_id)){  
            
            $userdata = array(
                    "status"   => '0'
            );
            
            $tbl_name = 'payments';   
            $result = $this->web_model->update_contents($userdata,$payment_id,$tbl_name);
            if($result) {
                sf( 'success_message', "Payment details deleted successfully" );
                redirect("manage_payment");
            }
            else {
                sf( 'error_message', "Payment details not deleted,Please try again later" );
                redirect("manage_payment");
            }
        }
        else {
            redirect("manage_payment");
        }
    }
    
    public function deleteagent ($agent_id = 0) { 
        if($agent_id != 0 && is_numeric($agent_id)){  
            
            $userdata = array(
                    "status"   => '0'
            );
            
            $tbl_name = 'crm_agents';   
            $result = $this->web_model->update_contents_agents($userdata,$agent_id,$tbl_name);
            if($result) {
                sf( 'success_message', "Agent details deleted successfully" );
                redirect("manage_agents");
            }
            else {
                sf( 'error_message', "Agent details not deleted,Please try again later" );
                redirect("manage_agents");
            }
        }
        else {
            redirect("manage_agents");
        }
    }
    
    
}
