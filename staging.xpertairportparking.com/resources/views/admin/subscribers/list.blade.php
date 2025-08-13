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
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}" />
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
                Subscribers
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12 floatNone">
                <!-- PAGE CONTENT BEGINS -->

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <div class="row">
                                        {{ Form::open(['route' => 'subscribers.index', 'method' => 'get']) }}
                                            <div class="col-lg-2 col-md-6 col-sm-12 mb-2">
                                                {{ Form::label('airport_id', 'Airport', ['class' => 'form-label']) }}
                                                {{ Form::select('airport_id', $airportsList, Request::get('airport_id'), ['class' => 'form-control']) }}
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-12 mb-2">
                                                {{ Form::label('downloaded', 'Has Downloaded', ['class' => 'form-label']) }}
                                                {{ Form::select('downloaded', ['all' => 'All', 'Yes' => 'Yes', 'No' => 'No'], Request::get('downloaded'), ['class' => 'form-control']) }}
                                            </div>
                                            <div class="col-lg-2 col-md-6 col-sm-12 mb-2">
                                                <div class="d-flex justify-content-start align-items-center mt-20">
                                                    <input value="Search" type="submit" class="btn btn-sm btn-success w-100" />
                                                    <a href="{{ route('subscribers.index') }}" class="btn btn-sm btn-primary w-100 ml-5">Reset</a>
                                                </div>
                                            </div>
                                        {{ Form::close() }}
                                    </div>

                    </div>

                    <!--<a id="excel" class="btn btn-primary btn-xs" style="float: right;"-->
                    <!--    href='{{ route('export_subscriber_excel') }}'><i class="fa fa-file-excel-o"></i> Download Excel</a>-->
                    {{-- <a style="float: right; margin-bottom: 9px;" class="btn btn-success" --}}
                    {{-- href="{{ route("pages.create") }}"> Add New</a> --}}
                    <div class="table table-responsive mt-20">
                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                                <tr>

                                    <!--th>Name</th-->
                                    <th>Email</th>
                                    <th>Airport</th>
                                    <th>Has Download</th>
                                    <th class="exclude">Action</th>


                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($subscribers as $sub)
                                    <tr>


                                        <!--td class="">{{ $sub->name }}</td-->
                                        <td class="">{{ $sub->email }}</td>
                                        <td class="">
                                            @if ($sub->airport)
                                                {{ $sub->airport->name }}
                                            @endif
                                        </td>
                                        <td class="">{{ $sub->download }}</td>


                                        <td class="exclude">
                                            <div class=" btn-group">
                                                @can('user_auth', ['edit'])
                                                    <form method="POST" style="margin-right: 5px; float: left"
                                                        onsubmit="return confirm('Are you sure?')"
                                                        action="{{ route('subscribers.destroy', [$sub->id]) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-xs btn-danger">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </button>
                                                    </form>
                                                @endcan


                                                </a>


                                            </div>


                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>


            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div>
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
