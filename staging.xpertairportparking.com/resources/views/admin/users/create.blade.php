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
@endsection
@section('content')
<div class="page-content">
    <div class="page-header">
       <h1>
          Users
          <small>
          <i class="ace-icon fa fa-angle-double-right"></i>
          Create
          </small>
       </h1>
    </div>
    <!-- /.page-header -->
    <div class="row">
        <div class="col-xs-12">
           <!-- PAGE CONTENT BEGINS -->
           <form action="{{route('registerstore')}}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                 <!-- Column 1: Name -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                       {{ Form::text('name', Request::old('name'), ['class' => 'form-control']) }}
                       @if ($errors->has('name'))
                       <div class="alert alert-danger">{{ $errors->first('name') }}</div>
                       @endif
                    </div>
                 </div>
                 <!-- Column 2: Email -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                       {{ Form::text('email', Request::old('email'), ['class' => 'form-control']) }}
                       @if ($errors->has('email'))
                       <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                       @endif
                    </div>
                 </div>
                 <!-- Column 3: Password -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
                       {{ Form::password('password', ['class' => 'form-control']) }}
                       @if ($errors->has('password'))
                       <div class="alert alert-danger">{{ $errors->first('password') }}</div>
                       @endif
                    </div>
                 </div>
                 <!-- Column 4: Confirm Password -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('confirm_password', 'Confirm Password', ['class' => 'control-label']) }}
                       {{ Form::password('confirm_password', ['class' => 'form-control']) }}
                       @if ($errors->has('confirm_password'))
                       <div class="alert alert-danger">{{ $errors->first('confirm_password') }}</div>
                       @endif
                    </div>
                 </div>
              </div>
              <div class="row">
                 <!-- Column 1: Roles -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('Roles', 'Roles', ['class' => 'control-label']) }}
                       {{ Form::select('role_id', $rolesList, Request::old('role_id'), ['onchange' => 'getPermissions()', 'id' => 'role_id', 'class' => 'form-control']) }}
                       @if ($errors->has('role_id'))
                       <div class="alert alert-danger">{{ $errors->first('role_id') }}</div>
                       @endif
                    </div>
                 </div>
                 <!-- Column 2: Permissions -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('Permissions', 'Permissions', ['class' => 'control-label']) }}
                       <div class="permission_checkboxes">
                          @foreach ($permissions as $key => $permission)
                          <div class="checkbox">
                             {{ Form::checkbox('permissions[]', $permission, null) }} {{ ucfirst($permission) }}
                          </div>
                          @endforeach
                       </div>
                    </div>
                 </div>
                 <!-- Column 3: Booking Source -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('Booking Source', 'Booking Source', ['class' => 'control-label']) }}
                       <div class="permission_checkboxes1">
                          <div class="checkbox">
                             <label><input type="checkbox" name="bk_source[]" value="all">All</label><br>
                             <label><input type="checkbox" name="bk_source[]" value="paid">Paid</label><br>
                             <label><input type="checkbox" name="bk_source[]" value="ORG">Organic</label><br>
                             <label><input type="checkbox" name="bk_source[]" value="PPC">PPC</label><br>
                             <label><input type="checkbox" name="bk_source[]" value="FB">Facebook</label><br>
                             <label><input type="checkbox" name="bk_source[]" value="Ln">LinkedIn</label><br>
                             <label><input type="checkbox" name="bk_source[]" value="In">Instagram</label><br>
                          </div>
                       </div>
                    </div>
                 </div>
                 <!-- Column 4: Pages to Hide -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('Pages to hide', 'Pages to hide', ['class' => 'control-label']) }}
                       <div class="pagetoHide">
                          <div class="checkbox">
                             <label><input type="checkbox" name="pages[]" value="all">All</label>
                             @foreach ($pages as $key => $page)
                             <label>
                             {{ Form::checkbox('pages[]', $page, null, ['class' => 'checks']) }} {{ ucfirst($page) }}
                             </label><br>
                             @endforeach
                          </div>
                       </div>
                    </div>
                 </div>
              </div>
              <div class="row">
                 <!-- Column 1: Status -->
                 <div class="col-md-3">
                    <div class="form-group">
                       {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                       {{ Form::select('status', ['1' => 'Active', '0' => 'Inactive'], 'active', ['class' => 'form-control']) }}
                    </div>
                 </div>
              </div>
              <div class="row">
                 <!-- Column 2: Submit Button -->
                 <div class="col-md-12">
                    <div class="form-group">
                       {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}
                    </div>
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