@extends('layouts.main')
@section("title",$page->meta_title)
@section("meta_keyword",$page->meta_keyword )
@section("meta_description",$page->meta_description)
@section('content')

    <div class="home-container home-background">



    </div><!-- end home-container -->
<style type="text/css">
    .passenger-detail
    {
        width: 100%;
    }
    .tab-content>.active {
        margin-top: 0px;
    }
    .listlinkpz a{
        color: #000;
        font-weight: 500;
        font-size: 16px;
        padding: 10px 0px;
        text-decoration: none;
    }
    .listlinkpz a:hover{
        color: #1773b9;
        font-weight: 600;
        font-size: 16px;
        text-decoration: underline;
    }
    .site-map{
        color: #000;
        font-weight: 600;
        text-align: center;
    }
    .top-hding{
        color: #000;
        font-weight: 600;
        padding: 30px 0px; 
    }
    .sitemap-links li{
        list-style: none;
    }
    .sitemap-links a{
        list-style: none;
    }
</style>


    <div class="container-fluid blog-banner">
        <div class="row">
        	<div class="col-lg-12">
        		<h2 class="blog-banner-hding">Site Map</h2>
        	</div>
        </div>
    </div>


    <section class="top-offer marginto73" style="top:40px" >


        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                    <div class="row">
                        <div class="panel passenger-detail">
                            <!--<h3 class="site-map">Site Map</h3>-->
                            <div class="well-body">


                                <div class="inr-cnt  col-xs-12 col-sm-12 col-md-12 col-lg-12 mainsitemap" >

                                    <div class="">
                                        <div class="row ">
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 ">

                                            <h3 class="top-hding"> Airport Parking</h3>
                                            <ul class="sitemap-links">
                                                <li class="listlinkpz"><a href="{{ route("page",["slug"=>"gatwick-airport-parking"]) }}">Gatwick
                                                        Airport Parking</a></li>
                                                <li class="listlinkpz"><a href="{{ route("page",["slug"=>"heathrow-airport-parking"]) }}">Heathrow
                                                        Airport Parking</a></li>
                                                <li class="listlinkpz"><a href="{{ route("page",["slug"=>"stansted-airport-parking"]) }}">Stansted
                                                        Airport Parking</a></li>
                                                <li class="listlinkpz">
                                                    <a href="{{ route("page",["slug"=>"birmingham-airport-parking"]) }}">Birmingham
                                                        Airport Parking</a></li>
                                                <li class="listlinkpz"><a href="{{ route("page",["slug"=>"edinburgh-airport-parking"]) }}">Edinburgh
                                                        Airport Parking</a></li>
                                                <li class="listlinkpz">
                                                    <a href="{{ route("page",["slug"=>"southampton-airport-parking"]) }}">Southampton
                                                        Airport Parking</a></li>
                                                <li class="listlinkpz"><a href="{{ route("page",["slug"=>"liverpool-airport-parking"]) }}">Liverpool
                                                        Airport Parking</a></li>
                                                <li class="listlinkpz"><a href="{{ route("page",["slug"=>"luton-airport-parking"]) }}">Luton
                                                        Airport Parking</a></li>
                                                <li class="listlinkpz">
                                                    <a href="{{ route("page",["slug"=>"manchester-airport-parking"]) }}">Manchester
                                                        Airport Parking</a></li>
                                                        <li  class="listlinkpz">
                                                <a href="{{ route("page",["slug"=>"east-midlandsairport-parking"]) }}">East Midlands
                                                        Airport Parking</a></li>
                                                        <li  class="listlinkpz">
                                                <a href="{{ route("page",["slug"=>"leeds-bradford-airport-parking"]) }}">Leeds Bradford Airport</a></li>
                                            </ul>
                                            <br>
                                        </div>
                                        <!--<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 ">-->
                                        <!--    <h3 class="top-hding"> Serving Airports</h3>-->
                                        <!--    <ul class="sitemap-links">-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"gatwick-airport-parking"]) }}">Gatwick-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"heathrow-airport-parking"]) }}">Heathrow-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"luton-airport-parking"]) }}">Luton-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz">-->
                                        <!--            <a href="{{ route("page",["slug"=>"birmingham-airport-parking"]) }}">Birmingham-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"stansted-airport-parking"]) }}">Stansted-->
                                        <!--                Airport</a></li>-->

                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"edinburgh-airport-parking"]) }}">Edinburgh-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"exeter-airport-parking"]) }}">Exeter-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"bristol-airport-parking"]) }}">Bristol-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"glasgow-airport-parking"]) }}">Glassgow-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"aberdeen-airport-parking"]) }}">Aberdeen-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"newcastle-airport-parking"]) }}">Newcastle-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"belfast-airport-parking"]) }}">Belfast-->
                                        <!--                Int Airport</a></li>-->
                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"cardiff-airport-parking"]) }}">Cardiff-->
                                        <!--                Airport</a></li>-->


                                        <!--        <li class="listlinkpz"><a href="{{ route("page",["slug"=>"liverpool-airport-parking"]) }}">Liverpool-->
                                        <!--                Airport</a></li>-->
                                        <!--        <li class="listlinkpz">-->
                                        <!--            <a href="{{ route("page",["slug"=>"manchester-airport-parking"]) }}">Manchester-->
                                        <!--                Airport</a></li>-->

                                        <!--        <li class="listlinkpz">-->
                                        <!--            <a href="{{ route("page",["slug"=>"east-midlandsairport-parking"]) }}">East Midlands-->
                                        <!--                Airport</a></li>-->

                                        <!--    </ul>-->
                                        <!--    <br>-->
                                            
                                        <!--</div>-->
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

                                            <h3 class="top-hding">Other Pages</h3>
                                            <ul class="sitemap-links">


                                                <li class="listlinkpz">
                                                    <a href="{{ route("static_page",["page"=>"about-us"]) }}">About
                                                        Us</a></li>

                                                <li class="listlinkpz">
                                                    <a href="{{ route("static_page",["page"=>"terms-and-conditions"]) }}">Terms
                                                        & condition</a></li>
                                                <li class="listlinkpz">
                                                    <a href="{{ route("static_page",["page"=>"privacy-policy"]) }}">Privacy
                                                        Policy</a></li>
                                                <li class="listlinkpz">
                                                    <a href="{{ route("static_page",["page"=>"site-security"]) }}">Site
                                                        Security</a></li>
                                                <li class="listlinkpz">
                                                    <a href="{{ route("sitemap") }}">Site Map</a></li>
                                                <li class="listlinkpz">
                                                    <a href="{{ route("static_page",["page"=>"affiliates"]) }}">Affiliates</a>
                                                </li>
                                                <li  class="listlinkpz"><a href="{{ route("static_page",["page"=>"cookies"]) }}">Cookies</a>
                                                </li>
                                         
                                                <li class="listlinkpz">
                                                    <a href="{{ route("airport_guide") }}">Airport Guide</a></li>
                                                <li class="listlinkpz"><a href="{{ route("faqs") }}">FAQ</a></li>

                                            </ul>

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
    <!-- end innerpage-wrapper -->


@endsection

