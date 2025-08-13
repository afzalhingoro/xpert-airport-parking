@extends('layouts.main')

    <title>Admin | Airport Deals Parking</title>



    <link rel="stylesheet" href="{{ asset("assets/css/ace.min.css") }}" />

@section('content')

<style>

    .header.darkblue{text-align:center;color:#00519A;font-size: 25px;font-weight: 600;}

    .icon-css{z-index: 2;position: relative;top: -55px;bottom: 1px;right: 10px;line-height: 30px !important;display: inline-block;color: #00519A;font-size: 23px !important;float: right;}

    .login-layout{background-color: #E4E6E9 !important;}

    .login-container{width: 664px !important;}

    .login-layout .widget-box{background-color: #00519A !important;border-radius: 40px;}

    .login-layout .login-box .widget-main{border-radius: 40px;}

    .widget-body{border-radius: 40px;}

    .btn-primary2{border-color: #FAB03F !important;border-radius: 15px !important;color: #00519A !important;}

    .input-icon.input-icon-right > input{border-radius: 12px !important;}

    .nav-link{    color: #00519A !important;font-size: 20px !important;margin-left: 15px;}

    .navbar .navbar-nav > li > a{padding-top: 6px !important;}

    .navbar .navbar-nav > li{border: 0px solid rgba(0, 0, 0, 0.2) !important;}

    .navbar{background: none !important;}

    input[type="text"]{font-size: 1rem !important;}

    .input-icon.input-icon-right > input{height: 50px;}

    .login-layout .main-content{min-height: auto !important;margin-bottom: 30px;margin-top: 30px;}

    

    @media only screen and (max-width: 767px){ 

        .login-container {width: 98% !important;}

        }

    .navbar-nav .dropdown-menu{position: static !important;background-color: #FAB03F !important;}

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

                                        Change Password 

                                    </h4>

                                    <div class="space-6"></div>

                                    <form method="POST" action="" aria-label="">

                                        @csrf

                                        <fieldset>

                                            <label class="block clearfix">
												<span class="block input-icon input-icon-right">
													<input type="password" class="form-control" name="password" placeholder="Enter New password" required/>
													<i class="fa fa-solid fa-lock icon-css"></i>
												</span>

                                            </label>



                                            <label class="block clearfix">

												<span class="block input-icon input-icon-right">

													<input id="confirm_password" type="password" class="form-control" name="confirm_password" required placeholder="Confirm password">

                                                    <i class="fa fa-solid fa-lock icon-css"></i>


												</span>

                                            </label>

                                            <div class="clearfix">

                                                <div style="text-align: center;">

                                                <!--<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">-->

                                                <button type="submit" class="width-35 btn btn-sm  btn-primary2" style="background-color: #FAB03F !important;">

                                                    <i class="ace-icon fa fa-key"></i>

                                                    <span class="bigger-110">Change Password</span>

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

