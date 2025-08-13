@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/admin.css') }}" />
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
                Roles & Menus
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Create
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading main-color-bg">
                            <h3 class="panel-title">Select Your Role</h3>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-3">
                                <select name="mymenu" id="mymenu" class="form-control">
                                </select>
                            </div>
                            <div class="col-md-9">
                                <div class="btn-group">
                                    <a class="btn btn-success " type="button" data-toggle="modal"
                                        data-target="#addrole">Create Role</a></li>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default" id="test">
                        <div class="panel-heading main-color-bg clearfix">
                            <h4 class="panel-title pull-left" style="padding-top: 7.5px;">Menu Structure</h4>
                            <div class="btn-group pull-right">
                                <a class="btn btn-warning " type="button" data-toggle="modal"
                                    data-target="#clone">Clone</a>
                                <a class="btn btn-success " type="button" id="save">Update</a>
                                <a class="btn btn-danger " type="button" data-toggle="modal"
                                    data-target="#addstructure">Create</a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="vspace-16-sm"></div>


                            <div class="dd dd-draghandle" id="nestable">
                                <ol class="dd-list">


                                    {{-- <li class="dd-item dd2-item" data-id="19"> --}}
                                    {{-- <div class="dd-handle dd2-handle"> --}}
                                    {{-- <i class="normal-icon ace-icon fa fa-bars blue bigger-130"></i> --}}

                                    {{-- <i class="drag-icon ace-icon fa fa-arrows bigger-125"></i> --}}
                                    {{-- </div> --}}
                                    {{-- <div class="dd2-content">Menu</div> --}}
                                    {{-- </li> --}}
                                </ol>
                            </div>
                            <input type="hidden" id="nestable-output">

                        </div>
                    </div>

                </div><!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.row -->


    <!-- PAGE CONTENT ENDS -->
    </div><!-- /.col -->
    </div><!-- /.row -->



    <!-- model  for create menu -->


    <div class="modal fade" id="addrole" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Role</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Menu name">
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="yes">Yes</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Permissions</label>
                        <ul class="nav">
                            @foreach ($pers as $per)
                                <li>
                                    <input type="checkbox" class="permission" name="permission"
                                        id="permission{{ $per['name'] }} " value="{{ $per['name'] }}" />
                                    {{ ucwords($per['name']) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="create_role">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="clone" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Clone</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Select Role from</label>
                        <select name="mymenu2" id="mymenu2" class="form-control">
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Role to</label>
                        <select name="mymenu3" id="mymenu3" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="creat_clone">Get Clone</button>
                </div>
            </div>
        </div>
    </div>

    <!-- model  for create menu -->

    <div class="modal fade" id="addstructure" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Menu</h4>
                </div>

                <div class="modal-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Role</label>
                            <select name="mymenu1" id="mymenu1" class="form-control">
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Menu Name</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>URL</label>
                            <input type="text" name="url" id="url" class="form-control" />
                        </div>
                        <div class="form-group icon">
                            <label>Icon</label>
                            <input type="text" name="icons" id="icon" class="form-control" />
                        </div>
                        <div class="form-group" id="permissions">
                            <label>Permissions</label>
                            <ul class="nav">
                                @foreach ($pers as $per)
                                    <li>
                                        <input type="checkbox" class="permission" name="permission"
                                            id="permission{{ $per['name'] }}" value="{{ $per['name'] }}" />
                                        {{ ucwords($per['name']) }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="modal-footer" style="margin:top:10px;">
                    <input type="hidden" id="id" name="id">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pull-left" id="submit">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    <!-- page specific plugin scripts -->
    <script src="{{ secure_asset('assets/js/jquery.nestable.min.js') }}"></script>

    <!-- inline scripts related to this page -->
    {{-- <script type="text/javascript"> --}}
    {{-- jQuery(function($){ --}}

    {{-- //            $('.dd').nestable(); --}}
    {{-- // --}}
    {{-- //            $('.dd-handle a').on('mousedown', function(e){ --}}
    {{-- //                e.stopPropagation(); --}}
    {{-- //            }); --}}
    {{-- // --}}
    {{-- //            $('[data-rel="tooltip"]').tooltip(); --}}
    {{-- --}}
    {{-- --}}
    {{-- --}}
    {{-- --}}

    {{-- }); --}}
    {{-- </script> --}}


    <script>
        $(document).ready(function() {
            $(document).on("click", ".delete-button", function() {

                var x = confirm('Delete this menu?');
                var id = $(this).attr('id');
                if (x) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('delMenu') }}",
                        data: {
                            id: id
                        },
                        cache: false,
                        success: function(data) {
                            $("li[data-id='" + id + "']").remove();
                            window.location.href = "{{ route('roleCreate') }}";
                        }
                    });
                }
            });

            $('#create_role').click(function() {
                //jQuery.noConflict();
                $('#addrole').modal('hide');
                var permissions = [];
                $('.permission:checked').each(function(i, e) {
                    permissions.push($(this).val());
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('createRole') }}",
                    data: {
                        name: $("#name").val(),
                        active: $("#status").val(),
                        permission: permissions,
                        action: 'create_role'
                    },
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        if (data > 0) {
                            $("#success").fadeIn();
                            //setTimeout('$("#success").fadeOut()', 2000);
                            $("#name").val('');
                            select_dropdown();
                        } else {
                            $("#error").fadeIn();
                            //setTimeout('$("#error").fadeOut()', 2000);
                            $("#name").val('');
                            select_dropdown();
                        }

                    }
                });

            });


            $("#creat_clone").click(function() {

                $('#clone').modal('hide');
                $(".loader").fadeIn();
                $.ajax({
                    type: "POST",
                    url: "{{ route('creat_clone') }}",
                    data: {
                        c_from: $('#clone select[name="mymenu2"]').val(),
                        c_to: $('#clone select[name="mymenu3"]').val(),
                        action: 'creat_clone'
                    },
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        window.location.href = "{{ route('roleCreate') }}";
                        //select_dropdown();
                        //$("#success").fadeIn();
                        setTimeout('$("#success").fadeOut()', 2000);
                    }
                });
                $(".loader").fadeOut();
            });


            var updateOutput = function(e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize'))); //, null, 2));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };
            // activate Nestable for list 1
            $('#nestable').nestable({
                    group: 1
                })
                .on('change', updateOutput);
            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));

            $('#nestable-menu').on('click', function(e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });
            $("#save").click(function() {
                //$('.dd').on('change', function() {
                $(".loader").fadeIn();
                var dataString = $("#nestable-output").val();
                $.ajax({
                    type: "POST",
                    url: "{{ route('updateMenuSortOrder') }}",
                    data: {
                        data: dataString,
                        action: 'menu'
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        alert(error);
                    },
                });
                $(".loader").fadeOut();
            });

            $(document).on("click", "#mypage", function() {
                var links = $(this).attr('links');
                var name = $(this).attr('pname');
                $('#addstructure input[name="name"]').val(name);
                $('#addstructure input[name="url"]').val(links);
            });
            //By default
            select_dropdown();
            //Onchange
            $('#mymenu').on('change', function() {
                get_menu($(this).val());
            });


            function get_menu(id) {
                $('.loader').show();
                $.ajax({
                    type: "GET",
                    url: "{{ '../role/getMenusByIdjson/' }}" + id,

                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        if (data == 0) {
                            $('#nestable').html('');
                            $("#nest").fadeIn();
                            setTimeout('$("#nest").fadeOut()', 1500);
                        } else {
                            $('#nest').hide();
                            $('#nestable').html('');
                            $('#nestable').append(data);
                        }
                    }

                });
                $('.loader').hide();
            }

            function select_dropdown() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('getRolesDD') }}",

                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        $('#mymenu1').html('');
                        $('#mymenu2').html('');
                        $('#mymenu3').html('');
                        $('#mymenu').html('');
                        $('#mymenu1').html(data);
                        $('#mymenu2').html(data);
                        $('#mymenu3').html(data);
                        $('#mymenu').html(data);
                        var id = $('#mymenu').val();
                        get_menu(id);

                    }

                });
            }


            $(document).on("click", ".edit-button", function() {

                $('#addstructure').modal('show', {
                    backdrop: 'static'
                });
                var id = $(this).attr('id');
                var label = $(this).attr('label');
                var link = $(this).attr('link');
                var role = $(this).attr('role');
                var icons = $(this).attr('iconz');
                $('#id').val(id);
                $.ajax({
                    type: "POST",
                    url: "{{ route('getEdata') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        data = data[0];
                        $('#addstructure input[name="name"]').val(data.name);
                        $('#addstructure input[name="url"]').val(data.route_name);
                        $('#addstructure select[name="mymenu1"]').val(data.role_id);
                        $('#addstructure input[name="icons"]').val(data.class);
                        if (data.permissions) {
                            var array = data.permissions.split(',');
                            console.log(array);
                            $.each(array, function(key, value) {
                                if (array[key]) {
                                    //console.log("permission"+value);
                                    $('#addstructure input[id="permission' + value +
                                        '"]').prop('checked', true);
                                } else {
                                    $('#addstructure input[id="permission' + value +
                                        '"]').prop('checked', false);
                                }

                            });
                        } else {
                            $('#addstructure input[name="permission"]').prop('checked', false);
                        }

                    }
                });

            });


            $("#submit").click(function() {

                $('#addstructure').modal('hide');
                var permissions = [];
                $('.permission:checked').each(function(i, e) {
                    permissions.push($(this).val());
                });
                $.ajax({
                    type: "POST",
                    url: "{{ route('insertMenu') }}",
                    data: {
                        id: $('#addstructure input[name="id"]').val(),
                        menu_id: $('#addstructure select[name="mymenu1"]').val(),
                        name: $('#addstructure input[name="name"]').val(),
                        slug: $('#addstructure input[name="url"]').val(),
                        icon: $('#addstructure input[name="icons"]').val(),
                        permission: permissions,
                        action: 'insert_menu'
                    },
                    dataType: "json",
                    cache: false,
                    success: function(data) {
                        //window.location.href = "{{ route('roleCreate') }}";
                        select_dropdown();
                        $("#success").fadeIn();
                        setTimeout('$("#success").fadeOut()', 2000);
                    }
                });
            });


        });
    </script>
@endsection
