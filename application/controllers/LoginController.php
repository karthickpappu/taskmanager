<?php

class LoginController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('directory');
        $this->load->library('validation');
		$this->load->model('LoginModel', 'loginmodel', TRUE);
		$this->load->model('HeaderModel', 'headermodel', TRUE);
    }

    public function index() {
        if ($this->validation->user_in()) {
            redirect('dashboard','refresh');
        } else {        
			$this->load->helper(array('form'));
            $this->load->view('login');
        }
    }
	
	public function logout()
	{
		$this->session->unset_userdata('user_data');
		$this->load->helper(array('form'));
		redirect('login', 'refresh');
	}

	public function verification()
	{		
		$token = openssl_random_pseudo_bytes(16);
		$token = bin2hex($token);
		$post_data = $this->input->post();
		
		$check = $this->loginmodel->checkuser($post_data,$token);
		if($check){			
			$this->session->set_userdata('user_data',(array)$check);
			redirect('dashboard', 'refresh');
		}else{
			redirect('login/Wrong-credentials', 'refresh');
		}		
			
		echo json_encode($message);
	}
   
    /** login using mobile number - check whether the user credential entered is mobile number or username ends*/
}
