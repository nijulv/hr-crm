<?php

// For the script that is running:

if (!defined('DOCUMENT_ROOT'))
    define('DOCUMENT_ROOT', str_replace('application/config', '', substr(__FILE__, 0, strrpos(__FILE__, '/'))));
$script_directory = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], '/'));
$CI = &get_instance();
//$config['site_baseurl'] = $CI->config->item('site_baseurl');
//$config['site_basepath'] = constant("DOCUMENT_ROOT");
//
//$config['styles_path_url'] = $config['site_baseurl'] . 'assets/styles/';
//$config['css_path_url'] = $config['site_baseurl'] . 'assets/css/';
//$config['js_path_url'] = $config['site_baseurl'] . 'assets/js/';
//
//$config['images_path'] = $config['site_basepath'] . 'assets/images/';
//$config['image_url'] = $config['site_baseurl'] . 'assets/images/';



switch (ENVIRONMENT) {
    case 'local':
        $config['admin_mail'] = 'sooraj.v@rainconcert.in';
        $config['admin_name'] = 'Sooraj V';
        break;
    case 'development':
        $config['admin_mail'] = 'admin@copierchoice.com.au';
        $config['admin_name'] = 'hr-crm';
        break;
    case 'live':
        $config['admin_mail'] = 'sooraj.v@rainconcert.in';
        $config['admin_name'] = 'Sooraj V';
        break;
    default:
        $config['admin_mail'] = 'sooraj.v@rainconcert.in';
        $config['admin_name'] = 'Sooraj V';
        break;
}
//Email template constants
$config['CC_ENQUIRY_MAIL_TEMPLATE']     = 5;
$config['BG_MAIL_TEMPLATE']             = 6;
//$config['LEAD_MAIL_TEMPLATE']           = 7;
$config['ALERT_MAIL_TEMPLATE']          = 9;
$config['LEAD_MAIL_TEMPLATE']           = 14;
$config['VALUATION_MAIL_TEMPLATE']      = 15;

