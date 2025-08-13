<!DOCTYPE html>

<html lang="en">
@include('admin.layout.header')

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default    ace-save-state">
        <div class="navbar-container ace-save-state" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
                <span class="sr-only">Toggle sidebar</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="navbar-header pull-left">
                <a href="{{ url('/admin') }}" class="navbar-brand">
                    <small> <i class="fa fa-plane"></i>
                        Xpert Airport Parking
                    </small>
                </a>
            </div>
            <div class="navbar-buttons navbar-header pull-right" role="navigation">
                <ul class="nav ace-nav">
                    <li class="green dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                            <i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
                            <span class="badge badge-success" id="ticket_messages">0</span>
                        </a>
                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close"
                            style="">
                            <li class="dropdown-header">
                                <i class="ace-icon fa fa-envelope-o"></i>
                                <span id="message_counter">0 </span> Messages
                            </li>
                            <li class="dropdown-content ace-scroll" style="position: relative;">
                                <div class="scroll-track" style="display: none;">
                                    <div class="scroll-bar"></div>
                                </div>
                                <div class="scroll-content" style="">
                                    <div class="scroll-track" style="display: none;">
                                        <div class="scroll-bar"></div>
                                    </div>
                                    <div class="scroll-content" style="max-height: 200px;">
                                        <ul class="dropdown-menu dropdown-navbar" id="messes_list_ticket">
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="dropdown-footer">
                                <a href="{{ route('myticket') }}">
                                    See all messages
                                    <i class="ace-icon fa fa-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="light-blue dropdown-modal">
                        <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <span class="user-info">
                                <small>Welcome,</small>
                                {{ Auth::user()->name }}
                            </span>
                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>
                        <ul
                            class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <li class="divider"></li>
                            <li>
                                <a href="{{ route('adminLogout') }}">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="main-container ace-save-state" id="main-container">
        @include('admin.layout.side_bar')
        <div class="main-content">
            <div class="main-content-inner">
                <div class="page-content">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('admin.layout.footer')
        <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
            <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
        </a>
    </div>
    <script type="text/javascript">
        if ('ontouchstart' in document.documentElement) document.write(
            "<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
    </script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.custom.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.sparkline.index.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.pie.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
    <script src="{{ asset('assets/js/ace.min.js') }}"></script>

    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')

        } catch (e) {}
    </script>
    <script type="text/javascript">
        function request() {
            console.log("NEW MESSAGE ");
            $.ajax({
                type: "GET",
                url: '{{ route('getNewMessages') }}',
                success: function(result) {
                    $("#ticket_messages").html(result.length)
                    $("#message_counter").html(result.length)
                    var html = "";
                    $.each(result, function(i, item) {
                        html += "";
                        html += "<li>";
                        html += '<a href="/admin/myticket/view/' + item.ticketid +
                            '" class="clearfix">';
                        html +=
                            '<img src="{{ asset('assets/images/manicon.png') }}" class="msg-photo" alt="Images"><span class="msg-body"><span class="msg-title">';
                        html += '<span class="blue">' + item.raised_named + '  ' + '</span>';
                        if (item.message != null) {
                            html += item.message.substr(0, 50);
                        }
                        html +=
                            '</span><span class="msg-time"><i class="ace-icon fa fa-clock-o"></i><span></span></span></span></a></li>';
                    });
                    $("#messes_list_ticket").html(html);
                }

            });

        }
        setInterval(request(), 10000);
        jQuery(function($) {})
    </script>
    <script>
        function hideText() {
            // hides text for 5 secs
            const btn = document.querySelector('#info');
            const infoHide = document.querySelector('.info-hide');

            infoHide.style.display = "block"
            btn.style.display = 'none'
            setTimeout(() => {
                btn.style.display = 'block';
                infoHide.style.display = "none"
            }, 10000)

        }
    </script>
    @section('footer-script')
    @show
</body>

</html>
