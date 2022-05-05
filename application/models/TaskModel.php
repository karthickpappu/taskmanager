<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class TaskModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getalltask()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM task WHERE lead_id = ?  AND status = ? order by task_id desc";
            $query = $this->db->query($sql, [$lead_id,$status]);
            $result = $query->result();
            if($result){
                return $result;
            }else{
                return FALSE;
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }  
	
	function getmytask()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $user_id = $user_data['user_id'];   
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $query = $this->db->select('*')->from('task')->where("assign_to LIKE '%$user_id%'")->where("lead_id = '$lead_id'")->order_by('task_id','desc')->get()->result();
            if($query){
                return $query;
            }else{
                return FALSE;
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    } 	
		
	function gettaskbyid($id)
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM task WHERE task_id = ?  AND lead_id = ?  AND status = ? ";
            $query = $this->db->query($sql, [$id,$lead_id,$status]);
            $result = $query->row();
            if($result){
                return $result;
            }else{
                return FALSE;
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    } 
    
	function getalltasktodo()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM task_todo WHERE lead_id = ? and status = ? ";
            $query = $this->db->query($sql, [$lead_id,$status]);
            $result = $query->result();
            if($result){
                return $result;
            }else{
                return FALSE;
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    } 
	
	function create($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];         
            $this->db->select('task_id');
            $this->db->from('task');
            $this->db->order_by('task_id','desc');
            $this->db->limit(1); 
            $query = $this->db->get();
            $countop = $query->row();
            $taskidcount = $countop->task_id + 1;

            $this->db->select('prefix');
            $this->db->from('leads');
            $this->db->where('lead_id',$lead_id);
            $query = $this->db->get();
            $leadop = $query->row();

            $leadingzeros = '00000';
            $no_reg = $leadop->prefix.'T'.(substr($leadingzeros, 0, (-strlen($taskidcount))) . $taskidcount);

			$data['task_code']		    = $no_reg;
			$data['lead_id']		    = $user_data['lead_id'];
			$data['created_by']		    = $user_data['user_id'];
			$data['project_id']		    = $post_data['project_id'];
			$data['project_module_id']	= $post_data['project_module_id'];
			$data['title']		 	    = $post_data['title'];
			$data['description']        = $post_data['description'];
			$data['date_from']          = $post_data['date_from'];
			$data['date_to']	 	    = $post_data['date_to'];
			$data['priority']		    = $post_data['priority'];
			$data['assign_to']		    = implode(',',$post_data['assign_to']);
			$data['followers']		    = implode(',',$post_data['followers']);
            if(strlen($_FILES['task_attachment']['name']) > 0){
                $_FILES['file']['name'] 			= $_FILES["task_attachment"]['name'];
                $_FILES['file']['type'] 			= $_FILES["task_attachment"]['type'];
                $_FILES['file']['tmp_name'] 		= $_FILES["task_attachment"]['tmp_name'];
                $_FILES['file']['error'] 			= $_FILES["task_attachment"]['error'];
                $_FILES['file']['size'] 			= $_FILES["task_attachment"]['size'];
                $new_name 							= time().'_'.(str_replace(' ','_',$_FILES["task_attachment"]['name']));
                $new_file_name 						= preg_replace('/[^A-Za-z0-9\-.]/', '',$new_name);
                $config['upload_path']   			= './assets/images/task/';
                $config['allowed_types'] 			= 'pdf|pptx|docx|doc|jpg|jpeg|png';
                $config['max_size']      			= '8388608';
                $config['file_name']	 			= $new_file_name;	
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data['task_attachment'] 				= $new_file_name;	
            }else{
                $data['task_attachment'] 				= '';	
            }
			if($this->db->insert('task',$data))
			{
				if($this->db->affected_rows() == 1)
				{	
					$last_insert_id = $this->db->insert_id();
					return true;
				}
			}
			else
            {
                $this->msg = "UNKNOWN ERROR: Couldn't insert data";
                return false;
            }
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
    }	

    function createtasktodo($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];         
            $this->db->select('task_todo_id');
            $this->db->from('task_todo');
            $this->db->order_by('task_todo_id','desc');
            $this->db->limit(1); 
            $query = $this->db->get();
            $countop = $query->row();
            $tasktodoidcount = $countop->task_todo_id + 1;

            $this->db->select('prefix');
            $this->db->from('leads');
            $this->db->where('lead_id',$lead_id);
            $query = $this->db->get();
            $leadop = $query->row();

            $leadingzeros = '00000';
            $no_reg = $leadop->prefix.'TT'.(substr($leadingzeros, 0, (-strlen($tasktodoidcount))) . $tasktodoidcount);

			$data['task_todo_code']		= $no_reg;
			$data['lead_id']		    = $user_data['lead_id'];
			$data['created_by']		    = $user_data['user_id'];
			$data['task_id']		    = $user_data['task_id'];
			$data['title']		 	    = $post_data['title'];
			$data['description']        = $post_data['description'];
            if(strlen($_FILES['task_todo_attachment']['name']) > 0){
                $_FILES['file']['name'] 			= $_FILES["task_todo_attachment"]['name'];
                $_FILES['file']['type'] 			= $_FILES["task_todo_attachment"]['type'];
                $_FILES['file']['tmp_name'] 		= $_FILES["task_todo_attachment"]['tmp_name'];
                $_FILES['file']['error'] 			= $_FILES["task_todo_attachment"]['error'];
                $_FILES['file']['size'] 			= $_FILES["task_todo_attachment"]['size'];
                $new_name 							= time().'_'.(str_replace(' ','_',$_FILES["task_todo_attachment"]['name']));
                $new_file_name 						= preg_replace('/[^A-Za-z0-9\-.]/', '',$new_name);
                $config['upload_path']   			= './assets/images/task_todo/';
                $config['allowed_types'] 			= 'pdf|pptx|docx|doc|jpg|jpeg|png';
                $config['max_size']      			= '8388608';
                $config['file_name']	 			= $new_file_name;	
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data['task_todo_attachment'] 				= $new_file_name;	
            }else{
                $data['task_todo_attachment'] 				= '';	
            }
			if($this->db->insert('task_todo',$data))
			{
				if($this->db->affected_rows() == 1)
				{	
					$last_insert_id = $this->db->insert_id();
					return true;
				}
			}
			else
            {
                $this->msg = "UNKNOWN ERROR: Couldn't insert data";
                return false;
            }
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
    }


    function changetaskstatus($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $id                     = $post_data['id'];   
            $data['task_status']    = $post_data['task_status'];   
			$this->db->where('task_id ', $id);
            $this->db->update('task',$data);
            if ($this->db->affected_rows() > 0)
            {
				return true;
			}
			else
            {
                $this->msg = "UNKNOWN ERROR: Couldn't insert data";
                return false;
            }
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
    }	

    function changetasktodostatus($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $id                         = $post_data['id'];   
            $data['tasktodo_status']    = $post_data['tasktodo_status'];   
			$this->db->where('task_todo_id ', $id);
            $this->db->update('task_todo',$data);
            if ($this->db->affected_rows() > 0)
            {
				return true;
			}
			else
            {
                $this->msg = "UNKNOWN ERROR: Couldn't insert data";
                return false;
            }
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
    }	

}
?>