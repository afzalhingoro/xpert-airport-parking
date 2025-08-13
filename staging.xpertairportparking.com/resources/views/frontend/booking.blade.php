<?php
use App\Company;
?>

@extends('layouts.main')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<!--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@section('content')
    <!-- content-->
    <style>
        #footer .footer-wrap {
            padding: 0;
        }
        .navbar-expand-lg .navbar-collapse#navbarNavDropdown{
            padding: 0;
        }
        .navbar-nav {
            display: none;
        }

        .navbar-toggler {
            display: none !important;
        }

        .second_class {
            display: none;
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

        .card_chrge {
            width: 82%;
            margin: auto;
        }

        .text-danger {
            text-align: center;
        }

        .badge {
            color: #000;
        }

        .error {
            color: red !important;
        }

        .widget-posts-img {
            width: 100%;
        }

        /*.cart_detail {*/
        /*    height: 100%;*/
        /*    position: sticky;*/
        /*    z-index: 100;*/
        /*    top: 0;*/
        /*}*/
        .booking-wash {
            text-align: left;
            padding-bottom: 10px;
        }

        .unordered-list {
            margin-left: 16px;
        }

        .custom-form label,
        .cart_list li {
            color: #1a1b1c;
        }

        .list-single-main-item-title h3 {
            color: #000000;
        }

        .select_car {
            text-align: left;
            font-size: 15px;
            font-weight: 600;
            color: #000000;
            font-family: 'Nunito', sans-serif;
            padding-bottom: 20px;
        }

        .custom-form textarea,
        .custom-form input[type="text"],
        .custom-form input[type=email],
        .custom-form input[type=password],
        .custom-form input[type=button],
        .listsearch-input-item input[type="text"] {
            color: #000000;
        }

        .form-div-img {
            display: block;
            max-width: 85%;
            height: auto;
            margin: auto;
        }

        @media screen and (max-width:767px) {
            .form-div-img {
                display: block;
                max-width: 85%;
                height: auto;
                margin: auto;
            }

            #reverseContainer {
                display: flex;
                flex-direction: column-reverse;
                justify-content: center;
            }

            .widget-posts-img img {
                width: 70%;
            }

            .card_chrge {
                width: 100%;
                margin: auto;
            }
        }

        @media screen and (min-width:821px) {
            .card_chrge {}
        }

        @media screen and (min-device-width: 992px) and (max-device-width: 1199px) {
            .label-h {
                height: 58px
            }

        }

        div.sticky {
            /*position: -webkit-sticky;*/
            position: sticky;
            top: 0;
        }

        .info-link {
            font-size: 16px;
            line-height: 20px;
            color: #055988;
            text-transform: uppercase;
            font-weight: 700;
            display: block;
            cursor: pointer;
        }

        #myTabContent .tab-content-scroll {
            padding: 20px;
            padding-top: 0px !important;
        }

        .modal-title {
            color: #fff;
            font-weight: 600;
            padding: 0px 0px;
        }

        .modal-header {
            border-bottom: 5px solid #ffffff;
            background-color: #4AA1D9;
        }

        .modal-footer {
            background-color: #4AA1D9;
        }

        .btn-secondary {
            color: #fff;
            background-color: #4AA1D9;
            border: 2px solid #ffffff;
        }

        .nav-tabs {
            border-bottom: 1px solid #4AA1D9;
        }

        #myTab {
            display: none;
        }

        .new-banner-content {
            display: none;
        }

        @media screen and (max-width: 485px) {
            div.cal {
                width: 242px;
            }
        }

        .stepwizard-step p {
            margin-top: 0px;
            color: #666;
        }

        .popup1 {
            background-color: #25A493;
            border: 5px solid;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
            height: 260px
        }

        .list {
            background-color: #25A493;
            height: 238px
        }

        @media only screen and (max-width: 712px) {
            .list {
                height: 538px
            }

            .popup1 {
                height: 560px
            }
        }

        .icon1 {
            animation: change 1s step-end both;
        }

        @keyframes change {
            from {
                color: gray
            }

            to {
                color: rgb(246, 171, 47)
            }
        }

        .icon2 {
            animation: change2 3s step-end both;
        }

        @keyframes change2 {
            from {
                color: gray
            }

            to {
                color: rgb(246, 171, 47)
            }
        }

        .icon3 {
            animation: change3 5s step-end both;
        }

        @keyframes change3 {
            from {
                color: gray
            }

            to {
                color: rgb(246, 171, 47)
            }
        }

        .icon4 {
            animation: change4 7s step-end both;
        }

        @keyframes change4 {
            from {
                color: gray
            }

            to {
                color: rgb(246, 171, 47)
            }
        }

        .search {
            margin-top: 95px;
            padding-top: 10px;
            background-color: #eceaec;
            border-bottom: 1px solid #efa32147;
            height: 80px;
        }

        @media only screen and (max-width: 712px) {
            .search {
                height: 259px;
            }
        }

        @media (min-width:713px) and (max-width:1025px) {
            .search {
                height: 170px;
            }
        }

        .primart-bg-color {
            background-color: #4AA1D9;
        }

        .btn-book {
            width: 100%;
            height: 54px;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            border-color: #4AA1D9;
        }

        .modal-body {
            position: relative;
            padding: 15px;
        }

        .modal-backdrop.show {
            opacity: 0;
        }

        .modal-backdrop {
            position: relative !important;
        }

        .block-card {
            display: none;
        }

        .block-card.active {
            display: block;
        }

        .book-head {
            font-size: 40px;
            font-weight: bold;
            color: white;
            margin: 16px 0;
            text-align: center;
        }

        .book-p {
            color: #0c5adb;
        }

        .form-control {
            border-radius: 8px !important;
        }

        @media only screen and (min-width: 992px) {
            .col-pa {
                padding: 30px;
                padding-top: 15px;
            }
        }
        @media only screen and (max-width: 991px) {
            .col-pa {
                padding-top: 15px;
            }
        }
        .table {
            margin-bottom: 7px;
        }


        @media only screen and (min-width: 1400px) {
            .facility-list {
                height: 115px;
            }
        }

        .parking-price2 {
            padding: 11px;
        }

        @media only screen and (max-width: 575px) {
            #bookingFrm1 {
                justify-content: center;
                display: flex
            }

            .parking-price2 {
                text-align: center;
            }
        }

        .img-rad {
            height: 191px;
        }

        @media only screen and (min-width: 575px) {
            .modal-dialog {
                max-width: 70% !important;
            }
        }

        .tab-content-scroll {
            overflow-y: auto;
            height: 350px;
        }

        .modal-header {
            background-color: #0c5adb;
        }

        .modal-footer {
            background-color: #0c5adb;
        }

        .btn-close {
            background: none;
        }

        .btn-close {
            opacity: 1.5;
        }

        .btn-s {
            color: #0c5adb;
            background-color: #FAB03F
        }

        .moreinfo {
            color: #0c5adb;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            padding-left: 20px;
        }

        @media only screen and (min-width: 768px) {
            .dest {
                width: 100% !important;
                position: relative;
                list-style-type: none;
            }
        }

        @media only screen and (max-width: 767px) {
            .dest {
                width: 100% !important;
                overflow-x: auto !important;
                scroll-snap-type: x mandatory;
                position: relative;
                overflow: auto;
                display: flex !important;
                list-style-type: none;
            }
        }

        .model-edit {
            background: rgba(188, 188, 188, 0.8);
        }

        .content-edit {
            margin-top: 127px;
        }

        .edit {
            color: #0c5adb;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            padding-left: 20px;
            background: none !important;
        }
        .info-pad{
         padding:7px;   
        }
        .card-section{
            border-radius:20px;
            padding-top:20px;
            padding-bottom:10px;
            margin-bottom:10px;    
            margin-left: -2px;
            background-color:white;
            border: 1px dashed;
            box-shadow: 0px 1px 4px 0px black;
        }
        .bg-table{
            background: #0c5adb;
            color:white;
            margin:0;
        }
        .addition-h3{
            font-size: 20px;
            font-weight: 600;
            text-align: center;
            margin-top: 10px;
        }
    </style>
    <script language="javascript" type="text/javascript">
        var washDetails = <?php echo json_encode($washDetails); ?>;
        var grossAmount = <?php if (!empty($objBooking->grossamount)) {
            echo $objBooking->grossamount;
        } else {
            echo '0.00';
        } ?>;
    </script>

    <section class="sec-h bookingConfSec" id="zoomIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center col-sec-h3">
                   <h2 class="section-3-h2">Booking  <span style="color:#242d62">Confirmation</span></h2>
                   <div class="seperator"></div>
                   <p class="mt-2 mb-0">Complete Your Booking Process</p>
                </div>
                <!-- <div class="col-lg-12">
                    <h1 class="book-head">Booking Confirmation</h1>
                </div> -->
            </div>
        </div>
    </section>
    <section id="" class="booking-form confirmBooking" id="zoomIn">
        <div class="container">
            <div class="row justify-content-space-around" id="reverseContainer">
                <div class="col-xl-8 col-lg-7 col-md-12 col-sm-12 col-xs-12">
                    <div class="support-bg" style="border: 0px solid #4AA1D9;">
                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <form class="row g-3" id="personal_details_form" autocomplete="false">
                                @csrf
                                    <!--<h3 class="booking-heading">Email Confirmation To</h3>-->

                                    <!--<div class="row card-section">-->
                                    <!--    <h3 class="booking-heading">Email Confirmation To</h3>-->
                                    <!--    <hr>-->

                                        
                                    <!--    <div class="col-md-12">-->
                                    <!--        <p class="checkout_hint" style="font-size: 16px;color: #444;">Your booking-->
                                    <!--            confirmation, directions, important pre-travel information will be sent to-->
                                    <!--            the booking email address.</p>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="row card-section">
                                        <h3 class="booking-heading"> Your Personal information</h3>
                                        <hr>
                                        <div class="col-md-6 input-icons">
                                            <label class="form-label">First Name <span class="red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Your Name" 
                                                name="firstname" id="firstname" oninput="checkFields()"
                                                value="@if (isset(Auth::guard('customer')->user()->first_name)) {{ Auth::guard('customer')->user()->first_name }} @else({{ '' }})@endif"
                                                required>
                                            <i class="fas fa-user icon"></i>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Last Name <span class="red">*</span></label>
                                            <input type="text" class="form-control" placeholder="Last Name" required
                                                name="lastname" id="lastname" oninput="checkFields()"
                                                value="@if (isset(Auth::guard('customer')->user()->last_name)) {{ Auth::guard('customer')->user()->last_name }} @else{{ '' }}@endif">
                                            <i class="fas fa-user icon"></i>
                                        </div>
                                        <div class="col-md-6 ">
                                            <label class="form-label">Email Address <span class="red">*</span></label>
                                            <input type="email" class="form-control" class="disablecopypaste"
                                                placeholder="email@domain.com" name="email" id="email" oninput="checkFields()"
                                                value="@if (isset(Auth::guard('customer')->user()->email)) {{ Auth::guard('customer')->user()->email }} @else {{ '' }} @endif"
                                                autocomplete="false" required>
                                            <i class="fas fa-envelope icon"></i>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Mobile Number <span class="red">*</span></label>
                                            <input type="number" class="form-control" placeholder="XX XXX XXXX" required
                                                      oninput="this.value = this.value.slice(0, 11)"

                                                name="contactno" id="contactno" disabled
                                                value="@if (isset(Auth::guard('customer')->user()->phone_number)) {{ Auth::guard('customer')->user()->phone_number }} @else {{ '' }} @endif"
                                                autocomplete="nope">
                                            <i class="fas fa-phone icon"></i>
                                        </div>
                                        <div class="col-md-12">
                                            <p class="checkout_hint filled-hidden" style="font-size: 16px;color: #dc3545;">Please enter your email address, first name, and last name to enable the mobile number field.</p>

                                        </div>
                                    </div>
                                    <!--</div>-->
                                    <!--   <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="border:1px solid #4AA1D9;border-radius:20px;padding-top:10px;padding-bottom:10px;margin-bottom:10px;background-color:white">-->





                                    <!--<div class="col-md-6">-->
                                    <!--	<label class="form-label">Email Address <span class="red">*</span></label>-->
                                    <!--	<input type="email" class="form-control" class="disablecopypaste" required placeholder="email@domain.com" name="email"  id="email"  autocomplete="false">-->
                                    <!--	<i class="fas fa-envelope icon"></i> -->
                                    <!--</div>-->

                                </form>
                            </div>

                        </div>
                         <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 card-section">
                                <h3 class="booking-heading mt-4">Vehicle Details</h3>
                                <hr>

                                <form id="vechile_detail" class="row g-3">
                                    <div class="col-lg-6 col-md-6 input-icons">
                                        <label class="form-label label-h">Vehicle Registration</label>
                                        <input type="text" class="form-control" placeholder="Reg Number" required
                                            name="registration" id="registration" value="">
                                        <i class="fas fa-car icon"></i>
                                    </div>
                                    <div class=" col-lg-6 col-md-6">
                                        <label class="form-label label-h">Vehicle Make </label>
                                        <input type="text" class="form-control" placeholder="Vehicle Make" required
                                            name="make" id="make" value="">
                                        <i class="fas fa-car icon"></i>
                                    </div>
                                    <div class=" col-lg-6 col-md-6">
                                        <label class="form-label label-h">Vehicle Color</label>
                                        <input type="text" class="form-control" placeholder="Vehicle Color" required
                                            name="color" id="color" value="">
                                        <i class="fas fa-car icon"></i>
                                    </div>
                                    <div class=" col-lg-6 col-md-6">
                                        <label class="form-label label-h">Vehicle Model</label>
                                        <input type="text" class="form-control" placeholder="Vehicle Model" required
                                            name="model" id="model" value="">
                                        <i class="fas fa-car icon"></i>
                                    </div>
                                <div class="col-lg-6 col-md-6">
    <label class="form-label label-h">Passengers</label>
    <div class="position-relative">
        <select class="form-control ps-5" name="passengers" id="passenger" required>
             @for ($i = 1; $i <= 7; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
        <i class="fas fa-user position-absolute" style="top: 50%; left: 15px; transform: translateY(-50%); color: #666;"></i>
    </div>
</div>


                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 card-section">
                                <h3 class="booking-heading mt-4">Flight Details</h3>
                                <hr>
                                <form id="travel_detail" class="row">
                                    <div class="col-md-12">
                                        <label class="check-detail">Do you have Travel Details?</label>
                                        <p class="inner-para">We will set your Travel details to be confirmed if you select
                                            No.<br>You can add these details later on by contacting support desk.</p>
                                        <div class="form-check">
                                            <input class="form-check-input flightdetailsyes" name="flightdetails"
                                                id="yes" type="radio"  value="yes">
                                            <label class="travel-detail" for="flexRadioDefault"> Yes </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input flightdetailsyes" name="flightdetails"
                                                id="no" type="radio" checked value="no">
                                            <label class="travel-detail" for="flexRadioDefault"> No </label>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center" id="flight-detail" style="display:none;">
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label label-h">Departure F-No</label>
                                            <input type="text" class="form-control" placeholder="Optional"
                                                name="deptFlight" id="deptFlight" value="">
                                            <i class="fas fa-plane icon"></i>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputAddress2" class="form-label label-h">Departing
                                                Terminal</label>
                                            <select data-placeholder="Departing Terminal" id="departterminal"
                                                name="departterminal" class="form-control">
                                                @foreach ($terminals as $terminal)
                                                    <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-arrow-right icon"></i>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <label for="inputState" class="form-label label-h">Arrival F-No <span class="red"></span></label>
                                            <input type="text" class="form-control" placeholder="Arrival F-No"
                                                name="returnflight" id="returnflight" value="" >
                                            <i class="fas fa-plane icon"></i>



                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label label-h">Arrival Terminal <span class="red"></span></label>
                                            <select data-placeholder="Arrival Terminal" id="arrivalterminal"
                                                name="arrivalterminal" class="form-control" >
                                                @foreach ($terminals as $terminal)
                                                    <option value="{{ $terminal->id }}">{{ $terminal->name }}</option>
                                                @endforeach
                                            </select>
                                            <i class="fas fa-arrow-right icon"></i>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="row"> 
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 card-section">
                                <h3 class="booking-heading mt-4">Payment Details</h3>
                                <hr>
                                <div class="col-sm-12">
                                    @if ($settings['payment_type'] == 'stripe')
                                        <img class="img-responsive form-div-img" 
                                            src="{{ asset('assets/payzone/images/payzone_cards_accepted.png') }}">

                                        <div class="paymentFrm" id="paymentFrm" >

                                            <form method="post" class="text-center">
                                                {{ csrf_field() }}

                                                <div id="creditDiv">
                                                    <a class="reset" href="#"></a>

                                                    <div class="col-lg-12 margin15">

                                                        <div class="col-lg-6" style="display: none;">

                                                            <label>Card Number </label>

                                                            <span class="required-field">*</span>

                                                            <div class="form-control bf-inptfld empty" type="text"
                                                                id="cc_card_no" name="card_no" ></div>

                                                            <div class="baseline"></div>

                                                        </div>

                                                        <div class="col-lg-6" style="display: none;">

                                                            <label>Card Holder Name </label>

                                                            <span class="required-field">*</span>

                                                            <input class="form-control empty" type="text"
                                                                id="cc_card_title" name="card_title"> </input>

                                                            <div class="baseline"></div>

                                                        </div>

                                                    </div>

                                                    <div class="col-lg-12 margin15" style="display: none;">

                                                        <div class="col-lg-6">

                                                            <label>Expiry Month / Year</label>

                                                            <span class="required-field">*</span>

                                                            <div class="form-control empty bf-inptfld" id="expiry_year">
                                                                Expiration</div>

                                                            <div class="baseline"></div>

                                                        </div>

                                                        <div class="col-lg-6">

                                                            <label>Security Code</label>

                                                            <span class="required-field">*</span>

                                                            <div class="form-control bf-inptfld empty" type="text"
                                                                id="cc_security_code" name="security_code"></div>

                                                            <small>Enter the last 3 digit code on the back of your card
                                                            </small>

                                                            <div class="baseline"></div>

                                                        </div>

                                                    </div>

                                                    <div class="card_chrge">

                                                        <input type="hidden" value="airportParkingBooking"
                                                            name="action" id="action">

                                                        <input type="hidden" id="bookID" name="booking_id"
                                                            value="0">

                                                        <input type="hidden" id="referenceNo" name="reference_no"
                                                            value="">

                                                        <input type="hidden" id="aphactivestripe" name="aphactive"
                                                            value="{{ $data['aphactive'] }}">

                                                        <input type="hidden" id="speed_park_active"
                                                            name="speed_park_active" value="">

                                                        <input type="hidden" id="site_codename" name="site_codename"
                                                            value="">

                                                        <input type="hidden" id="edinactive" name="edinactive"
                                                            value="">

                                                        <input type="hidden" id="edin_search" name="edin_search"
                                                            value="">

                                                    </div>

                                                    <div class="col-lg-12">

                                                        <div class="alert alert-danger" id="c_error">

                                                            Could not submit your request this time, please check your Card
                                                            details and try again.

                                                        </div>

                                                    </div>
                                                </div><!--#creditDiv-->

                                                <div class="card_chrge" style="">
                                                    <input type="hidden" id="intent_secret" name="intent_secret"
                                                        value="">
                                                    <input type="hidden" id="intent_id" name="intent_id"
                                                        value="">
                                                    <!-- placeholder for Elements -->
                                                    <center>
                                                        <div id="card-element"></div>

                                                        <h4 class="mt-2">
                                                            <span class="badge badge-warning">Your Card Will Be
                                                                Charged</span>
                                                            <span class="badge badge-danger bg-success text-white">
                                                                <strong>£<span id="ccPrice">0</span></strong>
                                                            </span>
                                                        </h4>
                                                    </center>
                                                </div>
                                                <br>
                                                <div id="imgloader" style="display:none;">
                                                    <img src="theme/images/timeloader.gif">
                                                </div>
                                                <!--center>
                                                  <button class="btn cnf_booking btn-lg btn-warning center-block" >Confirm Booking</button>
                                                 </center-->

                                                <div class="error" role="alert">
                                                    <span class="message"></span>
                                                </div>
                                                <div id="error_personal_detail"></div>

                                                <div class="col-md-12">
                                                    <div class="styledpadding"></div>
                                                </div>

                                                <span class="fw-separator"></span>
                                                <button type="submit" id="bookingButton"
                                                    class="btn booking-page-button">Confirm Booking</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-12 col-sm-12 col-xs-12">
                    <div class="sticky">
                        <div class="card-section rightContent">
                        
                            <div class="sidebar-img-div"> <img src="{{ str_replace('public','', $data['comp_img']) }}"  class="img-fluid d-block m-auto" style="width: 50%; border-radius: 20px;"> </div>

                            <div class="row justify-content-center">
                                <div class="col-lg-12 ">
                                    <table class="table bg-table" style="margin-top: 30px;">
                                        <thead>
                                            <!--<h4 class="company-name">Flight Park One</h4> -->
                                        </thead>
                                        <tbody>
                                            <tr style="">
                                                <td style="border-color: none;border-style: none;font-size: 16px;">Product
                                                    Name</td>
                                                <td class="table-detail"
                                                    style="border-color: none;border-style: none;font-size: 16px;">
                                                    {{ $data['compant_name'] }}</td>
                                            </tr>
                                            <tr style="">
                                                <td style="border-color: none;border-style: none;font-size: 16px;">Drop-Off
                                                </td>
                                                <td style="border-color: none;border-style: none;font-size: 16px;"
                                                    class="table-detail">
                                                    {{ \Carbon\Carbon::parse($data['dropdate'])->format('D d M Y') }} at
                                                    {{ $data['droptime'] }}</td>
                                            </tr>
                                            <tr style="">
                                                <td style="border-color: none;border-style: none;font-size: 16px;">Return
                                                </td>
                                                <td style="border-color: none;border-style: none;font-size: 16px;"
                                                    class="table-detail">
                                                    {{ \Carbon\Carbon::parse($data['pickdate'])->format('D d M Y') }} at
                                                    {{ $data['picktime'] }}</td>
                                            </tr>
                                            <tr style="">
                                                <td style="border-color: none;border-style: none;font-size: 16px;">No of
                                                    Days</td>
                                                <td style="border-color: none;border-style: none;font-size: 16px;"
                                                    class="table-detail">{{ $data['total_days'] }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--<a data-bs-toggle="modal" data-bs-target="#exampleModaledit" class="edit-booking">	-->
                                    <!--                    		Edit <i class="fa-solid fa-pen-to-square"></i>-->
                                    <!--                    	</a>-->
                                    <!--<button class="btn btn-sm edit" data-toggle="modal" data-target="#search_data_modal"><span> Edit <i class="fas fa-pencil-alt"></i></span></button><br>-->
                                    <div class="modal fade model-edit" id="search_data_modal" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content content-edit">
                                                <div class="modal-header primart-bg-color">
                                                    <span class="modal-title white-color">Edit</span>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close" style="background:none;border:none">
                                                        <i class="fa fa-solid fa-xmark"
                                                            style="color: white;font-size: 20px;"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="block">
                                                        @php 
                                                            $company = new \App\Models\Company();

                                                            $facilities = $company->find($data['company_id'])->facilities;
                                                            $company = $company->find($data['company_id']);

                                                        @endphp
                                                        <form class="row from-css justify-content-center" style=""
                                                            method="get" action="{{ route('searchresult') }}"
                                                            id="search_form_1">

                                                            <div class="col-lg-6 col-cs col-cs2">

                                                                <div class="mb-3">

                                                                    <label for="floatingInput">Drop off Date </label>

                                                                    <div class="input-hold date">

                                                                        <input style="background-color:#FAB03F !important;"
                                                                            value="{{ $data['dropdate'] }}"
                                                                            type="text"
                                                                            class="text-field dpd1 form-control drop-css"
                                                                            id="startDate" name="dropdate" required
                                                                            placeholder="DD/MM/YYYY" readonly>

                                                                        <!--<i class="fa-regular fa-calendar-days icon-cs"></i>-->

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-lg-6 col-cs2">

                                                                <div class="mb-3">

                                                                    @php

                                                                        $dropdown_timer = [];

                                                                        for ($i = 0; $i <= 23; $i++) {
                                                                            for ($j = 0; $j <= 45; $j += 15) {
                                                                                $dropdown_timer[str_pad($i, 2, '0', STR_PAD_LEFT) . ':' . str_pad($j, 2, '0', STR_PAD_LEFT)] = str_pad($i, 2, '0', STR_PAD_LEFT) . ':' . str_pad($j, 2, '0', STR_PAD_LEFT);
                                                                            }
                                                                        }

                                                                    @endphp
                                                                    <label for="floatingInput">
                                                                        Drop off Time
                                                                    </label>


                                                                    <div class="input-hold time">
                                                                        <select
                                                                            style="background-color:#FAB03F !important;"
                                                                            name="droptime" required
                                                                            class="form-select drop-css">
                                                                            @foreach ($dropdown_timer as $key => $value)
                                                                                <option
                                                                                    @if ($data->droptime == $value) selected @endif
                                                                                    value="{{ $value }}">
                                                                                    {{ $value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6 p-cs col-cs col-cs2">
                                                                <div class="mb-3">

                                                                    <label for="floatingInput">

                                                                        PickUp Date

                                                                    </label>

                                                                    <div class="input-hold date">

                                                                        <input style="background-color:#FAB03F !important;"
                                                                            type="text" value="{{ $data->pickdate }}"
                                                                            value="{{ request()->get('promo') }}"
                                                                            class="text-field dpd2 form-control drop-css"
                                                                            readonly id="endDate" name="pickdate"
                                                                            autocomplete="off" required
                                                                            placeholder="DD/MM/YYYY">

                                                                        <!--<i class="fa-regular fa-calendar-days icon-cs"></i>-->

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-lg-6 col-cs2">

                                                                <div class="mb-3">

                                                                    <label for="floatingInput">

                                                                        PickUp Time

                                                                    </label>

                                                                    <div class="input-hold time">

                                                                        <select
                                                                            style="background-color:#FAB03F !important;"
                                                                            name="picktime" required
                                                                            class="form-select drop-css">
                                                                            @foreach ($dropdown_timer as $key => $value)
                                                                                <option
                                                                                    @if ($data['picktime'] == $value) selected @endif
                                                                                    value="{{ $value }}">
                                                                                    {{ $value }} </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>

                                                                </div>

                                                            </div>

                                                            <div class="col-lg-12 p-cs col-cs mtop col-cs2">

                                                                <div class="mb-3">

                                                                    <!--<div id="dropdatepicker">-->

                                                                    <label for="floatingInput" class="promo-code-css">

                                                                        Promo Code

                                                                    </label>


                                                                    <input style="background-color:#FAB03F !important;"
                                                                        type="text"
                                                                        class="form-control promo-css drop-css"
                                                                        placeholder="Optional" name="promo"
                                                                        value="{{ request()->get('promo') }}">

                                                                    <!--</div>-->

                                                                    <i class="fa-solid fa-percent icon-cs"></i>



                                                                </div>

                                                            </div>



                                                            <div class="col-lg-6 mtop btn-css-mtop">

                                                                <!--<input type="hidden" name="company_id" value="3">-->

                                                                <!--<input type="hidden" name="product_code" value="103">-->

                                                                <input type="hidden" name="parking_type"
                                                                    value="{{ $company->parking_type }}">

                                                                <input type="hidden" name="parking_name" value="">

                                                                <input type="hidden" name="aphactive"
                                                                    value="{{ @$company->aphactive }}">



                                                                <input type="hidden" name="bookingfor"
                                                                    value="airport_parking">

                                                                <input type="hidden" name="pl_id"
                                                                    value="{{ @$company->pl_id }}">

                                                                <input type="hidden" name="sku" value="">

                                                                <input type="hidden" name="site_codename"
                                                                    value="">

                                                                <input type="hidden" name="speed_park_active"
                                                                    value="">

                                                                <input type="hidden" name="edin_active" value="">

                                                                <input type="hidden" name="edin_search" value="">

                                                                <input type="hidden" name="comp_img"
                                                                    value='{{ asset('storage/app/' . $company->logo) }}'>

                                                                <input type="hidden" name="submitted"
                                                                    value="airport_parking">

                                                                <label>

                                                                    &nbsp;

                                                                </label>

                                                                <div class="form-group"> 



                                                                    <button style="background:#0c5adb;color:#FAB03F;"
                                                                        type="submit" class="btn btn-h"><b
                                                                            style="font-weight: 800;">Search</b></button>

                                                                </div>

                                                            </div>

                                                           <!-- #region 
                                                            -->



                                                    </div>

                                                    </form>
                                                </div>
                                            </div>
                                            <script>
                                                let $blocks = $('.block-card');

                                                $('.filter-btn').on('click', e => {
                                                    let $btn = $(e.target).addClass('active');
                                                    $btn.siblings().removeClass('active');

                                                    let selector = $btn.data('target');
                                                    $blocks.removeClass('active').filter(selector).addClass('active');
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <!--<a data-bs-toggle="modal" data-bs-target="#exampleModal{{ $data['company_id'] }}"-->
                                <!--    class="moreinfo">-->
                                <!--    More Info <i class="fa fa-plus"></i>-->
                                <!--</a>-->



                                @php
                                    $company = new \App\Models\Company();
                                    $facilities = $company->find($data['company_id'])->facilities;
                                    $company = $company->find($data['company_id']);

                                @endphp

                                <div class="modal fade model-edit" id="exampleModal{{ $data['company_id'] }}"
                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" id="airport-modal">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">
                                                    {{ $data['compant_name'] }}<br>
                                                </h5>

                                                <button type="button" class="btn-close " data-bs-dismiss="modal"
                                                    aria-label="Close"> <i class="fa fa-solid fa-xmark"
                                                        style="color: white;font-size: 20px;"></i></button>
                                            </div>
                                            <div class="modal-body">
                                                <ul class="nav-tabs tabs__controls d-flex js-tabs-controls dest"
                                                    id="myTab" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link active info-pad" id="home-tab"
                                                            data-bs-toggle="tab"
                                                            data-bs-target="#info{{ $data['company_id'] }}"
                                                            type="button" role="tab" aria-controls="home"
                                                            aria-selected="true">info</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link info-pad" id="contact-tab" data-bs-toggle="tab"
                                                            data-bs-target="#arrival{{ $data['company_id'] }}"
                                                            type="button" role="tab" aria-controls="contact"
                                                            aria-selected="false">Arrivals</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link info-pad" id="contact-tab" data-bs-toggle="tab"
                                                            data-bs-target="#return{{ $data['company_id'] }}"
                                                            type="button" role="tab" aria-controls="contact"
                                                            aria-selected="false">Return</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button class="nav-link info-pad" id="profile-tab" data-bs-toggle="tab"
                                                            data-bs-target="#Map{{ $data['company_id'] }}" type="button"
                                                            role="tab" aria-controls="profile"
                                                            aria-selected="false">Map</button>
                                                    </li>
                                                    <!-- <li class="nav-item" role="presentation">-->
                                                    <!--<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#note{{ $data['company_id'] }}" type="button" role="tab" aria-controls="contact" aria-selected="false">Note</button>-->
                                                    <!-- </li>-->
                                                    <!-- <li class="nav-item" role="presentation">-->
                                                    <!--<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#help{{ $data['company_id'] }}" type="button" role="tab" aria-controls="contact" aria-selected="false">Terms & Conditions</button>-->
                                                    <!-- </li>-->
                                                </ul>
                                                <div class="tab-content" id="myTabContent">
                                                    <div class="tab-pane fade show active"
                                                        id="info{{ $data['company_id'] }}" role="tabpanel"
                                                        aria-labelledby="home-tab">
                                                        <div class="tab-content-scroll">
                                                            <p>{!! $company->overview !!} </p>

                                                            <h3>Facilities</h3>
                                                            <ul class="result-benefit">
                                                                @foreach ($facilities as $facility)
                                                                    <li class="rs-list"><i class="fa fa-check"></i>
                                                                        {!! $facility->description !!} </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="Map{{ $data['company_id'] }}"
                                                        role="tabpanel" aria-labelledby="profile-tab">
                                                        <div class="tab-content-scroll">
                                                            @if ($company->parking_type == 'Meet and Greet')
                                                                <iframe width="100%" height="400" frameborder="0"
                                                                    style="border:0"
                                                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAbqO8h1hqd8sQ5YR7zC10C4TQ0kbW1j_g&q={{ $company->address }}+{{ $company->town }}+{{ $company->post_code }}"
                                                                    allowfullscreen></iframe>
                                                            @else
                                                                <iframe width="100%" height="400" frameborder="0"
                                                                    style="border:0"
                                                                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAbqO8h1hqd8sQ5YR7zC10C4TQ0kbW1j_g&q={{ $company->address }}+{{ $company->town }}+{{ $company->post_code }}"
                                                                    allowfullscreen></iframe>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="arrival{{ $data['company_id'] }}"
                                                        role="tabpanel" aria-labelledby="contact-tab">
                                                        <div class="tab-content-scroll">{!! $company->arival !!}</div>
                                                    </div>

                                                    <div class="tab-pane fade" id="return{{ $data['company_id'] }}"
                                                        role="tabpanel" aria-labelledby="contact-tab">
                                                        <div class="tab-content-scroll">{!! $company->return_proc !!}</div>
                                                    </div>
                                                    <div class="tab-pane fade" id="note{{ $data['company_id'] }}"
                                                        role="tabpanel" aria-labelledby="contact-tab">
                                                        <div class="tab-content-scroll">
                                                            <h4><strong>Important Information</strong></h4>

                                                            <ul class="points"
                                                                style="text-align: left;list-style: none;line-height: 25px;font-size: 15px;padding-left:0px;     color: #000;">



                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane fade" id="help{{ $data['company_id'] }}"
                                                        role="tabpanel" aria-labelledby="contact-tab">
                                                        <div class="tab-content-scroll">
                                                            <div class="alert alert-info text-left"
                                                                style="margin-top: 10px;">
                                                                <strong>Will Be provided on request</strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-s"
                                                    data-bs-dismiss="modal">Close</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                <table class="table bg-table">
                                    <tr style="border-top: 1px solid #fff;">
                                        <td
                                            style="border-color: none;border-style: none;font-size: 16px;    padding-top: 10px;padding-bottom: 10px;">
                                            Booking Price</td>
                                        <td style="border-color: none;border-style: none;font-size: 14px;padding-top: 10px;padding-bottom: 10px;"
                                            class="table-detail"><span id="bookingPriceDiv">£0.00</span></td>
                                    </tr>
                                </table>
                                <table class="table bg-table">
                                    <tr id="disfee">
                                        <td
                                            style="border-color: none;border-style: none;font-size: 16px;padding-top: 10px;padding-bottom: 10px;">
                                            Discount</td>
                                        <td style="border-color: none;border-style: none;font-size: 14px;padding-top: 10px;padding-bottom: 10px;"
                                            class="table-detail"><span id="disfeeprice">£0.00</span></td>
                                    </tr>
                                </table>
                                <table class="table bg-table">
                                    <tr style="border-bottom: 1px solid #fff;">
                                        <td
                                            style="border-color: none;border-style: none;font-size: 16px;padding-top: 10px;padding-bottom: 10px;">
                                            Booking Fee</td>
                                        <td style="border-color: none;border-style: none;font-size: 14px;padding-top: 10px;padding-bottom: 10px;"
                                            class="table-detail"><span id="bookfeeprice">£0.00</span></td>
                                    </tr>
                                </table>
                                <table class="table bg-table">
                                    @if($company->cancelable == 'Yes')
                                    <tr>
                                        <td style="border-color: none;border-style: none;font-size: 16px;padding-top: 10px;padding-bottom: 10px;">
                                            <h3 class="addition-h3">Additional Services</h3>
                                        </td>
                                    </tr>
                                    <!-- <tr>
                                        <td style="border-color: none;border-style: none;font-size: 16px;padding-top: 10px;padding-bottom: 10px;">
                                            <label style="font-size: 16px;font-weight: 500;color: #000;padding-left: 0px;padding-right: 0px;">
                                                <input class="feeinput" type="checkbox" id="smsfee" name="smsfee" value='{{ $settings['sms_notification_fee'] }}'> Add SMS
                                                confirmation at only £{{ $settings['sms_notification_fee'] }} &nbsp;<span class="fa fa-info-circle cls-pointer" data-toggle="tooltip" data-placement="top"
                                                    title="Why not have your booking details sent direct to your mobile, for a quick and easy check in."></span>
                                            </label>
                                        </td>
                                    </tr> -->
                                    <tr>
                                        <td style="border-color: none;border-style: none;font-size: 16px;padding-top: 10px;padding-bottom: 10px;">
                                            <label style="font-size: 16px;font-weight: 500;color: #000;padding-left: 0px;padding-right: 0px;">
                                                <input class="feeinput" type="checkbox" id="cancelfee" name="cancelfee" value='{{ $settings['cancellation_fee'] }}'> Add Cancellation
                                                Cover at only £{{ $settings['cancellation_fee'] }}&nbsp;<span class="fa fa-info-circle cls-pointer" data-toggle="tooltip" data-placement="top"
                                                    title="Our cancellation cover protects you if you do need to cancel or amend your booking."></span>
                                            </label>
                                        </td>
                                    </tr>
                                    @else
                                    <input class="feeinput" type="hidden" id="cancelfee" name="cancelfee" value="0">
                                    @endif
                                </table>


                                <table class="table">
                                    <tr>
                                        <td class="totelprice" style="padding-top: 20px;border: 0;">Total To
                                            Pay:</td>
                                        <td class="price" id="bookingDetails" style="padding-top: 20px;border: 0;">
                                            <span id="totalPrice">£0.00</span>
                                            <input type="hidden" id="bookingprice"
                                                value='{{ $data['booking_amount'] }}' />
                                            <input type="hidden" id="alltotal"
                                                value='{{ $data['booking_amount'] }}' />
                                            <input type="hidden" id="disAmount" name="discount_amount"
                                                value='{{ $data['discount_amount'] }}'>
                                            <input type="hidden" id="valet_amount" name="valet_amount" value='0'>
                                            <input type="hidden" name="company_id" value='{{ $data['company_id'] }}'>
                                            <input type="hidden" name="product_code"
                                                value='{{ $data['product_code'] }}'>
                                            <input type="hidden" name="parking_type"
                                                value='{{ $data['parking_type'] }}'>
                                            <input type="hidden" name="compant_name"
                                                value='{{ $data['compant_name'] }}'>
                                            <input type="hidden" name="pickdate" value='{{ $data['pickdate'] }}'>
                                            <input type="hidden" name="dropdate" value='{{ $data['dropdate'] }}'>
                                            <input type="hidden" name="droptime" value='{{ $data['droptime'] }}'>
                                            <input type="hidden" name="picktime" value='{{ $data['picktime'] }}'>
                                            <input type="hidden" name="total_days" value='{{ $data['total_days'] }}'>
                                            <input type="hidden" name="airport_id" value='{{ $data['airport_id'] }}'>
                                            <input type="hidden" name="promo" value='{{ $data['discount_code'] }}'>
                                            <input type="hidden" name="pl_id" value='{{ $data['pl_id'] }}'>
                                            <input type="hidden" name="source_site" value='{{ $data['source_site'] }}'>
                                            <input type="hidden" name="site_codename" value="">
                                            <input type="hidden" name="bookingfor" value="airport_parking">
                                            <input type="hidden" name="incomplete" id="incomplete" value="yes">
                                            <input type="hidden" name="aphactive" id="aphactivebook"
                                                value='{{ $data['aphactive'] }}'>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
<div class="overlay" style="display: none;"></div>
@section('footer-script')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js" data-autoinit='true'></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            ScrollReveal().reveal('#slideInRight', {
                distance: '350px',
                origin: 'right',
                duration: 2000,
                reset: true
            });
            ScrollReveal().reveal('#zoomIn', {
                scale: 0.5,     
                duration: 2000,  
                reset: true       
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input.disablecopypaste').bind('copy paste', function(e) {
                e.preventDefault();
            });
        });
        $("#bookingButton1").click(function(event) {
            //$("#personal_details_form").valid();
            if ($("#email_form").valid() && $("#personal_details_form").valid() && $("#vechile_detail").valid()) {
                $('.error').html(
                    '<div class="alert alert-success" style=" width: 40%; margin: auto;text-align: center;padding: 10px;margin-top: 16px;"><strong>Success!</strong> This is test booking.</div>'
                );
            }
        });
        $(":input").inputmask();
        
        
        // $("#travel_detail").validate({

        //     rules: {

        //         departterminal: {

        //             required: {

        //                 depends: function(element) {

        //                     var id = $('input[name=flightdetails]:checked').attr('id');

        //                     if (id == 'yes') {

        //                         return true;

        //                     } else {

        //                         return false;

        //                     }



        //                 }

        //             }



        //         },

        //         arrivalterminal: {

        //             required: {

        //                 depends: function(element) {

        //                     var id = $('input[name=flightdetails]:checked').attr('id');

        //                     if (id == 'yes') {

        //                         return true;

        //                     } else {

        //                         return false;

        //                     }



        //                 }

        //             }



        //         },

        //         returnflight: {

        //             required: {

        //                 depends: function(element) {

        //                     var id = $('input[name=flightdetails]:checked').attr('id');

        //                     if (id == 'yes') {

        //                         return true;

        //                     } else {

        //                         return false;

        //                     }



        //                 }

        //             }



        //         },

        //     }

        // });

        $("#vechile_detail1").validate({

            rules: {

                registration: {

                    required: {

                        depends: function(element) {

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

                        depends: function(element) {

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

                        depends: function(element) {

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

                        depends: function(element) {

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

        $(".feeinput").click(function(event) {

            ap_processCheckout();

        });

        function showErrorMsg(obj) {

            obj.addClass('border-red');

            obj.after('<span class="error error-massage">Required</span>');

            //$(obj).scrollintoview();

        }

        function hideErrorMsg(obj) {

            obj.find('.border-red').removeClass('border-red');

            obj.find('span.error').remove();

        }

        $(document).ready(function() {
            $('#deptFlight').val('');

            $('#returnflight').val('');

            // $('#flight-detail').slideDown(1000);

            ap_processCheckout();

            $('input[name=flightdetails]').on('change', function() {

                var id = $('input[name=flightdetails]:checked').attr('id');
                console.log('test' + id);
                if (id == 'no') {

                    $('#deptFlight').val('TBA');

                    $('#returnflight').val('TBA');

                    $('#flight-detail').slideUp(1000);

                } else {
                    console.log($('#deptFlight').val(''));

                    $('#deptFlight').val('');

                    $('#returnflight').val('');

                    $('#flight-detail').slideDown(1000);

                }

            });

            $('input[name=vehdetails]').on('change', function() {

                var id = $('input[name=vehdetails]:checked').attr('id');

                if (id == 'yes') {

                    $('#make').val('');

                    $('#model').val('');

                    $('#color').val('');

                    $('#registration').val('');

                    $('#vechile_detail_div').slideDown(1000);

                } else {

                    $('#make').val('TBA');

                    $('#model').val('TBA');

                    $('#color').val('TBA');

                    $('#registration').val('TBA');

                    $('#vechile_detail_div').slideUp(1000);

                }

            });
            $('input[name=additional_service]').on('change', function() {

                var id = $('input[name=additional_service]:checked').attr('id');
                console.log('test' + id);
                if (id == 'no') {

                    $("#no_wast").prop("checked", true).trigger("click");
                    $('#additional_div').slideUp(1000);

                } else {
                    $('#additional_div').slideDown(1000);

                }

            });

$('#contactno').on('blur', function() {
 
                if ($("#personal_details_form").valid()) {

                    var data = {};

                    data['firstname'] = $('#firstname').val();
                    data['lastname'] = $('#lastname').val();
                    data['email'] = $('#email').val();
                    data['contactno'] = $('#contactno').val();
                    data['address'] = $('#address').val();
                    data['city'] = $('#city').val();
                    data['country'] = $('#country').val();
                    data['postal_code'] = $('#postal_code').val();
                    data['action'] = $('#action').val();
                    data['reference_no'] = $('#referenceNo').val();
                    data['booking_fee'] = "{{ $settings['booking_fee'] }}";
                    data['_token'] = "{{ csrf_token() }}";
                    data['refr'] = $('#refr').val();
                    data['booking_id'] = $('#bookID').val();
                    data['aphactive'] = $('#aphactivebook').val();
                    if (data['action'] == 'airportParkingBooking') {
                        //

                        data['discount'] = $('#disAmount').val();
                        data['company_id'] = $('#bookingDetails input[name="company_id"]').val(),
                            data['product_code'] = $('#bookingDetails input[name="product_code"]').val(),
                            data['parking_type'] = $('#bookingDetails input[name="parking_type"]').val(),

                            data['compant_name'] = $('#bookingDetails input[name="compant_name"]').val(),

                            data['pickdate'] = $('#bookingDetails input[name="pickdate"]').val(),

                            data['dropdate'] = $('#bookingDetails input[name="dropdate"]').val(),

                            data['droptime'] = $('#bookingDetails input[name="droptime"]').val(),
                            data['source_site'] = $('#bookingDetails input[name="source_site"]').val(),

                            data['picktime'] = $('#bookingDetails input[name="picktime"]').val(),

                            data['total_days'] = $('#bookingDetails input[name="total_days"]').val(),

                            data['airport'] = $('#bookingDetails input[name="airport_id"]').val(),

                            data['bookingfor'] = $('#bookingDetails input[name="bookingfor"]').val(),

                            data['promo'] = $('#bookingDetails input[name="promo"]').val(),

                            data['smsfee'] = $("#smsfee").is(':checked') ? 'Yes' : 'No',

                            data['cancelfee'] = $("#cancelfee").is(':checked') ? 'Yes' : 'No',

                            data['passenger'] = $('#passenger').val(),

                            data['incomplete'] = $('#bookingDetails input[name="incomplete"]').val(),

                            data['pl_id'] = $('#bookingDetails input[name="pl_id"]').val(),

                            data['speed_park_active'] = $('#bookingDetails input[name="speed_park_active"]')
                            .val(),

                            data['site_codename'] = $('#bookingDetails input[name="site_codename"]').val(),

                            data['sku'] = $('#bookingDetails input[name="sku"]').val(),

                            data['edin_active'] = $('#bookingDetails input[name="edin_active"]').val()

                        //data['debug']       = 1

                    }

                    $.post('checkBooking', data, function(data) {

                        console.log("data===", data);

                        if (data.booking_id > 0) {

                            if (data.available == "Yes") {

                                $("#bookID").val(data.booking_id);

                                $("#bookID1").val(data.booking_id);

                                $("#referenceNo").val(data.referenceNo);

                                $("#referenceNo1").val(data.referenceNo);

                                $("#incomplete").val('yes');

                            } else {

                            }
                        }
                    }, 'json');

                }

            });
        });


        function showSpinner() {
            $(".overlay").show();
            $("#imgloader").show();
        }

        function hideSpinner() {
            $(".overlay").hide();
            $("#imgloader").hide();
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
                //discount : 1,
                discount: $('#disamount input[name="discount_amount"]').val(),
                airport: $('#bookingDetails input[name="airport_id"]').val(),

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
                source_site: $('#bookingDetails input[name="source_site"]').val(),

                speed_park_active: $('#bookingDetails input[name="speed_park_active"]').val(),

                site_codename: $('#bookingDetails input[name="site_codename"]').val(),

                passenger: $('#passenger').val(),

                promo: $('#bookingDetails input[name="promo"]').val(),

                bookingfor: $('#bookingDetails input[name="bookingfor"]').val(),

                aphactive: $('#bookingDetails input[name="aphactive"]').val(),

                car_wash: $('#carOptions input[type="radio"]:checked').val(),
                wash_type: $('#washOptions input[type="radio"]:checked').val(),

                intent_secret: $('#intent_secret').val(),
                intent_id: $('#intent_id').val(),

                smsfee: smsfee,

                canfee: canfee,

                action: 'booking_checkout'

            };

            data['_token'] = "{{ csrf_token() }}";

            //setProcessBar(75);

            $.post('booking/checkout', data, function(data) {

                console.log(data);

                $("#totalPrice").text('£' + data.total_amount);

                $("#ccPrice").text(data.total_amount);

                $("#ddPrice").val(data.total_amount);

                $("#alltotal").val(data.total_amount);

                $("#disAmount").val(data.discount_amount);
                $("#company_name").text(data.company_name);
                $("#intent_secret").val(data.intent_secret);
                $("#intent_id").val(data.intent_id);



                if (data.booking_amount > 0) {

                    $("#bookingPriceDiv").text('£' + data.booking_amount);

                    $("#bookingprice").val(data.booking_amount);

                } else {

                    //  showalert();

                }

                if (data.discount_amount > 0) {

                    $("#disfeeprice").text('£' + data.discount_amount);

                    $("#disfee").show();

                    $(".promodiscont").hide();

                } else {

                    $("#disfee").hide();

                }

                if (data.booking_fee > 0) {

                    $("#bookfeeprice").text('£' + data.booking_fee);

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

        function validate_vechiledetail() {

            var html = '<label class="error error-vech" >This field is required.</label>';

            var id = 'yes';



            $(".error-vech").remove();

            var id2 = 'yes';

            if (id2 == 'yes') {

                if ($("#departterminal").val() == "") {

                    $("#departterminal_div").after(html);

                    return false;

                }

                if ($("#arrivalterminal").val() == "") {

                    $("#arrivalterminal_div").after(html);

                    return false;

                }
            }

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
            var id2 = 'yes';

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

            if ($("#address").val() == "") {

                $("#address").after(html);

                return false;

            }

            if ($("#city").val() == "") {

                $("#city").after(html);

                return false;

            }
            if ($("#country").val() == "") {

                $("#country").after(html);

                return false;

            }
            if ($("#postal_code").val() == "") {

                $("#postal_code").after(html);

                return false;

            }

            return true;

        }
    </script>

    @if ($settings['payment_type'] == 'stripe')
        <script src="https://js.stripe.com/v3/"></script>

        <script src="{{ secure_asset('assets/stripe/index.js') }}"></script>

        <script src="{{ secure_asset('assets/stripe/example2.js') }}"></script>

        <script src="{{ secure_asset('assets/stripe/l10n.js') }}"></script>
    @endif

    <script>
        $(document).ready(function(e) {



            $('#washOptions input[type="radio"]').click(function(e) {
                getOptionss()
            });


            $('#carOptions input[name="car_type"]').click(function(e) {
                getCharges();
            });

        });

        function getOptionss() {
            var washOption = $('#washOptions input[type="radio"]:checked').val();
            if (washOption == 1) {
                $("#carOptions").hide();


            } else {
                if (document.querySelector('input[name="wash_type"]:checked').value == "2") {

                    $("#standard123").show();
                    $("#Exective123").hide();
                    $("#Premier123").hide();


                    console.log(document.querySelector('input[name="wash_type"]:checked').value)
                }
                if (document.querySelector('input[name="wash_type"]:checked').value == "3") {

                    $("#standard123").hide();
                    $("#Exective123").show();
                    $("#Premier123").hide();


                    console.log(document.querySelector('input[name="wash_type"]:checked').value)
                }
                if (document.querySelector('input[name="wash_type"]:checked').value == "4") {
                    $("#standard123").hide();
                    $("#Exective123").hide();
                    $("#Premier123").show();
                }
                $("#carOptions").show();

            }
            get_charges();
        }

        function getCharges() {
            var carOption = $('#carOptions input[type="radio"]:checked').val();
            $(".standard-price").html(washDetails.Standard[carOption]);
            $(".executive-price").html(washDetails.Executive[carOption]);
            $(".premier-price").html(washDetails.Premier[carOption]);
            get_charges();
        }

        function get_charges() {
            var data = {};


            data['action'] = $('#action').val();

            data['reference_no'] = $('#referenceNo').val();

            data['booking_fee'] = "{{ $settings['booking_fee'] }}";

            data['_token'] = "{{ csrf_token() }}";

            data['booking_id'] = $('#bookID').val();

            data['bookingprice'] = $('#bookingprice').val();

            data['alltotal'] = $('#alltotal').val();

            data['disAmount'] = $('#disAmount').val();

            data['car_wash'] = $('#carOptions input[type="radio"]:checked').val();

            data['wash_type'] = $('#washOptions input[type="radio"]:checked').val();

            data['intent_secret'] = $('#intent_secret').val();

            data['intent_id'] = $('#intent_id').val();



            $.post('checkCarWash', data, function(data) {

                $("#totalPrice").text('£' + data.total_amount);

                $("#ccPrice").text(data.total_amount);

                $("#ddPrice").val(data.total_amount);

                $("#alltotal").val(data.total_amount);
                $("#intent_secret").val(data.intent_secret);
                $("#intent_id").val(data.intent_id);

                if (data.valet_amount > 0) {
                    $("#car_valet_div").text('£' + data.valet_amount);
                    $("#valet_amount").val(data.valet_amount);
                } else {
                    $("#car_valet_div").text('£' + '0.00');
                    $("#valet_amount").val(0);
                }

            }, 'json');
        }
    </script>
    <script></script>
@endsection

<style type="text/css">
    .menu_item a {
        display: inline-block;
        position: relative;
        font-family: sans-serif !important;
        font-size: 36px;
        color: #FFFFFF;
        font-weight: 400;
    }
</style>


<script type="text/javascript">
    (function($) {

        "use strict";
        $(function() {
            $('body').on('click', '.modal-body ul li', function() {
                $('.modal-body ul li').removeClass('active');
                $(this).closest('.modal-body ul li').addClass('active');
            });
        });
        // Cache Selectors
        var date1 = $('.dpd1'),
            date2 = $('.dpd2');


        //Date Picker//
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = date1.datepicker({
            format: 'dd-mm-yyyy',
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 7);
                checkout.setValue(newDate);
                console.log(newDate);

            }
            if (ev.date.valueOf() < checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 7);
                checkout.setValue(newDate);
                console.log(newDate);

            }

            checkin.hide();
            //date2[0].focus();

        }).data('datepicker');

        var checkout = date2.datepicker({
                format: 'dd-mm-yyyy',
                onRender: function(date) {
                    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
                }

            }).on('changeDate', function(ev) {
                checkout.hide();
            })
            .data('datepicker');



    })(jQuery);


    (function($) {


        // Cache Selectors
        var date1 = $('.right_dpd1'),
            date2 = $('.right_dpd2');


        //Date Picker//
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

        var checkin = date1.datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            if (ev.date.valueOf() > checkout.date.valueOf()) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 7);
                checkout.setValue(newDate);
            }

            checkin.hide();
            date2[0].focus();

        }).data('datepicker');

        var checkout = date2.datepicker({
            onRender: function(date) {
                return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
            }

        }).on('changeDate', function(ev) {
            checkout.hide();
        }).data('datepicker');


    })(jQuery);
    var date1 = $('.dpd1'),
        date2 = $('.dpd2');

    var startdate = new Date();
    startdate.setDate(startdate.getDate() - 1);


    date1.datepicker({
            startDate: startdate,
            todayHighlight: 'TRUE',
            format: 'dd-mm-yyyy',
        })
        .on('changeDate', function(e) {
            $(this).datepicker('hide');
        });

    date2.datepicker({
            startDate: startdate,
            todayHighlight: 'TRUE',
            format: 'dd-mm-yyyy',
        })
        .on('changeDate', function(e) {
            $(this).datepicker('hide');
        });



    $('.moreinfo').click(function() {
        $('#infoModal').modal('toggle');
        $.ajax({
            type: 'POST',
            data: {
                id: $(this).data('id')
            },
            dataType: 'json',
            url: '{{ route('loadinfo') }}',
            success: function(res) {
                //var parsed_data = JSON.stringify(res);
                //console.log(res[0].overview);
                var len = res.length;
                var revhtml = '';
                for (var i = 0; i < len; i++) {
                    if (res[i].username != null) {
                        var rat = res[i].rating;
                        revhtml += ` <div class="card" >
                        <div class="card-body">
                          <h4 class="card-title" style="margin-top:0">` + res[i].username + ` | ` + res[i].title +
                            ` </h4>`;

                        for ($x = 1; $x <= res[i].rating; $x++) {
                            revhtml += `<span class="fa fa-star checked"></span>`;
                        }
                        // if (rat.indexOf(".") > -1) {
                        //     revhtml +=`<span class="fa fa-star"></span>`;
                        //     $x++;
                        // }
                        while ($x <= 5) {
                            revhtml += ` <span class="fa fa-star"></span>`;
                            $x++;
                        }

                        revhtml += `<p class="card-text">` + res[i].review + `</p>  </div>
                      </div>`;
                    }
                }
                $(".reviews-result").html(revhtml);
                $(".info-overview").html(res[0].overview);
                $(".info-arrivals").html(res[0].arival);
                $(".info-return").html(res[0].return_proc);
            }
        })
    });
</script>


<script>
    function checkFields() {
      var nameValue = document.getElementById('firstname').value.trim();
      var name2Value = document.getElementById('lastname').value.trim();
      var emailValue = document.getElementById('email').value.trim();
      var phoneField = document.getElementById('contactno');

      // Disable phone field if both name and email are empty
      if (nameValue !== '' && emailValue !== '' && name2Value !== '') {
        phoneField.disabled = false;
      } else {
        phoneField.disabled = true;
      }
    }
  </script>