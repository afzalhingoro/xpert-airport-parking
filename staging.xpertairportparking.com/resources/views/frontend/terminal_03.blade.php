@extends('layouts.main')
<title>Manchester Airport Spaces Parking Terminal 3 - Stress Free Parking</title>
<meta name="description" content="Experience hassle-free and budget-friendly Terminal 3 parking at Heathrow Airport with Airport Deals Parking. Secure your spot today for a stress-free journey.">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@section('content')

@include('layouts.search_form')	

<section class="section-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-3-h2"><span class="span_blk_color">About Manchester</span> Terminal 3 </h2>
                <p class="section-3-p">
					{!! $page->content !!}
                </p>
                <!--<a href="{{url('heathrow-airport-parking')}}" > <button style="font-size: 20px;" type="submit" class="btn btn-primary btn-h1 btn-h2"><b style="font-weight: 500;">Read more</b></button></a>-->
            </div>
             <div class="col-lg-6 col-r">
                <img src="{{url('theme-new/img/Terminal_03_new.webp')}}" class="img-fluid img-h1 "  alt="image-1">
                <!--<img src="{{url('theme-new/img/Rectangle-1080.png')}}" class="img-fluid img-h1 img-h3"  alt="image-1">-->
                <!--<img src="{{url('theme-new/img/terml-3.webp')}}" class="img-fluid img-h1 img-h2 "  alt="image-1">-->
            </div>
        </div>
    </div>
</section>

<section class="filter-sect">
    <div class="container filterCont">
        <div class="row">
            <div class="col-lg-12">
                <div class="filter">
                  <button class="filter-btn active" data-target="#block-1">Overview </button>
                  <button class="filter-btn" data-target="#block-2">Faqs</button>
                  <button class="filter-btn" data-target="#block-3">Directions</button>
                  <button class="filter-btn" data-target="#block-4">Terminal Guide</button>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="block">
                    <div class="block-card active" id="block-1">
					  {!! $page->content2 !!}
					</div>
                    <div class="block-card" id="block-2">
					<h3 class="faqs-title">Can I book the Meet and Greet service at Terminal 3 on short notice?</h3>
					<p class="faqs-body"> Yes, you can book our Meet and Greet service for Terminal 3 on short notice, subject to availability. We recommend making your reservation as early as possible to secure your spot.</p>
					<h3 class="faqs-title">Is the Meet and Greet service at Terminal 3 suitable for families with young children?</h3>
					<p class="faqs-body">Absolutely, our Meet and Greet service at Terminal 3 is family-friendly. The shuttle service offers a convenient way to transfer to the terminal, making it a practical choice for families with young children and their belongings.</p>
					<h3 class="faqs-title">Can I use the On-Airport parking option for a weekend trip?</h3>
					<p class="faqs-body">Yes, our On-Airport parking at Terminal 3 is ideal for weekend getaways. With its proximity to the terminal, it offers a swift and hassle-free option for short stays, including weekend trips</p>
					<h3 class="faqs-title">Are there any restrictions on using the Drop Off Parking service at Terminal 3?</h3>
					<p class="faqs-body">While our Meet and Greet service for drop-offs at Terminal 3 is designed for convenience, we recommend checking our booking terms for any specific restrictions or guidelines to ensure a smooth experience.</p>
					<h3 class="faqs-title">Is the Pick Up Parking service available for all arriving flights at Terminal 3?</h3>
					<p class="faqs-body">Yes, our Meet and Greet service for Pick Up at Terminal 3 is available for all arriving flights. Your vehicle will be ready and waiting for you as soon as you land, ensuring a seamless transition from the aircraft to the road.</p>
					
					</div>
                    <div class="block-card" id="block-3">
					<iframe style="width:100%;height:380px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23924.31276091749!2d-2.27206015731379!3d53.36506508052429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487b206ad40474b9%3A0xe3d9774bc84a7b5!2sManchester%20Airport%20(Man)!5e0!3m2!1sen!2suk!4v1701615071264!5m2!1sen!2suk" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
                    <div class="block-card" id="block-4">
					  {!! $page->content3 !!}
					</div>
                    </div>
            </div>
        </div>
    </div>
</section>

<section id="section-b" class="section-b2 happyClients testimonial">
    <div class="container">
        <div class="row justify-content-center">
            <div class="section-heading">
                <h2 class="section-3-h2 text-center">Our Happy <span class="span_color"> Clients
                    </span></h2>
                @include('layouts.happy_clients')
            </div>
        </div>
    </div>
</section>

<script>
    let $blocks = $('.block-card');
	$('.filter-btn').on('click', e => {
	let $btn = $(e.target).addClass('active');
	$btn.siblings().removeClass('active');
	let selector = $btn.data('target');
	$blocks.removeClass('active').filter(selector).addClass('active');
	});
</script>
@endsection
