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
@endsection
@section('content')

    <div class="page-content">


        <div class="page-header">
            <h1>
                Hotels
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
                        <a style="float: right; margin-bottom: 9px;" class="btn btn-success" href="{{ route("airport.create") }}"> Add New</a>

                        <table id="simple-table" class="table  table-bordered table-hover">
                            <thead>
                            <tr>

                                <th class="detail-col">Name</th>
                                <th>Address</th>


                                <th class="hidden-480">Status</th>

                                <th></th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($airports as $airport)
                            <tr>




                                <td class="hidden-480">
                                    {{ $airport->name }}
                                </td>
                                <td>{{ $airport->address }}</td>
                                <td class="hidden-480">
                                    @if($airport->status=="Yes")
                                        <span class="label label-sm label-success">Active</span>
                                    @else
                                         <span class="label label-sm label-warning">Inactive</span>
                                    @endif


                                </td>



                                <td>
                                    <div class="hidden-sm hidden-xs btn-group">







                                        <form method="POST"  style="float: left;margin-right: 5px;" onsubmit="return confirm('Are you sure?')" action="{{ route('airport.destroy', [$airport->id]) }}">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                            </button>
                                        </form>

                                        <a href="{{ route('airport.edit',$airport->id) }}">
                                            <button class="btn btn-xs btn-info">
                                                <i class="ace-icon fa fa-pencil bigger-120"></i>
                                            </button>
                                        </a>



                                    </div>


                                </td>
                            </tr>
                            @endforeach



                            </tbody>
                        </table>

                        {{ $airports->links("vendor.pagination.default") }}
                    </div><!-- /.span -->
                </div><!-- /.row -->




                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <script>
        function validate(form) {

            // validation code here ...


            if(!valid) {
                alert('Please correct the errors in the form!');
                return false;
            }
            else {
                return confirm('Do you really want to submit the form?');
            }
        }
    </script>
@endsection
