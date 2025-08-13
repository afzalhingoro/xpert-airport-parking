<link rel="stylesheet" href=" {{ secure_asset('assets/css/jquery-ui.custom.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/chosen.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/bootstrap-datepicker3.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/bootstrap-timepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/daterangepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ secure_asset('assets/css/bootstrap-colorpicker.min.css') }}"/>
<style>
    .input-container input {
    border: none;
    box-sizing: border-box;
    outline: 0;
    padding: .75rem;
    position: relative;
    width: 100%;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    background: transparent;
    bottom: 0;
    color: transparent;
    cursor: pointer;
    height: auto;
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    width: auto;
}
#step_2_companies{
        width: 100%;
    height: 400px;
    overflow: scroll;
}
</style>
<div class="modal fade" id="new_payment_model" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Update Your Booking Details </h4>
            </div>
            <div class="modal-body" id=" ">
                <div class="row grid-box">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-12 control-label">Departure Date</label>
                            <div class="col-sm-12">
                                <input type="date"
                                    value="{{ \Carbon\Carbon::parse($booking_detail->departDate)->format('Y-m-d') }}"
                                    name="dep_date" id="new_dep_date" class="form-control  "
                                    placeholder="Departure Date">
                                <!--<input type="text" value="{{ \Carbon\Carbon::parse($booking_detail->departDate)->format('Y-m-d') }}" name="dep_date" id="new_dep_date"-->
                                <!--       data-validate="required" data-message-required="Date is Required."-->
                                <!--       class="form-control dpd1" placeholder="Departure Date"-->
                                <!--       data-format="dd-mm-yyyy" data-start-date="+1">-->
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">

                            <label for="field-1" class="col-sm-12 control-label"> Departure Time</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="departure_time"
                                    value="{{ \Carbon\Carbon::parse($booking_detail->departDate)->format('H:i') }}"
                                    id="new_departure_time">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-12 control-label">Return Date</label>
                            <div class="col-sm-12">
                                <input type="date"
                                    value="{{ \Carbon\Carbon::parse($booking_detail->returnDate)->format('Y-m-d') }}"
                                    name="return_date" id="new_return_date" data-validate="required"
                                    data-message-required="Date is Required." class="form-control"
                                    placeholder="Return Date" data-format="dd-mm-yyyy">
                                <!--<input type="text" value="{{ \Carbon\Carbon::parse($booking_detail->returnDate)->format('Y-m-d') }}" name="return_date" id="new_return_date"-->
                                <!--       data-validate="required" data-message-required="Date is Required."-->
                                <!--       class="form-control dpd2" placeholder="Return Date" data-format="dd-mm-yyyy">-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-12 control-label">Return Time</label>

                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="return_time"
                                    value="{{ \Carbon\Carbon::parse($booking_detail->returnDate)->format('H:i') }}"
                                    id="new_return_time">

                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-12 control-label">Promo Code</label>
                            <div class="col-sm-12">
                                <input type="text" name="discount_code" value="{{ $booking_detail->discount_code }}"
                                    id="new_promo" class="form-control">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-12 control-label">Reference</label>
                            <div class="col-sm-12">
                                <input type="text" name="referenceNo" id="new_reff" class="form-control"
                                    value="{{ $booking_detail->referenceNo }}" readonly>
                            </div>

                            <input type="hidden" name="total_amount_booking_old" id="total_amount_booking_old"
                                class="form-control" value="{{ $booking_detail->total_amount }}">

                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-12 control-label">&nbsp;
                            </label>
                            <div class="col-sm-12">
                                <button class="btn btn-info quote-btn btn-sm update_and_quote" type="button"
                                    id="updateQuoteButton" disabled onclick="get_parking_prices()"> Update & Get Quote
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="new_payment_details" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Payment Details </h4>
            </div>
            <div class="modal-body" id=" ">
                <form method="post" id="tempororyBookingFrom" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="price_difference" id="new_price_difference">
                    <input type="hidden" name="difference_type" id="new_difference_type">
                    <input type="hidden" name="departure_date_time" id="departure_date_time">
                    <input type="hidden" name="anew_departure_time" id="anew_departure_time" value="">
                    <input type="hidden" name="anew_return_time" id="anew_return_time" value="">
                    <input type="hidden" name="return_date_time" id="return_date_time">
                    <input type="hidden" name="booking_reference" value="{{ $booking_detail->referenceNo }}">
                    <input type="hidden" name="promo_code" id="new_promo_code">
                    <input type="hidden" name="previous_booking_price" value="{{ $booking_detail->total_amount }}">
                    <input type="hidden" name="new_booking_price" id="new_booking_price">
                    <input type="hidden" name="booking_id" value="{{ $booking_detail->id }}">
                    <input type="hidden" name="customer_id" value="{{ $booking_detail->companyId }}">
                    <input type="hidden" name="new_no_of_days" id="new_no_of_days" value="">
                    <table class="table table-striped">
                        <tr>
                            <th colspan="6" class="text-center">
                                <h4 style="font-family: revert;font-weight:600"> Previous Details </h4>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <h6> Departure Date </h6>
                                
                                <h5> {{ \Carbon\Carbon::parse($booking_detail->departDate)->format('Y-m-d') }} </h5>
                            </th>
                            <th>
                                <h6> Departure Time </h6>
                                <h5> {{ \Carbon\Carbon::parse($booking_detail->departDate)->format('H:i') }}</h5>
                            </th>

                            <th>
                                <h6> Return Date </h6>
                                <h5> {{ \Carbon\Carbon::parse($booking_detail->returnDate)->format('Y-m-d') }} </h5>
                            </th>

                            <th>
                                <h6> Return Time </h6>
                                <h5> {{ \Carbon\Carbon::parse($booking_detail->returnDate)->format('H:i') }}</h5>
                            </th>

                            <th>
                                <h6> Promo Code </h6>
                                <h5>
                                    @if ($booking_detail->discount_code != '')
                                        {{ $booking_detail->discount_code }}
                                    @else
                                        --
                                    @endif
                                </h5>
                            </th>

                            <th>
                                <h6 class="text-danger"> Price </h6>
                                <h5 class="text-danger">
                                    {{ $booking_detail->total_amount }}
                                </h5>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="6" class="text-center">
                                <h4 style="font-family: revert;font-weight:600"> New Details </h4>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                <h6> Departure Date </h6>
                               
                                <h5 class="updated_departure_date"></h5>
                            </th>
                            <th>
                                <h6> Departure Time </h6>
                                <h5 class="updated_departure_time"></h5>
                            </th>

                            <th>
                                <h6> Return Date </h6>
                                <h5 class="updated_return_date"></h5>
                            </th>

                            <th>
                                <h6> Return Time </h6>
                                <h5 class="updated_return_time"></h5>
                            </th>

                            <th>
                                <h6> Promo Code </h6>
                                <h5 class="new_promo_code"></h5>
                            </th>

                            <th>
                                <h6 class="text-danger"> Price Difference </h6>

                                <h5 class="text-danger price_difference"> </h5>
                            </th>
                        </tr>

                        <tr>
                            <th colspan="6" class="text-center">
                                <button class="btn btn-sm btn-info" id="saveTempororyFrom" type="button"
                                    style="border-radius: 0">
                                    Update Data
                                </button>
                            </th>
                        </tr>
                        <tr class=" payment_link_wrapper hideMe">
                            <th colspan="6" class="text-center">
                                <h4 class="text-center" style="font-weight:bold"> Payment Link </h4>
                                <h5 class="text-center paymentLinkUrl" style="font-weight:bold"></h5>
                                <p class="note text-center hideMe" style="padding:8px"></p>
                            </th>
                        </tr>

                        <tr class=" payment_link_error_wrapper hideMe">
                            <th colspan="6" class="text-center text-danger">
                                <h5 class="text-center payment_error_link"></h5>
                            </th>
                        </tr>


                    </table>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="airport_modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Select Company</h4>
            </div>
            <div class="modal-body" id="step_2_companies">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src='{{ secure_asset("assets/js/moment.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootstrap-timepicker.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootstrap-datetimepicker.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/wizard.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/jquery.validate.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/jquery-additional-methods.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootbox.js") }}'></script>
<script src='{{ secure_asset("assets/js/jquery.maskedinput.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/select2.min.js") }}'></script>
<script src='{{ secure_asset("assets/front/js/bootstrap-datepicker.js") }}'></script>
<script src='{{ secure_asset("assets/front/js/custom-date-picker.js") }}'></script>
<script src="https://getaddress.io/js/jquery.getAddress-2.0.8.min.js"></script>





<script src='{{ secure_asset("assets/js/daterangepicker.min.js") }}'></script>

<script src='{{ secure_asset("assets/js/bootstrap-datepicker.min.js") }}'></script>

<!-- page specific plugin scripts -->

{{--<script src='{{ secure_asset("assets/js/jquery.min.js") }}'></script>--}}

<script type="text/javascript">
    // $(function () {
    //     $('#new_departure_time').timepicker({
    //         showMeridian: false,
    //         showInputs: true
    //     });
    // });
    
    
    
    $('#new_departure_time').timepicker({
                minuteStep: 15,
                showSeconds: false,
                showMeridian: false,
                disableFocus: true,
                icons: {
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down'
                }
            }).on('focus', function () {
                // $('#new_departure_time').timepicker('showWidget');
            }).next().on(ace.click_event, function () {
                $(this).prev().focus();
            });
     $('#new_return_time').timepicker({
                minuteStep: 15,
                showSeconds: false,
                showMeridian: false,
                disableFocus: true,
                icons: {
                    up: 'fa fa-chevron-up',
                    down: 'fa fa-chevron-down'
                }
            }).on('focus', function () {
                $('#new_return_time').timepicker('showWidget');
            }).next().on(ace.click_event, function () {
                $(this).prev().focus();
            });
</script>