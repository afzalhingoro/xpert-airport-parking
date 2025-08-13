@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}"/>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

@endsection
@section('content')

    <div class="page-content">

        <div class="page-header">
            <h1>
               Price Statistics Report
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="col-xs-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                
                    <form action="{{ route('day_wise_Booking') }}" method="get" class="form-inline mb-10">
                        <div class="col-md-2">
                            <div class="form-group form_data">
                                <label>From</label>
                                <input type="text" name="start_date" id="start_date" autocomplete="off"
                                       class="form-control input-sm datepicker" placeholder="Start Date"
                                       data-date-format="dd-M-yyyy" value="{{ Request::get('start_date') }}"
                                       >
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group form_data">
                                <label>To</label>
                                <input class="form-control input-sm date-picker" value="{{ Request::get('end_date') }}"
                                       autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text"
                                       data-date-format="dd-M-yyyy"/>
    
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="form-group mt-30">
                                <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm">
                                <a href="{{ route('day_wise_Booking') }}" class="btn btn-primary btn-sm">Reset</a>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" style="display:none;">
                                Days
                                <select name="no_of_days" class="form-control input-sm" >
                                    <option value="all">All</option>
                                    @php
                                        for ($j = 1; $j <= 30; $j++){
                                    @endphp
                                    <option value="{{ $j }}" @if(Request::get('no_of_days')==$j) {{ "selected='selected'" }} @endif >{{  $j }}</option>
                                    @php
                                        }
                                    @endphp
                                    <option value="30+" @if(Request::get('no_of_days')=="30+") {{ "selected='selected'" }} @endif >Over 30</option>
                                </select>
                            </div>
                        </div>
                    </form>
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

								<div id="sms_response"></div>
                            <div class="table-responsive mt-20">
                                <table id="example" class="display nowrap mt-20 w-100">
                                    <thead>
                                        <tr>
                                             <th class="w-50"> S/No</th>
                                        <th>Date</th>
                                        <th>Day</th>
                                        <th>Departure (New Cars in System)</th>
                                        <th>Arrivals (Cars Leaving the System)</th>
                                        <!--<th>New Bookings</th>-->
                                        @if($role_name!="Controller")
                                        @can('user_auth', ["Amounts"])
                                        <th>Revenue(For Both)</th>
                                        @endcan
                                        @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php $i=0;?>

                                    @foreach($result as $row)
                                        <tr>
                                            <td>

                                                {{$i+1}}

                                            </td>
                                            <td>{{$row['nextday']}}</td>
                                            <td>{{$row['dayName']}}</td>
                                            <td>{{$row['departure']}}</td>
                                            <td>{{$row['arrivals']}}</td>
                                            <!--<td>{{$row['bookings']}}</td>-->
                                            @if($role_name!="Controller")
                                            @can('user_auth', ["Amounts"])
                                            <td>{{$row['revenue']}}</td>
                                            @endcan
                                            @endif
                                        </tr>
                                    <?php $i++ ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                
                            </div>



                            </div><!-- /.span -->
                        </div><!-- /.row -->


                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>

@endsection

@section("footer-script")
<script src='{{ secure_asset("assets/js/moment.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/daterangepicker.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootstrap-datetimepicker.min.js") }}'></script>

<script src='{{ secure_asset("assets/js/bootstrap-datepicker.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootstrap-timepicker.min.js") }}'></script>


<!-- page specific plugin scripts -->
<script src='{{ secure_asset("assets/js/wizard.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/jquery.validate.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/jquery-additional-methods.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootbox.js") }}'></script>
{{--<script src='{{ secure_asset("assets/js/jquery.min.js") }}'></script>--}}
<script src='{{ secure_asset("assets/js/select2.min.js") }}'></script>
<script type="text/javascript">


	$('#start_date').datepicker({
		autoclose: true,
		todayHighlight: true,
		allowPast: false,
	})
	//show datepicker when clicking on the icon
		.next().on(ace.click_event, function () {
		$(this).prev().focus();
	});


	$('#end_date').datepicker({
		autoclose: true,
		todayHighlight: true
	})
	//show datepicker when clicking on the icon
		.next().on(ace.click_event, function () {
		$(this).prev().focus();
	});

</script>



<script src='{{ secure_asset("assets/front/js/bootbox.js") }}'></script>
<script>

	function show_detal(id) {
		console.log('test');
		if ($("#show_detail_icon_" + id).hasClass("fa-plus-circle")) {
			$("#show_detail_icon_" + id).removeClass("fa-plus-circle");
			$("#show_detail_icon_" + id).addClass("fa-minus-circle");
		} else {
			$("#show_detail_icon_" + id).removeClass("fa-minus-circle");
			$("#show_detail_icon_" + id).addClass("fa-plus-circle");
		}
		console.log('test');

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
			"                        <input  onclick=\"sendEmail('" + id + "','" + cmpID + "')\" class=\"btn btn-info\" value=\"Send\" style=\"margin: 15px 5px 5px 15px;\">\n" +
			"                        </div>");
	}

	function sendEmail(id, cid) {
		var type = $('input[name=resendEmailto]:checked').val();
		$("#resend_email").html("<div id=\"resend_email\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");

		var data = {};
		data["id"] = id;
		data["cid"] = cid;
		data["type"] = type;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("booking.sendEmailBooking") }}', data, function (data) {
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
		}
		else {
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
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.show") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}


	function getcancelForm(id) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.cancelForm") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}

	function getrefundForm(id) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.refundForm") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}


	function transferSubmit(id) {
		var cid = $("#company_id_pop option:selected").val();
		var html = "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>";
		$("#booking_detail_pop").html(html);
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		data["new_cid"] = cid;
		$.post('{{ route("transferBooking") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}


	function getTransferForm(url) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		// data["id"]=id;
		data["_token"] = '{{ csrf_token() }}';
		$.get(url, data, function (data) {
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
	function sendsms(phone_no,ref_no){
		var data = {};
		var url ='{{ url("admin/send_sms") }}/'+phone_no+'/'+ref_no;

		data["_token"] = '{{ csrf_token() }}';
		$.get(url,  function (data) {

			if(data == 200){
				$("#sms_response").html('<div class="alert alert-success"><strong>Success!</strong> SMS Successfully sent.</div>');
			}
			else{
				$("#sms_response").html('<div class="alert alert-danger"><strong>Error!</strong> SMS sending failed.</div>');
			}

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
