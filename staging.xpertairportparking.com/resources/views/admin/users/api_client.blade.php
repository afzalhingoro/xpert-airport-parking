
 @extends('admin.layout.master')

@section('stylesheets')
    @parent

    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />

    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}" />

    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}" />

    <link rel="stylesheet" href=" {{ asset('assets/css/admin.css') }}" />

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />

    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}" />
@endsection

@section('content')


    <div class="page-content">





        <div class="page-header">

            <h1>

                Api Client

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

                <div class="row">

                    <div class="col-xs-12">

                        <!-- PAGE CONTENT BEGINS -->

                        <div class="row">


                             
                            <div class="col-md-10">



                            </div>

 
                                <div class="col-md-2">
 
                                        <a class="btn btn-success addNewBtn"
                                            href="{{ route('register_api_client') }}">

                                            Add New</a>
                             


                            </div>

                        </div>

                        <div class="table-responsive">



                           <table id="dynamic-table" class="table table-striped table-bordered table-hover userTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Access Token</th>
            <th>Partner Name</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->access_token }}</td>
            <td>{{ $user->partner->username ?? 'N/A' }}</td> <!-- Show Partner Name -->
            <td>
                @if ($user->status == '1')
                    <span class="label label-sm label-success">Active</span>
                @else
                    <span class="label label-sm label-warning">Inactive</span>
                @endif
            </td>
            <td>
          <form method="POST" onsubmit="return confirm('Are you sure?')" action="{{ route('deleteapiclient', $user->id) }}">
    @csrf
     <button type="submit" class="btn btn-xs btn-danger">
        <i class="ace-icon fa fa-trash-o bigger-120"></i>
    </button>
</form>


                    <a href="{{ route('edit_api_client', $user->id) }}" class="btn btn-xs btn-info">
                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                    </a>
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