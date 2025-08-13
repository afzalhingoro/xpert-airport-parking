<div id="sidebar" class="active">

    <div class="sidebar-wrapper active">

        <div class="sidebar-header">

            <div class="d-flex justify-content-center">

                <div class="logo">

                    <a href="{{ route('main') }}">
                        <img src="{{ url('/') }}/theme-new/img/xpert_logo1.png"
                            style="height:auto; width:100%;" alt="Logo" srcset="">
                    </a>
                </div>

                <div class="toggler">

                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>

                </div>

            </div>

        </div>

        <div class="sidebar-menu">

            <ul class="menu">

                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item @if (Route::currentRouteName() == 'customer-admin') {{ 'active' }} @endif">
                    <a href="{{ url('/customer/admin') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>

                </li>

                {{-- <li class="sidebar-item ">

                    <a href="{{ route('customer-manage-booking') }}" class="sidebar-link">

                        <!-- <i class="bi bi-envelope-fill"></i> -->
                        <i class="bi bi-clipboard-data"></i>

                        <span>Manage Booking</span>

                    </a>

                </li> --}}

                <li class="sidebar-item @if (Route::currentRouteName() == 'customer-manage-history') {{ 'active' }} @endif ">

                    <a href="{{ route('customer-manage-history') }}" class="sidebar-link">

                        <!-- <i class="bi bi-envelope-fill"></i> -->
                        <i class="bi bi-clock-history"></i>

                        <span>Booking History</span>

                    </a>

                </li>


                <li class="sidebar-item @if (Route::currentRouteName() == 'customer-support-tickets' || Route::currentRouteName() == 'customer.ticket.view') {{ 'active' }} @endif ">

                    <a href="{{ route('customer-support-tickets') }}" class="sidebar-link">

                        <!-- <i class="bi bi-envelope-fill"></i> -->
                        <i class="bi bi-telephone"></i>

                        <span>Support Tickets</span>

                    </a>

                </li>
                
                <!--<li class="sidebar-item @if (Route::currentRouteName() == 'customer-support-tickets' || Route::currentRouteName() == 'customer.ticket.view') {{ 'active' }} @endif ">-->

                <!--    <a href="{{ url('/') }}" class="sidebar-link">-->

                        <!-- <i class="bi bi-envelope-fill"></i> -->
                <!--        <i class="bi bi-house"></i>-->

                <!--        <span>Main Page</span>-->

                <!--    </a>-->

                <!--</li>-->



                <!--<li class="sidebar-title">Logout</li>-->

                @if (Auth::guard('customer')->guest())
                @else
                    <li class="sidebar-item  has-sub">

                        <a href="#" class='sidebar-link'>

                            <i class="bi bi-person-badge-fill"></i>

                            <span>{{ Auth::guard('customer')->user()->first_name . ' ' . Auth::guard('customer')->user()->last_name }}</span>

                        </a>

                        <ul class="submenu ">

                            <li class="submenu-item ">
                                <a href="{{ route('logout') }}">Logout</a>
                            </li>



                        </ul>

                    </li>
                @endif











            </ul>

        </div>

        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

    </div>

</div>
