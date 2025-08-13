@extends('admin.layout.master')
@section('stylesheets')
@parent
<link rel="stylesheet" href="{{ secure_asset('assets/css/jquery-ui.custom.min.css') }}" />
<link rel="stylesheet" href="{{ secure_asset('assets/css/chosen.min.css') }}" />
<link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap-datepicker3.min.css') }}" />
<link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap-timepicker.min.css') }}" />
<link rel="stylesheet" href="{{ secure_asset('assets/css/daterangepicker.min.css') }}" />
<link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
<link rel="stylesheet" href="{{ secure_asset('assets/css/bootstrap-colorpicker.min.css') }}" />
<link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection
@section('content')

<div class="page-content">


    <style>
        .form-inline .form-group {
            margin-bottom: 8px;
        }

        .card {
            box-shadow: 0 2px 4px rgba(0, 0, 20, .08), 0 1px 2px rgba(0, 0, 20, .08);
            border: 0;
            border-radius: .5rem;
        }

        .text-margin {
            margin-left: 25px;
        }

        .px-3 {
            padding-right: 1rem !important;
            padding-left: 1rem !important;
        }

        .row1 {
            -bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            display: flex;
            margin-left: -20px;

        }

        .col-6 {
            flex: 0 0 auto;
            width: 50%;
        }

        .text-25 {
            font-size: 25px !important;
        }

        .text-capitalize {
            text-transform: capitalize !important;
        }

        .fw-bold {
            font-weight: 700 !important;
        }


        .text-16 {
            font-size: 16px !important;
        }

        .align-items-end {
            align-items: flex-end !important;
        }

        .flex-column {
            flex-direction: column !important;
        }

        .text-margin0 {
            margin: 0;
        }

        .mt-4 {
            margin-top: 1.25rem !important;
        }

        .px-5 {
            padding-right: 1.5rem !important;
            padding-left: 1.5rem !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .d-flex {
            display: flex !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .col-8 {
            flex: 0 0 auto;
            width: 66%;
        }

        .col-4 {
            flex: 0 0 auto;
            width: 33.33333333%;
        }

        .text-spaces {
            display: flex;
            justify-content: space-between;
        }

        .mb-3 {
            margin-bottom: 1rem !important;
        }

        .border-bottom {
            border-bottom: 3px gray solid;
        }

        .btn-margin {
            margin-top: 8%;
            margin-left: 2px;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 600;
        }

        .title {
            margin-right: 11px;
        } 
        @page {
            margin: 0px 5px 0px 5px;
        }
        @media print {
            body {
                font-family: Arial, sans-serif;
                margin: 10px;
                padding: 0;
                margin: 0px 5px 0px 5px;
            }
            h1, h2, h3 {
                /*text-align: center;*/
            }
            .table {
                width: 100%;
                margin-top: 20px;
                border-collapse: collapse;
            }
            .table, .table th, .table td {
                border: 1px solid #ddd;
            }
            .table th, .table td {
                padding: 8px;
                text-align: center;
            }
            .card {
                page-break-before: always;
             
            }
            .btn {
                display: none;
            }
            p {
                text-align: center;
            }
            .price-group, .footer-total-price{
                margin: 0;
                padding: 0;
            }
            .text-16, .total-amount, .commission-amount, .net-payable-amount{
                margin-bottom: 0 !important;
            }
            h4.text-16{
                margin-top: 8px !important;
            }
        }
    </style>

    <div class="page-header">
        <h1>
            Agent Statistics Report
            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                List
            </small>
        </h1>
    </div>

    <div class="row">

        <form action='{{ route("agent.statis.search") }}' method="get" class="form-inline mb-10">



            <!-- <div class="col-md-3" style="margin-top:-5px">
                <div class="form-group form_data">
                    <label for="">Agents</label>
                    <select name="agent" class="form-control input-sm">
                        <option value="all">All Admins</option>
 
                        @foreach($agents as $admin)
                            <option value="{{ $admin->id }}" {{ Request::get('agent') == $admin->id ? 'selected' : '' }}>
                                {{ $admin->username }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div> -->


            <div class="col-md-3">
                <div class="form-group form_data">
                    From
                    <input type="text" name="start_date" id="start_date" autocomplete="off"
                        class="form-control input-sm datepicker" placeholder="Start Date" data-date-format="dd-M-yyyy"
                        value="{{ Request::get('start_date', \Carbon\Carbon::now()->startOfMonth()->format('d-M-Y')) }}">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group form_data">
                    To
                    <input class="form-control input-sm date-picker" autocomplete="off" id="end_date"
                        placeholder="End Date" name="end_date" type="text" data-date-format="dd-M-yyyy"
                        value="{{ Request::get('end_date', \Carbon\Carbon::now()->endOfMonth()->format('d-M-Y')) }}">
                </div>
            </div>




            <div class="form-group d-flex   align-items-center mt-25">
                <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm btn-margin">
                <a href='{{ route("agent.statis") }}' class="btn btn-primary btn-sm btn-margin">Reset</a>

            </div>


        </form>
    </div>
    @if(Request::has('start_date') && Request::has('end_date'))
    <div class="text-right">
        <button class="btn btn-primary btn-sm print" onclick="printPage()">Print</button>
    </div>
    <div class="row1 hide-content print_page">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="car style="background: #fff;">


                <div class="px-  row1">
                    <div class="col-8">
                        <div class="text-margin">
                            <h2 class="text-25 fw-bold text-capitalize">Xpert Airport Parking</h2>
                 
                            <!--<h4 class="text-16">50 Princes Street, Ipswich, England, IP1 1RJ  </h4>-->

                            <h4 class="text-16">helpdesk@Xpertairportparking.com</h4>
                            <h4 class="text-16">020 3386 1809</h4>
                            <h4 class="text-16 me-3"><strong>Invoice No:</strong> {{ now()->format("Y/m/d") }}</h4>
                            <div class="invoice-from-and-to-date d-flex mt-2 mb-10">
                                <!-- Invoice Date -->
                                <h4 class="text-margin0 text-16 me-3"><strong>Invoice Date: </strong></h4>
                                <div class="d-flex">
                                    <!-- Convert start_date and end_date to Carbon instances and format them -->
                                    <h4 class="text-16 text-margin0" style="padding-left: 4px;">
                                        @if(request('start_date'))
                                            {{ \Carbon\Carbon::parse(request('start_date'))->format('Y/m/d') }}
                                        @else
                                            N/A
                                        @endif
                                       - 
                                    </h4>
                                    <h4 class="text-16 text-margin0" style="padding-left: 4px;">
                                        @if(request('end_date'))
                                            {{ \Carbon\Carbon::parse(request('end_date'))->format('Y/m/d') }}
                                        @else
                                            N/A
                                        @endif
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 d-flex flex-column align-items-end">
                        <div class="title">
                            <h3>Invoice</h3>
                        </div> 
                        <div class="site-logo mb-3"
                            style="width: 100px; height: 100px; box-shadow: rgba(0, 0, 0, 0.44) 0px 0px 3px; border-radius: 50%; padding: 10px 9px;">
                            <img alt="" loading="lazy" width="80" height="80" decoding="async" data-nimg="1"
                                src="{{ asset('theme-new/img/logo_transparent.png') }}" style="">
                        </div>
                    </div>
                </div>







            </div>
          
    <div class="car">
        <div class="px-4 pt-2 py-0 card-body">
            <div class="table-responsive">
                <table class="text-nowrap set-report-style table table-bordere table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col" class="col-4" style="background: #fff; color:#767381; ">Supplier Name</th>
                            <th scope="col" class="col-2 text-center" style="background: #fff; color:#767381; ">Total Bookings</th>
                            <th scope="col" class="col-2 text-center" style="background: #fff; color:#767381; ">Gross Amount</th>
                            <th scope="col" class="col-2 text-center" style="background: #fff; color:#767381; ">Commission</th>
                            <th scope="col" class="col-2 text-right" style="background: #fff; color:#767381;  border: 0;">Net Payable</th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach($admins as $agent)
        <tr>
            <td scope="col" class="col-4 text-capitalize">{{ $agent->username }}</td>
            <td scope="col" class="col-2 text-center">
                {{ $agentsStats[$agent->id]['booking_count'] ?? 0 }}
            </td>
            <td scope="col" class="col-2 text-center">
                {{ number_format($agentsStats[$agent->id]['total_amount'] ?? 0, 2) }}
            </td>
            <td scope="col" class="col-2 text-center">
                {{ number_format($agentsStats[$agent->id]['commission'] ?? 0, 2) }}
            </td>
            <td scope="col" class="col-2 text-right">
                {{ number_format($agentsStats[$agent->id]['net_payable'] ?? 0, 2) }}
            </td>
        </tr>
    @endforeach
</tbody>


                </table>
            </div>
        </div>

        <!-- Total summary -->
      <!-- Total summary -->
<div class="footer-total-price d-flex justify-content-space-between mt-4 px-">
    <div class="end-title col-8 d-flex align-items-center justify-content-center">
        <h3 class="text-25">Thank you for your business!</h3>
    </div>
    <div class="price-group col-4">
        <div class="total-amount d-flex align-items-center mb-3">
            <h4 class="col-6 text-16">Total Amount:</h4>
            <h4 class="col-6 border-botto text-right text-16 pb-2">
                <span class="fw-bolder">£</span>{{ number_format($totalBookingAmount, 2) }}
            </h4>
        </div>
        <div class="commission-amount d-flex align-items-center mb-3">
            <h4 class="col-6 text-16">Commission:</h4>
            <h4 class="col-6 border-botto  text-right text-16 pb-2">
                <span class="fw-bolder text-right">£</span>{{ number_format($totalCommission, 2) }}
            </h4>
        </div>
        <div class="net-payable-amount d-flex align-items-center">
            <h4 class="col-6 text-16">Net Payable:</h4>
            <h4 class="col-6 border-botto text-right text-16 pb-2">
                <span class="fw-bolder text-right">£</span>{{ number_format($totalNetPayable, 2) }}
            </h4>
        </div>
    </div>
</div>
    {{-- const printWindow = window.open('', '', 'height=600,width=800'); --}}
    <script>
        function printPage() {
            const contentToPrint = document.querySelector('.print_page').innerHTML;

            const printWindow = window.open('', '', 'height=1123,width=800');

            printWindow.document.write('<html><head><title>Invoice</title>');
            printWindow.document.write('<style>');
            const stylesheets = document.querySelectorAll('link[rel="stylesheet"], style');
            stylesheets.forEach((sheet) => {
                printWindow.document.write(sheet.outerHTML);
            });
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');
            printWindow.document.write(contentToPrint);
            printWindow.document.write('</body></html>');
            printWindow.document.close();  
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
@endif

                
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        var ba = $('#ba_total').html();
        var pz = $('#pz_total').html();
        $('#total_ba_span').html(ba);
        $('#total_pz_span').html(pz);

    });
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
</script>

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
<script src='{{ secure_asset("assets/js/jquery.maskedinput.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/select2.min.js") }}'></script>
<script type="text/javascript">


    $('#start_date').datepicker({
        autoclose: true,
        todayHighlight: true
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

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                { extend: 'print', footer: true },
                { extend: 'csv', footer: true },
                { extend: 'copy', footer: true },
                { extend: 'excel', footer: true }
            ],
            order: [],
        });
    });



</script>

@endsection