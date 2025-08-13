@extends('admin.layout.master')
@section('stylesheets')
@parent
<!-- <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
   <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
   
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
   
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
   
   <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css') }}" />
   
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
   
   <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}" /> -->
<style type="text/css">
   .col-lg-12.grid-box{
    float: none!important;
   }
</style>
@endsection
@section('content')
<div class="loading" id="loading" style="display: none;">Loading&#8230;</div>
<div class="page-content">
   <div class="page-header">
      <h1> Booking <small> <i class="ace-icon fa fa-angle-double-right"></i>
         @if ($type == 'add')
         Add
         @else
         Update
         @endif
         </small> 
      </h1>
   </div>
   <!-- /.page-header -->
   <div class="row">
      <div class="col-xs-12">
         <form id="bookingDetails" method="post" action="{{ route('admin_update_booking', $booking_detail->id) }}">
            <input type="hidden" name="airportid" id="airportid" value="1">
            @csrf
            <div class="row">
               <div class="col-xs-12">
                  @if ($message = Session::get('success'))
                  <div class="alert alert-success">
                     <p>{{ $message }}</p>
                  </div>
                  @endif
                  <div class="row">
                  <div class="col-md-9">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           @if ($type == 'add')
                           Add
                           @else
                           Update
                           @endif Booking
                        </div>
                        <div class="panel-body bookingBody">
                           <div id="fuelux-wizard-container">
                              <!--<div class="steps-container">-->
                              <!--    <ul class="steps">-->
                              <!--        <li data-step="1" class="active">-->
                              <!--            <span class="step"></span>-->
                              <!--            <span class="title">Update</span>-->
                              <!--        </li>-->
                              <!--    </ul>-->
                              <!--</div>-->
                              <!--<hr />-->
                              <div class="step-content pos-rel">
                                 <div class="col-lg-12 grid-box mt-3">
                                    <h4 class="update_booking_title">Booking Details</h4>
                                    <div class="row">
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Departure
                                             Date</label>
                                             <div class="">
                                                <input type="text"
                                                   value="{{ \Carbon\Carbon::parse($booking_detail->departDate)->format('d-m-Y') }}"
                                                   readonly class="form-control  "
                                                   id = "old_depart_date"
                                                   placeholder="Departure Date" data-format="dd-mm-yyyy">
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Departure
                                             Time</label>
                                             <input class="form-control" readonly
                                                id = "old_departure_time"
                                                value="{{ \Carbon\Carbon::parse($booking_detail->departDate)->format('H:i') }}">
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Return
                                             Date</label>
                                             <input type="text"
                                                value="{{ \Carbon\Carbon::parse($booking_detail->returnDate)->format('d-m-Y') }}"
                                                readonly class="form-control dpd2"
                                                id = "old_return_date"
                                                placeholder="Return Date" data-format="dd-mm-yyyy">
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label for="field-1" class=" control-label">Return
                                             Time</label>
                                             <input class="form-control" disabled
                                                id = "old_return_time"
                                                value="{{ \Carbon\Carbon::parse($booking_detail->returnDate)->format('H:i') }}">
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">Promo</label>
                                             <input type="text"
                                                value="{{ $booking_detail->discount_code }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">Reference</label>
                                             <input type="text" class="form-control"
                                                value="{{ $booking_detail->referenceNo }}" readonly>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">&nbsp;
                                             </label>
                                             @php
                                             //Departure Date
                                             $departure_date = Carbon\Carbon::parse($booking_detail->departDate);
                                             $today_date = Carbon\Carbon::now();
                                             $subOneDayFromDeparture = $departure_date->copy()->subDay();
                                             // Return Date
                                             $return_date = Carbon\Carbon::parse($booking_detail->returnDate);
                                             $subOneDayFromReturn = $return_date->copy()->subDay();
                                             @endphp
                                             <button class="btn btn-danger quote-btn btn-sm"
                                             type="button"
                                             onclick="show_new_booking_details_form()"
                                             @if ($today_date < $subOneDayFromDeparture && $subOneDayFromReturn > $today_date) onclick="show_new_booking_details_form()"
                                             @else @endif>
                                             Want to update booking details ? </button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-12 grid-box">
                                    <h4 class="update_booking_title">Personal Details</h4>
                                    <div class="row">
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">Title</label>
                                             <select class="form-control bf-slctfld" name="title"
                                                id="title">
                                             <option
                                             @if ($booking_detail->title == 'Mr') selected @endif
                                             value="Mr">Mr</option>
                                             <option
                                             @if ($booking_detail->title == 'Mrs') selected @endif
                                             value="Mrs">Mrs</option>
                                             <option
                                             @if ($booking_detail->title == 'Miss') selected @endif
                                             value="Miss">Miss</option>
                                             <option
                                             @if ($booking_detail->title == 'Ms') selected @endif
                                             value="Ms">Ms</option>
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">First
                                             Name:</label>
                                             <input type="text"
                                                value="{{ $booking_detail->first_name }}"
                                                name="first_name" data-validate="required"
                                                data-message-required="First Name is Required."
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Last
                                             Name:</label>
                                             <input type="text"
                                                value="{{ $booking_detail->last_name }}"
                                                name="last_name" data-validate="required"
                                                data-message-required="Last Name is Required."
                                                class="form-control">
                                          </div>
                                       </div>
                                       <?php //if ($_SESSION['admin_admintype'] == 'SuperAdmin') {
                                          ?>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">Email</label>
                                             <input name="email" type="text" class="form-control"
                                                data-validate="required,email" aria-invalid="true"
                                                aria-describedby="email-error"
                                                value="{{ $booking_detail->email }}">
                                          </div>
                                       </div>
                                       <?php //}
                                          ?>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">Contact</label>
                                             <input name="contact" type="text"
                                                value="{{ $booking_detail->phone_number }}"
                                                data-validate="required"
                                                data-message-required="Contact Number is Required."
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">City</label>
                                             <input name="city" id="city" type="text"
                                                value="{{ $booking_detail->city }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">Country</label>
                                             <input name="country" id="country" type="text"
                                                value="{{ $booking_detail->country }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-12 grid-box">
                                    <h4 class="update_booking_title">Flight and Car Details</h4>
                                    <div class="row">
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Flight
                                             No</label>
                                             <input name="dept_flight_no" type="text"
                                                value="{{ $booking_detail->deptFlight }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Return
                                             Flight No</label>
                                             <input name="return_flight_no" type="text"
                                                value="{{ $booking_detail->returnFlight }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">Departure Terminal</label>
                                             <select name="departure_terminal" id="departure_terminal"
                                                type="text" data-validate="required"
                                                data-message-required="Departure Terminal No is Required."
                                                class="form-control">
                                                @php
                                                $terminals = App\Models\airports_terminals::where('aid', $booking_detail->airportID)->get(); @endphp ?> ?> ?>
                                                @if ($booking_detail->deprTerminal == 'TBA')
                                                <option selected="selected" value="TBA"> TBA
                                                </option>
                                                @endif
                                                @foreach ($terminals as $row)
                                                <option
                                                @if ($row->id == $booking_detail->deprTerminal) selected="selected" @endif
                                                value="{{ $row->id }}">
                                                {{ $row->name }}</option>
                                                @endforeach
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Arrival
                                             Terminal</label>
                                             <select name="return_terminal" id="return_terminal"
                                                type="text" data-validate="required"
                                                data-message-required="Arrival Terminal is Required."
                                                class="form-control">
                                                @php
                                                $terminals = App\Models\airports_terminals::where('aid', $booking_detail->airportID)->get();
                                                @endphp
                                                @if ($booking_detail->returnTerminal == 'TBA')
                                                <option selected="selected" value="TBA"> TBA
                                                </option>
                                                @endif
                                                @foreach ($terminals as $row)
                                                <option
                                                @if ($row->id == $booking_detail->returnTerminal) selected="selected" @endif
                                                value="{{ $row->id }}">
                                                {{ $row->name }}</option>
                                                @endforeach
                                             </select>
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Vehicle
                                             Make</label>
                                             <input name="veh_make" id="veh_make" type="text"
                                                value="{{ $booking_detail->make }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Vehicle
                                             Model</label>
                                             <input name="veh_model" id="veh_model" type="text"
                                                value="{{ $booking_detail->model }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Vehicle
                                             Colour</label>
                                             <input name="veh_colour" id="veh_colour" type="text"
                                                value="{{ $booking_detail->color }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                       <div class="col-md-4 col-sm-4">
                                          <div class="form-group">
                                             <label for="field-1" class="control-label">Vehicle
                                             Registration</label>
                                             <input name="veh_registration" id="veh_registration"
                                                type="text"
                                                value="{{ $booking_detail->registration }}"
                                                class="form-control">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-lg-12 grid-box">
                                    <h4 class="update_booking_title">Payment Details</h4>
                                    <div class="row">
                                       <div class="col-sm-3">
                                          <div class="form-group">
                                             <label for="field-1"
                                                class="control-label">Transaction Id:</label>
                                             <input type="text"
                                                value="{{ $booking_detail->token }}"
                                                name="transaction_id" data-validate="required"
                                                data-message-required="Transaction id is Required."
                                                class="form-control" readonly>
                                          </div>
                                       </div>
                                       <div class="col-sm-3">
                                          <div class="form-group stripe_btn">
                                             <label for="field-1"
                                                class="control-label col-sm-3">Stripe:</label>
                                             <div class="col-sm-9">
                                                <input name="payment_method" type="radio"
                                                class="form-control"
                                                @if ($booking_detail->payment_method == 'stripe') checked @endif
                                                data-validate="required"
                                                data-message-required="Payment Method is Required."
                                                value="Stripe" class="payment_method"/>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-sm-12 updateCol">
                                          <div class="form-group btnCont">
                                             <button type="submit" class="btn btn-primary">
                                             Update</button>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="widget-box">
                        <div class="widget-header">
                           <h4 class="widget-title">Booking Summary</h4>
                           <div class="widget-toolbar">
                              <a href="#" data-action="collapse">
                              <i class="ace-icon fa fa-chevron-up"></i>
                              </a>
                           </div>
                        </div>
                        <div class="widget-body">
                           <div class="widget-main">
                              <table class="table">
                                 <tbody>
                                    <tr>
                                       <th class="col-md-5">Airport</th>
                                       <td id="airport_txt" class="col-md-5">
                                          @if ($booking_detail != '' && $booking_detail->airport)
                                          {{ $booking_detail->airport->name }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Company</th>
                                       <td id="airport_txt" class="col-md-5">
                                          @if ($booking_detail != '' && $booking_detail->company)
                                          {{ $booking_detail->company->name }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Departure Date</th>
                                       <td id="deptdate_txt" class="col-md-5">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->departDate }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Return Date</th>
                                       <td id="returndate_txt" class="col-md-5">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->returnDate }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr style="display:none;">
                                       <th class="col-md-5">Company</th>
                                       <td id="company_txt" class="col-md-5">
                                          @if ($booking_detail != '' && $booking_detail->company)
                                          {{ $booking_detail->company->name }}
                                          @endif
                                       </td>
                                    </tr>
                                    <input type="hidden" id="companyID" name="companyID"
                                       value="@if ($booking_detail != '' && $booking_detail->company) {{ $booking_detail->company->id }} @endif">
                                    <tr style="display:none;">
                                       <th class="col-md-5">Parking Type</th>
                                       <td id="parkingtype_txt" class="col-md-5">
                                          @if ($booking_detail && $booking_detail->company)
                                          {{ $booking_detail->company->parking_type }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th>Total Days</th>
                                       <td id="totalNoDays_txt">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->no_of_days }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Booking Price</th>
                                       <td id="booking_price_txt" class="col-md-5"
                                          style="font-weight: bold; font-size: 16px;">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->booking_amount }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Add Extra Sys</th>
                                       <td id="add_extra_sys" class="col-md-5">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->extra_amount }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr class="tr-hide" style="display: none;">
                                       <th class="col-md-5">Discounted Booking Price</th>
                                       <td id="discounted_price_txt" class="col-md-5"
                                          style="font-weight: bold; font-size: 16px;">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->discount_amount }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr class="tr-hide">
                                       <th class="col-md-5">Discount Amount</th>
                                       <td id="discount_price_txt" class="col-md-5">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->discount_amount }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Cancel Price</th>
                                       <td id="cancel_price_txt" class="col-md-5">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->cancelfee }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Sms Price</th>
                                       <td id="sms_price_txt" class="col-md-5">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->smsfee }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Booking Fee</th>
                                       <td id="booking_fee_txt" class="col-md-5">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->booking_fee }}
                                          @endif
                                       </td>
                                    </tr>
                                    <tr>
                                       <th class="col-md-5">Total Price</th>
                                       <td id="total_price_txt" class="col-md-5"
                                          style="font-weight: bold; font-size: 16px;">
                                          @if ($booking_detail != '')
                                          {{ $booking_detail->total_amount }}
                                          @endif
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                              <input type="hidden" name="parking_type" id="parking_type"
                                 value="@if ($booking_detail && $booking_detail->company) {{ $booking_detail->company->parking_type }} @endif" />
                              <input type="hidden" name="cancelFEE" id="cancelFEE"
                                 value="@if ($booking_detail != '') {{ $booking_detail->cancelfee }} @endif" />
                              <input type="hidden" name="smsFEE" id="smsFEE"
                                 value="@if ($booking_detail != '') {{ $booking_detail->smsfee }} @endif" />
                              <input type="hidden" name="add_extra" id="add_extra"
                                 value="@if ($booking_detail != '') {{ $booking_detail->extra_amount }} @endif" />
                              <input type="hidden" name="bookingFEE" id="bookingFEE"
                                 value="@if ($booking_detail != '') {{ $booking_detail->booking_fee }} @endif" />
                              <input type="hidden" name="booking_extra_sys" id="booking_extra_sys"
                                 value="@if ($booking_detail != '') {{ $booking_detail->extra_amount }} @endif" />
                              <input type="hidden" name="p_booking_amount" id="p_booking_amount"
                                 value="@if ($booking_detail != '') {{ $booking_detail->booking_amount }} @endif" />
                              <input type="hidden" name="no_of_days" id="no_of_days"
                                 value="@if ($booking_detail != '') {{ $booking_detail->no_of_days }} @endif" />
                              <input type="hidden" name="discount_amount" id="discount_amount"
                                 value="@if ($booking_detail != '') {{ $booking_detail->discount_amount }} @endif" />
                              <input type="hidden" name="totalAMOUNT" id="totalAMOUNT"
                                 value="@if ($booking_detail != '') {{ $booking_detail->total_amount }} @endif" />
                              <input type="hidden" name="h_totalAMOUNT" id="h_totalAMOUNT"
                                 value="@if ($booking_detail != '') {{ $booking_detail->total_amount }} @endif" />
                           </div>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal fade" id="airport_modal" role="dialog">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Select Company</h4>
         </div>
         <div class="modal-body" id="step_2_companies">
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
@include('admin.partials.models')
@endsection
@section('footer-script')
<script src='{{ asset('assets/js/moment.min.js') }}'></script>
<script src='{{ asset('assets/js/bootstrap-timepicker.min.js') }}'></script>
<!-- page specific plugin scripts -->
<script src='{{ asset('assets/js/wizard.min.js') }}'></script>
<script src='{{ asset('assets/js/jquery.validate.min.js') }}'></script>
<script src='{{ asset('assets/js/jquery-additional-methods.min.js') }}'></script>
<script src='{{ asset('assets/js/bootbox.js') }}'></script>
<script src='{{ asset('assets/js/jquery.maskedinput.min.js') }}'></script>
<script src='{{ asset('assets/js/select2.min.js') }}'></script>
<script src='{{ asset('assets/front/js/bootstrap-datepicker.js') }}'></script>
<script src='{{ asset('assets/front/js/custom-date-picker.js') }}'></script>
<script src="https://getaddress.io/js/jquery.getAddress-2.0.8.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script type="text/javascript">
   $('#postcode_lookup').getAddress({
   
       api_key: '{{ $settings['address_key'] }}',
   
       //            <!--  Or use your own endpoint - api_endpoint:https://your-web-site.com/getAddress, -->
   
       output_fields: {
   
           line_1: '#line1',
   
           line_2: '#address',
   
           line_3: '#address2',
   
           post_town: '#town',
   
           county: '#county',
   
           postcode: '#post_code'
   
       },
   
       button_class: 'btn btn-yellow',
   
       input_class: 'form-control my-class',
   
       dropdown_class: 'form-control  my-class',
   
       onLookupSuccess: function(data) {
   
           /* Your custom code */
   
           $('#ad_field').hide();
   
       },
   
       onLookupError: function() {
   
           /* Your custom code */
   
   
   
           // $('#postcode_lookup').hide();
   
           $('#ad_field').hide();
   
   
   
   
   
           $("#postcode_lookup").append(
   
               '<button id="nolist" type="button" class="btn text-center btn-yellow" >Address Not Listed</button><script>$("#nolist").bind("click",function(){$("#ad_field").show(); $("#getaddress_input").hide(); $("#getaddress_button").hide(); $("#getaddress_error_message").hide(); });<\/script>'
   
           );
   
   
   
   
   
       },
   
       onAddressSelected: function(elem, index) {
   
           /* Your custom code */
   
           //$('#ad_field').show();
   
       }
   
   });
   
   var isSelected = 0;
   
   
   
   function show_new_booking_details_form() {
   
       $("#new_payment_model").modal('show');
   
   }
   
   
   
   function get_parking_prices() {
   
       $('#new_payment_model').modal('hide');
   
       $("#airport_modal").modal('toggle');
   
   
   
       setTimeout(function() {
   
           var old_departure_date = $('#old_depart_date').val();
   
           var departure_date = $('#new_dep_date').val();
   
           var return_date = $('#new_return_date').val();
   
           var old_return_date = $('#old_return_date').val();
   
           var departure_time = $('#new_departure_time').val();
   
           var old_departure_time = $('#old_departure_time').val();
   
           var return_time = $('#new_return_time').val();
   
           var old_return_time = $('#old_return_time').val();
   
           var total_amount_booking_old = $('#total_amount_booking_old').val();
   
           var ref = $('#new_reff').val();
   
           var old_no_of_days = $('#no_of_days').val();
   
           
   
           // if (moment(return_date, 'YYYY-MM-DD', true).isValid()) {
   
           //     var modifiedDate = moment(return_date, 'YYYY-MM-DD').add(1, 'days').format('YYYY-MM-DD');
   
           //     var return_date = modifiedDate;
   
           // }
   
           var airportid = $('#airportid').val();
   
           var promo = $('#new_promo').val();
   
           var data = {};
   
           data['companyID'] = $('#companyID').val();
   
           data['dropoffdate'] = departure_date;
   
           data['old_dropoffdate'] = old_departure_date;
   
           data['dropoftime'] = departure_time;
   
           data['old_dropoftime'] = old_departure_time;
   
           data['pickup_date'] = return_date;
   
           data['old_pickup_date'] = old_return_date;
   
           data['pickup_time'] = return_time;
   
           data['old_pickup_time'] = old_return_time;
   
           data['airport_id'] = airportid;
   
           data['total_amount_booking_old'] = total_amount_booking_old;
   
           data['ref'] = ref;
   
           data['old_no_of_days'] = old_no_of_days;
   
           data['_token'] = '{{ @csrf_token() }}';
   
           data['promo'] = promo;
   
           $.ajax({
   
               type: 'post',
   
               data: data,
   
               async: false,
   
               url: '{{ route('getQuote') }}',
   
               beforeSend: function() {
   
   
   
                   // $('#loading').css("display","block");
   
               },
   
               complete: function() {
   
                   // $('#loading').hide();
   
               },
   
               error: function() {
   
                   $('.quote-btn').attr("disabled", false);
   
                   $('.quote-btn').html("Get Quote");
   
                   $("#step_2_companies").html("No Result found!");
   
               },
   
               success: function(msg) {
   
   
   
                   $("#step_2_companies").html(msg);
   
               }
   
           });
   
           //}
   
       }, 100);
   
   }
   
   
   
   function selectCompany(id) {
   
       isSelected = 1;
   
       var x = $('#cform' + id).serializeArray();
   
       var obj = JSON.parse(JSON.stringify($('#cform' + id).serializeArray()));
   
       // console.log($('#new_departure_date').val());
   
       //$('#cdetails-modal').modal('hide');
   
       $('#company_id').val(obj[0].value); //company id
   
       // console.log(obj);
   
       $('#company_txt').text(obj[1].value); //company name
   
       $('#parkingtype_txt').text(obj[2].value); //parking type
   
       $('#parking_type').val(obj[2].value); //parking type
   
       $('#booking_price_txt').text(obj[3].value); //booking price
   
       $('#p_booking_amount').val(obj[3].value); //booking price
   
       $('#cancel_price_txt').text(obj[5].value); //cancel price
   
       $('#cancelFEE').val(obj[5].value); //cancel price
   
       $('#booking_fee_txt').text(obj[6].value); //booking fee
   
       $('#bookingFEE').val(obj[6].value); //booking fee
   
       $('#total_price_txt').html(obj[7].value); //total price
   
       $('#totalAMOUNT').val(obj[7].value); //total price
   
       $('#h_totalAMOUNT').val(obj[7].value); //total price
   
       $('#discount_amount').val(obj[8].value); //discount price
   
       $('#discount_price_txt').text(obj[8].value); //discount price
   
       $('#extraAmount').val(0); //total price
   
       $('#airport_txt').text(obj[9].value); //company id
   
       $('#deptdate_txt').text(obj[10].value); //company id
   
       $('#returndate_txt').text(obj[11].value); //company id
   
       $('#totalNoDays_txt').text(obj[15].value); //company id
   
       $('#no_of_days').val(obj[15].value); //company id
   
       $('#sms_price_txt').text(0); //company id
   
       $('#anew_departure_time').val(obj[13].value); //Depart Time
   
       $('#anew_return_time').val(obj[12].value); //Arrival Time
   
       getTerminals($('#airportid').val());
   
       get_extra_prices();
   
       $("#airport_modal").modal('toggle');
   
       $('.updated_departure_date').html($('#new_departure_date').val());
   
       $('.updated_departure_time').html($('#new_departure_time').val());
   
       $('.updated_return_date').html($('#new_return_date').val());
   
       $('.updated_return_time').html($('#new_return_time').val());
   
       $('.updated_promo_code').html($('#new_promo_code').val());
   
       $('.updated_price').html($('#updated_price').val());
   
       $('.price_difference').html($('#difference_amount').val());
   
       $('#new_no_of_days').val(obj[15].value);
   
   
   
       $('#new_difference_type').val($('#difference_type').val());
   
       $('#new_price_difference').val($('#difference_amount').val());
   
   
   
   
   
       $('#new_booking_price').val(obj[7].value);
   
       $('#new_promo_code').val($('#new_promo_code').val());
   
       $('#departure_date_time').val($('#new_departure_date').val());
   
       $('#return_date_time').val($('#new_return_date').val());
   
       $('#return_date_time').val($('#new_return_date').val());
   
       $('#return_date_time').val($('#new_return_date').val());
   
       $('.update_new_price').html($('#updated_price').val());
   
   
   
   
   
   
   
       $('#new_payment_details').modal('show');
   
   
   
   
   
   
   
   }
   
   
   
   function get_extra_prices() {
   
       var total_amount = $('#h_totalAMOUNT').val();
   
       var sms_amount = 0.00;
   
       var postal_amount = 0.00;
   
       var extraAmount = 0.00;
   
       var cancelAmount = 0.00;
   
       if ($('#sms_fee').is(':checked')) {
   
           sms_amount = parseFloat($('#sms_fee').val());
   
       }
   
       if ($('#postal_fee').is(':checked')) {
   
           postal_amount = parseFloat($('#postal_fee').val());
   
       }
   
       if ($('#add_extra').val() != '') {
   
           // extraAmount = parseFloat($('#extraAmount').val());
   
       }
   
       if ($('#cancel_fee').is(':checked')) {
   
           cancelAmount = parseFloat($('#cancel_fee').val());
   
       }
   
       total_amount = parseFloat(total_amount);
   
       var newtotal = ((total_amount) + (sms_amount) + (postal_amount) + (extraAmount) + (cancelAmount));
   
       var newtotal = newtotal.toFixed(2);
   
       var sms_amount = sms_amount.toFixed(2);
   
       var postal_amount = postal_amount.toFixed(2);
   
       var extraAmount = extraAmount.toFixed(2);
   
       var cancelAmount = cancelAmount.toFixed(2);
   
       $('#total_price_txt').text(newtotal);
   
       $('#totalAMOUNT').val(newtotal);
   
       $('#sms_price_txt').text(sms_amount);
   
       $('#smsFEE').val(sms_amount);
   
       $('#postalFEE').val(postal_amount);
   
       $('#postal_price_txt').text(postal_amount);
   
       $('#cancelFEE').val(cancelAmount);
   
       $('#cancel_price_txt').text(cancelAmount);
   
       $('#extraAmount').val(extraAmount);
   
       $('#extra_price_txt').text(extraAmount);
   
   }
   
   
   
   jQuery(function($) {
   
       $('#add_extra').on('keyup blur', function() {
   
           get_extra_prices();
   
       });
   
       $('#sms_fee').click(function() {
   
           get_extra_prices();
   
       });
   
       $('#postal_fee').click(function() {
   
           get_extra_prices();
   
       });
   
       $('#cancel_fee').click(function() {
   
           get_extra_prices();
   
       });
   
       $('#return_time').timepicker({
   
           minuteStep: 15,
   
           showSeconds: false,
   
           showMeridian: false,
   
           disableFocus: true,
   
           icons: {
   
               up: 'fa fa-chevron-up',
   
               down: 'fa fa-chevron-down'
   
           }
   
       }).on('focus', function() {
   
           $('#return_time').timepicker('showWidget');
   
       }).next().on(ace.click_event, function() {
   
           $(this).prev().focus();
   
       });
   
   
   
       $('#departure_time').timepicker({
   
           minuteStep: 15,
   
           showSeconds: false,
   
           showMeridian: false,
   
           disableFocus: true,
   
           icons: {
   
               up: 'fa fa-chevron-up',
   
               down: 'fa fa-chevron-down'
   
           }
   
       }).on('focus', function() {
   
           $('#departure_time').timepicker('showWidget');
   
       }).next().on(ace.click_event, function() {
   
           $(this).prev().focus();
   
       });
   
   
   
   });
   
   
   
   //company_email_div
   
   function getTerminals(airport) {
   
       var data = {};
   
       data['id'] = airport;
   
       //data['action'] = 'getTerminals';
   
       $.ajax({
   
           type: 'get',
   
           // data: data,
   
           @if ($edit == 1)
   
               url: '{{ url('../admin/company/getTerminals') }}/' + airport,
   
           @else
   
               url: '{{ url('admin/company/getTerminals') }}/' + airport,
   
           @endif
   
   
   
           success: function(msg) {
   
               $('#departure_terminal').html(msg);
   
               $('#return_terminal').html(msg);
   
   
   
           }
   
       });
   
   
   
   }
   
   
   
   var $validation = false;
   
   //$('#fuelux-wizard-container').wizard( get_parking_prices() );
   
   $('#fuelux-wizard-container')
   
       .ace_wizard({
   
           //step: 2 //optional argument. wizard will jump to step "2" at first
   
           //buttons: '.wizard-actions:eq(0)'
   
       })
   
       .on('actionclicked.fu.wizard', function(e, info) {
   
           console.log("info", info);
   
           //get_parking_prices();
   
           if (info.step == 1 && info.direction == "next") {
   
               if ($('#quote').valid()) {
   
                   get_parking_prices();
   
               } else {
   
                   e.preventDefault();
   
               }
   
           }
   
           if (info.step == 2 && info.direction == "next") {
   
               if (isSelected == 0) {
   
                   e.preventDefault();
   
                   alert("Please Select parking type.");
   
               }
   
           }
   
           if (info.step == 3 && info.direction == "next") {
   
               if (!$('#personal_detail').valid()) {
   
                   e.preventDefault();
   
               }
   
           }
   
   
   
   
   
           if (info.step == 5 && info.direction == "next") {
   
               if (!$('#payment_detail').valid()) {
   
                   e.preventDefault();
   
               }
   
           }
   
       })
   
       //.on('changed.fu.wizard', function() {
   
       //})
   
       .on('finished.fu.wizard', function(e) {
   
           //data submit start
   
           var data = {};
   
           data['airport_id'] = $('#airportid').val();
   
           data['dep_date'] = $('#dep_date').val();
   
           data['departure_time'] = $('#departure_time').val();
   
           data['return_date'] = $('#return_date').val();
   
           data['return_time'] = $('#return_time').val();
   
           data['promo'] = $('#promo').val();
   
   
   
   
   
           data['first_name'] = $('#first_name').val();
   
           data['last_name'] = $('#last_name').val();
   
           data['email'] = $('#email').val();
   
           data['contact'] = $('#contact').val();
   
           //data['full_address'] = $('#getaddress_dropdown').val();
   
           data['address'] = $('#address').val();
   
           data['city'] = $('#city').val();
   
           data['post_code'] = $('#post_code').val();
   
           data['country'] = $('#country').val();
   
   
   
   
   
           data['dept_flight_no'] = $('#dept_flight_no').val();
   
           data['return_flight_no'] = $('#return_flight_no').val();
   
           data['departure_terminal'] = $('#departure_terminal').val();
   
           data['return_terminal'] = $('#return_terminal').val();
   
           data['veh_make'] = $('#veh_make').val();
   
           data['veh_model'] = $('#veh_model').val();
   
           data['veh_colour'] = $('#veh_colour').val();
   
           data['veh_registration'] = $('#veh_registration').val();
   
   
   
   
   
           data['transaction_id'] = $('#transaction_id').val();
   
           data['payment_method'] = $("#payment_detail input[name='payment_method']:checked").val();
   
   
   
   
   
           data['company_id'] = $('#bookingDetails input[name="company_id"]').val();
   
           data['parking_type'] = $('#bookingDetails input[name="parking_type"]').val();
   
           data['discount_amount'] = $('#bookingDetails input[name="discount_amount"]').val();
   
           data['p_booking_amount'] = $('#bookingDetails input[name="p_booking_amount"]').val();
   
           data['postalFEE'] = $('#bookingDetails input[name="postalFEE"]').val();
   
           data['bookingFEE'] = $('#bookingDetails input[name="bookingFEE"]').val();
   
           data['add_extra'] = $('#bookingDetails input[name="add_extra"]').val();
   
           data['totalAMOUNT'] = $('#bookingDetails input[name="totalAMOUNT"]').val();
   
           data['h_totalAMOUNT'] = $('#bookingDetails input[name="h_totalAMOUNT"]').val();
   
   
   
           data['no_of_days'] = $('#bookingDetails input[name="no_of_days"]').val();
   
           data['airport'] = $('#bookingDetails input[name="airport"]').val();
   
           data['_token'] = '{{ csrf_token() }}';
   
   
   
           data['smsFEE'] = $("#smsFEE").val();
   
           data['cancelFEE'] = $("#cancelFEE").val();
   
           data['passenger'] = 1;
   
           var url = '{{ route('admin_add_booking') }}';
   
           @if ($type == 'edit')
   
               url = '{{ route('admin_update_booking', [$id]) }}';
   
           @endif
   
   
   
   
   
           $.post(url, data, function(data) {
   
   
   
   
   
               bootbox.dialog({
   
                   message: "Thank you! Your information was successfully saved!",
   
                   buttons: {
   
                       "success": {
   
                           "label": "OK",
   
                           "className": "btn-sm btn-primary"
   
                       }
   
                   }
   
               });
   
   
   
               window.location.href = "{{ url('admin/booking') }}";
   
   
   
   
   
           }, 'json');
   
           //data submit end
   
   
   
   
   
       }).on('stepclick.fu.wizard', function(e) {
   
           //e.preventDefault();//this will prevent clicking and selecting steps
   
       });
   
</script>
<script type="text/javascript">
   $(document).ready(function() {
   
       // Initially, disable the "Update & Get Quote" button
   
   
   
       // Store the initial values of the input fields
   
       var initialValues = {
   
           dep_date: $('#new_dep_date').val(),
   
           new_return_date: $('#new_return_date').val(),
   
   
   
       };
   
   
   
       // Function to check if any field value has changed
   
       function isAnyFieldChanged() {
   
           var currentValues = {
   
               dep_date: $('#new_dep_date').val(),
   
               new_return_date: $('#new_return_date').val()
   
           };
   
   
   
           // Compare the current values with the initial values
   
           for (var field in currentValues) {
   
               if (currentValues[field] !== initialValues[field]) {
   
                   return true;
   
               }
   
           }
   
   
   
           return false;
   
       }
   
   
   
       $('#new_dep_date, #new_return_date').on('change', function() {
   
           if (isAnyFieldChanged()) {
   
               $('#updateQuoteButton').prop('disabled', false);
   
           } else {
   
               $('#updateQuoteButton').prop('disabled', true);
   
           }
   
       });
   
   });
   
</script>
<script>
   $(document).ready(function() {
   
       // Handle form submission when the button is clicked
   
       $('#saveTempororyFrom').click(function() {
   
           var formData = $('#tempororyBookingFrom').serialize();
   
           $('#saveTempororyFrom').prop('disabled', true);
   
           $('#saveTempororyFrom').html('Loading.....');
   
            $('.note').html('');
   
           $.ajax({
   
               type: 'POST',
   
               url: "{{ route('temporary.bookings.save') }}",
   
               data: formData,
   
               success: function(response) {
   
                   console.log(response);
   
                   if (response.status == true) {
   
                       $('.payment_link_wrapper').removeClass('hideMe');
   
                       if(response.is_refund != true){
   
                                $('.paymentLinkUrl').html(response.paymentLink);
   
                                $('.note').removeClass('hideMe');
   
                                $('.note').html('Booking amended Successfully, if you want the customer to pay via stripe please copy the payment link provided and send it to process the payment. Once the payment is done, Payment details will be automatically updated. <br> <p class="text-danger">Please do not hit update button as the booking is already updated. </p>');
   
                       }else{
   
                            $('.paymentLinkUrl').html('Amount for new dates are in negative, so the link is not accessible.');
   
                       }
   
                       $('#saveTempororyFrom').remove();
   
                   } else {
   
                       $('.payment_error_wrapper').removeClass('hideMe');
   
                       $('.payment_error_link').html(response.paymentLink);
   
                       $('#saveTempororyFrom').prop('disabled', false);
   
                       $('#saveTempororyFrom').html('Update');
   
                   }
   
   
   
               },
   
               error: function(error) {
   
                   // Handle any errors here
   
                   console.error(error);
   
               }
   
           });
   
       });
   
   });
   
</script>
<script>
   var today = new Date();
   
   var dd = String(today.getDate()).padStart(2, '0');
   
   var mm = String(today.getMonth() + 1).padStart(2, '0');
   
   var yyyy = today.getFullYear();
   
   today = yyyy + '-' + mm + '-' + dd;
   
   document.getElementById("new_dep_date").setAttribute("min", today);
   
</script>
<script>
   var depDateInput = document.getElementById("new_dep_date");
   
   var returnDateInput = document.getElementById("new_return_date");
   
   depDateInput.addEventListener("change", function() {
   
       var depDate = new Date(this.value);
   
       var returnDate = new Date(returnDateInput.value);
   
       if (depDate > returnDate) {
   
           alert("Departure date cannot be later than the return date. Please update the return date.");
   
           returnDateInput.value = this.value;
   
       }
   
   });
   
</script>
@endsection