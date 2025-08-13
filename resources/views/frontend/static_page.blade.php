@extends('layouts.main')
<style>
	.section-b2 {
		height: auto !important;
	}

	#search_form_1 {
		margin: 0 !important;
	}

    #wrapper h3 b, #wrapper h4 b {
        font-weight: inherit !important;
	}

	#wrapper h3 {
        font-size: 20px !important;
        color: #1f2937 !important;
        font-weight: 700 !important;
		font-family: "Muli", sans-serif !important;
    }

	#wrapper h4 {
        font-size: 18px !important;
        color: #1f2937 !important;
        font-weight: 700 !important;
		font-family: "Muli", sans-serif !important;
    }

	#wrapper #section p {
        font-size: 17px !important;
		color: #6c757d!important;
		font-family: "Muli", sans-serif !important;
    }

	.staticPageSec .inner-content > .row:nth-child(2) {
		margin-top: 60px;
	}

	@media(min-width: 768px) {
        .staticPageSec .inner-content > .row:nth-child(2) {
			margin-top: 100px;
		}

		.inner-content > .row:nth-child(2) {
			padding: 50px 0;
		}
    }

	.inner-content > .row:nth-child(2) {
		position: relative;
	}

	.inner-content > .row:nth-child(2) > * {
		position: relative;
		z-index: 2;
	}

	.inner-content > .row:nth-child(2)::after{
		content: '';
		position: absolute;
		top: -50px;
		left: -100%;
		width: calc(100vw + 100%);
		height: calc(100% + 100px);
		background: #ededed;
		z-index: 1;
	}

	section#section-b.happyClients.testimonial {
      margin: 100px 0 120px !important;
    }

    @media(max-width: 768px) {
      section#section-b.happyClients.testimonial {
		margin-bottom: unset !important;
        margin: 50px 0 100px !important;
      }

	  #section.staticPageSec .inner-content .col-cent img {
		max-height: 100% !important;
	  }

	  .inner-content.px-4 {
		padding: 0 !important;
	  }
	}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!--@section("title",$page->meta_title)-->
@section("meta_keyword",$page->meta_keyword )
@section("meta_description",$page->meta_description)

@section('content')

<section id="bg-css" style="background-image: url('theme-new/img/Banner-V2-others.png');background-size: cover;">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 pt-67" id="slideInRight">
                            <h1 class="h3banner" style="">{{ $page->page_title  }}</h1>
                            <p class="banner-description">Convenient, secure parking at Stansted Airport.</p>
                        </div>
                        @include('layouts.search_form_others') 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@if (request()->is('terms-and-conditions'))

<section id="section" class="staticPageSec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-55">
			    <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="box-shadow: 0 -11px 38px rgba(0,0,0,0.10);padding-top: 30px;">-->
				<div class="inner-content px-4">
					<h1 class="inner-heading">{{ $page->page_title  }}</h1>
                    <p>{!! $page->content !!}</p>
				</div>
			</div>
		</div>
	</div>
</section>
@elseif (request()->is('affiliates'))

<section id="section" class="staticPageSec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-55">
			    <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="box-shadow: 0 -11px 38px rgba(0,0,0,0.10);padding-top: 30px;">-->
				<div class="inner-content px-4">
					<h1 class="inner-heading">{{ $page->page_title  }}</h1>
                    <p>{!! $page->content !!}</p>
				</div>
			</div>
		</div>
	</div>
</section>

@elseif (request()->is('privacy-policy'))

<section id="section" class="staticPageSec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-55">
			    <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="box-shadow: 0 -11px 38px rgba(0,0,0,0.10);padding-top: 30px;">-->
				<div class="inner-content px-4">
					<h1 class="inner-heading">{{ $page->page_title  }}</h1>
                    <p>{!! $page->content !!}</p>
				</div>
			</div>
		</div>
	</div>
</section>

@else
<section id="section" class="staticPageSec">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 pt-55">
				<div class="inner-content px-4">
					<!--<h1 class="inner-heading">{{ $page->page_title  }}</h1>-->
					<div class="row">
					    <div class="col-lg-7" style="margin-top:3%;">
					        {!! $page->content !!}
					    </div>
					    <div class="col-lg-5 col-rght">
					        <img class="img-fluid" style="margin-top: 30px;height: 465px;" alt="" src="{{ url('storage/' . str_replace('public/', '', $page->banner)) }}">
					    </div>
					    <div class="col-lg-5 col-cent">
					        <img class="img-fluid" style="margin-top: 30px;" alt="" src="{{ url('storage/' . str_replace('public/', '', $page->banner)) }}">
					    </div>
					</div>
					
					<div class="row">
					    <div class="col-lg-5 col-rght">
					        <img class="img-fluid" style="margin-top: 30px;height: 465px;" alt="" src="{{ url('storage/' . str_replace('public/', '', $page->banner2)) }}" style="height: 465px;">
					    </div>
					    <div class="col-lg-7 align-content-center">
					        {!! $page->content2 !!}
					    </div>
					    
					    <div class="col-lg-5 col-cent">
					        <img class="img-fluid" style="margin-top: 30px;" alt="" src="{{ url('storage/' . str_replace('public/', '', $page->banner2)) }}">
					    </div>
					</div>
					
					<div class="row">
					    <div class="col-lg-7 align-content-center">
					        {!! $page->content3 !!}
					    </div>
					    <div class="col-lg-5 col-rght">
					        <img class="img-fluid" style="margin-top: 30px;" alt="" src="{{ url('storage/' . str_replace('public/', '', $page->banner3)) }}" style="height: 465px;">
					    </div>
					    <div class="col-lg-5 col-cent">
					        <img class="img-fluid" style="margin-top: 30px;" alt="" src="{{ url('storage/' . str_replace('public/', '', $page->banner3)) }}">
					    </div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
@endif
<section id="section-b" class="section-b2 happyClients testimonial">
		<div class="container">
			<div class="row justify-content-center">
				<div class="section-heading">
				    <h2 class="section-3-h2">Our Happy  <span> Clients </span></h2>
					 @include('layouts.happy_clients')
				</div>
			</div>
		</div>
</section>


<script>
    let $blocks = $('.block-card');

$('.filter-btn').on('click', e => {
  let $btn = $(e.target).addClass('active');
  $btn.siblings().removeClass('active');
  
  let selector = $btn.data('target');
  $blocks.removeClass('active').filter(selector).addClass('active');
});
</script>
<!--@include('layouts.parking_type')-->
@endsection

