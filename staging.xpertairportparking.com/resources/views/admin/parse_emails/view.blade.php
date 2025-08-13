@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}" />
@endsection

@section('content')
    <div class="page-content">
        <div class="page-header">
            <h1>
                Parsed Email
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    View
                </small>
            </h1>
        </div>
        <!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12" style="font-size: 16px; word-wrap: break-word;overflow-x: auto;">
                        <p><strong>From: {{ $parse_email->email_from }}</strong></p>
                        <p><strong>Subject: <?php echo $parse_email->email_subject; ?></strong></p>
                        <br>
                        <p><strong>Message Body:</strong></p>

                        <?php echo $parse_email->email_body; ?>
                        <?php
//                         $parse_email_body =  $parse_email->email_body;
//                         $parse_email_body = htmlentities($parse_email_body, ENT_QUOTES, 'utf-8');
//         $parse_email_body = html_entity_decode($parse_email_body);
//         $parse_email_body =  str_replace('&nbsp;', '', $parse_email_body);               
//         $parse_email_body = trim(preg_replace('/\s\s+/', ' ', $parse_email_body));
//         $parse_email_body = str_replace('\n', '', $parse_email_body);
//         $parse_email_body = str_replace('Ã‚', '', $parse_email_body);
//         $parse_email_body = str_replace('Ã', '', $parse_email_body);
//         $parse_email_body = str_replace('£', '', $parse_email_body);


// function stripHtmlTags($text) {
//     return strip_tags($text);
// }

// // Split the email body into lines
// $emailLines = explode("\n", $parse_email_body);

// // Initialize variables
// $new_data = [];

// // Iterate through each line to find the required information
// foreach ($emailLines as $line) {
//     if (strpos($line, 'Airport:') !== false) {
//         $new_data['airport'] = stripHtmlTags('Airport:', '', $line);
//     } elseif (strpos($line, 'Reference Code:') !== false) {
//         $new_data['referenceCode'] = trim(str_replace('Reference Code:', '', $line));
//     } elseif (strpos($line, 'Company Name:') !== false) {
//         $new_data['companyName'] = trim(str_replace('Company Name:', '', $line));
//     } elseif (strpos($line, 'Name:') !== false) {
//         $new_data['name'] = trim(str_replace('Name:', '', $line));
//     } elseif (strpos($line, 'Contact No:') !== false) {
//         $new_data['contactNo'] = trim(str_replace('Contact No:', '', $line));
//     } elseif (strpos($line, 'Model:') !== false) {
//         $new_data['model'] = trim(str_replace('Model:', '', $line));
//     } elseif (strpos($line, 'Make:') !== false) {
//         $new_data['make'] = trim(str_replace('Make:', '', $line));
//     } elseif (strpos($line, 'Colour:') !== false) {
//         $new_data['colour'] = trim(str_replace('Colour:', '', $line));
//     } elseif (strpos($line, 'Registration No.:') !== false) {
//         $new_data['regNo'] = trim(str_replace('Registration No.:', '', $line));
//     } elseif (strpos($line, 'Departure Date/Time:') !== false) {
//         $new_data['departureDateTime'] = trim(str_replace('Departure Date/Time:', '', $line));
//     } elseif (strpos($line, 'Departure Terminal:') !== false) {
//         $new_data['departureTerminal'] = trim(str_replace('Departure Terminal:', '', $line));
//     } elseif (strpos($line, 'Departure Flight no:') !== false) {
//         $new_data['departureFlightNo'] = trim(str_replace('Departure Flight no:', '', $line));
//     } elseif (strpos($line, 'Arrival Date/Time:') !== false) {
//         $new_data['arrivalDateTime'] = trim(str_replace('Arrival Date/Time:', '', $line));
//     } elseif (strpos($line, 'Arrival Terminal:') !== false) {
//         $new_data['arrivalTerminal'] = trim(str_replace('Arrival Terminal:', '', $line));
//     } elseif (strpos($line, 'Arrival Flight no:') !== false) {
//         $new_data['arrivalFlightNo'] = trim(str_replace('Arrival Flight no:', '', $line));
//     } elseif (strpos($line, 'Passengers:') !== false) {
//         $new_data['passengers'] = trim(str_replace('Passengers:', '', $line));
//     } elseif (strpos($line, 'Valeting:') !== false) {
//         $new_data['valeting'] = trim(str_replace('Valeting:', '', $line));
//     } elseif (strpos($line, 'Amount:') !== false) {
//         $new_data['amount'] = trim(str_replace('Amount:', '', $line));
//     } elseif (strpos($line, 'Booking Status:') !== false) {
//         $new_data['bookingStatus'] = trim(str_replace('Booking Status:', '', $line));
//     }
//     // Continue this pattern for the remaining fields...
// }

// // Display the extracted data (for testing purposes)


// print_r($new_data);exit;




// // print_r("New Data: ------------- <br>".$new_data."<br>  Body: -------------- <br>".$parse_email_body );exit;
        
//         $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['departureDateTime']);
        
//         $departDate = $dateTime->format('Y-m-d H:i:s');

//         $dateTime = DateTime::createFromFormat('d-M-Y H:i', $new_data['arrivalDateTime']);
//         $returnDate = $dateTime->format('Y-m-d H:i:s');
        
//         $name = $new_data['name'];
//         $nameArray = explode(' ',$name);
//         $title = $nameArray[0];
//         $firstName = $nameArray[1];
//         $lastName = $nameArray[2];
        
//         if(isset($new_data['arrivalTerminal'])){
//             if($new_data['arrivalTerminal'] == "Terminal 2"){
//                     $data['returnTerminal'] = '394';
//                 }elseif($new_data['arrivalTerminal'] == "Terminal 3"){
//                     $data['returnTerminal'] = '395';
//                 }elseif($new_data['arrivalTerminal'] == "Terminal 4"){
//                     $data['returnTerminal'] = '396';
//                 }elseif($new_data['arrivalTerminal'] == "Terminal 5"){
//                     $data['returnTerminal'] = '397';
//                 }
//         }else{
//             $data['returnTerminal'] = "TBA";
//         }
        
//         if(isset($new_data['departureTerminal'])){
//             if($new_data['departureTerminal'] == "Terminal 2"){
//                     $data['deprTerminal'] = '394';
//                 }elseif($new_data['departureTerminal'] == "Terminal 3"){
//                     $data['deprTerminal'] = '395';
//                 }elseif($new_data['departureTerminal'] == "Terminal 4"){
//                     $data['deprTerminal'] = '396';
//                 }elseif($new_data['departureTerminal'] == "Terminal 5"){
//                     $data['deprTerminal'] = '397';
//                 }
//         }else{
//             $data['deprTerminal'] = "TBA";
//         }
        

//         $data['referenceNo'] = $new_data['referenceCode'];
//         $data['abookedCompany'] = $new_data['companyName'];
//         $data['departDate'] = $departDate;
//         $data['returnDate'] = $returnDate;
//         $data['deptFlight'] = $new_data['departureFlightNo'] ?? 'TBA';
//         $data['returnFlight'] = $new_data['arrivalFlightNo'] ?? 'TBA';

//         $data['title'] = $title;
//         $data['first_name'] = $firstName;
//         $data['last_name'] = $lastName;
//         $data['phone_number'] = $new_data[contactNo];
//         $data['passenger'] = $new_data[passengers];
//         $data['make'] = $new_data['make'] ?? 'TBA';
//         $data['model'] = $new_data['model'] ?? 'TBA';
//         $data['color'] = $new_data['colour'] ?? 'TBA';
//         $data['registration'] = $new_data['registrationNo'] ?? 'TBA';
//         $data['total_amount'] = $new_data['amount'];
//         $data['booking_amount'] = $new_data['amount'];
//         $data['valet_type'] = ($new_data['valeting'] == "No") ? 0 : 1;
    
        
//                         echo $parse_email_body;
//                         echo "<pre>";
//                         print_r($data);
//                         dd($data);
//                         echo "</pre>";

        


    
    

                        
                      
                        
                      



                        
       
                        
                    
                        
        //                 $data = array_map('trim', $data);
                        
                        
        //                 return $data;
                        
                        //////////////////////////////////////////
                        ?>
                    </div><!-- /.span -->
                </div><!-- /.row -->
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection
