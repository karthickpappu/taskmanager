<?php
function index(){
	public function get($url){
		$ch = curl_init();
		//$url = 'https://localhost/integration/api/v1/institute_info_from_institute_id/569';
			echo($url);				
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			print_r($data)
			if(curl_errno($ch)){
				echo 'Request Error:' . curl_error($ch);
				throw new Exception(curl_error($ch));
			}
			
		curl_close($ch);
		return $data;
	}
	
	try{
		$object->get('https://staging.istem.gov.in/integration/api/v1/institute_info_from_institute_id/569');
	} catch(Exception $e){
		echo $e;
		//do something with the exception you caught
	}
}
	
?>
