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



<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<style>
    .sh {

        margin-top: 20px;

    }

    /*head title {

            display: none !important;

        }

        ho-ja {

            max-width: 10% !important;

        }*/

    @media print {

        table {

            /*                border-collapse: collapse;*/

        }



        /* Apply word-breaking to the table body and ensure text wraps */

        table.dataTable.display>tbody>tr>td {

            font-size: 14px !important;

            padding: 15px 4px !important;

            text-align: center !important;

            line-height: 20px !important;

        }



        /* Set width of the 3rd column (adjust this value if needed) */

        table.dataTable.display>tbody>tr>td:nth-child(3) {

            width: 7% !important;

        }



        /* Apply to headers for breaking the text and setting line height */

        table.dataTable.display>thead>tr>th {

            font-size: 14px !important;

            text-align: center !important;

            font-weight: 700 !important;

            line-height: 1.2;

            padding: 6px 3px;

        }



        /* Optional: If you need specific control for certain header cells, you can do this */

        table.dataTable.display>thead>tr>th:nth-child(13),

        table.dataTable.display>thead>tr>th:nth-child(11) {

            width: 7% !important;

            font-size: 13px !important;



        }

        table.dataTable.display>tbody>tr>td:nth-child(12) {

            text-transform: uppercase !important;

            white-space: normal;

            /* word-break: break-word;  */

        }

        table.dataTable.display>thead>tr>th:nth-child(4) {

            width: 7% !important;

        }

        table.dataTable.display>thead>tr>th:nth-child(3) {

            width: 10% !important;

            text-align: center !important;

            padding: 15px 5px !important;

        }



        table.dataTable.display>thead>tr>th:first-child {

            width: 8% !important;

        }





        /* Ensure that title is hidden during print */

        title {

            display: none !important;

        }



        /* Optional: Define styles for other elements */

        table tbody tr.white-row {

            background-color: white !important;

            color: black;

        }

    }
</style>

@endsection



@section('content')

<div class="page-content">





    <div class="page-header">

        <h1>

            Departure / Retrun Report

            <small>

                <i class="ace-icon fa fa-angle-double-right"></i>

                List

            </small>

        </h1>

    </div><!-- /.page-header -->



    <div class="row">

        <div class="col-md-12 floatNone">

            <form action="{{ route('departure_Booking') }}" method="get" class="form-inline mb-10">

                <input type="hidden" value="q" name="q">

                <div class="form-group">

                    Search By Keyword<br>

                    <input type="text" name="search" id="field-1" autocomplete="off"

                        class="form-control input-sm  " placeholder="Search By Keyword"

                        value="{{ Request::get('search') }}">

                </div>





                <div class="form-group">

                    From<br>

                    <input type="text" name="start_date" id="start_date" autocomplete="off"

                        class="form-control input-sm datepicker" placeholder="Start Date" data-date-format="dd-M-yyyy"

                        value="{{ Request::get('start_date') }}">

                </div>

                <div class="form-group">

                    To<br>

                    <input class="form-control input-sm date-picker" value="{{ Request::get('end_date') }}"

                        autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text"

                        data-date-format="dd-M-yyyy" />



                </div>

                <div class="form-group">

                    Agent

                    <br>



                    <select style="height: 30px;" id="supplier" name="supplier" class="form-control">

                        <option value="">Select Agent</option> <!-- Default empty option -->

                        @foreach ($partners as $partner)

                        <option value="{{ $partner->id }}"

                            @if(request()->get('supplier') == $partner->id) selected @endif>

                            {{ $partner->alias }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <div class="form-group">

                    Booking Type

                    <br>

                    <select style="height: 30px;" id="type" name="type" class="form-control">

                        <option value="departDate" @if(Request::get('type')=='departDate' ) {{ "selected='selected'" }} @endif> Departure </option>

                        <option value="returnDate" @if(Request::get('type')=='returnDate' ) {{ "selected='selected'" }} @endif> Return </option>

                        <option value="all" @if(Request::get('type')=='all' ) {{ "selected='selected'" }} @endif>All</option>

                    </select>

                </div>

  <div class="form-group">

                   Company type

                    <br>

                    <select style="height: 30px;" id="c_type" name="c_type" class="form-control">

                        <option value="117,120" @if(Request::get('c_type')=='117,120' ) {{ "selected='selected'" }} @endif> Departure </option>

                        <option value="124,125" @if(Request::get('c_type')=='124,125' ) {{ "selected='selected'" }} @endif> Return </option>

                        <option value="all" @if(Request::get('type')=='all' ) {{ "selected='selected'" }} @endif>All</option>

                    </select>

                </div>




                <div class="form-group sh">

                    <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">

                    <a href='{{ route('departure_Booking') }}' class="btn btn-primary btn-sm">Reset</a>

                </div>

            </form>



        </div>





    </div>



    <div class="row">

        <div class="col-xs-12">



            <div class="row">

                <div class="col-xs-12">



                    @if ($message = Session::get('success'))

                    <div class="alert alert-success">

                        <p>{{ $message }}</p>

                    </div>

                    @endif

                    @if(count($bookings) > 0)

                    <div class="row">

                        <div style="margin-bottom: 6px;" class="col-md-6 text-left section-right mb-10">

                            <button type="button" class="btn btn-sm btn-info"> Total Bookings : {{ $totalBookings }} </button>

                        </div>

                        <div class="col-md-6 text-right section-right mb-10">



                        </div>

                    </div>

                    @endif









                    <div class="table table-responsive">

                        <div class="heading"></div>

                        <table id="example" class="display nowrap w-100 deparaturTable">

                            <thead class="black-rows">

                                <tr>

                                    <th class="w-14-per">Reference No</th>

                                    <th>Name</th>

                                    <th>Mobile</th>

                                    <th class="d-nth-p">Departure Date</th>

                                    <th class="d-nth-p">Time</th>

                                    <th class="d-nth-p">Return Date</th>

                                    <th class="d-nth-p">Time</th>

                                    <th>Return Terminal</th>

                                    <th>Retune <br> Flight</th>

                                    <th class="w-70">Company</th>

                                    <th>Car Reg</th>

                                    <th>Car Make</th>

                                    <th>Car Color</th>

                                    <th class="location">Location</th>

                                    <th style="width:10% !important">Passengers</th>

                                    <th>Booking status</th>

                                    <th style="dispaly:none">departure Terminal</th>

                                </tr>

                            </thead>

                            <tbody>

                                @foreach ($bookings as $booking)

                                @if($booking->agentID == 7)

                                @php

                                $company = $booking->company->name

                                @endphp

                                @else

                                @php

                                $company = $booking->abookedCompany

                                @endphp

                                @endif





                                <tr>

                                    <td class="w-14%"> {{ $booking->referenceNo }} </td>

                                    <!-- <td class="">{{ $booking->first_name . ' ' . $booking->last_name }}</td> -->

                                    <td class="">

                                        @if(in_array($booking->first_name, ['Mr.', 'Miss.', 'Mrs.']))

                                        {{ $booking->title }} {{ $booking->last_name }}

                                        @else

                                        {{ $booking->title }} {{ $booking->first_name }} {{ $booking->last_name }}

                                        @endif

                                    </td>

                                    <td class="">{{ $booking->phone_number }}</td>

                                   <td data-order="{{ date('Y-m-d', strtotime($booking->departDate)) }}">
    {{ date('d/m/Y', strtotime($booking->departDate)) }}
</td>

                                            <!--<td class="">{{ date('H:i', strtotime($booking->created_at)) }}</td>-->

                                             
                                            
                                    <td class=""> {{ date('H:i', strtotime($booking->departDate)) }}</td>

                                   <td data-order="{{ date('Y-m-d', strtotime($booking->returnDate)) }}">
    {{ date('d/m/Y', strtotime($booking->returnDate)) }}
</td>
                                    <td class=""> {{ date('H:i', strtotime($booking->returnDate)) }}</td>

                                    @if(!empty($booking->rTerminal))

                                    <td class="">{{ $booking->rTerminal }}</td>

                                    @else

                                    <td class="">{{ $booking->returnTerminal }}</td>

                                    @endif

                                    <td class="">{{ $booking->returnFlight }}</td>

                                    <td class="custom-column ">{{ $company }}</td>

                                    <td class="">{{ $booking->registration }}</td>

                                    <td class="">{{ $booking->make }}</td>

                                    <td class="">{{ $booking->color }}</td>

                                    <td class="location">{{ $booking->address }}</td>

                                    <td class="custom-column ">{{ $booking->passenger }}</td>



                                    <td>{{ $booking->booking_status }}</td>

                                    <td style="display:none">{{ $booking->deprTerminal }}</td>

                                </tr>



                                @endforeach



                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @endsection

    @section('footer-script')

    <script src="{{ secure_asset('assets/js/moment.min.js') }}"></script>

    <script src="{{ secure_asset('assets/js/daterangepicker.min.js') }}"></script>

    <script src="{{ secure_asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>



    <script src="{{ secure_asset('assets/js/bootstrap-datepicker.min.js') }}"></script>

    <script src="{{ secure_asset('assets/js/bootstrap-timepicker.min.js') }}"></script>





    <!-- page specific plugin scripts -->

    <script src="{{ secure_asset('assets/js/wizard.min.js') }}"></script>

    <script src="{{ secure_asset('assets/js/jquery.validate.min.js') }}"></script>

    <script src="{{ secure_asset('assets/js/jquery-additional-methods.min.js') }}"></script>

    <script src="{{ secure_asset('assets/js/bootbox.js') }}"></script>

    <script src="{{ secure_asset('assets/js/jquery.maskedinput.min.js') }}"></script>

    <script src="{{ secure_asset('assets/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        $('#start_date').datepicker({

                autoclose: true,

                todayHighlight: true

            })

            //show datepicker when clicking on the icon

            .next().on(ace.click_event, function() {

                $(this).prev().focus();

            });





        $('#end_date').datepicker({

                autoclose: true,

                todayHighlight: true

            })

            //show datepicker when clicking on the icon

            .next().on(ace.click_event, function() {

                $(this).prev().focus();

            });
    </script>

    <script src="{{ secure_asset('assets/front/js/bootbox.js') }}"></script>

    <script>
        function show_detal(id) {

            if ($("#show_detail_icon_" + id).hasClass("fa-plus-circle")) {

                $("#show_detail_icon_" + id).removeClass("fa-plus-circle");

                $("#show_detail_icon_" + id).addClass("fa-minus-circle");

            } else {

                $("#show_detail_icon_" + id).removeClass("fa-minus-circle");

                $("#show_detail_icon_" + id).addClass("fa-plus-circle");

            }



            $("#detail_" + id).toggle();

        }



        function sendEmailForm(id, cmpID) {

            ModelPopUp("<div id=\"resend_email\" ><div><h2>Resend Email</h2></div>\n" +

                "                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +

                "<input class=\"radio-resend\" type=\"radio\" value=\"company\" name=\"resendEmailto\">Company</label>\n" +

                "                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +

                "<input class=\"radio-resend\"  type=\"radio\" value=\"client\" name=\"resendEmailto\">Client</label>\n" +

                "                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +

                "<input class=\"radio-resend\" type=\"radio\" value=\"all\" name=\"resendEmailto\" >ALL</label>\n" +

                "                        <input  onclick=\"sendEmail('" + id + "','" + cmpID +

                "')\" class=\"btn btn-info\" value=\"Send\" style=\"margin: 15px 5px 5px 15px;\">\n" +

                "                        </div>");

        }



        function sendEmail(id, cid) {

            $("#resend_email").html(

                "<div id=\"resend_email\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"

            );



            var data = {};

            data["id"] = id;

            data["cid"] = cid;

            data["type"] = $('input[name=resendEmailto]:checked').val();

            data["_token"] = '{{ csrf_token() }}';

            $.post('{{ route('reSendEmailBooking') }}', data,
                function(data) {

                    console.log("data===", data);

                    $("#resend_email").html(data);

                    //                        if (data.StatusCode == 0) {

                    //                            window.location.href = "https://"+window.location.hostname+"/booking/thankyou";

                    //                        } else {

                    //                            $("#error_personal_detail").html(data.Message);

                    //                        }

                });



        }



        function validate(form) {



            // validation code here ...





            if (!valid) {

                alert('Please correct the errors in the form!');

                return false;

            } else {

                return confirm('Do you really want to submit the form?');

            }

        }



        //                        jQuery(function($) {

        //                            $("#view_detail").on(ace.click_event, function () {

        //

        //

        //

        //                                ModelPopUp('');

        //                            });

        //

        //

        //

        //                        });





        function getDetail(id) {

            ModelPopUp(

                "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"

            );

            var data = {};

            data["id"] = id;

            data["_token"] = '{{ csrf_token() }}';

            $.post('{{ route('bookingdetail.show') }}', data,
                function(data) {

                    console.log("data===", data);

                    $("#booking_detail_pop").html(data);

                    //

                });







        }





        function getcancelForm(id) {

            ModelPopUp(

                "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"

            );

            var data = {};

            data["id"] = id;

            data["_token"] = '{{ csrf_token() }}';

            $.post('{{ route('bookingdetail.cancelForm') }}', data,
                function(data) {

                    console.log("data===", data);

                    $("#booking_detail_pop").html(data);

                    //

                });







        }



        function getrefundForm(id) {

            ModelPopUp(

                "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"

            );

            var data = {};

            data["id"] = id;

            data["_token"] = '{{ csrf_token() }}';

            $.post('{{ route('bookingdetail.refundForm') }}', data,
                function(data) {

                    console.log("data===", data);

                    $("#booking_detail_pop").html(data);

                    //

                });







        }





        function transferSubmit(id) {

            var html =

                "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>";

            $("#booking_detail_pop").html(html);

            var data = {};

            data["id"] = id;

            data["_token"] = '{{ csrf_token() }}';

            data["new_cid"] = $("#company_id_pop option:selected").val();

            $.post('{{ route('transferBooking') }}', data,
                function(data) {

                    console.log("data===", data);

                    $("#booking_detail_pop").html(data);

                    //

                });







        }





        function getTransferForm(url) {

            ModelPopUp(

                "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"

            );

            var data = {};

            // data["id"]=id;

            data["_token"] = '{{ csrf_token() }}';

            $.get(url, data, function(data) {

                console.log("data===", data);

                $("#booking_detail_pop").html(data);

                //

            });







        }



        function ModelPopUp(message) {

            bootbox.dialog({

                message: message,

                size: "large",

                //                                buttons:

                //                                    {

                //                                        "success":

                //                                            {

                //                                                "label": "<i class='ace-icon fa fa-check'></i> Ok",

                //                                                "className": "btn-sm btn-success",

                //                                                "callback": function () {

                //                                                    //Example.show("great success");

                //                                                }

                //                                            }

                //                                    }

            });

        }
    </script>





    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">



    <script>
        function getParameterByName(name, url) {

            if (!url) url = window.location.href;

            name = name.replace(/[\[\]]/g, "\\$&");

            var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),

                results = regex.exec(url);

            if (!results) return null;

            if (!results[2]) return '';

            return decodeURIComponent(results[2].replace(/\+/g, " "));

        }



        $(document).ready(function() {

            var orderColumn;



            var typeParam = getParameterByName('type');

            console.log(typeParam);

            if (typeParam === 'departDate') {

                orderColumn = 4;

            } else if (typeParam === 'returnDate') {

                orderColumn = 6;

            } else {

                orderColumn = 1;

            }

            $('#example').DataTable({

                dom: 'Bfrtip',

                buttons: [

                    {

                        extend: 'print',

                        text: 'Print',

                        customize: function(win) {

                            const type = $('#type').val();

                            let reportTitle = '';

                            let departureCount = 0;

                            let returnCount = 0;

                            let bothcont = 0;



                            // Set report title based on type

                            if (type == 'all') {

                                reportTitle = 'Departure and Return Report';

                            } else if (type == 'departDate') {

                                reportTitle = 'Departure Report';

                            } else if (type == 'returnDate') {

                                reportTitle = 'Return Report';

                            }





                            $(win.document.head).append(`

    <style>

        @media print {

            @page {

                margin: .2cm;

            }

            body {

                font-family: Arial, sans-serif;

            }

            table {

                width: 100%;

                max-width: 100%;

            }

            th, td {

                border: 1px solid black;

                text-align: center;

                font-size: 14px;

                padding: 6px;

                

            }

           

            h1 {

                text-align: center;

                font-size: 20px;

                font-weight: bold;

                margin-top: 0;

            }

            .non-printable {

                display: none;

            }

        }

        table { 

            border-collapse: collapse; 

            width: 100%; 

            margin-top: 3% !important; 

        }

        th, td { 

            border: 1px solid black; 

            text-align: center; 

        }

        @media print {

            body { 

                font-family: Arial, sans-serif; 

            }

            table thead th { 

                background-color: blue !important; 

                color: white !important; 

            }

            table tbody tr.black-row { 

                background-color: rgba(240, 53, 53, 0.8) !important; 

                color: white !important; 

            }

           table tbody tr.light-gray-row {

    background-color: #d3d3d3 !important;  /* Light gray */

}



            

            table thead th:nth-child(5), 

            table thead th:nth-child(6), 

            table thead th:nth-child(7) { 

                display: none !important; 

            }

           

    

            table thead th:nth-child(17) { 

                display: none !important; 

            }

            table thead th:nth-child(10), 

            table tbody td:nth-child(10) { 

                display: none !important; 

            }

            table thead th:nth-child(11), 

            table tbody td:nth-child(11) { 

                font-weight: 600 !important; 

            }

            table thead th { 

                font-weight: bold !important; 

            }

            table tbody td:nth-child(14) { 

                word-wrap: break-word !important; 

                word-break: break-word !important; 

                white-space: normal !important; 

                font-size: 15px !important; 

            }

            table tbody td:nth-child(13)::after { 

                content: attr(data-first-letter) !important; 

                font-size: 24px; 

                font-weight: bold !important; 

            }

            table thead th:nth-child(16), 

            table tbody td:nth-child(16) { 

                display: none !important; 

            }

            table thead th:nth-child(15), 

            table tbody td:nth-child(15) { 

                display: none !important; 

            }

            table thead th:nth-child(4), 

            table tbody td:nth-child(4) { 

                width: 5% !important; 

            }

            

            h1 { 

                text-align: center; 

                font-size: 24px; 

                font-weight: bold; 

                margin-top: 2px; 

            }

        }

    </style>

`);







                            $(win.document.body).find('table thead th:nth-child(4)').text('Date/Time');

                            $(win.document.body).find('table thead th:nth-child(8)').text('Terminal');

                            $(win.document.body).find('table thead th:nth-child(13)').text('Color');

                            $(win.document.body).find('table thead th:nth-child(12)').text('Make');







                            const formatDate = (dateStr) => {

                                let date;

                                if (dateStr.match(/^(\d{2})-(\w{3})-(\d{4})$/)) {

                                    const parts = dateStr.split('-');

                                    const monthMap = {

                                        'Jan': 0,
                                        'Feb': 1,
                                        'Mar': 2,
                                        'Apr': 3,
                                        'May': 4,
                                        'Jun': 5,

                                        'Jul': 6,
                                        'Aug': 7,
                                        'Sep': 8,
                                        'Oct': 9,
                                        'Nov': 10,
                                        'Dec': 11

                                    };

                                    const day = parseInt(parts[0], 10);

                                    const month = monthMap[parts[1]];

                                    const year = parseInt(parts[2], 10);

                                    date = new Date(Date.UTC(year, month, day));

                                } else if (dateStr.match(/^(\d{2})\/(\d{2})\/(\d{4})$/)) {

                                    const parts = dateStr.split('/');

                                    date = new Date(Date.UTC(parts[2], parts[1] - 1, parts[0]));

                                } else {

                                    return null;

                                }

                                return date ? date.toISOString().split('T')[0] : null;

                            };



                            function formatDateWithTime(dateStr, timeStr) {

                                const dateParts = dateStr.split('-');

                                const day = dateParts[2];

                                const month = dateParts[1];

                                const year = dateParts[0];



                                return `<span style="color: white; font-weight: 600 !important;">${day}/${month}/${year}<br>${timeStr}</span>`;

                            }

                            function formatDates(dateStr) {

                                const dateParts = dateStr.split('-');

                                const day = dateParts[2];

                                const month = dateParts[1];

                                const year = dateParts[0];



                                return `${day}/${month}/${year}`;

                            }



                            $(win.document.body).find('table tbody tr').each(function() {

                                const departureDate = $(this).find('td:nth-child(4)').text().trim();

                                const returnDate = $(this).find('td:nth-child(6)').text().trim();

                                const startDate = $('#start_date').val();

                                const endDate = $('#end_date').val();



                                // Format all dates

                                const formattedDepartureDate = formatDate(departureDate);

                                const formattedReturnDate = formatDate(returnDate);

                                const formattedStartDate = formatDate(startDate);

                                const formattedEndDate = formatDate(endDate);

                                let newDateColumn = '';

                                let newTime = '';

                                let terminalInfo = '';



                                if (type === 'departDate') {

                                    const departureTime = $(this).find('td:nth-child(5)').text().trim();

                                    const terminal = $(this).find('td:nth-child(17)').text().trim();



                                    const terminalInfoz = terminal.replace(/Terminal\s*/i, 'T');

                                    terminalInfo = ` ${terminalInfoz}`;



                                    newDateColumn = formatDateWithTime(formattedDepartureDate, departureTime);

                                    newTime = departureTime;



                                    $(this).addClass('white-row');

                                    departureCount++;

                                } else if (type === 'returnDate') {

                                    const returnTime = $(this).find('td:nth-child(7)').text().trim();

                                    const terminal = $(this).find('td:nth-child(8)').text().trim();



                                    const terminalInfoz = terminal.replace(/Terminal\s*/i, 'T');

                                    terminalInfo = ` ${terminalInfoz}`;





                                    console.log(terminalInfo);

                                    newDateColumn = formatDateWithTime(formattedReturnDate, returnTime);

                                    newTime = returnTime;



                                    $(this).addClass('black-row');

                                    returnCount++;

                                } else if (type === 'all') {

                                    const departureTime = $(this).find('td:nth-child(5)').text().trim();

                                    const returnTime = $(this).find('td:nth-child(7)').text().trim();

                                    const departureTerminal = $(this).find('td:nth-child(17)').text().trim();

                                    const departureTerminals = departureTerminal.replace(/Terminal\s*/i, 'T');



                                    const returnTerminal = $(this).find('td:nth-child(8)').text().trim();

                                    const returnTerminals = returnTerminal.replace(/Terminal\s*/i, 'T');



                                    const departureDateTime = formattedDepartureDate;

                                    const returnDateTime = formattedReturnDate;



                                    if (formattedDepartureDate === formattedReturnDate) {

                                        terminalInfo = `DEP ${departureTerminals}<br>RTN ${returnTerminals}`;



                                        newDateColumn = `<span style="color: white; font-weight: 600 !important;">${formatDates(departureDateTime)}<br>DEP=${departureTime}<br>RTN=${returnTime}</span>`;

                                        newTime = `${departureTime}/${returnTime}`;

                                        $(this).addClass('light-gray-row');

                                        bothcont++;

                                    } else if (formattedDepartureDate === formattedStartDate || formattedDepartureDate === formattedEndDate) {

                                        const terminal = $(this).find('td:nth-child(17)').text().trim();

                                        const terminalInfoz = terminal.replace(/Terminal\s*/i, 'T');

                                        terminalInfo = ` ${terminalInfoz}`;



                                        newDateColumn = formatDateWithTime(formattedDepartureDate, departureTime);

                                        newTime = departureTime;

                                        $(this).addClass('white-row');

                                        departureCount++;

                                    } else {

                                        const terminal = $(this).find('td:nth-child(8)').text().trim();



                                        const terminalInfoz = terminal.replace(/Terminal\s*/i, 'T');

                                        terminalInfo = ` ${terminalInfoz}`;

                                        console.log(terminalInfo);



                                        newDateColumn = formatDateWithTime(formattedReturnDate, returnTime);

                                        newTime = returnTime;

                                        $(this).addClass('black-row');

                                        returnCount++;

                                    }

                                }



                                // Hide rows with no `newDateColumn`, else update the row with formatted values

                                if (!newDateColumn) {

                                    $(this).hide();

                                } else {

                                    $(this).find('td:nth-child(4)').html(newDateColumn);

                                    $(this).find('td:nth-child(5)').html(terminalInfo);

                                    $(this).find('td:nth-child(6)').hide();

                                    $(this).find('td:nth-child(8)').hide();

                                    $(this).find('td:nth-child(17)').hide();

                                    $(this).find('td:nth-child(7)').hide();

                                    $(this).find('td:nth-child(10)').hide();

                                    $(this).find('td:nth-child(15)').hide();

                                    $(this).attr('data-time', newTime);

                                }



                                $(this).each(function() {

                                    const firstColumnText = $(this).find('td:nth-child(1)').text().trim();

                                    const firstColumnHeaderText = $(this).find('table.dataTable.display thead  th:first-child').text().trim();

                                    const secondColumnText1 = $(this).find('td:nth-child(2)').text().trim();

                                    // const secondColumnText2 = $(this).find('td:nth-child(8)').text().trim();

                                    // const secondColumnText22 = $(this).find('td:nth-child(9)').text().trim();



                                    // const updatedSecondColumnText = secondColumnText2.replace(/Terminal[-\s]*(\d+)/g, function (match, p1) {

                                    //     return 'T ' + p1;

                                    // });

                                    // $(this).find('td:nth-child(8)').html(updatedSecondColumnText);



                                    // const updatedSecondColumnTexts = secondColumnText22.replace(/Terminal[-\s]*(\d+)/g, function (match, p1) {

                                    //     return 'Terminal <br>' + p1;

                                    // });

                                    // $(this).find('td:nth-child(9)').html(updatedSecondColumnTexts);



                                    $(this).find('table.dataTable.display thead th:first-child').html(firstColumnHeaderText.replace(/ /g, '<br>'));



                                    $(this).find('td:nth-child(1)').html(firstColumnText.replace(/-(?=\d)/, '<br>-'));



                                    $(this).find('td:nth-child(2)').html(secondColumnText1.replace(/ /g, '<br>'));

                                });



                            });



                            // Sorting rows by time

                            const rows = $(win.document.body).find('table tbody tr:visible').toArray();

                            rows.sort((a, b) => {

                                const timeA = $(a).attr('data-time');

                                const timeB = $(b).attr('data-time');

                                if (timeA < timeB) return -1;

                                if (timeA > timeB) return 1;

                                return 0;

                            });



                            rows.forEach(row => {

                                $(win.document.body).find('table tbody').append(row);

                            });









                            $(win.document.body).prepend(`

                        <div style="position: absolute;left:32%;right:auto; top: 30px;  font-size: 18px; font-weight: bold; color: black; ">

                            Departure : ${departureCount} 

                            Return : ${returnCount}  

                            Total Jobs :  ${returnCount + departureCount}    

                     

                          

                        </div>

                    `);



                        }

                    },

                    'copy', 'csv', 'excel'

                ],

                order: [],

            });







        });











        // $(document).ready(function () {



        //         $('#example').DataTable({

        //             dom: 'Brtip',

        //             buttons: [

        //                 {

        //                     extend: 'print',

        //                     exportOptions: {

        //                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]

        //             }

        //                 },

        //                 {

        //                     extend: 'csv',

        //                     exportOptions: {

        //                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]

        //             }

        //                 },

        //                 {

        //                     extend: 'copy',

        //                     exportOptions: {

        //                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]

        //             }

        //                 },

        //                 {

        //                     extend: 'excel',

        //                     exportOptions: {

        //                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]

        //             }

        //                 }

        //             ]

        //         });

        //     });
    </script>

    @endsection