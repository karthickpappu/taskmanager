<?php

class TaskController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->library('session');
        $this->load->library('validation');
		$this->load->model('TaskModel', 'taskmodel', TRUE);
		$this->load->model('HeaderModel', 'headermodel', TRUE);
    }

    public function index() {	
		$page_content['alltask'] = $this->taskmodel->getalltask();
		$page_content['mytask'] = $this->taskmodel->getmytask();
		$headercontent = $this->headermodel->headerdata();
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/task/taskboard',$page_content);
            $this->load->view('template/footer');
        } else {        
            redirect('login','refresh'); 
        }
    }
	
	public function pages() {
		$page 						= strtolower($this->uri->segment(2));	
		$id 						= $this->uri->segment(3);
		$page_content['alltask'] 	= $this->taskmodel->getalltask();
		$page_content['mytask'] 	= $this->taskmodel->getmytask();
		$page_content['taskbyid'] 	= $this->taskmodel->gettaskbyid($id);
		$headercontent 				= $this->headermodel->headerdata();
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/task/'.$page,$page_content);
            $this->load->view('template/footer');
        } else {        
            redirect('login','refresh'); 
        }
    }

	public function contentpages() {
		$page 						= strtolower($this->uri->segment(2));	
		$id 						= $this->uri->segment(3);
		$page_content['alltask'] 	= $this->taskmodel->getalltask();
		$page_content['mytask'] 	= $this->taskmodel->getmytask();
		$page_content['taskbyid'] 	= $this->taskmodel->gettaskbyid($id);
		$headercontent 				= $this->headermodel->headerdata();
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/task/'.$page,$page_content);
            $this->load->view('template/footer');
        } else {        
            redirect('login','refresh'); 
        }
    }
		
	function create() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$creation = $this->taskmodel->create($post_data,$token);
		if($creation){
			$message =array('status'=>'1','msg'=>'Task Created successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 
	
	function createtasktodo() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$creation = $this->taskmodel->createtasktodo($post_data,$token);
		if($creation){
			$message =array('status'=>'1','msg'=>'Task Todo Created successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 

	function changetaskstatus() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$creation = $this->taskmodel->changetaskstatus($post_data,$token);
		if($creation){
			$message =array('status'=>'1','msg'=>'Task status updated successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 

	function changetasktodostatus() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$creation = $this->taskmodel->changetasktodostatus($post_data,$token);
		if($creation){
			$message =array('status'=>'1','msg'=>'Task todo status updated successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 
	
	function getalltask() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$query = $this->taskmodel->getalltask();
		echo json_encode($query);
	} 
	
}
