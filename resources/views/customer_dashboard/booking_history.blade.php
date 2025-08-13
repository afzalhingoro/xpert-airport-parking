@extends('customer_dashboard.layouts.master')

@section('content')
    <link rel="stylesheet" href="/customer-assets/backend/assets/vendors/simple-datatables/style.css">


    <section class="section">

        <h2>Booking History</h2>
        <div class="card">
            <div class="card-body">
                @if (!$errors->ticket_store->isEmpty())
                    <div class="alert alert-danger alert-sm">
                        <ul>
                            @foreach ($errors->ticket_store->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Reference No</th>
                            <th>Name</th>
                            <th>Booking Date</th>
                            <th>Departure Date</th>
                            <th>Return Date</th>
                            <th>Booking status</th>
                            <th>Net Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $booking->referenceNo }}</td>
                                <td>{{ $booking->first_name . ' ' . $booking->last_name }}</td>
                                <td>{{ $booking->created_at }}</td>
                                <td>{{ $booking->departDate }}</td>
                                <td>{{ $booking->returnDate }}</td>
                                <td>{{ $booking->booking_status }}</td>
                                <td>{{ $booking->total_amount }}</td>
                                <td>
                                  
                                    <button type="button" data-toggle="modal" data-target="#bookingDetailModal"
                                        class="show_booking_details btn btn-sm btn-primary" style="padding-top:7px"
                                        data-bookingReference="{{ $booking->referenceNo }}"
                                        data-first_name="{{ $booking->first_name }}"
                                        data-phone_number="{{ $booking->phone_number }}"
                                        data-email="{{ $booking->email }}"
                                        data-departure_date="{{ $booking->departDate }}"
                                        data-departure_time="{{ $booking->departDate }}"
                                        data-return_date="{{ $booking->returnDate }}"
                                        data-return_time="{{ $booking->returnDate }}"
                                        data-booking_company="{{ $booking->company->name }}"
                                        data-booking_dept_flight="{{ $booking->deptFlight }}"
                                        data-booking_depr_terminal="{{ $booking->dterminal->name }}"
                                        data-booking_return_terminal="{{ $booking->rterminal->name }}"
                                        data-booking_return_flight="{{ $booking->returnFlight }}"
                                        data-car_make="{{ $booking->make }}" data-car_model="{{ $booking->model }}"
                                        data-car_color="{{ $booking->color }}"
                                        data-car_registration="{{ $booking->registration }}">
                                        <i class="bi bi-eye"></i>
                                    </button>

                                    <button type="button" data-toggle="modal" data-target="#exampleModal"
                                        style="padding-top:7px" class="show_details btn btn-sm btn-info"
                                        data-bookingReference="{{ $booking->referenceNo }}">
                                        <i class="bi bi-headset"></i>
                                    </button>


                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Customer Support Help Desk </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="bookiing-form-wrap block_box fl-wrap">
                            <!--   list-single-main-item -->
                            <div class="list-single-main-item fl-wrap hidden-section tr-sec">
                                <div class="profile-edit-container">
                                    <div class="support-bg">
                                        <form id="js_contact-form" action='{{ route('submit-ticket') }}' method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="portal" value="customer" required>
                                            <div class="row mb-3">
                                                <div class="col-sm-4">
                                                    <label class="form-label">Booking Reference No.</label>
                                                    <input type="text" class="form-control" id="ref_no" name="ref_no"
                                                        placeholder="ADP-XXXXXXXXX" required=""
                                                        value='{{ Request::old('ref_no') }}' autofocus="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class="form-label">Full Name</label>
                                                    <input type="text" class="form-control" id="full_name"
                                                        name="full_name" placeholder="Full Name" required=""
                                                        value='{{ Auth::guard('customer')->user()->first_name }}'
                                                        autofocus="">
                                                </div>

                                                <div class="col-sm-4">
                                                    <label class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                        placeholder="Email" required=""
                                                        value='{{ Auth::guard('customer')->user()->email }}'
                                                        autofocus="">
                                                </div>

                                            </div>
                                            <div class="row marginrightleft0  mb-3">
                                                <div class="col-sm-4">
                                                    <label class="form-label">Mobile No.</label>
                                                    <input type="text" class="form-control" id="contact"
                                                        name="contact"
                                                        value='{{ Auth::guard('customer')->user()->phone_number }}'
                                                        placeholder="XXXXXXXXX" required="" autofocus="">
                                                </div>

                                                <div class="col-xs-12 col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Support Department <span
                                                                class="required-field">*</span></label>
                                                        <select name="department" class="form-select" required>
                                                            <option selected disabled value="">Select Department
                                                            </option>
                                                            <option value="1">Booking</option>
                                                            <option value="2">Complaint</option>
                                                            <option value="3">Amendment</option>
                                                            <option value="4">Cancellation</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label">Ticket Priority <span
                                                                class="required-field">*</span></label>
                                                        <select name="priority" class="form-select" required>
                                                            <option selected disabled value="">Select Ticket Priority
                                                            </option>
                                                            <option value="Low">Low</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="High">High</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="row  mb-3">
                                                <div class="col-xs-12 col-md-12">
                                                    <div class="form-group form_left">
                                                        <label class="form-label">Ticket Subject:<span
                                                                class="required-field">*</span> </label>
                                                        <input type="text" class="form-control" id="subject"
                                                            name="subject" placeholder="Subject"
                                                            value='{{ Request::old('subject') }}' required="">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="row  mb-3">
                                                <div class="col-xs-12 col-md-12">
                                                    <div class="form-group form_left">
                                                        <label class="form-label">Ticket Message: <span
                                                                class="required-field">*</span></label>
                                                        <textarea class="form-control textarea-contact ckeditor" required rows="10" id="message" name="message"
                                                            value='{{ Request::old('message') }}' style="height: 100px;" placeholder="Type Your Message/Feedback here...">{{ Request::old('message') }}</textarea>
                                                        <input type="hidden" name="ticket_submit" value="yes">
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="row">
                                                <div class="col-xs-12 col-md-12 col-lg-12">
                                                    <div class="form-group form_left mrgin-tp">
                                                        <div class="input-file form-group" name="Fichier1">
                                                            <label class="form-label">Attachment:</label>
                                                            <input type="file"
                                                                class="form-control mt-3 mb-3 borderrediusinput"
                                                                id="inputGroupFile01" name="attatchment"
                                                                placeholder="Choose a file...">

                                                            <!--<input  type="file" class="form-control mt-3 mb-3 borderrediusinput"-->
                                                            <!--   name="attatchment" placeholder="Choose a file...">-->
                                                        </div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="clearfix"></div>
                                            <div class="col-xs-12 anchr-links">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="supportdeskpolicy" id="supportdeskpolicy" value="1"
                                                        required=""
                                                        @if (Request::old('supportdeskpolicy')) {{ 'checked' }} @endif
                                                        aria-required="true" />
                                                    <label class="form-check-label" style="padding-left: 10px;"> I Agree
                                                        To The Airport Deals Parking <a style="color:#00519A"
                                                            href="{{ route('static_page', ['page' => 'privacy-policy']) }}">Privacy
                                                            Policy </a> & <a style="color:#00519A"
                                                            href="{{ route('static_page', ['page' => 'terms-and-conditions']) }}">
                                                            Terms & Conditions</a> </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 ">
                                                <br>
                                                <button type="submit" name="submit" class="btn btn-primary"> Submit
                                                    Ticket
                                                </button>
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
        <div class="modal fade bd-example-modal-xl" id="bookingDetailModal" tabindex="-1" role="dialog"
            aria-labelledby="bookingDetailModal" aria-hidden="true">
            <div class="modal-dialog  modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Booking Details </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bookiing-form-wrap block_box fl-wrap">
                            <!--   list-single-main-item -->
                            <div class="list-single-main-item fl-wrap hidden-section tr-sec">
                                <div class="profile-edit-container">
                                    <div class="bootbox-body">
                                        <div id="booking_detail_pop" style="text-align: center;">

                                            <div style=" margin-top: 30px">
                                                <div class="row" style="margin-bottom: 10px;">
                                                    <div class="col-md-6">
                                                        <table class="table table-bordered responsive">


                                                            <tbody>
                                                                <tr>
                                                                    <td>Booking Reference:</td>
                                                                    <td class="bookingReference"> </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Name:</td>
                                                                    <td class="first_name"> </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Contact Number:</td>
                                                                    <td class="phone_number"> </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Email Address:</td>
                                                                    <td class="email"> </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Departure Date:</td>
                                                                    <td class="departDate"> </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Departure Time:</td>
                                                                    <td class="departTime"> </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Return Date:</td>
                                                                    <td class="returnDate"> </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Return Time:</td>
                                                                    <td class="returnTime"> </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Company:</td>
                                                                    <td class="companyId"> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table class="table table-bordered responsive">
                                                            <tbody>
                                                                <tr>
                                                                    <td>Departure Flight:</td>
                                                                    <td class="deptFlight"> </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Departure Terminal:</td>
                                                                    <td class="deprTerminal"> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Arrival Terminal:</td>
                                                                    <td class="returnTerminal"> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Return Flight:</td>
                                                                    <td class="returnFlight"> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Make:</td>
                                                                    <td class="make"> </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Model:</td>
                                                                    <td class="model"> </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Colour:</td>
                                                                    <td class="color"> </td>
                                                                </tr>


                                                                <tr>
                                                                    <td>Registration No:</td>
                                                                    <td class="registration"> </td>
                                                                </tr>
                                                                <tr>
                                                                    <td> -- </td>
                                                                    <td> -- </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
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
        </div>
    </section>
@endsection
@section('footer-script')
    <script src="/customer-assets/backend/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
        $(document).ready(function() {
            $('.show_details').on('click', function() {
                var bookingReference = $(this).data('bookingreference');
                $('#ref_no').val(bookingReference)
            });
            $('.show_booking_details').on('click', function() {
                var bookingdepartdate = $(this).data('departure_date');
                var bookingdepartTime = $(this).data('departure_time');
                var booking_return_date = $(this).data('return_date');
                var booking_return_time = $(this).data('return_time');
                var booking_company = $(this).data('booking_company');
                var booking_dept_flight = $(this).data('booking_dept_flight');
                var booking_depr_terminal = $(this).data('booking_depr_terminal');
                var booking_return_terminal = $(this).data('booking_return_terminal');
                var booking_return_flight = $(this).data('booking_return_flight');
                var car_make = $(this).data('car_make');
                var car_model = $(this).data('car_model');
                var car_color = $(this).data('car_color');
                var car_registration = $(this).data('car_registration');
                $('.bookingReference').html($(this).data('bookingreference'));
                $('.first_name').html($(this).data('first_name'));
                $('.phone_number').html($(this).data('phone_number'));
                $('.email').html($(this).data('email'));
                $('.departDate').html(bookingdepartdate);
                $('.departTime').html(bookingdepartTime);
                $('.returnDate').html(booking_return_date);
                $('.returnTime').html(booking_return_time);
                $('.companyId').html(booking_company);

                $('.deptFlight').html(booking_dept_flight);
                $('.deprTerminal').html(booking_depr_terminal);
                $('.returnTerminal').html(booking_return_terminal);
                $('.returnFlight').html(booking_return_flight);

                $('.make').html(car_make);
                $('.model').html(car_model);
                $('.color').html(car_color);
                $('.registration').html(car_registration);
            });
        });
    </script>
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}")
        </script>
    @endif
@endsection
