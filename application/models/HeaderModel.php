<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class HeaderModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
		$this->load->model('UsersModel', 'usersmodel', TRUE);
		$this->load->model('ProjectModel', 'projectmodel', TRUE);
		$this->load->model('RoleModel', 'rolemodel', TRUE);
		$this->load->model('DepartmentModel', 'departmentmodel', TRUE);
		$this->load->model('DesignationModel', 'designationmodel', TRUE);
		$this->load->model('ModuleModel', 'modulemodel', TRUE);
		$this->load->model('ClientModel', 'clientmodel', TRUE);
		$this->load->model('VendorModel', 'vendormodel', TRUE);
		$this->load->model('TaskModel', 'taskmodel', TRUE);
	}
	
	function headerdata()
    {
        $title = strtolower($this->uri->segment(1));
		$page = strtolower($this->uri->segment(2));		
		$headercontent['title'] 			= $title;
		$headercontent['page'] 				= $page;
		$headercontent['user_data'] 		= $this->session->userdata('user_data');
		$headercontent['allroles'] 			= $this->rolemodel->getallroles();
		$headercontent['alldepartment'] 	= $this->departmentmodel->getalldepartment();
		$headercontent['alldesignation'] 	= $this->designationmodel->getalldesignation();
		$headercontent['allusers'] 			= $this->usersmodel->getallusers();
		$headercontent['allproject'] 		= $this->projectmodel->getallproject();
		$headercontent['allprojectmodule'] 	= $this->projectmodel->getallprojectmodule();
		$headercontent['allclient'] 		= $this->clientmodel->getallclient();
		$headercontent['allvendor'] 		= $this->vendormodel->getallvendor();
		$headercontent['allmodule'] 		= $this->modulemodel->getallmodule();
		$headercontent['alltask'] 			= $this->taskmodel->getalltask();
        return $headercontent;
    }  
	  
}
?>