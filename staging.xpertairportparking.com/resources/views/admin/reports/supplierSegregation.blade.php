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
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
     @endsection @section('content') <script>
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
   
    <div class="info-hide"
        style="display:none;background:rgb(232, 242, 250,0.8);    background-size: cover;height:100%;width:100%;position:absolute;z-index:99">
        <center>
            <div class="loader"></div>
        </center>
    </div>
    <div class="page-content">
        <div class="page-header">
            <h1>
                Supplier Segregation
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
                 <form action="{{ route('supplier.segregation.report') }}" method="get" class="form-inline mb-10">
                        <input type="hidden" value="search" name="search" />
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-4">
                                <div class="form-group">
                                    <label for="">Month</label>
                                    <input class="form-control input-sm date-picker" autocomplete="off"
                                          placeholder="End Date" name="selected_month" type="month"  value="{{ Request::get('selected_month', date('Y-m')) }}" required >
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-4">
                                <div class="d-flex justify-content-start align-items-center">
                                    <div class="form-group ">
                                        <button name="submit" class="btn btn-primary btn-sm ">
                                            Search
                                        </button>
                                    </div>
                                    <div class="form-group ">
                                        <a href="{{ route('supplier.segregation.report') }}"
                                            class="btn btn-primary btn-sm ml-5">Reset</a>
                                    </div>
                                </div>
                            </div>
                    </form>
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">

                                <div id="sms_response"></div>
                                <div class="table-responsive mt-20">
                                    <table id="example" class="display nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>Supplier</th> 
                                                <th>Total Booking Amount</th>
                                                <th>Net to XAP Amount (70%)</th>
                                                <th>No of Bookings</th>
                                                <th>Avg. Price per Day</th>
                                            </tr>
                                        </thead>
                                        @if(count($bookings)>0)
                                        <tbody>
                                            @php
                                                  $netAspAmount   = 0;
                                                  $netAspAmountpercentage   = 0;
                                                  $noBookings  = 0;
                                            @endphp
                                            @foreach ($bookings as $booking)
                                                @php
                                                  $netAspAmount += $booking->total_amount; 
                                                  $noBookings += $booking->num_bookings;
                                                  $sharePercent = 100 - $booking->partner->share;
                                                @endphp
                                               <tr>
                                                   
                                                    <td>@if($booking->partner){{ $booking->partner->company }}   @else - @endif</td>
                                                    <td>{{ number_format($booking->total_amount,2) }} </td>
                                                    @if($booking->partner && $booking->partner->id == 7 ) 
                                                         <td class="text-danger">{{ number_format($booking->total_amount ,2)}}    </td>
                                                    @else
                                                         <td>{{ number_format( $booking->total_amount * $sharePercent / 100 ,2)}} </td>
                                                    @endif
                                                   
                                                    <td>{{ $booking->num_bookings }}</td>
                                                    <td>{{ number_format($booking->total_amount / cal_days_in_month(CAL_GREGORIAN, substr($selectedMonth, 5, 2), substr($selectedMonth, 0, 4)),2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="yellowBg">
                                                <th> Total </th>
                                                <td>  {{ $netAspAmount }} </td>
                                                <td>  </td>
                                                <td> {{ $noBookings }} </td>
                                                <td> - </td>
                                            </tr>
                                        </tfoot>
                                        @endif
                                    </table>
                                    <div class="bookingInfoCount">
                                        @if(count($bookings) > 0) 
                                        
                                    @endif    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
          </div></div>
          </div>
          </div>
          </div>
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

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
    
    $(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            { extend: 'print', footer: true },
            { extend: 'csv', footer: true },
            { extend: 'copy', footer: true },
            { extend: 'excel', footer: true }
        ]
    } );
} );
    </script>
        @endsection
