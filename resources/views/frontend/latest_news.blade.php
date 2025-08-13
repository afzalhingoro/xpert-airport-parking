@extends('layouts.main')
<script         src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<style>
.subnav-content{left: -531px !important;width: 1500% !important;}
footer .round-btn a{margin-top: 3px;}
@media only screen and (min-width: 1200px)  {
    #section{margin-top:130px !important}
}
.section-3-h2{color:#FAB03F;font-size:36px;font-weight:bold;}
@media only screen and (min-width: 992px)  {
    .col-percentage{justify-content: center;display:flex;}
}
@media only screen and (min-width: 992px)  {
    .card-body-cs{ height: 211px;  }
}
.card-body-cs{ background: #F6F6F6; border-bottom-left-radius: 19px;border-bottom-right-radius: 19px; }
@media screen and (min-device-width: 768px) and (max-device-width: 991px) { 
.card-body-cs{height: 217px; }
.card-cs{margin-bottom:20px;}
.row-css1{justify-content: center;}
}
@media only screen and (min-width: 767px)  {
    .card-cs{width: 20rem;}
}
@media only screen and (max-width: 767px)  {
    .card-cs{margin-bottom: 20px;}
}
.img-h1{height: 92%;}
@media only screen and (min-width: 992px)  {
    .img-h3{height: 287px;}
}
.section-3-p{color:#434343;font-size:18px;line-height: 1.7;}

@import url(https://fonts.googleapis.com/css?family=Raleway:400,600,700);
@import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
figure.snip1253 {
  font-family: 'Raleway', Arial, sans-serif;
  color: #fff;
  position: relative;
  overflow: hidden;
  margin: 10px;
  min-width: 250px;
  max-width: 310px;
  width: 100%;
  background-color: #ffffff;
  color: #000000;
  text-align: left;
  font-size: 16px;
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
}
@media only screen and (max-width: 767px)  {
    figure.snip1253{max-width: 100%;}
    figure.snip1253 img{width: 100%;}
}
figure.snip1253 * {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all 0.3s ease;
  transition: all 0.3s ease;
}
figure.snip1253 .image {
  max-height: 220px;
  overflow: hidden;
}
figure.snip1253 img {
  max-width: 100%;
  vertical-align: top;
  position: relative;
}
figure.snip1253 figcaption {
  margin: -40px 15px 0;
  padding: 15px ;
  position: relative;
  background-color: #ffffff;
}
figure.snip1253 .date {
  background-color: #00519A;
  top: 15px;
  color: #fff;
  left: 15px;
  min-height: 54px;
  min-width: 54px;
  position: absolute;
  text-align: center;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
}
figure.snip1253 .date span {
  display: block;
  line-height: 24px;
}
figure.snip1253 .date .month {
  font-size: 14px;
  background-color: #00519A;
}
figure.snip1253 h3,
figure.snip1253 p {
  margin: 0;
  padding: 0;
}
figure.snip1253 h3 {
  min-height: 50px;
  margin-bottom: 10px;
  margin-left: 70px;
  display: inline-block;
  font-weight: 600;
  text-transform: uppercase;
  font-size: 19px;
  color: #00519A;
}
figure.snip1253 p {
  font-size: 0.8em;
  margin-bottom: 20px;
  line-height: 1.6em;
}
figure.snip1253 footer {
  padding: 0 25px;
  background-color: #FAB03F;
  color: #00519A;
  font-size: 0.8em;
  line-height: 30px;
  text-align: right;
}
figure.snip1253 footer > div {
  display: inline-block;
  margin-left: 10px;
}
figure.snip1253 footer i {
  color: rgb(0, 81, 154, .4);
  margin-right: 5px;
}
figure.snip1253 a {
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  position: absolute;
  z-index: 1;
}
figure.snip1253:hover img,
figure.snip1253.hover img {
  -webkit-transform: scale(1.15);
  transform: scale(1.15);
}
.h3banner{
    color:white;
    font-size:36px;
     font-weight:700;
    line-height:1.3;
        text-align: center;
       }
    @media screen and (max-width: 600px) {
    .h3banner{font-size:2rem !important; }
    }
</style>
@section('content')
<section id="bg-css" style="background-image: url('theme-new/img/banner2.webp');background-size: cover;">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12"  style="padding-top:67px">
                            <p class="h3banner">Latest News</p>
                            <p style="color:white;font-size:20px;text-align: center;padding-bottom: 33px;">Park Mark and BPA Certified!</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>	
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <figure class="snip1253">
                    <div class="image"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample52.jpg" alt="sample52"/></div>
                    <figcaption>
                        <div class="date"><span class="day">28 Sep</span><span class="month">2024</span></div>
                        <h3>Airport Deals Parking OPTIONS.</h3>
                        <span class="claimedRight" maxlength="20" style="font: size 15px;">BOOKING YOUR PARKING AT HEATHROW JUST GOT EASIER! Check out our website. We have made it quicker and easier than ever to book your Parking for Heathrow Port online.</span>
                        <!-- <p>
                            BOOKING YOUR PARKING AT HEATHROW JUST GOT EASIER! Check out our website. We have made it quicker and easier than ever to book your Parking for Heathrow Port online.
                        </p> -->
                    </figcaption>
                    <footer>
                        <div class="views"><i class="fa fa-regular fa-eye"></i></i>2,907</div>
                        <div class="love"><i class="fa fa-solid fa-heart"></i></i>623</div>
                        <div class="comments"><i class="fa fa-solid fa-message"></i></i></i>23</div>
                    </footer><a href="#"></a>
                </figure>
            </div>
            <div class="col-md-6 col-lg-4">
                <figure class="snip1253">
                    <div class="image"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample52.jpg" alt="sample52"/></div>
                    <figcaption>
                        <div class="date"><span class="day">20 Nov</span><span class="month">2024</span></div>
                        <h3>Airport Deals Parking OPTIONS.</h3>
                        <span class="claimedRight" maxlength="20" style="font: size 15px;">BOOKING YOUR PARKING AT HEATHROW JUST GOT EASIER! Check out our website. We have made it quicker and easier than ever to book your Parking for Heathrow Port online.</span>
                        <!-- <p>
                            BOOKING YOUR PARKING AT HEATHROW JUST GOT EASIER! Check out our website. We have made it quicker and easier than ever to book your Parking for Heathrow Port online.
                        </p> -->
                    </figcaption>
                    <footer>
                        <div class="views"><i class="fa fa-regular fa-eye"></i></i>2,907</div>
                        <div class="love"><i class="fa fa-solid fa-heart"></i></i>623</div>
                        <div class="comments"><i class="fa fa-solid fa-message"></i></i></i>23</div>
                    </footer><a href="#"></a>
                </figure>
            </div>
            <div class="col-md-6 col-lg-4">
                <figure class="snip1253">
                    <div class="image"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample52.jpg" alt="sample52"/></div>
                    <figcaption>
                        <div class="date"><span class="day">17 Nov</span><span class="month">2024</span></div>
                        <h3>Airport Deals Parking OPTIONS.</h3>
                        <span class="claimedRight" maxlength="20" style="font: size 15px;">BOOKING YOUR PARKING AT HEATHROW JUST GOT EASIER! Check out our website. We have made it quicker and easier than ever to book your Parking for Heathrow Port online.</span>
                        <!-- <p>
                            BOOKING YOUR PARKING AT HEATHROW JUST GOT EASIER! Check out our website. We have made it quicker and easier than ever to book your Parking for Heathrow Port online.
                        </p> -->
                    </figcaption>
                    <footer>
                        <div class="views"><i class="fa fa-regular fa-eye"></i></i>2,907</div>
                        <div class="love"><i class="fa fa-solid fa-heart"></i></i>623</div>
                        <div class="comments"><i class="fa fa-solid fa-message"></i></i></i>23</div>
                    </footer><a href="#"></a>
                </figure>
            </div>
            <div class="col-md-6 col-lg-4">
                <figure class="snip1253">
                    <div class="image"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/331810/sample52.jpg" alt="sample52"/></div>
                    <figcaption>
                        <div class="date"><span class="day">01 Dec</span><span class="month">2024</span></div>
                        <h3>Airport Deals Parking OPTIONS.</h3>
                        <span class="claimedRight" maxlength="20" style="font: size 15px;">BOOKING YOUR PARKING AT HEATHROW JUST GOT EASIER! Check out our website. We have made it quicker and easier than ever to book your Parking for Heathrow Port online.</span>
                        <!-- <p>
                            BOOKING YOUR PARKING AT HEATHROW JUST GOT EASIER! Check out our website. We have made it quicker and easier than ever to book your Parking for Heathrow Port online.
                        </p> -->
                    </figcaption>
                    <footer>
                        <div class="views"><i class="fa fa-regular fa-eye"></i></i>2,907</div>
                        <div class="love"><i class="fa fa-solid fa-heart"></i></i>623</div>
                        <div class="comments"><i class="fa fa-solid fa-message"></i></i></i>23</div>
                    </footer><a href="#"></a>
                </figure>
            </div>
        </div>
    </div>
</section>






<section id="section-b" class="section-b2" style="margin-top: 40px;">
		<div class="container">
			<div class="row justify-content-center">
				<div class="section-heading">
				    <h2 class="section-3-h2" style="margin-bottom: 5px;">Our Happy  <span style="color:#00519A;font-size: 35px !important;"> Clients </span></h2>
					 @include('layouts.happy_clients')
				</div>
			</div>
		</div>
</section>

<script>
    $(document).ready(function(){
  
  $('.claimedRight').each(function (f) {

      var newstr = $(this).text().substring(0,100)+'...';
      $(this).text(newstr);

    });
})
</script>
<!--@include('layouts.parking_type')-->
@endsection

