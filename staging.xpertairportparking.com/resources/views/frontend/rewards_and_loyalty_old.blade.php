@extends('layouts.main')
<title>Xpert Airport Parking Rewards and Loyalty Program </title>
<meta name="description" content="Elevate your travel experience with Xpert Airport Parking Rewards & Loyalty Program, exclusively for our valued Meet and Greet customers">

@section('content')

<section id="bg-css" style="background-image: url('theme-new/img/banner-v4.png');background-size: cover;">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12"  style="padding-top:67px">
                            <h1 class="h3banner" style="">Rewards and Loyalty</h1>
                            <p style="color:white;font-size:20px;text-align: center;">Convenient, secure parking at Stansted Airport.</p>
                        </div>
                        @include('layouts.search_form_others') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-3 rewardLoyality">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-3-h2">Join Our <span style="color:#00519A">Rewards and Loyalty </span>Program</h2>
                <p class="section-3-p">
                    At Xpert Airport Parking, we understand that your loyalty means everything to us, and we want to give back in a meaningful way. Our Rewards and Loyalty Program allows you to unlock a range of exciting perks and discounts, making every trip more enjoyable. For every booking, referral, or interaction, you’ll earn points that you can redeem for discounts on future services, free upgrades, and exclusive offers that are only available to members. Additionally, we keep things personal—our program lets us tailor offers and rewards based on your preferences, so you always feel valued. With priority customer support and access to special promotions, our Rewards and Loyalty Program ensures that your airport parking experience is seamless and even more affordable. Whether you're a frequent traveller or just looking for convenience, our program is designed to make your journey easier and more rewarding. Don’t miss out—join today and start making the most of every booking!
                </p>
            </div>
            <div style="margin-left:-6%;" class="col-lg-6 col-r">
                <img src="{{url('theme-new/img/Loyality-Reward-Post.png')}}" class="img-fluid img-h1 "  alt="image-1">
            </div>
            <div class="col-lg-12">
                <h2 class="section-3-h2 text-center my-3"><span style="color:#00519A">Why Join Our </span>Rewards Program?</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <p style="font-weight: 600;color: #00519A;font-size: 20px;">Enjoy Exclusive Benefits</p>
                        <p class="section-3-p">
                            As a member, you'll unlock access to special discounts, exclusive offers, and priority entry to promotions and events. We strive to make your experience with us more rewarding at every step.
                        </p>
                        <p style="font-weight: 600;color: #00519A;font-size: 20px;">Earn Rewards with Every Booking</p>
                        <p class="section-3-p">
                            With each booking, referral, and interaction, you'll earn points that can be redeemed for exciting rewards. It's our way of thanking you for your continued loyalty and support.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <p style="font-weight: 600;color: #00519A;font-size: 20px;">Tailored for You</p>
                        <p class="section-3-p">
                            We customize your experience based on your preferences and needs, ensuring your journey with us is smooth, convenient, and enjoyable.
                        </p>
                        <p style="font-weight: 600;color: #00519A;font-size: 20px;">Fast-Track Support</p>
                        <p class="section-3-p">
                            As a loyal member, you’ll receive priority support, ensuring that your questions and concerns are addressed quickly and efficiently by our dedicated customer service team.
                        </p>
                    </div>
                </div>
            </div>
             
        </div>
    </div>
</section>

<section class="section-4 getRewardSec" >
    <div class="container">
        <div class="row row-css1">
            <div class="col-lg-12 text-center">
                <h2 class="section-3-h2">Get Loyalty Reward <span style="color:#00519A">From Xpert Airport Parking</span></h2>
                <br>
            </div>
            <div class="col-lg-4 col-md-6 col-percentage">
                <div class="card card-cs">
                    <div class="text-center my-3">
                        <img src="{{url('theme-new/img/Reward-Loyality-Silveer.png')}}" class="img-fluid img-h1 loyl-img"  alt="image-1">
                    </div>
                  
                  <div class="card-body card-body-cs">
                    <h5 class="card-title card-title1">12% OFF <br>Every Booking</h5>
                    <p class="card-text">
                        <table>
                            <tr>
                                <td style="padding-right: 17px;"><p><i class="fa-solid fa-check icon-css1"></i></p></td>
                                <td><p class="td-p m-0">Make 1-4 Direct Bookings</p></td>
                            </tr>
                        </table>
                    </p>
                  </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-percentage">
                <div class="card card-cs">
                    <div class="text-center my-3">
                        <img src="{{url('theme-new/img/Reward-Loyality-Gold.png')}}" class="img-fluid img-h1 loyl-img"  alt="image-1">
                    </div>
                  
                  <div class="card-body card-body-cs">
                    <h5 class="card-title card-title1">15% OFF <br>Every Booking </h5>
                    <p class="card-text">
                        <table>
                            <tr>
                                <td style="padding-right: 17px;"><p><i class="fa-solid fa-check icon-css1"></i></p></td>
                                <td><p class="td-p m-0">Make 5+ Bookings</p></td>
                            </tr>
                            <!--<tr>-->
                            <!--    <td style="padding-right: 17px;"><p><i class="fa-solid fa-check icon-css1"></i></p></td>-->
                            <!--    <td><p class="td-p m-0">Become a Member for 3 years</p></td>-->
                                <!--<td><p class="td-p">Make (or) Member for 3 Year</p></td>-->
                            <!--</tr>-->
                            <tr>
                                <td style="padding-right: 17px;"><p><i class="fa-solid fa-check icon-css1"></i></p></td>
                                <td><p class="td-p m-0">Preferential Seasonal Rates</p></td>
                            </tr>
                        </table>
                    </p>
                  </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-percentage">
                <div class="card card-cs">
                <div class="text-center my-3">
                    <img src="{{url('theme-new/img/Reward-Loyality-Diamond.png')}}" class="img-fluid img-h1 loyl-img"  alt="image-1">
                  </div>
                  <div class="card-body card-body-cs">
                    <h5 class="card-title card-title1">20% OFF <br>Every Booking</h5>
                    <p class="card-text">
                        <table>
                            <tr>
                                <td style="padding-right: 17px;"><p><i class="fa-solid fa-check icon-css1"></i></p></td>
                                <td><p class="td-p m-0">Make 20+ Bookings</p></td>
                            </tr>
                            <tr>
                                <td style="padding-right: 17px;"><p><i class="fa-solid fa-check icon-css1"></i></p></td>
                                <!--<td><p class="td-p">(or) Member for 7 Year</p></td>-->
                                <td><p class="td-p m-0">Become a Member for 7 years</p></td>
                            </tr>
                            <!--<tr>-->
                            <!--    <td style="padding-right: 17px;"><p><i class="fa-solid fa-check icon-css1"></i></p></td>-->
                            <!--    <td><p class="td-p m-0">Preferential Seasonal Rates</p></td>-->
                            <!--</tr>-->
                        </table>
                    </p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section id="section-b" class="section-b2 happyClients">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-heading">
                    <h2 class="section-3-h2" style="margin-bottom: 5px;">Our Happy  <span style="color:#242d62;font-size: 35px !important;"> Clients </span></h2>
                     @include('layouts.happy_clients')
                </div>
            </div>
        </div>
</section>


<!--@include('layouts.parking_type')-->
@endsection

