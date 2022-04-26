<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
class Mailer {
    public function __construct()
    {
        $this->CI =& get_instance();
    }
	
    public function sendmail($to,$subject,$mail_body,$cc='',$attachments=NULL)
    {
		if (!class_exists("phpmailer")) {
                    require_once('class.phpmailer.php');
                }
		// require("class.phpmailer.php");
		// php mailer code starts
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
		$mail->Username = 'istemstaging@gmail.com';

		$mail->Password = 'staging@560012';

		// set your subject
		$mail->Subject = $subject;

		// sending mail from
		$mail->SetFrom('istemstaging@gmail.com', 'I-STEM');
		// sending to
		$mail->AddAddress($to);
                //sending cc
                if(is_array($cc))
                    {
                        foreach($cc as $cc_email)
                        {
                                $mail->AddCC($cc_email);
                        }
                    }
                
                //attachements
                if($attachments){
                    foreach ($attachments as $attachment){
                        $mail->addAttachment($attachment);
                    }
                }
		// set the message
		$mail->MsgHTML($mail_body);

		/*$mail->SMTPOptions = array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
		);
		*/
		/*$mail->SMTPDebug = 4;*/
		try {
			$mail->send();
		} catch (Exception $ex) {
			//echo 
			$msg = $ex->getMessage();
		}
    }
   
}
?>