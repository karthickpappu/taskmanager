<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Crypt
 *
 * @author Natesh
 */

class Crypt {
	
    private $hex_iv = "0000000000000000"; # converted Java byte code in to HEX and placed it here       
    private $key = "9ISTEMCENSEIISC0"; #Same as in JAVA	

    //put your code here
    public function __construct() {
        $this->CI = & get_instance();
	$this->key = hash('sha256', $this->key, true);
    }

    public function hash_password($password) {
        $key = "istem_random_salt_string";
        $salt1 = hash('sha512', $key . $password);
        $salt2 = hash('sha512', $password . $key);
        return hash('sha512', $salt1 . $password . $salt2);
    }

    //encryption of equipment id
    public function hash_password_equipment($eq_id) {
        $key=substr(md5($eq_id), 0, 5) . md5($eq_id);
        return $key;
    }
	
    function get_param_hash($param_array)
    {
        $final_param = "";
        foreach ($param_array as $param) {
            if(strlen($param) > 0) {
                $final_param = $final_param.$param.substr($param,0,1);
            }
        }
        return hash('sha256', $final_param);
    }

    function encrypt($str) {       
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        mcrypt_generic_init($td, $this->key, $this->hexToStr($this->hex_iv));
        $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $pad = $block - (strlen($str) % $block);
        $str .= str_repeat(chr($pad), $pad);
        $encrypted = mcrypt_generic($td, $str);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);        
        return base64_encode($encrypted);
    }

    function decrypt($code) {   
        
        $plaintext = sodium_crypto_secretbox_open($ciphertext, $nonce, $key);
        
        $td = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
        mcrypt_generic_init($td, $this->key, $this->hexToStr($this->hex_iv));
        $str = mdecrypt_generic($td, base64_decode($code));
        $block = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        mcrypt_generic_deinit($td);
        mcrypt_module_close($td);        
        return $this->strippadding($str);               
    }
	
	 function encrypt_email($str) {

        $plaintext = $str;
        $password = '3sc3RLrpd17';
        $method = 'aes-256-cbc';

// Must be exact 32 chars (256 bit)
        $password = substr(hash('sha256', $password, true), 0, 32);
       // echo "Password:" . $password . "\n";

// IV must be exact 16 chars (128 bit)
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
        $encrypted = base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));
        return $encrypted;
    }

    function decrypt_email($str) {


        $password = '3sc3RLrpd17';
        $method = 'aes-256-cbc';

// Must be exact 32 chars (256 bit)
        $password = substr(hash('sha256', $password, true), 0, 32);


// IV must be exact 16 chars (128 bit)
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

// av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
        $encrypted = $str;
// My secret message 1234
        $decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }
    /*
      For PKCS7 padding
     */

    private function addpadding($string, $blocksize = 16) {
        $len = strlen($string);
        $pad = $blocksize - ($len % $blocksize);
        $string .= str_repeat(chr($pad), $pad);
        return $string;
    }

    private function strippadding($string) {
        $slast = ord(substr($string, -1));
        $slastc = chr($slast);
        $pcheck = substr($string, -$slast);
        if (preg_match("/$slastc{" . $slast . "}/", $string)) {
            $string = substr($string, 0, strlen($string) - $slast);
            return $string;
        } else {
            return false;
        }
    }
    function hexToStr($hex)
    {
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2)
        {
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
    
    function decrypt_v2($chiper) 
    {   
        $password = $this->key;
        $method = 'aes-256-cbc';
        $iv = $this->hex_iv;
        $encrypted = $chiper;
        $decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }
    
    /*method for testing purpose */
    function decrypt22() 
    {
        $plaintext = 'NATESH';
        $password = '9ISTEMCENSEIISC0';
        $method = 'aes-256-cbc';
        $iv = "0000000000000000";

        // Must be exact 32 chars (256 bit)
        $password = substr(hash('sha256', $password, true), 0, 32);
        //echo "Password=" . $password . "<br>";

        // IV must be exact 16 chars (128 bit)
        //chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);

        // av3DYGLkwBsErphcyYp+imUW4QKs19hUnFyyYcXwURU=
        $encrypted = "VWAaMYKAKOz9nbay2qauLYVa3cQ8tYyXoKszU5PZyH4=";// base64_encode(openssl_encrypt($plaintext, $method, $password, OPENSSL_RAW_DATA, $iv));

        // My secret message 1234
        $decrypted = openssl_decrypt(base64_decode($encrypted), $method, $password, OPENSSL_RAW_DATA, $iv);

        echo 'plaintext=' . $plaintext . "<br>";
        echo 'cipher=' . $method . "<br>";
        echo 'iv=' . $iv . "<br>";
        echo 'encrypted to: ' . $encrypted . "<br>";
        echo 'decrypted to: ' . $decrypted . "<br>";  
    }    
    
     function random_number()
    {
        $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                    "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                    "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
        $return_str = "";
        for ( $x=0; $x<=17; $x++ )
        {
             $return_str .= $chary[rand(0, count($chary)-1)];
        }
        return $return_str;
        echo "$return_str";
    }
    
    
    public function tokengeneration($key,$id) 
    {
        $tokengen=substr(md5($key), 0, 5) . md5($key);
        return $tokengen;
    }
}
