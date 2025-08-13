@extends('layouts.main')
    <title>Register Account | Xpert Airport Parking</title>
    <meta name="description" content="Create your Xpert Airport Parking account to enjoy quick bookings, manage reservations, and access exclusive offers for Stansted Airport parking." />

    <link rel="stylesheet" href="{{ asset("assets/css/ace.min.css") }}" />
@section('content')
<style>
    .header.darkblue{text-align:center;color:#714a97;font-size: 25px;font-weight: 600;}
    .icon-css{z-index: 2;position: relative;top: -55px;bottom: 1px;right: 10px;line-height: 30px !important;display: inline-block;color: #714a97;font-size: 23px !important;float: right;}
    .login-container{width: 664px !important;}
    .login-layout .widget-box{background-color: #714a97 !important;border-radius: 40px;}
    .login-layout .login-box .widget-main{border-radius: 40px;}
    .widget-body{border-radius: 40px;}
    .btn-primary2{border-color: #c72037 !important;border-radius: 15px !important;color: #fff !important;}
    .input-icon.input-icon-right > input{border-radius: 12px !important;}
    .nav-link{    color: #714a97 !important;font-size: 18px !important;margin-left: 15px;}
    .navbar .navbar-nav > li > a{padding-top: 6px !important;}
    .navbar .navbar-nav > li{border: 0px solid rgba(0, 0, 0, 0.2) !important;}
    .navbar{background: none !important;}
    input[type="text"]{font-size: 1rem !important;}
    .input-icon.input-icon-right > input{height: 50px;}
    .login-layout .main-content{min-height: auto !important;margin-bottom: 30px;margin-top: 30px;}
    .navbar .navbar-nav > li.open > a, .navbar .navbar-nav > li > a:focus, .navbar .navbar-nav > li > a:hover{
            background-color: rgb(255 255 255) !important;
        color: #c72037 !important;
        }
    @media only screen and (max-width: 767px){ 
        .login-container {width: 98% !important;}
        }
    .navbar-nav .dropdown-menu{position: static !important;background-color: #c72037 !important;}
    input{margin-bottom: 0px;}
    .clearfix::after{display: inline !important;}
</style>



<body class="login-layout">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <!--<a href="{{url('/')}}">-->
                            <!--    <img src="{{url('theme-new/img/Airport Deals Parking-parking-logo.webp')}}"></br>-->
                            <!--</a>-->
                        </h1>
                    </div>
                    <div class="space-6"></div>
                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header darkblue lighter bigger">
                                        <!--<i class="ace-icon fa fa-coffee green"></i>-->
                                        <!--<i class="ace-icon fa fa-regular fa-right-to-bracket"></i>-->
                                        Register
                                    </h4>
                                    <div class="space-6"></div>
                                    <form method="POST" action="{{route('post_register')}}" aria-label="">
                                        @csrf
                                        <fieldset>
                                            <label class="block clearfix">
                                                <label class="inline">
                                                    First Name
                                                </label>
												<span class="block input-icon input-icon-right">
													<input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" required/>
													<i class="fa fa-user icon-css"></i>
													<!--<i class="ace-icon fa fa-user icon-css"></i>-->
                                                        
												</span>
                                            </label>
                                            <label class="block clearfix">
                                                <label class="inline">
                                                    Last Name
                                                </label>
												<span class="block input-icon input-icon-right">
													<input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" required/>
													<i class="fa fa-user icon-css"></i>
													<!--<i class="ace-icon fa fa-user icon-css"></i>-->
                                                        
												</span>
                                            </label>
                                            <label class="block clearfix">
                                                <label class="inline">
                                                    Email
                                                </label>
												<span class="block input-icon input-icon-right">
													<input type="email" class="form-control" name="email" value="{{old('email')}}" required/>
													<!--<i class="fa fa-user icon-css"></i>-->
													<i class="fa fa-solid fa-envelope icon-css"></i>
                                                        
												</span>
												@if ($errors->has('email'))
                                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </label>
                                            <label class="block clearfix">
                                                <label class="inline">
                                                    Password
                                                </label>
												<span class="block input-icon input-icon-right">
													<input id="password" type="password" class="form-control" id="password" name="password" onChange="onChange()"  required>
                                                    <i class="fa fa-solid fa-lock icon-css"></i>    
												</span>
												@if ($errors->has('password'))
                                                      <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                            </label>
                                            <label class="block clearfix">
                                                <label class="inline">
                                                    Confirm Password
                                                </label>
												<span class="block input-icon input-icon-right">
													<input id="password" type="password" class="form-control" id="confirmpassword" name="confirm_password"  onChange="onChange()" required>
                                                    <i class="fa fa-solid fa-lock icon-css"></i>    
												</span>
												<div id="checkconfirm"></div>
                                            </label>
                                            <div class="space"></div>
                                            <div class="clearfix">
                                                <div style="text-align: center;">
                                                    <!--<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">-->
                                                    <button type="submit" class="width-35 btn btn-sm  btn-primary2" style="background-color: #c72037 !important;">
                                                        <!--<i class="ace-icon fa fa-key"></i>-->
                                                        <span class="bigger-110">Register</span>
                                                    </button>
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
<script>  
function onChange() {
  const password = document.querySelector('input[name=password]');
  const confirm = document.querySelector('input[name=confirm_password]');
  if (confirm.value === password.value) {
    confirm.setCustomValidity('');
  } else {
    confirm.setCustomValidity('Passwords do not match');
  }
}
</script> 
<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery-1.11.3.revolution.extension.navigation.min.js"></script>
<![endif]-->
<script type="text/javascript">
    if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.revolution.extension.navigation.min.js'>"+"<"+"/script>");
</script>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function($) {
        $(document).on('click', '.toolbar a[data-target]', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            $('.widget-box.visible').removeClass('visible');//hide others
            $(target).addClass('visible');//show target
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
