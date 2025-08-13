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
   
    <div class="page-content">


        <div class="page-header">
            <h1>
                Companies
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->

                <!-- PAGE CONTENT BEGINS -->

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif


                        <div class="row">
                            <div class="col-md-12 floatNone">
                                <form action="{{ route('company.index') }}" method="get" class="form-inline mb-10">
                                    <div class="form-group" style="padding: 6px 2px;">
                                        <input type="text" value="{{ Request::get('name') }}" class="form-control"
                                            name="name" placeholder="Search here..." />
                                    </div>
                                    <div class="form-group">
                                        <select name="airport" class="form-control" style="padding: 6px 2px;">
                                            <option value="all">All Airports</option>
                                            @foreach ($airports as $airport)
                                                <option
                                                    @if (Request::get('airport') == $airport->id) {{ "selected='selected'" }} @endif
                                                    value="{{ $airport->id }}">{{ $airport->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="admins" class="form-control" style="padding: 6px 2px;">
                                            <option value="all">All Admins</option>
                                            @foreach ($admins as $admin)
                                                <option
                                                    @if (Request::get('admins') == $admin->id) {{ "selected='selected'" }} @endif
                                                    value="{{ $admin->id }}">{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="parking_type">
                                            <option value="all">Parking Type</option>
                                            <option value="Park and Ride">Park and Ride</option>
                                            <option value="Meet and Greet">Meet and Greet</option>
                                            <option value="On Airport">On Airport</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="status" class="form-control">
                                            <option value="all">All</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                            <option value="Removed">Removed</option>
                                            <option value="Old">Old</option>

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select name="companies" class="form-control" style="padding: 6px 2px;">
                                            <option value="all">All Companies</option>
                                            @foreach ($companies_dlist as $company)
                                                <option
                                                    @if (Request::get('companies') == $company->id) {{ "selected='selected'" }} @endif
                                                    value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <input value="Search" type="submit" class="btn  btn-success" />
                                        <a href="{{ route('company.index') }}" class="btn btn-primary">Reset</a>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-2">
                                @can('user_auth', ['add'])
                                    <a style="margin-bottom: 9px;" class="btn btn-success"
                                        href="{{ route('company.create') }}"> Add New</a>
                                @endcan
                            </div>
                        </div>


                        <table id="simple-table" class="table  table-bordered table-hover companyTable">
                            <thead>
                                <tr>

                                    <th>Company</th>
                                    <th>Company Code</th>
                                    <th>Admin</th>
                                    <th>Airport</th>
                                    <th>Parking Type</th>
                                    <th>Status</th>


                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>


                                        <td class="">{{ $company->name }}</td>
                                        <td class="">{{ $company->company_code }}</td>
                                        <td class="">{{ $company->uname }}</td>
                                        <td class="">{{ $company->aname }}</td>
                                        <td class="">{{ $company->parking_type }}</td>
                                        <td class="">
                                            @if ($company->is_active == 'Yes')
                                                {{ 'Active' }}
                                            @else
                                                {{ 'Inactive' }}
                                            @endif
                                        </td>


                                        <td>
                                            <div class="  btn-group">

                                                @can('user_auth', ['delete'])
                                                    <form method="POST" style="margin-right: 5px; float: left"
                                                        onsubmit="return confirm('Are you sure?')"
                                                        action="{{ route('company.destroy', [$company->id]) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                        <button type="submit" class="btn btn-xs btn-danger">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </button>
                                                    </form>
                                                @endcan
                                                </a>
                                                @can('user_auth', ['edit'])
                                                    <a href="{{ route('company.edit', $company->id) }}">
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



                        {{ $companies->appends(request()->input())->links('vendor.pagination.default') }}


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
@endsection
