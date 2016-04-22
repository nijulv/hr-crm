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

    //get lead types
//    public function get_lead_types() {
//        $this->db->select("*");
//        $this->db->from("lead_types");
//        $this->db->order_by("lead_type_id");
//        $this->db->limit(2);                    // comment this line when all questions of remaining lead type will entered
//        $query = $this->db->get();
//        if ($query->num_rows() > 0) {
//            return $query->result_array();
//        } else {
//            return false;
//        }
//    }
    // function to get questions and answers
    public function get_question_answers($type_id) {
        $where = array(
            'lead_type_id' => $type_id
        );
        $this->db->select("*");
        $this->db->from("lead_questions");
        $this->db->where($where);
        $this->db->order_by("qn_order");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            //p($query->result_array());
            //return $query->result_array();
            $qns = $query->result_array();
            foreach ($qns as $qn) {
                $qa[] = array(
                    "question_id" => $qn['question_id'],
                    "lead_type_id" => $qn['lead_type_id'],
                    "question" => $qn['question'],
                    "qn_order" => $qn['qn_order'],
                    "specification" => $qn['specification'],
                    "lead_price_matching" => $qn['lead_price_matching'],
                    "vendor_matching" => $qn['vendor_matching'],
                    "answer_type" => $qn['answer_type'],
                    "answers" => $this->get_answers($qn['question_id']) //appending answers
                );
            }
            //p($qa);
            return $qa;
        } else {
            return false;
        }
    }

    //function to get answers
    public function get_answers($question_id = '') {
        $where = array(
            'question_id' => $question_id
        );
        $this->db->select("*");
        $this->db->from("lead_question_answers");
        $this->db->where($where);
        $this->db->order_by("aid");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //get brands/makers 
    public function get_brands() {
        $this->db->select("*");
        $this->db->from('makers m');
        $where = array(
            'm.status' => 'A'
        );
        $this->db->where($where);
        $this->db->order_by("m.maker");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //get brands/makers 
    public function get_states() {
        $this->db->select("*");
        $this->db->from('states s');
        $this->db->order_by("s.state");
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //intialize lead answering
    public function lead_init($init_data) {
        $sess_id = session_id();
        $type_id = $init_data['type_id'];
        $promoid = get_cookie('promoid');
        $ldata = array(
            "lead_type_id"  => $type_id,
            "sess_id"       => $sess_id,
            "ip_address"    => $this->input->ip_address(),
            "promo_id"      => $promoid,
            "city_suburb"   => $init_data['suburb'],
            "postcode"      => $init_data['postcode']
        );
        $where = array("sess_id" => $sess_id, "mail_sent_count" => 0);
        $this->db->select("*");
        $this->db->from("leads_details");
        $this->db->where($where);
        $query = $this->db->get();
        //echo $this->db->last_query(); //exit;
        if ($query->num_rows() == 0) {
            $this->db->insert("leads_details", $ldata);
            $lead_id = $this->db->insert_id();
        } else {
            $ldata1 = $query->result_array();
            $lead_id = $ldata1[0][lead_id];
            // update newly selected data
            $whr = array("lead_id" => $lead_id);
            $this->db->where($whr);
            $this->db->update("leads_details", $ldata);
        }
        return $lead_id;
    }

    //process lead answer
    public function process_answer($adata) {
        //section to check in db already answer this question ?
        $lead_id = $adata['lead_id'];
        $qn_id = $adata['question_id'];
        $whr = array(
            'lead_id' => $lead_id,
            'question_id' => $qn_id
        );
        $this->db->select("*");
        $this->db->from("leads_response");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            //insert answer section
            $this->db->insert("leads_response", $adata);
        } else {
            //update answer
            $ans = $query->result_array();
            $aid = $ans[0]['id'];
            $whr = array("id" => $aid);
            $this->db->where($whr);
            $this->db->update("leads_response", $adata);
            //echo $this->db->last_query();
        }
    }

    //process final submission
    public function process_final_post($lead_id, $postdata) {
        //insert into db
        $whr = array(
            'lead_id' => $lead_id
        );
        $this->db->where($whr);
        if ($this->db->update("leads_details", $postdata)) {
            return 'success';
        } else {
            return "error";
        }
    }

    //get main region list according to state id
    public function get_mregion($state_id) {
        $where = array("stateID" => $state_id);
        $this->db->select("*");
        $this->db->from("major_regions");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //get sub region list according to main region id
    public function get_sregion($mregion_id) {
        $where = array("mregionID" => $mregion_id);
        $this->db->select("*");
        $this->db->from("sub_regions");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //get quetion details 
    public function get_question_details($question_id) {
        $where = array("question_id" => $question_id);
        $this->db->select("*");
        $this->db->from("lead_questions");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    // Autocomplete for postcode 
    public function postcode_autocomplete($keyword = '') {
        $this->db->select("postcode");
        $this->db->from("cities");
        $this->db->like('postcode', $keyword);
        $this->db->group_by("postcode");
        $this->db->order_by("postcode");
        //$this->db->limit(5);  
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    // Autocomplete suburb
    public function suburb_autocomplete($keyword = '') {
        //$this->db->select("city");
        //$this->db->from("cities");
        //$this->db->like('city', $keyword);
        //$this->db->group_by("city");
        //$this->db->order_by("city");
        //$this->db->limit(5);  
        //$query = $this->db->get();  
        $query = $this->db->query("SELECT city FROM cities WHERE city LIKE '$keyword%'");
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    public function lead_suburb_search_autocomplete($keyword = '', $tabletype = '') {
        if ($tabletype == 'user') {
            $this->db->select("city as city_suburb");
            $this->db->from("users");
            $this->db->like('city', $keyword);
            $this->db->group_by("city");
            $this->db->order_by("city");
        } else if ($tabletype == 'sellcopier') {
            $this->db->select("suburb as city_suburb");
            $this->db->from("cc_sellcopier");
            $this->db->like('suburb', $keyword);
            $this->db->group_by("suburb");
            $this->db->order_by("suburb");
        } else if ($tabletype == 'pre_registration') {
            $this->db->select("city_suburb as city_suburb");
            $this->db->from("pre_registration");
            $this->db->like('city_suburb', $keyword);
            $this->db->group_by("city_suburb");
            $this->db->order_by("city_suburb");
        } else {
            $this->db->select("city_suburb");
            $this->db->from("leads_details");
            $this->db->like('city_suburb', $keyword);
            $this->db->group_by("city_suburb");
            $this->db->order_by("city_suburb");
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    // Dropdown values according to postcode value 
    public function autocompletecity($postcode = '') {
        $this->db->select("city,cityID");
        $this->db->from("cities");
        $this->db->where("postcode", $postcode);
        $this->db->group_by("city");
        $this->db->order_by("cityID", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    // Get cities list 
    public function get_cities() {
        $this->db->select("*");
        $this->db->from("cities");
        $this->db->group_by("city");
        $this->db->order_by("cityID", "asc");
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    // Get cities list on search
    public function get_cities_onsearch($search = "") {
        $this->db->select("*");
        $this->db->from("cities");
        $this->db->where('city LIKE "'.$search . '%" OR postcode LIKE "'.$search . '%"');        
        $this->db->order_by("cityID", "asc");
        $this->db->limit(20);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return array();
    }

    // get answer details
    public function get_answer_details($answer_id) {
        $where = array("aid" => $answer_id);
        $this->db->select("*");
        $this->db->from("lead_question_answers");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    // get answer details
    public function get_web_contents($controller) {
        $where = array("controller" => $controller);
        $this->db->select("*");
        $this->db->from("cc_web_contents");
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //check the email downloaded or not the buyer guide
    public function is_bg_downloaded($email) {
        $whr = array(
            "email" => $email,
            "download_status" => "yes"
        );
        $this->db->select("*");
        $this->db->from("buyerguid_userdata");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //process buyer guid user data
    public function process_bg_userdata($userdata) {
//        $whr = array(
//            "email" => $userdata['email']
//        );
//        $this->db->select("*");
        $this->db->insert("buyerguid_userdata", $userdata);
        return $this->db->insert_id();
    }

    //process user questionnaire for buyer guide and send download link to user
    public function process_bg_qdata($did, $qdata) {
        $whr = array(
            "id" => $did
        );
        $this->db->where($whr);
        $this->db->update("buyerguid_userdata", $qdata);
        $download_link = base_url() . "bgdownload/" . $qdata['download_key'];

        return $download_link;
    }

    public function get_bg_user($did) {
        $whr = array(
            'id' => $did
        );
        $this->db->select("*");
        $this->db->from("buyerguid_userdata");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //check bg is able to downlaod or not 
    public function is_bg_downloadable($key) {
        $whr = array(
            'download_key' => $key,
            'email != ' => '',
            'download_status' => 'no'
        );
        $this->db->select("*");
        $this->db->from("buyerguid_userdata");
        $this->db->where($whr);
        $query = $this->db->get();
        //echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // get bg download file 
    public function get_bg_file() {
        $whr = array(
            'status' => 1
        );
        $this->db->select("*");
        $this->db->from("cc_buyer_guide");
        $this->db->where($whr);
        $qry = $this->db->get();
        if ($qry->num_rows() > 0) {
            return $qry->result_array();
        } else {
            return NULL;
        }
    }

    // update download status 
    public function update_bg_status($key) {
        $udata = array(
            "download_status" => "yes"
        );
        $whr = array(
            "download_key" => $key
        );
        $this->db->where($whr);
        $this->db->update("buyerguid_userdata", $udata);
    }

    //insert user data when download buyer guide - From RFQ
    public function insert_rfq_bguserdata($data1) {
        $this->db->insert("buyerguid_userdata", $data1);
        $download_link = base_url() . "bgdownload/" . $data1['download_key'];
        return $download_link;
    }

    //get page data from html link
    public function get_page_data($html_link) {
        $whr = array(
            'html_link' => $html_link,
            'status' => 'Active'
        );
        $this->db->select("*");
        $this->db->from("cc_web_pages");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //get landing page data from html link
    public function get_landingpage_data($html_link) {
        $whr = array(
            'html_link' => $html_link,
            'status' => 'Active'
        );
        $this->db->select("*");
        $this->db->from("cc_landing_pages");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //process enquiry/contact us form
    public function process_enquiry($enq_data) {
        if ($this->db->insert('cc_enquiries', $enq_data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //process supplier enquiry form
    public function process_supplier($sup_data) {
        if ($this->db->insert('cc_suppliers', $sup_data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //process supplier enquiry form to l2s user
    public function process_supplier_l2s($sup_data) {
        if ($this->db->insert('users', $sup_data)) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    //get footer location links
    public function get_footer_links($category) {
        $whr = array(
            'category' => $category
        );
        $this->db->select("*");
        $this->db->from("cc_web_pages");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //sell my copier form submit in db
    public function insert_sellmycopier($data = array()) {
        $this->db->insert('cc_sellcopier', $data);
        return $this->db->insert_id();
    }

    //get home page banners from db
    public function get_banners() {
        $whr = array(
            'status' => 'A'
        );
        $this->db->select("*");
        $this->db->from("cc_web_banners");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //get home page banners from db
    public function get_sellcopier_banners() {
        $whr = array(
            'status' => 'A'
        );
        $this->db->select("*");
        $this->db->from("cc_sellcopier_banners");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //get home page banners from db
    public function get_landingpage_banners($pageid) {
        $whr = array(
            'pageid' => $pageid,
            'image_path !=' => ''
        );
        $this->db->select("*");
        $this->db->from("cc_landing_page_carousal_images");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
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

    //get lead matching seller email and email content for seller
    public function get_lead_data($lead_id = '') {

        $lead_details = $this->get_lead_basic_details($lead_id);
        $lead_qa = $this->get_lead_response($lead_id);
        //p($lead_qa); exit;
        foreach ($lead_qa as $lqa) {
            if ($lqa['qn_type'] == "condition") {
                //$sub .= " uo.device_status = '$lqa[answer]' OR";
                $condition = $lqa['answer'];
            } else if ($lqa['qn_type'] == "brand") {
                $brands = explode(",", $lqa['answer']);
                for ($i = 0; $i < count($brands); $i++) {                    
                    if (!empty($brands[$i]) && ($brands[$i] != 'No. I don’t have a preference.')) {
                        $sub .= " find_in_set('" . $brands[$i] . "',uo.used_equipment_brands) <> 0 OR";
                    }
                }
            }
        }
        $sub = rtrim($sub, "OR");
        //-- select sellers email by matching a lead ---------------------------------
        $lead_type_id 	= $lead_details[0]['lead_type_id'];
        $business_type 	= $lead_details[0]['business_type'];
        $qry = "SELECT u.*, uo.* FROM users u "
                . "LEFT JOIN ( SELECT * FROM user_options ) uo "
                . "ON (u.userID = uo.userID) "
                . "WHERE u.status = 'Active' AND find_in_set( '$lead_type_id', uo.lead_type_ids ) <> 0 ";    //. "WHERE uo.lead_type_id = '$lead_type_id' ";
        $condition = 'I will consider both';
        // device condition matching(old, new, will consider both)
		if($condition == 'I will consider both'){
            $qry .= " AND (uo.device_status = 'New only' OR uo.device_status = 'Used only' OR uo.device_status = 'I will consider both')";
        }
        else{
            $qry .= " AND uo.device_status = '$condition'";	
        }
		// match lead match preferences
        if (NULL != $sub) {
            $qry .= " AND ($sub)";
        }
		// match with business type
		if(!empty($business_type)){
			$qry .= " AND (find_in_set( '$business_type', uo.business_type ) <> 0)";
		}
        //echo $qry; exit;
        $sel = $this->db->query($qry);
        if ($sel->num_rows() > 0) {
            $seller_data = $sel->result_array();
        }
        //-----------------------------------------------------------------------------
        // GET email contents to send sellers
        $whr4 = array(
            "lead_type_id" => $lead_type_id
        );
        $this->db->select("*");
        $this->db->from("lead_types");
        $this->db->where($whr4);
        $query4 = $this->db->get();
        $leadtype_data = $query4->result_array();
        $qids = explode(",", $leadtype_data[0]['lead_alert_qids']);
        //p($qids);        die();
        $email_data = '<table cellpadding="5" border="1" style="border-collapse: collapse;">';
        $email_data .= '<tr><td><b>Lead ID: </b> </td><td>' . $lead_details[0]['lead_id'] . '</td></tr>'
                . '<tr><td><b>Lead Type: </b></td><td>' . $lead_details[0]['lead_type'] . '</td></tr>';
        for ($i = 0; $i < count($qids); $i++) {
            $j = $i + 1;
            $whr5 = array(
                "lr.question_id" => $qids[$i],
                "lr.lead_id"    => $lead_id
            );
            $this->db->select("lr.*, lq.question");
            $this->db->from('`leads_response` lr');
            $this->db->join("lead_questions lq", "lq.question_id = lr.question_id", "left");
            $this->db->where($whr5);
            $query5 = $this->db->get();
            $qa = $query5->result_array();
            $email_data .= "<tr><td><b>" . $qa[0]['question'] . "</b></td><td>" . $qa[0]['answer'];
            if (!empty($qa[0]['comments'])) {
                $email_data .= " - " . $qa[0]['comments'];
            }
            $email_data .= "</td></tr>";
        }

        //append lead contact and business data to $email_data
        $email_data .= '<tr><td><b>Business type: </b></td><td>' . $lead_details[0]['business_type'] . '</td><tr>'
                . '<tr><td><b>Suburb: </b></td><td>' . $lead_details[0]['city_suburb'] . '</td><tr>'
                . '<tr><td><b>State: </b></td><td>' . $lead_details[0]['state'] . '</td><tr>'
                . '<tr><td><b>Postcode: </b></td><td>' . $lead_details[0]['postcode'] . '</td><tr>'
                . '<tr><td><b>Lead Price: </b></td><td>' . $lead_details[0]['lead_price'] . '</td><tr>'
                . '<tr><td><b>Quality Rating: </b></td><td>' . $lead_details[0]['star_level'] . ' Stars</td><tr>';
        $email_data .= '</table>';

        $lead_data = array(
            "seller_data" 	=> $seller_data,
            "email_data" 	=> $email_data,
            "postcode"		=> $lead_details[0]['postcode'],
            "suburb"            => $lead_details[0]['city_suburb']
        );
        return $lead_data;
    }

    public function get_lead_basic_details($lead_id = "") {
        //-- select laeds basic details
        $whr1 = array(
            'ld.lead_id' => $lead_id
        );
        $this->db->select("ld.*, lt.lead_type, lt.lead_type_id");
        $this->db->from("leads_details ld");
        $this->db->join("lead_types lt", "ld.lead_type_id = lt.lead_type_id", "left");
        $this->db->where($whr1);
        $query1 = $this->db->get();
        if ($query1->num_rows() > 0) {
            $lead_details = $query1->result_array();
            return $lead_details;
        } else {
            return NULL;
        }
    }

    //get lead response - VENDOR MATCHING
    public function get_lead_response($lead_id = "") {
        $whr2 = array(
            'lr.lead_id' => $lead_id,
            'lq.vendor_matching' => 'yes'
        );
        $this->db->select("lr.*, lq.question, lq.vendor_matching, qn_type");
        $this->db->from("leads_response lr");
        $this->db->join("lead_questions lq", "lq.question_id = lr.question_id", "left");
        $this->db->where($whr2);
        $query2 = $this->db->get();
        if ($query2->num_rows() > 0) {
            $lead_qa = $query2->result_array();
            return $lead_qa;
        } else {
            return NULL;
        }
    }

    //insert lead match history
    public function process_leadmatch_history($lead_match_data) {
        $userID = $lead_match_data['userID'];
        $lead_id = $lead_match_data['lead_id'];
        $qry = "SELECT COUNT( * ) cnt
                FROM leadmatch_history                
                WHERE userID =  '$userID' AND lead_id = '$lead_id'";                
        $sel = $this->db->query($qry);
        $res = $sel->row_array();        
        if($res['cnt'] == 0){
            if ($this->db->insert('leadmatch_history', $lead_match_data)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        else{
            return TRUE;
        }
        
    }

    public function update_mail_sent_count($lead_id) {
        $qry = "UPDATE leads_details SET mail_sent_count = (mail_sent_count + 1) WHERE lead_id = '$lead_id'";
        if($this->db->query($qry)){
            return TRUE;
        }
        else{
            return FALSE;
        }
        
    }

    //insert sell old copier match history
    public function process_sellmycopier_history($match_data) {
        $userID     = $match_data['userID'];
        $sellcopier_id    = $match_data['sellcopier_id'];
        $qry = "SELECT COUNT( * ) cnt
                FROM cc_sellcopier_history                
                WHERE userID =  '$userID' AND sellcopier_id = '$sellcopier_id'";                
        $sel = $this->db->query($qry);
        $res = $sel->row_array();    
        if($res['cnt'] == 0){
            if ($this->db->insert('cc_sellcopier_history', $match_data)) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        else{
            return TRUE;
        }
    }

    //setting lead price
    public function set_lead_price($lead_id = '', $star_level) {
        $lead_details = $this->get_lead_basic_details($lead_id);
        $lead_type_id = $lead_details[0]["lead_type_id"];

        //generate price code
        $whr = array(
            "lr.lead_id" => $lead_id,
            "lr.price_match" => "yes"
        );
        $this->db->select("lr.*");
        $this->db->from("leads_response lr");
        $this->db->where($whr);
        $query = $this->db->get();
        $price_match = $query->result_array();
        $code = '';
        foreach ($price_match as $pm) {
            $code .= 'Q' . $pm['question_id'] . '(A' . $pm['answer_id'] . ')_';
        }
        $price_code = rtrim($code, '_');

        //get lead price
        $whr1 = array(
            "price_code" => $price_code,
            "lead_type_id" => $lead_type_id
        );
        $this->db->select("*");
        $this->db->from("lead_price_master");
        $this->db->where($whr1);
        $query1 = $this->db->get();
        $price_master = $query1->result_array();
        $price = $price_master[0]['price'];
        if ($price > 0 || NULL == $price) {
            $rr = $this->get_reduction_rate($star_level);   // select lead price reduction percentage
            $lead_price = round($price - (($rr * $price) / 100));
        } else {
            $lead_price = $this->get_default_leadprice();   // get default lead price
        }
        // update lead price in lead details table
        $whr2 = array(
            "lead_id" => $lead_id
        );
        $pdata = array(
            "lead_price" => $lead_price
        );
        $this->db->where($whr2);
        $this->db->update("leads_details", $pdata);
        //exit;
    }

    //get default lead price from admin settings
    public function get_default_leadprice() {
        $qry = "SELECT settings_value FROM admin_settings WHERE title = 'default_lead_price'";
        $sel = $this->db->query($qry);
        $price = $sel->result_array();
        $p = $price[0]['amount'];
        if (NULL != $p) {
            return $p;
        } else {
            return NULL;
        }
    }

    public function get_reduction_rate($star_level) {
        $qry = "SELECT red_perc FROM reduction_percentage WHERE lead_star = '$star_level'";
        $sel = $this->db->query($qry);
        $rate1 = $sel->result_array();
        $rate = $rate1[0]['red_perc'];
        if (NULL != $rate) {
            return $rate;
        } else {
            return NULL;
        }
    }

    // check promocode is valid or not
    public function valid_promocode($code = "") {
        $whr = array(
            "cp.code" => $code,
            "cp.expiry_date >= " => date("Y-m-d"),
            "cp.status" => 'Active'
        );
        $this->db->select("*");
        $this->db->from("cc_promocode cp");
        $this->db->where($whr);
        $qry = $this->db->get();
        //echo $this->db->last_query();
        if ($qry->num_rows() > 0) {
            return TRUE;
            //echo "valid";
        } else {
            return FALSE;
            //echo "invalid";
        }
    }

    // apply promocode for the lead
    public function apply_promocode($lead_id = "", $code = "") {
        $whr = array(
            "ld.promo_code" => $code,
            "ld.lead_id" => $lead_id
        );
        $this->db->select("*");
        $this->db->from("leads_details ld");
        $this->db->where($whr);
        $qry = $this->db->get();
        if ($qry->num_rows() == 1) {
            return "already_applied";
        } else {
            $up_data = array(
                "promo_code" => $code
            );
            $up_whr = array(
                "lead_id" => $lead_id
            );
            $this->db->where($up_whr);
            $this->db->update("leads_details", $up_data);
            return "applied";
        }
    }

    //Get Rotating Banner List    
    public function get_rotating_banners() {
        $query = "SELECT rb.*, rbp.* FROM rotating_banners rb
                    LEFT JOIN(
                            SELECT * FROM rotating_banner_packages
                    ) rbp ON (rb.pack_id = rbp.pack_id)
                    WHERE rb.status = 'A' 
                    AND DATE_ADD(rb.approval_date, INTERVAL rbp.pack_limit DAY) >= NOW() order by rand()";

        $qry = $this->db->query($query);
        //$qry = $this->db->get();
        if ($qry->num_rows($qry) > 0) {
            //p($qry->result_array()); exit;
            return $qry->result_array();
        } else {
            return NULL;
        }
    }

    //get admin settings
    public function get_admin_settings($title = "") {
        $whr = array(
            "title" => $title
        );
        $this->db->select("as.*");
        $this->db->from("admin_settings as");
        $this->db->where($whr);
        $qry = $this->db->get();
        if ($qry->num_rows($qry) > 0) {
            return $qry->result_array();
        } else {
            return NULL;
        }
    }

    // check email alert settings permissiom
    public function check_email_alert_settings($flag = '') {
        $this->db->select("*");
        $this->db->from("admin_email_notification");
        $this->db->where('flag', $flag);
        $this->db->where('status', '1');
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }

    //function update rotating banner click
    public function update_rbclick($rbid) {
        $whr = array(
            "id" => $rbid
        );
        $this->db->where($whr);
        $this->db->set("banner_click", "banner_click+1", false);
        $this->db->update("rotating_banners");
        //echo $this->db->last_query(); exit;
    }

    // get old copier seller list from users table - Leads2sale Supplier
    public function get_old_copier_sellerdata($userdata) {

        $brands = explode(",", $userdata['brands']);
        //create where condition for matching used brands
        for ($i = 0; $i < count($brands); $i++) {
            $sub .= " find_in_set('" . $brands[$i] . "',uo.used_equipment_brands) <> 0 OR";
        }
        $sub = rtrim($sub, "OR");

        //create where condition for matching trade in brands
        for ($i = 0; $i < count($brands); $i++) {
            $sub1 .= " find_in_set('" . $brands[$i] . "',uo.trade_in_brands) <> 0 OR";
        }
        $sub1 = rtrim($sub1, "OR");

        $query1 = "SELECT `u`.*, `uo`.* "
                . "FROM `users` `u` "
                . "LEFT JOIN `user_options` `uo` "
                . "ON `u`.`userID` = `uo`.`userID` "
                . "WHERE u.status = 'Active' AND (`uo`.`used_equipment_status` = '1') ";

        if (NULL != $sub) {
            $query1 .= " AND ($sub)";
        }

        $query1 .= " OR (`uo`.`trade_in_status` = '1') ";

        if (NULL != $sub1) {
            $query1 .= " AND ($sub1)";
        }

        //echo $query1; exit;

        $qry = $this->db->query($query1);
        if ($qry->num_rows() > 0) {
            return $qry->result_array();
        } else {
            return NULL;
        }
    }

    //get popupalr product list for listing
    public function get_popular_products() {
        $this->db->select("*");
        $this->db->where("status", "1");
        $this->db->from("cc_popular_products");
        //$this->db->order_by("pid","desc");
        $this->db->order_by('pid', 'RANDOM');
        $this->db->limit(6, 0);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    //get popular product details by id
    public function get_product_details_byid($clean_url = '') {
        $this->db->select('p.*,c.cat_name');
        $this->db->from('cc_popular_products p');
        $this->db->join('product_categories c', 'c.cat_id = p.cat_id', 'left');
        $this->db->where("clean_url", $clean_url);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }

    public function get_other_products($clean_url = '') {
        $this->db->select('p.*,c.cat_name');
        $this->db->from('cc_popular_products p');
        $this->db->join('product_categories c', 'c.cat_id = p.cat_id', 'left');
        $this->db->where("clean_url !=", $clean_url);
        $this->db->where("p.status", '1');
        $query = $this->db->get();   //echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    // get email template 
    public function get_email_template() {
        $email_template['header'] = '<!DOCTYPE html>
                                    <html style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
                                        <head>
                                            <meta name="viewport" content="width=device-width">
                                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                                            <title>CopierChoice</title>
                                            <style type="text/css">
                                                @media only screen and (max-width: 480px){
                                                    .emailButton{
                                                        max-width:600px !important;
                                                        width:100% !important;
                                                    }

                                                    .emailButton a{
                                                        display:block !important;
                                                        font-size:18px !important;
                                                    }
                                                }
                                            </style>
                                        </head>
                                    <body bgcolor="#f6f6f6" style="font-family: \'Helvetica Neue\', Helvetica, Arial, \'Lucida Grande\', sans-serif; font-size: 100%; line-height: 1.6em; -webkit-font-smoothing: antialiased; height: 100%; -webkit-text-size-adjust: none; width: 100% !important; margin: 0; padding: 0;">

                                        <!-- body -->
                                        <table class="body-wrap" bgcolor="#f6f6f6" style=" font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 20px;">

                                            <tr style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">

                                                <td style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
                                                <td class="container" bgcolor="#FFFFFF" style=" font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; Margin: 0 auto; padding: 20px; border: 1px solid #f0f0f0;">
                                                    <div style="background: #AAECF5; padding: 10px; border-bottom: #40A2FB solid 4px;" align="center">
                                                        <img width="300" src="' . assets_url() . 'images/theme/l2slogo.png" alt="Logo" style="">
                                                    </div>
                                                    <!-- content -->
                                                    <div class="content" style="font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">';
        $email_template['footer'] = '</div>
                                    <!-- /content -->

                                </td>
                                <td style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
                            </tr>
                        </table>
                        <!-- /body --><!-- footer -->
                        <table class="footer-wrap" style=" font-size: 100%; line-height: 1.6em; clear: both !important; width: 100%; margin: 0; padding: 0;"><tr style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
                                <td style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
                                <td class="container" style=" font-size: 100%; line-height: 1.6em; clear: both !important; display: block !important; max-width: 600px !important; margin: 0 auto; padding: 0;">

                                    <!-- content -->
                                    <div class="content" style=" font-size: 100%; line-height: 1.6em; display: block; max-width: 600px; margin: 0 auto; padding: 0;">
                                        <table style=" font-size: 100%; line-height: 1.6em; width: 100%; margin: 0; padding: 0;"><tr style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
                                                <td align="center" style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">
                                                    <!--<p style=" font-size: 12px; line-height: 1.6em; color: #666666; font-weight: normal; margin: 0 0 10px; padding: 0;">No longer want these emails? <a href="#" style=" font-size: 100%; line-height: 1.6em; color: #999999; margin: 0; padding: 0;">
                                                    <unsubscribe style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;">Unsubscribe</unsubscribe></a>.
                                                    </p>-->
                                                </td>
                                            </tr></table>
                                    </div>
                                    <!-- /content -->

                                </td>
                                <td style=" font-size: 100%; line-height: 1.6em; margin: 0; padding: 0;"></td>
                            </tr></table>
                        <!-- /footer -->
                    </body>
                </html>';
        $email_template['button'] = '<!-- button -->
                                        <table border="0" cellpadding="0" cellspacing="0" class="emailButton" style="border-radius:3px; background-color:#79ba28;">
                                            <tr>
                                                <td align="center" valign="middle" class="emailButtonContent" style="padding-top:15px; padding-right:30px; padding-bottom:15px; padding-left:30px;">
                                                    {{button_link}}
                                                </td>
                                            </tr>
                                        </table>
                                        <!-- /button -->';
        return $email_template;
    }

    //get related types - for listing after RFQ
    public function get_related_types($type_id = "") {
        $query1 = "SELECT lt . * FROM `lead_types` lt WHERE lt.lead_type_id = '" . $type_id . "'";
        $qry = $this->db->query($query1);
        $category = $qry->result_array();
        $cat_id = $category[0]['cat_id'];

        $whr = array(
            'cat_id != ' => $cat_id
        );
        $this->db->select("*");
        $this->db->from("lead_type_category`");
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return '';
        }
    }

    //get lead type category
    public function get_leadtype_category() {
        $query1 = "SELECT ltc . * FROM `lead_type_category` ltc WHERE ltc.type_flag = 1";
        $qry = $this->db->query($query1);
        $category = $qry->result_array();
        if (NULL != $category) {
            return $category;
        } else {
            return NULL;
        }
    }

    public function get_lead_types($cat_id) {
        $query1 = "SELECT * FROM `lead_types` WHERE cat_id = '$cat_id'";
        $qry = $this->db->query($query1);
        $lead_types = $qry->result_array();
        if (NULL != $lead_types) {
            return $lead_types;
        } else {
            return NULL;
        }
    }

    //get social media links
    public function get_social_links($site) {
        $qry = "SELECT * FROM social_media_links WHERE site = '$site' AND status = 1";
        $sel = $this->db->query($qry);
        $links = $sel->result_array();
        if (NULL != $links) {
            return $links;
        } else {
            return NULL;
        }
    }

    //get promotion details
    public function get_promotions($short_url) {
        $qry = "SELECT * FROM cc_promotions WHERE short_url = '$short_url' AND status = 1";
        $sel = $this->db->query($qry);
        $promo = $sel->result_array();
        if (NULL != $promo) {
            return $promo;
        } else {
            return NULL;
        }
    }

    //insert/track promotions
    public function track_promotions($promo_id) {
        $sess_id = session_id();
        $track_data = array(
            'promo_id' => $promo_id,
            'sess_id' => $sess_id,
            'ip_address' => $this->input->ip_address()
        );
        $qry = "SELECT * FROM cc_promotions_tracking WHERE sess_id = '$sess_id'";
        $sel = $this->db->query($qry);
        if ($sel->num_rows() == 0) {
            $this->db->insert("cc_promotions_tracking", $track_data);
        }
    }

    // get supplier remaining credits
    public function get_user_credits($userID = "") {
        $this->db->select_sum('credits_nr');
        $this->db->where('userID', $userID);
        $check = $this->db->get('transactions');

        if ($check->num_rows() > 0) {
            $chk = $check->row_array();
            return $chk['credits_nr'];
        } else {
            return 0;
        }
    }

    // get all leads which do not send alter to suppliers
    public function get_all_untouched_leads() {
        $qry = "SELECT * FROM leads_details ld WHERE ld.mail_sent_count = 0 "
                . " AND ld.submission_status = 'Completed'";
        $sel = $this->db->query($qry);
        $leads = $sel->result_array();
        if (NULL != $leads) {
            return $leads;
        } else {
            return NULL;
        }
    }

    // get all leads which do not send alter to suppliers
    public function get_all_reminder_leads($hours) {
        if($hours == 6){
            $qry = "SELECT * FROM leads_details
                    WHERE mail_sent_count = 1
                    AND payment_status_count < 3
                    AND TIMESTAMPDIFF(HOUR,date_time,NOW()) >= 6";
        }
        else if($hours == 24){
            $qry = "SELECT * FROM leads_details
                    WHERE mail_sent_count = 2
                    AND payment_status_count < 3
                    AND TIMESTAMPDIFF(HOUR,date_time,NOW()) >= 24";
        }
        //echo $qry;
        $sel = $this->db->query($qry);
        $leads = $sel->result_array();
        if (NULL != $leads) {
            return $leads;
        } else {
            return NULL;
        }
    }

    // get all dropout leads which star level > 2
    public function get_all_dropout_leads() {
        $qry = "SELECT * FROM leads_details
                WHERE star_level >= 2 AND star_level < 5 
                AND lead_price > 0 
                AND mail_sent_count = 0 
                AND TIMESTAMPDIFF(MINUTE,date_time,NOW()) >= 25";
        //echo $qry; exit;
        $sel = $this->db->query($qry);
        $leads = $sel->result_array();
        if (NULL != $leads) {
            return $leads;
        } else {
            return NULL;
        }
    }

    // get article data 
    public function get_articles($title = "") {
        if ($title != "") {
            $qry = "SELECT * FROM cc_articles WHERE clean_url = '$title'";
        } else {
            $qry = "SELECT * FROM cc_articles WHERE status = 1 ORDER BY date_time DESC";
        }
        $sel = $this->db->query($qry);
        $articles = $sel->result_array();
        if (NULL != $articles) {
            return $articles;
        } else {
            return NULL;
        }
    }

    public function get_complete_article($articles_search = '') {
        $this->db->select("*");
        $this->db->from('cc_articles');
        if ($articles_search != '') {
            $this->db->like('title', $articles_search);
            $this->db->or_like('description', $articles_search);
        }
        $this->db->where('status', '1');
        $this->db->order_by('date_time', 'DESC');
        $this->db->limit(5);
        $query = $this->db->get();              //echo $this->db->last_query();
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }
    
    public function get_other_article($tot_rows = 0) {
        $this->db->select("*");
        $this->db->from('cc_articles');        
        $this->db->where('status', '1');
        $this->db->order_by('date_time', 'DESC');   
        $this->db->limit($tot_rows,5);
        $query = $this->db->get();             //echo $this->db->last_query(); exit;
        if ($query->num_rows() > 0)
            return $query->result_array();
        else
            return false;
    }

    public function get_device_type() {
        $qry = "SELECT * FROM cc_device_type WHERE 1";
        $sel = $this->db->query($qry);
        $device_types = $sel->result_array();
        if (NULL != $device_types) {
            return $device_types;
        } else {
            return NULL;
        }
    }

    public function get_device_color() {
        $qry = "SELECT * FROM cc_device_color WHERE 1";
        $sel = $this->db->query($qry);
        $colors = $sel->result_array();
        if (NULL != $colors) {
            return $colors;
        } else {
            return NULL;
        }
    }

    public function get_main_rejions($stateID) {
        $qry = "SELECT * FROM major_regions WHERE stateID = '$stateID'";
        $sel = $this->db->query($qry);
        $main_rejion = $sel->result_array();
        if (NULL != $main_rejion) {
            return $main_rejion;
        } else {
            return NULL;
        }
    }
    
    public function get_sub_rejions($stateID) {
        $qry = "SELECT * FROM sub_regions WHERE stateID = '$stateID'";
        $sel = $this->db->query($qry);
        $sub_rejion = $sel->result_array();
        if (NULL != $sub_rejion) {
            return $sub_rejion;
        } else {
            return NULL;
        }
    }
    
    public function get_device_speed($type_id) {
        $qry = "SELECT * FROM cc_device_speed WHERE type_id = '$type_id'";
        $sel = $this->db->query($qry);
        $speed = $sel->result_array();
        if (NULL != $speed) {
            return $speed;
        } else {
            return NULL;
        }
    }

    public function get_device_model($type_id) {
        $qry = "SELECT * FROM cc_device_model WHERE type_id = '$type_id'";
        $sel = $this->db->query($qry);
        $model = $sel->result_array();
        if (NULL != $model) {
            return $model;
        } else {
            return NULL;
        }
    }

    // get device price for price guide page
    public function get_device_price($req) {

        $this->db->select("*");
        $this->db->from("cc_device_price");
        $this->db->where($req);
        $qry = $this->db->get();
        //echo $this->db->last_query();
        if ($qry->num_rows() > 0) {
            return $qry->result_array();
        } else {
            return NULL;
        }
    }

    //chack whether the supplier already purchased lead 
    public function is_purchased_lead($lead_id = "", $seller_id = "") {
        $this->db->select("*");
        $this->db->from("leadmatch_history");
        $whr = array(
            "lead_id" => $lead_id,
            "userID" => $seller_id,
            "payment_status" => 1
        );
        $this->db->where($whr);
        $qry = $this->db->get();
        //echo $this->db->last_query();
        if ($qry->num_rows() == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_pagecontents($flag = '') {
        $this->db->select("*");
        $this->db->from("ls_page_contents");
        $this->db->where('status', "1");
        $this->db->where('flag', $flag);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return $query->row_array();
        else
            return false;
    }

    //get state from postcode
    public function get_state_name($ps = '', $from = '') {
        $this->db->select("s.state");
        $this->db->from("cities c");
        $this->db->join("states s","s.stateID = c.stateID",'left');
        $whr = array(
            'c.'.$from => $ps
        );
        $this->db->where($whr);
        $this->db->limit(1,0);
        $query = $this->db->get();
        if ($query->num_rows() > 0){
            return $query->row_array();
        }
        else{
            return '';
        }
    }
    
    //check postcode in coverage area 
    public function is_in_coverage_area($user_id='', $post_sub=array()){
        $postcode = $post_sub['postcode'];
        $suburb = $post_sub['suburb'];
        $qry = "SELECT COUNT( * ) cnt
                FROM covered_areas ca
                LEFT JOIN (
                    SELECT * 
                    FROM cities
                )c ON ( c.cityID = ca.cityID ) 
                WHERE ca.userID =  '$user_id'
                AND c.postcode =  '".$postcode."' AND c.city = '$suburb'";
	//echo $qry; exit;
        $sel = $this->db->query($qry);
        $res = $sel->row_array();
        //p($res);
        if(!empty($res)){
            return $res['cnt'];
        }
        else{
            return 0;
        }
    }
    
    //is lead match email email already sent to user/supplier 
    public function is_email_already_sent($lead_id, $user_id){
        $this->db->select("*");
        $this->db->from("leadmatch_history");
        $whr = array(
            'lead_id'   => $lead_id,
            'userID'    => $user_id
        );
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
        
    }
    
    //get key from lead match history
    public function get_key_from_LMhistory($lead_id,$user_id){
        $qry = "SELECT `key` FROM leadmatch_history WHERE lead_id = '$lead_id' AND userID = '$user_id'";
        $sel = $this->db->query($qry);
        $res = $sel->row_array($sel);
        if(!empty($res)){
            return $res['key'];
        }
        else{
            return substr(md5(uniqid()), 0, 10);
        }
    }
    
    
    //is lead match(sellmycopier) email email already sent to user/supplier 
    public function is_email_already_sent_sc($sellcopier_id, $user_id){
        $this->db->select("*");
        $this->db->from("cc_sellcopier_history");
        $whr = array(
            'sellcopier_id'     => $sellcopier_id,
            'userID'            => $user_id
        );
        $this->db->where($whr);
        $query = $this->db->get();
        if ($query->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
        
    }
    
    //get key from lead match history(sell my copier)
    public function get_key_from_SChistory($sellcopier_id,$user_id){
        $qry = "SELECT `key` FROM cc_sellcopier_history WHERE sellcopier_id = '$sellcopier_id' AND userID = '$user_id'";
        $sel = $this->db->query($qry);
        $res = $sel->row_array($sel);
        if(!empty($res)){
            return $res['key'];
        }
        else{
            return substr(md5(uniqid()), 0, 10);
        }
    }
}