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
<style>
    .highlighted a {
        background-color: #ff9999 !important;
        background-image: none !important;
        color: #000 !important;
    }
</style>
    <div class="page-content">
        <div class="page-header">
            <h1>
                Add OFF Days
                <!--<small>-->
                <!--    <i class="ace-icon fa fa-angle-double-right"></i>-->
                <!--    Add-->
                <!--</small>-->
            </h1>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @elseif($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif


        <div class="row">

            <form method="POST" action="{{ route('offDaysSave') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            Select OFF Days Type<br>
                            <select name="off_day_type" id="off_day_type" class="form-control input-sm select-wid"
                                onchange="toggleVisibility()">
                                <option>Select OFF Days Types</option>
                                <option value="Admin">Admin</option>
                                <option value="Company">Company</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" id="adminSection" style="display: none;">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            Select Admin
                            <select name="admins" class="form-control input-sm">
                                <option value="all">Select Admin</option>
                                @foreach ($admins as $admin)
                                    <option @if (Request::get('admins') == $admin->id) {{ "selected='selected'" }} @endif
                                        value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" id="companySection" style="display: none;">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            Companies<br>
                            <select name="companies" class="form-control input-sm select-wid">
                                <option value="all">Select Company</option>
                                @foreach ($companies_dlist as $company)
                                    <option @if (Request::get('companies') == $company->id) {{ "selected='selected'" }} @endif
                                        value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            Select OFF Dates<br>
                            <input type="text" name="start_date" id="start_date" autocomplete="off" class="form-control input-sm datepicker" placeholder="Start Date" data-date-format="dd-M-yyyy" readonly>
                        </div>
                        <div class="form-group">
                            <a style="position: absolute;right: 0;z-index: 1;top: 24px;background: #337ab7;color: white;padding: 5px;height: 30px;">Close Calendar</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <!--OFF Dates<br>-->
                            <textarea type="text" name="off_dates" class="form-control input-sm" id="off_dates" placeholder="Add Dates" readonly></textarea>
                            <!--<small style="font-size: 13px;">Enter comma-separated dates in this format(yyyy-mm-dd-->
                            <!--    2024-02-29)</small>-->

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-warning">Submit</button>
                        </div>
                    </div>
                </div>
            </form>


        </div>
    </div>
@endsection
@section('footer-script')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/rickshaw/rickshaw.min.css') }}">
    <script src="{{ asset('assets/rickshaw/vendor/d3.v3.js') }}"></script>
    <script src="{{ asset('assets/rickshaw/rickshaw.min.js') }}"></script>
    <script src='{{ secure_asset("assets/js/daterangepicker.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/bootstrap-datetimepicker.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/bootstrap-datepicker.min.js") }}'></script>
    <script src='{{ secure_asset("assets/js/bootstrap-timepicker.min.js") }}'></script>
    <script>
        // Function to toggle visibility based on selected option
        function toggleVisibility() {
            var selectedOption = document.getElementById('off_day_type').value;

            // Hide all sections by default
            document.getElementById('adminSection').style.display = 'none';
            document.getElementById('companySection').style.display = 'none';

            // Show the relevant section based on the selected option
            if (selectedOption === 'Admin') {
                document.getElementById('adminSection').style.display = 'block';
            } else if (selectedOption === 'Company') {
                document.getElementById('companySection').style.display = 'block';
            }
        }
    </script>
    <script type="text/javascript">


	$('#start_date').datepicker({
		autoclose: false,
		todayHighlight: true
	})
	//show datepicker when clicking on the icon
		.next().on(ace.click_event, function () {
		$(this).prev().focus();
	});


	$('#end_date').datepicker({
		autoclose: true,
		todayHighlight: true
	})
	//show datepicker when clicking on the icon
		.next().on(ace.click_event, function () {
		$(this).prev().focus();
	});

</script>
<script>
$(document).ready(function() {
    $('#start_date').datepicker({
        format: 'dd-M-yyyy',
        beforeShowDay: function(date) {
            var offDates = $('#off_dates').val();
            var offDatesArray = offDates ? offDates.split(', ') : [];
            var formattedDate = $.datepicker.formatDate('yy-mm-dd', date);
            if (offDatesArray.indexOf(formattedDate) != -1) {
                return [true, 'highlighted', ''];
            }
            return [true, '', ''];
        }
    }).on('changeDate', function(e) {
        var selectedDate = $('#start_date').datepicker('getFormattedDate', 'yyyy-mm-dd');
        var offDates = $('#off_dates').val();
        var offDatesArray = offDates ? offDates.split(', ') : [];

        var dateIndex = offDatesArray.indexOf(selectedDate);

        if (dateIndex > -1) {
            offDatesArray.splice(dateIndex, 1);
        } else {
            offDatesArray.push(selectedDate);
        }

        $('#off_dates').val(offDatesArray.join(', '));
        $('#start_date').datepicker('update');  // Update the datepicker after adding
        
        // Manually highlight selected dates
        $('.highlighted').removeClass('highlighted');
        var offDatesArrayFormatted = offDatesArray.map(function(date) {
            return $.datepicker.parseDate('yy-mm-dd', date);
        });
        offDatesArrayFormatted.forEach(function(date) {
            var formattedDate = $.datepicker.formatDate('dd-M-yyyy', date);
            $('[data-date="' + formattedDate + '"]').addClass('highlighted');
        });
    });
});
</script>

    
@endsection
