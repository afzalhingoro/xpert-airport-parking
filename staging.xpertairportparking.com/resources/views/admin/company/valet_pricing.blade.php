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
                Plan
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Valet Pricing
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="row">
            <div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-3">
                <div class="demo-form-wrapper">
                    <form class="form" id="valet_form" action="" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="card mt-15">
                                <div class="card-header">
                                    <div class="card-actions">

                                    </div>
                                    <strong>Valeting</strong>
                                </div>
                                <div class="card-body" data-toggle="match-height">
                                    <table class="table table-hover table-bordered valetTable">

                                        <tbody>
                                            <tr>
                                                <th></th>

                                                <th>Car</th>

                                                <th>4X4</th>

                                                <th>MPV</th>

                                            </tr>
                                            @if($valet != null)
                                            <tr>
                                                <td>Standard</td>
                                                
                                                <td><input class="form-control" id="st_car" name="st_car"
                                                        value="{{ $valet[0]['car'] }}" type="number" placeholder=""></td>
                                                <td><input class="form-control" id="st_4" name="st_4"
                                                        value="{{ $valet[0]['4x4'] }}" type="number" placeholder=""></td>
                                                <td><input class="form-control" id="st_mpv" name="st_mpv"
                                                        value="{{ $valet[0]['mpv'] }}" type="number" placeholder=""></td>

                                            </tr>
                                            <tr>
                                                <td>Executive</td>
                                                <td><input class="form-control" id="ex_car" name="ex_car"
                                                        value="{{ $valet[1]['car'] }}" type="number" placeholder=""></td>
                                                <td><input class="form-control" id="ex_4" name="ex_4"
                                                        value="{{ $valet[1]['4x4'] }}" type="number" placeholder=""></td>
                                                <td><input class="form-control" id="ex_mpv" name="ex_mpv"
                                                        value="{{ $valet[1]['mpv'] }}" type="number" placeholder=""></td>

                                            </tr>
                                            <tr>
                                                <td>Premier</td>
                                                <td><input class="form-control" id="pre_car" name="pre_car"
                                                        value="{{ $valet[2]['car'] }}" type="number" placeholder=""></td>
                                                <td><input class="form-control" id="pre_4" name="pre_4"
                                                        value="{{ $valet[2]['4x4'] }}" type="number" placeholder=""></td>
                                                <td><input class="form-control" id="pre_mpv" name="pre_mpv"
                                                        value="{{ $valet[2]['mpv'] }}" type="number" placeholder=""></td>
                                        
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="response"></div>



                        <div class="form-group">
                            <button class="btn btn-primary btn-block" type="submit" name="action">Submit</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer-script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ secure_asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript">
        $('.chosen-select').chosen({
            allow_single_deselect: true
        });
        $(document).ready(function() {
            getPlanByUserID();
        });
        $("#form-field-select-3").change(function() {
            getPlanByUserID();
        });

        function getPlanByUserID() {
            var airport = $('#form-field-select-3').val();
            var data = {};
            data['id'] = airport;
            $.ajax({
                type: 'get',
                url: '../getPlanView/' + airport,
                success: function(msg) {
                    // $('#terminalSection').show();
                    $('#plan_setting').html(msg);
                }
            });

        }

        function updateProductPrices(form_id) {
            var d = $("#" + form_id).serialize();
            console.log(d);
            $.ajax({
                type: 'post',
                data: d,
                url: '../updateProductPrices',
                success: function(msg) {

                    if ($("#action_sub").val() == "add") {
                        $("#action_sub").val("update");
                    }
                    // $('#terminalSection').show();
                    console.log(msg);
                    //var obj = JSON.parse(msg);

                    $('#message_' + form_id).html(msg.message);
                }
            });
            return false;

        }
        $("#valet_form").on("submit", function() {
            var d = $("#valet_form").serialize();
            console.log(d);
            $.ajax({
                type: 'post',
                data: d,
                url: '/admin/company/updateValetProductPrices',
                success: function(msg) {


                    console.log(msg);
                    $('#response').html(msg.message);
                }
            });
            return false;
        })
    </script>
@endsection
