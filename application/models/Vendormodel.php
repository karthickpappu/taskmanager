<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class VendorModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
        $this->load->library('session');
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function getallvendor()
    {
        try { 
			$user_data = $this->session->userdata('user_data');
            $lead_id = $user_data['lead_id'];   
            $status = '1';      
            $sql = "SELECT * FROM vendors WHERE lead_id = ?  AND status = ? ";
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
            $this->db->select('vendor_id');
            $this->db->from('vendors');
            $this->db->order_by('vendor_id','desc');
            $this->db->limit(1); 
            $query = $this->db->get();
            $countop = $query->row();
            $vendoridcount = $countop->vendor_id + 1;

            $this->db->select('prefix');
            $this->db->from('leads');
            $this->db->where('lead_id',$lead_id);
            $query = $this->db->get();
            $leadop = $query->row();

            $leadingzeros = '00000';
            $no_reg = $leadop->prefix.'C'.(substr($leadingzeros, 0, (-strlen($vendoridcount))) . $vendoridcount);

			$data['vendor_code']		= $no_reg;
			$data['lead_id']		    = $user_data['lead_id'];
			$data['created_by']		    = $user_data['user_id'];
			$data['name']	 	        = $post_data['name'];
			$data['phone']	 	        = $post_data['phone'];
			$data['email']	 	        = $post_data['email'];
			$data['gst']	 	        = $post_data['gst'];
			$data['description']		= $post_data['description'];
			$data['address']	    	= $post_data['address'];
			$data['state']		        = $post_data['state'];
			$data['city']		        = $post_data['city'];
			$data['pincode']		    = $post_data['pincode'];
            if(strlen($_FILES['vendor_logo']['name']) > 0){
                $_FILES['file']['name'] 			= $_FILES["vendor_logo"]['name'];
                $_FILES['file']['type'] 			= $_FILES["vendor_logo"]['type'];
                $_FILES['file']['tmp_name'] 		= $_FILES["vendor_logo"]['tmp_name'];
                $_FILES['file']['error'] 			= $_FILES["vendor_logo"]['error'];
                $_FILES['file']['size'] 			= $_FILES["vendor_logo"]['size'];
                $new_name 							= time().'_'.(str_replace(' ','_',$_FILES["vendor_logo"]['name']));
                $new_file_name 						= preg_replace('/[^A-Za-z0-9\-.]/', '',$new_name);
                $config['upload_path']   			= './assets/images/vendorlogo/';
                $config['allowed_types'] 			= 'pdf|pptx|docx|doc|jpg|jpeg|png';
                $config['max_size']      			= '8388608';
                $config['file_name']	 			= $new_file_name;	
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data['vendor_logo'] 				    = $new_file_name;	
            }else{
                $data['vendor_logo'] 				    = '';	
            }
			if($this->db->insert('vendors',$data)){
				if($this->db->affected_rows() == 1){	
					$last_insert_id = $this->db->insert_id();
					return true;
				}
			}else{
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
			$id	 	                    = $post_data['edit_id'];
			$data['name']	 	        = $post_data['edit_name'];
			$data['phone']	 	        = $post_data['edit_phone'];
			$data['email']	 	        = $post_data['edit_email'];
			$data['gst']	 	        = $post_data['edit_gst'];
			$data['description']		= $post_data['edit_description'];
			$data['address']	    	= $post_data['edit_address'];
			$data['state']		        = $post_data['edit_state'];
			$data['city']		        = $post_data['edit_city'];
			$data['pincode']		    = $post_data['edit_pincode'];
            if(strlen($_FILES['edit_vendor_logo']['name']) > 0){
                $_FILES['file']['name'] 			= $_FILES["edit_vendor_logo"]['name'];
                $_FILES['file']['type'] 			= $_FILES["edit_vendor_logo"]['type'];
                $_FILES['file']['tmp_name'] 		= $_FILES["edit_vendor_logo"]['tmp_name'];
                $_FILES['file']['error'] 			= $_FILES["edit_vendor_logo"]['error'];
                $_FILES['file']['size'] 			= $_FILES["edit_vendor_logo"]['size'];
                $new_name 							= time().'_'.(str_replace(' ','_',$_FILES["edit_vendor_logo"]['name']));
                $new_file_name 						= preg_replace('/[^A-Za-z0-9\-.]/', '',$new_name);
                $config['upload_path']   			= './assets/images/vendorlogo/';
                $config['allowed_types'] 			= 'pdf|pptx|docx|doc|jpg|jpeg|png';
                $config['max_size']      			= '8388608';
                $config['file_name']	 			= $new_file_name;	
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->do_upload('file');
                $data['vendor_logo'] 				    = $new_file_name;	
            }else{
                $data['vendor_logo'] 				    = $post_data['edit_vendor_logo_old'];
            }
            $this->db->where('vendor_id', $id);
            $this->db->update('vendors',$data);
            if ($this->db->affected_rows() > 0) {	
				return true;
			}else{
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
			$this->db->where('vendor_id', $id);
            $this->db->update('vendors',$data);
            if ($this->db->affected_rows() > 0){
				return true;
			}else{
                $this->msg = "UNKNOWN ERROR: Couldn't insert data";
                return false;
            }
		} catch (Exception $e) {
			var_dump($e->getMessage());
		}
    }

}
?>