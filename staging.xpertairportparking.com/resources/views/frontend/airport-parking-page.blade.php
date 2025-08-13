@extends('layouts.main')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>
body{
    font-family: Arial, Helvetica, sans-serif;
}
    .block-card {
  display: none;
}

.block-card.active {
  display: block;
}
.p-h{
    font-weight: 700;
    font-size: 24px;
    color: black !important;
}
.p-h2{
    font-weight: 700;
    font-size: 20px;
    color: black !important;
}
.p-h5{
    font-weight: 700;
}
.p-c{
    color: black !important;
}
.div-1{
    margin-top:30px;
    padding:20px;
    background-color:rgb(74, 161, 217,0.5);
    border-radius:15px;
}
.div-2{
    margin-top:30px;
    margin-bottom:30px;
    padding:20px;
    background-color:#242d62;
    border-radius:15px;
}
.p-li{
    font-weight: 700;
    font-size: 17px;
    color: black !important;
}
.p-h6{
    font-weight: 700;
    font-size: 18px;
    color: black !important;
}
@media only screen and (min-width: 1255px)  {
            .img-h{    height: 300px;}
        }
        @media only screen and (min-width: 1255px)  {
            .img-h2{height: 353px;width: 394px;}
        }
         @media only screen and (max-width: 500px)  {
            .section-3{margin-left: 5px; margin-right: 5px;}
        }
         .card-h{border: none; box-shadow: 0px 0px 8px -2px #00519A;margin-bottom:12px;  padding-top: 25px;}
        @media only screen and (min-width: 1400px)  {
            .card-h{height:478px !important;  }
        }
       
        /*@media screen and (min-device-width: 1403px) and (max-device-width: 1514px) { */
        /*.card-h{height:474px;}*/
        /*}*/
        @media screen and (min-device-width: 1351px) and (max-device-width: 1400px) { 
        .card-h{height:541px  !important;}
        }
        @media screen and (min-device-width: 1323px) and (max-device-width: 1350px) { 
        .card-h{height:545px !important;}
        }
        @media screen and (min-device-width: 1200px) and (max-device-width: 1322px) { 
        .card-h{height:557px !important;}
        }
        @media screen and (min-device-width: 1143px) and (max-device-width: 1199px) { 
        .card-h{height:656px !important;}
        }
        @media screen and (min-device-width: 1115px) and (max-device-width: 1142px) { 
        .card-h{height:657px !important;}
        }
        @media screen and (min-device-width: 1035px) and (max-device-width: 1114px) { 
        .card-h{height:641px !important;}
        }
         @media screen and (min-device-width: 999px) and (max-device-width: 1034px) { 
        .card-h{height:638px !important;}
        }
        @media screen and (min-device-width: 992px) and (max-device-width: 998px) { 
        .card-h{height:638px !important;}
        }
        @media screen and (min-device-width: 768px) and (max-device-width: 832px) { 
        .card-h{height:446px !important;}
        }
        .experance-p{font-size:20px; color:black;}
        .section-3-h22{font-size: 25px;color:black;font-weight:600;}
        @media screen and (min-device-width: 992px) and (max-device-width: 1399px) { 
        .card-title{    height: 42px;}
        }
        @media only screen and (min-width: 992px)  {
             .mobileview{display:none;}
        }
        @media only screen and (max-width: 991px)  {
            .destopview{display:none;}
        }
        .card-title{margin-top: 15px;margin-bottom: 20px;}
        
        footer .round-btn a{margin-top: 3px;}
        
        @media only screen and (min-width: 1200px)  {
           #section{margin-top: 143px !important;}
        }
        /*@media screen and (min-device-width: 992px) and (max-device-width: 1199px) { */
        /*#section{margin-top:529px !important;}*/
        /*}*/
       
</style>
@section('content')


@include('layouts.search_form')
	
<section id="section">
	<div class="container">
		<div class="row">
		    <div class="col-lg-12 " style="    box-shadow: 0 -11px 38px rgba(0,0,0,0.10);">
		        <h2 class="my-4" style="color:#00519A">Heathrow Airport Parking</h2>
		        <div class="filter">
                  <button class="filter-btn active" data-target="#block-1" style="width:100px;height:40px;background-color:#dadcde;color:black;border:none">Overview</button>
                  <button class="filter-btn" data-target="#block-2" style="width:150px;height:40px;background-color:#dadcde;color:black;border:none">Airport Guide</button>
                  <button class="filter-btn" data-target="#block-3" style="width:100px;height:40px;background-color:#dadcde;color:black;border:none">Maps </button>
                  <hr style="margin-top:-0.11px">
                </div>

                <div class="block">
                    <div class="block-card active" id="block-1">
                        <h2 style="color:#00519A;font-weight: 700;">
                            What Are Parking Options For <span style="color:#c72037"> You At Heathrow?</span>
                        </h2>
                        <p class="p-h2"><i>Booking airport parking can be a wobble, Airport Deals Parking makes it simpler.</i> </p>
                        <p class="p-c">Have a look at things that can be important for you. Book with Airport Deals Parking to get a parking space while saving up to 60%. Or if there is a change of plan? No worries, you can cancel the booking any time you want. From easy cancellation to amendments and pre-booking, we have made it all easy for you.
                            <br>Car Parking at Heathrow Airport comes with several options. Meet and Greet and Valet Parking are our exclusive services.
                        </p>
                      
                      <table class="table table-striped">
                          <!--<thead>-->
                          <!--  <tr>-->
                          <!--    <th scope="col">#</th>-->
                          <!--    <th scope="col">First</th>-->
                              
                          <!--  </tr>-->
                          <!--</thead>-->
                          <tbody>
                            <tr>
                              <td scope="row"><b><i class="fa-solid fa-square-parking"></i> Terminal Parking</b></td>
                              <td style="color:#00519A"><b>All Terminals</b></td>
                              
                            </tr>
                            <tr>
                              <td scope="row"><b><i class="fa-solid fa-taxi"></i> Services</b></td>
                              <td style="color:#00519A"><b>Meet and Greet & Valet Parking</b></td>
                              
                            </tr>
                            <tr>
                              <td scope="row"><b><i class="fa-solid fa-thumbs-up"></i> Recommended</b></td>
                              <td style="color:#00519A"><b>Airport Deals Parking Meet and Greet Service</b></td>
                              
                            </tr>
                          </tbody>
                        </table>
                        <div class="div-2">
                            <h5 class="p-h5" style="color:#fff">But we don't stop here. There is More!</h5>
                            <h5 class="p-h5" style="color:#fff">At Heathrow airport parking, we offer a budget-friendly policy,  making sure you are not paying more!</h5>
                        </div>
                        <div class="div-2">
                            <h5 style="color:#fff;font-weight: 900;">Heathrow Parking</h5>
                            <p style="color:#fff;font-weight: 900;">Weekly Heathrow Parking from</p>
                            <h5 style="color:#fff;font-weight: 900;">£76.99 a week. </h5>
                        </div>
                        <h2 style="color:#00519A;font-weight: 700;">
                            Why is <span style="color:#c72037">Airport Deals Parking The Best Parking Service For You?</span>
                        </h2>
                        <section class="section-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card card-h" style="border-radius:24px">
                    <div style="text-align:center">
                         <img src="{{url('theme-new/img/Ellipse-1.webp')}}" class="img-fluid"  alt="Ellipse-1" style="width:100px;height:100px">
                    </div>
                   
                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center;font-size:18px;font-weight:600;color:black">Simplified Booking Process</h5>
                    <p class="card-text" style="font-size:18px;color:black">You can now secure your parking spot in just a few clicks! We have introduced a quick and easy booking process on our website. Click, and with a few-step process get hold of your parking spots.</p>
                  </div>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-12">
                <div class="card card-h card-hm " style="border-radius:24px">
                    <div style="text-align:center">
                    <img src="{{url('theme-new/img/Ellipse-2.webp')}}" class="img-fluid"  alt="Ellipse-2" style="width:100px;height:100px">
                    </div>
                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center;font-size:18px;font-weight:600;color:black">Secure Payment</h5>
                    <p class="card-text" style="font-size:18px;color:black">We understand the importance of ensuring your transactions are safe and protected. With our streamlined and SSL Certified payment process, you can enjoy a hassle-free booking experience knowing your financial information is secure and encrypted with us.</p>
                  </div>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-12">
                <div class="card card-h" style="border-radius:24px">
                    <div style="text-align:center">
                    <img src="{{url('theme-new/img/Ellipse-3.webp')}}" class="img-fluid"  alt="Ellipse-3" style="width:100px;height:100px">
                    </div>
                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center;font-size:18px;font-weight:600;color:black">Expert Customer Support</h5>
                    <p class="card-text" style="font-size:18px;color:black">Our dedicated customer support experts are always ready to assist you, providing solutions to all your inquiries promptly and efficiently. Whether it's day or night, we are here to address all your concerns.</p>
                  </div>
                </div>
            </div>
            <div class="col-lg-3  col-md-6 col-sm-12">
                <div class="card card-h card-hm" style="border-radius:24px">
                    <div style="text-align:center">
                     <img src="{{url('theme-new/img/Ellipse-4.webp')}}" class="img-fluid"  alt="Ellipse-4" style="width:100px;height:100px">
                     </div>
                  <div class="card-body">
                    <h5 class="card-title" style="text-align: center;font-size:18px;font-weight:600;color:black">Security Priority</h5>
                    <p class="card-text" style="font-size:18px;color:black">We understand your security concerns, which is why we have implemented state-of-the-art security measures to ensure the safety of your vehicle. Your car is secure and protected with us throughout your stay.</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</section>
                        <p style="color:black;">
                            This seems like a great question. Here’s why the only option for you is us.
                        </p>
                        <ol style="color:black;margin-left:15px">
                            <li>
                               <p class="p-li"> Years of Professional Experience</p>
                               <p class="p-li-c">Our experience made us what we are today. With this experience, we have developed expertise in airport parking service from the grass-root level to higher values. </p>
                            </li>
                            <li>
                               <p class="p-li">Free UK-based Call Centers</p>
                               <p class="p-li-c">UK-based free call centres and customer-centric professionals are always ready to help via phone, live chat or email.</p>
                            </li>
                            <li>
                               <p class="p-li">Budget-Friendly Price Policy</p>
                               <p class="p-li-c">You can book the best Heathrow Airport Parking with our exclusive money deal.  We are proud to announce the low-priced policy that gives our customers the trust and
                               reliance on us.</p>
                            </li>
                        </ol>
                        <h2 style="color:#00519A;font-weight: 700;">
                            Looking for a relaxing holiday? <span style="color:#c72037">Heathrow Airport Parking</span> Deals Are for You. 
                        </h2>
                        <p style="color:black">Your comfort is a priority for us. And we are here to provide you with the closest parking arena near Heathrow. At Airport Deals Parking, we offer versatile parking options, Meet and Greet and Valet parking for all Terminals.
                        <br>We have many parking deals and packages, giving you access to everything in just one simple booking. To get rid of all the hustle-bustle, book this easy parking for yourself to enjoy your journey to the fullest. 
                        <b><a href="{{url('heathrow-airport-parking')}}">Click to see the details of parking options</a></b></p>
                        <u style="font-weight: 600;color:#00519A;font-size:20px">Meet and Greet</u>
                        <p style="color:black">This easy option just wants you to take your car to the drop-off car park which is close to the terminal. Hand it over to the driver and leave the rest with him. He will park your car
                        for you while you go straight to check in.<br>This service is as affordable as £76.99 a week. </p>
                        <u style="font-weight: 600;color:#00519A;font-size:20px">Valet Parking</u>
                        <p style="color:black">The Valet parking service provides you with a professional driver to park your car at your booked parking spot. Just go directly to the terminal, meet the driver and put all your
                        stress behind you.<br>This service is as affordable as £76.99 a week. </p>
                        
                    </div>
                    <div class="block-card" id="block-2">
                         <h2 style="color:#00519A;font-weight: 700;">
                         The <span style="color:#c72037">Terminal</span>
                        </h2>
                        <h5 style="color:#00519A;font-weight: 600;">Terminal 2: The Queen's Terminal</h5>
                        <p class="p-c">Known as "The Queen's Terminal," is primarily dedicated to airlines within the Star Alliance network. These include carriers like United Airlines, Lufthansa, and Air Canada. In terms of facilities, Terminal 2 offers a wide array of shopping outlets, dining options, and passenger services.<br>
                            Travellers can find lounges, currency exchange, and baggage services here. To access Terminal 2, you can choose from various transportation options, including the Heathrow Express train from Central London, Heathrow Connect, London Underground's Piccadilly Line, or by car or taxi.
                        </p>
                        <h5 style="color:#00519A;font-weight: 600;">Terminal 3</h5>
                        <p class="p-c">Iit Serves a diverse range of airlines, making it a hub for carriers such as Virgin Atlantic, Delta Air Lines, Emirates, and Cathay Pacific. Passengers passing through Terminal 3 can enjoy a selection of shops, restaurants, and lounges. <br>
                        Additionally, this terminal houses the Heathrow Airport VIP service. To get to Terminal 3, you have the choice of using the Heathrow Express, Heathrow Connect, London Underground's Piccadilly Line, or road and taxi services.
                        </p>
                        <h5 style="color:#00519A;font-weight: 600;">Terminal 4</h5>
                        <p class="p-c">It is home to a mix of long-haul and European carriers, including KLM, Qatar Airways, and Etihad Airways. It's known for its modern and spacious design. <br>
                            Facilities at Terminal 4 encompass a variety of shops, eateries, and lounges for travellers to explore. To reach Terminal 4, you can use the Heathrow Express, Heathrow Connect, or opt for road and taxi services.
                        </p>
                        <h5 style="color:#00519A;font-weight: 600;">Terminal 5</h5>
                        <p class="p-c">It is exclusively dedicated to British Airways and Iberia for their flights and is divided into two separate buildings, T5A and T5B. Passengers flying with these airlines can find numerous shops, restaurants, and lounges in both T5A and T5B, including the British Airways Galleries Lounge. <br>
                            Terminal 5 even has its own dedicated train station, Heathrow Terminal 5 station, served by the Heathrow Express and London Underground's Piccadilly Line. Alternatively, you can access it by road or taxi.
                        </p>
                        <h2 style="color:#00519A;font-weight: 700;">
                         Family <span style="color:#c72037"> Facilities</span>
                        </h2>
                        <h5 style="color:#00519A;font-weight: 600;">Family Rooms and Baby Changing Facilities</h5>
                        <p class="p-c">Many terminals at Heathrow Airport offer dedicated family rooms equipped with comfortable seating, baby changing tables, and private feeding areas. These rooms provide a quiet and private space for parents to attend to their children's needs.</p>
                        <h5 style="color:#00519A;font-weight: 600;">Children's Play Areas</h5>
                        <p class="p-c">Some terminals feature children's play areas designed to keep kids entertained while waiting for flights. These play areas often include soft play equipment, slides, and interactive games to burn off energy and make waiting times more enjoyable for young travellers.</p>
                        <h5 style="color:#00519A;font-weight: 600;">Pushchair Rental Services</h5>
                        <p class="p-c">Heathrow Airport offers pushchair (stroller) rental services for families travelling with infants or toddlers. This service can be especially helpful if you prefer not to bring your own stroller through security or if you need one for a short layover.</p>
                        <h5 style="color:#00519A;font-weight: 600;">Kid-Friendly Dining Options </h5>
                        <p class="p-c">Throughout the airport, you'll find a variety of restaurants and eateries with kid-friendly menus and high chairs. Many of these dining establishments are equipped to accommodate families with children, making mealtime more convenient for parents.</p>
                        <h5 style="color:#00519A;font-weight: 600;">Family Security Lanesk</h5>
                        <p class="p-c">Heathrow Airport often provides dedicated family security lanes, allowing families with young children to go through security checks at a more relaxed pace. This can reduce stress and minimise the time spent in queues, making the security process smoother for families.</p>
                        <!-- <h5 style="color:#00519A;font-weight: 900;">Shopping</h5>
                        <p class="p-c">Heathrow constitutes plenty of shops ranging from fashion, cosmetics, technology, bakers and books. It provides customers with a great variety to spend their time at the airport. </p>
                        <h5 style="color:#00519A;font-weight: 900;">Online Facilities</h5>
                        <p class="p-c">Heathrow also provides internet facilities to each passenger. It entitles free WiFi to each passenger for 45 minutes. If you require more time, you can connect to the high-speed
                        WiFi provided by Boingo Hotspot. </p> -->
                    </div>
                    <div class="block-card" id="block-3">
                        <h2 style="color:#00519A;font-weight: 700;">
                         Map
                        </h2>
                        <!--<p class="p-c">Heathrow Airport located in the South of London is 28 miles which links to the M23. You can reach the airport using the railway station that passes the South terminal. You -->
                        <!--can also use the navigation to see directions to the airport. This airport can be reached through M23, A23 and M25. </p>-->
                        <!--<div id="googleMap" style="width:100%;height:400px;margin-bottom:20px"></div>-->
                        <!--<script>-->
                        <!--function myMap() {-->
                        <!--var mapProp= {-->
                        <!--  center:new google.maps.LatLng(51.508742,-0.120850),-->
                        <!--  zoom:5,-->
                        <!--};-->
                        <!--var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);-->
                        <!--}-->
                        <!--</script>-->
                        
                        <!--<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>-->
                        <iframe style="width:100%" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2485.464115528564!2d-0.4576259231493779!3d51.467994713581035!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48767234cdc56de9%3A0x8fe7535543f64167!2sHeathrow%20Airport!5e0!3m2!1sen!2s!4v1693476380460!5m2!1sen!2s" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <!--<iframe style="width:100%;height:400px;margin-bottom:20px" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2502.809106012723!2d-0.10292962363125166!3d51.14887123683198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4875f1703d525c49%3A0xb735addfcd412e2b!2sFlight%20Park%20One!5e0!3m2!1sen!2s!4v1683817481749!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>-->
                    </div>
                </div>
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

