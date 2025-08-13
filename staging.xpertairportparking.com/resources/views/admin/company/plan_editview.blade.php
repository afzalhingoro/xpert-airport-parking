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
         View/Edit Plan
         </small>
      </h1>
   </div>
   <!-- /.page-header -->
   <div class="row">
      <div class="col-xs-12">
         <!-- PAGE CONTENT BEGINS -->
         <div class="row">
         <div class="col-md-3">
    <label for="form-field-select-2">Plan Type</label>
    <div class="form-group">
        <select class="chosen-select form-control" id="plan_type" data-placeholder="Choose a Plan Type...">
            <option value="1" selected>Self Plan</option>
            <option value="2">Api Plan</option>
        </select>
    </div>
</div>

<div class="col-md-3">
    <label for="form-field-select-2">Select Agent</label>
    <div class="form-group">
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

<div class="col-lg-4 col-sm-12">
    <label for="form-field-select-2">Select Company</label>
    <div class="form-group">
        <select class="chosen-select form-control" id="form-field-select-3" data-placeholder="Choose a Company...">
            <!-- Options will be dynamically inserted here -->
        </select>
    </div>
</div>
            <!-- <div class="col-md-4">
               <label for="form-field-select-2">Select Company</label>
               <div class="form-group">
                  <select class="chosen-select form-control" id="form-field-select-3"
                     data-placeholder="Choose a Company...">
                     <option value=""></option>
                     @foreach ($companies as $company)
                     <option selected value="{{ $company['id'] }}">{{ $company['name'] }}</option>
                     @endforeach
                  </select>
               </div>
            </div> -->
         </div>
         <div class="panel-group table-responsive" id="plan_setting">
         </div>
         <!-- PAGE CONTENT ENDS -->
      </div>
      <!-- /.col -->
   </div>
   <!-- /.row -->
</div>
@endsection
@section('footer-script')

<script src="{{ secure_asset('assets/js/chosen.jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#agent_id').closest('.col-md-3').hide();

        // Function to update the company dropdown
        function updateCompanyDropdown(selectedPlan) {
            var companyDropdown = $('#form-field-select-3');
            companyDropdown.empty(); // Clear existing options

            var companies = selectedPlan == 1 ? @json($selfPlanCompanies) : @json($apiPlanCompanies);

            companyDropdown.append(`<option value="">Select Company</option>`); // Default option

            companies.forEach(function(company) {
                companyDropdown.append(`<option value="${company.id}">${company.name}</option>`);
            });

            // Reinitialize the chosen-select to reflect the new options
            companyDropdown.trigger("chosen:updated");
        }

        // Set default selection on page load
        updateCompanyDropdown(1);

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
<script type="text/javascript">
  $(document).ready(function() {
    getPlanByUserID();
});

$('.chosen-select').chosen({
    allow_single_deselect: true
});

$("#form-field-select-3, #plan_type, #agent_id").change(function() {
    getPlanByUserID();
});

function getPlanByUserID() {
    var airport = $('#form-field-select-3').val();
    var planType = $('#plan_type').val();
    var agentId = planType == "1" ? 0 : $('#agent_id').val(); // If plan type is 1, set agent_id to 0, else get selected agent_id

    var data = {
        id: airport,
        agent_id: agentId,
        plan_type: planType
    };

    $.ajax({
        type: 'GET',
        url: '../company/getPlanPrices/' + airport,
        data: data,
        success: function(msg) {
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
</script>
@endsection