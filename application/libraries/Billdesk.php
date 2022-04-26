<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Billdesk
 *
 * @author Natesh
 */
class Billdesk {
    //put your code here
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    
    public function generate_checksum($parameters, $key)
    {
        $checksum = strtoupper(hash_hmac('sha256',$parameters,$key, false));
        return $checksum;
    }
    
    public function validate_checksum($parameters, $key, $billdesk_checksum)
    {
        $checksum = strtoupper(hash_hmac('sha256',$parameters,$key, false));
        if(strcmp($checksum,$billdesk_checksum)==0)
        {    
            return true;
        }
        else
        {
            return false;
        }
    }
}
