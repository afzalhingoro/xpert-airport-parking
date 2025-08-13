@extends('layouts.main')
@section('content')
<style>
        .first-txt {
            position: absolute;padding: 11px;width:100%;text-shadow: 2px 2px #333333; color: white;
        }
        .title{ font-size: 18px;
                font-weight: 600;
                color: #00519A;
                padding-top: 16px;
                text-align: left;
        }
    .section-3{margin-top:80px;
        
    }
    .section-3-h2{color:#FAB03F;font-size:36px;font-weight:bold;}
 .section-3-p {color: #434343;font-size: 18px;line-height: 1.7;}
</style>
@include('layouts.search_form')	
<div style="padding-bottom:20px;margin-top: 150px;">
<section class="section-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-3-h2" style="margin-bottom: 45px;">Choose <span style="color:#00519A"> Us </span></h2>
            </div>
            <div class="col-lg-12">
                <p class="section-3-p">
                    At our company, we hold our customers in high regard, considering them as our most valuable assets. Our unwavering commitment is to provide top-notch quality services that surpass industry standards,
                    all with the aim of ensuring your satisfaction and convenience.<br>
                    To guarantee this level of excellence, we have stringent quality checklists that all our parking service providers and contractors must meet. These checklists serve as a benchmark, ensuring that
                    every aspect of our services aligns with our commitment to quality.<br>
                    Our core focus remains on simplifying your travel experience and offering a convenient Meet and Greet service. Furthermore, we take your vehicle's safety seriously, as our car parks are equipped 
                    with 24-hour security surveillance technology.
                </p>
            </div>
        </div>
    </div>
</section>
</div>
<section id="section-b" class="section-b2" style="margin-top: 15px;" >
		<div class="container">
			<div class="row justify-content-center">
				<div class="section-heading">
				    <h2 class="section-3-h2" style="margin-bottom: 45px;">Our Happy  <span style="color:#00519A"> Clients </span></h2>
					 @include('layouts.happy_clients')
				</div>
			</div>
		</div>
</section>
@endsection