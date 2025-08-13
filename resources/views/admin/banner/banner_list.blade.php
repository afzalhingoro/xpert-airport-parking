@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-colorpicker.min.css') }}" />

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

        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            /* display: flex; */
            padding: 5px 5px 0px 5px;
            position: relative;
            overflow: auto;
        }

        .preview-images-zone>.preview-image:first-child {
            height: 185px;
            width: 185px;
            position: relative;
            margin-right: 5px;
        }

        .preview-images-zone>.preview-image {
            height: 90px;
            width: 90px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }

        .preview-images-zone>.preview-image>.image-zone {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone>.preview-image>.image-zone>img {
            width: 100%;
            height: 100%;
        }

        .preview-images-zone>.preview-image>.tools-edit-image {
            position: absolute;
            z-index: 100;
            color: #fff;
            bottom: 0;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
            display: none;
        }

        .preview-images-zone>.preview-image>.image-cancel {
            font-size: 18px;
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
            display: none;
            z-index: 100;
        }

        .preview-image:hover>.image-zone {
            cursor: move;
            opacity: .5;
        }

        .preview-image:hover>.tools-edit-image,
        .preview-image:hover>.image-cancel {
            display: block;
        }

        .ui-sortable-helper {
            width: 90px !important;
            height: 90px !important;
        }

        .container {
            padding-top: 50px;
        }
    </style>
@endsection

@section('content')

    <div class="container">
        <div class="row">
        <div class="col-md-12">
        <fieldset class="form-group">
            <a href="javascript:void(0)" onclick="$('#pro-image').click()">Add Image</a> &nbsp &nbsp <sub
                style="color:red">Recommended 1600 * 600</sub>
            <input type="file" id="pro-image" name="pro-image" style="display: none;" class="form-control" multiple>
        </fieldset>
            <div class="preview-images-zone">
                @if (count($sliders) == 0)
                    <div class="preview-image preview-show-1">
                        <div class="image-cancel" data-no="1">x</div>
                        <div class="image-zone"><img id="pro-img-1" src="{{ url('theme/images/home_slider.jpg') }}"></div>
                        <div class="tools-edit-image"><a href="javascript:void(0)" data-no="1"
                                class="btn btn-light btn-edit-image">edit</a></div>
                    </div>
                @else
                    @foreach ($sliders as $slider)
                        <div class="preview-image preview-show-{{ $loop->index }}">
                            <div class="image-cancel" data-no="{{ $loop->index }}">x</div>
                            <div class="image-zone"><img id="pro-img-{{ $loop->index }}" src="{{ $slider }}"></div>
                            <!--<div class="tools-edit-image"><a href="javascript:void(0)" data-no="{{ $loop->index }}" class="btn btn-light btn-edit-image">edit</a></div>-->
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="align-button-center mt-15">
                <button type="button" onclick="uploadImage()" class="btn btn-primary upload-image">Upload</button>
            </div>
            
        </div>
        </div>
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
        var i = "<?php echo count(Request::old('product')); ?>";
        <?php } ?>

        function add_product_fields() {

            var objTo = $('#products');
            //            var divtest = document.createElement("div");
            var field_name = "product_" + i;
            //            divtest.innerHTML = '<div class="label">Room ' + room +':</div><div class="content"><span>Width: <input type="text" style="width:48px;" name="width[]" value="" /><small>(ft)</small> X</span><span>Length: <input type="text" style="width:48px;" namae="length[]" value="" /><small>(ft)</small></span></div>';
            var inp = '<div id="product_' + i +
                '" style="clear: both; margin-top: 10px"><input class="col-xs-10 col-sm-5" data-provide="markdown" name="product[]" type="text" value="" "><a id="del_product_' +
                i + '"  onclick="delete_product_fields(' + i +
                ')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-minus-sign"></span></a></div>';
            objTo.append(inp);
            i++;
        }

        function delete_product_fields(id) {
            $("#product_" + id).remove();
            //$("#del_terminal_"+id).remove();
        }

        var a = 1;

        <?php if(Request::old('company_email') !=""){ ?>
        a = "<?php echo count(Request::old('company_email')); ?>";
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
                url: 'getTerminals/' + airport,
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

    <script>
        $(document).ready(function() {
            document.getElementById('pro-image').addEventListener('change', readImage, false);

            $(".preview-images-zone").sortable();

            $(document).on('click', '.image-cancel', function() {
                let no = $(this).data('no');
                $(".preview-image.preview-show-" + no).remove();
            });
        });



        var num = 4;

        function readImage() {
            if (window.File && window.FileList && window.FileReader) {
                var files = event.target.files; //FileList object
                var output = $(".preview-images-zone");

                for (let i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (!file.type.match('image')) continue;

                    var picReader = new FileReader();

                    picReader.addEventListener('load', function(event) {
                        var picFile = event.target;
                        var html = '<div class="preview-image preview-show-' + num + '">' +
                            '<div class="image-cancel" data-no="' + num + '">x</div>' +
                            '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result +
                            '"></div>' +
                            '<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num +
                            '" class="btn btn-light btn-edit-image">edit</a></div>' +
                            '</div>';

                        output.append(html);
                        num = num + 1;
                    });

                    picReader.readAsDataURL(file);
                }
                $("#pro-image").val('');
            } else {
                console.log('Browser not support');
            }
        }

        function uploadImage() {
    $(".upload-image").text("Uploading Please Wait...");
    
    let images = [];
    
    $(".preview-image img").each(function() {
        const imageSrc = $(this).attr('src');
        if (imageSrc) {
            // Create an image object to send in the form of base64
            images.push(imageSrc);
        }
    });

    if (images.length > 0) {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: "{{ route('upload_banner_list') }}",
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
            data: {
                images: images,
            },
            success: function(data) {
                $(".upload-image").text("Successfully Uploaded");
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("An error occurred while uploading images.");
                $(".upload-image").text("Upload Images");
            }
        });
    } else {
        alert("Please add some slider images.");
    }
}




    </script>
@endsection
