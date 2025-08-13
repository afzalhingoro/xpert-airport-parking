@extends('layouts.main')
<title>Admin | Airport Deals Parking</title>

<link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" />
@section('content')
    <style>
        .header.darkblue {
            text-align: center;
            color: #00519A;
            font-size: 25px;
            font-weight: 600;
        }

        .icon-css {
            z-index: 2;
            position: relative;
            top: -55px;
            bottom: 1px;
            right: 10px;
            line-height: 30px !important;
            display: inline-block;
            color: #00519A;
            font-size: 23px !important;
            float: right;
        }
        .navbar .navbar-nav > li.open > a, .navbar .navbar-nav > li > a:focus, .navbar .navbar-nav > li > a:hover{
            background-color: rgb(255 255 255) !important;
        color: #c72037 !important;
        }
        .login-container {
            width: 664px !important;
        }

        .login-layout .widget-box {
            background-color: #00519A !important;
            border-radius: 40px;
        }

        .login-layout .login-box .widget-main {
            border-radius: 40px;
        }

        .widget-body {
            border-radius: 40px;
        }

        .btn-primary2 {
            border-color: #c72037 !important;
            border-radius: 15px !important;
            color: #fff !important
        }

        .input-icon.input-icon-right>input {
            border-radius: 12px !important;
        }

        .nav-link {
            color: #00519A !important;
            font-size: 20px !important;
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
        }

        .navbar-nav .dropdown-menu {
            position: static !important;
            background-color: #c72037 !important;
        }

        .width-35 {
            width: 50% !important;
            padding-top: 10px !important;
            padding-bottom: 10px !important;
        }
        .alert-mes{
           border-radius: 0 !important;
            margin-top: 10px !important;
            position: relative !important;
            width: 100% !important;
            left: 0 !important;
            z-index: 1 !important;
            border-radius: 16px !important;
        }
        .alert-div-marg{
            margin-bottom: 29px;
            margin-top: -32px;
        }
    </style>

    <body class="login-layout">
        <div class="main-container">
            <div class="main-content">
                <div class="row">
                    <div class="col-sm-12 col-sm-offset-1">
                        <div class="login-container">
                            
                            <div class="space-6"></div>
                            <div class="position-relative">
                                <div id="login-box" class="login-box visible widget-box no-border">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header darkblue lighter bigger">
                                                <!--<i class="ace-icon fa fa-coffee green"></i>-->
                                                <!--<i class="ace-icon fa fa-regular fa-right-to-bracket"></i>-->
                                                Reset Password
                                            </h4>
                                            <div class="space-6"></div>
                                            <form method="POST" action="{{ route('send.reset.link') }}" aria-label=""
                                                id="myForm">
                                                @csrf
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" name="email"
                                                                required placeholder="Enter Your Email Address" />
                                                            <i class="fa fa-solid fa-envelope icon-css"></i>
                                                        </span>
                                                    </label>
                                                    
                                                    <div class="center alert-div-marg">
                                                        @if ($errors->any())
                                                            <div class="alert-mes alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        @if (session('resetsuccess'))
                                                            <div class="alert-mes alert alert-success">
                                                                {{ session('resetsuccess') }}
                                                            </div>
                                                        @endif
                                                        @if (session('error'))
                                                            <div class="alert-mes alert alert-error">
                                                                {{ session('error') }}
                                                            </div>
                                                        @endif
                        
                        
                                                    </div>
                                                    
                                                    <div class="clearfix">
                                                        <div style="text-align: center;">
                                                            <!--<button type="submit" class="width-35 pull-right btn btn-sm btn-primary">-->
                                                            <button type="submit" class=" btn  btn-primary2"
                                                                id="submitButton" onclick="disableSubmitButton()"
                                                                style="background-color: #c72037 !important;">
                                                                <i class="ace-icon fa fa-key"></i>
                                                                <span class="bigger-110">Send Password Reset Link</span>
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

        <script src="assets/js/jquery-2.1.4.min.js"></script>

        <script>
            function disableSubmitButton() {
                // Disable the submit button
                document.getElementById('submitButton').disabled = true;
                // Allow the form to be submitted to its action
                document.getElementById('myForm').submit();
            }
        </script>
    </body>

    </html>
@endsection
