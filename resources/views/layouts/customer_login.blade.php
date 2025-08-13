@extends('layouts.main')
<title>Admin | Xpert Airport Parking</title>

<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" />
@section('content')
    <style>
        .header.darkblue {
            text-align: center;
            color: #714a97;
            font-size: 25px;
            font-weight: 600;
            padding-top: 10px;
            padding-bottom: 35px;
        }
        .navbar .navbar-nav > li.open > a, .navbar .navbar-nav > li > a:focus, .navbar .navbar-nav > li > a:hover{
            background-color: rgb(255 255 255) !important;
        color: #c72037 !important;
        }

        .icon-css {
            z-index: 2;
            position: absolute;
            top: 9px;
            bottom: 1px;
            right: 10px;
            line-height: 30px !important;
            display: inline-block;
            color: #714a97;
            font-size: 23px !important;
            float: right;
        }

        .login-container {
            width: 664px !important;
        }

        .login-layout .widget-box {
            background-color: #714a97 !important;
            border-radius: 40px;
        }

        .login-layout .login-box .widget-main {
            border-radius: 40px;
        }

        .widget-body {
            border-radius: 40px;
        }

        .btn-primary2 {
           
            border-radius: 15px !important;
            color: #fff !important;
        }

        .input-icon.input-icon-right>input {
            border-radius: 12px !important;
        }

        .nav-link {
            color: #714a97 !important;
            font-size: 18px !important;
            margin-left: 15px;
        }

        .navbar .navbar-nav>li>a {
            padding-top: 6px !important;
        }

        .navbar .navbar-nav>li {
            border: 0px solid rgba(0, 0, 0, 0.2) !important;
        }

        .navbar {
            background: none !important;
        }

        input[type="text"] {
            font-size: 1rem !important;
        }

        .input-icon.input-icon-right>input {
            height: 50px;
        }

        .login-layout .main-content {
            min-height: auto !important;
            margin-bottom: 30px;
            margin-top: 30px;
        }

        @media only screen and (max-width: 767px) {
            .login-container {
                width: 98% !important;
            }
            .alert-mes{width: 100% !important;}
        }

        .navbar-nav .dropdown-menu {
            position: static !important;
            background-color: #c72037 !important;
        }
        .alert-mes{
            margin-top: 10px !important;
            position: relative !important;
            
            left: 0 !important;
            z-index: 1 !important;
            border-radius: 16px !important;
            text-align: center;
            padding: 9px;
        }
         @media only screen and (min-width: 767px) {
            .alert-mes{width: 50% !important;}
        }
    </style>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-12 col-sm-offset-1">
                        <div class="login-container">
                            <div class="center">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                
                            </div>
                            <div class="space-6" ></div>
                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header darkblue lighter bigger">
                                                <!--<i class="ace-icon fa fa-coffee green"></i>-->
                                                <!--<i class="ace-icon fa fa-regular fa-right-to-bracket"></i>-->
                                                LogIn
                                            </h4>
                                            <div class="space-6" style="margin-bottom: 30px;"></div>
                                            <form method="POST" action="{{ route('post_login') }}" aria-label="">
                                                @csrf
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="email" class="form-control" name="email"
                                                                placeholder="Email Address" value="{{ old('email') }}"
                                                                required />
                                                            <i class="fa fa-user icon-css"></i>
                                                            <!--<i class="ace-icon fa fa-user icon-css"></i>-->
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong> </strong>
                                                            </span>
                                                            @if ($errors->has('email'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input id="password" type="password" class="form-control"
                                                                name="password" value="{{ old('password') }}" required
                                                                placeholder="Password">
                                                            <i class="fa fa-solid fa-lock icon-css"></i>
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong> </strong>
                                                            </span>
                                                            @if ($errors->has('password'))
                                                                <span
                                                                    class="text-danger">{{ $errors->first('password') }}</span>
                                                            @endif
                                                        </span>
                                                        <div class="align-items-center d-flex justify-content-between">
                                                            <label class="align-items-center d-flex justify-content-start">
                                                                <input class="form-check-input me-1 m-0" type="checkbox" name="remember"
                                                                    id="remember">
                                                                <span class="lbl"> Remember Me</span>
                                                            </label>
                                                        
                                                            <label class="inline">
                                                                <a href="{{ url('forget-customer-pasword') }}"> Forgot Your
                                                                    Password?</a>
                                                                <!--<input class="form-check-input pull-right" type="checkbox" name="customer_remember" id="customer_remember">-->
                                                                <!--<span class="lbl"> </span>-->
                                                            </label>
                                                        </div>
                                                    </label>
                                                    <div class="text-center" style="justify-content: center;display: flex;">
                                                    @if (session('passsuccessreset'))
                                                        <div class="alert alert-mes alert-success">
                                                            {{ session('passsuccessreset') }}
                                                        </div>
                                                    @endif
                                                    </div>
                                                    <div class="space"></div>
                                                    <div class="clearfix">
                                                        <div style="text-align: center;">
                                                            <!--<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">-->
                                                            <button type="submit" class="width-35 btn btn-sm  btn-primary2"
                                                                style="background-color: #714a97 !important;">
                                                                <i class="ace-icon fa fa-key"></i>
                                                                <span class="bigger-110">Login</span>
                                                            </button>
                                                        </div>
                                                        <!--<div style="text-align: center;">
                                                            <label class="inline">
                                                                <a href="{{ url('forget-customer-pasword') }}"> Forgot Your
                                                                    Password?</a>
                                                                <input class="form-check-input pull-right" type="checkbox" name="customer_remember" id="customer_remember">-->
                                                                <!--<span class="lbl"> </span>
                                                            </label>
                                                        </div>-->
                                                        <div style="text-align: center;">
                                                            <label class="inline mt-2">
                                                                <a href="{{ url('c-register') }}">Don't have an account? 
                                                                    Register</a>
                                                                <!--<input class="form-check-input pull-right" type="checkbox" name="customer_remember" id="customer_remember">-->
                                                                <!--<span class="lbl"> </span>-->
                                                            </label>
                                                        </div>

                                                    </div>

                                                    <div class="space-4"></div>
                                                </fieldset>
                                            </form>



                                        </div><!-- /.widget-main -->


                                    </div><!-- /.widget-body -->
                                </div><!-- /.login-box -->


                            </div><!-- /.position-relative -->

                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.main-content -->
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>

        <!-- <![endif]-->

        <!--[if IE]>
                    <script src="assets/js/jquery-1.11.3.revolution.extension.navigation.min.js"></script>
                    <![endif]-->
        <script type="text/javascript">
            if ('ontouchstart' in document.documentElement) document.write(
                "<script src='assets/js/jquery.mobile.custom.revolution.extension.navigation.min.js'>" + "<" + "/script>");
        </script>

        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {
                $(document).on('click', '.toolbar a[data-target]', function(e) {
                    e.preventDefault();
                    var target = $(this).data('target');
                    $('.widget-box.visible').removeClass('visible'); //hide others
                    $(target).addClass('visible'); //show target
                });
            });



            //you don't need this, just used for changing background
            jQuery(function($) {
                $('#btn-login-dark').on('click', function(e) {
                    $('body').attr('class', 'login-layout');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-light').on('click', function(e) {
                    $('body').attr('class', 'login-layout light-login');
                    $('#id-text2').attr('class', 'grey');
                    $('#id-company-text').attr('class', 'blue');

                    e.preventDefault();
                });
                $('#btn-login-blur').on('click', function(e) {
                    $('body').attr('class', 'login-layout blur-login');
                    $('#id-text2').attr('class', 'white');
                    $('#id-company-text').attr('class', 'light-blue');

                    e.preventDefault();
                });

            });
        </script>
    </body>

    </html>
@endsection
