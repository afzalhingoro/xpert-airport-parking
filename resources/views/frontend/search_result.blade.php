@extends('layouts.main')



@section('content')
    
    <style>
        .navbar-nav {
            display: none;
        }

        .navbar-toggler {
            display: none !important;
        }

        .second_class {
            display: none;
        }
        #footer .footer-wrap {
            padding: 0;
        }

        .col-sec-h3 {
            margin-bottom: 32px;
        }

        .seperator {
            height: 4px;
            width: 10%;
            background-color: #714a97;
            margin: 0 auto;
            text-align: center;
            border-radius: 2px;
        }
</style>
    


    <section class="result-bsnner d-flex justify-content-center align-items-center">
        <div class="container main-section">
            <div class="row">
                <div class="col-lg-4">
                    <h1 class="main-heading">Xpert Airport Parking</h1>
                </div>
                <div class="col-xl-6 col-lg-7 text-center">
                    <ul class="list-inline search-data margint10 primary-color textc">
                        <li class="li-display" style="color:#0c5adb"><strong class="hidden-md">Departure: </strong> &nbsp;<i
                                class="fas fa-plane-departure">&nbsp;</i> <?php echo $_GET['dropdate'] . ' at ' . $_GET['droptime']; ?></li>
                        <li class="li-display" style="color:#0c5adb"><strong class="hidden-md">Arrival: </strong>&nbsp;<i
                                class="fas fa-plane-arrival"></i>&nbsp; <?php echo $_GET['pickdate'] . ' at ' . $_GET['picktime']; ?></li>
                    </ul>
                </div>
                <div class="col-xs-2 col-lg-1 text-center">

                    <!--<button class="btn edit-button" id="show" style="    ">Edit</button>-->
                    <button type="button" class="btn edit-button mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                      Edit
                    </button>
                </div>

            </div>
        </div>
    </section>
        <!-- Modal -->
        <div class="modal fade manParkModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Xpert Airport Parking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
              </div>
              <div class="modal-body">
                @include('layouts.search_form_result')
              </div>
              <!--<div class="modal-footer">-->
              <!--  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
              <!--</div>-->
            </div>
          </div>
        </div>

    <section id="section" class="bookingPage">
        <div class="container p-0">
            <div class="row">
                <div class="col-lg-12 text-center col-sec-h3" id="zoomIn">
                   <h2 class="section-3-h2">Choose Your <span style="color:#242d62">Package</span></h2>
                   <div class="seperator"></div>
                </div>
            </div>

            <div id="ajax_search_results">

                <div class="spiner_container" style="text-align: center;"><img
                        src="{{ url('theme-new/img/Animation-1732884041269.gif') }}"></div>
            </div>
        </div>
    </section>

    
@endsection
@section('footer-script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
        $(document).ready(function() {
            $('#show').click(function() {
                $('.menu').toggle("slide");
            });
        });
    </script>
    <script>
        var coll = document.getElementsByClassName("collapsible");
        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;

                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        }
    </script>
    <script>
        var enddate = new Date();
        enddate.setDate(enddate.getDate() + 7);
        var startDate = new Date();
        startDate.setDate(startDate.getDate());
        console.log(startDate);
        new TinyPicker({
            format: 'dd-mm-yyyy',
            firstBox: document.getElementById('startDate'), // Required -- Overrides us finding the first input box
            lastBox: document.getElementById('endDate'), // Required -- Overrides us finding the last input box
            // 	startDate: startDate, // Needs to be a valid instance of Date
            //     endDate: enddate, // Needs to be a valid instance of Date
            allowPast: false, // If you want the user to be able to select past dates
            useCache: true,
            orientation: "top auto",
            horizontal: 'auto',
            vertical: 'auto'
        }).init();
    </script>
    <script type="text/javascript">
        $('.spiner_container').show();

        $(document).ready(function() {
            var ajdata = {};

            //ajdata['airport_id'] = '{{ request()->airport_id }}';
            ajdata['airport_id'] = '1';
            ajdata['dropoffdate'] = '{{ request()->dropdate }}';
            ajdata['dropoftime'] = '{{ request()->droptime }}';
            ajdata['departure_date'] = '{{ request()->pickdate }}';
            ajdata['pickup_time'] = '{{ request()->picktime }}';
            ajdata['promo'] = '{{ request()->promo }}';
            ajdata['promo2'] = '{{ request()->promo2 }}';
            ajdata['_token'] = '{{ csrf_token() }}';

            $.ajax({
                url: '{{ route('searchresult') }}',
                type: "POST",
                data: ajdata
                //datatype: "html"
            }).done(function(data) {
                $("#ajax_search_results").empty().html(data);
                $('.spiner_container').hide();
                $('#to-top').click();
                //location.hash = page;
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                $('.spiner_container').hide();
                //alert('No response from server');
                console.log('No response from server');
            });
            console.log("ready!");
        })
    </script>

    <script type="text/javascript">
        $("a.apply-active").on('click', function() {
            $('li.active').removeClass('active');
            // $(this).closest("li.active").removeClass('active');
            $(this).closest("li").addClass('active');


            $(".tab-pane").hide();
            $($(this).attr("href")).show();
        });
    </script>
@endsection
