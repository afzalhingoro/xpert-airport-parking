 
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 100%;
                    padding: 20px;
                }
                .topCont {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    margin-bottom: 20px;
                }
                .header {
                    text-align: left;
                    width: 50%;
                }
                .header p {
                    margin-left: 12%;
                    font-weight: normal;
                    font-size: 13px;
                    margin-bottom: 10px;
                }
                .barcode {
                    text-align: center;
                    margin-right: 10%;
                }
                .barcode img {
                    height: 50px;
                    width: 150px;
                }
                .section {
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 20px;
                }
                .section .column {
                    width: 30%;
                    text-align: left;
                }
                .section .column p {
                    margin: 5px 0;
                }
                .footer {
                    text-align: center;
                    margin-top: 20px;
                }
            </style>

            <div class="container">
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
                        <p>' . $fullname . '</p>
                        <p>' . $row->phone_number . '</p>
                        <p>' . $row->referenceNo . '</p>
                    </div>
                    <div class="barcode">
                        <img src="https://manchesterairportspaces.co.uk/public/assets/images/barcode.png" alt="Barcode"/>
                    </div>
                </div>

                <!-- Booking and Flight Details -->
                <div class="section">
                    <div class="column">
                        <p><strong>Departure Date:</strong> ' . date("d-M-Y H:i", strtotime($row->departDate)) . '</p>
                        <p><strong>Departure Terminal:</strong> ' . $row->deprTerminal . '</p>
                    </div>
                    <div class="column">
                        <p><strong>Return Date:</strong> ' . date("d-M-Y H:i", strtotime($row->returnDate)) . '</p>
                        <p><strong>Return Terminal:</strong> ' . $row->returnTerminal . '</p>
                    </div>
                    <div class="column">
                        <p><strong>Return Flight:</strong> ' . $row->returnFlight . '</p>
                    </div>
                </div>

                <!-- Vehicle Information -->
                <div class="section">
                    <div class="column">
                        <p><strong>Vehicle Reg:</strong> ' . $row->registration . '</p>
                    </div>
                    <div class="column">
                        <p><strong>Make:</strong> ' . $row->make . '</p>
                    </div>
                    <div class="column">
                        <p><strong>Color:</strong> ' . $row->color . '</p>
                        <p><strong>Model:</strong> ' . $row->model . '</p>
                    </div>
                </div>
            </div>';
           

