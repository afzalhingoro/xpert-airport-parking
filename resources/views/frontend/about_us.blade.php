@extends('layouts.main')
<style>
    .section-b2 {
		height: auto !important;
	}

    @media(min-width: 1200px) {
        .aboutUs.section-3 {
            margin-top: 160px !important;
        }
    }

    section.whatServices {
        padding: 50px 0;
        background: #ededed;
    }

    @media(min-width: 768px) {
        section.whatServices {
            padding: 100px 0 !important;
            background: #ededed;
        }
    }

    @media(max-width: 768px) {
        .parkMark .container, .whatServices .container, .aboutUs.section-3 .container {
            padding-left: 15px;
            padding-right: 15px;
        }

        .parkMark .section-3-p, .whatServices .section-3-p, .aboutUs.section-3 .section-3-p {
            margin-left: 0;
        }
    }

    .parkMark .section-3-h2, .whatServices .section-3-h2, .aboutUs .section-3-h2 {
        text-align: left !important;
        margin-bottom: 25px;
    }

    section#section-b.happyClients {
      margin: 100px 0 120px !important;
    }

    @media(max-width: 768px) {
      section#section-b.happyClients {
		margin-bottom: unset !important;
        margin: 50px 0 100px !important;
      }

      .aboutUs img.about-imgs, .whatServices img.about-imgs {
        max-height: 100% !important;
      }

      #search_form_1 {
        margin: 0 !important;
      }
	}
</style>

@section('content')
<section id="bg-css" class="aboutBgCss">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12" id="slideInRight">
                            <h1 class="h3banner">About Xpert Airport Parking | Our Mission & Values</h1>
                            <p>Convenient, secure parking at Stansted Airport.</p>
                        </div>
                        @include('layouts.search_form_others')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section-3 aboutUs">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-3-h2"><span> About</span> Xpert Airport Parking</h2>
                <p class="section-3-p"><strong>
                        Welcome to Xpert Airport Parking, Premium Park & Ride at Stansted Airport
</strong>
                    <br>
                   We are able to negotiate the lowest rates for our clients because of our vast expertise and understanding of airport parking providers around the United Kingdom. Your car and your money are the only things we care about.
                    <br>
            Our specialty at Xpert Airport Parking is providing<strong>Stansted Airport Park & Ride services </strong> that are easy, safe, and reasonably priced. Our experienced and amiable staff is here to make your airport parking experience free of anxiety from beginning to end, whether you're leaving on a business trip or a family vacation. 
            <br>
            We have a dedicated call center available to help you in any manner we can. We operate with efficiency, friendliness, and professionalism, and our safe online booking tools give clients who would rather make reservations online peace of mind.
          
            We work hard to provide you with the best quality at affordable costs since we appreciate our clients.

                </p>
            </div>
            <div class="col-lg-6 col-r aboutUsImg">
                <img src="{{ url('theme-new/img/About-Us-Image-01.png') }}" class="img-fluid about-imgs" alt="image-1">
            </div>
        </div>
    </div>
</section>

<section class="mt-4 whatServices">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-l des-mob">
                <img src="{{ url('theme-new/img/About-Us-Image-02.png') }}" class="img-fluid about-imgs" alt="image-1">
            </div>
            <div class="col-lg-6">
                <h2 class="section-3-h2">Why <span>Choose Us? </span> </h2>
                <p class="section-3-p">
                     <ul>
                    <li class="section-3-p"><storng>Trusted & Experienced:</storng> Our staff of highly qualified drivers is dedicated to providing exceptional service that consistently attracts new clients.</li>
                    <li class="section-3-p"><storng>Secure Parking:</storng> Our car park is monitored 24/7 with CCTV surveillance, giving you peace of mind while you travel.</li>
                    <li class="section-3-p"><storng>Effortless Booking:</storng> Get quick rates and make a reservation online with a couple of taps, or give us a call to talk to a member of our friendly staff. Our service is designed to be effortless from start to finish.
</li>
                        <li class="section-3-p"><storng>Affordable & High Quality:</storng> Affordable rates are being provided by us without sacrificing the caliber of our offerings.</li>
                </ul>
                     <p class="section-3-p">
                    
                   We go above and above to keep your car secure while you're away because we know how important it is to you. To guarantee you have the greatest experience each and every time you park with us, our skilled, knowledgeable staff is always enhancing our offerings. 


                    <strong>
                      Save time, save money, and travel with confidence. Park with Xpert Airport Parking and leave the rest to us.</strong>

                </p>
             </p>
                
            </div>
            <!-- <div class="col-lg-6 col-l des-mob2">
                <img src="{{ url('theme-new/img/About-Us-Image-02.png') }}" class="img-fluid about-imgs" alt="image-1">
            </div> -->
        </div>
    </div>
</section>

<section class="section-3 parkMark">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="section-3-h2">Park and Ride:  <span>Simple, Safe & Convenient
</span></h2>
                 <p class="section-3-p">
                  Getting to the airport doesn’t have to be stressful and with our Park and Ride service, it isn’t. Just pull into our secure car park, hand over your keys, and hop on one of our friendly shuttle rides straight to the terminal.
You can relax knowing your car is in safe hands while you’re off making memories or closing deals. Once you’ve dropped it off, you’re free to head straight to check-in. No stress, No delays.
Whether you prefer to park right at the airport or a little further out to save, we’ve got flexible options that suit your plans and your budget. From the moment you arrive, we’re here to help your journey start off right.


                </p>
                  
            </div>
        </div>
    </div>
</section>

<section id="section-b" class="section-b2 happyClients">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-heading">
                <h2 class="section-3-h2 text-center">Our Happy <span class="span_color"> Clients
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
            rotate: {
                x: 0,
                y: 0,
                z: 180
            },
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
            scale: 0.5, // Starts at 50% of its size
            duration: 2000, // Animation duration of 1 second
            reset: true // Resets on scroll up
        });        
    });
</script>
<!--@include('layouts.parking_type')-->
@endsection