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
            $status = '1';      
            $sql = "SELECT * FROM user_roles WHERE status = ? ";
            $query = $this->db->query($sql, [$status]);
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
}
?>