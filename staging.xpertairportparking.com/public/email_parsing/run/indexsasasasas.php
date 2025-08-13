<?php

$conn = mysqli_connect("localhost","manchesterairpor_usr","GZBFBlTLm0kI","manchesterairpor_database");
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


require_once("../PlancakeEmailParser.php");


ini_set('max_execution_time', '0'); // for infinite time of execution 


$emails = glob('../../../../mail/manchesterairportspaces.co.uk/agentbooking/new/*');
 
if(empty($emails)){
    $emails = glob('../../../../mail/manchesterairportspaces.co.uk/agentbooking/cur/*');
}
echo "<br>";

foreach($emails as $email) {
	$emailParser = new PlancakeEmailParser(file_get_contents($email));
	
	$to_arr = $emailParser->getTo();
	
	$to = mysqli_real_escape_string($conn, $to_arr[0]);
	
	$from_arr = $emailParser->getFrom();
	$from = $from_arr[0];
	$subject = $emailParser->getSubject();
	$subject=htmlentities($subject);
	$subject = mysqli_real_escape_string($conn, $subject);
	
	$body = $emailParser->getHTMLBody();
	$body = mysqli_real_escape_string($conn, $body);
	
	if($subject != 'Looking4.com - Hourly Order Report' && $subject != 'Looking4.com - Daily Order Report'){
    	$email_data = emailBreakdown($from,$body);
    	$ref_no = '';
    	if(isset($email_data)){
            $ref_no = $email_data['referenceNo'];
           
            $sql_count = mysqli_query($conn, "Select count(id) as total from airports_bookings where referenceNo = '".$ref_no."' ");
            
            $count = mysqli_fetch_assoc($sql_count);
            
            echo "count: ".$count['total']."<br>";
            
            if(isset($email_data['cancelRequest'])){
                $booking_status = mysqli_query($conn, "Select * from airports_bookings where referenceNo = '".$ref_no."' ");
                if($booking_status){
                    if($count['total'] > 0 && $booking_status->booking_status != 'Cancelled' && $email_data['cancelRequest'] == 1){
                            if($count['total'] > 0 && $email_data['cancelRequest'] == 1){
                                $referenceNo = $email_data['referenceNo'];
                                $sql = "UPDATE airports_bookings
                                SET booking_status = 'Cancelled', booking_action = 'Cancelled'
                                WHERE referenceNo = '$referenceNo'";
                                if (mysqli_query($conn,$sql) === TRUE) {
                                    echo "Record updated successfully";
                                }else {
                                    echo "Error updating record: " . $conn->error;
                                    
                                }
                            }
                        }
                }else{
                    file_put_contents("cronjob.txt","Req: ".date('Y-m-d H:i:s').'cancel request received but booking not found Ref:  '.$email_data['referenceNo']."\r\n",FILE_APPEND);
                }
    	}        
    // ********************************************************** Cancel Request code ended here **********************************************************    
            if (isset($email_data['amendRequest'])) {
                if ($count['total'] > 0 && $email_data['amendRequest'] == 1) {
                    $booking_status = mysqli_query($conn, "SELECT * FROM airports_bookings WHERE referenceNo = '" . $ref_no . "' ");
                    $row = mysqli_fetch_assoc($booking_status);
            
                    $referenceNo = $email_data['referenceNo'];
            
                    // Fetch the correct row from airports_bookings
                    $originalRowSql = "SELECT * FROM airports_bookings WHERE referenceNo = '$referenceNo'";
                    $originalRowResult = mysqli_query($conn, $originalRowSql);
                    $originalRow = mysqli_fetch_assoc($originalRowResult);
            
                    // Check if the referenceNo already exists in airports_bookings_temp
                    $tempCheckSql = "SELECT COUNT(*) as count FROM airports_bookings_temp WHERE referenceNo = '$referenceNo'";
                    $tempCheckResult = mysqli_query($conn, $tempCheckSql);
                    $tempCheckRow = mysqli_fetch_assoc($tempCheckResult);
            
                    if ($tempCheckRow['count'] > 0) {
                        // Update the existing record in airports_bookings_temp
                        $updateTempSql = "UPDATE airports_bookings_temp SET ";
            
                        foreach ($originalRow as $key => $value) {
                            // Check if the key exists in the table and is not 'referenceNo'
                            if ($key != 'referenceNo' && $key != 'id') {
                                // Add the key to the update query with proper quoting
                                $updateTempSql .= "`$key` = '" . mysqli_real_escape_string($conn, $value) . "', ";
                            }
                        }
            
                        // Remove the trailing comma and space
                        $updateTempSql = rtrim($updateTempSql, ', ');
            
                        // Add the WHERE clause to specify the row to update
                        $updateTempSql .= " WHERE referenceNo = '$referenceNo'";
            
                        // Execute the update query 
                        
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
                            if (array_key_exists($key, $row) && $key != 'referenceNo' && $key != 'amendRequest') {
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
                    if ($count['total'] == 0 && $email_data['amendRequest'] == 1 && $email_data['cancelRequest'] != 1) {
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
            
        // ********************************************************** Amend Request code ended here **********************************************************      
                    
            
                
            
                
                     
                
             

            
            if($count['total'] == 0 ){
                
            	$sql = "INSERT INTO parsed_emails (email_to, email_from, email_subject, email_body)
                VALUES ('".$to."', '".$from."', '".$subject."', '".$body."')";
                
                if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                    if($count['total'] == 0 && $email_data['amendRequest'] != 1 && $email_data['cancelRequest'] != 1){
                        $columns = implode(", ",array_keys($email_data));
                         $values  = implode("', '", array_values($email_data));
                        $sql_booking = "INSERT INTO airports_bookings (".$columns.")
                        VALUES ('".$values."')";
                        $run_query = mysqli_query($conn, $sql_booking);
                    }else{
                        file_put_contents("cronjob.txt","Req: ".date('Y-m-d H:i:s').'Message: Failed to create new booking. Ref:  '.$email_data['referenceNo']."\r\n",FILE_APPEND);
                    }
                } else {
                  echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
            
    	}
	}
	
}
file_put_contents("cronjob.txt","Req: ".date('Y-m-d H:i:s')."\r\n",FILE_APPEND);
function emailBreakdown($from,$body){
    
     
    
    
        if ($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body, 'noreply@compareparkingdeals.co.uk') == true && strpos($body, 'SERVICE INSTRUCTIONS') == false && strpos($body, 'Ammend') == false && strpos($body, 'Cancelled') == false) {
        // For Compare Parking Deals
        
        $parse_email_body = htmlentities($body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);                 
        $parse_email_body =  str_replace('&nbsp;', '', $parse_email_body);               
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('Â', '', $parse_email_body);
        $parse_email_body = str_replace('Ã‚', '', $parse_email_body);
        $parse_email_body = str_replace('£', '', $parse_email_body);
        $parse_email_body = explode('/tbody', $parse_email_body);
        $parse_email_body = strip_tags($parse_email_body[0]);
        
        // Initialize an array to store the matched values
        $matches = array();
        
        // Define the labels you want to extract, considering variations in formatting
        $labels = array(
            'Sent',
            'Airport',
            'Reference Code',
            'Company Name',
            'Name',
            'Contact No',
            'Model',
            'Make',
            'Colour',
            'Registration No.',
            'Departure Date/Time',
            'Departure Terminal',
            'Departure Flight no',
            'Arrival Date/Time',
            'Arrival Terminal',
            'Arrival Flight no',
            'Passengers',
            'Valeting',
            'Amount',
            'Booking Status',
            'Sent'
        );
        
        // Create an associative array to store the extracted data
        $new_data = array();
        
        // Combine the labels into a single pattern for matching, including variations
        $pattern = '@(' . implode('|', array_map('preg_quote', $labels)) . '):(.*?)(?=(' . implode('|', array_map('preg_quote', $labels)) . '|$))@s';
        
        if (preg_match_all($pattern, $parse_email_body, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $label = trim($match[1]);
                $value = trim($match[2]);
        
                // Extract date and time for the 'Sent' label
                if ($label === 'Sent') {
                    preg_match('/\b(\d{1,2} \w+ \d{4} \d{1,2}:\d{2}:\d{2})\b/', $value, $dateTimeMatch);
                    if (!empty($dateTimeMatch[1])) {
                        $new_data[$label] = $dateTimeMatch[1];
                    } else {
                        // Handle if no valid date and time is found
                        $new_data[$label] = date('Y-m-d H:i:s');
                    }
                } else {
                    $new_data[$label] = $value;
                }
            }
        }
        
        $dateTime = DateTime::createFromFormat('d M Y H:i:s', $new_data['Sent']);
        $created_at = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['Departure Date/Time']);
        $departDate = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['Arrival Date/Time']);
        $returnDate = $dateTime->format('Y-m-d H:i:s');
        
        $name = $new_data['Name'];
        $nameArray = explode(' ',$name);
        $title = $nameArray[0];
        $firstName = $nameArray[1];
        $lastName = $nameArray[2];
        
        $terminalMappings = [
            "Terminal 2" => '394',
            "Terminal 3" => '395',
            "Terminal 4" => '396',
            "Terminal 5" => '397',
            "2" => '394',
            "3" => '395',
            "4" => '396',
            "5" => '397',
        ];
        
        $data['referenceNo'] = $new_data['Reference Code'];
        $data['abookedCompany'] = $new_data['Company Name'];
        $data['departDate'] = $departDate;
        $data['returnDate'] = $returnDate;
        $data['deptFlight'] = $new_data['Departure Flight no'] ?? 'TBA';
        $data['deprTerminal'] = isset($new_data['Departure Terminal']) && array_key_exists($new_data['Departure Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Departure Terminal']] : 'TBA';
        $data['returnFlight'] = $new_data['Arrival Flight no'] ?? 'TBA';
        $data['returnTerminal'] = isset($new_data['Arrival Terminal']) && array_key_exists($new_data['Arrival Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Arrival Terminal']] : 'TBA';
        
        $data['title'] = $title;
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
        $data['phone_number'] = $new_data['Contact No'];
        $data['passenger'] = $new_data['Passengers'] ?? 'TBA';
        $data['model'] = $new_data['Model'] ?? 'TBA';
        $data['make'] = $new_data['Make'] ?? 'TBA';
        $data['color'] = $new_data['Colour'] ?? 'TBA';
        $data['registration'] = $new_data['Registration No.'] ?? 'TBA';
        $data['total_amount'] = str_replace('£','',$new_data['Amount']);
        $data['booking_amount'] = str_replace('£','',$new_data['Amount']);
        
        

        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['agentID'] = 6;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['payment_status'] = 'success';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
		$data['incomplete_sms'] = 1;
        $data['created_at'] = $created_at;
        
        
        // Now you have all the extracted information in the $data array  
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a")+1; //3
        
        
        $data = array_map('trim', $data);
        return $data;

    }
    
  
	if($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body,'notifications@meetandgreetreservations.net') == true && strpos($body,'Amendment') == false && strpos($body,'Cancelled') == false){
        
        $parse_email_body = strip_tags($body);
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); 
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('&amp;', '', $parse_email_body);
        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);
        $parse_email_body=  str_replace('&nbsp;','', $parse_email_body);
        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);
        $parse_array_aiport = explode('Email:',$parse_email_body);
        $parse_email_body = $parse_array_aiport[0];
        
        
        
        $parse_array_aiport = explode('Total Amount :',$parse_email_body);
        $data['total_amount'] = trim($parse_array_aiport[1]);
        $data['booking_amount'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Total Amount :'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Color :',$parse_email_body);
        $data['color'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Vehicle Color :'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Make :',$parse_email_body);
        $data['make'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Vehicle Make :'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Model:',$parse_email_body);
        $data['model'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Vehicle Model:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Registration:',$parse_email_body);
        $data['registration'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Vehicle Registration:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Terminal:',$parse_email_body);
        if($parse_array_aiport[1] == "Terminal 2"){
            $data['returnTerminal'] = '394';
        }elseif($parse_array_aiport[1] == "Terminal 3"){
            $data['returnTerminal'] = '395';
        }elseif($parse_array_aiport[1] == "Terminal 4"){
            $data['returnTerminal'] = '396';
        }else{
            $data['returnTerminal'] = '397';
        }
        $parse_email_body = str_replace('Inbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Terminal:',$parse_email_body);
        if($parse_array_aiport[1] == "Terminal 2"){
            $data['deprTerminal'] = '394';
        }elseif($parse_array_aiport[1] == "Terminal 3"){
            $data['deprTerminal'] = '395';
        }elseif($parse_array_aiport[1] == "Terminal 4"){
            $data['deprTerminal'] = '396';
        }else{
            $data['deprTerminal'] = '397';
        }
        $parse_email_body = str_replace('Outbound Terminal:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Flight No :',$parse_email_body);
        $data['returnFlight'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Inbound Flight No :'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Date / Time:',$parse_email_body);
        $data['created_at'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Booking Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Date / Time:',$parse_email_body);
        $data['returnDate'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Inbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Date / Time:',$parse_email_body);
        $data['departDate'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Outbound Date / Time:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Number Of days:',$parse_email_body);
        $data['no_of_days'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Number Of days:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Airport:',$parse_email_body);
        $data['airportID'] = 1;
        $parse_email_body = str_replace('Airport:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Parking Type:',$parse_email_body);
        $data['booked_type'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Parking Type:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Product Code:',$parse_email_body);
        $parse_email_body = str_replace('Product Code:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Company Name:',$parse_email_body);
        $data['abookedCompany'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Company Name:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Product Name:',$parse_email_body);
        $parse_email_body = str_replace('Product Name:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Telephone:',$parse_email_body);
        $data['phone_number'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Client Telephone:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Name:',$parse_email_body);
        $name_arr = explode(' ',trim($parse_array_aiport[1]));
        $data['first_name'] = $name_arr[0];
        $data['last_name'] = $name_arr[1];
        $parse_email_body = str_replace('Client Name:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Ref no:',$parse_email_body);
        $data['referenceNo'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Booking Ref no:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $data['companyId'] = 3;
        $data['agentID'] = 16;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['payment_status'] = 'success';
        $data['traffic_src'] = 'Agent';
		$data['incomplete_email'] = 1;
		$data['incomplete_sms'] = 1;
      
        $data = array_map('trim', $data);
        return $data;
    }
	if($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body,'pz@parkingzone.co.uk') == true && strpos($body,'Amendment') == false && strpos($body,'Cancelled') == false){
        
        $parse_email_body = strip_tags($body);
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);
        $parse_email_body = trim(preg_replace('/\s\s+/', '', $parse_email_body)); 
        $parse_email_body = str_replace('Â','', $parse_email_body);
        $parse_email_body=  str_replace('&nbsp;','', $parse_email_body);
        $parse_email_body=  str_replace('=C2=A0','', $parse_email_body);
        $parse_email_body=  str_replace('"\n','', $parse_email_body);
        $parse_email_body=  str_replace('=','', $parse_email_body);
        $parse_email_body=  str_replace('"','', $parse_email_body);
        $parse_email_body = str_replace('&nbsp=','', $parse_email_body);
        $parse_email_body = str_replace('&nbsp','', $parse_email_body);
        
        $terminalMappings = [
            "Terminal 2" => '394',
            "Terminal 3" => '395',
            "Terminal 4" => '396',
            "Terminal 5" => '397',
            "2" => '394',
            "3" => '395',
            "4" => '396',
            "5" => '397',
        ];
        
        $parse_array_aiport = explode('Total Amount',$parse_email_body);
        $amt = str_replace('&pound; ', '', $parse_array_aiport[1]);
        $amt = str_replace('\n', '', $amt);
        $data['total_amount'] = trim($amt);
        $data['booking_amount'] = trim($amt);
        $parse_email_body = str_replace('Total Amount'.$parse_array_aiport[1], '', $parse_email_body);
         
        $parse_array_aiport = explode('Vehicle Color',$parse_email_body);
        $color = str_replace('\n', '', $parse_array_aiport[1]);
        $data['color'] = trim($color);
        $parse_email_body = str_replace('Vehicle Color'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Make',$parse_email_body);
        $make = str_replace('\n', '', $parse_array_aiport[1]);
        $data['make'] = trim($make);
        $parse_email_body = str_replace('Vehicle Make'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Model',$parse_email_body);
        $model = str_replace('\n', '', $parse_array_aiport[1]);
        $data['model'] = trim($model);
        $parse_email_body = str_replace('Vehicle Model'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Registration',$parse_email_body);
        $reg = str_replace('\n', '', $parse_array_aiport[1]);
        $data['registration'] = trim($reg);
        $parse_email_body = str_replace('Vehicle Registration'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Date / Time',$parse_email_body);
        $bookingDate = $parse_array_aiport[1];
        $bookingDate = trim(str_replace('\n', '', $parse_array_aiport[1]));
        $data['created_at'] = $bookingDate;
        $parse_email_body = str_replace('Booking Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
    
        $parse_array_aiport = explode('Arrival Flight no',$parse_email_body);
        $retFlight = str_replace('\n', '', $parse_array_aiport[1]);
        $data['returnFlight'] = trim($retFlight);
        $parse_email_body = str_replace('Arrival Flight no'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Arrival Terminal',$parse_email_body);
        $retTerminal = str_replace('\n', '', trim($parse_array_aiport[1]));
        $data['returnTerminal'] = isset($retTerminal) && array_key_exists($retTerminal, $terminalMappings) ? $terminalMappings[$retTerminal] : 'TBA';
        $parse_email_body = str_replace('Arrival Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Arrival Date/Time',$parse_email_body);
        $date = $parse_array_aiport[1];
        
        $date = str_replace('\n', '', $date);
        $data['returnDate'] = date('Y-m-d H:i:s', strtotime($date));
        $parse_email_body = str_replace('Arrival Date/Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Departure Terminal',$parse_email_body);
        $depTerminla = str_replace('\n', '', $parse_array_aiport[1]);
        $data['deprTerminal'] = isset($depTerminla) && array_key_exists($depTerminla, $terminalMappings) ? $terminalMappings[$depTerminla] : 'TBA';
        $parse_email_body = str_replace('Departure Terminal'.$parse_array_aiport[1], '', $parse_email_body);
       
        $parse_array_aiport = explode('Departure Date/Time',$parse_email_body);
        $date = trim(str_replace('\n', '', $parse_array_aiport[1]));
        $data['departDate'] = date('Y-m-d H:i:s', strtotime($date));
        $parse_email_body = str_replace('Departure Date/Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Airport',$parse_email_body);
        $parse_email_body = str_replace('Airport'.$parse_array_aiport[1], '', $parse_email_body);   
        
        $parse_array_aiport = explode('Company Name',$parse_email_body);
        $data['abookedCompany'] = trim(str_replace('\n','',$parse_array_aiport[1]));
        $parse_email_body = str_replace('Company Name'.$parse_array_aiport[1], '', $parse_email_body);
     
        $parse_array_aiport = explode('Client Telephone',$parse_email_body);
        $phone = str_replace('\n', '', $parse_array_aiport[1]);
        $data['phone_number'] = trim($phone);
        $parse_email_body = str_replace('Client Telephone'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Name',$parse_email_body);
        $name = $parse_array_aiport[1];
        $name = trim(str_replace('\n', '', $name));
        $parse_email_body = str_replace('Client Name'.$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        
        $data['first_name'] = $name_arr[0];
        $data['last_name'] = $name_arr[1];
 
        $parse_array_aiport = explode('Booking Ref no',$parse_email_body);
        $parse_array_aiport = trim(str_replace('\n', '', $parse_array_aiport[1]));
        $data['referenceNo'] = strip_tags($parse_array_aiport);
        $parse_email_body = str_replace('Booking Ref no'.$parse_array_aiport[1], '', $parse_email_body);
        
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['agentID'] = 9;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['payment_status'] = 'success';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
        $data['incomplete_sms'] = 1;
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a")+1; //3
        return $data;
    }
	if($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body,'zmd@zmdtravel.net') == true && strpos($body,'Amendment') == false){
        
        $parse_email_body = strip_tags($body);
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);
        $parse_email_body = trim(preg_replace('/\s\s+/', '', $parse_email_body)); 
        $parse_email_body = str_replace('Â','', $parse_email_body);
        $parse_email_body=  str_replace('&nbsp;','', $parse_email_body);
        $parse_email_body=  str_replace('=C2=A0','', $parse_email_body);
        $parse_email_body=  str_replace('"\n','', $parse_email_body);
        $parse_email_body=  str_replace('=','', $parse_email_body);
        $parse_email_body=  str_replace('"','', $parse_email_body);
        $parse_email_body = str_replace('&nbsp=','', $parse_email_body);
        $parse_email_body = str_replace('&nbsp','', $parse_email_body);
        
        $terminalMappings = [
            "Terminal 2" => '394',
            "Terminal 3" => '395',
            "Terminal 4" => '396',
            "Terminal 5" => '397',
            "2" => '394',
            "3" => '395',
            "4" => '396',
            "5" => '397',
        ];
        
        $parse_array_aiport = explode('Total Amount',$parse_email_body);
        $amt = str_replace('&pound; ', '', $parse_array_aiport[1] ?? '');
        $amt = str_replace('\n', '', $amt ?? '');
        $data['total_amount'] = trim($amt);
        $data['booking_amount'] = trim($amt);
        $parse_email_body = str_replace('Total Amount'.$parse_array_aiport[1], '', $parse_email_body);
         
        $parse_array_aiport = explode('Vehicle Color',$parse_email_body);
        $color = str_replace('\n', '', $parse_array_aiport[1]);
        $data['color'] = trim($color);
        $parse_email_body = str_replace('Vehicle Color'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Make',$parse_email_body);
        $make = str_replace('\n', '', $parse_array_aiport[1] ?? '');
        $data['make'] = trim($make);
        $parse_email_body = str_replace('Vehicle Make'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Model',$parse_email_body);
        $model = str_replace('\n', '', $parse_array_aiport[1] ?? '');
        $data['model'] = trim($model);
        $parse_email_body = str_replace('Vehicle Model'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Vehicle Registration',$parse_email_body);
        $reg = str_replace('\n', '', $parse_array_aiport[1] ?? '');
        $data['registration'] = trim($reg);
        $parse_email_body = str_replace('Vehicle Registration'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Date / Time',$parse_email_body);
        $bookingDate = $parse_array_aiport[1];
        $bookingDate = trim(str_replace('\n', '', $parse_array_aiport[1] ?? ''));
        $data['created_at'] = $bookingDate;
        $parse_email_body = str_replace('Booking Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
    
        $parse_array_aiport = explode('Arrival Flight no',$parse_email_body);
        $retFlight = str_replace('\n', '', $parse_array_aiport[1] ?? '');
        $data['returnFlight'] = trim($retFlight);
        $parse_email_body = str_replace('Arrival Flight no'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Arrival Terminal',$parse_email_body);
        $retTerminal = str_replace('\n', '', trim($parse_array_aiport[1] ?? ''));
        $data['returnTerminal'] = isset($retTerminal) && array_key_exists($retTerminal, $terminalMappings) ? $terminalMappings[$retTerminal] : 'TBA';
        $parse_email_body = str_replace('Arrival Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Arrival Date/Time',$parse_email_body);
        $date = $parse_array_aiport[1];
        
        $date = str_replace('\n', '', $date ?? '');
        $data['returnDate'] = date('Y-m-d H:i:s', strtotime($date));
        $parse_email_body = str_replace('Arrival Date/Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Departure Terminal',$parse_email_body);
        $depTerminla = str_replace('\n', '', trim($parse_array_aiport[1] ?? ''));
        $data['deprTerminal'] = isset($depTerminla) && array_key_exists($depTerminla, $terminalMappings) ? $terminalMappings[$depTerminla] : 'TBA';
        $parse_email_body = str_replace('Departure Terminal'.$parse_array_aiport[1], '', $parse_email_body);
       
        $parse_array_aiport = explode('Departure Date/Time',$parse_email_body);
        $date = trim(str_replace('\n', '', $parse_array_aiport[1] ?? ''));
        $data['departDate'] = date('Y-m-d H:i:s', strtotime($date));
        $parse_email_body = str_replace('Departure Date/Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Airport',$parse_email_body);
        $parse_email_body = str_replace('Airport'.$parse_array_aiport[1], '', $parse_email_body);   
        
        $parse_array_aiport = explode('Company Name',$parse_email_body);
        $data['abookedCompany'] = trim(str_replace('\n','',$parse_array_aiport[1]));
        $parse_email_body = str_replace('Company Name'.$parse_array_aiport[1], '', $parse_email_body);
     
        $parse_array_aiport = explode('Client Telephone',$parse_email_body);
        $phone = str_replace('\n', '', $parse_array_aiport[1]);
        $data['phone_number'] = trim($phone);
        $parse_email_body = str_replace('Client Telephone'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Name',$parse_email_body);
        $name = $parse_array_aiport[1];
        $name = trim(str_replace('\n', '', $name ?? ''));
        $parse_email_body = str_replace('Client Name'.$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        
        $data['first_name'] = $name_arr[0];
        $data['last_name'] = $name_arr[1];
 
        $parse_array_aiport = explode('Booking Ref no',$parse_email_body);
        $parse_array_aiport = trim(str_replace('\n', '', $parse_array_aiport[1] ?? ''));
        $data['referenceNo'] = strip_tags($parse_array_aiport);
        $parse_email_body = str_replace('Booking Ref no'.$parse_array_aiport[1], '', $parse_email_body);
        
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['agentID'] = 8;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['payment_status'] = 'success';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
        $data['incomplete_sms'] = 1;
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a")+1; //3
        return $data;
    }
	
	if ($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body,'noreply@looking4parking.com') == true) {
	    
        $parse_email_body = htmlentities($body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);                 
        $parse_email_body =  str_replace('&nbsp;', '', $parse_email_body);               
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('Â', '', $parse_email_body);
        $parse_email_body = str_replace('£', '', $parse_email_body);
        $parse_email_body = str_replace('Add noreply@looking4parking.com to your contacts to ensure receipt of future emails.', '', $parse_email_body);
        $parse_email_body = explode('/tbody', $parse_email_body);
        $parse_email_body = strip_tags($parse_email_body[0]);
        
        

        // Initialize an array to store the matched values
        $matches = array();
        
        // Define the labels you want to extract, considering variations in formatting
        $labels = array(
            'Our Reference',
			'Car Park',
			'Location:',
			'Drop Off Date',
			'Return Date',
			'Outbound Flight Number',
			'Outbound Terminal',
			'Inbound Flight Number',
			'Inbound Terminal',
			'Name',
			'Contact Phone',
			'Passenger Number',
			'Make',
			'Model',
			'Colour',
			'Registration',
			'Price',
			'Sent'
        );
        
        // Create an associative array to store the extracted data
        $new_data = array();
        
        // Combine the labels into a single pattern for matching, including variations
        $pattern = '/(' . implode('|', array_map('preg_quote', $labels)) . '):(.*?)(?=(' . implode('|', array_map('preg_quote', $labels)) . '|$))/s';
        
        // Perform the regular expression match
        if (preg_match_all($pattern, $parse_email_body, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $label = trim($match[1]);
                $value = trim($match[2]);
        
                // Extract date and time for the 'Sent' label
                if ($label === 'Sent') {
                    preg_match('/\b(\d{1,2} \w+ \d{4} \d{1,2}:\d{2}:\d{2})\b/', $value, $dateTimeMatch);
                    if (!empty($dateTimeMatch[1])) {
                        $new_data[$label] = $dateTimeMatch[1];
                    } else {
                        // Handle if no valid date and time is found
                        $new_data[$label] = 'Invalid Date and Time';
                    }
                } else {
                    $new_data[$label] = $value;
                }
            }
        }
        
        $dateTime = DateTime::createFromFormat('d M Y H:i:s', $new_data['Sent']);
        $created_at = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d/m/Y H:i:s', $new_data['Drop Off Date']);
        $departDate = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d/m/Y H:i:s', $new_data['Return Date']);
        $returnDate = $dateTime->format('Y-m-d H:i:s');
        
        $name = $new_data['Name'];
        $nameArray = explode(' ',$name);
        $firstName = $nameArray[0];
        $lastName = $nameArray[1];
        
        $terminalMappings = [
            "Terminal 2" => '394',
            "Terminal 3" => '395',
            "Terminal 4" => '396',
            "Terminal 5" => '397',
            "2" => '394',
            "3" => '395',
            "4" => '396',
            "5" => '397',
        ];
        
        $data['referenceNo'] = $new_data['Our Reference'];
        $data['abookedCompany'] = $new_data['Car Park'];
        $data['departDate'] = $departDate;
        $data['returnDate'] = $returnDate;
        $data['deptFlight'] = $new_data['Outbound Flight Number'] ?? 'TBA';
        $data['deprTerminal'] = isset($new_data['Outbound Terminal']) && array_key_exists($new_data['Outbound Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Outbound Terminal']] : 'TBA';
        $data['returnFlight'] = $new_data['Inbound Flight Number'] ?? 'TBA';
        $data['returnTerminal'] = isset($new_data['Inbound Terminal']) && array_key_exists($new_data['Inbound Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Inbound Terminal']] : 'TBA';
        
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
        $data['phone_number'] = $new_data['Contact Phone'];
        $data['passenger'] = $new_data['Passenger Number'] ?? 'TBA';
        $data['make'] = $new_data['Make'] ?? 'TBA';
        $data['model'] = $new_data['Model'] ?? 'TBA';
        $data['color'] = $new_data['Colour'] ?? 'TBA';
        $data['registration'] = $new_data['Registration'] ?? 'TBA';
        $data['total_amount'] = str_replace('£','',$new_data['Price']);
        $data['booking_amount'] = str_replace('£','',$new_data['Price']);

        $data['companyId'] = 3;
        $data['airportID'] = 1;
        if(strpos($body,'SkyParkSecure') == true){
            $data['agentID'] = 19;
        }else{
            $data['agentID'] = 18;
        }
        // print_r('agent id: '.$data['agentID'] .'<br> body: '.$body);exit;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['payment_status'] = 'success';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
		$data['incomplete_sms'] = 1;
		$data['created_at'] = $created_at;

        // Now you have all the extracted information in the $data array  
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a")+1; //3
        $data = array_map('trim', $data);
        return $data;
    }
    if ($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body, 'noreply@parking4you.co.uk') == true  && strpos($body,'SERVICE INSTRUCTIONS') == false && strpos($body,'Cancelled') == false && strpos($body,'Amended') == false && strpos($body,'Mayfair') == false) {
        
        $parse_email_body = htmlentities($body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);                 
        $parse_email_body =  str_replace('&nbsp;', '', $parse_email_body);               
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('Â', '', $parse_email_body);
        $parse_email_body = str_replace('Ã‚', '', $parse_email_body);
        $parse_email_body = str_replace('£', '', $parse_email_body);
        $parse_email_body = str_replace('Add noreply@looking4parking.com to your contacts to ensure receipt of future emails.', '', $parse_email_body);
        $parse_email_body = explode('/tbody', $parse_email_body);
        $parse_email_body = strip_tags($parse_email_body[0]);
        
        // Initialize an array to store the matched values
        $matches = array();
        
        // Define the labels you want to extract, considering variations in formatting
        $labels = array(
            'Reference Code',
            'Company Name',
            'Name',
            'Contact No',
            'Model',
            'Make',
            'Colour',
            'Registration No.',
            'Departure Date/Time',
            'Departure Terminal',
            'Departure Flight no',
            'Arrival Date/Time',
            'Arrival Terminal',
            'Arrival Flight no',
            'Passengers',
            'Valeting',
            'Amount',
            'Booking Status',
            'Sent'
        );
        
        // Create an associative array to store the extracted data
        $new_data = array();
        
        // Combine the labels into a single pattern for matching, including variations
        $pattern = '@(' . implode('|', array_map('preg_quote', $labels)) . '):(.*?)(?=(' . implode('|', array_map('preg_quote', $labels)) . '|$))@s';
        
        if (preg_match_all($pattern, $parse_email_body, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $label = trim($match[1]);
                $value = trim($match[2]);
        
                // Extract date and time for the 'Sent' label
                if ($label === 'Sent') {
                    preg_match('/\b(\d{1,2} \w+ \d{4} \d{1,2}:\d{2}:\d{2})\b/', $value, $dateTimeMatch);
                    if (!empty($dateTimeMatch[1])) {
                        $new_data[$label] = $dateTimeMatch[1];
                    } else {
                        // Handle if no valid date and time is found
                        $new_data[$label] = 'Invalid Date and Time';
                    }
                } else {
                    $new_data[$label] = $value;
                }
            }
        }
        
        $dateTime = DateTime::createFromFormat('d M Y H:i:s', $new_data['Sent']);
        $created_at = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['Departure Date/Time']);
        $departDate = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['Arrival Date/Time']);
        $returnDate = $dateTime->format('Y-m-d H:i:s');
        
        $name = $new_data['Name'];
        $nameArray = explode(' ',$name);
        $title = $nameArray[0];
        $firstName = $nameArray[1];
        $lastName = $nameArray[2];
        
        $terminalMappings = [
            "Terminal 2" => '394',
            "Terminal 3" => '395',
            "Terminal 4" => '396',
            "Terminal 5" => '397',
            "2" => '394',
            "3" => '395',
            "4" => '396',
            "5" => '397',
        ];
        
        $data['referenceNo'] = $new_data['Reference Code'];
        $data['abookedCompany'] = $new_data['Company Name'];
        $data['departDate'] = $departDate;
        $data['returnDate'] = $returnDate;
        $data['deptFlight'] = $new_data['Departure Flight no'] ?? 'TBA';
        $data['deprTerminal'] = isset($new_data['Departure Terminal']) && array_key_exists($new_data['Departure Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Departure Terminal']] : 'TBA';
        $data['returnFlight'] = $new_data['Arrival Flight no'] ?? 'TBA';
        $data['returnTerminal'] = isset($new_data['Arrival Terminal']) && array_key_exists($new_data['Arrival Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Arrival Terminal']] : 'TBA';
        
        $data['title'] = $title;
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
        $data['phone_number'] = $new_data['Contact No'];
        $data['passenger'] = $new_data['Passengers'] ?? 'TBA';
        $data['model'] = $new_data['Model'] ?? 'TBA';
        $data['make'] = $new_data['Make'] ?? 'TBA';
        $data['color'] = $new_data['Colour'] ?? 'TBA';
        $data['registration'] = $new_data['Registration No.'] ?? 'TBA';
        $data['total_amount'] = str_replace('£','',$new_data['Amount']);
        $data['booking_amount'] = str_replace('£','',$new_data['Amount']);
        
        $data['companyId'] = 3;
        $data['airportID'] = 1;
        $data['agentID'] = 17;
        $data['booking_status'] = 'Completed';
        $data['booking_action'] = 'Booked';
        $data['payment_status'] = 'success';
        $data['traffic_src'] = 'Agent';
        $data['incomplete_email'] = 1;
		$data['incomplete_sms'] = 1;
        $data['created_at'] = $created_at;
        
        // Now you have all the extracted information in the $data array  
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a")+1; //3
        
        $data = array_map('trim', $data);
        return $data;
    }

    
	











// *********************************************** Cancellation Email Parsing Start ********************************************************










    if ($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body, 'info@parkandgo.co.uk') == true && strpos($body, 'Cancellation') == true) {
		// Parsing for L4P ref=L4P without terminals included
		
		$parse_email_body = strip_tags($body);
		$parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
		$parse_email_body = html_entity_decode($parse_email_body);
		$parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);
		$parse_email_body = str_replace('\n', '', $parse_email_body);
		$parse_email_body = str_replace('£', '', $parse_email_body);
		$parse_email_body = str_replace('&pound; ', '', $parse_email_body);
		$parse_email_body = str_replace('Ã,', '', $parse_email_body);
		$parse_email_body = str_replace('Ã', '', $parse_email_body);
		$parse_email_body = str_replace('\r', '', $parse_email_body);
		$parse_email_body = explode('Cancellation', $parse_email_body);
		$parse_email_body = $parse_email_body[1];
		$parse_array_aiport = explode('Booking Ref –', $parse_email_body);
		$referenceNo = trim($parse_array_aiport[1]);
		$referenceNo = preg_replace('/[^0-9]/', '', $referenceNo); // Extract only numeric characters
		$data['referenceNo'] = substr($referenceNo, 0, 8); // Get the first eight characters
		$parse_email_body = str_replace('Booking Ref –' . $parse_array_aiport[1], '', $parse_email_body);

		$data['cancelRequest'] = 1;

		$data = array_map('trim', $data);

		return $data;
	}
    if ($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body, 'booking@compareparkingdeals.co.uk') == true && strpos($body,'Cancelled') == true) {
		//Parsing for L4P ref=L4P with out terminals included
		$parse_email_body = strip_tags($body);
		$parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8'); 
		$parse_email_body = html_entity_decode($parse_email_body);
		$parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);
		$parse_email_body = str_replace('\n', '', $parse_email_body);
		$parse_email_body = str_replace('£', '', $parse_email_body);
		$parse_email_body = str_replace('&pound; ', '', $parse_email_body);
		$parse_email_body = str_replace('Ã,', '', $parse_email_body);
		$parse_email_body = str_replace('Ã', '', $parse_email_body);
		$parse_email_body = str_replace('\r', '', $parse_email_body);
		$parse_email_body = explode('Company Name:',$parse_email_body);
		$parse_email_body = $parse_email_body[0];
			$parse_array_aiport = explode('Reference Code:',$parse_email_body);
			$data['referenceNo'] = trim($parse_array_aiport[1]);
			$parse_email_body = str_replace('Reference Code:'.$parse_array_aiport[1], '', $parse_email_body);
			
			$data['cancelRequest'] = 1;
							
			$data = array_map('trim', $data);    
			
			return $data;
    

	}
	if($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body,'pz@parkingzone.co.uk') == true && strpos($body,'Amendment') == false && strpos($body,'Cancelled') == true){
        
        $parse_email_body = strip_tags($body);
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);
        $parse_email_body = trim(preg_replace('/\s\s+/', '', $parse_email_body)); 
        $parse_email_body = str_replace('Â','', $parse_email_body);
        $parse_email_body=  str_replace('&nbsp;','', $parse_email_body);
        $parse_email_body=  str_replace('=C2=A0','', $parse_email_body);
        $parse_email_body=  str_replace('"\n','', $parse_email_body);
        $parse_email_body=  str_replace('\n','', $parse_email_body);
        $parse_email_body=  str_replace('=','', $parse_email_body);
        $parse_email_body=  str_replace('"','', $parse_email_body);
        $parse_email_body = str_replace('&nbsp=','', $parse_email_body);
        // $parse_email_body = str_replace('__________________________________________________________________________','', $parse_email_body);
        $parse_email_body = str_replace('&nbsp','', $parse_email_body);
        $parse_email_body = explode('Client',$parse_email_body);
        $parse_email_body = $parse_email_body[0];

        $parse_array_aiport = explode('Booking Number:',$parse_email_body);
        $parse_array_aiport = trim(str_replace('\n', '', $parse_array_aiport[1]));
        $data['referenceNo'] = trim($parse_array_aiport);
        $parse_email_body = str_replace('Booking Number:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $data['cancelRequest'] = 1;
        $data = array_map('trim', $data);
        return $data;
    }
	if($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body,'notifications@meetandgreetreservations.net') == true && strpos($body,'Amendment') == false && strpos($body,'Cancelled') == true){
        
        $parse_email_body = strip_tags($body);
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); 
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('&amp;', '', $parse_email_body);
        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);
        $parse_email_body=  str_replace('&nbsp;','', $parse_email_body);
        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);
        $parse_array_aiport = explode('Regards',$parse_email_body);
        $parse_email_body = $parse_array_aiport[0];
        
        $parse_array_aiport = explode('Vehicle Registration No',$parse_email_body);
        $parse_email_body = str_replace('Vehicle Registration No'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Terminal',$parse_email_body);
        $parse_email_body = str_replace('Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Flight No',$parse_email_body);
        $parse_email_body = str_replace('Inbound Flight No'.$parse_array_aiport[1], '', $parse_email_body);  
        
        $parse_array_aiport = explode('Inbound Date / Time',$parse_email_body);
        $parse_email_body = str_replace('Inbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body); 
        
        $parse_array_aiport = explode('Outbound Date / Time',$parse_email_body);
        $parse_email_body = str_replace('Outbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body); 
        
        $parse_array_aiport = explode('Number Of days',$parse_email_body);
        $parse_email_body = str_replace('Number Of days'.$parse_array_aiport[1], '', $parse_email_body); 
        
        $parse_array_aiport = explode('Airport / Termainal',$parse_email_body);
        $parse_email_body = str_replace('Airport / Termainal'.$parse_array_aiport[1], '', $parse_email_body); 
        
        $parse_array_aiport = explode('Client',$parse_email_body);
        $parse_email_body = str_replace('Client'.$parse_array_aiport[1], '', $parse_email_body); 
        
        $parse_array_aiport = explode('Booking Number:',$parse_email_body);
        $data['referenceNo'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Booking Number:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $data['cancelRequest'] = 1;
        $data = array_map('trim', $data);
        
        return $data;
    }
	if ($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body, 'noreply@parking4you.co.uk') == true && strpos($body,'SERVICE INSTRUCTIONS') == false && strpos($body,'Mayfair') == false && strpos($body,'Cancelled') == true) {
		//Parsing for L4P ref=L4P with out terminals included
		$parse_email_body = strip_tags($body);
		$parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8'); 
		$parse_email_body = html_entity_decode($parse_email_body);
		$parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);
		$parse_email_body = str_replace('\n', '', $parse_email_body);
		$parse_email_body = str_replace('£', '', $parse_email_body);
		$parse_email_body = str_replace('&pound; ', '', $parse_email_body);
		$parse_email_body = str_replace('Ã,', '', $parse_email_body);
		$parse_email_body = str_replace('Ã', '', $parse_email_body);
		$parse_email_body = str_replace('\r', '', $parse_email_body);
		$parse_email_body = explode('Company Name:',$parse_email_body);
		$parse_email_body = $parse_email_body[0];
		
			$parse_array_aiport = explode('Reference Code:',$parse_email_body);
			$data['referenceNo'] = trim($parse_array_aiport[1]);
			$parse_email_body = str_replace('Reference Code:'.$parse_array_aiport[1], '', $parse_email_body);
			$data['cancelRequest'] = 1;
			$data = array_map('trim', $data);     
			return $data;
	}
	
	
	
	
	
	
	// *********************************************** Amendments Email Parsing Start ********************************************************
	
	

	    if(strpos($from,'M&G Reservations') == true   && strpos($body,'Amendment') == true && strpos($body,'Cancelled') == false){
	      
        $parse_email_body = strip_tags($body);
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body)); 
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('&amp;', '', $parse_email_body);
        $parse_email_body = str_replace('MG Reservations', '', $parse_email_body);
        $parse_email_body=  str_replace('&nbsp;','', $parse_email_body);
        $parse_email_body = str_replace('-------------------------------------------------------------------------------------------------------------------------------------', '', $parse_email_body);
        $parse_array_aiport = explode('Email:',$parse_email_body);
        $parse_email_body = $parse_array_aiport[0];
        
          
        $parse_array_aiport = explode('Additional Amount:',$parse_email_body);
        $parse_email_body = str_replace('Additional Amount:'.$parse_array_aiport[1], '', $parse_email_body);
        
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
        if($parse_array_aiport[1] == "Terminal 2"){
            $data['returnTerminal'] = '394';
        }elseif($parse_array_aiport[1] == "Terminal 3"){
            $data['returnTerminal'] = '395';
        }elseif($parse_array_aiport[1] == "Terminal 4"){
            $data['returnTerminal'] = '396';
        }else{
            $data['returnTerminal'] = '397';
        }
        $parse_email_body = str_replace('Inbound Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Terminal',$parse_email_body);
        if($parse_array_aiport[1] == "Terminal 2"){
            $data['deprTerminal'] = '394';
        }elseif($parse_array_aiport[1] == "Terminal 3"){
            $data['deprTerminal'] = '395';
        }elseif($parse_array_aiport[1] == "Terminal 4"){
            $data['deprTerminal'] = '396';
        }else{
            $data['deprTerminal'] = '397';
        }
        $parse_email_body = str_replace('Outbound Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Flight No',$parse_email_body);
        $data['returnFlight'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Inbound Flight No'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Date / Time',$parse_email_body);
        // $data['created_at'] = trim(date('Y-m-d H:i:s', strtotime($parse_array_aiport[1])));
        $parse_email_body = str_replace('Booking Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Date / Time',$parse_email_body);
        $data['returnDate'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Inbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Date / Time',$parse_email_body);
        $data['departDate'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Outbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Number Of days',$parse_email_body);
        $data['no_of_days'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Number Of days'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Airport',$parse_email_body);
        $data['airportID'] = 1;
        $parse_email_body = str_replace('Airport'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Parking Type',$parse_email_body);
        $data['booked_type'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Parking Type'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Company Name:',$parse_email_body);
        $data['abookedCompany'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Company Name:'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('CarPark Name',$parse_email_body);
        $parse_email_body = str_replace('CarPark Name'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Telephone',$parse_email_body);
        $data['phone_number'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Client Telephone'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Name',$parse_email_body);
        $name_arr = explode(' ',trim($parse_array_aiport[1]));
        $data['first_name'] = $name_arr[0];
        $data['last_name'] = $name_arr[1];
        $parse_email_body = str_replace('Client Name'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Ref no',$parse_email_body);
        $data['referenceNo'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Booking Ref no'.$parse_array_aiport[1], '', $parse_email_body);
         

        $data['booking_action'] = 'Amend';
        $data['amendRequest'] = 1;
        $data = array_map('trim', $data);
        
        return $data;
       
    }
    if($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body,'pz@parkingzone.co.uk') == true && strpos($body,'Amendment') == true && strpos($body,'Cancelled') == false){
        
        $parse_email_body = strip_tags($body);
        $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);
        $parse_email_body = trim(preg_replace('/\s\s+/', '', $parse_email_body)); 
        $parse_email_body = str_replace('Â','', $parse_email_body);
        $parse_email_body=  str_replace('&nbsp;','', $parse_email_body);
        $parse_email_body=  str_replace('=C2=A0','', $parse_email_body);
        $parse_email_body=  str_replace('"\n','', $parse_email_body);
        $parse_email_body=  str_replace('\n','', $parse_email_body);
        $parse_email_body=  str_replace('=','', $parse_email_body);
        $parse_email_body=  str_replace('"','', $parse_email_body);
        $parse_email_body = str_replace('&nbsp=','', $parse_email_body);
        $parse_email_body = str_replace('&nbsp','', $parse_email_body);
        $parse_email_body = explode('__________________________________________________________________________',$parse_email_body);
        $parse_email_body = $parse_email_body[0];
        
        $terminalMappings = [
            "Terminal 2" => '394',
            "Terminal 3" => '395',
            "Terminal 4" => '396',
            "Terminal 5" => '397',
            "2" => '394',
            "3" => '395',
            "4" => '396',
            "5" => '397',
        ];
        
        $parse_array_aiport = explode('Additional Amount:',$parse_email_body);
        $data['booking_extra'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Additional Amount:'.$parse_array_aiport[1], '', $parse_email_body);
         
        $parse_array_aiport = explode('Booking Amout',$parse_email_body);
        $parse_email_body = str_replace('Booking Amout'.$parse_array_aiport[1], '', $parse_email_body);
        
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
        $retTerminal = trim($parse_array_aiport[1]);
        $data['returnTerminal'] = isset($retTerminal) && array_key_exists($retTerminal, $terminalMappings) ? $terminalMappings[$retTerminal] : 'TBA';
        $parse_email_body = str_replace('Inbound Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Terminal',$parse_email_body);
        $depTerminla = trim($parse_array_aiport[1]);
        $data['deprTerminal'] = isset($depTerminla) && array_key_exists($depTerminla, $terminalMappings) ? $terminalMappings[$depTerminla] : 'TBA';
        $parse_email_body = str_replace('Outbound Terminal'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Flight No',$parse_email_body);
        $data['returnFlight'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Inbound Flight No'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Booking Date / Time',$parse_email_body);
        $parse_email_body = str_replace('Booking Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Inbound Date / Time',$parse_email_body);
        $data['returnDate'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Inbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Outbound Date / Time',$parse_email_body);
        $data['departDate'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Outbound Date / Time'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Number Of days',$parse_email_body);
        $data['no_of_days'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Number Of days'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Airport',$parse_email_body);
        $parse_email_body = str_replace('Airport'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Parking Type',$parse_email_body);
        $parse_email_body = str_replace('Parking Type'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('CarPark Name',$parse_email_body);
        $parse_email_body = str_replace('CarPark Name'.$parse_array_aiport[1], '', $parse_email_body);
       
        $parse_array_aiport = explode('Client Telephone',$parse_email_body);
        $data['phone_number'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Client Telephone'.$parse_array_aiport[1], '', $parse_email_body);
        
        $parse_array_aiport = explode('Client Name',$parse_email_body);
        $name = $parse_array_aiport[1];
        $name = trim(str_replace('\n', '', $name));
        $parse_email_body = str_replace('Client Name'.$parse_array_aiport[1], '', $parse_email_body);
        $name_arr = explode(' ',$name);
        $data['first_name'] = $name_arr[0];
        $data['last_name'] = $name_arr[1];
        
        $parse_array_aiport = explode('Booking Ref no',$parse_email_body);
        $data['referenceNo'] = trim($parse_array_aiport[1]);
        $parse_email_body = str_replace('Booking Ref no'.$parse_array_aiport[1], '', $parse_email_body);

        $data['booking_action'] = 'Amend';
        $data['amendRequest'] = 1;
        $data = array_map('trim', $data);
        
        return $data;
    }
    if ($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body, 'noreply@compareparkingdeals.co.uk') == true && strpos($body, 'Ammend') == true  && strpos($body, 'CPD-1-466657') == false ) {
        // For Compare Parking Deals
        $parse_email_body = htmlentities($body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);                 
        $parse_email_body =  str_replace('&nbsp;', '', $parse_email_body);               
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('Â', '', $parse_email_body);
        $parse_email_body = str_replace('Ã‚', '', $parse_email_body);
        $parse_email_body = str_replace('£', '', $parse_email_body);
        $parse_email_body = explode('/tbody', $parse_email_body);
        $parse_email_body = strip_tags($parse_email_body[0]);
        
        // Initialize an array to store the matched values
        $matches = array();
        
        // Define the labels you want to extract, considering variations in formatting
        $labels = array(
            'Sent',
            'Airport',
            'Reference Code',
            'Company Name',
            'Name',
            'Contact No',
            'Model',
            'Make',
            'Colour',
            'Registration No.',
            'Departure Date/Time',
            'Departure Terminal',
            'Departure Flight no',
            'Arrival Date/Time',
            'Arrival Terminal',
            'Arrival Flight no',
            'Passengers',
            'Valeting',
            'Amount',
            'Booking Status',
            'Sent'
        );
        
        // Create an associative array to store the extracted data
        $new_data = array();
        
        // Combine the labels into a single pattern for matching, including variations
        $pattern = '@(' . implode('|', array_map('preg_quote', $labels)) . '):(.*?)(?=(' . implode('|', array_map('preg_quote', $labels)) . '|$))@s';
        
        if (preg_match_all($pattern, $parse_email_body, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $label = trim($match[1]);
                $value = trim($match[2]);
        
                // Extract date and time for the 'Sent' label
                if ($label === 'Sent') {
                    preg_match('/\b(\d{1,2} \w+ \d{4} \d{1,2}:\d{2}:\d{2})\b/', $value, $dateTimeMatch);
                    if (!empty($dateTimeMatch[1])) {
                        $new_data[$label] = $dateTimeMatch[1];
                    } else {
                        // Handle if no valid date and time is found
                        $new_data[$label] = date('Y-m-d H:i:s');
                    }
                } else {
                    $new_data[$label] = $value;
                }
            }
        }
        
        $dateTime = DateTime::createFromFormat('d M Y H:i:s', $new_data['Sent']);
        $created_at = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['Departure Date/Time']);
        $departDate = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['Arrival Date/Time']);
        $returnDate = $dateTime->format('Y-m-d H:i:s');
        
        $name = $new_data['Name'];
        $nameArray = explode(' ',$name);
        $title = $nameArray[0];
        $firstName = $nameArray[1];
        $lastName = $nameArray[2];
        
        $terminalMappings = [
            "Terminal 2" => '394',
            "Terminal 3" => '395',
            "Terminal 4" => '396',
            "Terminal 5" => '397',
            "2" => '394',
            "3" => '395',
            "4" => '396',
            "5" => '397',
        ];
        
        $data['referenceNo'] = $new_data['Reference Code'];
        $data['abookedCompany'] = $new_data['Company Name'];
        $data['departDate'] = $departDate;
        $data['returnDate'] = $returnDate;
        $data['deptFlight'] = $new_data['Departure Flight no'] ?? 'TBA';
        $data['deprTerminal'] = isset($new_data['Departure Terminal']) && array_key_exists($new_data['Departure Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Departure Terminal']] : 'TBA';
        $data['returnFlight'] = $new_data['Arrival Flight no'] ?? 'TBA';
        $data['returnTerminal'] = isset($new_data['Arrival Terminal']) && array_key_exists($new_data['Arrival Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Arrival Terminal']] : 'TBA';
        
        $data['title'] = $title;
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
        $data['phone_number'] = $new_data['Contact No'];
        $data['passenger'] = $new_data['Passengers'] ?? 'TBA';
        $data['model'] = $new_data['Model'] ?? 'TBA';
        $data['make'] = $new_data['Make'] ?? 'TBA';
        $data['color'] = $new_data['Colour'] ?? 'TBA';
        $data['registration'] = $new_data['Registration No.'] ?? 'TBA';
        $data['total_amount'] = str_replace('£','',$new_data['Amount']);
        $data['booking_amount'] = str_replace('£','',$new_data['Amount']);
        
        $data['booking_action'] = 'Amend';
        $data['amendRequest'] = 1;
        
        
        // Now you have all the extracted information in the $data array  
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a")+1; //3
        $data = array_map('trim', $data);
        return $data;

    }
    if ($from == 'agentbooking manchesterairportspaces.co.uk <agentbooking@manchesterairportspaces.co.uk>' && strpos($body, 'noreply@parking4you.co.uk') == true && strpos($body,'SERVICE INSTRUCTIONS') == false && strpos($body,'Cancelled') == false && strpos($body,'Amended') == true && strpos($body,'Mayfair') == false) {
        $parse_email_body = htmlentities($body, ENT_QUOTES, 'utf-8');
        $parse_email_body = html_entity_decode($parse_email_body);                 
        $parse_email_body =  str_replace('&nbsp;', '', $parse_email_body);               
        $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
        $parse_email_body = str_replace('\n', '', $parse_email_body);
        $parse_email_body = str_replace('Â', '', $parse_email_body);
        $parse_email_body = str_replace('Ã‚', '', $parse_email_body);
        $parse_email_body = str_replace('£', '', $parse_email_body);
        $parse_email_body = str_replace('Add noreply@looking4parking.com to your contacts to ensure receipt of future emails.', '', $parse_email_body);
        $parse_email_body = explode('/tbody', $parse_email_body);
        $parse_email_body = strip_tags($parse_email_body[0]);
        
        // Initialize an array to store the matched values
        $matches = array();
        
        // Define the labels you want to extract, considering variations in formatting
        $labels = array(
            'Reference Code',
            'Company Name',
            'Name',
            'Contact No',
            'Model',
            'Make',
            'Colour',
            'Registration No.',
            'Departure Date/Time',
            'Departure Terminal',
            'Departure Flight no',
            'Arrival Date/Time',
            'Arrival Terminal',
            'Arrival Flight no',
            'Passengers',
            'Valeting',
            'Amount',
            'Booking Status',
            'Sent'
        );
        
        // Create an associative array to store the extracted data
        $new_data = array();
        
        // Combine the labels into a single pattern for matching, including variations
        $pattern = '@(' . implode('|', array_map('preg_quote', $labels)) . '):(.*?)(?=(' . implode('|', array_map('preg_quote', $labels)) . '|$))@s';
        
        if (preg_match_all($pattern, $parse_email_body, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $label = trim($match[1]);
                $value = trim($match[2]);
        
                // Extract date and time for the 'Sent' label
                if ($label === 'Sent') {
                    preg_match('/\b(\d{1,2} \w+ \d{4} \d{1,2}:\d{2}:\d{2})\b/', $value, $dateTimeMatch);
                    if (!empty($dateTimeMatch[1])) {
                        $new_data[$label] = $dateTimeMatch[1];
                    } else {
                        // Handle if no valid date and time is found
                        $new_data[$label] = 'Invalid Date and Time';
                    }
                } else {
                    $new_data[$label] = $value;
                }
            }
        }
        
        $dateTime = DateTime::createFromFormat('d M Y H:i:s', $new_data['Sent']);
        $created_at = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['Departure Date/Time']);
        $departDate = $dateTime->format('Y-m-d H:i:s');
        
        $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['Arrival Date/Time']);
        $returnDate = $dateTime->format('Y-m-d H:i:s');
        
        $name = $new_data['Name'];
        $nameArray = explode(' ',$name);
        $title = $nameArray[0];
        $firstName = $nameArray[1];
        $lastName = $nameArray[2];
        
        $terminalMappings = [
            "Terminal 2" => '394',
            "Terminal 3" => '395',
            "Terminal 4" => '396',
            "Terminal 5" => '397',
            "2" => '394',
            "3" => '395',
            "4" => '396',
            "5" => '397',
        ];
        $data['referenceNo'] = $new_data['Reference Code'];
        $data['abookedCompany'] = $new_data['Company Name'];
        $data['departDate'] = $departDate;
        $data['returnDate'] = $returnDate;
        $data['deptFlight'] = $new_data['Departure Flight no'] ?? 'TBA';
        $data['deprTerminal'] = isset($new_data['Departure Terminal']) && array_key_exists($new_data['Departure Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Departure Terminal']] : 'TBA';
        $data['returnFlight'] = $new_data['Arrival Flight no'] ?? 'TBA';
        $data['returnTerminal'] = isset($new_data['Arrival Terminal']) && array_key_exists($new_data['Arrival Terminal'], $terminalMappings) ? $terminalMappings[$new_data['Arrival Terminal']] : 'TBA';
        
        $data['title'] = $title;
        $data['first_name'] = $firstName;
        $data['last_name'] = $lastName;
        $data['phone_number'] = $new_data['Contact No'];
        $data['passenger'] = $new_data['Passengers'] ?? 'TBA';
        $data['model'] = $new_data['Model'] ?? 'TBA';
        $data['make'] = $new_data['Make'] ?? 'TBA';
        $data['color'] = $new_data['Colour'] ?? 'TBA';
        $data['registration'] = $new_data['Registration No.'] ?? 'TBA';
        $data['total_amount'] = str_replace('£','',$new_data['Amount']);
        $data['booking_amount'] = str_replace('£','',$new_data['Amount']);
        
        
        $data['booking_action'] = 'Amend';
        $data['amendRequest'] = 1;
        
        // Now you have all the extracted information in the $data array  
        
        $earlier = new DateTime($data['departDate']);
        $later = new DateTime($data['returnDate']);
        $data['no_of_days'] = $later->diff($earlier)->format("%a")+1; //3
        
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