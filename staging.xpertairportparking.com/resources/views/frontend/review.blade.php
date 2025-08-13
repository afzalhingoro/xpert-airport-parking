@extends('layouts.main')
@section('content')
    <style>
        .th_class {
            background: #ffcb05;
        }
        .inner-section {
            background-color: #eff2f3;
            padding: 5px 0;
        }
        .passenger-detail h3 {
            /* margin: 10px; */
            padding: 10px 20px;
            line-height: 1.6;
            background: linear-gradient(to right, rgba(30, 133, 95, 0.9) 0, rgba(13, 70, 141, 0.9));
            color: #fff;
            border-top-left-radius: 6px;
            border-top-right-radius: 6px;
        }
        #menu-tabs li {
            width: 100%;
            border: 1px solid #ccc;
        }
        .nav-tabs {
            border: 1px solid #dddddd03;
        }
        a:active {
            background: #1d9cbc;
        }
        .nav-tabs > li.active > a, .nav-tabs > li.active > a:focus, .nav-tabs > li.active > a:hover {
            border: none !important;
            border-bottom-color: inherit !important;
            background: #337ab7;
        }
        .bhoechie-tab-container {
            border: 1px solid #ccc;
            /* margin: -9px; */
            margin-top: 0px;
            margin-right: -9px;
            /* margin-bottom: -9px; */
            margin-left: -9px;
            padding: 0px;
        }
        .ap_page_content {
            padding-left: 19px;
        }
        .bhoechie-tab-menu {
            padding: 0px !important;
        }
        .inner-step i {
            border-radius: 50%;
            background: #ffcb05;
            color: #fff;
            padding: 23px;
            position: relative;
            display: inline-block;
            text-align: center;
        }
        .inner-step i path {
            fill: #fff;
        }
        .inner-step i svg {
            width: 60px;
            display: table-cell;
            vertical-align: middle;
            height: 60px;
        }
        .inner-step h5 {
            font-weight: 800;
            margin: 30px 0px 10px;
            text-transform: uppercase;
            color: #ffcb05;
            font-size: 34px;
        }
        .hxComment li {
            list-style-type: none;
        }
        .sb-serc {
            text-align: center;
            background: url(assets/images/banner16.jpg);
            border: 4px solid #fff;
            float: left;
            width: 100%;
            margin: 0px 0px 20px 0px;
            /*   min-height: 305px;
            max-height: 305px;*/
            overflow: hidden;
            padding-top: 15px;
        }
        .sb-serc a {
            margin: 5px 0px;
            float: left;
            width: 100%;
            font-weight: bold;
            background: linear-gradient(to right, rgba(30, 126, 37, 0.9) 0, rgba(12, 66, 132, 0.9));
            /*color: #0e4060;*/
            color: #fff;
            margin-bottom: 20px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .sb-serc p {
            font-size: 15px;
            line-height: 21px;
            overflow: hidden;
            padding: 0 10px;
            text-align: center;
            min-height: 127px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }
        .accordion-style1 {
            background: url(assets/images/banner16.jpg);
        }
        .sub-serc .sb-serc p {
            min-height: 150px
        }
        .col-right-norm h2, h3, h4, h5 {
            font-size: 22px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-weight: 700;
        }
        .review-col{
            background-color: #f8f9fa;
            border-radius: 2px;
            box-shadow: 0 1px 0 0 rgba(182,196,210,.4);
            line-height: 18px;
            margin: 0 0 16px;
            
            
            border: 3px solid #FAB03F;
            border-radius: 30px;
        }
        @media only screen and (min-width: 1200px)  {
            .review-col{width: 49%;margin-left: 10px;}
        }
        @media screen and (min-device-width: 768px) and (max-device-width: 1199px) { 
            .review-col{ width: 48%;margin-left: 10px;}
        }
        .review-create{
            color: #00519A;
            font-size: 17px;
        }
        .review-username{
            color: #FAB03F;
            font-size: 20px;
            font-weight: 600;
            padding: 6px 0;
        }
        .review-p{
            text-align: left;
            color: #191919;
            font-size: 17px;
        }
        .review-user-create{}
        .section-3-h2 {
            color: #FAB03F;
            font-size: 36px;
            font-weight: bold;
        }
        .review-star{
            color: #FAB03F;
        }
        blockquote span{color:black;}
    </style>
    <section>
        <div class="container-fluid">
            <div class="row">
                <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
                <!--    @include('frontend.reviews_search_form')-->
                <!--</div>-->
            </div>
        </div>
    </section>
    <section style="margin-top: 150px;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="row">
                        <div class="panel passenger-detail">
                        <h2 class="section-3-h2">Reviews <span style="color:#00519A">and</span>   Ratings</h2>
                            <div class="well-body">
                                <p>
                                    Below are the reviews of our customers who have booked car parking with us. Our Airport Parking feedback services, encourages 
                                    customers to review, good or bad about their experience with us. This allows us to know which car parks are better performing
                                     and in which areas our customers are most satisfied with
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="row">
                            @foreach($reviews as $review)
                                <div class="col-md-6 review-col">
                                    <p class="item padding0px">
                                        <strong class="fn">{{ $review["c_name"] }}</strong>
                                    </p>
                                    <blockquote style="padding-left: 18px;">
                                        <p class="padding0px review-p" style="text-align: left;">{!! $review["review"] !!}</p>
                                        <div class="review-user-create">
                                            <p>
                                                <small class="text-right review-username">
                                                    {{ $review["username"] }}<br>
                                                </small>
                                            </p>
                                            <p>
                                                <small class="text-right">
                                                    <strong class="review-create">{{ $review["created_at"] }}<span class="value-title" title="{{ $review["created_at"] }}"></span></strong>
                                                </small>
                                            </p>
                                            <!--@for($i=1 ; $i<=$review['rating'];  $i++)-->
                                            <!--    <i class="fa fa-star review-star" data-rating="1"></i>-->
                                            <!--@endfor-->
                                            
                                            @if($review['rating'] <= 0)
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                @elseif($review['rating'] === 1)
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                @elseif($review['rating'] === 2)
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                @elseif($review['rating'] === 3)
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                @elseif($review['rating'] === 4)
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                @elseif($review['rating'] >= 5)
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                    <i class="fa fa-star review-star" data-rating="1"></i>
                                                @endif
                                        </div>
                                    </blockquote>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- end innerpage-wrapper -->
@endsection
@section("footer-script")
    <script>

        $(function () {

            $("#dropdatepicker12").datepicker({

                minDate: 0,

                dateFormat: 'dd/mm/yy',

                onSelect: function (dateText, inst) {



                    var date2 = $('#dropdatepicker12').datepicker('getDate', '+1d');

                    date2.setDate(date2.getDate() + 7);

                    $('#pickdatepicker12').datepicker('setDate', date2);

                }



            });

            $('#pickdatepicker12').datepicker(

                {

                    defaultDate: "+1w",

                    dateFormat: 'dd/mm/yy',

                    beforeShow: function () {

                        $(this).datepicker('option', 'minDate', $('#dropdatepicker12').val());

                        if ($('#dropdatepicker12').val() === '') $(this).datepicker('option', 'minDate', 0);

                    }

                });

        });

    </script>

@endsection

