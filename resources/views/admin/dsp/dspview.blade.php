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


        <br>
        <br>
        <br>
        <h2>Expense</h2>
        <table class="table table-condensed table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Expenses List</th>
                    <th>Expense Value</th>
                    <th>Total</th>
                    <th>Percentage</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Vat</td>
                    <td></td>
                    <td>0</td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Booking Fee</td>
                    <td></td>
                    <td>0</td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Marketing &amp; Developement ch</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Google ch</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Bing ch</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Mail Chimp ch</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Affiliate ch</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>API Exp</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>IT Exp</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Other Exp IT</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Office Rent</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>Telephone Exp</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>Daily Wages</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>Account Exp</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>Travel Exp</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>Other Exp</td>
                    <td></td>
                    <td></td>
                    <td>0.00</td>
                </tr>

                <tr>
                    <td></td>
                    <td><strong>Total<strong></strong></strong></td>
                    <td></td>
                    <td><strong class="badge badge-success badge-roundless" style="width:100%;">0</strong></td>
                    <td><strong class="badge badge-success badge-roundless" style="width:100%;">0.00</strong></td>
                </tr>
            </tbody>
        </table>
        <br>
        <br>
        <h2>Revenue</h2>
        <table class="table table-condensed table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Revenue List</th>
                    <th>Revenue Value</th>
                    <th>Expenses</th>
                    <th>Total Net profit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Airport Parking</td>
                    <td><span id="fly">398436.7191999</span></td>
                    <td><span id="rev1">0</span></td>
                    <td><span id="total1">398436.7191999</span></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Hotel</td>
                    <td><input type="text" name="hotel" id="hotel" class="form-control"
                            style="background-repeat: no-repeat; background-attachment: scroll; background-size: 16px 18px; background-position: 98% 50%; cursor: auto;">
                    </td>
                    <td><input type="text" name="rev2" id="rev2" class="form-control"></td>
                    <td><span id="total2">0</span></td>
                </tr>

                <tr>
                    <td>3</td>
                    <td>Hotel with parking</td>
                    <td><input type="text" name="hotelparking" id="hotelparking" class="form-control"></td>
                    <td><input type="text" name="rev3" id="rev3" class="form-control"></td>
                    <td><span id="total3">0</span></td>
                </tr>

                <tr>
                    <td>4</td>
                    <td>Lounges</td>
                    <td><input type="text" name="lounges" id="lounges" class="form-control"></td>
                    <td><input type="text" name="rev4" id="rev4" class="form-control"></td>
                    <td><span id="total4">0</span></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Total</td>
                    <td><span id="rr_total">398436.72</span></td>
                    <td><span id="exp_total">0.00</span></td>
                    <td><span id="final_total">398436.72</span></td>
                </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-success btn-icon icon-left pull-right" id="calc"><i
                class="entypo-doc-text"></i> Re Calculate</button>
        <button type="button" class="btn btn-primary btn-icon icon-left" id="pri"><i class="entypo-doc-text"></i>
            Print</button>
    </div>
@endsection
