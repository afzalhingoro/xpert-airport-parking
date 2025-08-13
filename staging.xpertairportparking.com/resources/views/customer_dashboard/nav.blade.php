<div id="sidebar" class="active">

    <div class="sidebar-wrapper active">

        <div class="sidebar-header">

            <div class="d-flex justify-content-between">

                <div class="logo">

                    <a href=""><img src="{{ url('/') }}/assets/images/xpert_logo1.png" style="height:auto; width:100%;" alt="Logo" srcset=""></a>

                </div>

                <div class="toggler">

                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>

                </div>

            </div>

        </div>

        <div class="sidebar-menu">

            <ul class="menu">

                <li class="sidebar-title">Menu</li>



                <li class="sidebar-item active ">

                    <a href="{{ url('admin') }}" class='sidebar-link'>

                    <i class="bi bi-grid-fill"></i>

                    <span>Dashboard</span>

                </a>

                </li>






                <li class="sidebar-item  has-sub">

                    <a href="#" class='sidebar-link'>

                        <i class="bi bi-collection-fill"></i>

                        <span>Promo Codes</span>

                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item ">

                            <a href="{{ route('customer-discount-view') }}">Promo Codes List</a>

                        </li>

                        <li class="submenu-item ">

                            <a href="{{ route('customer-discount-add') }}">Add Promo Codes</a>

                        </li>

                    </ul>

                </li>



                <li class="sidebar-item  has-sub">

                    <a href="#" class='sidebar-link'>

                        <i class="bi bi-grid-1x2-fill"></i>

                        <span>Companies</span>

                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item ">

                            <a href="{{ route('customer-companies-view') }}">Companies List</a>

                        </li>

                        <li class="submenu-item ">

                            <a href="{{ route('customer-companies-add') }}">Add Company</a>

                        </li>

                    </ul>

                </li>

                <li class="sidebar-item  has-sub">

                    <a href="#" class='sidebar-link'>

                        <i class="bi bi-grid-1x2-fill"></i>

                        <span>Airports</span>

                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item ">

                            <a href="{{ route('customer-airport-view') }}">Airports List</a>

                        </li>

                        <li class="submenu-item ">

                            <a href="{{ route('customer-airport-add') }}">Add Airport</a>

                        </li>

                    </ul>

                </li>

                <li class="sidebar-item ">

                    <a href="{{ route('customer-subscribers-view') }}" class="sidebar-link">

                        <i class="bi bi-envelope-fill"></i>

                        <span>Subscribers</span>
                        

                    </a>

                </li>

                <li class="sidebar-title">Logout</li>

                @if (Auth::guest())

                @else

                    

                <li class="sidebar-item  has-sub">

                    <a href="#" class='sidebar-link'>

                        <i class="bi bi-person-badge-fill"></i>

                        <span>{{ Auth::guard('customer')->user()->name }}</span>

                    </a>

                    <ul class="submenu ">

                        <li class="submenu-item ">

                            <a href="{{ route('logout') }}"

                                    onclick="event.preventDefault();

                                             document.getElementById('logout-form').submit();">Logout</a>

                            

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                                {{ csrf_field() }}

                            </form>

                        </li>

                        

                    </ul>

                </li>

                @endif











            </ul>

        </div>

        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>

    </div>

</div>

 