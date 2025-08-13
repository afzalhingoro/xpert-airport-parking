<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="xpbruIJnQGRJ6vs4dEfvPNwAnMQfRDmuSkctGX6FNH8" />
<link rel="shortcut icon" href="{{ url('theme-new/img/Logo-For-Favicon-v1.png') }}?v=17519847221213205">

@vite(['resources/css/app.css', 'resources/js/app.js'])

@php
    $site_settings_main = [];
    $settingsAll = App\Models\settings::all();
    foreach ($settingsAll as $setting) {
        $site_settings_main[$setting->field_name] = $setting->field_value;
    }
@endphp
@if (request()->is('about-us'))
    <title>About Xpert Airport Parking | Our Mission & Values</title>
    <meta name="description" content="Learn about Xpert Airport Parking’s commitment to secure, affordable, and reliable airport parking with exceptional customer service and convenient shuttle transfers.">

@elseif (request()->is('c-register'))
    <title>Customer Registration | Create Your Account | Xpert Airport Parking</title>
    <meta name="description" content="Register your account with Xpert Airport Parking for fast booking, managing reservations, and accessing exclusive deals on secure airport parking.">
@elseif (request()->is('customer-login'))
    <title>Customer Login | Access Your Account | Xpert Airport Parking</title>
    <meta name="description" content="Log in to your Xpert Airport Parking account to manage bookings, view reservations, and access exclusive parking offers.">
@elseif (request()->is('rewards-and-loyalty'))
    <title>Xpert Airport Parking | Rewards & Loyalty Program</title>
    <meta name="description" content="Join Xpert Airport Parking's Rewards & Loyalty Program. Earn points every time you park and redeem for discounts and exclusive offers.">
@else
    @hasSection('title')
        <title>@yield('title')</title>
    @else
        <title>{{ $site_settings_main['site_title'] }}</title>
    @endif

    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @else
        <meta name="description" content="{{ $site_settings_main['meta_description'] }}">
    @endif
@endif

@hasSection('meta_keyword')
    <meta name="keywords" content="@yield('meta_keyword')">
@else
    <meta name="keywords" content="{{ $site_settings_main['meta_keyword'] }}">
@endif
<link rel="canonical" href="{{ str_replace('', '/', Request::fullUrl()) }}" />
<meta name="twitter:title" content="{!! $site_settings_main['site_twitter_title'] !!}">
<meta property="og:title" content="{!! $site_settings_main['site_og_title'] !!}">
<meta property="og:type" content="{!! $site_settings_main['site_og_type'] !!}">
<meta property="og:image" content="{!! $site_settings_main['site_og_image'] !!}">
<meta property="og:url" content="{!! $site_settings_main['site_og_url'] !!}">
<meta name="robots" content="index">
<meta name="author" content="{!! $site_settings_main['site_author'] !!}">
@if (isset($site_settings_main['site_header_analytics']))
    {!! $site_settings_main['site_header_analytics'] !!}
@endif
@if (isset($site_settings_main['site_schema']))
    {!! $site_settings_main['site_schema'] !!}
@endif
<style>
    



    .col-bt-cs {
        padding-top: 10px;
        text-align: right;
    }
</style>
<style>
    .homepagebanner{
        position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: cover; background-position: center; z-index: -1; transition: opacity 2s ease-in-out;
    }
    .subnav {
        float: left;
        overflow: hidden;
    }

    .subnav .subnavbtn {
        font-size: 20px;
        border: none;
        outline: none;
        color: #00519A;
        /*padding: 8px 4px;*/
        background-color: inherit;
        font-family: inherit;
        margin: 0;
        /*font-weight: 600;*/
        /*padding-left: 18px;*/
        display: inline-flex;
    }

    .navbar a:hover,
    .subnav:hover .subnavbtn {
        /*background-color: red;*/
        /*color:#00519A;*/
    }
 
    .subnav-content {
        display: none;
        position: absolute;
        left: -531px;
        background-color: #242d62;
        color: #00519A;
        width: 1500%;
        z-index: 1;
    }

    .subnav-content a {
        float: left;
        font-size: 20px;
        color: white;
        text-decoration: none;
        padding-right: 41px;
        font-weight: 600;
    }

    .ul-cs {
        padding-top: 18px;
        padding-bottom: 16px;
        justify-content: center;
        display: flex;
        list-style-type: none;
        /* margin-left: -517px; */
    }

    .subnav-content a:hover {
        /*background-color: #eee;*/
        /*color: black;*/
    }

    .subnav:hover .subnav-content {
        display: block;
    }

    @media only screen and (max-width: 1199px) {
        .destop-view {
            display: none;
        }
    }

    @media only screen and (min-width: 1200px) {
        .mobile-view {
            display: none;
        }

        .dropdown-toggle::after {
            display: none;
        }
    }

    @media only screen and (max-width: 1199px) {
        #header button.navbar-toggler {
            display: block !important;
            padding: 5px !important;
        }
    }

    @media only screen and (max-width: 1199px) {
        .navbar-expand-lg .navbar-nav {
            flex-direction: column;
        }

        .navbar-expand-lg {
            flex-wrap: inherit;
        }

        .navbar-expand-lg .navbar-collapse {
            flex-basis: 100%;
        }

        .collapse:not(.show) {
            display: none !important;
        }

        .navbar-expand-lg .navbar-nav .dropdown-menu {
            position: relative;
        }
    }

    @media only screen and (min-width: 1200px) {
        .navbar-expand-lg .navbar-collapse {
            display: flex !important;
            flex-basis: auto;
        }
    }

    .icon-down {
        position: relative;
        top: 11px;
    }

    .nav-item .active:hover {
        color: #c72037;
    }
</style>

<style>
    .footer-links li:before {

        content: "" !important;

        font-family: 'FontAwesome';

        padding-right: 0px !important;

        color: #ccc;

    }



    footer .round-btn a {

        padding: 4px 11px !important;

    }

    .footer-img-cs {
        height: 106px;
    }

    .end-img {
        padding-top: 91px;
    }

    .row-css-fo {
        width: 100%;
    }

    @media screen and (max-width: 911px) {
        .ul-css-fo {
            display: inline-flex;
        }
    }
</style>

<script>
  const loadFontCss = () => {
    if (window.fontCssLoaded) return;
    window.fontCssLoaded = true;

    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = '{{ Vite::asset("resources/css/font-awesome.css") }}';
    document.head.appendChild(link);
  };

  ['scroll', 'keydown', 'mousemove', 'touchstart'].forEach(event => {
    window.addEventListener(event, loadFontCss, { once: true });
  });
</script>