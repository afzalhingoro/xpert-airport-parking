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
            margin-top: 24px !important;
        }
       head title {
    display: none !important;
}
table.dataTable.nowrap th:nth-child(10), table.dataTable.nowrap td:nth-child(10) {
    white-space: break-spaces !important;
}
ho-ja {
    max-width: 10% !important;
}
@media print{
    table tbody tr.black-row {
    background-color: black !important;
    color: white;
}

table tbody tr.white-row {
    background-color: white !important;
    color: black;
}
title {
    display: none !important;
}

ho-ja {
    width: 10% !important;
}
}

        /* @media screen and (min-device-width: 1162px) and (max-device-width: 1368px) { */
        /*.sh{*/
        /*     margin-top: 25px !important;*/
        /* }*/

        /* @media screen and (min-device-width: 1524px) and (max-device-width: 1635px) { */
        /*.sh{*/
        /*     margin-top: 24px !important;*/
        /* }*/
        .floatNone{
                float: none!important;
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
                <form action="{{ route('departure_Booking') }}" method="get" class="form-inline"
                    style="margin-bottom: 10px;">
                     <input type="hidden" value="q" name="q" >
                  
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
                        Booking Type
                        <br>
                        <select id="type" name="type" class="form-control">
                            <option value="departDate" @if(Request::get('type')=='departDate') {{ "selected='selected'" }} @endif> Departure  </option>
                            <option value="returnDate" @if(Request::get('type')=='returnDate') {{ "selected='selected'" }} @endif> Return  </option> 
                            <option value="all" @if(Request::get('type')=='all') {{ "selected='selected'" }} @endif>All</option> 
                        </select> 
                    </div> 


                    <div class="form-group sh">
                        <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                        <a href='{{ route('departure_Booking') }}' class="btn btn-primary btn-sm">Reset</a>
                    </div>
                </form>

            </div>


        </div>

        <br>


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                          @if(count($bookings)>0)    
                          <div class="row">
                                 <div class="col-md-6 text-left section-right" style="margin-bottom: 10px "> 
                                        <button type="button" class="btn btn-sm btn-info">  Total Bookings : {{ $totalBookings }}  </button>
                                </div>
                                <div class="col-md-6 text-right section-right" style="margin-bottom: 10px "> 
                                    <!--<a id="excel" class="btn btn-sm btn-info exxl"-->
                                    <!--    href="{{ route('company_departure_report_excel') }}?filter={{ Request::get('filter') }}&search={{ Request::get('search') }}&start_date={{ Request::get('start_date') }}&end_date={{ Request::get('end_date') }}&companies={{ Request::get('companies') }}&airport={{ Request::get('airport') }}&status={{ Request::old('status') }}&admins={{ Request::get('admins') }}&payment={{ Request::get('payment') }}&refund_via={{ Request::get('refund_via') }}&palenty_to={{ Request::get('palenty_to') }}"><i-->
                                    <!--class="entypo-download"></i>Download Excel Sheet</a>-->
                                </div>
                                </div>
                       @endif
                      
                        
                        
                        
                        <div class="table table-responsive">
                            <div class="heading"></div>
                            <table id="example" class="display nowrap" style="width:100%">
                                <thead class="black-rows">
                                    <tr >
                                        <th  >Reference No</th>
                                        <th>Name</th>
                                        <th>Mobile</th>
                                        <th class="d-nth-p">Departure Date</th>
                                        <th class="d-nth-p">Time</th>
                                        <th class="d-nth-p">Return Date</th>
                                        <th class="d-nth-p">Time</th>
                                        <th>Return Terminal</th>
                                        <th>Retune Flight</th>
                                        <th style="width:10% !important">Company</th>
                                        <th>Car Reg</th>
                                        <th>Car Make</th>
                                        <th>Car Color</th>
                                        <th style="width:10% !important">Passengers</th>

                                        <th>Booking status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @foreach ($bookings as $booking) 
                                            @if($booking->agentID == 7 )
                                                @php
                                                    $company = $booking->company->name
                                                @endphp
                                            @else
                                                @php
                                                    $company = $booking->abookedCompany
                                                @endphp
                                            @endif
                                            
                                                
                                            <tr> 
                                                <td style="width: 14%;">     {{ $booking->referenceNo }} </td>
                                                <td class="">{{ $booking->first_name . ' ' . $booking->last_name }}</td>
                                                <td class="">{{ $booking->phone_number }}</td>
                                                <td class="custom-columna"> {{ date('d/m/Y', strtotime($booking->departDate)) }}</td>
                                                <td class=""> {{ date('H:i', strtotime($booking->departDate)) }}</td>
                                                <td class="">  {{ date('d/m/Y', strtotime($booking->returnDate)) }}</td>
                                                <td class="">  {{ date('H:i', strtotime($booking->returnDate)) }}</td>
                                                @if(!empty($booking->rTerminal))
                                                <td class="">{{ $booking->rTerminal }}</td>
                                                @else
                                                <td class="">{{ $booking->returnTerminal }}</td>
                                                @endif
                                                <td class="">{{ $booking->returnFlight }}</td>
                                                <td class="custom-column ">{{ $company }}</td>
                                                <td class="">{{ $booking->registration }}</td>
                                                <td class="">{{ $booking->make }}</td>
                                                <td class="custom-column">{{ $booking->color }}</td>
                                                <td class="custom-column ">{{ $booking->passenger }}</td>

                                                <td>{{ $booking->booking_status }}</td>

                                            </tr> 
                                             
                                    @endforeach

                                </tbody>
                            </table>
                        </div><!-- /.span -->
                    </div><!-- /.row -->


                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
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
                $.post('{{ route('booking.sendEmailBooking') }}', data, function(data) {
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
                $.post('{{ route('bookingdetail.show') }}', data, function(data) {
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
                $.post('{{ route('bookingdetail.cancelForm') }}', data, function(data) {
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
                $.post('{{ route('bookingdetail.refundForm') }}', data, function(data) {
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
                $.post('{{ route('transferBooking') }}', data, function(data) {
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
        
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"></script>
    
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
            customize: function (win) {
                const type = $('#type').val();  
                let reportTitle = '';
                let departureCount = 0;
                let returnCount = 0;

                // Set report title based on type
                if (type === 'all') {
                    reportTitle = 'Departure and Return Report';
                } else if (type === 'departDate') {
                    reportTitle = 'Departure Report';
                } else if (type === 'returnDate') {
                    reportTitle = 'Return Report';
                }
   

                $(win.document.head).append('<style>' +
    'table { border-collapse: collapse; width: 100%; margin-top:3% !important }' +
    'th, td { border: 1px solid black; padding: 2px; text-align: center; }' +   
     '.custom-column { width: 5px !important; overflow: hidden;text-overflow: ellipsis; white-space: nowrap}' +  
 

    '@media print {' +
    '   body { font-family: Arial, sans-serif; }' +  
    '   table thead th {  background-color: blue !important; color: white !important; }' +
    '   table tbody tr.black-row {  background-color: rgba(240, 53, 53, .8) !important;   color: white !important; }' +  
    '   table tbody tr.black-row td { color: white !important; } ' +  
     '   table#example thead  th.d-nth-p { display: none !important; } ' + 
    '   tr.white-row { background-color: white !important; color: black !important; }' +  
    '   table th, table td { font-size: 14px; padding: 2px !important; }' +  
    '   table { margin-top: 60px; }' +  
    '   title { display: none !important; }' +
    '   table thead th.d-nth-p { display: none !important; }' +
    '   table tbody td.d-nth-p { display: none !important; }' +
    
    '   table thead th:nth-child(4), ' +
    '   table thead th:nth-child(5), ' +
    '   table thead th:nth-child(6), ' +
    '   table thead thd:nth-child(7) { display: none !important; }' +  
    '   table thead th:nth-child(10), table tbody td:nth-child(10) {' +
    '       display:none !important;' +
    '   table thead th:nth-child(8), table tbody td:nth-child(8) {' +
    '       display:none !important;' +
    '   table thead th:nth-child(13), table tbody td:nth-child(13) {' +
    '       display:none !important;' +
    '   table thead th:nth-child(4), table tbody td:nth-child(4) {' +
    '       width:5% !important;' +
     
    
    '   }' + 

    '}' +
      
    '</style>');
    $(win.document.body).find('table').each(function () {
        $(' thead th:nth-child(10)').addClass('custom-column');
    $('tbody td:nth-child(10)').addClass('custom-column');
   
});
$(win.document.head).append('<style>' +
    'table th:nth-child(13), ' +
    'table td:nth-child(13) {' +
    '   display: none !important;' +
    '}' +
'</style>');


                const formatDate = (dateStr) => {
                    let date;
                    if (dateStr.match(/^(\d{2})-(\w{3})-(\d{4})$/)) {
                        const parts = dateStr.split('-');
                        const monthMap = {
                            'Jan': 0, 'Feb': 1, 'Mar': 2, 'Apr': 3, 'May': 4, 'Jun': 5,
                            'Jul': 6, 'Aug': 7, 'Sep': 8, 'Oct': 9, 'Nov': 10, 'Dec': 11
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
 
                $(win.document.body).find('table tbody tr').each(function () {
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

    if (formattedDepartureDate === formattedStartDate || formattedDepartureDate === formattedEndDate) {
        const departureTime = $(this).find('td:nth-child(5)').text().trim(); 
        function formatDateWithMonthName(dateStr) {
    const months = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];
    
    const dateParts = dateStr.split('-'); // Assuming dateStr is in "YYYY-MM-DD" format
    const year = dateParts[0];
    const monthIndex = parseInt(dateParts[1], 10) - 1; // Convert to 0-based index
    const day = dateParts[2];
    
    return `${day}<br>${months[monthIndex]}<br>${year}`;
}

// Format the departure date
newDateColumn = formatDateWithMonthName(formattedDepartureDate) + '<br>' + departureTime;
        newTime = departureTime;
        departureCount++;  
        $(this).addClass('white-row');  
    } 
    else if (formattedReturnDate === formattedStartDate || formattedReturnDate === formattedEndDate) {
        const returnTime = $(this).find('td:nth-child(7)').text().trim(); 
        function formatDateWithMonthName(dateStr) {
    const months = [
        'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
    ];
    
    const dateParts = dateStr.split('-');  
    const year = dateParts[0];
    const monthIndex = parseInt(dateParts[1], 10) - 1; 
    const day = dateParts[2];
    
    return `${day}<br>${months[monthIndex]}<br>${year}`;
}

newDateColumn = formatDateWithMonthName(formattedReturnDate) + '<br>' + returnTime;        newTime = returnTime;
        returnCount++;  
        $(this).addClass('black-row');  
    }

    if (!newDateColumn) {
        $(this).hide(); 
    } else {
        $(this).find('td:nth-child(4)').html(newDateColumn);  
        $(this).find('td:nth-child(5)').hide();  
        $(this).find('td:nth-child(6)').hide();  
        $(this).find('td:nth-child(7)').hide();  
        $(this).find('td:nth-child(10)').hide();  
        $(this).find('td:nth-child(13)').hide();  
     

        $(this).attr('data-time', newTime);
    }
    $(this).each(function() {
    const firstColumnText = $(this).find('td:nth-child(1)').text().trim();
    const secondColumnText1 = $(this).find('td:nth-child(2)').text().trim();
    // const secondColumnText2 = $(this).find('td:nth-child(8)').text().trim();

    // const updatedSecondColumnText = secondColumnText2.replace(/Terminal[-\s]*/g, '').trim();
    // $(this).find('td:nth-child(8)').text(updatedSecondColumnText);

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
                        <div style="display:flex; justify-content:flex-end;align-items:center; position: absolute; top: 60px; right: 24px; font-size: 16px; font-weight: bold; color: black; ">
                          Total Departure : ${departureCount} 
                            Total Return : ${returnCount}    
                        ${reportTitle} 
                          
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
