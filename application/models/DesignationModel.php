<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class DesignationModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getalldesignation()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM designation WHERE lead_id = ?  AND status = ? ";
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
			$data['lead_id']		        = $user_data['lead_id'];
			$data['created_by']		        = $user_data['user_id'];
			$data['department_id']		    = $post_data['department_id'];
			$data['designation']		    = $post_data['designation'];
			$data['designation_prefix']	    = $post_data['designation_prefix'];
			$data['designation_brief']      = $post_data['designation_brief'];
			if($this->db->insert('designation',$data))
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
			$id	                            = $post_data['designation_id'];
			$data['designation']		    = $post_data['edit_designation'];
			$data['designation_prefix']	    = $post_data['edit_designation_prefix'];
			$data['designation_brief']      = $post_data['edit_designation_brief'];
			$this->db->where('designation_id', $id);
            $this->db->update('designation',$data);
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
			$this->db->where('designation_id', $id);
            $this->db->update('designation',$data);
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