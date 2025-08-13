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
                Agent
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


                        {{ Form::open(['class' => 'form-horizontal', 'method' => 'PUT', 'route' => ['agent.update', $agent->id], 'files' => true]) }}
                        @csrf
                        <div class="form-group">
                            {{ Form::label('aname', 'Agent UserName', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('aname', $agent->username, ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('aname'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('aname') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>

                        <div class="form-group">
                            {{ Form::label('Pass', 'Password', ['rows' => '10', 'cols' => '50', 'class' => 'col-sm-3 control-label no-padding-right']) }}

                            <div class="col-sm-9">
                                {{ Form::Password('pass', ['class' => 'col-xs-10 col-sm-5']) }}


                                @if ($errors->has('pass'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('pass') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('Alies', 'Alies', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('alies', $agent->alias, ['class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('alies'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('alies') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('Company', 'Company', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('company', $agent->company, ['class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('company'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('company') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            {{ Form::label('email', 'Email', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9">
                                {{ Form::text('email', $agent->email, ['class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger alert alert-danger col-xs-10 col-sm-5"
                                        style="clear: both;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('share', 'Share', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9" id="terminal">
                                {{ Form::text('share', $agent->share, ['class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}

                            </div>
                        </div>



                        <div class="form-group">
                            {{ Form::label('url', 'Url', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-9" id="terminal">
                                {{ Form::text('url', $agent->url, ['class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}

                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('status', 'Status', ['class' => 'col-sm-3 control-label no-padding-right']) }}


                            <div class="col-sm-4">
                                {{ Form::select('status', ['Yes' => 'Active', 'No' => 'Inactive'], 'active') }}

                            </div>
                        </div>





                        <div class="clearfix form-actions">
                            <div class="col-md-offset-3 col-md-9">
                                {{ Form::submit('Update', ['class' => 'btn btn-info']) }}

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
    <!-- include summernote css/js-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#descp').summernote({
                height: 150,
                disableDragAndDrop: true,
                toolbar: [
                    // [groupName, [list of button]]
                    ['codeview'],
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ]
            });
        });

        $('#profile_img_comp').ace_file_input({
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

        var i = 1;

        function add_fields() {

            var objTo = $('#terminal');
            //            var divtest = document.createElement("div");
            //            divtest.innerHTML = '<div class="label">Room ' + room +':</div><div class="content"><span>Width: <input type="text" style="width:48px;" name="width[]" value="" /><small>(ft)</small> X</span><span>Length: <input type="text" style="width:48px;" namae="length[]" value="" /><small>(ft)</small></span></div>';
            var inp = '<div id="terminal_' + i +
                '" style="clear: both; margin-top: 10px"><input class="col-xs-10 col-sm-5" data-provide="markdown" name="terminal[]" type="text" value="" "><a id="del_terminal_' +
                i + '"  onclick="delete_fields(' + i +
                ')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-minus-sign"></span></a><div>';
            objTo.append(inp);
            i++;
        }

        function delete_fields(id) {
            $("#terminal_" + id).remove();
            //$("#del_terminal_"+id).remove();
        }
    </script>
@endsection
