@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <!-- <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}" /> -->
    <!-- <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}" /> -->
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
    <!-- <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}" /> -->
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  
@endsection
@section('content')
    <div class="page-content netEarning">


        <div class="page-header">
            <h1>
                Net Earnings
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-md-12 floatNone">
                
                <form action="{{ route('net.earnings') }}" method="get" class="form-inline mb-10"> 
                <input type="hidden" name="q" value="q" />

                    <div class="row">
                    <div class="col-md-2 ">
	                    <div class="form-group form_data">
	                        <label>From</label>
	                          
	                        <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control input-sm datepicker" placeholder="Start Date" 
	                        data-date-format="dd-M-yyyy" value="{{ request('start_date', date('d-M-Y')) }}" required>
	                    </div>
                    </div>
                    <div class="col-md-2 ">
	                    <div class="form-group form_data">
	                        <label>To</label>
	                        <input class="form-control input-sm date-picker"
	                          
	                       autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text"  data-date-format="dd-M-yyyy"  value="{{ request('end_date', date('d-M-Y')) }}"   required> 
	                    </div>   
                    </div>
                    <div class="col-md-2 ">
	                    <div class="form-group form_data">
	                        <label>Traffic Source</label>
	                        <select name="traffic_src" class="form-control">
	                                <option value="all" {{ request('traffic_src') == 'all' ? 'selected' : '' }}>All</option>
	                                <option value="Agent" {{ request('traffic_src') == 'Agent' ? 'selected' : '' }}>Agent</option>
	                                <option value="API" {{ request('traffic_src') == 'API' ? 'selected' : '' }}>API</option>
	                        </select>
	                    </div> 
                    </div>
                    <div class="col-md-2 "> 
	                     <div class="form-group form_data">
	                        <label>Agent </label>
	                        <select name="agent" class="form-control">
	                           <option value="all" {{ request('agent') == 'all' ? 'selected' : '' }}>All</option>
	                            @foreach($agents as $agent)
	                                <option value="{{ $agent->id }}" {{ request('agent') == $agent->id ? 'selected' : '' }}>{{ $agent->company }}</option>
	                            @endforeach
	                        </select>
	                    </div>  
                    </div> 
                    
                    <div class="col-md-3 ">
	                    <div class="form-group sh mt-30">
	                        <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
	                        <a href='{{ route('net.earnings') }}' class="btn btn-primary btn-sm">Reset</a>
	                    </div>
                    </div>
                    </div>
                </form>  
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
                         @if(count($bookings) > 0) 
                           
                                <div >
                                    <button type="button"  class="btn btn-sm btn-info"> Total Bookings : {{ $totalBookings }}  </button>
                                </div>     
                             
                           @endif    
                       
                        <hr/>
                        <div class="table table-responsive">
                            <table id="example" class="display nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Reference No</th>
                                        <th>Booking Amount</th>
                                        <th>Discount Amount</th>
                                        <th>Partner Commesion %</th>
                                        <!--<th>Refund Amount</th>-->
                                        <th>Net Total</th>
                                        <th> created at </th>
                                         <th> Agent </th>
                                          <th> Traffic Source </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $total_booking_amount = 0;
                                    $total_discount_amount = 0;
                                    $total_revenue = 0; 
                                @endphp

                                    @foreach ($bookings as $booking)
                                     
                                    @php
                                    
                                        $discount_amount = $booking->discount_amount;
                                        
                                        $bookingAmount = $booking->booking_amount;
                                        
                                        $booking_extra = $booking->booking_extra;
                                        
                                        $extra_amount = $booking->extra_amount;
                                        
                                        $smsfee = $booking->smsfee;
                                        
                                        $postal_fee = $booking->postal_fee;
                                        
                                        $cancelfee = $booking->cancelfee;
                                        
                                        $leavy_fee = $booking->leavy_fee;
                                        
                                        $total_amount = $booking->total_amount;
                                        
                                        $valet_amount = $booking->valet_amount;
                                        
                                        $booking_fee = $booking->booking_fee;
                                        if($booking->agentID == 7){
                                            $commissionRate = 100;
                                        }else{
                                            $commissionRate = $booking->partner->share;
                                        }
                                        
                                        
                                        
                                        
                                        $commissionRateDecimal = $commissionRate / 100;
                                        
                                        $totalCommission = $commissionRateDecimal * $bookingAmount;
                                        
                                        $othersAmount = ($booking_fee + $smsfee + $cancelfee + $extra_amount + $booking_extra + $postal_fee + $valet_amount );
                                        
                                        $grossTotal = ($bookingAmount );
                                        
                                        $refundAmount = ($total_amount - $othersAmount);
                                        
                                        if($booking->agentID == 7){ 
                                            $netTotal = ($total_amount - $discount_amount);
                                        }else{
                                             $netTotal = ($grossTotal - $discount_amount - $totalCommission);
                                        }
                                        
                                       
                    
                                    @endphp
                                    <tr>
                                            <td class="w-14-per">
                                                {{ $booking['referenceNo'] }}
                                            </td>
                                            <td class="">
                                                {{ $grossTotal }}
                                            </td>
                                            <td class="">
                                                {{ $discount_amount }}
                                            </td>
                                            <td class="">
                                                {{ number_format($commissionRate) }}  %
                                                
                                            </td>

                                            <!--<td class="">-->
                                            <!--    {{ number_format($refundAmount) }}-->
                                            <!--</td>-->

                                            <td class="">
                                                {{ $netTotal }}
                                            </td>
                                               <td class="">
                                                {{  ($booking->created_at) }}
                                            </td>
                                              <td class="">
                                                  
                                                {{  ($booking->partner->company) }}
                                            </td>
                                             <td class="">
                                                {{  ($booking->traffic_src) }}
                                            </td>
                                        </tr>

 
                                        @php
                                        $total_booking_amount = $total_booking_amount + $grossTotal;
                                        $total_discount_amount = $total_discount_amount + $discount_amount;
                                        $total_revenue = $total_revenue + $netTotal;
                                        
                                        @endphp                                    
                                    
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="totalEarn"><b>Total:</b></td>

                                        <td><b > {{ $total_booking_amount}} </b></td>
                                        
                                        <td><b> {{ $total_discount_amount }} </b></td>
                                        <td><b>  </b></td>
                                        <td><b > {{ $total_revenue}} </b></td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                        </div><!-- /.span -->
                    </div><!-- /.row -->


                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
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
