
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
  }
} if($category == 'All_alerts') {
  alert_verify_contact_users();
}
if($category != 'All_alerts' && $category == '' && $auto_date == '') {
  $sche_date  = get_all_date_from_alerts();
  date_default_timezone_set('Asia/Kolkata');
  $followup_date = date('Y-m-d');
  if($sche_date != NULL) {
    foreach ($sche_date as $key => $value) {
      if($value['date'] == $followup_date) {

        alert_verify_email_and_contact_users();

      }
    }
  }
}

/*if($auto_date) {
  $at_date = explode(',', $auto_date);
  foreach ($at_date as $key => $value1) {
    $sche_date  = get_date_from_alerts($value1);
    date_default_timezone_set('Asia/Kolkata');
    $followup_date = date('Y-m-d');
    if($sche_date != NULL) {
      foreach ($sche_date as $key => $value) {
        if($value['date'] == $followup_date) {

          alert_verify_emailid_users();

        }
      }
    }
  }
} else if($auto_date || $category == 'All') {

} */

function alert_verify_contact_users() {
  $response = "Error message: " . "alert_verify_contact_users.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alert_verify_contact_users.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alert_verify_emailid_users() {
  $response = "Error message: " . "alert_verify_emailid_users.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alert_verify_emailid_users.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alert_verify_email_and_contact_users() {
  $response = "Error message: " . "alert_verify_email_and_contact_users.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alert_verify_email_and_contact_users.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_complete_user_profile() {
  $response = "Error message: " . "alerts_for_complete_user_profile.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_complete_user_profile.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_institute_approval() {
  $response = "Error message: " . "alerts_for_institute_approval.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_institute_approval.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_fund_agen_approval() {
  $response = "Error message: " . "alerts_for_fund_agen_approval.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_fund_agen_approval.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_equipment_approval() {
  $response = "Error message: " . "alerts_for_equipment_approval.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_equipment_approval.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_institute_logo() {
  $response = "Error message: " . "alerts_for_institute_logo.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_institute_logo.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_institute_gstin() {
  $response = "Error message: " . "alerts_for_institute_gstin.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_institute_gstin.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_usage_rates() {
  $response = "Error message: " . "alerts_for_usage_rates.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_usage_rates.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_pay_for_user() {
  $response = "Error message: " . "alerts_pay_for_user.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_pay_for_user.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_facility_mapping() {
  $response = "Error message: " . "alerts_for_facility_mapping.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_facility_mapping.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_unmap_equip_to_facility() {
  $response = "Error message: " . "alerts_for_unmap_equip_to_facility.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_unmap_equip_to_facility.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_for_unmap_equip_to_operator() {
  $response = "Error message: " . "alerts_for_unmap_equip_to_operator.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_for_unmap_equip_to_operator.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_regarding_grievances()
{
  $response = "Error message: " . "alerts_regarding_grievances.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_regarding_grievances.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_regarding_pending_service_request() {
  $response = "Error message: " . "alerts_regarding_pending_service_request.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_regarding_pending_service_request.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

function alerts_to_cart_owner()
{
  $response = "Error message: " . "alerts_to_cart_owner.txt" ;
  $fp = fopen('/var/www/html/application/Alerts/alerts_to_cart_owner.txt', 'a');//opens file in append mode
  fwrite($fp, $response);
  fclose($fp);
}

?>
