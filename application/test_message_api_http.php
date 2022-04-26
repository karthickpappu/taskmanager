<?php

require_once ( '/var/www/html/application/Alerts/libraries/Mailer.php' );
require_once ('/var/www/html/application/Alerts/libraries/Mailid.php');


$mailid = new Mailid();
    $project_data = array(
		'userid' => 'FH00998',
		'subject' => 'Testing API with http',
		'body' => 'Testing API with http',
		'context_string' => 'ABCD',
	);
	$data_string = json_encode($project_data);
	$ch = curl_init('http://localhost/integration/api/v1/messaging/');

	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$output = curl_exec($ch);
	print_r($output); echo '<br>';
       echo $ch;
       if($output){
          sendmail($project_data["userid"],$project_data["subject"],$project_data["body"]); 
       }
	if(curl_errno($ch)){
		echo 'Request Error:' . curl_error($ch);
		throw new Exception(curl_error($ch));
	}
	curl_close($ch);
	$prj_data = json_decode($output, true);
	print_r($prj_data);		
?>
