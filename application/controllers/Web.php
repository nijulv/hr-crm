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
        
        $this->template->write_view('content', 'dashboard', $this->gen_contents);
        $this->template->render();
    }
    
    function logout() {
        $this->authentication->admin_logout();
        redirect('web');
    }
    
    
    
    public function manage_payment(){
        
        $page = 'payment';                       
        
        if($this->input->post("record_page_limit")){
            $this->session->set_userdata('page_limit', $this->input->post("record_page_limit"));
            $config['per_page']   = s('page_limit');   
        }
        else if(NULL != s('page_limit')){
            $config['per_page']   = s('page_limit');
        }  
        else {
             $config['per_page']   = 25;
        }
        
        $this->gen_contents['per_page'] = $config['per_page'];
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
        if($this->input->post("contact_name_search") != '')
            $contact_name_search = trim($this->input->post("contact_name_search",true));
        else 
            $contact_name_search = '';
        if($this->input->post("city_suburb_search") != '')
            $city_suburb_search = $this->input->post("city_suburb_search",true);
        else 
            $city_suburb_search = '';
        if($this->input->post("status_search") != '')
            $status_search = $this->input->post("status_search",true);
        else 
            $status_search = '';
        if($this->input->post("email_search") != '')
            $email_search = trim($this->input->post("email_search",true));
        else 
            $email_search = '';
        if($this->input->post("company_search") != '')
            $company_search = trim($this->input->post("company_search",true));
        else 
            $company_search = '';
        if($this->input->post("postcode_search") != '')
            $postcode_search = trim($this->input->post("postcode_search",true));
        else 
            $postcode_search = '';
        
        $this->gen_contents['users'] = $this->admin_model->get_users($config['per_page'], $pagin,$contact_name_search,$city_suburb_search,$status_search,$email_search,$company_search,$postcode_search,$user_id);
        
        $total_user = $this->admin_model->get_total_rows();
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'users';
        $config['total_rows']   = $total_user;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();
        
        $this->gen_contents['page_heading'] = 'Manage Suppliers';
        $this->template->set_template('admin');
        $this->template->write_view('content', $page, $this->gen_contents);
        $this->template->render();
    }
}
