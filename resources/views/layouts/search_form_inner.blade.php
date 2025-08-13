<style>
.form-select {
    padding: 0.375rem 0.25rem 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-repeat: no-repeat;
    background-position: right 0px center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
}
.text-field {

    height: 39px;

    width: 100%;

    border-radius: 5px;

    border-style: none;

    padding-left: 10px;

    padding-right: 10px;

}
</style>
<section id="banner-padding">
	<div class="container-fluid  banner-bg" id="banner">
		<div class="row">
			<div class="new-banner-content">
				<h1>Explore the World<br>with us</h1>
				<p>It Feels Good to be Lost in the Direction</p>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-10 form-align">
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item" role="presentation">
						<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#airport" type="button" role="tab" aria-controls="home" aria-selected="true">Airport Parking <br> <img src="{{url('theme/img/banner/parking.png') }}" class="banner-icon img-responsive"></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#Flights" type="button" role="tab" aria-controls="profile" aria-selected="false">Flights <br> <img src="{{url('theme/img/banner/airplane.png') }}" class="banner-icon img-responsive"></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Hotels" type="button" role="tab" aria-controls="contact" aria-selected="false">Hotels <br> <img src="{{url('theme/img/banner/hotel.png') }}" class="banner-icon img-responsive"></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Lounges" type="button" role="tab" aria-controls="contact" aria-selected="false">Lounges <br> <img src="{{url('theme/img/banner/lounge.png') }}" class="banner-icon img-responsive"></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Car" type="button" role="tab" aria-controls="contact" aria-selected="false">Car Hire <br> <img src="{{url('theme/img/banner/travel-insurance.png') }}" class="banner-icon img-responsive"></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Holidays" type="button" role="tab" aria-controls="contact" aria-selected="false">Holidays <br> <img src="{{url('theme/img/banner/sunbed.png') }}" class="banner-icon img-responsive"></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Transfer" type="button" role="tab" aria-controls="contact" aria-selected="false">Airport Transfer <br> <img src="{{url('theme/img/banner/airport.png') }}" class="banner-icon img-responsive"></button>
					</li>
					<li class="nav-item" role="presentation">
						<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#Insurance" type="button" role="tab" aria-controls="contact" aria-selected="false">Travel Insurance <br> <img src="{{url('theme/img/banner/leasing.png') }}" class="banner-icon img-responsive"></button>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="airport" role="tabpanel" aria-labelledby="home-tab">
						<form method="get" action="{{ route('searchresult') }}" id="search_form_1" class="search_panel_content">
							<div class="row">
								<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 mb-2">
									<select required="" name="airport_id" class="form-select">
										@foreach($airports as $airport)
											<option @if($request->input("airport_id")==$airport->id) {{ "selected" }} @endif  value="{{ $airport->id }}">{{ $airport->name }}</option>
										@endforeach
									</select>
								</div>
								<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
									<div class="form-floating d-flex mb-2">
										<input type="text" class="text-field dpd1" id="startDate" name="dropoffdate" required value="{{ $request->input('dropoffdate') }}" placeholder="DD/MM/YYYY">
									</div>
								</div>
								
								@php
                                           
                                    $dropdown_timer = [];
                                    for ($i = 0; $i <= 23; $i++) {
                                        for ($j = 0; $j <= 45; $j += 15) {
                                            $dropdown_timer[str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT)] = str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT);
                                        }  
                                    }

                                @endphp
								<div class="col-lg-1 col-md-6 col-sm-6 col-xs-12 mb-2">
									{{ Form::select('dropoftime',$dropdown_timer,$request->input('dropoftime'),["class"=>"form-select","id"=>"dropoftime"]) }}
								</div>
								<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 mb-2">
									<div class="form-floating  d-flex">
										<input type="text" class="text-field dpd2" name="departure_date" id="endDate" required value="{{ $request->input('departure_date') }}" placeholder="DD/MM/YYYY">
									</div>
								</div>
								<div class="col-lg-1 col-md-6 col-sm-6 col-xs-12 mb-2">
									{{ Form::select('pickup_time',$dropdown_timer,$request->input('pickup_time'),["class"=>"search_input","id"=>"pickup_time"]) }}
								</div>
								<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 mb-2">								
									<div class="form-floating  d-flex">
                                          @php if($request->input("promo2")!=""){ $p2=$request->input("promo2"); }else { $p2=""; } @endphp
										<input type="text" class="form-group text-field" name="promo" placeholder="Promo Code" value='@if($p2!="") {{ $p2 }} @endif  @if($request->input("promo")) {{ $request->input("promo") }} @endif'>
									</div>
								</div>
								<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
									<button type="submit" class="tbn form-submit-button"> Search</button>
								</div>
							</div>
						</form>
					
					</div>
					<div class="tab-pane fade" id="Flights" role="tabpanel" aria-labelledby="profile-tab">
						<h5>Coming Soon</h5>
					</div>
					<div class="tab-pane fade" id="Hotels" role="tabpanel" aria-labelledby="contact-tab">
						<h5>Coming Soon</h5>
					</div>
					<div class="tab-pane fade" id="Lounges" role="tabpanel" aria-labelledby="contact-tab">
						<h5>Coming Soon</h5>
					</div>
					<div class="tab-pane fade" id="Car" role="tabpanel" aria-labelledby="contact-tab">
						<h5>Coming Soon</h5>
					</div>
					<div class="tab-pane fade" id="Holidays" role="tabpanel" aria-labelledby="contact-tab">
						<h5>Coming Soon</h5>
					</div>
					<div class="tab-pane fade" id="Transfer" role="tabpanel" aria-labelledby="contact-tab">
						<h5>Coming Soon</h5>
					</div>
					<div class="tab-pane fade" id="Insurance" role="tabpanel" aria-labelledby="contact-tab">
						<h5>Coming Soon</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

