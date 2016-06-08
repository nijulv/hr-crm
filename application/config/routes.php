<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/ideletebankpaymentsd/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'web';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['logincheck']       = "web/logincheck";
$route['dashboard']        = "web/dashboard";
$route['logout']           = "web/logout";

$route['manageuser']              = "web/manageuser";
$route['manageuser/(:any)']       = "web/manageuser/$1";
$route['manageuser/(:any)/(:any)']       = "web/manageuser/$1/$1";

$route['adduser']                 = "web/adduser";
$route['edituser/(:any)']         = "web/edituser/$1";
$route['edituser']                = "web/edituser";
$route['deleteuser/(:any)']       = "web/deleteuser/$1";
$route['deleteuser']              = "web/deleteuser";
$route['viewuser/(:any)']         = "web/viewuser/$1";
$route['viewuser']                = "web/viewuser";
$route['todo']                    = "web/todo";
$route['savetodo']                = "web/savetodo";
$route['deletetodo']              = "web/deletetodo";
$route['deletetodo/(:any)']       = "web/deletetodo/$1";
$route['district']                = "web/district";
$route['edittodo']                = "web/edittodo";
$route['edittodo/(:any)']         = "web/edittodo/$1";
$route['updatetodo']              = "web/updatetodo";
$route['updatetodo/(:any)']       = "web/updatetodo/$1";
$route['search_todolist']         = "web/search_todolist";
$route['search_todolist/(:any)']         = "web/search_todolist/$1";

$route['add_payments']   = "web/add_payments";
$route['add_bankpayments']   = "web/add_bankpayments";
$route['add_agents']   = "web/add_agents";
$route['changestatus/(:any)']   = "web/changestatus/$1";
$route['changestatus']          = "web/changestatus";

$route['edit_bankpayments/(:any)']  = "web/edit_bankpayments/$1"; 
$route['edit_payments/(:any)']  = "web/edit_payments/$1"; 
$route['edit_agents/(:any)']  = "web/edit_agents/$1"; 

$route['deletepayments/(:any)']          = "web/deletepayments/$1";
$route['deletebankpayments/(:any)']          = "web/deletebankpayments/$1";
$route['deleteagent/(:any)']          = "web/deleteagent/$1";
$route['deletecategory/(:any)']          = "web/deletecategory/$1";

$route['generate_invoice/(:any)']          = "web/generate_invoice/$1";

$route['agree_payment/(:any)']          = "web/agree_payment/$1";
$route['disagree_bankpayment/(:any)']       = "web/disagree_payment/$1";
$route['disagree_bankpayment_submit/(:any)/(:any)']  = "web/disagree_bankpayment_submit/$1/$2";

$route['manage_payment']   = "web/manage_payment";
$route['manage_payment/(:num)']   = "web/manage_payment/$1";

$route['manage_cash']   = "web/manage_cash";
$route['manage_cash/(:num)']   = "web/manage_cash/$1";


$route['manage_agents']   = "web/manage_agents";
$route['manage_agents/(:num)']   = "web/manage_agents/$1";

$route['manage_category']   = "web/manage_category";
$route['manage_category/(:num)']   = "web/manage_category/$1";

$route['edit_profile']   = "web/edit_profile";
$route['change_password']   = "web/change_password";
$route['forgotpassword']   = "web/forgotpassword";

$route['agent_reports']           = "web/agent_reports";
$route['agent_reports/(:num)']    = "web/agent_reports/$1";

$route['payment_reports']           = "web/payment_reports";
$route['payment_reports/(:num)']    = "web/payment_reports/$1";

$route['user_reports']           = "web/user_reports";
$route['user_reports/(:num)']    = "web/user_reports/$1";

$route['viewmore/(:any)/(:any)']      = "ajax/viewmore/$1/$2";
$route['viewuserlist/(:any)/(:any)']  = "ajax/viewuserlist/$1/$2";
$route['district_autocomplete']       = "web/district_autocomplete";

$route['check_username_available']    = "web/check_username_available";
$route['check_user_payment']          = "web/check_user_payment";

$route['category_add']          = "web/category_add";

$route['remove_attchments/(:any)/(:any)']         = "web/remove_attchments/$1/$2";