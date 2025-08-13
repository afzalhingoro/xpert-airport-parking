@extends('layouts.main')
@section("title",$page->meta_title)
@section("meta_keyword",$page->meta_keyword )
@section("meta_description",$page->meta_description)
@section('content')
<style type="text/css">
    .bg-grey-margin {
    margin-top: 57px;
    margin-right: 63px;
    margin-bottom: 63px;
    padding: 40px;
    margin-left: 63px;
    background-color: white;
    box-shadow: 2px 2px 14px 6px #5f5f5f42;
}
 @media (max-width: 768px)
{
.bg-grey-margin {
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
    padding: 10%;
    margin-left: 0px;
}
}
.intro{
	margin-top: 40px;
}
.nice-select{
    background: #fff !important;
    border: 1px solid #b4b4b4 !important;
}
</style>
      <div class="home-container home-background">

          


    </div><!-- end home-container -->
    <style type="text/css">
        @media only screen and (max-width: 575px){
            .intro {
                width: 100%;
                padding-top: 0px;
                padding-bottom: 0px;
            }
        }
        .booking-summery{
            color: #2e3f6e;
            font-weight: 700;
            font-size: 35px;
            text-align: center;
            z-index: 10 !important;
            padding: 20px 0px;
        }
        .booking-div{
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 40px;
        }
        .submit-butn{
            display: block;
            margin: auto;
            margin-top: 20px !important;
            background-color: #1773b9;
            color: #fff;
            font-size: 15px;
            border: 2px solid #06a0ff !important;
            padding: 12px 25px 12px 25px;
        }
        .submit-butn:hover{
            display: block;
            margin: auto;
            margin-top: 20px !important;
            background-color: #fff0;
            color: #1773b9;
            font-size: 15px;
            border: 2px solid #1773b9 !important;
            padding: 12px 25px 12px 25px;
        }
        .block_box {
            background: #fff;
            border-radius: 10px;
            border: 1px solid #e5e7f2;
            padding: 20px;
        }
    </style>
    
<!--    <div class="container-fluid blog-banner">-->
<!--	<div class="row">-->
<!--		<div class="col-lg-12">-->
<!--			<h2 class="blog-banner-hding">Manage Booking</h2>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
    <div class="intro">
    <div class="container ">
        <div class="row justify-content-center" >
         
            
      

 
        
        <div class="inr-cnt  col-xs-12 col-sm-12 col-md-12 col-lg-10">
            <!------starting contact us ------->


            <!--form start---->
            <div class="booking-div">

                <h2 class="booking-summery text-center mb-5">Booking Summary</h2>

                    @if (!$errors->isEmpty())

                           <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>

                    @endif


                <div id="parent">
                    
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="inr-cnt col-lg-12 col-md-10 col-sm-12 col-xs-12">
                                <div class="bookiing-form-wrap block_box fl-wrap">
                                    <div class="list-single-main-item fl-wrap hidden-section tr-sec">
                                        <div class="profile-edit-container">
                                            <div class="custom-form">
                                                <form id="js_contact-form" action="{{ route("booking_search") }}" class="contact-form" method="post"
                                                      enctype="multipart/form-data">
                            
                                                    @csrf
                                                    <!--<div class="row">-->
                                                    <!--<div class="col-xs-12 col-md-12">-->
                                                        <!--<div class="form-group">-->
                                                        <!--    <label style="color:#000;">Booking Reference No.<span class="required-field">*</span></label>-->
                                                        <!--    <input type="text" class="form-control" id="ref_no" name="ref_no"-->
                                                        <!--           placeholder="ZMD-XXXXXXXXX" required="" value="{{ Request::old("ref_no") }}"-->
                                                        <!--           autofocus=""-->
                                                        <!--           style="/*background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABHklEQVQ4EaVTO26DQBD1ohQWaS2lg9JybZ+AK7hNwx2oIoVf4UPQ0Lj1FdKktevIpel8AKNUkDcWMxpgSaIEaTVv3sx7uztiTdu2s/98DywOw3Dued4Who/M2aIx5lZV1aEsy0+qiwHELyi+Ytl0PQ69SxAxkWIA4RMRTdNsKE59juMcuZd6xIAFeZ6fGCdJ8kY4y7KAuTRNGd7jyEBXsdOPE3a0QGPsniOnnYMO67LgSQN9T41F2QGrQRRFCwyzoIF2qyBuKKbcOgPXdVeY9rMWgNsjf9ccYesJhk3f5dYT1HX9gR0LLQR30TnjkUEcx2uIuS4RnI+aj6sJR0AM8AaumPaM/rRehyWhXqbFAA9kh3/8/NvHxAYGAsZ/il8IalkCLBfNVAAAAABJRU5ErkJggg==&quot;)*/; background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; border:1px solid #000">-->
                                                        <!--</div>-->
                                                        
                                                        <div class="col-sm-10">
                            							<label class="vis-label">Booking Reference No.<i class="far fa-book"></i></label>
                            							<input type="text" class="form-control" id="ref_no" name="ref_no"
                                                                   placeholder="GP247-XXXXXXXXX" required="" value="{{ Request::old("ref_no") }}"
                                                                   autofocus="">                                                  
                                						</div>
                                						
                                                    <!--</div>-->
                                                    <!--<div class="col-xs-12 col-md-12 mt-3">-->
                                                        
                                                    <div class="col-sm-10">
                            							<label class="vis-label">Last Name<i class="far fa-user"></i></label>
                            							<input  type="text" class="form-control" id="last_name" name="last_name"
                                                                   placeholder="Last Name" required="" value="{{ Request::old("last_name") }}"
                                                                   autofocus="" style="border: 1px solid #000">                                                  
                                					</div>
                                                        
                                                        
                                                        <!--<div class="form-group">-->
                                                        <!--    <label style="color:#000;">Last Name <span class="required-field">*</span></label>-->
                                                        <!--    <input type="text" class="form-control" id="last_name" name="last_name"-->
                                                        <!--           placeholder="Last Name" required="" value="{{ Request::old("last_name") }}"-->
                                                        <!--           autofocus="" style="border: 1px solid #000">-->
                                                        <!--</div>-->
                            
                                                    <!--</div>-->
                            
                                                    <!--<div class="col-xs-12 col-md-12 mt-3">-->
                                                        <!--<div class="form-group">-->
                                                        <!--    <label style="color:#000;">Email Address <span class="required-field">*</span></label>-->
                                                        <!--    <input type="text" class="form-control" id="email" name="email"-->
                                                        <!--           placeholder="Email" required="" value="{{ Request::old("email") }}"-->
                                                        <!--           autofocus="" style="border: 1px solid #000">-->
                                                        <!--</div>-->
                                                        
                                                        <div class="col-sm-10">
                                							<label class="vis-label">Email Address<i class="far fa-envelope"></i>  </label>
                                							<input type="text" class="form-control" id="email" name="email"
                                                                   placeholder="Email" required="" value="{{ Request::old("email") }}"
                                                                   autofocus="" style="border: 1px solid #000">                                                  
                                						</div>
                                                    <!--</div>-->
                                                <!--</div>-->
                            
                            
                                                    <div class="col-xs-12 mt-3">
                                                        <!--<button type="submit" name="submit" class="btn btn-yellow submit-butn"> Submit </button>-->
                                                        <button type="submit" name="submit" class="btn btn-yellow submit-butn">Submit</button>
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


            </div>
            <!----end-->

        </div>

            </div>

        <div class="clearfix"></div>


    </div>
</div>
<script type="text/javascript">
window.scroll({
 top: 0, 
 left: 0
});
	

</script>
@endsection
@section("footer-script")

@endsection