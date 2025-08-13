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
        .butn {
            margin-top: 22px !important;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">


        <div class="page-header">
            <h1>
                External Bookings
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div>
        <div class="col-xs-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="col-md-12">

                <form action="{{ route('external_booking') }}" method="get" class="form-inline"
                    style="margin-bottom: 10px;">
                    <div class="form-group">
                        Search<br>
                        <input type="text" value="{{ Request::get('search') }}" name="search"
                            class="form-control input-sm" id="field-1" value="" placeholder="Search By Keyword"
                            style="padding: 6px 2px;">
                    </div>
                    <div class="form-group">
                        Agent<br>
                        <select name="agent" class="form-control input-sm">
                            <option value="">All</option>
                            @foreach ($agents as $agent)
                                <option @if (Request::get('agentID') == $agent->alias) {{ "selected='selected'" }} @endif
                                    value="{{ $agent->alias }}">{{ $agent->alias }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        Booked Date <br>
                        <select name="filter" class="form-control input-sm">
                            <option value="all" @if (Request::get('filter') == 'all') {{ "selected='selected'" }} @endif>All
                            </option>
                            <option value="booking_date"
                                @if (Request::get('filter') == 'booking_date') {{ "selected='selected'" }} @endif> Booking Date
                            </option>
                            <option value="departure_datetime"
                                @if (Request::get('filter') == 'departure_datetime') {{ "selected='selected'" }} @endif> Departure Date
                            </option>
                            <option value="return_datetime"
                                @if (Request::get('filter') == 'return_datetime') {{ "selected='selected'" }} @endif> Arrival Date
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        From<br>
                        <input type="date" name="start_date" id="start_date" autocomplete="off"
                            class="form-control input-sm datepicker" placeholder="Start Date" data-date-format="dd-M-yyyy"
                            value="{{ Request::get('start_date') }}">
                    </div>
                    <div class="form-group">
                        To<br>
                        <input class="form-control input-sm date-picker" value="{{ Request::get('end_date') }}"
                            autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="date"
                            data-date-format="dd-M-yyyy" />
                    </div>
                    <div class="form-group">
                        Booked Status <br>
                        <select id="my_status" name="status" class="form-control input-sm">
                            <option value="all">Booking Status</option>
                            <option value="Booked">
                                Booked
                            </option>
                            <option value="Amended" @if (Request::get('status') == 'Amended') {{ "selected='selected'" }} @endif>
                                Amended
                            </option>
                            <option value="Payment-Pending"
                                @if (Request::get('status') == 'Payment-Pending') {{ "selected='selected'" }} @endif>
                                Payment-Pending
                            </option>
                            <option value="Cancelled" @if (Request::get('status') == 'Cancelled') {{ "selected='selected'" }} @endif>
                                Cancelled
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        &nbsp;<br>
                        <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm"
                            style="margin-left:10px">
                        <a href="{{ route('external_booking') }}" class="btn btn-primary btn-sm"
                            style="margin-left:10px">Reset</a>
                    </div>
                </form>

            </div>
            <div class="row">
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
                                    <h2 class="no-radius badge badge-info" style="padding: 10px;"><i
                                            class="entypo-target"></i> Total
                                        External Bookings: <span id="no_of_booking">
                                            {{ number_format($bookings->total()) }} </span>
                                    </h2>
                                    <table id="simple-table" class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th> S# </th>
                                                <th> Reference No </th>
                                                <th> Customer Name </th>
                                                <th> Booking Date </th>
                                                <th> Departure Date </th>
                                                <th> Return Date </th>
                                                <th> Booking status </th>
                                                <th> Discount Amount </th>
                                                <th> Payment Method </th>
                                                <th> Payment Status </th>
                                                <th> Net Amount </th>
                                                <th> Agent </th>
                                                <th> Referral </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($bookings as $booking)
                                                <tr>
                                                    <td> {{ $loop->iteration }} </td>
                                                    <td> {{ $booking->reference_number }} </td>
                                                    <td> {{ $booking->customer_name }} </td>
                                                    <td> {{ $booking->booking_date }} </td>
                                                    <td> {{ $booking->departure_datetime }} </td>
                                                    <td> {{ $booking->return_datetime }} </td>
                                                    <td> {{ $booking->booking_status }} </td>
                                                    <td> {{ $booking->discount_amount }} </td>
                                                    <td> {{ $booking->payment_mode }} </td>
                                                    <td> {{ $booking->payment_status }} </td>
                                                    <td> {{ $booking->total_amount }} </td>
                                                    <td> {{ $booking->supplier_name }}</td>
                                                    <td> External </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="table-responsive text-right">
                                        {{ $bookings->links() }}
                                    </div>

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
            <script src='{{ secure_asset('assets/front/js/bootbox.js') }}'></script>
        @endsection
