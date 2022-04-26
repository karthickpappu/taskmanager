
<?php
           
  try{ 
// 	 function get($url){
		$ch = curl_init();
		$url = 'https://staging.istem.gov.in/integration/api/v1/institute_info_from_institute_id/569';
			echo('1) ' .$url.'<br>');				
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			echo '<br>'.'API Response'.'<br>';print_r($data);echo '<br>';
			if(curl_errno($ch)){
				echo 'Request Error:' . curl_error($ch);
			throw new Exception(curl_error($ch));
			}
			
		curl_close($ch);
//		return $data;
	}
	
//	try{
  //        $url = 'https://staging.istem.gov.in/integration/api/v1/institute_info_from_institute_id/569';
//		$object->get($url);
//	} 
      catch(Exception $e){
		echo $e;
		//do something with the exception you caught
	}
echo '<br>'.'*************************';
$ch = curl_init();
		$url = 'http://localhost/integration/api/v1/institute_info_from_institute_id/569';
			echo('<br>'.'2) '.$url.'<br>');				
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			echo '<br>'. 'API Response '.'<br>'; print_r($data); echo '<br>';
			if(curl_errno($ch)){
				echo 'Request Error:' . curl_error($ch);
//				throw new Exception(curl_error($ch));
			}
			
		curl_close($ch);

echo '<br>'.'****************************';
    $ch = curl_init();
		$url = 'http://127.0.0.1/integration/api/v1/institute_info_from_institute_id/569';
			echo('<br>'.'3) '.$url.'<br>');				
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			echo '<br>'.'API Response'.'<br>';print_r($data);echo '<br>';
			if(curl_errno($ch)){
				echo 'Request Error:' . curl_error($ch);
//				throw new Exception(curl_error($ch));
			}
			
		curl_close($ch);
echo '<br>'.'*****************************';
$ch = curl_init();
		$url = 'http://10.10.0.7/integration/api/v1/institute_info_from_institute_id/569';
			echo('<br>'.'4) '.$url.'<br>');				
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			echo '<br>'.'API Response'.'<br>';print_r($data);
			if(curl_errno($ch)){
				echo 'Request Error:' . curl_error($ch);
			//	throw new Exception(curl_error($ch));
			}
			
		curl_close($ch);












?>
