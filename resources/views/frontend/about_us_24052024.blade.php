@extends('layouts.main')
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

    @media only screen and (min-width: 992px) {
        .section-b2 {
            height: 261px;
        }
    }

    @media only screen and (max-width: 991px) {
        .section-b2 {
            height: 83%;
        }
    }

    @media screen and (min-device-width: 1200px) and (max-device-width: 1399px) {
        .section-b2 {
            height: 320px
        }
    }

    @media screen and (min-device-width: 992px) and (max-device-width: 1199px) {
        .section-b2 {
            height: 320px;
        }
    }

    @media screen and (min-device-width: 366px) and (max-device-width: 444px) {
        .section-b2 {
            height: 100%;
        }
    }

    @media screen and (min-device-width: 601px) and (max-device-width: 767px) {
        #section-b {
            margin-bottom: 0px !important
        }

        .section-b2 {
            height: 90%;
        }
    }

    @media screen and (min-device-width: 330px) and (max-device-width: 365px) {
        .section-b2 {
            height: 100%;
        }
    }

    @media screen and (min-device-width: 308px) and (max-device-width: 331px) {
        .section-b2 {
            height: 110%;
        }
    }

    @media screen and (min-device-width: 281px) and (max-device-width: 307px) {
        .section-b2 {
            height: 118%;
        }
    }

    @media only screen and (max-width: 280px) {
        .section-b2 {
            height: 137%
        }
    }

    @media screen and (min-device-width: 445px) and (max-device-width: 533px) {
        .section-b2 {
            height: 90%;
        }
    }

    @media only screen and (max-width: 600px) {
        #section-b {
            margin-bottom: 0px !important
        }
    }

    .subnav-content {
        left: -531px !important;
        width: 1500% !important;
    }

    footer .round-btn a {
        margin-top: 3px;
    }

    @media only screen and (min-width: 1200px) {
        #section {
            margin-top: 130px !important
        }
    }

    .section-3-h2 {
        color: #FAB03F;
        font-size: 36px;
        font-weight: bold;
    }

    @media only screen and (min-width: 992px) {
        .col-percentage {
            justify-content: center;
            display: flex;
        }
    }

    @media only screen and (min-width: 992px) {
        .card-body-cs {
            height: 211px;
        }
    }

    .card-body-cs {
        background: #F6F6F6;
        border-bottom-left-radius: 19px;
        border-bottom-right-radius: 19px;
    }

    @media screen and (min-device-width: 768px) and (max-device-width: 991px) {
        .card-body-cs {
            height: 217px;
        }

        .card-cs {
            margin-bottom: 20px;
        }

        .row-css1 {
            justify-content: center;
        }
    }

    @media only screen and (min-width: 767px) {
        .card-cs {
            width: 20rem;
        }
    }

    @media only screen and (max-width: 767px) {
        .card-cs {
            margin-bottom: 20px;
        }
    }

    .img-h1 {
        height: 92%;
    }

    @media only screen and (min-width: 992px) {
        .img-h3 {
            height: 287px;
        }
    }

    .section-3-p {
        color: #434343;
        font-size: 18px;
        line-height: 1.7;
    }

    @media only screen and (min-width: 992px) {
        .col-r {
            text-align: right
        }

        .col-l {
            text-align: left
        }

        /*.btn-h2{margin-top: 36px !important;}*/
    }

    @media only screen and (max-width: 991px) {
        .col-r {
            text-align: center
        }

        .col-l {
            text-align: center
        }
    }

    @media only screen and (min-width: 1200px) {
        .section-3 {
            margin-top: 150px;
        }
    }

    @media only screen and (max-width: 1199px) {
        .section-3 {
            margin-top: 50px;
        }
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

    @media only screen and (max-width: 991px) {
        .des-mob {
            display: none;
        }
    }

    @media only screen and (min-width: 992px) {
        .des-mob2 {
            display: none;
        }
    }
</style>
@section('content')
    @include('frontend.about_us_search_form')


    <section class="section-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="section-3-h2"><span style="color:#00519A"> About </span> Airside Parking UK</h2>
                    <p class="section-3-p">
                        At Airside Parking, a company registered in England with company number 10351244, we provide a
                        premier meet and greet parking service at London Heathrow airport.<br>
                        We will be providing airport parking services with experienced drivers. We are sure that our
                        customers will be very happy and many will continue to use our services year after year. <br>
                        So whether you're booking a family holiday or a business trip, our staff will be glad to help you
                        arrange your airport parking. Alternatively, book through our easy to use secure online system where
                        instant quotes and bookings or by telephone where one of our representatives will be happy to help.
                        <br>
                        Our services focus on making travel easy for our customers and providing a convenient Meet and Greet
                        chauffeur service. Our car parks are protected by 24-hour security surveillance technology. We
                        strive to regularly update our systems and revise procedures so you can travel with the assurance
                        that your vehicle is in safe hands. <br>
                    </p>
                    <!-- <a href="{{ url('choose-us') }}" > <button style="font-size: 20px;" type="submit" class="btn btn-primary btn-h1 btn-h2"><b style="font-weight: 500;">Read more</b></button></a> -->
                </div>
                <div class="col-lg-6 col-r">
                    <img src="{{ url('theme-new/img/about.webp') }}" class="img-fluid img-h1 " alt="image-1">
                </div>
            </div>
        </div>
    </section>

    <section class="section-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-l  des-mob">
                    <img src="{{ url('theme-new/img/meet-a-greet.webp') }}" class="img-fluid img-h1" alt="image-1">
                </div>
                <div class="col-lg-6">
                    <h2 class="section-3-h2"><span style="color:#00519A"> WHAT IS MEET </span> AND GREET PARKING</h2>
                    <p class="section-3-p">
                        Meet and greet parking (also known as valet parking) is the most convenient way to park at Heathrow
                        airport. You drive directly to your departure terminal where you are met by our representative; you
                        proceed to check-in while our representative parks your car for you. On your return your car is
                        brought to your arrival terminal.
                    <p style="font-weight: 600;color: #00519A;font-size: 20px;">Benefits of meet and greet Heathrow parking
                    </p>
                    </p>
                    <p class="section-3-p">
                        No need to search for a parking space, you just pull up in our designated meeting area and our
                        Airside driver will park your car <br>
                        Avoids the need for a 'car park to terminal' transfer bus as our meeting areas are right outside of
                        the terminal buildings <br>
                        Enjoy your trip knowing your car is safe in our secure car park

                    </p>
                    <!-- <a href="{{ url('choose-us') }}" > <button style="font-size: 20px;" type="submit" class="btn btn-primary btn-h1 btn-h2"><b style="font-weight: 500;">Read more</b></button></a> -->
                </div>
                <div class="col-lg-6 col-l  des-mob2">
                    <img src="{{ url('theme-new/img/meet-a-greet.webp') }}" class="img-fluid img-h1" alt="image-1">
                </div>
            </div>
        </div>
    </section>

    <section class="section-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 class="section-3-h2"> PARK MARK<span style="color:#00519A"> ACCREDITED: </span></h2>
                    <p class="section-3-p">
                        An award for safer parking standards <br>
                        Park Mark is an award given to car parking facilities that have demonstrated they are concerned with
                        safety and have taken steps to ensure that they're secured and safe from crime. The Park Mark award
                        scheme is managed by the British Parking Association and fully supported by the Home Office and
                        Scottish Government.
                    <p style="font-weight: 600;color: #00519A;font-size: 20px;">What does a Park Mark award mean?</p>
                    </p>
                    <p class="section-3-p">
                        Because of our security measures, we have been approved by Park Mark, and the British Parking
                        Association. These certifications are awarded to the facilities that meet the security and risk
                        management standards of parking. <br>
                        Awarded by the Association of Police Officers, the Park Mark award scheme is dedicated to providing
                        safer surroundings for the public. When you park at one of our Park Mark-awarded sites, you know the
                        security standards have been credited by the experts and your car is in good hands, giving you extra
                        peace of mind while you're away.

                    </p>
                    <!-- <a href="{{ url('choose-us') }}" > <button style="font-size: 20px;" type="submit" class="btn btn-primary btn-h1 btn-h2"><b style="font-weight: 500;">Read more</b></button></a> -->
                </div>
                <div class="col-lg-6 col-r">
                    <img src="{{ url('theme-new/img/parkmark-logo.webp') }}" class="img-fluid img-h1 " style="max-width: 80%;"
                        alt="image-1">
                    <img src="{{ url('theme-new/img/new-member-logo.jfif') }}" class="img-fluid img-h1 "
                        style="max-width: 80%;margin-top:10px;" alt="image-1">
                </div>
            </div>
        </div>
    </section>

    <section id="section-b" class="section-b2" style="margin-top: 40px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-heading">
                    <h2 class="section-3-h2" style="margin-bottom: 5px;">Our Happy <span
                            style="color:#00519A;font-size: 35px !important;"> Clients </span></h2>
                    @include('layouts.happy_clients')
                </div>
            </div>
        </div>
    </section>


    <!--@include('layouts.parking_type')-->
@endsection
