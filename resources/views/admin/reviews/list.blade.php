@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/admin.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}" />
@endsection
@section('content')
    <style>
        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {
            td:nth-of-type(1):before {
                content: "Name";
            }

            td:nth-of-type(2):before {
                content: "Airport";
            }

            td:nth-of-type(3):before {
                content: "Admin";
            }

            td:nth-of-type(4):before {
                content: "Company";
            }

            td:nth-of-type(5):before {
                content: "Review";
            }

            td:nth-of-type(6):before {
                content: "Rating";
            }

            td:nth-of-type(7):before {
                content: "Date";
            }

            td:nth-of-type(8):before {
                content: "Resend Link";
            }

            td:nth-of-type(9):before {
                content: "Google";
            }

            td:nth-of-type(10):before {
                content: "Email";
            }

            td:nth-of-type(11):before {
                content: "Status";
            }



        }
    </style>
    <div class="page-content">


        <div class="page-header">
            <h1>
                Reviews
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

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
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{ route('reviews.index') }}" method="get" class="form-inline">
                                    <div class="form-group">
                                        <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control" id="field-1" value="" placeholder="Search By Keyword">
                                    </div>
                                    <div class="form-group">
                                        From
                                        <input type="text" name="start_date" id="start_date" autocomplete="off"
                                            class="form-control datepicker" placeholder="Start Date"
                                            data-date-format="dd-M-yyyy" value="{{ Request::get('start_date') }}">
                                    </div>
                                    <div class="form-group">
                                        To
                                        <input class="form-control date-picker" value="{{ Request::get('end_date') }}"
                                            autocomplete="off" id="end_date" placeholder="End Date" name="end_date"
                                            type="text" data-date-format="dd-M-yyyy" />

                                    </div>
                                    &nbsp; &nbsp;








                                    <div class="form-group">
                                        <input name="submit" type="submit" value="Search" class="btn btn-primary">
                                        <a href="{{ route('reviews.index') }}" class="btn btn-primary">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12">

                                <div class="addNewBtn">
                                    @can('user_auth', ['add'])
                                        <a class="btn btn-success"
                                            href="{{ route('reviews.create') }}"> Add New</a>
                                    @endcan
                                    
                                </div>
                            </div>


                                {{-- <a style="float: right; margin-bottom: 9px;" class="btn btn-success" --}}
                                {{-- href="{{ route("pages.create") }}"> Add New</a> --}}
                              <br>
                              <br>
                              <br>
                            <div class="col-md-12">

                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                        <tr>

                                            <th>Name</th>
                                            <!--<th>Airport</th>-->
                                            <!--<th>Admin</th>-->
                                            <!--<th>Company</th>-->
                                            <th>Review</th>
                                            <th>Rating</th>
                                            <th>Date</th>
                                            <!--<th>Resend Link</th>-->
                                            <!--<th>Google</th>-->
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($reviews as $review)
                                            <tr>


                                                <td class="">{{ $review->username }}</td>
                                                <!--<td class="">
    @if ($review->airport)
    {{ $review->airport->name }}
    @endif
    </td>-->
                                                <!--<td class="">
    @if ($review->user)
    {{ $review->user->name }}
    @endif
    </td>-->
                                                <!--<td class="">
    @if ($review->company)
    {{ $review->company->name }}
    @endif
    </td>-->
                                                <td class="">{!! $review->review !!}</td>
                                                <td class="">{{ $review->rating }}</td>
                                                <td class="">{{ $review->created_at }}</td>
                                                <!--<td class=""><a href="">Resend Link</a> </td>-->
                                                <!--<td class="">{{ $review->google_count }}</td>-->

                                                <td class="">{{ $review->email }}</td>
                                                @if ($review->status == 'Yes')
                                                    <td class=""> <span class="label  label-success"> Active</span>
                                                    </td>
                                                @else
                                                    <td class=""> <span class="label  label-danger">InActive</span>
                                                    </td>
                                                @endif

                                                <td>
                                                    <div class="btn-group">

                                                        @can('user_auth', ['delete'])
                                                            <form method="POST" style="margin-right: 5px; float: left"
                                                                onsubmit="return confirm('Are you sure?')"
                                                                action="{{ route('reviews.destroy', $review->id) }}">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="submit" class="btn btn-xs btn-danger">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </button>
                                                            </form>
                                                        @endcan
                                                        </a>
                                                        @can('user_auth', ['edit'])
                                                            <a href="{{ route('reviews.edit', $review->id) }}">
                                                                <button class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </button>
                                                            </a>
                                                        @endcan

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                                {{ $reviews->appends(request()->input())->links('vendor.pagination.default') }}
                            </div>
                            </div><!-- /.span -->
                        </div><!-- /.row -->


                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            <script>
                function validate(form) {

                    // validation code here ...


                    if (!valid) {
                        alert('Please correct the errors in the form!');
                        return false;
                    } else {
                        return confirm('Do you really want to submit the form?');
                    }
                }
            </script>
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
            {{-- <script src="{{ secure_asset("assets/js/jquery.min.js") }}"></script> --}}
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
            </script>
        @endsection
