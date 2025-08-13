<div class="info-hide"
    style="display:none;background:rgb(232, 242, 250,0.8);    background-size: cover;height:100%;width:100%;position:absolute;z-index:99">
    <center>
        <div class="loader"></div>
    </center>
</div>
<div id="sidebar" class="sidebar responsive ace-save-state">


    @php
        $role = auth::user()
            ->with('roles', 'roles.role')
            ->where('id', auth::id())
            ->first();
        $role->roles->role->name;
    @endphp

    <ul class="nav nav-list">
        <li class="dashboard_link @if (Route::currentRouteName() == '') {{ 'active' }} @endif">
            <a href="{{ url('/admin') }}">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
            <b class="arrow"></b>
        </li>
        @can('menu_auth', ['Administrators'])
            <li class="administrators_link @if (Route::currentRouteName() == 'user_list') {{ 'active' }} @endif">
                <a href="{{ route('user_list') }}">
                    <i class="menu-icon fa fa-group"></i>
                    <span class="menu-text">
                        Administrators
                    </span>
                </a>
            </li>
        @endcan
        @can('menu_auth', ['Airport Parkings'])
            <li class='@if (Route::currentRouteName() == 'add-booking' ||
                    Route::currentRouteName() == 'booking' ||
                    Route::currentRouteName() == 'booking_agent' ||
                    Route::currentRouteName() == 'allBookings' ||
                    Route::currentRouteName() == 'valetPlan' ||
                    Route::currentRouteName() == 'print-card' ||
                    Route::currentRouteName() == 'incomplete_Booking' ||
                    Route::currentRouteName() == 'add-booking' ||
                    Route::currentRouteName() == 'booking' ||
                    Route::currentRouteName() == 'incomplete_Booking' ||
                    Route::currentRouteName() == 'searchForm' ||
                    Route::currentRouteName() == 'airport_commission_report' ||
                    Route::currentRouteName() == 'company_report' ||
                    Route::currentRouteName() == 'bookinghistroy' ||
                    Route::currentRouteName() == 'company_setting' ||
                    Route::currentRouteName() == 'awards.index' ||
                    Route::currentRouteName() == 'airport.index' ||
                    Route::currentRouteName() == 'plan.create' ||
                    Route::currentRouteName() == 'setPlan' ||
                    Route::currentRouteName() == 'viewEditPlan' ||
                    Route::currentRouteName() == 'viewEditPlan') {{ 'open' }} @endif'>
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> Daily Operations</span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                @can('menu_auth', ['Booking'])
                    <ul class="submenu">
                        <li class='@if (Route::currentRouteName() == 'add-booking' ||
                                Route::currentRouteName() == 'booking' ||
                                Route::currentRouteName() == 'print-card' ||
                                Route::currentRouteName() == 'booking_agent' ||
                                Route::currentRouteName() == 'allBookings' ||
                                Route::currentRouteName() == 'incomplete_Booking' ||
                                Route::currentRouteName() == 'add-booking' ||
                                Route::currentRouteName() == 'booking' ||
                                Route::currentRouteName() == 'incomplete_Booking' ||
                                Route::currentRouteName() == 'searchForm' ||
                                Route::currentRouteName() == 'airport_commission_report' ||
                                Route::currentRouteName() == 'company_report' ||
                                Route::currentRouteName() == 'bookinghistroy') {{ 'open' }} @endif'>

                            <a href="#" class="dropdown-toggle">

                                <i class="menu-icon fa fa-list"></i>

                                <span class="menu-text"> Booking </span>

                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                @can('menu_auth', ['Booking List'])
                                    <li class="@if (Route::currentRouteName() == 'booking') {{ 'active' }} @endif">
                                        <a href="{{ route('booking') }}">
                                            Booking List
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                @endcan
                                @can('menu_auth', ['Agent Booking'])
                                    <li class="@if (Route::currentRouteName() == 'booking_agent') {{ 'active' }} @endif">
                                        <a href="{{ route('booking_agent') }}">
                                            Agent Booking List
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                @endcan
                                
                                @can('menu_auth', ['All Booking'])
                                    <li class="@if (Route::currentRouteName() == 'allBookings') {{ 'active' }} @endif">
                                        <a href="{{ route('allBookings') }}">
                                            All Booking List
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                @endcan
                               
                                @can('menu_auth', ['Add Booking'])
                                    <li class="@if (Route::currentRouteName() == 'add-booking') {{ 'active' }} @endif">
                                        <a href="{{ route('add-booking') }}">
                                            Add Booking
                                        </a>
                                        <b class="arrow"></b>
                                    </li>
                                @endcan
                                @can('menu_auth', ['Incomplete Booking'])
                                    <li class="@if (Route::currentRouteName() == 'incomplete_Booking') {{ 'active' }} @endif">
                                        <a href="{{ route('incomplete_Booking') }}">
                                            <span class="menu-text">
                                                Incomplete Booking
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                
                            </ul>
                        </li>
                    @endcan
                    @can('menu_auth', ['Print Cards'])
                                    <li class="@if (Route::currentRouteName() == 'print-card') {{ 'active' }} @endif">
                                        <a href="{{ route('print-card') }}">
                                        Print Cards
                                        </a>
                                     </li>
                                @endcan
                  
                    @can('menu_auth', ['Price Plan'])
                        <li class='@if (Route::currentRouteName() == 'plan.create' ||
                                Route::currentRouteName() == 'setPlan' ||
                                Route::currentRouteName() == 'valetPlan' ||
                                Route::currentRouteName() == 'viewEditPlan' ||
                                Route::currentRouteName() == 'viewEditPlan') {{ 'open' }} @endif'>
                            <a href="#" class="dropdown-toggle">
                                <i class="menu-icon fa fa-list"></i>
                                <span class="menu-text"> Price Plan</span>
                                <b class="arrow fa fa-angle-down"></b>
                            </a>
                            <b class="arrow"></b>
                            <ul class="submenu">
                                @can('menu_auth', ['Plan Setting'])
                                    <li class="@if (Route::currentRouteName() == 'plan.create') {{ 'active' }} @endif">
                                        <a href="{{ route('plan.create') }}">
                                            <span class="menu-text">
                                                Plan Setting
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('menu_auth', ['Set Plan'])
                                    <li class="@if (Route::currentRouteName() == 'setPlan') {{ 'active' }} @endif">
                                        <a href="{{ route('setPlan') }}">
                                            <span class="menu-text">
                                                Set Plan
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                                @can('menu_auth', ['viewedit Plan'])
                                    <li class="@if (Route::currentRouteName() == 'viewEditPlan') {{ 'active' }} @endif">
                                        <a href="{{ route('viewEditPlan') }}">
                                            <span class="menu-text">
                                                View / Edit Plan
                                            </span>
                                        </a>
                                    </li>
                                    <li class="@if (Route::currentRouteName() == 'valetPlan') {{ 'active' }} @endif">
                                        <a href="{{ route('valetPlan') }}">
                                            <span class="menu-text">
                                                Valet Pricing Plan
                                            </span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                    @can('menu_auth', ['Company Setting'])
                    @endcan
                </ul>
            </li>
        @endcan
        @can('menu_auth', ['Reports'])
            <li class='@if (Route::currentRouteName() == 'departure_Booking' ||
                    Route::currentRouteName() == 'arrival_Booking' ||
                    Route::currentRouteName() == 'pickup.bookings' ||
                    Route::currentRouteName() == 'not.picked.returned' ||
                    Route::currentRouteName() == 'net.earnings' ||
                    Route::currentRouteName() == 'gross.earnings' ||
                    Route::currentRouteName() == 'valet_Booking' ||
                    Route::currentRouteName() == 'day_wise_Booking' ||
                    Route::currentRouteName() == 'Overnight_Booking' ||
                    Route::currentRouteName() == 'capacity.report' ||
                         Route::currentRouteName() == 'agent.statis' ||
                    Route::currentRouteName() == 'supplier.segregation.report' ||
                    Route::currentRouteName() == 'invoice_commission_report') {{ 'open' }} @endif'>
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon     fa fa-newspaper-o"></i>
                    <span class="menu-text">Reports </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    @can('menu_auth', ['Departure Report'])
                        <li class="@if (Route::currentRouteName() == 'departure_Booking') {{ 'active' }} @endif">
                            <a href="{{ route('departure_Booking') }}">
                                <span class="menu-text">
                                    Departure/Return Report
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Return Report'])
                        <!--<li class="@if (Route::currentRouteName() == 'arrival_Booking') {{ 'active' }} @endif">-->
                        <!--    <a href="{{ route('arrival_Booking') }}">-->
                        <!--        <span class="menu-text">-->
                        <!--            Return-->
                        <!--        </span>-->
                        <!--    </a>-->
                        <!--</li>-->

                        <!--<li class="@if (Route::currentRouteName() == 'pickup.bookings') {{ 'active' }} @endif">-->
                        <!--    <a href="{{ route('pickup.bookings') }}">-->
                        <!--        <span class="menu-text">-->
                        <!--            Pickup-->
                        <!--        </span>-->
                        <!--    </a>-->
                        <!--</li>-->

                        <li class="@if (Route::currentRouteName() == 'not.picked.returned') {{ 'active' }} @endif">
                            <a href="{{ route('not.picked.returned') }}">
                                <span class="menu-text">
                                    Not Picked Up / Returned
                                </span>
                            </a>
                        </li>

                        <li class="@if (Route::currentRouteName() == 'net.earnings') {{ 'active' }} @endif">
                            <a href="{{ route('net.earnings') }}">
                                <span class="menu-text">
                                    Net earnings
                                </span>
                            </a>
                        </li>
                        <!--<li class="@if (Route::currentRouteName() == 'gross.earnings') {{ 'active' }} @endif">-->
                        <!--    <a href="{{ route('gross.earnings') }}">-->
                        <!--        <span class="menu-text">-->
                        <!--            Gross earnings-->
                        <!--        </span>-->
                        <!--    </a>-->
                        <!--</li>-->
                    @endcan
                    @can('menu_auth', ['Valet Request Report'])
                        <!--<li class="@if (Route::currentRouteName() == 'valet_Booking') {{ 'active' }} @endif">--> 
                        <!--    <a href="{{ route('valet_Booking') }}">--> 
                        <!--        <span class="menu-text">--> 
                        <!--            Valet Request Report-->  
                        <!--        </span>--> 
                        <!--    </a>--> 

                        <!--</li>-->
                    @endcan
                    @can('menu_auth', ['Price Statistics Report'])
                        <li class="@if (Route::currentRouteName() == 'day_wise_Booking') {{ 'active' }} @endif">
                            <a href="{{ route('day_wise_Booking') }}">
                                <span class="menu-text">
                                    Price Statistics Report
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Over Night'])
                        <li class="@if (Route::currentRouteName() == 'Overnight_Booking') {{ 'active' }} @endif">
                            <a href="{{ route('capacity.report') }}" onClick="hideText()" id="info">
                                <span class="menu-text">
                                    Capacity 
                                </span>
                            </a>
                        </li>
                    @endcan
                    <!--<button id="info" onClick="hideText()"><img src="//i.imgur.com/45PUhN3.png"/></button>-->
                    @can('menu_auth', ['Operations Invoices'])
                        <li class="@if (Route::currentRouteName() == 'invoice_commission_report') {{ 'active' }} @endif">
                        <li>
                            <a href="{{ route('invoice_commission_report') }}">
                                <span class="menu-text">
                                    Agent Invoice Report
                                </span>
                            </a>
                        </li>
                    @endcan


                    <!--<li class="@if (Route::currentRouteName() == 'capacity.report') {{ 'active' }} @endif">-->
                    <!--    <a href="{{ route('capacity.report') }}" onClick="hideText()" id="info">-->
                    <!--        <span class="menu-text">-->
                    <!--            Capacity-->
                    <!--        </span>-->
                    <!--    </a>-->
                    <!--</li>-->

                    <li class="@if (Route::currentRouteName() == 'supplier.segregation.report') {{ 'active' }} @endif">
                        <a href="{{ route('supplier.segregation.report') }}" onClick="hideText()" id="info">
                            <span class="menu-text">
                                Supplier Segregation
                            </span>
                        </a>
                    </li>
                    <li class="@if (Route::currentRouteName() == 'agent.statis') {{ 'active' }} @endif">
                        <li>
                            <a href="{{ route('agent.statis') }}">
                                <span class="menu-text">
                                Agent Invoice
                                </span>
                            </a>
                        </li>



                </ul>
            </li>
        @endcan <!--  reports full menu  -->
        @can('menu_auth', ['Settings'])
            <li class='@if (Route::currentRouteName() == 'company.index' ||
                    Route::currentRouteName() == 'company_setting' ||
                    Route::currentRouteName() == 'subscribers.index' ||
                    Route::currentRouteName() == 'footer_setting' ||
                    Route::currentRouteName() == 'analytics_setting' ||
                    Route::currentRouteName() == 'reviews.index' ||
                    Route::currentRouteName() == 'customers.index' ||
                    Route::currentRouteName() == 'email_setting' ||
                    Route::currentRouteName() == 'emails.index' ||
                    Route::currentRouteName() == 'seo_setting' ||
                    Route::currentRouteName() == 'discounts.index' ||
                    Route::currentRouteName() == 'pages.index' ||
                    Route::currentRouteName() == 'faqs.index' ||
                    Route::currentRouteName() == 'banner_list' ||
                    Route::currentRouteName() == 'social_setting' ||
                    Route::currentRouteName() == 'general_setting' ||
                    Route::currentRouteName() == 'homepage_setting' ||
                    Route::currentRouteName() == 'services_page_setting') {{ 'open' }} @endif'>
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-list"></i>
                    <span class="menu-text"> All Settings </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                     @can('menu_auth', ["OFF Day Management"])
         <li class="@if(Route::currentRouteName()=="offDays" || Route::currentRouteName()=="adminWise") {{ "open"  }} @endif">
         <a href="#" class="dropdown-toggle">
         <i class="menu-icon fa fa-list"></i>
         <span class="menu-text"> OFF Day Management</span>
         <b class="arrow fa fa-angle-down"></b>
         </a>
         <b class="arrow"></b>
         <ul class="submenu">
            <li class="@if(Route::currentRouteName()=="offDays") {{ "active"  }} @endif">
            <a href="{{ route('offDays') }}">
            <i class="menu-icon fa fa-cogs"></i>
            <span class="menu-text">Manage Days</span>
            </a>
            </li>
         </ul>
         </li>
         @endcan
                    @can('menu_auth', ['Subscribers'])


                        <li class='@if (Route::currentRouteName() == 'company.index') {{ 'active' }} @endif'>
                            <a href="{{ route('company.index') }}">
                                <!--<i class="menu-icon fa fa-building"></i>-->
                                <span class="menu-text">
                                    Companies
                                </span>
                            </a>
                        </li>
                        @can('menu_auth', ['Setting'])
                            <li class="@if (Route::currentRouteName() == 'company_setting') {{ 'active' }} @endif">
                                <a href="{{ route('company_setting') }}">
                                    <i class="menu-icon fa fa-wrench"></i>
                                    Setting
                                </a>
                                <b class="arrow"></b>
                            </li>
                        @endcan


                        <li class='@if (Route::currentRouteName() == 'subscribers.index') {{ 'active' }} @endif'>



                            <a href="{{ route('subscribers.index') }}">



                                <i class="menu-icon fa fa-users"></i>



                                <span class="menu-text">



                                    Subscribers



                                </span>







                            </a>



                        </li>

                        <li class="@if (Route::currentRouteName() == 'customers.index') {{ 'active' }} @endif">
                            <a href="{{ route('customers.index') }}">
                                <i class="menu-icon fa fa-users"></i>
                                <span class="menu-text">
                                    Customers
                                </span>
                            </a>
                        </li>


                    @endcan
                    @if ($role->roles->role->name == 'SuperAdmin')
                        @can('menu_auth', ['Email Settings'])
                            <li class='@if (Route::currentRouteName() == 'email_setting') {{ 'active' }} @endif'>
                                <a href="{{ route('email_setting') }}">
                                    <i class="menu-icon fa fa-clipboard-list"></i>
                                    <span class="menu-text">
                                        Email Settings
                                    </span>
                                </a>
                            </li>
                        @endcan
                    @endif
                    @can('menu_auth', ['Email Templates'])
                        <li class='@if (Route::currentRouteName() == 'emails.index') {{ 'active' }} @endif'>



                            <a href="{{ route('emails.index') }}">



                                <i class="menu-icon fa fa-clipboard-list"></i>



                                <span class="menu-text">



                                    Email Templates



                                </span>







                            </a>



                        </li>
                    @endcan
                    @can('menu_auth', ['Seo Settings'])
                        <li class='@if (Route::currentRouteName() == 'seo_setting') {{ 'active' }} @endif'>



                            <a href="{{ route('seo_setting') }}">



                                <i class="menu-icon fa fa-list"></i>







                                Seo Settings











                            </a>







                            <b class="arrow"></b>







                        </li>
                    @endcan
                    @can('menu_auth', ['Discount Codes'])
                        <li class='@if (Route::currentRouteName() == 'discounts.index') {{ 'active' }} @endif manage_discount'>



                            <a href="{{ route('discounts.index') }}">



                                <i class="menu-icon fa fa-clipboard-list"></i>



                                <span class="menu-text">



                                    Discount Codes



                                </span>







                            </a>



                        </li>
                    @endcan
                    @can('menu_auth', ['Pages'])
                        <li class='@if (Route::currentRouteName() == 'pages.index') {{ 'active' }} @endif'>



                            <a href="{{ route('pages.index') }}">



                                <i class="menu-icon fa fa-cogs"></i>



                                <span class="menu-text">



                                    Text Pages



                                </span>







                            </a>



                        </li>
                    @endcan
                    @can('menu_auth', ['Faqs'])
                        <li class='@if (Route::currentRouteName() == 'faqs.index') {{ 'active' }} @endif'>
                            <a href="{{ route('faqs.index') }}">
                                <i class="menu-icon fa fa-cogs"></i>
                                <span class="menu-text">
                                    Frequently Ask Questions
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Banner'])
                        <li class="@if (Route::currentRouteName() == 'banner_list') {{ 'active' }} @endif">
                            <a href="{{ route('banner_list') }}">
                                <i class="menu-icon fa fa-clipboard-list"></i>
                                <span class="menu-text">
                                    Banners
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Reviews'])
                        <li class="@if (Route::currentRouteName() == 'reviews.index') {{ 'active' }} @endif">
                            <a href="{{ route('reviews.index') }}">
                                <i class="menu-icon fa fa-clipboard-list"></i>
                                <span class="menu-text">
                                    Reviews
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Analytics Settings'])
                        <li class="@if (Route::currentRouteName() == 'analytics_setting') {{ 'active' }} @endif">
                            <a href="{{ route('analytics_setting') }}">
                                <i class="menu-icon fa fa-clipboard-list"></i>
                                <span class="menu-text">
                                    Site Analytics
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Social Settings'])
                        <li class="@if (Route::currentRouteName() == 'social_setting') {{ 'active' }} @endif">
                            <a href="{{ route('social_setting') }}">
                                <i class="menu-icon fa fa-clipboard-list"></i>
                                <span class="menu-text">
                                    Social Settings
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Supportticket'])
                    @endcan
                    @can('menu_auth', ['General Settings'])
                        <li class='@if (Route::currentRouteName() == 'general_setting') {{ 'active' }} @endif'>
                            <a href="{{ route('general_setting') }}">
                                <i class="menu-icon fa fa-clipboard-list"></i>
                                <span class="menu-text">
                                    General Settings
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Footer Settings'])
                        <li class='@if (Route::currentRouteName() == 'footer_setting') {{ 'active' }} @endif'>
                            <a href="{{ route('footer_setting') }}">
                                <i class="menu-icon fa fa-clipboard-list"></i>
                                <span class="menu-text">
                                    Footer Settings
                                </span>
                            </a>
                        </li>
                    @endcan
                    @can('menu_auth', ['Homepage Settings'])
                    @endcan
                    @can('menu_auth', ['Service Pages Settings'])
                    @endcan
                </ul>
            </li>
        @endcan
        @can('menu_auth', ['Bussiness Portal'])
        @endcan
        @can('menu_auth', ['Ticketing System'])
            <li class="ticketing_link @if (Route::currentRouteName() == 'myticket') {{ 'open' }} @endif">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon     fa fa-newspaper-o"></i>
                    <span class="menu-text">Ticketing System </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu">
                    <li class='@if (Route::currentRouteName() == 'myticket') {{ 'active' }} @endif'>
                        <a href="{{ route('myticket') }}">
                            <i class="menu-icon fa fa-cogs"></i>
                            <span class="menu-text">
                                View Ticket
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('menu_auth', ['Parsed Emails'])
            <li class="ticketing_link @if(Route::currentRouteName() == 'parsed.emails.report' || Route::currentRouteName() == 'parsed_emails') {{'open'}} @endif">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon     fa fa-newspaper-o"></i>
                    <span class="menu-text">Parsed Emails </span>
                    <b class="arrow fa fa-angle-down"></b>
                </a>
                <b class="arrow"></b>
                <ul class="submenu @if(Route::currentRouteName() == 'parsed.emails.report' || Route::currentRouteName() == 'parsed_emails') {{'nav-show'}} @endif">
                    <li class='@if (Route::currentRouteName() == 'parsed_emails') {{ 'active' }} @endif'>
                        <a href="{{ route('parsed_emails') }}">
                            <i class="menu-icon fa fa-cogs"></i>
                            <span class="menu-text">
                                View Emails
                            </span>
                        </a>
                    </li>
                    <li class="@if (Route::currentRouteName() == 'parsed.emails.report') {{ 'active' }} @endif">
                        <a href="{{ route('parsed.emails.report') }}">
                            <span class="menu-text">
                               View Report
                            </span>
                        </a>
                    </li>
                     
                </ul>
                
            </li>
        @endcan
        <li class=" @if (Route::currentRouteName() == 'api_client') {{ 'active' }} @endif">
            
            <a href="{{ route('api_client') }}">
            <i class="menu-icon fa fa-group"></i>

                 <span class="menu-text">Pricing API Client</span>
            </a>
        </li>
    </ul>
    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
            data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>
