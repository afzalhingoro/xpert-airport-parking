@extends('layouts.main')

@section("title",$post->meta_title)

@section("meta_keyword",$post->meta_keyword )

@section("meta_description",$post->meta_description)

@section('content')



<section class="blog-details-banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class="h3banner">{{ $post->page_title }}</h1>
                            <p class="h3banner-p-sec">Convenient, Secure Parking At Stansted Airport.</p>
                        </div>
                        @include('layouts.search_form_others')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content -->
<div class="content blog_detail_content">
    <section class="gray-bg no-top-padding-sec blog_detail" id="sec1">
        <div class="container">
            <div class="post-container fl-wrap">
                <div class="row justify-content-center">
                    <!-- Blog Content -->
                    <div class="col-md-10">
                        <!-- Article -->
                        <article class="post-article single-post-article">
                            @if(isset($post->banner))
                            <div class="list-single-main-media fl-wrap">
                                <div class="single-slider-wrap">
                                    <div class="single-slider fl-wrap">
                                        <div class="swiper-container">
                                            <div class="swiper-wrapper lightgallery">
                                                <div class="swiper-slide hov_zoom text-center">
                                                    <img class="img-fluid blog-image-details my-3" src='{{ url('storage/' . str_replace('public/', '', $post->banner)) }}' alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="list-single-main-item fl-wrap block_box">
                                {!! $post->content; !!}
                            </div>
                        </article>
                        <!-- Article End -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div>

<!--content end-->



@endsection