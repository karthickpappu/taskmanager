<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sms
 *
 * @author Natesh
 */
class Sms {
    //put your code here
    public $msg = "";
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->msg = "";
    }

    
    public function array_to_file1($facility_id_array) {
        $json = json_encode($facility_id_array);
        $file = "./ovsms.txt";
        //using the FILE_APPEND flag to append the content.
        file_put_contents($file, $json, FILE_APPEND);
    }
    public function sendsms($to,$text_msg)
    {
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "http://enterprise.smsgatewaycenter.com/SMSApi/rest/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "userId=istemtrans&password=Istem2021@&&senderId=ISTEMB&sendMethod=simpleMsg&msgType=text&mobile=".$to."&msg=".$text_msg."&duplicateCheck=true&format=json",
        CURLOPT_HTTPHEADER => array(
        
        "cache-control: no-cache",
        "content-type: application/x-www-form-urlencoded"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            
            $this->msg = "cURL Error #:" . $err;
            return false;
        } else {
           
            return true;
        }
    }    
}
