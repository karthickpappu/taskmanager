<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$segment_1 = $this->uri->segment(1);
$segment_2 = $this->uri->segment(2);
$segment_3 = $this->uri->segment(3); 

$route['default_controller'] = 'LoginController';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['401_error'] = 'ErrorController/error_401';
$route['403_error'] = 'ErrorController/error_403';

// Login
$route['login'] = 'LoginController';
$route['login/(:any)'] = 'LoginController';
$route['logout'] = 'LoginController/logout';
$route['login-verification'] = 'LoginController/verification';


//Website
$route['home'] = 'WebsiteController/index';
$route['home/(:any)'] = 'WebsiteController/pages/$1';

$route['project'] = 'ProjectController/index/$1';
$route['project/(:any)'] = 'ProjectController/pages/$1';
$route['data/project/(:any)'] = 'ProjectController/'.$segment_3;

$route['task'] = 'TaskController/index/$1';
$route['task/(:any)'] = 'TaskController/pages/$1';
$route['task/(:any)/(:any)'] = 'TaskController/pages/$1';
$route['data/task/(:any)'] = 'TaskController/'.$segment_3;

$route['todo'] = 'TodoController/index/$1';
$route['todo/(:any)'] = 'TodoController/pages/$1';
$route['data/todo/(:any)'] = 'TodoController/'.$segment_3;

$route['ticket'] = 'TicketController/index/$1';
$route['ticket/(:any)'] = 'TicketController/pages/$1';
$route['data/ticket/(:any)'] = 'TicketController/'.$segment_3;

$route['user'] = 'UsersController/index/$1';
$route['user/(:any)'] = 'UsersController/pages/$1';
$route['data/user/(:any)'] = 'UsersController/'.$segment_3;

$route['master'] = 'MasterController/index/$1';
$route['master/(:any)'] = 'MasterController/pages/$1';
$route['data/master/(:any)'] = 'MasterController/'.$segment_3;
$route['data/department/(:any)'] = 'DepartmentController/'.$segment_3;
$route['data/designation/(:any)'] = 'DesignationController/'.$segment_3;


?>