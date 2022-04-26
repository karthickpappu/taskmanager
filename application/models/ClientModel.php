<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class ClientModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getallclient()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM clients WHERE lead_id = ?  AND status = ? ";
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
            $query = $this->db->select('*')->from('task')->where("assign_to LIKE '%$user_id%'")->where("lead_id = '$lead_id'")->get()->result();
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
	
	function create($post_data,$token)
    {					      
		try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
			$n=15;
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$task_code = '';
		  
			for ($i = 0; $i < $n; $i++) {
				$index = rand(0, strlen($characters) - 1);
				$task_code .= $characters[$index];
			}

			$data['task_code']		= $task_code;
			$data['lead_id']		= $user_data['lead_id'];
			$data['created_by']		= $user_data['user_id'];
			$data['title']		 	= $post_data['title'];
			$data['description']    = $post_data['description'];
			$data['date_from']      = $post_data['date_from'];
			$data['date_to']	 	= $post_data['date_to'];
			$data['priority']		= $post_data['priority'];
			$data['assign_to']		= implode(',',$post_data['assign_to']);
			$data['followers']		= implode(',',$post_data['followers']);
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
}
?>