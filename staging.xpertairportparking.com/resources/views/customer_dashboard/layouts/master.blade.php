<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Xpert Airport Parking</title>



    <!-- CSRF Token -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('customer_dashboard.layouts.header')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>



<body>

    <div id="app">

        @include('customer_dashboard.layouts.nav')

        <div id="main">
                <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-right" style="text-align:right">
                                <a class="back-a-btn" href="{{ url('/') }}">Back to Main Site</a>
                            </div>
                        </div>
                    </div>
            <header class="mb-3">

                <a href="#" class="burger-btn d-block d-xl-none">

                    <i class="bi bi-justify fs-3"></i>

                </a>

            </header>



            <div class="page-heading">

                <!-- <h3>{{ isset($data['page_title']) ? $data['page_title'] : '' }}</h3> -->

            </div>

            <div class="page-content">
                    
                @yield('content')

            </div>



            <footer>

                <div class="footer clearfix mb-0 text-muted">

                    <div class="float-start">

                        <p><?php echo date('Y') ?> &copy;Xpert Airport Parking</p>

                    </div>

                    <div class="float-end">

                        <p>All rights reserved <span class="text-danger"> <a href="#">Xpert Airport Parking Ltd.
                                </a></p>

                    </div>

                </div>

            </footer>

        </div>

    </div>

    @include('customer_dashboard.layouts.footer')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>


    @section('footer-script')



    @show

</body>



</html>
