@extends('admin.layout.master')

@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/jquery-ui.custom.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/chosen.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/bootstrap-datepicker3.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/bootstrap-timepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/daterangepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/bootstrap-colorpicker.min.css') }}"/>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
    <style type="text/css">
    
        
    </style>
@endsection

@section('content')
@can('user_auth', ["add"])

    <div class="loading" id="loading" style="display: none;">Loading&#8230;</div>


    <div class="page-content">


        <div class="page-header">
            <h1>
                Booking
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    @if($type=="add") Add  @else Update @endif
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->


                <div class="row">
                    

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="col-md-9">
                            <div class="panel panel-default">

                                <div class="panel-heading">  @if($type=="add") Add  @else Update @endif Booking</div>
                                <div class="panel-body">


                                    <div id="fuelux-wizard-container">
                                        <div class="steps-container">
                                            <ul class="steps">
                                                <li data-step="1" class="active">
                                                    <span class="step">1</span>
                                                    <span class="title">Booking Details</span>
                                                </li>

                                                <li data-step="2" class="active">
                                                    <span class="step">2</span>
                                                    <span class="title">Select Product</span>
                                                </li>

                                                <li data-step="3">
                                                    <span class="step">3</span>
                                                    <span class="title">Personal Details</span>
                                                </li>

                                                <li data-step="4">
                                                    <span class="step">4</span>
                                                    <span class="title">Flight and Car Details</span>
                                                </li>

                                                <li data-step="5">
                                                    <span class="step">5</span>
                                                    <span class="title">Payment Details</span>
                                                </li>
                                            </ul>
                                        </div>

                                        <hr/>

                                        <div class="step-content pos-rel">
                                            <div class="step-pane active" data-step="1">
                                                
                                                <form id="quote">
                                                    <div class="row">
                                                    <div class="col-md-4  col-lg-4" style="display:none;">
                                                        <div class="form-group">
                                                            {{ Form::label('Airports', 'Select Airport', array('class' => 'col-sm-12')) }}

                                                            <div class="form-control-sm"></div>
                                                            <div class="col-sm-12">
                                                                {{ Form::text('airport_id',  1, array('class' => '', "id"=>"airport_id", "required"=>"required")) }}

                                                            </div>

                                                            @if ($errors->has('airport_id'))

                                                                <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5 clearBoth">
                                                                    <strong>{{ $errors->first('airport_id') }}</strong>
                                                                </div>
                                                            @endif


                                                        </div>

                                                    </div>


                                                    <div class="col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            {{ Form::label('Departure Date', 'Departure Date', array('class' => '')) }}


                                                                {{ Form::text('dep_date',  Request::old('dep_date'), array('class' => 'date-picker form-control',"data-date-format"=>"dd-mm-yyyy","id"=>"dep_date","required"=>"required")) }}
                                                                {{--<span class="input-group-addon">--}}
                                                                {{--<i class="fa fa-calendar" style="font-size: 145%!important"></i>--}}
                                                                {{--</span>--}}

                                                                @if ($errors->has('dep_date'))

                                                                    <div class="alert alert-danger alert alert-danger col-xs-12 col-sm-12  clearBoth">
                                                                        <strong>{{ $errors->first('dep_date') }}</strong>
                                                                    </div>
                                                                @endif

                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            {{ Form::label('Time', 'Time', array('class' => '')) }}


                                                                {{ Form::text('departure_time',  Request::old('departure_time'), array("id"=>"departure_time",'class' => ' form-control',"required"=>"required")) }}


                                                                @if ($errors->has('departure_time'))

                                                                    <div class="alert alert-danger alert alert-danger col-xs-12 col-sm-12 clearBoth">
                                                                        <strong>{{ $errors->first('departure_time') }}</strong>
                                                                    </div>
                                                                @endif

                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-3 col-lg-3">
                                                        <div class="form-group">
                                                            {{ Form::label('Return Date', 'Return Date', array('class' => '')) }}


                                                                {{ Form::text('return_date',  Request::old('return_date'), array("id"=>"return_date","data-date-format"=>"dd-mm-yyyy",'class' => ' form-control date-picker',"required"=>"required")) }}

                                                                {{--<span class="input-group-addon">--}}
                                                                {{--<i class="fa fa-calendar" style="font-size: 145%!important"></i>--}}
                                                                {{--</span>--}}
                                                                @if ($errors->has('return_date'))

                                                                    <div class="alert alert-danger alert alert-danger col-xs-12 col-sm-12 clearBoth">
                                                                        <strong>{{ $errors->first('return_date') }}</strong>
                                                                    </div>
                                                                @endif

                                                        </div>
                                                    </div>


                                                    <div class="col-md-2 col-lg-2">
                                                        <div class="form-group">
                                                            {{ Form::label('Time', 'Time', array('class' => '')) }}


                                                                {{ Form::text('return_time',  Request::old('return_time'), array("id"=>"return_time",'class' => ' form-control',"required"=>"required")) }}


                                                                @if ($errors->has('return_time'))

                                                                    <div class="alert alert-danger alert alert-danger col-xs-12 col-sm-12 clearBoth">
                                                                        <strong>{{ $errors->first('return_time') }}</strong>
                                                                    </div>
                                                                @endif

                                                        </div>
                                                    </div>


                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            {{ Form::label('Promo', 'Promo', array('class' => '')) }}


                                                                {{ Form::text('promo',  Request::old('promo'), array("id"=>"promo",'class' => ' form-control')) }}


                                                                @if ($errors->has('promo'))

                                                                    <div class="alert alert-danger alert alert-danger col-xs-12 col-sm-12 clearBoth">
                                                                        <strong>{{ $errors->first('promo') }}</strong>
                                                                    </div>
                                                                @endif

                                                        </div>
                                                    </div>
                                                </div>

                                                </form>


                                            </div>

                                            <div class="step-pane overflowYScroll" data-step="2" id="step_2_companies">
                                            

                                            </div>

                                            <div class="step-pane" data-step="3">
                                                <form id="personal_detail">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="field-1"
                                                                   class="control-label">Title</label>
                                                                <select class="form-control bf-slctfld" name="title"
                                                                        id="title">
                                                                    <option value="Mr">Mr</option>
                                                                    <option value="Mrs">Mrs</option>
                                                                    <option value="Miss">Miss</option>
                                                                    <option value="Ms">Ms</option>
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="field-1" class="control-label">First
                                                                Name:</label>
                                                                <input id="first_name" required type="text" value=""
                                                                       name="first_name"
                                                                       data-validate="required"
                                                                       data-message-required="First Name is Required."
                                                                       class="form-control">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="field-1" class="control-label">Last
                                                                Name:</label>
                                                                <input id="last_name" required type="text" value=""
                                                                       name="last_name"
                                                                       data-validate="required"
                                                                       data-message-required="Last Name is Required."
                                                                       class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="field-1"
                                                                   class="control-label">Email</label>
                                                                <input id="email" required name="email" type="text"
                                                                       class="form-control"
                                                                       data-validate="required,email"
                                                                       aria-invalid="true"
                                                                       aria-describedby="email-error"
                                                                       value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="field-1"
                                                                   class="control-label">Contact</label>
                                                                <input required name="contact" id="contact" type="text"
                                                                       value=""
                                                                       data-validate="required,number,minlength[1],maxlength[11]"
                                                                       data-message-required="Contact Number is Required."
                                                                       class="form-control">
                                                        </div>
                                                    </div>
                                                    

                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="field-1"
                                                                   class="control-label">Address</label>
                                                                <input required name="address" id="address" type="text"
                                                                       value=""
                                                                       data-validate="required"
                                                                       data-message-required="Address is Required."
                                                                       class="form-control">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="field-1"
                                                                   class="control-label">City</label>
                                                                <input name="city" id="city" type="text" value=""
                                                                       class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="form-group">
                                                            <label for="field-1" class="control-label">Country</label>
                                                                <input name="country" id="country" type="text"
                                                                       value="" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3 postal_code">
                                                        <div class="form-group ">
                                                            <label for="field-1" class="control-label">Postal
                                                                Code</label>
                                                                <input required name="postal_code" id="post_code"
                                                                       type="text"
                                                                       value=""
                                                                       data-validate="required"
                                                                       data-message-required="Post Code is Required."
                                                                       class="form-control">
                                                        </div>
                                                    </div>

                                                    {{--<div class="col-sm-3" id="passenger">--}}
                                                    {{--<div class="form-group">--}}
                                                    {{--<label for="field-1" class="col-sm-12 control-label">Number of--}}
                                                    {{--passengers</label>--}}
                                                    {{--<div class="col-sm-12">--}}
                                                    {{--<select class="form-control bf-slctfld" name="passenger">--}}
                                                    {{--<option value="1">1</option>--}}
                                                    {{--<option value="2">2</option>--}}
                                                    {{--<option value="3">3</option>--}}
                                                    {{--<option value="4">4</option>--}}
                                                    {{--<option value="5">5</option>--}}
                                                    {{--<option value="6">6</option>--}}
                                                    {{--<option value="7">7</option>--}}
                                                    {{--<option value="8">8</option>--}}
                                                    {{--<option value="9">9</option>--}}
                                                    {{--<option value="10">10</option>--}}
                                                    {{--</select>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                </div>
                                                </form>
                                            </div>

                                            <div class="step-pane" data-step="4">
                                                <div class=" grid-box">
                                                    <h4>Flight and Car Details</h4>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="field-1" class="control-label">Departure
                                                                Flight
                                                                No</label>

                                                                <input name="dept_flight_no" id="dept_flight_no"
                                                                       type="text" value=""
                                                                       class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="field-1" class=" control-label">Return
                                                                Flight
                                                                No</label>

                                                                <input name="return_flight_no" id="return_flight_no"
                                                                       type="text" value=""
                                                                       class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="field-1" class="control-label">Outbond
                                                                Terminal</label>
                                                                <select name="departure_terminal"
                                                                        id="departure_terminal" type="text"
                                                                        data-validate="required"
                                                                        data-message-required="Departure Terminal No is Required."
                                                                        class="form-control">
                                                                    @foreach($terminals as $terminal)
                                                                        <option value="{{$terminal->id}}">{{ $terminal->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="field-1" class="control-label">Inbond
                                                                Terminal</label>
                                                                <select name="return_terminal" id="return_terminal"
                                                                        type="text" data-validate="required"
                                                                        data-message-required="Arrival Terminal is Required."
                                                                        class="form-control">
                                                                    @foreach($terminals as $terminal)
                                                                        <option value="{{$terminal->id}}">{{ $terminal->name }}</option>
                                                                    @endforeach

                                                                </select>
                                                        </div>
                                                    </div>
                                                    <div class="myflight clearBoth">
                                                        <div class="col-lg-3 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Vehicle
                                                                    Make</label>
                                                                    <input name="veh_make" id="veh_make" type="text"
                                                                           value="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Vehicle
                                                                    Model</label>
                                                                    <input name="veh_model" id="veh_model" type="text"
                                                                           value="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Vehicle
                                                                    Colour</label>
                                                                    <input name="veh_colour" id="veh_colour" type="text"
                                                                           value="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-12 col-sm-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class=" control-label">Vehicle
                                                                    Registration</label>
                                                                    <input name="veh_registration" id="veh_registration"
                                                                           type="text" value="" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>


                                            <div class="step-pane" data-step="5">
                                                <form id="payment_detail">
                                                    <div class="col-lg-12 grid-box">
                                                        <h4>Payment Details</h4>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Transaction
                                                                    Id:</label>
                                                                    <input required type="text" value=""
                                                                           name="transaction_id"
                                                                           id="transaction_id"
                                                                           data-validate="required"
                                                                           data-message-required="Transaction id is Required."
                                                                           class="form-control" required="">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <!--<div class="form-group">-->
                                                            <!--    <label for="field-1"-->
                                                            <!--           class="col-sm-12 control-label">Payzone:</label>-->
                                                            <!--    <div class="col-sm-12">-->
                                                            <!--        <input required type="radio" value="payzone"-->
                                                            <!--               name="payment_method"-->
                                                            <!--               data-validate="required"-->
                                                            <!--               data-message-required="Payment Method is Required."-->
                                                            <!--               class="form-control" style="width: 20%;">-->
                                                            <!--    </div>-->
                                                            <!--</div>-->
                                                        </div>
                                                        <div class="filter">
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                
                                                                <label for="field-1" class="control-label">Stripe:</label>
                                                                    <input name="payment_method" data-target="#block-2" type="radio"
                                                                           class="form-control filter-btn w-20-per" data-validate="required"
                                                                           data-message-required="Payment Method is Required."
                                                                           value="stripe">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <div class="form-group">
                                                                <label for="field-1"
                                                                       class="control-label">Cash:</label>
                                                                    <input name="payment_method"  data-target="#block-1" type="radio"
                                                                           value="cash"
                                                                           data-validate="required"
                                                                           data-message-required="Payment Method id is Required."
                                                                           class="form-control filter-btn active w-20-per">
                                                            </div>
                                                        </div>
                                                        
                                                         </div>
                                                    </div>
                                                </form>
                                                <div class="block-card" id="block-2">
                                            <!--<a class="btn btn-success" href="https://dashboard.stripe.com/login?redirect=%2Fpayment-links%2Fcreate%2Fstandard-pricing" target="_blank" rel="noopener noreferrer" style="margin-left:45%;text-decoration: none;color:white"> Create Stripe Payment Link</a>-->
                                                <a class="btn btn-success createStripeBtn" onclick="createPaymentLink()" target="_blank"> Create Stripe Payment Link</a>
                                                <div class="col-sm-12" id="paymentLinktxt">
                                                                    
                                                
                                                </div>
                                             </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="clearBoth"/>
                                    <div class="wizard-actions col-xs-12 col-sm-12">
                                        <button class="btn btn-prev">
                                            <i class="ace-icon fa fa-arrow-left"></i>
                                            Prev
                                        </button>

                                        <button class="btn btn-success btn-next" data-last="Finish">
                                            Next
                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                        </button>


                                    </div>
                                     


                                </div>


                            </div>

                        </div>


                        <!---sidebar right--->


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
                                        <div class="table-resonsive">
                                            <table class="table">
                                            <tbody>
                                            <tr>
                                                
                                                <th class="col-md-5">Airport</th>
                                                <td id="airport_txt" class="col-md-5">
                                                    @if($booking_detail!="" && $booking_detail->airport) {{ $booking_detail->airport->name }} @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Departure Date</th>
                                                <td id="deptdate_txt" class="col-md-5">
                                                    @if($booking_detail!="") {{ $booking_detail->departDate }} @endif

                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Return Date</th>
                                                <td id="returndate_txt" class="col-md-5">
                                                    @if($booking_detail!="") {{ $booking_detail->returnDate }} @endif
                                                </td>
                                            </tr>
                                            <tr style="display:none;">
                                                <th class="col-md-5">Company</th>
                                                <td id="company_txt" class="col-md-5">
                                                    @if($booking_detail!="" && $booking_detail->company) {{ $booking_detail->company->name }} @endif

                                                </td>
                                            </tr>
                                            <tr style="display:none;">
                                                <th class="col-md-5">Parking Type</th>
                                                <td id="parkingtype_txt" class="col-md-5">
                                                    @if($booking_detail && $booking_detail->company) {{ $booking_detail->company->parking_type }} @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total Days</th>
                                                <td id="totalNoDays_txt">
                                                    @if($booking_detail!="") {{ $booking_detail->no_of_days }} @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Booking Price</th>
                                                <td id="booking_price_txt" class="col-md-5">
                                                    @if($booking_detail!="") {{ $booking_detail->booking_amount }} @endif

                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Discount Amount</th>
                                                <td id="discount_amount"  class="col-md-5">
                                                    @if($booking_detail!="") {{'this'. $booking_detail->discount_amount}} @endif
                                                </td>
                                            </tr>

                                            <!--<tr class="tr-hide" style="display: none;">-->
                                            <!--    <th class="col-md-5">Discounted Booking Price</th>-->
                                            <!--    <td id="discounted_price_txt" class="col-md-5"-->
                                            <!--        style="font-weight: bold; font-size: 16px;">-->
                                            <!--        @if($booking_detail!="") {{ $booking_detail->discount_amount }} @endif-->

                                            <!--    </td>-->
                                            <!--</tr>-->
                                            <!--<tr class="tr-hide" >-->
                                            <!--    <th class="col-md-5">Discount Price</th>-->
                                            <!--    <td id="discount_amount" class="col-md-5">@if($booking_detail!="") {{ $discount_amount }} @endif</td>-->
                                            <!--</tr>-->
                                            <tr>
                                                <th class="col-md-5">Cancel Price</th>
                                                <td id="cancel_price_txt" class="col-md-5">@if($booking_detail!="") {{ $booking_detail->cancelfee }} @endif</td>
                                            </tr>
                                            <tr>
                                                <th class="col-md-5">Sms Price</th>
                                                <td id="sms_price_txt" class="col-md-5">@if($booking_detail!="") {{ $booking_detail->smsfee }} @endif</td>
                                            </tr>
                                            {{--<tr>--}}
                                            {{--<th class="col-md-5">Postal Price</th>--}}
                                            {{--<td id="postal_price_txt" class="col-md-5"></td>--}}
                                            {{--</tr>--}}
                                            {{--<tr>--}}
                                            {{--<th class="col-md-5">Adjustment Price</th>--}}
                                            {{--<td id="extra_price_txt" class="col-md-5"></td>--}}
                                            {{--</tr>--}}
                                            <tr>
                                                <th class="col-md-5">Booking Fee</th>
                                                <td id="booking_fee_txt" class="col-md-5">@if($booking_detail!="") {{ $booking_detail->booking_fee }} @endif</td>
                                            </tr>

                                            <tr>
                                                <th class="col-md-5">Total Price</th>
                                                <td id="total_price_txt" class="col-md-5">@if($booking_detail!="") {{ $booking_detail->total_amount }} @endif</td>
                                            </tr>
                                            </tbody>


                                        </table>
                                        </div>
                                        <form id="bookingDetails">
                                            <input type="hidden" name="company_code" id="company_code" value=""/>
                                            <input type="hidden" name="company_name" id="company_name" value=""/>
                                            <input type="hidden" name="product_code" id="product_code" value=""/>
                                            <input type="hidden" name="company_id" id="company_id" value=""/>
                                            <input type="hidden" name="parking_type" id="parking_type" value=""/>
                                            <input type="hidden" name="discounted_amount" id="discounted_amount"value=""/>
                                            <input type="hidden" name="p_booking_amount" id="p_booking_amount" value=""/>
                                            <input type="hidden" name="cancelFEE" id="cancelFEE" value=""/>
                                            <input type="hidden" name="extraAmount" id="extraAmount" value=""/>
                                            <input type="hidden" name="smsFEE" id="smsFEE" value=""/>
                                            <input type="hidden" name="postalFEE" id="postalFEE" value=""/>
                                            <input type="hidden" name="add_extra" id="add_extra" value="0"/>
                                            <input type="hidden" name="bookingFEE" id="bookingFEE" value=""/>
                                            <input type="hidden" name="totalAMOUNT" id="totalAMOUNT" value="0"/>
                                            <input type="hidden" name="no_of_days" id="no_of_days" value="0"/>
                                            <input type="hidden" name="h_totalAMOUNT" id="h_totalAMOUNT" value="0"/>
                                            <input type="hidden" name="booking_extra_sys" id="booking_extra_sys" value=""/>
                                            <input type="hidden" name="paymentLink" id="paymentLink" value=""/>
                                                                                          </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <!-- /.span -->
                </div><!-- /.row -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>

@endcan
@endsection
@section("footer-script")
<script>
    let $blocks = $('.block-card');

$('.filter-btn').on('click', e => {
  let $btn = $(e.target).addClass('active');
  $btn.siblings().removeClass('active');
  
  let selector = $btn.data('target');
  $blocks.removeClass('active').filter(selector).addClass('active');
});

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->


    <script src="{{ secure_asset("assets/js/moment.min.js") }}"></script>
    <script src="{{ secure_asset("assets/js/daterangepicker.min.js") }}"></script>
    <script src="{{ secure_asset("assets/js/bootstrap-datetimepicker.min.js") }}"></script>

    <script src="{{ secure_asset("assets/js/bootstrap-datepicker.min.js") }}"></script>
    <script src="{{ secure_asset("assets/js/bootstrap-timepicker.min.js") }}"></script>


    <!-- page specific plugin scripts -->
    <script src="{{ secure_asset("assets/js/wizard.min.js") }}"></script>
    <script src="{{ secure_asset("assets/js/jquery.validate.min.js") }}"></script>
    <script src="{{ secure_asset("assets/js/jquery-additional-methods.min.js") }}"></script>
    <script src="{{ secure_asset("assets/js/bootbox.js") }}"></script>
    <script src="{{ secure_asset("assets/js/jquery.maskedinput.min.js") }}"></script>
    <script src="{{ secure_asset("assets/js/select2.min.js") }}"></script>

    <script src="https://getaddress.io/js/jquery.getAddress-2.0.8.min.js"></script>

    <script type="text/javascript">

        $('#postcode_lookup').getAddress({
            api_key: '{{ $settings["address_key"] }}',
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

            <!--  Optionally register callbacks at specific stages -->
            onLookupSuccess: function (data) {/* Your custom code */
                $('#ad_field').hide();
            },
            onLookupError: function () {/* Your custom code */

                // $('#postcode_lookup').hide();
                $('#ad_field').hide();


                $("#postcode_lookup").append('<button id="nolist" type="button" class="btn text-center btn-yellow" >Address Not Listed</button><script>$("#nolist").bind("click",function(){$("#ad_field").show(); $("#getaddress_input").hide(); $("#getaddress_button").hide(); $("#getaddress_error_message").hide(); });<\/script>');


            },
            onAddressSelected: function (elem, index) {/* Your custom code */
                //$('#ad_field').show();
            }
        });
        var isSelected = 0;

        function get_parking_prices() {
            var departure_date = $('#dep_date').val();
            var return_date = $('#return_date').val();
            var departure_time = $('#departure_time').val();
            var return_time = $('#return_time').val();
            var airportid = $('#airport_id').val();
            var promo = $('#promo').val();
            //if (airportid == '') {

            var data = {};
            data['dropoffdate'] = departure_date;
            data['dropoftime'] = departure_time;

            data['pickup_date'] = return_date;
            data['pickup_time'] = return_time;
            data['airport_id'] = airportid;
            data['_token'] = '{{ @csrf_token() }}';
            data['promo'] = promo;
            // data['action'] = 'getbookingPrice';
            $('#loading').css("display", "block");
            $.ajax({
                type: 'post',
                data: data,
                async: false,
                url: '{{ route("getQuote") }}',
                beforeSend: function () {
                    // $('#loading').css("display","block");
                },
                complete: function () {
                    // $('#loading').hide();
                },

                success: function (msg) {
                    $("#step_2_companies").html(msg);
                    $("#step_2_companies div.companies-listing").addClass('table-responsive');
                    $('#loading').css("display", "none");
                    //debugger;
//                    var obj = msg;
//                    //var obj = $.parseJSON(msg);
//                    $("#no_of_days").val(obj.total_days);
//                    $("#totalNoDays_txt").text(obj.total_days);
//                    $("#airport_txt").text(obj.airport);
//                    $("#deptdate_txt").text(departure_date + ' ' + departure_time);
//                    $("#returndate_txt").text(return_date + ' ' + return_time);
//                    //$('#overlay').show();
//                    // jQuery.noConflict();
//                    $('#cdetails-modal').modal('show', {backdrop: 'static'});
//                    $('#cdetails-modal .modal-body').html(obj.html);
                }
            });
            //}
        }

        function selectCompany(id) {
            isSelected = 1;
            var x = $('#cform' + id).serializeArray();
            var obj = JSON.parse(JSON.stringify($('#cform' + id).serializeArray()));
           console.log(obj);
            //$('#cdetails-modal').modal('hide');
            $('#company_id').val(obj[0].value);  //company id

            $('#company_txt').text(obj[1].value);  //company name
            $('#company_name').val(obj[1].value);  //company name
            $('#parkingtype_txt').text(obj[2].value);  //parking type
            $('#parking_type').val(obj[2].value);  //parking type
            $('#booking_price_txt').text(obj[3].value); //booking price
            $('#p_booking_amount').val(obj[3].value); //booking price
            $('#discount_amount').text(obj[8].value); //discount price
            $('#discounted_amount').val(obj[8].value); //discount price
            $('#cancel_price_txt').text(obj[5].value);  //cancel price
            $('#cancelFEE').val(obj[5].value);  //cancel price
            $('#booking_fee_txt').text(obj[6].value); //booking fee
            $('#bookingFEE').val(obj[6].value); //booking fee
            $('#total_price_txt').text(obj[7].value); //total price
            $('#totalAMOUNT').val(obj[7].value); //total price
            $('#h_totalAMOUNT').val(obj[7].value); //total price
            $('#extraAmount').val(0); //total price


            $('#airport_txt').text(obj[9].value);  //company id
            $('#deptdate_txt').text(obj[10].value);  //company id
            $('#returndate_txt').text(obj[11].value);  //company id
            $('#totalNoDays_txt').text(obj[15].value);  //company id
            $('#no_of_days').val(obj[15].value);  //company id
            $('#sms_price_txt').text(0); 

            $('#company_code').text(obj[17].value);  //company id
            $('#product_code').text(obj[18].value) //company id
             $('#company_code').val(obj[17].value);  //company id
            $('#product_code').val(obj[18].value) //company id

            getTerminals($('#airport_id').val());
            get_extra_prices();
            //$('#airport_txt').text(obj[0].value);  //company id
//            if(obj[4].value > 0.00){
//                $('#discount_price_txt').text(obj[4].value); //discount price
//                $('#discounted_price_txt').text(obj[8].value); //total price
//                $('.tr-hide').show();
//            }
//            if(obj[9].value == 1){
//                $('#passenger').show();
//            }else{
//                $('#passenger').hide();
//            }
//            $('#sms_postal_box').show();
            // get_extra_prices();


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

        jQuery(function ($) {


            $('#add_extra').on('keyup blur', function () {
                get_extra_prices();
            });
            $('#sms_fee').click(function () {
                get_extra_prices();
            });
            $('#postal_fee').click(function () {
                get_extra_prices();
            });
            $('#cancel_fee').click(function () {
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
            }).on('focus', function () {
                $('#return_time').timepicker('showWidget');
            }).next().on(ace.click_event, function () {
                $(this).prev().focus();
            });


            $('.date-picker').datepicker({
                autoclose: true,
                todayHighlight: true,
                startDate: new Date()
            })
            //show datepicker when clicking on the icon
                .next().on(ace.click_event, function () {
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
            }).on('focus', function () {
                $('#departure_time').timepicker('showWidget');
            }).next().on(ace.click_event, function () {
                $(this).prev().focus();
            });

//            var date = new Date();
//            date.setDate(date.getDate()-1);
//            if (!ace.vars['old_ie'])
//
//                $('#dep_date').datetimepicker({
//                format: 'MM/DD/YYYY',//use this option to display seconds
//                    startDate: date,
//                icons: {
//                    time: 'fa fa-clock-o',
//                    date: 'fa fa-calendar',
//                    up: 'fa fa-chevron-up',
//                    down: 'fa fa-chevron-down',
//                    previous: 'fa fa-chevron-left',
//                    next: 'fa fa-chevron-right',
//                    today: 'fa fa-arrows ',
//                    clear: 'fa fa-trash',
//                    close: 'fa fa-times'
//                }
//            }).next().on(ace.click_event, function () {
//                $(this).prev().focus();
//            });
//
//
//            $('#return_date').datetimepicker({
//                format: 'MM/DD/YYYY',//use this option to display seconds
//                startDate: date,
//                icons: {
//                    time: 'fa fa-clock-o',
//                    date: 'fa fa-calendar',
//                    up: 'fa fa-chevron-up',
//                    down: 'fa fa-chevron-down',
//                    previous: 'fa fa-chevron-left',
//                    next: 'fa fa-chevron-right',
//                    today: 'fa fa-arrows ',
//                    clear: 'fa fa-trash',
//                    close: 'fa fa-times'
//                }
//            }).next().on(ace.click_event, function () {
//                $(this).prev().focus();
//            });

        });

        //company_email_div
        function getTerminals(airport) {

            var data = {};
            data['id'] = airport;
//data['action'] = 'getTerminals';
            $.ajax({
                type: 'get',
// data: data,
                @if($edit==1)
                    url: '{{ url("../admin/company/getTerminals") }}/' + airport,
                @else
                    url: '{{ url("admin/company/getTerminals") }}/' + airport,
                @endif

                success: function (msg) {
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
            .on('actionclicked.fu.wizard', function (e, info) {
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
            .on('finished.fu.wizard', function (e) {
                //data submit start
                var data = {};
                data['airport_id'] = $('#airport_id').val();
                data['dep_date'] = $('#dep_date').val();
                data['departure_time'] = $('#departure_time').val();
                data['return_date'] = $('#return_date').val();
                data['return_time'] = $('#return_time').val();
                data['promo'] = $('#promo').val();

                  data['title'] = $('#title').val();
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
                

                 data['company_code'] = $('#bookingDetails input[name="company_code"]').val();
                 data['product_code'] = $('#bookingDetails input[name="product_code"]').val();
                 data['company_name'] = $('#bookingDetails input[name="company_name"]').val();
                data['company_id'] = $('#bookingDetails input[name="company_id"]').val();
                data['parking_type'] = $('#bookingDetails input[name="parking_type"]').val();
                data['discounted_amount'] = $('#bookingDetails input[name="discounted_amount"]').val();
                data['p_booking_amount'] = $('#bookingDetails input[name="p_booking_amount"]').val();
                data['postalFEE'] = $('#bookingDetails input[name="postalFEE"]').val();
                data['bookingFEE'] = $('#bookingDetails input[name="bookingFEE"]').val();
                data['add_extra'] = $('#bookingDetails input[name="add_extra"]').val();
                data['totalAMOUNT'] = $('#bookingDetails input[name="totalAMOUNT"]').val();
                data['h_totalAMOUNT'] = $('#bookingDetails input[name="h_totalAMOUNT"]').val();

                data['no_of_days'] = $('#bookingDetails input[name="no_of_days"]').val();
                data['airport'] = $('#bookingDetails input[name="airport"]').val();
                data['paymentLink'] = $('#bookingDetails input[name="paymentLink"]').val();
                data['_token'] = '{{ csrf_token() }}';

                data['smsFEE'] = $("#smsFEE").val();
                data['cancelFEE'] = $("#cancelFEE").val();
               
                data['passenger'] = 1;
                var url = '{{ route("admin_add_booking") }}';
                @if($type=="edit")
                    url = '{{ route("admin_update_booking",[$id]) }}';
                @endif


                $.post(url, data, function (data) {


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


            }).on('stepclick.fu.wizard', function (e) {
            //e.preventDefault();//this will prevent clicking and selecting steps
        });
        
        
        
//         function createPaymentLink() {

//             var price = {};
//             price = $('#bookingDetails input[name="totalAMOUNT"]').val();
//           $.ajax({
//                 url: "{{ route('createPaymentLink') }}/"+price,
//                 type: 'POST',
//                 dataType: 'json',
//                 success: function(response){
//                   console.log(response);
//                  }
//                 });
             
//   }
  
  
        function createPaymentLink() {

            

            var data = {
                price : $('#bookingDetails input[name="totalAMOUNT"]').val(),
                company : $('#bookingDetails input[name="company_name"]').val()
                

            };

            data['_token'] = "{{ csrf_token() }}";

            //setProcessBar(75);

            $.post('../booking/add/createPaymentLink', data, function (data) {
                
                $("#paymentLink").val(data);
                $("#paymentLinktxt").text(data);


                

            }, 'json');

        }
        
        
        

    </script>

@endsection