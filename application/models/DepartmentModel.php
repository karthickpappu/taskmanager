<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class DepartmentModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getalldepartment()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM department WHERE lead_id = ?  AND status = ? ";
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
			// $data['code']		        = $no_reg;
			$data['lead_id']		    = $user_data['lead_id'];
			$data['created_by']		    = $user_data['user_id'];
			$data['department']		    = $post_data['department'];
			$data['department_prefix']	= $post_data['department_prefix'];
			$data['department_brief']   = $post_data['department_brief'];
			// $data['user_pic']		= $post_data['user_pic'];
            // if(strlen($_FILES['user_pic']['name']) > 0){
            //     $_FILES['file']['name'] 			= $_FILES["user_pic"]['name'];
            //     $_FILES['file']['type'] 			= $_FILES["user_pic"]['type'];
            //     $_FILES['file']['tmp_name'] 		= $_FILES["user_pic"]['tmp_name'];
            //     $_FILES['file']['error'] 			= $_FILES["user_pic"]['error'];
            //     $_FILES['file']['size'] 			= $_FILES["user_pic"]['size'];
            //     $new_name 							= time().'_'.(str_replace(' ','_',$_FILES["user_pic"]['name']));
            //     $new_file_name 						= preg_replace('/[^A-Za-z0-9\-.]/', '',$new_name);
            //     $config['upload_path']   			= './assets/images/profile/';
            //     $config['allowed_types'] 			= 'pdf|pptx|docx|doc|jpg|jpeg|png';
            //     $config['max_size']      			= '8388608';
            //     $config['file_name']	 			= $new_file_name;	
            //     $this->load->library('upload', $config);
            //     $this->upload->initialize($config);
            //     $this->upload->do_upload('file');
            //     $data['user_pic'] 				    = $new_file_name;	
            // }else{
            //     $data['user_pic'] 				    = '';	
            // }

			if($this->db->insert('department',$data))
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

    function update($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];         
			$id	                        = $post_data['department_id'];
			$data['department']		    = $post_data['edit_department'];
			$data['department_prefix']	= $post_data['edit_department_prefix'];
			$data['department_brief']   = $post_data['edit_department_brief'];
			$this->db->where('department_id', $id);
            $this->db->update('department',$data);
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

    function delete($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $id             = $post_data['id'];   
            $data['status'] = 0;
			$this->db->where('department_id', $id);
            $this->db->update('department',$data);
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