
<?php
require_once('/var/www/html/application/Alerts/AlertModel.php');
require_once('/var/www/html/application/Alerts/libraries/Mailer.php');
require_once('/var/www/html/application/Alerts/libraries/Mailid.php');
require_once('/var/www/html/application/Alerts/libraries/Crypt.php');
require_once('/var/www/html/application/Alerts/libraries/Logdetails.php');
check_db();

$base_url = 'https://staging.istem.gov.in/';

$category = false;
$auto_date = false;
if(isset($_GET['p'])) {
  $category = $_GET['p'];
}
if(isset($_GET['date'])) {
  $auto_date = $_GET['date'];
}
if($category) {
  $codes = explode(',', $category);
  foreach ($codes as $key => $value) {
    if($value == 'CN'){
      alert_verify_contact_users();
    }
    if($value == 'EM') {
      alert_verify_emailid_users();
    }
    if($value == 'CNEM') {
      alert_verify_email_and_contact_users();
    }
    if($value == 'PR') {
      alerts_for_complete_user_profile();
    }
    if($value == 'IN') {
      alerts_for_institute_approval();
    }
    if($value == 'FA') {
      alerts_for_fund_agen_approval();
    }
    if($value == 'EA') {
      alerts_for_equipment_approval();
    }
    if($value == 'IL') {
      alerts_for_institute_logo();
    }
    if($value == 'IG') {
      alerts_for_institute_gstin();
    }
    if($value == 'UR') {
      alerts_for_usage_rates();
    }
    if($value == 'PA') {
      alerts_pay_for_user();
    }
    if($value == 'FM') {
      alerts_for_facility_mapping();
    }
    if($value == 'UF') {
      alerts_for_unmap_equip_to_facility();
    }
    if($value == 'UO') {
      alerts_for_unmap_equip_to_operator();
    }
    if($value == 'GR') {
      alerts_regarding_grievances();
    }
    if($value == 'PS') {
      alerts_regarding_pending_service_request();
    }
    if($value == 'CO') {
      alerts_to_cart_owner();
    }
    if($value == 'SP') {
      alerts_to_vendor();
    }
  }
} if($category == 'All_alerts') {
  alert_verify_contact_users();
  alert_verify_emailid_users();
  alert_verify_email_and_contact_users();
  alerts_for_complete_user_profile();
  alerts_for_institute_approval();
  alerts_for_fund_agen_approval();
  alerts_for_equipment_approval();
  alerts_for_institute_logo();
  alerts_for_institute_gstin();
  alerts_for_usage_rates();
  alerts_pay_for_user();
  alerts_for_facility_mapping();
  alerts_for_unmap_equip_to_facility();
  alerts_for_unmap_equip_to_operator();
  alerts_regarding_grievances();
  alerts_regarding_pending_service_request();
  alerts_to_cart_owner();
  alerts_to_vendor();
}
if($category != 'All_alerts' && $category == '' && $auto_date == '') {
  $sche_date  = get_all_date_from_alerts();
  date_default_timezone_set('Asia/Kolkata');
  $followup_date = date('Y-m-d');
  if($sche_date != NULL) {
    foreach ($sche_date as $key => $value) {
      if($value['date'] == $followup_date) {
        alert_verify_contact_users();
        alert_verify_emailid_users();
        alert_verify_email_and_contact_users();
        alerts_for_complete_user_profile();
        alerts_for_institute_approval();
        alerts_for_fund_agen_approval();
        alerts_for_equipment_approval();
        alerts_for_institute_logo();
        alerts_for_institute_gstin();
        alerts_for_usage_rates();
        alerts_pay_for_user();
        alerts_for_facility_mapping();
        alerts_for_unmap_equip_to_facility();
        alerts_for_unmap_equip_to_operator();
        alerts_regarding_grievances();
        alerts_regarding_pending_service_request();
        alerts_to_cart_owner();
        alerts_to_vendor();
      }
    }
  }
}

mails_regarding_equipment_down_for_first_reminder();
mails_regarding_equipment_down_for_second_reminder();

function mails_regarding_equipment_down_for_first_reminder() {
  $mailid = new Mailid();
  $logdetails = new Logdetails();
  try {
    $mail_list = get_list_of_equipments_for_first_reminder();
    sendmail($mail_list['mail_to'], $mail_list['mail_subject'], $mail_list['mail_message'], $mail_list['mail_cc']);
    //mail details//
    foreach ($mail_list['mail_cc'] as $cc) {
      $mail_type = 'Equipment Down';
      $ip = $logdetails->get_ip();
      $mail_sub = $mail_list['mail_subject'];
      $mail_content = $mail_list['mail_message'];
      $mail_data = array(
        'mail_type' => $mail_type,
        'mail_from' => $mailid->username,
        'mail_to' =>  $cc, //$mail_from
        'mail_subject' => $mail_sub,
        'mail_content' => $mail_content,
        'ip' => $ip,
        'mail_seen_status' => '0',
        'last_updated_on' => date('Y-m-d H:i:s'),
        'user_id' => '0'
      );
      insert($mail_data);
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/mails_regarding_equipment_down_for_first_reminder.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function mails_regarding_equipment_down_for_second_reminder() {
  $mailid = new Mailid();
  $logdetails = new Logdetails();
  try {
    $mail_list1 = get_list_of_equipments_for_second_reminder();
    sendmail($mail_list1['mail_to'], $mail_list1['mail_subject'], $mail_list1['mail_message'], $mail_list1['mail_cc']);
    //mail details//
    foreach ($mail_list1['mail_cc'] as $cc) {
      $mail_type = 'Equipment Down';
      $ip = $logdetails->get_ip();
      $mail_sub = $mail_list1['mail_subject'];
      $mail_content = $mail_list1['mail_message'];
      $mail_data = array(
        'mail_type' => $mail_type,
        'mail_from' => $mailid->username,
        'mail_to' =>  $cc, //$mail_from
        'mail_subject' => $mail_sub,
        'mail_content' => $mail_content,
        'ip' => $ip,
        'mail_seen_status' => '0',
        'last_updated_on' => date('Y-m-d H:i:s'),
        'user_id' => '0'
      );
      insert($mail_data);
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/mails_regarding_equipment_down_for_second_reminder.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alert_verify_contact_users() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $data  = verify_contact_users();
    if($data != NULL){
      foreach ($data as $value) {
        //send mail to user//
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "Your Contact number has not been verified." . '<br>';
        $notif_message = $notif_message . "Please verify your Contact number." . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($value['user_email'], 'I-STEM Alert Regarding Contact No.', $notif_message);
        //insert mail content//
        $mail_type = 'Contact No.';
        $ip = $logdetails->get_ip();
        $mail_sub = 'I-STEM Alert Regarding Contact No.';
        $mail_content = $notif_message;
        $mail_data = array(
          'mail_type' => $mail_type,
          'mail_from' => $mailid->username,
          'mail_to' => $value['user_email'],
          'mail_subject' => $mail_sub,
          'mail_content' => $mail_content,
          'ip' => $ip,
          'mail_seen_status' => '0',
          'last_updated_on' => date('Y-m-d H:i:s'),
          'user_id' => $value['user_id']
        );
        insert($mail_data);
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alert_verify_contact_users.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alert_verify_emailid_users() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $data  = verify_emailid_users();
    if($data != NULL){
      foreach ($data as $value) {
        //send mail to user//
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "Your Email Id has not been verified." . '<br>';
        $notif_message = $notif_message . "Please verify your Email Id." . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($value['user_email'], 'I-STEM Alert Regarding Email Id', $notif_message);
        //insert mail content//
        $mail_type = 'Email Id';
        $ip = $logdetails->get_ip();
        $mail_sub = 'I-STEM Alert Regarding Email Id';
        $mail_content = $notif_message;
        $mail_data = array(
          'mail_type' => $mail_type,
          'mail_from' => $mailid->username,
          'mail_to' => $value['user_email'],
          'mail_subject' => $mail_sub,
          'mail_content' => $mail_content,
          'ip' => $ip,
          'mail_seen_status' => '0',
          'last_updated_on' => date('Y-m-d H:i:s'),
          'user_id' => $value['user_id']
        );
        insert($mail_data);
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alert_verify_emailid_users.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alert_verify_email_and_contact_users() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $data  = verify_email_and_cont_users();
    if($data != NULL){
      foreach ($data as $value) {
        //send mail to user//
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "Your Email Id and Contact No. has not been verified." . '<br>';
        $notif_message = $notif_message . "Please verify your Email Id and Contact No." . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($value['user_email'], 'I-STEM Alert Regarding Contact No. and Email Id', $notif_message);
        //insert mail content//
        $mail_type = 'Contact No. and Email Id';
        $ip = $logdetails->get_ip();
        $mail_sub = 'I-STEM Alert Regarding Contact No. and Email Id';
        $mail_content = $notif_message;
        $mail_data = array(
          'mail_type' => $mail_type,
          'mail_from' => $mailid->username,
          'mail_to' => $value['user_email'],
          'mail_subject' => $mail_sub,
          'mail_content' => $mail_content,
          'ip' => $ip,
          'mail_seen_status' => '0',
          'last_updated_on' => date('Y-m-d H:i:s'),
          'user_id' => $value['user_id']
        );
        insert($mail_data);
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alert_verify_email_and_contact_users.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_complete_user_profile() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    //mail to public users//
    $data  = alerts_complete_user_profile();
    if($data != NULL){
      foreach ($data as $value) {
        //send mail to user//
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "Your profile has not been completed." . '<br>';
        $notif_message = $notif_message . "Please update your profile by logging in I-STEM Portal." . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($value['user_email'], 'I-STEM Complete the user profile - Notification', $notif_message);
        //insert mail content//
        $mail_type = 'Complete the user profile';
        $ip = $logdetails->get_ip();
        $mail_sub = 'I-STEM Complete the user profile - Notification';
        $mail_content = $notif_message;
        $mail_data = array(
          'mail_type' => $mail_type,
          'mail_from' => $mailid->username,
          'mail_to' => $value['user_email'],
          'mail_subject' => $mail_sub,
          'mail_content' => $mail_content,
          'ip' => $ip,
          'mail_seen_status' => '0',
          'last_updated_on' => date('Y-m-d H:i:s'),
          'user_id' => $value['user_id']
        );
        insert($mail_data);
      }
    }
    //mail to custodians//
    $data_custodian  = alerts_complete_user_profile_for_custodians();
    if($data_custodian != NULL){
      foreach ($data_custodian as $custodian_id) {
        //send mail to user//
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "Your profile has not been completed." . '<br>';
        $notif_message = $notif_message . "Please update your profile by logging in I-STEM Portal." . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($custodian_id['user_email'], 'I-STEM Complete the user profile - Notification', $notif_message);
        //insert mail content//
        $mail_type = 'Complete the user profile';
        $ip = $logdetails->get_ip();
        $mail_sub = 'I-STEM Complete the user profile - Notification';
        $mail_content = $notif_message;
        $mail_data = array(
          'mail_type' => $mail_type,
          'mail_from' => $mailid->username,
          'mail_to' => $custodian_id['user_email'],
          'mail_subject' => $mail_sub,
          'mail_content' => $mail_content,
          'ip' => $ip,
          'mail_seen_status' => '0',
          'last_updated_on' => date('Y-m-d H:i:s'),
          'user_id' => $custodian_id['user_id']
        );
        insert($mail_data);
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_complete_user_profile.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_institute_approval() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $insti_count = alerts_institute_approval();
    $insti_name = get_institute_name();
    $super_email = get_super_email();
    $cc_list1 = array();
    if($super_email) {
      foreach ($super_email as $key => $mail) {
        array_push($cc_list1, $mail['user_email']);
      }
    }
    if($insti_count > 0) {
      //send mail to admin//
      $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
      $notif_message = $notif_message . '<br>';
      $notif_message = $notif_message . "There are"  . " ". "<strong>" . $insti_count . " " . "</strong>" . "Institution(s) which needs to be approved :";
      $notif_message = $notif_message . '<br><br>';
      if($insti_name != NULL) {
        $i=1;
        $notif_message = $notif_message .  '<table class="table table-bordered" style="border-collapse: collapse;border:1px solid black">';
        $notif_message = $notif_message .  '<thead>';
        $notif_message = $notif_message .  '<tr>';
        $notif_message = $notif_message .  '<th style="border: 1px solid #333;text-align: center">S.No.</th>';
        $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Institution Name</th>';
        $notif_message = $notif_message .  '</tr>';
        $notif_message = $notif_message .  '</thead>';
        $notif_message = $notif_message .  '<tbody>';
        foreach ($insti_name as $key => $value) {
          $notif_message = $notif_message .  '<tr>';
          $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;text-align:center;padding:0 5px 0 5px;">' . $i . '</td>';
          $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['institute_name'] . '</td>';
          $notif_message = $notif_message .  '</tr>';
          $i++;
        }
        $notif_message = $notif_message .  '</tbody>';
        $notif_message = $notif_message .  '</table>';
      }
      $notif_message = $notif_message . "<br/>Kindly approve the institution(s) by logging in the I-STEM portal.<br>";
      $notif_message = $notif_message . '<br>';
      $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
      sendmail($cc_list1, 'I-STEM Institution Approval Notification', $notif_message);
      //insert mail content//
      $mail_type = 'Institution Approval';
      $ip = $logdetails->get_ip();
      $mail_sub = 'I-STEM Institution Approval Notification';
      $mail_content = $notif_message;
      foreach ($super_email as $key => $value1) {
        $mail_data = array(
          'mail_type' => $mail_type,
          'mail_from' => $mailid->username,
          'mail_to' => $value1['user_email'],
          'mail_subject' => $mail_sub,
          'mail_content' => $mail_content,
          'ip' => $ip,
          'mail_seen_status' => '0',
          'last_updated_on' => date('Y-m-d H:i:s'),
          'user_id' => $value1['user_id']
        );
        insert($mail_data);
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_institute_approval.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_fund_agen_approval() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  $super_email = get_super_email();
  $cc_list1 = array();
  if($super_email) {
    foreach ($super_email as $key => $mail) {
      array_push($cc_list1, $mail['user_email']);
    }
  }
  try {
    $funding_agency_count = alerts_fund_agen_approval();
    $funding_agency_name = get_funding_agency_name();
    if($funding_agency_count > 0) {
      //send mail to admin//
      $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
      $notif_message = $notif_message . '<br>';
      $notif_message = $notif_message . "There are" . " ". "<strong>" . $funding_agency_count . " " . "</strong>" . "funding agencies which needs to be approved :";
      $notif_message = $notif_message . '<br><br>';
      if($funding_agency_name != NULL) {
        $i=1;
        $notif_message = $notif_message .  '<table class="table table-bordered" style="border-collapse: collapse;border:1px solid black">';
        $notif_message = $notif_message .  '<thead>';
        $notif_message = $notif_message .  '<tr>';
        $notif_message = $notif_message .  '<th style="border: 1px solid #333;text-align: center">S.No.</th>';
        $notif_message = $notif_message .  '<th style="border: 1px solid #333;"">Name of Funding Agencies</th>';
        $notif_message = $notif_message .  '</tr>';
        $notif_message = $notif_message .  '</thead>';
        $notif_message = $notif_message .  '<tbody>';
        foreach ($funding_agency_name as $key => $value) {
          $notif_message = $notif_message .  '<tr>';
          $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;text-align:center;padding:0 5px 0 5px;">' . $i . '</td>';
          $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['fund_agen_name'] . '</td>';
          $notif_message = $notif_message .  '</tr>';
          $i++;
        }
        $notif_message = $notif_message .  '</tbody>';
        $notif_message = $notif_message .  '</table>';
      }
      $notif_message = $notif_message . "<br/>Kindly approve the funding agencies by logging in the I-STEM portal.<br>";
      $notif_message = $notif_message . '<br>';
      $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
      sendmail($cc_list1, 'I-STEM Funding Agency Approval Notification', $notif_message);
      //insert mail content//
      $mail_type = 'Funding Agency Approval';
      $ip = $logdetails->get_ip();
      $mail_sub = 'I-STEM Funding Agency Approval Notification';
      $mail_content = $notif_message;
      foreach ($super_email as $key => $value1) {
        $mail_data = array(
          'mail_type' => $mail_type,
          'mail_from' => $mailid->username,
          'mail_to' => $value1['user_email'],
          'mail_subject' => $mail_sub,
          'mail_content' => $mail_content,
          'ip' => $ip,
          'mail_seen_status' => '0',
          'last_updated_on' => date('Y-m-d H:i:s'),
          'user_id' => $value1['user_id']
        );
        insert($mail_data);
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_fund_agen_approval.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_equipment_approval() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  $super_email = get_super_email();
  $cc_list1 = array();
  if($super_email) {
    foreach ($super_email as $key => $mail) {
      array_push($cc_list1, $mail['user_email']);
    }
  }
  try {
    $equip_count = alerts_equipment_approval();
    //send mail to admin//
    $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
    $notif_message = $notif_message . "<br/>There are equipment which need to be approved :";
    $notif_message = $notif_message . '<br><br>';
    $i=1;
    $notif_message = $notif_message .  '<table class="table table-bordered" style="border-collapse: collapse;border:1px solid black">';
    $notif_message = $notif_message .  '<thead>';
    $notif_message = $notif_message .  '<tr>';
    $notif_message = $notif_message .  '<th style="border: 1px solid #333;text-align: center">Equipment ( Count )</th>';
    $notif_message = $notif_message .  '<th style="border: 1px solid #333;"">Name of Institution</th>';
    $notif_message = $notif_message .  '</tr>';
    $notif_message = $notif_message .  '</thead>';
    $notif_message = $notif_message .  '<tbody>';
    foreach ($equip_count as $key => $value) {
      if($value['eq_count'] > 0) {
        $notif_message = $notif_message .  '<tr>';
        $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;text-align:center;padding:0 5px 0 5px;">' . $value['eq_count'] . '</td>';
        $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['institute_name'] . '</td>';
        $notif_message = $notif_message .  '</tr>';
        $i++;
      }
    }
    $notif_message = $notif_message .  '</tbody>';
    $notif_message = $notif_message .  '</table>';
    $notif_message = $notif_message . "Kindly approve the equipment by logging in the I-STEM portal.<br>";
    $notif_message = $notif_message . '<br>';
    $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
    sendmail($cc_list1, 'I-STEM Equipment Approval Notification', $notif_message);
    //insert mail content//
    $mail_type = 'Equipment Approval';
    $ip = $logdetails->get_ip();
    $mail_sub = 'I-STEM Equipment Approval Notification';
    $mail_content = $notif_message;
    foreach ($super_email as $key => $value1) {
      $mail_data = array(
        'mail_type' => $mail_type,
        'mail_from' => $mailid->username,
        'mail_to' => $value1['user_email'],
        'mail_subject' => $mail_sub,
        'mail_content' => $mail_content,
        'ip' => $ip,
        'mail_seen_status' => '0',
        'last_updated_on' => date('Y-m-d H:i:s'),
        'user_id' => $value1['user_id']
      );
      insert($mail_data);
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_equipment_approval.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_institute_logo() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  $crypt = new Crypt();
  try {
    $institute_id = get_institute_id();
    foreach ($institute_id as $key => $value) {
      $key = $crypt->hash_password($value['institute_id']);
      $folder_name = "/var/www/html/document/logo/" . $key . "/";
      if(!file_exists($folder_name)) {
        $institute_email = get_institute_email($value['institute_id']);
        $cc_admin_list = array();
        $cc_list = array();
        if ($institute_email) {
          foreach ($institute_email as $institute_rep) {
            array_push($cc_admin_list, $institute_rep["user_email"]);
          }
        }
        $super_email = get_super_email();
        if($super_email != NULL) {
          foreach ($super_email as $key => $value) {
            array_push($cc_list, $value['user_email']);
          }
        }
        //  $mail_to = array_merge($cc_admin_list,$cc_list);
        // send mail to institute Representative //
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "Kindly upload the logo of the institution/organisation for making it part of the Institution Invoice/Bills.<br>";
        $notif_message = $notif_message . "Thank you!". '<br>';
        $notif_message = $notif_message . "<br/><strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($cc_admin_list, 'I-STEM Institute Logo Notification', $notif_message , $cc_list);
        //insert mail content//
        $mail_type = 'Institute Logo';
        $ip = $logdetails->get_ip();
        $mail_sub = 'I-STEM Institute Logo Notification';
        $mail_content = $notif_message;
        foreach ($institute_email as $key => $value) {
          $mail_data = array(
            'mail_type' => $mail_type,
            'mail_from' => $mailid->username,
            'mail_to' => $value['user_email'],
            'mail_subject' => $mail_sub,
            'mail_content' => $mail_content,
            'ip' => $ip,
            'mail_seen_status' => '0',
            'last_updated_on' => date('Y-m-d H:i:s'),
            'user_id' => $value['user_id'],
          );
          insert($mail_data);
        }
        foreach ($super_email as $key => $value) {
          $mail_data = array(
            'mail_type' => $mail_type,
            'mail_from' => $mailid->username,
            'mail_to' => $value['user_email'],
            'mail_subject' => $mail_sub,
            'mail_content' => $mail_content,
            'ip' => $ip,
            'mail_seen_status' => '0',
            'last_updated_on' => date('Y-m-d H:i:s'),
            'user_id' => $value['user_id'],
          );
          insert($mail_data);
        }
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_institute_logo.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_institute_gstin() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $institute_id = get_institute_id();
    $_row = 0;
    foreach ($institute_id as $key => $value) {
      $check_exists = check_institute_gst_exists($value['institute_id']);
      foreach ($check_exists as $key => $id) {
        $institute_email = get_institute_email($id['institute_id']);
        $cc_admin_list = array();
        $cc_list = array();
        if ($institute_email) {
          foreach ($institute_email as $institute_rep) {
            array_push($cc_admin_list, $institute_rep["user_email"]);
          }
        }
        $super_email = get_super_email();
        if($super_email != NULL) {
          foreach ($super_email as $key => $value1) {
            array_push($cc_list, $value1['user_email']);
          }
        }
        //  $mail_to = array_merge($cc_admin_list,$cc_list);
        // send mail to institute Representative //
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "Kindly update the GSTIN of the institution/organisation for making it part of the Institution Invoice/Bills.<br>";
        $notif_message = $notif_message . "Thank you!". '<br>';
        $notif_message = $notif_message . "<br/><strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($cc_admin_list, 'I-STEM Institute GSTIN Notification', $notif_message , $cc_list);
        //insert mail content//
        $mail_type = 'Institute GSTIN';
        $ip = $logdetails->get_ip();
        $mail_sub = 'I-STEM Institute GSTIN Notification';
        $mail_content = $notif_message;
        foreach ($institute_email as $key => $value1) {
          $mail_data = array(
            'mail_type' => $mail_type,
            'mail_from' => $mailid->username,
            'mail_to' => $value1['user_email'],
            'mail_subject' => $mail_sub,
            'mail_content' => $mail_content,
            'ip' => $ip,
            'mail_seen_status' => '0',
            'last_updated_on' => date('Y-m-d H:i:s'),
            'user_id' => $value1['user_id'],
          );
          insert($mail_data);
        }
        foreach ($super_email as $key => $value1) {
          $mail_data = array(
            'mail_type' => $mail_type,
            'mail_from' => $mailid->username,
            'mail_to' => $value1['user_email'],
            'mail_subject' => $mail_sub,
            'mail_content' => $mail_content,
            'ip' => $ip,
            'mail_seen_status' => '0',
            'last_updated_on' => date('Y-m-d H:i:s'),
            'user_id' => $value1['user_id'],
          );
          insert($mail_data);
        }
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_institute_gstin.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_usage_rates() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $institute_id = get_institute_id();
    foreach ($institute_id as $key => $value) {
      $equip_id = get_equipment_id_based_on_institute($value['institute_id']);
      foreach ($equip_id as $key => $id) {
        $usage_types = get_usage_type_for_equipment($id['equipment_id']);
        $types_list = array();
        foreach ($usage_types as $types) {
          array_push($types_list, $types["usage_type"]);
        }
        $get_eq_count = check_usage_rate($types_list,$id['equipment_id']);
        $opeartor_list = get_mapped_operator($id['equipment_id']);
        $_row = 0;
        $department_rep_list = get_user_list($id['dept_id']);
        $faculty_list = get_faculty_user_list_for_department_on_dept_id($id['dept_id']);
        $institute_email = get_institute_email($value['institute_id']);
        $fac_list = get_facility_list($value['institute_id']);
        if ($fac_list) {
          foreach ($fac_list as $fac_id) {
            $facility_rep_list = get_facility_user_list($fac_id['fac_id']);
          }
        }
        $cc_admin_list = array();
        $cc_list = array();
        $cc_admin_list1 = array();
        if ($institute_email) {
          foreach ($institute_email as $institute_rep) {
            array_push($cc_admin_list, $institute_rep);
            array_push($cc_admin_list1, $institute_rep['user_email']);
          }
        }
        if ($department_rep_list) {
          foreach ($department_rep_list as $department_rep) {
            array_push($cc_admin_list, $department_rep);
            array_push($cc_admin_list1, $department_rep['user_email']);
          }
        }
        if ($faculty_list) {
          foreach ($faculty_list as $faculty) {
            array_push($cc_admin_list, $faculty);
            array_push($cc_admin_list1, $faculty['user_email']);
          }
        }
        if ($facility_rep_list) {
          foreach ($facility_rep_list as $facility_rep) {
            array_push($cc_admin_list, $facility_rep);
            array_push($cc_admin_list1, $facility_rep['user_email']);
          }
        }
        if ($opeartor_list) {
          foreach ($opeartor_list as $opeartor) {
            array_push($cc_admin_list, $opeartor);
            array_push($cc_admin_list1, $opeartor['user_email']);
          }
        }
        $super_email = get_super_email();
        if($super_email != NULL) {
          foreach ($super_email as $key => $value1) {
            array_push($cc_list, $value1['user_email']);
          }
        }
        // $mail_to = array_merge($cc_admin_list,$cc_list);
        if($get_eq_count['eq_count'] > 0) {
          // send mail to institute Representative //
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message . "There are". " " . "<strong>". $get_eq_count['eq_count'] . "</strong>". " "."usage types for the equipment-" ."<strong>". $get_eq_count['equipment_name'] . " </strong>" ."for which you need to add the usage rate.<br>";
          $notif_message = $notif_message . "So,please add the rate for each equipment(s).<br>";
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($cc_admin_list1, 'I-STEM Notification for usage rate for each equipment(s)', $notif_message , $cc_list);
          //insert mail content//
          $mail_type = 'Usage rate';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Notification for usage rate';
          $mail_content = $notif_message;
          foreach ($cc_admin_list as $key => $admin_list) {
            $mail_data = array(
              'mail_type' => $mail_type,
              'mail_from' => $mailid->username,
              'mail_to' => $admin_list['user_email'],
              'mail_subject' => $mail_sub,
              'mail_content' => $mail_content,
              'ip' => $ip,
              'mail_seen_status' => '0',
              'last_updated_on' => date('Y-m-d H:i:s'),
              'user_id' => $admin_list['user_id'],
            );
            insert($mail_data);
          }

          foreach ($super_email as $key => $value) {
            $mail_data = array(
              'mail_type' => $mail_type,
              'mail_from' => $mailid->username,
              'mail_to' => $value['user_email'],
              'mail_subject' => $mail_sub,
              'mail_content' => $mail_content,
              'ip' => $ip,
              'mail_seen_status' => '0',
              'last_updated_on' => date('Y-m-d H:i:s'),
              'user_id' => $value['user_id'],
            );
            insert($mail_data);
          }
        }
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_usage_rates.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_pay_for_user() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $data = get_allocated_list_public_user();
    if($data != NULL){
      $_row = 0;
      foreach ($data as $key => $mail) {
        if($mail['eq_cnt'] > 0){
          // send mail to public user //
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message . "Your request has been approved and there are". " "."<strong>". $mail['eq_cnt'] . "</strong>". " "."equipment for which you need to make the payment.<br>";
          $notif_message = $notif_message . "So,please make the payment and use the equipment.<br>";
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($mail['user_email'], 'I-STEM Notification for payment', $notif_message);
          //insert mail content//
          $mail_type = 'Payment';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Notification for payment';
          $mail_content = $notif_message;
          $mail_data = array(
            'mail_type' => $mail_type,
            'mail_from' => $mailid->username,
            'mail_to' => $mail['user_email'],
            'mail_subject' => $mail_sub,
            'mail_content' => $mail_content,
            'ip' => $ip,
            'mail_seen_status' => '0',
            'last_updated_on' => date('Y-m-d H:i:s'),
            'user_id' => $mail['user_id']
          );
          insert($mail_data);
        }
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_pay_for_user.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_facility_mapping() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $institute_id = get_institute_id();
    $_row = 0;
    foreach ($institute_id as $key => $value) {
      $fac_list = get_facility_list($value['institute_id']);
      $facility_id_array = array();
      foreach ($fac_list as $row) {
        array_push($facility_id_array, $row["fac_id"]);
      }
      $facility_co_list = get_institute_facility_coordinator_list_based_on_institute_id($facility_id_array);
      $_row = 0;
      foreach ($facility_co_list as $key => $list) {
        $assigned_facilities = get_mapped_facilities($list['user_id']);
        $mapped_facility_id_array = array();
        foreach ($assigned_facilities as $ass_fac) {
          array_push($mapped_facility_id_array, $ass_fac["fac_id"]);
        }
        $unassigned_facilities = get_unmapped_facilities($value['institute_id'], $mapped_facility_id_array);
        $department_rep_list = get_user_list($unassigned_facilities['dept_id']);
        $faculty_list = get_faculty_user_list_for_department_on_dept_id($unassigned_facilities['dept_id']);
        $institute_email = get_institute_email($value['institute_id']);
        $cc_list = array();
        $send_mail_to = array();
        if ($institute_email) {
          foreach ($institute_email as $institute) {
            array_push($cc_list, $institute);
            array_push($send_mail_to, $institute['user_email']);
          }
        }
        if ($department_rep_list) {
          foreach ($department_rep_list as $department_rep) {
            array_push($cc_list, $department_rep);
            array_push($send_mail_to, $department_rep['user_email']);
          }
        }
        if ($faculty_list) {
          foreach ($faculty_list as $faculty) {
            array_push($cc_list, $faculty);
            array_push($send_mail_to, $faculty['user_email']);
          }
        }
        if($unassigned_facilities['fac_count'] > 0) {
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message . "There are". " "."<strong>". $unassigned_facilities['fac_count'] . "</strong>". " "." Un-assigned Facilities in Institution-" . " <strong>" . $value['institute_name'] . " </strong>" . "which needs to be assigned.<br>";
          $notif_message = $notif_message . "So,please map the Facilities.<br>";
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($send_mail_to, 'I-STEM Notification for Facilities Mapping', $notif_message);
          //insert mail content//
          $mail_type = 'Facilities Mapping';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Notification for Facilities Mapping';
          $mail_content = $notif_message;
          foreach ($cc_list as $key => $mail_to) {
            $mail_data = array(
              'mail_type' => $mail_type,
              'mail_from' => $mailid->username,
              'mail_to' => $mail_to['user_email'],
              'mail_subject' => $mail_sub,
              'mail_content' => $mail_content,
              'ip' => $ip,
              'mail_seen_status' => '0',
              'last_updated_on' => date('Y-m-d H:i:s'),
              'user_id' => $mail_to['user_id']
            );
            insert($mail_data);
          }
        }
        $_row++;
      }
      $_row++;
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_facility_mapping.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_unmap_equip_to_facility() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $institute_id = get_institute_id();
    $_row = 0;
    foreach ($institute_id as $key => $value) {
      $fac_list = get_facility_list($value['institute_id']);
      $_row = 0;
      foreach ($fac_list as $key => $value1) {
        $dept_id = get_dept_id_from_fac_id($value1['fac_id']);
        foreach ($dept_id as $key => $value2) {
          $facility_mapped_equipments = get_facility_mapped_equipments($value1['fac_id'], $value2['dept_id']);
          $mapped_equipment_id_array = array();
          foreach ($facility_mapped_equipments as $row) {
            array_push($mapped_equipment_id_array, $row["equipment_id"]);
          }
          $department_rep_list = get_user_list($value2['dept_id']);
          $faculty_list = get_faculty_user_list_for_department_on_dept_id($value2['dept_id']);
          $institute_email = get_institute_email($value['institute_id']);
          $cc_list = array();
          $send_mail_to = array();
          if ($institute_email) {
            foreach ($institute_email as $institute) {
              array_push($cc_list, $institute);
              array_push($send_mail_to, $institute['user_email']);
            }
          }
          if ($department_rep_list) {
            foreach ($department_rep_list as $department_rep) {
              array_push($cc_list, $department_rep);
              array_push($send_mail_to, $department_rep['user_email']);
            }
          }
          if ($faculty_list) {
            foreach ($faculty_list as $faculty) {
              array_push($cc_list, $faculty);
              array_push($send_mail_to, $faculty['user_email']);
            }
          }
          $eq_count = get_facility_non_mapped_equipments($value['institute_id'], $mapped_equipment_id_array, $value2['dept_id']);
          $_row++;
        }
        if($eq_count['eq_count'] > 0) {
          // send mail to admin //
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message . "There are". " "."<strong>". $eq_count['eq_count'] . "</strong>". " "."Un-mapped Equipment(s) in Institution-" . " <strong>" . $value['institute_name'] . "</strong> " . "which you need to map for the facilities.<br>";
          $notif_message = $notif_message . "So,please map the equipment(s).<br>";
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($send_mail_to,  'I-STEM Notification for unmapped equipment to the facility', $notif_message);
          //insert mail content//
          $mail_type = 'Unmapped equipment to facility';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Notification for unmapped equipment to facility';
          $mail_content = $notif_message;
          foreach ($cc_list as $key => $mail_to) {
            $mail_data = array(
              'mail_type' => $mail_type,
              'mail_from' => $mailid->username,
              'mail_to' => $mail_to['user_email'],
              'mail_subject' => $mail_sub,
              'mail_content' => $mail_content,
              'ip' => $ip,
              'mail_seen_status' => '0',
              'last_updated_on' => date('Y-m-d H:i:s'),
              'user_id' => $mail_to['user_id']
            );
            insert($mail_data);
          }
        }
      }
      $_row++;
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_unmap_equip_to_facility.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_for_unmap_equip_to_operator() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $institute_id = get_institute_id();
    $_row = 0;
    foreach ($institute_id as $key => $value) {
      $opr_list = get_operator_list($value['institute_id']);
      $_row = 0;
      foreach ($opr_list as $key => $value1) {
        $dept_list = get_mapped_dept_id($value1['operator_id']);
        $dept_id_list = array();
        foreach ($dept_list as $row) {
          array_push($dept_id_list, $row["dept_id"]);
        }
        $operator_mapped_equipments = get_mapped_equipments($value1['operator_id'], $dept_id_list);
        $mapped_equipment_id_array = array();
        foreach ($operator_mapped_equipments as $row) {
          array_push($mapped_equipment_id_array, $row["equipment_id"]);
        }
        $dept_id = get_dept_id_based_on_institute($value['institute_id']);
        $_row = 0;
        foreach ($dept_id as $key => $id) {
          $department_rep_list = get_user_list($id['dept_id']);
          $faculty_list = get_faculty_user_list_for_department_on_dept_id($id['dept_id']);
          $fac_list = get_facility_list($value['institute_id']);
          if ($fac_list) {
            foreach ($fac_list as $fac_id) {
              $facility_rep_list = get_facility_user_list($fac_id['fac_id']);
            }
          }
          $institute_email = get_institute_email($value['institute_id']);
          $cc_list = array();
          $send_mail_to = array();
          if ($institute_email) {
            foreach ($institute_email as $institute) {
              array_push($cc_list, $institute);
              array_push($send_mail_to, $institute['user_email']);
            }
          }
          if ($department_rep_list) {
            foreach ($department_rep_list as $department_rep) {
              array_push($cc_list, $department_rep);
              array_push($send_mail_to, $department_rep['user_email']);
            }
          }
          if ($faculty_list) {
            foreach ($faculty_list as $faculty) {
              array_push($cc_list, $faculty);
              array_push($send_mail_to, $faculty['user_email']);
            }
          }
          if ($facility_rep_list) {
            foreach ($facility_rep_list as $facility_rep) {
              array_push($cc_list, $facility_rep);
              array_push($send_mail_to, $facility_rep['user_email']);
            }
          }
        }
        $eq_count = get_non_mapped_equipments($value['institute_id'], $value1['operator_id'], $mapped_equipment_id_array, $dept_id_list);
        if($eq_count['eq_count'] > 0){
          // send mail to custodian //
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message . "There are". " "."<strong>". $eq_count['eq_count'] . "</strong>". " "."Un-mapped Equipment in Institution-" . "<strong> " . $value['institute_name'] . " </strong>" . "which you need to map.<br>";
          $notif_message = $notif_message . "So,please map the equipment to concern technologiest and operator.<br>";
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($send_mail_to,  'I-STEM Notification for unmapped equipment to the operator', $notif_message);
          //insert mail content//
          $mail_type = 'Unmapped equipment to operator';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Notification for unmapped equipment to operator';
          $mail_content = $notif_message;
          foreach ($cc_list as $key => $mail_to) {
            $mail_data = array(
              'mail_type' => $mail_type,
              'mail_from' => $mailid->username,
              'mail_to' => $mail_to['user_email'],
              'mail_subject' => $mail_sub,
              'mail_content' => $mail_content,
              'ip' => $ip,
              'mail_seen_status' => '0',
              'last_updated_on' => date('Y-m-d H:i:s'),
              'user_id' => $mail_to['user_id']
            );
            insert($mail_data);
          }
        }
      }
      $_row++;
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_for_unmap_equip_to_operator.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_regarding_grievances()
{
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $institute_id = get_institute_id();
    foreach ($institute_id as $key => $value) {
      $grie_count = get_grivance_count($value['institute_id']);
      foreach ($grie_count as $key => $count) {
        if($count['gr_count'] > 0) {
          $institute_email = get_institute_email($count['institute_id']);
          $cc_admin_list = array();
          if ($institute_email) {
            foreach ($institute_email as $institute_rep) {
              array_push($cc_admin_list, $institute_rep["user_email"]);
            }
          }
          // send mail to institute Representative //
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message . "Kindly see the Grievances Raised by user (if any) and do the needful.<br>";
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($cc_admin_list, 'I-STEM Alert Regarding Grievances', $notif_message);
          //insert mail content//
          $mail_type = 'Grievances';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Alert Regarding Grievances';
          $mail_content = $notif_message;
          foreach ($institute_email as $key => $mail_to) {
            $mail_data = array(
              'mail_type' => $mail_type,
              'mail_from' => $mailid->username,
              'mail_to' => $mail_to['user_email'],
              'mail_subject' => $mail_sub,
              'mail_content' => $mail_content,
              'ip' => $ip,
              'mail_seen_status' => '0',
              'last_updated_on' => date('Y-m-d H:i:s'),
              'user_id' => $mail_to['user_id']
            );
            insert($mail_data);
          }
        }
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_regarding_grievances.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_regarding_pending_service_request() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $institute_id = get_institute_id();
    $_row = 0;
    foreach ($institute_id as $key => $value) {
      $eq_id_list = get_equipment_id_based_on_institute($value['institute_id']);
      $eq_id_array = array();
      if ($eq_id_list) {
        foreach ($eq_id_list as $row) {
          array_push($eq_id_array, $row["equipment_id"]);
        }
        $confirmed_request_id_list = get_list_of_confirmed_request_id();
        $confirmed_request_array = array();
        foreach ($confirmed_request_id_list as $row) {
          array_push($confirmed_request_array, $row["request_id"]);
        }
        $rejected_request_id_list = get_list_of_rejected_request_id();
        $rejected_request_array = array();
        foreach ($rejected_request_id_list as $row) {
          array_push($rejected_request_array, $row["request_id"]);
        }
        $get_eq_count = get_pending_service_request($eq_id_array, $confirmed_request_array, $rejected_request_array);
        if(count($get_eq_count) > 0) {
          $institute_email = get_institute_email($value['institute_id']);
          $cc_admin_list = array();
          if ($institute_email) {
            foreach ($institute_email as $institute_rep) {
              array_push($cc_admin_list, $institute_rep["user_email"]);
            }
          }
          // send mail to institute Representative //
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message . "Your Institution has" . " " . "<strong>" . count($get_eq_count) . "</strong>" . " " .  "pending requests received from the users/researchers, kindly assign the task to concern department authorities/representive (s) to execute the service request.<br>";
          $notif_message = $notif_message . "<br/><strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($cc_admin_list, 'I-STEM Alerts Regarding Pending Service Request', $notif_message);
          //insert mail content//
          $mail_type = 'Pending Service Request';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Alerts Regarding Pending Service Request';
          $mail_content = $notif_message;
          foreach ($institute_email as $key => $mail_to) {
            $mail_data = array(
              'mail_type' => $mail_type,
              'mail_from' => $mailid->username,
              'mail_to' => $mail_to['user_email'],
              'mail_subject' => $mail_sub,
              'mail_content' => $mail_content,
              'ip' => $ip,
              'mail_seen_status' => '0',
              'last_updated_on' => date('Y-m-d H:i:s'),
              'user_id' => $mail_to['user_id']
            );
            insert($mail_data);
          }
        }
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_regarding_pending_service_request.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_to_cart_owner()
{
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $get_pub_email = get_public_mail_from_cart();
    if($get_pub_email != NULL) {
      foreach ($get_pub_email as $key => $mail_id) {
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "Your slot in your cart has been already allocated to some other user.<br>";
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($mail_id['user_email'], 'I-STEM Alert Regarding the slot is lost', $notif_message);
        //insert mail content//
        $mail_type = 'Slot is lost';
        $ip = $logdetails->get_ip();
        $mail_sub = 'I-STEM Alert Regarding the slot is lost';
        $mail_content = $notif_message;
        $mail_data = array(
          'mail_type' => $mail_type,
          'mail_from' => $mailid->username,
          'mail_to' => $mail_id['user_email'],
          'mail_subject' => $mail_sub,
          'mail_content' => $mail_content,
          'ip' => $ip,
          'mail_seen_status' => '0',
          'last_updated_on' => date('Y-m-d H:i:s'),
          'user_id' => $mail_id['user_id']
        );
        insert($mail_data);
      }
    }
    $get_pub_id_based_on_date_expiry = get_public_mail_if_date_expired();
    if($get_pub_id_based_on_date_expiry != NULL) {
      foreach ($get_pub_id_based_on_date_expiry as $key => $id) {
        $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message . "The date for the item which is added in the cart has already been expired.";
        $notif_message = $notif_message . "Kindly book the equipment for some other day/date.<br>";
        $notif_message = $notif_message . '<br>';
        $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
        $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
        sendmail($id['user_email'], 'I-STEM Alert Regarding the date expired for the cart item', $notif_message);
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
          'user_id' => $id['user_id']
        );
        insert($mail_data);
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_to_cart_owner.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

function alerts_to_vendor() {
  global $base_url;
  $logdetails = new Logdetails();
  $mailid = new Mailid();
  try {
    $institute_id = get_institute_id();
    foreach ($institute_id as $key => $value) {
      $equip_id = alerts_complete_supplier($value['institute_id']);
      if($equip_id){
        foreach ($equip_id as $key => $id) {
          // $opeartor_list = get_mapped_operator($id['equipment_id']);
          $department_rep_list = get_user_list($id['dept_id']);
          $faculty_list = get_faculty_user_list_for_department_on_dept_id($id['dept_id']);
          $fac_list = get_facility_list($value['institute_id']);
          $cc_admin_list = array();
          $cc_list = array();
          if ($fac_list) {
            foreach ($fac_list as $fac_id) {
              $facility_rep_list = get_facility_user_list($fac_id['fac_id']);
              if ($facility_rep_list) {
                foreach ($facility_rep_list as $facility_rep) {
                  array_push($cc_admin_list, $facility_rep);
                  array_push($cc_list, $facility_rep['user_email']);
                }
              }
            }
          }
          if ($department_rep_list) {
            foreach ($department_rep_list as $department_rep) {
              array_push($cc_admin_list, $department_rep);
              array_push($cc_list, $department_rep['user_email']);
            }
          }
          if ($faculty_list) {
            foreach ($faculty_list as $faculty) {
              array_push($cc_admin_list, $faculty);
              array_push($cc_list, $faculty['user_email']);
            }
          }
          // if ($opeartor_list) {
          //   foreach ($opeartor_list as $opeartor) {
          //     array_push($cc_admin_list, $opeartor["user_email"]);
          //   }
          //  }
          //  $mail_to = array_merge($cc_admin_list,$cc_list);
          //send mail to admin//
          $notif_message = "<strong>Dear Sir/Madam,</strong>" . '<br>';
          $notif_message = $notif_message . "Please provide the details regarding the supplier and service provider for each equipment(s).";
          $notif_message = $notif_message . '<br><br>';
          if($equip_id != NULL) {
            $i=1;
            $notif_message = $notif_message .  '<table class="table table-bordered" style="border-collapse: collapse;border:1px solid black">';
            $notif_message = $notif_message .  '<thead>';
            $notif_message = $notif_message .  '<tr>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;text-align: center">S.No.</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Equipment Code</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Equipment Name</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Department Name</th>';
            $notif_message = $notif_message .  '<th style="border: 1px solid #333;">Facility Name</th>';
            $notif_message = $notif_message .  '</tr>';
            $notif_message = $notif_message .  '</thead>';
            $notif_message = $notif_message .  '<tbody>';
            foreach ($equip_id as $key => $value) {
              $notif_message = $notif_message .  '<tr>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;text-align:center;padding:0 5px 0 5px;">' . $i . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['eq_code'] . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['equipment_name'] . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['dept_name'] . '</td>';
              $notif_message = $notif_message .  '<td style="border: 1px solid #333;font-weight: normal;padding:0 5px 0 5px;white-space: pre-wrap;">' . $value['fac_name'] . '</td>';
              $notif_message = $notif_message .  '</tr>';
              $i++;
            }
            $notif_message = $notif_message .  '</tbody>';
            $notif_message = $notif_message .  '</table>';
          }
          $notif_message = $notif_message . '<br>';
          $notif_message = $notif_message .  "<strong>Note : Kindly do not fail to file the GST Returns.</strong><br>";
          $notif_message = $notif_message . '<strong>Note: </strong>Kindly see the Guidelines' . " "  . "<a target=\"_blank\" data-toggle=\"tooltip\" title=\"Click here to view the Guidelines\" href=" . $base_url . "guidelines" . ">" . $base_url . "guidelines" . "</a>".  " " . "or contact us ( <a target=\"_blank\" data-toggle=\"tooltip\" title=\"Contact us for more Information\" href=" . $base_url . "contact_us" . ">" . $base_url . "contact_us" ."</a>" . " )" . " " . "for demo.";
          sendmail($cc_list, 'I-STEM Notification for completion of equipment(s) profile', $notif_message);
          //insert mail content//

          $mail_type = 'Alerts to Vendor';
          $ip = $logdetails->get_ip();
          $mail_sub = 'I-STEM Notification for Alerts to Vendor';
          $mail_content = $notif_message;
          foreach ($cc_admin_list as $key => $admin_list) {
            $mail_data = array(
              'mail_type' => $mail_type,
              'mail_from' => $mailid->username,
              'mail_to' => $admin_list['user_email'],
              'mail_subject' => $mail_sub,
              'mail_content' => $mail_content,
              'ip' => $ip,
              'mail_seen_status' => '0',
              'last_updated_on' => date('Y-m-d H:i:s'),
              'user_id' => $admin_list['user_id']
            );
            insert($mail_data);
          }
        }
      }
    }
  }
  catch(Exception  $e){
    $response = "Error message: " . $e->getMessage() ;
    $fp = fopen('/var/www/html/application/Alerts/alerts_to_vendor.txt', 'a');//opens file in append mode
    fwrite($fp, $response);
    fclose($fp);
  }
}

?>
