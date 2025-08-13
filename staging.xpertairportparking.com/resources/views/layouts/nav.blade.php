<style>
    #navbarNavDropdown .loyalty-program a.nav-link {
        background: black;
        color: white !important;
        display: inline-block;
        border-radius: 5px;
        padding: 4px 30px;
        width: 210px;
        margin-top: 7px;
        text-align: center;
    }
    #navbarNavDropdown .create-ticket a.nav-link {
        background: #714a97;
        color: white !important;
        display: inline-block;
        border-radius: 5px;
        padding: 4px 30px;
        width: 210px;
        margin-top: 15px;
        text-align: center;
    }

    @media(min-width: 1200px) {
        #navbarNavDropdown .loyalty-program a.nav-link, #navbarNavDropdown .create-ticket a.nav-link {
            display: none;
        }
    }
</style>

<section class="top-bar-section d-none d-md-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 topheader">
                <span class="span-1"><i class="fa-regular fa-envelope"></i> <a href="mailto:helpdesk@xpertairportparking.com">
                                 helpdesk@xpertairportparking.com 

                                </a></span>
                <span class="span-2"><i class="fa-solid fa-phone"></i><a href="tel: 020 3386 1809">

                           

                                    020 3386 1809

                                </a></span>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-6 buttonContainer">
                <div class="top_button_cont">
                                <a href="{{ url('support') }}">
                                    <button type="submit" class="bg-white btn create-ticket-btn dtbtn py-1 text-black"><b>Create Ticket</b></button>
                                </a>      
                                @if (!Auth::guard('customer')->user())
                                    <a href="{{ url('rewards-and-loyalty') }}"><button  type="submit"
                                        class="btn dtbtn loyalty-reward-btn py-1 text-black bg-white "><b>Loyalty Rewards</b></button></a>
                                @endif

                                @if (Auth::guard('customer')->user())
                                    <nav class="navbar navbar-expand-lg">
                                        <div class="container-fluid">
                                            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                                <ul class="navbar-nav">
                                                    <li class="nav-item dropdown pt-0">
                                                        <a class="nav-link dropdown-toggle"
                                                            href="javascript:void(0)" role="button" data-bs-toggle="dropdown"
                                                            aria-expanded="false"
                                                            >
                                                            <i class="fa fa-solid fa-user" ></i>
                                                            <?php /* <span style="font-size: 19px;">Welcome</span>
                                                            {{ Auth::guard('customer')->user()->last_name }}
                                                            */ ?>
                                                        </a>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('customer-admin') }}">Dashboard</a></li>
                                                            <li><a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </nav>
                                @endif
                            </div>
            </div>
        </div>
    </div>
</section>
<section id="header" class="">
    <div class="container">
        <div class="row justify-content-center">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img  style="width: 140px;" src="{{ url('theme-new/img/xpert-logo-v2.png') }}" alt="small-new-logo Logo">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                        <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 18L20 18" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            <path d="M4 12L20 12" stroke="white" stroke-width="2" stroke-linecap="round"/>
                            <path d="M4 6L20 6" stroke="white" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                     <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ url('xpert-park-and-ride') }}">Park & Ride</a>
                            </li>
                                                    
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route("page",["slug"=>"stansted-airport-parking"]) }}">Stansted Airport</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('how-it-works') }}">How it Works</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">Business Parking</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('about-us') }}">About</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" href="{{ url('reviews') }}">Reviews</a>
                            </li> -->
                            <li class="nav-item loyalty-program">
                                <a class="nav-link" href="{{ url('rewards-and-loyalty') }}">Loyalty Rewards</a>
                            </li>
                            <li class="nav-item create-ticket">
                                <a class="nav-link" href="{{ url('support') }}">Create Ticket</a>
                            </li>
 
                            

                          
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</section>
