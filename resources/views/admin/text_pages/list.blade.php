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
@endsection
@section('content')
    <style>
        /*
        Label the data
        */
        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {
            td:nth-of-type(1):before {
                content: " Title ";
            }

            td:nth-of-type(2):before {
                content: "Url";
            }

            td:nth-of-type(3):before {
                content: "Type";
            }

            td:nth-of-type(4):before {
                content: "Page Keyword";
            }

            td:nth-of-type(5):before {
                content: "Status";
            }

            td:nth-of-type(6):before {
                content: "Action";
            }
        }
    </style>

    <div class="page-content">


        <div class="page-header">
            <h1>
                Pages
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
                        <div class="row">
                            <div class="col-lg-11 col-md-12">
                                <form action="{{ route('pages.index') }}">
                                    <input type="text" class="input-sm" value="{{ Request::get('name') }}" name="name"
                                        placeholder="Search here..." />
                                    <select name="airport" class="input-sm">
                                        <option value="all">All Types</option>
                                        <option value="page"
                                            @if (Request::get('airport') == 'page') {{ "selected='selected'" }} @endif>Page
                                        </option>
                                        <option value="post"
                                            @if (Request::get('airport') == 'post') {{ "selected='selected'" }} @endif>Post
                                        </option>
                                        <option value="main"
                                            @if (Request::get('airport') == 'main') {{ "selected='selected'" }} @endif>Main
                                        </option>
                                    </select>
                                    <input value="Search" type="submit" class="btn btn-sm btn-success" />
                                </form>
                            </div>
                            <div class="col-lg-1 col-md-12">
                                @can('user_auth', ['add'])
                                    <a style="margin: 4px 0 5px;" class="btn btn-success btn-sm"
                                        href="{{ route('pages.create') }}"> Add New</a>
                                @endcan
                            </div>
                        </div>


                        <!-- div.dataTables_borderWrap -->
                        <div class="table-responsive">

                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>


                                    <tr>

                                        <th>Page Title</th>
                                        <th>Url</th>
                                        <th>Type</th>
                                        <th>Page Keyword</th>
                                        <th>Status</th>




                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>


                                    @foreach ($pages as $page)
                                        <tr>
                                            <td class="">{{ $page->page_title }}</td>
                                            <td class="">{{ $page->slug }}</td>
                                            <td class="">{{ $page->type }}</td>
                                            <td class="">{{ $page->meta_keyword }}</td>
                                            <td class="">
                                                @if ($page->status == 'Yes')
                                                    {{ 'Active' }}
                                                @else
                                                    {{ 'Inactive' }}
                                                @endif
                                            </td>



                                            <td>
                                                <div class="action-buttons" style="display: inline-flex;">

                                                    @can('user_auth', ['edit'])
                                                        <a class="green" href="{{ route('pages.edit', $page->id) }}">
                                                            <i class="ace-icon fa fa-pencil bigger-130"></i>
                                                        </a>
                                                    @endcan
                                                    @can('user_auth', ['delete'])
                                                        <form method="POST" style="margin-right: 5px; float: left"
                                                            onsubmit="return confirm('Are you sure?')"
                                                            action="{{ route('pages.destroy', [$page->id]) }}">
                                                            {{ csrf_field() }}
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-xs btn-danger">
                                                                <i class="ace-icon fa fa-trash-o bigger-130"></i>
                                                            </button>
                                                        </form>
                                                    @endcan


                                                    <div class="hidden-md hidden-lg">
                                                        <div class="inline pos-rel">


                                                            <ul
                                                                class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">


                                                                <li>

                                                                    @can('user_auth', ['edit'])
                                                                        <a href="{{ route('pages.edit', $page->id) }}"
                                                                            class="tooltip-success" data-rel="tooltip"
                                                                            title="Edit">
                                                                            <span class="green">
                                                                                <i
                                                                                    class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                            </span>
                                                                        </a>
                                                                    </li>
                                                                @endcan
                                                                @can('user_auth', ['delete'])
                                                                    <li>



                                                                        <form method="POST"
                                                                            style="margin-right: 5px; float: left"
                                                                            onsubmit="return confirm('Are you sure?')"
                                                                            action="{{ route('pages.destroy', [$page->id]) }}">
                                                                            {{ csrf_field() }}
                                                                            {{ method_field('DELETE') }}
                                                                            <button type="submit"
                                                                                class="btn btn-xs btn-danger">
                                                                                <i
                                                                                    class="ace-icon fa fa-trash-o bigger-130"></i>
                                                                            </button>
                                                                        </form>



                                                                    </li>
                                                                @endcan
                                                            </ul>
                                                        </div>
                                                    </div>
                                            </td>
                                        </tr>
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
                    responsive: true,
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
