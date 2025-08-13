@if(request()->get('porc'))

<?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

      

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, request()->get('utm_source')]);

}

?>

@endif



@if(request()->get('src') != '')

{{ session()->put('bk_src', request()->get('src') )}}

  <?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

      

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, request()->get('src')]);

}

?>

@endif

@if(request()->get('utm_source') == 'paidgoogleppc')

{{ session()->put('bk_src', 'PPC' )}}

  <?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'PPC']);

}

?>

@endif

@if(request()->get('utm_source') == 'Google PPC')

{{ session()->put('bk_src', 'PPC' )}}

  <?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'PPC']);

}

?>



@endif

@if(request()->get('utm_source') == 'ppc')

{{ session()->put('bk_src', 'PPC' )}}



  <?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'PPC']);

}

?>

@endif

@if(request()->get('utm_source') == 'Bing PPC')

{{ session()->put('bk_src', 'BING' )}}

  <?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'BING']);

}

?>



@endif

@if(request()->get('utm_source') == 'bing')

{{ session()->put('bk_src', 'BING' )}}

  <?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'BING']);

}

?>

@endif

@if(request()->get('utm_source') == 'social')

{{ session()->put('bk_src', 'FB' )}}

  <?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'FB']);

}

?>

@endif

@if(request()->get('porc') != '')

{{ session()->put('bk_src', 'POR' )}}

  <?php 

$ipaddress = '';

    if (getenv('HTTP_CLIENT_IP'))

        $ipaddress = getenv('HTTP_CLIENT_IP');

    else if(getenv('HTTP_X_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');

    else if(getenv('HTTP_X_FORWARDED'))

        $ipaddress = getenv('HTTP_X_FORWARDED');

    else if(getenv('HTTP_FORWARDED_FOR'))

        $ipaddress = getenv('HTTP_FORWARDED_FOR');

    else if(getenv('HTTP_FORWARDED'))

       $ipaddress = getenv('HTTP_FORWARDED');

    else if(getenv('REMOTE_ADDR'))

        $ipaddress = getenv('REMOTE_ADDR');

    else

        $ipaddress = 'UNKNOWN';

DB::update("update src set active = 'No' where created_at < now() - interval 30 DAY");

$present = DB::select("select * from src WHERE IP = '".$ipaddress."' and active = 'Yes'");

if($present){}

else

{

DB::insert('insert into src (IP, src) values (?, ?)', [$ipaddress, 'POR']);

}

?>

@endif



@php

$company = DB::table('companies')->where('id', '3')->first();



@endphp

<style>

  
</style>

<section id="">

    <div class="container" >

        <div class="row">

            

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="container" >

        <div class="row">

            <!--<div class="col-lg-12 col-md-12 col-sm-12"  style="padding-top:67px">-->

                

            <!--    <p class="h3banner" style="">Heathrow Airport</p>-->

            <!--    <p style="color:white;font-size:18px;">Home &nbsp; <i class="fa-solid fa-chevron-right"></i> &nbsp; Heathrow Airport</p>-->

            <!--</div>-->

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="row " id="">

        				<div class="col-lg-12 col-md-12 col-sm-12 text-center">

        					

        					

        					

        					<form class="row from-css justify-content-center" style="" method="get" action="{{ route('searchresult') }}" id="search_form_1">

        					    <div class="col-lg-6 col-cs col-cs2" >

        					        <div class="mb-3">

        					            <label for="floatingInput">Drop off Date </label>

        					            <div class="input-hold date">

        					            <input style="background-color:#FAB03F !important;" value="{{ request()->dropdate }}" type="text" class="text-field dpd1 form-control drop-css" id="startDate" name="dropdate" required placeholder="DD/MM/YYYY" readonly> 

            					        <!--<i class="fa-regular fa-calendar-days icon-cs"></i>-->

            					        </div>

        					        </div>

                                </div>

                                <div class="col-lg-6 col-cs2" >

        					        <div class="mb-3">

        					            @php

                                            $dropdown_timer = [];

                                            for ($i = 0; $i <= 23; $i++) {

                                                for ($j = 0; $j <= 45; $j += 15) {

                                                    $dropdown_timer[str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT)] = str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT);

                                                }  

                                            }

                                        @endphp

                                        <label for="floatingInput">

        					                 Drop off Time

            					        </label>

            					        <div class="input-hold time">

        					            <select style="background-color:#FAB03F !important;" name="droptime" required class="form-select drop-css">

        											@php

                                            		foreach ($dropdown_timer as $key => $value) {

                                            			$selected ='';

                                            			if($value == request()->droptime){

                                            				$selected ='selected';

                                            			}

                                        			@endphp

                                            			<option {{$selected}} value="{{ $value }}">{{ $value }}</option> 

                                            		@php

                                            		}

                                            		@endphp	

        										</select>

        										<!--<i class="fa-regular fa-clock icon-cs1"></i>-->

        					            </div>

        					        </div>

                                </div>

                                <div class="col-lg-6 p-cs col-cs col-cs2" >

        					        <div class="mb-3">

        					            <label for="floatingInput"  class="pickup_date">

            					           PickUp Date

            					        </label>

            					        <div class="input-hold date">

        					            <input style="background-color:#FAB03F !important;" type="text" value="{{ request()->pickdate }}" value="{{ request()->get('promo') }}" class="text-field dpd2 form-control drop-css"  readonly id="endDate" name="pickdate" autocomplete="off" required  placeholder="DD/MM/YYYY" >

        					            <!--<i class="fa-regular fa-calendar-days icon-cs"></i>-->

        					            </div>

        					        </div>

                                </div>

                                <div class="col-lg-6 col-cs2" >

        					        <div class="mb-3">

        					            <label for="floatingInput">

        					                PickUp Time

            					        </label>

            					        <div class="input-hold time">

        					            <select style="background-color:#FAB03F !important;" name="picktime" required class="form-select drop-css" >

                                                    @php

                                            		foreach ($dropdown_timer as $key => $value) {

                                            			$selected ='';

                                            			if($value == request()->picktime){

                                            				$selected ='selected';

                                            			}

                                            			@endphp

                                            			<option {{$selected}} value="{{ $value }}">{{ $value }}</option> 

                                            		@php

                                            		}

                                            		@endphp	

                                                </select>

                                                <!--<i class="fa-regular fa-clock icon-cs1"></i>-->

        					             </div>

        					        </div>

                                </div>

                                <div class="col-lg-12 p-cs col-cs mtop col-cs2" >

        					        <div class="mb-3">

        					            <!--<div id="dropdatepicker">-->

        					            <label for="floatingInput" class="promo-code-css">

            					                Promo Code

            					        </label>
                                        

                                                <input style="background-color:#FAB03F !important;" type="text" class="form-control promo-css drop-css" placeholder="Optional" name="promo"  value="{{ request()->get('promo') }}">

                                            <!--</div>-->

                                            <i class="fa-solid fa-percent icon-cs"></i>

        					            

        					        </div>

                                </div>

                                

                                <div class="col-lg-6 mtop btn-css-mtop" >

                                    <!--<input type="hidden" name="company_id" value="3">-->

        							<!--<input type="hidden" name="product_code" value="103">-->

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

        							<label>

        					                &nbsp;

            					        </label>

                                    <div class="form-group">

                                        

                                        <button style="background:#00519A;color:#FAB03F;" type="submit" class="btn btn-h"><b style="font-weight: 800;">Search</b></button>

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

            </div>

        </div>

    </div>

</section>	



