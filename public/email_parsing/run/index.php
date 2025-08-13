<?php

$conn = mysqli_connect("localhost", "xpertairportpark_newxpert_db", "ES*.%9?Ogav]guwH", "xpertairportpark_newxpert_db");
// Check connection

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());
}



require_once("../PlancakeEmailParser.php");





ini_set('max_execution_time', '0'); // for infinite time of execution 







$emails = glob('../../../../mail/xpertairportparking.com/agentbookings/cur/*');


if (empty($emails)) {

    $emails = glob(

        "../../../../mail/manchesterairportspaces.co.uk/agentbooking/cur/*"

    );

    rsort($emails);
}



echo "<br>";



foreach ($emails as $email) {

    $cron_start_time = date("Y-m-d H:i:s"); // Start time of the cron job for this booking



    $emailParser = new PlancakeEmailParser(file_get_contents($email));



    $to_arr = $emailParser->getTo();



    $to = mysqli_real_escape_string($conn, $to_arr[0]);





    $from_arr = $emailParser->getFrom();

    $from = $from_arr[0];



    $sender_email = '';

    if (preg_match('/<(.+?)>/', $from, $matches)) {

        $sender_email = $matches[1];
    } else {

        $sender_email = $from;
    }



    $sender_email = mysqli_real_escape_string($conn, $sender_email);

    $subject = $emailParser->getSubject();



    $subject = htmlentities($subject);



    $subject = mysqli_real_escape_string($conn, $subject);

    $date_time = $emailParser->getHeader('Date');



    if ($date_time) {

        $date = DateTime::createFromFormat('D, d M Y H:i:s O', $date_time);



        if ($date) {

            $date_time = $date->format('Y-m-d H:i:s');
        } else {

            $date_time = date('Y-m-d H:i:s');
        }



        $date_time = mysqli_real_escape_string($conn, $date_time);
    } else {

        $date_time = date('Y-m-d H:i:s');
    }





    $body = $emailParser->getHTMLBody();



    $body = mysqli_real_escape_string($conn, $body);



    if (

        $subject != "Looking4.com - Hourly Order Report" &&

        $subject != "Looking4.com - Daily Order Report"

    ) {

        $email_data = emailBreakdown($from, $body, $subject, $date_time);



        $ref_no = "";



        if (isset($email_data)) {

            $body = mb_convert_encoding($body, "UTF-8", "ISO-8859-1");



            $body = str_replace("Â", "", $body);



            mysqli_set_charset($conn, "utf8mb4");



            $ref_no = $email_data["referenceNo"];



            $sql_count = mysqli_query(

                $conn,

                "Select count(id) as total from airports_bookings where referenceNo = '" .

                    $ref_no .

                    "' "

            );



            $count = mysqli_fetch_assoc($sql_count);



            echo "count: " . $count["total"] . "<br>";

            if (isset($email_data["cancelRequest"])) {

                $booking_status = mysqli_query(

                    $conn,

                    "Select * from airports_bookings where referenceNo = '" .

                        $ref_no .

                        "' "

                );


                if ($booking_status) {

                    if (

                        $count["total"] > 0 &&

                        $booking_status->booking_status != "Cancelled" &&

                        $email_data["cancelRequest"] == 1

                    ) {

                        if (

                            $count["total"] > 0 &&

                            $email_data["cancelRequest"] == 1

                        ) {

                            $referenceNo = $email_data["referenceNo"];
                            
                            $sql = "UPDATE airports_bookings

                                    SET booking_status = 'Cancelled', booking_action = 'Cancelled'

                                    WHERE referenceNo = '$referenceNo'";



                            if (mysqli_query($conn, $sql) === true) {

                                echo "Record updated successfully";
                            } else {

                                echo "Error updating record: " . $conn->error;
                            }
                        }
                    }
                } else {

                    file_put_contents(

                        "cronjob.txt",

                        "Req: " .

                            date("Y-m-d H:i:s") .

                            "cancel request received but booking not found Ref:  " .

                            $email_data["referenceNo"] .

                            "\r\n",

                        FILE_APPEND

                    );
                }
            }

            if (isset($email_data["amendRequest"])) {

                if ($count["total"] > 0 && $email_data["amendRequest"] == 1) {

                    $booking_status = mysqli_query(

                        $conn,

                        "SELECT * FROM airports_bookings WHERE referenceNo = '" .

                            $ref_no .

                            "' "

                    );



                    $row = mysqli_fetch_assoc($booking_status);



                    $referenceNo = $email_data["referenceNo"];



                    $originalRowSql = "SELECT * FROM airports_bookings WHERE referenceNo = '$referenceNo'";



                    $originalRowResult = mysqli_query($conn, $originalRowSql);



                    $originalRow = mysqli_fetch_assoc($originalRowResult);



                    $tempCheckSql = "SELECT COUNT(*) as count FROM airports_bookings_temp WHERE referenceNo = '$referenceNo'";



                    $tempCheckResult = mysqli_query($conn, $tempCheckSql);



                    $tempCheckRow = mysqli_fetch_assoc($tempCheckResult);



                    if ($tempCheckRow["count"] > 0) {

                        $updateTempSql = "UPDATE airports_bookings_temp SET ";



                        foreach ($originalRow as $key => $value) {

                            if ($key != "referenceNo" && $key != "id") {

                                $updateTempSql .=

                                    "`$key` = '" .

                                    mysqli_real_escape_string($conn, $value) .

                                    "', ";
                            }
                        }



                        $updateTempSql = rtrim($updateTempSql, ", ");



                        $updateTempSql .= " WHERE referenceNo = '$referenceNo'";



                        try {

                            $updateTempResult = mysqli_query(

                                $conn,

                                $updateTempSql

                            );
                        } catch (Exception $e) {

                            file_put_contents(

                                "cronjob.txt",

                                "Req: " .

                                    date("Y-m-d H:i:s") .

                                    "Error updating record in airports_bookings_temp:  " .

                                    $referenceNo .

                                    "\r\n" .

                                    $e->getMessage() .

                                    "\r\n",

                                FILE_APPEND

                            );
                        }



                        if (!$updateTempResult) {

                            echo "Error updating record in airports_bookings_temp: " .

                                mysqli_error($conn);



                            exit();
                        }



                        echo "Update in airports_bookings_temp successful!";
                    } else {

                        $columns = array_filter(

                            array_keys($originalRow),

                            function ($column) {

                                return $column != "id";
                            }

                        );



                        $copyTempSql =

                            "INSERT INTO airports_bookings_temp (" .

                            implode(", ", $columns) .

                            ") 



                                            SELECT " .

                            implode(

                                ", ",

                                array_map(function ($column) use ($originalRow, $conn) {

                                    return "'" .

                                        mysqli_real_escape_string(

                                            $conn,

                                            $originalRow[$column]

                                        ) .

                                        "'";
                                }, $columns)

                            ) .

                            " 



                                            FROM airports_bookings 



                                            WHERE referenceNo = '$referenceNo'";



                        $copyTempResult = mysqli_query($conn, $copyTempSql);



                        if (!$copyTempResult) {

                            echo "Error copying record to airports_bookings_temp: " .

                                mysqli_error($conn);



                            exit();
                        }



                        echo "Insert into airports_bookings_temp successful!";
                    }



                    $updateSql = "UPDATE airports_bookings SET ";



                    foreach ($email_data as $key => $value) {

                        if (

                            array_key_exists($key, $row) &&

                            $key != "referenceNo" &&

                            $key != "amendRequest"

                        ) {

                            $escapedValue =

                                $value !== null

                                ? "'" .

                                mysqli_real_escape_string(

                                    $conn,

                                    $value

                                ) .

                                "'"

                                : "NULL";



                            $updateSql .= "`$key` = $escapedValue, ";
                        }
                    }



                    $updateSql = rtrim($updateSql, ", ");



                    $updateSql .= " WHERE referenceNo = '$referenceNo'";



                    $updateResult = mysqli_query($conn, $updateSql);



                    if ($updateResult) {

                        echo "Update in airports_bookings successful!";
                    } else {

                        echo "Error updating record in airports_bookings: " . mysqli_error($conn);
                    }



                    $reportSql = "UPDATE parsed_emails_report 

                                      SET booking_type = 1,

                                       booking_email_time = '$date_time', 

                                    cron_start_time = '$cron_start_time', 

                                      cron_end_time = '$cron_end_time'

                                      WHERE ref_no = '$referenceNo'";



                    $reportResult = mysqli_query($conn, $reportSql);



                    if ($reportResult) {

                        echo "Update in parsed_emails_report successful!";
                    } else {

                        echo "Error updating record in parsed_emails_report: " . mysqli_error($conn);
                    }
                } else {

                    if (

                        $count["total"] == 0 &&

                        $email_data["amendRequest"] == 1 &&

                        $email_data["cancelRequest"] != 1

                    ) {

                        $referenceNo = $email_data["referenceNo"];



                        $columns = [];



                        $values = [];



                        foreach ($email_data as $key => $value) {

                            if ($key != "amendRequest") {

                                $escapedValue =

                                    $value !== null

                                    ? "'" .

                                    mysqli_real_escape_string(

                                        $conn,

                                        $value

                                    ) .

                                    "'"

                                    : "NULL";



                                $columns[] = "`$key`";



                                $values[] = $escapedValue;
                            }
                        }



                        $sql_booking =

                            "INSERT INTO airports_bookings (" .

                            implode(", ", $columns) .

                            ") VALUES (" .

                            implode(", ", $values) .

                            ")";



                        $run_query = mysqli_query($conn, $sql_booking);
                    } else {

                        file_put_contents(

                            "cronjob.txt",

                            "Req: " .

                                date("Y-m-d H:i:s") .

                                "Message: Failed to create new booking. Ref:  " .

                                $email_data["referenceNo"] .

                                "\r\n",

                            FILE_APPEND

                        );
                    }
                }
            }





            if ($count["total"] == 0 && $email_data['referenceNo']!=="") {

                $originalRowSqls = "SELECT * FROM parsed_emails WHERE email_subject = '$subject'";

                $result = mysqli_query($conn, $originalRowSqls);



                if (mysqli_num_rows($result) > 0) {

                    echo "New record created successfully";



                    unset($email_data['cancelRequest']);

                    $columns = implode(", ", array_keys($email_data));

                    $values = implode("', '", array_values($email_data));



                    $sql_booking = "INSERT INTO airports_bookings ($columns) VALUES ('$values')";



                    if (mysqli_query($conn, $sql_booking)) {

                        echo "Booking record created successfully";

                        $ref_no = $email_data['referenceNo'] ?? null;

                        $phone_number = $email_data['phone_number'] ?? null;

                        $cron_end_time = date("Y-m-d H:i:s");



                        $parsed_emails_report_ref = "SELECT * FROM parsed_emails_report WHERE ref_no = '$ref_no'";

                        $resultss = mysqli_query($conn, $parsed_emails_report_ref);

                        if (mysqli_num_rows($result) == 0) {

                            $report_sql = "INSERT INTO parsed_emails_report (ref_no, agent_email, phone_number, booking_email_time, cron_start_time, cron_end_time,booking_type, status)

                                           VALUES ('$ref_no', '$sender_email', '$phone_number', '$date_time', '$cron_start_time', '$cron_end_time',0,0)";

                            mysqli_query($conn, $report_sql);
                        }
                    } else {

                        echo "Error: " . $sql_booking . "<br>" . $conn->error;
                    }
                } else {

                    $sql = "INSERT INTO parsed_emails (email_to, email_from, email_subject, email_body)

                                VALUES ('$to', '$from', '$subject', '$body')";



                    if (mysqli_query($conn, $sql)) {

                        echo "New record created successfully";



                        unset($email_data['cancelRequest']);

                        $columns = implode(", ", array_keys($email_data));

                        $values = implode("', '", array_values($email_data));



                        $sql_booking = "INSERT INTO airports_bookings ($columns) VALUES ('$values')";



                        if (mysqli_query($conn, $sql_booking)) {

                            echo "Booking record created successfully";



                            $ref_no = $email_data['referenceNo'] ?? null;

                            $phone_number = $email_data['phone_number'] ?? null;

                            $cron_end_time = date("Y-m-d H:i:s");

                            $parsed_emails_report_ref = "SELECT * FROM parsed_emails_report WHERE ref_no = '$ref_no'";

                            $resultss = mysqli_query($conn, $parsed_emails_report_ref);

                            if (mysqli_num_rows($result) == 0) {

                                $report_sql = "INSERT INTO parsed_emails_report (ref_no, agent_email, phone_number, booking_email_time, cron_start_time, cron_end_time,booking_type, status)

                                               VALUES ('$ref_no', '$sender_email', '$phone_number', '$date_time', '$cron_start_time', '$cron_end_time',0,0)";

                                mysqli_query($conn, $report_sql);
                            }
                        } else {

                            echo "Error: " . $sql_booking . "<br>" . $conn->error;



                            $ref_no = $email_data['referenceNo'] ?? null;

                            $phone_number = $email_data['phone_number'] ?? null;

                            $cron_end_time = date("Y-m-d H:i:s");



                            $parsed_emails_report_ref = "SELECT * FROM parsed_emails_report WHERE ref_no = '$ref_no'";

                            $resultss = mysqli_query($conn, $parsed_emails_report_ref);

                            if (mysqli_num_rows($result) == 0) {

                                $report_sql = "INSERT INTO parsed_emails_report (ref_no, agent_email, phone_number, booking_email_time, cron_start_time, cron_end_time,booking_type, status)

                                               VALUES ('$ref_no', '$sender_email', '$phone_number', '$date_time', '$cron_start_time', '$cron_end_time',0,1)";

                                mysqli_query($conn, $report_sql);
                            }
                        }
                    } else {

                        echo "Error: " . $sql . "<br>" . $conn->error;



                        $ref_no = null;

                        $phone_number = null;

                        $cron_end_time = date("Y-m-d H:i:s");



                        $report_sql = "INSERT INTO parsed_emails_report (ref_no, agent_email, phone_number, booking_email_time, cron_start_time, cron_end_time,booking_type, status)

                                           VALUES ('$ref_no', '$sender_email', '$phone_number', '$date_time', '$cron_start_time', '$cron_end_time',0, 2)";

                        mysqli_query($conn, $report_sql);
                    }
                }
            }
        }
    }
}





function emailBreakdown($from, $body, $subject, $date_time)

{

    if (

        strpos($from, "Book To Park") !== false



    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);

        // Decode quoted-printable encoding (if applicable)

        $parse_email_body = quoted_printable_decode($parse_email_body);



        // Remove hidden characters

        $parse_email_body = preg_replace('/[^\P{C}\t\n]+/u', '', $parse_email_body);







        // Remove trailing spaces from lines

        $parse_email_body = preg_replace('/[ \t]+$/m', '', $parse_email_body);

        $parse_email_body = str_replace(["  ", "   "], "\n", $parse_email_body);

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode special email characters

        $parse_email_body = preg_replace('/\r\n|\r/', "\n", $parse_email_body); // Normalize newlines

        $parse_email_body = trim($parse_email_body); // Trim spaces



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode email

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Normalize spaces

        $parse_email_body = trim($parse_email_body); // Trim start & end spaces

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);



        $pattern = '/Reference Code:\s*(.*?)\s*Company Name:\s*(.*?)\s*Airport:\s*(.*?)\s*Name:\s*(.*?)\s*Contact No:\s*(.*?)\s*Model:\s*(.*?)\s*Make:\s*(.*?)\s*Colour:\s*(.*?)\s*Registration No.:\s*(.*?)\s*Departure Date\/Time:\s*(.*?)\s*Departure Terminal:\s*(.*?)\s*Departure Flight no:\s*(.*?)\s*Arrival Date\/Time:\s*(.*?)\s*Arrival Terminal:\s*(.*?)\s*Arrival Flight no:\s*(.*?)\s*Valeting:\s*(.*?)\s*Amount:\s*([\d\.]+)(?: Pounds)?/s';









        preg_match($pattern, $parse_email_body, $bookingMatches);





        $data = [

            "referenceNo" => $bookingMatches[1],



            "abookedCompany" => $bookingMatches[2],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[7],



            "make" => $bookingMatches[6],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];















        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["payment_status"] = "success";



        $data["agentID"] = 34;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "Book To Park") !== false && strpos($subject, "Cancelled booking") !== false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);

        // Decode quoted-printable encoding (if applicable)

        $parse_email_body = quoted_printable_decode($parse_email_body);



        // Remove hidden characters

        $parse_email_body = preg_replace('/[^\P{C}\t\n]+/u', '', $parse_email_body);







        // Remove trailing spaces from lines

        $parse_email_body = preg_replace('/[ \t]+$/m', '', $parse_email_body);

        $parse_email_body = str_replace(["  ", "   "], "\n", $parse_email_body);

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode special email characters

        $parse_email_body = preg_replace('/\r\n|\r/', "\n", $parse_email_body); // Normalize newlines

        $parse_email_body = trim($parse_email_body); // Trim spaces



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode email

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Normalize spaces

        $parse_email_body = trim($parse_email_body); // Trim start & end spaces

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);



        $pattern = '/Reference Code:\s*(.*?)\s*Company Name:\s*(.*?)\s*Airport:\s*(.*?)\s*Name:\s*(.*?)\s*Contact no:\s*(.*?)\s*Model:\s*(.*?)\s*Make:\s*(.*?)\s*Colour:\s*(.*?)\s*Registration no:\s*(.*?)\s*Departure Date\/Time:\s*(.*?)\s*Departure Terminal:\s*(.*?)\s*Departure Flight no:\s*(.*?)\s*Arrival Date\/Time:\s*(.*?)\s*Arrival Terminal:\s*(.*?)\s*Arrival Flight no:\s*(.*?)\s*Valeting:\s*(.*?)\s*Amount:\s*(\d+(?:\.\d+)?)/s';









        preg_match($pattern, $parse_email_body, $bookingMatches);





        $data = [

            "referenceNo" => $bookingMatches[1],



            "abookedCompany" => $bookingMatches[2],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[6],



            "make" => $bookingMatches[7],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];















        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }

        $data["cancelRequest"] = 1;



        // $data["companyId"] = 117;



        // $data["airportID"] = 1;



        // $data["booking_status"] = "Completed";



        // $data["booking_action"] = "Booked";



        // $data["traffic_src"] = "Agent";



        // $data["incomplete_email"] = 1;



        // $data["payment_status"] = "success";



        // $data["agentID"] = 34;



        // $earlier = new DateTime($data["departDate"]);



        // $later = new DateTime($data["returnDate"]);



        // $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }
    if (
        (
            strpos($from, "M&G Reservations") !== false ||
            strpos($from, "Airport Park Booking") !== false
        ) &&
        strpos($subject, "Cancelled") === false &&
        strpos($subject, "Amendment") !== false
    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);

        $parse_email_body = strip_tags($body);

        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );

        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );

        $parse_email_body = html_entity_decode($parse_email_body);

        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );

        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );
        // Remove &nbsp;
        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);

        // Remove underline lines
        $parse_email_body = preg_replace('/_{10,}/', '', $parse_email_body);

        // Remove MIME boundary lines like --0000000000005af01a0638ef8f48--
        $parse_email_body = preg_replace('/--[a-zA-Z0-9]+/', '', $parse_email_body);

        // Remove email addresses (optional)
        $parse_email_body = preg_replace('/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/', '', $parse_email_body);

        // Remove common footers like "M&G Reservations"
        $parse_email_body = str_replace('M&G Reservations', '', $parse_email_body);

        // Final cleanup (extra spaces/newlines)
        $parse_email_body = trim(preg_replace('/\n{2,}/', "\n\n", $parse_email_body));
        $parse_email_body = preg_replace('/Hi\s+Park\s+and\s+Ride\s+Flex,.*?Amendment\s+Information\s*/is', '', $parse_email_body);


        $pattern = '/
Booking\s+Ref\s+no\s+([^\n]+)\s+
Client\s+Name\s+([^\n]+)\s+
Client\s+Telephone\s+([^\n]*)\s+
CarPark\s+Name\s+[^\n]*\s+
Company\s+Name:\s*([^\n]+)\s+
Parking\s+Type\s+[^\n]*\s+
Airport\s+([^\n]+)\s+
Number\s+Of\s+days\s+([^\n]+)\s+
Outbound\s+Date\s+\/\s+Time\s+([^\n]+)\s+
Inbound\s+Date\s+\/\s+Time\s+([^\n]+)\s+
Booking\s+Date\s+\/\s+Time\s+([^\n]+)\s+
Inbound\s+Flight\s+No\s+([^\n]*)\s+
Outbound\s+Terminal\s+([^\n]+)\s+
Inbound\s+Terminal\s+([^\n]+)\s+
Vehicle\s+Registration\s+([^\n]+)\s+
Vehicle\s+Model\s+([^\n]+)\s+
Vehicle\s+Make\s+([^\n]+)\s+
Vehicle\s+Color\s+([^\n]+)\s+
Additional\s+Amount:\s*([^\n]+)/x';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        if (isset($bookingMatches[16])) {

            $bookingMatches[16] = preg_replace(

                "/(--.*)/",

                "",

                $bookingMatches[16]

            );
        }
 

$data["referenceNo"]     = $bookingMatches[1];
$data["first_name"]      = extractNameParts($bookingMatches[2])["first_name"] ?? "";
$data["last_name"]       = extractNameParts($bookingMatches[2])["last_name"] ?? "";
$data["phone_number"]    = $bookingMatches[3];
$data["abookedCompany"]  = $bookingMatches[4];
$data["airportID"]       = 1;
$data["no_of_days"]      = $bookingMatches[6]; // originally hardcoded to 3 — you may want to keep this dynamic
$data["departDate"]      = $bookingMatches[7];
$data["returnDate"]      = $bookingMatches[8];
$data["created_at"]      = $bookingMatches[9]; // You had `$date_time` logic — more below
$data["returnFlight"]    = $bookingMatches[10];
$data["deprTerminal"]    = $bookingMatches[11];
$data["returnTerminal"]  = $bookingMatches[12];
$data["registration"]    = $bookingMatches[13];
$data["model"]           = $bookingMatches[14];
$data["make"]            = $bookingMatches[15];
$data["color"]           = $bookingMatches[16];
 

$data["companyId"]       = 3;
$data["agentID"]         = 16;
$data["booking_status"]  = "Completed";
$data["booking_action"] = "Amend";

$data["payment_status"]  = "success";
$data["traffic_src"]     = "Agent";
$data["incomplete_email"] = 1;
$data["incomplete_sms"]   = 1;

// Handle created_at fallback if empty
if (empty($data["created_at"]) || $data["created_at"] === '00:00:00 00:00:00') {
    $data["created_at"] = date("Y-m-d H:i:s"); // fallback to now or use $date_time->format() if DateTime object is available
}

// Trim all values
$data = array_map("trim", $data);

return $data;

    }
    if (

        strpos($from, "M&G Reservations") !== false ||

        strpos($from, "Airport Park Booking") !== false
        &&
        strpos($subject, "Cancelled") === false

    ) {


        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);

        $parse_email_body = strip_tags($body);

        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );

        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );

        $parse_email_body = html_entity_decode($parse_email_body);

        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );

        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );

        $paymentPattern =

            '/Payment Status\s*[:\s]*([^\n]+)\s*Booking Reference\s*[:\s]*([^\n]+)\s*Booking Detail Information/';



        preg_match($paymentPattern, $parse_email_body, $paymentMatches);



        $bookingPattern =

            '/Booking Ref no\s*[:\s]*([^\n]+)\s*Client Name\s*[:\s]*([^\n]+)\s*Client Telephone\s*[:\s]*([^\n]*)\s*Company Name\s*[:\s]*([^\n]+)\s*Airport\s*[:\s]*([^\n]+)\s*Departure Date\/Time\s*[:\s]*([^\n]+)\s*Departure Terminal\s*[:\s]*([^\n]+)\s*Arrival Date\/Time\s*[:\s]*([^\n]+)\s*Arrival Terminal\s*[:\s]*([^\n]+)\s*Arrival Flight no\s*[:\s]*([^\n]*)\s*Booking Date \/ Time\s*[:\s]*([^\n]+)\s*Vehicle Registration\s*[:\s]*([^\n]+)\s*Vehicle Model\s*[:\s]*([^\n]+)\s*Vehicle Make\s*[:\s]*([^\n]+)\s*Vehicle Color\s*[:\s]*([^\n]+)\s*Total Amount\s*[:\s]*([^\n]+)/';



        preg_match($bookingPattern, $parse_email_body, $bookingMatches);



        if (isset($bookingMatches[16])) {

            $bookingMatches[16] = preg_replace(

                "/(--.*)/",

                "",

                $bookingMatches[16]

            );
        }



        $data["total_amount"] = $bookingMatches[16];



        $data["booking_amount"] = $bookingMatches[16];



        $data["color"] = $bookingMatches[15];



        $data["make"] = $bookingMatches[14];



        $data["model"] = $bookingMatches[13];



        $data["registration"] = $bookingMatches[12];



        $data["returnTerminal"] = $bookingMatches[9];



        // if ($parse_array_aiport == "Terminal 1") {

        //     $data["returnTerminal"] = "394";

        // } elseif ($parse_array_aiport == "Terminal 2") {

        //     $data["returnTerminal"] = "395";

        // } elseif ($parse_array_aiport == "Terminal 3") {

        //     $data["returnTerminal"] = "396";

        // }



        $data["deprTerminal"] = $bookingMatches[7];



        // if ($parse_array_aiport == "Terminal 1") {

        //     $data["deprTerminal"] = "394";

        // } elseif ($parse_array_aiport == "Terminal 2") {

        //     $data["deprTerminal"] = "395";

        // } elseif ($parse_array_aiport == "Terminal 3") {

        //     $data["deprTerminal"] = "396";

        // }



        $data["returnFlight"] = $bookingMatches[10];



        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }

        $data["created_at"] = $date_times;



        $data["returnDate"] = $bookingMatches[8];



        $data["departDate"] = $bookingMatches[6];



        $data["no_of_days"] = 3;



        $data["airportID"] = 1;



        $data["abookedCompany"] = $bookingMatches[4];



        $data["phone_number"] = $bookingMatches[3];



        $fullname = $bookingMatches[2] ?? "";

        $extracted_fullname = extractNameParts($bookingMatches[2]);



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        $data["referenceNo"] = $paymentMatches[2];



        $data["companyId"] = 117;



        $data["agentID"] = 16;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["payment_status"] = "success";



        $data["traffic_src"] = "Agent";



        $data["agentID"] = 16;



        $data["incomplete_email"] = 1;



        $data["incomplete_sms"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "M&G Reservations") !== false ||

        strpos($from, "Airport Park Booking") !== false &&
        strpos($subject, "Cancelled") !== false

    ) {




        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);

        $parse_email_body = strip_tags($body);

        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );

        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );

        $parse_email_body = html_entity_decode($parse_email_body);

        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );

        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);


        $parse_email_body = str_replace([
            "Booking Cancelled",
            "_________________________________________________________________________",
        ], "", $parse_email_body);

        // Step 2: Remove greeting line with booking number
        $parse_email_body = preg_replace(
            '/Hi Manchester Airport Parking - Meet & Greet,Booking - MG-\d+ has been cancelled\./i',
            '',
            $parse_email_body
        );

        // Step 3: Remove "Regards"/"Best regards" and everything after
        $parse_email_body = preg_replace(
            '/(Best regards|Regards)(.|\s)*/i',
            '',
            $parse_email_body
        );

        // Step 4: Remove MIME/boundary lines like "--00000..." and base64 sections
        $parse_email_body = preg_replace(
            '/--\d+.*$/ms',
            '',
            $parse_email_body
        );

        // Step 5: Clean extra whitespace
        $parse_email_body = trim(preg_replace('/\s+/', ' ', $parse_email_body));

        // Define pattern: capture only the correct fields
        $bookingPattern = '/
    Booking\s+Number:\s*(MG-\d+)\s+
    Client\s+([A-Za-z\s]+?)\s+
    Airport\s+\/\s+Termainal\s+([^\n]+?)\s+
    Number\s+Of\s+days\s+(\d+)\s+
    Outbound\s+Date\s+\/\s+Time\s+(\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2})\s+
    Inbound\s+Date\s+\/\s+Time\s+(\d{4}-\d{2}-\d{2}\s+\d{2}:\d{2}:\d{2})\s+
    Inbound\s+Flight\s+No\s+(\S+)\s+
    Terminal\s+\[.*?\]\s+
    Vehicle\s+Registration\s+No\s+([A-Z0-9\s]+)
/x';

        preg_match($bookingPattern, $parse_email_body, $bookingMatches);

        // Optional: extract name parts
        $fullname = $bookingMatches[2] ?? "";
        $extracted_fullname = extractNameParts($fullname);

        // Set up the cleaned `$data` array
        $data = [
            "referenceNo"      => $bookingMatches[1] ?? "",
            "first_name"       => $extracted_fullname["first_name"] ?? "",
            "last_name"        => $extracted_fullname["last_name"] ?? "",
            "airport_terminal" => $bookingMatches[3] ?? "",
            "no_of_days"       => $bookingMatches[4] ?? "",
            "departDate"       => $bookingMatches[5] ?? "",
            "returnDate"       => $bookingMatches[6] ?? "",
            "returnFlight"     => $bookingMatches[7] ?? "",
            "registration"     => trim($bookingMatches[9] ?? ""), // corrected index

        ];

        // Optional: add timestamp logic
        if (!empty($date_time) && $date_time !== '00:00:00 00:00:00') {
            $data["created_at"] = is_object($date_time) ? $date_time->format('Y-m-d H:i:s') : $date_time;
        } else {
            $data["created_at"] = date('Y-m-d H:i:s');
        }
        $data["referenceNo"] = $bookingMatches[1];


        $data["cancelRequest"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "pz@parkingzone.co.uk") !== false ||

        strpos($from, "Parking Zone") !== false &&

        strpos($subject, "Cancelled") !== false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");

        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);

        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );

        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );

        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );

        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );

        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );

        $paymentPattern =

            '/Payment Status\s*[:\s]*([^\n]+)\s*Booking Reference\s*[:\s]*([^\n]+)\s*Booking Detail Information/';



        preg_match($paymentPattern, $parse_email_body, $paymentMatches);



        $bookingPattern =

            '/Booking Ref no\s*[:\s]*([^\n]+)\s*Client Name\s*[:\s]*([^\n]+)\s*Client Telephone\s*[:\s]*([^\n]*)\s*Company Name\s*[:\s]*([^\n]+)\s*Airport\s*[:\s]*([^\n]+)\s*Departure Date\/Time\s*[:\s]*([^\n]+)\s*Departure Terminal\s*[:\s]*([^\n]+)\s*Arrival Date\/Time\s*[:\s]*([^\n]+)\s*Arrival Terminal\s*[:\s]*([^\n]+)\s*Arrival Flight no\s*[:\s]*([^\n]*)\s*Booking Date \/ Time\s*[:\s]*([^\n]+)\s*Vehicle Registration\s*[:\s]*([^\n]+)\s*Vehicle Model\s*[:\s]*([^\n]+)\s*Vehicle Make\s*[:\s]*([^\n]+)\s*Vehicle Color\s*[:\s]*([^\n]+)\s*Total Amount\s*[:\s]*([^\n]+)/';



        preg_match($bookingPattern, $parse_email_body, $bookingMatches);



        if (isset($bookingMatches[16])) {

            $bookingMatches[16] = preg_replace(

                "/(--.*)/",

                "",

                $bookingMatches[16]

            );
        }



        $data["total_amount"] = $bookingMatches[16];



        $data["booking_amount"] = $bookingMatches[16];



        $data["color"] = $bookingMatches[15];



        $data["make"] = $bookingMatches[14];



        $data["model"] = $bookingMatches[13];



        $data["registration"] = $bookingMatches[12];



        $parse_array_aiport = $bookingMatches[9];



        if ($parse_array_aiport == "Terminal 1") {

            $data["returnTerminal"] = "394";
        } elseif ($parse_array_aiport == "Terminal 2") {

            $data["returnTerminal"] = "395";
        } elseif ($parse_array_aiport == "Terminal 3") {

            $data["returnTerminal"] = "396";
        }



        $parse_array_aiport = $bookingMatches[7];



        if ($parse_array_aiport == "Terminal 1") {

            $data["deprTerminal"] = "394";
        } elseif ($parse_array_aiport == "Terminal 2") {

            $data["deprTerminal"] = "395";
        } elseif ($parse_array_aiport == "Terminal 3") {

            $data["deprTerminal"] = "396";
        }



        $data["returnFlight"] = $bookingMatches[10];



        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }

        $data["created_at"] = $date_times;



        $data["returnDate"] = $bookingMatches[8];



        $data["departDate"] = $bookingMatches[6];



        $data["no_of_days"] = 3;



        $data["airportID"] = 1;



        $data["abookedCompany"] = $bookingMatches[4];



        $data["phone_number"] = $bookingMatches[3];



        $fullname = $bookingMatches[2] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        $data["referenceNo"] = $paymentMatches[2];



        // $data["companyId"] = 117;



        // $data["agentID"] = 16;



        // $data["booking_status"] = "Completed";



        // $data["booking_action"] = "Booked";



        // $data["payment_status"] = "success";



        // $data["traffic_src"] = "Agent";



        // $data["agentID"] = 16;



        // $data["incomplete_email"] = 1;



        // $data["incomplete_sms"] = 1;

        $data["cancelRequest"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "Compare Your Parking Deals") !== false && strpos($from, "bookings@compareyourparkingdeals.co.uk")

    ) {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace(

            ["\n", "Â", "\r", "]v4_}]]}", "&pound; ", "Ã‚Â£"],

            ["", "", "", "", "£", ""],

            $parse_email_body

        );



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        // First normalize line endings and clean up the content

        $parse_email_body = str_replace("\r\n", "\n", $parse_email_body); // Standardize line endings

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Replace multiple whitespaces with single space

        if (preg_match('/^(.*?Amount:\s*116Pounds)/s', $parse_email_body, $matches)) {

            $parse_email_body = $matches[1];
        }

        // Remove email headers and attachments if needed

        $parse_email_body = preg_replace('/--b1_[a-f0-9]+.*?--/s', '', $parse_email_body); // Remove MIME boundaries

        $parse_email_body = preg_replace('/Content-Type:.*?filename=.*?base64.*?[\r\n]+.*?[\r\n]+/s', '', $parse_email_body); // Remove attachment headers



        $parse_email_body = preg_replace('/[^\x20-\x7E\t\r\n£]/', '', $parse_email_body);



        $parse_email_body = str_replace("Pounds", "", $parse_email_body);

        $parse_email_body = preg_replace('/\\\n|\n/', ' ', $parse_email_body);



        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);



        $pattern = [

            "reference_code" => "/Reference Code:\s*([A-Z]+-\d+)/i",

            "company" => "/Company Name:\s*(.*?)\s*Airport:/",

            "airport" => "/Airport:\s*(.*?)\s*Name:/",

            'name' => '/Name:\s*([A-Za-z\s]+?)(?=\s*(?:Contact No:|Phone:|Vehicle:|$))/i',

            "contact_no" => "/Contact No:\s*(\d+)/",

            "model" => "/Model:\s*(\d+)/",

            "make" => "/Make:\s*([A-Z]+)/i",

            "colour" => "/Colour:\s*([A-Za-z]+)/i",

            "registration_no" => "/Registration No\.:\s*([A-Z0-9]+)/i",

            "departure_date" => "/Departure Date\/Time:\s*(\d{2}-\d{2}-\d{4} \d{2}:\d{2}:\d{2})/",

            "departure_terminal" => "/Departure Terminal:\s*(.*?)\s*Departure Flight no:/",

            "departure_flight" => "/Departure Flight no:\s*([A-Z0-9]+)/i",

            "arrival_date" => "/Arrival Date\/Time:\s*(\d{2}-\d{2}-\d{4} \d{2}:\d{2}:\d{2})/",

            "arrival_terminal" => "/Arrival Terminal:\s*([A-Z0-9]+)/i",

            "arrival_flight" => "/Arrival Flight no:\s*([A-Z0-9]+)/i",

            "valeting" => "/Valeting:\s*(Yes|No)/i",

            "amount" => "/Amount:\s*(\d+)/",

        ];



        $bookingMatches = [];

        foreach ($pattern as $key => $regex) {

            if (preg_match($regex, $parse_email_body, $matches)) {

                $bookingMatches[$key] = trim($matches[1]);
            }
        }





        // if (!empty($bookingMatches["amount"])) {

        //     $bookingMatches["amount"] = str_replace(

        //         ",",

        //         "",

        //         $bookingMatches["amount"]

        //     );

        // }



        $data = [

            "referenceNo" => $bookingMatches["reference_code"] ?? "",



            "abookedCompany" => $bookingMatches["company"] ?? "",



            "phone_number" => $bookingMatches["contact_no"] ?? "",



            "airportID" => 1,



            "model" => $bookingMatches["model"] ?? "",



            "make" => $bookingMatches["make"] ?? "",



            "color" => $bookingMatches["colour"] ?? "",



            "registration" => $bookingMatches["registration_no"] ?? "",



            "deprTerminal" => $bookingMatches["departure_terminal"] ?? "",



            "deptFlight" => $bookingMatches["departure_flight"] ?? "",



            "returnTerminal" => $bookingMatches["arrival_terminal"] ?? "",



            "returnFlight" => $bookingMatches["arrival_flight"] ?? "",



            "passenger" => $bookingMatches["passengers"] ?? "",



            "total_amount" => $bookingMatches["amount"] ?? "",

            "booking_amount" => $bookingMatches["amount"] ?? "",



        ];

        if (!empty($bookingMatches["departure_date"])) {

            $departureDate = $bookingMatches["departure_date"];



            $dateParts = explode(" ", $departureDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedDepartureDate = $date . " " . $time;



            $data["departDate"] =

                date("Y-m-d H:i:s", strtotime($formattedDepartureDate)) ?: null;
        }



        if (!empty($bookingMatches["arrival_date"])) {

            $arrivalDate = $bookingMatches["arrival_date"];



            $dateParts = explode(" ", $arrivalDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedArrivalDate = $date . " " . $time;



            $data["returnDate"] =

                date("Y-m-d H:i:s", strtotime($formattedArrivalDate)) ?: null;
        }



        $fullname = $bookingMatches["name"] ?? "";



        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 36;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "pz@parkingzone.co.uk") !== false ||

        strpos($from, "Parking Zone") !== false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");

        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);

        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );

        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );

        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );

        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );

        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );

        $paymentPattern =

            '/Payment Status\s*[:\s]*([^\n]+)\s*Booking Reference\s*[:\s]*([^\n]+)\s*Booking Detail Information/';



        preg_match($paymentPattern, $parse_email_body, $paymentMatches);



        $bookingPattern =

            '/Booking Ref no\s*[:\s]*([^\n]+)\s*Client Name\s*[:\s]*([^\n]+)\s*Client Telephone\s*[:\s]*([^\n]*)\s*Company Name\s*[:\s]*([^\n]+)\s*Airport\s*[:\s]*([^\n]+)\s*Departure Date\/Time\s*[:\s]*([^\n]+)\s*Departure Terminal\s*[:\s]*([^\n]+)\s*Arrival Date\/Time\s*[:\s]*([^\n]+)\s*Arrival Terminal\s*[:\s]*([^\n]+)\s*Arrival Flight no\s*[:\s]*([^\n]*)\s*Booking Date \/ Time\s*[:\s]*([^\n]+)\s*Vehicle Registration\s*[:\s]*([^\n]+)\s*Vehicle Model\s*[:\s]*([^\n]+)\s*Vehicle Make\s*[:\s]*([^\n]+)\s*Vehicle Color\s*[:\s]*([^\n]+)\s*Total Amount\s*[:\s]*([^\n]+)/';



        preg_match($bookingPattern, $parse_email_body, $bookingMatches);



        if (isset($bookingMatches[16])) {

            $bookingMatches[16] = preg_replace(

                "/(--.*)/",

                "",

                $bookingMatches[16]

            );
        }



        $data["total_amount"] = $bookingMatches[16];



        $data["booking_amount"] = $bookingMatches[16];



        $data["color"] = $bookingMatches[15];



        $data["make"] = $bookingMatches[14];



        $data["model"] = $bookingMatches[13];



        $data["registration"] = $bookingMatches[12];



        $parse_array_aiport = $bookingMatches[9];



        if ($parse_array_aiport == "Terminal 1") {

            $data["returnTerminal"] = "394";
        } elseif ($parse_array_aiport == "Terminal 2") {

            $data["returnTerminal"] = "395";
        } elseif ($parse_array_aiport == "Terminal 3") {

            $data["returnTerminal"] = "396";
        }



        $parse_array_aiport = $bookingMatches[7];



        if ($parse_array_aiport == "Terminal 1") {

            $data["deprTerminal"] = "394";
        } elseif ($parse_array_aiport == "Terminal 2") {

            $data["deprTerminal"] = "395";
        } elseif ($parse_array_aiport == "Terminal 3") {

            $data["deprTerminal"] = "396";
        }



        $data["returnFlight"] = $bookingMatches[10];



        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }

        $data["created_at"] = $date_times;



        $data["returnDate"] = $bookingMatches[8];



        $data["departDate"] = $bookingMatches[6];



        $data["no_of_days"] = 3;



        $data["airportID"] = 1;



        $data["abookedCompany"] = $bookingMatches[4];



        $data["phone_number"] = $bookingMatches[3];



        $fullname = $bookingMatches[2] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        $data["referenceNo"] = $paymentMatches[2];



        $data["companyId"] = 117;



        $data["agentID"] = 16;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["payment_status"] = "success";



        $data["traffic_src"] = "Agent";



        $data["agentID"] = 16;



        $data["incomplete_email"] = 1;



        $data["incomplete_sms"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }



    if (

        strpos($from, "no-reply@cheapdealcenter.com") !== false ||

        strpos($from, "Cheap Deal Center <no-reply@cheapdealcenter.com>") !== false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");

        $body = preg_replace('/\xC2\xA0/', " ", $body);

        $parse_email_body = strip_tags($body);

        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );

        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );

        $parse_email_body = html_entity_decode($parse_email_body);

        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );

        $parse_email_body = str_replace("\n", "", $parse_email_body);

        $parse_email_body = str_replace("&amp;", "", $parse_email_body);

        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );

        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);

        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );

        $parse_email_body = preg_replace('/Note:.*$/s', "", $parse_email_body);

        $parse_email_body = preg_replace(

            "/.*?(Booking Confirmation Details:)/s",

            '$1',

            $parse_email_body

        );



        $parse_email_body = str_replace(

            "Booking Confirmation Details:",

            "",

            $parse_email_body

        );

        $parse_email_body = str_replace(['\\n', '\\r'], ' ', $parse_email_body);











        $pattern = [

            "reference_number"       => "/Reference Number:\s*([A-Z0-9\-]+)/i",

            "name"                  => "/Customer Name\s*([A-Za-z\s\-']+)/",

            "contact_number"         => "/Contact Number\s+(\d{11})/",

            "product_name"           => "/Product Name\s+(.+?)\s+Product Booked With/i",

            "product_booked_with"    => "/Product Booked With\s+(.+?)\s+Product Code/i",

            "product_code"           => "/Product Code\s+([A-Z0-9\-]+)/i",

            "parking_type"           => "/Parking Type\s+([A-Za-z\s]+)/",

            "airport"                => "/Airport\s+([A-Za-z\s]+)/",

            "departure_terminal" => "/Departure Terminal\s+([A-Za-z0-9\s]+?)(?=\s+Return Terminal)/i",

            "return_terminal"    => "/Return Terminal\s+([A-Za-z0-9\s]+?)(?=\s+Number Of days)/i",

            "number_of_days"         => "/Number Of days\s+(\d+)/i",

            "departure_datetime"     => "/Departure Date\s+\/ Time\s+([0-9:\- ]+)/",

            "return_datetime"        => "/Return Date\s+\/ Time\s+([0-9:\- ]+)/",

            "booking_datetime"       => "/Booking Date\s+\/ Time\s+([0-9:\- ]+)/",

            "return_flight_no"       => "/Return Flight No\s+([A-Za-z0-9\-]+)/i",

            "vehicle_registration"   => "/Vehicle Registration No\s+([A-Za-z0-9]+)/",

            "vehicle_model"          => "/Vehicle Model\s+([A-Za-z0-9]+)/",

            "vehicle_make"           => "/Vehicle Make\s+([A-Za-z0-9]+)/",

            "vehicle_color" => "/Vehicle Color\s+([A-Za-z\s]+)(?=\s+Amount Paid)/i",

            "amount_paid"            => "/Amount Paid\s+([0-9]+(?:\.[0-9]{2})?)/",

        ];

        preg_match("/Customer Name\s*([A-Za-z\s\-']+)(?=\s+Contact Number)/", $parse_email_body, $matches);





        $data = [];

        foreach ($pattern as $key => $regex) {

            preg_match($regex, $parse_email_body, $bookingMatches);

            $data[$key] = $bookingMatches[1] ?? null;
        }

        $data = [

            "referenceNo" => $data["reference_number"] ?? "",

            "abookedCompany" => $data["product_booked_with"] ?? "",

            "phone_number" => $data["contact_number"] ?? "",

            "airportID" => 1,

            "model" => $data["vehicle_model"] ?? "",

            "make" => $data["vehicle_make"] ?? "",



            "color" => $data["vehicle_color"] ?? "",

            "registration" => $data["vehicle_registration"] ?? "",

            "returnDate" => $data["return_datetime"] ?? "",

            "departDate" => $data["departure_datetime"] ?? "",

            "deprTerminal" => preg_replace(

                "/Terminal.*?Terminal/i",

                "",

                $data["departure_terminal"] ?? ""

            ),

            "deptFlight" => $data["departure_flight_no"] ?? "",

            "returnTerminal" => $data["return_terminal"] ?? "",

            "returnFlight" => $data["return_flight_no"] ?? "",

            "total_amount" => $data["amount_paid"] ?? "",

            "booking_amount" => $data["amount_paid"] ?? "",

            "no_of_days" => $data["number_of_days"] ?? "7",

        ];



        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if (!empty($data["departDate"])) {

            $data["departDate"] = date(

                "Y-m-d H:i:s",

                strtotime(str_replace("/", "-", $data["departDate"]))

            );
        }



        if (!empty($data["returnDate"])) {

            $data["returnDate"] = date(

                "Y-m-d H:i:s",

                strtotime(str_replace("/", "-", $data["returnDate"]))

            );
        }



        $fullname = $matches[1] ?? "";

        $extracted_fullname = extractNameParts($fullname);

        $data["title"] = $extracted_fullname["title"] ?? "";

        $data["first_name"] = $extracted_fullname["first_name"] ?? "";

        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        $data["no_of_days"] = $data["no_of_days"] ?? "7";



        $data["companyId"] = 117;

        $data["booking_status"] = "Completed";

        $data["booking_action"] = "Booked";

        $data["payment_status"] = "success";

        $data["traffic_src"] = "Agent";

        $data["agentID"] = 28;

        $data["incomplete_email"] = 1;

        $data["incomplete_sms"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }



    if (

        strpos($from, "no-reply@holidayscarparking.uk") !== false ||

        strpos($from, "Holidays Car Parking") !== false ||

        strpos($from, "Parking Experts") !== false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);

        $parse_email_body = strip_tags($body);

        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );

        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );

        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );

        $parse_email_body = str_replace('\n', "", $parse_email_body);

        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );

        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );

        $paymentPattern =

            '/Payment Status\s*[:\s]*([^\n]+)\s*Booking Reference\s*[:\s]*([A-Za-z0-9\-]+)(?=\s|$)/s';



        preg_match($paymentPattern, $parse_email_body, $paymentMatches);



        $Refno = preg_replace('/-+Booking$/', "", $paymentMatches[2]);



        $bookingPattern =

            '/Booking Ref no\s*[:\s]*([^\n]+)\s*Client Name\s*[:\s]*([^\n]+)\s*Client Telephone\s*[:\s]*([^\n]*)\s*Company Name\s*[:\s]*([^\n]+)\s*Airport\s*[:\s]*([^\n]+)\s*Departure Date\/Time\s*[:\s]*([^\n]+)\s*Departure Terminal\s*[:\s]*([^\n]+)\s*Arrival Date\/Time\s*[:\s]*([^\n]+)\s*Arrival Terminal\s*[:\s]*([^\n]+)\s*Arrival Flight no\s*[:\s]*([^\n]*)\s*Booking Date \/ Time\s*[:\s]*([^\n]+)\s*Vehicle Registration\s*[:\s]*([^\n]+)\s*Vehicle Model\s*[:\s]*([^\n]+)\s*Vehicle Make\s*[:\s]*([^\n]+)\s*Vehicle Color\s*[:\s]*([^\n]+)\s*Total Amount\s*[:\s]*([^\n]+)/';



        preg_match($bookingPattern, $parse_email_body, $bookingMatches);



        if (isset($bookingMatches[16])) {

            $bookingMatches[16] = preg_replace(

                "/(--.*)/",

                "",

                $bookingMatches[16]

            );
        }



        $data["total_amount"] = $bookingMatches[16];

        $data["referenceNo"] = $bookingMatches[1];



        $data["booking_amount"] = $bookingMatches[16];



        $data["color"] = $bookingMatches[15];



        $data["make"] = $bookingMatches[14];



        $data["model"] = $bookingMatches[13];



        $data["registration"] = $bookingMatches[12];



        $parse_array_aiport = $bookingMatches[9];



        if ($parse_array_aiport == "Terminal 1") {

            $data["returnTerminal"] = "394";
        } elseif ($parse_array_aiport == "Terminal 2") {

            $data["returnTerminal"] = "395";
        } elseif ($parse_array_aiport == "Terminal 3") {

            $data["returnTerminal"] = "396";
        }



        $parse_array_aiport = $bookingMatches[7];



        if ($parse_array_aiport == "Terminal 1") {

            $data["deprTerminal"] = "394";
        } elseif ($parse_array_aiport == "Terminal 2") {

            $data["deprTerminal"] = "395";
        } elseif ($parse_array_aiport == "Terminal 3") {

            $data["deprTerminal"] = "396";
        }



        $data["returnFlight"] = $bookingMatches[10];



        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $data["returnDate"] = $bookingMatches[8];



        $data["departDate"] = $bookingMatches[6];



        $data["no_of_days"] = 3;



        $data["airportID"] = 1;



        $data["abookedCompany"] = $bookingMatches[4];



        $data["phone_number"] = $bookingMatches[3];



        $fullname = $bookingMatches[2] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        $data["companyId"] = 117;



        $data["agentID"] = 20;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["payment_status"] = "success";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["incomplete_sms"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }



    if (strpos($from, "Compare Parking 4 Me") !== false) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $pattern =

            '/Reference Code:\s*([^\n]+)\s*Company Name:\s*([^\n]+)\s*Airport:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact No:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration No.:\s*([^\n]+)\s*Departure Date\/Time:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Departure Flight no:\s*([^\n]+)\s*Arrival Date\/Time:\s*([^\n]+)\s*Arrival Terminal:\s*([^\n]+)\s*Arrival Flight no:\s*([^\n]+)\s*Valeting:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Paid Amount:\s*([^\n]+)\s*Booking Status:\s*([^\n]+)\s*Transaction Status:\s*([^\n]+)/';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[1],



            "abookedCompany" => $bookingMatches[2],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[6],



            "make" => $bookingMatches[7],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["agentID"] = 23;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["payment_status"] = "success";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["incomplete_sms"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }







    if ($from == "bookings@budgetairportparking.co.uk") {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $parse_email_body = preg_replace(

            "/<br>|\n|<br( ?)\/>/",

            " ",

            $parse_email_body

        );



        $parse_email_body = str_replace(

            "Vehicle Registrat ion",

            "Vehicle Registration",

            $parse_email_body

        );



        $parse_email_body = str_replace(

            "Vehicle Regis tration",

            "Vehicle Registration",

            $parse_email_body

        );



        $parse_email_body = str_replace("a t ", "", $parse_email_body);



        $parse_email_body = str_replace("at ", "", $parse_email_body);



        $parse_array_aiport = explode("Parking Charges:", $parse_email_body);



        $data["total_amount"] = str_replace("GBP ", "", $parse_array_aiport[1]);



        $data["booking_amount"] = str_replace(

            "GBP ",

            "",

            $parse_array_aiport[1]

        );



        $parse_email_body = str_replace(

            "Parking Charges:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("People:", $parse_email_body);



        $data["passenger"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "People:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Vehicle Registration:",

            $parse_email_body

        );



        $data["registration"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Vehicle Registration:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Vehicle Details:", $parse_email_body);



        $data["make"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Vehicle Details:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Customer Contact:", $parse_email_body);



        $data["phone_number"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Customer Contact:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Driver\'s Name:", $parse_email_body);



        $name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Driver\'s Name:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $name_arr = explode(" ", $name);



        $data["first_name"] = $name_arr[1];



        $data["last_name"] = $name_arr[2];



        $parse_array_aiport = explode(

            "Return Flight Number:",

            $parse_email_body

        );



        $data["returnFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Return Flight Number:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Outbound Flight Number:",

            $parse_email_body

        );



        $data["returnFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Outbound Flight Number:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Return:", $parse_email_body);



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($parse_array_aiport[1])

        );



        $parse_email_body = str_replace(

            "Return:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Terminal In:", $parse_email_body);



        $data["returnTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Terminal In:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Dropoff:", $parse_email_body);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($parse_array_aiport[1])

        );



        $parse_email_body = str_replace(

            "Dropoff:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Outbound Terminal:", $parse_email_body);



        $data["deprTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Outbound Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Parking Type:", $parse_email_body);



        $parse_email_body = str_replace(

            "Parking Type:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Airport:", $parse_email_body);



        $parse_email_body = str_replace(

            "Airport:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Reference:", $parse_email_body);



        $data["referenceNo"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Reference:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["agentID"] = 3;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["payment_status"] = "success";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        ($from == "Parking 4 You <noreply@compareairportparkings.co.uk>") &&

        strpos($from, "Parking 4 You") !== false &&

        strpos($subject, "Ammend") === false &&

        strpos($subject, "Cancelled") !== false

    ) {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace(

            "Compare Parking",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace(

            "Company Name",

            "Company",

            $parse_email_body

        );



        $parse_email_body = str_replace("Ã‚Â£", "£", $parse_email_body);



        $parse_email_body = str_replace("£", "", $parse_email_body);



        $parse_email_body = str_replace("&pound; ", "", $parse_email_body);



        $parse_email_body = str_replace("Â", "", $parse_email_body);



        $parse_email_body = str_replace('\r', "", $parse_email_body);



        $parse_array_aiport = explode("Booking Status:", $parse_email_body);



        $parse_email_body = str_replace(

            "Booking Status:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Amount:", $parse_email_body);



        $data["total_amount"] = trim($parse_array_aiport[1]);



        $data["total_amount"] = str_replace(" ", "", $data["total_amount"]);



        $data["total_amount"] = strip_tags($data["total_amount"]);



        $data["total_amount"] = html_entity_decode($data["total_amount"]);



        $data["total_amount"] = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $data["total_amount"]

        );



        $data["booking_amount"] = trim($parse_array_aiport[1]);



        $data["booking_amount"] = str_replace(" ", "", $data["booking_amount"]);



        $data["booking_amount"] = strip_tags($data["booking_amount"]);



        $data["booking_amount"] = html_entity_decode($data["booking_amount"]);



        $data["booking_amount"] = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $data["booking_amount"]

        );



        $parse_email_body = str_replace(

            "Amount:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Valeting:", $parse_email_body);



        $parse_email_body = str_replace(

            "Valeting:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Passengers:", $parse_email_body);



        $data["passenger"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Passengers:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Flight no:", $parse_email_body);



        $data["returnFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Arrival Flight no:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Terminal:", $parse_email_body);



        $data["returnTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Arrival Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Date/Time:", $parse_email_body);



        $data["returnDate"] = trim(

            date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

        );



        $parse_email_body = str_replace(

            "Arrival Date/Time:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Departure Flight no:",

            $parse_email_body

        );



        $data["deptFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Departure Flight no:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Departure Terminal:", $parse_email_body);



        $data["deprTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Departure Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Departure Date/Time:",

            $parse_email_body

        );



        $data["departDate"] = trim(

            date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

        );



        $parse_email_body = str_replace(

            "Departure Date/Time:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Registration No.:", $parse_email_body);



        $data["registration"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Registration No.:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Colour:", $parse_email_body);



        $data["color"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Colour:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Make:", $parse_email_body);



        $data["make"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Make:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Model:", $parse_email_body);



        $data["model"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Model:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Contact No:", $parse_email_body);



        $data["phone_number"] = trim($parse_array_aiport[1]);



        $parse_email_body = str_replace(

            "Contact No:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Name:", $parse_email_body);



        $name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Name:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $name_arr = explode(" ", $name);



        $data["title"] = $name_arr[1];



        $data["first_name"] = $name_arr[2];



        $data["last_name"] = $name_arr[3];



        $parse_array_aiport = explode("Company:", $parse_email_body);



        $company_name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Company:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Reference Code:", $parse_email_body);



        $data["referenceNo"] = trim($parse_array_aiport[1]);



        $parse_email_body = str_replace(

            "Reference Code:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Airport:", $parse_email_body);



        $airport = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Airport:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $data["cancelRequest"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        (strpos($from, "Parking 4 You") !== false &&

            $from == "Parking 4 You <noreply@parking4you.co.uk>") ||

        $from == "Parking 4 You <noreply@compareairportparkings.co.uk>" ||

        ($from == "Parking 4 You <noreply@compareparkingdeals.co.uk>" &&

            strpos($subject, "Ammend") === false &&

            strpos($subject, "Cancelled") === false)

    ) {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace(

            "Compare Parking",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace(

            "Company Name",

            "Company",

            $parse_email_body

        );



        $parse_email_body = str_replace("Ã‚Â£", "£", $parse_email_body);



        $parse_email_body = str_replace("£", "", $parse_email_body);



        $parse_email_body = str_replace("&pound; ", "", $parse_email_body);



        $parse_email_body = str_replace("Â", "", $parse_email_body);



        $parse_email_body = str_replace('\r', "", $parse_email_body);



        $parse_array_aiport = explode("Booking Status:", $parse_email_body);



        $parse_email_body = str_replace(

            "Booking Status:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Amount:", $parse_email_body);



        $data["total_amount"] = trim($parse_array_aiport[1]);



        $data["total_amount"] = str_replace(" ", "", $data["total_amount"]);



        $data["total_amount"] = strip_tags($data["total_amount"]);



        $data["total_amount"] = html_entity_decode($data["total_amount"]);



        $data["total_amount"] = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $data["total_amount"]

        );



        $data["booking_amount"] = trim($parse_array_aiport[1]);



        $data["booking_amount"] = str_replace(" ", "", $data["booking_amount"]);



        $data["booking_amount"] = strip_tags($data["booking_amount"]);



        $data["booking_amount"] = html_entity_decode($data["booking_amount"]);



        $data["booking_amount"] = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $data["booking_amount"]

        );



        $parse_email_body = str_replace(

            "Amount:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Valeting:", $parse_email_body);



        $parse_email_body = str_replace(

            "Valeting:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Passengers:", $parse_email_body);



        $data["passenger"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Passengers:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Flight no:", $parse_email_body);



        $data["returnFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Arrival Flight no:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Terminal:", $parse_email_body);



        $data["returnTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Arrival Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Date/Time:", $parse_email_body);



        $data["returnDate"] = trim(

            date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

        );



        $parse_email_body = str_replace(

            "Arrival Date/Time:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Departure Flight no:",

            $parse_email_body

        );



        $data["deptFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Departure Flight no:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Departure Terminal:", $parse_email_body);



        $data["deprTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Departure Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Departure Date/Time:",

            $parse_email_body

        );



        $data["departDate"] = trim(

            date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

        );



        $parse_email_body = str_replace(

            "Departure Date/Time:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $parse_array_aiport = explode("Registration No.:", $parse_email_body);



        $data["registration"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Registration No.:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Colour:", $parse_email_body);



        $data["color"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Colour:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Make:", $parse_email_body);



        $data["make"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Make:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Model:", $parse_email_body);



        $data["model"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Model:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Contact No:", $parse_email_body);



        $data["phone_number"] = trim($parse_array_aiport[1]);



        $parse_email_body = str_replace(

            "Contact No:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Name:", $parse_email_body);



        $name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Name:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $name_arr = explode(" ", $name);



        $data["title"] = $name_arr[1];



        $data["first_name"] = $name_arr[2];



        $data["last_name"] = $name_arr[3];



        $parse_array_aiport = explode("Company:", $parse_email_body);



        $company_name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Company:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Reference Code:", $parse_email_body);



        $data["referenceNo"] = trim($parse_array_aiport[1]);



        $parse_email_body = str_replace(

            "Reference Code:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Airport:", $parse_email_body);



        $airport = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Airport:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        if ($from == "Parking 4 You <noreply@parking4you.co.uk>") {

            $data["agentID"] = 17;
        } elseif (

            $from == "Parking 4 You <noreply@compareparkingdeals.co.uk>"

        ) {

            $data["agentID"] = 6;
        } elseif (

            $from == "Parking 4 You <noreply@compareairportparkings.co.uk>"

        ) {

            $data["agentID"] = 27;
        }



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        ($from == "Parking 4 You <noreply@parking4you.co.uk>" ||

            $from == "Parking 4 You <noreply@compareairportparkings.co.uk>" ||

            $from == "Parking 4 You <noreply@compareparkingdeals.co.uk>") &&

        strpos($from, "Parking 4 You") !== false

        &&

        strpos($subject, "Ammend") !== false

    ) {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace(

            "Compare Parking",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace(

            "Company Name",

            "Company",

            $parse_email_body

        );



        $parse_email_body = str_replace("Ã‚Â£", "£", $parse_email_body);



        $parse_email_body = str_replace("£", "", $parse_email_body);



        $parse_email_body = str_replace("&pound; ", "", $parse_email_body);



        $parse_email_body = str_replace("Â", "", $parse_email_body);



        $parse_email_body = str_replace('\r', "", $parse_email_body);



        $parse_array_aiport = explode("Booking Status:", $parse_email_body);



        $parse_email_body = str_replace(

            "Booking Status:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Amount:", $parse_email_body);



        $data["total_amount"] = trim($parse_array_aiport[1]);



        $data["total_amount"] = str_replace(" ", "", $data["total_amount"]);



        $data["total_amount"] = strip_tags($data["total_amount"]);



        $data["total_amount"] = html_entity_decode($data["total_amount"]);



        $data["total_amount"] = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $data["total_amount"]

        );



        $data["booking_amount"] = trim($parse_array_aiport[1]);



        $data["booking_amount"] = str_replace(" ", "", $data["booking_amount"]);



        $data["booking_amount"] = strip_tags($data["booking_amount"]);



        $data["booking_amount"] = html_entity_decode($data["booking_amount"]);



        $data["booking_amount"] = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $data["booking_amount"]

        );



        $parse_email_body = str_replace(

            "Amount:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Valeting:", $parse_email_body);



        $parse_email_body = str_replace(

            "Valeting:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Passengers:", $parse_email_body);



        $data["passenger"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Passengers:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Flight no:", $parse_email_body);



        $data["returnFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Arrival Flight no:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Terminal:", $parse_email_body);



        $data["returnTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Arrival Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Date/Time:", $parse_email_body);



        $data["returnDate"] = trim(

            date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

        );



        $parse_email_body = str_replace(

            "Arrival Date/Time:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Departure Flight no:",

            $parse_email_body

        );



        $data["deptFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Departure Flight no:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Departure Terminal:", $parse_email_body);



        $data["deprTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Departure Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Departure Date/Time:",

            $parse_email_body

        );



        $data["departDate"] = trim(

            date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

        );



        $parse_email_body = str_replace(

            "Departure Date/Time:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Registration No.:", $parse_email_body);



        $data["registration"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Registration No.:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Colour:", $parse_email_body);



        $data["color"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Colour:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Make:", $parse_email_body);



        $data["make"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Make:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Model:", $parse_email_body);



        $data["model"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Model:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Contact No:", $parse_email_body);



        $data["phone_number"] = trim($parse_array_aiport[1]);



        $parse_email_body = str_replace(

            "Contact No:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Name:", $parse_email_body);



        $name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Name:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $name_arr = explode(" ", $name);



        $data["title"] = $name_arr[1];



        $data["first_name"] = $name_arr[2];



        $data["last_name"] = $name_arr[3];



        $parse_array_aiport = explode("Company:", $parse_email_body);



        $company_name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Company:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Reference Code:", $parse_email_body);



        $data["referenceNo"] = trim($parse_array_aiport[1]);



        $parse_email_body = str_replace(

            "Reference Code:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Airport:", $parse_email_body);



        $airport = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Airport:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["booking_action"] = "Amend";



        $data["amendRequest"] = 1;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        if ($from == "Parking 4 You <noreply@parking4you.co.uk>") {

            $data["agentID"] = 17;
        } elseif (

            $from == "Parking 4 You <noreply@compareparkingdeals.co.uk>"

        ) {

            $data["agentID"] = 6;
        } elseif (

            $from == "Parking 4 You <noreply@compareairportparkings.co.uk>"

        ) {

            $data["agentID"] = 27;
        }



        $data = array_map("trim", $data);



        return $data;
    }





    if (

        ($from == "Parking 4 You <noreply@parking4you.co.uk>" ||

            $from == "Parking 4 You <noreply@compareairportparkings.co.uk>" ||

            $from == "Parking 4 You <noreply@compareparkingdeals.co.uk>") &&

        strpos($from, "Parking 4 You") !== false &&

        strpos($subject, "Ammend") === false &&

        strpos($subject, "Cancelled") !== false

    ) {



        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace(

            "Compare Parking",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace(

            "Company Name",

            "Company",

            $parse_email_body

        );



        $parse_email_body = str_replace("Ã‚Â£", "£", $parse_email_body);



        $parse_email_body = str_replace("£", "", $parse_email_body);



        $parse_email_body = str_replace("&pound; ", "", $parse_email_body);



        $parse_email_body = str_replace("Â", "", $parse_email_body);



        $parse_email_body = str_replace('\r', "", $parse_email_body);



        $parse_array_aiport = explode("Booking Status:", $parse_email_body);



        $parse_email_body = str_replace(

            "Booking Status:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Amount:", $parse_email_body);



        $data["total_amount"] = trim($parse_array_aiport[1]);



        $data["total_amount"] = str_replace(" ", "", $data["total_amount"]);



        $data["total_amount"] = strip_tags($data["total_amount"]);



        $data["total_amount"] = html_entity_decode($data["total_amount"]);



        $data["total_amount"] = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $data["total_amount"]

        );



        $data["booking_amount"] = trim($parse_array_aiport[1]);



        $data["booking_amount"] = str_replace(" ", "", $data["booking_amount"]);



        $data["booking_amount"] = strip_tags($data["booking_amount"]);



        $data["booking_amount"] = html_entity_decode($data["booking_amount"]);



        $data["booking_amount"] = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $data["booking_amount"]

        );



        $parse_email_body = str_replace(

            "Amount:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Valeting:", $parse_email_body);



        $parse_email_body = str_replace(

            "Valeting:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Passengers:", $parse_email_body);



        $data["passenger"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Passengers:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Flight no:", $parse_email_body);



        $data["returnFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Arrival Flight no:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Terminal:", $parse_email_body);



        $data["returnTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Arrival Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Arrival Date/Time:", $parse_email_body);



        $data["returnDate"] = trim(

            date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

        );



        $parse_email_body = str_replace(

            "Arrival Date/Time:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Departure Flight no:",

            $parse_email_body

        );



        $data["deptFlight"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Departure Flight no:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Departure Terminal:", $parse_email_body);



        $data["deprTerminal"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Departure Terminal:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode(

            "Departure Date/Time:",

            $parse_email_body

        );



        $data["departDate"] = trim(

            date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

        );



        $parse_email_body = str_replace(

            "Departure Date/Time:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Registration No.:", $parse_email_body);



        $data["registration"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Registration No.:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Colour:", $parse_email_body);



        $data["color"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Colour:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Make:", $parse_email_body);



        $data["make"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Make:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Model:", $parse_email_body);



        $data["model"] = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Model:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Contact No:", $parse_email_body);



        $data["phone_number"] = trim($parse_array_aiport[1]);



        $parse_email_body = str_replace(

            "Contact No:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Name:", $parse_email_body);



        $name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Name:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $name_arr = explode(" ", $name);



        $data["title"] = $name_arr[1];



        $data["first_name"] = $name_arr[2];



        $data["last_name"] = $name_arr[3];



        $parse_array_aiport = explode("Company:", $parse_email_body);



        $company_name = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Company:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Reference Code:", $parse_email_body);



        $data["referenceNo"] = trim($parse_array_aiport[1]);



        $parse_email_body = str_replace(

            "Reference Code:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );



        $parse_array_aiport = explode("Airport:", $parse_email_body);



        $airport = $parse_array_aiport[1];



        $parse_email_body = str_replace(

            "Airport:" . $parse_array_aiport[1],

            "",

            $parse_email_body

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $data["cancelRequest"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }





    // if (

    //     (strpos($from, "Parking 4 You") !== false &&

    //         $from == "Parking 4 You <noreply@parking4you.co.uk>") ||

    //     $from == "Parking 4 You <noreply@compareairportparkings.co.uk>" ||

    //     ($from == "Parking 4 You <noreply@compareparkingdeals.co.uk>" &&

    //         strpos($subject, "Ammend") === false &&

    //         strpos($subject, "Cancelled") === false)

    // ) {

    //     $parse_email_body = strip_tags($body);



    //     $parse_email_body = trim(

    //         preg_replace("/\s\s+/", " ", $parse_email_body)

    //     );



    //     $parse_email_body = str_replace('\n', "", $parse_email_body);



    //     $parse_email_body = str_replace(

    //         "Compare Parking",

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_email_body = str_replace(

    //         "Company Name",

    //         "Company",

    //         $parse_email_body

    //     );



    //     $parse_email_body = str_replace("Ã‚Â£", "£", $parse_email_body);



    //     $parse_email_body = str_replace("£", "", $parse_email_body);



    //     $parse_email_body = str_replace("&pound; ", "", $parse_email_body);



    //     $parse_email_body = str_replace("Â", "", $parse_email_body);



    //     $parse_email_body = str_replace('\r', "", $parse_email_body);



    //     $parse_array_aiport = explode("Booking Status:", $parse_email_body);



    //     $parse_email_body = str_replace(

    //         "Booking Status:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Amount:", $parse_email_body);



    //     $data["total_amount"] = trim($parse_array_aiport[1]);



    //     $data["total_amount"] = str_replace(" ", "", $data["total_amount"]); 



    //     $data["total_amount"] = strip_tags($data["total_amount"]); 



    //     $data["total_amount"] = html_entity_decode($data["total_amount"]); 



    //     $data["total_amount"] = preg_replace(

    //         '/[^\x20-\x7E]/',

    //         "",

    //         $data["total_amount"]

    //     ); 



    //     $data["booking_amount"] = trim($parse_array_aiport[1]);



    //     $data["booking_amount"] = str_replace(" ", "", $data["booking_amount"]); 



    //     $data["booking_amount"] = strip_tags($data["booking_amount"]); 



    //     $data["booking_amount"] = html_entity_decode($data["booking_amount"]); 



    //     $data["booking_amount"] = preg_replace(

    //         '/[^\x20-\x7E]/',

    //         "",

    //         $data["booking_amount"]

    //     ); 



    //     $parse_email_body = str_replace(

    //         "Amount:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Valeting:", $parse_email_body);



    //     $parse_email_body = str_replace(

    //         "Valeting:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Passengers:", $parse_email_body);



    //     $data["passenger"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Passengers:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Arrival Flight no:", $parse_email_body);



    //     $data["returnFlight"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Arrival Flight no:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Arrival Terminal:", $parse_email_body);



    //     $data["returnTerminal"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Arrival Terminal:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Arrival Date/Time:", $parse_email_body);



    //     $data["returnDate"] = trim(

    //         date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

    //     );



    //     $parse_email_body = str_replace(

    //         "Arrival Date/Time:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode(

    //         "Departure Flight no:",

    //         $parse_email_body

    //     );



    //     $data["deptFlight"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Departure Flight no:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Departure Terminal:", $parse_email_body);



    //     $data["deprTerminal"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Departure Terminal:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode(

    //         "Departure Date/Time:",

    //         $parse_email_body

    //     );



    //     $data["departDate"] = trim(

    //         date("Y-m-d H:i:s", strtotime($parse_array_aiport[1]))

    //     );



    //     $parse_email_body = str_replace(

    //         "Departure Date/Time:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Registration No.:", $parse_email_body);



    //     $data["registration"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Registration No.:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Colour:", $parse_email_body);



    //     $data["color"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Colour:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Make:", $parse_email_body);



    //     $data["make"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Make:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Model:", $parse_email_body);



    //     $data["model"] = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Model:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Contact No:", $parse_email_body);



    //     $data["phone_number"] = trim($parse_array_aiport[1]);



    //     $parse_email_body = str_replace(

    //         "Contact No:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Name:", $parse_email_body);



    //     $name = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Name:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $name_arr = explode(" ", $name);



    //     $data["title"] = $name_arr[1];



    //     $data["first_name"] = $name_arr[2];



    //     $data["last_name"] = $name_arr[3];



    //     $parse_array_aiport = explode("Company:", $parse_email_body);



    //     $company_name = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Company:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Reference Code:", $parse_email_body);



    //     $data["referenceNo"] = trim($parse_array_aiport[1]);



    //     $parse_email_body = str_replace(

    //         "Reference Code:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );



    //     $parse_array_aiport = explode("Airport:", $parse_email_body);



    //     $airport = $parse_array_aiport[1];



    //     $parse_email_body = str_replace(

    //         "Airport:" . $parse_array_aiport[1],

    //         "",

    //         $parse_email_body

    //     );

    //     if($date_time=='' || $date_time=='00:00:00 00:00:00' ){

    //         $date_times= $date_time->format('Y-m-d H:i:s');

    //        }else{

    //           $date_times=$date_time;

    //        }



    //       $data["created_at"] = $date_times;

    //     $data["companyId"] = 117;



    //     $data["airportID"] = 1;



    //     $data["booking_status"] = "Completed";



    //     $data["booking_action"] = "Booked";



    //     $data["traffic_src"] = "Agent";



    //     $data["payment_status"] = "success";



    //     $data["incomplete_email"] = 1;



    //     $earlier = new DateTime($data["departDate"]);



    //     $later = new DateTime($data["returnDate"]);



    //     $data["no_of_days"] = $later->diff($earlier)->format("%a"); 



    //     if ($from == "Parking 4 You <noreply@parking4you.co.uk>") {

    //         $data["agentID"] = 17;

    //     } elseif (

    //         $from == "Parking 4 You <noreply@compareparkingdeals.co.uk>"

    //     ) {

    //         $data["agentID"] = 6;

    //     } elseif (

    //         $from == "Parking 4 You <noreply@compareairportparkings.co.uk>"

    //     ) {

    //         $data["agentID"] = 27;

    //     }



    //     $data = array_map("trim", $data);



    //     return $data;

    // }

    if (

        strpos($from, "Compare The Parking") !== false &&

        strpos($subject, "Cancel") !== false

    ) {



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);

        $parse_email_body = str_replace(

            ["=", '\r', '\n'],

            "",

            $parse_email_body

        );

        $parse_email_body = str_replace(

            ["&nbsp;", "&amp;", "MG Reservations"],

            "",

            $parse_email_body

        );

        $parse_email_body = preg_replace("/\s+/", " ", $parse_email_body);

        $parse_email_body = trim($parse_email_body);



        $parse_email_body = str_replace('\r', "", $parse_email_body);

        $pattern =

            '/Reference:\s*(CTP-\d+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*([^\n]+)\s*Status:\s*([^\n]+)/';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[1],

            "abookedCompany" => $bookingMatches[2],

            "phone_number" => $bookingMatches[4],

            "airportID" => 1,

            "make" => $bookingMatches[5],

            "model" => $bookingMatches[6],

            "color" => $bookingMatches[7],

            "registration" => $bookingMatches[8],

            "departDate" => $bookingMatches[9],

            "deprTerminal" => $bookingMatches[10],

            "deptFlight" => $bookingMatches[11],

            "returnDate" => $bookingMatches[12],

            "returnTerminal" => $bookingMatches[13],

            "returnFlight" => $bookingMatches[14],

            "passenger" => $bookingMatches[15],

            "total_amount" => $bookingMatches[16],

            "booking_amount" => $bookingMatches[16],

        ];



        if (!empty($data["departDate"])) {



            $data["departDate"] = date(

                "Y-m-d H:i:s",

                strtotime(str_replace("/", "-", $data["departDate"]))

            );
        }



        if (!empty($data["returnDate"])) {

            $data["returnDate"] = date(

                "Y-m-d H:i:s",

                strtotime(str_replace("/", "-", $data["returnDate"]))

            );
        }



        $data["total_amount"] = preg_replace(

            "/[^\d.]+/",

            "",

            $data["total_amount"]

        );



        $data["booking_amount"] = preg_replace(

            "/[^\d.]+/",

            "",

            $data["booking_amount"]

        );



        $data["total_amount"] = floatval($data["total_amount"]);



        $data["booking_amount"] = floatval($data["booking_amount"]);



        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["cancelRequest"] = 1;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "Compare The Parking") !== false &&

        strpos($subject, "Amend") !== false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $pattern =

            '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[2],



            "abookedCompany" => $bookingMatches[3],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[7],



            "make" => $bookingMatches[6],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];



        $cleaned_total_amount = str_replace("£", "", $bookingMatches[17]);



        $data["total_amount"] = trim($cleaned_total_amount);



        $cleaned_total_amount_booking = str_replace(

            "£",

            "",

            $bookingMatches[17]

        );



        $data["booking_amount"] = trim($cleaned_total_amount_booking);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );



        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Amend";



        $data["amendRequest"] = 1;



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["payment_status"] = "success";



        $data["agentID"] = 25;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }

    if ($from == "bookings@comparetheairportparking.com" && strpos($subject, "Manchester") !== false) {



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $parse_email_body = str_replace('\r', "", $parse_email_body);

        $pattern =

            '/Booking ID:\s*([^\n]+)\s*Booking Date:\s*([^\n]+)\s*Customer Name:\s*([^\n]+)\s*Parking Space:\s*([^\n]+)\s*Airport:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Telephone No:\s*([^\n]+)\s*Drop Off:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Return Terminal:\s*([^\n]+)\s*Flight No:\s*([^\n]+)\s*Make & Model:\s*([^\n]+)\s*Registration No:\s*([^\n]+)\s*Colour:\s*([^\n]+?)(?=\s*Vehicle|$)/';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[1],

            // "created_at" => $bookingMatches[2],

            "abookedCompany" => $bookingMatches[4],

            "phone_number" => $bookingMatches[7],

            "airportID" => 1,

            "model" => $bookingMatches[13],

            "make" => $bookingMatches[13],

            "color" => $bookingMatches[15],

            "registration" => $bookingMatches[14],

            "departDate" => $bookingMatches[8],

            "deprTerminal" => $bookingMatches[10],

            "returnDate" => $bookingMatches[9],

            "returnTerminal" => $bookingMatches[11],

            "total_amount" => $bookingMatches[6],

            "booking_amount" => $bookingMatches[6],

        ];



        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        // $data["created_at"] = date(

        //     "Y-m-d H:i:s",

        //     strtotime($bookingMatches[2])

        // );



        if (!empty($data["departDate"])) {



            $data["departDate"] = date(

                "Y-m-d H:i:s",

                strtotime(str_replace("/", "-", $data["departDate"]))

            );
        }



        if (!empty($data["returnDate"])) {

            $data["returnDate"] = date(

                "Y-m-d H:i:s",

                strtotime(str_replace("/", "-", $data["returnDate"]))

            );
        }



        $data["total_amount"] = preg_replace(

            "/[^\d.]+/",

            "",

            $data["total_amount"]

        );



        $data["booking_amount"] = preg_replace(

            "/[^\d.]+/",

            "",

            $data["booking_amount"]

        );



        $data["total_amount"] = floatval($data["total_amount"]);



        $data["booking_amount"] = floatval($data["booking_amount"]);



        $fullname = $bookingMatches[3] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["payment_status"] = "success";



        $data["agentID"] = 21;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }

    if ($from == "bookings@comparetheairportparking.com" || strpos($subject, "Supplier temp") !== false || strpos($subject, "Supplier Notification") !== false) {



        // Convert encoding and clean up the body text

        $body = mb_convert_encoding($body, "UTF-8", "auto");

        $parse_email_body = strip_tags($body);

        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $parse_email_body = str_replace('\r', "", $parse_email_body);

        $parse_email_body = preg_replace('/[\x00-\x1F\x7F]/', '', $parse_email_body);

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        // Step 1: Normalize all line breaks (convert \r\n and \r to \n)

        $parse_email_body = str_replace(["\r\n", "\r"], "\n", $parse_email_body);



        // Step 2: Remove all excessive blank lines (more than one consecutive newline)

        $parse_email_body = str_replace("\n\n", "\n", $parse_email_body);

        while (strpos($parse_email_body, "\n\n") !== false) {

            $parse_email_body = str_replace("\n\n", "\n", $parse_email_body);
        }



        // Step 3: Remove excessive spaces (replace double spaces with a single space)

        while (strpos($parse_email_body, "  ") !== false) {

            $parse_email_body = str_replace("  ", " ", $parse_email_body);
        }



        // Step 4: Trim overall leading and trailing spaces/newlines

        $parse_email_body = trim($parse_email_body);



        // Step 5: Keep only content up to "Total: £ xxx.xx"

        $parse_email_body = preg_replace('/(Total:\s*£\s*\d+\.\d+)\s*[\s\S]*/u', '$1', $parse_email_body);

        $parse_email_body = preg_replace('/[^\x20-\x7E]/', '', $parse_email_body);

        $parse_email_body = preg_replace('/[^\x20-\x7E]/', '', $parse_email_body);

        $parse_email_body = mb_convert_encoding($parse_email_body, 'UTF-8', 'auto');

        preg_match('/Total:\s*(?:\n|\r)?\s*£?\s*([\d,]+(?:\.\d{2})?)/i', $parse_email_body, $matches);

        preg_match('/total\s*:\s*(?:\n|\r)?\s*£?\s*([\d,]+(?:\.\d{2})?)/i', $parse_email_body, $matches);









        $patterns = [

            'referenceNo' => '/InvoiceId:\s*\S*-(\d+)/',

            'abookedCompany'   => '/Airport:\s*([^\n]+?)(?=\s*Collection:)/',     // Extract only Airport Name

            'phone_number'     => '/Phone:\s*(\S+)/',                             // Extract Phone Number

            'departDate'       => '/Collection:\s*([\d\/]+\s+\d+:\d+)/',          // Extract Departure Date & Time

            'deprTerminal' => '/Collection:.*?(Terminal\s*\d+)/',

            'returnDate'       => '/Return:\s*([\d\/]+\s+\d+:\d+)/',              // Extract Return Date & Time

            'returnTerminal' => '/Return:.*?(Terminal\s*\d+)/',

            'model' => '/Model:\s*([\w\s]+?)(?=\s*Registration:)/',

            'color'            => '/Color:\s*([\w]+)/',                           // Extract only the Color

            'registration'     => '/Registration:\s*([\w\d]+)/',                  // Extract Vehicle Registration



        ];



        // Extract data using regex

        $data = [];

        foreach ($patterns as $key => $pattern) {

            preg_match($pattern, $parse_email_body, $matches);

            $data[$key] = trim($matches[1] ?? null); // Trim to remove extra spaces

        }

        $pos = stripos($parse_email_body, 'Total:');

        $snippet = substr($parse_email_body, $pos, 50);

        $data['total_amount'] = $snippet;

        $data['booking_amount'] = $snippet;

        $data['total_amount'] = preg_replace("/Total:\s*/", "", $data['total_amount']);

        $data['booking_amount'] = preg_replace("/Total:\s*/", "", $data['booking_amount']);

        $data['airportID'] = 1;



        // Convert dates to proper format

        if (!empty($data["departDate"])) {

            $data["departDate"] = date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $data["departDate"])));
        }



        if (!empty($data["returnDate"])) {

            $data["returnDate"] = date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $data["returnDate"])));
        }



        preg_match('/Name:\s*([A-Za-z\s]+)(?=\s*Phone:)/', $parse_email_body, $matches);



        if (isset($matches[1])) {

            $name = trim($matches[1]); // Extracted name

        } else {
        }

        if (isset($matches[1])) {

            $extracted_fullname = extractNameParts($matches[1]);

            $data["title"] = $extracted_fullname["title"] ?? "";

            $data["first_name"] = $extracted_fullname["first_name"] ?? "";

            $data["last_name"] = $extracted_fullname["last_name"] ?? "";
        }



        // Calculate number of days between collection and return

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);

            $later = new DateTime($data["returnDate"]);

            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        // Additional fields

        $data["companyId"] = 117;

        $data["booking_status"] = "Completed";

        $data["booking_action"] = "Booked";

        $data["traffic_src"] = "Agent";

        $data["incomplete_email"] = 1;

        $data["payment_status"] = "success";

        $data["agentID"] = 21;



        // Trim all values

        $data = array_map("trim", $data);



        return $data;
    }

    if ($from == "bookings@comparetheairportparking.com" && strpos($subject, "Supplier temp") !== false) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);

        $parse_email_body = str_replace(

            ["=", '\r', '\n'],

            "",

            $parse_email_body

        );

        $parse_email_body = str_replace(

            ["&nbsp;", "&amp;", "MG Reservations"],

            "",

            $parse_email_body

        );

        $parse_email_body = preg_replace("/\s+/", " ", $parse_email_body);

        $parse_email_body = trim($parse_email_body);

        $parse_email_body = base64_decode($parse_email_body);

        $parse_email_body = str_replace(["\r", "\n"], " ", $parse_email_body);

        $parse_email_body = str_replace(["\r", "\n", "\\r", "\\n", "\t"], " ", $parse_email_body);

        $parse_email_body = html_entity_decode(strip_tags($parse_email_body)); // Convert HTML entities  

        $parse_email_body = preg_replace('/\s+/', ' ', trim($parse_email_body)); // Normalize spaces  

        $parse_email_body = mb_convert_encoding($parse_email_body, 'UTF-8', 'auto'); // Fix encoding  

        // Define regex patterns

        $patterns = [

            'referenceNo'     => '/InvoiceId:\s*\S*-(\d+)/i',

            'abookedCompany'  => '/Airport:\s*([^\n]+?)(?=\s*Collection:)/i',

            'departDate'      => '/Collection:\s*([\d\/]+\s+\d+:\d+)/i',

            'deprTerminal'  => '/Collection:.*?(Terminal\s*\d+)/i',

            'returnDate'      => '/Return:\s*([\d\/]+\s+\d+:\d+)/i',

            'returnTerminal'  => '/Return:.*?(Terminal\s*\d+)/i',

            'returnFlight'    => '/Flight Number:\s*([\w\d]+)/i',

            'make'         => '/Vehicle:\s*(\d+)/i',

            'name'            => '/Name:\s*([\w]+)/i',

            'color'           => '/Color:\s*([\w]+)/i',

            'model'           => '/Model:\s*([\w\s]+?)(?=\s*Registration:)/i',

            'registration'    => '/Registration:\s*([\w\d]+)/i',



        ];



        // Extract data using regex

        $data = [];

        foreach ($patterns as $key => $pattern) {

            preg_match($pattern, $parse_email_body, $matches);

            $data[$key] = $matches[1] ?? null; // Store the matched value or null if not found

            if ($key === 'name' && !empty($matches[1])) {

                $extracted_fullname = extractNameParts($matches[1]);

                $data["title"] = $extracted_fullname["title"] ?? "";

                $data["first_name"] = $extracted_fullname["first_name"] ?? "";

                $data["last_name"] = $extracted_fullname["last_name"] ?? "";
            } else {

                $data[$key] = $matches[1] ?? null; // Store other matches

            }
        }

        unset($data['name']);





        $pos = stripos($parse_email_body, 'Total:');

        $snippet = substr($parse_email_body, $pos, 50);

        $data['total_amount'] = $snippet;

        $data['booking_amount'] = $snippet;

        $data['total_amount'] = preg_replace("/Total:\s*|compareairportcarparking\.com/", "", $data['total_amount']);

        $data['total_amount'] = trim($data['total_amount']); // Ensure no extra spaces





        $data['booking_amount'] = preg_replace("/Total:\s*|compareairportcarparking\.com/", "", $data['booking_amount']);

        $data['booking_amount'] = trim($data['booking_amount']); // Ensure no extra spaces



        $data['total_amount'] = str_replace("£", "", $data['total_amount']);

        $data['booking_amount'] = str_replace("£", "", $data['booking_amount']);



        $data['airportID'] = 1;



        // Convert dates to proper format

        if (!empty($data["departDate"])) {

            $data["departDate"] = date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $data["departDate"])));
        }



        if (!empty($data["returnDate"])) {

            $data["returnDate"] = date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $data["returnDate"])));
        }



        // Calculate number of days between collection and return

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);

            $later = new DateTime($data["returnDate"]);

            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        // Additional fields

        $data["companyId"] = 117;

        $data["booking_status"] = "Completed";

        $data["booking_action"] = "Booked";

        $data["traffic_src"] = "Agent";

        $data["incomplete_email"] = 1;

        $data["payment_status"] = "success";

        $data["agentID"] = 21;



        // Trim all values

        $data = array_map("trim", $data);



        return $data;
    }



    //     if ($from == "bookings@comparetheairportparking.com" || strpos($subject, "Supplier temp") !== false || strpos($subject, "Supplier Notification") !== false) {

    //         $body = mb_convert_encoding($body, "UTF-8", "auto");



    //         $body = preg_replace('/\xC2\xA0/', " ", $body);



    //         $parse_email_body = strip_tags($body);





    //         $parse_email_body = htmlentities(

    //             $parse_email_body,

    //             ENT_QUOTES,

    //             "utf-8"

    //         );



    //         $parse_email_body = html_entity_decode($parse_email_body);



    //         $parse_email_body = trim(

    //             preg_replace("/\s\s+/", " ", $parse_email_body)

    //         );



    //         $parse_email_body = str_replace('\n', "", $parse_email_body);



    //         $parse_email_body = str_replace("&amp;", "", $parse_email_body);



    //         $parse_email_body = str_replace(

    //             "MG Reservations",

    //             "",

    //             $parse_email_body

    //         );



    //         $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



    //         $parse_email_body = str_replace(

    //             "-------------------------------------------------------------------------------------------------------------------------------------",

    //             "",

    //             $parse_email_body

    //         );



    //         $parse_email_body = str_replace("=20", "", $parse_email_body);



    //         $parse_email_body = str_replace("=", "", $parse_email_body);

    //         $parse_email_body = str_replace(

    //             ["=", '\r', '\n'],

    //             "",

    //             $parse_email_body

    //         );

    //         $parse_email_body = str_replace(

    //             ["&nbsp;", "&amp;", "MG Reservations"],

    //             "",

    //             $parse_email_body

    //         );

    //         $parse_email_body = preg_replace("/\s+/", " ", $parse_email_body);



    //         $parse_email_body = trim($parse_email_body);

    //         $parse_email_body = base64_decode($parse_email_body);

    //         $parse_email_body = str_replace(["\r", "\n"], " ", $parse_email_body);

    //         $parse_email_body = str_replace(["\r", "\n", "\\r", "\\n", "\t"], " ", $parse_email_body);

    //         $parse_email_body = html_entity_decode(strip_tags($parse_email_body)); // Convert HTML entities  

    //         $parse_email_body = preg_replace('/\s+/', ' ', trim($parse_email_body)); // Normalize spaces  

    //         $parse_email_body = mb_convert_encoding($parse_email_body, 'UTF-8', 'auto'); // Fix encoding  



    // // Define regex patterns

    //         $patterns = [

    //             'referenceNo' => '/InvoiceId:\s*\S*-(\d+)/i',

    //             'abookedCompany' => '/Airport:\s*([^\n]+?)(?=\s*Collection:)/i',

    //             'departDate' => '/Collection:\s*([\d\/]+\s+\d+:\d+)/i',

    //             'deprTerminal' => '/Collection:.*?(Terminal\s*\d+)/i',

    //             'returnDate' => '/Return:\s*([\d\/]+\s+\d+:\d+)/i',

    //             'returnTerminal' => '/Return:.*?(Terminal\s*\d+)/i',

    //             'returnFlight' => '/Flight Number:\s*([\w\d]+)/i',

    //             'make' => '/Vehicle:\s*(\d+)/i',

    //             'name' => '/Name:\s*([\w]+)/i',

    //             'color' => '/Color:\s*([\w]+)/i',

    //             'model' => '/Model:\s*([\w\s]+?)(?=\s*Registration:)/i',

    //             'registration' => '/Registration:\s*([\w\d]+)/i',



    //         ];



    //         // Extract data using regex

    //         $data = [];

    //         foreach ($patterns as $key => $pattern) {

    //             preg_match($pattern, $parse_email_body, $matches);

    //             $data[$key] = $matches[1] ?? null; // Store the matched value or null if not found

    //             if ($key === 'name' && !empty($matches[1])) {

    //                 $extracted_fullname = extractNameParts($matches[1]);

    //                 $data["title"] = $extracted_fullname["title"] ?? "";

    //                 $data["first_name"] = $extracted_fullname["first_name"] ?? "";

    //                 $data["last_name"] = $extracted_fullname["last_name"] ?? "";

    //             } else {

    //                 $data[$key] = $matches[1] ?? null; // Store other matches

    //             }

    //         }

    //         unset($data['name']);





    //         $pos = stripos($parse_email_body, 'Total:');

    //         $snippet = substr($parse_email_body, $pos, 50);

    //         $data['total_amount'] = $snippet;

    //         $data['booking_amount'] = $snippet;

    //         $data['total_amount'] = preg_replace("/Total:\s*|compareairportcarparking\.com/", "", $data['total_amount']);

    //         $data['total_amount'] = trim($data['total_amount']); // Ensure no extra spaces





    //         $data['booking_amount'] = preg_replace("/Total:\s*|compareairportcarparking\.com/", "", $data['booking_amount']);

    //         $data['booking_amount'] = trim($data['booking_amount']); // Ensure no extra spaces



    //         $data['total_amount'] = str_replace("£", "", $data['total_amount']);

    //         $data['booking_amount'] = str_replace("£", "", $data['booking_amount']);



    //         $data['airportID'] = 1;



    //         // Convert dates to proper format

    //         if (!empty($data["departDate"])) {

    //             $data["departDate"] = date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $data["departDate"])));

    //         }



    //         if (!empty($data["returnDate"])) {

    //             $data["returnDate"] = date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $data["returnDate"])));

    //         }



    //         // Calculate number of days between collection and return

    //         if ($data["departDate"] && $data["returnDate"]) {

    //             $earlier = new DateTime($data["departDate"]);

    //             $later = new DateTime($data["returnDate"]);

    //             $data["no_of_days"] = $later->diff($earlier)->format("%a");

    //         } else {

    //             $data["no_of_days"] = null;

    //         }



    //         // Additional fields

    //         $data["companyId"] = 117;

    //         $data["booking_status"] = "Completed";

    //         $data["booking_action"] = "Booked";

    //         $data["traffic_src"] = "Agent";

    //         $data["incomplete_email"] = 1;

    //         $data["payment_status"] = "success";

    //         $data["agentID"] = 21;



    //         // Trim all values

    //         $data = array_map("trim", $data);



    //         return $data;

    //     }







    if (

        $from == "noreply@smartparkingdeals.uk" ||

        strpos($from, "Compare Airport Parking Deals") !== false &&

        strpos($subject, "Cancelled") === false &&

        strpos($subject, "Ammend") !== false

    ) {

        $encoding = mb_detect_encoding($body, "UTF-8, ISO-8859-1, ASCII", true);

        if ($encoding !== "UTF-8") {

            $body = mb_convert_encoding($body, "UTF-8", $encoding);
        }



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $pattern =

            '/Airport:\s*([^\n]+)\s*Reference Code:\s*([^\n]+)\s*Company Name:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact No:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration No\.:([^\n]+)\s*Departure Date\/Time:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Departure Flight no:\s*([^\n]+)\s*Arrival Date\/Time:\s*([^\n]+)\s*Arrival Terminal:\s*([^\n]+)\s*Arrival Flight no:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Valeting:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Booking Status:\s*Completed/i';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[2],



            "abookedCompany" => $bookingMatches[3],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[6],



            "make" => $bookingMatches[7],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[18],



            "booking_amount" => $bookingMatches[18],

        ];



        $cleaned_total_amount = str_replace("£", "", $bookingMatches[18]);



        $data["total_amount"] = trim($cleaned_total_amount);



        $cleaned_total_amount_booking = str_replace(

            "£",

            "",

            $bookingMatches[18]

        );



        $data["booking_amount"] = trim($cleaned_total_amount_booking);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );



        $fullname = $bookingMatches[4] ?? "";



        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Amend";



        $data["amendRequest"] = 1;

        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 24;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        $from == "noreply@smartparkingdeals.uk" ||

        (strpos($from, "Compare Airport Parking Deals") !== false &&

            strpos($subject, "Cancelled") !== false)

    ) {



        $encoding = mb_detect_encoding($body, "UTF-8, ISO-8859-1, ASCII", true);

        if ($encoding !== "UTF-8") {

            $body = mb_convert_encoding($body, "UTF-8", $encoding);
        }



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = preg_replace(

            '/\\\r\][\w\W]+?t[z]?/',

            "",

            $parse_email_body

        );



        $parse_email_body = preg_replace(

            '/[\x00-\x1F\x80-\xFF]+/',

            "",

            $parse_email_body

        );



        $parse_email_body = trim($parse_email_body);



        $pattern =

            '/Airport:\s*([^\n]+)\s*Reference Code:\s*([^\n]+)\s*Company Name:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact No:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration No\.:\s*([^\n]+)\s*Departure Date\/Time:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Departure Flight no:\s*([^\n]*)\s*Arrival Date\/Time:\s*([^\n]+)\s*Arrival Terminal:\s*([^\n]+)\s*Arrival Flight no:\s*([^\n]*)\s*Passengers:\s*([^\n]+)\s*Valeting:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Booking Status:\s*([^\n]+)/i';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[2],



            "abookedCompany" => $bookingMatches[3],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[6],



            "make" => $bookingMatches[7],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[18],



            "booking_amount" => $bookingMatches[18],

        ];



        $cleaned_total_amount = str_replace("£", "", $bookingMatches[18]);



        $data["total_amount"] = trim($cleaned_total_amount);



        $cleaned_total_amount_booking = str_replace(

            "£",

            "",

            $bookingMatches[18]

        );



        $data["booking_amount"] = trim($cleaned_total_amount_booking);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );



        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $data["cancelRequest"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        $from == "noreply@smartparkingdeals.uk" ||

        strpos($from, "Smart Parking Deals") !== false ||

        strpos($from, "Budget Airport Parking Deals") !== false ||

        strpos($from, "Compare Airport Parking Deals") !== false

    ) {

        $encoding = mb_detect_encoding($body, "UTF-8, ISO-8859-1, ASCII", true);

        if ($encoding !== "UTF-8") {

            $body = mb_convert_encoding($body, "UTF-8", $encoding);
        }



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $pattern =

            '/Airport:\s*([^\n]+)\s*Reference Code:\s*([^\n]+)\s*Company Name:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact No:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration No\.:([^\n]+)\s*Departure Date\/Time:\s*([^\n]+)\s*Departure Terminal:\s*([^\n]+)\s*Departure Flight no:\s*([^\n]+)\s*Arrival Date\/Time:\s*([^\n]+)\s*Arrival Terminal:\s*([^\n]+)\s*Arrival Flight no:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Valeting:\s*([^\n]+)\s*Amount:\s*([^\n]+)\s*Booking Status:\s*Completed/i';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[2],



            "abookedCompany" => $bookingMatches[3],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[6],



            "make" => $bookingMatches[7],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[18],



            "booking_amount" => $bookingMatches[18],

        ];



        $cleaned_total_amount = str_replace("£", "", $bookingMatches[18]);



        $data["total_amount"] = trim($cleaned_total_amount);



        $cleaned_total_amount_booking = str_replace(

            "£",

            "",

            $bookingMatches[18]

        );



        $data["booking_amount"] = trim($cleaned_total_amount_booking);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;



        $fullname = $bookingMatches[4] ?? "";



        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 24;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }



    if (

        strpos($from, "Compare Your Parking") !== false &&

        strpos($subject, "Cancel") !== false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $pattern =

            '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[2],



            "abookedCompany" => $bookingMatches[3],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[6],



            "make" => $bookingMatches[7],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];



        $cleaned_total_amount = str_replace("£", "", $bookingMatches[17]);



        $data["total_amount"] = trim($cleaned_total_amount);



        $cleaned_total_amount_booking = str_replace(

            "£",

            "",

            $bookingMatches[17]

        );



        $data["booking_amount"] = trim($cleaned_total_amount_booking);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );



        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["cancelRequest"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "Compare Your Parking") !== false &&

        strpos($subject, "Amend") !== false

    ) {



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $pattern =

            '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[2],



            "abookedCompany" => $bookingMatches[3],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[6],



            "make" => $bookingMatches[7],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];



        $cleaned_total_amount = str_replace("£", "", $bookingMatches[17]);



        $data["total_amount"] = trim($cleaned_total_amount);



        $cleaned_total_amount_booking = str_replace(

            "£",

            "",

            $bookingMatches[17]

        );



        $data["booking_amount"] = trim($cleaned_total_amount_booking);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Amend";



        $data["amendRequest"] = 1;

        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 22;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }



    if (strpos($from, "Compare Your Parking") !== false) {



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $pattern =

            '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[2],



            "abookedCompany" => $bookingMatches[3],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[6],



            "make" => $bookingMatches[7],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];



        $cleaned_total_amount = str_replace("£", "", $bookingMatches[17]);



        $data["total_amount"] = trim($cleaned_total_amount);



        $cleaned_total_amount_booking = str_replace(

            "£",

            "",

            $bookingMatches[17]

        );



        $data["booking_amount"] = trim($cleaned_total_amount_booking);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 22;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }



    if (

        strpos($from, "Compare The Parking") !== false &&

        strpos($subject, "Amend") === false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $pattern =

            '/Airport:\s*([^\n]+)\s*Reference:\s*([^\n]+)\s*Product:\s*([^\n]+)\s*Name:\s*([^\n]+)\s*Contact:\s*([^\n]+)\s*Make:\s*([^\n]+)\s*Model:\s*([^\n]+)\s*Colour:\s*([^\n]+)\s*Registration:\s*([^\n]+)\s*Departure:\s*([^\n]+)\s*DepTerminal:\s*([^\n]+)\s*DepFlight:\s*([^\n]+)\s*Return:\s*([^\n]+)\s*ReturnTerminal:\s*([^\n]+)\s*ReturnFlight:\s*([^\n]+)\s*Passengers:\s*([^\n]+)\s*Quote:\s*£\s*([^\n]+)\s*Status:\s*([^\n]+)/i';



        preg_match($pattern, $parse_email_body, $bookingMatches);



        $data = [

            "referenceNo" => $bookingMatches[2],



            "abookedCompany" => $bookingMatches[3],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[7],



            "make" => $bookingMatches[6],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];



        $cleaned_total_amount = str_replace("£", "", $bookingMatches[17]);



        $data["total_amount"] = trim($cleaned_total_amount);



        $cleaned_total_amount_booking = str_replace(

            "£",

            "",

            $bookingMatches[17]

        );



        $data["booking_amount"] = trim($cleaned_total_amount_booking);



        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["payment_status"] = "success";



        $data["agentID"] = 25;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }



    if (

        strpos($from, "Airport Cheap Parking") !== false &&

        strpos($subject, "Cancelled") === false && strpos($subject, "Ammend") === false

    ) {



        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace(

            ["\n", "Â", "\r", "]v4_}]]}", "&pound; ", "Ã‚Â£"],

            ["", "", "", "", "£", ""],

            $parse_email_body

        );



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $pattern = [

            "airport" => "/Airport:\s*(\S+)/",



            "reference_code" => "/Reference Code:\s*(\S+)/",



            "company" => "/Company Name:\s*(.*?)\s*Name:/",

            "name" => "/Name:\s*([^:]+?)\s*Contact No:/",

            "contact_no" => "/Contact No:\s*(\d+)/",



            "model" => "/Model:\s*(\S+)/",



            "make" => "/Make:\s*(\S+)/",



            "colour" => "/Colour:\s*(\S+)/",



            "registration_no" => "/Registration No.:\s*(\S+)/",



            "departure_date" => "/Departure Date\/Time:\s*(.*)/",



            "departure_terminal" => "/Departure Terminal:\s*(\S+)/",



            "departure_flight" => "/Departure Flight no:\s*(\S+)/",



            "arrival_date" => "/Arrival Date\/Time:\s*(.*)/",



            "arrival_terminal" => "/Arrival Terminal:\s*(\S+)/",



            "arrival_flight" => "/Arrival Flight no:\s*(\S+)/",



            "passengers" => "/Passengers:\s*(\d+)/",



            "valeting" => "/Valeting:\s*(\S+)/",



            "amount" => "/Amount(?:[:\s]*)[£]?\s*([\d,]+(?:\.\d{1,2})?)/i",



            "booking_status" => "/Booking Status:\s*(\S+)/",

        ];



        $bookingMatches = [];



        foreach ($pattern as $key => $regex) {

            if (preg_match($regex, $parse_email_body, $matches)) {

                $bookingMatches[$key] = $matches[1];
            }
        }



        if (!empty($bookingMatches["amount"])) {

            $bookingMatches["amount"] = str_replace(

                ",",

                "",

                $bookingMatches["amount"]

            );
        }



        $data = [

            "referenceNo" => $bookingMatches["reference_code"] ?? "",



            "abookedCompany" => $bookingMatches["company"] ?? "",



            "phone_number" => $bookingMatches["contact_no"] ?? "",



            "airportID" => 1,



            "model" => $bookingMatches["model"] ?? "",



            "make" => $bookingMatches["make"] ?? "",



            "color" => $bookingMatches["colour"] ?? "",



            "registration" => $bookingMatches["registration_no"] ?? "",



            "deprTerminal" => $bookingMatches["departure_terminal"] ?? "",



            "deptFlight" => $bookingMatches["departure_flight"] ?? "",



            "returnTerminal" => $bookingMatches["arrival_terminal"] ?? "",



            "returnFlight" => $bookingMatches["arrival_flight"] ?? "",



            "passenger" => $bookingMatches["passengers"] ?? "",



            "total_amount" => $bookingMatches["amount"] ?? "",

            "booking_amount" => $bookingMatches["amount"] ?? "",



        ];



        if (!empty($bookingMatches["departure_date"])) {

            $departureDate = $bookingMatches["departure_date"];



            $dateParts = explode(" ", $departureDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedDepartureDate = $date . " " . $time;



            $data["departDate"] =

                date("Y-m-d H:i:s", strtotime($formattedDepartureDate)) ?: null;
        }



        if (!empty($bookingMatches["arrival_date"])) {

            $arrivalDate = $bookingMatches["arrival_date"];



            $dateParts = explode(" ", $arrivalDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedArrivalDate = $date . " " . $time;



            $data["returnDate"] =

                date("Y-m-d H:i:s", strtotime($formattedArrivalDate)) ?: null;
        }



        $fullname = $bookingMatches["name"] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 26;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "Airport Cheap Parking") !== false && strpos($subject, "Ammend") !== false

    ) {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace(

            ["\n", "Â", "\r", "]v4_}]]}", "&pound; ", "Ã‚Â£"],

            ["", "", "", "", "£", ""],

            $parse_email_body

        );



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $pattern = [

            "airport" => "/Airport:\s*(\S+)/",



            "reference_code" => "/Reference Code:\s*(\S+)/",



            "company" => "/Company Name:\s*(.*?)\s*Name:/",

            "name" => "/Name:\s*([^:]+?)\s*Contact No:/",

            "contact_no" => "/Contact No:\s*(\d+)/",



            "model" => "/Model:\s*(\S+)/",



            "make" => "/Make:\s*(\S+)/",



            "colour" => "/Colour:\s*(\S+)/",



            "registration_no" => "/Registration No.:\s*(\S+)/",



            "departure_date" => "/Departure Date\/Time:\s*(.*)/",



            "departure_terminal" => "/Departure Terminal:\s*(\S+)/",



            "departure_flight" => "/Departure Flight no:\s*(\S+)/",



            "arrival_date" => "/Arrival Date\/Time:\s*(.*)/",



            "arrival_terminal" => "/Arrival Terminal:\s*(\S+)/",



            "arrival_flight" => "/Arrival Flight no:\s*(\S+)/",



            "passengers" => "/Passengers:\s*(\d+)/",



            "valeting" => "/Valeting:\s*(\S+)/",



            "amount" => "/Amount(?:[:\s]*)[£]?\s*([\d,]+(?:\.\d{1,2})?)/i",



            "booking_status" => "/Booking Status:\s*(\S+)/",

        ];



        $bookingMatches = [];



        foreach ($pattern as $key => $regex) {

            if (preg_match($regex, $parse_email_body, $matches)) {

                $bookingMatches[$key] = $matches[1];
            }
        }



        if (!empty($bookingMatches["amount"])) {

            $bookingMatches["amount"] = str_replace(

                ",",

                "",

                $bookingMatches["amount"]

            );
        }



        $data = [

            "referenceNo" => $bookingMatches["reference_code"] ?? "",



            "abookedCompany" => $bookingMatches["company"] ?? "",



            "phone_number" => $bookingMatches["contact_no"] ?? "",



            "airportID" => 1,



            "model" => $bookingMatches["model"] ?? "",



            "make" => $bookingMatches["make"] ?? "",



            "color" => $bookingMatches["colour"] ?? "",



            "registration" => $bookingMatches["registration_no"] ?? "",



            "deprTerminal" => $bookingMatches["departure_terminal"] ?? "",



            "deptFlight" => $bookingMatches["departure_flight"] ?? "",



            "returnTerminal" => $bookingMatches["arrival_terminal"] ?? "",



            "returnFlight" => $bookingMatches["arrival_flight"] ?? "",



            "passenger" => $bookingMatches["passengers"] ?? "",



            "total_amount" => $bookingMatches["amount"] ?? "",

            "booking_amount" => $bookingMatches["amount"] ?? "",



        ];



        if (!empty($bookingMatches["departure_date"])) {

            $departureDate = $bookingMatches["departure_date"];



            $dateParts = explode(" ", $departureDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedDepartureDate = $date . " " . $time;



            $data["departDate"] =

                date("Y-m-d H:i:s", strtotime($formattedDepartureDate)) ?: null;
        }



        if (!empty($bookingMatches["arrival_date"])) {

            $arrivalDate = $bookingMatches["arrival_date"];



            $dateParts = explode(" ", $arrivalDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedArrivalDate = $date . " " . $time;



            $data["returnDate"] =

                date("Y-m-d H:i:s", strtotime($formattedArrivalDate)) ?: null;
        }



        $fullname = $bookingMatches["name"] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        // $data["booking_action"] = "Booked";

        $data["booking_action"] = "Amend";



        $data["amendRequest"] = 1;

        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 26;



        $data = array_map("trim", $data);



        return $data;
    }



    if (

        strpos($from, "Airport Cheap Parking") !== false &&

        strpos($subject, "Cancelled") !== false

    ) {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace(

            ["\n", "Â", "\r", "]v4_}]]}", "&pound; ", "Ã‚Â£"],

            ["", "", "", "", "£", ""],

            $parse_email_body

        );



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $pattern = [

            "airport" => "/Airport:\s*(\S+)/",



            "reference_code" => "/Reference Code:\s*(\S+)/",



            "company" => "/Company Name:\s*(.*?)\s*Name:/",

            "name" => "/Name:\s*([^:]+?)\s*Contact No:/",



            "contact_no" => "/Contact No:\s*(\d+)/",



            "model" => "/Model:\s*(\S+)/",



            "make" => "/Make:\s*(\S+)/",



            "colour" => "/Colour:\s*(\S+)/",



            "registration_no" => "/Registration No.:\s*(\S+)/",



            "departure_date" => "/Departure Date\/Time:\s*(.*)/",



            "departure_terminal" => "/Departure Terminal:\s*(\S+)/",



            "departure_flight" => "/Departure Flight no:\s*(\S+)/",



            "arrival_date" => "/Arrival Date\/Time:\s*(.*)/",



            "arrival_terminal" => "/Arrival Terminal:\s*(\S+)/",



            "arrival_flight" => "/Arrival Flight no:\s*(\S+)/",



            "passengers" => "/Passengers:\s*(\d+)/",



            "valeting" => "/Valeting:\s*(\S+)/",



            "amount" => "/Amount(?:[:\s]*)[£]?\s*([\d,]+(?:\.\d{1,2})?)/i",



            "booking_status" => "/Booking Status:\s*(\S+)/",

        ];



        $bookingMatches = [];



        foreach ($pattern as $key => $regex) {

            if (preg_match($regex, $parse_email_body, $matches)) {

                $bookingMatches[$key] = $matches[1];
            }
        }



        if (!empty($bookingMatches["amount"])) {

            $bookingMatches["amount"] = str_replace(

                ",",

                "",

                $bookingMatches["amount"]

            );
        }



        $data = [

            "referenceNo" => $bookingMatches["reference_code"] ?? "",



            "abookedCompany" => $bookingMatches["company"] ?? "",



            "phone_number" => $bookingMatches["contact_no"] ?? "",



            "airportID" => 1,



            "model" => $bookingMatches["model"] ?? "",



            "make" => $bookingMatches["make"] ?? "",



            "color" => $bookingMatches["colour"] ?? "",



            "registration" => $bookingMatches["registration_no"] ?? "",



            "deprTerminal" => $bookingMatches["departure_terminal"] ?? "",



            "deptFlight" => $bookingMatches["departure_flight"] ?? "",



            "returnTerminal" => $bookingMatches["arrival_terminal"] ?? "",



            "returnFlight" => $bookingMatches["arrival_flight"] ?? "",



            "passenger" => $bookingMatches["passengers"] ?? "",



            "total_amount" => $bookingMatches["amount"] ?? "",

        ];



        if (!empty($bookingMatches["departure_date"])) {

            $departureDate = $bookingMatches["departure_date"];



            $dateParts = explode(" ", $departureDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedDepartureDate = $date . " " . $time;



            $data["departDate"] =

                date("Y-m-d H:i:s", strtotime($formattedDepartureDate)) ?: null;
        }



        if (!empty($bookingMatches["arrival_date"])) {

            $arrivalDate = $bookingMatches["arrival_date"];



            $dateParts = explode(" ", $arrivalDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedArrivalDate = $date . " " . $time;



            $data["returnDate"] =

                date("Y-m-d H:i:s", strtotime($formattedArrivalDate)) ?: null;
        }

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches["name"] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["cancelRequest"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }







    if (

        strpos($from, "GoCompareParking") !== false &&

        strpos($subject, "Cancelled") === false && strpos($subject, "Ammend") === false

    ) {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace(

            ["\n", "Â", "\r", "]v4_}]]}", "&pound; ", "Ã‚Â£"],

            ["", "", "", "", "£", ""],

            $parse_email_body

        );



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $pattern = [

            "airport" => "/Airport:\s*(\S+)/",



            "reference_code" => "/Reference Code:\s*(\S+)/",



            "company" => "/Company Name:\s*(.*?)\s*Name:/",

            "name" => "/Name:\s*([^:]+?)\s*Contact No:/",

            "contact_no" => "/Contact No:\s*(\d+)/",



            "model" => "/Model:\s*(\S+)/",



            "make" => "/Make:\s*(\S+)/",



            "colour" => "/Colour:\s*(\S+)/",



            "registration_no" => "/Registration No.:\s*(\S+)/",



            "departure_date" => "/Departure Date\/Time:\s*(.*)/",



            "departure_terminal" => "/Departure Terminal:\s*(\S+)/",



            "departure_flight" => "/Departure Flight no:\s*(\S+)/",



            "arrival_date" => "/Arrival Date\/Time:\s*(.*)/",



            "arrival_terminal" => "/Arrival Terminal:\s*(\S+)/",



            "arrival_flight" => "/Arrival Flight no:\s*(\S+)/",



            "passengers" => "/Passengers:\s*(\d+)/",



            "valeting" => "/Valeting:\s*(\S+)/",



            "amount" => "/Amount(?:[:\s]*)[£]?\s*([\d,]+(?:\.\d{1,2})?)/i",



            "booking_status" => "/Booking Status:\s*(\S+)/",

        ];



        $bookingMatches = [];



        foreach ($pattern as $key => $regex) {

            if (preg_match($regex, $parse_email_body, $matches)) {

                $bookingMatches[$key] = $matches[1];
            }
        }



        if (!empty($bookingMatches["amount"])) {

            $bookingMatches["amount"] = str_replace(

                ",",

                "",

                $bookingMatches["amount"]

            );
        }



        $data = [

            "referenceNo" => $bookingMatches["reference_code"] ?? "",



            "abookedCompany" => $bookingMatches["company"] ?? "",



            "phone_number" => $bookingMatches["contact_no"] ?? "",



            "airportID" => 1,



            "model" => $bookingMatches["model"] ?? "",



            "make" => $bookingMatches["make"] ?? "",



            "color" => $bookingMatches["colour"] ?? "",



            "registration" => $bookingMatches["registration_no"] ?? "",



            "deprTerminal" => $bookingMatches["departure_terminal"] ?? "",



            "deptFlight" => $bookingMatches["departure_flight"] ?? "",



            "returnTerminal" => $bookingMatches["arrival_terminal"] ?? "",



            "returnFlight" => $bookingMatches["arrival_flight"] ?? "",



            "passenger" => $bookingMatches["passengers"] ?? "",



            "total_amount" => $bookingMatches["amount"] ?? "",

            "booking_amount" => $bookingMatches["amount"] ?? "",

        ];



        if (!empty($bookingMatches["departure_date"])) {

            $departureDate = $bookingMatches["departure_date"];



            $dateParts = explode(" ", $departureDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedDepartureDate = $date . " " . $time;



            $data["departDate"] =

                date("Y-m-d H:i:s", strtotime($formattedDepartureDate)) ?: null;
        }



        if (!empty($bookingMatches["arrival_date"])) {

            $arrivalDate = $bookingMatches["arrival_date"];



            $dateParts = explode(" ", $arrivalDate);



            $date = $dateParts[0];



            $time = $dateParts[1] ?? "";



            $date = implode("-", array_reverse(explode("/", $date)));



            $formattedArrivalDate = $date . " " . $time;



            $data["returnDate"] =

                date("Y-m-d H:i:s", strtotime($formattedArrivalDate)) ?: null;
        }



        $fullname = $bookingMatches["name"] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 31;



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "Compare Parking Prices") !== false

        && strpos($subject, "Cancelled") === false

    ) {



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);

        // Decode quoted-printable encoding (if applicable)

        $parse_email_body = quoted_printable_decode($parse_email_body);



        // Remove hidden characters

        $parse_email_body = preg_replace('/[^\P{C}\t\n]+/u', '', $parse_email_body);







        // Remove trailing spaces from lines

        $parse_email_body = preg_replace('/[ \t]+$/m', '', $parse_email_body);

        $parse_email_body = str_replace(["  ", "   "], "\n", $parse_email_body);

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode special email characters

        $parse_email_body = preg_replace('/\r\n|\r/', "\n", $parse_email_body); // Normalize newlines

        $parse_email_body = trim($parse_email_body); // Trim spaces



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode email

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Normalize spaces

        $parse_email_body = trim($parse_email_body); // Trim start & end spaces

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);



        $pattern = '/Reference Code:\s*(.*?)\s*Company Name:\s*(.*?)\s*Airport:\s*(.*?)\s*Name:\s*(.*?)\s*Contact No:\s*(.*?)\s*Model:\s*(.*?)\s*Make:\s*(.*?)\s*Colour:\s*(.*?)\s*Registration No.:\s*(.*?)\s*Departure Date\/Time:\s*(.*?)\s*Departure Terminal:\s*(.*?)\s*Departure Flight no:\s*(.*?)\s*Arrival Date\/Time:\s*(.*?)\s*Arrival Terminal:\s*(.*?)\s*Arrival Flight no:\s*(.*?)\s*Valeting:\s*(.*?)\s*Amount:\s*([\d\.]+)(?: Pounds)?/s';









        preg_match($pattern, $parse_email_body, $bookingMatches);





        $data = [

            "referenceNo" => $bookingMatches[1],



            "abookedCompany" => $bookingMatches[2],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[7],



            "make" => $bookingMatches[6],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];















        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["payment_status"] = "success";



        $data["agentID"] = 32;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "Compare Parking Prices") !== false

        && strpos($subject, "Cancelled") !== false

    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);

        // Decode quoted-printable encoding (if applicable)

        $parse_email_body = quoted_printable_decode($parse_email_body);



        // Remove hidden characters

        $parse_email_body = preg_replace('/[^\P{C}\t\n]+/u', '', $parse_email_body);







        // Remove trailing spaces from lines

        $parse_email_body = preg_replace('/[ \t]+$/m', '', $parse_email_body);

        $parse_email_body = str_replace(["  ", "   "], "\n", $parse_email_body);

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode special email characters

        $parse_email_body = preg_replace('/\r\n|\r/', "\n", $parse_email_body); // Normalize newlines

        $parse_email_body = trim($parse_email_body); // Trim spaces



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode email

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Normalize spaces

        $parse_email_body = trim($parse_email_body); // Trim start & end spaces

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);



        $pattern = '/Reference Code:\s*(.*?)\s*Company Name:\s*(.*?)\s*Airport:\s*(.*?)\s*Name:\s*(.*?)\s*Contact no:\s*(.*?)\s*Model:\s*(.*?)\s*Make:\s*(.*?)\s*Colour:\s*(.*?)\s*Registration no:\s*(.*?)\s*Departure Date\/Time:\s*(.*?)\s*Departure Terminal:\s*(.*?)\s*Departure Flight no:\s*(.*?)\s*Arrival Date\/Time:\s*(.*?)\s*Arrival Terminal:\s*(.*?)\s*Arrival Flight no:\s*(.*?)\s*Valeting:\s*(.*?)\s*Amount:\s*([\d\.]+)/s';









        preg_match($pattern, $parse_email_body, $bookingMatches);





        $data = [

            "referenceNo"      => $bookingMatches[1],

            "abookedCompany"   => $bookingMatches[2],

            "airportID"        => 1, // assuming fixed Manchester mapping

            "passenger"        => $bookingMatches[4],

            "phone_number"     => $bookingMatches[5],

            "model"            => $bookingMatches[6],

            "make"             => $bookingMatches[7],

            "color"            => $bookingMatches[8],

            "registration"     => $bookingMatches[9],

            "departDate"       => $bookingMatches[10],

            "deprTerminal"     => $bookingMatches[11],

            "deptFlight"       => $bookingMatches[12],

            "returnDate"       => $bookingMatches[13],

            "returnTerminal"   => $bookingMatches[14],

            "returnFlight"     => $bookingMatches[15],

            "valeting"         => $bookingMatches[16],

            "total_amount"     => $bookingMatches[17],

            "booking_amount"   => $bookingMatches[17],

        ];













        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";







        $data["cancelRequest"] = 1;



        $data = array_map("trim", $data);



        return $data;
    }
 if (

        strpos($from, "Ezybook Airport Parking") !== false
        && strpos($subject, "Cancelled") !== false

    ) {
        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



      



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $parse_email_body = quoted_printable_decode($parse_email_body);





        $parse_email_body = preg_replace('/[^\P{C}\t\n]+/u', '', $parse_email_body);



        $parse_email_body = preg_replace('/[ \t]+$/m', '', $parse_email_body);

        $parse_email_body = str_replace(["  ", "   "], "\n", $parse_email_body);

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode special email characters

        $parse_email_body = preg_replace('/\r\n|\r/', "\n", $parse_email_body); // Normalize newlines

        $parse_email_body = trim($parse_email_body); // Trim spaces



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode email

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Normalize spaces

        $parse_email_body = trim($parse_email_body); // Trim start & end spaces

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);

        // Remove escaped quotes
        $parse_email_body = str_replace(['\\"', "\\'"], ['"', "'"], $parse_email_body);

        // Optional: remove date after amount
        // Clean up MIME base64 attachment block dynamically
      $pattern = '/Reference Code:\s*(.*?)\s*Company Name:\s*(.*?)\s*Airport:\s*(.*?)\s*Name:\s*(.*?)\s*Contact no:\s*(.*?)\s*Model:\s*(.*?)\s*Make:\s*(.*?)\s*Colour:\s*(.*?)\s*Registration no:\s*(.*?)\s*Departure Date\/Time:\s*(.*?)\s*Departure Terminal:\s*(.*?)\s*Departure Flight no:\s*(.*?)\s*Arrival Date\/Time:\s*(.*?)\s*Arrival Terminal:\s*(.*?)\s*Arrival Flight no:\s*(.*?)\s*Valeting:\s*(.*?)\s*Amount:\s*([\d\.]+)/s';

   preg_match($pattern, $parse_email_body, $bookingMatches);
          $data = [

            "referenceNo" => $bookingMatches[1],
             "abookedCompany" => $bookingMatches[2],
             "phone_number" => $bookingMatches[5],
             "airportID" => 1,



            "model" => $bookingMatches[7],



            "make" => $bookingMatches[6],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];
 


        $data["cancelRequest"] = 1;


        $data = array_map("trim", $data);


        return $data;
    }
    if (

        strpos($from, "Ezybook Airport Parking") !== false
      && strpos($subject, "Cancelled") === false
    ) {

        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);



        $parse_email_body = quoted_printable_decode($parse_email_body);





        $parse_email_body = preg_replace('/[^\P{C}\t\n]+/u', '', $parse_email_body);



        $parse_email_body = preg_replace('/[ \t]+$/m', '', $parse_email_body);

        $parse_email_body = str_replace(["  ", "   "], "\n", $parse_email_body);

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode special email characters

        $parse_email_body = preg_replace('/\r\n|\r/', "\n", $parse_email_body); // Normalize newlines

        $parse_email_body = trim($parse_email_body); // Trim spaces



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode email

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Normalize spaces

        $parse_email_body = trim($parse_email_body); // Trim start & end spaces

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);

        // Remove escaped quotes
        $parse_email_body = str_replace(['\\"', "\\'"], ['"', "'"], $parse_email_body);

        // Optional: remove date after amount
        // Clean up MIME base64 attachment block dynamically
        $parse_email_body = preg_replace('/--b1_[a-z0-9]+Content-Type: application\/octet-stream;.*?--b1_[a-z0-9]+--/is', '', $parse_email_body);



        $pattern = '/Reference Code:\s*(.*?)\s*Company Name:\s*(.*?)\s*Airport:\s*(.*?)\s*Name:\s*(.*?)\s*Contact No:\s*(.*?)\s*Model:\s*(.*?)\s*Make:\s*(.*?)\s*Colour:\s*(.*?)\s*Registration No.:\s*(.*?)\s*Departure Date\/Time:\s*(.*?)\s*Departure Terminal:\s*(.*?)\s*Departure Flight no:\s*(.*?)\s*Arrival Date\/Time:\s*(.*?)\s*Arrival Terminal:\s*(.*?)\s*Arrival Flight no:\s*(.*?)\s*Valeting:\s*(.*?)\s*Amount:\s*([\d\.]+)(?: Pounds)?/s';









        preg_match($pattern, $parse_email_body, $bookingMatches);





        $data = [

            "referenceNo" => $bookingMatches[1],



            "abookedCompany" => $bookingMatches[2],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[7],



            "make" => $bookingMatches[6],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];















        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["payment_status"] = "success";



        $data["agentID"] = 33;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }

    if (

        strpos($from, "Parki Booking") !== false && strpos($from, "booking@parki.co.uk")

    ) {

        $parse_email_body = strip_tags($body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace(

            ["\n", "Â", "\r", "]v4_}]]}", "&pound; ", "Ã‚Â£"],

            ["", "", "", "", "£", ""],

            $parse_email_body

        );

        // Step 1: Decode quoted-printable characters

        $parse_email_body = quoted_printable_decode($parse_email_body);



        // Step 2: Remove HTML tags

        $parse_email_body = strip_tags($parse_email_body);



        // Step 3: Decode HTML entities

        $parse_email_body = html_entity_decode($parse_email_body);



        // Step 4: Remove non-ASCII characters

        $parse_email_body = preg_replace('/[^\x20-\x7E]/', '', $parse_email_body);



        // Step 5: Keep content starting from "Reference Code" or "Company Name"

        $parse_email_body = preg_replace('/^.*?(Reference Code:|Company Name:)/s', '$1', $parse_email_body);



        // Step 6: Remove "Booking Fee" line

        $parse_email_body = preg_replace('/Booking Fee:.*?(?=Total Amount \(all included\):|$)/', '', $parse_email_body);



        // Step 7: Remove "Total Amount (all included)" line

        $parse_email_body = preg_replace('/Total Amount \(all included\):.*?(?=Thank you|Parki|$)/', '', $parse_email_body);



        // Step 8: Remove footer lines if present

        $parse_email_body = preg_replace('/Thank you for partnering with Parki!.*$/s', '', $parse_email_body);



        // Step 9: Normalize whitespace

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);





        $parse_email_body = str_replace('\n', "", $parse_email_body);



        // 5) Trim leading/trailing spaces

        $parse_email_body = trim($parse_email_body);





        $pattern = [



            "reference_code" => "/Reference Code:\s*(\S+)/",



            "company" => "/Company Name:\s*(.*?)\s*Airport:/",

            "airport" => "/Airport:\s*(.*?)(?:Name:|Company Name:|Model:|Contact No:|$)/i",

            "name" => "/Name:\s*([^:]+?)\s*Contact No:/",

            "contact_no" => "/Contact No:\s*(\d+)/",



            "model" => "/Model:\s*(\S+)/",



            "make" => "/Make:\s*(\S+)/",



            "colour" => "/Colour:\s*(\S+)/",



            "registration_no" => "/Registration No.:\s*(\S+)/",



            "departure_date" => "/Departure Date\/Time:\s*([^=]+)/",



            "departure_terminal" => "/Departure Terminal:\s*(.*?)\s*(Arrival Date|$)/",



            "departure_flight" => "/Departure Flight No:\s*(\S+)/i",



            "arrival_date"   => "/Arrival Date\/Time:\s*([A-Za-z]{3},\s*\d{2}\s*[A-Za-z]{3}\s*\d{4}\s*\d{2}:\d{2})/",



            "arrival_terminal" => "/Arrival Terminal:\s*(.*?)\s*(Arrival Flight|$)/",



            "arrival_flight" => "/Arrival Flight No:\s*(\S+)/i",



            "passengers" => "/Passengers:\s*(\d+)/",



            "valeting" => "/Valeting:\s*(\S+)/",



            "amount" => "/Actual Booking Price:\s*(?:£|=C2=A3)?\s*([\d]+\.\d{2})/i"

        ];



        $bookingMatches = [];



        foreach ($pattern as $key => $regex) {

            if (preg_match($regex, $parse_email_body, $matches)) {

                $bookingMatches[$key] = $matches[1];
            }
        }



        if (!empty($bookingMatches["amount"])) {

            $bookingMatches["amount"] = str_replace(

                ",",

                "",

                $bookingMatches["amount"]

            );
        }



        $data = [

            "referenceNo" => $bookingMatches["reference_code"] ?? "",



            "abookedCompany" => $bookingMatches["company"] ?? "",



            "phone_number" => $bookingMatches["contact_no"] ?? "",



            "airportID" => 1,



            "model" => $bookingMatches["model"] ?? "",



            "make" => $bookingMatches["make"] ?? "",



            "color" => $bookingMatches["colour"] ?? "",



            "registration" => $bookingMatches["registration_no"] ?? "",



            "deprTerminal" => $bookingMatches["departure_terminal"] ?? "",



            "deptFlight" => $bookingMatches["departure_flight"] ?? "",



            "returnTerminal" => $bookingMatches["arrival_terminal"] ?? "",



            "returnFlight" => $bookingMatches["arrival_flight"] ?? "",





            "total_amount" => $bookingMatches["amount"] ?? "",

            "booking_amount" => $bookingMatches["amount"] ?? "",



        ];





        if (!empty($bookingMatches["departure_date"])) {

            $formattedDepartureDate = date("Y-m-d H:i:s", strtotime($bookingMatches["departure_date"]));

            $data["departDate"] = $formattedDepartureDate ?: null;
        }

        if (!empty($bookingMatches["arrival_date"])) {

            $arrivalDate = date("Y-m-d H:i:s", strtotime($bookingMatches["arrival_date"]));

            $data["returnDate"] = $arrivalDate ?: null;
        }









        $fullname = $bookingMatches["name"] ?? "";



        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["payment_status"] = "success";



        $data["incomplete_email"] = 1;



        $data["agentID"] = 35;



        $data = array_map("trim", $data);



        return $data;
    }



    if (

        strpos($from, "Mobit Airport Parking") !== false


        && strpos($subject, "Cancelled") === false
        && strpos($subject, "Agent Login Information") === false

    ) {



        $body = mb_convert_encoding($body, "UTF-8", "auto");



        $body = preg_replace('/\xC2\xA0/', " ", $body);



        $parse_email_body = strip_tags($body);



        $parse_email_body = html_entity_decode(

            $parse_email_body,

            ENT_QUOTES,

            "UTF-8"

        );



        $parse_email_body = htmlentities(

            $parse_email_body,

            ENT_QUOTES,

            "utf-8"

        );



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = trim(

            preg_replace("/\s\s+/", " ", $parse_email_body)

        );



        $parse_email_body = str_replace('\n', "", $parse_email_body);



        $parse_email_body = str_replace("&amp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "MG Reservations",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("&nbsp;", "", $parse_email_body);



        $parse_email_body = str_replace(

            "-------------------------------------------------------------------------------------------------------------------------------------",

            "",

            $parse_email_body

        );



        $parse_email_body = str_replace("=20", "", $parse_email_body);



        $parse_email_body = str_replace("=", "", $parse_email_body);

        // Decode quoted-printable encoding (if applicable)

        $parse_email_body = quoted_printable_decode($parse_email_body);



        // Remove hidden characters

        $parse_email_body = preg_replace('/[^\P{C}\t\n]+/u', '', $parse_email_body);







        // Remove trailing spaces from lines

        $parse_email_body = preg_replace('/[ \t]+$/m', '', $parse_email_body);

        $parse_email_body = str_replace(["  ", "   "], "\n", $parse_email_body);

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode special email characters

        $parse_email_body = preg_replace('/\r\n|\r/', "\n", $parse_email_body); // Normalize newlines

        $parse_email_body = trim($parse_email_body); // Trim spaces



        $parse_email_body = strip_tags($parse_email_body);



        $parse_email_body = html_entity_decode($parse_email_body);



        $parse_email_body = preg_replace(

            '/[^\x20-\x7E]/',

            "",

            $parse_email_body

        );

        $parse_email_body = quoted_printable_decode($parse_email_body); // Decode email

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body); // Normalize spaces

        $parse_email_body = trim($parse_email_body); // Trim start & end spaces

        $parse_email_body = preg_replace('/\s+/', ' ', $parse_email_body);

        $parse_email_body = trim($parse_email_body);



        $pattern = '/Reference Code:\s*(.*?)\s*Company Name:\s*(.*?)\s*Airport:\s*(.*?)\s*Name:\s*(.*?)\s*Contact No:\s*(.*?)\s*Model:\s*(.*?)\s*Make:\s*(.*?)\s*Colour:\s*(.*?)\s*Registration No.:\s*(.*?)\s*Departure Date\/Time:\s*(.*?)\s*Departure Terminal:\s*(.*?)\s*Departure Flight no:\s*(.*?)\s*Arrival Date\/Time:\s*(.*?)\s*Arrival Terminal:\s*(.*?)\s*Arrival Flight no:\s*(.*?)\s*Valeting:\s*(.*?)\s*Amount:\s*([\d\.]+)(?: Pounds)?/s';









        preg_match($pattern, $parse_email_body, $bookingMatches);





        $data = [

            "referenceNo" => $bookingMatches[1],



            "abookedCompany" => $bookingMatches[2],



            "phone_number" => $bookingMatches[5],



            "airportID" => 1,



            "model" => $bookingMatches[7],



            "make" => $bookingMatches[6],



            "color" => $bookingMatches[8],



            "registration" => $bookingMatches[9],



            "departDate" => $bookingMatches[10],



            "deprTerminal" => $bookingMatches[11],



            "deptFlight" => $bookingMatches[12],



            "returnDate" => $bookingMatches[13],



            "returnTerminal" => $bookingMatches[14],



            "returnFlight" => $bookingMatches[15],



            "passenger" => $bookingMatches[16],



            "total_amount" => $bookingMatches[17],



            "booking_amount" => $bookingMatches[17],

        ];















        $data["departDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[10])

        );



        $data["returnDate"] = date(

            "Y-m-d H:i:s",

            strtotime($bookingMatches[13])

        );

        if ($date_time == '' || $date_time == '00:00:00 00:00:00') {

            $date_times = $date_time->format('Y-m-d H:i:s');
        } else {

            $date_times = $date_time;
        }



        $data["created_at"] = $date_times;

        $fullname = $bookingMatches[4] ?? "";

        $extracted_fullname = extractNameParts($fullname);



        $data["title"] = $extracted_fullname["title"] ?? "";



        $data["first_name"] = $extracted_fullname["first_name"] ?? "";



        $data["last_name"] = $extracted_fullname["last_name"] ?? "";



        if ($data["departDate"] && $data["returnDate"]) {

            $earlier = new DateTime($data["departDate"]);



            $later = new DateTime($data["returnDate"]);



            $data["no_of_days"] = $later->diff($earlier)->format("%a");
        } else {

            $data["no_of_days"] = null;
        }



        $data["companyId"] = 117;



        $data["airportID"] = 1;



        $data["booking_status"] = "Completed";



        $data["booking_action"] = "Booked";



        $data["traffic_src"] = "Agent";



        $data["incomplete_email"] = 1;



        $data["payment_status"] = "success";



        $data["agentID"] = 37;



        $earlier = new DateTime($data["departDate"]);



        $later = new DateTime($data["returnDate"]);



        $data["no_of_days"] = $later->diff($earlier)->format("%a");



        $data = array_map("trim", $data);



        return $data;
    }
}



function remove_nbsp($string)

{

    $string_to_remove = "&nbsp;";



    $string = trim(preg_replace("/\s\s+/", "", $string));



    $string = str_replace($string_to_remove, "", $string);



    $string = str_replace('\t', "", $string);



    $string = trim($string, "\xC2\xA0");



    return trim($string);
}



function extractNameParts($fullName)

{

    $fullName = trim($fullName);



    $titleList = [

        "Mr",

        "Mrs",

        "Ms",

        "Dr",

        "Prof",

        "Miss",

        "Mx",

        "Sir",

        "Dame",

        "Lord",

        "Lady",

        "Rev",

        "Fr",

        "Br",

        "Sr",

        "Hon",

        "Capt",

        "Maj",

        "Col",

        "Gen",

        "Lt",

        "Adm",

        "Cdr",

        "Sgt",

    ];



    $fullName = str_replace([",", "."], "", $fullName);



    $nameParts = explode(" ", $fullName);

    $title = "";



    if (in_array($nameParts[0], $titleList)) {



        $title = array_shift($nameParts);
    }



    $wordCount = count($nameParts);



    if ($wordCount % 2 == 0) {



        $firstNameParts = $wordCount / 2;
    } else {



        $firstNameParts = ceil($wordCount / 2);
    }



    $firstName = implode(" ", array_slice($nameParts, 0, $firstNameParts));

    $lastName = implode(" ", array_slice($nameParts, $firstNameParts));



    return [

        "title" => $title,

        "first_name" => $firstName,

        "last_name" => $lastName,

    ];
}

mysqli_close($conn);

