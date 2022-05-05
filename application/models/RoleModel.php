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

    function getpermission($module,$action)
    {
        try 
        { 
			$user_data = $this->session->userdata('user_data'); 
            $lead_id = $user_data['lead_id']; 
            $role_id = $user_data['role_id']; 
            $role_id = $user_data['role_id']; 
            $this->db->where('role_id',$code);
            $this->db->where('module',$module);
            $this->db->where($action,'1');
            $codebased = $this->db->get('permissions');    
            if ( $codebased->num_rows() > 0 ) 
            {
                return 1;
            }else{                
                $this->db->where('role_id',$role_id);
                $this->db->where('module',$module);
                $this->db->where($action,'1');
                $roleidbased = $this->db->get('permissions');  
                if ( $roleidbased->num_rows() > 0 ) 
                {
                    return 1;
                }else{                    
                    return 0;
                }
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
    
    function addpermission($post_data,$token)
    {					      
		try 
        { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];         
			// $data['code']		        = $no_reg;
            foreach($post_data['module_id'] as $key => $value)
            {
                $data['lead_id']		        = $user_data['lead_id'];
                $data['created_by']		        = $user_data['user_id'];
                $data['role_id']		        = $post_data['role_id'];
                $data['module_id']		        = $value;
            
                if (empty($post_data['module'][$key])) {
                    $data['module'] = '0';
                } else { 
                    $data['module'] = $post_data['module'][$key];
                }
                if (empty($post_data['module_read'][$key])) {
                    $data['read'] = '0';
                } else { 
                    $data['read'] = $post_data['module_read'][$key];
                }
                if (empty($post_data['module_write'][$key])) {
                    $data['write'] = '0';
                } else { 
                    $data['write'] = $post_data['module_write'][$key];
                }
                if (empty($post_data['module_delete'][$key])) {
                    $data['delete'] = '0';
                } else { 
                    $data['delete'] = $post_data['module_delete'][$key];
                }
                if (empty($post_data['module_create'][$key])) {
                    $data['create'] = '0';
                } else { 
                    $data['create'] = $post_data['module_create'][$key];
                }
                if (empty($post_data['module_import'][$key])) {
                    $data['import'] = '0';
                } else { 
                    $data['import'] = $post_data['module_import'][$key];
                }
                if (empty($post_data['module_export'][$key])) {
                    $data['export'] = '0';
                } else { 
                    $data['export'] = $post_data['module_export'][$key];
                }

                $this->db->where('role_id',$post_data['role_id']);
                $this->db->where('module_id',$value);
                $q = $this->db->get('permissions');
             
                if ( $q->num_rows() > 0 ) 
                {
                    $this->db->where('role_id',$post_data['role_id']);
                    $this->db->where('module_id',$value);
                    $this->db->update('permissions',$data);
                }else{
                    $this->db->insert('permissions',$data);
                }
            }
            if($this->db->affected_rows() == 1)
            {	
                $last_insert_id = $this->db->insert_id();
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