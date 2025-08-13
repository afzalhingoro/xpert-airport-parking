@extends('layouts.main')
@section("title",$page->meta_title)
@section("meta_keyword",$page->meta_keyword )
@section("meta_description",$page->meta_description)
@section('content')

<div class="container-fluid blog-banner">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="blog-banner-hding">Parking Types</h2>
		</div>
	</div>
</div>
<section id="section">
	<div class="container">
		<div class="row">
			<h1 class="text-center team-hding">Types of Airport Parking	</h1>
			<div id="background justify-content-center" class="hidden-xs hidden-sm">
				<p id="bg-text1">Parking</p>
			</div>
		</div>
        {!! $page->content !!}
	</div>
</section>
            
        

@endsection