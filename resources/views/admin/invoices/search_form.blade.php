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

                Booking

                <small>

                    <i class="ace-icon fa fa-angle-double-right"></i>

                    Invoices All

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

                <div class="col-md-12" style="padding: 10px; border-bottom: 1px solid  #ccc;">

                    <form method="post" action="{{ route('searchFormSubmit') }}">



                        <div class="col-md-1">

                            <div class="input-group">

                                Start Date

                            </div>

                        </div>

                        <div class="col-md-3">

                            <div class="input-group">

                                <input class="form-control input-sm date-picker" value="{{ $start_date }}"
                                    autocomplete="off" id="start_date" name="start_date" type="text"
                                    data-date-format="dd-mm-yyyy" />

                                <span class="input-group-addon">

                                    <i class="fa fa-calendar bigger-110"></i>

                                </span>

                            </div>

                        </div>

                        <div class="col-md-1">

                            End Date

                        </div>



                        <div class="col-md-3">

                            <div class="input-group">

                                <input class="form-control input-sm date-picker" value="{{ $end_date }}"
                                    autocomplete="off" id="end_date" name="end_date" type="text"
                                    data-date-format="dd-mm-yyyy" />

                                <span class="input-group-addon">

                                    <i class="fa fa-calendar bigger-110"></i>

                                </span>

                            </div>

                        </div>



                        {{-- <input type="text" value="{{ Request::get('name') }}" name="name" --}}

                        {{-- placeholder="Search here..."/> --}}





                        <input value="Search" name="submit" type="submit" class="btn btn-sm btn-success" />



                        <a href="{{ route('searchForm') }}" class="btn btn-sm btn-danger">Reset</a>

                    </form>











                </div>

                @if ($show == 1)
                    <div class="col-md-12 text-right section-right" style="margin-top: 10px">



                        <a id="excel" class="btn btn-primary exxl"
                            href="{{ route('invoicesDetailInvoice') }}?filter=departDate&search=&start_date={{ $start_date }}&end_date={{ $end_date }}&companies=all&airport=all&status=all&admins=all&payment=all&refund_via=all&palenty_to=all"><i
                                class="entypo-download"></i>Download Detail Invoice</a>

                        <a id="excel" class="btn btn-primary exxl"
                            href="{{ route('invoiceSummery') }}?filter=departDate&search=&start_date={{ $start_date }}&end_date={{ $end_date }}&companies=all&airport=all&status=all&admins=all&payment=all&refund_via=all&palenty_to=all"><i
                                class="entypo-download"></i> Download Summary Invoice</a>

                    </div>
                @endif



                <br>

                <br>

                <br>







            </div>

            <br />

            <br />

            <br />
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
        @endsection
