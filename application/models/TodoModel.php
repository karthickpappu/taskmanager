<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class TodoModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getalltodo()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $user_id = $user_data['user_id'];   
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM todo WHERE lead_id = ? AND assign_to = ?  AND status = ? ";
            $query = $this->db->query($sql, [$lead_id,$user_id,$status]);
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
	
    function todostatus($post_data,$token)
    {
        try {  
            $id = $post_data['id'];      
            $sql = "SELECT * FROM todo WHERE todo_id = ?  ";
            $query = $this->db->query($sql, [$id]);
            $result = $query->row();
            if($result){
				if($result->todo_status == '1'){
					$data['todo_status'] 	= '0';
				}else{
					$data['todo_status'] 	= '1';
				}
				$this->db->trans_start();
				$this->db->where('todo_id', $post_data['id']);
				$this->db->update('todo', $data);
				$this->db->trans_complete();	
				if($this->db->trans_status() === TRUE)
				{	             
					return TRUE;
				}else{
					return FALSE;
				}
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
			$todo_code = '';
		  
			for ($i = 0; $i < $n; $i++) {
				$index = rand(0, strlen($characters) - 1);
				$todo_code .= $characters[$index];
			}

			$data['todo_code']		= $todo_code;
			$data['lead_id']		= $user_data['lead_id'];
			$data['created_by']		= $user_data['user_id'];
			$data['todo']		 	= $post_data['todo'];
			$data['description']    = $post_data['description'];
			$data['date_from']      = $post_data['date_from'];
			$data['date_to']	 	= $post_data['date_to'];
			$data['priority']		= $post_data['priority'];
			$data['assign_to']		= $post_data['assign_to'];
			// $data['followers']		= implode(',',$post_data['followers']);
			if($this->db->insert('todo',$data))
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