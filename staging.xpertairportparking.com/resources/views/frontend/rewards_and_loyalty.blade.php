@extends('layouts.main')
<title>Xpert Airport Parking Rewards and Loyalty Program </title>
<meta name="description" content="Elevate your travel experience with Xpert Airport Parking Parking Rewards & Loyalty Program, exclusively for our valued Meet and Greet customers">
<style>
    .sidebar {
    padding: 30px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}
.sidebar .sidebar-title {
    font-size: 20px;
    font-weight: 700;
    padding: 0 0 0 0;
    margin: 0 0 15px 0;
    color: #3c4133;
    position: relative;
}
.sidebar .recent-posts img {
    width: 80px;
    height: 53px;
    float: left;
}
.recent-posts h4 {
    font-size: 15px;
    margin-left: 95px;
    font-weight: bold;
}
.blog .sidebar .recent-posts h4 a {
    color: #3c4133;
    transition: 0.3s;
}
.sidebar .recent-posts time {
    display: block;
    margin-left: 95px;
    font-style: italic;
    font-size: 14px;
    color: #1FA9FF;
    font-weight: 600;
}
/*span{font-size:18px !important;}*/

        @media only screen and (max-width: 600px)  {
            #section-b{margin-bottom: 0px !important}
        }
.subnav-content{left: -531px !important;width: 1500% !important;}
footer .round-btn a{margin-top: 3px;}
@media only screen and (min-width: 1200px)  {
    #section{margin-top:130px !important}
}
.section-3-h2{color:#c72037;font-size:36px;font-weight:bold;}
@media only screen and (min-width: 992px)  {
    .col-percentage{justify-content: center;display:flex;}
}
@media only screen and (min-width: 992px)  {
    .card-body-cs{ height: 211px;  }
}
.card-body-cs{ border-bottom-left-radius: 19px;border-bottom-right-radius: 19px; }
@media screen and (min-device-width: 768px) and (max-device-width: 991px) { 
.card-body-cs{height: 217px; }
.card-cs{margin-bottom:20px;}
.row-css1{justify-content: center;}
}
@media only screen and (min-width: 767px)  {
    .card-cs{width: 20rem;height: 370px !important;}
}
@media only screen and (max-width: 767px)  {
    .card-cs{margin-bottom: 20px;}
}
.section-3-p{color:#434343;font-size:18px;line-height: 1.7;}

@media only screen and (min-width: 992px)  {
    .col-r{text-align:right}
    /*.btn-h2{margin-top: 36px !important;}*/
}
@media only screen and (max-width: 991px)  {
    .col-r{text-align:center}
}
.card-title1 {
    color: #00519A;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
}
.card-title {
    margin-top: 15px;
    margin-bottom: 20px;
}
.section-3-h2s{
    color: #c72037;
    font-size: 26px;
    font-weight: bold;
}
.loyl-img{
    height: 146px !important;
}
.card-cs{
    border-radius: 19px;
    border: 1px dashed !important;
}
.find-parking-button1 {
  display: inline-block;
   padding: 10px 25px;
  background-color: #000000 ; /* Bootstrap primary blue */
  color: #fff;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  font-weight: 500;
  text-decoration: none;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.find-parking-button1:hover {
  background-color: #000000;
  transform: translateY(-2px);
  text-decoration: none;
  color: #fff;
} 
	.find-parking-button12 {
  display: inline-block;
   padding: 10px 25px;
  background-color: #714a97 ; /* Bootstrap primary blue */
  color: #fff;
  border: none;
  border-radius: 6px;
  font-size: 16px;
  font-weight: 500;
  text-decoration: none;
  transition: background-color 0.3s ease, transform 0.3s ease;
}

.find-parking-button12:hover {
  background-color: #714a97;
  transform: translateY(-2px);
  text-decoration: none;
  color: #fff;
}  
	 
 
    @media screen and (max-width: 992px) {
    .on-mobile {
       align-items: center;
    display: grid;
    justify-content: center;
    text-align: center;
    margin-top: 16px;
    }
    .on-mobilev {

    margin-top: 16px;
    }
    
}
.cta-modern-section {
    background-size: cover;
    background-position: center;
    padding: 40px 20px;
    border-radius: 20px;
    color: #fff;
    margin: 40px auto;
    max-width: 1200px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    overflow: hidden;
}

.container-custom {
    display: flex;
    justify-content: space-between;
    align-items: center;
 
  
}

.cta-text {
   
    min-width: 280px;
}

.cta-text h2 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #fff;
}

.cta-text p {
    font-size: 1.1rem;
    margin-bottom: 30px;
    color: #f8f9fa;
    opacity: 0.95;
}

.cta-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
}

.cta-buttons .cta-btn {
     padding: 10px 25px;
  background-color: #000000 ; /* Bootstrap primary blue */
  color: #fff;
  border: none;
  border-radius: 6px;
  font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    text-align: center;
    box-shadow: inset -3px -3px 7px rgba(255, 255, 255, 0.1),
                inset 3px 3px 7px rgba(0, 0, 0, 0.3);
    transition: background-color 0.3s ease;
}

.cta-buttons .cta-btn:hover {
    background-color: #222;
}

.cta-image {
    /* flex: 1 1 300px; */
    text-align: center;
}

.cta-image img {
    max-width: 53%;
    height: auto;
    border-radius: 12px;
}

/* === Tablet & Below === */
@media (max-width: 992px) {
    .cta-text h2 {
        font-size: 2rem;
    }

    .cta-text p {
        font-size: 1rem;
    }

    .cta-buttons {
        justify-content: center;
    }

    .cta-buttons .cta-btn {
        width: auto;
    }

    .cta-image img {
        max-width: 40%;
    }
}


/* === Mobile === */
@media (max-width: 576px) {
    .container-custom {
        flex-direction: column;
        text-align: center;
    }

    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }

    .cta-buttons .cta-btn {
        width: 100%;
        max-width: 280px;
    }

    .cta-image {
        margin-top: 20px;
    }

    .cta-image img {
        max-width: 40%;
    }
    .cta-modern-section {
    
    margin: 40px 10px;
  
}
}

.section-b2 {
    height: auto !important;
}

section#section-b.happyClients {
    margin: 100px 0 120px !important;
}

@media(max-width: 768px) {
    section#section-b.happyClients {
    margin-bottom: unset !important;
    margin: 50px 0 100px !important;
    }
}

/* -- */
#bg-css {
    position: relative;
}

#bg-css > .container {
    position: relative;
    z-index: 2;
}

#bg-css::after{
    content: '';
    background-color: black;
    width: 100%;
    height: 100%;
    display: block;
    position: absolute;
    z-index: 1;
    top: 0;
    left: 0;
    opacity: 0.6;
}

.p-t-671 {
    padding-top: 67px;
    padding-bottom: 67px;
}

.section-31.rewardSec {
    padding: 100px 0;
    background: #ededed;
}

.section-31.rewardSec .img-h1 {
    object-fit: cover;
    object-position: right;
    border-radius: 10px;
}

.section-3.rewardSec {
    padding: 100px 0;
    margin: 0;
}

.cta-modern-section {
    margin-top: 100px;
}

.loyaltySec {
    padding: 100px 0;
    background: #ededed;
}

.card.card-cs {
    border: 1px solid #00000024 !important;
}

.card.card-cs .card-body.card-body-cs {
    background: white;
    text-align: center;
}

.card.card-cs ul { 
    list-style: none;
}

.card.card-cs ul li {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
}

.card.card-cs ul li i {
    color: #714a97;
}

.card-title1 {
    color: #1f2937;
}

.section-3-h2 span {
    color: #714a97 !important;
}

.rewardTitle {
    font-size: 20px;
    font-weight: 700;
    color: #1f2937;
}

.xap-loyalty-cta-section {
    background-image: url("{{ asset('banner/676d58821e180.png') }}");
    background-size: cover;
    height: 320px;
    position: relative;
}

.xap-loyalty-cta-section::after{
    content: '';
    background-color: black;
    width: 100%;
    height: 100%;
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    opacity: 0.8;
}

.xap-loyalty-cta-section .container, .xap-loyalty-cta-section .row  {
    height: 100%;
    z-index: 1;
    position: relative;
}

.xap-loyalty-cta-section-heading {
    font-size: 36px;
    color: white;
    font-weight: 800;
}

.xap-loyalty-cta-section-subheading {
    font-size: 22px;
    color: white;
}

.xap-book-now-button a {
    background: #714a97;
}

@media(max-width: 768px) {
    .xap-loyalty-cta-section {
        text-align: center;
        height: auto;
        padding: 100px 0;
    }

    .xap-loyalty-cta-section .container, .xap-loyalty-cta-section .row {
        height: auto;
    }

    .xap-loyalty-cta-section .find-parking-button1 {
        margin-top: 20px;
    }

    .section-3-p {
        margin-left: 0 !important;
    }
}

@media(max-width: 992px) {
    .xap-loyalty-cta-section-heading {
        font-size: 25px;
    }

    .xap-loyalty-cta-section-subheading {
        font-size: 16px;
    }

    .section-3.rewardSec {
        padding: 30px 0;
        margin: 0 !important;
    }

    .section-31.rewardSec {
        padding: 30px 0;
    }

    .loyaltySec {
        padding: 30px 0;
    }

    section.rewardSec .section-3-h2 {
        font-size: 25px !important;
        margin-bottom: 25px !important;
        text-align: left !important;
    }

    section.loyaltySec .section-3-h2 {
        font-size: 25px !important;
        margin-bottom: 25px !important;
    }

    .on-mobile {
        display: flex; 
        gap: 8px;
        align-items: center;
        justify-content: start;
        margin-bottom: 30px;
    }

    .on-mobile a {
        margin: 0;
    }
}

</style>
@section('content')

<section id="bg-css" style="background-image: url('theme-new/img/banner-v4.webp');background-size: cover;">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 p-t-671">
                            <h1 class="h3banner" style="">Rewards and Loyalty</h1>
                            <p style="color:white;font-size:20px;text-align: center;">Convenient, secure parking at Xpert Airport Parking.</p>
                        </div>
                        {{-- @include('layouts.search_form_others')  --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 
<section class="section-31 rewardSec ">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12">
                <h2 class="section-3-h2">Join Our <span style="color:#00519A">Rewards and Loyalty </span>Program</h2>
                <p class="section-3-p">
                    At Xpert Airport Parking, we understand that your loyalty means everything to us, and we want to give back in a meaningful way. Our Rewards and Loyalty Program allows you to unlock a range of exciting perks and discounts, making every trip more enjoyable. For every booking, referral, or interaction, you’ll earn points that you can redeem for discounts on future services, free upgrades, and exclusive offers that are only available to members. Additionally, we keep things personal—our program lets us tailor offers and rewards based on your preferences, so you always feel valued. With priority customer support and access to special promotions, our Rewards and Loyalty Program ensures that your airport parking experience is seamless and even more affordable. Whether you're a frequent traveller or just looking for convenience, our program is designed to make your journey easier and more rewarding. Don’t miss out—join today and start making the most of every booking.
                </p>
                <div  class="on-mobile">
                           <a  href="{{ url('customer-login') }}" class=" find-parking-button1"  style="margin-right: 10px;">Already a Member? Login</a> 
                           <a  href="{{ url('c-register') }}" class=" find-parking-button12 on-mobilev" style=" ">Join Now</a> 
                </div>

            </div>
            <div class="col-lg-5 col-md-12 col-r">
                <img src="{{url('theme-new/img/reward.jpg')}}" class="img-fluid img-h1"  alt="image-1">
            </div>
             </div>
</section>
            <section class="section-3 rewardSec ">
    <div class="container">
            <div class="col-lg-12">
                <h2 class="section-3-h2 text-center mb-5">Why Join Our <span>Rewards Program?</span></h2>
                <div class="seperator"></div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="rewardCont">
                            <p class="rewardTitle">Enjoy Exclusive Benefits</p>
                            <p class="section-3-p">
                                As a member, you'll unlock access to special discounts, exclusive offers, and priority entry to promotions and events. We strive to make your experience with us more rewarding at every step.
                            </p>
                            <p class="rewardTitle">Earn Rewards with Every Booking</p>
                            <p class="section-3-p">
                                With each booking, referral, and interaction, you'll earn points that can be redeemed for exciting rewards. It's our way of thanking you for your continued loyalty and support.
                            </p>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="rewardCont">
                            <p class="rewardTitle">Tailored for You</p>
                            <p class="section-3-p">
                                We customize your experience based on your preferences and needs, ensuring your journey with us is smooth, convenient, and enjoyable.
                            </p>
                            <p class="rewardTitle">Fast-Track Support</p>
                            <p class="section-3-p">
                                As a loyal member, you’ll receive priority support, ensuring that your questions and concerns are addressed quickly and efficiently by our dedicated customer service team.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
             
        </div>
    </div>
</section>

<section class="xap-loyalty-cta-section">

    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-9">
            <h4 class="xap-loyalty-cta-section-heading">The Intelligent Way to Park Before You Fly</h4>
            <p class="xap-loyalty-cta-section-subheading">Secure your parking. Travel with peace of mind.</p>
            </div>

            <div class="col-md-3 text-center">
            <div class="xap-book-now-button" id="slideInRight">
                <a href="{{ url('/') }}" class=" find-parking-button1">Book Now</a>
            </div>
            </div>
        </div>
    </div>

</section>




<section class="section-4 loyaltySec">
    <div class="container">
        <div class="row row-css1">
            <div class="col-lg-12 text-center">
                <h2 class="section-3-h2 mb-5">Get Loyalty Reward <span>From Xpert Airport Parking</span></h2>
                <div class="seperator mb-3"></div>
            </div>
            <div class="col-lg-4 col-md-6 col-percentage">
                <div class="card card-cs">
                    <div class="text-center my-3">
                        <img src="{{url('theme-new/img/Reward-Loyality-Silveer.png')}}" class="img-fluid img-h1 loyl-img"  alt="image-1">
                    </div>
                  
                  <div class="card-body card-body-cs">
                    <h5 class="card-title card-title1">12% OFF Every Booking</h5>
                    <ul class="card-text">
                        <li><i class="fa-solid fa-square-check"></i>Make 1-4 Direct Bookings</li>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-percentage">
                <div class="card card-cs">
                    <div class="text-center my-3">
                        <img src="{{url('theme-new/img/Reward-Loyality-Gold.png')}}" class="img-fluid img-h1 loyl-img"  alt="image-1">
                    </div>
                  
                  <div class="card-body card-body-cs">
                    <h5 class="card-title card-title1">15% OFF Every Booking </h5>
                    <ul class="card-text">
                        <li><i class="fa-solid fa-square-check"></i>Make 5+ Bookings</li>
                        <li><i class="fa-solid fa-square-check"></i>Preferential Seasonal Rates</li>
                    </ul>
                  </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-percentage">
                <div class="card card-cs">
                <div class="text-center my-3">
                    <img src="{{url('theme-new/img/Reward-Loyality-Diamond.png')}}" class="img-fluid img-h1 loyl-img"  alt="image-1">
                  </div>
                  <div class="card-body card-body-cs">
                    <h5 class="card-title card-title1">20% OFF Every Booking</h5>
                    <ul class="card-text">
                        <li><i class="fa-solid fa-square-check"></i>Make 20+ Bookings</li>
                        <li><i class="fa-solid fa-square-check"></i>Become a Member for 7 years</li>
                    </ul>
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
				    <h2 class="section-3-h2">Our Happy  <span> Clients </span></h2>
                <div class="seperator"></div>

					 @include('layouts.happy_clients')
				</div>
			</div>
		</div>
</section>


<!--@include('layouts.parking_type')-->
@endsection

