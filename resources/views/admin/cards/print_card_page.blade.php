<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Bookings</title>
    <style>
         @media print {
            @page {
                size: A4 landscape;
            }

            body {
                margin: -20px 0 0 ;
            }

            .content {
                width: 100%;
                font-family: Arial, sans-serif;
                font-size: 12pt;
            }
        }
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;

            }
            .card_container {
                width: 100%;
                padding: 0px 50px;
            }
            .card_container .topCont {
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                margin-bottom: 20px;
            }
            .card_container .header {
                text-align: left;
                width: 41%;
                margin-top: 4%;
            }
            .card_container .header p {
                font-weight: normal;
                font-size: 14px;
                margin: 0 0 7% 12%;
                font-weight: 600;

            }
            .card_container .header p:last-child {
                margin-bottom: 0;
            }
            .card_container .barcode {
                text-align: center;
                margin-right: 10%;
            }
            .card_container .barcode img {
                height: 50px;
                width: 150px;
            }
            .card_container .section {
                display: flex;
                justify-content: space-between;
                margin-bottom: 20px;
            }
            .card_container .section .column {
                width: 30%;
                text-align: left;
            }
            .card_container .section .column p {
                margin: 5px 0;
                font-weight: 600;

            }
            .card_container .footer {
                text-align: center;
                margin-top: 20px;
            }
            .card_container .departureDate p {
                text-align: center;
                font-size: 26px;
                margin-bottom: 10px;
                margin-top: 0;
                font-weight: 600;
                margin-left: -18px;

            }
            .card_container .departureCont {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: 0px;
                margin-left: -18px;


            }
            .card_container .departureCont p {
                font-size: 14px;
                font-weight: 600;

            }
            .card_container .departureCont p:first-child {
                width: 23%;
            }
            .card_container .departureCont p:last-child {
                width: 54%;
            }
            .card_container .departureCont p:nth-child(2) {
                width: 13%;
            }
            .card_container .departureContainer {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
            }
            .card_container .referenceCont {
                display: flex;
                justify-content: space-between;
                align-items: flex-start;
                width: 25%;
                padding-right: 9%;
            }
            .card_container .departureLeftCont {
                width: 40%;
            }
            .card_container .referenceCont p {
                margin: 0;
                font-size: 14px;
                font-weight: 600;

            }
            .card_container .regCont {
                margin-top: 6%;
                text-align: left;
                width: 39%;
            }
            .card_container .regCont p {
                margin: 0 0 -19px;
                font-size: 18px;
                font-weight: 600;

            }
            .card_container .departureCont.vehicleInfo p:nth-child(2) {
                width: 20%;
            }
            .card_container .departureCont.vehicleInfo p:last-child {
                width: 43%;
            }
            .card_container .departureCont.vehicleInfo p:first-child {
                width: 23%;
            }
            .card_container .section .column.vehicleInfo {
                width: 33%;
                text-align: left;
            }
            .card_container .footerCont {
                margin-top: 17% !important;
            }
            .returnFlight{
                margin:4% 0 0 4%;
            }  
        </style>
<body onload="window.print();">


        <div class="card_container">
            <!-- Top Section -->
            <div class="topCont">
                <div class="header">
                    @php
                        if (!function_exists('cleanFullName')) {

                            function cleanFullName($fullName) {
                                // Use regex to match the first word and its possible duplicate
                                return preg_replace('/^(\S+)\s+\1\s+/', '$1 ', $fullName);
                            }
                        }

                        $fullname = cleanFullName($row->title." ".$row->first_name." ".$row->last_name);
                    @endphp
                    <p>{{ $fullname }}</p>
                    <p>{{ $row->phone_number }}</p>
                    <p>{{ $row->referenceNo }}</p>
                </div>
                <div class="barcode">
                    <img src="https://manchesterairportspaces.co.uk/public/assets/images/barcode.png" alt="Barcode"/>
                </div>
            </div>

            <!-- Booking and Flight Details -->
                <div class="column departureDate">
                    <p>{{ date('d-M-Y', strtotime($row->returnDate)) }}</p>
                </div>
                <div class="column departureContainer">
                        <div class="departureLeftCont">
                            <div class="column departureCont">
                                <p>{{ date('d-M-Y', strtotime($row->departDate)) }}</p>
                                <p>{{ date('H:i', strtotime($row->departDate)) }}</p>
                                <p>{{ $row->deprTerminal }}</p>
                            </div>
                            <div class="column departureCont">
                                <p>{{ date('d-M-Y', strtotime($row->returnDate)) }}</p>
                                <p>{{ date('H:i', strtotime($row->returnDate)) }}</p>
                                <p>{{ $row->returnTerminal }}</p>
                            </div>
                            <div class="column departureCont">
                                <p class="returnFlight">{{ $row->returnFlight }}</p>
                            </div>
                        </div>
                    <div class="column referenceCont">
                        <p>{{ $row->referenceNo }}</p>
                        <p>{{ $row->registration }}</p>
                    </div>
                </div>
          
                <div class="column regCont">
                    <p>{{ $row->registration }}</p>
                </div>
                <div class="column departureDate">
                    <p>{{ date('H:i', strtotime($row->returnDate)) }}</p>
                </div>
            <!-- Vehicle Information -->
            <div class="section">
                    <div class="column departureCont vehicleInfo">
                        <p>{{ $row->make }}</p>
                        <p>{{ $row->model }}</p>
                        <p>{{ $row->color }}</p>
                    </div>
            </div>
                    <div class="column departureDate footerCont">
                        <p>{{ $row->returnTerminal }}</p>
                    </div>
    </div>
 
</body>
</html>
