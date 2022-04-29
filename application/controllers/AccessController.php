<?php

class AccessController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->library('session');
        $this->load->library('validation');
		$this->load->model('UsersModel', 'usersmodel', TRUE);
		$this->load->model('HeaderModel', 'headermodel', TRUE);
    }

    public function index() {
		$page = strtolower($this->uri->segment(2));	
		$title = strtolower($this->uri->segment(1));	
		$headercontent = $this->headermodel->headerdata();	
		$page_content['title'] = $title;
		$page_content['allusers'] = $this->usersmodel->getallusers();
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/access/master',$page_content);
            $this->load->view('template/footer');
        } else {        
            redirect('login','refresh'); 
        }
    }
	
	public function pages() {
		$page = strtolower($this->uri->segment(2));	
		$title = strtolower($this->uri->segment(1));	
		$headercontent = $this->headermodel->headerdata();	
		$page_content['title'] = $title;
		$page_content['page'] = $page;
		$page_content['allusers'] = $this->usersmodel->getallusers();
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/access/'.$page,$page_content);
            $this->load->view('template/footer');
        } else {        
            redirect('login','refresh'); 
        }
    }

    function create() {					
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		$creation = $this->usersmodel->create($post_data,$token);
		if($creation){
			$message =array('status'=>'1','msg'=>'User Created successfully.','icon'=>'success',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}else{
			$message =array('status'=>'0','msg'=>'Somthing Went Wrong.','icon'=>'danger',"csrfTokenName" => $this->security->get_csrf_token_name(), "csrfHash" => $this->security->get_csrf_hash());
		}
		echo json_encode($message);
	} 
	
}
