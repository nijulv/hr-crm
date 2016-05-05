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
    
    public function forgotpassword () {
        
        
        $this->form_validation->set_rules('username', 'Username', 'required');
       
        if($this->form_validation->run() == TRUE){
            $username = $this->input->post("username",true);  
            $type = $this->input->post("type",true);
            if(!empty($username)){ 
                
                $details = $this->web_model->get_details_byusername($username,$type); 
                if($details) {         
                    
                    $this->load->helper('email_helper');
                    $this->gen_contents["mail_template"]  =  $this->web_model->get_mail_template(1);
                    $to = $details['email'];   
                    $firstname = $details['first_name'];
                    $subject = 'Forgot Password';
                    $message= "Hi ".$firstname."<br/>Please find your login details.<br/><br/><br/>"
                    ."<b>Username</b>  ".$details['username']."<br/>"
                    ."<b>Password</b>  ".$details['password'];

                    $mail_body  = sprintf($this->gen_contents["mail_template"]["mail_body"],$firstname,$message);
                    
                    $from_name  = $this->gen_contents["mail_template"]["mail_from_name"];
                    $from_email = $this->gen_contents["mail_template"]["mail_from"];
                    send_mail($to, $from_name,$subject,$mail_body,$from_email);

                    sf( 'success_message', "Your login details sended successfully,Please check your email." );
                    redirect("web"); 
                }
                else {
                    sf( 'error_message', "Please check your username" );
                     redirect("web");
                }
            } 
        }
        
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
         
        if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            $this->load->helper('date');
            $this->gen_contents['users_count']  = $this->web_model->get_total_users_count($status = '1');
            $this->gen_contents['guest_count']  = $this->web_model->get_total_users_count($status = '0');
            $this->gen_contents['payment_count']  = $this->web_model->get_total_payment_count();
            $this->gen_contents['todo']  = $this->web_model->get_todo();
            $this->gen_contents['link_dashboard']  = 'active';
            $this->template->write_view('content', 'dashboard', $this->gen_contents);
            $this->template->render();
        }
    }
    
    function logout() {
        
        $this->authentication->admin_logout();
        redirect('web');
    }
    function todo() { 
        $result=array('succes' => 0,'msg'=> '','html'=> '');
        $data=$this->input->post('todo');
        $date= $this->input->post('calendar');
        $currentdate=date('Y-m-d');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('todo','Schedule', 'required');
        $this->form_validation->set_rules('calendar','Date', 'required');
        if ($this->form_validation->run() == TRUE) {

            if(s('ADMIN_TYPE') == 0){
                $admin_id='admin';
            }
            else{
                $admin_id=$this->session->userdata("ADMIN_USERID");
            }
            $update_data = array(
                    'admin_id'              => $admin_id,
                    'todo'                  => $data,
                    'date'                  => $date
            );
            $save = $this->db->insert('todo', $update_data);
            $id   = $this->db->query('SELECT MAX(id) AS maxid FROM todo')->row()->maxid;
            if($save){
                if($currentdate==$date)
                    {
                $result['success']=1;
                $result['msg']='<font color="green">Saved!!!!</font>';
                $result['html'] ='<li class="todo-list-item">
                                        <div class="checkbox">
                                            <input type="checkbox" id="checkbox">
                                            <label for="checkbox">'.$data.'</label>
                                        </div>
                                        <div class="pull-right action-buttons">
                                            <a href="#"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil" xmlns:xlink="http://www.w3.org/1999/xlink"/></svg></a>
                                            <a class="flag" href="#"><svg class="glyph stroked flag"><use xlink:href="#stroked-flag" xmlns:xlink="http://www.w3.org/1999/xlink"/></svg></a>
                                            <a  id="deletetodo" data-url="deletetodo" class="trash deletetodo" data-id='.$id.'><svg class="glyph stroked trash"><use xlink:href="#stroked-trash" xmlns:xlink="http://www.w3.org/1999/xlink"/></svg></a>
                                        </div>
                                    </li>';

            
        }
        else{
            $result['msg']='<font color="green">Saved!!!!</font>';
        }
        }
        }
        else{
             $result['msg']='<font color="red">Error!!!!</font>';
        }
        $this->load->view('show_message',array('message'=>  json_encode($result)));
   
    }
    function deletetodo($todoid) { 
       $id   = $this->db->query('DELETE FROM todo where id='.$todoid);
       redirect('dashboard');
      
    }

    function manage_agents () {  
        
       if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            //$this->gen_contents['agents'] = $this->web_model->get_agents_names();
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
    }
    
    function manage_cash () {  
        
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            $this->gen_contents['users'] = $this->web_model->get_users();
            $config['per_page']   = 25;
            $pagin = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;  

            if($this->input->post("search_user") != '')
                $search_user = trim($this->input->post("search_user",true));
            else 
                $search_user = '';

            $this->gen_contents['details'] = $this->web_model->get_bank_payments($config['per_page'], $pagin);
            $total_record = $this->web_model->get_total_rows();
            //--pagination
            $this->load->library('pagination');
            $this->load->library('bspagination');   
            $config['base_url']     = base_url().'manage_cash';
            $config['total_rows']   = $total_record;
            $bs_init = $this->bspagination->config();
            $config = array_merge($config, $bs_init);
            $this->pagination->initialize($config);
            $this->gen_contents['links'] =  $this->pagination->create_links();     

            $this->gen_contents['link_bank']  = 'active';
            $this->template->write_view('content', 'bank_paymentlist', $this->gen_contents);
            $this->template->render();
        }
    }
    
    function manage_payment () {  
        
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            //$this->gen_contents['users'] = $this->web_model->get_users();
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
    }
    public function manageuser() {  
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            $this->load->library('pagination');
            $agent_id=$this->session->get_userdata('session_data'); 
            $agent_id=$agent_id['ADMIN_USERID'];
            $where = array();
            if(s('ADMIN_TYPE') == 1){
                  $where = array('agent_id' => $agent_id);
            }

            $total_count = $this->web_model->get_userdetails_count($where);
            $config['base_url'] = base_url().'manageuser';
            $config['total_rows'] = $total_count;
            $config['per_page'] = 25;
            $config['display_pages'] = true; 
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] ="</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            $config['page_query_string'] = FALSE;
            if($this->uri->segment(2)){
                $page = $this->uri->segment(2);
            }else{
                $page = 0;
            }
            $this->pagination->initialize($config);
            $this->gen_contents['results'] = $this->web_model->get_userdetails($where,$page,$config['per_page']);
            $this->gen_contents['js_files'] = array(); 
            $this->gen_contents['link_user']  = 'active';
            $this->template->write_view('content', 'manageuser', $this->gen_contents);
            $this->template->render();
        }
    }
    
    public function adduser() {  
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            $this->load->library('form_validation');
            if(!empty($_POST)){

                $this->form_validation->set_rules('firstname','First Name', 'required|trim|alpha_numeric');
                $this->form_validation->set_rules('city','City', 'required|trim|alpha_numeric');
                $this->form_validation->set_rules('state','State', 'required|trim');
                $this->form_validation->set_rules('district','District', 'required|trim');
                $this->form_validation->set_rules('useremail','Email', 'required|trim|is_unique[crm_users.email]');
                $this->form_validation->set_rules('phonenumber','Phone Number', 'required|numeric');
                $this->form_validation->set_rules('userstatus','Status', 'required');
                if(($this->input->post("pincode"))){
                   $this->form_validation->set_rules('pincode','Pincode', 'required|numeric|min_length[6]|max_length[6]'); 
                }
                $error = '';
                if ($this->form_validation->run() == TRUE) {
                
                if(s('ADMIN_TYPE') == 1){
                    $agent_id = s('ADMIN_USERID');
                }
                else {
                    $agent_id = 0;
                }
                
                $update_data = array(
                    'agent_id'              => $agent_id,
                    'first_name'            => $this->input->post("firstname", true),
                    'last_name'             => $this->input->post("lastname", true),
                    'email'                 => $this->input->post("useremail", true),
                    'state_id'              => $this->input->post("state", true),
                    'district_id'           => $this->input->post("district", true),
                    'city'                  => $this->input->post("city", true),
                    'phone'                 => $this->input->post("phonenumber", true),
                    'address'               => $this->input->post("useraddress", true),
                    'pincode'               => $this->input->post("pincode", true),
                    'status'                => $this->input->post("userstatus", true)
                
                );
            if(!empty($_FILES['attachment']['name'])){
                    $this->load->library('upload');
                    $image_path='./attachment/';
                    $this->upload->initialize(upload_config_image($image_path));
                    $file_name = '';
                    if($this->upload->do_upload('attachment')){
                        $img = $this->upload->data();
                        $file_name = $img['file_name'];
                        $update_data['attachments'] = $file_name;
                    }else{
                         $this->gen_contents['form_validation_error']=$this->upload->display_errors();
                        $error = "error";
                    }
                }
                if(!$error){
                    $sts = $this->db->insert('crm_users', $update_data);
                    if($sts){
                        sf( 'success_message', "User Details Added Successfully." );
                        redirect('manageuser');
                    }else{
                         $this->gen_contents['form_validation_error'] = 'Sorry. There is a problem to add details.';
                    }
                }
            
           }else{
                 $this->gen_contents['edit_return'] = 1;
                 $this->gen_contents['form_validation_error'] = validation_errors();
            }
            }
            $this->gen_contents['state_details']  = $this->web_model->get_state_details();
            $this->gen_contents['link_user']  = 'active';
            $this->template->write_view('content', 'adduser', $this->gen_contents);
            $this->template->render();
        }
           
    }
    function  district(){

        
        $state_id =  $this->input->post("state_id");
        $district_details= $this->web_model->get_district_details($state_id);
        foreach($district_details as $res){
            echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
            
        }
        
        
    }
   function edituser($user_id){
        if(!$user_id){
            redirect('manageuser');
        }
        $this->load->library('form_validation');
        if(!empty($_POST)){
            $this->form_validation->set_rules('firstname','First Name', 'required|trim|alpha_numeric');
            $this->form_validation->set_rules('city','City', 'required|trim|alpha_numeric');
            $this->form_validation->set_rules('state','State', 'required|trim');
            $this->form_validation->set_rules('district','District', 'required|trim');
            $this->form_validation->set_rules('useremail','Email', 'required|trim');
            $this->form_validation->set_rules('phonenumber','Phone Number', 'required|numeric');
            $this->form_validation->set_rules('userstatus','Status', 'required');
            if(($this->input->post("pincode"))){
                   $this->form_validation->set_rules('pincode','Pincode', 'required|numeric|min_length[6]|max_length[6]'); 
                }
            if ($this->form_validation->run() == TRUE) {// form validation                
                $update_data = array(
                    'first_name'            => $this->input->post("firstname", true),
                    'last_name'             => $this->input->post("lastname", true),
                    'email'                 => $this->input->post("useremail", true),
                    'phone'                 => $this->input->post("phonenumber", true),
                    'state_id'              => $this->input->post("state", true),
                    'district_id'           => $this->input->post("district", true),
                    'city'                  => $this->input->post("city", true),
                    'address'               => $this->input->post("useraddress", true),
                    'pincode'               => $this->input->post("pincode", true),
                    'status'                => $this->input->post("userstatus", true)
                );
                if(!empty($_FILES['attachment']['name'])){
                    $this->load->library('upload');
                    $image_path='./attachment/';
                    $this->upload->initialize(upload_config_image($image_path));
                    $file_name = '';
                    $where = array('user_id' => $user_id);
                    $get_image_details = $this->web_model->get_imagedetails($where);		
                    $get_image_details = @$get_image_details[0]['attachments'];
                    if($this->upload->do_upload('attachment')){
                        unlink('attachment/'.$get_image_details);
                        $img = $this->upload->data();
                        $file_name = $img['file_name'];
                        $update_data['attachments'] = $file_name;
                   }else{
                        $this->gen_contents['form_validation_error'] = $this->upload->display_errors();
                        $error = "error";
                    }
                }
                if(!$error){
                   $where = array('user_id' => $user_id);
                   $sts = $this->db->update('crm_users', $update_data,$where);
                    if($sts){
                        sf( 'success_message', "User Details Updated Successfully." );
                        redirect('manageuser');
                    }else{
                        sf( 'error_message', "No modification done" );
                        redirect("manageuser");
                    }
                }
            }else{
                 $this->gen_contents['edit_return'] = 1;
                 $this->gen_contents['form_validation_error'] = validation_errors();
            }
        }
        $get_user_details = $this->web_model->get_user_detail($user_id);		
        $this->gen_contents['user_details']=$get_user_details[0];
        if(empty($get_user_details)){ 
            redirect('manageuser');
        }
        $this->gen_contents['state_details']  = $this->web_model->get_state_details();
        $state_id=($get_user_details[0]['state_id']);
        $this->gen_contents['district_details']= $this->web_model->get_district_details($state_id);
        $this->gen_contents['link_user']  = 'active';
        $this->template->write_view('content', 'edituser', $this->gen_contents);
        $this->template->render();
    }
    function viewuser($user_id){
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            if(!$user_id){
                redirect('manageuser');
            }
            $get_user_details = $this->web_model->get_user_detail($user_id);
            if(empty($get_user_details)){ 
                redirect('manageuser');
            }
            $this->gen_contents['user_details']=$get_user_details[0];
            $state_id=$get_user_details[0]['state_id'];
            $district_id=$get_user_details[0]['district_id'];
            $get_state=$this->web_model->get_state($state_id);
            $this->gen_contents['get_state']=$get_state[0];
            $get_district=$this->web_model->get_district($district_id);
            $this->gen_contents['get_district']=$get_district[0];
            $this->gen_contents['link_user']  = 'active';
            $this->template->write_view('content', 'viewuser', $this->gen_contents);
            $this->template->render();
        }
    }
    function changestatus($agent_id){
       if(!$agent_id){
            redirect('manage_agents');
        } 
        $getstatus=$this->web_model->get_agent_status($agent_id);
        $getstatus=$getstatus[0]['status'];
        if($getstatus==1)
        {
        $status=2;
        }
        else
        {
            $status=1;
        }
        
        $update_data = array(
                    'status'            => $status
            );
        $where = array('agent_id' => $agent_id);
        $sts = $this->db->update('crm_agents', $update_data,$where);
        if($sts){
                    sf( 'success_message', "Status changed successfully." );
                    redirect('manage_agents');

                }else{
                    sf( 'error_message', "Sorry. There is a problem to update details." );
                    redirect('manage_agents');
                    
                } 
      
    }
    function deleteuser($user_id){

       if(!$user_id){
            redirect('manageuser');
        } 
        $delete=2;
        
        $update_data = array(
                    'status'            => $delete
            );
        $where = array('user_id' => $user_id);
        $sts = $this->db->update('crm_users', $update_data,$where);
        if($sts){
                    sf( 'success_message', "User details deleted successfully" );
                    redirect('manageuser');

                }else{
                        sf( 'error_message', "User details not deleted,Please try again later" );
                        redirect('manageuser');
                    
                } 
      
    }

    public function add_payments () {
        
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            $this->form_validation->set_rules('user', 'User', 'required');
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
            $page = 1;
            if($this->form_validation->run() == TRUE){
                
                if(s('ADMIN_TYPE') == 1){
                    $agent_id = s('ADMIN_USERID');
                }
                else {
                    $agent_id = 0;
                }
        
                $userdata = array(
                    "user_id"   => $this->input->post("user",true),
                    "title"  => $this->input->post("title",true),
                    "amount"  => $this->input->post("amount",true),
                    "comments"  => $this->input->post("comments",true),
                    "agent_id"  => $agent_id
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
    }
    
     public function add_bankpayments () {
        
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            $this->form_validation->set_rules('total_payment', 'total payment', 'required|numeric');
            $this->form_validation->set_rules('bank_payment', 'bank payment', 'required|numeric');
            
            if($this->form_validation->run() == TRUE){
                
                if(s('ADMIN_TYPE') == 1){
                    $agent_id = s('ADMIN_USERID');
                }
                else {
                    $agent_id = 0;
                }
                $user_id = implode(",",$this->input->post("user",true)); 
                $userdata = array(
                    "total_payment"   => $this->input->post("total_payment",true),
                    "bank_payment"  => $this->input->post("bank_payment",true),
                    "reason"  => $this->input->post("reason",true),
                    "agent_id"  => $agent_id,
                    "user_id"  => $user_id
                );

                $tbl_name = 'crm_bank_payment';
                $result = $this->web_model->insert_datas($userdata,$tbl_name);

                if($result){
                    sf( 'success_message', "Bank payment details inserted successfully" );
                    redirect("manage_cash");
                }
                else {
                    sf('error_message', 'Bank payment details not inserted, Please try agin later');
                    redirect("manage_cash");
                }
            }
            $this->gen_contents['users'] = $this->web_model->get_users();
            $this->gen_contents['link_bank']  = 'active';
            $this->template->write_view('content', 'bankpayment_add', $this->gen_contents);
            $this->template->render();
        }
    }
    
    public function add_agents () {
        
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            $this->form_validation->set_rules('agent_code', 'agent code', 'required|is_unique[crm_agents.agent_code]');
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[crm_agents.username]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('first_name', 'First name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[crm_agents.email]');
            $this->form_validation->set_rules('phone', 'Phone', 'numeric');
            $this->form_validation->set_rules('city','City', 'required|trim|alpha_numeric');
            $this->form_validation->set_rules('state','State', 'required|trim');
            $this->form_validation->set_rules('district','District', 'required|trim');
                if($this->form_validation->run() == TRUE){

                    $userdata = array(
                        "agent_code"            => $this->input->post("agent_code",true),
                        "username"              => $this->input->post("username",true),
                        "password"              => $this->input->post("password",true),
                        "first_name"            => $this->input->post("first_name",true),
                        "last_name"             => $this->input->post("last_name",true),
                        "email"                 => $this->input->post("email",true),
                        "phone"                 => $this->input->post("phone",true),
                        "address"               => $this->input->post("address",true),
                        "pincode"               => $this->input->post("pincode",true),
                        "address"               => $this->input->post("address",true),
                        'state_id'              => $this->input->post("state", true),
                        'district_id'           => $this->input->post("district", true),
                        'city'                  => $this->input->post("city", true),
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
                $this->gen_contents['state_details']  = $this->web_model->get_state_details();
                $this->gen_contents['link_agent']  = 'active';
                $this->template->write_view('content', 'agents_add', $this->gen_contents);
                $this->template->render();
        }
    }
    
    public function edit_agents ($id = 0) {  
         if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            if($id != 0 && is_numeric($id)){
                
                $this->form_validation->set_rules('agent_code', 'agent code', 'required');
                $this->form_validation->set_rules('username', 'Username', 'required');
                $this->form_validation->set_rules('password', 'Password', 'required');
                $this->form_validation->set_rules('first_name', 'First name', 'required');
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('phone', 'Phone', 'numeric');
                $this->form_validation->set_rules('city','City', 'required|trim|alpha_numeric');
                $this->form_validation->set_rules('state','State', 'required|trim');
                $this->form_validation->set_rules('district','District', 'required|trim');

                if($this->form_validation->run() == TRUE){ 

                    $userdata = array(
                        "agent_code"            => $this->input->post("agent_code",true),
                        "username"              => $this->input->post("username",true),
                        "password"              => $this->input->post("password",true),
                        "first_name"            => $this->input->post("first_name",true),
                        "last_name"             => $this->input->post("last_name",true),
                        "email"                 => $this->input->post("email",true),
                        "phone"                 => $this->input->post("phone",true),
                        "address"               => $this->input->post("address",true),
                        "pincode"               => $this->input->post("pincode",true),
                        "address"               => $this->input->post("address",true),
                        'state_id'              => $this->input->post("state", true),
                        'district_id'           => $this->input->post("district", true),
                        'city'                  => $this->input->post("city", true),
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
                $this->gen_contents['state_details']  = $this->web_model->get_state_details();
                $state_id=($this->gen_contents['details']['state_id']);
                $this->gen_contents['district_details']= $this->web_model->get_district_details($state_id);
                $this->template->write_view('content', 'modify_agents', $this->gen_contents);
                $this->template->render();   

            }
            else {
                redirect("manage_agents");
            }
        }
    }
    
    public function edit_payments ($id = 0) { 
        if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
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
    }
    
    public function edit_bankpayments ($id = 0) { 
        if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            if($id != 0 && is_numeric($id)){

                $this->form_validation->set_rules('total_payment', 'total payment', 'required|numeric');
                $this->form_validation->set_rules('bank_payment', 'bank payment', 'required|numeric');

                if($this->form_validation->run() == TRUE){ 
                    $user_id = implode(",",$this->input->post("user",true)); 
                    $userdata = array(
                        "total_payment"   => $this->input->post("total_payment",true),
                        "bank_payment"  => $this->input->post("bank_payment",true),
                        "reason"  => $this->input->post("reason",true),
                        "user_id"  => $user_id
                    );

                    $bank_payment_id  = $this->input->post("id",true);  
                    $tbl_name = 'crm_bank_payment';
                    $result = $this->web_model->update_contents_bankpayment($userdata,$bank_payment_id,$tbl_name);
                    if($result) {
                        sf( 'success_message', "Bank payment details updated successfully" );
                        redirect("manage_cash");
                    }
                    else {
                        sf( 'error_message', "No modification done" );
                        redirect("manage_cash");
                    }
                }
                $this->gen_contents['users'] = $this->web_model->get_users();
                $this->gen_contents['link_bank']  = 'active';
                $this->gen_contents['details'] = $this->web_model->get_bankpayment_details($id);
                $this->template->write_view('content', 'modify_bankpayments', $this->gen_contents);
                $this->template->render();   

            }
            else {
                redirect("manage_payment");
            }
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
    
    public function deletebankpayments ($bank_payment_id = 0) { 
        if($bank_payment_id != 0 && is_numeric($bank_payment_id)){  
            
            $userdata = array(
                    "status"   => '0'
            );
            
            $tbl_name = 'crm_bank_payment';   
            $result = $this->web_model->update_contents_bankpayment($userdata,$bank_payment_id,$tbl_name);
            if($result) {
                sf( 'success_message', "Bank payment details deleted successfully" );
                redirect("manage_cash");
            }
            else {
                sf( 'error_message', "Bank payment details not deleted,Please try again later" );
                redirect("manage_cash");
            }
        }
        else {
            redirect("manage_cash");
        }
    }
    
    public function deleteagent ($agent_id = 0) { 
        if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
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
    
    public function edit_profile () {
        
        if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('first_name', 'First name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'numeric');

                if($this->form_validation->run() == TRUE){

                    if(s('ADMIN_TYPE') == 1){
                        $tbl_name = 'crm_agents';
                        
                        $userdata = array(
                            "username"   => $this->input->post("username",true),
                            "first_name"  => $this->input->post("first_name",true),
                            "last_name"  => $this->input->post("last_name",true),
                            "email"  => $this->input->post("email",true),
                            "phone"  => $this->input->post("phone",true),
                            "agent_code"  => $this->input->post("agent_code",true),
                            "address"  => $this->input->post("address",true),
                            "pincode"  => $this->input->post("pincode",true),
                        );
                    }
                    else {
                        $tbl_name = 'crm_admin';
                        
                        $userdata = array(
                            "username"   => $this->input->post("username",true),
                            "first_name"  => $this->input->post("first_name",true),
                            "last_name"  => $this->input->post("last_name",true),
                            "email"  => $this->input->post("email",true),
                            "phone"  => $this->input->post("phone",true)
                        );
                    }
                    $id = s('ADMIN_USERID');   
                    $result = $this->web_model->update_profile($userdata,$id,$tbl_name);
                    if($result){
                        sf( 'success_message', "Profile details updated successfully" );
                        us('ADMIN_NAME','');
                        ss('ADMIN_NAME',$this->input->post("first_name",true));
                        redirect("edit_profile");
                    }
                    else {
                        sf('error_message', 'No modifications done');
                        redirect("edit_profile");
                    }
                }
            $id = s('ADMIN_USERID');
            $this->gen_contents['details'] = $this->web_model->get_profile_details($id); 
            $this->template->write_view('content', 'profile_update', $this->gen_contents);
            $this->template->render();
        }
    }
    
    public function change_password (){
        if (!($this->session->userdata("ADMIN_USERID"))) {
            redirect("web");
        }
        else {
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'required');
            $this->form_validation->set_rules('newpassword', 'New Password', 'required');
            $this->form_validation->set_rules('confirmpassword', 'Password Confirmation', 'required|matches[newpassword]');

            if($this->form_validation->run() == TRUE){
                $userdata = array(
                    "password" => $this->input->post("newpassword",true)
                );

                $id = s('ADMIN_USERID');
                $old_password = $this->input->post("oldpassword",true);

                $check_oldpassword = $this->web_model->check_oldpassword($old_password,$id); 
                if($check_oldpassword){
                    $result = $this->web_model->update_password($userdata,$id);
                    if($result) {
                        sf( 'success_message', "Password modified successfully" );
                        redirect("change_password");
                    }
                    else {
                        sf( 'error_message', "No modifications done" );
                        redirect("change_password");
                    }
                }
                else {
                    sf( 'error_message', "Please check your old password" );
                        redirect("change_password");
                }
            }

            $this->template->write_view('content','changepassword', $this->gen_contents);
            $this->template->render();
        }
    }
    
}
