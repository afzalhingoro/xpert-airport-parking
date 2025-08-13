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

                Seo Settings

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









                        {{ Form::open(['class' => 'form-horizontal add_email_template', 'method' => 'post', 'route' => ['settings.update']]) }}

                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('site_title', 'Site Title', ['class' => 'form-label']) }}
                                    {{ Form::text('setting[site_title]', $settings['site_title'], ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[site_title]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[site_title]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('meta_keyword', 'Meta Keyword', ['class' => 'form-label']) }}
                                    {{ Form::text('setting[meta_keyword]', $settings['meta_keyword'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[meta_keyword]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[meta_keyword]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('meta_description', 'Meta Description', ['class' => 'form-label']) }}
                                    {{ Form::textarea('setting[meta_description]', $settings['meta_description'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[meta_description]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[meta_description]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('twitter_title', 'Twitter Title', ['class' => 'form-label']) }}
                                    {{ Form::textarea('setting[site_twitter_title]', $settings['site_twitter_title'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[site_twitter_title]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[site_twitter_title]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('og_title', 'OG Title', ['class' => 'form-label']) }}
                                    {{ Form::textarea('setting[site_og_title]', $settings['site_og_title'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[site_og_title]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[site_og_title]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-6 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('og_url', 'OG URL', ['class' => 'form-label']) }}
                                    {{ Form::textarea('setting[site_og_url]', $settings['site_og_url'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[site_og_url]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[site_og_url]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('og_image', 'OG Image', ['class' => 'form-label']) }}
                                    {{ Form::textarea('setting[site_og_image]', $settings['site_og_image'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[site_og_image]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[site_og_image]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('og_type', 'OG Type', ['class' => 'form-label']) }}
                                    {{ Form::textarea('setting[site_og_type]', $settings['site_og_type'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[site_og_type]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[site_og_type]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('author', 'Author', ['class' => 'form-label']) }}
                                    {{ Form::textarea('setting[site_author]', $settings['site_author'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[site_author]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[site_author]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    {{ Form::label('site_schema', 'Site Schema', ['class' => 'form-label']) }}
                                    {{ Form::textarea('setting[site_schema]', $settings['site_schema'] ?? '', ['class' => 'form-control']) }}
                                    @if ($errors->has('setting[site_schema]'))
                                        <div class="alert alert-danger">
                                            <strong>{{ $errors->first('setting[site_schema]') }}</strong>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                      
                        
                        






                        @can('user_auth', ['edit'])
                            <div class="clearfix ">


                                    {{ Form::submit('Submit', ['class' => 'btn btn-info']) }}



                            </div>
                        @endcan
                        
                        {{ Form::close() }}



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





        });
    </script>
@endsection
