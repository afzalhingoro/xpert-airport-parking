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
@section('content')<style>
        .form-inline .form-group {
            margin-bottom: 8px;
        }
    </style>

    <div class="page-content">


        <div class="page-header">
            <ol class="breadcrumb bc-3">
                <li><a href="Dashboad">Dashboad</a></li>
                <li>Reports</li>
                <li class="active"><strong>Departure Report</strong></li>
            </ol>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-md-6">
                <h2>Departure Report</h2>
            </div>

        </div>
        <form action="{{ route('company_departure_report') }}" method="get" class="form-inline"
            style="margin-bottom: 10px;">
            <div class="form-group">
                <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control input-sm"
                    id="field-1" value="" placeholder="Search By Keyword" style=" width:98%;">
            </div>
            <div class="form-group">
                <select name="airport" class="form-control input-sm">
                    <option value="all">All Airports</option>
                    @foreach ($airports as $airport)
                        <option @if (Request::get('airport') == $airport->id) {{ "selected='selected'" }} @endif
                            value="{{ $airport->id }}">{{ $airport->name }}</option>
                    @endforeach
                </select>
            </div>
            &nbsp; &nbsp;

            <!--@if (
                \App\users_roles::get_user_role(Auth::user()->id)->name != 'Operations' &&
                    \App\users_roles::get_user_role(Auth::user()->id)->name != 'Sales')
    -->
            <!--<div class="form-group">-->
            <!--    <select name="admins" class="form-control input-sm" >-->
            <!--        <option value="all">All Admins</option>-->
            <!--        @foreach ($admins as $admin)
    -->
            <!--            <option @if (Request::get('admins') == $admin->id) {{ "selected='selected'" }} @endif value="{{ $admin->id }}">{{ $admin->name }}</option>-->
            <!--
    @endforeach-->
            <!--    </select>-->
            <!--</div>-->
            <!--
    @endif-->
            &nbsp; &nbsp;
            <div class="form-group">
                <select name="companies" class="form-control input-sm">
                    <option value="all">All Companies</option>
                    @foreach ($companies_dlist as $company)
                        <option @if (Request::get('companies') == $company->id) {{ "selected='selected'" }} @endif
                            value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>

            &nbsp; &nbsp;
            <div class="form-group">
                <select name="payment" class="form-control input-sm">
                    <option value="all">Payment Type</option>
                    <option value="payzone" @if (Request::get('payment') == 'payzone') {{ "selected='selected'" }} @endif>Payzone
                    </option>
                    <option value="stripe" @if (Request::get('payment') == 'stripe') {{ "selected='selected'" }} @endif>Stripe
                    </option>
                </select>
            </div>
            &nbsp; &nbsp;
            <div class="form-group">
                From
                <input type="text" name="start_date" id="start_date" autocomplete="off"
                    class="form-control input-sm datepicker" placeholder="Start Date" data-date-format="dd-M-yyyy"
                    value="{{ Request::get('start_date') }}">
            </div>
            <div class="form-group">
                To
                <input class="form-control input-sm date-picker" value="{{ Request::get('end_date') }}" autocomplete="off"
                    id="end_date" placeholder="End Date" name="end_date" type="text" data-date-format="dd-M-yyyy" />

            </div>
            <div class="form-group">
                <input name="submit" type="submit" value="Search" class="btn btn-sm btn-primary">
                <a href="{{ route('company_departure_report') }}" class="btn btn-sm btn-primary">Reset</a>
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
                        @if ($show == 1)
                            <div class="col-md-12 text-right section-right" style="margin-top: 10px">

                                <a id="excel" class="btn btn-primary exxl"
                                    href="{{ route('company_departure_detail_report_excel') }}?filter={{ Request::get('filter') }}&search=&start_date={{ Request::get('start_date') }}&end_date={{ Request::get('end_date') }}&companies={{ Request::get('companies') }}&airport={{ Request::get('airport') }}&status={{ Request::old('status') }}&admins={{ Request::get('admins') }}&payment={{ Request::get('payment') }}&refund_via={{ Request::get('refund_via') }}&palenty_to={{ Request::get('palenty_to') }}"><i
                                        class="entypo-download"></i>Download Detail Excel Sheet</a>


                                <a id="excel" class="btn btn-primary exxl"
                                    href="{{ route('company_departure_report_excel') }}?filter={{ Request::get('filter') }}&search=&start_date={{ Request::get('start_date') }}&end_date={{ Request::get('end_date') }}&companies={{ Request::get('companies') }}&airport={{ Request::get('airport') }}&status={{ Request::old('status') }}&admins={{ Request::get('admins') }}&payment={{ Request::get('payment') }}&refund_via={{ Request::get('refund_via') }}&palenty_to={{ Request::get('palenty_to') }}"><i
                                        class="entypo-download"></i>Download Excel Sheet</a>
                            </div>
                        @endif
                        <div class="table-responsive" style="overflow-x:inherit !important">
                            <table class="table table-bordered table-striped table-condensed dataTable" id="table-1"
                                role="grid" aria-describedby="table-1_info">
                                <thead>

                                    <tr role="row">

                                        <th>Reference#</th>
                                        <th>Name</th>
                                        <th>Booking Date </th>
                                        <th>Departure Date </th>
                                        <th>Return Date </th>
                                        <th>Days</th>
                                        <th>Payment Method</th>
                                        <th>Booking Amount</th>
                                        <th>Company Commission</th>
                                        <th>ZMD Commission</th>

                                    </tr>

                                </thead>

                                <tbody>


                                    @if (count($companies))
                                        @foreach ($companies as $company)
                                            <tr>


                                                <td> {{ $company['referenceNo'] }}</td>
                                                <td> {{ $company['title'] . ' ' . $company['first_name'] . ' ' . $company['last_name'] }}
                                                </td>
                                                <td> {{ date('d/m/Y H:i:s', strtotime($company['createdate'])) }} </td>
                                                <td> {{ date('d/m/Y H:i:s', strtotime($company['start_date'])) }} </td>
                                                <td> {{ date('d/m/Y H:i:s', strtotime($company['end_date'])) }} </td>
                                                <td> {{ $company['no_of_days'] }} </td>

                                                <td class="">
                                                    @if ($company['payment_method'] == 'stripe')
                                                        <span class="label label-lg label-info"><i
                                                                class="fa fa-cc-stripe"></i>
                                                            {{ ucwords(preg_replace('/\s/', '', $company['payment_method'])) }}</span>
                                                    @elseif($company['payment_method'] == 'payzone')
                                                        <span class="label label-lg label-info"><i
                                                                class="fa fa-paypal"></i>
                                                            {{ ucwords(preg_replace('/\s/', '', $company['payment_method'])) }}</span>
                                                    @endif
                                                </td>
                                                <td> {{ $company['ListPrice'] }} </td>
                                                <td> {{ (float) number_format($company['AmountPaid'], 3) }} </td>
                                                <td> {{ (float) number_format($company['commission'], 3) }} </td>


                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="10"> No data found</td>
                                        </tr>
                                    @endif


                                </tbody>
                            </table>
                        </div>
                        {{ $paginator }}
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
    <script src="{{ secure_asset('assets/js/jquery.maskedinput.min.js') }}"></script>
    <script src="{{ secure_asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        var today = new Date();
        var enddate = new Date();
        //enddate.setDate(enddate.getDate() - 7);
        $('#start_date').datepicker({
                autoclose: true,
                todayHighlight: true,
                endDate: "today",
                maxDate: today
            })
            //show datepicker when clicking on the icon
            .next().on(ace.click_event, function() {
                $(this).prev().focus();
            });


        $('#end_date').datepicker({
                autoclose: true,
                todayHighlight: true,
                endDate: "today",
                maxDate: "today"
            })
            //show datepicker when clicking on the icon
            .next().on(ace.click_event, function() {
                $(this).prev().focus();
            });


        // if($("#start_date").val() == "" && $("#end_date").val() == ""){
        //     $("#start_date").datepicker().datepicker("setDate", today);
        //     $("#end_date").datepicker().datepicker("setDate", enddate);
        // }
    </script>
@endsection
