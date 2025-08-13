@extends('layouts.main')
@section('content')
<section id="bg-css">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 content-container" id="slideInRight">
              <h1 class="h3banner">Manchester Airport Parking</h1>
              <p class="banner-description">Convenient, secure parking at Manchester Airport.</p>
            </div>
            @include('layouts.search_form_others')
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="manchesterTerminal">
  <section class="section-3">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center" id="zoomIn">
          <h2 class="section-3-h2"><span>Manchester</span> Terminals</h2>
          <p class="section-3-p">Manchester Airport has three terminals: Terminal 1 (international flights, primarily served by airlines like Emirates, TUI, and Air Canada), Terminal 2 (domestic and international flights, with airlines such as British Airways, Jet2, and EasyJet), and Terminal 3 (short-haul and long-haul flights, mainly served by carriers like TUI Airways and Air France). Each terminal offers a range of services, including shopping, dining, and lounges, all tailored to specific airlines and destinations.</p>
          <br>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 text-center" id="zoomIn">
          <div class="div-card">
            <div class="text-center">
              <img src="{{ url('theme-new/img/Terminal_1_new.webp') }}" class="img-fluid img-gif">
            </div>
            <h2 class="safty-cs steps-css">Manchester <span> Terminals 1 </span></h2>
            <p class="safty-cs-p">Manchester Airport’s Terminal 1, known as "The Queen’s Terminal," serves Star Alliance airlines and offers modern facilities with a variety of dining and shopping options.</p>
            <a href="{{ url('terminal-01') }}" class="other-page-button">Read More</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 text-center" id="zoomIn">
          <div class="div-card">
            <div class="text-center">
              <img src="{{ url('theme-new/img/Terminal_2_new.webp') }}" class="img-fluid img-gif">
            </div>
            <h2 class="safty-cs steps-css">Manchester <span> Terminals 2 </span></h2>
            <p class="safty-cs-p">Terminal 2 focuses on long-haul and Oneworld alliance flights, especially popular for North American routes, and provides a wide range of shops and lounges.</p>
            <a href="{{ url('terminal-02') }}" class="other-page-button">Read More</a>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4 text-center" id="zoomIn">
          <div class="div-card">
            <div class="text-center">
              <img src="{{ url('theme-new/img/Terminal_3_new.webp') }}" class="img-fluid img-gif">
            </div>
            <h2 class="safty-cs steps-css">Manchester <span> Terminals 3 </span></h2>
            <p class="safty-cs-p">Terminal 3 hosts many SkyTeam airlines and caters to international flights in a quieter environment, with several dining and relaxation options for travelers.</p>
            <a href="{{ url('terminal-03') }}" class="other-page-button">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

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
