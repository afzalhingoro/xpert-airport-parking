<!DOCTYPE HTML>
<html>

<head>
    <!-- Google tag (gtag.js) -->
    
    <link rel="alternate" href="https://airportdealsparking.co.uk/" hreflang="en-gb" />
    @include('layouts.header')
    <title>@yield('title') | Manchester Airport Spaces</title>
    @section('page_style')
    @show
</head>
<style>
    .star-rating-1 {
        font-size: 14px;
        padding-top: 0px;
    }

    .star-rating-1 i:hover {
        cursor: pointer;
        color: #FAB03F;
    }

    .star-rating-1 i.fill-color-rate {
        color: #242d62;
    }

    .fill-color-rate {
        color: #FAB03F;
    }

    .review-star-1 {
        color: #242d62;
    }

    .all-review-h2 {
        color: #242d62;
        font-size: 17px;
        font-weight: 600;
        margin-bottom: 0px;
    }

    .col-bt-cs-reviews {
        padding-top: 6px;
        text-align: right;
    }

    .star-size {
        font-size: 16px;
    }

    .modal-dialog-reviews {
        max-width: 500px !important;
    }

    .alert.alert-success {
        border-radius: 0;
        margin-top: 10px;
        position: absolute;
        width: 100%;
        left: 0;
        z-index: 1;
    }

    .top-bar-section a {
        color: white !important;
    }

    .bg-white.btn.create-ticket-btn.dtbtn.py-1.text-black {
        color: black !important;
        background-color: white !important;
        border: 1px solid white !important;
        margin-right: 10px;
    }

    button.btn.dtbtn.loyalty-reward-btn.py-1.text-black.bg-white {
        color: #ffffff !important;
        background-color: black !important;
        border: 1px solid black !important;
        margin-right: 10px;
        height: 38px;
        margin-top: -1px;
    }

    .top_button_cont button b {
        color: white !important;
        font-weight: 500;
    }

    .btn.dtbtn.loyalty-reward-btn.py-1.text-black.bg-white {
        border: 1px solid white;
    }

    .bg-white.btn.create-ticket-btn.dtbtn.py-1.text-black b {
        color: black !important;
    }

    .topheader {
        display: flex;
        align-items: center;
    }

    @media(max-width: 1200px) {
        .topheader {
            justify-content: center;
        }
    }

    .row-searchresult {
		padding: 0 !important;
		margin-top: 20px;	
		margin-bottom: 20px;	
	}

    #header .nav-link {
        font-weight: 600;
    }
</style>

<body>
    @php

        $site_settings_main = [];

        $settingsAll = App\Models\settings::all();

        foreach ($settingsAll as $setting) {
            $site_settings_main[$setting->field_name] = $setting->field_value;
        }
        $totalReviews = App\Models\reviews::where('status', 'Yes')->count();
        $rating_1 = App\Models\reviews::where('status', 'Yes')->avg('rating');
    @endphp

    <!--Site Body Analytics-->


    @if (isset($site_settings_main['site_body_analytics']))
        {!! $site_settings_main['site_body_analytics'] !!}
    @endif


    <!--End Site Body Analytics-->


    <!--loader-->
    <div class="loader-wrap">
        <div class="loader-inner">
            <div class="loader-inner-cirle"></div>
        </div>
    </div>
    
        @include('layouts.nav')
        <div id="wrapper">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>
    <script src="{{ url('js/ajaxform.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(".star-rating-1 i").hover(function() {
                $(this).prevAll().addBack().addClass("fill-color-rate");
                $(this).nextAll().removeClass("fill-color-rate");
            });

            let selectedRating = 0;

            $(".star-rating-1 i").click(function() {
                selectedRating = $(this).data('rating');

                $('#rate_us').modal('show');
            });

            $('#rate_us').on('shown.bs.modal', function() {
                $('#font-modal-star-rating_rate i').each(function(index) {

                    if (index < selectedRating) {
                        $(this).addClass('fill-color-rate');
                    } else {
                        $(this).removeClass('fill-color-rate');
                    }
                    $('#star_count_rate').val(selectedRating)
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#alert_main").delay(3000).slideUp(300);
        });
    </script>
    @section('page_js')
    @show

</body>

</html>
