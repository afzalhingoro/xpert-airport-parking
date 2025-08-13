@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}" />
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  
@endsection
@section('content')
    <div class="page-content notPickedReturn">


        <div class="page-header">
            <h1>
                Not Picked / Returned
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            
                
                <form action="{{ route('not.picked.returned') }}" method="get" class="form-inline mb-10"> 

                    <div class="col-md-3">
                        <div class="form-group form_data">
                             <input type="hidden" name="q" value="q" />
                            <label>From</label>
                            <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control input-sm datepicker" placeholder="Start Date" data-date-format="dd-M-yyyy" value="{{ request('start_date') }}">
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="form-group form_data">
                            <label>To</label>
                            <input class="form-control input-sm date-picker" value="{{ request('end_date') }}" autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text" data-date-format="dd-M-yyyy"> 
                        </div>  
                    </div>
                    <div class="col-md-3">
                         <div class="form-group form_data">
                            <label>Status</label>
                            <select name="type" class="form-control">
                <option value="departure_status" {{ request('type') == 'departure_status' ? 'selected' : '' }}>Departure</option>
                <option value="return_status" {{ request('type') == 'return_status' ? 'selected' : '' }}>Return</option> 
            </select> 
                        </div>  
                    </div>  
                    
                    <div class="col-md-3">
                        <div class="form-group sh mt-30">
                            <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                            <a href='{{ route('not.picked.returned') }}' class="btn btn-primary btn-sm">Reset</a>
                        </div>
                    </div>
                    
                    
                </form> 
                <div class="col-md-12">
                    <div id="accordion">
                        <div class="card">
                        <div class="card-header" id="headingOne">
                          <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     <i class="fa fa-info"></i>    Report Purpose: Not Picked and Returned
                            </button>
                          </h5>
                        </div>
                    
                        <div id="collapseOne" class="collapse  " aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                                 <b>Report Purpose: Not Picked and Returned Bookings</b>  
                                <p>
                                       This report consolidates data from our internal booking system and an external report to provide you with a detailed overview of bookings that were either not picked up or were returned within a specific timeframe. By analyzing these bookings, we gain valuable insights to enhance our services and ensure a seamless experience for you. Feel free to explore the report for a comprehensive understanding of these specific booking scenarios. If you have any questions, please reach out for assistance.
                                </p>
                           
                          </div>
                        </div>
                        <!--@if(count($bookings)>0) -->
                        <!--<div class="col-md-6 text-left section-right" style="margin-bottom: 10px "> -->
                        <!--                <button type="button" class="btn btn-sm btn-info">  Total Bookings : {{ count($bookings) }}  </button>-->
                        <!--        </div>-->
                        <!--@endif-->
                      </div> 
                    </div>
                </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="col-xs-12">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                        @if (Request::get('end_of_day'))
                            <div class="col-md-12 text-right section-right mt-10">
                                <a href="{{ route('export.filtered.data', ['end_of_day' => Request::get('end_of_day')]) }}"
                                    class="btn btn-success">Download Excel</a>
                                <br><br>
                            </div>
                        @endif
                        <div class="table table-responsive">
                            <table id="example" class="display nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Reference No</th>
                                        <th>Name</th>
                                        <th>Mobile</th> 
                                        <th>Depart Date</th>
                                        <th>Time</th>
                                        <th>Return Date</th>
                                        <th>Time</th>
                                        <!--th>Terminal</th-->
                                        <th>Car Reg</th>
                                        <th>Car Make</th>
                                        <th>Car Color</th>
                                        <th>Booking Status</th>
                                        <th>Booking Action</th>
                                        <th>Picked Status</th>
                                        <th>Returned Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td class="w-14-per">
                                                {{ $booking->referenceNo }}
                                            </td>
                                            <td class="">{{ $booking->first_name . ' ' . $booking->last_name }}
                                            </td>
                                            <td class="">{{ $booking->phone_number }}</td>
                                            <td class=""> {{ date('d-M-Y', strtotime($booking->departDate)) }}
                                            </td>
                                            <td class=""> {{ date('H:i', strtotime($booking->departDate)) }}
                                            </td>
                                            <td class=""> {{ date('d-M-Y', strtotime($booking->returnDate)) }}
                                            </td>
                                            <td class=""> {{ date('H:i', strtotime($booking->returnDate)) }}
                                            </td>
                                            <!-- class="">{{ $booking->deprTerminal }}</td-->
                                            <td class="">{{ $booking->registration }}</td>
                                            <td class="">{{ $booking->make }}</td>
                                            <td class="">{{ $booking->color }}</td>
                                            <td>{{ $booking->booking_status }}</td>
                                            <td>{{ $booking->booking_action }}</td>
                                            
                                            @if($booking->departure_status ==1)
                                                @php
                                                
                                                $pickedStauts = "Picked"
                                                @endphp
                                            @else
                                                @php
                                                $pickedStauts = "Not Picked"
                                                @endphp
                                            @endif
                                                
                                             <td>{{ $pickedStauts }}</td>
                                             
                                            @if($booking->return_status ==1)
                                                @php
                                                
                                                $returnStauts = "Returnd"
                                                @endphp
                                            @else
                                                @php
                                                $returnStauts = "Not Returnd"
                                                @endphp
                                            @endif 
                                             
                                             
                                             
                                             
                                              <td>{{ $returnStauts }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div><!-- /.span -->
                    </div><!-- /.row -->


                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    @endsection
    @section('footer-script')
        <script src="{{ secure_asset('assets/js/moment.min.js') }}"></script>
        <script src="{{ secure_asset('assets/js/daterangepicker.min.js') }}"></script>
        <script src="{{ secure_asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

        <script src="{{ secure_asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
        <script src="{{ secure_asset('assets/js/bootstrap-timepicker.min.js') }}"></script>


        <!-- page specific plugin scripts -->
        <script src="{{ secure_asset('assets/js/wizard.min.js') }}"></script>
        <script src="{{ secure_asset('assets/js/jquery.validate.min.js') }}"></script>
        <script src="{{ secure_asset('assets/js/jquery-additional-methods.min.js') }}"></script>
        <script src="{{ secure_asset('assets/js/bootbox.js') }}"></script>
        <script src="{{ secure_asset('assets/js/jquery.maskedinput.min.js') }}"></script>
        <script src="{{ secure_asset('assets/js/select2.min.js') }}"></script>
        <script type="text/javascript">
            $('#start_date').datepicker({
                    autoclose: true,
                    todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function() {
                    $(this).prev().focus();
                });


            $('#end_date').datepicker({
                    autoclose: true,
                    todayHighlight: true
                })
                //show datepicker when clicking on the icon
                .next().on(ace.click_event, function() {
                    $(this).prev().focus();
                });
        </script>
        <script src="{{ secure_asset('assets/front/js/bootbox.js') }}"></script>
        <script>
            function show_detal(id) {
                if ($("#show_detail_icon_" + id).hasClass("fa-plus-circle")) {
                    $("#show_detail_icon_" + id).removeClass("fa-plus-circle");
                    $("#show_detail_icon_" + id).addClass("fa-minus-circle");
                } else {
                    $("#show_detail_icon_" + id).removeClass("fa-minus-circle");
                    $("#show_detail_icon_" + id).addClass("fa-plus-circle");
                }

                $("#detail_" + id).toggle();
            }

            function sendEmailForm(id, cmpID) {
                ModelPopUp("<div id=\"resend_email\" ><div><h2>Resend Email</h2></div>\n" +
                    "                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
                    "<input class=\"radio-resend\" type=\"radio\" value=\"company\" name=\"resendEmailto\">Company</label>\n" +
                    "                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
                    "<input class=\"radio-resend\"  type=\"radio\" value=\"client\" name=\"resendEmailto\">Client</label>\n" +
                    "                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
                    "<input class=\"radio-resend\" type=\"radio\" value=\"all\" name=\"resendEmailto\" >ALL</label>\n" +
                    "                        <input  onclick=\"sendEmail('" + id + "','" + cmpID +
                    "')\" class=\"btn btn-info\" value=\"Send\" style=\"margin: 15px 5px 5px 15px;\">\n" +
                    "                        </div>");
            }

            function sendEmail(id, cid) {
                $("#resend_email").html(
                    "<div id=\"resend_email\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"
                );

                var data = {};
                data["id"] = id;
                data["cid"] = cid;
                data["type"] = $('input[name=resendEmailto]:checked').val();
                data["_token"] = '{{ csrf_token() }}';
                $.post('{{ route('booking.sendEmailBooking') }}', data, function(data) {
                    console.log("data===", data);
                    $("#resend_email").html(data);
                    //                        if (data.StatusCode == 0) {
                    //                            window.location.href = "https://"+window.location.hostname+"/booking/thankyou";
                    //                        } else {
                    //                            $("#error_personal_detail").html(data.Message);
                    //                        }
                });

            }

            function validate(form) {

                // validation code here ...


                if (!valid) {
                    alert('Please correct the errors in the form!');
                    return false;
                } else {
                    return confirm('Do you really want to submit the form?');
                }
            }

            //                        jQuery(function($) {
            //                            $("#view_detail").on(ace.click_event, function () {
            //
            //
            //
            //                                ModelPopUp('');
            //                            });
            //
            //
            //
            //                        });


            function getDetail(id) {
                ModelPopUp(
                    "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"
                );
                var data = {};
                data["id"] = id;
                data["_token"] = '{{ csrf_token() }}';
                $.post('{{ route('bookingdetail.show') }}', data, function(data) {
                    console.log("data===", data);
                    $("#booking_detail_pop").html(data);
                    //
                });



            }


            function getcancelForm(id) {
                ModelPopUp(
                    "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"
                );
                var data = {};
                data["id"] = id;
                data["_token"] = '{{ csrf_token() }}';
                $.post('{{ route('bookingdetail.cancelForm') }}', data, function(data) {
                    console.log("data===", data);
                    $("#booking_detail_pop").html(data);
                    //
                });



            }

            function getrefundForm(id) {
                ModelPopUp(
                    "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"
                );
                var data = {};
                data["id"] = id;
                data["_token"] = '{{ csrf_token() }}';
                $.post('{{ route('bookingdetail.refundForm') }}', data, function(data) {
                    console.log("data===", data);
                    $("#booking_detail_pop").html(data);
                    //
                });



            }


            function transferSubmit(id) {
                var html =
                    "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>";
                $("#booking_detail_pop").html(html);
                var data = {};
                data["id"] = id;
                data["_token"] = '{{ csrf_token() }}';
                data["new_cid"] = $("#company_id_pop option:selected").val();
                $.post('{{ route('transferBooking') }}', data, function(data) {
                    console.log("data===", data);
                    $("#booking_detail_pop").html(data);
                    //
                });



            }


            function getTransferForm(url) {
                ModelPopUp(
                    "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>"
                );
                var data = {};
                // data["id"]=id;
                data["_token"] = '{{ csrf_token() }}';
                $.get(url, data, function(data) {
                    console.log("data===", data);
                    $("#booking_detail_pop").html(data);
                    //
                });



            }

            function ModelPopUp(message) {
                bootbox.dialog({
                    message: message,
                    size: "large",
                    //                                buttons:
                    //                                    {
                    //                                        "success":
                    //                                            {
                    //                                                "label": "<i class='ace-icon fa fa-check'></i> Ok",
                    //                                                "className": "btn-sm btn-success",
                    //                                                "callback": function () {
                    //                                                    //Example.show("great success");
                    //                                                }
                    //                                            }
                    //                                    }
                });
            }
        </script>
        
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
            order: [],
        } );
    } );
    
    
    // $(document).ready(function () {
                
    //         $('#example').DataTable({
    //             dom: 'Brtip',
    //             buttons: [
    //                 {
    //                     extend: 'print',
    //                     exportOptions: {
    //                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
    //             }
    //                 },
    //                 {
    //                     extend: 'csv',
    //                     exportOptions: {
    //                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
    //             }
    //                 },
    //                 {
    //                     extend: 'copy',
    //                     exportOptions: {
    //                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
    //             }
    //                 },
    //                 {
    //                     extend: 'excel',
    //                     exportOptions: {
    //                 columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ]
    //             }
    //                 }
    //             ]
    //         });
    //     });

    </script>
    @endsection
