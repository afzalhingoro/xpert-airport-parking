@extends('layouts.main')
@section('stylesheets')
    <link property="stylesheet" rel='stylesheet' href='{{ secure_asset('assets/page.css') }}' type='text/css' media='all' />
@endsection
<!--
@section('title', $page->meta_title)
@section('meta_keyword', $page->meta_keyword)
@section('meta_description', $page->meta_description)
-->

 <title>Customer Support | Xpert Airport Parking</title>
    <meta name="description" content="Get help with your bookings, payments, or any questions at Xpert Airport Parking. Our dedicated support team is here to assist you with Stansted Airport parking." />
@section('content')

    <section class="support-ticket">
        <div class="row justify-content-center">
            <div class="section-heading">
                <h2 class="text-center customers mt-5 mb-5">Customer Support Help Desk</h2>
            </div>
        </div>
        <div id="overlay"></div>
        <div class="container">
            <div class="row">
                <p class="sup-p">
                    To streamline support requests, we use a ticket system where each request is assigned a unique ticket number for easy tracking. You can access the full history of your support requests online. A valid email address and booking reference are required to submit a support ticket.
                </p>
                <!--<ol class="support-list">-->
                <!--    <li>In order to streamline support requests and better serve you, we utilize a support ticket system.-->
                <!--    </li>-->
                <!--    <li>Every support request is assigned a unique ticket number which you can use to track the progress and-->
                <!--        responses online.</li>-->
                <!--    <li>For your reference we provide complete archives and history of all your support requests.</li>-->
                <!--    <li>A valid <b>Email Address & Booking Reference</b> is required to submit a support ticket.</li>-->
                <!--</ol>-->
            </div>
            <div class="row">
                <div class="inr-cnt  col-xs-12 col-sm-12 col-md-12 col-lg-9">
                    <!------starting contact us ------->
                    <!--form start---->

                    @if (!$errors->ticket_store->isEmpty())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->ticket_store->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="bookiing-form-wrap block_box fl-wrap">
                        <!--   list-single-main-item -->
                        <div class="list-single-main-item fl-wrap hidden-section tr-sec">
                            <div class="profile-edit-container">
                                <div class="support-bg">
                                    <form id="js_contact-form" action='{{ route('submit-ticket') }}' method="post"
                                        enctype="multipart/form-data">

                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <label class="form-label">Booking Reference No.:</label>
                                                <input type="text" class="form-control" id="ref_no" name="ref_no"
                                                    placeholder="XAP-XXXX" required=""
                                                    value='{{ Request::old('ref_no') }}' autofocus="">
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <label class="form-label">Full Name:</label>
                                                <input type="text" class="form-control" id="full_name" name="full_name"
                                                    placeholder="Full Name" required=""
                                                    value='{{ Request::old('full_name') }}' autofocus="">
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <label class="form-label">Email Address:</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email" required="" value='{{ Request::old('email') }}'
                                                    autofocus="">
                                            </div>

                                        </div>
                                        <div class="row marginrightleft0">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <label class="form-label">Mobile No.:</label>
                                                <input type="text" class="form-control" id="contact" name="contact"
                                                    value='{{ Request::old('contact') }}' placeholder="XXXXXXXXX"
                                                    required="" autofocus="">
                                            </div>

                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Support Department: <span
                                                            class="required-field">*</span></label>
                                                    <select name="department" class="form-select">
                                                        <option selected>Select Department</option>
                                                        <option value="1">Booking</option>
                                                        <option value="2">Complaint</option>
                                                        <option value="3">Amendment</option>
                                                        <option value="4">Cancellation</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-label">Ticket Priority: <span
                                                            class="required-field">*</span></label>
                                                    <select name="priority" class="form-select">
                                                        <option selected>Select Ticket Priority</option>
                                                        <option value="Low">Low</option>
                                                        <option value="Medium">Medium</option>
                                                        <option value="High">High</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <div class="form-group form_left">
                                                    <label class="form-label">Ticket Subject:<span
                                                            class="required-field">*</span> </label>
                                                    <input type="text" class="form-control" id="subject" name="subject"
                                                        placeholder="Subject" value='{{ Request::old('subject') }}'
                                                        required="">
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-xs-12 col-md-12">
                                                <div class="form-group form_left">
                                                    <label class="form-label">Ticket Message: <span
                                                            class="required-field">*</span></label>
                                                    <textarea class="form-control textarea-contact ckeditor" required rows="10" id="message" name="message"
                                                        value='{{ Request::old('message') }}' style="height: 100px;">{{ Request::old('message') }}
                                        </textarea>
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
                                                            class="form-control borderrediusinput"
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
                                                <input class="form-check-input" type="checkbox" name="supportdeskpolicy"
                                                    id="supportdeskpolicy" value="1" required=""
                                                    @if (Request::old('supportdeskpolicy')) {{ 'checked' }} @endif
                                                    aria-required="true" />
                                                <label class="form-check-label" style="padding-left: 10px;"> I Agree To
                                                    The Xpert Airport Parking  <a style="color:#00519A"
                                                        href="{{ route('static_page', ['page' => 'privacy-policy']) }}">Privacy
                                                        Policy </a> & <a style="color:#00519A"
                                                        href="{{ route('static_page', ['page' => 'terms-and-conditions']) }}">
                                                        Terms & Conditions</a> </label>
                                            </div>
                                            <!--<label>-->
                                            <!--    <span><input class="form-check-label" type="checkbox"-->
                                            <!--                 name="supportdeskpolicy"-->
                                            <!--                 id="supportdeskpolicy" value="1" required=""-->
                                            <!--                 @if (Request::old('supportdeskpolicy'))
                    {{ 'checked' }}
                    @endif aria-required="true"/>-->
                                                            <!--    </span><span>I Agree To The Flight Park One <a href="{{ route('static_page', ['page' => 'terms-and-conditions']) }}">Support Policy &amp; Terms of-->
                                            <!--            Service</a></span>-->
                                            <!--</label>-->
                                        </div>
                                        <div class="col-xs-12 text-center">
                                            <br>
                                            <button type="submit" name="submit" class="btn other-page-button"> Submit Ticket
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 cart_detail">
                    <div class="cart-details-wrap fl-wrap">

                        <div class="cart-details fl-wrap block_box">
                            <!--cart-details_header-->
                            <div class="cart-details_header">
                                @if (!$errors->search_ticket->isEmpty())
                                    <div class="clearfix"></div>
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->search_ticket->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <!--cart-details_header end-->
                            <!--ccart-details_text-->
                            <div class="support-bg">
                                <form action="{{ route('ticket_list') }}" method="post" class="support-form">
                                    @csrf
                                    <div class="col-sm-12">
                                        <label class="form-label">Email Address: </label>
                                        <input type="email" value="{{ Request::old('email') }}" name="email"
                                            id="tickrt_email" placeholder="Email" class="form-control" required />
                                    </div>

                                    <div class="col-sm-12">
                                        <label class="form-label">Booking Reference No.: </label>
                                        <input type="text" name="ref_no" value="{{ Request::old('ref_no') }}"
                                            id="ticket_reference" placeholder="Booking Reference" class="form-control"
                                            required="required" />
                                    </div>

                                    <div class="col-md-12 form-group text-center">
                                        <button type="submit" id="search_ticket" class="btn other-page-button">
                                            Search Support Ticket
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--cart-details_text end -->
                        </div>
                        <!--cart-details end -->
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

@endsection
@section('footer-script')
    <script>
        $(function() {
            $("#dropdatepicker12").datepicker({
                minDate: 0,
                dateFormat: 'dd/mm/yy',
                onSelect: function(dateText, inst) {

                    var date2 = $('#dropdatepicker12').datepicker('getDate', '+1d');
                    date2.setDate(date2.getDate() + 7);
                    $('#pickdatepicker12').datepicker('setDate', date2);
                }

            });
            $('#pickdatepicker12').datepicker({
                defaultDate: "+1w",
                dateFormat: 'dd/mm/yy',
                beforeShow: function() {
                    $(this).datepicker('option', 'minDate', $('#dropdatepicker12').val());
                    if ($('#dropdatepicker12').val() === '') $(this).datepicker('option', 'minDate', 0);
                }
            });
        });
    </script>
@endsection
