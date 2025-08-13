<?php

namespace App\Http\Controllers\Back;

use App\Models\Subscribers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubscribersController extends Controller
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
        $data['page_title'] = "Subscribers List";
        $data['subscribers'] = Subscribers::all();
        return view('admin.subscribers-view',["data" => $data]);
    }
}
