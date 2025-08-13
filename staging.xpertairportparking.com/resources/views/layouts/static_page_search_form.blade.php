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
    font-size:36px;
     font-weight:700;
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
    font-size: 13px;
}
.form-floating>.form-select{border-radius:0;}
        @media screen and (min-device-width: 1168px) and (max-device-width: 1199px) { 
        .mnt{max-width: 207px;}
            
        }
        @media screen and (min-device-width: 531px) and (max-device-width: 536px) { 
        .mnt{max-width: 207px;}
            
        }
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
            background-color:rgb(255, 255, 255);
            padding:15px 26px;
            border-radius: 30px;
            margin-top:12px;
            margin-bottom:30px;
            /*width:510px;*/
                box-shadow: 0px 1px 5px 1px gray;
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
        
        .btn-h{
            border-radius: 10px !important;
            height: 49px !important;
            width: 100%;
            border-color: #c72037 !important;
            background-color: #c72037 !important;
            color: #fff !important;
            font-weight: 600;
        }
        .btn-h:hover{
            border-radius: 10px !important;
            height: 49px !important;
            width: 100%;
            border-color: #242d62 !important;
            background-color: #242d62 !important;
            color: #fff !important;
            font-weight: 600;
        }
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
label{
    font-size: 14px;
    font-weight: bold;
    color: black;
    margin-left: 6px;
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
.promo-css{border-top-right-radius: 12px !important;border-bottom-right-radius: 12px !important;}
@media only screen and (max-width: 991px)  {
    input, select{border-radius:12px !important;}
}
@media only screen and (min-width: 1400px)  {
    .icon-cs{
        color: #242d62;
        position: relative;
        top: -50px;
        font-size: 20px;
        float: right;
        margin-right: -4px;
}
.icon-cs1{
    color: #242d62;
    position: relative;
    top: -42px;
    /*margin-left: 151px;*/
    font-size: 24px;
    float: right;
    margin-right: 10px;
}
}

@media only screen and (max-width: 1399px)  {
    .icon-cs{
    color: #242d62;
    position: relative;
    top: -58px;
    /*margin-left: 125px;*/
    font-size: 20px;
    float: right;
    margin-right: 10px;
}
.icon-cs1{
    color: #242d62;
    position: relative;
    top: -42px;
    /*margin-left: 151px;*/
    font-size: 24px;
    float: right;
    margin-right: 10px;
}
}

input[type="text"] {
    font-size:20px;
    color: #7A7979;
}
select {
    font-size:20px !important;
    color: #7A7979 !important;
}
input::placeholder {
    color: #7A7979 !important;
}

@media screen and (min-device-width: 1200px) and (max-device-width: 1399px) { 
.icon-cs{
    color: #242d62;
    position: relative;
    top: -50px;
    /*margin-left: 125px;*/
    font-size: 20px;
}
.icon-cs1{
    color: #242d62;
    position: relative;
    top: -42px;
    /*margin-left: 121px;*/
    font-size: 24px;
}
}
/*.form-control{width: 119%;margin-left: -20px;}*/
.icon-cs{top: -49px;margin-right: 12px;}
.icon-cs1{top: -43px;}
/*.p-cs{margin-left: 14px;}*/
}
@media only screen and (min-width: 1400px)  {
    .form-control{width: 107% !important;}
}
@media screen and (min-device-width: 768px) and (max-device-width: 991px) { 
.icon-cs{    margin-right: 21px;}
    .icon-cs1{margin-right: 20px;}
}
@media screen and (min-device-width: 601px) and (max-device-width: 767px) { 
.icon-cs{    margin-right: 10px;}
    .icon-cs1{margin-left: 394px;}
}
@media screen and (min-device-width: 527px) and (max-device-width: 600px) { 
.icon-cs{margin-right: 10px;}
    .icon-cs1{margin-left: 346px;}
}

@media only screen and (max-width: 526px)  {
    .icon-cs{margin-right: 15px;}
    .icon-cs1{margin-right: 15px;}
}
@media only screen and (max-width: 1199px)  {
   .col-cs2{width:100%;}
}


.input-hold.date:before, .input-hold.person:before{
    font-family: 'FontAwesome' !important;
    text-align: center;
    color: #242d62;
    -webkit-font-smoothing: antialiased;
    padding-top: 7px;
    position: relative;
    top: 40px;
    pointer-events: none;
    border-radius: 0 6px 6px 0;
    z-index: 1;
    float: right;
    font-size: 20px;
}
@media only screen and (min-width: 1400px)  {
   .input-hold.date:before, .input-hold.person:before{margin-right: 9px;}
}
@media only screen and (max-width: 1399px)  {
   .input-hold.date:before, .input-hold.person:before{margin-right: 9px;}
}
.input-hold.date:before{content: "\f073";}



.search-row {
    border: 2px dashed black;
    border-radius: 15px;
    padding: 12px 9px;
}


.input-hold.time:before, .input-hold.person:before{
    font-family: 'FontAwesome' !important;
    text-align: center;
    color: #242d62;
    -webkit-font-smoothing: antialiased;
    padding-top: 7px;
    position: relative;
    top: 40px;
    pointer-events: none;
    border-radius: 0 6px 6px 0;
    z-index: 1;
    float: right;
    font-size: 20px;
    margin-right: 9px;
}
.input-hold.time:before{content: "\f017";}
.input-hold{margin-top: -34px;}
.quotae-h3{
    color: #242d62;
    font-weight: 600;
    text-decoration: underline;
    font-style: italic;
    font-size: 32px;
    margin-bottom: 30px;
}
.quotae-h3 span{
    color: #c72037;
}
.input-fields-css {
    background-color: #8080802e !important;
    box-shadow: 0 0 6px #0000004f;
    border-radius: 8px !important;
}
</style>
<section id="bg-css" style="background-image: url('theme-new/img/banner-v4.webp');background-size: cover;">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12"  style="padding-top:67px">
                            <h1 class="h3banner" style="">{{ $page->page_title  }}</h1>
                            <p style="color:white;font-size:20px;text-align: center;">Convenient, secure parking at Heathrow Airport.</p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row " id="">
                				<div class="col-lg-12 col-md-12 col-sm-12">
                				    
                					<form class="from-css justify-content-center" style="" method="get" action="{{ route('searchresult') }}" id="search_form_1">
                					    <div class="row search-row">
                					            <div class="col-lg-12 col-md-12">
                        				           <h3 class="text-center quotae-h3"><span>Get</span> a Quote</h3>
                        				        </div>
                        					    <div class="col-lg-2 col-cs col-cs2" >
                        					            <label for="floatingInput">Drop off Date </label>
                        					            <div class="input-hold date">
                        					                <input type="text" class="text-field dpd1 form-control drop-css input-fields-css" id="startDate" name="dropdate" required placeholder="DD/MM/YYYY" readonly> 
                        					            </div>
                        					            
                        					            <!--<i class="fa fa-light fa-calendar icon-cs"></i>-->
                            					        <!--<i class="fa-regular fa-calendar-days icon-cs"></i>-->
                                                </div>
                                                <div class="col-lg-2 col-cs2" >
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
                        					            <select name="droptime" required class="form-select drop-css input-fields-css">
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
                        										<!--<i class="fa-regular fa-clock icon-cs1"></i>-->
                        					            </div>
                                                </div>
                                                <div class="col-lg-2 p-cs col-cs col-cs2" >
                        					            <label for="floatingInput">
                            					           PickUp Date
                            					        </label>
                            					        <div class="input-hold date">
                        					            <input type="text" class="text-field dpd2 form-control drop-css input-fields-css"  readonly id="endDate" name="pickdate" autocomplete="off" required  placeholder="DD/MM/YYYY" >
                        					            </div>
                        					            <!--<i class="fa-regular fa-calendar-days icon-cs"></i>-->
                                                </div>
                                                <div class="col-lg-2 col-cs2" >
                        					        <div class="mb-3">
                        					            <label for="floatingInput">
                        					                PickUp Time
                            					        </label>
                            					        <div class="input-hold time">
                        					            <select name="picktime" required class="form-select drop-css input-fields-css" >
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
                                                                <!--<i class="fa-regular fa-clock icon-cs1"></i>-->
                        					            </div>
                        					        </div>
                                                </div>
                                                <div class="col-lg-2 p-cs col-cs col-cs2" >
                        					        <div class="mb-3">
                        					            <!--<div id="dropdatepicker">-->
                        					            <label for="floatingInput">
                            					                Promo Code
                            					        </label>
                            					        
                                                                <input type="text" class="form-control promo-css drop-css input-fields-css" placeholder="Optional" name="promo" value="{{ request()->get('promo') }}">
                                                            <!--</div>-->
                                                            <i class="fa-solid fa-percent icon-cs"></i>
                        					            
                        					        </div>
                                                </div>
                                                
                                                <div class="col-lg-2 " >
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
                                                    <div class="form-group">
                                                        <label for="floatingInput" style="width:100%">
                            					                &nbsp;
                            					        </label>
                                                        <button style=" " type="submit" class="btn btn-h">Get a Quote</button>
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

