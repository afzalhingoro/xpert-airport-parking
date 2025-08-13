@extends('layouts.main')



@section('content')

<style type="text/css">
    .booking-result p strong{color: #000 !important;}
	.btn-black{
        background-color: #1773b9;
        color: white;
	}
	.btn-black:hover{
		background-color: #1773b9;
		color: white;
        text-decoration: underline;
	}
	.details-hding{
    	color: #000;
        font-weight: 600;
        padding: 20px 0px;
        text-align: center;
	}
	.main-area{
        background: url(assets/images/banner18.jpg);
        border: 2px solid #1773b9;
        float: left;
        width: 100%;
        border-radius: 15px;
	}
	.sub-detail{
	    float: left; 
	    width: 100%; 
	    border: 4px solid #1773b9; 
	    border-bottom: 0px; 
	    border-right: 0px; 
	    border-left: 0px; 
	    margin: 10px 0px 10px 0px; 
	    padding: 20px 0px;
	}
	.list-style-div{
	    list-style: none;
	}
	#RButton{
	    background: #d9d9d9; 
	    width: 88%;
	}
</style>


    <section class="section" style="margin-top: 20px;padding: 40px;">



        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



                <div class="booking-result">





                    <div class="row" style="margin: 20px auto;">

                        <div class="col-md-9" id="myfont" style="margin:20px auto;">

                            <div class="row" id="print">

                                <div class="main-area">

                                    <!-- top area -->

                                    <div class="top-bar">

                                        <div class="top-bar-left col-xs-12 col-sm-12 col-md-3 col-lg-3">

                                            <!-- <img src="{{ secure_asset("assets/images/logo2.png") }}" class="img-responsive"> -->

                                        </div>

                                        <div class="top-bar-right col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">

                                            <h1 class="details-hding">Booking Details</h1>

                                        </div>

                                    </div>

                                    <!-- Detail Content -->

                                    <div class="detail col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div class="sub-detail sub-detail-2"

                                           >

                                            <div class="table-responsive">



                                            <table class="table" border="0">

                                                <tbody class="bg-grey-col">

                                                <tr>

                                                    <td width="12%"><span

                                                                style="font-weight:bold; color:#000 !important;">Name:</span>

                                                    </td>

                                                    <td width="26%" >{{ $booking->first_name }} {{ $booking->last_name }} 

                                                    </td>

                                                    <td width="22%"><span

                                                                style="font-weight:bold; color:#000 !important;">Ref:</span>

                                                    </td>

                                                    <td width="26%">{{ $booking->referenceNo }} </td>

                                                </tr>

                                                @if($airport_detail)

                                                <tr>

                                                    <td>&nbsp;</td>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Airport:</span>

                                                    </td>

                                                    <td>{{ $airport_detail->name }}</td>

                                                </tr>

                                                @endif

                                                <tr>

                                                    

                                                    <td><span style="font-weight:bold; color:#000 !important;">Booking Start Date:</span>

                                                    </td>

                                                    <td>{{ $booking->departDate  }}</td>

                                              

                                                  

                                                    <td><span style="font-weight:bold; color:#000 !important;">Booking End Date:</span>

                                                    </td>

                                                    <td>{{ $booking->returnDate }}</td>

                                                </tr>

                                                <tr>

                                                   

                                                    <td><span style="font-weight:bold; color:#000 !important;">Booking Status:</span>

                                                    </td>

                                                    <td>{{ $booking->booking_status }}</td>

                                              

                                                   

                                                    <td><span style="font-weight:bold; color:#000 !important;">Payment Status:</span>

                                                    </td>

                                                    <td>{{ $booking->payment_status }}</td>

                                                </tr>

                                                </tbody>

                                            </table>

                                                </div>

                                        </div>

                                    </div>

                                    <div class="confirm col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <h1 class="details-hding">Booking Confirmation</h1>

                                        <p>Thank you for booking with ZMD Travel, this is your booking confirmation

                                            with all your traveling details.

                                            Please take a print out of this email as you might need to present this at

                                            the time of dropping off your vehicle. Please check the details of your

                                            booking confirmation as ZMD Travel cannot be held responsible if you do

                                            not advise amendments required.</p>

                                    </div>

                                    <div class="detail col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div class="sub-detail"

                                             style="">

                                            <div class="table-responsive">

                                            <table class="table"  border="0">

                                                <tbody>

                                                <tr>

                                                    <td width="20%"><span

                                                                style="font-weight:bold; color:#000 !important;">Email:</span>

                                                    </td>

                                                    <td width="29%">{{ $booking->email }}</td>

                                                    <td width="23%"><span

                                                                style="font-weight:bold; color:#000 !important;">Ref:</span>

                                                    </td>

                                                    <td width="28%">{{ $booking->referenceNo }}</td>

                                                </tr>

                                                <tr>

                                                    <td>

                                                        <span style="font-weight:bold; color:#000 !important;">Phone:</span>

                                                    </td>

                                                    <td>{{ $booking->phone_number }}</td>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Payment Method:</span>

                                                    </td>

                                                    <td>{{ $booking->payment_method }}</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Product Name:</span>

                                                    </td>

                                                    <td>ZMD Travel Saver Gatwick</td>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Payment Status:</span>

                                                    </td>

                                                    <td>{{ $booking->payment_status }}</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Company Booked with:</span>

                                                    </td>

                                                    <td><b>{{ $booking->name }}</b></td>

                                                    <td rowspan="2"><h1 style="color:#000 !important;">Amount:</h1>

                                                    </td>

                                                    <td rowspan="2"><h1 style="color:#000 !important;">{{ $booking->total_amount }}</h1>

                                                    </td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Parking Type:</span>

                                                    </td>

                                                    <td>{{ $booking->booked_type }}</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Outbound Terminal:</span>

                                                    </td>

                                                    <td>@if($booking->dterminal) {{ $booking->dterminal->name }}  @endif</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Inbound Terminal:</span>

                                                    </td>

                                                    <td>@if($booking->rterminal) {{ $booking->rterminal->name  }} @endif</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Number Of days:</span>

                                                    </td>

                                                    <td>{{ $booking->no_of_days }}</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Flight No:</span>

                                                    </td>

                                                    <td>{{ $booking->no_of_days }}</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Vehicle Registration:</span>

                                                    </td>

                                                    <td> {{ $booking->registration }}</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Vehicle Model:</span>

                                                    </td>

                                                    <td>{{ $booking->model }}</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Vehicle Make:</span>

                                                    </td>

                                                    <td>{{ $booking->make }}</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                </tr>

                                                <tr>

                                                    <td><span style="font-weight:bold; color:#000 !important;">Vehicle Color:</span>

                                                    </td>

                                                    <td>{{ $booking->color }}</td>

                                                    <td>&nbsp;</td>

                                                    <td>&nbsp;</td>

                                                </tr>

                                                </tbody>

                                            </table>



                                                <div>

                                        </div>

                                    </div>

                                    <div class="detail col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div class="sub-detail"

                                             style="float: left; width: 100%; border: 4px solid #c7c7c7; border-bottom: 0px; border-right: 0px; border-left: 0px; margin: 10px 0px 10px 0px; padding: 20px 0px;">

                                            <h1 class="details-hding">Arrival</h1>

                                            <p></p>

                                            <?php echo $booking->arival; ?>
                                        </div>

                                    </div>

                                    <div class="detail col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div class="sub-detail"

                                             style="float: left; width: 100%; border: 4px solid #c7c7c7; border-bottom: 0px; border-right: 0px; border-left: 0px; margin: 10px 0px 10px 0px; padding: 20px 0px;">

                                            <h1 class="details-hding">Departure</h1>

                                            <p></p>

                                            
                                            <?php echo $booking->return_proc; ?>

                                        </div>

                                    </div>

                                    <div class="detail col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                        <div class="sub-detail"

                                             style="float: left; width: 100%; border: 4px solid #c7c7c7; border-right: 0px; border-left: 0px; border-bottom: 0px; margin: 10px 0px 10px 0px; padding: 20px 0px;">

                                            <h1 class="details-hding">Terms &amp; Conditions</h1>

                                            <p><strong style="color:#000 !important">Instructions to be followed

                                                    prior to parking</strong></p>

                                            <p>2 You are supposed to carry a copy of the booking confirmation with you

                                                at the time when you leave to park your car at the car park and

                                                henceforth till the time you retrieve your car back from the &nbsp;

                                                &nbsp;car park.</p>

                                            <p>3 In case you haven’t received your booking confirmation prior to 24

                                                hours of the date of booking, please contact the office on 02070580500

                                                or onpne.</p>

                                            <p>4 On inquiry you are supposed to present a copy of the booking

                                                confirmation and tell the representatives your booking number.</p>

                                            <p>5 Please ensure that you have a vapd identity proof such as Passport,

                                                Driving pcense, Photo ID card, passport etc.</p>

                                            <p>6 There will be a confirmation sent to you by SMS and you are required to

                                                please take a note of it.</p>

                                            <p>7 Please ensure that the vehicle that you are parking is fully

                                                insured.</p>

                                            <p>8 Please ensure that in case there is a fpght to be boarded, the car is

                                                dropped off at least 30 minutes prior to the check in time. There won’t

                                                be any responsibipty of ZMD Travel pmited in case a &nbsp; &nbsp;customer

                                                misses their fpght due to lack of time.</p>

                                            <p>9 There can be a possible delay during the drop off; the customer should

                                                keep scope of that.</p>

                                            <p>10 Please ensure that the vehicle that you have booked the parking spot

                                                for is of a standard size as there will be additional charges incurred

                                                for a vehicle larger than the standard size. Please cross &nbsp; check

                                                the same with the given parking as there are parking lots which cannot

                                                accommodate large vehicles.&nbsp; There are additional charges to be

                                                paid for vehicles which are large.</p>

                                            <p>11 Certain car parks have minimum stays, a customer who wants to stay

                                                lesser than the minimum duration will have to pay for the minimum stay.

                                                This will be mentioned in the bookings.</p>

                                            <p>12 There will be airport transfer provided to the customers with prior

                                                intimation. In case a customer requires airport transfers they have to

                                                mention it at the time of the booking. The airport transfers &nbsp;

                                                &nbsp;are without any additional charges.</p>

                                            <p>13All payments have to be made in advance.</p>

                                            <p><strong style="color:#000 !important">Instructions to be followed

                                                    during parking</strong></p>

                                            <p>1 Please ensure that there are no valuables left in the car before

                                                leaving the car in the car park and the company bears no responsibipty

                                                for valuables left in the car.</p>

                                            <p>2 Please leave the car keys with the caretaker unless otherwise

                                                specified. Sometimes the car needs to be moved around for the efficient

                                                management of parking space so the keys have to remain in the

                                                parking.</p>

                                            <p>3 Please ensure that all the documents of the car are in place.</p>

                                            <p>4 Please take a copy of the booking confirmation with you once you leave

                                                the car park. It acts as a receipt.</p>

                                            <p>5 Please ensure that you have proper directions to the car park which are

                                                different for each car park and mentioned individually.</p>

                                            <p><strong style="color:#000 !important">Cancellations and

                                                    Refunds</strong></p>

                                            <p>1 Cancellation without a 48-hour notice of the date of service will not

                                                be given any refund.</p>

                                            <p>2 Cancellation done between a 48 hour to one-week period of the date of

                                                the service will get a full refund after deducting the booking fees of

                                                £10.</p>

                                            <p>3 All refunds would be processed within 7-10 working days of the

                                                cancellation.</p>

                                            <p>4 The customers are requested to retain the booking confirmation unless

                                                the refund is processed.</p>

                                            <p>5 Under certain offers and promotional schemes no refund would be given.

                                                In such a case this clause would be mentioned during the booking.</p>

                                            <p><strong style="color:#000 !important">Chauffer Services</strong></p>

                                            <p>1 In case it is a chauffeur driven service, please ensure that you are

                                                present there at the right time.</p>

                                            <p>2 In case there is a delay there will be additional charges to be paid at

                                                the rate of £10 per day payable directly to the Car park.</p>

                                            <p>3 These additional charges would be payable immediately.</p>

                                            <p><strong style="color:#000 !important">Other information</strong></p>

                                            <p>1 In case of a structural default in a car such as engine fault, dents

                                                the Car park won’t be pable. Customers are supposed to check their

                                                vehicles for any default in their vehicles.</p>

                                            <p>2 The owner of the vehicle needs to ensure that the vehicle has a vapd

                                                insurance popcy which does not expire in the course of the parking

                                                period.</p>

                                            <p>3 There are certain car parks which have certain additional costs, the

                                                customer should check about these additional costs at the website before

                                                booking.</p>

                                            <p><strong style="color:#000 !important">Customer Complaints and

                                                    Grievances</strong></p>

                                            <p>1 The complaints which are of urgent nature should be taken to the

                                                customer service agents who are present at each car park.</p>

                                            <p>2 Before exiting from the car park, the customer should ensure that

                                                everything is in place, once the customer exits from the car park, there

                                                won’t be any pabipty of the Car park</p>

                                            <p>3 If the complaint is not of an urgent nature, there is a form which is

                                                available both onpne and offpne which should be filled by the customer.

                                                The ZMD Travel pmited would get back to the customer &nbsp; &nbsp;in

                                                7-10 working days.&nbsp;</p>

                                            <p>&nbsp;</p>

                                            <p><strong style="color:#000 !important">Your statutory rights as a

                                                    customer will not be effected</strong></p>

                                            <p><strong style="color:#000 !important">Errors or Omissions

                                                    Excepted</strong></p>

                                            <p>

                                                -------------------------------------------------------------------------------------------------------------------------------------</p>

                                            <p>



                                            </p>

                                            <p><strong style="color:#000 !important">ZMD Travel:</strong></p>

                                            <p>Customer Services: 113 322 9679</p>

                                            <p>Email: info@zmdtravel.com</p>
                                           

                                        </div>

                                        <!-- /detail content -->

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                    <div class="col-md-3" style="background: #fff;    padding-top: 33px;">

                        <div class="row text-center">

                            <div class="col-md-12">

                                <h3 class="details-hding">Booking Actions</h3>

                            </div>

                            <div class="col-md-12 ">

                                <p class="alert alert-info" id="msg" style="display:none;"></p>

                                <ul class="list-style-div" style="padding: 0px;">

                                    <li class="text-info">

                                        <button type="button" class="btn btn-black" id="pri" style="width: 88%;"><i

                                                    class="entypo-doc-text"></i> Print

                                        </button>

                                        <br></li>

                                    <li class="text-success" id="pri">

                                        <button type="button" class="btn btn-yellow" id="RButton" style=""><i

                                                    class="entypo-doc-text"></i> Re-send Email

                                        </button>

                                    </li>

                                </ul>

                            </div>

                        </div>

                    </div>

                    <form id="RForm">

                        <input type="hidden" name="id" value="{{ $booking->bookingid }}">

                        <input type="hidden" name="email" value="{{ $booking->email }}">

                        <input type="hidden" name="action" value="resend">

                    </form>



                </div>

            </div>

        </div>



    </section>







@endsection

@section("footer-script")

    <script>



        $('#RButton').click(function () {

            $.post('{{ route("reSendEmailBooking") }}', $("#RForm").serialize(), function (data, textStatus, xhr) {

                if (data=="success") {

                    alert('Email Send..!!');

//                    $('#msg').html('Email Send..!!');

//                    $('#msg').fadeIn();

                    //setTimeout('$("#msg").fadeOut()', 2000);

                } else {

                    alert('Email Not Send Try Again..!!');



//                    $('#msg').html('Email Not Send Try Again..!!');

//                    $('#msg').show().fadeIn();

                    //setTimeout('$("#msg").fadeOut()', 2000);

                }



            });

            $('#msg').hide();

        });

        document.getElementById("pri").onclick = function () {

            printElement(document.getElementById("print"));

            window.print();

        }



        function printElement(elem, append, delimiter) {

            var domClone = elem.cloneNode(true);

            var $printSection = document.getElementById("printSection");



            if (!$printSection) {

                var $printSection = document.createElement("div");

                $printSection.id = "printSection";

                document.body.appendChild($printSection);

            }



            if (append !== true) {

                $printSection.innerHTML = "";

            }

            else if (append === true) {

                if (typeof(delimiter) === "string") {

                    $printSection.innerHTML += delimiter;

                }

                else if (typeof(delimiter) === "object") {

                    $printSection.appendChlid(delimiter);

                }

            }

        }

    </script>

@endsection