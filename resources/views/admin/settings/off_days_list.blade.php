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

    <style>
        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {
            td:nth-of-type(1):before {
                content: " Name ";
            }

            td:nth-of-type(2):before {
                content: "Email";
            }

            td:nth-of-type(3):before {
                content: "Type";
            }

            td:nth-of-type(4):before {
                content: "Status";
            }

            td:nth-of-type(5):before {
                content: "Action";
            }
        }
    </style>

    <div class="page-content">
        <div class="page-header">
            <h1>
                Off Days
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div>
        <div class="col-xs-12">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @elseif($message = Session::get('error'))
                <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <div class="row">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            @php
                                $role = auth::user()
                                    ->with('roles', 'roles.role')
                                    ->where('id', auth::id())
                                    ->first();
                                $role->roles->role->name;
                            @endphp
                            <div class="col-md-10">
                            </div>
                            @can('user_auth', ['add'])
                                <div class="col-md-2">
                                        <a style="float: right; margin-bottom: 9px;" class="btn btn-success"
                                            href="{{ route('offDaysCreate') }}">
                                            Add New</a>
                                @endcan
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="detail-col">Sr.</th>
                                        <th>OFF Days Type</th>
                                        <th>Company/Admin Name</th>
                                        <th class="">OFF dates</th>
                                        <th class="">Action</th>
                                        <!--<th></th>-->
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                @foreach ($offDaysList as $offDay)
                                    <tr>

                                        <td class=""> {{ $loop->iteration }} </td>
                                        <td>{{ $offDay->off_type }}</td>
                                        @if (isset($offDay->company_id) && $offDay->company_id != null)
                                            <td>{{ $offDay->company->name }}</td>
                                        @elseif(isset($offDay->admin_id) && $offDay->admin_id != null)
                                            <td>{{ $offDay->admin->name }}</td>
                                        @endif
                                        <td class="">{{ $offDay->off_days }}</td>
                                        <td>
                                            <div class="btn-group">
                                                @can('user_auth', ['delete'])
                                                    <form method="POST" style="float: left;margin-right: 5px;"
                                                        onsubmit="return confirm('Are you sure?')"
                                                        action="{{ route('destroyOffDays', [$offDay->id]) }}">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}

                                                        <button type="submit" class="btn btn-xs btn-danger">
                                                            <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                        </button>
                                                    </form>
                                                @endcan

                                                @can('user_auth', ['edit'])
                                                    <a href="{{ route('offDaysEdit', [$offDay->id]) }}">
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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script>
@endsection
