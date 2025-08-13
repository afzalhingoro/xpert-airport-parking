<?php
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', '1'); // Display errors on the browser
$conn = mysqli_connect("localhost","manchesterairpor_usr","GZBFBlTLm0kI","manchesterairpor_database");

// Check connection

if (!$conn) {

  die("Connection failed: " . mysqli_connect_error());

}


require_once("../PlancakeEmailParser.php");





ini_set('max_execution_time', '0'); // for infinite time of execution 






$emails = glob('../../../../mail/manchesterairportspaces.co.uk/agentbooking/new/*');
 


if (empty($emails)) {
    $emails = glob('../../../../mail/manchesterairportspaces.co.uk/agentbooking/cur/*');
    rsort($emails); 
}

// print_r($emails);

// exit;

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

	    	

    	$email_data = emailBreakdown($from,$body,$subject);

    	$ref_no = '';

    	if(isset($email_data)){

        
  
            $body = mb_convert_encoding($body, 'UTF-8', 'ISO-8859-1');

            $body = str_replace('Â', '', $body);

            mysqli_set_charset($conn, "utf8mb4");



            $ref_no = $email_data['referenceNo'];

            $sql_count = mysqli_query($conn, "Select count(id) as total from airports_bookings where referenceNo = '".$ref_no."' ");

            

            $count = mysqli_fetch_assoc($sql_count);

            

            echo "count: ".$count['total']."<br>";

                if ($count['total'] > 0) {

                    $booking_status = mysqli_query($conn, "SELECT * FROM airports_bookings WHERE referenceNo = '" . $ref_no . "' ");
                    $row = mysqli_fetch_assoc($booking_status);
                    $referenceNo = $email_data['referenceNo'];
                    $originalRowSql = "SELECT * FROM airports_bookings WHERE referenceNo = '$referenceNo'";
                    $originalRowResult = mysqli_query($conn, $originalRowSql);
                    $originalRow = mysqli_fetch_assoc($originalRowResult);

                    $tempCheckSql = "SELECT COUNT(*) as count FROM airports_bookings_temp WHERE referenceNo = '$referenceNo'";

                    $tempCheckResult = mysqli_query($conn, $tempCheckSql);

                    $tempCheckRow = mysqli_fetch_assoc($tempCheckResult);

            

                    if ($tempCheckRow['count'] > 0) {

                         $updateTempSql = "UPDATE airports_bookings_temp SET ";
                            foreach ($originalRow as $key => $value) {

                            if ($key != 'referenceNo' && $key != 'id') {

                                $updateTempSql .= "`$key` = '" . mysqli_real_escape_string($conn, $value) . "', ";

                            }

                        }
                        $updateTempSql = rtrim($updateTempSql, ', ');

                        $updateTempSql .= " WHERE referenceNo = '$referenceNo'";
                        try {

                          $updateTempResult = mysqli_query($conn, $updateTempSql);

                        }

                        

                        //catch exception

                        catch(Exception $e) {

                        file_put_contents("cronjob.txt","Req: ".date('Y-m-d H:i:s').'Error updating record in airports_bookings_temp:  '.$referenceNo."\r\n".$e->getMessage()."\r\n",FILE_APPEND);

                          

                        }
                   if (!$updateTempResult) {

                            echo "Error updating record in airports_bookings_temp: " . mysqli_error($conn);

                            

                            exit;

                        }

            //  print_r($updateTempResult);die();

                        echo "Update in airports_bookings_temp successful!";

                    } else {

                        // Insert a new record into airports_bookings_temp

                        $columns = array_filter(array_keys($originalRow), function ($column) {

                            return $column != 'id';

                        });

                        

                        $copyTempSql = "INSERT INTO airports_bookings_temp (" . implode(", ", $columns) . ") 

                                        SELECT " . implode(", ", array_map(function ($column) use ($originalRow, $conn) {

                                            return "'" . mysqli_real_escape_string($conn, $originalRow[$column]) . "'";

                                        }, $columns)) . " 

                                        FROM airports_bookings 

                                        WHERE referenceNo = '$referenceNo'";

                        $copyTempResult = mysqli_query($conn, $copyTempSql);

            

                        if (!$copyTempResult) {

                            echo "Error copying record to airports_bookings_temp: " . mysqli_error($conn);

                            exit;

                        }

            

                        echo "Insert into airports_bookings_temp successful!";

                    }

            

                    // Continue with the original update logic for airports_bookings

                    $updateSql = "UPDATE airports_bookings SET ";



                        foreach ($email_data as $key => $value) {

                            // Check if the key exists in the table and is not 'referenceNo'

                            if (array_key_exists($key, $row) && $key != 'referenceNo') {

                                // Ensure $value is not null before using mysqli_real_escape_string

                                $escapedValue = $value !== null ? "'" . mysqli_real_escape_string($conn, $value) . "'" : 'NULL';

                        

                                // Add the key to the update query

                                $updateSql .= "`$key` = $escapedValue, ";

                            }

                        }

            

                    // Remove the trailing comma and space

                    $updateSql = rtrim($updateSql, ', ');

            

                    // Add the WHERE clause to specify the row to update

                    $updateSql .= " WHERE referenceNo = '$referenceNo'";

            

                    // Execute the update query

                    $updateResult = mysqli_query($conn, $updateSql);

            

                    if ($updateResult) {

                        echo "Update in airports_bookings successful!";

                    } else {

                        echo "Error updating record in airports_bookings: " . mysqli_error($conn);

                    }

                } else {

                    if ($count['total'] > 0) {

                            $referenceNo = $email_data['referenceNo'];

                            

                            // Prepare data for insertion

                            $columns = [];

                            $values = [];

                            foreach ($email_data as $key => $value) {

                                // Check if the key exists in the table and is not 'referenceNo'

                                if ($key != 'amendRequest') {

                                    // Ensure $value is not null before inserting it into the data array

                                    $escapedValue = $value !== null ? "'" . mysqli_real_escape_string($conn, $value) . "'" : 'NULL';

                                    $columns[] = "`$key`";

                                    $values[] = $escapedValue;

                                }

                            }

                            

                            // Construct SQL query

                            $sql_booking = 'INSERT INTO airports_bookings (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $values) . ')';

                            

                            // Execute SQL query

                            $run_query = mysqli_query($conn, $sql_booking);

                        } else {

                            file_put_contents('cronjob.txt', 'Req: '.date('Y-m-d H:i:s').'Message: Failed to create new booking. Ref:  '.$email_data['referenceNo']."\r\n", FILE_APPEND);

                        }

                }

            }

            

    	}

	}

	



file_put_contents("cronjob.txt","Req: ".date('Y-m-d H:i:s')."\r\n",FILE_APPEND);

function emailBreakdown($from,$body,$subject){

  

    if(strpos($from, 'M&G Reservations') !== false){

       

        $body = mb_convert_encoding($body, 'UTF-8', 'auto'); // Convert to UTF-8

        $body = preg_replace('/\xC2\xA0/', ' ', $body); // Remove non-breaking space characters

        $parse_email_body = strip_tags($body); // Remove HTML tags

        $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8'); // Decode HTML entities

        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8'); // Encode HTML entities again

        $parse_email_body = html_entity_decode($parse_email_body); // Decode again

        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); // Remove extra whitespaces

        $parse_email_body = str_replace('\n', '', $parse_email_body); // Remove newlines

        $parse_email_body = str_replace('&amp;', '', $parse_email_body); // Remove '&amp;' if present

        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body); // Remove unwanted text

        $parse_email_body = str_replace('&nbsp;', '', $parse_email_body); // Remove non-breaking space

        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body); // Remove long lines

        

        // Extract payment information

        $paymentPattern = '/Payment Status\s*[:\s]*([^\n]+)\s*Booking Reference\s*[:\s]*([^\n]+)\s*Booking Detail Information/';

        preg_match($paymentPattern, $parse_email_body, $paymentMatches);

        

        // Extract booking details

        $bookingPattern = '/Booking Ref no\s*[:\s]*([^\n]+)\s*Client Name\s*[:\s]*([^\n]+)\s*Client Telephone\s*[:\s]*([^\n]*)\s*Company Name\s*[:\s]*([^\n]+)\s*Airport\s*[:\s]*([^\n]+)\s*Departure Date\/Time\s*[:\s]*([^\n]+)\s*Departure Terminal\s*[:\s]*([^\n]+)\s*Arrival Date\/Time\s*[:\s]*([^\n]+)\s*Arrival Terminal\s*[:\s]*([^\n]+)\s*Arrival Flight no\s*[:\s]*([^\n]*)\s*Booking Date \/ Time\s*[:\s]*([^\n]+)\s*Vehicle Registration\s*[:\s]*([^\n]+)\s*Vehicle Model\s*[:\s]*([^\n]+)\s*Vehicle Make\s*[:\s]*([^\n]+)\s*Vehicle Color\s*[:\s]*([^\n]+)\s*Total Amount\s*[:\s]*([^\n]+)/';

        preg_match($bookingPattern, $parse_email_body, $bookingMatches);

        

        // Clean up incorrect concatenation in Vehicle Color and Total Amount

        if (isset($bookingMatches[16])) {

            // Example of fixing the concatenation issue between 'Vehicle Color' and 'Total Amount'

            $bookingMatches[16] = preg_replace('/(--.*)/', '', $bookingMatches[16]);

        }

        

        // $parse_array_aiport = explode('Total Amount :',$parse_email_body);

        $data['total_amount'] = $bookingMatches[16];

        $data['booking_amount'] = $bookingMatches[16];

        // $parse_email_body = str_replace('Total Amount :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Color :',$parse_email_body);

        $data['color'] = $bookingMatches[15];

        // $parse_email_body = str_replace('Vehicle Color :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Make :',$parse_email_body);

        $data['make'] = $bookingMatches[14];

        // $parse_email_body = str_replace('Vehicle Make :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Model:',$parse_email_body);

        $data['model'] = $bookingMatches[13];

        // $parse_email_body = str_replace('Vehicle Model:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Registration:',$parse_email_body);

        $data['registration'] =$bookingMatches[12];

        // $parse_email_body = str_replace('Vehicle Registration:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $parse_array_aiport = $bookingMatches[9];

        if($parse_array_aiport == "Terminal 1"){

            $data['returnTerminal'] = '394';

        }elseif($parse_array_aiport == "Terminal 2"){

            $data['returnTerminal'] = '395';

        }elseif($parse_array_aiport == "Terminal 3"){

            $data['returnTerminal'] = '396';

        }

        // $parse_email_body = str_replace('Inbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $parse_array_aiport = $bookingMatches[7];

        if($parse_array_aiport == "Terminal 1"){

            $data['deprTerminal'] = '394';

        }elseif($parse_array_aiport == "Terminal 2"){

            $data['deprTerminal'] = '395';

        }elseif($parse_array_aiport == "Terminal 3"){

            $data['deprTerminal'] = '396';

        }

        // else{

        //     $data['deprTerminal'] = '397';

        // }

        // $parse_email_body = str_replace('Outbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Inbound Flight No :',$parse_email_body);

        $data['returnFlight'] = $bookingMatches[10];

        // $parse_email_body = str_replace('Inbound Flight No :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Booking Date / Time:',$parse_email_body);

        $data['created_at'] = $bookingMatches[11];

        // $parse_email_body = str_replace('Booking Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Inbound Date / Time:',$parse_email_body);

        $data['returnDate'] = $bookingMatches[8];

        // $parse_email_body = str_replace('Inbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Outbound Date / Time:',$parse_email_body);

        $data['departDate'] =$bookingMatches[6];

        // $parse_email_body = str_replace('Outbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        

        $data['no_of_days'] = 3;

        

       

        $data['airportID'] = 1;

        

        // $parse_array_aiport = explode('Parking Type:',$parse_email_body);

        // $data['booked_type'] = trim($parse_array_aiport[1]);

        // $parse_email_body = str_replace('Parking Type:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Product Code:',$parse_email_body);

        // $parse_email_body = str_replace('Product Code:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $data['abookedCompany'] = $bookingMatches[4];

        

        // $parse_array_aiport = explode('Product Name:',$parse_email_body);

        // $parse_email_body = str_replace('Product Name:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $data['phone_number'] = $bookingMatches[3];

        $fullname = $bookingMatches[2] ?? '';
        $extracted_fullname = extractNameParts($bookingMatches[2]);
    
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';

        // $parse_array_aiport = explode(' ',$bookingMatches[2]);

        
        

        // $data['first_name'] = $parse_array_aiport[0];

        // $data['last_name'] = $parse_array_aiport[1];

   

        // $parse_email_body = str_replace('Client Name:'.$parse_array_aiport[1], '', $parse_email_body);

        

        

        $data['referenceNo'] = $paymentMatches[2];

        

        $data['companyId'] = 3;

        $data['agentID'] = 16;

        $data['booking_status'] = 'Completed';

        $data['booking_action'] = 'Booked';

        $data['payment_status'] = 'success';

        $data['traffic_src'] = 'Agent';

         $data['agentID'] = 16;

		$data['incomplete_email'] = 1;

		$data['incomplete_sms'] = 1;

      

        $data = array_map('trim', $data);

        return $data;

    }

    

    if( strpos($from, 'pz@parkingzone.co.uk') !== false   || strpos($from, 'Parking Zone') !== false){
    
            $body = mb_convert_encoding($body, 'UTF-8', 'auto'); // Convert to UTF-8
    
            $body = preg_replace('/\xC2\xA0/', ' ', $body); // Remove non-breaking space characters
    
            $parse_email_body = strip_tags($body); // Remove HTML tags
    
            $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8'); // Decode HTML entities
    
            $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8'); // Encode HTML entities again
    
            $parse_email_body = html_entity_decode($parse_email_body); // Decode again
    
            $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); // Remove extra whitespaces
    
            $parse_email_body = str_replace('\n', '', $parse_email_body); // Remove newlines
    
            $parse_email_body = str_replace('&amp;', '', $parse_email_body); // Remove '&amp;' if present
    
            $parse_email_body = str_replace('MG Reservations', '', $parse_email_body); // Remove unwanted text
    
            $parse_email_body = str_replace('&nbsp;', '', $parse_email_body); // Remove non-breaking space
    
            $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body); // Remove long lines
    
            
    
            // Extract payment information
    
            $paymentPattern = '/Payment Status\s*[:\s]*([^\n]+)\s*Booking Reference\s*[:\s]*([^\n]+)\s*Booking Detail Information/';
    
            preg_match($paymentPattern, $parse_email_body, $paymentMatches);
    
            
    
            // Extract booking details
    
            $bookingPattern = '/Booking Ref no\s*[:\s]*([^\n]+)\s*Client Name\s*[:\s]*([^\n]+)\s*Client Telephone\s*[:\s]*([^\n]*)\s*Company Name\s*[:\s]*([^\n]+)\s*Airport\s*[:\s]*([^\n]+)\s*Departure Date\/Time\s*[:\s]*([^\n]+)\s*Departure Terminal\s*[:\s]*([^\n]+)\s*Arrival Date\/Time\s*[:\s]*([^\n]+)\s*Arrival Terminal\s*[:\s]*([^\n]+)\s*Arrival Flight no\s*[:\s]*([^\n]*)\s*Booking Date \/ Time\s*[:\s]*([^\n]+)\s*Vehicle Registration\s*[:\s]*([^\n]+)\s*Vehicle Model\s*[:\s]*([^\n]+)\s*Vehicle Make\s*[:\s]*([^\n]+)\s*Vehicle Color\s*[:\s]*([^\n]+)\s*Total Amount\s*[:\s]*([^\n]+)/';
    
            preg_match($bookingPattern, $parse_email_body, $bookingMatches);
    
            
    
            // Clean up incorrect concatenation in Vehicle Color and Total Amount
    
            if (isset($bookingMatches[16])) {
    
                // Example of fixing the concatenation issue between 'Vehicle Color' and 'Total Amount'
    
                $bookingMatches[16] = preg_replace('/(--.*)/', '', $bookingMatches[16]);
    
            }
    
            
    
            // $parse_array_aiport = explode('Total Amount :',$parse_email_body);
    
            $data['total_amount'] = $bookingMatches[16];
    
            $data['booking_amount'] = $bookingMatches[16];
    
            // $parse_email_body = str_replace('Total Amount :'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Vehicle Color :',$parse_email_body);
    
            $data['color'] = $bookingMatches[15];
    
            // $parse_email_body = str_replace('Vehicle Color :'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Vehicle Make :',$parse_email_body);
    
            $data['make'] = $bookingMatches[14];
    
            // $parse_email_body = str_replace('Vehicle Make :'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Vehicle Model:',$parse_email_body);
    
            $data['model'] = $bookingMatches[13];
    
            // $parse_email_body = str_replace('Vehicle Model:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Vehicle Registration:',$parse_email_body);
    
            $data['registration'] =$bookingMatches[12];
    
            // $parse_email_body = str_replace('Vehicle Registration:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            $parse_array_aiport = $bookingMatches[9];
    
            if($parse_array_aiport == "Terminal 1"){
    
                $data['returnTerminal'] = '394';
    
            }elseif($parse_array_aiport == "Terminal 2"){
    
                $data['returnTerminal'] = '395';
    
            }elseif($parse_array_aiport == "Terminal 3"){
    
                $data['returnTerminal'] = '396';
    
            }
    
            // $parse_email_body = str_replace('Inbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            $parse_array_aiport = $bookingMatches[7];
    
            if($parse_array_aiport == "Terminal 1"){
    
                $data['deprTerminal'] = '394';
    
            }elseif($parse_array_aiport == "Terminal 2"){
    
                $data['deprTerminal'] = '395';
    
            }elseif($parse_array_aiport == "Terminal 3"){
    
                $data['deprTerminal'] = '396';
    
            }
    
            // else{
    
            //     $data['deprTerminal'] = '397';
    
            // }
    
            // $parse_email_body = str_replace('Outbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Inbound Flight No :',$parse_email_body);
    
            $data['returnFlight'] = $bookingMatches[10];
    
            // $parse_email_body = str_replace('Inbound Flight No :'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Booking Date / Time:',$parse_email_body);
    
            $data['created_at'] = $bookingMatches[11];
    
            // $parse_email_body = str_replace('Booking Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Inbound Date / Time:',$parse_email_body);
    
            $data['returnDate'] = $bookingMatches[8];
    
            // $parse_email_body = str_replace('Inbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Outbound Date / Time:',$parse_email_body);
    
            $data['departDate'] =$bookingMatches[6];
    
            // $parse_email_body = str_replace('Outbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            
    
            $data['no_of_days'] = 3;
    
            
    
           
    
            $data['airportID'] = 1;
    
            
    
            // $parse_array_aiport = explode('Parking Type:',$parse_email_body);
    
            // $data['booked_type'] = trim($parse_array_aiport[1]);
    
            // $parse_email_body = str_replace('Parking Type:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            // $parse_array_aiport = explode('Product Code:',$parse_email_body);
    
            // $parse_email_body = str_replace('Product Code:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            $data['abookedCompany'] = $bookingMatches[4];
    
            
    
            // $parse_array_aiport = explode('Product Name:',$parse_email_body);
    
            // $parse_email_body = str_replace('Product Name:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            $data['phone_number'] = $bookingMatches[3];
    
            
            $fullname = $bookingMatches[2] ?? '';
            $extracted_fullname = extractNameParts($fullname);
        
        
            $data['first_name'] = $extracted_fullname['first_name'] ?? '';
        
            $data['last_name'] = $extracted_fullname['last_name'] ?? '';
    
            // $parse_array_aiport = explode(' ',$bookingMatches[2]);
    
            
    
            
    
            // $data['first_name'] = $parse_array_aiport[0];
    
            // $data['last_name'] = $parse_array_aiport[1];
    
       
    
            // $parse_email_body = str_replace('Client Name:'.$parse_array_aiport[1], '', $parse_email_body);
    
            
    
            
    
            $data['referenceNo'] = $paymentMatches[2];
    
            
    
            $data['companyId'] = 3;
    
            $data['agentID'] = 16;
    
            $data['booking_status'] = 'Completed';
    
            $data['booking_action'] = 'Booked';
    
            $data['payment_status'] = 'success';
    
            $data['traffic_src'] = 'Agent';
    
             $data['agentID'] = 16;
    
    		$data['incomplete_email'] = 1;
    
    		$data['incomplete_sms'] = 1;
    
          
    
            $data = array_map('trim', $data);
    
            return $data;
    
            // if($from == 'Parking Zone <pz@parkingzone.co.uk>' || $from == 'pz@parkingzone.co.uk'){
    
            //     $data['agentID'] = 9;
    
            // }
    
            // // if($from == 'Travel Warehouse <zmd@zmdtravel.net>' || $from == 'ZMD Travels <zmd@zmdtravel.net>'){
    
            // //     $data['agentID'] = 8;
    
            // // }
    
            // $earlier = new DateTime($data['departDate']);
    
            // $later = new DateTime($data['returnDate']);
    
            // $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3
    
            
    
            // $data = array_map('trim', $data);
    
            
    
            // return $data;
    
        }

    if( strpos($from, 'no-reply@cheapdealcenter.com') !== false   || strpos($from, 'Cheap Deal Center <no-reply@cheapdealcenter.com>') !== false){

   

        $body = mb_convert_encoding($body, 'UTF-8', 'auto'); // Convert to UTF-8

        $body = preg_replace('/\xC2\xA0/', ' ', $body); // Remove non-breaking space characters

        $parse_email_body = strip_tags($body); // Remove HTML tags

        $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8'); // Decode HTML entities

        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8'); // Encode HTML entities again

        $parse_email_body = html_entity_decode($parse_email_body); // Decode again

        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); // Remove extra whitespaces

        $parse_email_body = str_replace('\n', '', $parse_email_body); // Remove newlines

        $parse_email_body = str_replace('&amp;', '', $parse_email_body); // Remove '&amp;' if present

        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body); // Remove unwanted text

        $parse_email_body = str_replace('&nbsp;', '', $parse_email_body); // Remove non-breaking space

        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body); // Remove long lines

    

        // Extract payment information

        // $paymentPattern = '/Payment Status\s*[:\s]*([^\n]+)\s*Booking Reference\s*[:\s]*([^\n]+)\s*Booking Detail Information/';

        // preg_match($paymentPattern, $parse_email_body, $paymentMatches);

        $bookingPattern = '/Reference\s*Number\s*[:|-]\s*([^\s]+)[\s\S]*Customer\s*Name\s*[:|-]\s*([\w\s]+)/i';

        // $bookingPattern = '/Reference\s*Number\s*[:|-]\s*(\S+).*?Customer\s*Name\s*[:|-]\s*([\w\s]+).*?Contact\s*Number\s*[:|-]\s*(\S+).*?Product\s*Name\s*[:|-]\s*([\w\s-]+).*?Product\s*Booked\s*With\s*[:|-]\s*([\w\s-]+).*?Product\s*Code\s*[:|-]\s*(\S+).*?Parking\s*Type\s*[:|-]\s*([\w\s]+).*?Airport\s*[:|-]\s*([\w\s]+).*?Departure\s*Date\s*\/\s*Time\s*[:|-]\s*([\d\-:\s]+).*?Return\s*Date\s*\/\s*Time\s*[:|-]\s*([\d\-:\s]+).*?Booking\s*Date\s*\/\s*Time\s*[:|-]\s*([\d\-:\s]+).*?Vehicle\s*Registration\s*[:|-]\s*(\S+).*?Vehicle\s*Model\s*[:|-]\s*([\w\s]+).*?Vehicle\s*Make\s*[:|-]\s*([\w\s]+).*?Vehicle\s*Color\s*[:|-]\s*([\w\s]+).*?Amount\s*Paid\s*[:|-]\s*([\d\.]+)/s';



        preg_match($bookingPattern, $parse_email_body, $bookingMatches);

        // Clean up incorrect concatenation in Vehicle Color and Total Amount

        if (isset($bookingMatches[16])) {

            // Example of fixing the concatenation issue between 'Vehicle Color' and 'Total Amount'

            $bookingMatches[16] = preg_replace('/(--.*)/', '', $bookingMatches[16]);

        }

        

        // $parse_array_aiport = explode('Total Amount :',$parse_email_body);

        $data['total_amount'] = $bookingMatches[16];

        $data['booking_amount'] = $bookingMatches[16];

        // $parse_email_body = str_replace('Total Amount :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Color :',$parse_email_body);

        $data['color'] = $bookingMatches[15];

        // $parse_email_body = str_replace('Vehicle Color :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Make :',$parse_email_body);

        $data['make'] = $bookingMatches[14];

        // $parse_email_body = str_replace('Vehicle Make :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Model:',$parse_email_body);

        $data['model'] = $bookingMatches[13];

        // $parse_email_body = str_replace('Vehicle Model:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Registration:',$parse_email_body);

        $data['registration'] =$bookingMatches[12];

        // $parse_email_body = str_replace('Vehicle Registration:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $parse_array_aiport = $bookingMatches[9];

        if($parse_array_aiport == "Terminal 1"){

            $data['returnTerminal'] = '394';

        }elseif($parse_array_aiport == "Terminal 2"){

            $data['returnTerminal'] = '395';

        }elseif($parse_array_aiport == "Terminal 3"){

            $data['returnTerminal'] = '396';

        }

        // $parse_email_body = str_replace('Inbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $parse_array_aiport = $bookingMatches[7];

        if($parse_array_aiport == "Terminal 1"){

            $data['deprTerminal'] = '394';

        }elseif($parse_array_aiport == "Terminal 2"){

            $data['deprTerminal'] = '395';

        }elseif($parse_array_aiport == "Terminal 3"){

            $data['deprTerminal'] = '396';

        }

        // else{

        //     $data['deprTerminal'] = '397';

        // }

        // $parse_email_body = str_replace('Outbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Inbound Flight No :',$parse_email_body);

        $data['returnFlight'] = $bookingMatches[10];

        // $parse_email_body = str_replace('Inbound Flight No :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Booking Date / Time:',$parse_email_body);

        $data['created_at'] = $bookingMatches[11];

        // $parse_email_body = str_replace('Booking Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Inbound Date / Time:',$parse_email_body);

        $data['returnDate'] = $bookingMatches[8];

        // $parse_email_body = str_replace('Inbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Outbound Date / Time:',$parse_email_body);

        $data['departDate'] =$bookingMatches[6];

        // $parse_email_body = str_replace('Outbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        

        $data['no_of_days'] = 3;

        

       

        $data['airportID'] = 1;

        

        // $parse_array_aiport = explode('Parking Type:',$parse_email_body);

        // $data['booked_type'] = trim($parse_array_aiport[1]);

        // $parse_email_body = str_replace('Parking Type:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Product Code:',$parse_email_body);

        // $parse_email_body = str_replace('Product Code:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $data['abookedCompany'] = $bookingMatches[4];

        

        // $parse_array_aiport = explode('Product Name:',$parse_email_body);

        // $parse_email_body = str_replace('Product Name:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $data['phone_number'] = $bookingMatches[3];

        
        $fullname = $bookingMatches[2] ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';

        // $parse_array_aiport = explode(' ',$bookingMatches[2]);

        

        

        // $data['first_name'] = $parse_array_aiport[0];

        // $data['last_name'] = $parse_array_aiport[1];

   

        // $parse_email_body = str_replace('Client Name:'.$parse_array_aiport[1], '', $parse_email_body);

        

        

        $data['referenceNo'] = $bookingPattern[2];

        

        $data['companyId'] = 3;

        $data['agentID'] = 16;

        $data['booking_status'] = 'Completed';

        $data['booking_action'] = 'Booked';

        $data['payment_status'] = 'success';

        $data['traffic_src'] = 'Agent';

         $data['agentID'] = 16;

		$data['incomplete_email'] = 1;

		$data['incomplete_sms'] = 1;

      

        $data = array_map('trim', $data);

        return $data;

        // if($from == 'Parking Zone <pz@parkingzone.co.uk>' || $from == 'pz@parkingzone.co.uk'){

        //     $data['agentID'] = 9;

        // }

        // // if($from == 'Travel Warehouse <zmd@zmdtravel.net>' || $from == 'ZMD Travels <zmd@zmdtravel.net>'){

        // //     $data['agentID'] = 8;

        // // }

        // $earlier = new DateTime($data['departDate']);

        // $later = new DateTime($data['returnDate']);

        // $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

        

        // $data = array_map('trim', $data);

        

        // return $data;

    }

 

    if( strpos($from, 'no-reply@holidayscarparking.uk') !== false   || strpos($from, 'Holidays Car Parking') !== false || strpos($from,'Parking Experts')!==false){

        $body = mb_convert_encoding($body, 'UTF-8', 'auto'); // Convert to UTF-8

        $body = preg_replace('/\xC2\xA0/', ' ', $body); // Remove non-breaking space characters

        $parse_email_body = strip_tags($body); // Remove HTML tags

        $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8'); // Decode HTML entities

        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8'); // Encode HTML entities again

        $parse_email_body = html_entity_decode($parse_email_body); // Decode again

        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); // Remove extra whitespaces

        $parse_email_body = str_replace('\n', '', $parse_email_body); // Remove newlines

        $parse_email_body = str_replace('&amp;', '', $parse_email_body); // Remove '&amp;' if present

        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body); // Remove unwanted text

        $parse_email_body = str_replace('&nbsp;', '', $parse_email_body); // Remove non-breaking space

        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body); // Remove long lines

        

        // Extract payment information

    $paymentPattern = '/Payment Status\s*[:\s]*([^\n]+)\s*Booking Reference\s*[:\s]*([A-Za-z0-9\-]+)(?=\s|$)/s';

        preg_match($paymentPattern, $parse_email_body, $paymentMatches);

       

      $Refno= preg_replace('/-+Booking$/', '', $paymentMatches[2]);

        // Extract booking details

        $bookingPattern = '/Booking Ref no\s*[:\s]*([^\n]+)\s*Client Name\s*[:\s]*([^\n]+)\s*Client Telephone\s*[:\s]*([^\n]*)\s*Company Name\s*[:\s]*([^\n]+)\s*Airport\s*[:\s]*([^\n]+)\s*Departure Date\/Time\s*[:\s]*([^\n]+)\s*Departure Terminal\s*[:\s]*([^\n]+)\s*Arrival Date\/Time\s*[:\s]*([^\n]+)\s*Arrival Terminal\s*[:\s]*([^\n]+)\s*Arrival Flight no\s*[:\s]*([^\n]*)\s*Booking Date \/ Time\s*[:\s]*([^\n]+)\s*Vehicle Registration\s*[:\s]*([^\n]+)\s*Vehicle Model\s*[:\s]*([^\n]+)\s*Vehicle Make\s*[:\s]*([^\n]+)\s*Vehicle Color\s*[:\s]*([^\n]+)\s*Total Amount\s*[:\s]*([^\n]+)/';

        preg_match($bookingPattern, $parse_email_body, $bookingMatches);
        

        

        // Clean up incorrect concatenation in Vehicle Color and Total Amount

        if (isset($bookingMatches[16])) {

            // Example of fixing the concatenation issue between 'Vehicle Color' and 'Total Amount'

            $bookingMatches[16] = preg_replace('/(--.*)/', '', $bookingMatches[16]);

        }

        

        // $parse_array_aiport = explode('Total Amount :',$parse_email_body);

        $data['total_amount'] = $bookingMatches[16];
        $data['referenceNo'] = $bookingMatches[1];

        $data['booking_amount'] = $bookingMatches[16];

        // $parse_email_body = str_replace('Total Amount :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Color :',$parse_email_body);

        $data['color'] = $bookingMatches[15];

        // $parse_email_body = str_replace('Vehicle Color :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Make :',$parse_email_body);

        $data['make'] = $bookingMatches[14];

        // $parse_email_body = str_replace('Vehicle Make :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Model:',$parse_email_body);

        $data['model'] = $bookingMatches[13];

        // $parse_email_body = str_replace('Vehicle Model:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Vehicle Registration:',$parse_email_body);

        $data['registration'] =$bookingMatches[12];

        // $parse_email_body = str_replace('Vehicle Registration:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $parse_array_aiport = $bookingMatches[9];

        if($parse_array_aiport == "Terminal 1"){

            $data['returnTerminal'] = '394';

        }elseif($parse_array_aiport == "Terminal 2"){

            $data['returnTerminal'] = '395';

        }elseif($parse_array_aiport == "Terminal 3"){

            $data['returnTerminal'] = '396';

        }

        // $parse_email_body = str_replace('Inbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $parse_array_aiport = $bookingMatches[7];

        if($parse_array_aiport == "Terminal 1"){

            $data['deprTerminal'] = '394';

        }elseif($parse_array_aiport == "Terminal 2"){

            $data['deprTerminal'] = '395';

        }elseif($parse_array_aiport == "Terminal 3"){

            $data['deprTerminal'] = '396';

        }

        // else{

        //     $data['deprTerminal'] = '397';

        // }

        // $parse_email_body = str_replace('Outbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Inbound Flight No :',$parse_email_body);

        $data['returnFlight'] = $bookingMatches[10];

        // $parse_email_body = str_replace('Inbound Flight No :'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Booking Date / Time:',$parse_email_body);

        $data['created_at'] = $bookingMatches[11];

        // $parse_email_body = str_replace('Booking Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Inbound Date / Time:',$parse_email_body);

        $data['returnDate'] = $bookingMatches[8];

        // $parse_email_body = str_replace('Inbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Outbound Date / Time:',$parse_email_body);

        $data['departDate'] =$bookingMatches[6];

        // $parse_email_body = str_replace('Outbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);

        

        

        $data['no_of_days'] = 3;

        

       

        $data['airportID'] = 1;

        

        // $parse_array_aiport = explode('Parking Type:',$parse_email_body);

        // $data['booked_type'] = trim($parse_array_aiport[1]);

        // $parse_email_body = str_replace('Parking Type:'.$parse_array_aiport[1], '', $parse_email_body);

        

        // $parse_array_aiport = explode('Product Code:',$parse_email_body);

        // $parse_email_body = str_replace('Product Code:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $data['abookedCompany'] = $bookingMatches[4];

        

        // $parse_array_aiport = explode('Product Name:',$parse_email_body);

        // $parse_email_body = str_replace('Product Name:'.$parse_array_aiport[1], '', $parse_email_body);

        

        $data['phone_number'] = $bookingMatches[3];



        $fullname = $bookingMatches[2] ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';
        
        

        // $parse_array_aiport = explode(' ',$bookingMatches[2]);

        

        

        // $data['first_name'] = $parse_array_aiport[0];

        // $data['last_name'] = $parse_array_aiport[1];

   

        // $parse_email_body = str_replace('Client Name:'.$parse_array_aiport[1], '', $parse_email_body);

        

        

        // $data['referenceNo'] = $Refno;

        

        $data['companyId'] = 3;

        $data['agentID'] = 20;

        $data['booking_status'] = 'Completed';

        $data['booking_action'] = 'Booked';

        $data['payment_status'] = 'success';

        $data['traffic_src'] = 'Agent';

        //  $data['agentID'] = 20;

		$data['incomplete_email'] = 1;

		$data['incomplete_sms'] = 1;

      

        $data = array_map('trim', $data);

        return $data;

        // if($from == 'Parking Zone <pz@parkingzone.co.uk>' || $from == 'pz@parkingzone.co.uk'){

        //     $data['agentID'] = 9;

        // }

        // // if($from == 'Travel Warehouse <zmd@zmdtravel.net>' || $from == 'ZMD Travels <zmd@zmdtravel.net>'){

        // //     $data['agentID'] = 8;

        // // }

        // $earlier = new DateTime($data['departDate']);

        // $later = new DateTime($data['returnDate']);

        // $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

        

        // $data = array_map('trim', $data);

        

        // return $data;

    }

    


    if (strpos($from, 'Compare Parking 4 Me') !== false) {
    
        $body = mb_convert_encoding($body, 'UTF-8', 'auto');
    
        $body = preg_replace('/\xC2\xA0/', ' ', $body);
        
        $parse_email_body = strip_tags($body);
        
        $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');
        
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        
        $parse_email_body = html_entity_decode($parse_email_body);
        
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        
        $parse_email_body = str_replace('&amp;', '', $parse_email_body);
        
        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);
        
        $parse_email_body = str_replace('&nbsp;', '', $parse_email_body);
        
        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);
        
        $parse_email_body = str_replace('=20', '', $parse_email_body);
        
        $parse_email_body = str_replace('=', '', $parse_email_body);
        
        $pattern = '/Reference Code:\s*([^\n]+)\s*Company Name:\s*([^\n]+)\s*Airport:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact No:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration No.:\s*([^\n]+)\s*Departure Date\/Time:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Departure Flight no:\s*([^\n]+)\s*Arrival Date\/Time:\s*([^\n]+)\s*Arrival Terminal:\s*([^\n]+)\s*Arrival Flight no:\s*([^\n]+)\s*Valeting:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Paid Amount:\s*([^\n]+)\s*Booking Status:\s*([^\n]+)\s*Transaction Status:\s*([^\n]+)/';
        
        preg_match($pattern, $parse_email_body, $bookingMatches);
    
    
    
    
    
        
    
    
    
        $data = [
        
            'referenceNo' => $bookingMatches[1],
        
            'abookedCompany'=> $bookingMatches[2],
        
            'phone_number' => $bookingMatches[5],
        
            'airportID' => 1,
        
            'model'=>$bookingMatches[6],
        
            'make'=>$bookingMatches[7],
        
            'color'=>$bookingMatches[8],
        
            'registration'=>$bookingMatches[9],
        
            'departDate' => $bookingMatches[10],
        
            'deprTerminal' => $bookingMatches[11],
        
            'deptFlight'=>$bookingMatches[12],
        
            'returnDate' => $bookingMatches[13],
        
            'returnTerminal' => $bookingMatches[14],
        
            'returnFlight' => $bookingMatches[15],
        
            'total_amount' => $bookingMatches[17],
        
            'booking_amount' => $bookingMatches[17],
        
        ];
    
    
    
    
    
        $data['departDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[10]));
        
        $data['returnDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[13]));
    
    
    
        
    
    
    
        // Split name into title, first name, and last name
        
        $fullname = $bookingMatches[4] ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';
    
        // $nameParts = explode(' ', $bookingMatches[4]);
    
        // $data['title'] = $nameParts[0] ?? '';
    
        // $data['first_name'] = $nameParts[0] ?? '';
    
        // $data['last_name'] = $nameParts[1] ?? '';
    
    
    
        // Calculate the number of days between departure and return
    
        if ($data['departDate'] && $data['returnDate']) {
    
            $earlier = new DateTime($data['departDate']);
    
            $later = new DateTime($data['returnDate']);
    
            $data['no_of_days'] = $later->diff($earlier)->format('%a');
    
        } else {
    
            $data['no_of_days'] = null; // Set to null if dates are invalid
    
        }
    
           $data['companyId'] = 3;
    
            $data['agentID'] = 23;
    
            $data['booking_status'] = 'Completed';
    
            $data['booking_action'] = 'Booked';
    
            $data['payment_status'] = 'success';
    
            $data['traffic_src'] = 'Agent';
    
    		$data['incomplete_email'] = 1;
    
    		$data['incomplete_sms'] = 1;
    
    
    
        // Trim all data to remove extra spaces
    
        $data = array_map('trim', $data);
    
    
    
        // Return the parsed data
    
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

        // $name_arr = explode(' ',$name);

        // $data['title'] = $name_arr[1];

        // $data['first_name'] = $name_arr[2];

        // $data['last_name'] = $name_arr[3];
        
        
        $fullname = $name ?? '';
    
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';

        

        $parse_array_aiport = explode('Booking Ref no',$parse_email_body);

        $data['referenceNo'] = trim($parse_array_aiport[1]);

        $parse_email_body = str_replace('Booking Ref no'.$parse_array_aiport[1], '', $parse_email_body);



        $data['companyId'] = 3;

        $data['airportID'] = 1;

        $data['booking_status'] = 'Completed';

        $data['payment_status'] = 'success';

        $data['booking_action'] = 'Booked';

        $data['traffic_src'] = 'Agent';

        $data['incomplete_email'] = 1;

        $data['agentID'] = 10;

        

        

        return $data;

        

    }

	if(($from == 'Travel Airport Plus <tap@travelairportplus.co.uk>' || $from == 'Airport Park Booking <tap@travelairportplus.co.uk>')   && strpos($body, 'Amendment') == false){

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
        
        
        
        $fullname = $name ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';
        

        // $name_arr = explode(' ',$name);

        // $data['title'] = $name_arr[1];

        // $data['first_name'] = $name_arr[2];

        // $data['last_name'] = $name_arr[3];

        

        $parse_array_aiport = explode('Booking Ref no',$parse_email_body);

        $data['referenceNo'] = strip_tags($parse_array_aiport[1]);

        $parse_email_body = str_replace('Booking Ref no'.$parse_array_aiport[1], '', $parse_email_body);

        

        $data['companyId'] = 3;

        $data['airportID'] = 1;

        $data['booking_status'] = 'Completed';

        $data['booking_action'] = 'Booked';

        $data['payment_status'] = 'success';

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
        
        
        $fullname = $name ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';
        

        // $name_arr = explode(' ',$name);

        // //$data['name'] = $name;

        // $data['first_name'] = $name_arr[1];

        // $data['last_name'] = $name_arr[2];

        

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

        $data['payment_status'] = 'success';

        $data['traffic_src'] = 'Agent';

        $data['incomplete_email'] = 1;

        

        $earlier = new DateTime($data['departDate']);

        $later = new DateTime($data['returnDate']);

        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

            

        $data = array_map('trim', $data);

        

        return $data;

        

    }

    if (
        ( 
            $from == 'Parking 4 You <noreply@parking4you.co.uk>' || 
            $from == 'Parking 4 You <noreply@compareairportparkings.co.uk>' || 
        
            $from == 'Parking 4 You <noreply@compareparkingdeals.co.uk>' 
        ) &&
        strpos($from, 'Parking 4 You') !== false &&
        strpos($subject, 'Ammend') !== false &&
        strpos($subject, 'Cancelled') === false
    ) {

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

        

      // Extract the amount, remove spaces, and remove the currency symbol

$data['total_amount'] = trim($parse_array_aiport[1]);

$data['total_amount'] = str_replace(' ', '', $data['total_amount']); // Remove spaces

  $data['total_amount'] = strip_tags( $data['total_amount']); // Remove HTML tags

$data['total_amount'] = html_entity_decode( $data['total_amount']); // Decode HTML entities

$data['total_amount'] = preg_replace('/[^\x20-\x7E]/', '',  $data['total_amount']); // Remove non-printable characters

 

 

// Repeat the same for the booking amount

$data['booking_amount'] = trim($parse_array_aiport[1]);

 $data['booking_amount'] = str_replace(' ', '', $data['booking_amount']); // Remove spaces

  $data['booking_amount'] = strip_tags( $data['booking_amount']); // Remove HTML tags

$data['booking_amount'] = html_entity_decode( $data['booking_amount']); // Decode HTML entities

$data['booking_amount'] = preg_replace('/[^\x20-\x7E]/', '',  $data['booking_amount']); // Remove non-printable characters

 

       

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
        
        
        $fullname = $name ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';
        
        

        // $name_arr = explode(' ',$name);

        // $data['title'] = $name_arr[1];

        // $data['first_name'] = $name_arr[2];

        // $data['last_name'] = $name_arr[3];

        

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

        // $data['booking_action'] = 'Booked';

        $data['traffic_src'] = 'Agent';

        $data['payment_status'] = 'success';

        $data['incomplete_email'] = 1;

          $data['booking_action'] = 'Amend';

        $data['amendRequest'] = 1;

        $earlier = new DateTime($data['departDate']);

        $later = new DateTime($data['returnDate']);

        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

        

          if($from == 'Parking 4 You <noreply@parking4you.co.uk>'){

            $data['agentID'] = 17;

        }elseif($from == 'Parking 4 You <noreply@compareparkingdeals.co.uk>'){

            $data['agentID'] = 6;

        }elseif($from == 'Parking 4 You <noreply@compareairportparkings.co.uk>'){
            $data['agentID'] = 27;

        }

        

        $data = array_map('trim', $data);

   

        return $data;

        

    }
    
    if (
        ( 
            $from == 'Parking 4 You <noreply@parking4you.co.uk>' || 
            $from == 'Parking 4 You <noreply@compareparkingdeals.co.uk>'
        ) &&
        strpos($from, 'Parking 4 You') !== false &&
        strpos($subject, 'Ammend') === false &&
        strpos($subject, 'Cancelled') !== false
    ) {
         

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

        

      // Extract the amount, remove spaces, and remove the currency symbol

$data['total_amount'] = trim($parse_array_aiport[1]);

$data['total_amount'] = str_replace(' ', '', $data['total_amount']); // Remove spaces

  $data['total_amount'] = strip_tags( $data['total_amount']); // Remove HTML tags

$data['total_amount'] = html_entity_decode( $data['total_amount']); // Decode HTML entities

$data['total_amount'] = preg_replace('/[^\x20-\x7E]/', '',  $data['total_amount']); // Remove non-printable characters

 

 

// Repeat the same for the booking amount

$data['booking_amount'] = trim($parse_array_aiport[1]);

 $data['booking_amount'] = str_replace(' ', '', $data['booking_amount']); // Remove spaces

  $data['booking_amount'] = strip_tags( $data['booking_amount']); // Remove HTML tags

$data['booking_amount'] = html_entity_decode( $data['booking_amount']); // Decode HTML entities

$data['booking_amount'] = preg_replace('/[^\x20-\x7E]/', '',  $data['booking_amount']); // Remove non-printable characters

 

       

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
        
        
        
        
        $fullname = $name ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';
        
        

        // $name_arr = explode(' ',$name);

        // $data['title'] = $name_arr[1];

        // $data['first_name'] = $name_arr[2];

        // $data['last_name'] = $name_arr[3];

        

        $parse_array_aiport = explode('Company:',$parse_email_body);

        $company_name = $parse_array_aiport[1];

        $parse_email_body = str_replace('Company:'.$parse_array_aiport[1], '', $parse_email_body);

        

        

        $parse_array_aiport = explode('Reference Code:',$parse_email_body);

        $data['referenceNo'] = trim($parse_array_aiport[1]);

        $parse_email_body = str_replace('Reference Code:'.$parse_array_aiport[1], '', $parse_email_body);

        

        

        $parse_array_aiport = explode('Airport:',$parse_email_body);

        $airport = $parse_array_aiport[1];

        $parse_email_body = str_replace('Airport:'.$parse_array_aiport[1], '', $parse_email_body);

        

        
 

        $data['cancelRequest'] = 1;


        $data = array_map('trim', $data);

   

        return $data;

        

    }
    if (
        strpos($from, 'Parking 4 You') !== false &&
        $from == 'Parking 4 You <noreply@parking4you.co.uk>' || 
        $from == 'Parking 4 You <noreply@compareairportparkings.co.uk>' || 
        
            $from == 'Parking 4 You <noreply@compareparkingdeals.co.uk>' &&
        strpos($subject, 'Ammend') === false &&
        strpos($subject, 'Cancelled') === false
    ) {


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

        

      // Extract the amount, remove spaces, and remove the currency symbol

$data['total_amount'] = trim($parse_array_aiport[1]);

$data['total_amount'] = str_replace(' ', '', $data['total_amount']); // Remove spaces

  $data['total_amount'] = strip_tags( $data['total_amount']); // Remove HTML tags

$data['total_amount'] = html_entity_decode( $data['total_amount']); // Decode HTML entities

$data['total_amount'] = preg_replace('/[^\x20-\x7E]/', '',  $data['total_amount']); // Remove non-printable characters

 

 

// Repeat the same for the booking amount

$data['booking_amount'] = trim($parse_array_aiport[1]);

 $data['booking_amount'] = str_replace(' ', '', $data['booking_amount']); // Remove spaces

  $data['booking_amount'] = strip_tags( $data['booking_amount']); // Remove HTML tags

$data['booking_amount'] = html_entity_decode( $data['booking_amount']); // Decode HTML entities

$data['booking_amount'] = preg_replace('/[^\x20-\x7E]/', '',  $data['booking_amount']); // Remove non-printable characters

 

       

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
        
        
        
        $fullname = $name ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';
        

        // $name_arr = explode(' ',$name);

        // $data['title'] = $name_arr[1];

        // $data['first_name'] = $name_arr[2];

        // $data['last_name'] = $name_arr[3];

        

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

        $data['payment_status'] = 'success';

        $data['incomplete_email'] = 1;

        

        $earlier = new DateTime($data['departDate']);

        $later = new DateTime($data['returnDate']);

        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

        

        if($from == 'Parking 4 You <noreply@parking4you.co.uk>'){

            $data['agentID'] = 17;

        }elseif($from == 'Parking 4 You <noreply@compareparkingdeals.co.uk>'){

            $data['agentID'] = 6;

        }elseif($from == 'Parking 4 You <noreply@compareairportparkings.co.uk>'){
            $data['agentID'] = 27;

        }

        

        $data = array_map('trim', $data);

   

        return $data;

        

    }
    
   
  


   

    
 
    if (strpos($from, 'Compare The Parking') !==false  && strpos($subject, 'Cancel') !==false ) {

        // $parse_email_body = strip_tags($body);


    

        $body = mb_convert_encoding($body, 'UTF-8', 'auto');

         

        $body = preg_replace('/\xC2\xA0/', ' ', $body);
        
        $parse_email_body = strip_tags($body);
        
        $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');
        
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        
        $parse_email_body = html_entity_decode($parse_email_body);
        
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        
        $parse_email_body = str_replace('&amp;', '', $parse_email_body);
        
        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);
        
        $parse_email_body = str_replace('&nbsp;', '', $parse_email_body);
        
        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);
        
        $parse_email_body = str_replace('=20', '', $parse_email_body);
        
        $parse_email_body = str_replace('=', '', $parse_email_body);
        $parse_email_body = str_replace(['=', '\r', '\n'], '', $parse_email_body);
        $parse_email_body = str_replace(['&nbsp;', '&amp;', 'MG Reservations'], '', $parse_email_body);
        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Normalize whitespace
        $parse_email_body = trim($parse_email_body);
        
        $parse_email_body = str_replace('\r', '', $parse_email_body);
        $pattern = '/Reference:\s*(CTP-\d+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*([^\n]+)\s*Status:\s*([^\n]+)/';
        
        
        preg_match($pattern, $parse_email_body, $bookingMatches);



 



$data = [
    'referenceNo' => $bookingMatches[1],       
    'abookedCompany' => $bookingMatches[2],     
    'phone_number' => $bookingMatches[4],     
    'airportID' => 1,                         
    'make' => $bookingMatches[5],             
    'model' => $bookingMatches[6],            
    'color' => $bookingMatches[7],           
    'registration' => $bookingMatches[8],      
    'departDate' => $bookingMatches[9],        
    'deprTerminal' => $bookingMatches[10],     
    'deptFlight' => $bookingMatches[11],        
    'returnDate' => $bookingMatches[12],      
    'returnTerminal' => $bookingMatches[13],   
    'returnFlight' => $bookingMatches[14],    
    'passenger' => $bookingMatches[15],         
    'total_amount' => $bookingMatches[16],      
    'booking_amount' => $bookingMatches[16],  
];

 

if (!empty($data['departDate'])) {

    // Make sure to replace slashes with dashes to match the expected date format for strtotime

    $data['departDate'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['departDate'])));

}



// For returnDate (Same as departDate)

if (!empty($data['returnDate'])) {

    $data['returnDate'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['returnDate'])));

}




$data['total_amount'] = preg_replace('/[^\d.]+/', '', $data['total_amount']); // Removes everything except digits and period

$data['booking_amount'] = preg_replace('/[^\d.]+/', '', $data['booking_amount']); // Removes everything except digits and period




$data['total_amount'] = floatval($data['total_amount']);

$data['booking_amount'] = floatval($data['booking_amount']);

 
    $fullname = $bookingMatches[4] ?? '';
    $extracted_fullname = extractNameParts($fullname);

    $data['title'] = $extracted_fullname['title'] ?? '';

    $data['first_name'] = $extracted_fullname['first_name'] ?? '';

    $data['last_name'] = $extracted_fullname['last_name'] ?? '';



    // $nameParts = explode(' ', $bookingMatches[4]);

    // $data['title'] = $nameParts[0] ?? '';

    // $data['first_name'] = $nameParts[0] ?? '';

    // $data['last_name'] = $nameParts[1] ?? '';



    // Calculate the number of days between departure and return

    if ($data['departDate'] && $data['returnDate']) {

        $earlier = new DateTime($data['departDate']);

        $later = new DateTime($data['returnDate']);

        $data['no_of_days'] = $later->diff($earlier)->format('%a');

    } else {

        $data['no_of_days'] = null;  

    }

  

    

        // $data['companyId'] = 3;

        // $data['airportID'] = 1;

        // $data['booking_status'] = 'Cancelled';

        // $data['booking_action'] = 'Booked';

        // $data['traffic_src'] = 'Agent';

        // $data['incomplete_email'] = 1;

        // $data['payment_status'] = 'success';
        $data['cancelRequest'] = 1;
        // $data['agentID'] = 21;

        $earlier = new DateTime($data['departDate']);

        $later = new DateTime($data['returnDate']);

        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

        $data = array_map('trim', $data);

       

        return $data;

        

  
 }
if($from == 'bookings@comparetheairportparking.com'){ 

	      

    // $parse_email_body = strip_tags($body);

   



    $body = mb_convert_encoding($body, 'UTF-8', 'auto');

     

$body = preg_replace('/\xC2\xA0/', ' ', $body);

$parse_email_body = strip_tags($body);

$parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');

$parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');

$parse_email_body = html_entity_decode($parse_email_body);

$parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

$parse_email_body = str_replace('\n', '', $parse_email_body);

$parse_email_body = str_replace('&amp;', '', $parse_email_body);

$parse_email_body = str_replace('MG Reservations', '', $parse_email_body);

$parse_email_body = str_replace('&nbsp;', '', $parse_email_body);

$parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);

$parse_email_body = str_replace('=20', '', $parse_email_body);

$parse_email_body = str_replace('=', '', $parse_email_body);

$parse_email_body = str_replace('\r', '', $parse_email_body);
$pattern = '/Booking ID:\s*([^\n]+)\s*Booking Date:\s*([^\n]+)\s*Customer Name:\s*([^\n]+)\s*Parking Space:\s*([^\n]+)\s*Airport:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Telephone No:\s*([^\n]+)\s*Drop Off:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Return Terminal:\s*([^\n]+)\s*Flight No:\s*([^\n]+)\s*Make & Model:\s*([^\n]+)\s*Registration No:\s*([^\n]+)\s*Colour:\s*([^\n]+?)(?=\s*Vehicle|$)/';


preg_match($pattern, $parse_email_body, $bookingMatches);









$data = [
    'referenceNo' => $bookingMatches[1],
    'created_at' => $bookingMatches[2],
    'abookedCompany' => $bookingMatches[4],
    'phone_number' => $bookingMatches[7],
    'airportID' => 1,
    'model' => $bookingMatches[13],
    'make' => $bookingMatches[13],
    'color' => $bookingMatches[15],  
    'registration' => $bookingMatches[14],
    'departDate' => $bookingMatches[8],
    'deprTerminal' => $bookingMatches[10],
    'returnDate' => $bookingMatches[9],
    'returnTerminal' => $bookingMatches[11],
    'total_amount' => $bookingMatches[6],
    'booking_amount' => $bookingMatches[6],
];

$data['created_at'] = date('Y-m-d H:i:s', strtotime($bookingMatches[2]));

// if (!empty($data['created_at'])) {

//     $data['created_at'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['created_at'])));

// }

if (!empty($data['departDate'])) {

// Make sure to replace slashes with dashes to match the expected date format for strtotime

$data['departDate'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['departDate'])));

}



// For returnDate (Same as departDate)

if (!empty($data['returnDate'])) {

$data['returnDate'] = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['returnDate'])));

}



// Remove spaces and commas (for thousands separator)

$data['total_amount'] = preg_replace('/[^\d.]+/', '', $data['total_amount']); // Removes everything except digits and period

$data['booking_amount'] = preg_replace('/[^\d.]+/', '', $data['booking_amount']); // Removes everything except digits and period



// Convert to float for proper storage

$data['total_amount'] = floatval($data['total_amount']);

$data['booking_amount'] = floatval($data['booking_amount']);





// Split name into title, first name, and last name

    $fullname = $bookingMatches[3] ?? '';
    $extracted_fullname = extractNameParts($fullname);

    $data['title'] = $extracted_fullname['title'] ?? '';

    $data['first_name'] = $extracted_fullname['first_name'] ?? '';

    $data['last_name'] = $extracted_fullname['last_name'] ?? '';

    // $nameParts = explode(' ', $bookingMatches[3]);
    
    // $data['title'] = $nameParts[0] ?? '';
    
    // $data['first_name'] = $nameParts[0] ?? '';
    
    // $data['last_name'] = $nameParts[1] ?? '';



// Calculate the number of days between departure and return

if ($data['departDate'] && $data['returnDate']) {

    $earlier = new DateTime($data['departDate']);

    $later = new DateTime($data['returnDate']);

    $data['no_of_days'] = $later->diff($earlier)->format('%a');

} else {

    $data['no_of_days'] = null; // Set to null if dates are invalid

}





    $data['companyId'] = 3;

    $data['airportID'] = 1;

    $data['booking_status'] = 'Completed';

    $data['booking_action'] = 'Booked';

    $data['traffic_src'] = 'Agent';

    $data['incomplete_email'] = 1;

    $data['payment_status'] = 'success';

    $data['agentID'] = 21;

    $earlier = new DateTime($data['departDate']);

    $later = new DateTime($data['returnDate']);

    $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

    $data = array_map('trim', $data);

   

    return $data;

    



}
if ( $from == 'noreply@smartparkingdeals.uk' || strpos($from, 'Compare Airport Parking Deals') !== false && strpos($subject, 'Cancelled') !== false)  {
    
    // $parse_email_body = strip_tags($body);

   
    $encoding = mb_detect_encoding($body, 'UTF-8, ISO-8859-1, ASCII', true);
    if ($encoding !== 'UTF-8') {
        $body = mb_convert_encoding($body, 'UTF-8', $encoding);
    }
    
    $body = mb_convert_encoding($body, 'UTF-8', 'auto');

    $body = preg_replace('/\xC2\xA0/', ' ', $body);

    $parse_email_body = strip_tags($body);

    $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');

    $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');

    $parse_email_body = html_entity_decode($parse_email_body);

    $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

    $parse_email_body = str_replace('\n', '', $parse_email_body);

    $parse_email_body = str_replace('&amp;', '', $parse_email_body);

    $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);

    $parse_email_body = str_replace('&nbsp;', '', $parse_email_body);

    $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);

    $parse_email_body = str_replace('=20', '', $parse_email_body);

    $parse_email_body = preg_replace('/\\\r\][\w\W]+?t[z]?/', '', $parse_email_body);
    
    $parse_email_body = preg_replace('/[\x00-\x1F\x80-\xFF]+/', '', $parse_email_body);
    
    $parse_email_body = trim($parse_email_body);

    

    $pattern = '/Airport:\s*([^\n]+)\s*Reference Code:\s*([^\n]+)\s*Company Name:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact No:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration No\.:\s*([^\n]+)\s*Departure Date\/Time:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Departure Flight no:\s*([^\n]*)\s*Arrival Date\/Time:\s*([^\n]+)\s*Arrival Terminal:\s*([^\n]+)\s*Arrival Flight no:\s*([^\n]*)\s*Passengers:\s*([^\n]+)\s*Valeting:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Booking Status:\s*([^\n]+)/i';


    preg_match($pattern, $parse_email_body, $bookingMatches);

    

    







    $data = [

        'referenceNo' => $bookingMatches[2],

        // 'created_at' => $bookingMatches[2],

        

        'abookedCompany'=> $bookingMatches[3],

        'phone_number' => $bookingMatches[5],

        'airportID' => 1,

        'model'=>$bookingMatches[6],

        'make'=>$bookingMatches[7],

        'color'=>$bookingMatches[8],

        'registration'=>$bookingMatches[9],

        'departDate' => $bookingMatches[10],

        'deprTerminal' => $bookingMatches[11],

        'deptFlight'=>$bookingMatches[12],

        'returnDate' => $bookingMatches[13],

        'returnTerminal' => $bookingMatches[14],

        'returnFlight' => $bookingMatches[15],

        'passenger'=>$bookingMatches[16],

        'total_amount' => $bookingMatches[18],

        'booking_amount' => $bookingMatches[18],

    ];

    $cleaned_total_amount = str_replace('£', '', $bookingMatches[18]);

    $data['total_amount'] = trim($cleaned_total_amount); 

    $cleaned_total_amount_booking = str_replace('£', '', $bookingMatches[18]);

    $data['booking_amount'] = trim($cleaned_total_amount_booking);

    // $data['created_at'] = date('Y-m-d H:i:s', strtotime($bookingMatches[2]));

    $data['departDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[10]));

    $data['returnDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[13]));







    // Split name into title, first name, and last name


    $fullname = $bookingMatches[4] ?? '';
    $extracted_fullname = extractNameParts($fullname);

    $data['title'] = $extracted_fullname['title'] ?? '';

    $data['first_name'] = $extracted_fullname['first_name'] ?? '';

    $data['last_name'] = $extracted_fullname['last_name'] ?? '';
    
    

    // $nameParts = explode(' ', $bookingMatches[4]);
    
    // $data['title'] = $nameParts[0] ?? '';
    
    // $data['first_name'] = $nameParts[0] ?? '';
    
    // $data['last_name'] = $nameParts[1] ?? '';



    // Calculate the number of days between departure and return
    
    if ($data['departDate'] && $data['returnDate']) {
    
        $earlier = new DateTime($data['departDate']);
    
        $later = new DateTime($data['returnDate']);
    
        $data['no_of_days'] = $later->diff($earlier)->format('%a');
    
    } else {
    
        $data['no_of_days'] = null; // Set to null if dates are invalid
    
    }





    // $data['companyId'] = 3;

    // $data['airportID'] = 1;

    // $data['booking_status'] = 'Completed';

    // $data['booking_action'] = 'Booked';

    // $data['traffic_src'] = 'Agent';

    // $data['payment_status'] = 'success';

    // $data['incomplete_email'] = 1;

    // $data['agentID'] = 24;

    // $earlier = new DateTime($data['departDate']);

    // $later = new DateTime($data['returnDate']);

    // $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3
    $data['cancelRequest'] = 1;

    $data = array_map('trim', $data);

   

    return $data;

    



}
    if ( $from == 'noreply@smartparkingdeals.uk' || strpos($from, 'Compare Airport Parking Deals') !== false)  {
        echo "here";

        // $parse_email_body = strip_tags($body);
 
       
        $encoding = mb_detect_encoding($body, 'UTF-8, ISO-8859-1, ASCII', true);
        if ($encoding !== 'UTF-8') {
            $body = mb_convert_encoding($body, 'UTF-8', $encoding);
        }
        
        $body = mb_convert_encoding($body, 'UTF-8', 'auto');

        $body = preg_replace('/\xC2\xA0/', ' ', $body);

        $parse_email_body = strip_tags($body);

        $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');

        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');

        $parse_email_body = html_entity_decode($parse_email_body);

        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

        $parse_email_body = str_replace('\n', '', $parse_email_body);

        $parse_email_body = str_replace('&amp;', '', $parse_email_body);

        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);

        $parse_email_body = str_replace('&nbsp;', '', $parse_email_body);

        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);

        $parse_email_body = str_replace('=20', '', $parse_email_body);

        $parse_email_body = str_replace('=', '', $parse_email_body);


        $pattern = '/Airport:\s*([^\n]+)\s*Reference Code:\s*([^\n]+)\s*Company Name:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact No:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration No\.:([^\n]+)\s*Departure Date\/Time:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Departure Flight no:\s*([^\n]+)\s*Arrival Date\/Time:\s*([^\n]+)\s*Arrival Terminal:\s*([^\n]+)\s*Arrival Flight no:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Valeting:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Booking Status:\s*Completed/i';

        preg_match($pattern, $parse_email_body, $bookingMatches);

        $data = [

            'referenceNo' => $bookingMatches[2],

            // 'created_at' => $bookingMatches[2],

            

            'abookedCompany'=> $bookingMatches[3],

            'phone_number' => $bookingMatches[5],

            'airportID' => 1,

            'model'=>$bookingMatches[6],

            'make'=>$bookingMatches[7],

            'color'=>$bookingMatches[8],

            'registration'=>$bookingMatches[9],

            'departDate' => $bookingMatches[10],

            'deprTerminal' => $bookingMatches[11],

            'deptFlight'=>$bookingMatches[12],

            'returnDate' => $bookingMatches[13],

            'returnTerminal' => $bookingMatches[14],

            'returnFlight' => $bookingMatches[15],

            'passenger'=>$bookingMatches[16],

            'total_amount' => $bookingMatches[18],

            'booking_amount' => $bookingMatches[18],

        ];

        $cleaned_total_amount = str_replace('£', '', $bookingMatches[18]);

        $data['total_amount'] = trim($cleaned_total_amount); 

        $cleaned_total_amount_booking = str_replace('£', '', $bookingMatches[18]);

        $data['booking_amount'] = trim($cleaned_total_amount_booking);

        // $data['created_at'] = date('Y-m-d H:i:s', strtotime($bookingMatches[2]));

        $data['departDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[10]));

        $data['returnDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[13]));


        // Split name into title, first name, and last name
    
        // extractNameParts($fullName)
        $fullname = $bookingMatches[4] ?? '';
        
        
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';



        // Calculate the number of days between departure and return
    
        if ($data['departDate'] && $data['returnDate']) {
    
            $earlier = new DateTime($data['departDate']);
    
            $later = new DateTime($data['returnDate']);
    
            $data['no_of_days'] = $later->diff($earlier)->format('%a');
    
        } else {
    
            $data['no_of_days'] = null; // Set to null if dates are invalid
    
        }

  

    

        $data['companyId'] = 3;

        $data['airportID'] = 1;

        $data['booking_status'] = 'Completed';

        $data['booking_action'] = 'Booked';

        $data['traffic_src'] = 'Agent';

        $data['payment_status'] = 'success';

        $data['incomplete_email'] = 1;

        $data['agentID'] = 24;

        $earlier = new DateTime($data['departDate']);

        $later = new DateTime($data['returnDate']);

        $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

        $data = array_map('trim', $data);

       

        return $data;

    }

if (strpos($from, 'Compare Your Parking') !== false && strpos($subject, 'Cancel') !== false) {

     

   

   $body = mb_convert_encoding($body, 'UTF-8', 'auto');

$body = preg_replace('/\xC2\xA0/', ' ', $body);

$parse_email_body = strip_tags($body);

$parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');

$parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');

$parse_email_body = html_entity_decode($parse_email_body);

$parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

$parse_email_body = str_replace('\n', '', $parse_email_body);

$parse_email_body = str_replace('&amp;', '', $parse_email_body);

$parse_email_body = str_replace('MG Reservations', '', $parse_email_body);

$parse_email_body = str_replace('&nbsp;', '', $parse_email_body);

$parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);

$parse_email_body = str_replace('=20', '', $parse_email_body);

$parse_email_body = str_replace('=', '', $parse_email_body);



$pattern = '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';

preg_match($pattern, $parse_email_body, $bookingMatches);











$data = [

'referenceNo' => $bookingMatches[2],

// 'created_at' => $bookingMatches[2],



'abookedCompany'=> $bookingMatches[3],

'phone_number' => $bookingMatches[5],

'airportID' => 1,

'model'=>$bookingMatches[6],

'make'=>$bookingMatches[7],

'color'=>$bookingMatches[8],

'registration'=>$bookingMatches[9],

'departDate' => $bookingMatches[10],

'deprTerminal' => $bookingMatches[11],

'deptFlight'=>$bookingMatches[12],

'returnDate' => $bookingMatches[13],

'returnTerminal' => $bookingMatches[14],

'returnFlight' => $bookingMatches[15],

'passenger'=>$bookingMatches[16],

'total_amount' => $bookingMatches[17],

'booking_amount' => $bookingMatches[17],

];

$cleaned_total_amount = str_replace('£', '', $bookingMatches[17]);

$data['total_amount'] = trim($cleaned_total_amount); 

$cleaned_total_amount_booking = str_replace('£', '', $bookingMatches[17]);

$data['booking_amount'] = trim($cleaned_total_amount_booking);

// $data['created_at'] = date('Y-m-d H:i:s', strtotime($bookingMatches[2]));

$data['departDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[10]));

$data['returnDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[13]));







// Split name into title, first name, and last name


    $fullname = $bookingMatches[4] ?? '';
    $extracted_fullname = extractNameParts($fullname);

    $data['title'] = $extracted_fullname['title'] ?? '';

    $data['first_name'] = $extracted_fullname['first_name'] ?? '';

    $data['last_name'] = $extracted_fullname['last_name'] ?? '';
    
    
    

// $nameParts = explode(' ', $bookingMatches[4]);

// $data['title'] = $nameParts[0] ?? '';

// $data['first_name'] = $nameParts[0] ?? '';

// $data['last_name'] = $nameParts[1] ?? '';



// Calculate the number of days between departure and return

if ($data['departDate'] && $data['returnDate']) {

    $earlier = new DateTime($data['departDate']);

    $later = new DateTime($data['returnDate']);

    $data['no_of_days'] = $later->diff($earlier)->format('%a');

} else {

    $data['no_of_days'] = null; // Set to null if dates are invalid

}





     // $data['companyId'] = 3;

        // $data['airportID'] = 1;

        // $data['booking_status'] = 'Completed';

        // $data['booking_action'] = 'Booked';

        // $data['traffic_src'] = 'Agent';

        // $data['payment_status'] = 'success';

        // $data['incomplete_email'] = 1;

        

        // $earlier = new DateTime($data['departDate']);

        // $later = new DateTime($data['returnDate']);

        // $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

        

        // if($from == 'Parking 4 You <noreply@parking4you.co.uk>'){

        //     $data['agentID'] = 17;

        // }else{

        //     $data['agentID'] = 17;

        // }

        $data['cancelRequest'] = 1;

        $data = array_map('trim', $data);

           

            return $data;

    



}
if (strpos($from, 'Compare Your Parking') !== false && strpos($subject, 'Amend') !== false) {

          
    
    // $parse_email_body = strip_tags($body);

   

   $body = mb_convert_encoding($body, 'UTF-8', 'auto');

$body = preg_replace('/\xC2\xA0/', ' ', $body);

$parse_email_body = strip_tags($body);

$parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');

$parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');

$parse_email_body = html_entity_decode($parse_email_body);

$parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

$parse_email_body = str_replace('\n', '', $parse_email_body);

$parse_email_body = str_replace('&amp;', '', $parse_email_body);

$parse_email_body = str_replace('MG Reservations', '', $parse_email_body);

$parse_email_body = str_replace('&nbsp;', '', $parse_email_body);

$parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);

$parse_email_body = str_replace('=20', '', $parse_email_body);

$parse_email_body = str_replace('=', '', $parse_email_body);



$pattern = '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';

preg_match($pattern, $parse_email_body, $bookingMatches);











$data = [

'referenceNo' => $bookingMatches[2],

// 'created_at' => $bookingMatches[2],



'abookedCompany'=> $bookingMatches[3],

'phone_number' => $bookingMatches[5],

'airportID' => 1,

'model'=>$bookingMatches[6],

'make'=>$bookingMatches[7],

'color'=>$bookingMatches[8],

'registration'=>$bookingMatches[9],

'departDate' => $bookingMatches[10],

'deprTerminal' => $bookingMatches[11],

'deptFlight'=>$bookingMatches[12],

'returnDate' => $bookingMatches[13],

'returnTerminal' => $bookingMatches[14],

'returnFlight' => $bookingMatches[15],

'passenger'=>$bookingMatches[16],

'total_amount' => $bookingMatches[17],

'booking_amount' => $bookingMatches[17],

];

$cleaned_total_amount = str_replace('£', '', $bookingMatches[17]);

$data['total_amount'] = trim($cleaned_total_amount); 

$cleaned_total_amount_booking = str_replace('£', '', $bookingMatches[17]);

$data['booking_amount'] = trim($cleaned_total_amount_booking);

// $data['created_at'] = date('Y-m-d H:i:s', strtotime($bookingMatches[2]));

$data['departDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[10]));

$data['returnDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[13]));







// Split name into title, first name, and last name


    $fullname = $bookingMatches[4] ?? '';
    $extracted_fullname = extractNameParts($fullname);

    $data['title'] = $extracted_fullname['title'] ?? '';

    $data['first_name'] = $extracted_fullname['first_name'] ?? '';

    $data['last_name'] = $extracted_fullname['last_name'] ?? '';


    // $nameParts = explode(' ', $bookingMatches[4]);
    
    // $data['title'] = $nameParts[0] ?? '';
    
    // $data['first_name'] = $nameParts[0] ?? '';
    
    // $data['last_name'] = $nameParts[1] ?? '';



// Calculate the number of days between departure and return

if ($data['departDate'] && $data['returnDate']) {

    $earlier = new DateTime($data['departDate']);

    $later = new DateTime($data['returnDate']);

    $data['no_of_days'] = $later->diff($earlier)->format('%a');

} else {

    $data['no_of_days'] = null; // Set to null if dates are invalid

}





    $data['companyId'] = 3;

    $data['airportID'] = 1;

    $data['booking_status'] = 'Completed';

    $data['booking_action'] = 'Amend';

    $data['amendRequest'] = 1;
    $data['traffic_src'] = 'Agent';

    $data['payment_status'] = 'success';

    $data['incomplete_email'] = 1;

    $data['agentID'] = 22;

    $earlier = new DateTime($data['departDate']);

    $later = new DateTime($data['returnDate']);

    $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

    $data = array_map('trim', $data);

   

    return $data;

    



}

    if (strpos($from, 'Compare Your Parking') !== false) {

    	      

            // $parse_email_body = strip_tags($body);

           

           $body = mb_convert_encoding($body, 'UTF-8', 'auto');

    $body = preg_replace('/\xC2\xA0/', ' ', $body);

    $parse_email_body = strip_tags($body);

    $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');

    $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');

    $parse_email_body = html_entity_decode($parse_email_body);

    $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

    $parse_email_body = str_replace('\n', '', $parse_email_body);

    $parse_email_body = str_replace('&amp;', '', $parse_email_body);

    $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);

    $parse_email_body = str_replace('&nbsp;', '', $parse_email_body);

    $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);

    $parse_email_body = str_replace('=20', '', $parse_email_body);

    $parse_email_body = str_replace('=', '', $parse_email_body);

     

    $pattern = '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';

    preg_match($pattern, $parse_email_body, $bookingMatches);

     

    

    

        

    

    $data = [

        'referenceNo' => $bookingMatches[2],

        // 'created_at' => $bookingMatches[2],

        

        'abookedCompany'=> $bookingMatches[3],

        'phone_number' => $bookingMatches[5],

        'airportID' => 1,

        'model'=>$bookingMatches[6],

        'make'=>$bookingMatches[7],

        'color'=>$bookingMatches[8],

        'registration'=>$bookingMatches[9],

        'departDate' => $bookingMatches[10],

        'deprTerminal' => $bookingMatches[11],

        'deptFlight'=>$bookingMatches[12],

        'returnDate' => $bookingMatches[13],

        'returnTerminal' => $bookingMatches[14],

        'returnFlight' => $bookingMatches[15],

        'passenger'=>$bookingMatches[16],

        'total_amount' => $bookingMatches[17],

        'booking_amount' => $bookingMatches[17],

    ];

     $cleaned_total_amount = str_replace('£', '', $bookingMatches[17]);

    $data['total_amount'] = trim($cleaned_total_amount); 

     $cleaned_total_amount_booking = str_replace('£', '', $bookingMatches[17]);

    $data['booking_amount'] = trim($cleaned_total_amount_booking);

    // $data['created_at'] = date('Y-m-d H:i:s', strtotime($bookingMatches[2]));

    $data['departDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[10]));

    $data['returnDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[13]));

    

        

    

        // Split name into title, first name, and last name


        $fullname = $bookingMatches[4] ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';



        // $nameParts = explode(' ', $bookingMatches[4]);

        // $data['title'] = $nameParts[0] ?? '';

        // $data['first_name'] = $nameParts[0] ?? '';

        // $data['last_name'] = $nameParts[1] ?? '';

    

        // Calculate the number of days between departure and return

        if ($data['departDate'] && $data['returnDate']) {

            $earlier = new DateTime($data['departDate']);

            $later = new DateTime($data['returnDate']);

            $data['no_of_days'] = $later->diff($earlier)->format('%a');

        } else {

            $data['no_of_days'] = null; // Set to null if dates are invalid

        }

      

        

            $data['companyId'] = 3;

            $data['airportID'] = 1;

            $data['booking_status'] = 'Completed';

            $data['booking_action'] = 'Booked';

            $data['traffic_src'] = 'Agent';

            $data['payment_status'] = 'success';

            $data['incomplete_email'] = 1;

            $data['agentID'] = 22;

            $earlier = new DateTime($data['departDate']);

            $later = new DateTime($data['returnDate']);

            $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

            $data = array_map('trim', $data);

           

            return $data;

            

      

    }
  


     if (strpos($from, 'Compare The Parking') !== false && strpos($subject, 'Amend') === false) {


               

           $body = mb_convert_encoding($body, 'UTF-8', 'auto');

    $body = preg_replace('/\xC2\xA0/', ' ', $body);

    $parse_email_body = strip_tags($body);

    $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');

    $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');

    $parse_email_body = html_entity_decode($parse_email_body);

    $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

    $parse_email_body = str_replace('\n', '', $parse_email_body);

    $parse_email_body = str_replace('&amp;', '', $parse_email_body);

    $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);

    $parse_email_body = str_replace('&nbsp;', '', $parse_email_body);

    $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);

    $parse_email_body = str_replace('=20', '', $parse_email_body);

    $parse_email_body = str_replace('=', '', $parse_email_body);

     

    $pattern = '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';

    preg_match($pattern, $parse_email_body, $bookingMatches);

    

    

    

        

    

    $data = [

        'referenceNo' => $bookingMatches[2],

        // 'created_at' => $bookingMatches[2],

        

        'abookedCompany'=> $bookingMatches[3],

        'phone_number' => $bookingMatches[5],

        'airportID' => 1,

        'model'=>$bookingMatches[7],

        'make'=>$bookingMatches[6],

        'color'=>$bookingMatches[8],

        'registration'=>$bookingMatches[9],

        'departDate' => $bookingMatches[10],

        'deprTerminal' => $bookingMatches[11],

        'deptFlight'=>$bookingMatches[12],

        'returnDate' => $bookingMatches[13],

        'returnTerminal' => $bookingMatches[14],

        'returnFlight' => $bookingMatches[15],

        'passenger'=>$bookingMatches[16],

        'total_amount' => $bookingMatches[17],

        'booking_amount' => $bookingMatches[17],

    ];

     $cleaned_total_amount = str_replace('£', '', $bookingMatches[17]);

    $data['total_amount'] = trim($cleaned_total_amount); 

     $cleaned_total_amount_booking = str_replace('£', '', $bookingMatches[17]);

    $data['booking_amount'] = trim($cleaned_total_amount_booking);

    // $data['created_at'] = date('Y-m-d H:i:s', strtotime($bookingMatches[2]));

    $data['departDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[10]));

    $data['returnDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[13]));

    

        

    

        // Split name into title, first name, and last name
        
        $fullname = $bookingMatches[4] ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';

        // $nameParts = explode(' ', $bookingMatches[4]);

        // $data['title'] = $nameParts[0] ?? '';

        // $data['first_name'] = $nameParts[0] ?? '';

        // $data['last_name'] = $nameParts[1] ?? '';

    

        // Calculate the number of days between departure and return

        if ($data['departDate'] && $data['returnDate']) {

            $earlier = new DateTime($data['departDate']);

            $later = new DateTime($data['returnDate']);

            $data['no_of_days'] = $later->diff($earlier)->format('%a');

        } else {

            $data['no_of_days'] = null; // Set to null if dates are invalid

        }

      

        

            $data['companyId'] = 3;

            $data['airportID'] = 1;

            $data['booking_status'] = 'Completed';

            $data['booking_action'] = 'Booked';

            $data['traffic_src'] = 'Agent';

            $data['incomplete_email'] = 1;

            $data['payment_status'] = 'success';

            $data['agentID'] = 25;

            $earlier = new DateTime($data['departDate']);

            $later = new DateTime($data['returnDate']);

            $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

            $data = array_map('trim', $data);

           

            return $data;

            

      

    }

   
     if (strpos($from, 'Compare The Parking') !== false && strpos($subject, 'Amend') !== false ) {

 

             

           $body = mb_convert_encoding($body, 'UTF-8', 'auto');

    $body = preg_replace('/\xC2\xA0/', ' ', $body);

    $parse_email_body = strip_tags($body);

    $parse_email_body = html_entity_decode($parse_email_body, ENT_QUOTES, 'UTF-8');

    $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');

    $parse_email_body = html_entity_decode($parse_email_body);

    $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

    $parse_email_body = str_replace('\n', '', $parse_email_body);

    $parse_email_body = str_replace('&amp;', '', $parse_email_body);

    $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);

    $parse_email_body = str_replace('&nbsp;', '', $parse_email_body);

    $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);

    $parse_email_body = str_replace('=20', '', $parse_email_body);

    $parse_email_body = str_replace('=', '', $parse_email_body);

     

    $pattern = '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';

    preg_match($pattern, $parse_email_body, $bookingMatches);

    

    

    

        

    

    $data = [

        'referenceNo' => $bookingMatches[2],

        // 'created_at' => $bookingMatches[2],

        

        'abookedCompany'=> $bookingMatches[3],

        'phone_number' => $bookingMatches[5],

        'airportID' => 1,

        'model'=>$bookingMatches[7],

        'make'=>$bookingMatches[6],

        'color'=>$bookingMatches[8],

        'registration'=>$bookingMatches[9],

        'departDate' => $bookingMatches[10],

        'deprTerminal' => $bookingMatches[11],

        'deptFlight'=>$bookingMatches[12],

        'returnDate' => $bookingMatches[13],

        'returnTerminal' => $bookingMatches[14],

        'returnFlight' => $bookingMatches[15],

        'passenger'=>$bookingMatches[16],

        'total_amount' => $bookingMatches[17],

        'booking_amount' => $bookingMatches[17],

    ];

     $cleaned_total_amount = str_replace('£', '', $bookingMatches[17]);

    $data['total_amount'] = trim($cleaned_total_amount); 

     $cleaned_total_amount_booking = str_replace('£', '', $bookingMatches[17]);

    $data['booking_amount'] = trim($cleaned_total_amount_booking);

    // $data['created_at'] = date('Y-m-d H:i:s', strtotime($bookingMatches[2]));

    $data['departDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[10]));

    $data['returnDate'] = date('Y-m-d H:i:s', strtotime($bookingMatches[13]));

    

        

    

        // Split name into title, first name, and last name

        $fullname = $bookingMatches[4] ?? '';
        $extracted_fullname = extractNameParts($fullname);
    
        $data['title'] = $extracted_fullname['title'] ?? '';
    
        $data['first_name'] = $extracted_fullname['first_name'] ?? '';
    
        $data['last_name'] = $extracted_fullname['last_name'] ?? '';


        // $nameParts = explode(' ', $bookingMatches[4]);

        // $data['title'] = $nameParts[0] ?? '';

        // $data['first_name'] = $nameParts[0] ?? '';

        // $data['last_name'] = $nameParts[1] ?? '';

    

        // Calculate the number of days between departure and return

        if ($data['departDate'] && $data['returnDate']) {

            $earlier = new DateTime($data['departDate']);

            $later = new DateTime($data['returnDate']);

            $data['no_of_days'] = $later->diff($earlier)->format('%a');

        } else {

            $data['no_of_days'] = null; // Set to null if dates are invalid

        }

      

        

            $data['companyId'] = 3;

            $data['airportID'] = 1;

            $data['booking_status'] = 'Completed';

            // $data['booking_action'] = 'Booked';

            $data['booking_action'] = 'Amend';

        $data['amendRequest'] = 1;

            $data['traffic_src'] = 'Agent';

            $data['incomplete_email'] = 1;

            $data['payment_status'] = 'success';

            $data['agentID'] = 25;

            $earlier = new DateTime($data['departDate']);

            $later = new DateTime($data['returnDate']);

            $data['no_of_days'] = $later->diff($earlier)->format("%a"); //3

            $data = array_map('trim', $data);

           

            return $data;

            

      

    }

if (strpos($from, 'Airport Cheap Parking') !== false && strpos($subject, 'Cancelled') === false) {

    

    // Sanitize and clean up the email body

    $parse_email_body = strip_tags($body);

    $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

    $parse_email_body = str_replace(["\n", "Â", "\r", "]v4_}]]}", "&pound; ", "Ã‚Â£"], ['', '', '', '', '£', ''], $parse_email_body);

    $parse_email_body = strip_tags($parse_email_body); // Remove HTML tags

$parse_email_body = html_entity_decode($parse_email_body); // Decode HTML entities

$parse_email_body = preg_replace('/[^\x20-\x7E]/', '', $parse_email_body); // Remove non-printable characters

 

   

    $pattern = [

    'airport' => '/Airport:\s*(\S+)/',

    'reference_code' => '/Reference Code:\s*(\S+)/',

    'company' => '/Company:\s*([^0-9]+)/',

    'meet_greet' => '/Meet & Greet\s*Name:\s*([^0-9]+)/',

    'contact_no' => '/Contact No:\s*(\d+)/',

    'model' => '/Model:\s*(\S+)/',

    'make' => '/Make:\s*(\S+)/',

    'colour' => '/Colour:\s*(\S+)/',

    'registration_no' => '/Registration No.:\s*(\S+)/',

    'departure_date' => '/Departure Date\/Time:\s*(.*)/',  // Updated to capture full date and time

    'departure_terminal' => '/Departure Terminal:\s*(\S+)/',

    'departure_flight' => '/Departure Flight no:\s*(\S+)/',

    'arrival_date' => '/Arrival Date\/Time:\s*(.*)/',  // Updated to capture full date and time

    'arrival_terminal' => '/Arrival Terminal:\s*(\S+)/',

    'arrival_flight' => '/Arrival Flight no:\s*(\S+)/',

    'passengers' => '/Passengers:\s*(\d+)/',

    'valeting' => '/Valeting:\s*(\S+)/',

    'amount' => '/Amount(?:[:\s]*)[£]?\s*([\d,]+(?:\.\d{1,2})?)/i',

    'booking_status' => '/Booking Status:\s*(\S+)/'

];



// Initialize an empty array to store matches

$bookingMatches = [];

foreach ($pattern as $key => $regex) {

    if (preg_match($regex, $parse_email_body, $matches)) {

        $bookingMatches[$key] = $matches[1];  // Store the first match

    }

}



    // Handle the amount specifically

    if (!empty($bookingMatches['amount'])) {

        $bookingMatches['amount'] = str_replace(',', '', $bookingMatches['amount']); // Remove commas for amounts

    }



    // Prepare the structured data array

  $data = [

    'referenceNo' => $bookingMatches['reference_code'] ?? '',

    'abookedCompany' => $bookingMatches['company'] ?? '',

    'phone_number' => $bookingMatches['contact_no'] ?? '',

    'airportID' => 1,

    'model' => $bookingMatches['model'] ?? '',

    'make' => $bookingMatches['make'] ?? '',

    'color' => $bookingMatches['colour'] ?? '',

    'registration' => $bookingMatches['registration_no'] ?? '',

    'deprTerminal' => $bookingMatches['departure_terminal'] ?? '',

    'deptFlight' => $bookingMatches['departure_flight'] ?? '',

    'returnTerminal' => $bookingMatches['arrival_terminal'] ?? '',

    'returnFlight' => $bookingMatches['arrival_flight'] ?? '',

    'passenger' => $bookingMatches['passengers'] ?? '',

    'total_amount' => $bookingMatches['amount'] ?? '',

];

   

  if (!empty($bookingMatches['departure_date'])) {

    $departureDate = $bookingMatches['departure_date'];

    $dateParts = explode(" ", $departureDate);

    $date = $dateParts[0];

    $time = $dateParts[1] ?? '';



    $date = implode('-', array_reverse(explode('/', $date)));

    $formattedDepartureDate = $date . ' ' . $time;

    $data['departDate'] = date('Y-m-d H:i:s', strtotime($formattedDepartureDate)) ?: null;

}



if (!empty($bookingMatches['arrival_date'])) {

    $arrivalDate = $bookingMatches['arrival_date'];

    $dateParts = explode(" ", $arrivalDate);

    $date = $dateParts[0];

    $time = $dateParts[1] ?? '';



    $date = implode('-', array_reverse(explode('/', $date)));

    $formattedArrivalDate = $date . ' ' . $time;

    $data['returnDate'] = date('Y-m-d H:i:s', strtotime($formattedArrivalDate)) ?: null;

}



 

    // Split name into title, first name, and last name
    
    
    $fullname = $bookingMatches['meet_greet'] ?? '';
    $extracted_fullname = extractNameParts($fullname);

    $data['title'] = $extracted_fullname['title'] ?? '';

    $data['first_name'] = $extracted_fullname['first_name'] ?? '';

    $data['last_name'] = $extracted_fullname['last_name'] ?? '';
    

    // $nameParts = explode(' ', $bookingMatches['meet_greet'] ?? '');

    // $data['title'] = $nameParts[0] ?? '';

    // $data['first_name'] = $nameParts[0] ?? '';

    // $data['last_name'] = $nameParts[1] ?? '';



    // Calculate the number of days between departure and return

    if ($data['departDate'] && $data['returnDate']) {

        $earlier = new DateTime($data['departDate']);

        $later = new DateTime($data['returnDate']);

        $data['no_of_days'] = $later->diff($earlier)->format('%a');

    } else {

        $data['no_of_days'] = null; // Set to null if dates are invalid

    }



    // Additional static data

    $data['companyId'] = 3;

    $data['airportID'] = 1;

    $data['booking_status'] = 'Completed';

    $data['booking_action'] = 'Booked';

    $data['traffic_src'] = 'Agent';

    $data['payment_status'] = 'success';

    $data['incomplete_email'] = 1;

    $data['agentID'] = 26;



    // Clean up any extra spaces

    $data = array_map('trim', $data);



    return $data; // Return the cleaned and structured data

}


if (strpos($from, 'Airport Cheap Parking') !== false && strpos($subject, 'Cancelled') !== false) {
    

    // Sanitize and clean up the email body

    $parse_email_body = strip_tags($body);

    $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));

    $parse_email_body = str_replace(["\n", "Â", "\r", "]v4_}]]}", "&pound; ", "Ã‚Â£"], ['', '', '', '', '£', ''], $parse_email_body);

    $parse_email_body = strip_tags($parse_email_body); // Remove HTML tags

$parse_email_body = html_entity_decode($parse_email_body); // Decode HTML entities

$parse_email_body = preg_replace('/[^\x20-\x7E]/', '', $parse_email_body); // Remove non-printable characters

 

   

    $pattern = [

    'airport' => '/Airport:\s*(\S+)/',

    'reference_code' => '/Reference Code:\s*(\S+)/',

    'company' => '/Company:\s*([^0-9]+)/',

    'meet_greet' => '/Meet & Greet\s*Name:\s*([^0-9]+)/',

    'contact_no' => '/Contact No:\s*(\d+)/',

    'model' => '/Model:\s*(\S+)/',

    'make' => '/Make:\s*(\S+)/',

    'colour' => '/Colour:\s*(\S+)/',

    'registration_no' => '/Registration No.:\s*(\S+)/',

    'departure_date' => '/Departure Date\/Time:\s*(.*)/',  // Updated to capture full date and time

    'departure_terminal' => '/Departure Terminal:\s*(\S+)/',

    'departure_flight' => '/Departure Flight no:\s*(\S+)/',

    'arrival_date' => '/Arrival Date\/Time:\s*(.*)/',  // Updated to capture full date and time

    'arrival_terminal' => '/Arrival Terminal:\s*(\S+)/',

    'arrival_flight' => '/Arrival Flight no:\s*(\S+)/',

    'passengers' => '/Passengers:\s*(\d+)/',

    'valeting' => '/Valeting:\s*(\S+)/',

    'amount' => '/Amount(?:[:\s]*)[£]?\s*([\d,]+(?:\.\d{1,2})?)/i',

    'booking_status' => '/Booking Status:\s*(\S+)/'

];



// Initialize an empty array to store matches

$bookingMatches = [];

foreach ($pattern as $key => $regex) {

    if (preg_match($regex, $parse_email_body, $matches)) {

        $bookingMatches[$key] = $matches[1];  // Store the first match

    }

}



    // Handle the amount specifically

    if (!empty($bookingMatches['amount'])) {

        $bookingMatches['amount'] = str_replace(',', '', $bookingMatches['amount']); // Remove commas for amounts

    }



    // Prepare the structured data array

  $data = [

    'referenceNo' => $bookingMatches['reference_code'] ?? '',

    'abookedCompany' => $bookingMatches['company'] ?? '',

    'phone_number' => $bookingMatches['contact_no'] ?? '',

    'airportID' => 1,

    'model' => $bookingMatches['model'] ?? '',

    'make' => $bookingMatches['make'] ?? '',

    'color' => $bookingMatches['colour'] ?? '',

    'registration' => $bookingMatches['registration_no'] ?? '',

    'deprTerminal' => $bookingMatches['departure_terminal'] ?? '',

    'deptFlight' => $bookingMatches['departure_flight'] ?? '',

    'returnTerminal' => $bookingMatches['arrival_terminal'] ?? '',

    'returnFlight' => $bookingMatches['arrival_flight'] ?? '',

    'passenger' => $bookingMatches['passengers'] ?? '',

    'total_amount' => $bookingMatches['amount'] ?? '',

];

   

  if (!empty($bookingMatches['departure_date'])) {

    $departureDate = $bookingMatches['departure_date'];

    $dateParts = explode(" ", $departureDate);

    $date = $dateParts[0];

    $time = $dateParts[1] ?? '';



    $date = implode('-', array_reverse(explode('/', $date)));

    $formattedDepartureDate = $date . ' ' . $time;

    $data['departDate'] = date('Y-m-d H:i:s', strtotime($formattedDepartureDate)) ?: null;

}



if (!empty($bookingMatches['arrival_date'])) {

    $arrivalDate = $bookingMatches['arrival_date'];

    $dateParts = explode(" ", $arrivalDate);

    $date = $dateParts[0];

    $time = $dateParts[1] ?? '';



    $date = implode('-', array_reverse(explode('/', $date)));

    $formattedArrivalDate = $date . ' ' . $time;

    $data['returnDate'] = date('Y-m-d H:i:s', strtotime($formattedArrivalDate)) ?: null;

}



 

    // Split name into title, first name, and last name
    
    $fullname = $bookingMatches['meet_greet'] ?? '';
    $extracted_fullname = extractNameParts($fullname);

    $data['title'] = $extracted_fullname['title'] ?? '';

    $data['first_name'] = $extracted_fullname['first_name'] ?? '';

    $data['last_name'] = $extracted_fullname['last_name'] ?? '';
    
    

    // $nameParts = explode(' ', $bookingMatches['meet_greet'] ?? '');

    // $data['title'] = $nameParts[0] ?? '';

    // $data['first_name'] = $nameParts[0] ?? '';

    // $data['last_name'] = $nameParts[1] ?? '';



    // Calculate the number of days between departure and return

    if ($data['departDate'] && $data['returnDate']) {

        $earlier = new DateTime($data['departDate']);

        $later = new DateTime($data['returnDate']);

        $data['no_of_days'] = $later->diff($earlier)->format('%a');

    } else {

        $data['no_of_days'] = null; // Set to null if dates are invalid

    }



    // Additional static data

    // $data['companyId'] = 3;

    // $data['airportID'] = 1;

    // $data['booking_status'] = 'Completed';

    // $data['booking_action'] = 'Booked';

    // $data['traffic_src'] = 'Agent';

    // $data['payment_status'] = 'success';

    // $data['incomplete_email'] = 1;

    // $data['agentID'] = 26;
$data['cancelRequest'] = 1;


    // Clean up any extra spaces

    $data = array_map('trim', $data);



    return $data; // Return the cleaned and structured data

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
    
    function extractNameParts($fullName) {
        $fullName = trim($fullName); // Trim any extra spaces
         // Title list
        $titleList = ['Mr', 'Mrs', 'Ms', 'Dr', 'Prof', 'Miss', 'Mx', 'Sir', 'Dame', 'Lord', 'Lady', 'Rev', 'Fr', 'Br', 'Sr', 'Hon', 'Capt', 'Maj', 'Col', 'Gen', 'Lt', 'Adm', 'Cdr', 'Sgt'];
    
        // Remove commas and periods from the name
        $fullName = str_replace([',', '.'], '', $fullName); // Remove both commas and periods
    
        // Extract name parts
        $nameParts = explode(' ', $fullName);
        $title = '';
    
        // Check if the first part is a title
        if (in_array($nameParts[0], $titleList)) {
            // $title = $nameParts[0];
            $title = array_shift($nameParts); // Remove title from the name parts
        }
    
        $wordCount = count($nameParts);
    
        if ($wordCount % 2 == 0) { 
            // If evenly divisible, split equally
            $firstNameParts = $wordCount / 2;
        } else {
            // If odd, assign more words to first name
            $firstNameParts = ceil($wordCount / 2);
        }
    
        $firstName = implode(' ', array_slice($nameParts, 0, $firstNameParts));
        $lastName = implode(' ', array_slice($nameParts, $firstNameParts));
    
        return [
            'title' => $title,
            'first_name' => $firstName,
            'last_name' => $lastName
        ];
    }


    



mysqli_close($conn);



?>

