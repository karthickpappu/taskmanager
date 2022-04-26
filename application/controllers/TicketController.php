<?php

class TicketController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('directory');
        $this->load->library('validation');
		$this->load->model('HeaderModel', 'headermodel', TRUE);
    }

    public function index() {
		$page = strtolower($this->uri->segment(2));	
		$title = strtolower($this->uri->segment(1));	
		$headercontent = $this->headermodel->headerdata();	
		$page_content['title'] = $title;
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/ticket/index',$page_content);
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
        if ($this->validation->user_in()) {   
			$this->load->view('template/header',$headercontent);
            $this->load->view('webpages/ticket/'.$page,$page_content);
            $this->load->view('template/footer');
        } else {        
            redirect('login','refresh'); 
        }
    }
	
}
