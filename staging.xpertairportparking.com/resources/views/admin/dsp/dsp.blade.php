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

            Dashboard

            <small>
                <i class="ace-icon fa fa-angle-double-right"></i>
                List
            </small>
            </h1>
        </div><!-- /.page-header -->
        <h2>Sale Profit Report</h2>
        <br>
        <div class="row">
            <div class="col-sm-3 invoice-left">
                <select name="filter" class="form-control" style="padding: 6px 2px;">
                    <option value="all">All</option>
                    <option value="createdate">Booked Date</option>
                    <option value="departDate">Departure Date</option>
                    <option value="returnDate">Arrival Date</option>
                </select>
            </div>
            <div class="col-sm-3 invoice-left">
                <input type="text" name="start_date" class="form-control datepicker" placeholder="End Date"
                    data-format="dd-MM-yyyy" style="padding: 6px 2px;">
            </div>
            <div class="col-sm-3 invoice-left">
                <input type="text" name="end_date" class="form-control datepicker" placeholder="End Date"
                    data-format="dd-MM-yyyy" style="padding: 6px 2px;">
            </div>
        </div>
        <br>
        <br>
        <br>
        <h2>Expense</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Expenses List</th>
                    <th>Expense Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Vat</td>
                    <td><input type="text" name="vat" id="vat" class="form-control" value="2.5"
                            style=" background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Booking Fee</td>
                    <td><input type="text" name="book_fee" id="book_fee" class="form-control" value="1.65"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Marketing &amp; Developement ch</td>
                    <td><input type="text" name="d_exp" id="d_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Google ch</td>
                    <td><input type="text" name="g_exp" id="g_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Bing ch</td>
                    <td><input type="text" name="b_exp" id="b_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Mail Chimp ch</td>
                    <td><input type="text" name="m_exp" id="m_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Affiliate ch</td>
                    <td><input type="text" name="a_exp" id="a_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>API Exp</td>
                    <td><input type="text" name="api_exp" id="api_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>IT Exp</td>
                    <td><input type="text" name="it_exp" id="it_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Other Exp IT</td>
                    <td><input type="text" name="other_exp" id="other_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Office Rent</td>
                    <td><input type="text" name="off_exp" id="off_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Telephone Exp</td>
                    <td><input type="text" name="tel_exp" id="tel_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Daily Wages</td>
                    <td><input type="text" name="w_exp" id="w_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Account Exp</td>
                    <td><input type="text" name="acc_exp" id="acc_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>Travel Exp</td>
                    <td><input type="text" name="tr_exp" id="tr_exp" class="form-control"></td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>Other Exp</td>
                    <td><input type="text" name="ot_exp" id="ot_exp" class="form-control"></td>
                </tr>
            </tbody>
        </table>
        <input type="submit" class="btn btn-primary pull-right" id="submit" name="submit" value="Submit">
    </div>
@endsection
