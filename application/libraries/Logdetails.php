<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
class Logdetails {
    public function __construct()
    {
        $this->CI =& get_instance();
    }
    public function get_logdetails($ip=NULL)
            
    {
        
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

                $ip = $_SERVER['HTTP_CLIENT_IP'];

            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
 
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {

                $ip = $_SERVER['REMOTE_ADDR'];
                
            }
        return $ip;

    }
    public function get_ip()
            
    {
        
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

                $ip = $_SERVER['HTTP_CLIENT_IP'];

            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
 
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {

                $ip = $_SERVER['REMOTE_ADDR'];
                
            }
        return $ip;

    }

}
?>

