<?PHP
include('session.php');
set_time_limit(2000000);
ini_set('max_execution_time', '1200');//20 minutes
if (($handle = fopen("subscribed_list.csv", "r")) !== FALSE) {
	$i=1;
	$api_endpoint = 'https://us17.api.mailchimp.com/3.0/lists/73d9053859/members/';
    while (($data = fgetcsv($handle, 300, ",")) !== FALSE) {
		if($i>3499 && $i<7011)
		{
        		if($data[1]=='')
				{
					if($data[2]!='')
					{
						$data[1] = $data[2];
						$data[2] = '';
					}
					else
					{
						$data[1] = 'ParkingZone';
						$data[2] = 'Subscriber';
					}
					
				}
				$mailchimp_user_info = array(
				'FNAME' => $data[1],
				'LNAME' => $data[2]
				);
				$data = array(
				'status' => 'subscribed',
				'email_address' => $data[0],
				'merge_fields' => $mailchimp_user_info);
					
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $api_endpoint);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Accept: application/vnd.api+json',
					'Content-Type: application/vnd.api+json',
					'Authorization: apikey 2266974a532240839066eacaac47dfc3-us17'
				));
				curl_setopt($ch, CURLOPT_USERAGENT, 'X-Cart4');
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
				//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->verify_ssl);
				//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
				curl_setopt($ch, CURLOPT_POST, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
				curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
				curl_setopt($ch, CURLOPT_ENCODING, '');
				curl_setopt($ch, CURLINFO_HEADER_OUT, true);
				$response['body']    = curl_exec($ch);
				//$response['headers'] = curl_getinfo($ch);
				$response_array = json_decode($response['body'],true);
				echo $i." ".$response_array["status"]."<br>";
		
		}
		$i++;
    }
    fclose($handle);
}
exit;
?>