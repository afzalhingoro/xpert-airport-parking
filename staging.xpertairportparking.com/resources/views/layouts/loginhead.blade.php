<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Admin | Customer Login | Xpert Airport Parking</title>

	<link rel="shortcut icon" type="image/x-icon" href="{{url('theme/img/parkingdeals-FavIcon.png')}}">
    <meta name="description" content="Access your Xpert Airport Parking account to manage bookings, view past reservations, and update your details securely and easily." />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ URL::asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />

    <!-- text fonts -->
    <link rel="stylesheet" href="{{ asset("assets/css/fonts.googleapis.com.css") }}" />

    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset("assets/css/ace.min.css") }}" />

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset("assets/css/ace-part2.min.css") }} " />
    <![endif]-->
    <link rel="stylesheet" href="{{ asset("assets/css/ace-rtl.min.css") }}" />

</head>
<main class="py-4" style="    margin-top: 171px;">
    @yield('content')
</main>