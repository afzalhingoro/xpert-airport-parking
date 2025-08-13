<style>
    .main-search-input-item{
        border-right: 0;
        width: 100%;
        margin-bottom:12px;
    }
    .search-widget input {
        float: left;
        width: 100%;
        border: none;
        background: #F5F6FA;
        height: 50px;
        padding: 0px 80px 0 40px;
        z-index: 1;
        border-radius: 5px;
    }
    .main-search-button {
        position: relative;
        padding: 12px;
    }
    .label_text{
        text-align: left;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 6px;
    }
    .ab_text {
        text-align: left;
    }
    .list-single-main-item p, .accordion-inner p, .author-content p, .about-wrap p, .user-profile-header_content p {
        color: #000000;
        font-size: 14px;
    }
    #sidebar_form .main-search-input-item .nice-select {
        background: #f5f6fa;
    }
</style>
<div class="box-widget-wrap fl-wrap fixed-bar">
    <!--box-widget-item -->
    <div class="box-widget-item fl-wrap block_box">
        <div class="box-widget-item-header">
            <h3>Search Parking</h3>
        </div>
        <div class="box-widget fl-wrap">
            <div class="box-widget-content">
                <div class="search-widget">
                    <form  method="post" action="{{ route('addBookingForm') }}" id="sidebar_form">
						@csrf
                    	<input type="hidden" name="company_id" value="3">
                    	<input type="hidden" name="airport" value="1">
                        <div class="label_text"><label>Car Drop off Date</label></div>
                        <div class="main-search-input-item clact date-container">
                        	<span class="iconn-dec"><i class="fal fa-calendar"></i></span>
                        	<input type="text" placeholder="Car Drop Off Date & Time" name="dropdate" class="dpd1" id="startDate" autocomplete="off" value="" />
                        	<!--span class="clear-singleinput"><i class="fal fa-times"></i></span-->
                        </div>
                        <div class="label_text"><label>Car Drop off Time</label></div>
                        <div class="main-search-input-item">
                            @php
                                $dropdown_timer = [];
                        
                                for ($i = 0; $i <= 23; $i++) {
                        
                                    for ($j = 0; $j <= 45; $j += 15) {
                        
                                        $dropdown_timer[str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT)] = str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT);
                        
                                    }  
                        
                                }
                            @endphp
                            <select data-placeholder="Time" name="droptime"  class="chosen-select no-search-select" >
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
                        
                        <div class="label_text"><label>Car Collect Date</label></div>
                        <div class="main-search-input-item clact date-container">
                        	<span class="iconn-dec"><i class="fal fa-calendar"></i></span>
                        	<input type="text" placeholder="Car Collect Date" name="pickdate" class="dpd2"  id="endDate" autocomplete="off" value="<?php echo date("m/d/Y", strtotime('+7 days')); ?> 12:00 AM" />
                        	<!--span class="clear-singleinput"><i class="fal fa-times"></i></span-->
                        </div>
                        
                        <div class="label_text"><label>Car Collect Time</label></div>
                        <div class="main-search-input-item">
                            <select data-placeholder="Time" name="picktime"  class="chosen-select no-search-select" >
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
                        <div class="label_text"><label>Promo Code</label></div>
                        <div class="main-search-input-item">
                        	<label><i class="fal fa-percent"></i></label>
                        	<input type="text" placeholder="Promo Code" name="promo" value=""/>
                        </div>
						<button class="main-search-button color2-bg" type="submit">Search <i class="far fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>   
    <div class="box-widget-item fl-wrap block_boxb">
        <div class="banner-wdget fl-wrap">
            <div class="overlay"></div>
            <div class="bg" data-bg="{{url('theme-new/images/bg/13.webp')}}" style="background-image: url({{url('theme-new/images/bg/13.webp')}});"></div>
            <div class="banner-wdget-content fl-wrap">
                <h4>Whant to be notified about new post and news ? Subscribe For a Newsletter.</h4>
                <a href="#subscribe" class="custom-scroll-link color-bg">Subscribe</a>
            </div>
        </div>
    </div>
</div>