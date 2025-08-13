@if (\Request::is('main'))  
@else
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endif
@extends('layouts.main')
@section("stylesheets")
    <link property="stylesheet" rel='stylesheet' href='{{ secure_asset("assets/page.css") }}' type='text/css' media='all'/>
    <link rel="stylesheet" href="{{  secure_asset("assets/payzone/payzone_gateway.css?v=1.2") }}"/>
@endsection
@section('content')

  <style type="text/css">
  body{
      background: white;
  }
  .booking-heading{
      padding: 30px;
    text-align: center;
  }
.side-bar .row div[class*="col-"] {
    margin-top: 15px;
    font-weight: bold!important;
}
#getaddress_button {
    float: left!important;
    height: 50px;
}
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
      width: 59%;
    border-radius: 50px !important
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
.btn-warning 
{
    color: #111;
    background-color: #fa9e1b;
}
.btn-yellow
{
    color: #fff;
    background-color: #fa9e1b;
}

.email
{
    height: 22px;width: 25%!important;margin-right: 1%;margin: 1.6%;border: none; outline: none;padding-left: 15px;padding-right: 15px;font-size: 13px; font-weight: 600; color: #929191; border-radius: 0px;
}

.order{
    margin: 5px;
    height: 28px;
    position: absolute;
    text-align: center;
    /* opacity: 1; */
    background: #f99f03!important;
    color: #fff;
    -webkit-animation: bounce .3s infinite alternate;
    -moz-animation: bounce .3s infinite alternate;
    animation: bounce .3s infinite alternate;
    -webkit-animation-iteration-count: 1;
    -moz-animation-iteration-count: 1;
    animation-iteration-count: 1;
}
    .side-bar .row div[class*="col-"] {
    margin-top: 15px;
    font-weight: bold!important;
	color:#444;
}
#getaddress_button {
    float: left!important;
    height: 50px;
}
.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid #ccc;
  border-radius: 4px;
  background-color: #fde4e4;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}
.btn-warning 
{
    color: #111;
    background-color: #fa9e1b;
}
.btn-yellow
{
    color: #fff;
    background-color: #fa9e1b;
}

.email
{
    height: 22px;width: 25%!important;margin-right: 1%;margin: 1.6%;border: none; outline: none;padding-left: 15px;padding-right: 15px;font-size: 13px; font-weight: 600; color: #929191; border-radius: 0px;
}
#creditDiv hr {margin-top:20px !important; border-top:1px solid #ccc !important;}
.order{
    margin: 5px;
    height: 28px;
    position: absolute;
    text-align: center;
    /* opacity: 1; */
    background: #f99f03!important;
    color: #fff;
    -webkit-animation: bounce .3s infinite alternate;
    -moz-animation: bounce .3s infinite alternate;
    animation: bounce .3s infinite alternate;
    -webkit-animation-iteration-count: 1;
    -moz-animation-iteration-count: 1;
    animation-iteration-count: 1;
}
select.form22{height:35px; border-radius:4px; border:solid 1px #bbb; color:#555; width:100%;}
.paymentFrm{
	margin-top:20px;
}
.btn-group-lg>.btn, .btn-lg {
    line-height: 0.5;
}
.col-lg-4{
	margin-top: 12px;
}
.form-control {
    background: #EEEEEE !important;
    border-radius: 50px !important;
    border: none;
    height: 45px !important;
}
.jusfify-cent{
    justify-content: center;
    display: flex;
}
.badge-warning{
    background-color: rgb(28 40 63/63%);
    padding: 8px !important;
    margin-top: 14px;
    border-radius: 50px !important;
}
.weaccept-marginleft h4{
    color: #1C283F;
    font-size: 21px;
    font-weight: 700;
    text-align: center;
}
@media only screen and (min-width: 350px){
#bookingButton {
    padding: 10px 53px;
}
}
#bookingButton{
    margin-bottom: 20px !important;
}
</style>
    <div class="home-container home-background">
        {{-- @include("frontend.header") --}}

    </div><!-- end home-container -->
    <section id="room-listings" class="innerpage-wrapper margintop110">

        <div id="room-listing-blocks" class="innerpage-section-padding">

            <div class="container margintop59">

                <div class="row frombgbooking" >

                    <div class="col-xs-12 col-sm-12 col-md-12" id="bookingheader" >
                            <!--<h4 class="frombgbookingh4">Booking Detail Form</h4>-->
                        </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-md-push-8 col-lg-push-8 col-lg-4 side-bar" style="margin: 0;">

                        <div class="row" style="margin-top: 4px;">

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding: 0px;margin: 0px">
                                     <div style="background-color: white; padding:20px;box-shadow: 2px 5px 4px #00000070;border: 3px solid #FAB03F;border-radius: 34px;margin: 0 10px;">
                                <h3 class="booking-heading"><span><i
                                                    style="font-size: 26px;margin-right: 10px;" class="fa fa-shopping-cart"></i></span> Booking Detail 
                                                    </p>
                                </h3>
                                <div class="side-bar-block support-block1">
									<div class="row">
                                        <div class="col-12" class="head-text-bookingdetail">
                                        	<p class="text-center" id="company_name"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-4" class="head-text-bookingdetail">Drop-Off</div>
                                        <div class="col-xs-6 col-md-8" style="padding-left:0px;">
                                            <p class="text-right" style="font-size: 14px;">{{ \Carbon\Carbon::parse($data["dropdate"])->format('D d M Y') }}
                                                at {{ $data["droptime"] }}</p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-4" class="head-text-bookingdetail">Return</div>
                                        <div class="col-xs-6 col-md-8" style="padding-left:0px;">
                                            <p class="text-right"
                                               style="font-size: 14px;">{{ \Carbon\Carbon::parse($data["pickdate"])->format('D d M Y') }}
                                                at {{ $data["picktime"] }}</p>
                                        </div>
                                    </div>
                                    <hr/>
									<div class="row">
                                        <div class="col-xs-6 col-md-6" class="head-text-bookingdetail">No of Days</div>

                                        <div class="col-xs-6 col-md-6" style="padding-left:0px;">

                                            <p class="text-right" style="font-size: 14px;">{{ $data["total_days"] }}</p>

                                        </div>

                                    </div>

                                    <hr/>
                                    <div class="row">
                                        <div class="col-xs-6 col-md-6" class="head-text-bookingdetail">Booking Price

                                        </div>

                                        <div class="col-xs-6 col-md-6" style="padding-left:0px;">

                                            <p class="text-right" style="font-size: 14px;">

                                                £{{ $data["booking_amount"]+$data["discount_amount"] }}</p>

                                        </div>

                                    </div>

                                    <hr/>

                                    @if($data["discount_amount"]>0)

                                    <div class="row">

                                        <div class="col-xs-6 col-md-6" class="head-text-bookingdetail">Discount price</div>

                                        <div class="col-xs-6 col-md-6" style="padding-left:0px;">

                                            <p class="text-right" style="font-size: 14px;">- £{{ $data["discount_amount"] }}</p>

                                        </div>
                                    </div>

                                    <hr/>

                                    @endif

                                    <div style="clear: both"></div>
                                </div><!-- end side-bar-block -->

                                <h3 style="padding:13px 20px 13px !important" class="booking-heading"

                                    id="bookingDetails">

                                    Total to pay
                           
                                    &pound; <span id="totalPrice">53.99</span>

                                    <input type="hidden" id="bookingprice" value="{{ $data["booking_amount"] }}"/>

                                    <input type="hidden" id="alltotal" value="{{ $data["booking_amount"] }}"/>

                                    <input type="hidden" id="disAmount" name="discount_amount" value="{{ $data["discount_amount"] }}">

                                    <input type="hidden" name="company_id" value="{{ $data["company_id"] }}">
                                    <input type="hidden" name="product_code" value="{{ $data["product_code"] }}">
                                    <input type="hidden" name="referenceNo" value="{{ $data["referenceNo"] }}">

                                    <input type="hidden" name="parking_type" value="{{ $data["parking_type"] }}">

                                    <input type="hidden" name="pickdate" value="{{ $data["pickdate"] }}">

                                    <input type="hidden" name="dropdate" value="{{ $data["dropdate"] }}">

                                    <input type="hidden" name="droptime" value="{{ $data["droptime"] }}">

                                    <input type="hidden" name="picktime" value="{{ $data["picktime"] }}">

                                    <input type="hidden" name="total_days" value="{{ $data["total_days"] }}">

                                    <input type="hidden" name="airport" value="{{ $data["airport"] }}">

                                    <input type="hidden" name="promo" value="{{ $data["discount_code"] }}">

                                    <input type="hidden" name="pl_id" value="{{ $data["pl_id"] }}">

                                    {{--<input type="hidden" name="sku" value="{{ $settings["airport"] }}">--}}

                                    <input type="hidden" name="site_codename" value="">

                                    {{--<input type="hidden" name="speed_park_active" value="{{ $settings["airport"] }}">--}}

                                    {{--<input type="hidden" name="edin_active" value="{{ $settings["airport"] }}">--}}

                                    {{--<input type="hidden" name="edin_search" value="{{ $settings["airport"] }}">--}}

                                    <input type="hidden" name="bookingfor" value="airport_parking">

                                    <input type="hidden" name="incomplete" id="incomplete" value="yes">

                                    <!--<input type="hidden" name="aphactive" id="aphactivebook" value="{{ $data["aphactive"] }}">-->
                                </h3>
                                </div>
                            </div><!-- end columns -->

                        </div><!-- end row -->
                    </div><!-- end columns -->

                    <div class="col-xs-12 col-sm-12 col-md-pull-4 col-lg-8 col-md-8 col-lg-pull-4">
                        <ul id="room-list" class="list-unstyled" style="border: 3px solid #FAB03F;border-radius: 34px;">

                            <li id="room-list-1">

                                <form id="personal_details_form">

                                    <div class="room-list-block">

                                        <div class="row">

                                            <div class="col-xs-12  col-sm-12  col-md-12  col-lg-12 room-text room-text-padding" >

                                                <div class="">

                                                    <h3 class="booking-heading">Personal Details</h3>

                                                    <div class="col-lg-12">
                                                        <div class="row">
                                                        <div class="col-lg-2 setgenderwidth">

                                                            <label>Title</label>

                                                            <select required class="bf-slctfld bookingselect_height form-control" name="gender" id="title">

                                                                <option value="Mr" @if($data['title']=='Mr') selected="" @endif>Mr</option>

                                                                <option value="Mrs" @if($data['title']=='Mrs') selected="" @endif>Mrs</option>

                                                                <option value="Miss" @if($data['title']=='Miss') selected="" @endif>Miss</option>

                                                                <option value="Ms" @if($data['title']=='Ms') selected="" @endif>Ms</option>

                                                            </select>

                                                        </div>

                                                        <div class="col-lg-5">

                                                            <label>First Name</label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control bf-inptfld" required type="text" name="firstname" id="firstname" value="{{$data['firstname']}}">

                                                        </div>

                                                        <div class="col-lg-5">

                                                            <label>Last Name</label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control bf-inptfld" type="text" name="lastname" required id="lastname" value="{{$data['lastname']}}">

                                                        </div>

                                                        <div class="col-lg-4">

                                                            <label>Email Address</label>

                                                            <span class="required-field">*</span>

                                                            &nbsp;&nbsp;<span class="fa fa-info-circle cls-pointer" data-toggle="tooltip" data-placement="top" title="This is the email address you will recieve confirmation which includes booking reference and parking procedures"></span>

                                                            <input email="true" class="form-control bf-inptfld"

                                                                   type="text" name="email"

                                                                   id="email" required value="{{$data['email']}}">

                                                        </div>

                                                        <div class="col-lg-4">

                                                            <label>Confirm Email Address</label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control bf-inptfld" type="text"

                                                                   email="true"

                                                                   equalTo="#email"

                                                                   name="c_email" id="c_email" required value="{{$data['email']}}">

                                                        </div>

                                                        <div class="col-lg-4">

                                                            <label>Mobile Number</label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control bf-inptfld" type="text"

                                                                   name="contactno" id="contactno" required

                                                                   value="{{$data['phone_number']}}">

                                                        </div>

                                                    </div>
                                                    
                                                </div><!-- end room-info -->

                                            </div><!-- end columns -->

                                        </div><!-- end row -->

                                    </div><!-- end room-list-block -->

                                </form>

                            </li><!-- end list-item -->

							<hr/>
                            <li id="room-list-1">

                                <div class="room-list-block">

                                    <div class="row">

                                        <form id="vechile_detail">

                                            <div class="col-xs-12  booking-vehdetal col-sm-12  col-md-12  col-lg-12 room-text" >

                                                <div class="">

                                                    <h3 class="booking-heading">Vehicle Details

                                                    </h3>

                                                    <div class="col-sm-12 col-xs-12 col-md-12 col-lg-12 ">

                                                        <label class="inputdefault"><span class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"

                                                        title="We will set your vehicle details to be confirmed if you select No. You can add these details at a later stage by either logging in to your account or by calling customer services."></span>

                                                            Do you have Vehicle details? &nbsp;&nbsp;

                                                        </label>

                                                        <br class="hidde-md hidden-lg">

                                                        <label for="inputdefault">

                                                            <input class="flightdetailsyes1" name="vehdetails"  id="yes" type="radio" value="Yes"/>

                                                            Yes</label>

                                                        <label for="inputdefault">

                                                            <input class="flightdetailsyes1" checked="checked"

                                                                   name="vehdetails" id="no"

                                                                   type="radio" value="No"/>

                                                            No</label>



                                                        <p class="hidden-md hidden-lg"></p>

                                                    </div>

                                                    <div class="clearfix"></div>



                                                    <div class="row margin15" id="vechile-detail"

                                                         style="display: none;">

                                                        <div class="col-lg-3 margin-vehicle">

                                                            <label class="normal-font">Vehicle Registration</label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control bf-inptfld" type="text"

                                                                   name="registration" id="registration"

                                                                   placeholder="Registration Number" value=""/>

                                                        </div>

                                                        <div class="col-lg-3">

                                                            <label class="normal-font">Vehicle Make</label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control bf-inptfld" type="text"

                                                                   name="make"

                                                                   id="make" placeholder="Make" value=""/>

                                                        </div>

                                                        <div class="col-lg-3">

                                                            <label class="normal-font">Vehicle Colour</label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control bf-inptfld" type="text"

                                                                   name="color"

                                                                   id="color" placeholder="Colour" value=""/>

                                                        </div>

                                                        <div class="col-lg-3">

                                                            <label class="normal-font">Vehicle Model</label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control bf-inptfld" type="text"

                                                                   name="model"

                                                                   id="model" placeholder="Model" value=""/>

                                                        </div>

                                                    </div>





                                                </div><!-- end room-info -->

                                            </div><!-- end columns -->

                                        </form>

                                    </div><!-- end row -->

                                </div><!-- end room-list-block -->

                            </li><!-- end list-item -->


							<hr/>
							
							



                            <li id="room-list-1">

                                <form id="travel_detail">

                                    <div class="room-list-block">

                                        <div class="row">

                                            <div class="col-xs-12 booking-vehdetal  col-sm-12  col-md-12  col-lg-12 room-text">

                                                <div class="">

                                                    <h3 class="booking-heading">Travel Details  </h3>

                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">

                                                        <label class="inputdefault"><span class="fa fa-info-circle cls-pointer" data-toggle="tooltip" data-placement="top"

                                                                    title="We will set your travel details to be confirmed if you select No. You can add these details at a later stage by either logging in to your account or by calling customer services."></span>

                                                            Do you have Travel details? </label>&nbsp;&nbsp;

                                                        <br class="hidde-md hidden-lg">

                                                        <label for="inputdefault">

                                                            <input class="flightdetailsyes" name="flightdetails" id="yes" type="radio" value="Yes"/>

                                                            Yes

                                                        </label>

                                                        <label for="inputdefault">

                                                            <input class="flightdetailsyes" checked="checked" name="flightdetails" id="no" type="radio" value="No"/>

                                                            No

                                                        </label> .<br class="hidde-md hidden-lg">

                                                    </div>

                                                    <div class="clearfix"></div>



                                                    <div class="row margin15" id="travel-detail" style="display: none; margin: 5px;">
                                                        <div class="d-flex">
                                                        
                                                            <div class="col-lg-4 margin-travel">
    
                                                                <label class="normal-font">Drop-Off Terminal:</label><span class="required-field"> *</span>
    
                                                                <select class="form22 bf-slctfld form-control" id="departterminal" name="departterminal">
    
                                                                    <option value="" selected="">Select Terminal</option>
    
                                                                    @foreach($terminals as $terminal)
    
                                                                        <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
    
                                                                    @endforeach
    
                                                                </select>
    
                                                            </div>
    
                                                            <div class="col-lg-4" id="return_terminal1">
    
                                                                <label class="normal-font">Return Terminal:</label><span
    
                                                                        class="required-field"> *</span>
    
                                                                <select class="form22 bf-slctfld form-control" id="arrivalterminal"
    
                                                                        name="arrivalterminal">
    
                                                                    <option value="" selected="">Select Terminal</option>
    
                                                                    @foreach($terminals as $terminal)
    
                                                                        <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
    
                                                                    @endforeach
    
                                                                </select>
    
                                                            </div>
    
                                                            <div class="col-lg-4" id="return_terminal">
    
                                                                <label class="normal-font">Return Flight Number:</label>
    
                                                                <input type="text" class="form-control bf-inptfld"
    
                                                                       name="returnflight" id="returnflight"
    
                                                                       placeholder="Optional" value=""/>
    
                                                            </div>
                                                        </div>
                                                    </div>





                                                </div><!-- end room-info -->

                                            </div><!-- end columns -->

                                        </div><!-- end row -->

                                    </div><!-- end room-list-block -->

                                </form>

                            </li><!-- end list-item -->



							<hr/>
							<li id="room-list-1">

                                <div class="room-list-block">

                                   <div class="row" style="padding: 15px;">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h3 class="booking-heading">Explore Additional Services</h3>
                            
                                <div class="row clear-padding add-extra-smscncl" style="padding-left: 10px;">
                                    <label style="font-size: 16px;font-weight: 500;color: #667085;padding-left: 0px;padding-right: 0px;">
                                        <input class="feeinput" type="checkbox" id="smsfee" name="smsfee" value='{{ $settings['sms_notification_fee'] }}'> Add SMS
                                        confirmation at only £{{ $settings['sms_notification_fee'] }} &nbsp;<span class="fa fa-info-circle cls-pointer" data-toggle="tooltip" data-placement="top"
                                            title="Why not have your booking details sent direct to your mobile, for a quick and easy check in."></span>
                                    </label>
                                </div>
                                <div class="row  clear-padding add-extra-smscncl" style="padding-left: 10px;">
                                    <label style="font-size: 16px;font-weight: 500;color: #667085;padding-left: 0px;padding-right: 0px;">
                                        <input class="feeinput" type="checkbox" id="cancelfee" name="cancelfee" value='{{ $settings['cancellation_fee'] }}'> Add Cancellation
                                        Cover at only £{{ $settings['cancellation_fee'] }}&nbsp;<span class="fa fa-info-circle cls-pointer" data-toggle="tooltip" data-placement="top"
                                            title="Our cancellation cover protects you if you do need to cancel or amend your booking."></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                                </div>

                            </li>


							<hr/>

                            <li id="room-list-1">

                                <div class="room-list-block">

                                    <div class="row">

                                        <div class="col-xs-12 booking-vehdetal col-sm-12  col-md-12  col-lg-12 room-text"

                                            >

                                            <div class="">

                                                <h3 class="booking-heading">Payment Detail</h3>





                                                <div class="weaccept-marginleft">

                                                    <h4>We Accept</h4>





                                                @if($settings["payment_type"]=='stripe')

                                                        <img class="img-responsive" style="    display: block; max-width: 50%;  height: auto; margin: auto;"  src="{{ secure_asset("assets/payzone/images/payzone_cards_accepted.png") }}"></div>

                                                    <div class="paymentFrm" id="paymentFrm">

                                                        <form method="post">

                                                            {{ csrf_field() }}

                                                            <div id="creditDiv">



                                                                <a class="reset" href="#">



                                                                </a>





                                                                <div class="col-lg-12 margin15">



                                                                    <div class="col-lg-6" style="display: none;">

                                                                        <label>Card Number </label>

                                                                        <span class="required-field">*</span>

                                                                        <div class="form-control bf-inptfld empty"

                                                                             type="text"

                                                                             id="cc_card_no" name="card_no"

                                                                             style=""></div>

                                                                        <div class="baseline"></div>

                                                                    </div>

                                                                    <div class="col-lg-6" style="display: none;">

                                                                        <label>Card Holder Name </label>

                                                                        <span class="required-field">*</span>

                                                                        <input class="form-control empty" type="text"



                                                                               id="cc_card_title"

                                                                               name="card_title"> </input>

                                                                        <div class="baseline"></div>

                                                                    </div>

                                                                </div>

                                                                <div class="col-lg-12 margin15" style="display: none;">

                                                                    <div class="col-lg-6">

                                                                        <label>Expiry Month / Year</label>

                                                                        <span class="required-field">*</span>





                                                                        <div class="form-control empty bf-inptfld"

                                                                             id="expiry_year">Expiration

                                                                        </div>



                                                                        <div class="baseline"></div>

                                                                    </div>

                                                                    <div class="col-lg-6">

                                                                        <label>Security Code</label>

                                                                        <span class="required-field">*</span>

                                                                        <div class="form-control bf-inptfld empty"

                                                                             type="text"

                                                                             id="cc_security_code"

                                                                             name="security_code"></div>

                                                                        <small>Enter the last 3 digit code on the back

                                                                            of

                                                                            your

                                                                            card

                                                                        </small>

                                                                        <div class="baseline"></div>

                                                                    </div>

                                                                </div>




                                                                <div class="card_chrge">

                                                                    <input type="hidden" value="airportParkingBooking"

                                                                           name="action" id="action">

                                                                    <input type="hidden" id="bookID" name="booking_id"

                                                                           value="0">

                                                                    <input type="hidden" id="referenceNo"

                                                                           name="reference_no"

                                                                           value="{{ $data['referenceNo'] }}">

                                                                    <input type="hidden" id="aphactivestripe" name="aphactive"

                                                                           value="{{ $data['aphactive'] }}">

                                                                    <input type="hidden" id="speed_park_active"

                                                                           name="speed_park_active" value="">

                                                                    <input type="hidden" id="site_codename"

                                                                           name="site_codename"

                                                                           value="">

                                                                    <input type="hidden" id="edinactive"

                                                                           name="edinactive"

                                                                           value="">

                                                                    <input type="hidden" id="edin_search"

                                                                           name="edin_search"

                                                                           value="">

                                                                </div>

                                                                <div class="col-lg-12">

                                                                    <div id="checkoutPageError"

                                                                         class="dg-danger text-danger hidden">

                                                                    </div>

                                                                </div>

                                                                <div class="col-lg-12">

                                                                    <div class="alert alert-danger" id="c_error"

                                                                         style="display: none; margin-top: 10px; font-weight: bold;">

                                                                        Could not submit your request this time, please

                                                                        check

                                                                        your Card details and try again.

                                                                    </div>

                                                                </div>





                                                            </div><!--#creditDiv-->

                                                             <div class="card_chrge ">
                                                                 <div class="text-center jusfify-cent">
                                                                  <input type="hidden" id="intent_secret" name="intent_secret" value="" >
                                                                  <input type="hidden" id="intent_id" name="intent_id" value="" >
                                                        
                                                        <!-- placeholder for Elements -->
                                                        <div id="card-element"></div>
                                                              

                                                               

                                                            
                                                                </div>
                                                                <center>  <h4><span class="badge badge-warning" >Your Card Will Be Charged</span> <span class="badge badge-danger" > <strong>£<span

                                                                                id="ccPrice">78.98</span></strong></span></h4> </center>
                                                            </div>

                                                            <br>
                                                            <center> 
                                                            <button class="btn btn-primary d-flex m-auto"  type="submit" id="bookingButton">Confirm Booking

                                                            </button>
                                                        </center>



                                                            <div class="error" role="alert" style="display:none">

                                                                <svg xmlns="http://www.w3.org/2000/svg" width="17"

                                                                     height="17" viewBox="0 0 17 17">

                                                                    <path class="base" fill="#000"

                                                                          d="M8.5,17 C3.80557963,17 0,13.1944204 0,8.5 C0,3.80557963 3.80557963,0 8.5,0 C13.1944204,0 17,3.80557963 17,8.5 C17,13.1944204 13.1944204,17 8.5,17 Z"></path>

                                                                    <path class="glyph" fill="#FFF"

                                                                          d="M8.5,7.29791847 L6.12604076,4.92395924 C5.79409512,4.59201359 5.25590488,4.59201359 4.92395924,4.92395924 C4.59201359,5.25590488 4.59201359,5.79409512 4.92395924,6.12604076 L7.29791847,8.5 L4.92395924,10.8739592 C4.59201359,11.2059049 4.59201359,11.7440951 4.92395924,12.0760408 C5.25590488,12.4079864 5.79409512,12.4079864 6.12604076,12.0760408 L8.5,9.70208153 L10.8739592,12.0760408 C11.2059049,12.4079864 11.7440951,12.4079864 12.0760408,12.0760408 C12.4079864,11.7440951 12.4079864,11.2059049 12.0760408,10.8739592 L9.70208153,8.5 L12.0760408,6.12604076 C12.4079864,5.79409512 12.4079864,5.25590488 12.0760408,4.92395924 C11.7440951,4.59201359 11.2059049,4.59201359 10.8739592,4.92395924 L8.5,7.29791847 L8.5,7.29791847 Z"></path>

                                                                </svg>

                                                                <span class="message"></span></div>

                                                            <div id="error_personal_detail" style="color:#f20; font-weight:bold; text-align:center;"></div>



                                                            <div class="col-md-12">

                                                                <div class="styledpadding" >

                                                                    

                                                                </div>

                                                            </div>



                                                        </form>





                                                    </div>

                                                @endif

                                                @if($settings["payment_type"]=='payzone')

                                                    <img class="img-responsive"

                                                         src="{{ secure_asset("assets/payzone/images/payzone_cards_accepted.png") }}"></div>

                                                    {{--PAYZONE FORM--}}

                                                    <form id="payzone_form">

                                                        <div class='payzone-form-section'>

                                                            {{ csrf_field() }}



                                                            <input type="hidden" id="CrossReferenceTransaction"

                                                                   name="CrossReferenceTransaction" value="false"/>



                                                            <div id='CardSectionTop' class="col-lg-12 margin15">

                                                                <div class="col-lg-6">

                                                                    <label for='CardName'>Card Name</label>

                                                                    <input class="form-control bf-inptfld"

                                                                           type="text" name="CardName" required

                                                                           value=""/>

                                                                </div>



                                                                <div class="col-lg-6">

                                                                    <label for='CardNumber'>Card Number</label>

                                                                    <input class="form-control bf-inptfld"

                                                                           type="tel" name="CardNumber"

                                                                           id="CardNumber"

                                                                           value=""

                                                                           required

                                                                           placeholder="XXXX XXXX XXXX XXXX"

                                                                           data-inputmask="'mask': '9999 9999 9999 9999'"

                                                                           pattern="\d{4} \d{4} \d{4} \d{4}"

                                                                           class="masked"/>

                                                                </div>

                                                            </div>

                                                            <div id='CardSectionTop' class="col-lg-12 margin15">

                                                                <div class="col-lg-6">

                                                                    <label for='CV2'>CV2</label>

                                                                    <input class="form-control bf-inptfld"

                                                                           type="text" name="CV2" value=""

                                                                           required

                                                                           maxlength="4"

                                                                           onkeypress='return event.charCode >= 48 && event.charCode <= 57'/>

                                                                    </span>

                                                                </div>



                                                                <div class="col-lg-6 exp_monthdd"

                                                                     >

                                                                    <label for="ExpiryDateMonth" class="col-lg-12">Expiry

                                                                        Date</label>

                                                                    <div class="col-lg-6">



                                                                        <select required name="ExpiryDateMonth"

                                                                                class='exp_monthdd_height'>

                                                                            <option value=''></option>

                                                                            <option value="01">01</option>

                                                                            <option value="02">02</option>

                                                                            <option value="03">03</option>

                                                                            <option value="04">04</option>

                                                                            <option value="05">05</option>

                                                                            <option value="06">06</option>

                                                                            <option value="07">07</option>

                                                                            <option value="08">08</option>

                                                                            <option value="09">09</option>

                                                                            <option value="10">10</option>

                                                                            <option value="11">11</option>

                                                                            <option value="12">12</option>

                                                                        </select>

                                                                    </div>

                                                                    <div class="col-lg-6">

                                                                        <select required name="ExpiryDateYear"

                                                                                class='exp_monthdd_height'>

                                                                            <option value=''></option>

                                                                            <option value="18">2018</option>

                                                                            <option value="19">2019</option>

                                                                            <option value="20">2020</option>

                                                                            <option value="21">2021</option>

                                                                            <option value="22">2022</option>

                                                                            <option value="23">2023</option>

                                                                            <option value="24">2024</option>

                                                                            <option value="25">2025</option>

                                                                            <option value="26">2026</option>

                                                                            <option value="27">2027</option>

                                                                            <option value="28">2028</option>

                                                                            <option value="28">2029</option>

                                                                            <option value="28">2030</option>

                                                                        </select>

                                                                    </div>

                                                                    </span>



                                                                </div>

                                                            </div>





                                                        </div>

                                                        <div class="card_chrge">

                                                            <h3 class="total_charged">Your Card Will Be Charged <strong>£<span

                                                                            id="ccPrice">00.00</span></strong></h3>

                                                            

                                                        </div>

                                                        <div class="col-md-12">

                                                            <div class="styledpadding">

                                                                <label for="subscribe">

                                                                    <input type="checkbox" name="subscribe"

                                                                           class="styled"

                                                                           value="1">

                                                                    Subscribe for Regular Customer discount Code.

                                                                </label>

                                                            </div>

                                                        </div>

                                                        <div class="card_chrge">

                                                            <input type="hidden" value="airportParkingBooking"

                                                                   name="action" id="action">

                                                            <input type="hidden" id="bookID" name="booking_id"

                                                                   value="0">

                                                            <input type="hidden" id="referenceNo"

                                                                   name="reference_no"

                                                                   value="{{ $data['reference_no'] }}">

                                                            <input type="hidden" id="aphactivepayzone" name="aphactive"

                                                                   value="{{ $data['aphactive'] }}">

                                                            <input type="hidden" id="speed_park_active"

                                                                   name="speed_park_active" value="">

                                                            <input type="hidden" id="site_codename"

                                                                   name="site_codename"

                                                                   value="">

                                                            <input type="hidden" id="edinactive"

                                                                   name="edinactive"

                                                                   value="">

                                                            <input type="hidden" id="edin_search"

                                                                   name="edin_search"

                                                                   value="">

                                                        </div>

                                                        <div id="form_errors"></div>

                                                        <div id="error_personal_detail" style="color:red; padding-left: 27px;"></div>



                                                    <button id="booking_button" class="btn btn-lg btn-yellow center-block cnf_booking" type="button" onclick="payzone_submit()" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing">Confirm Booking</button>

                                                    </form>

                                                    {{--PAYZONE FORM END--}}

                                                @endif





                                            </div><!-- end room-info -->



                                        </div><!-- end columns -->

                                    </div><!-- end row -->

                                </div><!-- end room-list-block -->

                            </li><!-- end list-item -->





                        </ul>



                    </div><!-- end columns -->



                    

                </div><!-- end row -->

            </div><!-- end container -->

        </div><!-- end room-listing-blocks -->



    </section>





@endsection
<div class="overlay" style="display: none;"></div>
@section("footer-script")



    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>







    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js" data-autoinit='true'></script>



    <script src="https://getaddress.io/js/jquery.getAddress-2.0.8.min.js"></script>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>--}}

    <script type="text/javascript">

        $(":input").inputmask();



        $("#travel_detail").validate({

            rules: {

                departterminal: {

                    required: {

                        depends: function (element) {

                            var id = $('input[name=flightdetails]:checked').attr('id');

                            if (id == 'yes') {

                                return true;

                            } else {

                                return false;

                            }



                        }

                    }



                },

                arrivalterminal: {

                    required: {

                        depends: function (element) {

                            var id = $('input[name=flightdetails]:checked').attr('id');

                            if (id == 'yes') {

                                return true;

                            } else {

                                return false;

                            }



                        }

                    }



                },

                returnflight: {

                    required: {

                        depends: function (element) {

                            var id = $('input[name=flightdetails]:checked').attr('id');

                            if (id == 'yes') {

                                return true;

                            } else {

                                return false;

                            }



                        }

                    }



                },

            }

        });

        $("#vechile_detail").validate({

            rules: {

                registration: {

                    required: {

                        depends: function (element) {

                            var id = $('input[name=vehdetails]:checked').attr('id');

                            if (id == 'yes') {

                                return true;

                            } else {

                                return false;

                            }



                        }

                    }



                },

                make: {

                    required: {

                        depends: function (element) {

                            var id = $('input[name=vehdetails]:checked').attr('id');

                            if (id == 'yes') {

                                return true;

                            } else {

                                return false;

                            }



                        }

                    }



                },

                color: {

                    required: {

                        depends: function (element) {

                            var id = $('input[name=vehdetails]:checked').attr('id');

                            if (id == 'yes') {

                                return true;

                            } else {

                                return false;

                            }



                        }

                    }



                },

                model: {

                    required: {

                        depends: function (element) {

                            var id = $('input[name=vehdetails]:checked').attr('id');

                            if (id == 'yes') {

                                return true;

                            } else {

                                return false;

                            }



                        }

                    }



                },

            }

        });



        $(".feeinput").click(function (event) {

            ap_processCheckout();

        });

        //service key for address : MT53-FF88-JA71-AX88



        //        function validateUserFormDumy() {

        //            hideErrorMsg($('#checkoutFrm'));

        //            var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        //            var error = false;

        //            if ($('#c_email').val() == '' || !re.test($('#c_email').val()) || $('#email').val() != $('#c_email').val()) {

        //                showErrorMsg($('#c_email'));

        //                //find('#c_email')

        //                error = true;

        //                $('.error-massage').html('Email Not Match');

        //

        //            }

        //            if ($('#title').val() == '') {

        //                showErrorMsg($('#title'));

        //                error = true;

        //            }

        //

        //            if ($('#firstname').val() == '') {

        //                showErrorMsg($('#firstname'));

        //                error = true;

        //            }

        //

        //            if ($('#lastname').val() == '') {

        //                showErrorMsg($('#lastname'));

        //                error = true;

        //            }

        //

        //            if ($('#email').val() == '') {

        //                showErrorMsg($('#email'));

        //                error = true;

        //            }

        //

        //            if ($('#contactno').val() == '') {

        //                showErrorMsg($('#contactno'));

        //                error = true;

        //            }

        //

        //            $('#checkoutFrm').find('.border-red').each(function(index, el) {

        //                $(this).change(function(event) {

        //                    validateUserFormDumy();

        //                });

        //            });

        //            return !error;

        //        }



        function showErrorMsg(obj) {

            obj.addClass('border-red');

            obj.after('<span class="error error-massage">Required</span>');

            //$(obj).scrollintoview();

        }



        function hideErrorMsg(obj) {

            obj.find('.border-red').removeClass('border-red');

            obj.find('span.error').remove();

        }





        $(document).ready(function () {

            ap_processCheckout();



//            $("#nolist").bind(function(){

//                $("#ad_field").css("display","block");

//            });



            <!-- Include plugin file -->





            <!-- Add after your form -->



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





            $('input[name=flightdetails]').on('change', function () {

                var id = $('input[name=flightdetails]:checked').attr('id');

                if (id == 'no') {

                    $('#flightnumber').val('TBA');

                    $('#returnflight').val('TBA');

                    $('#travel-detail').slideUp(1000);

                } else {

                    $('#flightnumber').val('');

                    $('#returnflight').val('');

                    $('#travel-detail').slideDown(1000);

                }

            });

            $('input[name=vehdetails]').on('change', function () {

                var id = $('input[name=vehdetails]:checked').attr('id');

                if (id == 'yes') {

                    $('#make').val('');

                    $('#model').val('');

                    $('#color').val('');

                    $('#registration').val('');

                    $('#vechile-detail').slideDown(1000);

                } else {

                    $('#make').val('TBA');

                    $('#model').val('TBA');

                    $('#color').val('TBA');

                    $('#registration').val('TBA');

                    $('#vechile-detail').slideUp(1000);

                }

            });





            $('#getaddress_button').click(function () {



                //hideMsgDiv($("#checkoutPageError"));

                if ($("#personal_details_form").valid()) {

                    var data = {};
                    // data['discount'] = $('#disamount input[name="discount_amount"]').val();
                         data['discount'] ="{{ $data['discount_amount'] }}";
                          //  data['discount2'] = $('#disamount').val();
                    data['title'] = $('#title').val();

                    data['firstname'] = $('#firstname').val();

                    data['lastname'] = $('#lastname').val();

                    data['email'] = $('#email').val();

                    data['contactno'] = $('#contactno').val();

                    data['action'] = $('#action').val();

                    data['reference_no'] = $('#bookingDetails input[name="referenceNo"]').val(),

                        data['booking_fee'] ="{{ $settings['booking_fee'] }}";

                    data['_token'] = "{{ csrf_token() }}";

                    data['refr'] = $('#refr').val();

                    //alert(data['refr']);

                    data['booking_id'] = $('#bookID').val();

                    data['aphactive'] = $('#aphactivebook').val();



                    if (data['action'] == 'airportParkingBooking') {

//                        
                           data['discount'] ="{{ $data['discount_amount'] }}";
                          
                        

                        data['company_id'] = $('#bookingDetails input[name="company_id"]').val(),
						data['product_code'] = $('#bookingDetails input[name="product_code"]').val(),
                            data['parking_type'] = $('#bookingDetails input[name="parking_type"]').val(),

                            data['pickdate'] = $('#bookingDetails input[name="pickdate"]').val(),
                            
                            data['referenceNo'] = $('#bookingDetails input[name="referenceNo"]').val(),

                            data['dropdate'] = $('#bookingDetails input[name="dropdate"]').val(),

                            data['droptime'] = $('#bookingDetails input[name="droptime"]').val(),

                            data['picktime'] = $('#bookingDetails input[name="picktime"]').val(),

                            data['total_days'] = $('#bookingDetails input[name="total_days"]').val(),

                            data['airport'] = $('#bookingDetails input[name="airport"]').val(),

                            data['bookingfor'] = $('#bookingDetails input[name="bookingfor"]').val(),

                            data['promo'] = $('#bookingDetails input[name="promo"]').val(),

                            data['smsfee'] = $("#smsfee").is(':checked') ? 'Yes' : 'No',

                            data['cancelfee'] = $("#cancelfee").is(':checked') ? 'Yes' : 'No',

                            data['passenger'] = $('#passenger').val(),

                            data['incomplete'] = $('#bookingDetails input[name="incomplete"]').val(),

                            data['pl_id'] = $('#bookingDetails input[name="pl_id"]').val(),

                            data['speed_park_active'] = $('#bookingDetails input[name="speed_park_active"]').val(),

                            data['site_codename'] = $('#bookingDetails input[name="site_codename"]').val(),

                            data['sku'] = $('#bookingDetails input[name="sku"]').val(),

                            data['edin_active'] = $('#bookingDetails input[name="edin_active"]').val()



                        //data['debug']       = 1

                    }

//                    if(data['action'] == 'hotelBooking') {

//                        data['hotel_id']    	= $('#bookingDetails input[name="hotel_id"]').val(),

//                            data['room_id']     	= $('#bookingDetails input[name="room_id"]').val(),

//                            data['room_type_id']	= $('#bookingDetails input[name="room_type_id"]').val(),

//                            data['airport']     	= $('#bookingDetails input[name="airport"]').val(),

//                            data['check_in']    	= $('#bookingDetails input[name="check_in"]').val(),

//                            data['check_until']     = $('#bookingDetails input[name="check_until"]').val(),

//                            data['bookingfor']       	= $('#bookingDetails input[name="bookingfor"]').val(),

//                            data['promo']       	= $('#bookingDetails input[name="promo"]').val(),

//                            data['smsfee']      	= $("#smsfee").is(':checked') ? 'Yes' : 'No',

//                            data['cancelfee']   	= $("#cancelfee").is(':checked') ? 'Yes' : 'No'

//                        data['incomplete']  	= $('#bookingDetails input[name="incomplete"]').val()

//                    }

//

//                    if(data['action'] == 'airport_lounges') {

//                        data['lounge_id']    		= $('#bookingDetails input[name="lounge_id"]').val(),

//                            data['airport']     		= $('#bookingDetails input[name="airport"]').val(),

//                            data['airport_code']     		= $('#bookingDetails input[name="airport_code"]').val(),

//                            data['aldeparturedate']    	= $('#bookingDetails input[name="aldeparturedate"]').val(),

//                            data['aldeparturetime']     = $('#bookingDetails input[name="aldeparturetime"]').val(),

//                            data['aladults']     		= $('#bookingDetails input[name="aladults"]').val(),

//                            data['alchildren']     		= $('#bookingDetails input[name="alchildren"]').val(),

//                            data['bookingfor']       		= $('#bookingDetails input[name="bookingfor"]').val(),

//                            data['promo']       		= $('#bookingDetails input[name="promo"]').val(),

//                            data['booking_amount']      = $('#bookingDetails input[name="booking_amount"]').val(),

//                            data['lounge_code']      = $('#bookingDetails input[name="lounge_code"]').val(),

//                            data['lounge_name']      = $('#bookingDetails input[name="lounge_name"]').val(),

//                            data['smsfee']      		= $("#smsfee").is(':checked') ? 'Yes' : 'No',

//                            data['cancelfee']   		= $("#cancelfee").is(':checked') ? 'Yes' : 'No'

//                        data['incomplete']  		= $('#bookingDetails input[name="incomplete"]').val()

//                    }

//

//                    if(data['action'] == 'hotelParkingBooking') {

//                        data['hotel_id']    	= $('#bookingDetails input[name="hotel_id"]').val(),

//                            data['room_id']     	= $('#bookingDetails input[name="room_id"]').val(),

//                            data['room_type_id']	= $('#bookingDetails input[name="room_type_id"]').val(),

//                            data['airport']     	= $('#bookingDetails input[name="airport"]').val(),

//                            data['check_in']    	= $('#bookingDetails input[name="check_in"]').val(),

//                            data['check_until']    	= $('#bookingDetails input[name="check_until"]').val(),

//                            data['addtionalprice']  = $('#bookingDetails input[name="addtionalprice"]').val(),

//                            data['bookingfor']      		= $('#bookingDetails input[name="bookingfor"]').val(),

//                            data['promo']      		= $('#bookingDetails input[name="promo"]').val(),

//                            data['smsfee']      	= $("#smsfee").is(':checked') ? 'Yes' : 'No',

//                            data['cancelfee']   	= $("#cancelfee").is(':checked') ? 'Yes' : 'No'

//                        data['incomplete']  	= $('#bookingDetails input[name="incomplete"]').val()

//                    }

                    $.post('checkBooking', data, function (data) {

                        console.log("data===", data);





                        if (data.booking_id > 0) {



                            if (data.available == "Yes") {

                                $("#bookID").val(data.booking_id);

                                $("#bookID1").val(data.booking_id);

                                $("#referenceNo").val(data.referenceNo);

                                $("#referenceNo1").val(data.referenceNo);

                                $("#incomplete").val('no');

                            }

                            else {



                            }





                        }





//                        if(data.booking_id > 0) {

//

////                            if(data.available == "Yes"){

////                                $("#bookID").val(data.booking_id);

////                                $("#bookID1").val(data.booking_id);

////                                $("#referenceNo").val(data.reference_no);

////                                $("#referenceNo1").val(data.reference_no);

////                                $("#incomplete").val('no');

////                            }

////                            else{

////                                showMsgDiv($("#checkoutPageError1"));

////                            }

//

//

//

//                        } else {

//                          //  showMsgDiv($("#checkoutPageError"));

//                        }

                    }, 'json');

                }

            });





        });

	
	function showSpinner() {
    $(".overlay").show();
}

function hideSpinner() {

        $(".overlay").hide();
}



        function ap_processCheckout(argument) {

            var smsfee = $("#smsfee").is(':checked') ? 'Yes' : 'No';

            var canfee = $("#cancelfee").is(':checked') ? 'Yes' : 'No';

            CheckoutData(smsfee, canfee);

            //$('[data-toggle="tooltip"]').tooltip();

        }



        function CheckoutData(smsfee, canfee) {

            showSpinner();

            var data = {
                 discount : 1,
                discount : $('#disamount input[name="discount_amount"]').val(),
                airport: $('#bookingDetails input[name="airport"]').val(),

                company_id: $('#bookingDetails input[name="company_id"]').val(),
				
				product_code: $('#bookingDetails input[name="product_code"]').val(),

                total_days: $('#bookingDetails input[name="total_days"]').val(),

                dropdate: $('#bookingDetails input[name="dropdate"]').val(),

                pickdate: $('#bookingDetails input[name="pickdate"]').val(),

                droptime: $('#bookingDetails input[name="droptime"]').val(),

                picktime: $('#bookingDetails input[name="picktime"]').val(),

                pl_id: $('#bookingDetails input[name="pl_id"]').val(),

                sku: $('#bookingDetails input[name="sku"]').val(),

                edin_active: $('#bookingDetails input[name="edin_active"]').val(),

                speed_park_active: $('#bookingDetails input[name="speed_park_active"]').val(),

                site_codename: $('#bookingDetails input[name="site_codename"]').val(),

                passenger: $('#passenger').val(),

                promo: $('#bookingDetails input[name="promo"]').val(),

                bookingfor: $('#bookingDetails input[name="bookingfor"]').val(),

                aphactive: $('#bookingDetails input[name="aphactive"]').val(),
                
                intent_secret: $('#intent_secret').val(),
                intent_id: $('#intent_id').val(),

                smsfee: smsfee,

                canfee: canfee,

                action: 'booking_checkout'

            };

            data['_token'] = "{{ csrf_token() }}";

            //setProcessBar(75);

            $.post('booking/checkout', data, function (data) {

                //console.log(data);

                $("#totalPrice").text(data.total_amount);

                $("#ccPrice").text(data.total_amount);

                $("#ddPrice").val(data.total_amount);

                $("#alltotal").val(data.total_amount);

                $("#disAmount").val(data.discount_amount);
				$("#company_name").text(data.company_name);
                $("#intent_secret").val(data.intent_secret);
                 $("#intent_id").val(data.intent_id);


                if (data.booking_amount > 0) {

                    $("#bookingPriceDiv").text(data.booking_amount);

                    $("#bookingprice").val(data.booking_amount);

                } else {

                    //  showalert();

                }

                if (data.discount_amount > 0) {

                    $("#disfeeprice").text(data.discount_amount);

                    $("#disfee").show();

                    $(".promodiscont").hide();

                } else {

                    $("#disfee").hide();

                }

                if (data.booking_fee > 0) {

                    $("#bookfeeprice").text(data.booking_fee);

                    $("#bookfee").show();

                } else {

                    $("#bookfee").hide();

                }

                if (data.sms_notification > 0) {

                    $("#smsNotificationprice").text(data.sms_notification);

                    $("#smsNotification").show();

                } else {

                    $("#smsNotification").hide();

                }

                if (data.cancellation_fee > 0) {

                    $("#canfeeprice").text(data.cancellation_fee);

                    $("#canfee").show();

                } else {

                    $("#canfee").hide();

                }

                hideSpinner();

            }, 'json');

        }





    </script>





    <script type="text/javascript">

        // $("#payzone_form").valid();





        function validate_vechiledetail() {

            var html = '<label class="error error-vech" >This field is required.</label>';

            var id = $('input[name=vehdetails]:checked').attr('id');



            $(".error-vech").remove();

            if (id == 'yes') {

                if ($("#registration").val() == "") {

                    $("#registration").after(html);

                    return false;

                }

                if ($("#make").val() == "") {

                    $("#make").after(html);

                    return false;

                }

                if ($("#color").val() == "") {

                    $("#color").after(html);

                    return false;

                }

                if ($("#model").val() == "") {

                    $("#model").after(html);

                    return false;

                }



            }





            var id2 = $('input[name=flightdetails]:checked').attr('id');

            if (id2 == 'yes') {

                if ($("#departterminal").val() == "") {

                    $("#departterminal").after(html);

                    return false;

                }

                if ($("#arrivalterminal").val() == "") {

                    $("#arrivalterminal").after(html);

                    return false;

                }



            }

            return true;

        }





        function valid_address() {

            var html = '<label class="error error-vech" >This field is required.</label>';





            $(".error-vech").remove();



//            if ($("#address").val() == "") {

//                $("#ad_field").after(html);

//                return false;

//            }

//            if ($("#address2").val() == "") {

//                $("#ad_field").after(html);

//                return false;

//            }

            if ($("#town").val() == "") {

                $("#ad_field").after(html);

                return false;

            }

            if ($("#post_code").val() == "") {

                $("#ad_field").after(html);

                return false;

            }





            return true;

        }





        function payzone_submit() {

            //debugger;

            // e.preventDefault();

//        var cartForm = document.getElementById('payzone_form');

//        var validated = validateForm(cartForm, 'direct', 'true');

//        if (validated) {
			showSpinner();
            if ($("#payzone_form").valid()) { 

                if ($("#personal_details_form").valid()) {

					

                    if (valid_address()) {



                        if (validate_vechiledetail()) {

                            var smsfee=0;

                            if($("#smsfee").prop("checked")==true) {

                                smsfee=$("#smsfee").val();

                            }



                            var cancelfee=0;

                            if($("#cancelfee").prop("checked")==true) {

                                cancelfee=$("#cancelfee").val();

                            }



                            var data = {};
                             data['discount'] = $('#disamount input[name="discount_amount"]').val();
data['discount'] = 1;
                            data['title'] = $('#title').val();

                            data['firstname'] = $('#firstname').val();

                            data['lastname'] = $('#lastname').val();

                            data['email'] = $('#email').val();

                            data['contactno'] = $('#contactno').val();

                            data['action'] = $('#action').val();

                            data['reference_no'] = $('#referenceNo').val();



                            data['_token'] = $('input[name="_token"]').val();

                            data['refr'] = $('#refr').val();

                            //alert(data['refr']);

                            data['booking_id'] = $('#bookID').val();

                            data['alltotal'] = $('#alltotal').val();





                            data['CardName'] = $('#payzone_form input[name="CardName"]').val();

                            data['CardNumber'] = $('#payzone_form input[name="CardNumber"]').val();

                            data['CV2'] = $('#payzone_form input[name="CV2"]').val();

                            data['ExpiryDateMonth'] = $('#payzone_form select[name="ExpiryDateMonth"]').val();

                            data['ExpiryDateYear'] = $('#payzone_form select[name="ExpiryDateYear"]').val();



                            // if (data['action'] == 'airportParkingBooking') {

//

                            data['company_id'] = $('#bookingDetails input[name="company_id"]').val();
							
							data['product_code'] = $('#bookingDetails input[name="product_code"]').val();

                            data['parking_type'] = $('#bookingDetails input[name="parking_type"]').val();

                            data['pickdate'] = $('#bookingDetails input[name="pickdate"]').val()

                            data['dropdate'] = $('#bookingDetails input[name="dropdate"]').val();

                            data['droptime'] = $('#bookingDetails input[name="droptime"]').val();

                            data['picktime'] = $('#bookingDetails input[name="picktime"]').val();

                            data['total_days'] = $('#bookingDetails input[name="total_days"]').val();

                            data['airport'] = $('#bookingDetails input[name="airport"]').val();

                            data['bookingfor'] = $('#bookingDetails input[name="bookingfor"]').val();

                            data['promo'] = $('#bookingDetails input[name="promo"]').val();



                            data['smsfee'] = smsfee;

                        //}

                            data['cancelfee'] = cancelfee;

                            data['passenger'] = $('#passenger').val();

                            data['incomplete'] = $('#bookingDetails input[name="incomplete"]').val();

                            data['pl_id'] = $('#bookingDetails input[name="pl_id"]').val();

                            data['speed_park_active'] = $('#bookingDetails input[name="speed_park_active"]').val();

                            data['site_codename'] = $('#bookingDetails input[name="site_codename"]').val(),

                            data['sku'] = $('#bookingDetails input[name="sku"]').val();

                            data['model'] = $('#vechile_detail input[name="model"]').val();

                            data['color'] = $('#vechile_detail input[name="color"]').val();

                            data['make'] = $('#vechile_detail input[name="make"]').val();

                            data['registration'] = $('#vechile_detail input[name="registration"]').val();

                            data['subscribe'] = $('#bookingDetails input[name="subscribe"]').val();

                            data['departterminal'] = $('#departterminal ').val();

                            data['arrivalterminal'] = $('#arrivalterminal').val();
                            data['discount'] = $('#disAmount').val();

                            data['returnflight'] = $('#returnflight').val();

                            data['address'] = $('#address').val();



                            data['fulladdress'] = $('#getaddress_dropdown option:selected').text();

                            data['address2'] = $('#address2').val();

                            data['town'] = $('#town').val();



                            data['post_code'] = $('#post_code').val();

                            data['aphactive'] = $('#aphactivebook').val();





                            //data['debug']       = 1

                            //}

                            try {

//
                                $('#booking_button').button('loading');

                                $.post('booking/paymentwithPayzone', data, function (data) {

                                    console.log("data===", data);

                                    if (data.StatusCode == 0) {
										
										hideSpinner();

                                        var refid = $('#referenceNo').val();

                                        window.location.href = "https://" + window.location.hostname + "/booking/thankyou/"+refid;

                                    } else {
										hideSpinner();
										alert(data.Message);
                                        $('#booking_button').button('reset');
                                        $("#error_personal_detail").html(data.Message);

                                    }

                                }, 'json');

                            } catch(err) {
								
								hideSpinner();

                                $('#booking_button').button('reset');
                                console.log("error in catch ",err);

                            }

                        } else {
							
							hideSpinner();

                            //vechile_detail

                            var top = $('#vechile_detail').position().top;

                            $(window).scrollTop(top);

                        }

                    } else {
						
						hideSpinner();

                        //$("#ad_field").after('<label class="error error-vech" >This field is required.</label>');

                        var top = $('#personal_details_form').position().top;

                        $(window).scrollTop(top);

                    }





                } else {
					
					hideSpinner();

                    //$("#error_personal_detail").html("<p>Some Personal Detail Field are missing</p>");

                    //$(document).scrollTo('#error_personal_detail');

                    var top = $('#personal_details_form').position().top;

                    $(window).scrollTop(top);



                }

            }

            //}

            //$('#booking_button').button('reset');

            return false;

        }





    </script>

    @if($settings["payment_type"]=='stripe')

        <script src="https://js.stripe.com/v3/"></script>

        <script src="{{ secure_asset('assets/stripe/index.js') }}"></script>

        <script src="{{ secure_asset('assets/stripe/example2.js') }}"></script>

        <script src="{{ secure_asset('assets/stripe/l10n.js') }}"></script>

    @endif



@endsection

<style type="text/css">
   .menu_item a {
    display: inline-block;
    position: relative;
     font-family: sans-serif!important;
    font-size: 36px;
    color: #FFFFFF;
    font-weight: 400;
}
</style>