@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/admin.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}" />
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection
@section('content')
    <style>
        /*
        Label the data
        */

        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {
            td:nth-of-type(1):before {
                content: "   Name    ";
            }

            td:nth-of-type(2):before {
                content: "Email";
            }

            td:nth-of-type(3):before {
                content: "Airport";
            }

            td:nth-of-type(4):before {
                content: "Has Download";
            }

            td:nth-of-type(5):before {
                content: "Action";
            }

        }
    </style>
    <div class="page-content">


        <div class="page-header">
            <h1>
                Customers
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

                <!-- PAGE CONTENT BEGINS -->
                    <div class="col-xs-12 floatNone">

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <!--div class="row">

                                    {{ Form::open(['route' => 'customers.index', 'method' => 'get']) }}


                                    {{ Form::select('airport_id', $airportsList, Request::get('airport_id')) }}


                                    {{ Form::label('has_downloaded', 'Has Downloaded') }}

                                    {{ Form::select('downloaded', ['all' => 'All', 'Yes' => 'Yes', 'No' => 'No'], Request::get('downloaded')) }}

                                    <input value="Search" type="submit" class="btn btn-sm btn-success"/>
                                      <a href="{{ route('subscribers.index') }}" class="btn btn-sm btn-primary">Reset</a>
                                    {{ Form::close() }}



                            </div-->
                    </div>

                    <!--<a id="excel" class="btn btn-primary btn-xs" style="float: right;"-->
                    <!--    href='{{ route('export_customer_excel') }}'><i class="fa fa-file-excel-o"></i> Download Excel</a>-->


                    <div class="table table-responsive">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($subscribers as $sub)
                                    <tr>
                                        <td class="">{{ $sub->first_name }} {{ $sub->last_name }}</td>

                                        <td class="">{{ $sub->email }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div><!-- /.span -->


            <!-- PAGE CONTENT ENDS -->
    </div>
    <script>
        function validate(form) {

            // validation code here ...


            if (!valid) {
                alert('Please correct the errors in the form!');
                return false;
            } else {
                return confirm('Do you really want to submit the form?');
            }
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
    $('#simple-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
                'copy', 'csv', 'excel', 'print'
            ],
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(.exclude)'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(.exclude)'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':not(.exclude)'
                }
            },
            {
                extend: 'copy',
                exportOptions: {
                    columns: ':not(.exclude)'
                }
            },
            // Add other buttons as needed
        ],
        order: [],
    });
});
    </script>
@endsection
