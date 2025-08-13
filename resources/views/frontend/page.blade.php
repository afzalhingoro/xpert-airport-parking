@extends('layouts.main')
@section("title",$page->meta_title)
@section("meta_keyword",$page->meta_keyword )
@section("meta_description",$page->meta_description)
@section('content')

@include('layouts.search_form')

	<!-- Intro -->
	@php
        $site_settings_main=[];
            $settingsAll = App\settings::all();
                    foreach ($settingsAll as $setting) {
                        $site_settings_main[$setting->field_name] = $setting->field_value;
                    }
    @endphp

	
	<style>
	    .options{
            border: 2px solid #fff;
            border-radius: 10px;
            padding: 10px;
            height: 545px;
            margin-top:10px;
	    }
	    .border-box{
	       background-color: #e7e7e7;
	    }
            @media  screen and (max-width: 400px){
            .options {
                height: auto;
                margin-top:10px;
            }
            #airport-location .nav-tabs .nav-link {
                font-size: 11px;
            }
        }
        /*p{*/
        /*    color: #000;*/
        /*    font-weight: 400 !important;*/
        /*}*/
        /*span{*/
        /*    color: #000;*/
        /*    font-weight: 400 !important;*/
        /*}*/
        h2 {
           color: #000;
           font-weight: 600 !important;
        }
        h4 {
           color: #000;
           font-weight: 600 !important;
           font-size: 18px;
        }
        @media screen 
          and (min-device-width: 700px) 
          and (max-device-width: 1200px){
                .nav-span {
                    font-size: 11px;
                    font-weight: 400;
                }
        }
        @media screen 
          and (min-device-width: 1020px) 
          and (max-device-width: 1370px){
               .options {
                    border: 2px solid #fff;
                    border-radius: 10px;
                    padding: 10px;
                    height: 615px;
                    margin-top: 10px;
                }
        }
	</style>
	
	<section id="section" style="background-color:#fff; padding: 40px 0px; margin-top: 0px;">
		<div class="container" id="airport-location">
			<div class="row justify-content-center">
				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
					<nav>
						<div class="nav nav-tabs border-clr" id="nav-tab" role="tablist">
							<button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#parking" href="#parking" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Airport Parking</button>
							<button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#overview" href="#overview" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Airport Overview</button>
							<button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#fac" href="#fac" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Airport Facilities</button>
							<button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#top_things" href="#top_things" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Top things to do at</button>
						</div>
					</nav>
					<div class="tab-content" id="nav-tabContent">
					    {!! $page->content !!} 
					</div>
				
				</div>
			</div>
		</div>
	</section>

	<section id="section" style="background-color:#1773b9; padding: 40px 0px; margin-bottom: 0px;">
		<div class="container">
			<div class="row">
				<h1 class="text-center team-hding" style="color: #fff;">Types of Airport Parking we offer</h1>
				<p class="img-grid-para" style="color: #fff;">{!!  $page->alluring !!}</p>
			</div>
			<div class="row justify-content-center mt-5">
				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<div class="options"> <img src="{{ url('theme/img/icons/icon-zmd-1.png') }}" class="m-auto d-block">
						<h5 class="airport-new text-center" style="color: #fff;">Meet &amp; Greet</h5>
						<p class="text-center text-dark" style="color: #fff !important;"> {!!  $page->alluring_meetandgreet !!}</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<div class="options"> <img src="{{ url('theme/img/icons/icon-zmd-2.png') }}" class="m-auto d-block">
						<h5 class="airport-new text-center" style="color: #fff;">Park &amp; Ride</h5>
						<p class="text-center text-dark" style="color: #fff !important;"> {!!  $page->alluring_parkandride !!}</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
					<div class="options"> <img src="{{ url('theme/img/icons/icon-zmd-3.png') }}" class="m-auto d-block">
						<h5 class="airport-new text-center" style="color: #fff;">On Airport</h5>
						<p class="text-center text-dark" style="color: #fff !important;"> {!!  $page->alluring_onairport !!}</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	@include('layouts.airports_section')
	<section id="section">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-lg-9 border-box">
    				<div class="content">
    					<h1 class="text-center">{{ $page->page_title }}</h1>
    					{!! $airports_Detail->description !!}
    				</div>
    			</div>
    		</div>
    	</div>
    </section>

	









<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
    $('.customer-logos').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        arrows: false,
        dots: false,
        pauseOnHover: false,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 4
            }
        }, {
            breakpoint: 520,
            settings: {
                slidesToShow: 3
            }
        }]
    });
});
</script>

@endsection



