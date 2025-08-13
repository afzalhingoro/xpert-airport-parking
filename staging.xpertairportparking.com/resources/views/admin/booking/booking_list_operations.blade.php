@extends('admin.layout.master')

@section('stylesheets')

    @parent

    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}"/>

    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}"/>

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}"/>

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}"/>

    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}"/>

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}"/>

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}"/>

@endsection

@section('content')



    <div class="page-content">





        <div class="page-header">

            <h1>

                Bookings

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

                        <div class="form-group" style="padding: 6px 2px;">

                            <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control"

                                   id="field-1" value=""

                                   placeholder="Search By Keyword" style="padding: 6px 2px; width:98%;">

                        </div>

                        <div class="form-group">

                            <select name="airport" class="form-control" style="padding: 6px 2px;">

                                <option value="all">All Airports</option>

                                @foreach($airports as $airport)

                                    <option @if(Request::get('airport')==$airport->id) {{ "selected='selected'" }} @endif value="{{ $airport->id }}">{{ $airport->name }}</option>

                                @endforeach

                            </select>

                        </div>

                        &nbsp; &nbsp;

                        <div class="form-group">

                            <select name="admins" class="form-control" style="padding: 6px 2px;">

                                <option value="all">All Admins</option>

                                @foreach($admins as $admin)

                                    <option @if(Request::get('admins')==$admin->id) {{ "selected='selected'" }} @endif value="{{ $admin->id }}">{{ $admin->name }}</option>

                                @endforeach

                            </select>

                        </div>

                        &nbsp; &nbsp;



                        <div class="form-group">

                            Filter by

                            <select name="filter" class="form-control" style="padding: 6px 2px; ">

                                <option value="all">All</option>

                                <option value="created_at" @if(Request::get('filter')=='created_at') {{ "selected='selected'" }} @endif >

                                    Booked Date

                                </option>

                                <option value="departDate" @if(Request::get('filter')=='departDate') {{ "selected='selected'" }} @endif>

                                    Departure Date

                                </option>

                                <option value="returnDate" @if(Request::get('filter')=='returnDate') {{ "selected='selected'" }} @endif >

                                    Arrival Date

                                </option>

                            </select>

                        </div>

                        <div class="form-group">

                            From

                            <input type="text" name="start_date" id="start_date" autocomplete="off"

                                   class="form-control datepicker" placeholder="Start Date"

                                   data-date-format="dd-M-yyyy" value="{{ Request::get('start_date') }}"

                                   style="padding: 6px 2px;">

                        </div>

                        <div class="form-group">

                            To

                            <input class="form-control date-picker" value="{{ Request::get('end_date') }}"

                                   autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text"

                                   data-date-format="dd-M-yyyy"/>



                        </div>

                        <div class="form-group">

                            <select name="companies" class="form-control" style="padding: 6px 2px;">

                                <option value="all">All Companies</option>

                                @foreach($companies_dlist as $company)

                                    <option @if(Request::get('companies')==$company->id) {{ "selected='selected'" }} @endif value="{{ $company->id }}">{{ $company->name }}</option>

                                @endforeach

                            </select>

                        </div>

                        &nbsp; &nbsp;

                        <div class="form-group">

                            <select name="payment" class="form-control" style="padding: 6px 2px;">

                                <option value="all">Payment Type</option>

                                <option value="payzone" @if(Request::get('payment')=='payzone') {{ "selected='selected'" }} @endif>

                                    Payzone

                                </option>

                            </select>

                        </div>

                        &nbsp; &nbsp;

                        <div class="form-group">

                            Status

                            <select id="my_status" name="status" class="form-control" style="padding: 6px 2px; "

                                    required="">

                                <option value="all">Booking Status</option>

                                <option value="Booked" @if(Request::get('status')=='Booked') {{ "selected='selected'" }} @endif>

                                    Booked

                                </option>

                                <option value="Amend" @if(Request::get('status')=='Amend') {{ "selected='selected'" }} @endif>

                                    Amend

                                </option>

                                <option value="Refund" @if(Request::get('status')=='Refund') {{ "selected='selected'" }} @endif>

                                    Refund

                                </option>

                                <option value="Cancelled" @if(Request::get('status')=='Cancelled') {{ "selected='selected'" }} @endif>

                                    Cancelled

                                </option>

                                <option value="Noshow" @if(Request::get('status')=='Noshow') {{ "selected='selected'" }} @endif>

                                    No Show

                                </option>

                            </select>

                        </div> &nbsp; &nbsp;





                        <div class="form-group">

                            <strong style="color:green;">Previous Adjustment</strong>

                            <input type="text" name="adjust" value="{{ Request::get('adjust') }}" class="form-control"

                                   placeholder="Enter Adjustment amout" value="">

                        </div>

                        <div class="form-group">

                            <input name="submit" type="submit" value="Search" class="btn btn-primary">

                            <a href="{{ route("booking") }}" class="btn btn-primary">Reset</a>

                        </div>

                    </form>



                </div>





                <br>

                <br>

                <br>

                <div class="col-md-12"

                     style="border: 1px solid #e4e4e4;    border-radius: 9px; margin-bottom: 10px;background: #f5f5f6;">

                    <div class="col-md-6">

                        @php

                            $countCompleted=0;

                              foreach($bookings_count as $booking)

                              {





                                if($booking['booking_status']=='Completed')

                                $countCompleted++;







                              }



                        @endphp



                        <h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i> Total Booked

                            bookings: <span id="no_of_booking"> @php echo  $countCompleted; @endphp</span></h2>





                    </div>



                </div>



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



                                <table id="simple-table" class="table  table-bordered table-hover">

                                    <thead>

                                    <tr>







                                        <th>Reference No</th>

                                        <th>Airports</th>

                                        <th>Name</th>

                                        <th>Booking Date</th>

                                        <th>Departure Date</th>

                                        <th>Return Date</th>

                                        <th>Booking status</th>

                                        <th>Payment Method</th>

                                        <th>Refund</th>

                                        <th>Net Amount</th>

                                        <th>no of days</th>

                                        <th id="email">Email</th>

                                        <th id="action">Action</th>

                                        <th id="cancel">Canc</th>

                                         @if($role_name!="Sales")

                                        <th id="refund">Refund</th>



                                        <th id="sms">Sms</th>

                                        @endif



                                    </tr>

                                    </thead>



                                    <tbody>

                                    @foreach($bookings as $booking)





                                        @php    if($booking['booking_status']=='Completed') { @endphp



                                        <tr id="expand_{{  $booking->id  }}">

                                        @php } else { @endphp

                                        <tr style="color:red;" id="expand_{{  $booking->id  }}">

                                            @php }  @endphp



                                            <td style="width: 14%;">

                                                <i class="fa fa-plus-circle" id="show_detail_icon_{{  $booking->id  }}"

                                                   style="cursor: pointer; font-size: 20px;"

                                                   onclick="show_detal('{{  $booking->id  }}')"></i> {{ $booking->referenceNo }}

                                            </td>

                                            <td class="hidden-480">@if($booking->airport) <span

                                                        class="label label-lg label-success"><i

                                                            class="fa fa-plane"></i> {{ ucwords(preg_replace('/\s/', '', $booking->airport->name))  }}</span>  @endif

                                            </td>

                                            <td class="hidden-480">{{ $booking->first_name." ".$booking->last_name }}</td>



                                            <td class="hidden-480">{{ $booking->created_at }}</td>

                                            <td class="hidden-480">{{ $booking->departDate }}</td>

                                            <td class="hidden-480">{{ $booking->returnDate }}</td>

                                            <td class="hidden-480">{{ $booking->booking_status }}</td>

                                            <td class="hidden-480">

                                                @if($booking->payment_method=="stripe")

                                                    <span class="label label-lg label-info"><i

                                                                class="fa fa-cc-stripe"></i> {{ ucwords(preg_replace('/\s/', '', $booking->payment_method))  }}</span>





                                                @elseif($booking->payment_method=="payzone")

                                                    <span class="label label-lg label-info"><i

                                                                class="fa fa-paypal"></i> {{ ucwords(preg_replace('/\s/', '', $booking->payment_method))  }}</span>







                                                @endif

                                            </td>

                                            <td class="hidden-480">0</td>

                                            <td class="hidden-480">£{{ $booking->booking_amount  }}</td>

                                            <td class="hidden-480">{{ $booking->no_of_days}}</td>



                                        <th> <i onclick="sendEmailForm('{{ $booking->id  }}','{{ $booking->companyId  }}')"

                                                                   class="btn btn-minier btn-grey fa fa-envelope"></i></th>

                                        <th id="action"><a id="edit" class="btn btn-minier btn-primary"

                                                                   href="{{ route("edit_booking_form",[$booking->id]) }}"

                                                                   title="Edit"> <i class="fa fa-pencil"

                                                                                    title="Edit"></i></a></th>

                                        <th onclick="getcancelForm('{{ $booking->id  }}')">Canc</th>

                                       @if($role_name!="Sales")

                                        <th id="refund"><i onclick="getrefundForm('{{ $booking->id  }}')"

                                                                   class="btn btn-minier btn-pink  fa fa-reply"></i></th>



                                        <th id="sms">Sms</th>

                                        @endif





                                        </tr>





                                    @endforeach





                                    </tbody>

                                </table>





                                {{ $bookings->appends(request()->input())->links("vendor.pagination.default") }}

                            </div><!-- /.span -->

                        </div><!-- /.row -->





                        <!-- PAGE CONTENT ENDS -->

                    </div><!-- /.col -->

                </div><!-- /.row -->

            </div>

            <br/>

            <br/>

            <br/>



@endsection



@section("footer-script")

                <script src="{{ secure_asset("assets/js/moment.min.js") }}"></script>

                <script src="{{ secure_asset("assets/js/daterangepicker.min.js") }}"></script>

                <script src="{{ secure_asset("assets/js/bootstrap-datetimepicker.min.js") }}"></script>



                <script src="{{ secure_asset("assets/js/bootstrap-datepicker.min.js") }}"></script>

                <script src="{{ secure_asset("assets/js/bootstrap-timepicker.min.js") }}"></script>





                <!-- page specific plugin scripts -->

                <script src="{{ secure_asset("assets/js/wizard.min.js") }}"></script>

                <script src="{{ secure_asset("assets/js/jquery.validate.min.js") }}"></script>

                <script src="{{ secure_asset("assets/js/jquery-additional-methods.min.js") }}"></script>

                <script src="{{ secure_asset("assets/js/bootbox.js") }}"></script>

                {{--<script src="{{ secure_asset("assets/js/jquery.min.js") }}"></script>--}}

                <script src="{{ secure_asset("assets/js/select2.min.js") }}"></script>

                <script type="text/javascript">





                    $('#start_date').datepicker({

                        autoclose: true,

                        todayHighlight: true

                    })

                    //show datepicker when clicking on the icon

                        .next().on(ace.click_event, function () {

                        $(this).prev().focus();

                    });





                    $('#end_date').datepicker({

                        autoclose: true,

                        todayHighlight: true

                    })

                    //show datepicker when clicking on the icon

                        .next().on(ace.click_event, function () {

                        $(this).prev().focus();

                    });



                </script>







                <script src="{{ secure_asset("assets/front/js/bootbox.js") }}"></script>

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

                            "                        <input  onclick=\"sendEmail('" + id + "','" + cmpID + "')\" class=\"btn btn-info\" value=\"Send\" style=\"margin: 15px 5px 5px 15px;\">\n" +

                            "                        </div>");

                    }



                    function sendEmail(id, cid) {

                        var type = $('input[name=resendEmailto]:checked').val();

                        $("#resend_email").html("<div id=\"resend_email\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");



                        var data = {};

                        data["id"] = id;

                        data["cid"] = cid;

                        data["type"] = type;

                        data["_token"] = '{{ csrf_token() }}';

                        $.post('{{ route("booking.sendEmailBooking") }}', data, function (data) {

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

                        }

                        else {

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

                        ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");

                        var data = {};

                        data["id"] = id;

                        data["_token"] = '{{ csrf_token() }}';

                        $.post('{{ route("bookingdetail.show") }}', data, function (data) {

                            console.log("data===", data);

                            $("#booking_detail_pop").html(data);

//

                        });





                    }





                    function getcancelForm(id) {

                        ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");

                        var data = {};

                        data["id"] = id;

                        data["_token"] = '{{ csrf_token() }}';

                        $.post('{{ route("bookingdetail.cancelForm") }}', data, function (data) {

                            console.log("data===", data);

                            $("#booking_detail_pop").html(data);

//

                        });





                    }



                    function getrefundForm(id) {

                        ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");

                        var data = {};

                        data["id"] = id;

                        data["_token"] = '{{ csrf_token() }}';

                        $.post('{{ route("bookingdetail.refundForm") }}', data, function (data) {

                            console.log("data===", data);

                            $("#booking_detail_pop").html(data);

//

                        });





                    }





                    function transferSubmit(id) {

                        var cid = $("#company_id_pop option:selected").val();

                        var html = "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>";

                        $("#booking_detail_pop").html(html);

                        var data = {};

                        data["id"] = id;

                        data["_token"] = '{{ csrf_token() }}';

                        data["new_cid"] = cid;

                        $.post('{{ route("transferBooking") }}', data, function (data) {

                            console.log("data===", data);

                            $("#booking_detail_pop").html(data);

//

                        });





                    }





                    function getTransferForm(url) {

                        ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");

                        var data = {};

                        // data["id"]=id;

                        data["_token"] = '{{ csrf_token() }}';

                        $.get(url, data, function (data) {

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

