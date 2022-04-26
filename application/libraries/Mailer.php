<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailer {

    public function __construct() {
        $this->CI = & get_instance();
    }

    public function sendmail($to, $subject, $mail_body, $cc = '', $attachments = NULL, $path = NULL) {
        if (!class_exists("phpmailer")) {
            require_once('class.phpmailer.php');
        }
        // require("class.phpmailer.php");
        // php mailer code starts

        $user_data = $this->CI->session->userdata('user_data');
        $this->CI->load->model('UserModel', '', TRUE);
        $mail_to1 = $this->CI->UserModel->check_email_exit($to, $user_data['user_id'] = '');        
        $status = $this->CI->UserModel->check_email_status($mail_to1['user_email']);
        $mail_too = $this->CI->UserModel->check_user_email_exit($to, $user_data['user_id'] = '');        
        $status_istem = $this->CI->UserModel->check_user_email_status($mail_too['user_email']);       
       
       if($status != ''){
            if ($status['email_enable_desable_status'] == '1') {
                $mail_from = $this->CI->config->item('email_disable');
                $to = $mail_from;
            } 
        }

      if($status_istem !=''){
            if ($status_istem['email_enable_disable_status'] == '1') {
                $mail_from = $this->CI->config->item('email_disable');
                $to = $mail_from;
            }
        }  

        
        $mail = new PHPMailer(true);
        // telling the class to use SMTP
        $mail->IsSMTP();
        // enable SMTP authentication
        $mail->SMTPAuth = true;
        // sets the prefix to the server
        $mail->SMTPSecure = "ssl";
        // sets GMAIL as the SMTP server
        $mail->Host = "smtp.gmail.com";
        // set the SMTP port for the GMAIL server
        $mail->Port = 465;

        // set your username here
        $mail->Username = $this->CI->config->item('super_admin_email');

        $mail->Password = $this->CI->config->item('super_admin_email_password');

        // set your subject
        $mail->Subject = $subject;

        // sending mail from
        $mail->SetFrom($this->CI->config->item('super_admin_email'), 'I-STEM');
        // sending to
        $mail->AddAddress($to);
        //sending cc
        if (is_array($cc)) {
            foreach ($cc as $cc_email) {
               $mail_too = $this->CI->UserModel->check_user_email_exit($cc_email, $user_data['user_id'] = '');
               $status_istem = $this->CI->UserModel->check_user_email_status($mail_too['user_email']);
               if ($status_istem['email_enable_disable_status'] == '1') {          
                    $mail_from = $this->CI->config->item('email_disable');
                    $cc_email = $mail_from;            
               }               


                $mail->AddBCC($cc_email);
            }
        }

        //attachements
        //   $mail->addAttachment('./document/bankecsform/c3c7b353e0514ad4197d10a4a1f3351bed71a4d88086b5efde908f0ffc96460de6901d2b24aaf22adc1d5d6f2f8d078015674d3ab21b1dda26d1fc6b62ed482d/form_for_bank_account_details.docx');


        if ($attachments) {
            
            foreach ($attachments as $attachment) {

                $directory = $path . $attachment;
                $directory = str_replace( '\/', '/', $directory );
             
                $mail->addAttachment($directory);
            }
        }

        // set the message
        $mail->MsgHTML($mail_body);

        /* $mail->SMTPOptions = array(
          'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
          )
          );
         */
        /* $mail->SMTPDebug = 4; */
        try {
            $mail->send();
        } catch (Exception $ex) {
            //echo 
            $msg = $ex->getMessage();
        }
    }
    

}

?>
