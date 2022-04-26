<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class ProjectModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getallproject()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM project WHERE lead_id = ?  AND status = ? ";
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
            $this->db->select('project_id');
            $this->db->from('project');
            $this->db->order_by('project_id','desc');
            $this->db->limit(1); 
            $query = $this->db->get();
            $countop = $query->row();
            $useridcount = $countop->project_id + 1;

            $this->db->select('prefix');
            $this->db->from('leads');
            $this->db->where('lead_id',$lead_id);
            $query = $this->db->get();
            $leadop = $query->row();

            $leadingzeros = '00000';
            $no_reg = $leadop->prefix.'P'.(substr($leadingzeros, 0, (-strlen($useridcount))) . $useridcount);

			$data['project_code']       = $no_reg;
			$data['lead_id']		    = $user_data['lead_id'];
			$data['created_by']		    = $user_data['user_id'];
			$data['title']		        = $post_data['title'];
			$data['scope']		        = $post_data['scope'];
			$data['description']	    = $post_data['description'];
			$data['project_type']       = $post_data['project_type'];
			$data['client']             = $post_data['client'];
			$data['team']               = implode(',',$post_data['team']);
			$data['signed_on']          = $post_data['signed_on'];
			$data['start_date']         = $post_data['start_date'];
			$data['handover_date']      = $post_data['handover_date'];
			$data['budget_type']        = $post_data['budget_type'];
			$data['budget_amount']      = $post_data['budget_amount'];
			// $data['attachment']		    = $post_data['attachment'];
            if(strlen($_FILES['attachment']['name']) > 0){
                $_FILES['file']['name'] 			= $_FILES["attachment"]['name'];
                $_FILES['file']['type'] 			= $_FILES["attachment"]['type'];
                $_FILES['file']['tmp_name'] 		= $_FILES["attachment"]['tmp_name'];
                $_FILES['file']['error'] 			= $_FILES["attachment"]['error'];
                $_FILES['file']['size'] 			= $_FILES["attachment"]['size'];
                $new_name 							= time().'_'.(str_replace(' ','_',$_FILES["attachment"]['name']));
                $new_file_name 						= preg_replace('/[^A-Za-z0-9\-.]/', '',$new_name);
                $config['upload_path']   			= './assets/images/project/';
                $config['allowed_types'] 			= 'pdf|pptx|docx|doc|jpg|jpeg|png';
                $config['max_size']      			= '8388608';
                $config['file_name']	 			= $new_file_name;	
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data['attachment'] 				= $new_file_name;	
            }else{
                $data['attachment'] 				= '';	
            }

			if($this->db->insert('project',$data))
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

    function changeprojectstatus($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $id                     = $post_data['id'];   
            $data['project_status'] = $post_data['project_status'];
			$this->db->where('project_id', $id);
            $this->db->update('project',$data);
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
			$this->db->where('project_id', $id);
            $this->db->update('project',$data);
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

    function createmodule($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];         
			// $data['code']		        = $no_reg;
			$data['lead_id']		        = $user_data['lead_id'];
			$data['created_by']		        = $user_data['user_id'];
			$data['project_id']		        = $post_data['project_id'];
			$data['module']		            = $post_data['module'];
			$data['module_description']     = $post_data['module_description'];
			if($this->db->insert('modules',$data))
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

    function deletemodule($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $id             = $post_data['id'];   
            $data['status'] = 0;
			$this->db->where('module_id', $id);
            $this->db->update('modules',$data);
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