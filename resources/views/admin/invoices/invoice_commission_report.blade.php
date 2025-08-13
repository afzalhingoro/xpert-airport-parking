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
            <ol class="breadcrumb bc-3">
                <li><a href="Dashboad">Dashboad</a></li>
                <li>Reports</li>
                <li class="active"><strong>ZMD Detail Commission Report</strong></li>
            </ol>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-md-6">
                <h2>Invoice Commission Report</h2>
            </div>

        </div>
        <form action="index.php?p=airport_commission_report" method="post" class="form-inline"
            style="margin-bottom: 10px;">
            <div class="form-group" style="padding: 6px 2px;">
                <input type="text" name="search" class="form-control" id="field-1" value=""
                    placeholder="Search By Keyword" style="padding: 6px 2px; width:98%;">
            </div>
            <div class="form-group">
                <select name="airport" class="form-control" style="padding: 6px 2px;">
                    <option value="all">All Airports</option>
                    <option value="1">Gatwick </option>
                </select>
            </div>
            &nbsp; &nbsp;
            <div class="form-group">
                <select name="airport" class="form-control" style="padding: 6px 2px;">
                    <option value="all">All Admins</option>
                    <option value="1">Admin </option>

                </select>
            </div>
            &nbsp; &nbsp;
            <div class="form-group">
                <select name="airport" class="form-control" style="padding: 6px 2px;">
                    <option value="all">All Companies</option>
                    <option value="1">Jhon Watson </option>
                </select>
            </div>

            &nbsp; &nbsp;
            <div class="form-group">
                <select name="payment" class="form-control" style="padding: 6px 2px;">
                    <option value="all">Payment Type</option>
                    <option value="Paypal">Paypal</option>
                    <option value="Barclay">Barclay</option>
                </select>
            </div>
            &nbsp; &nbsp;
            <div class="form-group">
                Status
                <select id="my_status" name="status" class="form-control" style="padding: 6px 2px; " required="">
                    <option value="all">Booking Status</option>
                    <option value="Booked">Booked</option>
                    <option value="Amend">Amend</option>
                    <option value="Refund">Refund</option>
                    <option value="Cancelled">Cancelled</option>
                    <option value="Noshow">No Show</option>
                </select>
            </div> &nbsp; &nbsp;

            <div class="form-group">
                Filter by
                <select name="filter" class="form-control" style="padding: 6px 2px; ">
                    <option value="all">All</option>
                    <option value="createdate" selected="selected">Booked Date</option>
                    <option value="departDate">Departure Date</option>
                    <option value="returnDate">Arrival Date</option>
                </select>
            </div>
            <div class="form-group">
                From
                <input type="text" name="start_date" class="form-control datepicker" placeholder="Start Date"
                    data-format="dd-MM-yyyy" value="03-December-2018" style="padding: 6px 2px;">
            </div>
            <div class="form-group">
                To
                <input class="form-control date-picker" autocomplete="off" id="start_date" name="start_date" type="text"
                    data-date-format="dd-mm-yyyy" />

            </div>
            <div class="form-group">
                <strong style="color:green;">Previous Adjustment</strong>
                <input type="text" name="adjust" class="form-control" placeholder="Enter Adjustment amout"
                    value="">
            </div>
            <div class="form-group">
                <input name="submit" type="submit" value="Search" class="btn btn-primary">
                <a href="index.php?p=airport_commission_report" class="btn btn-primary">Reset</a>
            </div>
        </form>

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

                        <table class="table table-bordered table-striped table-condensed dataTable" id="table-1"
                            role="grid" aria-describedby="table-1_info">
                            <thead>
                                <tr>

                                <tr role="row">
                                    <th rowspan="1" colspan="1">Reference#</th>
                                    <th>Name</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1"
                                        colspan="1" aria-label="Booking Date : activate to sort column ascending"
                                        style="width: 69px;">Booking Date </th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1"
                                        colspan="1" aria-label="Departure Date : activate to sort column ascending"
                                        style="width: 77px;">Departure Date </th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1"
                                        colspan="1" aria-label="Return Date : activate to sort column ascending"
                                        style="width: 59px;">Return Date </th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1"
                                        colspan="1" aria-label="Days: activate to sort column ascending"
                                        style="width: 29px;">Days</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1"
                                        colspan="1" aria-label="Payment Method: activate to sort column ascending"
                                        style="width: 85px;">Payment Method</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1"
                                        colspan="1" aria-label="Booking Amount: activate to sort column ascending"
                                        style="width: 85px;">Booking Amount</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1"
                                        colspan="1" aria-label="Company Commission: activate to sort column ascending"
                                        style="width: 117px;">Company Commission</th>
                                    <th class="sorting" tabindex="0" aria-controls="table-1" rowspan="1"
                                        colspan="1" aria-label="Fly Commission: activate to sort column ascending"
                                        style="width: 83px;">Fly Commission</th>
                                </tr>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($bookings as $booking)
                                    <tr>


                                        <td class="hidden-480">{{ $booking->referenceNo }}</td>
                                        <td class="hidden-480">{{ $booking->first_name . ' ' . $booking->last_name }}</td>
                                        <td class="hidden-480">{{ $booking->departDate }}</td>
                                        <td class="hidden-480">{{ $booking->returnDate }}</td>
                                        <td class="hidden-480">{{ $booking->created_at }}</td>
                                        <td class="hidden-480">{{ $booking->booking_status }}</td>
                                        <td class="hidden-480">{{ $booking->no_of_days }}</td>
                                        <td class="hidden-480">{{ $booking->no_of_days }}</td>
                                        <td class="hidden-480">{{ $booking->no_of_days }}</td>
                                        <td class="hidden-480">{{ $booking->no_of_days }}</td>




                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                        {{ $bookings->links('vendor.pagination.default') }}
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
