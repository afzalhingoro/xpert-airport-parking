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

    <link rel="stylesheet" href=" {{ asset('assets/css/admin.css') }}" />
    <link rel="stylesheet" href=" {{ asset('assets/css/style.css') }}" />
@endsection

@section('content')
    <style>
        @media only screen and (max-width: 760px),

        (min-device-width: 768px) and (max-device-width: 1024px) {

            td:nth-of-type(1):before {
                content: "   Reference No    ";
            }

            td:nth-of-type(2):before {
                content: "Status";
            }

            td:nth-of-type(3):before {
                content: "Subject";
            }

            td:nth-of-type(4):before {
                content: "Raised By";
            }

            td:nth-of-type(5):before {
                content: "Department";
            }

            td:nth-of-type(6):before {
                content: "Assigned Agent";
            }

            td:nth-of-type(7):before {
                content: "Priority";
            }

            td:nth-of-type(8):before {
                content: "Last Update";
            }

            td:nth-of-type(9):before {
                content: "Action";
            }









        }

        .hover_bkgr_fricc {

            background: rgba(0, 0, 0, .4);

            cursor: pointer;

            display: none;

            height: 100%;

            position: fixed;

            text-align: center;

            top: 0;

            width: 100%;

            z-index: 10000;

        }



        .hover_bkgr_fricc .helper {

            display: inline-block;

            height: 100%;

            vertical-align: middle;

        }



        .hover_bkgr_fricc>div {

            background-color: #fff;

            box-shadow: 10px 10px 60px #555;

            display: inline-block;

            height: auto;

            max-width: 551px;

            min-height: 100px;

            vertical-align: middle;

            width: 60%;

            position: relative;

            border-radius: 8px;

            padding: 15px 5%;

        }



        .popupCloseButton {

            background-color: #fff;

            border: 3px solid #999;

            border-radius: 50px;

            cursor: pointer;

            display: inline-block;

            font-family: arial;

            font-weight: bold;

            position: absolute;

            top: -20px;

            right: -20px;

            font-size: 25px;

            line-height: 30px;

            width: 30px;

            height: 30px;

            text-align: center;

        }



        .popupCloseButton:hover {

            background-color: #ccc;

        }



        .trigger_popup_fricc {

            cursor: pointer;

            font-size: 20px;

            margin: 20px;

            display: inline-block;

            font-weight: bold;

        }
        #my_status{
            width: 100%;
        }
    </style>

    <script type="text/javascript">
        $(window).load(function() {

            $(".trigger_popup_fricc").click(function() {

                $('.hover_bkgr_fricc').show();

            });

            $('.hover_bkgr_fricc').click(function() {

                $('.hover_bkgr_fricc').hide();

            });

            $('.popupCloseButton').click(function() {

                $('.hover_bkgr_fricc').hide();

            });

        });
    </script>

    <div class="page-content">





        <div class="page-header">

            <h1>

                Myticket

                <small>

                    <i class="ace-icon fa fa-angle-double-right"></i>

                    List

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

                        <div class="row">

                            <div class="col-md-12">

                                <form action="{{ route('myticket') }}" method="get" class="form-inline mb-10">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-3 col-sm-4">
                                            <div class="form-group">
                                                <label for="field-1">Search By Reference</label>
                                                <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control input-sm searchRef" id="field-1" placeholder="Search By Reference">
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-1 col-md-2 col-sm-3">
                                            <div class="form-group">
                                                <label for="my_status">Status</label>
                                                <select id="my_status" name="status" class="form-control input-sm" required="">
                                                    <option value="all" @if (Request::get('status') == 'all') selected @endif>All</option>
                                                    <option value="Open" @if (Request::get('status') == 'Open' || Request::get('status') == '') selected @endif>Open</option>
                                                    <option value="Closed" @if (Request::get('status') == 'Closed') selected @endif>Closed</option>
                                                </select>
                                            </div>
                                        </div>
                                
                                        <div class="col-lg-2 col-md-3 col-sm-4">
                                            <div class="form-group mt-30 myTicketBtn">
                                                <input name="submit" type="submit" value="Search" class="btn btn-sm btn-primary mb-2">
                                                <a href="{{ route('myticket') }}" class="btn btn-primary mb-2 btn-sm">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>




                            </div>



                        </div>
                    </div>
                </div>




                    <table id="simple-table" class="table  table-bordered table-hover">

                    <thead>

                        <tr>



                            <th>Ticket Ref</th>

                            <th>Booking Ref</th>

                            <th>Status</th>

                            <th>Subject</th>

                            <th>Raised By</th>

                            <th>Department</th>

                            <th>Assigned Agent</th>

                            <th>Priority</th>

                            <th>Last Update</th>

                            <th>Action</th>





                            {{-- <th>no of days</th> --}}





                        </tr>

                    </thead>



                    <tbody>



                        @foreach ($tickets as $ticket)
                            <tr id="">





                                <td style="">

                                    <i>

                                        {{ $ticket->ticket_id }}

                                    </i>

                                </td>

                                <td style="">

                                    <i>

                                        {{ $ticket->booking_ref }}

                                    </i>

                                </td>

                                <td class=""><span
                                        class="badge @if ($ticket->status == 'Open') badge-success @else badge-warning @endif"
                                        style="

    border-radius: .25em;width: 100%;"> {{ $ticket->status }}</span>

                                </td>

                                <td class=""><a
                                        href="{{ route('myticketview', ['id' => $ticket->ticketid]) }}">{{ $ticket->title }}</a>

                                </td>



                                <td class="text-left" class=""><span class="badge badge-blues badge-roundless"><i
                                            class="fa fa-user"></i> </span>

                                    &nbsp;&nbsp;{{ $ticket->raised_named }}</td>

                                <td class=""> {{ $ticket->department_name }}</td>

                                <td class=""> {{ $ticket->name }}</td>

                                <td class="">

                                    <strong class="badge badge-danger " style="width:100%;">
                                        {{ $ticket->urgency }}</strong>

                                </td>

                                <td class="">{{ date('d-m-Y (H:i)', strtotime($ticket->date)) }}</td>

                                <td class="">

                                    @can('user_auth', ['view'])
                                        <a href="{{ route('myticketview', ['id' => $ticket->ticketid]) }}"
                                            class="btn btn-info btn-xs popId" title="Ticket Details">

                                            <i class="fa fa-eye"></i>

                                        </a>
                                    @endcan

                                    @can('user_auth', ['Assign Ticket'])
                                        <a class="btn btn-warning btn-xs" title="Assigned Ticket"
                                            onclick="sendEmailForm('{{ $ticket->ticketid }}');">

                                            <i class="fa fa-forward"></i>



                                        </a>
                                    @endcan


                                    @can('user_auth', ['edit'])
                                        @if ($ticket->status == 'Closed')
                                            <a href="{{ route('updateTicketStatus', ['id' => $ticket->ticketid]) }}"
                                                class="btn btn-success btn-xs" title="Re Open Ticket">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        @endif

                                        @if ($ticket->status == 'Open')
                                            <a href="{{ route('updateTicketStatus', ['id' => $ticket->ticketid]) }}"
                                                class="btn btn-danger btn-xs" title="Close This Ticket">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        @endif

                                        <!-- @if ($ticket->status == 'Open')
        <a href="{{ route('updateTicketStatus', ['id' => $ticket->ticketid]) }}"

                                                                   class="btn btn-success btn-xs" title="Re Open Ticket">

                                                                    <i class="fa fa-check"></i>



                                                                </a>
        @endif



                                                            @if ($ticket->status == 'Closed')
        <a href="{{ route('updateTicketStatus', ['id' => $ticket->ticketid]) }}"

                                                                   class="btn btn-danger btn-xs" title="Re Open Ticket">

                                                                    <i class="fa fa-close"></i>



                                                                </a>
        @endif -->





                                        {{-- <i onclick="sendEmailForm()" --}}

                                        {{-- class="btn btn-minier btn-grey fa fa-envelope"></i> --}}
                                    @endcan



                                </td>

                            </tr>
                        @endforeach



                    </tbody>

                </table>
           


                {{ $tickets->links('vendor.pagination.default') }}

            </div><!-- /.span -->

        </div><!-- /.row -->





        <!-- PAGE CONTENT ENDS -->

    </div><!-- /.col -->

    </div><!-- /.row -->

    </div>

    <br />

    <br />

    <br />
@endsection

@section('footer-script')
    <script src="{{ secure_asset('assets/front/js/bootbox.js') }}"></script>

    <script>
        function sendEmailForm(id) {

            var html = "";

            @foreach ($admins as $admin)

                html += "<option value=\"{{ $admin->id }}\">{{ $admin->name }}</option>\n";
            @endforeach

            ModelPopUp("<div id=\"booking_detail_pop\" ><div><h2>Assign User</h2></div>\n" +



                "<select name=\"assign_to\" id=\"assign_to\" class=\"form-control company-bookings\">" + html +
                "<tbody><tr><td>" +



                '<input type="submit" class="btn btn-success"  onclick="assignUser(' + id + ')" />'

                +
                "                       </div>");

        }



        " <tbody><tr><td>"





        " </td></tr></tbody>"



        function ModelPopUp(message) {

            bootbox.dialog({

                message: message,

                size: "large",

                //                             buttons:

                //                                    {

                //                                        "success":

                //                                            {

                //                                                "label": "<i class='ace-icon fa fa-check'></i> Ok",

                //                                                "className": "btn-sm btn-success",

                //                                                "callback": function () {

                //                                                    //Example.show("great success");

                //                                                }

                //                                            }

                //                                    }

            });

        }





        function assignUser(id) {



            var assign_to = $('#assign_to option:selected').val();



            var html =
                "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset('assets/images/loader.gif') }}'/> </div>";

            $("#booking_detail_pop").html(html);

            var data = {};

            data["tid"] = id;

            data["aid"] = assign_to;

            data["_token"] = '{{ csrf_token() }}';

            $.post('{{ route('assignTicket') }}', data, function(data) {

                console.log("data===", data);



                $("#booking_detail_pop").html(data);

                //

            });





        }
    </script>
@endsection
