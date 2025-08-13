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
        .navbar{
            height: 10px;
        } 
        .sh{
            margin-top: 25px;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">


        <div class="page-header">
            <h1>
                Parsed Email Report
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('parsed.emails.report') }}" method="get" class="form-inline"
                    style="margin-bottom: 10px;">
                    <div class="form-group">
                        Search<br>
                        <input type="text" value="{{ Request::get('search') }}" name="search"
                            class="form-control input-sm" id="field-1" value="" placeholder="Search By Reference No">
                    </div>


 
                    <div class="form-group">
                        <label style="margin-bottom: 0px;" for="booking_type">Booking Type</label><br>
                        <select class="form-control input-sm" id="booking_type" name="booking_type">
                            <option value="">Select Booking type</option>
                            <option value="0" {{ Request::get('booking_type') == '0' ? 'selected' : '' }}>Booked</option>
                            <option value="1" {{ Request::get('booking_type') == '1' ? 'selected' : '' }}>Amend</option>
                            <option value="2" {{ Request::get('booking_type') == '2' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="margin-bottom: 0px;" for="status">Status</label><br>
                        <select class="form-control input-sm" id="status" name="status">
                            <option value="">Select Status</option>
                            <option value="0" {{ Request::get('status') == '0' ? 'selected' : '' }}>Completed</option>
                            <option value="1" {{ Request::get('status') == '1' ? 'selected' : '' }}>Pending</option>
                            <option value="3" {{ Request::get('status') == '3' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>



                    <div class="form-group sh">
                        <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                        <a href='{{ route('parsed.emails.report') }}' class="btn btn-primary btn-sm">Reset</a>
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
                        <div  class="col-md-12 text-right section-right" style="margin-top: 10px;display:none ">
                            <a id="excel" class="btn btn-primary exxl"
                                href="{{ route('company_arrival_report_excel') }}?filter={{ Request::get('filter') }}&search={{ Request::get('search') }}&start_date={{ Request::get('start_date') }}&end_date={{ Request::get('end_date') }}&companies={{ Request::get('companies') }}&airport={{ Request::get('airport') }}&status={{ Request::old('status') }}&admins={{ Request::get('admins') }}&payment={{ Request::get('payment') }}&refund_via={{ Request::get('refund_via') }}&palenty_to={{ Request::get('palenty_to') }}"><i
                                    class="entypo-download"></i>Download Excel Sheet</a>
                            <br><br>
                        </div>
                        <div class="table table-responsive">
                        <table id="simple-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Reference No</th>
                                            <th>Agent Email</th>
                                            <th>Booked/Amend/Cancelled Email Time</th>
                                            <th>Parsing Cron Start Time</th>
                                            <th>Parsing Cron End Time</th> 
                                            <th>Booking Type</th>
                                            <th>Booking status</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($bookings as $booking)
                                            <tr>
                                                <td style="width: 14%;">{{ $booking->ref_no }}</td>
                                                <td>{{ $booking->agent_email }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($booking->booking_email_time)) }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($booking->cron_start_time)) }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($booking->cron_end_time)) }}</td>
                                                 <td>
                                                @if ($booking->booking_type == '0')
                                                    <button style="background-color: black; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Booked</button>
                                                @elseif ($booking->booking_type == '1')
                                                    <button style="background-color: #0091eb; color: white; border: none; padding: 5px 10px; border-radius: 4px;">Amend</button>
                                                @elseif ($booking->booking_type == '2')
                                                    <button style="background-color: rgb(206, 0, 0); color: white; border: none; padding: 5px 10px; border-radius: 4px;">Cancelled</button>
                                                @endif
                                            </td>

                                                <td>
                                                    @if ($booking->status == '0')
                                                        <?php $booking_statu = "Completed"; ?>
                                                    @elseif ($booking->status == '1')
                                                        <?php $booking_statu = "Pending"; ?>
                                                    @else
                                                        <?php $booking_statu = "Failed"; ?>
                                                    @endif
                                                    {{ $booking_statu }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                {{ $bookings->appends(request()->input())->links('vendor.pagination.default') }}

                        </div><!-- /.span -->
                    </div><!-- /.row -->


                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
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