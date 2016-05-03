<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * This function will return date & time 
 * 
 */
function clear_cache() {
    $CI = &get_instance();
    $CI->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
    $CI->output->set_header("Pragma: no-cache");
}

/**
 * This function will return date & time 
 */

function get_cur_date_time($time = true) {
    //return ($time ==  true) ? date('Y-m-d H:i:s') : date('Y-m-d');
    if ($time)
        return date('Y-m-d H:i:s', (mktime(gmdate('H'), gmdate('i'), gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y'))));
    else
        return date('Y-m-d', (mktime(gmdate('H'), gmdate('i'), gmdate('s'), gmdate('m'), gmdate('d'), gmdate('Y'))));
}

function mysql_date_format($date, $time = false) {
    if (empty($date) || (!validateDate($date, 'm-d-Y'))) {
        return '';
    }
    if ($time) {
        return date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $date)));
    } else {
        return date('Y-m-d', strtotime(str_replace('-', '/', $date)));
    }
}

if (!function_exists('admin_url')) {

    function admin_url($uri = '', $protocol = NULL) {
        return get_instance()->config->base_url($uri, $protocol) . 'admin/';
    }

}

function assets_url() {
    return get_instance()->config->item('assets_url');
}

// creating password using 
function create_secure_password($pass) {
    $pass = 'cc' . $pass;
    $hash = hash('sha256', $pass);
    return $hash;
}

/**
 * to access config settings easily
 * 
 */
function c($setting_name) {
    return get_instance()->config->item($setting_name);
}

// get Language item
function l($item_name) {
    return get_instance()->lang->line($item_name);
}

/**
 * to access content from session easily
 * 
 */
function s($item_name) {
    return get_instance()->session->userdata($item_name);
}

/**
 * to access content from flash session easily
 * 
 */
function f($item_name) {
    return get_instance()->session->flashdata($item_name);
}

/**
 * SET SESSION - to set an item to session easily
 * 
 */
function ss($item_name, $item_value) {
    return get_instance()->session->set_userdata($item_name, $item_value);
}

/**
 * SET FLASH DATA - to set an item to session easily
 * 
 */
function sf($item_name, $item_value) {
    return get_instance()->session->set_flashdata($item_name, $item_value);
}

/**
 * KEEP FLASH DATA - to keep an item to session easily
 * 
 */
function kf($item_name) {
    return get_instance()->session->keep_flashdata($item_name);
}

/**
 * UNSET SESSION - to unset an item from session easily
 * 
 */
function us($item_name) {
    return get_instance()->session->unset_userdata($item_name);
}

/** print last query */
function lq() {
    return get_instance()->db->last_query();
}

/**
 * print_r() ;
 * 
 */
function p($str, $exit = false) {
    print "<pre>";
    print_r($str);
    print "</pre>";
    if ($exit)
        exit();
}

if (!function_exists('force_ssl')) {

    function force_ssl() {
        $CI = & get_instance();
        $CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
        $CI->config->config['site_baseurl'] = str_replace('http://', 'https://', $CI->config->config['site_baseurl']);
        $CI->config->config['js_url_path'] = str_replace('http://', 'https://', $CI->config->config['js_url_path']);
        $CI->config->config['js_path_url'] = str_replace('http://', 'https://', $CI->config->config['js_path_url']);
        $CI->config->config['css_url_path'] = str_replace('http://', 'https://', $CI->config->config['css_url_path']);
        $CI->config->config['image_url'] = str_replace('http://', 'https://', $CI->config->config['image_url']);
        if ($_SERVER['SERVER_PORT'] != 443) {
            redirect($CI->uri->uri_string());
        }
    }

}

function remove_ssl() {
    $CI = & get_instance();
    $CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);
    $CI->config->config['site_baseurl'] = str_replace('https://', 'http://', $CI->config->config['site_baseurl']);
    $CI->config->config['js_url_path'] = str_replace('https://', 'http://', $CI->config->config['js_url_path']);
    $CI->config->config['js_path_url'] = str_replace('https://', 'http://', $CI->config->config['js_path_url']);
    $CI->config->config['css_url_path'] = str_replace('https://', 'http://', $CI->config->config['css_url_path']);
    $CI->config->config['image_url'] = str_replace('https://', 'http://', $CI->config->config['image_url']);
    if ($_SERVER['SERVER_PORT'] != 80) {
        kf('success_message');
        kf('error_message');
        redirect($CI->uri->uri_string());
    }
}

function get_body_content_from_mobile() {
    $raw = "";
    // Try param
    if (isset($_POST))
    //$raw = getRequestParam("json_data");
        $raw = $_POST;

    // Try globals array
    if (!$raw && isset($_GLOBALS) && isset($_GLOBALS["HTTP_RAW_POST_DATA"]))
        $raw = $_GLOBALS["HTTP_RAW_POST_DATA"];

    // Try globals variable
    if (!$raw && isset($HTTP_RAW_POST_DATA))
        $raw = $HTTP_RAW_POST_DATA;

    // Try stream
    if (!$raw) {
        if (!function_exists('file_get_contents')) {
            $fp = fopen("php://input", "r");
            if ($fp) {
                $raw = "";
                while (!feof($fp))
                    $raw = fread($fp, 1024);
                fclose($fp);
            }
        } else
            $raw = "" . file_get_contents("php://input");
    }
    //file_put_contents('mylog.log', "\r\n >>>" . serialize($raw) . "\r\n<<<" .date('Y-m-d H:i:s') . " -RC", FILE_APPEND);

    return $raw;
}

function date_readable_format($date) {
    return date('D d, M Y h:i A', strtotime($date));
}

function date_readable_format_mobile($date) {
    return date('D d M', strtotime($date));
}

function date_display_format($date) {
    return date("F j, Y", strtotime($date));
}

function format_date_for_calendar($date, $time = '', $hrs = 0) {
    if (!empty($hrs))
        $hrs = ' - ' . $hrs . ' hours';
    if (!empty($time)) {
        // $end_time = ' - '.strtotime("$time +$hrs hour");
        return date('F, d', strtotime($date)) . ' @ ' . date('h:i A', strtotime($time)) . ' ' . c('time_zone_code') . ' ' . $hrs;
    } else {
        return date('F, d', strtotime($date)) . $hrs;
    }
}

function make_dir($path) {
    mkdir($path, 0777);
}

function inbox_date_time($date) {
    $curr_date = get_cur_date_time(false);
    if (strtotime($curr_date) == strtotime(date('Y-m-d', strtotime($date)))) {
        return date('h:i a', strtotime($date));
        //Y-m-d H:i:s
    } else if (strtotime(date('Y', strtotime($curr_date))) == strtotime(date('Y', strtotime($date)))) {
        return date('M Y', strtotime($date));
    } else {
        return date('d/m/y', strtotime($date));
    }
}

function inbox_date_time_conversation($date, $time_availble = true) {
    $curr_date = get_cur_date_time(false);
    if ($time_availble && strtotime($curr_date) == strtotime(date('Y-m-d', strtotime($date)))) {
        return date('h:i a', strtotime($date));
        //Y-m-d H:i:s
    } else if (strtotime(date('Y', strtotime($curr_date))) == strtotime(date('Y', strtotime($date)))) {
        return date('d, M Y', strtotime($date));
    } else {
        return date('d/m/y', strtotime($date));
    }
}

function time_passed($timestamp) {
    //type cast, current time, difference in timestamps
    $timestamp = (int) $timestamp;
    $current_time = strtotime(get_cur_date_time()); //time();
    $diff = $current_time - $timestamp;

    //intervals in seconds
    $intervals = array(
        'year' => 31556926, 'month' => 2629744, 'week' => 604800, 'day' => 86400, 'hour' => 3600, 'minute' => 60
    );

    //now we just find the difference
    if ($diff == 0) {
        return 'just now';
    }

    if ($diff < 60) {
        return $diff == 1 ? $diff . ' second ago' : $diff . ' seconds ago';
    }

    if ($diff >= 60 && $diff < $intervals['hour']) {
        $diff = floor($diff / $intervals['minute']);
        return $diff == 1 ? $diff . ' minute ago' : $diff . ' minutes ago';
    }

    if ($diff >= $intervals['hour'] && $diff < $intervals['day']) {
        $diff = floor($diff / $intervals['hour']);
        return $diff == 1 ? $diff . ' hour ago' : $diff . ' hours ago';
    }

    if ($diff >= $intervals['day'] && $diff < $intervals['week']) {
        $diff = floor($diff / $intervals['day']);
        return $diff == 1 ? $diff . ' day ago' : $diff . ' days ago';
    }

    if ($diff >= $intervals['week'] && $diff < $intervals['month']) {
        $diff = floor($diff / $intervals['week']);
        return $diff == 1 ? $diff . ' week ago' : $diff . ' weeks ago';
    }

    if ($diff >= $intervals['month'] && $diff < $intervals['year']) {
        $diff = floor($diff / $intervals['month']);
        return $diff == 1 ? $diff . ' month ago' : $diff . ' months ago';
    }

    if ($diff >= $intervals['year']) {
        $diff = floor($diff / $intervals['year']);
        return $diff == 1 ? $diff . ' year ago' : $diff . ' years ago';
    }
}

/*
  return date difference
 */

function get_date_diff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
      $interval can be:
      yyyy - Number of full years
      q - Number of full quarters
      m - Number of full months
      y - Difference between day numbers
      (eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
      d - Number of full days
      w - Number of full weekdays
      ww - Number of full weeks
      h - Number of full hours
      n - Number of full minutes
      s - Number of full seconds (default)
     */

    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }

    $difference = $dateto - $datefrom; // Difference in seconds

    switch ($interval) {
        case 'yyyy': // Number of full years
            $years_difference = floor($difference / 31536000);
            if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom) + $years_difference) > $dateto) {
                $years_difference--;
            }

            if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto) - ($years_difference + 1)) > $datefrom) {
                $years_difference++;
            }
            $datediff = $years_difference;
            break;

        case "q": // Number of full quarters
            $quarters_difference = floor($difference / 8035200);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($quarters_difference * 3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }
            $quarters_difference--;
            $datediff = $quarters_difference;
            break;

        case "m": // Number of full months
            $months_difference = floor($difference / 2678400);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom) + ($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }
            $months_difference--;
            $datediff = $months_difference;
            $datediff = $datediff + 1; //for getting the correct month difference
            break;

        case 'y': // Difference between day numbers
            $datediff = date("z", $dateto) - date("z", $datefrom);
            break;

        case "d": // Number of full days
            $datediff = floor($difference / 86400);
            break;

        case "w": // Number of full weekdays
            $days_difference = floor($difference / 86400);
            $weeks_difference = floor($days_difference / 7); // Complete weeks
            $first_day = date("w", $datefrom);
            $days_remainder = floor($days_difference % 7);
            $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
            if ($odd_days > 7) { // Sunday
                $days_remainder--;
            }
            if ($odd_days > 6) { // Saturday 
                $days_remainder--;
            }
            $datediff = ($weeks_difference * 5) + $days_remainder;
            break;

        case "ww": // Number of full weeks
            $datediff = floor($difference / 604800);
            break;
        case "h": // Number of full hours
            $datediff = floor($difference / 3600);
            break;
        case "n": // Number of full minutes
            $datediff = floor($difference / 60);
            break;
        default: // Number of full seconds (default)
            $datediff = $difference;
            break;
    }
    return $datediff;
}
//convert timestamp to date time format
function timestamp_to_datetime($timestamp,$date_format){
    $date = date_create();
    date_timestamp_set($date, $timestamp);
    return date_format($date, $date_format);
}

function print_rating($rating) {
    $rating = roundDownToHalf($rating);
    $total_star = 5;
    $ratings = explode('.', $rating);
    $html = '';
    for ($i = 1; $i <= $ratings[0]; $i++) {
        $html .= '<i class="fa fa-star" data-prev-rating-class="fa fa-star"></i>';
        $total_star -= 1;
    }
    if (!empty($ratings[1])) {
        $html .= '<i class="fa fa-star-half-full" data-prev-rating-class="fa fa-star-half-full"></i>';
        $total_star -= 1;
    }
    for ($i = (5 - $total_star) + 1; $i <= 5; $i++) {
        $html .= '<i data-prev-rating-class="fa fa-star-o" class="fa fa-star-o"></i>';
    }
    return $html;
}

function roundDownToHalf($number) {

    $remainder = ($number * 10) % 10;
    $half = $remainder >= 5 ? 0.5 : 0;
    $value = floatval(intval($number) + $half);
    if ($half > 0) {
        return number_format($value, 1, '.', '');
    } else {
        return $value;
    }
}

function push_message_start($workout_id) {
    if (!($binary = which(array('php', 'php5', 'php-cli', 'php-cgi', '/usr/local/php54/bin/php', 'php54-cli'))))
        return false;
    $file_path = c('site_basepath') . 'index.php';
    return exec("$binary $file_path api mobile push_start_message $workout_id > /dev/null &");
}

function workout_booking_email($booking_id) {
    if (!($binary = which(array('php', 'php5', 'php-cli', 'php-cgi', '/usr/local/php54/bin/php', 'php54-cli'))))
        return false;
    $file_path = c('site_basepath') . 'index.php';
    return exec("$binary $file_path api mobile workout_booking_email $booking_id > /dev/null &");
}

function which($binaries) {

    if (ENVIRONMENT == 'testing') {
        return '/usr/local/php54/bin/php';
    } else if (ENVIRONMENT == 'production') {
        return 'php54-cli';
    }

    if (!($path = getenv('PATH')) && !($path = getenv('Path')))
        return 'php';

    $arr = preg_split('/[:;]/', $path);

    foreach ($arr as $p) {
        foreach ($binaries as $b) {
            if (file_exists("$p/$b"))
                return "$p/$b";
        }
    }

    return 'php';
}

function is_start_date_over($from_date) {
    $curr_date = get_cur_date_time();
    if (strtotime($curr_date) > strtotime($from_date)) {
        return true;
    } else {
        return false;
    }
}

//This function transforms the php.ini notation for numbers (like '2M') to an integer (2*1024*1024 in this case)  
function convertPHPSizeToBytes($sSize) {
    if (is_numeric($sSize)) {
        return $sSize;
    }
    $sSuffix = substr($sSize, -1);
    $iValue = substr($sSize, 0, -1);
    switch (strtoupper($sSuffix)) {
        case 'P':
            $iValue *= 1024;
        case 'T':
            $iValue *= 1024;
        case 'G':
            $iValue *= 1024;
        case 'M':
            $iValue *= 1024;
        case 'K':
            $iValue *= 1024;
            break;
    }
    return $iValue;
}

function getMaximumFileUploadSize() {
    return min(convertPHPSizeToBytes(ini_get('post_max_size')), convertPHPSizeToBytes(ini_get('upload_max_filesize')));
}

function formatBytes($size, $precision = 2) {
    $base = log($size, 1024);
    $suffixes = array('B', 'Kb', 'MB', 'GB', 'TB', 'PB');
    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}

function fncEncrypt_data($array) {
    $array = str_replace(array("&#39;", "&quot;"), array("'", '"'), $array);
    $encoded = serialize($array);
    $encoded = base64_encode($encoded);
    $encoded = urlencode($encoded);
    return $encoded;
}

function fncDecrypt_data($encrypted) {
    if (!empty($encrypted)) {
        ///$encrypted = str_replace(array("'", '"'), array("&#39;", "&quot;"), $encrypted);
        $uncrypted = urldecode($encrypted);
        $uncrypted = base64_decode($uncrypted);
        $uncrypted = unserialize($uncrypted);
        //$uncrypted = str_replace(array("'", '"'), array("&#39;", "&quot;"), $uncrypted);
        return $uncrypted;
    }
    return $encrypted;
}

function nl2comma($str) {
    $str = nl2br($str);
    $str = str_replace('<br />', ',', $str);
    return substr(trim($str), 0, -1);
}

function remove_temp_images() {
    $files = glob(c('file_upload_path') . 'temp_crop/*');
    $now = time();

    foreach ($files as $file) {
        if (is_file($file)) {
            if ($now - filemtime($file) >= 60 * 60 * 24 * 5) { // 5 days 
                @unlink($file);
            }
        }
    }
}

function remove_temp_captcha() {
    $files = glob(c('file_upload_path') . 'captcha/*');
    $now = time();

    foreach ($files as $file) {
        if (is_file($file)) {
            if ($now - filemtime($file) >= 60 * 60 * 3) { // 3 hrs
                @unlink($file);
            }
        }
    }
}

function format_array_for_mobile($array = array()) {
    if (empty($array))
        return array();
    $formated = array();
    foreach ($array as $k => $v) {
        $formated[] = array('id' => $k, 'name' => $v);
    }
    return $formated;
}

function set_null($val, $default = '') {

    return empty($val) ? $default : $val;
}

function validateDate($date, $format = 'Y-m-d H:i:s') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function extract_sms($sms, $type) {
    for ($i = 0; $i < count($sms); $i++) {
        if ($type == 'lead_type') {
            if (strtolower($sms[$i]) == 'seller') {
                unset($sms[$i]);
                return array('value' => 'seller', 'sms' => array_values($sms));
            } else if (strtolower($sms[$i]) == 'buyer') {
                unset($sms[$i]);
                return array('value' => 'buyer', 'sms' => array_values($sms));
            }
        } else if ($type == 'email') {
            if (check_email_format($sms[$i])) {
                $mail = $sms[$i];
                unset($sms[$i]);
                return array('value' => $mail, 'sms' => array_values($sms));
            }
        }
    }

    return array('value' => '', 'sms' => $sms);
}

function check_email_format($email) {
    $email = strtolower($email);
    if (preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})^", $email)) {
        return true;
    } else {
        return false;
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists('random_string')) {

    /**
     * Create a Random String
     *
     * Useful for generating passwords or hashes.
     *
     * @param	string	type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
     * @param	int	number of characters
     * @return	string
     */
    function random_string($type = 'alnum', $len = 8) {
        switch ($type) {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                switch ($type) {
                    case 'alpha':
                        $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'alnum':
                        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        break;
                    case 'numeric':
                        $pool = '0123456789';
                        break;
                    case 'nozero':
                        $pool = '123456789';
                        break;
                }
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'unique': // todo: remove in 3.1+
            case 'md5':
                return md5(uniqid(mt_rand()));
            case 'encrypt': // todo: remove in 3.1+
            case 'sha1':
                return sha1(uniqid(mt_rand(), TRUE));
        }
    }

}

function getSuburb($suburb_id = '') {
    if ($suburb_id == '') {
        $where = array('active_status' => 1, 'status' => 1);
    } else {
        $where = array('postal_id' => $suburb_id, 'active_status' => 1, 'status' => 1);
    }
    $ci = &get_instance();

    if (!empty($where)) {
        $ci->db->where($where);
    }
    $streets = $ci->db->get('postal_code');

    if ($streets->num_rows() > 0) {
        return $streets->result_array();
    }
    return array();
}

function getAgent($agent_id = '', $select = "*") {
    if ($agent_id == '') {
        $where = array('active_status' => 1, 'status' => 1);
    } else {
        $where = array('agent_id' => $agent_id, 'active_status' => 1, 'status' => 1);
    }
    $ci = &get_instance();
    $ci->db->select($select);

    if (!empty($where)) {
        $ci->db->where($where);
    }

    $ci->db->order_by('agency_nm');
    $ci->db->from('agent_details');
    $agents = $ci->db->get();

    if ($agents->num_rows() > 0) {
        return $agents->result_array();
    }
    return array();
}

function getStreetType($street_id = '', $select = "*") {
    if ($street_id == '') {
        $where = array('active_status' => 1, 'status' => 1);
    } else {
        $where = array('street_type_id' => $street_id, 'active_status' => 1, 'status' => 1);
    }
    $ci = &get_instance();
    $ci->db->select($select);

    if (!empty($where)) {
        $ci->db->where($where);
    }

    $ci->db->order_by('street_type');
    $ci->db->from('street_type');
    $streets = $ci->db->get();

    if ($streets->num_rows() > 0) {
        return $streets->result_array();
    }
    return array();
}

function getPropertyFeatures($feature_id = '', $type = '', $select = "*") {
    if ($feature_id != '') {
        $where = array('property_features_id' => $feature_id);
    }
    if ($type != '') {
        if (!empty($where)) {
            $where = array_merge($where, array('type' => $type));
        } else {
            $where = array('type' => $type);
        }
    }
    if (!empty($where)) {
        $where = array_merge($where, array('active_status' => 1, 'status' => 1));
    } else {
        $where = array('active_status' => 1, 'status' => 1);
    }

    $ci = &get_instance();
    $ci->db->select($select);

    if (!empty($where)) {
        $ci->db->where($where);
    }
    $ci->db->order_by('property_feature');
    $ci->db->from('property_features');
    $streets = $ci->db->get();

    if ($streets->num_rows() > 0) {
        return $streets->result_array();
    }
    return array();
}

function getPropertyType($property_type_id = '', $select = "*") {
    if ($property_type_id == '') {
        $where = array('active_status' => 1, 'status' => 1);
    } else {
        $where = array('property_type_id' => $property_type_id, 'active_status' => 1, 'status' => 1);
    }
    $ci = &get_instance();
    $ci->db->select($select);

    if (!empty($where)) {
        $ci->db->where($where);
    }

    $ci->db->order_by('property_type');
    $ci->db->from('property_type');
    $streets = $ci->db->get();

    if ($streets->num_rows() > 0) {
        return $streets->result_array();
    }
    return array();
}

/**
 * get encript password
 *
 * @param  $password
 * @return encr password
 */
function get_encr_password($password) {
    $pass = md5($password);
    return substr(md5($pass . 'renter_ratings'), 0, 50);
}

function getFilters($filter_id = '', $select = "*") {

    if ($filter_id == '') {
        $where = array('active_status' => 1, 'status' => 1);
    } else {
        $where = array('$ilter_id' => $filter_id, 'active_status' => 1, 'status' => 1);
    }
    $ci = &get_instance();
    $ci->db->select($select);

    if (!empty($where)) {
        $ci->db->where($where);
    }
    $ci->db->from('filter');
    $filters = $ci->db->get();

    if ($filters->num_rows() > 0) {
        return $filters->result_array();
    }
    return array();
}

function load_notification_count($type = '') {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    if($type == 'suppler')
       $tbl_name = 'cc_suppliers';
    else if($type == 'enquiries_ls')
       $tbl_name = 'ls_enquiries';
    else 
        $tbl_name = 'cc_enquiries';
    return $CI->admin_model->get_notification_count($tbl_name);
}

function loadweeklytotalreviewdata() {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    return $CI->admin_model->loadweeklytotalreviewdata();
}

function loadreviewbysuburb() {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    return $CI->admin_model->loadreviewbysuburb();
}

function getclientcount() {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    return $CI->admin_model->getclientcount();
}

function getallads() {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    return $CI->admin_model->loadallactiveads();
}

function loadtopratedproperty() {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    return $CI->admin_model->loadtopratedproperty();
}

function loadlatestagents() {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    return $CI->admin_model->loadallagents(0, 5, "list");
}

function loadblogposts($blog_id = "") {
    $CI = &get_instance();
    $CI->load->model('common_model');
    return $CI->common_model->loadblogposts($blog_id);
}

function get_leadprice_question ($qustion_id = 0) {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    return $CI->admin_model->get_qustion_byid($qustion_id);
}

function get_username ($user_id = 0) {  
    $CI = &get_instance();
    $CI->load->model('web_model');
    return $CI->web_model->get_username($user_id);
}

function get_leadprice_answer ($ansid = 0) {
    $CI = &get_instance();
    $CI->load->model('admin/admin_model');
    return $CI->admin_model->get_answer_byid($ansid);
}
function upload_config_image($image_path, $allowed_types = 'pdf|doc|docx') {
        $CI = & get_instance();
        $CI->config->config['upload_path'] = $image_path;
        $CI->config->config['allowed_types'] = $allowed_types;
        $CI->config->config['max_size'] = "2048000"; // Can be set to particular file size , here it is 2 MB(2048 Kb)
        return $CI->config->config;
    }
