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
    .h3banner{
    color:white;
    font-size:40px;
     font-weight:bolder;
    line-height:1.3;
        text-align: center;
       }
.form.bg{
    background-color:white;
}
    @media screen and (max-width: 600px) {
  #div-hidden {
    visibility: hidden; clear: both; float: left; margin: 10px auto 5px 20px;width: 28%; display: none;
  }
  .h3banner{
   font-size:2rem !important;
       
}
  
  #search_form_1{
      margin-right:10px; margin-left:10px;
  }
}
@media screen and (min-width: 600px) {
  #title_message {
    visibility: hidden; clear: both; float: left; margin: 10px auto 5px 20px;width: 28%; display: none;
  }
}
.checked{
    color: #F79F02 !important;
    font-size: 18px;
}
.form-floating>.form-select{border-radius:0;}
        /*@media screen and (min-device-width: 768px) and (max-device-width: 975px) { */
        /*.mnt{max-width: 210px;}*/
            
        /*}*/
        
        /*@media screen and (min-device-width: 1301px) and (max-device-width: 1325px) { */
        /*.mnt{max-width: 203px;}*/
            
        /*} */
        /*@media screen and (min-device-width: 1276px) and (max-device-width: 1300px) { */
        /*.mnt{max-width: 196px;}*/
            
        /*}*/
        /*@media screen and (min-device-width: 1200px) and (max-device-width: 1275px) { */
        /*.mnt{max-width: 178px;}*/
            
        /*}*/
        @media screen and (min-device-width: 1168px) and (max-device-width: 1199px) { 
        .mnt{max-width: 207px;}
            
        }
         @media screen and (min-device-width: 992px) and (max-device-width: 1167px) { 
        div.cal{max-width: 236px;}
            
        }
        @media screen and (min-device-width: 531px) and (max-device-width: 536px) { 
        .mnt{max-width: 207px;}
            
        }
        /*@media screen and (min-device-width: 1037px) and (max-device-width: 1067px) { */
        /*.mnt{max-width: 152px;}*/
            
        /*}*/
        /* @media screen and (min-device-width: 1000px) and (max-device-width: 1036px) { */
        /*.mnt{max-width: 143px;}*/
            
        /*}*/
        /*@media screen and (min-device-width: 909px) and (max-device-width: 991px) { */
        /*div.cal{width: 246px;}*/
            
        /*}*/
        /*@media screen and (min-device-width: 768px) and (max-device-width: 908px) { */
        /*.mnt{width: 193px;}*/
            
        /*}*/
        @media screen and (min-device-width: 334px) and (max-device-width: 531px) { 
        div.cal{width: 235px;}
            
        }
        
        
        .form-h2{
            text-align:center;
            color:white;
            font-weight:bold;
            font-size:30px;
                margin-bottom: 40px;
        }
        .from-css{
            background-color:rgb(255, 255, 255,40%);
            padding:30px;
            border-radius: 13px;
            margin-top:67px;
            margin-bottom:30px;
            /*width:510px;*/
        }
        .form-control{    height: 50px;    background: none !important;}
        .form-select{ height: 50px;    background: none !important;}
        
        .p-css{color:black;margin-top:2px;background-color:rgb(255, 255, 255,60%);border-radius:15px;padding:15px;padding-bottom:25px;}
        @media screen and (min-width:1323px) {
          .p-css{ width: 577px;    height: 279px;}
        }
        @media screen and (min-device-width: 1203px) and (max-device-width: 1322px) { 
        .p-css{ width: 482px;    height:285px ;}
        }
        
        @media screen and (min-width:992px) {
          #banner{height:100%;}
        }
        @media screen and (min-width:601px) {
          .padding{    padding-left:80px;padding-right:80px;}
        }
        
        .btn-h{border-radius: 12px !important;height:58px !important;width: 89%;}
        @media screen and (max-width:284px) {
          .btn-h{height: 66px !important;}
        }
       .form-control::-webkit-input-placeholder {
  color: black;
}
@media only screen and (min-width: 1527px)  {
            .row-lr-p{margin-left:-100px;margin-right:-100px;}
        }
.form-floating{    position: relative;}
.form-floating>.form-control{height: 3.625rem; line-height: 1.25;}
.form-floating>label{
    border: 0.0625rem solid transparent;
    height: 100%;
    left: 0;
    overflow: hidden;
    padding: 1rem 0.75rem;
    pointer-events: none;
    position: absolute;
    text-overflow: ellipsis;
    top: 0;
    transition: opacity .1s ease-in-out,transform .1s ease-in-out,-webkit-transform .1s ease-in-out;
    white-space: nowrap;
    width: 100%;
}
.banner-location-single-contents-subtitle{
        display: block;
    font-size: 15px;
    font-weight: 500;
    line-height: 22px;
    margin: -4px 0 10px;
        color: black;
}
@media only screen and (min-width: 992px)  {
    .search_item{width:16%;padding-left: 0;padding-right: 0;}
}


.drop-css{border-top-left-radius: 12px !important;border-bottom-left-radius: 12px !important;}
.promo-css{border-top-right-radius: 12px !important;border-bottom-right-radius: 12px !important;}
@media only screen and (max-width: 991px)  {
    input, select{border-radius:12px !important;}
}
</style>
<section id="" style="background-image: url('theme-new/img/main3.webp');background-size: cover;">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
        <div class="row row-lr-p">
            <div class="col-lg-12 col-md-12 col-sm-12"  style="padding-top:67px">
                <p class="h3banner" style="">We aim to BEAT our competitors on price! <br> & We will keep your Car Safe</p>
                <p style="color:white;font-size:25px;    text-align: center;">We are PARK MARK certified for your peace of mind.</p>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row " id="">
        				<div class="col-lg-12 col-md-12 col-sm-12 text-center">
        				    
        					<form class="row from-css justify-content-center" style="" method="get" action="{{ route('searchresult') }}" id="search_form_1">
        					    <div class="search_item" >
        					        <div class="mb-3 form-floating">
        					            
        					            <input style="background-color:white !important;" type="text" class="text-field dpd1 form-control drop-css" id="startDate" name="dropdate" required placeholder="DD/MM/YYYY" readonly> 
        					            <label for="floatingInput">
        					                <span class="banner-location-single-contents-subtitle">
        					                    <i class="fa fa-light fa-calendar"></i>
                					            Drop off Date
                					        </span>
            					        </label>
        					        </div>
                                </div>
                                <div class="search_item" >
        					        <div class="mb-3 form-floating">
        					            @php
                                            $dropdown_timer = [];
                                            for ($i = 0; $i <= 23; $i++) {
                                                for ($j = 0; $j <= 45; $j += 15) {
                                                    $dropdown_timer[str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT)] = str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT);
                                                }  
                                            }
                                        @endphp
        					            <select style="background-color:white !important;" name="droptime" required class="form-select">
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
        					            <label for="floatingInput">
        					                <span class="banner-location-single-contents-subtitle">
        					                    <i class="fa-regular fa-clock"></i>
            					            Drop off Time
                					        </span>
            					        </label>
        					        </div>
                                </div>
                                <div class="search_item" >
        					        <div class="mb-3 form-floating">
        					            <input style="background-color:white !important;" type="text" class="text-field dpd2 form-control"  readonly id="endDate" name="pickdate" autocomplete="off" required  placeholder="DD/MM/YYYY" >
        					            <label for="floatingInput"  class="pickup_date">
        					                <span class="banner-location-single-contents-subtitle">
        					                    <i class="fa fa-light fa-calendar"></i>
            					           PickUp Date
                					        </span>
            					        </label>
        					        </div>
                                </div>
                                <div class="search_item" >
        					        <div class="mb-3 form-floating">
        					            <select style="background-color:white !important;" name="picktime" required class="form-select" >
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
        					            <label for="floatingInput">
        					                <span class="banner-location-single-contents-subtitle">
        					                    <i class="fa-regular fa-clock"></i>
            					                PickUp Time
                					        </span>
            					        </label>
        					        </div>
                                </div>
                                <div class="search_item" >
        					        <div class="mb-3 form-floating">
        					            <!--<div id="dropdatepicker">-->
                                                <input style="background-color:white !important;" type="text" class="form-control promo-css" placeholder="Promo-code" name="discount_code" value="{{ request()->get('promo') }}">
                                            <!--</div>-->
        					            <label for="floatingInput">
        					                <span class="banner-location-single-contents-subtitle">
        					                    <i class="fa-solid fa-percent"></i>
            					                Promo Code
                					        </span>
            					        </label>
        					        </div>
                                </div>
                                <div class="search_item" >
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
                                    <div class="form-group">
                                        <button style=" " type="submit" class="btn btn-primary btn-h"><b style="font-weight: 800;">Search</b></button>
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
