@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
    <!-- <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}" /> -->
 
@endsection
@section('content')
    <div class="page-content">


        <div class="page-header">
            <h1>
                Plan
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    Plan Setting
                </small>
            </h1>
        </div><!-- /.page-header -->

        <div class="row">
            <div class="col-xs-12">
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
                <div class="col-md-3">
                        <label for="form-field-select-2">Plan Type</label>
                        <div class="form-group ">
                            <select class="chosen-select form-control" id="plan_type"
                                data-placeholder="Choose a Plan Type...">
                                <option value=""></option>
                                 <option value="1">Self Plan</option>
                                    <option value="2">Api Plan</option>
                                
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3" style="">
                        <label for="form-field-select-2">Select Agent</label>
                        <div class="form-group ">
                        <select class="chosen-select form-control" id="agent_id" data-placeholder="Choose an Agent...">
                        <option value="">Select Agent</option>
                        @forelse ($agent as $agents)
                            <option value="{{ $agents->id }}">{{ $agents->company }}</option>
                        @empty
                            <option value="">No Agents Available</option>
                        @endforelse
                    </select>

                        </div>
                    </div>
                   <div class="col-md-3">
    <label for="form-field-select-2">Select Company</label>
    <div class="form-group">
        <select class="chosen-select form-control" id="company" data-placeholder="Choose a Company...">
            <!-- Options will be dynamically inserted here -->
        </select>
    </div>
</div>

                    <div class="col-md-3">
                        <label for="form-field-select-2">Year</label>
                        <div class="form-group ">
                            <select class="chosen-select form-control" id="year" data-placeholder="Choose a Year...">
                                <option value=""></option>

                                @php
                                    $years = [];
                                    $y = date('Y') * 1;

                                    if (Request::get('mode') == 'edit') {
                                        $y = Request::get('year');
                                    }

                                    for ($i = $y; $i < $y + 3; $i++) {
                                        $years[$i] = $i;
                                    }

                                @endphp
                                @foreach ($years as $year)
                                    <option @if (Request::get('year') == $year) {{ 'selected="selected"' }} @endif
                                        value="{{ $year }}">{{ $year }}</option>
                                @endforeach


                            </select>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <label for="form-field-select-2">Month</label>
                        <div class="form-group ">
                            <select class="chosen-select form-select" id="month" data-placeholder="Choose a Month...">
                                <option value=""></option>


                                @php
                                    $months = [];

                                    for ($i = 1; $i < 13; $i++) {
                                        $dt = DateTime::createFromFormat('!m', $i);
                                        $months[$i] = $dt->format('F');
                                    }

                                @endphp
                                @foreach ($months as $month)
                                    <option @if (Request::get('month') == date('m', strtotime($month))) {{ 'selected="selected"' }} @endif
                                        value="{{ date('m', strtotime($month)) }}">{{ $month }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>

                    

                    <div class="col-md-3  ">
                        <label for="form-field-select-2">Add Extra</label>
                        <div class="form-group ">
                            <input type="text" name="extra" id="extra" class="form-control" value="" />

                        </div>
                    </div>


                </div>
                <hr />

                <div class="panel-group" id="set_plan">


                </div>


                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
@endsection
@section('footer-script')
    <script src="{{ secure_asset('assets/js/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript">
        @if (Request::get('mode') == 'edit')
            getPlanByUserID();
        @endif


        $('.chosen-select').chosen({
            allow_single_deselect: true
        });
        $("#company,#year,#month").change(function() {
            getPlanByUserID();
        });

        function getPlanByUserID() {
    var airport = $('#company').val();
    var year = $('#year').val();
    var month = $('#month').val();
    var plan_type = $('#plan_type').val();
    var agent_id = $('#agent_id').val();

    // Ensure agent_id is treated properly
    agent_id = agent_id === '' ? 0 : agent_id;

    console.log("airport: " + airport);
    console.log("year: " + year);
    console.log("month: " + month);
    console.log("agent_id: " + agent_id);

    // Ensure agent_id = 0 is allowed
    if (airport !== "" && year !== "" && month !== "" && plan_type !== "" && agent_id !== undefined) {
        $.ajax({
            type: 'get',
            url: 'getCompanySetPlanView/' + airport + "/" + year + "/" + month + "/" + plan_type + "/" + agent_id,
            success: function(msg) {
                $('#set_plan').html(msg);
            }
        });
    }
}


        function updateProductPrices(form_id) {
            var d = $("#" + form_id).serialize();
           

            console.log(d);
            d = d + "&extra=" + $("#extra").val();

            @if (Request::get('mode') == 'edit')
                d = d + "&month=" + $("#month").val();
                //d = d+"&mode=edit";
            @endif
            $.ajax({
                type: 'post',
                data: d,
                url: 'setCompanyPlanPrices',
                success: function(msg) {
                   
                    if (msg.success == true) {
                        @if (Request::get('mode') != 'edit')
                            getPlanByUserID();
                        @endif
                    }

                    $('#message_' + form_id).html(msg.message);
                }
            });
            return false;

        }
    </script>
<script>
   $(document).ready(function() {
    $('#agent_id').closest('.col-md-3').hide();

    // Get query parameters from URL
    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Get values from the URL
    var selectedPlanType = getQueryParam('plan_type');
    var selectedAgentId = getQueryParam('agent_id');
    var selectedCompanyId = getQueryParam('cid');
    var selectedYear = getQueryParam('year');
    var selectedMonth = getQueryParam('month');

    // Function to update the company dropdown
    function updateCompanyDropdown(selectedPlan) {
        var companyDropdown = $('#company');
        companyDropdown.empty(); // Clear existing options

        var companies = selectedPlan == 1 ? @json($selfPlanCompanies) : @json($apiPlanCompanies);

        companyDropdown.append(`<option value="">Choose a Company...</option>`); // Default option

        companies.forEach(function(company) {
            var selected = selectedCompanyId == company.id ? 'selected' : '';
            companyDropdown.append(`<option value="${company.id}" ${selected}>${company.name}</option>`);
        });

        companyDropdown.trigger("chosen:updated");
    }

    // Set default or preselected values for dropdowns
    if (selectedPlanType) {
        $('#plan_type').val(selectedPlanType).trigger('chosen:updated');
        updateCompanyDropdown(selectedPlanType);
    } else {
        updateCompanyDropdown(1);
    }

    if (selectedAgentId) {
        $('#agent_id').val(selectedAgentId).trigger('chosen:updated');
        $('#agent_id').closest('.col-md-3').show();
    }

    if (selectedYear) {
        $('#year').val(selectedYear).trigger('chosen:updated');
    }

    if (selectedMonth) {
        $('#month').val(selectedMonth).trigger('chosen:updated');
    }

    // Change event for plan type selection
    $('#plan_type').change(function() {
        var selectedPlan = $(this).val();

        if (selectedPlan == 2) { 
            $('#agent_id').closest('.col-md-3').show();
        } else {
            $('#agent_id').closest('.col-md-3').hide();
        }

        updateCompanyDropdown(selectedPlan);
    });
});

</script>


@endsection
