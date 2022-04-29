<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class ModuleModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getallmodule()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM modules WHERE lead_id = ?  AND status = ? ";
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

    function delete($post_data,$token)
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