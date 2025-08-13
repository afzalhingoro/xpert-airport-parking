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
    <script src="https://cdn.tiny.cloud/1/gmj3q35o116dixbt0pbsac3bhxwzewdo0b135geopnwkfg6o/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

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
        #my-editor {
        font-family: 'Arial', sans-serif;
        font-size: 16px;
    }
    #my-editor-2{
        font-family: 'Arial', sans-serif;
        font-size: 16px;
    }
    #my-editor-3{
        font-family: 'Arial', sans-serif;
        font-size: 16px;
    }
    .tox-notification.tox-notification--in.tox-notification--warning{
        display:none !important;
    }
    .tox-statusbar__branding{
        display:none;
    }
    </style>
@endsection

@section('content')




    <div class="page-content">


        <div class="page-header">
            <h1>
                Page
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




                        {{ Form::open(['class' => 'form-horizontal', 'method' => 'PUT', 'route' => ['pages.update', $page->id], 'files' => true]) }}
                        @csrf

                        {{ Form::hidden('airport_id', 1, ['class' => 'form-control']) }}

                        <div class="form-group">
                            {{ Form::label('Page Title', 'Page Title', ['class' => 'col-sm-2 control-label no-padding-right']) }}

                            <div class="form-control-sm"></div>
                            <div class="col-sm-8">
                                {{ Form::text('page_title', $page->page_title, ['class' => 'form-control']) }}



                                @if ($errors->has('page_title'))
                                    <div class="alert alert-danger alert alert-danger " style="clear: both;">
                                        <strong>{{ $errors->first('page_title') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            {{ Form::label('Page Slug', 'Page Slug', ['class' => 'col-sm-2 control-label no-padding-right']) }}

                            <div class="form-control-sm"></div>
                            <div class="col-sm-8">
                                {{ Form::text('page_slug', $page->slug, ['class' => 'form-control', 'disabled' => 'disabled']) }}



                                @if ($errors->has('page_slug'))
                                    <div class="alert alert-danger alert alert-danger " style="clear: both;">
                                        <strong>{{ $errors->first('page_slug') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            {{ Form::label('type', 'Page Type', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::select('type', ['' => 'All Type', 'page' => 'Page', 'post' => 'Post', 'main' => 'Main'], $page->type, ['id' => 'type', 'class' => 'form-control']) }}


                                @if ($errors->has('type'))
                                    <div class="alert alert-danger alert alert-danger " style="clear: both;">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>

                        @if ($role_name != 'Operations')
                            <div class="form-group">
                                {{ Form::label('Meta Title', 'Meta Title', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                                <div class="col-sm-8">
                                    {{ Form::text('meta_title', $page->meta_title, ['class' => 'form-control']) }}


                                    @if ($errors->has('meta_title'))
                                        <div class="alert alert-danger alert alert-danger " style="clear: both;">
                                            <strong>{{ $errors->first('meta_title') }}</strong>
                                        </div>
                                    @endif
                                </div>

                            </div>


                            <div class="form-group">
                                {{ Form::label('Meta Keywords', 'Meta Keywords', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                                <div class="col-sm-8">
                                    {{ Form::text('meta_keyword', $page->meta_keyword, ['class' => 'form-control']) }}


                                    @if ($errors->has('meta_keyword'))
                                        <div class="alert alert-danger alert alert-danger " style="clear: both;">
                                            <strong>{{ $errors->first('meta_keyword') }}</strong>
                                        </div>
                                    @endif
                                </div>

                            </div>






                            <div class="form-group">
                                {{ Form::label('meta_description', 'Meta Description', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                                <div class="col-sm-8">
                                    {{ Form::textarea('meta_description', $page->meta_description, ['id' => 'meta_description', 'class' => 'form-control', 'data-provide' => 'markdown', "style='height: 60px;'"]) }}
                                    @if ($errors->has('meta_description'))
                                        <div class="alert alert-danger alert alert-danger"
                                            style="clear: both; margin-top: -22px;">
                                            <strong>{{ $errors->first('meta_description') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif



                        <div class="form-group" style="display:none;">
                            {{ Form::label('meet_and_greet', 'Meet And Greet', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('meet_and_greet', $page->meet_and_greet, ['id' => 'meet_and_greet', 'class' => 'form-control', 'data-provide' => 'markdown', "style='height: 60px;'"]) }}
                                @if ($errors->has('meet_and_greet'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('meet_and_greet') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" style="display:none;">
                            {{ Form::label('park_and_ride', 'Park and Ride', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('park_and_ride', $page->park_and_ride, ['id' => 'park_and_ride', 'class' => 'form-control', 'data-provide' => 'markdown', "style='height: 60px;'"]) }}
                                @if ($errors->has('park_and_ride'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('park_and_ride') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group" style="display:none;">
                            {{ Form::label('alluring', 'Our Alluring', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('alluring', $page->alluring, ['id' => 'alluring', 'class' => 'form-control', 'data-provide' => 'markdown', "style='height: 60px;'"]) }}
                                @if ($errors->has('alluring'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('alluring') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group" style="display:none;">
                            {{ Form::label('alluring_meetandgreet', 'Alluring meet and greet', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('alluring_meetandgreet', $page->alluring_meetandgreet, ['id' => 'alluring_meetandgreet', 'class' => 'form-control', 'data-provide' => 'markdown', "style='height: 60px;'"]) }}
                                @if ($errors->has('alluring_meetandgreet'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('alluring_meetandgreet') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group" style="display:none;">
                            {{ Form::label('alluring_parkandride', 'Alluring Park and Ride', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('alluring_parkandride', $page->alluring_parkandride, ['id' => 'alluring_parkandride', 'class' => 'form-control', 'data-provide' => 'markdown', "style='height: 60px;'"]) }}
                                @if ($errors->has('alluring_parkandride'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('alluring_parkandride') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="form-group" style="display:none;">
                            {{ Form::label('alluring_onairport', 'Alluring On Airport', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('alluring_onairport', $page->alluring_onairport, ['id' => 'alluring_onairport', 'class' => 'form-control', 'data-provide' => 'markdown', "style='height: 60px;'"]) }}
                                @if ($errors->has('alluring_onairport'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('alluring_onairport') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>





                        <div class="form-group" id="main">
                            {{ Form::label('content', 'Content', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('content', $page->content, ['id' => 'content', 'class' => 'form-control', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('content'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('Content Image', 'Content Image', ['class' => 'col-sm-2 control-label no-padding-right']) }}
                            <div class="col-sm-4">
                                {{ Form::file('logo1', ['id' => 'logo1', 'class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                            </div>
                            <div class="col-sm-2">
                                @if (isset($page->banner))
                                    <img src="{{ asset('storage/app/' . $page->banner) }}" class="img-responsive">
                                @endif
                            </div>
                        </div>

                        <div class="form-group" id="main">
                            {{ Form::label('content 2', 'content2', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('content2', $page->content2, ['id' => 'content2', 'class' => 'form-control', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('content2'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('content2') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('Content 2 Image', 'Content 2 Image', ['class' => 'col-sm-2 control-label no-padding-right']) }}
                            <div class="col-sm-4">
                                {{ Form::file('logo2', ['id' => 'logo2', 'class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                            </div>
                            <div class="col-sm-2">
                                @if (isset($page->banner2))
                                    <img src="{{ asset('storage/app/' . $page->banner2) }}" class="img-responsive">
                                @endif
                            </div>
                        </div>

                        <div class="form-group" id="main">
                            {{ Form::label('content 3', 'content 3', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-8">
                                {{ Form::textarea('content3', $page->content3, ['id' => 'content3', 'class' => 'form-control', 'data-provide' => 'markdown']) }}
                                @if ($errors->has('content3'))
                                    <div class="alert alert-danger alert alert-danger"
                                        style="clear: both; margin-top: -22px;">
                                        <strong>{{ $errors->first('content3') }}</strong>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            {{ Form::label('Content 3 Image', 'Content 3 Image', ['class' => 'col-sm-2 control-label no-padding-right']) }}
                            <div class="col-sm-4">
                                {{ Form::file('logo3', ['id' => 'logo3', 'class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}
                            </div>
                            <div class="col-sm-2">
                                @if (isset($page->banner3))
                                    <img src="{{ asset('storage/app/' . $page->banner3) }}" class="img-responsive">
                                @endif
                            </div>
                        </div>

                        @if ($role_name != 'Operations')
                            <div class="form-group">
                                {{ Form::label('Schema', 'Schema', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                                <div class="col-sm-8">
                                    {{ Form::textarea('schema', $page->schema, ['id' => 'schema', 'class' => 'form-control', 'data-provide' => 'markdown']) }}
                                    @if ($errors->has('schema'))
                                        <div class="alert alert-danger alert alert-danger"
                                            style="clear: both; margin-top: -22px;">
                                            <strong>{{ $errors->first('schema') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endif








                        <div class="form-group">
                            {{ Form::label('status', 'Status', ['class' => 'col-sm-2 control-label no-padding-right']) }}


                            <div class="col-sm-4">
                                {{ Form::select('status', ['Yes' => 'Active', 'No' => 'Inactive'], $page->status) }}

                            </div>
                        </div>



                        <div class="form-group">

                            {{ Form::label('Upload Banner', 'Upload Banner', ['class' => 'col-sm-2 control-label no-padding-right']) }}





                            <div class="col-sm-4">

                                {{ Form::file('logo', ['id' => 'logo', 'class' => 'col-xs-10 col-sm-5', 'data-provide' => 'markdown']) }}



                            </div>

                            <div class="col-sm-2">
                                @if (isset($page->banner))
                                    <img src="{{ asset('storage/app/' . $page->main_img) }}" class="img-responsive">
                                @endif
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
        $(document).ready(function() {


            $('#content').summernote({
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

            $('#content2').summernote({
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

            $('#content3').summernote({
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
        $(document).ready(function() {
            $("#type").change(function() {
                var val = $('#type').val();
                if (val == 'AP' || val === 'HP' || val == 'AH' || val == 'AL') {
                    $("#airport").show();
                } else {
                    $("#airport").hide();
                }
                if (val == 'main') {
                    $("#main").hide();
                } else {
                    $("#main").show();
                }
            });
        });



        $('#logo').ace_file_input({

            style: 'well',

            btn_choose: 'Drop files here or click to choose',

            btn_change: null,

            no_icon: 'ace-icon fa fa-cloud-upload',

            droppable: true,

            thumbnail: 'small' /*//large | fit*/

                /*,icon_remove:null//set null, to hide remove/reset button*/

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

                /* //name of the file that failed

                 //error_code values

                 //1 = 'FILE_LOAD_FAILED',

                 //2 = 'IMAGE_LOAD_FAILED',

                 //3 = 'THUMBNAIL_FAILED'

                 //alert(error_code);*/

            }



        }).on('change', function() {

            /*//console.log($(this).data('ace_input_files'));

            //console.log($(this).data('ace_input_method'));*/

        });
    </script>
    
    
    <script>
    function uploadImage(blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'https://api.cloudinary.com/v1_1/YOUR_CLOUDINARY_CLOUD_NAME/image/upload', true);
        formData = new FormData();
        formData.append('upload_preset', 'YOUR_CLOUDINARY_UPLOAD_PRESET');
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.onload = function () {
            var json;
            if (xhr.status !== 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);
            if (!json || typeof json.secure_url !== 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
            success(json.secure_url);
        };
        xhr.onerror = function () {
            failure('Image upload failed due to a network error.');
        };
        xhr.send(formData);
    }
    
        tinymce.init({
            selector: '#my-editor',
            
            plugins: 'advlist autolink lists link image charmap print preview anchor table media',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | table | media' ,
            
            images_upload_handler: uploadImage,
            automatic_uploads: false,
            table_default_attributes: {
                border: '1'
            },
            table_default_styles: {
                'border-collapse': 'collapse'
            },
            table_responsive_width: true,
            contextmenu: 'showAltText editAltText',
        setup: function (editor) {
            editor.ui.registry.addMenuItem('showAltText', {
                text: 'Show Alt Text',
                onAction: function (_) {
                    var selectedNode = editor.selection.getNode();
                    if (selectedNode.tagName.toLowerCase() === 'img') {
                        var altText = selectedNode.alt || 'No Alt Text';
                        alert('Alt Text: ' + altText);
                    }
                }
            });

            editor.ui.registry.addMenuItem('editAltText', {
                text: 'Edit Alt Text',
                onAction: function (_) {
                    var selectedNode = editor.selection.getNode();
                    if (selectedNode.tagName.toLowerCase() === 'img') {
                        var newAltText = prompt('Enter Alt Text:', selectedNode.alt);
                        if (newAltText !== null) {
                            selectedNode.alt = newAltText;
                        }
                    }
                }
            });
        },
        content_style: "h1 { font-size: 34px; } h2 { font-size: 30px; } h3 { font-size: 24px; } h4 { font-size: 20px; } h5 { font-size: 18px; } h6 { font-size: 16px; } p { font-size: 16px; } a { color: #0072ff; }",
                height: 300
        });
        
        var content = tinymce.activeEditor.getContent();
    </script>
    
    <script>
    function uploadImage(blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'https://api.cloudinary.com/v1_1/YOUR_CLOUDINARY_CLOUD_NAME/image/upload', true);
        formData = new FormData();
        formData.append('upload_preset', 'YOUR_CLOUDINARY_UPLOAD_PRESET');
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.onload = function () {
            var json;
            if (xhr.status !== 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);
            if (!json || typeof json.secure_url !== 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
            success(json.secure_url);
        };
        xhr.onerror = function () {
            failure('Image upload failed due to a network error.');
        };
        xhr.send(formData);
    }
    
        tinymce.init({
            selector: '#my-editor-2',
            plugins: 'advlist autolink lists link image charmap print preview anchor table media',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | table | media' ,
            
            images_upload_handler: uploadImage,
            automatic_uploads: false,
            table_default_attributes: {
                border: '1'
            },
            table_default_styles: {
                'border-collapse': 'collapse'
            },
            table_responsive_width: true,
            contextmenu: 'showAltText editAltText',
        setup: function (editor) {
            editor.ui.registry.addMenuItem('showAltText', {
                text: 'Show Alt Text',
                onAction: function (_) {
                    var selectedNode = editor.selection.getNode();
                    if (selectedNode.tagName.toLowerCase() === 'img') {
                        var altText = selectedNode.alt || 'No Alt Text';
                        alert('Alt Text: ' + altText);
                    }
                }
            });

            editor.ui.registry.addMenuItem('editAltText', {
                text: 'Edit Alt Text',
                onAction: function (_) {
                    var selectedNode = editor.selection.getNode();
                    if (selectedNode.tagName.toLowerCase() === 'img') {
                        var newAltText = prompt('Enter Alt Text:', selectedNode.alt);
                        if (newAltText !== null) {
                            selectedNode.alt = newAltText;
                        }
                    }
                }
            });
        },
        content_style: "h1 { font-size: 34px; } h2 { font-size: 30px; } h3 { font-size: 24px; } h4 { font-size: 20px; } h5 { font-size: 18px; } h6 { font-size: 16px; } p { font-size: 16px; } a { color: #0072ff; }",
                height: 300
        });
        
        var content = tinymce.activeEditor.getContent();
    </script>
    
    
     <script>
    function uploadImage(blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'https://api.cloudinary.com/v1_1/YOUR_CLOUDINARY_CLOUD_NAME/image/upload', true);
        formData = new FormData();
        formData.append('upload_preset', 'YOUR_CLOUDINARY_UPLOAD_PRESET');
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.onload = function () {
            var json;
            if (xhr.status !== 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);
            if (!json || typeof json.secure_url !== 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
            success(json.secure_url);
        };
        xhr.onerror = function () {
            failure('Image upload failed due to a network error.');
        };
        xhr.send(formData);
    }
    
        tinymce.init({
            selector: '#my-editor-3',
            plugins: 'advlist autolink lists link image charmap print preview anchor table media',
            toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | table | media' ,
            
            images_upload_handler: uploadImage,
            automatic_uploads: false,
            table_default_attributes: {
                border: '1'
            },
            table_default_styles: {
                'border-collapse': 'collapse'
            },
            table_responsive_width: true,
            contextmenu: 'showAltText editAltText',
        setup: function (editor) {
            editor.ui.registry.addMenuItem('showAltText', {
                text: 'Show Alt Text',
                onAction: function (_) {
                    var selectedNode = editor.selection.getNode();
                    if (selectedNode.tagName.toLowerCase() === 'img') {
                        var altText = selectedNode.alt || 'No Alt Text';
                        alert('Alt Text: ' + altText);
                    }
                }
            });

            editor.ui.registry.addMenuItem('editAltText', {
                text: 'Edit Alt Text',
                onAction: function (_) {
                    var selectedNode = editor.selection.getNode();
                    if (selectedNode.tagName.toLowerCase() === 'img') {
                        var newAltText = prompt('Enter Alt Text:', selectedNode.alt);
                        if (newAltText !== null) {
                            selectedNode.alt = newAltText;
                        }
                    }
                }
            });
        },
        content_style: "h1 { font-size: 34px; } h2 { font-size: 30px; } h3 { font-size: 24px; } h4 { font-size: 20px; } h5 { font-size: 18px; } h6 { font-size: 16px; } p { font-size: 16px; } a { color: #0072ff; }",
                height: 300
        });
        
        var content = tinymce.activeEditor.getContent();
    </script>
    
@endsection
