@extends('layouts.main')



@section('content')

<style type="text/css">
.table-css{border:1px solid #00519A;}
.th-css{color:#00519A;}
.main-head{color: #00519A;font-size: 30px;font-weight: bold;text-align: center;padding-top: 20px;padding-bottom: 20px;}
</style>

    
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="main-head">Ticket List</h2>
            </div>
            <div class="col-lg-12">
                <table class="table table-striped table-css">
                  <thead>
                    <tr>
                       
                      <th scope="col" class="th-css">Sr.</th>
                      <th scope="col" class="th-css">Ticket Reference:</th>
                      <th scope="col" class="th-css">Booking Reference:</th>
                      <th scope="col" class="th-css">Ticket Subject</th>
                      <th scope="col" class="th-css">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach($tickets as $ticket)
                       @php $i = 1; @endphp
                    <tr>
                      <th scope="row">{{$i}}</th>
                      <td>{{$ticket->ticket_id}}</td>
                      <td>{{$ticket->booking_ref}}</td>
                      <td>{{$ticket->title}}</td>
                      <td><a href="{{ route("view-ticket",[Crypt::encrypt($ticket->ticket_id)]) }}"><i class="fa fa-solid fa-eye" ></i></a></td>
                    </tr>
                    
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section("footer-script")


@endsection

