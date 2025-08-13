<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Airport Parking - Customer Support</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-purple: #6f42c1;
            --dark-purple: #5a32a3;
            --medium-purple: #8a6dbb;
            --light-purple: #e2d9f3;
            --lighter-purple: #f5f2fd;
            --light-gray: #f8f9fa;
            --medium-gray: #e9ecef;
            --success-green: #28a745;
            --warning-orange: #ffc107;
            --danger-red: #dc3545;
            --info-blue: #17a2b8;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            color: #333;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            color: white;
            padding: 15px 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        
        .logo {
            font-size: 24px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo-icon {
            background: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-purple);
        }
        
        .agent-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .agent-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        .logout-btn {
            background-color: transparent;
            border: 1px solid white;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            transition: all 0.3s;
        }
        
        .logout-btn:hover {
            background-color: white;
            color: var(--primary-purple);
        }
        
        .search-container {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            margin: 25px 0;
            border: 1px solid var(--medium-gray);
        }
        
        .search-box {
            position: relative;
        }
        
        .search-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-purple);
            font-size: 18px;
        }
        
        .search-input {
            padding-left: 50px !important;
            height: 55px;
            border-radius: 30px;
            border: 2px solid var(--light-purple);
            font-size: 16px;
            box-shadow: 0 2px 6px rgba(111, 66, 193, 0.1);
        }
        
        .search-input:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
        }
        
        .results-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
            margin-bottom: 30px;
            border: 1px solid var(--medium-gray);
        }
        
        .results-header {
            background: linear-gradient(135deg, var(--lighter-purple), white);
            padding: 18px 25px;
            border-bottom: 1px solid var(--medium-gray);
            font-weight: 700;
            color: var(--dark-purple);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .results-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .results-table thead th {
            background-color: var(--lighter-purple);
            color: var(--dark-purple);
            font-weight: 600;
            padding: 15px 20px;
            border-bottom: 2px solid var(--light-purple);
            position: sticky;
            top: 0;
        }
        
        .results-table tbody td {
            padding: 15px 20px;
            border-bottom: 1px solid var(--medium-gray);
            vertical-align: middle;
        }
        
        .results-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .results-table tbody tr:hover {
            background-color: var(--lighter-purple);
        }
        
        .booking-ref {
            font-weight: 700;
            color: var(--primary-purple);
        }
        
        .customer-name {
            font-weight: 600;
            color: #333;
        }
        
        .contact-info {
            font-size: 14px;
            color: #666;
        }
        
        .vehicle-details {
            font-size: 14px;
            color: #444;
        }
        
        .date-info {
            font-size: 14px;
            font-weight: 500;
        }
        
        .date-label {
            font-size: 12px;
            color: #777;
            display: block;
        }
        
        .amount-info {
            font-weight: 700;
            color: var(--primary-purple);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }
        
        .status-completed {
            background-color: #e1f7e7;
            color: #1a7d43;
        }
        
        .status-pending {
            background-color: #fff5e0;
            color: #d97706;
        }
        
        .status-cancelled {
            background-color: #fde8e8;
            color: #c81e1e;
        }
        
        .status-refund {
            background-color: #e0f0ff;
            color: #1d4ed8;
        }
        
        .status-refunded {
            background-color: #d1e7dd;
            color: #0f5132;
        }
        
        .status-cancelled-refunded {
            background: linear-gradient(135deg, #fde8e8, #d1e7dd);
            color: #721c24;
        }
        
        .action-buttons {
            display: flex;
            gap: 8px;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            background-color: var(--lighter-purple);
            color: var(--primary-purple);
        }
        
        .action-btn:hover {
            background-color: var(--primary-purple);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(111, 66, 193, 0.2);
        }
        
        .action-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .action-btn:disabled:hover {
            background-color: var(--lighter-purple);
            color: var(--primary-purple);
            transform: none;
            box-shadow: none;
        }
        
        .view-btn {
            background-color: #e0f0ff;
            color: #1d4ed8;
        }
        
        .edit-btn {
            background-color: #e0f7fa;
            color: #0097a7;
        }
        
        .reschedule-btn {
            background-color: #e8f5e9;
            color: #2e7d32;
        }
        
        .refund-btn {
            background-color: #fff5e0;
            color: #d97706;
        }
        
        .email-btn {
            background-color: #f3e5f5;
            color: #7b1fa2;
        }
        
        .cancel-btn {
            background-color: #fde8e8;
            color: #c81e1e;
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-purple), var(--dark-purple));
            color: white;
        }
        
        .modal-title {
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .modal-title i {
            font-size: 22px;
        }
        
        .modal-footer .btn-primary {
            background-color: var(--primary-purple);
            border-color: var(--primary-purple);
            min-width: 120px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
        }
        
        .modal-footer .btn-primary:hover {
            background-color: var(--dark-purple);
            border-color: var(--dark-purple);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(111, 66, 193, 0.3);
        }
        
        .modal-footer .btn-outline-secondary {
            border-radius: 8px;
            padding: 10px 20px;
        }
        
        .detail-group {
            margin-bottom: 20px;
            padding-bottom: 20px;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        .detail-group-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-purple);
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .detail-row {
            display: flex;
            margin-bottom: 12px;
        }
        
        .detail-label {
            flex: 0 0 40%;
            font-weight: 600;
            color: #555;
        }
        
        .detail-value {
            flex: 0 0 60%;
            color: #333;
        }
        
        .loading-spinner {
            text-align: center;
            padding: 40px;
        }
        
        .spinner-border {
            width: 3rem;
            height: 3rem;
            color: var(--primary-purple);
        }
        
        .no-results {
            text-align: center;
            padding: 40px;
            color: #777;
        }
        
        .no-results i {
            font-size: 60px;
            color: var(--light-purple);
            margin-bottom: 15px;
        }
        
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #777;
        }
        
        .empty-state i {
            font-size: 80px;
            color: var(--light-purple);
            margin-bottom: 15px;
            opacity: 0.5;
        }
        
        .tab-content {
            padding: 25px 0;
        }
        
        .nav-tabs .nav-link {
            color: var(--primary-purple);
            font-weight: 600;
            border: none;
            padding: 12px 25px;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--dark-purple);
            background-color: var(--lighter-purple);
            border-bottom: 3px solid var(--primary-purple);
        }
        
        .form-label {
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
        }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #ddd;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(111, 66, 193, 0.25);
        }
        
        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
        }
        
        .toast {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .toast-header {
            background: var(--primary-purple);
            color: white;
            font-weight: 600;
        }
        
        .email-preview {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #eee;
            min-height: 200px;
            margin-top: 20px;
        }
        
        .email-header {
            border-bottom: 1px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        
        .email-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--primary-purple);
            margin-bottom: 5px;
        }
        
        .email-subtitle {
            font-size: 16px;
            color: #666;
            margin-bottom: 20px;
        }
        
        .email-content {
            line-height: 1.6;
            color: #444;
        }
        
        .action-tabs .nav-link {
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 8px 8px 0 0;
        }
        
        .status-indicator {
            display: inline-block;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 5px;
        }
        
        .status-active {
            background-color: var(--success-green);
        }
        
        .status-pending {
            background-color: var(--warning-orange);
        }
        
        .status-inactive {
            background-color: var(--danger-red);
        }

        .section-title {
            font-weight: 600;
            margin-bottom: 8px;
            color: #2c3e50;
        }
        .detail-section {
            margin-bottom: 10px;
            font-size: 0.95rem;
        }
        .status-badge {
            padding: 3px 8px;
            border-radius: 4px;
            color: #fff;
            font-size: 0.8rem;
        }
        .status-completed { background-color: #28a745; }
        .status-pending { background-color: #ffc107; color: #000; }
        .status-failed { background-color: #dc3545; }
        .status-refunded { background-color: #17a2b8; }
        .status-refund { background-color: #6f42c1; }
        .status-processed { background-color: #007bff; }
        .status-abandoned { background-color: orange; }

    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="fas fa-parking"></i>
                    </div>
                    <span>Xpert Airport Parking</span>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="agent-info">
                        <div class="agent-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <div class="fw-medium">{{ Auth::user()->name }}</div>
                            <div class="small">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                    <a class="logout-btn d-flex align-items-center" style = "text-decoration:none;" href="{{ route('adminLogout') }}">
                        <i class="fas fa-sign-out-alt me-1"></i> Logout
                        <i class="icon-base ti tabler-logout ms-2 icon-14px"></i>
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <div class="container my-4">
        <!-- Search Section -->
        <div class="search-container">
            <h2 class="mb-4"><i class="fas fa-headset me-2"></i> Customer Support Panel</h2>
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input 
                    type="text" 
                    class="form-control search-input" 
                    id="searchInput" 
                    placeholder="Search bookings by reference, name, email, phone, or vehicle details..."
                    autofocus
                >
            </div>
        </div>
        
        <!-- Results Section -->
        <div class="results-container">
            <div class="results-header">
                <div>
                    <i class="fas fa-list me-2"></i>
                    Booking Results
                </div>
                <div id="resultCount">0 bookings found</div>
            </div>
            
            <div class="loading-spinner" id="loadingSpinner" style="display: none;">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div class="mt-3">Searching bookings...</div>
            </div>
            
            <div class="no-results" id="noResults"  style="display: none;">
                <i class="fas fa-search"></i>
                <h4>No bookings found</h4>
                <p class="text-muted">Try searching with different keywords</p>
            </div>
            
            <div class="empty-state" id="emptyState">
                <i class="fas fa-search-location"></i>
                <h3>Discover Bookings</h3>
                <p class="text-muted">Enter a search term above to find customer bookings</p>
                <p class="text-muted small mt-3">Search by reference number, name, email, phone, or vehicle details</p>
            </div>
            
            <div id="resultsContent" style="display: none;">
                <div class="table-responsive">
                    <table class="results-table">
                        <thead>
                            <tr>
                                <th>Booking Ref</th>
                                <th>Customer</th>
                                <th>Contact</th>
                                <th>Vehicle</th>
                                <th style="width: 10%;">Departure</th>
                                <th style="width: 10%;">Arrival</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="resultsList">
                            <!-- Results will be populated here via AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- View Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                <i class="fas fa-info-circle me-2"></i> Booking Details
                <small class="text-light ms-2">Ref: <span id="detailReference"></span></small>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="container-fluid">
                
                <!-- Customer Info -->
                <h6 class="section-title"><i class="fas fa-user me-2"></i>Customer Information</h6>
                <div class="row detail-section">
                    <div class="col-md-6"><strong>Full Name:</strong> <span id="detailName"></span></div>
                    <div class="col-md-6"><strong>Email:</strong> <span id="detailEmail"></span></div>
                    <div class="col-md-6"><strong>Phone:</strong> <span id="detailPhone"></span></div>
                    <div class="col-md-6"><strong>Address:</strong> <span id="detailAddress"></span></div>
                    <div class="col-md-4"><strong>City:</strong> <span id="detailCity"></span></div>
                    <div class="col-md-4"><strong>Country:</strong> <span id="detailCountry"></span></div>
                    <div class="col-md-4"><strong>Postal Code:</strong> <span id="detailPostal"></span></div>
                </div>

                <hr>

                <!-- Vehicle Info -->
                <h6 class="section-title"><i class="fas fa-car me-2"></i>Vehicle Information</h6>
                <div class="row detail-section">
                    <div class="col-md-4"><strong>Make & Model:</strong> <span id="detailVehicle"></span></div>
                    <div class="col-md-4"><strong>Color:</strong> <span id="detailColor"></span></div>
                    <div class="col-md-4"><strong>Registration:</strong> <span id="detailReg"></span></div>
                </div>

                <hr>

                <!-- Travel Info -->
                <h6 class="section-title"><i class="fas fa-plane-departure me-2"></i>Travel Information</h6>
                <div class="row detail-section">
                    <div class="col-md-6"><strong>Departure Date:</strong> <span id="detailDepartDate"></span></div>
                    <div class="col-md-6"><strong>Departure Terminal:</strong> <span id="detailDepartTerminal"></span></div>
                    <div class="col-md-6"><strong>Return Date:</strong> <span id="detailReturnDate"></span></div>
                    <div class="col-md-6"><strong>Return Terminal:</strong> <span id="detailReturnTerminal"></span></div>
                    <div class="col-md-4"><strong>No. of Days:</strong> <span id="detailDays"></span></div>
                    <div class="col-md-4"><strong>Flight Out:</strong> <span id="detailDeptFlight"></span></div>
                    <div class="col-md-4"><strong>Flight In:</strong> <span id="detailReturnFlight"></span></div>
                </div>

                <hr>

                <!-- Payment Info -->
                <h6 class="section-title"><i class="fas fa-receipt me-2"></i>Payment Information</h6>
                <div class="row detail-section">
                    <div class="col-md-4"><strong>Booking Amount:</strong> <span id="detailAmount"></span></div>
                    <div class="col-md-4"><strong>Discount:</strong> <span id="detailDiscount"></span></div>
                    <div class="col-md-4"><strong>Total Paid:</strong> <span id="detailTotal"></span></div>
                    <div class="col-md-4"><strong>Payment Method:</strong> <span id="detailPayment"></span></div>
                    <div class="col-md-4"><strong>Payment Status:</strong> <span id="detailPaymentStatus"></span></div>
                    <div class="col-md-4"><strong>Refund Status:</strong> <span id="detailRefundStatus"></span></div>
                    <div class="col-md-12 mt-2"><strong>API Error:</strong> <span id="detailApiError" class="text-danger small"></span></div>
                </div>

                <hr>

                <!-- Booking Status -->
                <h6 class="section-title"><i class="fas fa-tasks me-2"></i>Booking Status</h6>
                <div class="row detail-section">
                    <div class="col-md-4"><strong>Status:</strong> <span id="detailBookingStatus"></span></div>
                    <div class="col-md-4"><strong>Action:</strong> <span id="detailBookingAction"></span></div>
                    <div class="col-md-4"><strong>Source:</strong> <span id="detailSource"></span></div>
                </div>

                <!-- Admin Only - Toggle -->
                <button class="btn btn-sm btn-outline-secondary mt-3" style="display: none;" data-bs-toggle="collapse" data-bs-target="#extraDetails">
                    Show Technical Details
                </button>
                <div id="extraDetails" class="collapse mt-2">
                    <pre id="detailJson" class="bg-light p-2 small border rounded"></pre>
                </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

    
    <!-- Edit Booking Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-edit"></i> Edit Booking Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs action-tabs mb-4">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#customerTab">Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#vehicleTab">Vehicle</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#travelTab">Travel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#paymentTab">Payment</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="customerTab">
                            <input type="hidden" id="editBookingId">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" id="editFirstName">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" id="editLastName">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" id="editEmail">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="editPhone">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" id="editAddress">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" id="editCity">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" id="editCountry">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" id="editPostal">
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="vehicleTab">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Vehicle Make</label>
                                    <input type="text" class="form-control" id="editMake">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Vehicle Model</label>
                                    <input type="text" class="form-control" id="editModel">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Color</label>
                                    <input type="text" class="form-control" id="editColor">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Registration</label>
                                    <input type="text" class="form-control" id="editRegistration">
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="travelTab">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Departure Date</label>
                                    <input type="datetime-local" class="form-control" id="editDepartDate">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Departure Terminal</label>
                                    <input type="text" class="form-control" id="editDepartTerminal">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Return Date</label>
                                    <input type="datetime-local" class="form-control" id="editReturnDate">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Return Terminal</label>
                                    <input type="text" class="form-control" id="editReturnTerminal">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Departure Flight</label>
                                    <input type="text" class="form-control" id="editDepartFlight">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Return Flight</label>
                                    <input type="text" class="form-control" id="editReturnFlight">
                                </div>
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="paymentTab">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Booking Amount (£)</label>
                                    <input type="number" class="form-control" id="editBookingAmount" step="0.01">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Discount Amount (£)</label>
                                    <input type="number" class="form-control" id="editDiscountAmount" step="0.01">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Total Paid (£)</label>
                                    <input type="number" class="form-control" id="editTotalAmount" step="0.01" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Payment Method</label>
                                    <select class="form-select" id="editPaymentMethod">
                                        <option value="stripe">Stripe (Card)</option>
                                        <option value="paypal">PayPal</option>
                                        <option value="bank">Bank Transfer</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Payment Status</label>
                                    <select class="form-select" id="editPaymentStatus">
                                        <option value="success">Completed</option>
                                        <option value="pending">Pending</option>
                                        <option value="failed">Failed</option>
                                        <option value="refunded">Refunded</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Refund Status</label>
                                    <select class="form-select" id="editRefundStatus">
                                        <option value="">Not Refunded</option>
                                        <option value="Refunded">Refunded</option>
                                        <option value="Partial">Partial Refund</option>
                                        <option value="Processing">Processing</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Reschedule Modal -->
    <div class="modal fade" id="rescheduleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-calendar-alt"></i> Reschedule Booking</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="rescheduleBookingId">
                    <div class="mb-3">
                        <label class="form-label">Booking Reference</label>
                        <input type="text" class="form-control" id="rescheduleReference" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="rescheduleCustomer" disabled>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Original Departure</label>
                            <input type="text" class="form-control" id="rescheduleOriginalDepart" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Departure Date</label>
                            <input type="datetime-local" class="form-control" id="rescheduleDepartDate">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Original Return</label>
                            <input type="text" class="form-control" id="rescheduleOriginalReturn" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">New Return Date</label>
                            <input type="datetime-local" class="form-control" id="rescheduleReturnDate">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Departure Terminal</label>
                            <input type="text" class="form-control" id="rescheduleDepartTerminal">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Return Terminal</label>
                            <input type="text" class="form-control" id="rescheduleReturnTerminal">
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Departure Flight</label>
                            <input type="text" class="form-control" id="rescheduleDepartFlight">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Return Flight</label>
                            <input type="text" class="form-control" id="rescheduleReturnFlight">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Reschedule Reason</label>
                        <select class="form-select" id="rescheduleReason">
                            <option>Flight changed</option>
                            <option>Customer request</option>
                            <option>Airport change</option>
                            <option>Other</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Additional Notes</label>
                        <textarea class="form-control" id="rescheduleNotes" rows="3" placeholder="Enter any additional information..."></textarea>
                    </div>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Rescheduling may affect the booking price. The customer will be notified of any changes.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="saveRescheduleBtn">Confirm Reschedule</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Refund Modal -->
    <div class="modal fade" id="refundModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-money-bill-wave"></i> Process Refund</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="refundBookingId">
                    <div class="mb-3">
                        <label class="form-label">Booking Reference</label>
                        <input type="text" class="form-control" id="refundReference" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Customer Name</label>
                        <input type="text" class="form-control" id="refundCustomer" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Original Amount</label>
                        <input type="text" class="form-control" id="refundAmount" disabled>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Refund Amount (£)</label>
                            <input type="number" class="form-control" id="refundRefundAmount" min="0" step="0.01">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Refund Method</label>
                            <select class="form-select" id="refundMethod">
                                <option>Original Payment Method</option>
                                <option>Bank Transfer</option>
                                <option>Credit Note</option>
                                <option>Cash</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Refund Reason</label>
                        <select class="form-select" id="refundReason">
                            <option>Cancellation</option>
                            <option>Customer request</option>
                            <option>Service not provided</option>
                            <option>Overpayment</option>
                            <option>Other</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Additional Notes</label>
                        <textarea class="form-control" id="refundNotes" rows="3" placeholder="Enter any additional information..."></textarea>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="notifyCustomer" checked>
                        <label class="form-check-label" for="notifyCustomer">
                            Notify customer about refund
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="processRefundBtn">Process Refund</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Resend Email Modal -->
    <div class="modal fade" id="emailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-envelope"></i> Resend Booking Email</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="emailBookingId">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Booking Reference</label>
                            <input type="text" class="form-control" id="emailReference" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="emailCustomer" disabled>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="emailAddress">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="emailPhone">
                        </div>
                    </div>
                    
                    <div class="mb-4" style="display: none;">>
                        <label class="form-label">Email Template</label>
                        <select class="form-select" id="emailTemplate">
                            <option>Booking Confirmation</option>
                            <option>Booking Update</option>
                            <option>Cancellation Confirmation</option>
                            <option>Refund Confirmation</option>
                            <option>Reminder (24h before departure)</option>
                        </select>
                    </div>
                    
                    <div class="form-check mb-4" style="display: none;">>
                        <input class="form-check-input" type="checkbox" id="includeSMS" checked>
                        <label class="form-check-label" for="includeSMS">
                            Also send SMS notification
                        </label>
                    </div>
                    
                    <div class="email-preview" style="display: none;">
                        <div class="email-header">
                            <div class="email-title">Booking Confirmation</div>
                            <div class="email-subtitle">Xpert Airport Parking - Booking #<span id="previewReference"></span></div>
                        </div>
                        <div class="email-content">
                            <p>Dear <span id="previewName"></span>,</p>
                            <p>Thank you for booking with Xpert Airport Parking! Your booking details are confirmed below:</p>
                            
                            <p><strong>Booking Reference:</strong> <span id="previewReference2"></span></p>
                            <p><strong>Dates:</strong> <span id="previewDates"></span></p>
                            <p><strong>Vehicle:</strong> <span id="previewVehicle"></span></p>
                            <p><strong>Total Paid:</strong> <span id="previewAmount"></span></p>
                            
                            <p>Please present your booking reference and ID when you arrive at our parking facility.</p>
                            <p>If you have any questions, please contact our support team at support@xpertairportparking.com or call +44 20 7123 4567.</p>
                            
                            <p>Safe travels,<br>
                            The Xpert Airport Parking Team</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="resendEmailBtn">Resend Email</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Success Toast -->
    <div class="toast-container">
        <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto"><i class="fas fa-check-circle me-2"></i> Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Operation completed successfully!
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 + jQuery (agar already included nahi) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        $(document).ready(function() {
            // Initialize modals
            const detailsModal = new bootstrap.Modal('#detailsModal');
            const editModal = new bootstrap.Modal('#editModal');
            const rescheduleModal = new bootstrap.Modal('#rescheduleModal');
            const refundModal = new bootstrap.Modal('#refundModal');
            const emailModal = new bootstrap.Modal('#emailModal');
            const successToast = new bootstrap.Toast('#successToast');
            
            // DOM elements
            const searchInput = $('#searchInput');
            const resultsList = $('#resultsList');
            const loadingSpinner = $('#loadingSpinner');
            const noResults = $('#noResults');
            const emptyState = $('#emptyState');
            const resultsContent = $('#resultsContent');
            const resultCount = $('#resultCount');
            
            // Search functionality
            let searchTimeout;
            searchInput.on('input', function() {
                clearTimeout(searchTimeout);
                const term = $(this).val().trim();
                
                if (term.length === 0) {
                    resultsContent.hide();
                    noResults.hide();
                    loadingSpinner.hide();
                    emptyState.show();
                    resultCount.text('0 bookings found');
                    return;
                }
                
                if (term.length < 2) return;
                
                loadingSpinner.show();
                noResults.hide();
                emptyState.hide();
                resultsContent.hide();
                
                searchTimeout = setTimeout(() => {
                    // Simulate AJAX call - in a real app, this would be your Laravel endpoint
                    simulateSearch(term);
                }, 500);
            });
            
            // Simulate search with sample data
            function simulateSearch(term) {
                loadingSpinner.show();
                noResults.hide();
                resultsContent.hide();
            
                $.ajax({
                    url: "{{ route('support.search') }}",
                    method: 'POST',
                    data: {
                        term: term,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        loadingSpinner.hide();
            
                        if (!Array.isArray(response) || response.length === 0) {
                            noResults.show();
                            resultCount.text('0 bookings found');
                            return;
                        }
            
                        // Filter results
                        const searchTerm = term.toLowerCase();
                        const filtered = response.filter(booking => {
                            return (
                                (booking.referenceNo || '').toLowerCase().includes(searchTerm) ||
                                ((booking.first_name || '') + ' ' + (booking.last_name || '')).toLowerCase().includes(searchTerm) ||
                                (booking.email || '').toLowerCase().includes(searchTerm) ||
                                (booking.phone_number || '').includes(term) ||
                                ((booking.make || '') + ' ' + (booking.model || '')).toLowerCase().includes(searchTerm) ||
                                (booking.registration || '').toLowerCase().includes(searchTerm)
                            );
                        });
            
                        if (filtered.length === 0) {
                            noResults.show();
                            resultCount.text('0 bookings found');
                            return;
                        }
            
                        // Update count & show results
                        resultCount.text(filtered.length + ' booking' + (filtered.length !== 1 ? 's' : '') + ' found');
                        buildResultsTable(filtered);
                        resultsContent.show();
                    },
                    error: function() {
                        loadingSpinner.hide();
                        resultsList.html('<div class="alert alert-danger">Error loading results. Please try again.</div>');
                    }
                });
            }

            
            // Build results table
            function buildResultsTable(bookings) {
                resultsList.empty();
                
                bookings.forEach(booking => {
                    // Format dates
                    const departDate = new Date(booking.departDate);
                    const returnDate = new Date(booking.returnDate);
                    
                    const departDateStr = departDate.toLocaleDateString('en-GB', {
                        day: '2-digit', 
                        month: 'short', 
                        year: 'numeric'
                    });
                    
                    const returnDateStr = returnDate.toLocaleDateString('en-GB', {
                        day: '2-digit', 
                        month: 'short', 
                        year: 'numeric'
                    });
                    
                    // Format times
                    const departTimeStr = departDate.toLocaleTimeString('en-GB', {
                        hour: '2-digit', 
                        minute: '2-digit'
                    }).replace(' ', '');
                    
                    const returnTimeStr = returnDate.toLocaleTimeString('en-GB', {
                        hour: '2-digit', 
                        minute: '2-digit'
                    }).replace(' ', '');
                    
                    // Determine display status
                    let displayStatus = booking.booking_status;
                    let statusClass = '';
                    
                    // Handle combined statuses
                    if (booking.booking_status === 'Cancelled' && booking.refund_status) {
                        if (booking.refund_status === 'Refunded') {
                            displayStatus = 'Cancelled & Refunded';
                            statusClass = 'status-cancelled-refunded';
                        } else {
                            displayStatus = 'Cancelled (' + booking.refund_status + ')';
                            statusClass = 'status-cancelled';
                        }
                    } else if (booking.booking_status === 'Refund') {
                        displayStatus = 'Refunded';
                        statusClass = 'status-refunded';
                    } else {
                        switch(booking.booking_status) {
                            case 'Completed':
                                statusClass = 'status-completed';
                                break;
                            case 'Pending':
                                statusClass = 'status-pending';
                                break;
                            case 'Cancelled':
                                statusClass = 'status-cancelled';
                                break;
                            case 'Refund':
                                statusClass = 'status-refund';
                                break;
                            case 'Abandon':
                                statusClass = 'status-abandoned';
                                break;
                            default:
                                statusClass = '';
                        }
                    }
                    
                    // Determine allowed actions based on status
                    const allowedActions = getAllowedActions(booking);
                    
                    const row = `
                    <tr data-id="${booking.id}">
                        <td>
                            <div class="booking-ref">${booking.referenceNo}</div>
                            <div class="small text-muted">ID: ${booking.id}</div>
                        </td>
                        <td>
                            <div class="customer-name">${booking.first_name} ${booking.last_name}</div>
                        </td>
                        <td>
                            <div class="contact-info">${booking.email}</div>
                            <div class="contact-info">${booking.phone_number}</div>
                        </td>
                        <td>
                            <div class="vehicle-details">${booking.make || '-'} ${booking.model || '-'}</div>
                            <div class="vehicle-details">${booking.color || '-'}, ${booking.registration || '-'}</div>
                        </td>
                        <td>
                            <div class="date-info">
                                <span class="date-label">Date:</span> ${departDateStr}
                            </div>
                            <div class="date-info">
                                <span class="date-label">Time:</span> ${departTimeStr}
                            </div>
                            <div class="date-info" style="display: none;">
                                <span class="date-label">Terminal:</span> ${booking.deprTerminal || '-'}
                            </div>
                            <div class="date-info">
                                <span class="date-label">Flight:</span> ${booking.deptFlight || '-'}
                            </div>
                        </td>
                        <td>
                            <div class="date-info">
                                <span class="date-label">Date:</span> ${returnDateStr}
                            </div>
                            <div class="date-info">
                                <span class="date-label">Time:</span> ${returnTimeStr}
                            </div>
                            <div class="date-info" style="display: none;">
                                <span class="date-label">Terminal:</span> ${booking.returnTerminal || '-'}
                            </div>
                            <div class="date-info">
                                <span class="date-label">Flight:</span> ${booking.returnFlight || '-'}
                            </div>
                        </td>
                        <td class="amount-info">£${parseFloat(booking.total_amount).toFixed(2)}</td>
                        <td><span class="status-badge ${statusClass}">${displayStatus}</span></td>
                        <td>
                            <div class="action-buttons">
                                <button class="action-btn view-btn" data-action="view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="action-btn edit-btn" data-action="edit" ${!allowedActions.includes('edit') ? 'disabled' : ''} title="Edit Booking">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </div>
                            <div class="action-buttons">
                                <button class="action-btn reschedule-btn" style="display: none;" data-action="reschedule" ${!allowedActions.includes('reschedule') ? 'disabled' : ''} title="Reschedule">
                                    <i class="fas fa-calendar-alt"></i>
                                </button>
                                <button class="action-btn refund-btn" data-action="refund" ${!allowedActions.includes('refund') ? 'disabled' : ''} title="Process Refund">
                                    <i class="fas fa-money-bill-wave"></i>
                                </button>
                                <button class="action-btn cancel-btn" data-action="cancel" ${!allowedActions.includes('cancel') ? 'disabled' : ''} title="Cancel Booking">
                                    <i class="fas fa-ban"></i>
                                </button>
                                
                            </div>
                            <div class="action-buttons" style="display: ;">
                                <button class="action-btn email-btn" data-action="email" title="Resend Email">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                
                            </div>
                        </td>
                    </tr>
                    `;
                    
                    resultsList.append(row);
                });
            }
            
            // Determine allowed actions based on booking status
            function getAllowedActions(booking) {
                const actions = ['view', 'email']; // Always allowed
                
                // Status-based restrictions
                switch(booking.booking_status) {
                    case 'Completed':
                        actions.push('edit', 'reschedule', 'refund');
                        break;
                    case 'Pending':
                        actions.push('edit', 'cancel', 'reschedule');
                        break;
                    case 'Cancelled':
                        if (!booking.refund_status) {
                            actions.push('refund');
                        }
                        break;
                    case 'Refund':
                        // No additional actions
                        break;
                    default:
                        actions.push('edit', 'cancel', 'reschedule');
                }
                
                return actions;
            }
            
            // Action button handlers
            resultsList.on('click', '.action-btn:not(:disabled)', function() {
                const action = $(this).data('action');
                const id = $(this).closest('tr').data('id');
            
                getBookingDetails(id, function(booking) {
                    if (!booking) return;
            
                    if (action === 'view') {
                        openDetailsModal(booking);
                    } else if (action === 'edit') {
                        openEditModal(booking);
                    } else if (action === 'reschedule') {
                        openRescheduleModal(booking);
                    } else if (action === 'refund') {
                        openRefundModal(booking);
                    } else if (action === 'cancel') {
                        cancelBooking(id);
                    } else if (action === 'email') {
                        //openEmailModal(booking);
                        confirmAndAjax("/admin/support-panel/bookings/" + id + "/resend-email");
                    }
                });
            });
            
            function confirmAndAjax(url) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to resend booking confirmation email again?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, Please Resend',
                    cancelButtonText: 'Cancel',
                }).then((result) => {
                    if (!result.isConfirmed) return;
            
                    Swal.showLoading(); // loading dikhao
            
                    $.get(url, function(response) {
                        Swal.close(); // pehle loading close karo
            
                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.message || 'Something went wrong!',
                            });
                        }
                    }).fail(function() {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Request failed. Please try again!',
                        });
                    });
                });
            }


            
            // Simulate getting booking details
            function getBookingDetails(id, callback) {
                //loadingSpinner.show();
                //noResults.hide();
            
                $.ajax({
                    url: "{{ route('support.fetch', ':id') }}".replace(':id', id),
                    method: 'GET',
                    success: function(response) {
                        loadingSpinner.hide();
            
                        if (!response) {
                            noResults.show();
                            if (typeof callback === 'function') callback(null);
                            return;
                        }
            
                        console.log(response);
                        if (typeof callback === 'function') callback(response);
                    },
                    error: function() {
                        loadingSpinner.hide();
                        alert('Error fetching booking details. Please try again.');
                        if (typeof callback === 'function') callback(null);
                    }
                });
            }

            
            // Open Details Modal
            function openDetailsModal(booking) {
                const formatDate = (dateStr) => {
                    if (!dateStr) return 'N/A';
                    return new Date(dateStr).toLocaleString('en-GB', {
                        day: '2-digit', month: 'short', year: 'numeric',
                        hour: '2-digit', minute: '2-digit'
                    });
                };

                const money = (num) => isNaN(num) ? '£0.00' : '£' + parseFloat(num).toFixed(2);

                $('#detailReference').text(booking.referenceNo || 'N/A');
                $('#detailName').text((booking.first_name || '') + ' ' + (booking.last_name || ''));
                $('#detailEmail').text(booking.email || 'N/A');
                $('#detailPhone').text(booking.phone_number || 'N/A');
                $('#detailAddress').text(booking.address || booking.fulladdress || 'N/A');
                $('#detailCity').text(booking.city || 'N/A');
                $('#detailCountry').text(booking.country || 'N/A');
                $('#detailPostal').text(booking.postal_code || 'N/A');

                $('#detailVehicle').text((booking.make || '') + ' ' + (booking.model || ''));
                $('#detailColor').text(booking.color || 'N/A');
                $('#detailReg').text(booking.registration || 'N/A');

                $('#detailDepartDate').text(formatDate(booking.departDate));
                $('#detailDepartTerminal').text(booking.deprTerminal || 'N/A');
                $('#detailReturnDate').text(formatDate(booking.returnDate));
                $('#detailReturnTerminal').text(booking.returnTerminal || 'N/A');
                $('#detailDays').text(booking.no_of_days || 'N/A');
                $('#detailDeptFlight').text(booking.deptFlight || 'N/A');
                $('#detailReturnFlight').text(booking.returnFlight || 'N/A');

                $('#detailAmount').text(money(booking.booking_amount));
                $('#detailDiscount').text(money(booking.discount_amount));
                $('#detailTotal').text(money(booking.total_amount));
                $('#detailPayment').text(booking.payment_method || 'N/A');

                $('#detailPaymentStatus').html(getBadge(booking.payment_status));
                $('#detailRefundStatus').html(getRefundBadge(booking.refund_status));

                $('#detailApiError').text(booking.api_error || '');

                $('#detailBookingStatus').text(booking.booking_status || 'N/A');
                $('#detailBookingAction').text(booking.booking_action || 'N/A');
                $('#detailSource').text(booking.traffic_src || 'N/A');

                $('#detailJson').text(JSON.stringify(booking, null, 2));

                /* new bootstrap.Modal(document.getElementById('detailsModal')).show(); */
                const modal = new bootstrap.Modal(document.getElementById('detailsModal'), {
                backdrop: true,
                keyboard: true
                });
                modal.show();
            }

            function getBadge(status) {
                const map = {
                    success: 'status-completed',
                    pending: 'status-pending',
                    failed: 'status-failed'
                };
                return `<span class="status-badge ${map[status] || ''}">${status || 'N/A'}</span>`;
            }

            function getRefundBadge(status) {
                const map = {
                    Refunded: 'status-refunded',
                    Partial: 'status-refund',
                    Processed: 'status-processed'
                };
                return `<span class="status-badge ${map[status] || ''}">${status || 'Not Refunded'}</span>`;
            }

            
            // Cancel Booking
            function cancelBooking(id) {
                if (confirm('Are you sure you want to cancel this booking?')) {
                    // Simulate API call
                    setTimeout(() => {
                        successToast.show();
                        // Refresh results
                        searchInput.trigger('input');
                    }, 800);
                }
            }
            
            // Open Edit Modal
            function openEditModal(booking) {
                // Format dates for datetime-local inputs
                const departDate = new Date(booking.departDate);
                const returnDate = new Date(booking.returnDate);
                
                const departDateFormatted = `${departDate.getFullYear()}-${String(departDate.getMonth() + 1).padStart(2, '0')}-${String(departDate.getDate()).padStart(2, '0')}T${String(departDate.getHours()).padStart(2, '0')}:${String(departDate.getMinutes()).padStart(2, '0')}`;
                const returnDateFormatted = `${returnDate.getFullYear()}-${String(returnDate.getMonth() + 1).padStart(2, '0')}-${String(returnDate.getDate()).padStart(2, '0')}T${String(returnDate.getHours()).padStart(2, '0')}:${String(returnDate.getMinutes()).padStart(2, '0')}`;
                
                // Populate form
                $('#editBookingId').val(booking.id);
                $('#editFirstName').val(booking.first_name);
                $('#editLastName').val(booking.last_name);
                $('#editEmail').val(booking.email);
                $('#editPhone').val(booking.phone_number);
                $('#editAddress').val(booking.address || '');
                $('#editCity').val(booking.city || '');
                $('#editCountry').val(booking.country || '');
                $('#editPostal').val(booking.postal_code || '');
                $('#editMake').val(booking.make || '');
                $('#editModel').val(booking.model || '');
                $('#editColor').val(booking.color || '');
                $('#editRegistration').val(booking.registration || '');
                $('#editDepartDate').val(departDateFormatted);
                $('#editDepartTerminal').val(booking.deprTerminal || '');
                $('#editDepartFlight').val(booking.deptFlight || '');
                $('#editReturnDate').val(returnDateFormatted);
                $('#editReturnTerminal').val(booking.returnTerminal || '');
                $('#editReturnFlight').val(booking.returnFlight || '');
                $('#editBookingAmount').val(parseFloat(booking.booking_amount).toFixed(2));
                $('#editDiscountAmount').val(parseFloat(booking.discount_amount).toFixed(2));
                $('#editTotalAmount').val(parseFloat(booking.total_amount).toFixed(2));
                $('#editPaymentMethod').val(booking.payment_method || 'stripe');
                $('#editPaymentStatus').val(booking.payment_status || 'success');
                $('#editRefundStatus').val(booking.refund_status || '');
                
                editModal.show();
            }
            
            // Save Edit Changes
            $('#saveEditBtn').click(function() {
                const formData = {
                    id: $('#editBookingId').val(),
                    first_name: $('#editFirstName').val(),
                    last_name: $('#editLastName').val(),
                    email: $('#editEmail').val(),
                    phone_number: $('#editPhone').val(),
                    address: $('#editAddress').val(),
                    city: $('#editCity').val(),
                    country: $('#editCountry').val(),
                    postal_code: $('#editPostal').val(),
                    make: $('#editMake').val(),
                    model: $('#editModel').val(),
                    color: $('#editColor').val(),
                    registration: $('#editRegistration').val(),
                    departDate: $('#editDepartDate').val(),
                    deprTerminal: $('#editDepartTerminal').val(),
                    deptFlight: $('#editDepartFlight').val(),
                    returnDate: $('#editReturnDate').val(),
                    returnTerminal: $('#editReturnTerminal').val(),
                    returnFlight: $('#editReturnFlight').val(),
                    booking_amount: $('#editBookingAmount').val(),
                    discount_amount: $('#editDiscountAmount').val(),
                    total_amount: $('#editTotalAmount').val(),
                    payment_method: $('#editPaymentMethod').val(),
                    payment_status: $('#editPaymentStatus').val(),
                    refund_status: $('#editRefundStatus').val(),
                    _token: "{{ csrf_token() }}"
                };

                $.ajax({
                    url: "{{ route('support.update') }}",
                    method: "POST",
                    data: formData,
                    beforeSend: function() {
                        $('#saveEditBtn').prop('disabled', true).text('Saving...');
                    },
                    success: function(response) {
                        $('#saveEditBtn').prop('disabled', false).text('Save Changes');
                        if (response.success) {
                            $('#editModal').modal('hide');
                            successToast.show();
                            searchInput.trigger('input'); // Refresh list
                        } else {
                            alert('Error: ' + (response.message || 'Unable to save changes.'));
                        }
                    },
                    error: function(xhr) {
                        $('#saveEditBtn').prop('disabled', false).text('Save Changes');
                        alert('Validation error or server issue.');
                        console.error(xhr.responseText);
                    }
                });
            });

            
            // Open Reschedule Modal
            function openRescheduleModal(booking) {
                // Format dates
                const departDate = new Date(booking.departDate);
                const returnDate = new Date(booking.returnDate);
                
                const departDateStr = departDate.toLocaleString('en-GB', {
                    day: '2-digit', 
                    month: 'short', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                const returnDateStr = returnDate.toLocaleString('en-GB', {
                    day: '2-digit', 
                    month: 'short', 
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                });
                
                // Format dates for datetime-local inputs
                const departDateFormatted = `${departDate.getFullYear()}-${String(departDate.getMonth() + 1).padStart(2, '0')}-${String(departDate.getDate()).padStart(2, '0')}T${String(departDate.getHours()).padStart(2, '0')}:${String(departDate.getMinutes()).padStart(2, '0')}`;
                const returnDateFormatted = `${returnDate.getFullYear()}-${String(returnDate.getMonth() + 1).padStart(2, '0')}-${String(returnDate.getDate()).padStart(2, '0')}T${String(returnDate.getHours()).padStart(2, '0')}:${String(returnDate.getMinutes()).padStart(2, '0')}`;
                
                // Populate form
                $('#rescheduleBookingId').val(booking.id);
                $('#rescheduleReference').val(booking.referenceNo);
                $('#rescheduleCustomer').val(booking.first_name + ' ' + booking.last_name);
                $('#rescheduleOriginalDepart').val(departDateStr);
                $('#rescheduleOriginalReturn').val(returnDateStr);
                $('#rescheduleDepartDate').val(departDateFormatted);
                $('#rescheduleReturnDate').val(returnDateFormatted);
                $('#rescheduleDepartTerminal').val(booking.deprTerminal || '');
                $('#rescheduleReturnTerminal').val(booking.returnTerminal || '');
                $('#rescheduleDepartFlight').val(booking.deptFlight || '');
                $('#rescheduleReturnFlight').val(booking.returnFlight || '');
                
                rescheduleModal.show();
            }
            
            // Save Reschedule Changes
            $('#saveRescheduleBtn').click(function() {
                const id = $('#rescheduleBookingId').val();
            
                $.ajax({
                    url: `/admin/support/${id}/reschedule`,
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        departDate: $('#rescheduleDepartDate').val(),
                        returnDate: $('#rescheduleReturnDate').val(),
                        deprTerminal: $('#rescheduleDepartTerminal').val(),
                        returnTerminal: $('#rescheduleReturnTerminal').val(),
                        deptFlight: $('#rescheduleDepartFlight').val(),
                        returnFlight: $('#rescheduleReturnFlight').val(),
                        rescheduleReason: $('#rescheduleReason').val(),
                        rescheduleNotes: $('#rescheduleNotes').val()
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            rescheduleModal.hide();
                            successToast.show();
                            searchInput.trigger('input');
                        }
                    },
                    error: function(err) {
                        alert('Error: ' + err.responseJSON.message);
                    }
                });
            });


            
            // Open Refund Modal
            function openRefundModal(booking) {
                $('#refundBookingId').val(booking.id);
                $('#refundReference').val(booking.referenceNo);
                $('#refundCustomer').val(booking.first_name + ' ' + booking.last_name);
                $('#refundAmount').val('£' + parseFloat(booking.total_amount).toFixed(2));
                $('#refundRefundAmount').val(parseFloat(booking.total_amount).toFixed(2));
                
                refundModal.show();
            }
            
            // Process Refund
            $('#processRefundBtn').click(function() {
                const id = $('#refundBookingId').val();
                
                // Simulate API call
                setTimeout(() => {
                    refundModal.hide();
                    successToast.show();
                    // Refresh results
                    searchInput.trigger('input');
                }, 800);
            });
            
            // Open Email Modal
            function openEmailModal(booking) {
                // Format dates
                const departDate = new Date(booking.departDate);
                const returnDate = new Date(booking.returnDate);
                
                const departDateStr = departDate.toLocaleDateString('en-GB', {
                    day: '2-digit', 
                    month: 'short', 
                    year: 'numeric'
                });
                
                const returnDateStr = returnDate.toLocaleDateString('en-GB', {
                    day: '2-digit', 
                    month: 'short', 
                    year: 'numeric'
                });
                
                // Populate form
                $('#emailBookingId').val(booking.id);
                $('#emailReference').val(booking.referenceNo);
                $('#emailCustomer').val(booking.first_name + ' ' + booking.last_name);
                $('#emailAddress').val(booking.email);
                $('#emailPhone').val(booking.phone_number);
                
                // Populate preview
                $('#previewReference').text(booking.referenceNo);
                $('#previewReference2').text(booking.referenceNo);
                $('#previewName').text(booking.first_name);
                $('#previewDates').text(departDateStr + ' to ' + returnDateStr);
                $('#previewVehicle').text((booking.make || '') + ' ' + (booking.model || '') + ' (' + (booking.color || '') + ')');
                $('#previewAmount').text('£' + parseFloat(booking.total_amount).toFixed(2));
                
                emailModal.show();
            }
            
            // Resend Email
            $('#resendEmailBtn').click(function() {
                const id = $('#emailBookingId').val();
                
                // Simulate API call
                setTimeout(() => {
                    emailModal.hide();
                    successToast.show();
                }, 800);
            });
        });
    </script>
</body>
</html>