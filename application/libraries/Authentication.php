<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 
 * Project		CRM
 * @package		CodeIgniter
 * @author		Saji
 * @since		Version 2.0
 * @filesource
 */
// ------------------------------------------------------------------------

class Authentication {

    var $CI = null;

    function Authentication() {
        $this->CI = & get_instance();
        clear_cache();
    }

    /**
     * Process user login 
     *
     * @param unknown_type $login
     * @return unknown
     */
    function process_user_login($login = NULL, $email_login = false) { 
        if (!is_array($login) || 0 >= count($login)) {
            return FALSE;
        }
        $emailid = $login['email'];
        $password = @$login['password'];
        $this->CI->db->select("email AS EMAIL, id as USERID, first_name as FIRST_NAME, last_name as LAST_NAME, status as STATUS, activation_code as ACT_CODE, profile_image");
        if(!empty($login['user_id'])){
            $this->CI->db->where('id', $login['user_id']);
        
        }else if($email_login == true){
            $this->CI->db->where('email', $emailid);
            $this->CI->db->where(" 'status' != '4' "); 
        }else{
            $this->CI->db->where('email', $emailid);
            $this->CI->db->where(" 'status' != '4' "); 
            $password = $this->CI->db->escape_like_str($password);
            $password = '365Pass' . $password;
            $this->CI->db->where("`password` = (SELECT SHA2(CONCAT('$password',`encrypt_time`), 256))", NULL, false);
        }
        $select_query = $this->CI->db->get('user_details');  //echo($this->CI->db->last_query()); exit;
        if (0 < $select_query->num_rows()) { 
            $row = $select_query->row();
                if ( $row->STATUS == 1 && $row->ACT_CODE == NULL) {
                    $this->CI->db->where('id', $row->USERID);
                    $arr['last_login_date'] = get_cur_date_time();
                    $this->CI->db->update('user_details', $arr);
                    $session_data = array(
                        'USER_EMAIL' => $row->EMAIL,
                        'FIRST_NAME' => $row->FIRST_NAME,
                        'LAST_NAME' => $row->LAST_NAME,
                        'USER_ID' => $row->USERID,
                        'USER_STATUS' => $row->STATUS,
                        'USER_PROFILE_IMAGE' => $row->profile_image,
                        'last_activity' => time()
                    );
                    $this->CI->session->set_userdata($session_data); 
                    return 'success';
                }
                else if ( $row->STATUS == 3 || $row->STATUS == 2) {                    
                    return 'blocked';
                }else if ($row->STATUS == 4){
                    return 'deleted';
                } else if($row->ACT_CODE != NULL){
                    return 'emailactivation';
                }
                else{
                    return 'inactive';
                }
           
        }
        return false;
    }

    /**
     * function for admin login process
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function process_admin_login($login = NULL, $set_session = true) {
        if (!is_array($login) || 0 >= count($login)) {
            return FALSE;
        }
        $emailid = $login['username'];
        $password = $login['password'];
        $type = $login['type'];
        if($type == 'admin') {
            
            $this->CI->db->select("username AS USERNAME, admin_id as USERID, first_name as NAME,status as STATUS,type as TYPE ");
            $this->CI->db->where('username', $emailid);
            $password = $this->CI->db->escape_like_str($password);
            //$password = 'cc' . $password;
            $this->CI->db->where("password = '$password'", NULL, false);
            $select_query = $this->CI->db->get('crm_admin');
            if (0 < $select_query->num_rows()) {
                $row = $select_query->row();
                if ($row->STATUS == '1') {
                    $this->CI->db->where('admin_id', $row->USERID);
                    $arr['last_login_date'] = date('Y-m-d H:i:s');
                    $this->CI->db->update('crm_admin', $arr);
                    $session_data = array(
                        'ADMIN_USERNAME' => $row->USERNAME,
                        'ADMIN_NAME' => $row->NAME,
                        'ADMIN_USERID' => $row->USERID,
                        'ADMIN_STATUS' => $row->STATUS,
                        'ADMIN_TYPE' => $row->TYPE,
                        'last_activity' => time()
                    );
                    $this->CI->session->set_userdata($session_data);
                    return 'success';
                }else
                    return 'inactive';
            }
            return false;
        }
        else {     
            
            $this->CI->db->select("username AS USERNAME, agent_id as USERID, first_name as NAME, status as STATUS,type as TYPE,enable_logging as enable_logging");
            $this->CI->db->where('username', $emailid);
            $password = $this->CI->db->escape_like_str($password);
            //$password = md5($password);
            $this->CI->db->where("password = '$password'", NULL, false);
            $select_query = $this->CI->db->get('crm_agents');
            if (0 < $select_query->num_rows()) {
                $row = $select_query->row();
                if (($row->STATUS == '1') && ($row->enable_logging == '1')) {
                    $this->CI->db->where('agent_id', $row->USERID);
                    $arr['last_login_date'] = date('Y-m-d H:i:s');
                    $this->CI->db->update('crm_agents', $arr);
                    $session_data = array(
                        'ADMIN_USERNAME' => $row->USERNAME,
                        'ADMIN_NAME' => $row->NAME,
                        'ADMIN_USERID' => $row->USERID,
                        'ADMIN_STATUS' => $row->STATUS,
                        'ADMIN_TYPE' => $row->TYPE,
                        'last_activity' => time()
                    );
                    $this->CI->session->set_userdata($session_data);
                    return 'success';
                }
                else if($row->STATUS == '2') {
                    return 'inactive';
                }
                else
                    return 'emailactivation';
            }
            return false;
        }
    }

    /**
     * function for logout
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function logout() {
        $session_data = array(
            'USER_EMAIL' => '',
            'USER_NAME' => '',
            'USER_ID' => '',
            'ADMIN_APPROVE' => '',
            'USER_STATUS' => '',
            'last_activity' => '',
            'fb_data' => null,
            'USER_PROFILE_IMAGE' => ''
        );
        unset(
                $_SESSION['USER_EMAIL'], $_SESSION['USER_NAME'], $_SESSION['USER_ID'], $_SESSION['ADMIN_APPROVE'], $_SESSION['USER_STATUS'], $_SESSION['last_activity'], $_SESSION['fb_data']
        );
        $this->CI->session->unset_userdata($session_data);
        return TRUE;
    }

    /**
     * To avoid the unauthorized access
     * 
     * @package		CodeIgniter
     * @author		
     * @return unknown
     */
    function UserHasAccess($required_role, $status='', $type='') {
        return TRUE;
    }

    /**
     * To checked whether the admin is logged in or not
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function admin_logged_in() {
        if ('' == $this->CI->session->userdata('ADMIN_USERID')) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * To checked whether the user is logged in or not
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function user_logged_in() {
        if ('' == $this->CI->session->userdata('USER_ID')) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * To checked whether the user is logged in or not
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function check_user_logged_in() {
        ($this->admin_logged_in()) ? redirect('dashboard') : '';
    }

    /**
     * To checked whether the admin is logged out
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function admin_logout() {
        $session_data = array(
            'ADMIN_USERNAME' => '',
            'ADMIN_NAME' => '',
            'ADMIN_USERID' => '',
            'ADMIN_STATUS' => '',
            'ADMIN_TYPE' => ''
        );
        unset(
                $_SESSION['ADMIN_USERNAME'], $_SESSION['ADMIN_NAME'], $_SESSION['ADMIN_USERID'], $_SESSION['ADMIN_STATUS'], $_SESSION['ADMIN_TYPE']
        );
        $this->CI->session->unset_userdata($session_data);
        return TRUE;
    }

    function redirect() {
        if (s('USER_REQUEST_URI')) {
            $redirect_to = s('USER_REQUEST_URI');
            $set_session_data = array('USER_REQUEST_URI' => '');
            us($set_session_data);
            redirect($redirect_to);
        }
        else {
            redirect('dashboard');
        }
    }

    /**
     * To checked whether the user is logged out
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
      'USER_EMAIL'          => $row->EMAIL,
      'USER_NAME'           => $row->NAME,
      'USER_ID'             => $row->USERID,
      'USER_TYPE'           => $row->USERTYPE,
      'ADMIN_APPROVE'       => $row->ADMINAPPROVE,
      'USER_STATUS'         => $row->STATUS,
     **/

    /**
     * To checked whether the admin/user is logged in or not
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function check_logged_in($user_type = "", $status='', $type='', $step=0, $user_step=0, $check_incomplete_step=1, $redirect=1, $popup=false) {
        switch ($user_type){
            case "normal":
                if (!$this->CI->session->userdata('USER_ID')) {
                    return FALSE;
                }
                // suppose admin has blocked the user after user logged in then
                if (!$this->Checkuserstatus($this->CI->session->userdata('USER_ID'))) {
                    $this->logout();
                    return FALSE;
                }
                if (!$this->UserHasAccess('normal', $status, $type)) {
                    return FALSE;
                }
                return TRUE;
                break;
            case "admin":
                if (!$this->CI->session->userdata('ADMIN_USERID')) {
                    return FALSE;
                }
                else {

                    if (!$this->CheckAdminStatus($this->CI->session->userdata('ADMIN_USERID'))) {
                        $this->admin_logout();
                        return FALSE;
                    }
                    return TRUE;
                }
                break;
            default:
                if ($this->CI->session->userdata('USER_ID') > 0) {
                    return TRUE;
                }
                else {
                    return FALSE;
                }
                break;
        }
    }

    /**
     * To checked whether the admin is Active/Inactive
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function CheckAdminStatus($user_id) {
        $status = 'A';
        $this->CI->db->select("status");
        $this->CI->db->where('status', 'A');
        $this->CI->db->where('id', $user_id);
        $select_query = $this->CI->db->get('administrators');
        if (0 < $select_query->num_rows()) {
            $row = $select_query->row();
            $session_data['ADMIN_STATUS'] = $row->status;
            $this->CI->session->set_userdata($session_data);
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * To checked whether the user is Active/Inactive
     *
     * @package		CodeIgniter
     * @author
     * @return unknown
     */
    function Checkuserstatus($user_id) {
       // $status = 1;
        $this->CI->db->select("status, profile_image");
        $this->CI->db->where('status', '1');
        $this->CI->db->where('id', $user_id);
        $select_query = $this->CI->db->get('user_details');
        if (0 < $select_query->num_rows()) {
            $row = $select_query->row();
            $session_data['STATUS'] = $row->status;
            $session_data['USER_PROFILE_IMAGE'] = $row->profile_image;
            $this->CI->session->set_userdata($session_data);
            return true;
        }
        else {
            return false;
        }
    }

    function userHasPermission($role_type = '') {
        if ($role_type != s('ROLETYPE')) {
            return false;
        }
        else {
            return true;
        }
    }
}

// End of library class
// Location: system/application/libraries/authentication.php