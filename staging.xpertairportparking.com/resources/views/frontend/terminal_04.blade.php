@extends('layouts.main')
<title>Book Cheap Heathrow Parking Terminal 4 | Airport Deals Parking</title>
<meta name="description" content="Secure Affordable Heathrow Parking at Terminal 4, Choose Airport Deals Parking for Savings, Convenience and Hassle free airport parkings">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@section('content')
<style>
.first-txt {
position: absolute;padding: 11px;width:100%;text-shadow: 2px 2px #333333; color: white;
}
.title{ font-size: 18px;
font-weight: 600;
color: #242d62;
padding-top: 16px;
text-align: left;
}
.section-3{margin-top:80px;

}
.section-3-h2{color:#c72037;font-size:38px;font-weight:bold;}
@media only screen and (min-width: 1200px)  {
.first-div{padding-bottom:20px;margin-top: 177px;}
}
@media screen and (min-device-width: 992px) and (max-device-width: 1199px) { 
	.first-div{padding-bottom:20px;margin-top: 400px;}
}
@media only screen and (max-width: 991px)  {
.first-div{padding-bottom:20px;margin-top: 40px;}
}
.tit-cs{margin-top: 30px;}
.card-side{border-radius: 20px;    box-shadow: -13px -12px 0px 1px #242d62;}
@media only screen and (min-width: 992px)  {
.card-body-cs{ height: 211px;  }
.filter{display: block;}
}
.card-body-cs{ background: #F6F6F6; border-bottom-left-radius: 19px;border-bottom-right-radius: 19px; }
@media screen and (min-device-width: 768px) and (max-device-width: 991px) { 
.card-body-cs{height: 217px; }
.card-cs{margin-bottom:20px;}
.row-css1{justify-content: center;}
}
@media screen and (min-device-width: 712px) and (max-device-width: 766px) { 
.title{height:30px}
.p1{height:240px}
}
@media screen and (min-device-width: 767px) and (max-device-width: 912px) { 
.title{height:30px}
.p1{height:153px}
}
@media screen and (min-device-width: 913px) and (max-device-width: 1025px) { 
.title{height:30px}
.p1{height:230px}
}
.title{ font-size: 18px;
font-weight: 600;
color: #242d62;
padding-top: 16px;
text-align: left;
}
@media only screen and (min-width: 1400px)  {
.p-main-cs{ height: 60px  }
}
@media only screen and (min-width: 1400px)  {
.p-main-cs{ height: 60px  }
}
@media screen and (min-device-width: 1200px) and (max-device-width: 1399px) { 
.p-main-cs{ height: 80px  }
}
@media screen and (min-device-width: 992px) and (max-device-width: 1199px) { 
.p-main-cs{ height: 101px  }
.title{height: 59px;}
}
@media screen and (min-device-width: 711px) and (max-device-width: 1026px) { 
.title{margin-bottom: 24px;}
}
.p-main-cs{font-size:16px;color:#434343;text-align: left;line-height: 20px;}
.section-3-p{color:#434343;font-size:18px;line-height: 1.7;}
@media only screen and (min-width: 992px)  {
.col-r{text-align:right}
.filter-sect{margin-top: 140px;}
}
@media only screen and (max-width: 991px)  {
.col-r{text-align:center}
}
@media only screen and (max-width: 390px)  {
	.filter-btn{width: 49%;}
}

.img-h1{height: 100%;border-radius:10px;box-shadow: 0px 1px 5px 1px gray;}
.accordion-button:focus {
z-index: 3;
border-color: #FAB03F !important;
outline: 0;
box-shadow: 0 0 0 0.25rem rgb(255 255 255) !important;
background-color: #FAB03F !important;
color: #242d62 !important;
}
.accordion-button{
background-color: #FAB03F !important;
/*margin-bottom: 10px;*/
font-weight: 600;
}
.faqs-hding{
color: #242d62;
font-weight: 700;
font-size: 35px;
text-align: center;
background-color: #FAB03F;
padding: 10px 0px;
}
.accordion-collapse{background:#EFEFEF;}
.accordion-body{color:#434343;}
@media only screen and (max-width: 575px)  {
.tit-cs{padding-left: 28px;}
}

.accordion-item{
border: #EFEFEF !important;
background-color: #EFEFEF !important;
}
.block-card {
  display: none;
}

.block-card.active {
  display: block;
}
.filter{width: 100%;margin-bottom: 20px;}
.filter .active{background:#242d62;color: white;font-size: 17px;padding: 11px;border: 1px solid #242d62;}
.filter-btn{
    color: #242d62;
    font-size: 17px;
    padding: 11px 40px;
    position: relative;
    border-radius: 5px;
    background: 0 0;
    outline: none;
    font-weight: 600;
    
    border: 1px solid #c72037;
}
@media only screen and (min-width: 992px)  {
.filter-btn{width: 24.6%;}
}
@media only screen and (min-width: 1200px)  {
.filter-btn{width: 24.7%;}
}
@media only screen and (max-width: 991px)  {
.filter{
    box-sizing: border-box;
    overflow-x: scroll;
    white-space: nowrap;
    width: 100%;
}
}
	.filter-btn:before {
    background: #c72037;
    content: "";
    position: absolute;
    left: 0;
    right: 0px;
    bottom: 0;
    height: 2px;
}
.filter .active:before {
    background: #242d62;
}
.block .active{
    border: 2px dashed #c72037;
    padding: 20px;
    border-radius: 13px;
}
@media only screen and (max-width: 991px)  {
	#bg-css {height: auto !important;}
}
.faqs-title{color: #242d62;font-size: 24px;font-weight: 600;}
.faqs-body{color: #666;font-size: 17px;}
.img-h3{
    width: 400px;
    height: 400px;
}
@media only screen and (min-width: 1200px)  {
.img-h2{
    position: relative;
    right: 33px;
    border-radius: 34px;
    border: 5px solid #FAB03F;
    height: 423px;
    margin-top: -365px;
    height: 340px;
    width: 340px;
}
}
@media screen and (min-device-width: 992px) and (max-device-width: 1199px) { 
.img-h2{
    position: relative;
    right: 6px;
    border-radius: 6px;
    border: 5px solid #FAB03F;
    height: 423px;
    margin-top: -365px;
    height: 340px;
    width: 340px;
}
}
@media only screen and (max-width: 991px)  {
.img-h2{
    position: relative;
    /*right: 33px;*/
    border-radius: 34px;
    border: 5px solid #FAB03F;
    height: 423px;
    margin-top: -365px;
    height: 340px;
    width: 340px;
}
}
</style>
@include('layouts.search_form')	

<section class="section-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-3-h2"><span style="color:#00519A">About Heathrow</span> Terminal 4 </h2>
                <p class="section-3-p">
				{!! $page->content !!}
                </p>
                <!--<a href="{{url('heathrow-airport-parking')}}" > <button style="font-size: 20px;" type="submit" class="btn btn-primary btn-h1 btn-h2"><b style="font-weight: 500;">Read more</b></button></a>-->
            </div>
             <div class="col-lg-6 col-r">
                <img src="{{url('theme-new/img/Terminal_04_new.webp')}}" class="img-fluid img-h1 "  alt="image-1">
                <!--<img src="{{url('theme-new/img/Rectangle-1080.png')}}" class="img-fluid img-h1 img-h3"  alt="image-1">-->
                <!--<img src="{{url('theme-new/img/terml-4.webp')}}" class="img-fluid img-h1 img-h2 "  alt="image-1">-->
            </div>
        </div>
    </div>
</section>
<section class="filter-sect">
    <div class="container" style="margin-top: 30px;margin-bottom: 30px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter">
                  <button class="filter-btn active" data-target="#block-1">General </button>
                  <button class="filter-btn" data-target="#block-2">Faqs</button>
                  <button class="filter-btn" data-target="#block-3">Directions</button>
                  <button class="filter-btn" data-target="#block-4">Terminal Guide</button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-card active" id="block-1">
					  {!! $page->content2 !!}
					</div>
                    <div class="block-card" id="block-2">
					<h3 class="faqs-title">Can I use the Meet and Greet service at Terminal 4 for both departures and arrivals?</h3>
					<p class="faqs-body">Absolutely, our Meet and Greet service at Terminal 4 is available for both departures and arrivals. Whether you're flying out or returning, we offer a seamless and convenient parking experience.</p>
					<h3 class="faqs-title">Is the Meet and Greet service at Terminal 4 wheelchair accessible?</h3>
					<p class="faqs-body">Yes, our Meet and Greet service at Terminal 4 is wheelchair accessible. Our shuttle service is designed to accommodate passengers with mobility challenges, ensuring a comfortable and inclusive experience.</p>
					<h3 class="faqs-title">Is the On-Airport parking option at Terminal 4 suitable for business travelers with tight schedules?</h3>
					<p class="faqs-body">Indeed, the On-Airport parking option at Terminal 4 is ideal for business travelers. Its proximity to the terminal ensures a swift and efficient experience, making it perfect for those with busy schedules.</p>
					<h3 class="faqs-title">Can I drop off a passenger quickly using the Drop Off Parking service at Terminal 4 during peak hours?</h3>
					<p class="faqs-body">Certainly, our Meet and Greet service for drop-offs at Terminal 4 ensures a quick and efficient process, even during peak hours. This service is designed to help you save time and navigate busy periods.</p>
					<h3 class="faqs-title">Is the Pick Up Parking service at Terminal 4 available for all types of vehicles?</h3>
					<p class="faqs-body">Yes, our Meet and Greet service for Pick Up at Terminal 4 is available for all types of vehicles. Whether you're driving a compact car or an SUV, our team will ensure a seamless transition from your flight to your vehicle.</p>
					
					</div>
                    <div class="block-card" id="block-3">
					<iframe style="width:100%;height:380px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2485.9159380382853!2d-0.44993712314977324!3d51.45969981418656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487673c790311477%3A0xc7c12ba131bb2c2d!2sTerminal%204%2C%20Nelson%20Rd%2C%20Hounslow%20TW6%202GW%2C%20UK!5e0!3m2!1sen!2s!4v1693391143062!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					
					</div>
                    <div class="block-card" id="block-4">
					  {!! $page->content3 !!}
					</div>
                    </div>
            </div>
        </div>
    </div>
</section>


<section id="section-b" class="section-b2" style="margin-top: 80px;" >
		<div class="container">
			<div class="row justify-content-center">
				<div class="section-heading">
				    <h2 class="section-3-h2" style="margin-bottom: 45px;">Our Happy  <span style="color:#00519A"> Clients </span></h2>
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
@endsection
