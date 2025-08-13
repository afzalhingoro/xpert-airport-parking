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
    <script>
        function hideText() {
            // hides text for 5 secs

            const btn = document.querySelector('#excel');
            const infoHide = document.querySelector('.info-hide');

            infoHide.style.display = "block"
            btn.style.display = 'none'
            setTimeout(() => {
                btn.style.display = 'block';
                infoHide.style.display = "none"
            }, 10000)

        }
    </script>
    <style>
        .loader {
            margin-top: 200px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="info-hide"
        style="display:none;background:rgb(232, 242, 250,0.8);    background-size: cover;height:100%;width:100%;position:absolute;z-index:99">
        <center>
            <div class="loader"></div>
        </center>
    </div>

    <div class="page-content">

        <div class="page-header">
            <h1>
                Capacity Report
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
                                <div style="text-align: right;margin-bottom: 20px;">
                                    <a style = "" id="excel" class="btn btn-primary  btn-sm"
                                        href='{{ route('capacity.report') }}?days=30' onClick="hideText()"> 30 Days </a>

                                    <a style = "" id="excel" class="btn btn-primary  btn-sm"
                                        href='{{ route('capacity.report') }}?days=60' onClick="hideText()"> 60 Days </a>
                                    <a style = "" id="excel" class="btn btn-primary  btn-sm"
                                        href='{{ route('capacity.report') }}?days=90' onClick="hideText()"> 90 Days </a>

                                </div>

                                <div id="sms_response"></div>
                                <div class="table-responsive">
                                    <table id="simple-table" class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th style="width: 50px;"> S/No</th>
                                                <th>Date</th>
                                                <th>Day</th>
                                                <th>Departure (New Cars in System)</th>
                                                <th>Arrivals (Cars Leaving the system)</th>
                                                <th>Available Slots</th>
                                                <th>Overnight Stay (Occupied Slots)</th>


                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php $i = 0; ?>

                                            @foreach ($result as $row)
                                                <tr>
                                                    <td>

                                                        {{ $i + 1 }}

                                                    </td>

                                                    <td>{{ date('d-m-Y', strtotime($row['currentdate'])) }}</td>
                                                    <td>{{ $row['dayName'] }}</td>
                                                    <td>{{ $row['departure'] }}</td>
                                                    <td>{{ $row['arrivals'] }}</td>
                                                    <td>{{ $row['bookings'] }}</td>
                                                    <td>{{ $row['overnight'] }}</td>


                                                </tr>
                                                <?php $i++; ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                    <div style="margin-right:20px;float:right ">
                                        {{ $result->links() }}


                                    </div>
                                </div>



                            </div><!-- /.span -->
                        </div><!-- /.row -->


                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
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
