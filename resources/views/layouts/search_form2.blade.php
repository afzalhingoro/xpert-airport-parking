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
    font-size:50px;
     font-weight:bolder;
    line-height:1;
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
            background-color:rgb(255, 255, 255,60%);
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
          #banner{height:696px;}
        }
        @media screen and (min-width:601px) {
          .padding{    padding-left:80px;padding-right:80px;}
        }
        
        .btn-h{border-radius: 50px !important;height:50px !important}
        @media screen and (max-width:284px) {
          .btn-h{height: 66px !important;}
        }
       .form-control::-webkit-input-placeholder {
  color: black;
}
@media only screen and (min-width: 1527px)  {
            .row-lr-p{margin-left:-100px;margin-right:-100px;}
        }
</style>
<section id="banner" style="background-image: url('theme-new/img/banner/flight-banner.webp');">
    <div class="container" >
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="container" >
        <div class="row row-lr-p">
            <div class="col-lg-6 col-md-12 col-sm-12"  style="padding-top:67px">
                <p class="h3banner" style="">FLIGHTPARK ONE</p>
                <p style="color:white;font-size:25px"> Quality Service in Reasonable Price</p>
                <p style="color:white;font-size:40px;font-weight:700;    margin-bottom: 40px;" id="div-hidden">89 %</p>
                
                 <!--<span class="fa-regular fa-star-half-strokefull" id="div-hidden"></span>-->
                 <!--<p style="color:white" id="div-hidden"><b>Review</b></p>-->
                 <div class="p-css" id="div-hidden" style="    font-size: 20px;"><p style="margin-top:10px;margin-bottom: 10px;    font-size: 20px;"><b>HOLLI RANDALL</b></p><span class="fa fa-star checked" id="div-hidden"></span>
                 <span class="fa fa-star checked" id="div-hidden"></span>
                 <span class="fa fa-star checked" id="div-hidden"></span>
                 <span class="fa fa-star checked" id="div-hidden"></span>
                 <i class="fa-regular fa-star-half-stroke checked" id="div-hidden" style="margin-bottom: 10px;"></i><br><i>Cost-efficient, Convenient and best quality meet and greet service ever had at Gatwick. I will highly recommend this parking provider, as I had a great experience booking with them and saved money too. Surely, I will love to book again in future.</i><br><i style="float:right"></i></div>
            </div>
            <div class="col-lg-1 col-md-12 col-sm-12">
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12">
                <div class="row " id="">
        				<div class="col-lg-12 col-md-12 col-sm-12 text-center">
        				    
        					<form class="row from-css" style="" method="post" action="{{ route('addBookingForm') }}" id="search_form_1">
                                <h2 class="form-h2">BOOK NOW</h2>
                            	<input type="hidden" name="airport" value="1">
        						<div class="col-md-6">
                                    <div class="book_tabel_item">
                                        <div class="form-group">
                                            <div class="input-group date" id="dropdatepicker">
                                                 <label style=" border-radius: 3px;color:black;font-size:15px;font-weight:bold" for="dropdate">Drop off Date </label>
                                                <input style=" border-radius: 50px;background-color:white;    border:2px solid #4AA1D9;" type="text" class="text-field dpd1 form-control" id="startDate" name="dropdate" required placeholder="DD/MM/YYYY" readonly> 
        										
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <div class="input-group">
                                                <label for="pickupdate" style="color:black;font-size:15px;font-weight:bold">PickUp Date </label>
                                                <input style=" border-radius: 50px;background-color:white;border:2px solid #4AA1D9;" type="text" class="text-field dpd2 form-control"  readonly id="endDate" name="pickdate" autocomplete="off" required  placeholder="DD/MM/YYYY" >  
        										
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="book_tabel_item">
                                       @php
                                            $dropdown_timer = [];
                                    
                                            for ($i = 0; $i <= 23; $i++) {
                                    
                                                for ($j = 0; $j <= 45; $j += 15) {
                                    
                                                    $dropdown_timer[str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT)] = str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT);
                                    
                                                }  
                                            }
                                        @endphp
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <label for="time" style="color:black;font-size:15px;font-weight:bold">Drop off Time </label>
                                                <select style=" border-radius: 50px;background-color:white;border:2px solid #4AA1D9;" name="droptime" required class="form-select">
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
                                        <div class="form-group">
                                            <div class="input-group date">
                                                <label for="time" style="color:black;font-size:15px;font-weight:bold">PickUp Time </label>
                                                <select style=" border-radius: 50px;background-color:white;border:2px solid #4AA1D9;" name="picktime" required class="form-select" >
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
                                </div>
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <div class="book_tabel_item">
                                        <div class="form-group">
                                            <div class="input-group date" id="dropdatepicker">
                                                <label for="promocode" style="color:black;font-size:15px;font-weight:bold">Promo Code <span style="font-size:10px"><i>( optional )</i></span> </label>
                                                <input style=" border-radius: 50px;background-color:white;border:2px solid #4AA1D9" type="text" class="form-control" placeholder="Promo-code" name="discount_code" value="{{ request()->get('promo') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-2">
                                </div>
                                <div class="col-md-12">
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
                                            <button style=" " type="submit" class="btn btn-primary btn-h"><b>GET A QUOTE</b></button>
                                        </div>
                                    </div>
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
