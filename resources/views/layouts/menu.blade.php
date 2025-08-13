<div id="header-bottom">

    <nav class="navbar navbar-default transparent-nav navbar-custom black-menu" id="mynavbar" style="    padding: 32px">

        <div class="container">

            <div class="navbar-header">

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar1">

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                </button>

                <a href="{{ route("main") }}"> <img style="height: 50px;" src="{{ secure_asset("assets/images/logo2.png") }}"  /></a>

                {{--<a href="#" class="navbar-brand"><span>PARKING</span>ZONE</a>--}}

            </div><!-- end navbar-header -->



            <div class="collapse navbar-collapse" id="myNavbar1">

                <ul class="nav navbar-nav navbar-right">

                    <li class="dropdown active"><a href="{{ route("main") }}" class="dropdown-toggle" >Home</a></li>







                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Airport Parking<span><i class="fa fa-angle-down"></i></span></a>

                    <ul class="dropdown-menu">

                    <li><a href="{{ route("page",["slug"=>"gatwick-airport-parking"]) }}">Gatwick Airport Parking</a></li>

                        <li><a href="{{ route("page",["slug"=>"heathrow-airport-parking"]) }}">Heathrow Airport Parking</a></li>

                        <li><a href="{{ route("page",["slug"=>"stansted-airport-parking"]) }}">Stansted Airport Parking</a></li>

                        <li><a href="{{ route("page",["slug"=>"birmingham-airport-parking"]) }}">Birmingham Airport Parking</a></li>

                        <li><a href="{{ route("page",["slug"=>"edinburgh-airport-parking"]) }}">Edinburgh Airport Parking</a></li>

                        <li><a href="{{ route("page",["slug"=>"southampton-airport-parking"]) }}">Southampton Airport Parking</a></li>

                        <li><a href="{{ route("page",["slug"=>"liverpool-airport-parking"]) }}">Liverpool Airport Parking</a></li>

                        <li><a href="{{ route("page",["slug"=>"luton-airport-parking"]) }}">Luton Airport Parking</a></li>

                        <li><a href="{{ route("page",["slug"=>"manchester-airport-parking"]) }}">Manchester Airport Parking</a></li>

                        @if(count($airports) > 9)

                        <li><a style="background: #1d9cbc; text-align:center" href="{{ route("airports") }}"> {{ count($airports)-9 }} More Choices </a></li>

                        @endif

                    </ul>



                    <li class="dropdown "><a href="{{ route("faqs") }}" class="dropdown-toggle" >FAQ</a></li>

                    <li class="dropdown "><a href="{{ route("static_page",["page"=>"terms-and-conditions"]) }}" class="dropdown-toggle" >Terms & condition</a></li>

                    {{--<li class="dropdown "><a href="{{ route("main") }}" class="dropdown-toggle" >Contact us</a></li>--}}

                    <li class="dropdown"><a href="{{ route("reviews") }}" class="dropdown-toggle" >Reviews</a></li>



                    </li>




 

                    {{--<li><a href="reservation-right-sidebar.html">Book Now</a></li>--}}

                </ul>

            </div><!-- end navbar collapse -->

        </div><!-- end container -->

    </nav><!-- end navbar -->

</div><!-- end header-bottom -->