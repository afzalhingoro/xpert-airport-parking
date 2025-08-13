@extends('layouts.main')
@section("title",$page->meta_title)
@section("meta_keyword",$page->meta_keyword )
@section("meta_description",$page->meta_description)
@section('content')
<style>
.sb-serc a {
    width: 100%;
    margin-left: 0;
}
</style>
	<div class="container-fluid blog-banner">
		<div class="row">
			<div class="col-lg-12">
				<h2 class="blog-banner-hding">Airport Guides</h2>
			</div>
		</div>
	</div>

	<section id="section">
		<div class="container">
			<div class="row">
				<h1 class="text-center team-hding">Airport Guides	</h1>
				<div id="background justify-content-center" class="hidden-xs hidden-sm">
					<p id="bg-text1">Guides</p>
				</div>
			</div>
			<div class="row justify-content-center mx-3">
				<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 mt-2">
					<p class="text-dark text-center">Airports are an essential platform for travelers to board airplanes. 
					Not only is it a complex maze of physical structure but several other factors need to be taken into account, including shuttle services, 
					baggage clearance, airport lounges, baggage clearance and departure terminal. So what is it that you need to do to prepare yourself to 
					check in or check out at a new airport? Following is a list of UK's major airports that we operate on and offer services like on-site parking, 
					meet & greet and chauffeur help. Feel free to go through them and skim the information. 
					Maybe it won't satisfy the academic curiosity rather it will serve the purpose of contributing towards general knowledge.</p>
				</div>
			</div>
			<div class="row justify-content-center mt-5 mx-3">
				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 types-div">
					<div class="options"> <img src="theme/img/icons/parking-area.png" class="m-auto d-block my-3">
						<h5 class="airport-new text-center">Airport Parking</h5>
						<p class="text-center text-dark"> Secure, guaranteed and satisfactory. Our customers reap benefits from priority parking at
                350+ car parks on 30+ major airports across UK, while saving up to 30%.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 types-div">
					<div class="options"> <img src="theme/img/icons/hotel.png" class="m-auto d-block my-3">
						<h5 class="airport-new text-center">Airport Hotels </h5>
						<p class="text-center text-dark"> Why struggle through traffic to reach airport when you can say goodbye to stress with ZMD Travels
                and book an Airport hotel in two minutes.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 types-div">
					<div class="options"> <img src="theme/img/icons/airport.png" class="m-auto d-block my-3">
						<h5 class="airport-new text-center">Airport Lounges</h5>
						<p class="text-center text-dark">Take a break from all the stress and extensive traveling. Book a premium lounge with
                    ZMD Travels in the price of an economy airport lounge.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	
	@endsection