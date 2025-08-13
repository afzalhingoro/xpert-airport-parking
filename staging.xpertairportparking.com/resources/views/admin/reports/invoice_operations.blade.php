@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href="{{ secure_asset('assets/css/jquery-ui.custom.min.css') }}"/>
    <link rel="stylesheet" href="{{ secure_asset('assets/css/chosen.min.css') }}"/>
    <link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap-datepicker3.min.css') }}"/>
    <link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap-timepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ secure_asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap-colorpicker.min.css') }}" />
    <link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection
@section('content')

    <div class="page-content">


<style>
.form-inline .form-group {
    margin-bottom: 8px;
}	
</style>

        <div class="page-header">
            <ol class="breadcrumb bc-3">
                <li><a href="Dashboad">Dashboad</a></li>
                <li>Reports</li>
                <li class="active"><strong>Agent Invoices Report</strong></li>
            </ol>
        </div><!-- /.page-header -->
        <div class="row">
            <div class="col-md-6">
                <h2 class="invTitle">Agent Invoices Report</h2>
            </div>

        </div>
        <form action='{{ route("invoice_commission_report") }}' method="get" class="form-inline mb-10">
            <div class="row">
            <div class="col-md-3">
                <div class="form-group searchByKeyword">
                    <label for="field-1">Search By Keyword</label>
                    <input type="text" value='{{ Request::get('search') }}' name="search" class="form-control input-sm" id="field-1" value=""
                           placeholder="Search By Keyword">
                </div>
            </div>
            <input name = "airport" value = '1' hidden >
            <!--<div class="form-group">-->
            <!--    <select name="airport" class="form-control input-sm" >-->
            <!--        @foreach($airports as $airport)-->
            <!--            <option @if(Request::get('airport')==$airport->id) {{ "selected='selected'" }} @endif value='{{ $airport->id }}'>{{ $airport->name }}</option>-->
            <!--        @endforeach-->
            <!--    </select>-->
            <!--</div>-->
            <div class="col-md-3">
                <div class="form-group form_data">
                    <label for="">Admins</label>
                    <select name="admins" class="form-control input-sm" >
                        <option value="all">All Admins</option>
                        @foreach($admins as $admin)
                            <option @if(Request::get('admins')==$admin->id) {{ "selected='selected'" }} @endif value='{{ $admin->id }}'>{{ $admin->username }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-3">
            <div class="form-group form_data">
                <label for="">Status</label>
                <select id="my_status" name="status" class="form-control input-sm" required>
                    <option value="all">Booking Status</option>
                    <option value="Booked" @if(Request::get('status')=='Booked') {{ "selected='selected'" }} @endif>Booked</option>
                    <option value="Amend" @if(Request::get('status')=='Amend') {{ "selected='selected'" }} @endif>Amend</option>
                    <option value="Refund" @if(Request::get('status')=='Refund') {{ "selected='selected'" }} @endif>Refund</option>
                    <option value="Cancelled" @if(Request::get('status')=='Cancelled') {{ "selected='selected'" }} @endif>Cancelled</option>
                    <option value="Noshow" @if(Request::get('status')=='Noshow') {{ "selected='selected'" }} @endif>No Show</option>
                </select>
            </div>
            </div>
            <div class="col-md-3">

            <div class="form-group form_data">
                Filter by
                <select name="filter" class="form-control input-sm">
                    <!-- <option value="all">All</option> -->
                    <option value="departDate" @if(Request::get('filter')=='departDate') {{ "selected='selected'" }} @endif>Departure Date</option>
                    <option value="created_at" @if(Request::get('filter')=='created_at') {{ "selected='selected'" }} @endif >Booked Date</option>
                    <option value="returnDate" @if(Request::get('filter')=='returnDate') {{ "selected='selected'" }} @endif >Arrival Date</option>
                </select>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-3">
            <div class="form-group form_data">
                From
                <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control input-sm datepicker" placeholder="Start Date"
                       data-date-format="dd-M-yyyy" value='{{ Request::get("start_date") }}' >
            </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form_data">
                    To
                    <input class="form-control input-sm date-picker" value='{{ Request::get("end_date") }}' autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text"
                           data-date-format="dd-M-yyyy"/>
    
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form_data">
                    <strong class="textGreen">Previous Adjustment</strong>
                    <input type="text" name="adjust" value='{{ Request::get("adjust") }}' class="form-control input-sm" placeholder="Enter Adjustment amout" value="">
                </div>
            </div>
                <div class="col-md-3">
                    <div class="form-group d-flex justify-content-end align-items-center mt-20">
                        <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                        <a href='{{ route("invoice_commission_report") }}' class="btn btn-primary btn-sm">Reset</a>
                    </div>
                </div>
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
                            @if($show==1)
								<div class="row">
									<div class="col-sm-8 mb-10">
                                             	<h2 class="badge badge-info mt-0 totalBooked">
											<i class="entypo-target"></i> Total Bookings : <b > {{$tbooking}} </b>
										</h2>
										@can('user_auth', ["Amounts"])
										<h2 class="badge badge-info mt-0 totalBooked">
											<i class="entypo-target"></i> Total Booking Amount:  <b> {{number_format($tamount,2)}} </b>
										</h2>
										<h2 class="badge badge-info mt-0 totalBooked">
											<i class="entypo-target"></i> Total ADP Commission: <b > {{number_format($ASPcommision,2)}} </b>
										</h2>
										@if($adjust != 0)
											<h2 class="badge badge-info mt-0 totalBooked">
											<i class="entypo-target"></i> Pervious Adjustment: <b > {{$adjust}} </b>
										</h2>
											<h2 class="badge badge-info mt-0 totalBooked">
											<i class="entypo-target"></i> Total ADP Commission: <b > {{$ASPcommision + $adjust}} </b>
										</h2>
										
										@endif
										
										@endcan
									</div>
									<?php /*
									<div class="col-sm-4 text-right" style="margin-bottom: 10px; margin-top: 20px;">

                                        @can('user_auth', ["Downloads"])

										<a id="excel" class="btn btn-primary  btn-sm" href='{{ route("invoice_operation_report_excel") }}?filter={{ Request::get("filter") }}&search=&start_date={{ Request::get("start_date") }}&end_date={{ Request::get("end_date") }}&companies={{ Request::get("companies") }}&airport={{ Request::get("airport") }}&status={{ Request::get("status") }}&admins={{ Request::get("admins") }}&payment={{ Request::get("payment") }}&refund_via={{ Request::get("refund_via") }}&palenty_to={{ Request::get("palenty_to") }}'><i class="fa fa-file-excel-o"></i>Download Excel</a>
                                        @endcan
									</div>
									*/ ?>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <table id="example" class="display nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>Reference#</th>
                                            <th>Name</th>
                                            <th>Booking Date</th>
                                            <th>Departure Date</th>
                                            <th>Time</th>
                                            <th>Return Date</th>
                                            <th>Time</th>
                                            <th>Days</th>
                                          <!--  <th>Payment Method</th> -->
                                          @can('user_auth', ["Amounts"])
                                            <th>Booking Amount</th>
    									
                							<!--<th>Booking Fee</th> 
    										
    										<th>Bank Amount</th> -->
                                            <th>XAP Commission</th>
                                            <th>Agent Commission</th>
                                        @endcan
                                        </tr>
                                    </thead>
                                    @php
                                    $total_list_price = 0;
                                    $total_client_paid = 0;
                                    $total_bank_amount = 0;
                                    $total_booking_fee = 0;
                                    $total_amount_paid = 0;
                                    $total_pz_commission = 0;
                                    $total_discount_commission = 0;
                                    @endphp
                                    <tbody>
                                        @foreach($companies as $company)
                                        <tr>
                                            <td> {{ $company['referenceNo'] }}</td>
                                            <td> {{ $company['title']." ".$company['first_name']." ".$company['last_name'] }}</td>
                                            <td> {{  date("d/m/Y", strtotime($company['createdate'])) }} </td>
                                            <td> {{ date("d/m/Y", strtotime($company['start_date'])) }} </td>
                                            <td> {{ date("H:i", strtotime($company['start_date'])) }} </td>
                                            <td> {{  date("d/m/Y", strtotime($company['end_date'])) }} </td>
                                            <td> {{  date("H:i", strtotime($company['end_date'])) }} </td>
                                            <td> {{ $company['no_of_days'] }} </td>
                                    <!--
                                            <td class="">
                                                @if($company["payment_method"]=="stripe")
                                                    <span class="label label-lg label-info"><i
                                                                class="fa fa-cc-stripe"></i> {{ ucwords(preg_replace('/\s/', '', $company["payment_method"]))  }}</span>
                                                @elseif($company["payment_method"]=="payzone")
                                                    <span class="label label-lg label-info"><i
                                                                class="fa fa-paypal"></i> {{ ucwords(preg_replace('/\s/', '',$company["payment_method"]))  }}</span>
                                                @endif
                                            </td>
                                            -->
                                            @can('user_auth', ["Amounts"])
                                            <td> {{ $company['ListPrice'] }} </td>
											<!--
											<td>{{ (float)number_format($company['booking_fee'] ,2) }}</td>
											<td>{{ (float)number_format($company['bank_amount'] ,2) }}</td>
											-->
                                            <td> {{ (float)number_format($company['AmountPaid'] ,2) }} </td>
                                            <td> {{ (float)number_format($company['commission'] ,2) }} </td>
                                            @endcan
                                            @php                                            
                                            $total_list_price = $total_list_price + $company['ListPrice'];
                                            $total_client_paid = $total_client_paid + $company['client_paid'];
                                            $total_booking_fee = $total_booking_fee + $company['booking_fee'];
                                            $total_bank_amount = $total_bank_amount + $company['bank_amount'];
                                            $total_amount_paid = $total_amount_paid + $company['AmountPaid'];
                                            $total_pz_commission = $total_pz_commission + $company['commission'];
                                            @endphp
                                        </tr>
                                         @endforeach
                                            
                                    </tbody>
                                    <tfoot>
                                        @can('user_auth', ["Amounts"])
                                            <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="totalEarn"><b>Total:</b></td>
                                            
                                            <td><b id="ba_total"> {{ $total_list_price}} </b></td>
                                            
                                            <td><b> {{ $total_amount_paid }} </b></td>
                                            <td><b id="pz_total"> {{ $total_pz_commission}} </b></td>
                                            </tr>
                                            @endcan
                                    </tfoot>
                                </table>
                            </div>
                        
                    </div><!-- /.span -->
                </div><!-- /.row -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <script>
		$(document).ready(function() {
			var ba = $('#ba_total').html();
			var pz = $('#pz_total').html();
			$('#total_ba_span').html(ba);
			$('#total_pz_span').html(pz);
			
		});
        function validate(form) {

            // validation code here ...


            if (!valid) {
                alert('Please correct the errors in the form!');
                return false;
            }
            else {
                return confirm('Do you really want to submit the form?');
            }
        }
    </script>

@endsection
@section("footer-script")
    <script src='{{ secure_asset("assets/js/moment.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/daterangepicker.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/bootstrap-datetimepicker.min.js") }}'></script>

    <script src='{{ secure_asset("assets/js/bootstrap-datepicker.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/bootstrap-timepicker.min.js") }}'></script>


    <!-- page specific plugin scripts -->
    <script src='{{ secure_asset("assets/js/wizard.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/jquery.validate.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/jquery-additional-methods.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/bootbox.js") }}'></script>
    <script src='{{ secure_asset("assets/js/jquery.maskedinput.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/select2.min.js") }}'></script>
    <script type="text/javascript">


        $('#start_date').datepicker({
            autoclose: true,
            todayHighlight: true
        })
        //show datepicker when clicking on the icon
            .next().on(ace.click_event, function () {
            $(this).prev().focus();
        });


        $('#end_date').datepicker({
            autoclose: true,
            todayHighlight: true
        })
        //show datepicker when clicking on the icon
            .next().on(ace.click_event, function () {
            $(this).prev().focus();
        });

    </script>

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
        ],
        order: [],
    } );
} );
    
    

    </script>

@endsection
