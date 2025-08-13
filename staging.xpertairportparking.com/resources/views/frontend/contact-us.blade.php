@extends('layouts.main')

@section('content')

<style>
    span {
        padding-bottom: 0px !important;
    }
    .parallax-section .section-title h1, .parallax-section .section-title p {
        color: #fff;
    }
    .parallax-section .section-title h1 {
        font-size: 32px;
    }
    .section-title h1 {
        float: left;
        width: 100%;
        text-align: center;
        color: #697891;
        font-size: 34px;
        font-weight: 800;
        position: relative;
    }
</style>
<!-- content-->
<div class="content">
    <!--  section  -->
    <section class="parallax-section single-par" data-scrollax-parent="true">
        <div class="bg par-elem "  data-bg="{{url('theme-new/images/bg/banner4-min.webp')}}" data-scrollax="properties: { translateY: '30%' }"></div>
        <div class="overlay op7"></div>
        <div class="container">
            <div class="section-title center-align big-title">
                <h1><span>Contact Us</span></h1>
                <span class="section-separator"></span>
                <div class="breadcrumbs fl-wrap"><a href="{{url('/')}}">Home</a><span>Contact Us</span></div>
            </div>
        </div>
        <div class="header-sec-link">
            <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down"></i></a> 
        </div>
    </section>
    <!--  section  end-->               
    <!--  section  -->
    <section   id="sec1" data-scrollax-parent="true">
        <div class="container">
            <!--about-wrap -->
            <div class="about-wrap">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ab_text-title fl-wrap">
                            <h3>Get in Touch</h3>
                            <span class="section-separator fl-sec-sep"></span>
                        </div>
                        <!--box-widget-item -->                                       
                        <div class="box-widget-item fl-wrap block_box">
                            <div class="box-widget">
                                <div class="box-widget-content bwc-nopad">
                                    <div class="list-author-widget-contacts list-item-widget-contacts bwc-padside">
                                        <ul class="no-list-style">
                                            <li><span><i class="fal fa-map-marker"></i> Adress :</span> <a href="#singleMap" class="custom-scroll-link">20-22 Wenlock Road, London, <br>England, N1 7GU</a></li>
                                            <li><span><i class="fal fa-phone"></i> Phone :</span> <a href="tel:0330 0435735">0330 0435735</a></li>
                                            <li><span><i class="fal fa-envelope"></i> Mail :</span> <a href="mailto: helpdesk@gatwickparking247.com">helpdesk@gatwickparking247.com</a></li>
                                        </ul>
                                    </div>
                                    <div class="list-widget-social bottom-bcw-box  fl-wrap">
                                        <ul class="no-list-style">
                                            <li><a href="#" target="_blank" ><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" target="_blank"><i class="fab fa-twitter"></i></a></li>
                                            <!--<li><a href="#" target="_blank" ><i class="fab fa-vk"></i></a></li>-->
                                            <li><a href="#" target="_blank" ><i class="fab fa-instagram"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--box-widget-item end -->  
                        <!--box-widget-item -->
                        <div class="box-widget-item fl-wrap" style="margin-top:20px;">
                            <div class="banner-wdget fl-wrap">
                                <div class="overlay op4"></div>
                                <div class="bg"  data-bg="{{url('theme-new/images/bg/18.jpg')}}"></div>
                                <div class="banner-wdget-content fl-wrap">
                                    <h4>Whant to be notified about new post and news ? Subscribe For a Newsletter.</h4>
                                    <a href="#subscribe" class="color-bg">Subscribe</a>
                                </div>
                            </div>
                        </div>
                        <!--box-widget-item end -->                                            
                    </div>
                    <div class="col-md-8">
                        <div class="ab_text">
                            <div class="ab_text-title fl-wrap">
                                <h3>Drop us a line</h3>
                                <span class="section-separator fl-sec-sep"></span>
                            </div>
                            <p>If you cannot find the required information in our website, we invite you to contact our support team.</p>
                            <div id="contact-form">
                                <div id="message"></div>
                                <form  class="custom-form" action="" name="contactform" id="contactform">
                                    @csrf
                                    <fieldset>
                                        <label><i class="fal fa-user"></i></label>
                                        <input type="text" name="name" id="name" placeholder="Your Name *" value=""/>
                                        <div class="clearfix"></div>
                                        <label><i class="fal fa-envelope"></i>  </label>
                                        <input type="text"  name="email" id="email" placeholder="Email Address*" value=""/>
                                        <textarea name="comments"  id="comments" cols="40" rows="3" placeholder="Your Message:"></textarea>
                                    </fieldset>
                                    <button class="btn float-btn color2-bg" id="submit">Send Message<i class="fal fa-paper-plane"></i></button>
                                    <div class="alert alert-success" role="alert" id="contactpagesuccessMsg" style="display: none" >
                                        Thank you for getting in touch!
                                    </div>
                                </form>
                            </div>
                            <!-- contact form  end--> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- about-wrap end  --> 
        </div>
    </section>
</div>

<!--content end-->
@endsection

