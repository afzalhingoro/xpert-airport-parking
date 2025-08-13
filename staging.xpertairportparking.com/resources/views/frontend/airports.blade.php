@include('layouts.header')
@include('layouts.nav')
    

    <!-- Home -->

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
                       
                            <h1><!--bestairport parking--></h1>
                        </div>
                    </div>
                </div>

     

                <!-- Slider Item -->
             

            </div>
            
            <!-- Home Slider Nav - Prev -->

            


            <!-- Home Slider Dots -->

         
            
        </div>

    </div>

    <!-- Search -->
@include('layouts.search_form')
 
<style type="text/css">
    .offers_item
    {
        padding: 5%;
    }
    .offers {
    /*top: -420px;*/
    width: 100%;
    /*padding-top: 90px;*/
    padding-bottom: 43px;
    background: #f3f6f9;
}
    .checked{
    color: #fa9e1b;
    font-size: 13px;
    }
    .unchecked{
    font-size: 13px;
    } 

</style>
    <div class="offers">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="section_title">the best offers </h2>
                </div>
            </div>
            <div class="row offers_items">

                <!-- Offers Item --> 
                 @foreach($airports as $airport)
                            @php
                                if ( preg_match('/\s/',$airport->name) ){
                                    $name = str_replace(" ", "-", strtolower($airport->name));
                                } else {
                                    $name = trim(strtolower($airport->name))."-";
                                }
                            $url = $name."airport-parking";
                            @endphp
                <div class="col-lg-6 offers_col">
                    <div class="offers_item">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="offers_image_container">
                                    <!-- Image by https://unsplash.com/@kensuarez -->
                                    <div class="offers_image_background" style="background-image:url('{{ asset("storage/app/".$airport->profile_image) }}')"></div>
                                    <div class="offer_name"><a href="#">{{ $airport->name }}</a></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="offers_content">
                                    <div class="offers_price">{{ $airport->name }} <span></span></div>
                                    <div class="rating_r rating_r_4 offers_rating">
<!--                                         <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i>
                                        <i></i> -->
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star checked"></span>
                                        <span class="fa fa-star unchecked"></span>
                                    </div>
                                    <p class="offers_text"> </p>
                                    <div class="offers_icons">
                                        <ul class="offers_icons_list">
                                            <li class="offers_icons_item"><img src="{{url('theme/images/post.png')}}" alt=""></li>
                                            <li class="offers_icons_item"><img src="{{url('theme/images/compass.png')}}" alt=""></li>
                                            <li class="offers_icons_item"><img src="{{url('theme/images/bicycle.png')}}" alt=""></li>
                                            <li class="offers_icons_item"><img src="{{url('theme/images/sailboat.png')}}" alt=""></li>
                                        </ul>
                                    </div>
                                    <div class="offers_link"><a href="{{ route("page",["slug"=>$url]) }}">read more</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                 @endforeach
                <!-- Offers Item -->
            

            </div>
        </div>
    </div>
  
@include('layouts.footer')