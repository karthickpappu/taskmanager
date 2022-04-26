<?php
require_once('/var/www/html/application/Alerts/AlertModel.php');
require_once('/var/www/html/application/Alerts/libraries/Mailer.php');
require_once('/var/www/html/application/Alerts/libraries/Mailid.php');
require_once('/var/www/html/application/Alerts/libraries/Logdetails.php');
check_db();

$base_url = 'https://staging.istem.gov.in/';


$exp_date  = get_expiry_date_for_cart();
if($exp_date != NULL) {
  alerts_to_cart_date_expiry();
}


function alerts_to_cart_date_expiry()
{
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $get_pub_id_based_on_date_expiry = get_cart_request_date();
    $exp_date  = get_expiry_date_for_cart();
    if($get_pub_id_based_on_date_expiry != NULL) {
      foreach ($get_pub_id_based_on_date_expiry as $key => $id) {
        $days_ago = date('Y-m-d', strtotime("-$exp_date[0] days", strtotime($id['request_date'])));
        date_default_timezone_set('Asia/Kolkata');
        $followup_date = date('Y-m-d');
        if($days_ago == $followup_date) {
          $get_cart_details = get_cart_data($id['public_user_id'] , $id['request_date']);
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message . "The date for the item which is added in the cart is expiring soon.<br>";
          $notif_message = $notif_message . "Kindly book the equipment for some other day/date.<br>";
          $notif_message = $notif_message . '<br>';
          if($get_cart_details != NULL) {
            $i=1;
            $notif_message = $notif_message .  '<table class="table table-bordered" style="border-collapse: collapse;border:1px solid black">';
            $notif_message = $notif_message .  '<thead>';
            $notif_message = $notif_message .  '<tr>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;text-align: center">S.No.</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Equipment Code</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Equipment Name</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Department Name</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Institution Name</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Requested Date</th>';
            $notif_message = $notif_message .  '</tr>';
            $notif_message = $notif_message .  '</thead>';
            $notif_message = $notif_message .  '<tbody>';
            foreach ($get_cart_details as $key => $value) {
              $notif_message = $notif_message .  '<tr>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;text-align:center;padding:0 5px 0 5px;">' . $i . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['eq_code'] . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['equipment_name'] . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['dept_name'] . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['institute_name'] . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['request_date'] . '</td>';
              $notif_message = $notif_message .  '</tr>';
              $i++;
            }
            $notif_message = $notif_message .  '</tbody>';
            $notif_message = $notif_message .  '</table>';
          }
          $notif_message = $notif_message .  "<br><strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($id['user_email'], 'I-STEM Alert Regarding the date expiration for the cart item', $notif_message);

          //insert mail content//
          $mail_type = 'Date expired for the cart item';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Alert Regarding the date expired for the cart item';
          $mail_content = $notif_message;
          $mail_data = array(
            'mail_type' => $mail_type,
            'mail_from' => $mailid->username,
            'mail_to' => $id['user_email'],
            'mail_subject' => $mail_sub,
            'mail_content' => $mail_content,
            'ip' => $ip,
            'mail_seen_status' => '0',
            'last_updated_on' => date('Y-m-d H:i:s'),
            'user_id' => $id['public_user_id']
          );
          insert_for_cart($mail_data);
        }
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_to_cart_date_expiry.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

?>
