@extends('admin.layout.master')
@section('stylesheets')
@parent
<link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}" />
<link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}" />
<link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}" />
<style>
/* Ensure modal has full opacity */
.modal.show {
    opacity: 1 !important;
}

/* Adjust top margin of modal */
.modal-dialog {
    margin-top: 9% !important;
}
</style>



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
                <div class="col-lg-4 text-right mt-25">
                    <button class="btn btn-primary" onclick="downloadCSV()">Download CSV</button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#importPricesModal">
                    Import CSV
                </button>

                </div>


            </div>


            <div class="panel-group" id="plan_setting">





            </div>


            <!-- PAGE CONTENT ENDS -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>
<!-- In <head> -->
 
<!-- Before </body> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Import Prices Modal -->
<div class="modal fade" id="importPricesModal" tabindex="-1" role="dialog" aria-labelledby="importPricesModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Prices (CSV or Excel)</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="file" id="priceFile" accept=".csv, .xlsx" class="form-control" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" onclick="importCSV()">Update Prices</button>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer-script')

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
        var plan_type = $('#plan_type').val();
        var agent_id = $('#agent_id').val();
        if (agent_id == '') {
            agent_id = 0
        } else {
            agent_id = agent_id

        }
        var data = {};
        data['id'] = airport;

        $.ajax({
            type: 'get',
            url: '../getPlanView/' + airport + "/" + plan_type + "/" + agent_id,
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

    function downloadCSV() {
        let productNames = [];
        let dayData = {};

        // Initialize dayData with keys from Day 1 to Day 31 and "Over 30 Days"
        for (let i = 1; i <= 31; i++) {
            dayData[`Day ${i}`] = [];
        }
        dayData["Over 30 Days"] = [];

        // Loop through each product form
        $("#plan_setting .panel").each(function() {
            let form = $(this).find("form");
            let productName = form.find("input[name='product_name']").val() || "Unnamed Product";
            productNames.push(productName);

            // Collect daily prices
            for (let i = 1; i <= 31; i++) {
                let price = form.find(`input[name='p_day_${i}']`).val() || "0.00";
                dayData[`Day ${i}`].push(price);
            }

            // Collect over 30/31 day price
            let over30 = form.find("input[name='after_30_days'], input[name='over_31_days']").val() || "0.00";
            dayData["Over 30 Days"].push(over30);
        });

        // Build CSV content
        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Day," + productNames.join(",") + "\n";

        for (let day in dayData) {
            csvContent += day + "," + dayData[day].join(",") + "\n";
        }

        // Trigger download
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "company_prices.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
function importCSV() {
    const fileInput = document.getElementById("priceFile");
    const file = fileInput.files[0];
    if (!file) {
        alert("Please select a file.");
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        const data = new Uint8Array(e.target.result);
        const workbook = XLSX.read(data, { type: "array" });
        const sheet = workbook.Sheets[workbook.SheetNames[0]];
        const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

        const headerRow = jsonData[1]; // Row 2: ['Number of days', 'A', 'B']
        const planKeys = headerRow.slice(1); // ['A', 'B']

        for (let i = 2; i < jsonData.length; i++) {
            const row = jsonData[i];
            const day = parseInt(row[0]);

            for (let col = 1; col < row.length; col++) {
                const planName = planKeys[col - 1];
                const planId = planName.toLowerCase().replace(/\s+/g, "_");
                const price = parseFloat(row[col]);

                if (!isNaN(day) && !isNaN(price)) {
                    const inputId = `${planId}_p_day_${day}`;
                    const input = document.getElementById(inputId);
                    if (input) {
                        input.value = price.toFixed(2);
                    }
                }

                // Update over-30-days value if it's labeled 'Over 30 Days' or day > 31
                if ((day === "Over 30 Days" || day === "Over30" || day > 31) && !isNaN(price)) {
                    const overInputId = `${planId}_after_30_days`;
                    const altOverInputId = `${planId}_over_31_days`;

                    const overInput = document.getElementById(overInputId) || document.getElementById(altOverInputId);
                    if (overInput) {
                        overInput.value = price.toFixed(2);
                    }
                }
            }
        }

        const modal = bootstrap.Modal.getInstance(document.getElementById("importPricesModal"));
        modal?.hide();

        alert("Prices updated!");
    };
    reader.readAsArrayBuffer(file);
}


</script>



@endsection