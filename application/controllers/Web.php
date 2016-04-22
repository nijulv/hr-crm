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
    
    function manage_payment () {
        
        
        $this->gen_contents['users'] = $this->web_model->get_users();
        $config['per_page']   = 25;
        $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  
        
        if($this->input->post("search_user") != '')
            $search_user = trim($this->input->post("search_user",true));
        else 
            $search_user = '';
        
        $this->gen_contents['payments'] = $this->web_model->get_payments($config['per_page'], $pagin,$search_user);
        
        $total_user = $this->web_model->get_total_rows();
        //--pagination
        $this->load->library('pagination');
        $this->load->library('bspagination');   
        $config['base_url']     = admin_url().'users';
        $config['total_rows']   = $total_user;
        $bs_init = $this->bspagination->config();
        $config = array_merge($config, $bs_init);
        $this->pagination->initialize($config);
        $this->gen_contents['links'] =  $this->pagination->create_links();
        
        
        $this->template->write_view('content', 'payment', $this->gen_contents);
        $this->template->render();
    }
    
    
}
