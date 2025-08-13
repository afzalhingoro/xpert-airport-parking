<?php
namespace App\Http\Controllers\customer;
use App\Http\Controllers\Controller;



class BookingController extends Controller
{
    public function index()
    {
        return view('customer_dashboard.manage_booking');
    }


    public function booking_history()
    {
        return view('customer_dashboard.booking_history');
    }
}
