<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class RoleModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getallroles()
    {
        try { 
			$user_data = $this->session->userdata('user_data'); 
            $lead_id = $user_data['lead_id']; 
            $status = '1';      
            $sql = "SELECT * FROM roles WHERE lead_id = ?  AND status = ? ";
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
			$data['lead_id']		        = $user_data['lead_id'];
			$data['created_by']		        = $user_data['user_id'];
			$data['role']		            = $post_data['role'];
			$data['role_prefix']            = $post_data['role_prefix'];
			$data['role_brief']             = $post_data['role_brief'];
			if($this->db->insert('roles',$data))
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
			$this->db->where('role_id', $id);
            $this->db->update('roles',$data);
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