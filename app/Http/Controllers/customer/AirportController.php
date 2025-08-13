<?php

namespace App\Http\Controllers\Back;

use App\Models\Airports;
use App\Models\Discounts;
use App\Models\Deals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class AirportController extends Controller
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
        $data['page_title'] = "Airport List";
        $data['airports'] = Airports::all();
        return view('admin.airport-view',["data" => $data]);
    }
    public function add_airport()
    {
        $data['page_title'] = "Add Airport";
        
        return view('admin.airport-add',["data" => $data]);
    }
    public function create_airport(Request $request)
    {
        
        $data = $request->all();
        unset($data['_token']);
        $deal_insert = Airports::create($data);
        if($deal_insert){
            return redirect("/admin/airport-view")->with("success", "Airport added Successfully");
        }
    }
    public function edit_airport($id)
    {
        $data['page_title'] = "Edit Airport";
        
        $data['airport'] = Airports::where('id',$id)->first();
        
        return view('admin.airport-edit',["data" => $data]);
    }
    public function update_airport(Request $request)
    {
        
        $data = $request->all();
        unset($data['_token']);
        $deal_insert = Airports::where('id',$data['id'])->update($data);
        if($deal_insert){
            return redirect("/admin/airport-view")->with("success", "Airport updated Successfully");
        }
    }
    
    public function delete_airport($id)
    {
        $deal_delete = Airports::where('id',$id)->delete();
        if($deal_delete){
            return redirect("/admin/airport-view")->with("success", "Airport Deleted Successfully");
        }
    }
}
