@extends('admin.layout.master')
@section('stylesheets')
@parent
 
<link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}" />
<style>@media (min-width: 1200px) {
    .container {
         width: 970px; 
    }
}</style>
@endsection
@section('content')
<div class="page-content">
    <div class="page-header">
       <h1>
          Api Client
          <small>
          <i class="ace-icon fa fa-angle-double-right"></i>
          Edit
          </small>
       </h1>
    </div>
    <!-- /.page-header -->
<div class="container">
    <div class="row">
        <!-- Form Begins -->
        <form action="{{ route('updateapiclient', $user->id) }}" method="post">
        @csrf

    <div class="row mb-3">
        <!-- Name -->
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                @if ($errors->has('name'))
                    <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                @endif
            </div>
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                {{ Form::text('email', $user->email, ['class' => 'form-control']) }}
                @if ($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <!-- Agent Selection -->
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('agent_id', 'Agent', ['class' => 'control-label']) }}
                {{ Form::select('agent_id', $agents, $user->supplier_id, ['id' => 'agent_id', 'class' => 'form-control']) }}
                @if ($errors->has('agent_id'))
                    <div class="alert alert-danger">{{ $errors->first('agent_id') }}</div>
                @endif
            </div>
        </div>

        <!-- Status -->
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                {{ Form::select('status', ['1' => 'Active', '0' => 'Inactive'], $user->status, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <!-- Access Token (Readonly) -->
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('access_token', 'Access Token', ['class' => 'control-label']) }}
                <div style="width:48%" class="input-group">
                <input  type="text" name="access_token" id="access_token" class="form-control" value="{{ $user->access_token }}" readonly>
            </div>

            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="row mt-3">
        <div class="col-md-12 text-center">
            {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
        </div>
    </div>

</form>

    </div>
</div>
</div>
@endsection
@section('footer-script')
 
 
 
 
@endsection