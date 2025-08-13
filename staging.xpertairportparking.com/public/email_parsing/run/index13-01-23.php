<?php

$conn = mysqli_connect("localhost","flightparkonecom_dbs_user","KHT.4QX]zI*]","flightparkonecom_db");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

require_once("../PlancakeEmailParser.php");


ini_set('max_execution_time', '0'); // for infinite time of execution 


$emails = glob('../../../../mail/flightparkone.com/agentbookings/new/*');

if(empty($emails)){
    $emails = glob('../../../../mail/flightparkone.com/agentbookings/cur/*');
}
// print_r($emails);
//exit;
echo "<br>";

foreach($emails as $email) {
	//echo "Email $email <br>";
	//sleep(2);
	$emailParser = new PlancakeEmailParser(file_get_contents($email));
	
	$to_arr = $emailParser->getTo();
	
	$to = mysqli_real_escape_string($conn, $to_arr[0]);
	
	$from_arr = $emailParser->getFrom();
	$from = $from_arr[0];
	//echo '<br>';
	$subject = $emailParser->getSubject();
	$subject=htmlentities($subject);
	$subject = mysqli_real_escape_string($conn, $subject);
	
	$body = $emailParser->getHTMLBody();
	$body = mysqli_real_escape_string($conn, $body);
	//echo $subject.'<br>';
	
	if($subject != 'Looking4.com - Hourly Order Report' && $subject != 'Looking4.com - Daily Order Report'){
    	$email_data = emailBreakdown($from,$body);
    	$ref_no = '';
    	if(isset($email_data)){
        //echo "data:"; print_r($email_data); echo "<br>"; 
        // $columns1 = implode(", ",array_keys($email_data));
       	// $values1  = implode("', '", array_values($email_data));
        // echo "INSERT INTO airports_bookings (".$columns1.") VALUES ('".$values1."')"; echo "<br>"; 
            $ref_no = $email_data['referenceNo'];
	        //echo "Select count(id) as total from airports_bookings where referenceNo = '".$ref_no."' ";
            $sql_count = mysqli_query($conn, "Select count(id) as total from airports_bookings where referenceNo = '".$ref_no."' ");
            
            $count = mysqli_fetch_assoc($sql_count);
            
            echo "count: ".$count['total']."<br>";
            if($count['total'] == 0){
            	$sql = "INSERT INTO parsed_emails (email_to, email_from, email_subject, email_body)
                VALUES ('".$to."', '".$from."', '".$subject."', '".$body."')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                    $columns = implode(", ",array_keys($email_data));
                    //$escaped_values = array_map('mysql_real_escape_string', array_values($email_data));
                    $values  = implode("', '", array_values($email_data));
                    $sql_booking = "INSERT INTO airports_bookings (".$columns.")
                    VALUES ('".$values."')";
                    $run_query = mysqli_query($conn, $sql_booking);
                  
                } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
    	}
	}
	
}
file_put_contents("cronjob.txt","Req: ".date('Y-m-d H:i:s')."\r\n",FILE_APPEND);
function emailBreakdown($from,$body){
    echo "<br><br>".$from."<br><br>";
    if($from == 'Travel Warehouse <zmd@zmdtravel.net>' || $from == 'pz@parkingzone.co.uk' || $from == 'ZMD Travels <zmd@zmdtravel.net>' || $from == 'Parking Zone <pz@parkingzone.co.uk>'){
        $parse_email_body = strip_tags($body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('£', '', $parse_email_body);
        $parse_email_body = str_replace('=C2=A3 ', '', $parse_email_body);
        
        $parse_email_body = str_replace('=C2==A3 ', '', $parse_email_body);
        $parse_email_body = str_replace('=', '', $parse_email_body);
        
        $parse_email_body = str_replace('Company Name:', 'Company:', $parse_email_body);
        
        $parse_array_aiport = explode('Amount:',$parse_email_body);
        $data['total_amount'] = str_replace('&pound; ', '', $parse_array_aiport[1]);
        $data['booking_amount'] = str_replace('&pound; ', '', $parse_array_aiport[1]);
        $parse_email_body = str_replace('Amount:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Valeting:',$parse_email_body);
        $valeting = $parse_array_aiport[1];
        $parse_email_body = str_replace('Valeting:'.$parse_array_aiport[1], '', $parse_email_body);
       
        
        
        $parse_array_aiport = explode('Arrival Flight no:',$parse_email_body);
        $data['returnFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Arrival Flight no:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Arrival Terminal:',$parse_email_body);
        $data['returnTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Arrival Terminal:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Arrival Date/Time:',$parse_email_body);
        $data['returnDate'] = date('Y-m-d H:i:s', strtotime($parse_array_aiport[1]));
        $parse_email_body = str_replace('Arrival Date/Time:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Departure Flight no:',$parse_email_body);
        $data['deptFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Departure Flight no:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Departure Terminal:',$parse_email_body);
        $data['deprTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Departure Terminal:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Departure Date/Time:',$parse_email_body);
        $data['departDate'] = date('Y-m-d H:i:s', strtotime($parse_array_aiport[1]));
   
        $parse_email_body = str_replace('Departure Date/Time:'.$parse_array_aiport[1], '', $parse_email_body);
       
        
        $parse_array_aiport = explode('Registration No.:',$parse_email_body);
        $data['registration'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Registration No.:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Colour:',$parse_email_body);
        $data['color'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Colour:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Make:',$parse_email_body);
        $data['make'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Make:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Model:',$parse_email_body);
        $data['model'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Model:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Contact No:',$parse_email_body);
        $data['phone_number'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Contact No:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Name:',$parse_email_body);
        $name = $parse_array_aiport[1];
        $parse_email_body = str_replace('Name:'.$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        $data['title'] = $name_arr[1];
        $data['first_name'] = $name_arr[2];
        $data['last_name'] = $name_arr[3];
        
        
        $parse_array_aiport = explode('Airport:',$parse_email_body);
        $airport = $parse_array_aiport[1];
        $parse_email_body = str_replace('Airport:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Company:',$parse_email_body);
        $parse_email_body = str_replace('Company:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Reference Code:',$parse_email_body);
        $data['referenceNo'] = strip_tags($parse_array_aiport[1]);
        
        $parse_email_body = str_replace('Reference Code:'.$parse_array_aiport[1], '', $parse_email_body);
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['agentID'] = 8;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['traffic_src'] = 'Agent';
        if($from == 'Parking Zone <pz@parkingzone.co.uk>' || $from == 'pz@parkingzone.co.uk'){
            $data['agentID'] = 9;
        }
        if($from == 'Travel Warehouse <zmd@zmdtravel.net>' || $from == 'ZMD Travels <zmd@zmdtravel.net>'){
            $data['agentID'] = 8;
        }
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3
        
        $data = array_map('trim', $data);
        
        return $data;
    }
    if($from == 'Compare Your Parking <noreply@compareyourparking.co.uk>' || $from == 'Compare The Parking <noreply@comparetheparking.co.uk>' ){
        $parse_email_body = strip_tags($body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('Â£ ', '', $parse_email_body);
        $parse_email_body = str_replace('Company Name:', 'Company:', $parse_email_body);
       
        $parse_array_aiport = explode('Status:',$parse_email_body);
        $parse_email_body = str_replace('Status:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Quote:',$parse_email_body);
        $data['total_amount'] = str_replace('&pound; ', '', $parse_array_aiport[1]);
        $data['booking_amount'] = str_replace('&pound; ', '', $parse_array_aiport[1]);
        $parse_email_body = str_replace('Quote:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Passengers:',$parse_email_body);
        $data['passenger'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Passengers:'.$parse_array_aiport[1], '', $parse_email_body);
       
        
        $parse_array_aiport = explode('ReturnFlight:',$parse_email_body);
        $data['returnFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('ReturnFlight:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('ReturnTerminal:',$parse_email_body);
        $data['returnTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('ReturnTerminal:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Return:',$parse_email_body);
        $data['returnDate'] = date('Y-m-d H:i:s', strtotime($parse_array_aiport[1]));
        $parse_email_body = str_replace('Return:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('DepFlight:',$parse_email_body);
        $data['deptFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('DepFlight:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('DepTerminal:',$parse_email_body);
        $data['deprTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('DepTerminal:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Departure:',$parse_email_body);
        $data['departDate'] = date('Y-m-d H:i:s', strtotime($parse_array_aiport[1]));
        $parse_email_body = str_replace('Departure:'.$parse_array_aiport[1], '', $parse_email_body);
       
        
        $parse_array_aiport = explode('Registration:',$parse_email_body);
        $data['registration'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Registration:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Colour:',$parse_email_body);
        $data['color'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Colour:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Model:',$parse_email_body);
        $data['model'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Model:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Make:',$parse_email_body);
        $data['make'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Make:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Contact:',$parse_email_body);
        $data['phone_number'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Contact:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Name:',$parse_email_body);
        $name = $parse_array_aiport[1];
        $parse_email_body = str_replace('Name:'.$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        $data['title'] = $name_arr[1];
        $data['first_name'] = $name_arr[2];
        $data['last_name'] = $name_arr[3];
        
        $parse_array_aiport = explode('Product:',$parse_email_body);
        $company_name = $parse_array_aiport[1];
        $parse_email_body = str_replace('Product:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Reference:',$parse_email_body);
        $data['referenceNo'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Reference:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Airport:',$parse_email_body);
        $airport = $parse_array_aiport[1];
        $parse_email_body = str_replace('Airport:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['agentID'] = 2;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3
        
        $data = array_map('trim', $data);
       
        return $data;
        
    }
	
	
	
	
	
	
	       if($from == 'Flightpath Parking <admin@flightpathparking.com>' && strpos($body, 'Amendment') == false){ //done check
        $parse_email_body = strip_tags($body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); 
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('Â', '', $parse_email_body);
        $parse_email_body = htmlentities($parse_email_body, null, 'utf-8');
        $parse_email_body=  str_replace("&nbsp;", "", $parse_email_body);
        $parse_email_body = html_entity_decode($parse_email_body);
        
        
        $parse_array_aiport = explode('Registered in England and wales Company Registration Number 12666271',$parse_email_body);
        $parse_email_body = $parse_array_aiport[0];
        //$parse_email_body = str_replace('Registered in England and wales Company Registration Number 12666271', '', $parse_email_body);
        $parse_email_body = str_replace('Suite 34 , Anglesey Business Centre, Anglesey Road, Burton upon Trent, DE14 3NT.', '', $parse_email_body);
        $parse_email_body = str_replace('ATP Limited', '', $parse_email_body);
        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);
        
        $parse_array_aiport = explode('Total Amount',$parse_email_body);
        $data['total_amount'] = trim($parse_array_aiport[1]);
        $data['booking_amount'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Total Amount'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Color',$parse_email_body);
        $data['color'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Vehicle Color'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Make',$parse_email_body);
        $data['make'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Vehicle Make'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Model',$parse_email_body);
        $data['model'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Vehicle Model'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Registration',$parse_email_body);
        $data['registration'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Vehicle Registration'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Terminal',$parse_email_body);
        $data['returnTerminal'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Inbound Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Terminal',$parse_email_body);
        $data['deprTerminal'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Outbound Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Flight No',$parse_email_body);
        $data['returnFlight'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Inbound Flight No'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Date / Time',$parse_email_body);
        $departDate = trim($parse_array_aiport[1], "\xC2\xA0");
        $departDate = trim(preg_replace('/\s\s+/', '', $departDate));
        $departDate = str_replace('&nbsp;', "", $departDate);
        $departDate = str_replace('\t', '', $departDate);
        $departDate = trim($departDate, "\xC2\xA0");
        $departDate_array = explode(' at ',$departDate);
        $data['created_at'] = trim(date('Y-m-d H:i:s', strtotime($departDate_array[0].' '.$departDate_array[1])));
        $parse_email_body = str_replace('Booking Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Date / Time',$parse_email_body);
        $departDate = trim($parse_array_aiport[1], "\xC2\xA0");
        $departDate = trim(preg_replace('/\s\s+/', '', $departDate));
        $departDate = str_replace('&nbsp;', "", $departDate);
        $departDate = str_replace('\t', '', $departDate);
        $departDate = trim($departDate, "\xC2\xA0");
        $departDate_array = explode(' at ',$departDate);
        $data['returnDate'] = trim(date('Y-m-d H:i:s', strtotime($departDate_array[0].' '.$departDate_array[1])));
        $parse_email_body = str_replace('Inbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Date / Time',$parse_email_body);
        $departDate = trim($parse_array_aiport[1], "\xC2\xA0");
        $departDate = trim(preg_replace('/\s\s+/', '', $departDate));
        $departDate = str_replace('&nbsp;', "", $departDate);
        $departDate = str_replace('\t', '', $departDate);
        $departDate = trim($departDate, "\xC2\xA0");
        $departDate_array = explode(' at ',$departDate);
        $data['departDate'] = trim(date('Y-m-d H:i:s', strtotime($departDate_array[0].' '.$departDate_array[1])));
        $parse_email_body = str_replace('Outbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Number Of days',$parse_email_body);
        $data['no_of_days'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Number Of days'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Parking Type',$parse_email_body);
        //$data['parkingType'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Parking Type'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Product Code',$parse_email_body);
        //$data['productCode'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Product Code'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Product Name',$parse_email_body);
        //$data['productName'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Product Name'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Client Telephone',$parse_email_body);
        $data['phone_number'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Client Telephone'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Name',$parse_email_body);
        $name = $parse_array_aiport[1];
        $parse_email_body = str_replace('Client Name'.$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        $data['title'] = $name_arr[1];
        $data['first_name'] = $name_arr[2];
        $data['last_name'] = $name_arr[3];
        
        $parse_array_aiport = explode('Booking Ref no',$parse_email_body);
        $data['referenceNo'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Booking Ref no'.$parse_array_aiport[1], '', $parse_email_body);

        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
        $data['agentID'] = 10;
        
        
        return $data;

        
}
	if(($from == 'Travel Airport Plus <tap@travelairportplus.co.uk>' || $from == 'Airport Park Booking <tap@travelairportplus.co.uk>' || $from == 'Cheap Car Parks <tap@travelairportplus.co.uk>')   && strpos($body, 'Amendment') == false){
        $parse_email_body = strip_tags($body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); 
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('&nbsp;', '', $parse_email_body);
        $parse_array_aiport = explode('Registered in England and wales Company Registration Number 12666271',$parse_email_body);
        $parse_email_body = $parse_array_aiport[0];
        //$parse_email_body = str_replace('Registered in England and wales Company Registration Number 12666271', '', $parse_email_body);
        $parse_email_body = str_replace('Suite 34 , Anglesey Business Centre, Anglesey Road, Burton upon Trent, DE14 3NT.', '', $parse_email_body);
        $parse_email_body = str_replace('ATP Limited', '', $parse_email_body);
        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);
        
        $parse_array_aiport = explode('Total Amount',$parse_email_body);
        $data['total_amount'] = trim($parse_array_aiport[1]);
        $data['booking_amount'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Total Amount'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Color',$parse_email_body);
        $data['color'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Vehicle Color'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Make',$parse_email_body);
        $data['make'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Vehicle Make'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Model',$parse_email_body);
        $data['model'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Vehicle Model'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Registration',$parse_email_body);
        $data['registration'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Vehicle Registration'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Terminal',$parse_email_body);
        $data['returnTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Inbound Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Terminal',$parse_email_body);
        $data['deprTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Outbound Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Flight No',$parse_email_body);
        $data['returnFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Inbound Flight No'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Date / Time',$parse_email_body);
        $departDate = $parse_array_aiport[1];
        $departDate_array = explode(' at ',$departDate);
        $data['created_at'] = trim(date('Y-m-d H:i:s', strtotime($departDate_array[0].' '.$departDate_array[1])));
        $parse_email_body = str_replace('Booking Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Date / Time',$parse_email_body);
        $departDate = $parse_array_aiport[1];
        $departDate_array = explode(' at ',$departDate);
        $data['returnDate'] = trim(date('Y-m-d H:i:s', strtotime($departDate_array[0].' '.$departDate_array[1])));
        $parse_email_body = str_replace('Inbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Date / Time',$parse_email_body);
        $departDate = $parse_array_aiport[1];
        $departDate_array = explode(' at ',$departDate);
        $data['departDate'] = trim(date('Y-m-d H:i:s', strtotime($departDate_array[0].' '.$departDate_array[1])));
        $parse_email_body = str_replace('Outbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Number Of days',$parse_email_body);
        $data['no_of_days'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Number Of days'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Airport',$parse_email_body);
        $airport = $parse_array_aiport[1];
        $parse_email_body = str_replace('Airport'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Parking Type',$parse_email_body);
        //$data['parkingType'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Parking Type'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Product Code',$parse_email_body);
        //$data['productCode'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Product Code'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Product Name',$parse_email_body);
        //$data['productName'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Product Name'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Telephone',$parse_email_body);
        $data['phone_number'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Client Telephone'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Name',$parse_email_body);
        $name = $parse_array_aiport[1];
        $parse_email_body = str_replace('Client Name'.$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        $data['title'] = $name_arr[1];
        $data['first_name'] = $name_arr[2];
        $data['last_name'] = $name_arr[3];
        
        $parse_array_aiport = explode('Booking Ref no',$parse_email_body);
        $data['referenceNo'] = strip_tags($parse_array_aiport[1]);
        $parse_email_body = str_replace('Booking Ref no'.$parse_array_aiport[1], '', $parse_email_body);
        
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
        $data['agentID'] = 10;
        
        $data = array_map('trim', $data);
       
        return $data;
        
    }

    if($from == 'bookings@budgetairportparking.co.uk'){
        $parse_email_body = strip_tags($body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('=', '', $parse_email_body);
        $parse_email_body = preg_replace( "/<br>|\n|<br( ?)\/>/", " ", $parse_email_body );
        $parse_email_body = str_replace('Vehicle Registrat ion', 'Vehicle Registration', $parse_email_body);
        $parse_email_body = str_replace('Vehicle Regis tration', 'Vehicle Registration', $parse_email_body);
        $parse_email_body = str_replace('a t ', '', $parse_email_body);
        $parse_email_body = str_replace('at ', '', $parse_email_body);
        //$data['body'] = $parse_email_body;
        $parse_array_aiport = explode('Parking Charges:',$parse_email_body); 
        $data['total_amount'] = str_replace('GBP ', '', $parse_array_aiport[1]);
        $data['booking_amount'] = str_replace('GBP ', '', $parse_array_aiport[1]);
        $parse_email_body = str_replace('Parking Charges:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('People:',$parse_email_body);
        $data['passenger'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('People:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Vehicle Registration:',$parse_email_body);
        $data['registration'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Vehicle Registration:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Vehicle Details:',$parse_email_body);
        $data['make'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Vehicle Details:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Customer Contact:',$parse_email_body);
        $data['phone_number'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Customer Contact:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode("Driver\'s Name:",$parse_email_body);
        $name = $parse_array_aiport[1];
        $parse_email_body = str_replace("Driver\'s Name:".$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        //$data['name'] = $name;
        $data['first_name'] = $name_arr[1];
        $data['last_name'] = $name_arr[2];
        
        $parse_array_aiport = explode("Return Flight Number:",$parse_email_body);
        $data['returnFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace("Return Flight Number:".$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode("Outbound Flight Number:",$parse_email_body);
        $data['returnFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace("Outbound Flight Number:".$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode("Return:",$parse_email_body);
        $data['returnDate'] = date('Y-m-d H:i:s', strtotime($parse_array_aiport[1]));
        $parse_email_body = str_replace("Return:".$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode("Terminal In:",$parse_email_body);
        $data['returnTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace("Terminal In:".$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode("Dropoff:",$parse_email_body);
        $data['departDate'] = date('Y-m-d H:i:s', strtotime($parse_array_aiport[1]));
        $parse_email_body = str_replace("Dropoff:".$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode("Outbound Terminal:",$parse_email_body);
        $data['deprTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace("Outbound Terminal:".$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode("Parking Type:",$parse_email_body);
        //$data['parking_type'] = $parse_array_aiport[1];
        $parse_email_body = str_replace("Parking Type:".$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode("Airport:",$parse_email_body);
        //$data['airport'] = $parse_array_aiport[1];
        $parse_email_body = str_replace("Airport:".$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode("Reference:",$parse_email_body);
        $data['referenceNo'] = $parse_array_aiport[1];
        $parse_email_body = str_replace("Reference:".$parse_array_aiport[1], '', $parse_email_body);
        
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['agentID'] = 3;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3
            
        $data = array_map('trim', $data);
        
        return $data;
        
    }

    if($from == 'Parking 4 You <noreply@parking4you.co.uk>' || $from == 'Compare Parking Deals <noreply@compareparkingdeals.co.uk>' ){
        $parse_email_body = strip_tags($body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('Compare Parking', '', $parse_email_body);
        $parse_email_body = str_replace('Company Name', 'Company', $parse_email_body);
        $parse_email_body = str_replace('Ã‚Â£', '£', $parse_email_body);
        $parse_email_body = str_replace('£', '', $parse_email_body);
        $parse_email_body = str_replace('&pound; ', '', $parse_email_body);
        $parse_email_body = str_replace('Â', '', $parse_email_body);
        $parse_email_body = str_replace('\r', '', $parse_email_body);
       
        $parse_array_aiport = explode('Booking Status:',$parse_email_body);
        $parse_email_body = str_replace('Booking Status:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Amount:',$parse_email_body);
        $data['total_amount'] = trim($parse_array_aiport[1]);
        $data['total_amount'] = str_replace(' ', '', $data['total_amount']);
        $data['booking_amount'] = trim($parse_array_aiport[1]);
        $data['booking_amount'] = str_replace(' ', '', $data['booking_amount']);
        $parse_email_body = str_replace('Amount:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Valeting:',$parse_email_body);
        $parse_email_body = str_replace('Valeting:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Passengers:',$parse_email_body);
        $data['passenger'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Passengers:'.$parse_array_aiport[1], '', $parse_email_body);
       
        
        $parse_array_aiport = explode('Arrival Flight no:',$parse_email_body);
        $data['returnFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Arrival Flight no:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Arrival Terminal:',$parse_email_body);
        $data['returnTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Arrival Terminal:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Arrival Date/Time:',$parse_email_body);
        $data['returnDate'] = trim(date('Y-m-d H:i:s', strtotime($parse_array_aiport[1])));
        $parse_email_body = str_replace('Arrival Date/Time:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Departure Flight no:',$parse_email_body);
        $data['deptFlight'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Departure Flight no:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Departure Terminal:',$parse_email_body);
        $data['deprTerminal'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Departure Terminal:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Departure Date/Time:',$parse_email_body);
        $data['departDate'] = trim(date('Y-m-d H:i:s', strtotime($parse_array_aiport[1])));
        $parse_email_body = str_replace('Departure Date/Time:'.$parse_array_aiport[1], '', $parse_email_body);
       
        
        $parse_array_aiport = explode('Registration No.:',$parse_email_body);
        $data['registration'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Registration No.:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Colour:',$parse_email_body);
        $data['color'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Colour:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Make:',$parse_email_body);
        $data['make'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Make:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Model:',$parse_email_body);
        $data['model'] = $parse_array_aiport[1];
        $parse_email_body = str_replace('Model:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Contact No:',$parse_email_body);
        $data['phone_number'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Contact No:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Name:',$parse_email_body);
        $name = $parse_array_aiport[1];
        $parse_email_body = str_replace('Name:'.$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        $data['title'] = $name_arr[1];
        $data['first_name'] = $name_arr[2];
        $data['last_name'] = $name_arr[3];
        
        $parse_array_aiport = explode('Company:',$parse_email_body);
        $company_name = $parse_array_aiport[1];
        $parse_email_body = str_replace('Company:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Reference Code:',$parse_email_body);
        $data['referenceNo'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Reference Code:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $parse_array_aiport = explode('Airport:',$parse_email_body);
        $airport = $parse_array_aiport[1];
        $parse_email_body = str_replace('Airport:'.$parse_array_aiport[1], '', $parse_email_body);
        
        
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3
        
        if($from == 'Parking 4 You <noreply@parking4you.co.uk>'){
            $data['agentID'] = 5;
        }else{
            $data['agentID'] = 6;
        }
        
        $data = array_map('trim', $data);
       
        return $data;
        
    }
	    if($from == 'bookings@comparetheairportparking.com' || $from == 'CTAP Bookings <bookings@comparetheairportparking.com>'){ 
        $parse_email_body = strip_tags($body);
         $parse_email_body = htmlentities($parse_email_body, null, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);
        $parse_email_body = trim(preg_replace('/¥s¥s+/', ' ', $parse_email_body)); 
        $parse_email_body = str_replace('Â', '', $parse_email_body);
        $parse_email_body = str_replace('£', '', $parse_email_body);
        $parse_email_body = str_replace('\r', '', $parse_email_body);
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_array_aiport = explode('Departure Instructions',$parse_email_body);
         $parse_email_body = $parse_array_aiport[0];
        $parse_email_body = str_replace('Vehicle Details', '', $parse_email_body);
        $parse_email_body = str_replace('Flight Details', '', $parse_email_body);
        $parse_email_body = str_replace('Booking Details', '', $parse_email_body);
        
$parse_array_aiport = explode('Model',$parse_email_body);
$data['model'] = trim($parse_array_aiport[1]);
$parse_email_body = str_replace('Model'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Vehicle Colour',$parse_email_body);
$data['color'] = trim($parse_array_aiport[1]);
$parse_email_body = str_replace('Vehicle Colour'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Vehicle Registration',$parse_email_body);
$data['registration'] = trim($parse_array_aiport[1]);
$parse_email_body = str_replace('Vehicle Registration'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Return Terminal',$parse_email_body);
$data['returnTerminal'] = trim($parse_array_aiport[1]);
$parse_email_body = str_replace('Return Terminal'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Departure Terminal',$parse_email_body);
$data['deprTerminal'] = trim($parse_array_aiport[1]);
$parse_email_body = str_replace('Departure Terminal'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Flight No',$parse_email_body);
$data['returnFlight'] = trim($parse_array_aiport[1]);
$parse_email_body = str_replace('Flight No'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Return',$parse_email_body);
$returnDate = str_replace('/', '-', $parse_array_aiport[1]);
$data['returnDate'] = date('Y-m-d H:i:s', strtotime($returnDate));
$parse_email_body = str_replace('Return'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('DropOff',$parse_email_body);
$departDate = str_replace('/', '-', $parse_array_aiport[1]);
$data['departDate'] = date('Y-m-d H:i:s', strtotime($departDate));
$parse_email_body = str_replace('DropOff'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Amount',$parse_email_body);
$data['total_amount'] = trim(str_replace('ﾃつ｣', '', $parse_array_aiport[1]));
$parse_email_body = str_replace('Amount'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Coupon',$parse_email_body);
//$data['total_amount'] = trim(str_replace('ﾃつ｣', '', $parse_array_aiport[1]));
$parse_email_body = str_replace('Coupon'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Mobile',$parse_email_body);
$data['phone_number'] = trim(str_replace('ﾃつ｣', '', $parse_array_aiport[1]));
$parse_email_body = str_replace('Mobile'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Booking Date',$parse_email_body);
//$bookingDate = str_replace('/', '-', $parse_array_aiport[1]);
$bookingDate = strtotime($parse_array_aiport[1]);
$bookingDate = date('Y-m-d H:i:s', $bookingDate );
//$bookingDate = strtotime($bookingDate)
$data['created_at'] = $bookingDate;
$parse_email_body = str_replace('Booking Date'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Airport Name',$parse_email_body);
$airport = trim($parse_array_aiport[1]);
$parse_email_body = str_replace('Airport Name'.$parse_array_aiport[1], '', $parse_email_body);

//$parse_array_aiport = explode('Deal Name',$parse_email_body);
//$data['productName'] = trim($parse_array_aiport[1]);
//$parse_email_body = str_replace('Deal Name'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Deal Name',$parse_email_body);
$company_name = $parse_array_aiport[1];
$parse_email_body = str_replace('Deal Name'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Booking Ref No',$parse_email_body);
$data['referenceNo'] = trim(strip_tags($parse_array_aiport[1]));
$parse_email_body = str_replace('Booking Ref No'.$parse_array_aiport[1], '', $parse_email_body);

$parse_array_aiport = explode('Dear',$parse_email_body);
$parse_email_body = str_replace($parse_array_aiport[0], '', $parse_email_body);
$name = $parse_array_aiport[1];
$parse_email_body = str_replace("Dear".$parse_array_aiport[1], '', $parse_email_body);

$name_arr = explode(' ',$name);
$data['first_name'] = $name_arr[1];
$data['last_name'] = $name_arr[2];

       
        
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
        $data['agentID'] = 10;
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3
        $data = array_map('trim', $data);
       
        return $data;
  
}
}
function remove_nbsp($string){
    $string_to_remove = "&nbsp;";
    $string = trim(preg_replace('/\s\s+/', '', $string));
    $string = str_replace($string_to_remove, "", $string);
    $string = str_replace('\t', '', $string);
    $string = trim($string, "\xC2\xA0");
    
    //return str_replace($string_to_remove, "", $string);
    return trim($string);
}
mysqli_close($conn);

?>
