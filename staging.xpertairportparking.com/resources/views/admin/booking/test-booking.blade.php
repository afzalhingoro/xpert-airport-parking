<?php
use Illuminate\Support\Str;
?>
@extends('admin.layout.master')
@section('stylesheets')
    @parent
    <link rel="stylesheet" href=" {{ asset('assets/css/jquery-ui.custom.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/chosen.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datepicker3.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-timepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/daterangepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href=" {{ asset('assets/css/bootstrap-colorpicker.min.css') }}"/>
    <style>
        .butn{
            margin-top:22px !important;
        }

    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection
@php
$ORG = 0;
$BING = 0;
$EM = 0;
$POR = 0;
$paid = 0;
foreach($books as $book)
{

if($book->traffic_src == "ORG" )
{
  $ORG++;

}
if($book->traffic_src == "EM" )
{
  $EM++;

}
if($book->traffic_src == "POR" )
{
  $POR++;

}
if($book->traffic_src == "BING" )
{
  $BING++;

}
if($book->traffic_src == "PPC" )
{
  $paid++;

}

}

@endphp
@section('content')
<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011-04-25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011-07-25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009-01-12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012-03-29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008-11-28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012-12-02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012-08-06</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010-10-14</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009-09-15</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Sonya Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008-12-13</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008-12-19</td>
                <td>$90,560</td>
            </tr>
            <tr>
                <td>Quinn Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013-03-03</td>
                <td>$342,000</td>
            </tr>
            <tr>
                <td>Charde Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008-10-16</td>
                <td>$470,600</td>
            </tr>
            <tr>
                <td>Haley Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012-12-18</td>
                <td>$313,500</td>
            </tr>
            <tr>
                <td>Tatyana Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010-03-17</td>
                <td>$385,750</td>
            </tr>
            <tr>
                <td>Michael Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012-11-27</td>
                <td>$198,500</td>
            </tr>
            <tr>
                <td>Paul Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010-06-09</td>
                <td>$725,000</td>
            </tr>
            <tr>
                <td>Gloria Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009-04-10</td>
                <td>$237,500</td>
            </tr>
            <tr>
                <td>Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012-10-13</td>
                <td>$132,000</td>
            </tr>
            <tr>
                <td>Dai Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012-09-26</td>
                <td>$217,500</td>
            </tr>
            <tr>
                <td>Jenette Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011-09-03</td>
                <td>$345,000</td>
            </tr>
            <tr>
                <td>Yuri Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009-06-25</td>
                <td>$675,000</td>
            </tr>
            <tr>
                <td>Caesar Vance</td>
                <td>Pre-Sales Support</td>
                <td>New York</td>
                <td>21</td>
                <td>2011-12-12</td>
                <td>$106,450</td>
            </tr>
            <tr>
                <td>Doris Wilder</td>
                <td>Sales Assistant</td>
                <td>Sydney</td>
                <td>23</td>
                <td>2010-09-20</td>
                <td>$85,600</td>
            </tr>
            <tr>
                <td>Angelica Ramos</td>
                <td>Chief Executive Officer (CEO)</td>
                <td>London</td>
                <td>47</td>
                <td>2009-10-09</td>
                <td>$1,200,000</td>
            </tr>
            <tr>
                <td>Gavin Joyce</td>
                <td>Developer</td>
                <td>Edinburgh</td>
                <td>42</td>
                <td>2010-12-22</td>
                <td>$92,575</td>
            </tr>
            <tr>
                <td>Jennifer Chang</td>
                <td>Regional Director</td>
                <td>Singapore</td>
                <td>28</td>
                <td>2010-11-14</td>
                <td>$357,650</td>
            </tr>
            <tr>
                <td>Brenden Wagner</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>28</td>
                <td>2011-06-07</td>
                <td>$206,850</td>
            </tr>
            <tr>
                <td>Fiona Green</td>
                <td>Chief Operating Officer (COO)</td>
                <td>San Francisco</td>
                <td>48</td>
                <td>2010-03-11</td>
                <td>$850,000</td>
            </tr>
            <tr>
                <td>Shou Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011-08-14</td>
                <td>$163,000</td>
            </tr>
            <tr>
                <td>Michelle House</td>
                <td>Integration Specialist</td>
                <td>Sydney</td>
                <td>37</td>
                <td>2011-06-02</td>
                <td>$95,400</td>
            </tr>
            <tr>
                <td>Suki Burks</td>
                <td>Developer</td>
                <td>London</td>
                <td>53</td>
                <td>2009-10-22</td>
                <td>$114,500</td>
            </tr>
            <tr>
                <td>Prescott Bartlett</td>
                <td>Technical Author</td>
                <td>London</td>
                <td>27</td>
                <td>2011-05-07</td>
                <td>$145,000</td>
            </tr>
            <tr>
                <td>Gavin Cortez</td>
                <td>Team Leader</td>
                <td>San Francisco</td>
                <td>22</td>
                <td>2008-10-26</td>
                <td>$235,500</td>
            </tr>
            <tr>
                <td>Martena Mccray</td>
                <td>Post-Sales support</td>
                <td>Edinburgh</td>
                <td>46</td>
                <td>2011-03-09</td>
                <td>$324,050</td>
            </tr>
            <tr>
                <td>Unity Butler</td>
                <td>Marketing Designer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009-12-09</td>
                <td>$85,675</td>
            </tr>
            <tr>
                <td>Howard Hatfield</td>
                <td>Office Manager</td>
                <td>San Francisco</td>
                <td>51</td>
                <td>2008-12-16</td>
                <td>$164,500</td>
            </tr>
            <tr>
                <td>Hope Fuentes</td>
                <td>Secretary</td>
                <td>San Francisco</td>
                <td>41</td>
                <td>2010-02-12</td>
                <td>$109,850</td>
            </tr>
            <tr>
                <td>Vivian Harrell</td>
                <td>Financial Controller</td>
                <td>San Francisco</td>
                <td>62</td>
                <td>2009-02-14</td>
                <td>$452,500</td>
            </tr>
            <tr>
                <td>Timothy Mooney</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>37</td>
                <td>2008-12-11</td>
                <td>$136,200</td>
            </tr>
            <tr>
                <td>Jackson Bradshaw</td>
                <td>Director</td>
                <td>New York</td>
                <td>65</td>
                <td>2008-09-26</td>
                <td>$645,750</td>
            </tr>
            <tr>
                <td>Olivia Liang</td>
                <td>Support Engineer</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2011-02-03</td>
                <td>$234,500</td>
            </tr>
            <tr>
                <td>Bruno Nash</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>38</td>
                <td>2011-05-03</td>
                <td>$163,500</td>
            </tr>
            <tr>
                <td>Sakura Yamamoto</td>
                <td>Support Engineer</td>
                <td>Tokyo</td>
                <td>37</td>
                <td>2009-08-19</td>
                <td>$139,575</td>
            </tr>
            <tr>
                <td>Thor Walton</td>
                <td>Developer</td>
                <td>New York</td>
                <td>61</td>
                <td>2013-08-11</td>
                <td>$98,540</td>
            </tr>
            <tr>
                <td>Finn Camacho</td>
                <td>Support Engineer</td>
                <td>San Francisco</td>
                <td>47</td>
                <td>2009-07-07</td>
                <td>$87,500</td>
            </tr>
            <tr>
                <td>Serge Baldwin</td>
                <td>Data Coordinator</td>
                <td>Singapore</td>
                <td>64</td>
                <td>2012-04-09</td>
                <td>$138,575</td>
            </tr>
            <tr>
                <td>Zenaida Frank</td>
                <td>Software Engineer</td>
                <td>New York</td>
                <td>63</td>
                <td>2010-01-04</td>
                <td>$125,250</td>
            </tr>
            <tr>
                <td>Zorita Serrano</td>
                <td>Software Engineer</td>
                <td>San Francisco</td>
                <td>56</td>
                <td>2012-06-01</td>
                <td>$115,000</td>
            </tr>
            <tr>
                <td>Jennifer Acosta</td>
                <td>Junior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>43</td>
                <td>2013-02-01</td>
                <td>$75,650</td>
            </tr>
            <tr>
                <td>Cara Stevens</td>
                <td>Sales Assistant</td>
                <td>New York</td>
                <td>46</td>
                <td>2011-12-06</td>
                <td>$145,600</td>
            </tr>
            <tr>
                <td>Hermione Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011-03-21</td>
                <td>$356,250</td>
            </tr>
            <tr>
                <td>Lael Greer</td>
                <td>Systems Administrator</td>
                <td>London</td>
                <td>21</td>
                <td>2009-02-27</td>
                <td>$103,500</td>
            </tr>
            <tr>
                <td>Jonas Alexander</td>
                <td>Developer</td>
                <td>San Francisco</td>
                <td>30</td>
                <td>2010-07-14</td>
                <td>$86,500</td>
            </tr>
            <tr>
                <td>Shad Decker</td>
                <td>Regional Director</td>
                <td>Edinburgh</td>
                <td>51</td>
                <td>2008-11-13</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Michael Bruce</td>
                <td>Javascript Developer</td>
                <td>Singapore</td>
                <td>29</td>
                <td>2011-06-27</td>
                <td>$183,000</td>
            </tr>
            <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011-01-25</td>
                <td>$112,000</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot>
    </table>
    
    <div class="page-content">


        <div class="page-header">
            <h1>
                Bookings
                <small>
                    <i class="ace-icon fa fa-angle-double-right"></i>
                    List
                </small>
            </h1>
        </div><!-- /.page-header -->


        <div class="col-xs-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('booking') }}" method="get" class="form-inline" style="margin-bottom: 10px;">
                        <div class="form-group" >
                            Search<br>
                            <input type="text" value="{{ Request::get('search') }}" name="search" class="form-control input-sm"
                                   id="field-1" value=""
                                   placeholder="Search By Keyword" style="padding: 6px 2px;">
                        </div>
                        <!--<div class="form-group">-->
                        <!--    <select name="airport" class="form-control input-sm" >-->
                        <!--        <option value="all">All Airports</option>-->
                        <!--        @foreach($airports as $airport)-->
                        <!--            <option @if(Request::get('airport')==$airport->id) {{ "selected='selected'" }} @endif value="{{ $airport->id }}">{{ $airport->name }}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->

                        <div class="form-group" style="display:none;">
                            Admins<br>
                            <select name="admins" class="form-control input-sm" >
                                <option value="all">All Admins</option>
                                @foreach($admins as $admin)
                                    <option @if(Request::get('admins')==$admin->id) {{ "selected='selected'" }} @endif value="{{ $admin->id }}">{{ $admin->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" style="display:none;">
                            Agent<br>
                           <select name="agentID" class="form-control input-sm" >
                                    <option value="">All</option>
                                      @foreach($agent as $agent)
                                    <option @if(Request::get('agentID')==$agent->id) {{ "selected='selected'" }} @endif value="{{ $agent->id }}">{{ $agent->alias }}</option>
                                    @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                           Booked Date <br>
                            <select name="filter" class="form-control input-sm">

                                <option value="created_at" selected='selected' @if(Request::get('filter')=='created_at') {{ "selected='selected'" }} @endif >
                                    Booked Date
                                </option>

                                <option value="departDate" @if(Request::get('filter')=='departDate') {{ "selected='selected'" }} @endif>
                                    Departure Date
                                </option>
                                <option value="returnDate" @if(Request::get('filter')=='returnDate') {{ "selected='selected'" }} @endif >
                                    Arrival Date
                                </option>
                                <option value="all" @if(Request::get('filter')=='all') {{ "selected='selected'" }} @endif>All</option>
                            </select>
                        </div>
                        <div class="form-group">
                            From<br>
                            <input type="text" name="start_date" id="start_date" autocomplete="off"
                                   class="form-control input-sm datepicker" placeholder="Start Date"
                                   data-date-format="dd-M-yyyy" value="{{ Request::get('start_date') }}"
                                   >
                        </div>
                        <div class="form-group">
                            To<br>
                            <input class="form-control input-sm date-picker" value="{{ Request::get('end_date') }}"
                                   autocomplete="off" id="end_date" placeholder="End Date" name="end_date" type="text"
                                   data-date-format="dd-M-yyyy"/>

                        </div>
                        <!--<div class="form-group">-->
                        <!--    <select name="companies" class="form-control input-sm" >-->
                        <!--        <option value="all">All Companies</option>-->
                        <!--        @foreach($companies_dlist as $company)-->
                        <!--            <option @if(Request::get('companies')==$company->id) {{ "selected='selected'" }} @endif value="{{ $company->id }}">{{ $company->name }}</option>-->
                        <!--        @endforeach-->
                        <!--    </select>-->
                        <!--</div>-->
                        <!--&nbsp; &nbsp;-->
                        <!--<div class="form-group">-->
                        <!--    <select name="payment" class="form-control input-sm" >-->
                        <!--        <option value="all">Payment Type</option>-->
                        <!--        <option value="payzone" @if(Request::get('payment')=='payzone') {{ "selected='selected'" }} @endif>-->
                        <!--            Payzone-->
                        <!--        </option>-->
                        <!--    </select>-->
                        <!--</div>-->

                        <div class="form-group">
                            Booked Status <br>
                            <select id="my_status" name="status" class="form-control input-sm"
                                    required="">
                                @if($role_name!="Controller")
                                <option value="all">Booking Status</option>
                                @endif
                                <option value="Completed" @if(Request::get('status')=='Completed' || $role_name=='Controller') {{ "selected='selected'" }} @endif>
                                    Booked
                                </option>
                                @if($role_name!="Controller")
                                <option value="Abandon" @if(Request::get('status')=='Abandon') {{ "selected='selected'" }} @endif>
                                    Abandon
                                </option>
                                <option value="Refund" @if(Request::get('status')=='Refund') {{ "selected='selected'" }} @endif>
                                    Refund
                                </option>
                                <option value="Cancelled" @if(Request::get('status')=='Cancelled') {{ "selected='selected'" }} @endif>
                                    Cancelled
                                </option>
                                <option value="Noshow" @if(Request::get('status')=='Noshow') {{ "selected='selected'" }} @endif>
                                    No Show
                                </option>
                                @endif
                            </select>
                        </div>
                        @can('user_auth', ["Sources"])
                        @if($role_name!="Controller")
                        <div class="form-group">
                            Source <br>
                            <select name="booking_source" class="form-control input-sm" >
                                    @foreach($sourceList as $key=>$sourcelist)
                                        @php $checked='none'; @endphp
                                        @if(in_array($key,$user_role_details))
                                            @php $checked=true; @endphp
                                        @endif
                                        <option value="{{$key}}" @if(Request::get('booking_source')==$key) {{ "selected='selected'" }}@endif style="display:{{$checked}};">{{$sourcelist}}</option>


                                    @endforeach
                            </select>
                        </div>
                        @endif
                        @endcan


                        <div class="form-group" style="display:none;">
                            Days<br>
                            <select name="no_of_days" class="form-control input-sm" >

                                <option value="all">All</option>

                                @php
                                for ($j = 1; $j <= 30; $j++){
                                @endphp
                                <option value="{{ $j }}" @if(Request::get('no_of_days')==$j) {{ "selected='selected'" }} @endif >{{  $j }}</option>
                                @php
                                }
                                @endphp
                                <option value="30+" @if(Request::get('no_of_days')=="30+") {{ "selected='selected'" }} @endif >Over 30</option>
                            </select>
                        </div>



                        <!-- <div class="form-group">
                            <strong style="color:green;">Previous Adjustment</strong>
                            <input type="text" name="adjust" value="{{ Request::get('adjust') }}" class="form-control input-sm"
                                   placeholder="Enter Adjustment amout" value="">
                        </div> -->
                        <div class="form-group">
                            &nbsp;<br>
                            <input name="submit" type="submit" value="Search" class="btn btn-primary btn-sm" style="margin-left:10px">
                            <a href="{{ route('booking') }}" class="btn btn-primary btn-sm" style="margin-left:10px">Reset</a>
                        </div>
                    </form>

                </div>


                <br>
                <br>
                <br>
				@if(count($bookings) > 0)
                <div class="col-md-12"
                     style="border: 1px solid #e4e4e4;    border-radius: 9px; margin-bottom: 10px;background: #f5f5f6;">
                    <div class="col-md-8">
                        @php
                            $f_share = 0;
                            $tot_rev = 0;
                            $countCompleted=0;
                              foreach($bookings_count as $booking)
                              {


                                if($booking['booking_status']=='Completed') {
                                    $countCompleted++;
                                    $share = 0;
                                    if($booking->company){
                                        $share = $booking->company->share_percentage;
                                    }
                                    $fly_share = ((
                                    ($share/100)*
                                    $booking->booking_amount)-
                                    $booking->discount_amount)+
                                    $booking->booking_extra;
                                    $f_share += $fly_share;

                                    $rev = ((
                                    $booking->booking_amount)-
                                    $booking->discount_amount)+
                                    $booking->booking_extra;
                                    $tot_rev += $booking->total_amount;
                                }

                              }

                              $f_share = round(($f_share),2);
                              $net_share = round(($f_share * 0.78),2);

                        @endphp
                        <h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i> Total Booked
                            bookings: <span id="no_of_booking">  @php echo  $countCompleted;
                                @endphp</span></h2>
                        @if($role_name!="Controller")
                        @can('user_auth', ["Sources"])
                        <h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i> Total
                            Amount: <span id="total_share">{{$tot_rev}}</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                        @if($ORG != '0')
                         <h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i>
                            ORG: <span id="no_of_booking">  @php echo  $ORG;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                        @if($EM != '0')
                         <h2 class="badge badge-info" style="padding: 10px;"><i class=" entypo-target"></i>
                            EM: <span id="no_of_booking">  @php echo  $EM;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                        @if($POR != '0')
                         <h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i>
                            POR: <span id="no_of_booking">  @php echo  $POR;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                        @if($BING != '0')
                         <h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i>
                            BING: <span id="no_of_booking">  @php echo  $BING;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        @can('user_auth', ["Sources"])
                         @if($paid != '0')
                         <h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i>
                            Paid: <span id="no_of_booking">  @php echo  $paid;
                                @endphp</span></h2>
                        @endif
                        @endcan
                        <!--<h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i> Total-->
                        <!--    ZMD share: <span id="total_share">{{$f_share}}</span></h2>-->
                        <!--<h2 class="badge badge-info" style="padding: 10px;"><i class="entypo-target"></i> Net-->
                        <!--    ZMD share: <span id="net_share">{{$net_share}}</span></h2>-->




                    </div>
                    @can('user_auth', ["Downloads"])
                    <div class="col-md-4 text-right section-right" style="margin-top: 22px;">

                        <a id="excel" class="btn btn-primary  btn-sm" href='{{ route("admin_booking_report_excel") }}?filter={{ Request::get("filter") }}&search={{ Request::get("search") }}&start_date={{ Request::get("start_date") }}&end_date={{ Request::get("end_date") }}&companies={{ Request::get("companies") }}&airport={{ Request::get("airport") }}&status={{ Request::get("status") }}&admins={{ Request::get("admins") }}&payment={{ Request::get("payment") }}&refund_via={{ Request::get("refund_via") }}&palenty_to={{ Request::get("palenty_to") }}&no_of_days={{ Request::get("no_of_days") }}&agentID={{ Request::get("agentID") }}&booking_source={{ Request::get("booking_source") }}'><i class="fa fa-file-excel-o"></i> Download Excel</a>
                        <!--<a id="excel" target="_blank" class="btn btn-primary  btn-sm" href='{{ route("admin_booking_report_pdf") }}?filter={{ Request::get("filter") }}&search=&start_date={{ Request::get("start_date") }}&end_date={{ Request::get("end_date") }}&companies={{ Request::get("companies") }}&airport={{ Request::get("airport") }}&status={{ Request::get("status") }}&admins={{ Request::get("admins") }}&payment={{ Request::get("payment") }}&refund_via={{ Request::get("refund_via") }}&palenty_to={{ Request::get("palenty_to") }}'><i class="fa fa-file-pdf-o"></i>Download PDF</a>-->
                    </div>
                    @endcan
                </div>
				@endif
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

								<div id="sms_response"></div>
<div class="table-responsive">
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                    <tr>

                                        <th style="width: 50px;"> Reference No</th>
                                        <!--th>Airports</th-->

                                        <th>Name</th>
                                        <th>Booking Date</th>
                                        <th>Departure Date</th>
                                        <th>Return Date</th>
                                        <th>Booking status</th>
                                        <th>Company Booked</th>

                                        @if($role_name!="Controller")
                                        <th>Discount Code</th>
                                        <th style="width: 70px;">Payment Method</th>
                                        <!--<th>Refund</th>-->
                                        @can('user_auth', ["Amounts"])
                                        <th>Net Amount</th>
                                        @endcan
                                        @endif
                                        <!--<th>No of Days</th>-->
                                        <!--<th>Valet</th>-->
                                        @can('user_auth', ["Sources"])
										@if($role_name!="Marketing" && $role_name!="Controller")
                                        <th>Booking Src</th>
                                        <!--<th>Email</th>-->
                                        @endif
                                        @endcan
                                        <!--<th>Action</th>-->
                                        @if($role_name!="Controller")
										<!--<th>Cancel</th>-->
										@if($role_name!="Operations")
                                        <!--<th>Refund</th>-->
                                        @endif
                                        <!--<th>SMS</th>-->
										@endif
                                        

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($bookings as $booking)

                                        @php    if($booking['booking_status']=='Completed') { @endphp

                                        <tr id="expand_{{  $booking->id  }}">
                                        @php } else { @endphp
                                        <tr style="color:red;" id="expand_{{  $booking->id  }}">
                                            @php }  @endphp

											<td style="width: 50px;">
                                                <i class="fa fa-plus-circle" id="show_detail_icon_{{  $booking->id  }}"
                                                   style="cursor: pointer; font-size: 20px;color:green"
                                                   onclick="show_detal('{{  $booking->id  }}')"></i>
                                                   {{ $booking->referenceNo }}
                                            </td>
                                            <!--td class="">@if($booking->airport) <span
                                                        class="label label-sm label-success"><i
                                                            class="fa fa-plane"></i> {{ ucwords(preg_replace('/\s/', '', $booking->airport->name))  }}</span>  @endif
                                            </-->
                                            <td class="">{{ $booking->first_name." ".$booking->last_name }}</td>

                                            <td class="">{{ date('d/m/Y H:i', strtotime($booking->created_at)) }}</td>
                                            <td class="">{{ date('d/m/Y H:i', strtotime($booking->departDate)) }}</td>
                                            <td class="">{{ date('d/m/Y H:i', strtotime($booking->returnDate)) }}</td>
                                            <td class="">{{ $booking->booking_status }}</td>
                                            <td class="">{{ $booking->company->name }}</td>
                                            @if($role_name!="Controller")
                                            <td class=""> {{ $booking->discount_code }}</td>
                                            <td class="">
                                                @if($booking->payment_method=="stripe")
                                                    <span class="label label-sm label-info"><i
                                                                class="fa fa-cc-stripe"></i> {{ ucwords(preg_replace('/\s/', '', $booking->payment_method))  }}</span>


                                                @elseif($booking->payment_method=="payzone")
                                                    <span class="label label-sm label-info"><i
                                                                class="fa fa-paypal"></i> {{ ucwords(preg_replace('/\s/', '', $booking->payment_method))  }}</span>



                                                @endif
                                            </td>
                                            @can('user_auth', ["Amounts"])
                                            <td class="">£{{ $booking->total_amount }}</td>
                                            @endcan
                                            @endif

                                            {{--<td class="">{{ $booking->no_of_days}}</td>--}}
                                            @php
                                                $share = 0;
                                                    if($booking->company){ $share = $booking->company->share_percentage; }
                                                    $fly_share1 = ((($share/100)*$booking->booking_amount )-$booking->discount_amount)+$booking->booking_extra;

                                                    $fly_share = ($share/100)*$booking->booking_amount;
                                            @endphp

											<!--<td>{{ $booking->no_of_days  }}</td>-->

											<!--<td>-->
											<!--    @if($booking->valet_type != 1 & $booking->valet_type != 0 )-->
											<!--        Yes-->
										 <!--       @else-->
										 <!--           No-->
											<!--    @endif-->
											<!--</td>-->
											@can('user_auth', ["Sources"])
											@if($role_name!="Marketing" && $role_name!="Controller")
											<td>{{ $booking->traffic_src  }}</td>
											
											<!--<td><i onclick="sendEmailForm('{{ $booking->id  }}','{{ $booking->companyId  }}')"-->
           <!--                                                        class="btn btn-minier btn-warning fa fa-envelope"></i></td>-->
											@endif
											@endcan
											<!--<td>-->
											<!--	@can('user_auth', ["view"])-->
											<!--	<i id="view_detail"-->
											<!--	   onclick="getDetail('{{ $booking->id  }}')"-->
											<!--	   class="btn btn-minier btn-success fa fa-eye"-->
											<!--	   title="View"></i>-->
											<!--			 @endcan-->
											<!--	@if($role_name!="Controller")-->
											<!--	@can('user_auth', ["edit"])-->
											<!--	<a id="edit" class="btn btn-minier btn-pink"-->
											<!--	   href="{{ route("edit_booking_form",[$booking->id]) }}"-->
											<!--	   title="Edit"> <i class="fa fa-pencil"-->
											<!--						title="Edit"></i></a>-->
											<!--						 @endcan-->

											<!--	<a id="edit" class="btn btn-minier btn-warning "-->
											<!--	   href="{{ route("edit_booking_form",[$booking->id]) }}"-->
											<!--	   title="Extand">-->
											<!--		<i class="fa fa-ellipsis-h"-->
											<!--		   title="Extend"></i></a>-->
											<!--	<i onclick="getTransferForm('{{ route("transferBookingForm",[$booking->id]) }}')"-->
											<!--	   class="btn btn-minier btn-info fa fa-exchange"-->
											<!--	   title="Transfer"></i>-->
           <!--                                 @endif-->
											<!--</td>-->
											@if($role_name!="Marketing" && $role_name!="Controller")
											<!--<td>-->
											<!--	<i onclick="getcancelForm('{{ $booking->id  }}')"-->
											<!--	   class=" btn btn-minier btn-danger fa fa-times-circle"></i>-->

											<!--	<a id="cancel" class="btn btn-primary btn-minier" title="Cancel Booking Not show" onclick="return confirm('Are you sure want to cancel this booking..?')" href="{{ route('cancelNotShow',['id'=>$booking->id]) }}"><i class="entypo-cancel">Not Show</i></a>-->

											<!--</td>-->
											@if($role_name!="Operations")
											<!--<td><i onclick="getrefundForm('{{ $booking->id  }}')"-->
											<!--	   class="btn btn-minier btn-pink  fa fa-reply"></i>-->
											<!--</td>-->
											@endif
											<!--<td>-->
											<!--	<i class="btn btn-minier btn-warning  fa fa-commenting" onclick="sendsms('{{ $booking->phone_number  }}','{{ $booking->referenceNo  }}')" ></i>-->
											<!--</td>-->
										@endif
                                        </tr>
                                        <tr style="display: none" id="detail_{{  $booking->id  }}">
                                            <td colspan="11">
                                                <div class="col-md-4">
                                                    <table class="table table-bordered table-striped">

                                                        <tbody>

                                                            @if($role_name!="Marketing" && $role_name!="Controller")
                                                            @can('user_auth', ["Amounts"])
                                                        <tr>
                                                            <td colspan="2">Net Amount</td>
                                                        </tr>

                                                        <tr>
                                                            <td colspan="2"><span
                                                                        class="label label-sm col-md-12 col-xl-12 col-lg-12 label-success">£{{ $booking->total_amount }}</span>
                                                            </td>
                                                        </tr>
                                                        @endcan
                                                        @endif

                                                        <!--<tr>-->
                                                        <!--    <td colspan="2">ZMD Share</td>-->
                                                        <!--</tr>-->
                                                        <!--<tr>-->
                                                        <!--    <td colspan="2"><span-->
                                                        <!--                class="label col-md-12 col-xl-12 col-lg-12 label-sm label-info">£{{ $fly_share  }}</span>-->
                                                        <!--    </td>-->
                                                        <!--</tr>-->

                                                        <tr>
                                                            <td>No of Days</td>
                                                            <td>{{ $booking->no_of_days  }}</td>
                                                        </tr>
                                                        
                                                        @can('user_auth', ["Sources"])
                                                        <tr>
                                                            <td>Booking Src</td>
                                                            <td>{{ $booking->traffic_src  }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Pickup / Return </td>
                                                            <td> 
                                                               <button type="button" 
                                                               @if($booking->departure_status != null) disabled @else data-id="{{ $booking->id }}" data-type="departure_status" onclick="confirmAction(this)" @endif class="btn btn-sm btn-warning">
    <i class="fa fa-truck" aria-hidden="true"></i> Picked Up
</button>

<button type="button" @if($booking->return_status != null) disabled @else data-id="{{ $booking->id }}" data-type="return_status" onclick="confirmAction(this)" @endif class="btn btn-sm btn-danger">
    <i class="fa fa-undo" aria-hidden="true"></i> Returned
</button>


                                                               
                                                            </td>
                                                        </tr>
                                                        @endcan
                                                        <tr>
                                                            <td>Refund</td>
                                                            <td class="">

       @php
                                                 $transactions = App\booking_transaction::where("referenceNo", $booking->referenceNo)->get();


            $transaction = (array)$transactions;
            $cancel=0;
            $adjust=0;
            $plenty_amount=0;
            $total_planty_to_flys=0;
             $total_planty_to_company=0;
             $total_planty_to_companys=0;
             $total_planty_to_fly=0;

           foreach ($transactions as $transaction) {

                if ($transaction['booking_status'] != 'Noshow') {

                    if ($transaction['amount_type'] == 'credit' && $transaction['payment_case'] == 'cancel') {

                        $cancel += $transaction['payable'];

                    }


                    if ($transaction['amount_type'] == 'credit' && ($transaction['payment_case'] == 'Refund' || $transaction['payment_case'] == 'edit')) {

                        $adjust += $transaction['payable'];



                    }
                     $penalty_trans = App\penalty_details::where("trans_id", $transaction["id"])->get();

                    foreach ($penalty_trans as $penalty) {

                        if ($penalty['penalty_to'] == "Company") {

                            $total_planty_to_companys += $penalty['penalty_amount'];

                        }

                        if ($penalty['penalty_to'] == "yayparking") {

                            $total_planty_to_flys += $penalty['penalty_amount'];

                        }

                    }

                    $total_planty_to_company += $total_planty_to_companys;

                    $total_planty_to_fly += $total_planty_to_flys;



                    // if($transaction['palenty_amount']==''){

                    // $transaction['palenty_amount']=0;

                    // }



                    $plenty_amount += ($total_planty_to_fly + $total_planty_to_company);
                }
            }


                                            @endphp
                                                {{$cancel+$adjust+$plenty_amount}}

                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Valet</td>
                                                            <td>@if($booking->valet_type != 1 & $booking->valet_type != 0 )
											        Yes
										        @else
										            No
											    @endif</td>
                                                        </tr>
                                                        @can('user_auth', ["Email"])
                                                      @if($role_name!="Marketing" && $role_name!="Controller")
                                                        <tr>
                                                            <td>Email</td>
                                                            <td><i onclick="sendEmailForm('{{ $booking->id  }}','{{ $booking->companyId  }}')"
                                                                   class="btn btn-minier btn-warning fa fa-envelope"></i></td>
                                                        </tr>
                                                        @endcan

                                                        <tr>
                                                            <td>Action</td>
                                                            @php
                                                                if($booking->aph_id =='NULL' || $booking->aph_id ==''){
                                                                    $dis = '';
                                                                } else{
                                                                    $dis = 'disabled';
                                                                }

                                                            @endphp
                                                            <td>
												@can('user_auth', ["view"])
												<i id="view_detail"
												   onclick="getDetail('{{ $booking->id  }}')"
												   class="btn btn-minier btn-success fa fa-eye"
												   title="View"></i>
														 @endcan

												@can('user_auth', ["edit"])
												<a id="edit" class="btn btn-minier btn-pink"
												   href="{{ route("edit_booking_form",[$booking->id]) }}"
												   title="Edit"> <i class="fa fa-pencil"
																	title="Edit"></i></a>
												@endcan
                                            @if($role_name!="Controller" && $role_name!="Operations")
												<a id="edit" class="btn btn-minier btn-warning "
												   href="{{ route("edit_booking_form",[$booking->id]) }}"
												   title="Extand">
													<i class="fa fa-ellipsis-h"
													   title="Extend"></i></a>
												<i onclick="getTransferForm('{{ route("transferBookingForm",[$booking->id]) }}')"
												   class="btn btn-minier btn-info fa fa-exchange"
												   title="Transfer"></i>
                                            @endif
											</td>
                                                        </tr>

                                                    @can('user_auth', ["Cancel"])
                                                        <tr>
                                                            <td>Cancel</td>
                                                            <td>
												<i onclick="getcancelForm('{{ $booking->id  }}')"
												   class=" btn btn-minier btn-danger fa fa-times-circle"></i>
                                                @if($role_name!="Operations")
												<a id="cancel" class="btn btn-primary btn-minier" title="Cancel Booking Not show" onclick="return confirm('Are you sure want to cancel this booking..?')" href="{{ route('cancelNotShow',['id'=>$booking->id]) }}"><i class="entypo-cancel">Not Show</i></a>
                                                @endif
											</td>
                                                        </tr>
                                                    @endcan
                                                    @if($role_name!="Operations")
                                                    @can('user_auth', ["Refund"])
                                                        <tr>
                                                            <td>Refund</td>
                                                            <td><i onclick="getrefundForm('{{ $booking->id  }}')"
												   class="btn btn-minier btn-pink  fa fa-reply"></i>
											</td>
                                                        </tr>
                                                    @endcan
                                                    @endif
                                                    @can('user_auth', ["SMS"])
                                                        <tr>
                                                            <td>Sms</td>
                                                            	<td>
												<i class="btn btn-minier btn-warning  fa fa-commenting" onclick="sendsms('{{ $booking->phone_number  }}','{{ $booking->referenceNo  }}')" ></i>
											</td>
                                                        </tr>
                                                    @endcan
                                                        @endif

                                                        </tbody>

                                                    </table>
                                                </div>



                                                {{--<ul data-dtr-index="0" class="col-md-3">--}}
                                                {{--<li data-dtr-index="10"><span class="dtr-title">Net Amount:</span>--}}
                                                {{--<span--}}
                                                {{--class="dtr-data"><strong--}}
                                                {{--class="badge badge-success badge-roundless"--}}
                                                {{--style="width:100%;"></strong></span>--}}
                                                {{--</li>--}}
                                                {{--<li data-dtr-index="11"><span class="dtr-title">Fly Share:</span>--}}
                                                {{--<span--}}
                                                {{--class="dtr-data"><strong--}}
                                                {{--class="badge badge-info badge-roundless"--}}
                                                {{--style="width:100%;"></strong></span>--}}
                                                {{--</li>--}}
                                                {{--<li data-dtr-index="12"><span class="dtr-title">No of Days:</span>--}}
                                                {{--<span--}}
                                                {{--class="dtr-data"> </span>--}}
                                                {{--</li>--}}
                                                {{--<li data-dtr-index="13"><span class="dtr-title">Booking Src:</span>--}}
                                                {{--<span class="dtr-data"></span></li>--}}
                                                {{--<li data-dtr-index="14"><span class="dtr-title">Email:</span> <span--}}
                                                {{--class="dtr-data"><a class="btn btn-info btn-xs"--}}
                                                {{--onclick="showResendModal(904,'101');"--}}
                                                {{--title="Resend Email"><i--}}
                                                {{--class="entypo-mail"></i></a></span></li>--}}
                                                {{--<li data-dtr-index="15"><span class="dtr-title">Action:</span> <span--}}
                                                {{--class="dtr-data"><a id="view"--}}
                                                {{--class="btn btn-info btn-xs popId"--}}
                                                {{--data-toggle="modal"--}}
                                                {{--data-target="#Booking_Detail_AP-170608904"--}}
                                                {{--title="BookingHistory"--}}
                                                {{--onclick="showhistoryModal('AP-170608904');"><i--}}
                                                {{--class="entypo-book-open"></i></a>--}}

                                                {{--<a id="view" class="btn btn-info btn-xs popId" data-toggle="modal"--}}
                                                {{--data-target="#Booking_Detail_904" title="Booking Details"--}}
                                                {{--onclick="showAjaxModal(904);"><i class="entypo-eye"></i></a>--}}

                                                {{--<a id="transfer" class="btn btn-info btn-xs popId" data-toggle="modal"--}}
                                                {{--data-target="#Booking_transfer_904" title="Booking Transfer"--}}
                                                {{--onclick="showtransferModal(904);"><i class="entypo-switch"></i></a></span></li>--}}
                                                {{--<li data-dtr-index="16"><span class="dtr-title">Canc:</span> <span--}}
                                                {{--class="dtr-data"><a id="cancel"--}}
                                                {{--class="btn btn-danger btn-xs"--}}
                                                {{--data-toggle="modal"--}}
                                                {{--data-target="#Booking_Detail_904"--}}
                                                {{--title="Cancel Booking"--}}
                                                {{--onclick="cancel_refund(904,'cancel');"><i--}}
                                                {{--class="entypo-cancel"></i></a>--}}

                                                {{--<a id="cancel" class="btn btn-primary btwn-xs" title="Cancel Booking Not show"--}}
                                                {{--onclick="return confirm('Are you sure want to cancel this booking..?')"--}}
                                                {{--href="index.php?p=company_bookings&amp;mode=cancel_not_show&amp;id=904"><i--}}
                                                {{--class="entypo-cancel">Not Show</i></a></span></li>--}}
                                                {{--<li data-dtr-index="17"><span class="dtr-title">Refund:</span> <span--}}
                                                {{--class="dtr-data"><a id="refund"--}}
                                                {{--class="btn btn-warning btn-xs"--}}
                                                {{--data-toggle="modal"--}}
                                                {{--data-target="#Booking_Detail_904"--}}
                                                {{--title="Refund"--}}
                                                {{--onclick="cancel_refund(904,'refund');"><i--}}
                                                {{--class="entypo-shareable"></i></a></span></li>--}}
                                                {{--<li data-dtr-index="18"><span class="dtr-title">Sms:</span> <span--}}
                                                {{--class="dtr-data"><b><a class="btn btn-danger btn-xs"--}}
                                                {{--onclick="return confirm('Are you sure?')"><i--}}
                                                {{--class="entypo-phone"></i></a></b></span>--}}
                                                {{--</li>--}}
                                                {{--</ul>--}}
                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>
</div>

                                {{ $bookings->appends(request()->input())->links("vendor.pagination.default") }}
                            </div><!-- /.span -->
                        </div><!-- /.row -->


                        <!-- PAGE CONTENT ENDS -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div>
            <br/>
            <br/>
            <br/>

@endsection

@section("footer-script")

<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    } );
    </script>
    
    
    
    
    
    
    <script src='{{ secure_asset("assets/js/moment.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/daterangepicker.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootstrap-datetimepicker.min.js") }}'></script>

<script src='{{ secure_asset("assets/js/bootstrap-datepicker.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootstrap-timepicker.min.js") }}'></script>


<!-- page specific plugin scripts -->
<script src='{{ secure_asset("assets/js/wizard.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/jquery.validate.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/jquery-additional-methods.min.js") }}'></script>
<script src='{{ secure_asset("assets/js/bootbox.js") }}'></script>
{{--<script src='{{ secure_asset("assets/js/jquery.min.js") }}'></script>--}}
<script src='{{ secure_asset("assets/js/select2.min.js") }}'></script>
<script type="text/javascript">


	$('#start_date').datepicker({
		autoclose: true,
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



<script src='{{ secure_asset("assets/front/js/bootbox.js") }}'></script>
<script>

	function show_detal(id) {
		console.log('test');
		if ($("#show_detail_icon_" + id).hasClass("fa-plus-circle")) {
			$("#show_detail_icon_" + id).removeClass("fa-plus-circle");
			$("#show_detail_icon_" + id).addClass("fa-minus-circle");
		} else {
			$("#show_detail_icon_" + id).removeClass("fa-minus-circle");
			$("#show_detail_icon_" + id).addClass("fa-plus-circle");
		}
		console.log('test');

		$("#detail_" + id).toggle();
	}

	function sendEmailForm(id, cmpID) {
		ModelPopUp("<div id=\"resend_email\" ><div><h2>Resend Email</h2></div>\n" +
			"                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
			"<input class=\"radio-resend\" type=\"radio\" value=\"company\" name=\"resendEmailto\">Company</label>\n" +
			"                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
			"<input class=\"radio-resend\"  type=\"radio\" value=\"client\" name=\"resendEmailto\">Client</label>\n" +
			"                        <label class=\"radio-inline\" style=\"font-size: 16px;\">" +
			"<input class=\"radio-resend\" type=\"radio\" value=\"all\" name=\"resendEmailto\" >ALL</label>\n" +
			"                        <input  onclick=\"sendEmail('" + id + "','" + cmpID + "')\" class=\"btn btn-info\" value=\"Send\" style=\"margin: 15px 5px 5px 15px;\">\n" +
			"                        </div>");
	}

	function sendEmail(id, cid) {
		var type = $('input[name=resendEmailto]:checked').val();
		$("#resend_email").html("<div id=\"resend_email\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");

		var data = {};
		data["id"] = id;
		data["cid"] = cid;
		data["type"] = type;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("booking.sendEmailBooking") }}', data, function (data) {
			console.log("data===", data);
			$("#resend_email").html(data);
//                        if (data.StatusCode == 0) {
//                            window.location.href = "https://"+window.location.hostname+"/booking/thankyou";
//                        } else {
//                            $("#error_personal_detail").html(data.Message);
//                        }
		});

	}

	function validate(form) {

		// validation code here ...


		if (!valid) {
			alert('Please correct the errors in the form!');
			return false;
		}
		else {
			return confirm('Do you really want to submit the form?');
		}
	}

	function getDetail(id) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.show") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
		});


	}


	function getcancelForm(id) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.cancelForm") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}

	function getrefundForm(id) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		$.post('{{ route("bookingdetail.refundForm") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}


	function transferSubmit(id) {
		var cid = $("#company_id_pop option:selected").val();
		var html = "<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>";
		$("#booking_detail_pop").html(html);
		var data = {};
		data["id"] = id;
		data["_token"] = '{{ csrf_token() }}';
		data["new_cid"] = cid;
		$.post('{{ route("transferBooking") }}', data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}


	function getTransferForm(url) {
		ModelPopUp("<div id=\"booking_detail_pop\" style=\"text-align: center;\"><img src='{{ secure_asset("assets/images/loader.gif") }}'/> </div>");
		var data = {};
		// data["id"]=id;
		data["_token"] = '{{ csrf_token() }}';
		$.get(url, data, function (data) {
			console.log("data===", data);
			$("#booking_detail_pop").html(data);
//
		});


	}

	function ModelPopUp(message) {
		bootbox.dialog({
			message: message,
			size: "large",
		});
	}
	function sendsms(phone_no,ref_no){
		var data = {};
		var url ='{{ url("admin/send_sms") }}/'+phone_no+'/'+ref_no;

		data["_token"] = '{{ csrf_token() }}';
		$.get(url,  function (data) {

			if(data == 200){
				$("#sms_response").html('<div class="alert alert-success"><strong>Success!</strong> SMS Successfully sent.</div>');
			}
			else{
				$("#sms_response").html('<div class="alert alert-danger"><strong>Error!</strong> SMS sending failed.</div>');
			}

		});
	}
</script>
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
 <script>
    function confirmAction(button) {
        var id = button.getAttribute('data-id');
        var type = button.getAttribute('data-type');
        var clickedButton = button;
        var confirmation = confirm('Are you sure you want to confirm ' + type + ' status?'); 
       
        if (confirmation) {
            // Send AJAX request to update database
            $.ajax({
                url: "{{route('booking.update.pickup.return.status')}}", // Replace with your actual route URL
                method: 'GET',
                data: {
                    id: id,
                    type: type
                },
                success: function(response) {
                   if(response.status == true){
                       clickedButton.disabled = true;
                       alert("Status Updated")
                       
                   }
                    console.log(response);
                },
                error: function(error) {
                    // Handle error response if needed
                    console.error(error);
                }
            });
        }
    }
</script>

@endsection
