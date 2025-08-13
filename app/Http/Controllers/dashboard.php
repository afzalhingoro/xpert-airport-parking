<?php

namespace App\Http\Controllers;

use App\Models\airports_bookings;
use App\Models\users_roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class dashboard extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function __construct()

    {

        $this->middleware('auth');

    }


    /**

     * Show the application dashboard.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $role_nam = users_roles::get_user_role(Auth::user()->id)->name;
        $agent = new BookingController();
        $bmodel = new airports_bookings();
        $todaybooking = airports_bookings::where('booking_status',"completed")->whereDate('created_at', Carbon::today())->count();
        $todayDept = airports_bookings::where('booking_status',"completed")->whereDate('departDate', Carbon::today())->count();
        $todayRet = airports_bookings::where('booking_status',"completed")->whereDate('returnDate', Carbon::today())->count();
        $today_amount = $agent->sales_amount("today"); 
        $monthly_amount = $agent->sales_amount("monthly");



//Invalid argument supplied for foreach



        $count_paid_bookings = $agent->get_sales_count("paid");



       // dd("ttt");

        $sale_count = $agent->get_sales_count("em");

        $count_organic_booking_source = $agent->get_sales_count("org");

        $count_email_booking_source = $agent->get_sales_count("em");

        $count_google_booking_source = $agent->get_sales_count("ppc");

        $count_bing_booking_source = $agent->get_sales_count("BING");

        $incompletebooking = $agent->get_count_bookings("incomplete");

        $completebooking = $agent->get_count_bookings("complete");

        $thismonthsale = $bmodel->getThisMonthlySale();

		if($role_nam=="Marketing") //do not show dashboard to marketers
		{
			return redirect('admin/booking');
		}


// Show total orders for Paid, Email, and Organic on dashboard
        /*
        * today total bookings
        */
        $todayTotal = airports_bookings::where('booking_status',"completed")->where('traffic_src','!=',"Agent")
        ->whereDate('created_at', Carbon::today())->count();

        /*
        * today ppc bookings
        */
        $todayPpc = airports_bookings::where([
            'booking_status' => 'completed', 'payment_status' => 'success', 'traffic_src' => 'PPC'
        ])->whereDate('created_at', Carbon::today())->count();

        /*
        * today bing bookings
        */
        $todayBing = airports_bookings::where([
            'booking_status' => 'completed', 'payment_status' => 'success', 'traffic_src' => 'BING'
        ])->whereDate('created_at', Carbon::today())->count();

        /*
        * today email bookings
        */
        $todayEmail = airports_bookings::where([
            'booking_status' => 'completed', 'payment_status' => 'success', 'traffic_src' => 'EMAIL'
        ])->whereDate('created_at', Carbon::today())->count();

        /*
        * today org bookings
        */
        $todayOrg = airports_bookings::where([
            'booking_status' => 'completed', 'payment_status' => 'success', 'traffic_src' => 'ORG'
        ])->whereDate('created_at', Carbon::today())->count();

        /*
        * today Agent bookings
        */
        $todayAgent = airports_bookings::where([
            'booking_status' => 'completed', 'traffic_src' => 'Agent'
        ])->whereDate('created_at', Carbon::today())->count();


        return view('admin.index',["todayAgent" =>$todayAgent, "todayRet" =>$todayRet,"todayDept" => $todayDept,"sale_count"=> $todaybooking,"today_amount"=>$today_amount,"monthly_amount"=>$monthly_amount,"role_nam"=>$role_nam,"count_organic_booking_source"=>$count_organic_booking_source,"count_email_booking_source"=>$count_email_booking_source,"count_google_booking_source"=>$count_google_booking_source,"count_bing_booking_source"=>$count_bing_booking_source,"incompletebooking"=>$incompletebooking,"completebooking"=>$completebooking,"count_paid_bookings"=>$count_paid_bookings, 'todayTotal'=>$todayTotal, 'todayPpc'=>$todayPpc, 'todayBing'=>$todayBing, 'todayEmail'=>$todayEmail, 'todayOrg'=>$todayOrg]);

    }







}

