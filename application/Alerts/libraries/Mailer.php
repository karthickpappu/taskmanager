<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require_once '/var/www/html/application/Alerts/third_party/phpmailer/Exception.php';
require_once '/var/www/html/application/Alerts/third_party/phpmailer/PHPMailer.php';
require_once '/var/www/html/application/Alerts/third_party/phpmailer/SMTP.php';
require_once '/var/www/html/application/Alerts/libraries/Mailid.php';
/*include '/var/www/html/application/Alerts/third_party/phpmailer/Exception.php';
include '/var/www/html/application/Alerts/third_party/phpmailer/PHPMailer.php';
include '/var/www/html/application/Alerts/third_party/phpmailer/SMTP.php';
include '/var/www/html/application/Alerts/Mailid.php'; */

function sendmail($to, $subject, $mail_body, $cc = '', $attachments = NULL, $path = NULL) {
  //require("third_party/phpmailer/PHPMailer.php");
  // php mailer code starts

  $mail = new PHPMailer(true);
  $mailid = new Mailid();
  //$mailid = new Mailid();
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
  $mail->Username = $mailid->username;

  $mail->Password = $mailid->password;

  // set your subject
  $mail->Subject = $subject;

  // sending mail from
  $mail->SetFrom($mailid->username, 'I-STEM');
  // sending to
  //$mail->AddAddress($to);
  if (is_array($to)) {
    foreach ($to as $cc_email) {
      $mail->AddAddress($cc_email);
    }
  } else {
    $mail->AddAddress($to);
  }
  //sending cc
  if (is_array($cc)) {
    foreach ($cc as $cc_email) {
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

?>
