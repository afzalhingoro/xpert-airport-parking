@include('layouts.header')
@include('layouts.nav')

<div class="container-fluid blog-banner">
	<div class="row">
		<div class="col-lg-12">
			<h2 class="blog-banner-hding">All Airports</h2>
		</div>
	</div>
</div>
	<div class="container" id="Parkingpage">
		<div class="row justify-content-center my-5">
		    @foreach($airports as $airport)

            @php

            if ( preg_match('/\s/',$airport->name) ){

            $name = str_replace(" ", "-", strtolower($airport->name));

            } else {

            $name = trim(strtolower($airport->name));

            }

            $url = str_replace(" ", "-", $name);

            $url = $url."-".'airport-parking';



            @endphp
			<div class="col-lg-3 col-md-5 col-sm-10 airport-div">
				<div class="image"> <img src="{{ asset('storage/app/'.$airport->profile_image)}}" alt="" class="img-fluid img-pdg">
					<div class="all-airport">
						<a href='{{ route("page",["slug"=>$url]) }}'>{{$airport->name}} Airport</a>
						<ul class="list-unstyled d-flex star-color">
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
							<li><span class="fa fa-star"></span></li>
						</ul>
					    <a href='{{ route("page",["slug"=>$url]) }}'>	<button class="bg-visitbutton" type="button" >Visit Now</button></a>
					</div>
				</div>
			</div>
			@endforeach
			
		</div>
	</div>
@include('layouts.footer')