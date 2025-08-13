<?php

namespace App\Http\Controllers;
use App\Models\parse_emails;
use App\Models\airports_bookings;
use App\Models\airport;
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

class ParsedEmailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //set_time_limit(0);
        $parse_emails = parse_emails::orderby('id','DESC');
        $parse_emails = $parse_emails->paginate(1000);

      
        return view("admin.parse_emails.list", ["parse_emails" => $parse_emails]);




    }
    public function view($id)
    {
        
        set_time_limit(0);
        $parse_email = parse_emails::where('id', $id)->first();
      //dd($parse_email);
        return view("admin.parse_emails.view", ["parse_email" => $parse_email]);
    
        
    }
    
    
}
