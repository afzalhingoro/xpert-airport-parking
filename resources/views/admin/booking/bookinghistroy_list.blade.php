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

                Bookings

                <small>

                    <i class="ace-icon fa fa-angle-double-right"></i>

                    Edit And Cancel Booking History

                </small>

            </h1>

        </div><!-- /.page-header -->

        <div class="col-md-10">

            <form method="get" action="{{ route('bookinghistroy') }}">

                <input type="text" value="{{ Request::get('name') }}" name="name" placeholder="Search here..." />

                <input value="Search" type="submit" class="btn btn-sm btn-success" />

            </form>

        </div>



        <br>

        <br>

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

                        <div class="table-responsive">

                            <table id="simple-table" class="table  table-bordered table-hover">

                                <thead>

                                    <tr>



                                        <th>Reference No</th>

                                        <th>Name</th>

                                        <th>Discount Amount</th>

                                        <th>Booking Amount</th>

                                        <th>Adjustment Amount</th>

                                        <th>Sms Fee</th>

                                        <th>Booking Fee</th>

                                        <th>Cancel Fee</th>

                                        <th>Payment Action</th>

                                        <th>Amount Type</th>

                                        <th>Total Amount</th>

                                        <th>Payable</th>

                                        <th id="action">Action</th>





                                    </tr>

                                </thead>



                                <tbody>

                                    @foreach ($bookings as $booking)
                                        @php

                                            //$user = $db->get_row("SELECT first_name,last_name from " . $db->prefix . "booking where referenceNo='".$row["referenceNo"] ."'");

                                            $user = \App\airports_bookings::where('referenceNo', $booking->referenceNo)->first();

                                        @endphp
                                        @if ($booking->edit_by != 0)
                                            <tr>









                                                <td class="">{{ $booking->referenceNo }}</td>

                                                <td class="">
                                                    @if ($user)
                                                        {{ $user->first_name . ' ' . $user->last_name }}
                                                    @endif
                                                </td>

                                                <td class="">{{ $booking->discount_amount }}</td>

                                                <td class="">{{ $booking->booking_amount }}</td>

                                                <td class="">{{ $booking->booking_extra }}</td>

                                                <td class="">{{ $booking->smsfee }}</td>

                                                <td class="">{{ $booking->booking_fee }}</td>

                                                <td class="">{{ $booking->cancelfee }}</td>

                                                <td class="">{{ $booking->payment_action }}</td>

                                                <td class="">{{ $booking->amount_type }}</td>

                                                <td class="">{{ $booking->total_amount }}</td>

                                                <td class="">{{ $booking->payable }}</td>

                                                <td><i id="view_detail" onclick="getDetail('{{ $booking->orderID }}')"
                                                        class="btn btn-minier btn-success fa fa-eye" title="View"></i>
                                                </td>





                                            </tr>
                                        @endif
                                    @endforeach





                                </tbody>

                            </table>

                        </div>



                        {{ $bookings->appends(request()->input())->links('vendor.pagination.default') }}

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
    <script src="{{ secure_asset('assets/front/js/bootbox.js') }}"></script>

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
