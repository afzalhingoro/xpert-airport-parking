

@extends('layouts.main')

<title>Latest Blogs - Xpert Airport Parking</title>
<meta name="description" content="Stay informed with our Latest Blogs at Xpert Airport Parking for travel tips and insights">

<style>

  
</style>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>

$(document).ready(function(){

	var maxLength = 405;

	$(".show-read-more2").each(function(){

		var myStr = $(this).text();

		if($.trim(myStr).length > maxLength){

			var newStr = myStr.substring(0, maxLength);

			var removedStr = myStr.substring(maxLength, $.trim(myStr).length);

			$(this).empty().html(newStr);

			$(this).append(' <a href="javascript:void(0);" class="read-more"> ...</a>');

			$(this).append('<span class="more-text">' + removedStr + '</span>');

		}

	});

// 	$(".read-more").click(function(){

// 		$(this).siblings(".more-text").contents().unwrap();

// 		$(this).remove();

// 	});

});

</script>

<script>

$(document).ready(function(){

	var maxLength = 205;

	$(".show-read-more").each(function(){

		var myStr = $(this).text();

		if($.trim(myStr).length > maxLength){

			var newStr = myStr.substring(0, maxLength);

			var removedStr = myStr.substring(maxLength, $.trim(myStr).length);

			$(this).empty().html(newStr);

			$(this).append(' <a href="javascript:void(0);" class="read-more"></a>');

			$(this).append('<span class="more-text">' + removedStr + '</span>');

		}

	});

	$(".read-more").click(function(){

		$(this).siblings(".more-text").contents().unwrap();

		$(this).remove();

	});

});

</script> -->

@section('content')

<section id="bg-css" class="aboutBgCss">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class="h3banner" style="">Blog</h1>
                            <p class="h3banner-p-sec">Convenient, Secure Parking At Stansted Airport.</p>
                        </div>
                        @include('layouts.search_form_others') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="top-shape blogSection">

        <div class="container">

            <!--<div class="row justify-content-center">-->

            <!--    <div class="col-12">-->

            <!--        <div class="section-title">-->

            <!--            <h2 style="font-size: 20px;color: black;margin-top: 50px;">Recent blog posts</h2>-->

            <!--        </div>-->

            <!--    </div>-->

            <!--</div>-->

            <!--<hr>-->

            <div class="row">

                <!--<div class="col-md-12 col-lg-6">-->

                <!--        <div class="row">-->

                <!--            <div class="col-lg-12 col-md-12">-->

                <!--                <a href="https://www.flightparkone.com/gatwick-airport-parking-guides">-->

                <!--                    <img src="{{url('theme-new/img/blog-img.png')}}" alt="" id="" style="width: 100%;height:100%">-->

                <!--                </a>-->

                <!--            </div>-->

                <!--            <div class="col-lg-12 col-md-12">-->

                <!--                <div class="row">-->

                <!--                    <div class="col-lg-12"  style="margin-top: 12px;margin-bottom: 12px;">-->

                <!--                        <span href="#" style="color: black;font-size: 14px;">Charles Thompson Feb 21, 2023</span>-->

                <!--                    </div>-->

                <!--                </div>-->

                <!--                <div class="row">-->

                <!--                    <div class="col-lg-12">-->

                <!--                        <h3 style="color: black;font-size: 24px;font-weight: bold;"><a href="">Heathrow Airport Parking Guides</a></h3>-->

                <!--                    </div>-->

                <!--                </div>-->

                <!--                <div class="row">-->

                <!--                    <div class="col-lg-12">-->

                <!--                        <p style="color: rgb(0,0,0,80%)" class="show-read-more2">This field offers a broad range of expertise and learning opportunities. It offers the best of both worlds to digital enthusiasts who thrive on creativity, communication and tremendous earning potential.This field offers a broad range of expertise and learning opportunities. It offers the best of both worlds to digital enthusiasts who thrive on creativity, communication and tremendous earning potential.This field offers a broad range of expertise and learning opportunities. It offers the best of both worlds to digital enthusiasts who thrive on creativity, communication and tremendous earning potential.This field offers a broad range of expertise and learning opportunities. It offers the best of both worlds to digital enthusiasts who thrive on creativity, communication and tremendous earning potential.</p>-->

                <!--                    </div>-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--</div>-->

                <!--<div class="col-md-12 col-lg-6">-->

                <!--    <div class="row" style="margin-bottom: 10px;">-->

                <!--        <div class="col-lg-6 col-md-6">-->

                <!--            <img src="{{url('theme-new/img/blog-img.png')}}" class="img-fluid" id="" style="height: 100%;">-->

                <!--        </div>-->

                <!--        <div class="col-lg-6 col-md-6">-->

                <!--            <div class="row">-->

                <!--                <div class="col-lg-12" style="margin-bottom: 12px;">-->

                <!--                    <span href="#" style="color: black;font-size: 14px;">Charles Thompson Feb 21, 2023</span>-->

                <!--                </div>-->

                <!--                <div class="col-lg-12">-->

                <!--                    <h3 style="color: black;font-size: 18px;font-weight: bold;"><a href="">Heathrow Airport Parking Guides</a></h3>-->

                <!--                </div>-->

                <!--                <div class="col-lg-12"  style="margin-top: 8px;">-->

                <!--                   <p style="color: rgb(0,0,0,80%);font-size: 15px;" class="show-read-more">This field offers a broad range of expertise and learning opportunities. It offers the best of both worlds to digital enthusiasts who thrive on creativity, communication and tremendous earning potential.</p>-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </div>-->

                <!--    <div class="row" style="margin-bottom: 10px;">-->

                <!--        <div class="col-lg-6 col-md-6">-->

                <!--            <img src="{{url('theme-new/img/blog-img.png')}}" class="img-fluid" id="" style="height: 100%;">-->

                <!--        </div>-->

                <!--        <div class="col-lg-6 col-md-6">-->

                <!--            <div class="row">-->

                <!--                <div class="col-lg-12" style="margin-bottom: 12px;">-->

                <!--                    <span href="#" style="color: black;font-size: 14px;">Charles Thompson Feb 21, 2023</span>-->

                <!--                </div>-->

                <!--                <div class="col-lg-12">-->

                <!--                    <h3 style="color: black;font-size: 18px;font-weight: bold;"><a href="">Heathrow Airport Parking Guides</a></h3>-->

                <!--                </div>-->

                <!--                <div class="col-lg-12"  style="margin-top: 8px;">-->

                <!--                   <p style="color: rgb(0,0,0,80%);font-size: 15px;" class="show-read-more">This field offers a broad range of expertise and learning opportunities. It offers the best of both worlds to digital enthusiasts who thrive on creativity, communication and tremendous earning potential.</p>-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </div>-->

                <!--    <div class="row">-->

                <!--        <div class="col-lg-6 col-md-6">-->

                <!--            <img src="{{url('theme-new/img/blog-img.png')}}" class="img-fluid" id="" style="height: 100%;">-->

                <!--        </div>-->

                <!--        <div class="col-lg-6 col-md-6">-->

                <!--            <div class="row">-->

                <!--                <div class="col-lg-12" style="margin-bottom: 12px;">-->

                <!--                    <span href="#" style="color: black;font-size: 14px;">Charles Thompson Feb 21, 2023</span>-->

                <!--                </div>-->

                <!--                <div class="col-lg-12">-->

                <!--                    <h3 style="color: black;font-size: 18px;font-weight: bold;"><a href="">Heathrow Airport Parking Guides</a></h3>-->

                <!--                </div>-->

                <!--                <div class="col-lg-12"  style="margin-top: 8px;">-->

                <!--                   <p style="color: rgb(0,0,0,80%);font-size: 15px;" class="show-read-more">This field offers a broad range of expertise and learning opportunities. It offers the best of both worlds to digital enthusiasts who thrive on creativity, communication and tremendous earning potential.</p>-->

                <!--                </div>-->

                <!--            </div>-->

                <!--        </div>-->

                <!--    </div>-->

                <!--</div>-->

                 @foreach($posts as $post)
                <div class="col-lg-4 col-md-6 col-sm-12 my-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="blog-div-bor">
                            <a href="{{ url('blog/'.$post->slug) }}">
                               @if ($post->banner != null)
                                   <img class="img-fluid blog-image" src='{{ url('storage/' . str_replace('public/', '', $post->banner)) }}' alt="">
                                    @else
                                     <img src="{{url('theme-new/img/parking 2.avif')}}" alt="" class="blog-image">
                                @endif 
                            </a>
                            <div class="col-lg-12 col-md-12">
                            <div class="row blog-row">
                                <div class="col-lg-12">
                                    <span href="#" class="blog_date"> {{ date("F d Y", strtotime($post->added_on)) }}</span>
                                </div>
                                <div class="col-lg-12">
                                    <h3 class="blog_title"><a href='{{ url('blog/'.$post->slug) }}'>{{ $post->page_title }}</a></h3>
                                </div>
                                <div class="col-lg-12">
                                   <p  class="show-read-more">{!! \Illuminate\Support\Str::limit($post->meta_description, 200, $end='...') !!}</p>
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                </div>
                 @endforeach
            </div>
        </div>
    </section>
@endsection



