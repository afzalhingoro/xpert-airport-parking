@extends('layouts.main')
@section('page_style')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .confirmation-heading {
            color: #fff;
        }

        .ref-hding {
            color: #232323;
            font-weight: 600;
            font-size: 18px;
        }

        .ticket-details {
            margin-top: 10px;
            text-align: right;
        }

        .ref-no {
            color: #393939;
            font-size: 16px;
            margin-left: 10px;
        }

        .confirmation-list {
            list-style: none;
            font-weight: 500;
            color: #393939;
            font-size: 17px;
        }

        .customer-detail {
            text-align: right;
            /*margin-top: 20px;*/
        }

        .customer-detail li {
            /*margin-top: 10px;*/
        }

        .confirmation-company {
            background-color: #1fa9ff08;
            padding: 10px;
            border-radius: 10px;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        .table-info tr {
            color: #232323;
        }

        .table-heading {
            /*background-color: #255498;*/
            padding: 10px;
            /*border-radius: 10px;*/
            text-align: center;
            color: white;
            font-size: 30px;
            font-weight: 600;

        }

        .text-bold {
            font-weight: 600;
        }

        .totel-heading {
            color: #fff;
            font-weight: 600;
            text-align: right;
            padding: 10px 0px;
        }

        .hotel-sidebar {
            background-color: #fff;
            padding: 20px 20px;
            border-radius: 10px;
            /*box-shadow: -1px 0px 20px 5px #0000001c;*/
            margin-bottom: 20px;
        }

        .sub-head {
            font-size: 20px;
            font-weight: 600;
            color: white;
        }

        .sub-p {
            color: white;
            font-size: 18px;
        }

        .star-rating i:hover {
            cursor: pointer;
            color: #FAB03F;
        }

        .star-rating i.fill {
            color: #FAB03F;
        }

        .fill {
            color: #FAB03F;
        }
        .col-css{
            border: 1px dashed;
            border-radius: 15px;
            background: #714a97;
                box-shadow: 0px 1px 5px 1px gray;
        }
        .row-css{
            justify-content: center;
        }
    </style>
@endsection
@section('content')
    <section id="section">
        <div class="conatiner">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-12 col-sm-12 col-xs-12">
                    <div class="hotel-sidebar">
                        <div class="row ">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <img src="{{ url('theme-new/img/THANK-YOU.gif') }}" class="img-fluid" style="height: 243px;">
                                <h3 class="table-heading" style="margin-top: 34px;color:black">BOOKING CONFIRMED </h3>
                                <div style="justify-content:center;display:flex">
                                    <p style="color:black; max-width: 1000px;">
                                        Thank you for completing booking this is your booking confirmation with all your
                                        traveling details, Email has been sent to you in regards to your booking.
                                        If you do have any questions in the mean time please do not hesitate to contact us on
                                        helpdesk@xpertairportparking.com
                                    </p>
                                </div>
                                
                            </div>

                            @if (session('success') || session('rating'))
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center "
                                    style="margin:30px 0 10px 0">
                                    <div style="margin:10px 0 ; border-radius: 0; " class="star-rating">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star{{ session('rating') >= $i ? ' fill' : '' }}"
                                                data-rating="{{ $i }}"></i>
                                        @endfor
                                        @if (session('success'))
                                            <!--<div style="padding: 0 300px; font-size: 18px; margin-top: 20px;">-->
                                            <!--    <div class="alert alert-success"-->
                                            <!--        style="border-radius: 0;margin-top:10px;font-size:">-->
                                            <!--        {{ session('success') }}-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center "
                                    style="margin:30px 0 10px 0">
                                    <div style="margin:10px 0 ; border-radius: 0; " class="star-rating">
                                        <i class="fa fa-star" data-rating="1"></i>
                                        <i class="fa fa-star" data-rating="2"></i>
                                        <i class="fa fa-star" data-rating="3"></i>
                                        <i class="fa fa-star" data-rating="4"></i>
                                        <i class="fa fa-star" data-rating="5"></i>
                                    </div>
                                </div>
                            @endif






                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center mb-20"
                                style="margin-bottom:30px">

                            </div>
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('review.submit') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <h6 class="modal-title text-center"
                                                    style="font-weight: bold; color: #000; font-family: inherit; ">
                                                    {{ $booking->company->name }}
                                                </h6>
                                                <div id="modal-star-rating" style="margin:10px 0 ; border-radius: 0;">
                                                    <i class="fa fa-star" data-rating="1"></i>
                                                    <i class="fa fa-star" data-rating="2"></i>
                                                    <i class="fa fa-star" data-rating="3"></i>
                                                    <i class="fa fa-star" data-rating="4"></i>
                                                    <i class="fa fa-star" data-rating="5"></i>
                                                </div>
                                                <small>
                                                    @if ($booking->company->reviews)
                                                        {{ $booking->company->reviews->count() }}
                                                    @else
                                                        0
                                                    @endif Reviews
                                                </small>
                                                <textarea name="review_content" class="form-control" cols="20" rows="5" placeholder="Write Review"></textarea>
                                                <input type="hidden" name="rating" class="total_star_count">
                                                <input type="hidden" name="username"
                                                    value="{{ $booking->customer->first_name }}">
                                                <input type="hidden" name="email"
                                                    value="{{ $booking->customer->email }}">
                                                <input type="hidden" name="company_id" value="{{ $booking->company->id }}">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-secondary btn-sm"
                                                    style="border-radius: 0; background-color:#FAB03F; border-color:#FAB03F;">Save
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                        </div>
                        <div class="container">
                            <div class="row row-css">
                                <div class="col-xl-7 col-lg-10 col-css">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h3 class="table-heading">YOUR DETAILS</h3>
                                        </div>
                                    </div>
                                    <div class="row" style="border-bottom: 1px solid white;border-top: 1px solid white;padding-top: 15px;">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Name:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->first_name . ' ' . $booking->last_name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Mobile number: </h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->phone_number }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Email:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h3 class="table-heading">VEHICLE DETAILS</h3>
                                        </div>
                                    </div>
                                    <div class="row"
                                        style="border-bottom: 1px solid white;border-top: 1px solid white;padding-top: 15px;">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Registration No:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->registration }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Model:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->model }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Make:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->make }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Color:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->color }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <h3 class="table-heading">BOOKING Details</h3>
                                        </div>
                                    </div>
                                    <div class="row"
                                        style="border-bottom: 1px solid white;border-top: 1px solid white;padding-top: 15px;">
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Booking Ref:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->referenceNo }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Company:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->company->name }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Drop-Off:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ date('F d Y', strtotime($booking->departDate)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Return:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ date('F d Y', strtotime($booking->returnDate)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Days:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->no_of_days }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Depature Flight:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->deptFlight }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Return Flight:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">{{ $booking->returnFlight }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <h3 class="sub-head">Booking Price:</h3>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-6">
                                                    <p class="sub-p">£{{ $booking->total_amount }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="totel-price">
                                            <h3 class="totel-heading">Total Price : £{{ $booking->total_amount }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if ($booking->traffic_src == 'PPC')
        <!-- Event snippet for Confirm Purchase of Stansted Parking 247 conversion page -->
        <script>
            gtag('event', 'conversion', {
                'send_to': 'AW-10965864838/Jm8mCJivi-YDEIaj9-wo',
                'transaction_id': '{{ $booking->referenceNo }}'
            });
        </script>
    @endif

    @if ($booking->traffic_src == 'POR')
        <script language=JavaScript
            src="https://portgk.com/create-sale?client=java&MerchantID=2440&SaleID=[{{ $booking->referenceNo }}]&OrderValue=[{{ $booking->total_amount }}]&VoucherCode=[VoucherUsed]&ExcludeVAT=NO">
        </script>
        <noscript><img
                src="https://portgk.com/create-sale?client=img&MerchantID=2440&SaleID=[{{ $booking->referenceNo }}]&OrderValue=[{{ $booking->total_amount }}]&VoucherCode=[VoucherUsed]&ExcludeVAT=NO"
                width="10" height="10" border="0"></noscript>
    @endif
@endsection

@section('page_js')
    <script>
        // JavaScript for star rating interaction
        $(document).ready(function() {
            $(".star-rating i").hover(function() {
                $(this).prevAll().addBack().addClass("fill");
                $(this).nextAll().removeClass("fill");
            });

            let selectedRating = 0;

            $(".star-rating i").click(function() {
                selectedRating = $(this).data('rating');
                // Trigger the modal
                $('#myModal').modal('show');
            });

            // Update stars in the modal when the modal is shown
            $('#myModal').on('shown.bs.modal', function() {
                $('#modal-star-rating i').each(function(index) {
                    
                    if (index < selectedRating) {
                        $(this).addClass('fill');
                    } else {
                        $(this).removeClass('fill');
                    } 
                });
                
                 $('.total_star_count').val(selectedRating)
            });
        });
    </script>
@endsection
