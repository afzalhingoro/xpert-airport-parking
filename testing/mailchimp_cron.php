<?PHP
include('session.php');
set_time_limit(2000000);

$bookings = $db->select("SELECT distinct email,id,name FROM fpp_subscribers WHERE mailchimp='0' AND email!='' limit 400");
//departDate >= NOW() + INTERVAL 12 HOUR
//AND (modifydate >= NOW() - INTERVAL 1 DAY)
$i = 0;
foreach($bookings as $booking){
	
	//fiveg mailchimp 
		try {
				//$email_address = trim($email);
				$api_endpoint = 'https://us17.api.mailchimp.com/3.0/lists/73d9053859/members/';
				if($booking['name']=='')
				{
					$booking['name'] = 'ParkingZone Subscriber';
				}
				$mailchimp_user_info = array(
				'FNAME' => $booking['name']
				);
				$data = array(
				'status' => 'subscribed',
				'email_address' => $booking['email'],
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
				$response['headers'] = curl_getinfo($ch);
				$response_array = json_decode($response['body'],true);
				if (isset($response['headers']['request_header'])) {
					$headers = $response['headers']['request_header'];
				}
		
				if ($response['body'] === false) {
					$last_error = curl_error($ch);
					//print_r($last_error);
				}
				curl_close($ch);
				if($response_array["status"]=='subscribed' || $response_array["title"]=='Member Exists')
				{
					$i++;
					$db->update("update fpp_subscribers SET
                        mailchimp  = 1  WHERE id='".$booking['id']."'");
						
				}
		}
		catch(Exception $e)
		{
			
		}
		
		
	
	//fivegmailchimp
}
		$to_email = 'developmentfive1@gmail.com';
		$subject = 'TAP Mailchimp cronjob update';
		$message = "$i emails sent to cronjob successfully";
		$headers = 'From: info@travelairportplus.co.uk';
		//mail($to_email, $subject, $message, $headers);
/*$query1 = $db->update("UPDATE " . $db->prefix . "booking SET incomplete_email = '1' WHERE incomplete_email='0' AND (booking_status = 'Abandon' || booking_status = 'incompleted') AND booking_action = 'Abandon' ");*/



 // $query = $db->update("DELETE FROM ".$db->prefix."booking_transaction  where id='2258' ");
?>