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
                    <form action="{{ route('daily_report') }}" method="get" class="form-inline"
                        style="margin-bottom: 10px;">

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
                        <div class="form-group">
                            <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                            <a href="{{ route('booking') }}" class="btn btn-primary btn-sm">Reset</a>
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

                                                <th>S.No</th>
                                                <th>Date</th>
                                                <th>Departure</th>
                                                <th>Return</th>
                                                <th>Bookings</th>
                                                <th>Revenue</th>


                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $serial = 1;
                                            @endphp
                                            @foreach ($bookings as $booking)
                                                <tr>

                                                    <td>{{ $serial++ }}</td>


                                                    <td>{{ $booking->date }}</td>
                                                    <td>{{ $booking->views }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                </tr>
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
        @endsection
