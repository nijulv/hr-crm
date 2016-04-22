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
|	example.com/class/method/id/
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
$route['adduser']                 = "web/adduser";
$route['edituser/(:any)']         = "web/edituser/$1";
$route['edituser']                = "web/edituser";
$route['deleteuser/(:any)']       = "web/deleteuser/$1";
$route['deleteuser']              = "web/deleteuser";
$route['viewuser/(:any)']         = "web/viewuser/$1";
$route['viewuser']                = "web/viewuser";

$route['add_payments']   = "web/add_payments";
$route['add_agents']   = "web/add_agents";
$route['changestatus/(:any)']   = "web/changestatus/$1";
$route['changestatus']          = "web/changestatus";

$route['edit_payments/(:any)']  = "web/edit_payments/$1"; 
$route['edit_agents/(:any)']  = "web/edit_agents/$1"; 

$route['deletepayments/(:any)']          = "web/deletepayments/$1";
$route['deleteagent/(:any)']          = "web/deleteagent/$1";


$route['manage_payment']   = "web/manage_payment";
$route['manage_payment/(:num)']   = "web/manage_payment/$1";


$route['manage_agents']   = "web/manage_agents";
$route['manage_agents/(:num)']   = "web/manage_agents/$1";
 
