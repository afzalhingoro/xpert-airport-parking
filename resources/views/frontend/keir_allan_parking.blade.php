@extends('layouts.main')
@section('content')
<style>
    .section-3-h2 {
        color: #000;
        font-size: 36px;
        font-weight: bold;
    }
    .safty-cs-p {
        font-size: 16px;
        color: #434343;
    }
    .safty-cs {
        font-size: 22px;
        font-weight: 600;
        color: #0c5adb;
        margin-bottom: 20px;
    }
    .div-card{
        border: 1px dashed;
        border-radius: 25px;
        padding: 15px;
        box-shadow: 0px 1px 5px 1px gray;
    }
    .terminls-a-tag{
        border: 1px solid #c72037;
        padding: 5px 29px;
        border-radius: 10px;
        color: #fff;
        background: #c72037;
        margin: 5px 0;
        display: inline-block;
    }
    .terminls-a-tag:hover{
        border: 1px solid #242d62;
        color: #fff;
        background: #242d62;
    }
    .img-gif{
        border-radius: 25px;
        margin-bottom: 20px;
        height: 182px;
        width: 100%;
    }
    @media only screen and (min-width:992px) {
        .safty-cs-p{min-height: 235px;}
    }
    @media only screen and (min-width:1200px) {
        .safty-cs-p{min-height: 205px;}
    }
    @media only screen and (min-width:1400px) {
        .safty-cs-p{min-height: 173px;}
    }
    .section-3-p{
        color: #434343;
        font-size: 16px;
        line-height: 1.7;
    }
    .section-3{
        margin-top: 55px;
    }
</style>
<section id="bg-css"  class="static_page_banner">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 p-t-67px" id="slideInRight">
                            <h1 class="h3banner">Keir Allan Parking</h1>
                            <p style="color:white;font-size:20px;text-align: center;">Convenient, secure parking at Keir Allan Parking.</p>
                        </div>
                        @include('layouts.search_form_others') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
    <div style="padding-bottom:20px;">
        <section class="section-3 terminalSec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center" id="zoomIn">
                        <h2 class="section-3-h2 mt-5">Keir Allan Terminals</span></h2>
                        <p class="section-3-p mb-30">Keir Allan Parking operates exclusively with one terminal, catering to both domestic and international flights. The terminal supports a wide array of airlines, including Emirates, TUI, Air Canada, British Airways, Jet2, EasyJet, and Air France. Travelers can access a range of amenities within the terminal, including retail outlets, dining options, and comfortable lounges, all designed to elevate the travel experience for passengers heading to various destinations.</p>
                        <br>
                    </div>
                    <div class="col-lg-12 col-md-12 mb-4 text-center" id="zoomIn">
                        <div class="div-card">
                            <div class="text-center w-50">
                                <img src="{{ url('theme-new/img/terminal_1.png') }}" class="img-fluid img-gif">
                            </div>
                            <div class="terminalCont">
                                <h2 class="safty-cs steps-css">Keir Allan Terminal</h2>
                                <p class="safty-cs-p">Keir Allan Parking’s facilities cater to passengers with convenient parking options. Stansted serves as a hub for low-cost airlines, offering modern amenities, a range of dining and shopping options, and efficient access to flights across Europe and beyond.</p>
                                <a href="{{ url('terminal') }}" class="other-page-button">Read More</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-4 col-md-6 mb-4 text-center" id="zoomIn">
                        <div class="div-card">
                            <div class="text-center">
                                <img src="{{ url('theme-new/img/Terminal_2_new.webp') }}" class="img-fluid img-gif">
                            </div>
                            <h2 class="safty-cs steps-css">Manchester <span style="color:#000"> Terminals 2 </span></h2>
                            <p class="safty-cs-p">Terminal 2 focuses on long-haul and Oneworld alliance flights, especially popular for North American routes, and provides a wide range of shops and lounges.</p>
                            <a href="{{ url('terminal-02') }}" class="other-page-button">Read More</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4 text-center" id="zoomIn">
                        <div class="div-card">
                            <div class="text-center">
                                <img src="{{ url('theme-new/img/Terminal_3_new.webp') }}" class="img-fluid img-gif">
                            </div>
                            <h2 class="safty-cs steps-css">Manchester <span style="color:#000"> Terminals 3 </span></h2>
                            <p class="safty-cs-p">Terminal 3 hosts many SkyTeam airlines and caters to international flights in a quieter environment, with several dining and relaxation options for travelers.</p>
                            <a href="{{ url('terminal-03') }}" class="other-page-button">Read More</a>
                        </div>
                    </div> -->
                  
                </div>
            </div>
        </section>
    </div>
    <section id="section-b" class="section-b2 happyClients" style="margin-top: 15px;margin-bottom: 83px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="section-heading">
                    <h2 class="section-3-h2 text-center">Our Happy <span style="color:#0c5adb"> Clients
                        </span></h2>
                    @include('layouts.happy_clients')
                </div>
            </div>
        </div>
    </section>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize ScrollReveal with reset option to allow repeat on scroll up
            ScrollReveal().reveal('#fadeIn', {
            opacity: 0,
            duration: 1000,
            reset: true // Resets on scroll up
            });

            ScrollReveal().reveal('#slideInLeft', {
            distance: '200px',
            origin: 'left',
            duration: 1000,
            reset: true
            });

            ScrollReveal().reveal('#scaleUp', {
            scale: 0.8,
            duration: 1000,
            reset: true
            });

            ScrollReveal().reveal('#rotate', {
            rotate: { x: 0, y: 0, z: 180 },
            duration: 1000,
            reset: true
            });

            ScrollReveal().reveal('#bounce', {
            distance: '50px',
            origin: 'bottom',
            duration: 1000,
            easing: 'ease-in-out',
            reset: true
            });
            ScrollReveal().reveal('#slideInRight', {
            distance: '350px',
            origin: 'right',
            duration: 2000,
            reset: true
            });
            ScrollReveal().reveal('#zoomIn', {
                scale: 0.5,       // Starts at 50% of its size
                duration: 2000,   // Animation duration of 1 second
                reset: true       // Resets on scroll up
            });
        });
  </script>
@endsection
