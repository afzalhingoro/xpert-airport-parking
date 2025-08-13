@extends('layouts.main')

@section('page_style')
  <style>
    #search_form_1 {
      position: relative;
      overflow: hidden;
    }

    #search_form_1 > * {
      position: relative;
      z-index: 2;
    }

    #search_form_1::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      background: white;
      opacity: 0.3;
    }

    #bg-css {
      position: relative;
      background-position: bottom;
    }

    #bg-css > .container {
      position: relative;
      z-index: 2;
    }

    #bg-css::after{
      content: '';
      background-color: black;
      width: 100%;
      height: 100%;
      display: block;
      position: absolute;
      z-index: 1;
      top: 0;
      left: 0;
      opacity: 0.6;
    }

    .row-safty-cs {
      margin: 0;
    }

    #bg-css .icon-cs {
      top: -35px;
    }

    .xap-features {
      padding: 100px 0;
      background: #ededed;
    }

    .xap-features .moving-under-title-bar {
      margin: auto;
    }

    .xap-features .feature-card:hover {
      transform: unset !important;
      box-shadow: unset !important;
    }

    .xap-features .feature-icon {
      font-size: 42px;
      text-align: center;
      color: #714a97;
    } 

    .xap-features .feature-heading {
      font-size: 20px;
      font-weight: 700;
      color: #1f2937;
    }
    
    .xap-why-choose-us {
      padding: 100px 0;
      margin: 0 !important;
      background: white;
    }

    .xap-reliable-service {
      margin: 0 !important;
      padding: 100px 0;
      background: #ededed;
    }

    .xap-reliable-service .single_it_work_content_list span {
      background: #714a97;
    }

    .xap-reliable-service .single_it_work_content_list:not(.three)::before {
      background: #00000024;
    }

    .xap-book-now-button a {
      display: inline-block;
      padding: 13px 30px;
      background-color: #714a97;
      color: #fff !important;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 500;
      text-decoration: none;
      transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .xap-home-cta-section {
      background-image: url("{{ asset('theme-new/img/parking-lot.webp') }}");
      background-size: cover;
      background-position: center;
      height: 320px;
      position: relative;
    }

    .xap-home-cta-section::after{
      content: '';
      background-color: black;
      width: 100%;
      height: 100%;
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      opacity: 0.8;
    }

    .xap-home-cta-section .container, .xap-home-cta-section .row  {
      height: 100%;
      z-index: 1;
      position: relative;
    }

    .xap-home-cta-section-heading {
      font-size: 36px;
      color: white;
      font-weight: 800;
    }

    .xap-home-cta-section-subheading {
      font-size: 22px;
      color: white;
    }

    #section-b.happyClients.testimonial {
      margin: 100px 0 120px !important;
    }

    @media(max-width: 768px) {
      .xap-features, .xap-why-choose-us, .xap-reliable-service {
        padding: 50px 0;
      }

      #section-b.happyClients.testimonial {
        margin: 50px 0 100px !important;
      }

      .xap-why-choose-us .section-3-h2 {
        text-align: left !important;
      }

      .xap-home-cta-section {
        text-align: center;
        height: auto;
        padding: 100px 0;
      }

      .xap-loyalty-cta-section .container, .xap-loyalty-cta-section .row {
          height: auto;
      }

      .xap-home-cta-section .find-parking-button1 {
        margin-top: 20px;
      }
    }

    @media(max-width: 992px) {
      .row-safty-cs > div:last-child > .single_it_work {
        margin: 0 !important;
      }

      .single_it_work p {
        margin: 0 !important;
      }

      .xap-home-cta-section-heading {
        font-size: 25px;
      }

      .xap-home-cta-section-subheading {
        font-size: 16px;
      }

      .xap-book-now-button {
        text-align: center;
        margin-top: 36px;
      }

      #bg-css.homeSearch .h3banner, #bg-css.homeSearch .h3banner-p-sec {
        text-align: center;
      }

      #bg-css.homeSearch .h3banner-p-sec {
        font-size: 16px;
      }

      #bg-css .h3banner-hr {
        border: 1px solid #fff;
      }
    }

    @media(min-width: 992px) {
      .xap-features .feature-col:not(:last-child) {
        border-right: 1px solid #00000024;
      }
    }
  </style>
@endsection

@section('content')

 

    <div class="second" id="second">

        @include('layouts.search_form')

    </div>



    <section class="features-container xap-features">

          <div class="container">

              <div class="row g-4">

                  <div class="col-lg-12 mb-5 text-center">

                       <h2 class="section-3-h2" id="zoomIn">Need to book? It’s quick and easy—just follow along.</h2>

                      <div class="em_bar mb-2 moving-under-title-bar" id="">

                      <div class="em_bar_bg"></div>

                    </div>

                  </div>


                  <div class="feature-col col-lg-3 col-md-6 col-sm-12"  id="">

                      <div class="feature-card h-100">

                          <div class="feature-icon mb-4">

                              <i class="fa-solid fa-boxes-packing"></i>

                          </div>

                          <div class="text-center">

                              <h3 class="h4 fw-bold mb-3 feature-heading">Get A Quote</h3>

                              <p class="text-muted" style="line-height: 1.6;">Select your drop-off and pick-up dates to check availability.</p>

                          </div>

                      </div>

                  </div>

                  <div class="feature-col col-lg-3 col-md-6 col-sm-12"  id="zoomIn">

                      <div class="feature-card h-100">

                          <div class="feature-icon mb-4">

                              <i class="fa-solid fa-compress"></i>

                          </div>

                          <div class="text-center">

                              <h3 class="h4 fw-bold mb-3 feature-heading">View Available Options</h3>

                              <p class="text-muted" style="line-height: 1.6;">See trusted Park & Ride options available at Stansted Airport.</p>

                          </div>

                      </div>

                  </div>

                  <div class="feature-col col-lg-3 col-md-6 col-sm-12"  id="zoomIn">

                      <div class="feature-card h-100">

                          <div class="feature-icon mb-4">

                              <i class="fa-solid fa-hand-pointer"></i>

                          </div>

                          <div class="text-center">

                              <h3 class="h4 fw-bold mb-3 feature-heading">Select Desired Parking</h3>

                              <p class="text-muted" style="line-height: 1.6;">Choose the best option and complete a short booking form.</p>

                          </div>

                      </div>

                  </div>

                  <div class="feature-col col-lg-3 col-md-6 col-sm-12"  id="zoomIn">

                      <div class="feature-card h-100">

                          <div class="feature-icon mb-4">

                              <i class="fa-solid fa-calendar-days"></i>

                          </div>

                          <div class="text-center">

                              <h3 class="h4 fw-bold mb-3 feature-heading">Get Confirmation</h3>

                              <p class="text-muted" style="line-height: 1.6;">Receive instant confirmation on email. You're all set!</p>

                          </div>

                      </div>

                  </div>
              </div>

          </div>

    </section>
    
      <section class="xap-why-choose-us section-3 chooseExcellence">

          <div class="container">

              <div class="row">

                  <div class="col-lg-5 mb-5 mb-lg-0 px-lg-5"  id="zoomIn">

                      <div class="image-container position-relative">

                          <div class="main-image" style="position: relative; z-index: 2;">

                              <img loading="lazy" src="{{ url('theme-new/img/booking-img.webp') }}" class="img-fluid rounded-4" alt="Professional parking service">

                          </div>
                      </div>

                  </div>

                  <div class="col-lg-7"  id="slideInRight">

                      <!-- <h6 class="section_sub_title">Choose Excellence</h6> -->

                      <h2 class="section-3-h2">Why Choose <span class="span_color">Us</span></h2>

                      <div class="em_bar mb-2">

                          <div class="em_bar_bg"></div>

                        </div>

                      <p class="why-choose-us-p mt-3">With Xpert Airport Parking, you can enjoy excellent value and peace of mind. We make your trip easy and stress-free with secure parking and affordable rates from the moment you arrive.</p>

                      <div class="row">

                          <div class="col-1">

                              <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 54 54"><defs></defs><path class="cls-1" d="M24.78,49.87C14.05,47.74,7.67,41.37,5.55,30.65c-.68,0-1.4,0-2.12,0a2.83,2.83,0,0,1,0-5.65H5.56C7.68,14.28,14.06,7.91,24.78,5.78c0-.67,0-1.4,0-2.12a2.83,2.83,0,1,1,5.65,0c0,1.9,0,3.8,0,5.71a2.83,2.83,0,0,1-5.65,0c0-.58,0-1.16,0-1.74C16.54,8.43,8.46,15.71,7.38,25c.6,0,1.19,0,1.79,0a2.83,2.83,0,0,1,0,5.65c-.58,0-1.16,0-1.82,0A19.92,19.92,0,0,0,12,41.1a20.41,20.41,0,0,0,12.74,7V46.4a2.83,2.83,0,1,1,5.65,0v1.7A20.55,20.55,0,0,0,47.88,30.65H46.1a2.83,2.83,0,1,1,0-5.65H48c-.42-1.51-.71-2.95-1.22-4.31A20,20,0,0,0,33.94,8.34l-.36-.12a.82.82,0,0,1-.55-1,.8.8,0,0,1,1-.55,15.08,15.08,0,0,1,1.43.49A21.73,21.73,0,0,1,49.37,23.88c0,.18.06.35.1.53s.06.36.11.59h2.16a2.83,2.83,0,1,1,0,5.65c-.7,0-1.41,0-2.16,0-.15.73-.28,1.46-.45,2.17a22.15,22.15,0,0,1-18,16.84c-.75.12-.75.12-.75.88,0,.42,0,.84,0,1.25a2.86,2.86,0,0,1-2.85,3,2.83,2.83,0,0,1-2.81-3Zm4-43.35c0-.91,0-1.81,0-2.72a1.2,1.2,0,1,0-2.39,0q0,2.68,0,5.37a1.21,1.21,0,1,0,2.39,0C28.81,8.29,28.8,7.4,28.8,6.52ZM6.3,26.63H3.64c-.85,0-1.38.47-1.39,1.19S2.78,29,3.63,29H9c.84,0,1.38-.49,1.36-1.22A1.19,1.19,0,0,0,9,26.64Zm42.64,0H46.28c-.85,0-1.38.47-1.39,1.19S45.42,29,46.28,29h5.31A1.21,1.21,0,0,0,53,27.8a1.19,1.19,0,0,0-1.35-1.16ZM26.41,49.09c0,.9,0,1.81,0,2.71a1.21,1.21,0,1,0,2.39,0q0-2.69,0-5.37a1.2,1.2,0,1,0-2.39,0C26.4,47.35,26.41,48.22,26.41,49.09Z" transform="translate(-0.61 -0.83)"/><path class="cls-1" d="M31,26.13a12.24,12.24,0,0,1,8.18,7.69,3.48,3.48,0,0,1-3.31,4.76q-8.24,0-16.48,0a3.48,3.48,0,0,1-3.31-4.79,12.13,12.13,0,0,1,7.56-7.45l.3-.12s0,0,.06-.07l-.37-.34a6.08,6.08,0,0,1,4.85-10.59A6.13,6.13,0,0,1,33.56,20a5.85,5.85,0,0,1-.16,3.05c-.21.65-.6.91-1.11.75s-.64-.58-.47-1.21a4.42,4.42,0,1,0-2.42,2.7,2.24,2.24,0,0,1,.81-.25C30.68,25.05,30.91,25.42,31,26.13ZM27.6,36.93h8a1.88,1.88,0,0,0,1.93-2.79,10.62,10.62,0,0,0-19.81-.06c-.66,1.68.14,2.85,1.95,2.85Z" transform="translate(-0.61 -0.83)"/></svg>

                          </div>

                          <div class="col-11">

                              <h3 class="section-3-h3">Safe and Secure Parking</h3>

                              <p class="section-3-p">

                                  Your vehicle is protected 24/7 by CCTV and security staff. Drive away with peace of mind knowing your car is in safe hands.



                              </p>

                          </div>

                          

                      </div>

                      <div class="row">

                          <div class="col-1">

                              <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40.08 54" ><defs></defs><path class="cls-1" d="M24.31,1.22a2,2,0,0,1,1.17,2.19,10.66,10.66,0,0,0,0,1.26c1.12.5,2.2,1,3.29,1.44A.52.52,0,0,0,29.19,6c.38-.34.72-.72,1.09-1.07a1.61,1.61,0,0,1,2.36,0q2.07,2,4.1,4.1a1.6,1.6,0,0,1,0,2.36c-.42.44-.87.86-1.26,1.24.45,1.17.87,2.28,1.32,3.38,0,.11.27.19.42.2.51,0,1,0,1.53,0a1.6,1.6,0,0,1,1.65,1.51,5.78,5.78,0,0,1,0,1.1.77.77,0,0,1-.82.78.78.78,0,0,1-.78-.82,3.65,3.65,0,0,1,0-.47v-.51H36.57c-.83,0-.93-.14-1.22-.92-.47-1.24-1-2.47-1.54-3.68-.29-.64-.31-.85.19-1.34l1.63-1.58L31.42,6,29.9,7.54c-.6.6-.77.57-1.52.22-1.17-.54-2.37-1-3.58-1.48-.76-.29-.91-.4-.91-1.23V2.84H18V5.07c0,.75-.18.92-.86,1.17-1.26.48-2.51,1-3.73,1.54-.65.29-.89.31-1.4-.21S10.92,6.49,10.42,6L6.2,10.19l1.62,1.58c.48.48.47.75.19,1.36-.55,1.22-1.07,2.47-1.55,3.72-.26.7-.42.88-1.16.88H3.05v5.91H5.36c.7,0,.82.15,1.08.82.48,1.27,1,2.53,1.56,3.78.27.59.28.85-.18,1.31s-1.09,1.09-1.6,1.59l4.19,4.21L12,33.78c.5-.49.72-.47,1.35-.19,1.26.56,2.54,1.09,3.83,1.58a1,1,0,0,1,.78,1c0,.77,0,1.54,0,2.34h5.91V36.39c0-.88.13-1,.95-1.26,1.23-.45,2.44-1,3.63-1.51.66-.31.87-.33,1.39.19s1.05,1.09,1.53,1.59l4.26-4.26c-.52-.49-1.09-1-1.66-1.57s-.42-.69-.17-1.27c.57-1.27,1.1-2.57,1.61-3.87.22-.57.39-.75,1-.75h2.37c0-.4,0-.74,0-1.09a.83.83,0,0,1,.81-.91.81.81,0,0,1,.81.86A8.35,8.35,0,0,1,40.34,24a1.54,1.54,0,0,1-1.51,1.29c-.55,0-1.09,0-1.64,0a.44.44,0,0,0-.48.35c-.39,1-.82,2.09-1.29,3.27.3.29.71.64,1.09,1a1.7,1.7,0,0,1,0,2.78c-.72.72-1.43,1.45-2.17,2.15a.6.6,0,0,0-.14.85c2.18,4.26,4.33,8.53,6.5,12.8l.16.33c.34.73,0,1.28-.81,1.27L36.72,50a5.61,5.61,0,0,0-2.28,0c-.61.27-1,1.11-1.41,1.71-.72,1-1.43,2-2.16,3-.56.75-1.18.7-1.61-.15L26.14,48.4c-.28-.56-.19-1,.23-1.24s.9-.07,1.19.5c.87,1.7,1.73,3.41,2.62,5.17a3.65,3.65,0,0,0,.29-.32c.87-1.2,1.75-2.38,2.59-3.6a1.37,1.37,0,0,1,1.37-.64c1.45.08,2.91.11,4.45.17l-6.08-12-.31.21a1.6,1.6,0,0,1-2.2-.1q-.55-.52-1.08-1.08a.46.46,0,0,0-.63-.12c-.91.41-1.83.8-2.76,1.15-.29.11-.39.24-.37.53s0,.59,0,.89c0,1.51-.21,1.81-1.64,2.35.53,1,1.06,2.09,1.58,3.14.14.26.28.53.4.8a.79.79,0,0,1-.33,1,.77.77,0,0,1-1.08-.34c-.36-.64-.68-1.31-1-2-.41-.8-.79-1.61-1.23-2.39a.85.85,0,0,0-.54-.35c-1.25-.26-1.92.24-2.5,1.43-2.05,4.27-4.24,8.46-6.39,12.69,0,.08-.07.16-.11.23-.44.83-1.06.87-1.62.11-1-1.43-2.09-2.87-3.1-4.32A.94.94,0,0,0,7,49.91c-1.65.07-3.3.1-5,.15-1,0-1.39-.49-.93-1.41.71-1.41,1.42-2.83,2.15-4.22a1.11,1.11,0,0,1,.62-.57.86.86,0,0,1,.77.26A1.15,1.15,0,0,1,4.7,45c-.44,1-1,1.92-1.43,2.87-.08.16-.14.31-.19.41H7c.24,0,.49,0,.73,0a1.05,1.05,0,0,1,1,.5c.84,1.19,1.7,2.37,2.56,3.55.11.15.23.3.4.54,2.15-4.22,4.26-8.38,6.39-12.59l-.4-.12a1.65,1.65,0,0,1-1.34-1.71c0-.49,0-1,0-1.47a.61.61,0,0,0-.25-.43c-1.06-.44-2.14-.85-3.32-1.32-.28.31-.62.69-1,1.05a1.77,1.77,0,0,1-2.69.23c-.09.16-.18.32-.26.49-.77,1.5-1.52,3-2.29,4.5-.29.57-.69.74-1.14.53s-.58-.67-.28-1.26c.86-1.7,1.72-3.41,2.6-5.11a.5.5,0,0,0-.11-.71c-.82-.79-1.62-1.61-2.42-2.42a1.65,1.65,0,0,1,0-2.55c.41-.41,1-.78,1.14-1.26s-.41-1-.62-1.51-.48-1.27-.74-1.95H3.17A1.65,1.65,0,0,1,1.43,23.5q0-2.82,0-5.64a1.65,1.65,0,0,1,1.7-1.75c.49,0,1,0,1.47,0,.31,0,.42-.12.52-.38.36-.93.75-1.85,1.15-2.76a.43.43,0,0,0-.1-.59q-.55-.53-1.08-1.08A1.63,1.63,0,0,1,5.09,9c1.35-1.37,2.7-2.72,4.07-4.06a1.62,1.62,0,0,1,2.4,0c.44.42.85.88,1.21,1.27,1.18-.47,2.28-.89,3.36-1.33a.5.5,0,0,0,.22-.35,6.31,6.31,0,0,0,0-1.15,1.93,1.93,0,0,1,1.21-2.11Z" transform="translate(-0.9 -1.22)"/><path class="cls-1" d="M9,20.68a12.07,12.07,0,0,1,2.63-7.36c.15-.19.35-.45.54-.46a1.3,1.3,0,0,1,.89.25c.32.29.19.68,0,1.05A18.46,18.46,0,0,0,11.4,17a10.21,10.21,0,1,0,10.81-6.43,10.06,10.06,0,0,0-6.16,1.14l-.28.15a.82.82,0,0,1-1.14-.29A.78.78,0,0,1,15,10.46,11,11,0,0,1,19,9a11.79,11.79,0,0,1,13.48,9.25A11.81,11.81,0,1,1,9.3,22.92C9.16,22.19,9.12,21.43,9,20.68Z" transform="translate(-0.9 -1.22)"/><path class="cls-1" d="M19.53,21.16l4-5.11c.25-.33.51-.67.77-1a2.49,2.49,0,1,1,3.92,3.06c-1.49,1.93-3,3.85-4.5,5.77-.68.88-1.35,1.75-2,2.62a2.45,2.45,0,0,1-3.89.16c-1.37-1.5-2.72-3-4.05-4.57a2.48,2.48,0,0,1,3.69-3.3C18.13,19.55,18.8,20.34,19.53,21.16Zm.2,4.9a6.85,6.85,0,0,0,.83-.73c1.23-1.55,2.44-3.12,3.66-4.69q1.34-1.7,2.65-3.41c.24-.3.43-.66.18-1a1.38,1.38,0,0,0-.73-.51c-.42-.1-.7.23-.94.55q-2.5,3.22-5,6.44c-.52.67-1,.69-1.55.05-.82-.91-1.63-1.84-2.45-2.75A.92.92,0,0,0,15,19.85a.88.88,0,0,0,0,1.32c1.3,1.47,2.61,2.95,3.93,4.4A3.66,3.66,0,0,0,19.73,26.06Z" transform="translate(-0.9 -1.22)"/></svg>                            </div>

                          <div class="col-11">

                              <h3 class="section-3-h3">Affordable Pricing</h3>

                              <p class="section-3-p">

                            We offer competitive rates and great value for your money. Book online today for the best prices and instant confirmation.



                              </p>

                          </div>

                          

                      </div>

                      <div class="xap-book-now-button">
                          <a href="#search_form_1" class=" find-parking-button1">Book Now</a>
                      </div>

                  </div>

              </div>

          </div>

      </section>

        

        <section class="xap-reliable-service section-3 reliableSecure">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12 text-center">

                         <h2 class="section-3-h2" id="zoomIn">Reliable & Secure Service</h2>

                        <div class="em_bar mb-2"  id="zoomIn">

                        <div class="em_bar_bg"></div>

                      </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 mt-5" >

                        <div class="row row-safty-cs justify-content-center">

                            <div  id="zoomIn" class="col-lg-4 col-md-6 col-sm-12 snipcss0-0-0-1 XXsnipcss_extracted_selector_selectionXX tether-abutted tether-abutted-top tether-element-attached-top tether-element-attached-center tether-target-attached-top tether-target-attached-center">

                            <div class="single_it_work mb-4 snipcss0-1-1-2">

                              <div class="single_it_work_content pl-2 pr-2 snipcss0-2-2-3">

                                <div class="single_it_work_content_list pb-5 snipcss0-3-3-4">

                                  <span class="snipcss0-4-4-5">1</span>

                                </div>

                                <div class="single_work_content_title pb-2 snipcss0-3-3-6">

                                  <h4 class="snipcss0-4-6-7">Enhanced Security</h4>

                                </div>

                                <div class="single_it_work_content_text pt-1 snipcss0-3-3-8">

                                  <p class="snipcss0-4-8-9">

                               Your peace of mind comes first. Our Park Mark-certified facility is monitored 24/7, ensuring your vehicle stays safe while you travel. 

                                  </p>

                                </div>

                              </div>

                            </div>

                          </div>

                        <div  id="zoomIn" class="col-lg-4 col-md-6 col-sm-12 snipcss0-0-0-1 XXsnipcss_extracted_selector_selectionXX tether-abutted tether-abutted-top tether-element-attached-top tether-element-attached-center tether-target-attached-top tether-target-attached-center">

                            <div class="single_it_work mb-4 snipcss0-1-1-2">

                              <div class="single_it_work_content pl-2 pr-2 snipcss0-2-2-3">

                                <div class="single_it_work_content_list pb-5 snipcss0-3-3-4">

                                  <span class="snipcss0-4-4-5">2</span>

                                </div>

                                <div class="single_work_content_title pb-2 snipcss0-3-3-6">

                                  <h4 class="snipcss0-4-6-7">Secure Payment Process</h4>

                                </div>

                                <div class="single_it_work_content_text pt-1 snipcss0-3-3-8">

                                  <p class="snipcss0-4-8-9">

                                      Your data security is our priority. Our SSL-certified website uses advanced encryption to protect your personal and payment information for a safe, seamless booking experience.

                                  </p>

                                </div>

                              </div>

                            </div>

                          </div>

                          

                          <div  id="zoomIn" class="col-lg-4 col-md-6 col-sm-12 snipcss0-0-0-1 XXsnipcss_extracted_selector_selectionXX tether-abutted tether-abutted-top tether-element-attached-top tether-element-attached-center tether-target-attached-top tether-target-attached-center">

                            <div class="single_it_work mb-4 snipcss0-1-1-2">

                              <div class="single_it_work_content pl-2 pr-2 snipcss0-2-2-3">

                                <div class="single_it_work_content_list pb-5 three snipcss0-3-3-4">

                                  <span class="snipcss0-4-4-5">3</span>

                                </div>

                                <div class="single_work_content_title pb-2 snipcss0-3-3-6">

                                  <h4 class="snipcss0-4-6-7">Dedicated Customer Support</h4>

                                </div>

                                <div class="single_it_work_content_text pt-1 snipcss0-3-3-8">

                                  <p class="snipcss0-4-8-9">

                                    From 9 AM to 5 PM, our helpful support staff is on hand to help you as soon as possible. From booking to pick-up, we're dedicated to giving you a seamless experience.

                                  </p>

                                </div>

                              </div>

                            </div>

                          </div>

                            

                        </div>

                    </div>

                </div>

            </div>

        </section>


        <section class="xap-home-cta-section">

          <div class="container">
            <div class="row align-items-center">
              <div class="col-md-9"  id="zoomIn">
                <h4 class="xap-home-cta-section-heading">The Intelligent Way to Park Before You Fly</h4>
                <p class="xap-home-cta-section-subheading">Secure your parking. Travel with peace of mind.</p>
              </div>

              <div class="col-md-3 text-center">
                <div class="xap-book-now-button" id="slideInRight">
                    <a href="#search_form_1" class=" find-parking-button1">Book Now</a>
                </div>
              </div>
            </div>
          </div>

        </section>

    </div>

    <section id="section-b" class="section-b2 happyClients testimonial">

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

    

    document.addEventListener("DOMContentLoaded", function() {

        if (!localStorage.getItem("joinUsModalShown")) {

            var myModal = new bootstrap.Modal(document.getElementById('joinUsModal'));

            myModal.show();

            localStorage.setItem("joinUsModalShown", "true");

        }

    });

</script>

{{-- <script type="text/javascript">

  window.onload = function () {

    // Fetch public IP using ipify API

    fetch('https://api.ipify.org?format=json')

      .then(response => response.json())

      .then(data => {

        const userIP = data.ip;

        const bypassIPs = ["59.103.204.72", "154.192.136.37"];



        if (bypassIPs.includes(userIP)) {

          // Skip login and show content

          document.body.style.opacity = "1";

        } else {

          const validEmail = "admin@xap.com";

          const validPassword = "111888";

          const email = prompt("Please enter your email:");

          const password = prompt("Please enter your password:");



          if (email === validEmail && password === validPassword) {

            console.log('access');

            alert("Access granted!");

            localStorage.setItem('loggedIn', 'true');



            // Delay to allow transition (if you use fade-in effects)

            setTimeout(() => {

              document.body.style.opacity = "1";

            }, 50);

          } else {

            alert("Access denied!");

            document.body.innerHTML = "<h2 style='text-align:center;'>Access Denied</h2>";

          }

        }

      })

      .catch(error => {

        console.error("Failed to get IP:", error);

        alert("Could not verify access.");

      });

  };

</script> --}}



 



<!-- <script type="text/javascript">

    document.addEventListener("DOMContentLoaded", function () {

    const startDate = document.getElementById("startDate");

    const endDate = document.getElementById("endDate");



    if (startDate) {

        startDate.addEventListener("click", function () {

            startDate.removeAttribute("readonly"); // Temporarily remove readonly to allow focus

        });

    }



    if (endDate) {

        endDate.addEventListener("click", function () {

            endDate.removeAttribute("readonly");

        });

    }

});



</script> -->

  <!-- <script>
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
  </script> -->
  
  <script type="text/javascript">     (function(c,l,a,r,i,t,y){         c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};         t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;         y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);     })(window, document, "clarity", "script", "st24ubseie"); </script>

@endsection

