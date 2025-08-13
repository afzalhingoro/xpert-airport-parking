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

    <style type="text/css">
        .awards-pic {
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .awards-pic img {
            width: 80px;
        }

        .leftText {
            margin-top: 10px;
        }

        .pad0 {
            padding: 0px;
        }
    </style>
@endsection

@section('content')




    <div class="page-content">


        <div class="page-header">
            <h1>
                Company
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Update
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




                        {{ Form::open(['class' => 'form-horizontal', 'method' => 'put', 'route' => ['company.update', $company->id], 'files' => true]) }}

                        @csrf

                        <div class="form-group">
                            {{ Form::label('Admin', 'Admin', ['class' => 'col-sm-3 control-label no-padding-right']) }}

                            <div class="form-control-sm"></div>
                            <div class="col-sm-4">
                                {{ Form::select('admin_id', $users, $company->admin_id, ['class' => 'form-control', 'style' => 'width: 97.5%;']) }}


                            </div>

                            @if ($errors->has('admin_id'))
                                <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5" style="clear: both;">
                                    <strong>{{ $errors->first('admin_id') }}</strong>
                                </div>
                            @endif
                        </div>


                        <div class="form-group">
                            {{ Form::label('name', 'Company Name', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('name', $company->name, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('name'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('company code', 'Company Code', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('company_code', $company->company_code, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('company_code'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('company_code') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="form-group">
                            {{ Form::label('aph id', 'APH ID', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('aph_id', $company->aph_id, ['class' => 'col-xs-10 col-sm-5']) }}

                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('company Email', 'Company Email', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9" id="company_email_div">


                                @if ($company->company_email != '')
                                    @php
                                        $emails = explode(',', $company->company_email);
                                        $cmpTotal = count($emails);
                                        $counter = 0;
                                    @endphp

                                    @foreach ($emails as $item)
                                        @if ($counter == 0)
                                            {{ Form::text('company_email[]', $emails[$counter], ['class' => 'col-xs-10 col-sm-5']) }}
                                            <a onclick="add_fields()" class="btn btn-info btn-sm">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </a>
                                        @else
                                            <div id="company_email_{{ $counter }}"
                                                style="clear: both; margin-top: 10px"><input class="col-xs-10 col-sm-5"
                                                    data-provide="markdown" name="company_email[]" type="text"
                                                    value="{{ $item }}"><a id="del_product_{{ $counter }}"
                                                    onclick="delete_fields('{{ $counter }}')"
                                                    class="btn btn-danger btn-sm"><span
                                                        class="glyphicon glyphicon-minus-sign"></span></a></div>
                                        @endif
                                        @php
                                            $counter++;
                                        @endphp
                                    @endforeach
                                @else
                                    {{ Form::text('company_email[]', '', ['class' => 'col-xs-10 col-sm-5']) }}
                                    <a onclick="add_fields()" class="btn btn-info btn-sm">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Select Airport', 'Select Airport', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-4">
                                {{ Form::select('airport_id', $airportsList, $company->airport_id, ['id' => 'airport_id', 'class' => 'form-control', 'style' => 'width: 97.5%;']) }}

                            </div>

                            @if ($errors->has('airport_id'))
                                <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5" style="clear: both;">
                                    <strong>{{ $errors->first('airport_id') }}</strong>
                                </div>
                            @endif
                        </div>


                        <div class="form-group" id="terminalSection" style="display: none">
                            {{ Form::label('Select Terminal', 'Select Terminal', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-4">
                                {{ Form::select('terminal', [], null, ['id' => 'terminal', 'class' => 'form-control', 'style' => 'width:97.5%']) }}

                            </div>

                            @if ($errors->has('terminal'))
                                <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5" style="clear: both;">
                                    <strong>{{ $errors->first('terminal') }}</strong>
                                </div>
                            @endif
                        </div>


                        <div class="form-group">
                            {{ Form::label('Address', 'Address', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('address', $company->address, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('address'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Address2', 'Address2', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('address2', $company->address2, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('address2'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('address2') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Town', 'Town', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('town', $company->town, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('town'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('town') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Post Code', 'Post Code', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('post_code', $company->post_code, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('post_code'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('post_code') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Parking Type', 'Parking Type', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-4">
                                {{ Form::select('parking_type', ['Park and Ride' => 'Park and Ride', 'Meet and Greet' => 'Meet and Greet', 'On Airport' => 'On Airport'], $company->parking_type, ['class' => 'form-control', 'style' => 'width:97.5%']) }}

                            </div>

                            @if ($errors->has('parking_type'))
                                <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5" style="clear: both;">
                                    <strong>{{ $errors->first('parking_type') }}</strong>
                                </div>
                            @endif
                        </div>




                        <div class="form-group">
                            {{ Form::label('Message', 'Message', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('message', $company->message, ['class' => 'col-xs-10 col-sm-5']) }}



                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Process Time', 'Process Time  (Hours)', ['class' => 'col-sm-3 control-label no-padding-right']) }}

                            @php
                                $processTime = [];
                                for ($i = 1; $i <= 200; $i++) {
                                    $processTime[$i] = $i;
                                }
                            @endphp
                            <div class="col-sm-4">
                                {{ Form::select('process_time', $processTime, $company->processtime, ['class' => 'form-control', 'style' => 'width:97.5%']) }}

                            </div>


                        </div>



                        <div class="form-group">


                            <label for="Parking Type" class="col-sm-3 control-label no-padding-right">Parking Type</label>
                            <div class="col-sm-6">
                                {{ Form::label('Opening Time', 'Opening Time', ['class' => 'col-sm-2 no-padding-left control-label no-padding-right']) }}


                                <div class="col-sm-2">
                                    {{ Form::select('opening_time', $opening_closing_time, $company->opening_time) }}


                                    @if ($errors->has('opening_time'))
                                        <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                            style="clear: both;">
                                            <strong>{{ $errors->first('opening_time') }}</strong>
                                        </div>
                                    @endif
                                </div>



                                {{ Form::label('Closing Time', 'Closing Time', ['class' => 'col-sm-2 no-padding-left control-label no-padding-right']) }}


                                <div class="col-sm-3">
                                    {{ Form::select('closing_time', $opening_closing_time, $company->closing_time) }}
                                    @if ($errors->has('closing_time'))
                                        <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                            style="clear: both;">
                                            <strong>{{ $errors->first('closing_time') }}</strong>
                                        </div>
                                    @endif



                                </div>


                            </div>

                        </div>





                        <div class="form-group">
                            {{ Form::label('Share Percentage', 'Share Percentage', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('share_percentage', $company->share_percentage, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('share_percentage'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('share_percentage') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Max Discount %', 'Max Discount %', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('max_discount', $company->max_discount, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('max_discount'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('max_discount') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Company Overview', 'Company Overview', ['rows' => '10', 'cols' => '50', 'class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-5">
                                {{ Form::textarea('overview', $company->overview, ['class' => 'col-xs-10 col-sm-5', 'id' => 'overview', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('overview'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('overview') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            {{ Form::label('Arival', 'Arival', ['rows' => '10', 'cols' => '50', 'class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-5">
                                {{ Form::textarea('arival', $company->arival, ['id' => 'arival', 'class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('arival'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('arival') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>





                        <div class="form-group">
                            {{ Form::label('Return', 'Return', ['rows' => '10', 'cols' => '50', 'class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-5">
                                {{ Form::textarea('return_proc', $company->return_proc, ['id' => 'return', 'class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('return_proc'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('return_proc') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            {{ Form::label('Return Front', 'Return Front', ['rows' => '10', 'cols' => '50', 'class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-5">
                                {{ Form::textarea('returnfront', $company->returnfront, ['id' => 'return_front', 'class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('returnfront'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('returnfront') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            {{ Form::label('Facility', 'Facility 1', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                @php
                                    $descp = '';
                                    if (count($saved_facilities) > 0) {
                                        $descp = $saved_facilities[0]['description'];
                                    }
                                @endphp
                                {{ Form::text('facility[1]', $descp, ['class' => 'col-xs-10 col-sm-5']) }}
                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Facility', 'Facility 2', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                @php
                                    $descp = '';
                                    if (count($saved_facilities) > 1) {
                                        $descp = $saved_facilities[1]['description'];
                                    }
                                @endphp
                                {{ Form::text('facility[2]', $descp, ['class' => 'col-xs-10 col-sm-5']) }}
                            </div>

                        </div>


                        <div class="form-group">

                            {{ Form::label('Facility', 'Facility 3', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                @php
                                    $descp = '';
                                    if (count($saved_facilities) > 2) {
                                        $descp = $saved_facilities[2]['description'];
                                    }
                                @endphp
                                {{ Form::text('facility[3]', $descp, ['class' => 'col-xs-10 col-sm-5']) }}
                            </div>

                        </div>

                        <div class="form-group">
                            {{ Form::label('Facility', 'Facility 4', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                @php
                                    $descp = '';
                                    if (count($saved_facilities) > 3) {
                                        $descp = $saved_facilities[3]['description'];
                                    }
                                @endphp
                                {{ Form::text('facility[4]', $descp, ['class' => 'col-xs-10 col-sm-5']) }}
                            </div>

                        </div>

                        <div class="form-group">

                            {{ Form::label('Facility', 'Facility 5', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                @php
                                    $descp = '';
                                    if (count($saved_facilities) > 4) {
                                        $descp = $saved_facilities[4]['description'];
                                    }
                                @endphp

                                {{ Form::text('facility[5]', $descp, ['class' => 'col-xs-10 col-sm-5']) }}
                            </div>

                        </div>


                        <div class="form-group">
    {{ Form::label('products', 'Self Products', ['class' => 'col-sm-3 control-label no-padding-right']) }}
    <div class="col-sm-9" id="products">
        @php $counter = 1; @endphp

        @if (count($saved_products) > 0)
            @foreach ($saved_products as $item)
                <div id="product_{{ $counter }}" style="clear: both; margin-top: 10px">
                    {{ Form::text('product[]', $item, ['class' => 'col-xs-10 col-sm-5']) }}
                    @if ($counter == 1)
                        <a onclick="add_product_fields('self')" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    @else
                        <a id="del_product_{{ $counter }}" onclick="delete_product_fields('product_{{ $counter }}')" class="btn btn-danger btn-sm">
                            <span class="glyphicon glyphicon-minus-sign"></span>
                        </a>
                    @endif
                </div>
                @php $counter++; @endphp
            @endforeach
        @else
            {{ Form::text('product[]', '', ['class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
            <a onclick="add_product_fields('self')" class="btn btn-info btn-sm">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        @endif
    </div>
</div>

<div class="form-group">
    {{ Form::label('api_products', 'API Products', ['class' => 'col-sm-3 control-label no-padding-right']) }}
    <div class="col-sm-9" id="api_products">
        @php $counter = 1; @endphp

        @if (count($saved_api_products) > 0)
            @foreach ($saved_api_products as $item)
                <div id="api_product_{{ $counter }}" style="clear: both; margin-top: 10px">
                    {{ Form::text('api_product[]', $item, ['class' => 'col-xs-10 col-sm-5']) }}
                    @if ($counter == 1)
                        <a onclick="add_product_fields('api')" class="btn btn-info btn-sm">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    @else
                        <a id="del_api_product_{{ $counter }}" onclick="delete_product_fields('api_product_{{ $counter }}')" class="btn btn-danger btn-sm">
                            <span class="glyphicon glyphicon-minus-sign"></span>
                        </a>
                    @endif
                </div>
                @php $counter++; @endphp
            @endforeach
        @else
            {{ Form::text('api_product[]', '', ['class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
            <a onclick="add_product_fields('api')" class="btn btn-info btn-sm">
                <span class="glyphicon glyphicon-plus"></span>
            </a>
        @endif
    </div>
</div>


                        <div class="form-group">
                            {{ Form::label('Features', 'Features', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">


                                <div class="col-sm-3">
                                    @php
                                        $fet = explode(',', $company->special_features);
                                    @endphp
                                    @foreach ($features1 as $name)
                                        <div class="checkbox">
                                            <label>



                                                @if (in_array($name, $fet))
                                                    {{ Form::checkbox('features[]', $name, $name, ['class' => 'ace']) }}
                                                @else
                                                    {{ Form::checkbox('features[]', $name, null, ['class' => 'ace']) }}
                                                @endif

                                                <span class="lbl"> {{ $name }}</span>
                                            </label>
                                        </div>
                                    @endforeach


                                </div>

                                <div class="col-sm-6">

                                    @foreach ($features2 as $f)
                                        <div class="checkbox">
                                            <label>

                                                @if (in_array($f, $fet))
                                                    {{ Form::checkbox('features[]', $f, $f, ['class' => 'ace']) }}
                                                @else
                                                    {{ Form::checkbox('features[]', $f, null, ['class' => 'ace']) }}
                                                @endif




                                                <span class="lbl"> {{ $f }}</span>
                                            </label>
                                        </div>
                                    @endforeach


                                </div>


                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Upload Logo', 'Upload Logo', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-4">
                                {{ Form::file('logo', ['id' => 'logo', 'class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}

                            </div>
                        </div>


                        <div class="form-group">
                            {{ Form::label('status', 'Status', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-4">
                                {{ Form::select('status', ['Yes' => 'Active', 'No' => 'Inactive'], $company->is_active) }}

                            </div>
                        </div>


                        <div class="form-group">
                            {{ Form::label('Mark as', 'Mark as', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">


                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>

                                            {{ Form::checkbox('recommended', 'Yes', $company->recommended, ['class' => 'ace']) }}


                                            <span class="lbl"> Recommended</span>
                                        </label>
                                    </div>

                                </div>


                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>

                                            {{ Form::checkbox('featured', 'Yes', $company->featured, ['class' => 'ace']) }}


                                            <span class="lbl"> Featured</span>
                                        </label>
                                    </div>

                                </div>


                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Airport Levy Fee!', 'Airport Levy Fee!', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">


                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>

                                            {{ Form::checkbox('levy_checked', 'Yes', null, ['class' => 'ace']) }}
                                            <span class="lbl"> </span>

                                        </label>
                                    </div>

                                </div>


                            </div>

                        </div>
                        <div class="form-group">
                            {{ Form::label('Booking Action', 'Booking Action', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">


                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>

                                            {{ Form::checkbox('cancelable', 'Yes', $company->cancelable, ['class' => 'ace']) }}


                                            <span class="lbl"> Cancelable Booking</span>
                                        </label>
                                    </div>

                                </div>


                                <div class="col-sm-3">
                                    <div class="checkbox">
                                        <label>

                                            {{ Form::checkbox('editable', 'Yes', $company->editable, ['class' => 'ace']) }}


                                            <span class="lbl"> Editable Booking</span>
                                        </label>
                                    </div>

                                </div>


                            </div>

                        </div>


                        <div class="form-group">
                            {{ Form::label('Awards', 'Awards', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">


                                <div class="col-sm-5">
                                    @foreach ($awardsList as $award)
                                        <div class="col-sm-12 awards-pic">
                                            <div class="col-sm-6">

                                                @if (in_array($award->id, $saved_awards_sorted))
                                                    <input type="checkbox" checked="checked" name="awards[]"
                                                        value="{{ $award->id }}">{{ $award->awardname }}
                                                @else
                                                    <input type="checkbox" name="awards[]"
                                                        value="{{ $award->id }}">{{ $award->awardname }}
                                                @endif

                                            </div>

                                            <!-- <div class="col-sm-6"><img
                                                            src="{{ secure_asset('storage/app/public/images/' . $award->image) }}"> -->
                                            <div class="col-sm-6"><img
                                                    src="{{ secure_asset('storage/app/' . $award->image) }}">

                                            </div>
                                        </div>
                                    @endforeach


                                </div>


                            </div>

                        </div>


                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}

                            </div>
                        </div>


                    </div><!-- /.span -->
                </div><!-- /.row -->


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>


@endsection
@section('footer-script')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script type="text/javascript">
        $('#airport_id').change(function() {
            getTerminals();
        });
        var i = 1;
        <?php if(Request::old('product') !=""){ ?>
        i = "<?php echo count(Request::old('product')); ?>";
        i++;
        <?php }
        else if($saved_products !="") { ?>
        i = "<?php echo count($saved_products); ?>";
        i++;
        <?php } ?>

        var i = 1; // Initialize counter globally

function add_product_fields(type) {
    var objTo, field_name, inp;

    if (type === 'self') {
        objTo = $('#products');
        field_name = "product_" + i;
    } else {
        objTo = $('#api_products');
        field_name = "api_product_" + i;
    }

    inp = '<div id="' + field_name + '" style="clear: both; margin-top: 10px">' +
        '<input class="col-xs-10 col-sm-5" data-provide="markdown" name="' + (type === 'self' ? 'product[]' : 'api_product[]') + '" type="text" value="">' +
        '<a id="del_' + field_name + '" onclick="delete_product_fields(\'' + field_name + '\')" class="btn btn-danger btn-sm">' +
        '<span class="glyphicon glyphicon-minus-sign"></span></a></div>';

    objTo.append(inp);
    i++;
}

function delete_product_fields(id) {
    $("#" + id).remove();
}


        var a = 1;

        <?php if(Request::old('company_email') !=""){ ?>
        a = "<?php echo count(Request::old('company_email')); ?>";
        a++;
        <?php } else if($company->company_email !="") { ?>
        a = "<?php echo count($emails); ?>";
        a++;
        <?php } ?>

        function add_fields() {

            var objTo = $('#company_email_div');
            //var field_name ="company_email_"+i;
            //            var divtest = document.createElement("div");
            //            divtest.innerHTML = '<div class="label">Room ' + room +':</div><div class="content"><span>Width: <input type="text" style="width:48px;" name="width[]" value="" /><small>(ft)</small> X</span><span>Length: <input type="text" style="width:48px;" namae="length[]" value="" /><small>(ft)</small></span></div>';
            var inp = '<div id="company_email_' + a +
                '" style="clear: both; margin-top: 10px"><input class="col-xs-10 col-sm-5" data-provide="markdown" name="company_email[]" type="text" value="" "><a id="del_product_' +
                a + '"  onclick="delete_fields(' + a +
                ')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-minus-sign"></span></a></div>';
            objTo.append(inp);
            a++;
        }

        function delete_fields(id) {
            $("#company_email_" + id).remove();
            $(this).parents('.li').remove();

            //$("#del_terminal_"+id).remove();
        }
        //company_email_div
        function getTerminals() {
            var airport = $('#airport_id').val();
            var data = {};
            data['id'] = airport;
            //data['action'] = 'getTerminals';
            $.ajax({
                type: 'get',
                // data: data,
                url: '../getTerminals/' + airport,
                success: function(msg) {
                    $('#terminalSection').show();
                    $('#terminal').html(msg);
                }
            });

        }

        $(document).ready(function() {

            $("a.delete_btn").click(function(event) {
                event.preventDefault();
                $(this).unwrap();
            });

            getTerminals();
            $('#descp').summernote({
                height: 150,
                disableDragAndDrop: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });


            $('#return').summernote({
                height: 150,
                disableDragAndDrop: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });

            $('#return_front').summernote({
                height: 150,
                disableDragAndDrop: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });


            $('#arival').summernote({
                height: 150,
                disableDragAndDrop: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });


            $('#overview').summernote({
                height: 150,
                disableDragAndDrop: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });

        $('#logo').ace_file_input({
            style: 'well',
            btn_choose: 'Drop files here or click to choose',
            btn_change: null,
            no_icon: 'ace-icon fa fa-cloud-upload',
            droppable: true,
            thumbnail: 'small' //large | fit
                //,icon_remove:null//set null, to hide remove/reset button
                /**,before_change:function(files, dropped) {
    						//Check an example below
    						//or examples/file-upload.html
    						return true;
    					}*/
                /**,before_remove : function() {
    						return true;
    					}*/
                ,
            preview_error: function(filename, error_code) {
                //name of the file that failed
                //error_code values
                //1 = 'FILE_LOAD_FAILED',
                //2 = 'IMAGE_LOAD_FAILED',
                //3 = 'THUMBNAIL_FAILED'
                //alert(error_code);
            }

        }).on('change', function() {
            //console.log($(this).data('ace_input_files'));
            //console.log($(this).data('ace_input_method'));
        });
    </script>
@endsection
