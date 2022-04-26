<?php

class ProjectController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->library('validation');
		$this->load->model('ProjectModel', 'projectmodel', TRUE);
		$this->load->model('HeaderModel', 'headermodel', TRUE);
    }

    public function index() {
		$page = strtolower($this->uri->segment(2));	
		$title = strtolower($this->uri->segment(1));
		$page_content['title'] = $title;
		$headercontent = $this->headermodel->headerdata();
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/project/project',$page_content);
            $this->load->view('template/footer');
        } else {        
            redirect('login','refresh'); 
        }
    }
	
	public function pages() {
		$page = strtolower($this->uri->segment(2));	
		$title = strtolower($this->uri->segment(1));
		$page_content['title'] = $title;	
		$headercontent = $this->headermodel->headerdata();		
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/project/'.$page,$page_content);
            $this->load->view('template/footer');
        } else {        
            redirect('login','refresh'); 
        }
    }

    function create() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$creation = $this->projectmodel->create($post_data,$token);
		if($creation){
			$message =array('status'=>'1','msg'=>'Project Created successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 

	function changeprojectstatus() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$delection = $this->projectmodel->changeprojectstatus($post_data,$token);
		if($delection){
			$message =array('status'=>'1','msg'=>'Project Status Updated successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 

	function delete() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$delection = $this->projectmodel->delete($post_data,$token);
		if($delection){
			$message =array('status'=>'1','msg'=>'Project Deleted successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 

    function createmodule() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$creation = $this->projectmodel->createmodule($post_data,$token);
		if($creation){
			$message =array('status'=>'1','msg'=>'Module Created successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 

	function deletemodule() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$delection = $this->projectmodel->deletemodule($post_data,$token);
		if($delection){
			$message =array('status'=>'1','msg'=>'Module Deleted successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 
	
}
