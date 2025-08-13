@php
use App\Http\Controllers\front\CustomerController
@endphp


@if(isset($_SERVER['HTTP_REFERER']))
{{ session()->put('ref_url', $_SERVER['HTTP_REFERER'] )}}
@endif
@if(request()->get('src') != '')
{{ session()->put('bk_src', request()->get('src') )}}
@endif
@if(request()->get('utm_source') == 'PPC')
{{ session()->put('bk_src', 'PPC' )}}
@endif
@if(request()->get('utm_source') == 'Trade')
{{ session()->put('bk_src', 'TT' )}}
@endif
@if(request()->get('utm_source') == 'Bing')
{{ session()->put('bk_src', 'BING' )}}
@endif
@if(request()->get('utm_source') == 'Por')
{{ session()->put('bk_src', 'POR' )}}
@endif
@if(request()->get('utm_source') == 'EMAIL')
{{ session()->put('bk_src', 'EM' )}}
@endif
@if(request()->get('utm_source') == 'Fbads')
{{ session()->put('bk_src', 'FB' )}}
@endif
@if(request()->get('utm_source') == 'Webgain')
{{ session()->put('bk_src', 'WG' )}}

@endif


@php

if(isset(Auth::guard('customer')->user()->id)){
$email = Auth::guard('customer')->user()->email;
$customer = DB::table('customers')->where('email', $email)->first();
$checkPlan = new CustomerController();
$activePlan = $checkPlan->applyCustomerLoyaltyPlan($customer);

}
$discount = request()->get("promo") ?? session()->get('promo');
@endphp


@php
$sliders = [];

$setting = App\Models\settings::find(135);

if ($setting && $setting->field_value) {
    // Try unserialize
    $unserialized = @unserialize($setting->field_value);

    if ($unserialized !== false || $setting->field_value === 'b:0;') {
        $sliders = $unserialized;
    } else {
        // Fallback: manually extract URL using regex
        preg_match_all('/https?:\/\/[^"]+/', $setting->field_value, $matches);
        $sliders = $matches[0] ?? [];
    }
}
@endphp
  <style>
	  @media only screen and (min-width:992px) {

     .main-search-seaction   {
      height: 590px;
    }
  }
	</style>

	<section id="bg-css" class="main-search-seaction homeSearch" style="position: relative; overflow: hidden;">
    <div id="slider-bg"  class="homepagebanner"></div>
 
 
        
      
      
 
    <div class="container" >
        <div class="row">
             <div class="col-lg-7 col-md-12 col-sm-12 align-content-center main-search-seaction" id="zoomIn">
                <p class="h3banner mt-4" style="">Book Affordable, Secure Stansted
<br> Airport Parking</p>
                <hr class="h3banner-hr">
                <p class="h3banner-p-sec">Experience stress-free travel with Xpert Airport Parking. Our Stansted Park & Ride service offers secure, 24/7 monitored parking and a fast, complimentary shuttle that gets you to the terminal in minutes.
</p>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12" id="slideInRight">
                <div class="row">
    				<div class="col-lg-12 col-md-12 col-sm-12">
    				    
    					<form class="from-css justify-content-center" method="get" action="{{ route('searchresult') }}" id="search_form_1" style="background-image: url('theme-new/img/search-Pattern.webp');background-size: cover;">
    					   <div class="row search-row">
    					       <div class="col-lg-12 col-md-12">
    					           <h3 class="text-center quotae-h3"><span>Quick and 
 </span>Easy Parking</h3>
 <p class="h3banner-p">Save Up-To 20% on Stansted Airport Parking</p>
    					       </div>
							   <div class="col-lg-12 col-md-12 mb-3">

                            <lable class="search-lable">Airports</lable>

                            <div class="formaero aeroplan">

                                <select required="" name="airport_id" class="form-select form-fields">

                                    @foreach($airports as $airport)



                                    <option value="{{ $airport->id }}">

                                        {{ $airport->name }}

                                    </option>



                                    @endforeach

                                </select>

                            </div>


                        </div>
    					    <div class="col-lg-6 col-md-7" >
					            <label for="floatingInput">Drop off Date </label>
					            <div class="input-hold date">
					                <input type="text" class="text-field dpd1 form-control input-fields-css" id="startDate" name="dropdate" required placeholder="DD/MM/YYYY" readonly> 
					            </div>
                            </div>
                            <div class="col-lg-6 col-md-5 col-cs2" >
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

								<label for="floatingInput">Drop off Time</label>

								<div class="input-hold time">
									<select name="droptime" required class="form-select fields-styling">
									@php
																		foreach ($dropdown_timer as $key => $value) {
																			$selected ='';
																			if($value == '09:00'){
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

                            <div class="col-lg-6 col-md-7 p-cs col-cs col-cs2" >
					            <label for="floatingInput" class="pickup_date">
    					           PickUp Date
    					        </label>
    					        <div class="input-hold date">
					            <input type="text" class="text-field dpd2 form-control input-fields-css"  readonly id="endDate" name="pickdate" autocomplete="off" required  placeholder="DD/MM/YYYY" >
					            </div>
                            </div>
                            <div class="col-lg-6 col-md-5 col-cs2" >
    					        <div class="mb-3">
    					            <label for="floatingInput">
    					                PickUp Time
        					        </label>
        					        <div class="input-hold time">
    					            <select name="picktime" required class="form-select input-fields-css" >
                                        @php
                                		foreach ($dropdown_timer as $key => $value) {
                                			$selected ='';
                                			if($value == '09:00'){
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
                            <div class="col-lg-6 col-md-7 p-cs col-cs col-cs2" >
                           
    					        <div class="mb-0">
    					            <label for="floatingInput">
        					                Promo Code
        					        </label>
                                        <input type="text" class="form-control input-fields-css mb-0" placeholder="Optional" name="promo" value="{{ request()->get('promo') ?? 'XAP-SUMOFFER' }}">
                                        <i class="fa-solid fa-percent icon-cs"></i>
    					        </div>
                        
                            </div>
                            
                            <div class="col-lg-6 col-md-5" >
                                <?php /*
                                <input type="hidden" name="company_id" value="3">
    							<input type="hidden" name="product_code" value="103">
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
    							 */?>
                                <div class="form-group">
                                    <label for="floatingInput" class="w-100">
        					                &nbsp;
        					        </label>
                                    <button style=" " type="submit" class="btn find-parking-button"><b style="font-weight: 800;">Get a Quote</b></button>
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
</section>	
