@extends('layouts.main')
<style>
	.section-b2 {
		height: auto !important;
	}

	#search_form_1 {
		margin: 0 !important;
	}

    #wrapper h3 b, #wrapper h4 b {
        font-weight: inherit !important;
	}

	#wrapper h3 {
        font-size: 20px !important;
        color: #1f2937 !important;
        font-weight: 700 !important;
		font-family: "Muli", sans-serif !important;
    }

	#wrapper h4 {
        font-size: 18px !important;
        color: #1f2937 !important;
        font-weight: 700 !important;
		font-family: "Muli", sans-serif !important;
    }

	#wrapper #section p {
        font-size: 17px !important;
		color: #6c757d!important;
		font-family: "Muli", sans-serif !important;
    }

	.staticPageSec .inner-content > .row:nth-child(2) {
		margin-top: 60px;
	}

	@media(min-width: 768px) {
        .staticPageSec .inner-content > .row:nth-child(2) {
			margin-top: 100px;
		}

		.inner-content > .row:nth-child(2) {
			padding: 50px 0;
		}
    }

	.inner-content > .row:nth-child(2) {
		position: relative;
	}

	.inner-content > .row:nth-child(2) > * {
		position: relative;
		z-index: 2;
	}

	.inner-content > .row:nth-child(2)::after{
		content: '';
		position: absolute;
		top: -50px;
		left: -100%;
		width: calc(100vw + 100%);
		height: calc(100% + 100px);
		background: #ededed;
		z-index: 1;
	}

	section#section-b.happyClients.testimonial {
      margin: 100px 0 120px !important;
    }

    @media(max-width: 768px) {
      section#section-b.happyClients.testimonial {
		margin-bottom: unset !important;
        margin: 50px 0 100px !important;
      }

	  #section.staticPageSec .inner-content .col-cent img {
		max-height: 100% !important;
	  }

	  .inner-content.px-4 {
		padding: 0 !important;
	  }
	}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@section('content')

<section id="bg-css" style="background-image: url('theme-new/img/Banner-V2-others.png');background-size: cover;">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 pt-67" id="slideInRight">
                            <h1 class="h3banner" style="">Book Now</h1>
                            <p class="banner-description">Convenient, secure parking at Stansted Airport.</p>
                        </div>
                        @include('layouts.search_form_others') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="section" class="staticPageSec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-55">
				<div class="inner-content px-4">
					<div class="row">
					    <div class="col-lg-7" style="margin-top:3%;">
					        <h3 style="font-size: 20px; font-weight: bold; margin-top: 30px; margin-bottom: 15px;">
                                <span style="font-size: 20px; font-weight: bold;">Your Journey Begins Here: </span><span style="font-size: 20px; font-weight: bold;"> Park with Self-Assuredness</span>
                            </h3>
                            
                            <p style="font-size: 14px; margin-bottom: 8px; text-align: justify;">
                                Don't worry. Don't panic at the last minute. Just reliable, simple, and reasonably priced airport parking. It takes less than a minute to book with Xpert Airport Parking, and your car is kept safe until you return.
                            </p>
                            
                            <h3 style="font-size: 20px; font-weight: bold; margin-top: 30px; margin-bottom: 15px;">
                                <span style="font-size: 20px; font-weight: bold;">How It Operates: </span>
                            </h3>
                            
                            <p style="font-size: 14px; margin-bottom: 8px; text-align: justify;">
                                Notify Us When You Take Off. Decide on times and dates. 
                            </p>
                            
                            <h3 style="font-size: 20px; font-weight: bold; margin-top: 30px; margin-bottom: 15px;">
                                <span style="font-size: 20px; font-weight: bold;">Select Your Spot: </span>
                            </h3>
                            
                            <p style="font-size: 14px; margin-bottom: 8px; text-align: justify;">
                               Examine safe, closely watched parking possibilities.
                            </p>
                            
                            <h3 style="font-size: 20px; font-weight: bold; margin-top: 30px; margin-bottom: 15px;">
                                <span style="font-size: 20px; font-weight: bold;">Book & Unwind: </span>
                            </h3>
                            
                            <p style="font-size: 14px; margin-bottom: 8px; text-align: justify;">
                               No worry, instant confirmation. 
                            </p>
					    </div>
					    <div class="col-lg-5 col-rght">
					        <img class="img-fluid" style="margin-top: 30px;height: 465px;" alt="" src="https://www.xpertairportparking.com/storage/pagebanners/nu3esgfH1dmDUlYgQVEpbWOxBQ7DdKd3FDyH0Wmy.png">
					    </div>
					    <div class="col-lg-5 col-cent">
					        <img class="img-fluid" style="margin-top: 30px;" alt="" src="https://www.xpertairportparking.com/storage/pagebanners/nu3esgfH1dmDUlYgQVEpbWOxBQ7DdKd3FDyH0Wmy.png">
					    </div>
					</div>
					
					<div class="row">
					    <div class="col-lg-5 col-rght">
					        <img class="img-fluid" style="margin-top: 30px;height: 465px;" alt="" src="https://www.xpertairportparking.com/storage/pagebanners/zzbd9zTxEfW0x46LpswxOxe8Hd6izgEORTXoM7LD.png">
					    </div>
					    <div class="col-lg-7 align-content-center">
					        <h3 style="font-size: 20px; font-weight: bold; margin-top: 30px; margin-bottom: 15px;">
                                <span style="font-size: 20px; font-weight: bold;">Why Travelers Love Us: Safe & Secure: </span>
                            </h3>
                            
                            <p style="font-size: 14px; margin-bottom: 8px; text-align: justify;">
                                Professional on-site staff and round-the-clock CCTV.
                            </p>
                            
                            <h3 style="font-size: 20px; font-weight: bold; margin-top: 30px; margin-bottom: 15px;">
                                <span style="font-size: 20px; font-weight: bold;">Excellent Value: </span>
                            </h3>
                            
                            <p style="font-size: 14px; margin-bottom: 8px; text-align: justify;">
                                Reasonably priced with no additional costs.
                            </p>
                            
                            <h3 style="font-size: 20px; font-weight: bold; margin-top: 30px; margin-bottom: 15px;">
                                <span style="font-size: 20px; font-weight: bold;">Dependable Service: </span>
                            </h3>
                            
                            <p style="font-size: 14px; margin-bottom: 8px; text-align: justify;">
                                We handle your vehicle as if it were our own.
                            </p>
                            
                            <h3 style="line-height: 1.38; margin-top: 12pt; margin-bottom: 2pt; font-size: 20px; font-family: Arial, sans-serif;"><b>Are You All Set to Go? </b></h3>

                            <p style="line-height: 1.38; margin-top: 12pt; margin-bottom: 12pt; font-size: 14px; font-family: Arial, sans-serif;">Now that your flight is scheduled, you may cross parking off your list. To reserve your spot and travel with confidence, <b><a href = "/book-now">Book Now</b></a></p>
					    </div>
					    
					    <div class="col-lg-5 col-cent">
					        <img class="img-fluid" style="margin-top: 30px;" alt="" src="https://www.xpertairportparking.com/storage/pagebanners/zzbd9zTxEfW0x46LpswxOxe8Hd6izgEORTXoM7LD.png">
					    </div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>

<section id="section-b" class="section-b2 happyClients testimonial">
		<div class="container">
			<div class="row justify-content-center">
				<div class="section-heading">
				    <h2 class="section-3-h2">Our Happy  <span> Clients </span></h2>
					 @include('layouts.happy_clients')
				</div>
			</div>
		</div>
</section>


<script>
    let $blocks = $('.block-card');

$('.filter-btn').on('click', e => {
  let $btn = $(e.target).addClass('active');
  $btn.siblings().removeClass('active');
  
  let selector = $btn.data('target');
  $blocks.removeClass('active').filter(selector).addClass('active');
});
</script>
<!--@include('layouts.parking_type')-->
@endsection

