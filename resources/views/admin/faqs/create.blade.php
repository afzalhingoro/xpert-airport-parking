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
        .add_email_template .form-group{
            margin:0px 0 10px;
        }
    </style>
@endsection

@section('content')
    <div class="page-content">


        <div class="page-header">
            <h1>
                Faqs
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Add
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




                        {{ Form::open(['class' => 'form-horizontal add_email_template', 'method' => 'post', 'route' => 'faqs.store']) }}
                        
                        <div class="form-group" style="display:none;">
                            <div class="row">
                                <div class="col-sm-4">
                                    {{ Form::label('type', 'Page Type', ['class' => 'control-label']) }}
                                    {{ Form::select('type', ['Parking' => 'Airport Parking'], null, ['id' => 'type', 'class' => 'form-control']) }}
                                    @if ($errors->has('type'))
                                        <div class="alert alert-danger" style="clear: both;">
                                            <strong>{{ $errors->first('type') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                            
                                    {{ Form::label('Title', 'Title', ['class' => 'control-label']) }}
                                    {{ Form::text('title', Request::old('title'), ['class' => 'form-control']) }}
                                    @if ($errors->has('title'))
                                        <div class="alert alert-danger" style="clear: both;">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                        <div class="col-sm-4">
                        
                        <div class="form-group">
                                
                                    {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                                    {{ Form::select('status', ['Yes' => 'Active', 'No' => 'Inactive'], 'active', ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-8">
                                    {{ Form::label('content', 'Content', ['class' => 'control-label']) }}
                                    {{ Form::textarea('content', Request::old('content'), ['id' => 'content', 'class' => 'form-control', 'data-provide' => 'markdown']) }}
                                    @if ($errors->has('content'))
                                        <div class="alert alert-danger" style="clear: both; margin-top: -22px;">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}
                                </div>
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
        $(document).ready(function() {


            $('#content').summernote({
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
    </script>
@endsection
