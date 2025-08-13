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
        </div>
        <div class="col-xs-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('capacity.report') }}" method="get" class="form-inline"
                        style="margin-bottom: 10px;">
                        <input type="hidden" value="search" name="search" />
                        <div class="form-group">
                            <label for="">From</label> <br>
                            <input type="text" name="from_date" id="start_date" autocomplete="off"
                                class="form-control input-sm datepicker" placeholder="Start Date"
                                data-date-format="dd-M-yyyy" value="{{ old('from_date') }}">
                        </div>
                        <div class="form-group">
                            <label for="">To</label> <br>

                            <input class="form-control input-sm date-picker" value="" autocomplete="off"
                                id="end_date" placeholder="End Date" name="to_date" type="text"
                                data-date-format="dd-M-yyyy" value="{{ old('to_date') }}">
                        </div>
                        <div class="form-group">
                            <button name="submit" class="btn btn-primary btn-sm " style="margin-top:41%">
                                Search
                            </button>
                        </div>
                        <div class="form-group ">
                            <a href="{{ route('capacity.report') }}" style="margin-top:45%"
                                class="btn btn-primary btn-sm">Reset</a>
                        </div>
                    </form>

                </div>
                <div class="row">

                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">

                                <div id="sms_response"></div>
                                <div class="table-responsive">
                                    <table id="simple-table" class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Depart Date</th>
                                                <th>Return Date</th>
                                                <th>Remaining Capacity </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($bookingDetails as $bookingDetail)
                                                <tr>
                                                    <td>{{ $bookingDetail['date'] }}</td>
                                                    <td>{{ $bookingDetail['check_in'] }}</td>
                                                    <td>{{ $bookingDetail['check_out'] }}</td>
                                                    <td>{{ $bookingDetail['remaining_capacity'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>




                                    <div style="margin-right:20px;float:right ">

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
        @endsection
