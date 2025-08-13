<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YTNQ04E3PX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-YTNQ04E3PX');
    </script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Dashboard | Manchester Airport Spaces</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('/theme-new/img/Logo-For-Favicon-v1.png') }}">
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <meta name="title" content="Airport Parking">
    <meta name="keywords"
        content="airport parking, airport car parking, parking airport, cheap airport parking, airport, parking, car, park">
    <meta
        content="The UK most popular choice for Airport Parking, Airport Deals Parking give you the best deals at Heathrow airport."
        name="description">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/css/admin.bootstrap.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet"
        id="main-ace-style" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />
    <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>
    <!-- <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script> -->



    <style>
        .nav-list>li.administrators_link {
            display: none;
        }
    </style>

    @php
        $role = auth::user()
            ->with('roles', 'roles.role')
            ->where('id', auth::id())
            ->first();
        if ($role->roles->role->name == 'Marketing') {
            echo '<style> .manage_discount, .reports, .dashboard_link , .administrators_link , .green.dropdown-modal, a#excel {display:none !important;} </style>';
        }

        if ($role->roles->role->name == 'SuperAdmin') {
            echo '<style> .administrators_link {display:block !important;} </style>';
        }
    @endphp
    <style type="text/css">
        .btn-group-sm>.btn,
        .btn-sm {
            padding: 2px 9px;
        }

        .table>thead>tr>th:last-child {
            border-right: 1px solid #ddd;
        }

        .table>thead>tr {
            color: #393939;
        }

        input[type=email],
        input[type=url],
        input[type=search],
        input[type=tel],
        input[type=color],
        input[type=text],
        input[type=password],
        input[type=datetime],
        input[type=datetime-local],
        input[type=date],
        input[type=month],
        input[type=time],
        input[type=week],
        input[type=number],
        textarea {
            font-size: 13px;
        }

        .form-group {
            margin-top: 5px;
        }
    </style>
    <style>
        .loader {
            margin-top: 200px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 2s linear infinite;
            /* Safari */
            animation: spin 2s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    @section('stylesheets')
    @show
</head>
<div class="loading" id="loader_ajax" style="display: none;">Loading&#8230;</div>
