<?php
use Illuminate\Support\Str;
?>
@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}"/>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <style>
      
       @media print {
            #example th:last-child  {
                display: none !important;
            }
            #example td:last-child  {
                display: none !important;
            }
        }
    </style>
@endsection
@php
$ORG = 0;
$BING = 0;
$EM = 0;
$POR = 0;
$paid = 0;
$pagents = 0;
$api = 0;


foreach($bookings as $book)
{
if($book->booking_status == 'Completed'){
if($book->traffic_src == "ORG" )
{
  $ORG++;

}
if($book->traffic_src == "EM" )
{
  $EM++;

}
if($book->traffic_src == "POR" )
{
  $POR++;

}
if($book->traffic_src == "BING" )
{
  $BING++;

}
if($book->traffic_src == "PPC" )
{
  $paid++;

}
if($book->traffic_src == "Agent" )
{
  $pagents++;

}
if($book->traffic_src == "API" )
{
  $api++;

}

}
}
@endphp
@section('content')
<!-- Button trigger modal -->


    <div class="page-content">


        <div class="page-header">
            <h1>
                All Bookings
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->


            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('allBookings') }}" method="get" class="form-inline mb-10">
                        <div class="form-group" >
                            Search<br>
                            <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control input-sm"
                                   id="field-1" value=""
                                   placeholder="Search By Keyword">
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <select name="airport" class="form-control input-sm" >-->
                        <!--        <option value="all">All Airports</option>-->
                        <!--        @foreach($airports as $airport)-->
                        <!--            <option @if(Request::get('airport')==$airport->id) {{ "selected='selected'" }} @endif value="{{ $airport->id }}">{{ $airport->name }}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->

                        <div class="form-group" style="display:none;">
                            Admins<br>
                            <select name="admins" class="form-control input-sm" >
                                <option value="all">All Admins</option>
                                @foreach($admins as $admin)
                                    <option @if(Request::get('admins')==$admin->id) {{ "selected='selected'" }} @endif value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" >
                            Agent<br>
                           <select name="agentID" class="form-control input-sm" >
                                    <option value="">All</option>
                                      @foreach($agents as $agent)
                                    <option @if(Request::get('agentID')==$agent->id) {{ "selected='selected'" }} @endif value="{{ $agent->id }}">{{ $agent->alias }}</option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                           Booked Date <br>
                            <select name="filter" class="form-control input-sm">

                                <option value="created_at" selected='selected' @if(Request::get('filter')=='created_at') {{ "selected='selected'" }} @endif >
                                    Booked Date
                                </option>

                                <option value="departDate" @if(Request::get('filter')=='departDate') {{ "selected='selected'" }} @endif>
                                    Departure Date
                                </option>
                                <option value="returnDate" @if(Request::get('filter')=='returnDate') {{ "selected='selected'" }} @endif >
                                    Arrival Date
                                </option>
                                <option value="all" @if(Request::get('filter')=='all') {{ "selected='selected'" }} @endif>All</option>
                            </select>
                        </div>
                        <div class="form-group">
                            From<br>
                            <input type="text" name="start_date" id="start_date" autocomplete="off"
                                   class="form-control input-sm datepicker" placeholder="Start Date"
                                   data-date-format="dd-M-yyyy" value="{{ Request::get('start_date') }}"
                                   >
                        </div>
                        <div class="form-group">
                            To<br>
                            <input class="form-control input-sm date-picker" value="{{ Request::get('end_date') }}"
                                   autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text"
                                   data-date-format="dd-M-yyyy"/>

                        </div>
                        <!--<div class="form-group">-->
                        <!--    <select name="companies" class="form-control input-sm" >-->
                        <!--        <option value="all">All Companies</option>-->
                        <!--        @foreach($companies_dlist as $company)-->
                        <!--            <option @if(Request::get('companies')==$company->id) {{ "selected='selected'" }} @endif value="{{ $company->id }}">{{ $company->name }}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!--&nbsp; &nbsp;-->
                        <!--<div class="form-group">-->
                        <!--    <select name="payment" class="form-control input-sm" >-->
                        <!--        <option value="all">Payment Type</option>-->
                        <!--        <option value="payzone" @if(Request::get('payment')=='payzone') {{ "selected='selected'" }} @endif>-->
                        <!--            Payzone-->
                        <!--        </option>-->
                        <!--    </select>-->
                        <!--</div>-->

                        <div class="form-group">
                            Booked Status <br>
                            <select id="my_status" name="status" class="form-control input-sm"
                                    required="">
                                @if($role_name!="Controller")
                                <option value="all">Booking Status</option>
                                @endif
                                <option value="Completed" @if(Request::get('status')=='Completed' || $role_name=='Controller') {{ "selected='selected'" }} @endif>
                                    Booked
                                </option>
                                @if($role_name!="Controller")
                                <option value="Abandon" @if(Request::get('status')=='Abandon') {{ "selected='selected'" }} @endif>
                                    Abandon
                                </option>
                                <option value="Refund" @if(Request::get('status')=='Refund') {{ "selected='selected'" }} @endif>
                                    Refund
                                </option>
                                <option value="Cancelled" @if(Request::get('status')=='Cancelled') {{ "selected='selected'" }} @endif>
                                    Cancelled
                                </option>
                                <option value="Noshow" @if(Request::get('status')=='Noshow') {{ "selected='selected'" }} @endif>
                                    No Show
                                </option>
                                @endif
                            </select>
                        </div>
                        @can('user_auth', ["Sources"])
                        @if($role_name!="Controller")
                        <div class="form-group">
                            Source <br>
                            <select name="booking_source" class="form-control input-sm" >
                                    @foreach($sourceList as $key=>$sourcelist)
                                        @php $checked='none'; @endphp
                                        @if(in_array($key,$user_role_details))
                                            @php $checked=true; @endphp
                                        @endif
                                        <option value="{{$key}}" @if(Request::get('booking_source')==$key) {{ "selected='selected'" }}@endif style="display:{{$checked}};">{{$sourcelist}}</option>


                                    @endforeach
                            </select>
                        </div>
                        @endif
                        @endcan


                        <div class="form-group" style="display:none;">
                            Days<br>
                            <select name="no_of_days" class="form-control input-sm" >

                                <option value="all">All</option>

                                @php
                                for ($j = 1; $j <= 30; $j++){
                                @endphp
                                <option value="{{ $j }}" @if(Request::get('no_of_days')==$j) {{ "selected='selected'" }} @endif >{{  $j }}</option>
                                @php
                                }
                                @endphp
                                <option value="30+" @if(Request::get('no_of_days')=="30+") {{ "selected='selected'" }} @endif >Over 30</option>
                            </select>
                        </div>



                        <!-- <div class="form-group">
                            <strong style="color:green;">Previous Adjustment</strong>
                            <input type="text" name="adjust" value="{{ Request::get('adjust') }}" class="form-control input-sm"
                                   placeholder="Enter Adjustment amout" value="">
                        </div> -->
                        <div class="form-group resetSubBtn agentGroup">
                            <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                            <a href="{{ route('allBookings') }}" class="btn btn-primary btn-sm resetBtn">Reset</a>
                        </div>
                    </form>

                </div>


				@if(count($bookings) > 0)
                <div class="col-md-12 statusContainer" >
                    <div class="col-md-8">
                        @php
                            $f_share = 0;
                            $tot_rev = 0;
                            $countCompleted=0;
                              foreach($bookings as $booking)
                              {


                                if($booking['booking_status']=='Completed') {
                                    $countCompleted++;
                                    $share = 0;
                                    if($booking->company){
                                        $share = $booking->company->share_percentage;
                                    }
                                    $fly_share = ((
                                    ($share/100)*
                                    $booking->booking_amount)-
                                    $booking->discount_amount)+
                                    $booking->booking_extra;
                                    $f_share += $fly_share;

                                    $rev = ((
                                    $booking->booking_amount)-
                                    $booking->discount_amount)+
                                    $booking->booking_extra;
                                    $tot_rev += $booking->total_amount;
                                }

                              }

                              $f_share = round(($f_share),2);
                              $net_share = round(($f_share * 0.78),2);

                        @endphp
                        <h2 class="badge badge-info totalBooked"><i class="entypo-target"></i> Total Booked
                            bookings: <span id="no_of_booking">  @php echo  $countCompleted;
                                @endphp</span></h2>
                        @if($role_name!="Controller")
                        @can('user_auth', ["Sources"])
                        <h2 class="badge badge-info totalBooked"><i class="entypo-target"></i> Total
                            Amount: <span id="total_share">{{$tot_rev}}</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                        @if($ORG != '0')
                         <h2 class="badge badge-info totalBooked"><i class="entypo-target"></i>
                            ORG: <span id="no_of_booking">  @php echo  $ORG;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                        @if($EM != '0')
                         <h2 class="badge badge-info totalBooked"><i class=" entypo-target"></i>
                            EM: <span id="no_of_booking">  @php echo  $EM;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                        @if($POR != '0')
                         <h2 class="badge badge-info totalBooked"><i class="entypo-target"></i>
                            POR: <span id="no_of_booking">  @php echo  $POR;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                        @if($BING != '0')
                         <h2 class="badge badge-info totalBooked"><i class="entypo-target"></i>
                            BING: <span id="no_of_booking">  @php echo  $BING;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                         @if($paid != '0')
                         <h2 class="badge badge-info totalBooked"><i class="entypo-target"></i>
                            Paid: <span id="no_of_booking">  @php echo  $paid;
                                @endphp</span></h2>
                        @endif
                        @if($pagents != '0')
                         <h2 class="badge badge-info totalBooked"><i class="entypo-target"></i>
                            Agent: <span id="no_of_booking">  @php echo  $pagents;
                                @endphp</span></h2>
                        @endif
                        @if($api != '0')
                         <h2 class="badge badge-info totalBooked"><i class="entypo-target"></i>
                            API: <span id="no_of_booking">  @php echo  $api;
                                @endphp</span></h2>
                        @endif
                        
                        
                        @endcan
                        <!--<h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i> Total-->
                        <!--    ZMD share: <span id="total_share">{{$f_share}}</span></h2>-->
                        <!--<h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i> Net-->
                        <!--    ZMD share: <span id="net_share">{{$net_share}}</span></h2>-->




                    </div>
                    @can('user_auth', ["Downloads"])
                    <div class="col-md-4 text-right section-right mt-15">

                        <!--<a id="excel" class="btn btn-primary  btn-sm" href='{{ route("admin_booking_report_excel") }}?filter={{ Request::get("filter") }}&search={{ Request::get("search") }}&start_date={{ Request::get("start_date") }}&end_date={{ Request::get("end_date") }}&companies={{ Request::get("companies") }}&airport={{ Request::get("airport") }}&status={{ Request::get("status") }}&admins={{ Request::get("admins") }}&payment={{ Request::get("payment") }}&refund_via={{ Request::get("refund_via") }}&palenty_to={{ Request::get("palenty_to") }}&no_of_days={{ Request::get("no_of_days") }}&agentID={{ Request::get("agentID") }}&booking_source={{ Request::get("booking_source") }}'><i class="fa fa-file-excel-o"></i> Download Excel</a>-->
                        <!--<a id="excel" target="_blank" class="btn btn-primary  btn-sm" href='{{ route("admin_booking_report_pdf") }}?filter={{ Request::get("filter") }}&search=&start_date={{ Request::get("start_date") }}&end_date={{ Request::get("end_date") }}&companies={{ Request::get("companies") }}&airport={{ Request::get("airport") }}&status={{ Request::get("status") }}&admins={{ Request::get("admins") }}&payment={{ Request::get("payment") }}&refund_via={{ Request::get("refund_via") }}&palenty_to={{ Request::get("palenty_to") }}'><i class="fa fa-file-pdf-o"></i>Download PDF</a>-->
                    </div>
                    @endcan
                </div>
				@endif
				
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
                                    <table id="example" class="display nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th class="exclude">
    										    
    										</th>
                                            <th class="w-50"> Reference No</th>
                                            <!--th>Airports</th-->
    
                                            <th>Name</th>
                                            <th>Booking Date</th>
                                            <!--<th>Time</th>-->
                                            <th>Departure Date</th>
                                            <th>Time</th>
                                            <th>Return Date</th>
                                            <th>Time</th>
                                            <th>Booking status</th>
                                            <th>Car Reg</th>
                                            <th>Company Booked</th>
    
                                            @if($role_name!="Controller")
                                            <th>Discount Code</th>
                                            <th class="w-70">P. Method</th>
                                            <!--<th>Refund</th>-->
                                            @can('user_auth', ["Amounts"])
                                            <th>Net Amount</th>
                                            @endcan
                                            @endif
                                            <!--<th>No of Days</th>-->
                                            <!--<th>Valet</th>-->
                                            @can('user_auth', ["Sources"])
    										@if($role_name!="Marketing" && $role_name!="Controller")
                                            <th>Src</th>
                                            <!--<th>Email</th>-->
                                            @endif
                                            @endcan
                                            <!--<th>Action</th>-->
                                            @if($role_name!="Controller")
    										<!--<th>Cancel</th>-->
    										@if($role_name!="Operations")
                                            <!--<th>Refund</th>-->
                                            @endif
                                            <!--<th>SMS</th>-->
    										@endif
                                        </tr>
                                    </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            @php    if($booking['booking_status']=='Completed') { @endphp

                                        <tr id="expand_{{  $booking->id  }}">
                                        @php } else { @endphp
                                        <tr class="text-danger" id="expand_{{  $booking->id  }}">
                                            @php }  @endphp
                                        <td  class="exclude">
										    <button type="button" class="btn btn-primary hide-print plr-10 ptb-0" data-toggle="modal" data-target="#asd{{  $booking->id  }}" id="{{  $booking->id  }}">
                                              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </button>
                                            
                                    <!-- Modal -->
                                    <div class="modal fade" id="asd{{  $booking->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                            <table class="w-100">
                                                <tr >
                                            <td colspan="11">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered table-striped">

                                                        <tbody>

                                                            @if($role_name!="Marketing" && $role_name!="Controller")
                                                            @can('user_auth', ["Amounts"])
                                                        <tr>
                                                            <td>Net Amount</td>
                                                            <td><span
                                                                        class="label label-sm label-success">£{{ $booking->total_amount }}</span>
                                                            </td>
                                                        </tr>

                                                        <!--<tr>-->
                                                        <!--    <td colspan="2"><span-->
                                                        <!--                class="label label-sm col-md-12 col-xl-12 col-lg-12 label-success">£{{ $booking->total_amount }}</span>-->
                                                        <!--    </td>-->
                                                        <!--</tr>-->
                                                        @endcan
                                                        @endif
                                                        <tr>
                                                            <td>No of Days</td>
                                                            <td>{{ $booking->no_of_days  }}</td>
                                                        </tr>
                                                        
                                                        @can('user_auth', ["Sources"])
                                                        <tr>
                                                            <td>Booking Src</td>
                                                            <td>{{ $booking->traffic_src  }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pickup / Return </td>
                                                            <td> 
                                                               <button type="button" 
                                                               @if($booking->departure_status != null) disabled @else data-id="{{ $booking->id }}" data-type="departure_status" onclick="confirmAction(this)" @endif class="btn btn-sm btn-warning">
                                                                <i class="fa fa-truck" aria-hidden="true"></i> Picked Up
                                                            </button>
                                                            
                                                            <button type="button" @if($booking->return_status != null) disabled @else data-id="{{ $booking->id }}" data-type="return_status" onclick="confirmAction(this)" @endif class="btn btn-sm btn-danger">
                                                                <i class="fa fa-undo" aria-hidden="true"></i> Returned
                                                            </button>


                                                               
                                                            </td>
                                                        </tr>
                                                        @endcan
                                                        <tr>
                                                            <td>Refund</td>
                                                            <td class="">

                                                            @php
                                                            $transactions = App\Models\booking_transaction::where("referenceNo", $booking->referenceNo)->get();


                                                            $transaction = (array)$transactions;
                                                            $cancel=0;
                                                            $adjust=0;
                                                            $plenty_amount=0;
                                                            $total_planty_to_flys=0;
                                                             $total_planty_to_company=0;
                                                             $total_planty_to_companys=0;
                                                             $total_planty_to_fly=0;
                                                
                                                           foreach ($transactions as $transaction) {
                                                
                                                                if ($transaction['booking_status'] != 'Noshow') {
                                                
                                                                    if ($transaction['amount_type'] == 'credit' && $transaction['payment_case'] == 'cancel') {
                                                
                                                                        $cancel += $transaction['payable'];
                                                
                                                                    }
                                                
                                                
                                                                    if ($transaction['amount_type'] == 'credit' && ($transaction['payment_case'] == 'Refund' || $transaction['payment_case'] == 'edit')) {
                                                
                                                                        $adjust += $transaction['payable'];
                                                
                                                
                                                
                                                                    }
                                                                     $penalty_trans = App\Models\penalty_details::where("trans_id", $transaction["id"])->get();
                                                
                                                                    foreach ($penalty_trans as $penalty) {
                                                
                                                                        if ($penalty['penalty_to'] == "Company") {
                                                
                                                                            $total_planty_to_companys += $penalty['penalty_amount'];
                                                
                                                                        }
                                                
                                                                        if ($penalty['penalty_to'] == "yayparking") {
                                                
                                                                            $total_planty_to_flys += $penalty['penalty_amount'];
                                                
                                                                        }
                                                
                                                                    }
                                                
                                                                    $total_planty_to_company += $total_planty_to_companys;
                                                
                                                                    $total_planty_to_fly += $total_planty_to_flys;
                                                
                                                
                                                
                                                                    // if($transaction['palenty_amount']==''){
                                                
                                                                    // $transaction['palenty_amount']=0;
                                                
                                                                    // }
                                                
                                                
                                                
                                                                    $plenty_amount += ($total_planty_to_fly + $total_planty_to_company);
                                                                }
                                                            }


                                                        @endphp
                                                            {{$cancel+$adjust+$plenty_amount}}
            
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Valet</td>
                                                            <td>@if($booking->valet_type != 1 & $booking->valet_type != 0 )
											        Yes
										        @else
										            No
											    @endif</td>
                                                        </tr>
                                                        @can('user_auth', ["Email"])
                                                      @if($role_name!="Marketing" && $role_name!="Controller")
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><i onclick="sendEmailForm('{{ $booking->id  }}','{{ $booking->companyId  }}')"
                                                                   class="btn btn-minier btn-warning fa fa-envelope"></i></td>
                                                        </tr>
                                                        @endcan

                                                        <tr>
                                                            <td>Action</td>
                                                            @php
                                                                if($booking->aph_id =='NULL' || $booking->aph_id ==''){
                                                                    $dis = '';
                                                                } else{
                                                                    $dis = 'disabled';
                                                                }

                                                            @endphp
                                                            <td>
            												@can('user_auth', ["view"])
            												<i id="view_detail"
            												   onclick="getDetail('{{ $booking->id  }}')"
            												   class="btn btn-minier btn-success fa fa-eye"
            												   title="View"></i>
            														 @endcan
            
            												@can('user_auth', ["edit"])
            												<a id="edit" class="btn btn-minier btn-pink"
            												   href="{{ route("edit_booking_form",[$booking->id]) }}"
            												   title="Edit"> <i class="fa fa-pencil"
            																	title="Edit"></i></a>
            												@endcan
                                                        @if($role_name!="Controller" && $role_name!="Operations")
            												<a id="edit" class="btn btn-minier btn-warning "
            												   href="{{ route("edit_booking_form",[$booking->id]) }}"
            												   title="Extand">
            													<i class="fa fa-ellipsis-h"
            													   title="Extend"></i></a>
            												<i onclick="getTransferForm('{{ route("transferBookingForm",[$booking->id]) }}')"
            												   class="btn btn-minier btn-info fa fa-exchange"
            												   title="Transfer"></i>
                                                        @endif
            											</td>
                                                                    </tr>
            
                                                                @can('user_auth', ["Cancel"])
                                                                    <tr>
                                                                        <td>Cancel</td>
                                                                        <td>
            												<i onclick="getcancelForm('{{ $booking->id  }}')"
            												   class=" btn btn-minier btn-danger fa fa-times-circle"></i>
                                                            @if($role_name!="Operations")
            												<a id="cancel" class="btn btn-primary btn-minier" title="Cancel Booking Not show" onclick="return confirm('Are you sure want to cancel this booking..?')" href="{{ route('cancelNotShow',['id'=>$booking->id]) }}"><i class="entypo-cancel">Not Show</i></a>
                                                            @endif
            											</td>
                                                                    </tr>
                                                                @endcan
                                                                @if($role_name!="Operations")
                                                                @can('user_auth', ["Refund"])
                                                                    <tr>
                                                                        <td>Refund</td>
                                                                        <td><i onclick="getrefundForm('{{ $booking->id  }}')"
            												   class="btn btn-minier btn-pink  fa fa-reply"></i>
            											</td>
                                                                    </tr>
                                                                @endcan
                                                                @endif
                                                                @can('user_auth', ["SMS"])
                                                                    <tr>
                                                                        <td>Sms</td>
                                                                        	<td>
            												<i class="btn btn-minier btn-warning  fa fa-commenting" onclick="sendsms('{{ $booking->phone_number  }}','{{ $booking->referenceNo  }}')" ></i>
            											</td>
                                                                    </tr>
                                                                @endcan
                                                                    @endif
            
                                                                    </tbody>
            
                                                                </table>
                                                            </div>
            
            
            
                                                            {{--<ul data-dtr-index="0" class="col-md-3">--}}
                                                            {{--<li data-dtr-index="10"><span class="dtr-title">Net Amount:</span>--}}
                                                            {{--<span--}}
                                                            {{--class="dtr-data"><strong--}}
                                                            {{--class="badge badge-success badge-roundless"--}}
                                                            {{--style="width:100%;"></strong></span>--}}
                                                            {{--</li>--}}
                                                            {{--<li data-dtr-index="11"><span class="dtr-title">Fly Share:</span>--}}
                                                            {{--<span--}}
                                                            {{--class="dtr-data"><strong--}}
                                                            {{--class="badge badge-info badge-roundless"--}}
                                                            {{--style="width:100%;"></strong></span>--}}
                                                            {{--</li>--}}
                                                            {{--<li data-dtr-index="12"><span class="dtr-title">No of Days:</span>--}}
                                                            {{--<span--}}
                                                            {{--class="dtr-data"> </span>--}}
                                                            {{--</li>--}}
                                                            {{--<li data-dtr-index="13"><span class="dtr-title">Booking Src:</span>--}}
                                                            {{--<span class="dtr-data"></span></li>--}}
                                                            {{--<li data-dtr-index="14"><span class="dtr-title">Email:</span> <span--}}
                                                            {{--class="dtr-data"><a class="btn btn-info btn-xs"--}}
                                                            {{--onclick="showResendModal(904,'101');"--}}
                                                            {{--title="Resend Email"><i--}}
                                                            {{--class="entypo-mail"></i></a></span></li>--}}
                                                            {{--<li data-dtr-index="15"><span class="dtr-title">Action:</span> <span--}}
                                                            {{--class="dtr-data"><a id="view"--}}
                                                            {{--class="btn btn-info btn-xs popId"--}}
                                                            {{--data-toggle="modal"--}}
                                                            {{--data-target="#Booking_Detail_AP-170608904"--}}
                                                            {{--title="BookingHistory"--}}
                                                            {{--onclick="showhistoryModal('AP-170608904');"><i--}}
                                                            {{--class="entypo-book-open"></i></a>--}}
            
                                                            {{--<a id="view" class="btn btn-info btn-xs popId" data-toggle="modal"--}}
                                                            {{--data-target="#Booking_Detail_904" title="Booking Details"--}}
                                                            {{--onclick="showAjaxModal(904);"><i class="entypo-eye"></i></a>--}}
            
                                                            {{--<a id="transfer" class="btn btn-info btn-xs popId" data-toggle="modal"--}}
                                                            {{--data-target="#Booking_transfer_904" title="Booking Transfer"--}}
                                                            {{--onclick="showtransferModal(904);"><i class="entypo-switch"></i></a></span></li>--}}
                                                            {{--<li data-dtr-index="16"><span class="dtr-title">Canc:</span> <span--}}
                                                            {{--class="dtr-data"><a id="cancel"--}}
                                                            {{--class="btn btn-danger btn-xs"--}}
                                                            {{--data-toggle="modal"--}}
                                                            {{--data-target="#Booking_Detail_904"--}}
                                                            {{--title="Cancel Booking"--}}
                                                            {{--onclick="cancel_refund(904,'cancel');"><i--}}
                                                            {{--class="entypo-cancel"></i></a>--}}
            
                                                            {{--<a id="cancel" class="btn btn-primary btwn-xs" title="Cancel Booking Not show"--}}
                                                            {{--onclick="return confirm('Are you sure want to cancel this booking..?')"--}}
                                                            {{--href="index.php?p=company_bookings&amp;mode=cancel_not_show&amp;id=904"><i--}}
                                                            {{--class="entypo-cancel">Not Show</i></a></span></li>--}}
                                                            {{--<li data-dtr-index="17"><span class="dtr-title">Refund:</span> <span--}}
                                                            {{--class="dtr-data"><a id="refund"--}}
                                                            {{--class="btn btn-warning btn-xs"--}}
                                                            {{--data-toggle="modal"--}}
                                                            {{--data-target="#Booking_Detail_904"--}}
                                                            {{--title="Refund"--}}
                                                            {{--onclick="cancel_refund(904,'refund');"><i--}}
                                                            {{--class="entypo-shareable"></i></a></span></li>--}}
                                                            {{--<li data-dtr-index="18"><span class="dtr-title">Sms:</span> <span--}}
                                                            {{--class="dtr-data"><b><a class="btn btn-danger btn-xs"--}}
                                                            {{--onclick="return confirm('Are you sure?')"><i--}}
                                                            {{--class="entypo-phone"></i></a></b></span>--}}
                                                            {{--</li>--}}
                                                            {{--</ul>--}}
                                                        </td>
                                                    </tr>
                                                </table>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
										</td>
                                        <td  class="w-50">
                                                <!--<i class="fa fa-plus-circle" id="show_detail_icon_{{  $booking->id  }}"-->
                                                <!--   style="cursor: pointer; font-size: 20px;color:green"-->
                                                <!--   onclick="show_detal('{{  $booking->id  }}')"></i>-->
                                                   {{ $booking->referenceNo }}
                                            </td>
                                            <!--td class="">@if($booking->airport) <span
                                                        class="label label-sm label-success"><i
                                                            class="fa fa-plane"></i> {{ ucwords(preg_replace('/\s/', '', $booking->airport->name))  }}</span>  @endif
                                            </-->
                                            @php
                                                if (!function_exists('cleanFullName')) {
    
                                                    function cleanFullName($fullName) {
                                                        // Use regex to match the first word and its possible duplicate
                                                        return preg_replace('/^(\S+)\s+\1\s+/', '$1 ', $fullName);
                                                    }
                                                }

                                                $fullname = cleanFullName($booking->title." ".$booking->first_name." ".$booking->last_name);
                                            @endphp
                                            <td class="">{{ $fullname }}</td>

                                           <td data-order="{{ date('Y-m-d H:i', strtotime($booking->created_at)) }}">
    {{ date('d/m/Y H:i', strtotime($booking->created_at)) }}
</td>   
                                            <!--<td class="">{{ date('H:i', strtotime($booking->created_at)) }}</td>-->
                                           <td data-order="{{ date('Y-m-d', strtotime($booking->departDate)) }}">
    {{ date('d/m/Y', strtotime($booking->departDate)) }}
</td>
                                            <td class="">{{ date('H:i', strtotime($booking->departDate)) }}</td>
                                           <td data-order="{{ date('Y-m-d', strtotime($booking->returnDate)) }}">
    {{ date('d/m/Y', strtotime($booking->returnDate)) }}
</td>     
                                            <td class="">{{ date('H:i', strtotime($booking->returnDate)) }}</td>
                                            
                                            
                                            @php
                                                if($booking->booking_status == 'Completed' && $booking->booking_action == 'Booked'){
                                                    $status = 'Completed';
                                                }elseif($booking->booking_status == 'Completed' && $booking->booking_action == 'Amend'){
                                                    $status = 'Amended';
                                                }else{
                                                    $status = $booking->booking_status;
                                                }
                                            @endphp
                                            
                                            
                                            
                                            <td class="">{{ $status }}</td>
                                            <td class="">{{ $booking->registration }}</td>
                                            @if($booking->traffic_src != 'Agent')
                                            <td class="">{{ $booking->company->name }}</td>
                                            @else
                                            <td class="">{{ $booking->abookedCompany }}</td>
                                            @endif
                                            @if($role_name!="Controller")
                                            <td class=""> {{ $booking->discount_code }}</td>
                                            <td class="">
                                                @if($booking->payment_method=="stripe")
                                                    <span class="label label-sm label-info"><i
                                                                class="fa fa-cc-stripe"></i> {{ ucwords(preg_replace('/\s/', '', $booking->payment_method))  }}</span>


                                                @elseif($booking->payment_method=="payzone")
                                                    <span class="label label-sm label-info"><i
                                                                class="fa fa-paypal"></i> {{ ucwords(preg_replace('/\s/', '', $booking->payment_method))  }}</span>



                                                @endif
                                            </td>
                                            @can('user_auth', ["Amounts"])
                                            <td class="">£{{ $booking->total_amount }}</td>
                                            @endcan
                                            @endif

                                            {{--<td class="">{{ $booking->no_of_days}}</td>--}}
                                            @php
                                                $share = 0;
                                                    if($booking->company){ $share = $booking->company->share_percentage; }
                                                    $fly_share1 = ((($share/100)*$booking->booking_amount )-$booking->discount_amount)+$booking->booking_extra;

                                                    $fly_share = ($share/100)*$booking->booking_amount;
                                            @endphp

											<!--<td>{{ $booking->no_of_days  }}</td>-->

											<!--<td>-->
											<!--    @if($booking->valet_type != 1 & $booking->valet_type != 0 )-->
											<!--        Yes-->
										 <!--       @else-->
										 <!--           No-->
											<!--    @endif-->
											<!--</td>-->
											@can('user_auth', ["Sources"])
											@if($role_name!="Marketing" && $role_name!="Controller")
											<td>{{ $booking->traffic_src  }}</td>
											
											<!--<td><i onclick="sendEmailForm('{{ $booking->id  }}','{{ $booking->companyId  }}')"-->
           <!--                                                        class="btn btn-minier btn-warning fa fa-envelope"></i></td>-->
											@endif
											@endcan
											<!--<td>-->
											<!--	@can('user_auth', ["view"])-->
											<!--	<i id="view_detail"-->
											<!--	   onclick="getDetail('{{ $booking->id  }}')"-->
											<!--	   class="btn btn-minier btn-success fa fa-eye"-->
											<!--	   title="View"></i>-->
											<!--			 @endcan-->
											<!--	@if($role_name!="Controller")-->
											<!--	@can('user_auth', ["edit"])-->
											<!--	<a id="edit" class="btn btn-minier btn-pink"-->
											<!--	   href="{{ route("edit_booking_form",[$booking->id]) }}"-->
											<!--	   title="Edit"> <i class="fa fa-pencil"-->
											<!--						title="Edit"></i></a>-->
											<!--						 @endcan-->

											<!--	<a id="edit" class="btn btn-minier btn-warning "-->
											<!--	   href="{{ route("edit_booking_form",[$booking->id]) }}"-->
											<!--	   title="Extand">-->
											<!--		<i class="fa fa-ellipsis-h"-->
											<!--		   title="Extend"></i></a>-->
											<!--	<i onclick="getTransferForm('{{ route("transferBookingForm",[$booking->id]) }}')"-->
											<!--	   class="btn btn-minier btn-info fa fa-exchange"-->
											<!--	   title="Transfer"></i>-->
           <!--                                 @endif-->
											<!--</td>-->
											@if($role_name!="Marketing" && $role_name!="Controller")
											<!--<td>-->
											<!--	<i onclick="getcancelForm('{{ $booking->id  }}')"-->
											<!--	   class=" btn btn-minier btn-danger fa fa-times-circle"></i>-->

											<!--	<a id="cancel" class="btn btn-primary btn-minier" title="Cancel Booking Not show" onclick="return confirm('Are you sure want to cancel this booking..?')" href="{{ route('cancelNotShow',['id'=>$booking->id]) }}"><i class="entypo-cancel">Not Show</i></a>-->

											<!--</td>-->
											@if($role_name!="Operations")
											<!--<td><i onclick="getrefundForm('{{ $booking->id  }}')"-->
											<!--	   class="btn btn-minier btn-pink  fa fa-reply"></i>-->
											<!--</td>-->
											@endif
											<!--<td>-->
											<!--	<i class="btn btn-minier btn-warning  fa fa-commenting" onclick="sendsms('{{ $booking->phone_number  }}','{{ $booking->referenceNo  }}')" ></i>-->
											<!--</td>-->
										@endif
										
										
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                                
                                </div>

                                
                            </div><!-- /.span -->
                        </div><!-- /.row -->


                        <!-- PAGE CONTENT ENDS -->
                </div><!-- /.row -->
            </div>

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
{{--<script src='{{ secure_asset("assets/js/jquery.min.js") }}'></script>--}}
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



<script src='{{ secure_asset("assets/front/js/bootbox.js") }}'></script>
<script>

	function show_detal(id) {
		console.log('test');
		if ($("#show_detail_icon_" + id).hasClass("fa-plus-circle")) {
			$("#show_detail_icon_" + id).removeClass("fa-plus-circle");
			$("#show_detail_icon_" + id).addClass("fa-minus-circle");
		} else {
			$("#show_detail_icon_" + id).removeClass("fa-minus-circle");
			$("#show_detail_icon_" + id).addClass("fa-plus-circle");
		}
		console.log('test');

		$("#detail_" + id).toggle();
	}

	function sendEmailForm(id, cmpID) {
		ModelPopUp("<div id=\"resend_email\" ><div><h2>Resend Email</h2></div>\n" +
			"                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
			"<input class=\"radio-resend\" type=\"radio\" value=\"company\" name=\"resendEmailto\">Company</label>\n" +
			"                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
			"<input class=\"radio-resend\"  type=\"radio\" value=\"client\" name=\"resendEmailto\">Client</label>\n" +
			"                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
			"<input class=\"radio-resend\" type=\"radio\" value=\"all\" name=\"resendEmailto\" >ALL</label>\n" +
			"                        <input  onclick=\"sendEmail('" + id + "','" + cmpID + "')\" class=\"btn btn-info\" value=\"Send\" style=\"margin: 15px 5px 5px 15px;\">\n" +
			"                        </div>");
	}

	function sendEmail(id, cid) {
		var type = $('input[name=resendEmailto]:checked').val();
		$("#resend_email").html("<div id=\"resend_email\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");

		var data = {};
		data["id"] = id;
		data["cid"] = cid;
		data["type"] = type;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("booking.sendEmailBooking") }}', data, function (data) {
			console.log("data===", data);
			$("#resend_email").html(data);
//                        if (data.StatusCode == 0) {
//                            window.location.href = "https://"+window.location.hostname+"/booking/thankyou";
//                        } else {
//                            $("#error_personal_detail").html(data.Message);
//                        }
		});

	}

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
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.show") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}


	function getcancelForm(id) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.cancelForm") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}

	function getrefundForm(id) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.refundForm") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}


	function transferSubmit(id) {
		var cid = $("#company_id_pop option:selected").val();
		var html = "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>";
		$("#booking_detail_pop").html(html);
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		data["new_cid"] = cid;
		$.post('{{ route("transferBooking") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}


	function getTransferForm(url) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		// data["id"]=id;
		data["_token"] = '{{ csrf_token() }}';
		$.get(url, data, function (data) {
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
	function sendsms(phone_no,ref_no){
		var data = {};
		var url ='{{ url("admin/send_sms") }}/'+phone_no+'/'+ref_no;

		data["_token"] = '{{ csrf_token() }}';
		$.get(url,  function (data) {

			if(data == 200){
				$("#sms_response").html('<div class="alert alert-success"><strong>Success!</strong> SMS Successfully sent.</div>');
			}
			else{
				$("#sms_response").html('<div class="alert alert-danger"><strong>Error!</strong> SMS sending failed.</div>');
			}

		});
	}
</script>
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
    //     $(document).ready(function() {
    //     $('#example').DataTable( {
    //         dom: 'Bfrtip',
    //         buttons: [
    //             'copy', 'csv', 'excel', 'print'
    //         ]
    //     } );
    // } );
    
    
    $(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(.exclude)'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(.exclude)'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(.exclude)'
                }
            },
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':not(.exclude)'
                }
            },
            // Add other buttons as needed
        ],
        order: [],
    });
});

    </script>
    
 <script>
    function confirmAction(button) {
        var id = button.getAttribute('data-id');
        var type = button.getAttribute('data-type');
        var clickedButton = button;
        var confirmation = confirm('Are you sure you want to confirm ' + type + ' status?'); 
       
        if (confirmation) {
            // Send AJAX request to update database
            $.ajax({
                url: "{{route('booking.update.pickup.return.status')}}", // Replace with your actual route URL
                method: 'GET',
                data: {
                    id: id,
                    type: type
                },
                success: function(response) {
                   if(response.status == true){
                       clickedButton.disabled = true;
                       alert("Status Updated")
                       
                   }
                    console.log(response);
                },
                error: function(error) {
                    // Handle error response if needed
                    console.error(error);
                }
            });
        }
    }
</script>

@endsection
