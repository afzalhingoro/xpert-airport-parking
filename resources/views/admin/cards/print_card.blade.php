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
                Cards
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="col-xs-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('booking') }}" method="get" class="form-inline" style="margin-bottom: 10px;">
                        <div class="form-group">
                            <input type="text" value="{{ Request::get('search') }}" name="search"
                                class="form-control input-sm" id="field-1" value="" placeholder="Search By Keyword"
                                style="padding: 6px 2px; width:98%;">
                        </div>
                        &nbsp; &nbsp;
                        <div class="form-group" style="display:none;">
                            <select name="admins" class="form-control input-sm">
                                <option value="all">All</option>
                                <option value="">Departure</option>
                            </select>
                        </div>
                        <div class="form-group">
                            From
                            <input type="text" name="start_date" id="start_date" autocomplete="off"
                                class="form-control input-sm datepicker" placeholder="Start Date"
                                data-date-format="dd-M-yyyy" value="{{ Request::get('start_date') }}">
                        </div>
                        <div class="form-group">
                            To
                            <input class="form-control input-sm date-picker" value="{{ Request::get('end_date') }}"
                                autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text"
                                data-date-format="dd-M-yyyy" />
                        </div>
                        &nbsp; &nbsp;
                        <div class="form-group">
                            <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                            <a href="{{ route('print-card') }}" class="btn btn-primary btn-sm">Reset</a>
                        </div>
                    </form>
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
                                <div id="sms_response"></div>
                                <div class="table-responsive">
                                    <table id="simple-table" class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;">Time </th>
                                                <th>Agent</th>
                                                <th>Ref#</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Day</th>
                                                <th>Car Make</th>
                                                <th style="width: 70px;">Car Reg</th>
                                                <th>Return Flight Number</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookings as $booking)
                                                @if ($booking['booking_status'] == 'Completed')
                                                    @php
                                                        if (!function_exists('cleanFullName')) {
            
                                                            function cleanFullName($fullName) {
                                                                // Use regex to match the first word and its possible duplicate
                                                                return preg_replace('/^(\S+)\s+\1\s+/', '$1 ', $fullName);
                                                            }
                                                        }
        
                                                        $fullname = cleanFullName($booking->title." ".$booking->first_name." ".$booking->last_name);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ date('H:i', strtotime($booking['created_at'])) }}</td>
                                                        <td>Agent</td>
                                                        <td>{{ $booking['referenceNo'] }}</td>
                                                        <td>{{ $fullname }}</td>
                                                        <td>{{ $booking->phone_number }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($booking['created_at'])) }}</td>

                                                        <td>{{ $booking->model }}</td>
                                                        <td>{{ $booking->registration }}</td>
                                                        <td>{{ $booking->deptFlight }}</td>
                                                        <td>
                                                            <button class="btn btn-primary btn-xs"
                                                                onclick="javascript:void
															window.open('print_card.php?id=<?= $booking['id'] ?>','1374577131540','toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');
															return false;"
                                                                type="button">
                                                                SHOW CARD

                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
            <br />
            <br />
        @endsection
        @section('footer-script')
            <script src='{{ secure_asset('assets/js/moment.min.js') }}'></script>
            <script src='{{ secure_asset('assets/js/daterangepicker.min.js') }}'></script>
            <script src='{{ secure_asset('assets/js/bootstrap-datetimepicker.min.js') }}'></script>

            <script src='{{ secure_asset('assets/js/bootstrap-datepicker.min.js') }}'></script>
            <script src='{{ secure_asset('assets/js/bootstrap-timepicker.min.js') }}'></script>


            <!-- page specific plugin scripts -->
            <script src='{{ secure_asset('assets/js/wizard.min.js') }}'></script>
            <script src='{{ secure_asset('assets/js/jquery.validate.min.js') }}'></script>
            <script src='{{ secure_asset('assets/js/jquery-additional-methods.min.js') }}'></script>
            <script src='{{ secure_asset('assets/js/bootbox.js') }}'></script>
            {{-- <script src='{{ secure_asset("assets/js/jquery.min.js") }}'></script> --}}
            <script src='{{ secure_asset('assets/js/select2.min.js') }}'></script>
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

            <script src='{{ secure_asset('assets/front/js/bootbox.js') }}'></script>
            <script>
                function show_detal(id) {
                    console.log('test');
                    if ($("#show_detail_icon_" + id).hasClass("fa-plus-circle")) {
                        $("#show_detail_icon_" + id).removeClass("fa-plus-circle");
                        $("#show_detail_icon_" + id).addClass("fa-minus-circle");
                    } else {
                        $("#show_detail_icon_" + id).removeClass("fa-minus-circle");
                        $("#show_detail_icon_" + id).addClass("fa-plus-circle");
                    }
                    console.log('test');
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
                    var type = $('input[name=resendEmailto]:checked').val();
                    $("#resend_email").html(
                        "<div id=\"resend_email\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"
                        );
                    var data = {};
                    data["id"] = id;
                    data["cid"] = cid;
                    data["type"] = type;
                    data["_token"] = '{{ csrf_token() }}';
                    $.post('{{ route('booking.sendEmailBooking') }}', data, function(data) {
                        console.log("data===", data);
                        $("#resend_email").html(data);
                        //if (data.StatusCode == 0) {
                        //     window.location.href = "https://"+window.location.hostname+"/booking/thankyou";
                        //} else {
                        //        $("#error_personal_detail").html(data.Message);
                        //}
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
                    var cid = $("#company_id_pop option:selected").val();
                    var html =
                        "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>";
                    $("#booking_detail_pop").html(html);
                    var data = {};
                    data["id"] = id;
                    data["_token"] = '{{ csrf_token() }}';
                    data["new_cid"] = cid;
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

                function sendsms(phone_no, ref_no) {
                    var data = {};
                    var url = '{{ url('admin/send_sms') }}/' + phone_no + '/' + ref_no;

                    data["_token"] = '{{ csrf_token() }}';
                    $.get(url, function(data) {

                        if (data == 200) {
                            $("#sms_response").html(
                                '<div class="alert alert-success"><strong>Success!</strong> SMS Successfully sent.</div>'
                                );
                        } else {
                            $("#sms_response").html(
                                '<div class="alert alert-danger"><strong>Error!</strong> SMS sending failed.</div>');
                        }

                    });
                }
            </script>
        @endsection
