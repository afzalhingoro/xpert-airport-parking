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
    <style>
        .sh {
            margin-top: 24px !important;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">


        <div class="page-header">
            <h1>
                Gross Earnings
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('gross.earnings') }}" method="get" class="form-inline"
                    style="margin-bottom: 10px;">
                    <div class="form-group">
                        From <br>
                        <input type="date" name="from_date" id="from_date" autocomplete="off"
                            class="form-control input-sm datepicker" placeholder="From Date" data-date-format="dd-M-yyyy"
                            value="{{ Request::get('from_date') }}">
                    </div>

                    <div class="form-group">
                        To <br>
                        <input type="date" name="to_date" id="to_date" autocomplete="off"
                            class="form-control input-sm datepicker" placeholder="To Date" data-date-format="dd-M-yyyy"
                            value="{{ Request::get('to_date') }}">
                    </div>
                    <div class="form-group sh">
                        <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                        <a href='{{ route('gross.earnings') }}' class="btn btn-primary btn-sm">Reset</a>
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
                        <div class="table table-responsive">
                            <table id="simple-table" class="table  table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Reference No</th>
                                        <th>Booking Date </th> 
                                        <th> Gross Total </th>
                                        <th> Net Total </th>
                                    </tr>
                                </thead>

                                <tbody>


                                    @foreach ($bookings as $booking)
                                    @php
                                        $discount_amount = $booking->discount_amount; 
                                        $bookingAmount = $booking->booking_amount; 
                                        $booking_extra = $booking->booking_extra; 
                                        $extra_amount = $booking->extra_amount; 
                                        $smsfee = $booking->smsfee; 
                                        $postal_fee = $booking->postal_fee; 
                                        $cancelfee = $booking->cancelfee; 
                                        $leavy_fee = $booking->leavy_fee; 
                                        $total_amount = $booking->total_amount; 
                                        $valet_amount = $booking->valet_amount; 
                                        $booking_fee = $booking->booking_fee; 
                                        $commissionRate = 30; 
                                        $commissionRateDecimal = $commissionRate / 100; 
                                        $totalCommission = $commissionRateDecimal * $bookingAmount; 
                                        $othersAmount = ($booking_fee + $smsfee + $cancelfee + $extra_amount + $booking_extra + $postal_fee + $valet_amount + $leavy_fee); 
                                        $grossTotal = ($bookingAmount + $othersAmount); 
                                        $refundAmount = ($total_amount - $othersAmount); 
                                        $netTotal = ($grossTotal - $discount_amount - $totalCommission);

                                    @endphp
                                        <tr>
                                            <td style="width: 14%;">
                                                {{ $booking['referenceNo'] }}
                                            </td>
                                            <td class="">
                                                {{ $booking->created_at }}
                                            </td>
                                            <td class="">
                                                {{ number_format($grossTotal) }}
                                            </td>
                                            <td class="">
                                                {{ number_format($netTotal) }}
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                                    @if(count($bookings) > 0) 
                                         {{ $bookings->links() }}
                                    @endif    


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
    @endsection
