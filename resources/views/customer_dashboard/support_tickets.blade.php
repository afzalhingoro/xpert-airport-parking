@extends('customer_dashboard.layouts.master')

@section('content')
    <link rel="stylesheet" href="/customer-assets/backend/assets/vendors/simple-datatables/style.css">
    <section class="section">
        <h2>Support Tickets</h2>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>S#</th>
                            <th>Ticket Id</th>
                            <th>Booking Ref</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Department</th>
                            <th>Urgency</th>
                            <th>Status</th>
                            <th>Assign To</th>
                            <th>Assign Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ticket->ticket_id }}</td>
                                <td>{{ $ticket->booking_ref }}</td>
                                <td>{{ $ticket->name }}</td>
                                <td>{{ $ticket->contact }}</td>
                                <td>{{ $ticket->department_name ?? 'N/A' }}</td>
                                <td>{{ $ticket->urgency }}</td>
                                <td>{{ $ticket->status }}</td>
                                <td>{{ $ticket->assign_to }}</td>
                                <td>{{ $ticket->assign_date }}</td>

                                <td>



                                    <a href="{{ route('customer.ticket.view', $ticket->id) }}">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade  bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Tickets Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
@section('footer-script')
    <script src="/customer-assets/backend/assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endsection
