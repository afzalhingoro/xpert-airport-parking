@extends('layouts.main')
<title>Manchester Parking Terminal 2 | Manchester Airport Spaces</title>
<meta name="description" content="Grab Budget-Friendly Manchester Terminal 2 Parking with Manchester Airport Spaces - Your Convenient Travel Choice">
@section('content')

@include('layouts.search_form')	

<section class="section-3 aboutManchester">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="section-3-h2"><span class="span_blk_color">About Manchester</span> Terminal 2 </h2>
                <p class="section-3-p">
                    {!! $page->content !!}
                </p>
            </div>
        </div>
    </div>
</section>
<section class="filter-sect ">
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
						<h3 class="faqs-title">How do I avail the Meet and Greet service at Terminal 2?</h3>
						<p class="faqs-body">Availing our Meet and Greet service at Terminal 2 is simple. When making your booking on our website, select the Meet and Greet option. Our professional chauffeurs will be alerted, ensuring a seamless experience from the terminal entrance to your vehicle.</p>
						<h3 class="faqs-title">Is the Meet and Greet service at Terminal 2 available round the clock?</h3>
						<p class="faqs-body">Yes, our Meet and Greet service at Terminal 2 operates 24/7, offering you a reliable parking solution no matter when your flight departs or arrives.</p>

						<h3 class="faqs-title">Can I use the On-Airport parking option for a longer trip?</h3>
						<p class="faqs-body">While our On-Airport parking is ideally suited for short stays due to its proximity, if you're planning an extended journey, we recommend considering our Meet and Greet service for secure parking and shuttle service.</p>
						<h3 class="faqs-title">Is there a time limit for using the Drop Off Parking service?</h3>
						<p class="faqs-body"> Our Meet and Greet service for swift drop-offs at Terminal 2 ensures you can swiftly hand over your vehicle. However, we recommend checking our booking terms for specific time limits to make the most of this convenient service.</p>
						<h3 class="faqs-title">Can I modify my pre-booked parking reservation for Terminal 2?</h3>
						<p class="faqs-body">Yes, you can easily modify your booking details online. Whether your travel plans change or you require adjustments, our website offers a user-friendly way to manage your reservation. Please check our booking terms for any modification deadlines.</p>
					
					</div>
                      <div class="block-card" id="block-3">
					  <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23924.31276091749!2d-2.27206015731379!3d53.36506508052429!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x487b206ad40474b9%3A0xe3d9774bc84a7b5!2sManchester%20Airport%20(Man)!5e0!3m2!1sen!2suk!4v1701615071264!5m2!1sen!2suk" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
                      <div class="block-card" id="block-4">
					  {!! $page->content3 !!}
					</div>
                      <!--<div class="block-card" id="block-5"><p>Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac.-->
                      <!--  <br>Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac.<br>-->
                      <!--  Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac. Bibendum sagittis pellentesque et lectus mattis eu diam.Lorem ipsum dolor sit amet consectetur. Mauris in nunc molestie elit. Proin volutpat enim nisl est et commodo mattis proin. Orci ultricies dictum habitant ac.-->
                      <!--  </p></div>-->
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

<!--<p style="text-align:left">-->
<!--Terminal 2, also known as The Queen's Terminal, is one of the passenger terminals at London Manchester Airport. It's one of the major terminals serving the airport, and it has undergone significant renovations and improvements in recent years. Here's some information about Manchester Terminal 2:-->

<!--Opening and Redevelopment: Terminal 2 was originally opened in 1955 and operated as the airport's oldest terminal building. However, due to the need for modernization and expansion, the original Terminal 2 was closed in 2009 to undergo a complete redevelopment and reconstruction.-->

<!--The Queen's Terminal: The new Terminal 2, often referred to as "The Queen's Terminal" in honor of Queen Elizabeth II, was officially opened in stages starting in 2014. The redevelopment project aimed to provide state-of-the-art facilities and an improved passenger experience.-->

<!--Design and Facilities: The new Terminal 2 was designed to offer a more efficient and modern layout. It features spacious check-in areas, security and immigration facilities, departure lounges, retail and dining options, as well as enhanced baggage handling systems. The terminal's design focused on providing a seamless and pleasant journey for passengers.-->

<!--Airlines: Terminal 2 primarily serves as a hub for Star Alliance member airlines, although it also hosts other carriers. Star Alliance is one of the world's largest airline alliances, and Terminal 2's layout and facilities are designed to accommodate the needs of its member airlines and their passengers.-->

<!--Environmental Considerations: The redevelopment of Terminal 2 included efforts to improve environmental sustainability. The building incorporates various energy-efficient and environmentally friendly features, aligning with broader goals to reduce the airport's carbon footprint.-->

<!--Expansion and Capacity: The new Terminal 2 was built with expansion in mind, aiming to cater to the growing number of passengers traveling through Manchester Airport. The terminal was designed to be able to handle increasing passenger traffic while maintaining high levels of service.-->
<!--</p>-->
@endsection
