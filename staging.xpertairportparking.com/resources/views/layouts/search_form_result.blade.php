@if(request()->get('porc'))

<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';
DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, request()->get('utm_source')]);
}

?>

@endif
@if(request()->get('src') != '')

{{ session()->put('bk_src', request()->get('src') )}}

<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';
DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, request()->get('src')]);
}

?>

@endif

@if(request()->get('utm_source') == 'paidgoogleppc')

{{ session()->put('bk_src', 'PPC' )}}

<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'PPC']);
}

?>

@endif

@if(request()->get('utm_source') == 'Google PPC')

{{ session()->put('bk_src', 'PPC' )}}

<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'PPC']);
}
?>
@endif

@if(request()->get('utm_source') == 'ppc')

{{ session()->put('bk_src', 'PPC' )}}
<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'PPC']);
}

?>

@endif

@if(request()->get('utm_source') == 'Bing PPC')

{{ session()->put('bk_src', 'BING' )}}

<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'BING']);
}

?>
@endif

@if(request()->get('utm_source') == 'bing')

{{ session()->put('bk_src', 'BING' )}}

<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'BING']);
}

?>

@endif

@if(request()->get('utm_source') == 'social')

{{ session()->put('bk_src', 'FB' )}}

<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'FB']);
}

?>

@endif

@if(request()->get('porc') != '')

{{ session()->put('bk_src', 'POR' )}}

<?php

$ipaddress = '';

if (getenv('HTTP_CLIENT_IP'))

    $ipaddress = getenv('HTTP_CLIENT_IP');

else if (getenv('HTTP_X_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

else if (getenv('HTTP_X_FORWARDED'))

    $ipaddress = getenv('HTTP_X_FORWARDED');

else if (getenv('HTTP_FORWARDED_FOR'))

    $ipaddress = getenv('HTTP_FORWARDED_FOR');

else if (getenv('HTTP_FORWARDED'))

    $ipaddress = getenv('HTTP_FORWARDED');

else if (getenv('REMOTE_ADDR'))

    $ipaddress = getenv('REMOTE_ADDR');

else

    $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '" . $ipaddress . "' and active = 'Yes'");

if ($present) {
} else {

    DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'POR']);
}

?>

@endif



@php

$company = DB::table('companies')->where('id', '117')->first();



@endphp

<style>
    .h3banner {

        color: white;

        font-size: 36px;

        font-weight: 700;

        line-height: 1.3;

        text-align: center;

    }

    .form.bg {

        background-color: white;

    }

    @media screen and (max-width: 600px) {

        #div-hidden {

            visibility: hidden;
            clear: both;
            float: left;
            margin: 10px auto 5px 20px;
            width: 28%;
            display: none;

        }

        .h3banner {
            font-size: 2rem !important;
        }
    }

    @media screen and (min-width: 600px) {

        #title_message {

            visibility: hidden;
            clear: both;
            float: left;
            margin: 10px auto 5px 20px;
            width: 28%;
            display: none;

        }

    }

    .checked {

        color: #F79F02 !important;

        font-size: 18px;
    }

    .form-floating>.form-select {
        border-radius: 0;
    }

    @media screen and (min-device-width: 1168px) and (max-device-width: 1199px) {

        .mnt {
            max-width: 207px;
        }
    }

    @media screen and (min-device-width: 531px) and (max-device-width: 536px) {

        .mnt {
            max-width: 207px;
        }
    }

    @media screen and (min-device-width: 334px) and (max-device-width: 531px) {

        div.cal {
            width: 235px;
        }
    }

    .form-h2 {

        text-align: center;

        color: white;

        font-weight: bold;

        font-size: 30px;

        margin-bottom: 40px;

    }

    .form-control {
        height: 60px;
        background: none !important;
    }

    .form-select {
        height: 60px;
        background: none !important;
    }



    .p-css {
        color: black;
        margin-top: 2px;
        background-color: rgb(255, 255, 255, 60%);
        border-radius: 15px;
        padding: 15px;
        padding-bottom: 25px;
    }

    @media screen and (min-width:1323px) {

        .p-css {
            width: 577px;
            height: 279px;
        }

    }

    @media screen and (min-device-width: 1203px) and (max-device-width: 1322px) {

        .p-css {
            width: 482px;
            height: 285px;
        }

    }

    @media screen and (min-width:992px) {

        #banner {
            height: 100%;
        }

    }

    @media screen and (min-width:601px) {

        .padding {
            padding-left: 80px;
            padding-right: 80px;
        }

    }

    .btn-h {
        border-radius: 12px !important;
        height: 58px !important;
    }

    @media screen and (max-width:284px) {

        .btn-h {
            height: 66px !important;
        }

    }

    .form-control::-webkit-input-placeholder {

        color: black;

    }

    @media only screen and (min-width: 1527px) {

        .row-lr-p {
            margin-left: -100px;
            margin-right: -100px;
        }

    }

    .form-floating {
        position: relative;
    }

    .form-floating>.form-control {
        height: 3.625rem;
        line-height: 1.25;
    }
    .banner-location-single-contents-subtitle {

        display: block;

        font-size: 15px;

        font-weight: 500;

        line-height: 22px;

        margin: -4px 0 10px;

        color: black;

    }

    @media only screen and (min-width: 992px) {

        .search_item {
            width: 16%;
            padding-left: 0;
            padding-right: 0;
        }

    }
    .promo-css {
        border-top-right-radius: 12px !important;
        border-bottom-right-radius: 12px !important;
    }

    @media only screen and (max-width: 991px) {

        input,
        select {
            border-radius: 12px !important;
        }

    }

    #bg-css {
        height: 350px;
    }

    .icon-cs {

        color: #fff;

        position: relative;

        top: -59px;

        margin-right: 10px;

        font-size: 24px;

        float: right;

    }

    .icon-cs1 {

        color: #242d62;

        position: relative;

        top: -42px;

        margin-right: 10px;

        font-size: 24px;

        float: right;

    }
    select {

        font-size: 18px !important;

    }

    input::placeholder {

        color: #fff !important;

    }

    @media screen and (min-device-width: 1200px) and (max-device-width: 1399px) {

        .icon-cs {

            color: #242d62;

            position: absolute;

            margin-top: -60px;

            margin-left: 44px;

            font-size: 24px;

        }

        .icon-cs1 {

            color: #242d62;

            position: absolute;

            margin-top: -43px;

            margin-left: 44px;

            font-size: 24px;

        }

    }

    @media screen and (min-device-width: 992px) and (max-device-width: 1199px) {

        .from-css {

            padding-left: 0px;

            padding-right: 0px;

        }


        .icon-cs {
            top: -60px;
        }

        .icon-cs1 {
            top: -43px;
        }

    }

    @media only screen and (max-width: 992px) {

        #bg-css {
            height: 100%;
        }

    }

    @media screen and (min-device-width: 768px) and (max-device-width: 991px) {

        .icon-cs {
            margin-left: 268px;
        }

        .icon-cs1 {
            margin-left: 268px;
        }

    }

    @media screen and (min-device-width: 601px) and (max-device-width: 767px) {

        .icon-cs {
            margin-left: 178px;
        }

        .icon-cs1 {
            margin-left: 178px;
        }

    }

    @media screen and (min-device-width: 527px) and (max-device-width: 600px) {

        .icon-cs {
            margin-left: 159px;
        }

        .icon-cs1 {
            margin-left: 159px;
        }

    }

    @media only screen and (max-width: 526px) {

        .icon-cs {
            margin-left: 0px;
        }

        .icon-cs1 {
            margin-left: 0px;
        }

    }

    label {
        float: left !important;
    }

    .input-hold.date:before,
    .input-hold.person:before {

        font-family: 'FontAwesome' !important;

        text-align: center;

        color: #fff;

        -webkit-font-smoothing: antialiased;

        padding-top: 7px;

        position: relative;

        top: 43px;

        pointer-events: none;

        border-radius: 0 6px 6px 0;

        z-index: 1;

        float: right;

        font-size: 24px;

        margin-right: 9px;

    }

    .input-hold.date:before {
        content: "\f073";
    }

    .input-hold.time:before,
    .input-hold.person:before {

        font-family: 'FontAwesome' !important;

        text-align: center;

        color: #fff;

        -webkit-font-smoothing: antialiased;

        padding-top: 7px;

        position: relative;

        top: 43px;

        pointer-events: none;

        border-radius: 0 6px 6px 0;

        z-index: 1;

        float: right;

        font-size: 24px;

        margin-right: 9px;

    }

    .input-hold.time:before {
        content: "\f017";
    }

    .mtop {
        margin-top: 29px;
    }

    @media only screen and (max-width: 1199px) {

        .col-cs2 {
            width: 100%;
        }

    }

    .promo-code-css {
        padding-bottom: 6px;
        margin-top: -6px;
    }


    .promo-css {
        font-size: 16px !important
    }

    input::placeholder {
        font-size: 20px !important;
    }

    @media screen and (min-device-width: 1200px) and (max-device-width: 1399px) {
        .promo-css {
            width: 118%;
        }

        .icon-cs {
            margin-right: -18px;
        }

        .btn-h {
            margin-left: 20px;
        }
    }
    .btn-h {
        background: #0c5adb;
        color: #fff;
    }

    .btn-h:hover {
        background: #0c5adb;
        color: #fff;
    }
    .fields-styling{
        font-size: 17px;
        color: #7A7979;
        border: 1px solid #c6c2c2;
        background: #fff !important;
        border-radius: 5px;
        height: 50px;
    }
    @media only screen and (min-width: 1200px) {
            .modal-dialog {max-width: 40% !important;}
    }
    @media only screen and (max-width: 1199px) {
            .modal-dialog {max-width: 55% !important;}
    }
    @media only screen and (max-width: 991px) {
            .modal-dialog {max-width: 81% !important;}
            .mtop{margin-top: 0;}
    }
    @media only screen and (max-width: 600px) {
            .modal-dialog {max-width: 100% !important;}
    }
</style>

<section>

    <div class="container">

        <div class="row">



            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <div class="row " id="">

                                <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                    <form class="row from-css justify-content-center" style="" method="get" action="{{ route('searchresult') }}" id="search_form_1">

                                        <div class="col-lg-6 col-cs">

                                            <div class="mb-3">

                                                <label for="floatingInput">Drop off Date </label>

                                                <div class="input-hold date">

                                                    <input value="{{ request()->dropdate }}" type="text" class="text-field dpd1 form-control fields-styling" id="startDate" name="dropdate" required placeholder="DD/MM/YYYY" readonly>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="mb-3">

                                            @php
								$dropdown_timer = [];

								for ($i = 0; $i <= 23; $i++) { // Loop from 00 to 23
									for ($j = 0; $j <= 45; $j += 15) { // 15-minute intervals
										if ($i == 0 && $j == 0) continue; // Skip 00:00, start from 00:15
										$time = str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT);
										$dropdown_timer[$time] = $time;
									}
								}
								@endphp
                                                    <label for="floatingInput">

                                                    Drop off Time

                                                    </label>

                                                    <div class="input-hold time">

                                                        <select name="droptime" required class="form-select fields-styling">

                                                            @php

                                                            foreach ($dropdown_timer as $key => $value) {

                                                            $selected ='';

                                                            if($value == request()->droptime){

                                                            $selected ='selected';

                                                            }

                                                            @endphp

                                                            <option {{$selected}} value="{{ $value }}">{{ $value }}</option>

                                                            @php

                                                            }

                                                            @endphp

                                                        </select>

                                                        <!--<i class="fa-regular fa-clock icon-cs1"></i>-->

                                                    </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="mb-3">

                                                <label for="floatingInput">

                                                    PickUp Date

                                                </label>

                                                <div class="input-hold date">

                                                    <input type="text" value="{{ request()->pickdate }}" value="{{ request()->get('promo') }}" class="text-field dpd2 form-control fields-styling" readonly id="endDate" name="pickdate" autocomplete="off" required placeholder="DD/MM/YYYY">
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="mb-3">

                                                <label for="floatingInput">

                                                    PickUp Time

                                                </label>

                                                <div class="input-hold time">

                                                    <select name="picktime" required class="form-select fields-styling">

                                                        @php

                                                        foreach ($dropdown_timer as $key => $value) {

                                                        $selected ='';

                                                        if($value == request()->picktime){

                                                        $selected ='selected';

                                                        }

                                                        @endphp

                                                        <option {{$selected}} value="{{ $value }}">{{ $value }}</option>

                                                        @php

                                                        }

                                                        @endphp

                                                    </select>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-lg-6">

                                            <div class="mb-3">

                                                <label for="floatingInput" class="promo-code-css">

                                                    Promo Code

                                                </label>


                                                <input type="text" class="form-control fields-styling mb-0" placeholder="Optional" name="promo" value="{{ request()->get('promo') }}">

                                                <!--</div>-->

                                                <i class="fa-solid fa-percent icon-cs"></i>



                                            </div>

                                        </div>



                                        <div class="col-lg-6 mtop btn-css-mtop">
                                            <input type="hidden" name="parking_type" value="{{  $company->parking_type }}">

                                            <input type="hidden" name="parking_name" value="">

                                            <input type="hidden" name="aphactive" value="{{ @$company->aphactive }}">

                                            <input type="hidden" name="bookingfor" value="airport_parking">

                                            <input type="hidden" name="pl_id" value="{{ @$company->pl_id }}">

                                            <input type="hidden" name="sku" value="">

                                            <input type="hidden" name="site_codename" value="">

                                            <input type="hidden" name="speed_park_active" value="">

                                            <input type="hidden" name="edin_active" value="">

                                            <input type="hidden" name="edin_search" value="">

                                            <input type="hidden" name="comp_img" value='{{ asset("storage/app/".$company->logo)  }}'>

                                            <input type="hidden" name="submitted" value="airport_parking">

                                            <div class="form-group">
                                                <button type="submit" class="btn result-page-search-button">Find Parking</button>
                                            </div>

                                        </div>

                                        <input type="hidden" name="airport" value="1">
                                    </div>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>

</section>