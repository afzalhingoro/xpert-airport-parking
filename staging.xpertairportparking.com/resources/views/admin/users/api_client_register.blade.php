@extends('admin.layout.master')
@section('stylesheets')
@parent
<!-- <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
   <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
   <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
   <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
   <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}" />
   <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
   <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}" /> -->
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
          Create
          </small>
       </h1>
    </div>
    <!-- /.page-header -->
<div class="container">
    <div class="row">
        <!-- Form Begins -->
        <form action="{{ route('storeapiclient') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <!-- Name -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                        {{ Form::text('name', old('name'), ['class' => 'form-control']) }}
                        @if ($errors->has('name'))
                            <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                        {{ Form::text('email', old('email'), ['class' => 'form-control']) }}
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
                        {{ Form::select('agent_id', $agents, old('agent_id'), ['id' => 'agent_id', 'class' => 'form-control']) }}
                        @if ($errors->has('agent_id'))
                            <div class="alert alert-danger">{{ $errors->first('agent_id') }}</div>
                        @endif
                    </div>
                </div>

                <!-- Status -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                        {{ Form::select('status', ['1' => 'Active', '0' => 'Inactive'], old('status', '1'), ['class' => 'form-control']) }}
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Access Token with Button -->
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('access_token', 'Access Token', ['class' => 'control-label']) }}
                        <div style="width:48%" class="input-group">
                            {{ Form::text('access_token', old('access_token'), ['id' => 'access_token', 'class' => 'form-control mb-3', 'readonly']) }}
                            <div  class="input-group-append">
                                <button type="button" class="btn btn-primary" onclick="generateToken()">Generate Token</button>
                            </div>
                        </div>
                        @if ($errors->has('access_token'))
                            <div class="alert alert-danger">{{ $errors->first('access_token') }}</div>
                        @endif
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
<script>
   $('#select-all').click(function(event) {
       if (this.checked) {
           // Iterate each checkbox
           $('.check').each(function() {
               this.checked = true;
           });
       } else {
           $('.check').each(function() {
               this.checked = false;
           });
       }
   });
</script>
<script>
   $('#select-alll').click(function(event) {
       if (this.checked) {
           // Iterate each checkbox
           $('.checks').each(function() {
               this.checked = true;
           });
       } else {
           $('.checks').each(function() {
               this.checked = false;
           });
       }
   });
</script>
<script>
 function generateToken() {
    // Generate a secure token (UUID format)
    let token = crypto.randomUUID();

    // Set the generated token in the input field
    document.getElementById('access_token').value = token;
}

</script>
<script>
   function getPermissions() {
       var role_id = $("#role_id :selected").text();
   
       $.ajax({
           type: 'get',
           url: '../users/getPermissions/' + role_id,
           success: function(msg) {
               // $('#terminalSection').show();
               $('#permission_list').html(msg);
           }
       });
   
   }
</script>
@endsection