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
$route['dashboard'] = 'WebsiteController/index';
$route['dashboard/(:any)'] = 'WebsiteController/pages/$1';

//project
$route['project'] = 'ProjectController/index/$1';
$route['project/(:any)'] = 'ProjectController/pages/$1';
$route['data/project/(:any)'] = 'ProjectController/'.$segment_3;

//taskboard
$route['taskboard'] = 'TaskController/index/$1';
$route['taskboard/(:any)'] = 'TaskController/pages/$1';
$route['taskboard/(:any)/(:any)'] = 'TaskController/pages/$1';
$route['taskboard/(:any)/(:any)/(:any)'] = 'TaskController/contentpages/$1';
$route['data/task/(:any)'] = 'TaskController/'.$segment_3;

//todo-list
$route['todo-list'] = 'TodoController/index/$1';
$route['todo-list/(:any)'] = 'TodoController/pages/$1';
$route['data/todo/(:any)'] = 'TodoController/'.$segment_3;

//ticket
$route['ticket'] = 'TicketController/index/$1';
$route['ticket/(:any)'] = 'TicketController/pages/$1';
$route['data/ticket/(:any)'] = 'TicketController/'.$segment_3;

//user
$route['user'] = 'UsersController/index/$1';
$route['user/(:any)'] = 'UsersController/pages/$1';
$route['data/user/(:any)'] = 'UsersController/'.$segment_3;

//master
$route['master'] = 'MasterController/index/$1';
$route['master/(:any)'] = 'MasterController/pages/$1';
$route['data/master/(:any)'] = 'MasterController/'.$segment_3;
$route['data/department/(:any)'] = 'DepartmentController/'.$segment_3;
$route['data/designation/(:any)'] = 'DesignationController/'.$segment_3;
$route['data/client/(:any)'] = 'ClientController/'.$segment_3;
$route['data/vendor/(:any)'] = 'VendorController/'.$segment_3;
$route['data/module/(:any)'] = 'ModuleController/'.$segment_3;
$route['data/role/(:any)'] = 'RoleController/'.$segment_3;
$route['data/permission/(:any)/(:any)/(:any)'] = 'RoleController/getpermission/$1/$2/$3';

//access
$route['access'] = 'AccessController/index/$1';
$route['access/(:any)'] = 'AccessController/pages/$1';
$route['data/access/(:any)'] = 'AccessController/'.$segment_3;

?>