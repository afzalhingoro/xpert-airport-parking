<style>
    .get-hding{
        color: #fff;
        font-weight: 600;
        text-align: center;
        padding: 10px 0px ;
    }
    #accordion{
        background-color: #1773B9 !important;
        padding: 20px;
        border-radius: 15px;
        margin-bottom: 20px;
    }
    .panel-heading a{
        color: #fff !important;
        text-decoration: none;
    }
    .title{
        color: #fff !important;
    }
    .title small{
         color: #fff !important;
    }
    .sb-serc h5{
        color: #000 !important;
        text-align: left;
        font-weight: 600;
        font-size: 18px;
        padding: 20px 0px;
        padding-bottom: 10px !important;
    }
    .sb-serc{
        padding: 30px;
        border: 2px solid #1773b9;
        border-radius: 15px;
        margin-bottom: 10px;
        background-color: #ebebeb;
        display: none;
    }
    .btn-quote-ap{
        color: #1773b9;
        font-size: 18px;
        margin-bottom: 10px;
        background: #ffffff;
        display: block;
        margin: auto;
    }
</style>


<div class="sub-serc">

    <div class="row">

        <div class="col-sm-12">

            <div class="tabbable">

                <div class="tab-content">

                    <div class="tab-pane active" id="home4">

                        <div class="row">

                            <div class="col-sm-12 ">

                                <div id="accordion"

                                     class="accordion-style panel-group passenger-detail" style="background: #350a4e;">

                                    <h3 class="get-hding">ParkingZone Get Discount</h3>

                                    <div class="">

                                        <div class="panel-heading">

                                            <h4 class="panel-title maintab">

                                                <a class="accordion-toggle" href="#collapseOne"

                                                   data-parent="#accordion" data-toggle="collapse">

                                                    <i class="icon-angle-down bigger-110"

                                                       data-icon-show="icon-angle-right"

                                                       data-icon-hide="icon-angle-down"></i>

                                                    Airport Parking

                                                </a>

                                            </h4>

                                        </div>

                                        <div id="collapseOne" class="panel-collapse collapse show">

                                            <form method="POST" class="quote-form"

                                                  action='{{ route("searchresult") }}' id="airportParkingForm12">

                                                @csrf

                                                <div class="panel-body">

                                                    <div class="row">

                                                        <div class="col-md-12 col-xs-12">

                                                            <label class="title">Airport

                                                                <small> ( Select Your Airport )

                                                                </small>

                                                            </label>

                                                            <select required name="airport_id" class="form-control">

                                                                <option value="" selected>Airport</option>

                                                                @foreach($airports as $airport)

                                                                    <option value="{{ $airport->id }}">{{ $airport->name }}</option>

                                                                @endforeach

                                                            </select>

                                                        </div>

                                                    </div>



                                                                                                @php $date = date("Y-m-d"); @endphp

                                                    <div class="row">

                                                        <div class="col-md-6 col-xs-6">

                                                            <label class="title">Departure

                                                                Date</label>

                                                            <input required class="form-control right_dpd1"

                                                                   id="dropdatepicker12"

                                                                   autocomplete="off"

                                                                   readonly

                                                                   name="dropoffdate"

                                                                   value="{{ $date }}" placeholder="MM/DD/YY" value="" style="background:white;">

                                                        </div>



                                                        <div class=" col-md-6 col-xs-6">

                                                            <label class="title">Time</label>

                                                            @php

                                                                $dropdown_timer = [];

                                                               for ($i = 0; $i <= 23; $i++) {

                                                                   for ($j = 0; $j <= 45; $j += 15) {

                                                                       //$sel = str_pad($i, 2, "0", STR_PAD_LEFT).':'.str_pad($j, 2, "0", STR_PAD_LEFT) == $opening_time ? 'selected' : '';

                                                                       //echo '<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT).':'.str_pad($j, 2, "0", STR_PAD_LEFT).'"'.$sel.'>'.str_pad($i, 2, "0", STR_PAD_LEFT).':'.str_pad($j, 2, "0", STR_PAD_LEFT).'</option>';

                                                                       $dropdown_timer[str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT)] = str_pad($i, 2, "0", STR_PAD_LEFT) . ':' . str_pad($j, 2, "0", STR_PAD_LEFT);

                                                                   }

                                                               }

                                                            @endphp

                                                            {{ Form::select('dropoftime',$dropdown_timer,"",["class"=>"form-control","id"=>"dropoftime"]) }}





                                                        </div>



                                                    </div>

                                                    <div class="row">

                                                        <div class="col-md-6 col-xs-6">

                                                            <label class="title">Arrival

                                                                Date</label>

                                                            <input required class="form-control right_dpd2"

                                                                   id="pickdatepicker12"

                                                                   autocomplete="off"


                                                                   name="departure_date"

                                                                   <?php

                                                               $mydate = $date;

                                                               $daystosum = '2';

                                                               $datesum = date('Y-m-d', strtotime($mydate . ' + ' . $daystosum . ' days'));

                                                               ?>

                                                               value="{{ $datesum}}"

                                                               value="" placeholder="MM/DD/YY" value="" style="background: white;">

                                                        </div>



                                                        <div class="col-md-6 col-xs-6">

                                                            <label class="title">Time</label>

                                                            {{ Form::select('pickup_time',$dropdown_timer,"",["class"=>"form-control ","id"=>"pickup_time"]) }}





                                                        </div>



                                                    </div>

                                                    <div class="row">

                                                        <div class=" col-md-12">

                                                            <label class="title"></label>

                                                              <br>

                                                            <button class="btn btn butn_1 center-block btn-quote-ap "

                                                                    

                                                                    type="submit" name="button"

                                                                    value="Get a quote">GET A QUOTE

                                                            </button>

                                                        </div>

                                                    </div>

                                                </div>

                                            </form>

                                        </div>

                                    </div>

                                   

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>



</div>

<div class="sb-serc">

    <h5>Airport Parking</h5>

   

    <p>Secure, guaranteed and satisfactory. Our customers reap benefits from priority parking at

        350+ car parks on 30+ major airports across UK, while saving up to 30%.</p>

    <a href="{{ route("airports") }}" class="btn btn-submit">Learn More</a>

</div>

<div class="sb-serc">

    <h5>Airport Hotels</h5>

    

    <p>Why struggle through traffic to reach airport when you can say goodbye to stress with ParkingZone

        and book an Airport hotel in two minutes. </p>

    <a  class="btn btn-submit">Coming Soon</a>

</div>

<div class="sub-serc">

    <div class="sb-serc">

        <h5>Airport Lounges</h5>

       

        <p>Take a break from all the stress and extensive traveling. Book a premium lounge with

            ParkingZone  in the price of an economy airport lounge. </p>

        <a  class="btn btn-submit">Coming Soon</a>

    </div>

</div>

<div class="sub-serc">

    <div class="sb-serc">

        <h5>Other Traveling Services</h5>



        <p>Flying made easy. We offer unbeatable rates for car rentals, travel insurance, taxi

            services, parking, airport lounges and international hotels. Try it to believe it!</p>

        <a  class="btn btn-submit">Coming Soon</a>

    </div>

</div>

@section("footer-script")

    <script>

        $(function () {






        });

    </script>

@endsection