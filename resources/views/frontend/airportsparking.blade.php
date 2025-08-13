@extends('layouts.main')
@section("title",$page->meta_title)
@section("meta_keyword",$page->meta_keyword )
@section("meta_description",$page->meta_description)
@section('content')

    <div class="home">
        
        <!-- Home Slider -->

        <div class="home_slider_container">
            
            <div class="owl-carousel owl-theme home_slider">

                <!-- Slider Item -->
                <div class="owl-item home_slider_item">
                    <!-- Image by https://unsplash.com/@anikindimitry -->
                    <div class="home_slider_background" style="background-image:url('{{url('theme/images/home_slider.jpg')}}"></div>

                    <div class="home_slider_content text-center">
                        <div class="home_slider_content_inner" data-animation-in="flipInX" data-animation-out="animate-out fadeOut">
                       
                            <h1></h1>
                        </div>
                    </div>
                </div>
                <!-- Slider Item -->
            </div>
            
            <!-- Home Slider Nav - Prev -->

            


            <!-- Home Slider Dots -->

         
            
        </div>

    </div>
    <style>
        .th_class {
            background: #ffcb05;
        }

        .inner-section {
            background-color: #eff2f3;
            padding: 5px 0;
        }

        .passenger-detail h3 {

            padding: 10px 20px;
            line-height: 1.6;
            background: linear-gradient(to right, rgba(14, 127, 28, 0.9) 0, rgba(39, 129, 238, 0.9));
            color: #fff;
            border-radius: 5px;
        }

        .panel {

            margin-bottom: 20px;
            /* background-color: #fff; */
            border: 0px solid transparent !important;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
        }

        .padding h2 {
            font-size: 22px;
            color: #1d9cbc;
            padding-left: 22px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin-bottom: 0;
        }

        #menu-tabs li {
            width: 100%;
            border: 1px solid #ccc;
        }

        .nav-tabs {
            border: 1px solid #ddd;
        }

        a:active {
            background: #ffcb05;
        }

        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {

            border: none !important;
            border-bottom-color: inherit !important;
            background: #16bbbb;

        }

        .bhoechie-tab-container {
            border: 1px solid #ccc;
            /* margin: -9px; */
            margin-top: 0px;
            margin-right: -9px;
            /* margin-bottom: -9px; */
            margin-left: -9px;
            padding: 0px;
        }

        .ap_page_content {
            padding-left: 19px;
        }

        .bhoechie-tab-menu {
            padding: 0px !important;
        }

        .inner-step i {
            border-radius: 50%;
            background: #ffcb05;
            color: #fff;
            padding: 23px;
            position: relative;
            display: inline-block;
            text-align: center;
        }

        .nrm-cont h3 {
            font-size: 22px;
            color: #1d9cbc;
            padding-left: 22px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin-bottom: 0;
        }

        .inner-step i path {
            fill: #fff;
        }

        .inner-step i svg {
            width: 60px;
            display: table-cell;
            vertical-align: middle;
            height: 60px;
        }

        .inner-step h5 {
            font-weight: 800;
            margin: 30px 0px 10px;
            text-transform: uppercase;
            color: #ffcb05;
            font-size: 34px;
        }

        .hxComment li {
            list-style-type: none;
        }

        .sb-serc {
            text-align: center;
            background: url(assets/images/banner16.jpg);
            border: 4px solid #fff;
            float: left;
            width: 100%;
            margin: 0px 0px 20px 0px;
            /*   min-height: 305px;
            max-height: 305px;*/
            overflow: hidden;
            padding-top: 15px;
            border-radius: 15px;

        }

        .sb-serc a {
            margin: 5px 0px;
            float: left;
            width: 100%;
            font-weight: bold;
            background: linear-gradient(to right, rgba(30, 133, 95, 0.9) 0, rgba(12, 113, 238, 0.9));
            /*color: #0e4060;*/
            color: #fff;
            margin-bottom: 20px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            border-radius: 3px;
        }

        .sb-serc p {
            font-size: 15px;
            line-height: 21px;
            overflow: hidden;
            padding: 0 10px;
            text-align: center;
            min-height: 283px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        .light-weight h3 {
            float: left;
            width: 100%;
            margin: 10px 0px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 5px;
        }

        .accordion-style1 {

            background: url(assets/images/banner16.jpg);
        }
 

        .col-right-norm h2, h3, h4, h5 {
            font-size: 22px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: 700;
        }

        .nrm-cont h3 {
            font-size: 22px;
            color: #1d9cbc;
            padding-left: 22px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin-bottom: 0;
            background: none;
        }

    </style>
    <div class="home-container home-background">

        @include("layouts.nav")


    </div><!-- end home-container -->



    @php
        $site_settings_main=[];
            $settingsAll = App\settings::all();
                    foreach ($settingsAll as $setting) {
                        $site_settings_main[$setting->field_name] = $setting->field_value;
                    }
    @endphp


    <section class="top-offer " style="margin-top: 73px;">


        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="row">
                        <div class="panel passenger-detail">
                            <h3 class="light-weight">{!! $site_settings_main["services_page_parking_heading"];  !!}
                            </h3>
                            <div class="well-body">


                                <div class="inr-cnt  col-xs-12 col-sm-12 col-md-9 col-lg-9" style="       width: 100%;
   
  
    margin-top: -8px;
    border-color: #386171;
        box-shadow: 0px 4px 8px 5px #dfd7d7;">
                                   <p> {!! $site_settings_main["services_page_parking_descp"];  !!}</p>

                                    <div class="nrm-cont  col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">


                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>


                <div class="hidden-xs hidden-sm col-xs-12 col-sm-12 col-md-4 col-lg-4">


                    <div class="sub-serc">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="tabbable">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="home4">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div id="accordion"
                                                         class="accordion-style1 panel-group passenger-detail">
                                                        <h3 class="text-center"
                                                        >ParkingZone Get
                                                            Discount</h3>
                                                        <div class="">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title maintab">
                                                                    <a class="accordion-toggle" href="#collapseOne"
                                                                       data-parent="#accordion" data-toggle="collapse">
                                                                        <i class="icon-angle-down bigger-110"
                                                                           data-icon-show="icon-angle-right"
                                                                           data-icon-hide="icon-angle-down"></i>
                                                                        Airport Parking
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                                <form method="POST" class="quote-form"
                                                                      action="{{ route("searchresult") }}"
                                                                      id="airportParkingForm12">
                                                                    @csrf
                                                                    <div class="panel-body">
                                                                        <div class="row">
                                                                            <div class="col-xs-12">
                                                                                <label class="title">Airport
                                                                                    <small> ( Select Your Airport )
                                                                                    </small>
                                                                                </label>
                                                                                <select required name="airport_id"
                                                                                        class="form-control">
                                                                                    <option value="" selected>Airport
                                                                                    </option>
                                                                                    @foreach($airports as $airport)
                                                                                        <option value="{{ $airport->id }}">{{ $airport->name }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        @php $date = date("Y-m-d"); @endphp
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <label class="title">Departure
                                                                                    Date</label>
                                                                                <input required
                                                                                       class="form-control right_dpd1"
                                                                                       id="dropdatepicker12"
                                                                                       autocomplete="off"
                                                                                       readonly
                                                                                       name="dropoffdate"
                                                                                       value="{{ $date }}"
                                                                                       placeholder="MM/DD/YY" value=""
                                                                                       style="background:white;">
                                                                            </div>

                                                                            <div class="col-xs-6">
                                                                                <label class="title">Time</label>
                                                                                @php
                                                                                    $dropdown_timer = [];
                                                                                   for ($i = 0; $i <= 23; $i++) {
                                                                                       for ($j = 0; $j <= 45; $j += 15) {
                                                                                           //$sel = str_pad($i, 2, "0", STR_PAD_LEFT).':'.str_pad($j, 2, "0", STR_PAD_LEFT) == $opening_time ? 'selected' : '';
                                                                                           //echo '<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT).':'.str_pad($j, 2, "0", STR_PAD_LEFT).'"'.$sel.'>'.str_pad($i, 2, "0", STR_PAD_LEFT).':'.str_pad($j, 2, "0", STR_PAD_LEFT).'</option>';
                                                                                           $dropdown_timer[str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT)] = str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT);
                                                                                       }
                                                                                   }
                                                                                @endphp
                                                                                {{ Form::select('dropoftime',$dropdown_timer,"",["class"=>"form-control","id"=>"dropoftime"]) }}


                                                                            </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <label class="title">Arrival
                                                                                    Date</label>
                                                                                <input required
                                                                                       class="form-control right_dpd2"
                                                                                       id="pickdatepicker12"
                                                                                       autocomplete="off"
                                                                                       readonly
                                                                                       name="departure_date"
                                                                                       <?php
                                                                                       $mydate = $date;
                                                                                       $daystosum = '2';
                                                                                       $datesum = date('Y-m-d', strtotime($mydate . ' + ' . $daystosum . ' days'));
                                                                                       ?>
                                                                                       value="{{ $datesum}}"
                                                                                       value="" placeholder="MM/DD/YY"
                                                                                       value=""
                                                                                       style="background: white;">
                                                                            </div>

                                                                            <div class="col-xs-6">
                                                                                <label class="title">Time</label>
                                                                                {{ Form::select('pickup_time',$dropdown_timer,"",["class"=>"form-control ","id"=>"pickup_time"]) }}


                                                                            </div>

                                                                        </div>
                                                                        <div class="row">
                                                                            <div class=" col-md-12">
                                                                                <label class="title"></label>

                                                                                <button class="btn btn butn_1 center-block btn-quote-ap"
                                                                                        style="color: #fff; font-size:20px;margin-bottom:10px; background:linear-gradient(to right,rgba(30, 126, 37, 0.9) 0,rgba(12, 66, 132, 0.9));"
                                                                                        type="submit" name="button"
                                                                                        value="Get a quote">GET A QUOTE
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!--<div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title maintab">
                                                                    <a class="accordion-toggle collapsed" href="#collapseTwo" data-parent="#accordion" data-toggle="collapse">
                                                                        <i class="icon-angle-right bigger-110" data-icon-show="icon-angle-right" data-icon-hide="icon-angle-down"></i>
                                                                        Airport Hotel
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseTwo" class="panel-collapse collapse">
                                                                <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. </div>
                                                            </div>
                                                        </div>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title maintab">
                                                                    <a class="accordion-toggle collapsed" href="#collapseThree" data-parent="#accordion" data-toggle="collapse">
                                                                    <i class="icon-angle-right bigger-110" data-icon-show="icon-angle-right" data-icon-hide="icon-angle-down"></i>
                                                                     Airport Hotel &  Parking
                                                                    </a>
                                                                </h4>
                                                            </div>
                                                            <div id="collapseThree" class="panel-collapse collapse">
                                                                <div class="panel-body"> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. </div>
                                                            </div>
                                                        </div>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

            </div>

        </div>


    </section>

    <section id="services" class="section-padding bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="page-heading">
                        <h2>{!! $site_settings_main["services_page_parking_sec1_heading"];  !!}</h2>
                        <p> {!! $site_settings_main["services_page_parking_sec1_descp"];  !!}</p>
                    </div><!-- end page-heading -->

                    <div class="row">
                        <div id="service-blocks">

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="service-block" style="min-height:309px !important;">
                                    <h4>Meet & Greet</h4>
                                    <img src="assets/images/meet.jpg" class="img-circle" style="width:80px;height:80px"
                                         alt="logo">
                                    <p>{!! $site_settings_main["services_page_parking_sec1_meetandgreet"];  !!}</p><br>
                                </div><!-- end service-block -->
                            </div><!-- end columns -->

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="service-block" style="min-height: 291px !important;">
                                    <h4>Park & Ride</h4>
                                    <img src="assets/images/pandr.png" class="img-circle" style="width:80px;height:80px"
                                         alt="logo">
                                    <p>{!! $site_settings_main["services_page_parking_sec1_parkandride"];  !!}
                                        <br>
                                        <br></p>
                                </div><!-- end service-block -->
                            </div><!-- end columns -->

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="service-block" style="min-height: 291px !important;">
                                    <h4>On Airport</h4>
                                    <img src="assets/images/onairport.jpg" class="img-circle"
                                         style="width:80px;height:80px" alt="logo">
                                    <p>{!! $site_settings_main["services_page_parking_sec1_onairport"];  !!}

                                        <br><br><br></p>
                                </div><!-- end service-block -->
                            </div><!-- end columns -->


                        </div><!-- end service-blocks -->
                    </div><!-- end row -->


                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
    <section id="services" class="section-padding bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="page-heading">
                        <h2>{!! $site_settings_main["services_page_parking_sec2_heading"];  !!}</h2>
                        <p> {!! $site_settings_main["services_page_parking_sec2_descp"];  !!}</p>

                    </div><!-- end page-heading -->

                    <div class="row">
                        <div id="service-blocks">

                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="service-block1" style="min-height:309px !important;">
                                    <img src="assets/images/1.png" class="img-circle myimage" alt="logo">

                                    <p>{!! $site_settings_main["services_page_parking_sec2_step1"];  !!}</p>

                                </div><!-- end service-block -->
                            </div><!-- end columns -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="service-block1" style="min-height:309px !important;">
                                    <img src="assets/images/2.png" class="img-circle myimage" alt="logo">

                                    <p>{!! $site_settings_main["services_page_parking_sec2_step2"];  !!}</p>

                                </div><!-- end service-block -->
                            </div><!-- end columns -->
                            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="service-block1" style="min-height:309px !important;">
                                    <img src="assets/images/3.png" class="img-circle myimage" alt="logo">

                                    <p>{!! $site_settings_main["services_page_parking_sec2_step3"];  !!}</p>

                                </div><!-- end service-block -->
                            </div><!-- end columns -->


                        </div><!-- end service-blocks -->
                    </div>

                </div><!-- end columns -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>


    <!-- end innerpage-wrapper -->


@endsection

