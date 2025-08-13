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
@endsection
@section('content')
    <style>
        /*
        Label the data
        */

        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {
            td:nth-of-type(1):before {
                content: "   Title    ";
            }

            td:nth-of-type(2):before {
                content: "Type";
            }

            td:nth-of-type(3):before {
                content: "Status";
            }
        }
    </style>
    <div class="page-content">


        <div class="page-header">
            <h1>
                Faqs
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

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
                        @can('user_auth', ['add'])
                            <a style="float: right; margin-bottom: 9px;" class="btn btn-success"
                                href="{{ route('faqs.create') }}"> Add New</a>
                        @endcan
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>

                            <th>Title</th>
                            <th>Type</th>

                            <th>Status</th>


                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($faqs as $faq)
                            <tr>


                                <td class="">{{ $faq->title }}</td>
                                <td class="">{{ $faq->type }}</td>
                                <td class="">
                                    @if ($faq->status == 'Yes')
                                        {{ 'Active' }}
                                    @else
                                        {{ 'Inactive' }}
                                    @endif
                                </td>


                                <td>
                                    <div class="btn-group">

                                        @can('user_auth', ['delete'])
                                            <form method="POST" style="margin-right: 5px; float: left"
                                                onsubmit="return confirm('Are you sure?')"
                                                action="{{ route('faqs.destroy', $faq->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="btn btn-xs btn-danger">
                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                </button>
                                            </form>
                                        @endcan
                                        </a>
                                        @can('user_auth', ['edit'])
                                            <a href="{{ route('faqs.edit', $faq->id) }}">
                                                <button class="btn btn-xs btn-info">
                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                </button>
                                            </a>
                                        @endcan

                                    </div>


                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                </div>
            </div>

        </div><!-- /.span -->
    </div><!-- /.row -->


    <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
    </div><!-- /.row -->

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
@endsection
@section('footer-script')
    <script src="{{ secure_asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ secure_asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('assets/js/dataTables.buttons.min.js') }}"></script>


    <!-- inline scripts related to this page -->
    <script type="text/javascript">
        jQuery(function($) {
            //initiate dataTables plugin
            var myTable =
                $('#dynamic-table')
                //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
                .DataTable({
                    bAutoWidth: false,
                    // "aoColumns": [
                    //   { "bSortable": false },
                    //   null, null,null, null, null,
                    //   { "bSortable": false }
                    // ],
                    // "aaSorting": [],


                    //"bProcessing": true,
                    //"bServerSide": true,
                    //"sAjaxSource": "http://127.0.0.1/table.php"   ,

                    //,
                    //"sScrollY": "200px",
                    //"bPaginate": false,

                    //"sScrollX": "100%",
                    //"sScrollXInner": "120%",
                    //"bScrollCollapse": true,
                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element

                    //"iDisplayLength": 50


                    select: {
                        style: 'multi'
                    }
                });














            /////////////////////////////////
            //table checkboxes
            $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);





            $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
                e.stopImmediatePropagation();
                e.stopPropagation();
                e.preventDefault();
            });




        })
    </script>
@endsection
