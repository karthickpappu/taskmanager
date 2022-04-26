<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class LoginModel extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->helper('directory');
        $this->load->library('crypt');
	}
	
    function checkuser($post_data,$token)
	{
        try 
		{ 
            $user_role = $post_data['user_role'];
            $user_detail = $post_data['user_detail'];
            $user_password = $post_data['user_password'];   
            $status = '1';      
			$hashed_password = $this->crypt->hash_password($user_password);
            $sql = "SELECT * FROM users WHERE (( code = ? OR email = ? ) AND passcode =? ) AND status = ? LIMIT 1";
            $query = $this->db->query($sql, [$user_detail,$user_detail,$hashed_password,$status]);
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
}
?>