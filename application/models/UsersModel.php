<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class UsersModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getallusers()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM users WHERE lead_id = ?  AND status = ? ";
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
            $this->db->select('user_id');
            $this->db->from('users');
            $this->db->order_by('user_id','desc');
            $this->db->limit(1); 
            $query = $this->db->get();
            $countop = $query->row();
            $useridcount = $countop->user_id + 1;

            $this->db->select('prefix');
            $this->db->from('leads');
            $this->db->where('lead_id',$lead_id);
            $query = $this->db->get();
            $leadop = $query->row();

            $leadingzeros = '00000';
            $no_reg = $leadop->prefix.(substr($leadingzeros, 0, (-strlen($useridcount))) . $useridcount);


			$data['code']		        = $no_reg;
			$data['lead_id']		    = $user_data['lead_id'];
			$data['department_id']		= $user_data['department_id'];
			$data['designation_id']		= $post_data['designation_id'];
			$data['first_name']         = $post_data['first_name'];
			$data['middle_name']        = $post_data['middle_name'];
			$data['last_name']	 	    = $post_data['last_name'];
			$data['user_name']	 	    = $post_data['user_name'];
			$data['phone']	 	        = $post_data['phone'];
			$data['email']	 	        = $post_data['email'];
			$data['emp_type']	 	    = $post_data['emp_type'];
			$data['emp_start_date']	 	= $post_data['emp_start_date'];
			$data['emp_end_date']	 	= $post_data['emp_end_date'];
			$data['joining_date']	 	= $post_data['joining_date'];
			$data['role_id']	 	    = $post_data['role_id'];
			$data['department_id']	    = $post_data['department_id'];
			$data['designation_id']	 	= $post_data['designation_id'];
			$data['reporting_to']	    = implode(',',$post_data['reporting_to']);
			$data['description']		= $post_data['description'];
			$data['address']	    	= $post_data['address'];
			$data['state']		        = $post_data['state'];
			$data['city']		        = $post_data['city'];
			$data['pincode']		    = $post_data['pincode'];
			// $data['user_pic']		= $post_data['user_pic'];
            if(strlen($_FILES['user_pic']['name']) > 0){
                $_FILES['file']['name'] 			= $_FILES["user_pic"]['name'];
                $_FILES['file']['type'] 			= $_FILES["user_pic"]['type'];
                $_FILES['file']['tmp_name'] 		= $_FILES["user_pic"]['tmp_name'];
                $_FILES['file']['error'] 			= $_FILES["user_pic"]['error'];
                $_FILES['file']['size'] 			= $_FILES["user_pic"]['size'];
                $new_name 							= time().'_'.(str_replace(' ','_',$_FILES["user_pic"]['name']));
                $new_file_name 						= preg_replace('/[^A-Za-z0-9\-.]/', '',$new_name);
                $config['upload_path']   			= './assets/images/profile/';
                $config['allowed_types'] 			= 'pdf|pptx|docx|doc|jpg|jpeg|png';
                $config['max_size']      			= '8388608';
                $config['file_name']	 			= $new_file_name;	
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data['user_pic'] 				    = $new_file_name;	
            }else{
                $data['user_pic'] 				    = '';	
            }

			if($this->db->insert('users',$data))
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

    function delete($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $id             = $post_data['id'];   
            $data['status'] = 0;
			$this->db->where('user_id', $id);
            $this->db->update('users',$data);
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