@extends('customer_dashboard.layouts.master')
<style>
    .stats-icon {
        padding-top: 4px !important;
    }

    .help-tip {
        position: relative;
        top: -14px;
        left: -19%;
        transform: translate(-50%, -50%);
        margin: auto;
        text-align: center;
        border: 1px solid #00519A;
        border-radius: 50%;
        width: 13px;
        height: 13px;
        font-size: 9px;
        /* line-height: 42px; */
        cursor: default;
    }

    .help-tip2 {
        position: relative;
        top: -14px;
        left: -4%;
        transform: translate(-50%, -50%);
        margin: auto;
        text-align: center;
        border: 1px solid #00519A;
        border-radius: 50%;
        width: 13px;
        height: 13px;
        font-size: 9px;
        /* line-height: 42px; */
        cursor: default;
    }

    .help-tip:before {
        content: '?';
        font-family: sans-serif;
        font-weight: normal;
        color: #00519A;
    }

    .help-tip:hover p {
        display: block;
        transform-origin: 100% 0%;
        -webkit-animation: fadeIn 0.3s ease;
        animation: fadeIn 0.3s ease;
    }

    /* The tooltip */
    .help-tip p {
        display: none;
        font-family: sans-serif;
        text-rendering: optimizeLegibility;
        -webkit-font-smoothing: antialiased;
        text-align: center;
        background-color: #FAB03F;
        padding: 12px 16px;
        width: 228px;
        height: auto;
        position: absolute;
        left: 50%;
        transform: translate(-50%, 5%);
        border-radius: 3px;
        /* 	border: 1px solid #E0E0E0; */
        box-shadow: 0 0px 20px 0 rgba(0, 0, 0, 0.1);
        color: #00519A;
        font-size: 12px;
        line-height: 18px;
        z-index: 99;
    }

    .help-tip p a {
        color: #067df7;
        text-decoration: none;
    }

    .help-tip p a:hover {
        text-decoration: underline;
    }

    /* The pointer of the tooltip */
    .help-tip p:before {
        position: absolute;
        content: '';
        width: 0;
        height: 0;
        border: 10px solid transparent;
        border-bottom-color: #FAB03F;
        top: -9px;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Prevents the tooltip from being hidden */
    .help-tip p:after {
        width: 10px;
        height: 40px;
        content: '';
        position: absolute;
        top: -40px;
        left: 0;
    }

    /* CSS animation */
    @-webkit-keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 100%;
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 100%;
        }
    }

    @media screen and (min-device-width: 992px) and (max-device-width: 1596px) {
        .text-cs {
            height: 36px;
        }
    }

    @media screen and (min-device-width: 1524px) and (max-device-width: 1590px) {
        .help-tip {
            left: -17%;
        }

        .help-tip2 {
            left: 1%;
        }
    }

    @media screen and (min-device-width: 1457px) and (max-device-width: 1523px) {
        .help-tip {
            left: -14%;
        }

        .help-tip2 {
            left: 5%;
        }
    }

    @media screen and (min-device-width: 1400px) and (max-device-width: 1456px) {
        .help-tip {
            left: -11%;
        }

        .help-tip2 {
            left: 8%;
        }
    }

    @media screen and (min-device-width: 1350px) and (max-device-width: 1399px) {
        .help-tip {
            left: -8%;
        }

        .help-tip2 {
            left: 12%;
        }
    }

    @media screen and (min-device-width: 1300px) and (max-device-width: 1349px) {
        .help-tip {
            left: -5%;
        }

        .help-tip2 {
            left: 18%;
        }
    }

    @media screen and (min-device-width: 1250px) and (max-device-width: 1299px) {
        .help-tip {
            left: -1%;
        }

        .help-tip2 {
            left: 23%;
        }
    }

    @media screen and (min-device-width: 1200px) and (max-device-width: 1249px) {
        .help-tip {
            left: 3%;
        }

        .help-tip2 {
            left: 28%;
        }
    }

    @media screen and (min-device-width: 1130px) and (max-device-width: 1199px) {
        .help-tip {
            left: -40%;
        }

        .help-tip2 {
            left: -34%;
        }
    }

    @media screen and (min-device-width: 1057px) and (max-device-width: 1129px) {
        .help-tip {
            left: -39%;
        }

        .help-tip2 {
            left: -33%;
        }
    }

    @media screen and (min-device-width: 992px) and (max-device-width: 1056px) {
        .help-tip {
            left: -38%;
        }

        .help-tip2 {
            left: -32%;
        }
    }

    @media screen and (min-device-width: 945px) and (max-device-width: 991px) {
        .help-tip {
            left: -41%;
        }

        .help-tip2 {
            left: -36%;
        }
    }

    @media screen and (min-device-width: 866px) and (max-device-width: 944px) {
        .help-tip {
            left: -40%;
        }

        .help-tip2 {
            left: -34%;
        }
    }

    @media screen and (min-device-width: 795px) and (max-device-width: 865px) {
        .help-tip {
            left: -39%;
        }

        .help-tip2 {
            left: -33%;
        }
    }

    @media screen and (min-device-width: 738px) and (max-device-width: 794px) {
        .help-tip {
            left: -38%;
        }

        .help-tip2 {
            left: -31%;
        }
    }

    @media screen and (min-device-width: 689px) and (max-device-width: 737px) {
        .help-tip {
            left: -37%;
        }

        .help-tip2 {
            left: -30%;
        }
    }

    @media screen and (min-device-width: 612px) and (max-device-width: 688px) {
        .help-tip {
            left: -35%;
        }

        .help-tip2 {
            left: -27%;
        }
    }

    @media screen and (min-device-width: 555px) and (max-device-width: 611px) {
        .help-tip {
            left: -33%;
        }

        .help-tip2 {
            left: -24%;
        }
    }

    @media screen and (min-device-width: 500px) and (max-device-width: 554px) {
        .help-tip {
            left: -31%;
        }

        .help-tip2 {
            left: -20%;
        }
    }

    @media screen and (min-device-width: 450px) and (max-device-width: 499px) {
        .help-tip {
            left: -28%;
        }

        .help-tip2 {
            left: -16%;
        }
    }

    @media screen and (max-width: 449px) {
        .help-tip {
            top: 0px;
            left: 0;
            float: right;
        }

        .help-tip2 {
            top: 0px;
            left: 0;
            float: right;
        }
    }
</style>
@section('content')
    <div class="col-12 col-lg-12">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <!-- <i class="iconly-boldShow"></i> -->

                                    <i class="bi-calendar2-check"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold text-cs">Last Booking Made On</h6>
                                <h6 class="font-extrabold mb-0">{{ $latestBooking->created_at ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <!-- <i class="iconly-boldShow"></i> -->
                                    <i class="bi-card-list"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold text-cs">Bookings This Month</h6>
                                <h6 class="font-extrabold mb-0">{{ $currentMonthBooking }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6  col-xs-12">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon blue">
                                    <!-- <i class="iconly-boldProfile"></i> -->
                                    <i class="bi-clipboard-data"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold text-cs">Over All Bookings</h6>
                                <h6 class="font-extrabold mb-0">{{ $customerTotalBookings }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon green">
                                    <!-- <i class="iconly-boldAdd-User"></i> -->
                                    <i class="bi-people-fill"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold text-cs">Partner Since</h6>
                                <h6 class="font-extrabold mb-0">
                                    {{ date('d-M-y', strtotime(Auth::guard('customer')->user()->created_at)) }}
                                    <small>({{ $totalYear }} Years)</small>
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="card">
                    <div class="card-body px-3 py-4-5">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="stats-icon red">
                                    <!-- <i class="iconly-boldBookmark"></i> -->
                                    <i class=" bi-percent"></i>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-muted font-semibold text-cs">Current Discount Plan</h6>
                                <h6 class="font-extrabold mb-0">
                                    
                                    @if (Auth::guard('customer')->user()->loyaltyPlan)
                                        {{ Auth::guard('customer')->user()->loyaltyPlan->plan_name }}
                                    @endif
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Discount Plans Status</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-profile-visit"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Plan</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="align-items-center">
                                    <!-- <svg class="bi text-primary" width="32" height="32" fill="blue"
                                                                                                                                                                                                                                                                                                                                            style="width:10px">
                                                                                                                                                                                                                                                                                                                                            <use
                                                                                                                                                                                                                                                                                                                                                xlink:href="backend/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                                                                                                                                                                                                                                                                                                                        </svg> -->
                                    <h5 class="mb-0 ms-3">
                                        Silver
                                        <div class="help-tip">
                                            <p>
                                                <i class="bi-arrow-right-short"></i>Make 1-4 Direct Bookings
                                            </p>
                                        </div>
                                    </h5>
                                    <p class="ms-3" style="font-size: 13px;">12% OFF on Every Booking</p>

                                </div>
                            </div>
                            <!-- <div class="col-6">
                                                                                                                                                                                                                                                                                                                                    <h5 class="mb-0">12% OFF on Every Booking</h5>
                                                                                                                                                                                                                                                                                                                                </div> -->
                            <div class="col-12">
                                <div id="chart-europe"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="align-items-center">
                                    <!-- <svg class="bi text-success" width="32" height="32" fill="blue"
                                                                                                                                                                                                                                                                                                                                            style="width:10px">
                                                                                                                                                                                                                                                                                                                                            <use
                                                                                                                                                                                                                                                                                                                                                xlink:href="backend/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                                                                                                                                                                                                                                                                                                                        </svg> -->
                                    <h5 class="mb-0 ms-3">Gold</h5>
                                    <div class="help-tip">
                                        <p>
                                            <i class="bi-arrow-right-short"></i>Make 5+ Bookings<br>
                                            <i class="bi-arrow-right-short"></i>Become a Member for 3 years<br>
                                            <i class="bi-arrow-right-short"></i>Preferential Seasonal Rates
                                        </p>
                                    </div>
                                    <p class="ms-3" style="font-size: 13px;">15% OFF Every on Booking</p>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                                                                                                                                                                                                                                                                                                                    <h5 class="mb-0">375</h5>
                                                                                                                                                                                                                                                                                                                                </div> -->
                            <div class="col-12">
                                <div id="chart-america"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="align-items-center">
                                    <svg class="bi text-danger" width="32" height="32" fill="blue"
                                        style="width:10px">
                                        <use
                                            xlink:href="backend/assets/vendors/bootstrap-icons/bootstrap-icons.svg#circle-fill" />
                                    </svg>
                                    <h5 class="mb-0 ms-3">Diamond</h5>
                                    <div class="help-tip help-tip2">
                                        <p>
                                            <i class="bi-arrow-right-short"></i>Make 20+ Bookings<br>
                                            <i class="bi-arrow-right-short"></i>Become a Member for 7 years<br>
                                            <i class="bi-arrow-right-short"></i>Preferential Seasonal Rates
                                        </p>
                                    </div>
                                    <p class="ms-3" style="font-size: 13px;">20% OFF Every on Booking</p>
                                </div>
                            </div>
                            <!-- <div class="col-6">
                                                                                                                                                                                                                                                                                                                                    <h5 class="mb-0">1025</h5>
                                                                                                                                                                                                                                                                                                                                </div> -->
                            <div class="col-12">
                                <div id="chart-indonesia"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-header" style="    padding-bottom: 0px;">
                        <h4>Milestones</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Plan Name</th>
                                        <th>Bookings</th>
                                        <th>Years</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                               
                               
                                <tbody>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <!-- <img src="backend/assets/images/faces/5.jpg"> -->
                                                </div>
                                                <p class="font-bold ms-3 mb-0">Silver</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">{{ $customerTotalBookings }}/4</p>
                                        </td>

                                        <td class="col-auto">
                                            <p class=" mb-0">Not Required</p>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                @if (Auth::guard('customer')->user()->loyaltyPlan)
                                                    <button type="button"
                                                        class="btn btn{{ Auth::guard('customer')->user()->loyaltyPlan->plan_name == 'Silver' ? '-success' : '' }}">
                                                        {{ Auth::guard('customer')->user()->loyaltyPlan->plan_name == 'Silver' ? 'Active' : 'Inactive' }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-default">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <!-- <img src="backend/assets/images/faces/2.jpg"> -->
                                                </div>
                                                <p class="font-bold ms-3 mb-0">Gold</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">{{ $customerTotalBookings }}/5</p>
                                        </td>

                                        <td class="col-auto">
                                            <p class=" mb-0">{{ $totalYear }}/3</p>
                                        </td>

                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                @if (Auth::guard('customer')->user()->loyaltyPlan)
                                                    <button type="button"
                                                        class="btn btn{{ Auth::guard('customer')->user()->loyaltyPlan->plan_name == 'Gold' ? '-success' : '' }}">
                                                        {{ Auth::guard('customer')->user()->loyaltyPlan->plan_name == 'Gold' ? 'Active' : 'Inactive' }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-default">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="col-3">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md">
                                                    <!-- <img src="backend/assets/images/faces/2.jpg"> -->
                                                </div>
                                                <p class="font-bold ms-3 mb-0">Diamond</p>
                                            </div>
                                        </td>
                                        <td class="col-auto">
                                            <p class=" mb-0">{{ $customerTotalBookings }}/20</p>
                                        </td>

                                        <td class="col-auto">
                                            <p class=" mb-0">{{ $totalYear }}/7</p>
                                        </td>

                                        <td class="col-auto">
                                            <p class=" mb-0">
                                                @if (Auth::guard('customer')->user()->loyaltyPlan)
                                                    <button type="button"
                                                        class="btn btn{{ Auth::guard('customer')->user()->loyaltyPlan->plan_name == 'Diamond' ? '-success' : '' }}">
                                                        {{ Auth::guard('customer')->user()->loyaltyPlan->plan_name == 'Diamond' ? 'Active' : 'Inactive' }}
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-default">
                                                        Inactive
                                                    </button>
                                                @endif
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section @endsection @section('footer-script') <script src="/backend/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="/backend/assets/js/pages/dashboard.js"></script>
@endsection
