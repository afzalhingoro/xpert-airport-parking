<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\airports_bookings;
use App\Models\customers;
use App\Models\support_departments;
use App\Models\ticket_chat;
use App\Models\tickets;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\Exceptions\InvalidFormatException;



class HomeController extends Controller
{
    public function index()
    {


        if (Auth::guard('customer')->user() == false) {
            return redirect(route("customer-login"))->with('Failed', 'Please Login to view Dashboard');
        } else {    

            $customer = Auth::guard('customer')->user();
            $regDate = Auth::guard('customer')->user()->created_at;
            $bookings = airports_bookings::where("customerId", $customer->id)->where("booking_status", "Completed")->where("booking_action", "Booked")->get();
            // $latestBooking = airports_bookings::where("customerId", $customer->id)->where("booking_status", "Completed")->where("booking_action", "Booked")->groupBy('created_at')->latest()->first();
            $latestBooking = airports_bookings::select('created_at', DB::raw('MAX(id) as id'))
                            ->where("customerId", $customer->id)
                            ->where("booking_status", "Completed")
                            ->where("booking_action", "Booked")
                            ->groupBy('created_at')
                            ->latest()
                            ->first();
            $currentMonthBooking = airports_bookings::where("customerId", $customer->id)->where("booking_status", "Completed")->where("booking_action", "Booked")->whereMonth('created_at', Carbon::now()->month)->count();
            $customerTotalBookings = airports_bookings::where("customerId", $customer->id)->where("booking_status", "Completed")->where("booking_action", "Booked")->count();
            // tayyab Working
            // Old query
            // $currentPlan = customers::select("lp.plan_name as plan")
            //     ->leftjoin("loyatly_plans as lp", "lp.id", "=", "customers.loyalty_planID")
            //     ->where("customerId", $customer->id)->first();
            //  dd($currentPlan, $customer->loyaltyPlan);
            // $currentPlan = $customer->loyaltyPlan;
            $now = Carbon::now();
            //  dd($now ." AND ". $regDate);
            $totalYear = $now->diffInYears($regDate);
            //  date('Y-m-d H:i:s', strtotime('-1 days', strtotime($regDate)));
            //  dd($totalYear);

            return view('customer_dashboard.home-auth', ["bookings" => $bookings, "latestBooking" => $latestBooking, "currentMonthBooking" => $currentMonthBooking, "customerTotalBookings" => $customerTotalBookings,  "totalYear" => $totalYear]);
        }
    }

    public function manage_booking()
    {
        $customer = Auth::guard('customer')->user();
        $bookings = airports_bookings::where("customerId", $customer->id)->where("booking_status", "Completed")->where("booking_action", "Booked")->orderby("id", "DESC")->get();
        return view('customer_dashboard.manage_booking', ["bookings" => $bookings]);
    }


    public function booking_history()
    {
        $customer = Auth::guard('customer')->user();
        $bookings = airports_bookings::where("customerId", $customer->id)->where("booking_status", "Completed")->where("booking_action", "Booked")->orderby("id", "DESC")->get();

        return view('customer_dashboard.booking_history', ["bookings" => $bookings]);
    }

    public function support_tickets()
    {

        $customer = Auth::guard('customer')->user();
        // $tickets = tickets::where("user_id", $customer->id)->get();
        // Fetch tickets with department relation
        $tickets = DB::table('tickets')
        ->join('support_departments', 'tickets.department', '=', 'support_departments.id')
        ->select(
            'tickets.*', 
            'support_departments.name as department_name'
        )
        ->where('tickets.user_id', $customer->id)
        ->get();

        return view('customer_dashboard.support_tickets', ["tickets" => $tickets]);
    }
  


    public function viewTicket($id)
    {

        $ticket = tickets::where("id", $id)->orderBy('id', 'desc')->first();
        $department = support_departments::where("id", $ticket->department)->orderBy('id', 'desc')->first();
        $progress = ticket_chat::where("ticket_id", $ticket->id)->orderBy('id', 'desc')->first();
        ticket_chat::where("ticket_id", $ticket->id)->update(["adminunread" => "Yes"]);
        $companyMsg[] = "";
        if ($progress->reply_to == 'All') {
            if ($progress->clientunread == 'Yes') {
                $companyMsg = "Awaiting for Client Read";
            } elseif ($progress->Companyread == 'No') {
                $companyMsg = "Awaiting for Company Read";
            } else {
                $companyMsg = "Awaiting for Client and Company Response";
            }
        } elseif ($progress->reply_to != 'All') {
            if ($progress->reply_by == 'Client' && $progress->hold == 'Yes') {
                $companyMsg = "Awaiting for admin to show to Company";
            } else if ($progress->reply_by == 'Company' && $progress->hold == 'Yes') {
                $companyMsg = "Awaiting for Admin to show to Client";
            } elseif ($progress->reply_by == 'Admin' && $progress->reply_to == 'Company') {

                $companyMsg = "Awaiting for Company Reply";
            } elseif ($progress->reply_by == 'Admin' && $progress->reply_to == 'Client') {

                $companyMsg = "Awaiting for Client Reply";
            } else {

                $companyMsg = "Awaiting for Response";
            }
        }

        return view("customer_dashboard.view_ticket", ["companyMsg" => $companyMsg, "progress" => $progress, "id" => $id, "model" => $ticket, "ticket" => $ticket, "department" => $department]);

        //return view("admin.myticket.view", ["companyMsg" => $companyMsg, "progress" => $progress, "id" => $id, "model" => $ticket, "ticket" => $ticket, "department" => $department]);
    }
}
