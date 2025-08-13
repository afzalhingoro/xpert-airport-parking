<?php

namespace App\Http\Controllers\Back;

use App\Models\Airports;
use App\Models\Discounts;
use App\Models\Companies;
use App\Models\Deals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DealController extends Controller
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
        $data['page_title'] = "Deals List";
        $data['deals'] = Deals::with('airports','discounts','companies')->get();
        //dd($data);
        return view('admin.deals-view',["data" => $data]);
    }
    public function add_deal()
    {
        $data['page_title'] = "Add Deal";
        
        $data['airports'] = Airports::all()->where("status", "Yes");
        $data['companies'] = Companies::all()->where("status", "Yes");
        $data['discounts'] = Discounts::all()->where("status", "Yes");
        return view('admin.deal-add',["data" => $data]);
    }
    public function edit_deal($id)
    {
        $data['page_title'] = "Edit Deal";
        
        $data['deal'] = Deals::where('id',$id)->first();
       //dd($data['deal']);
        $data['airports'] = Airports::all()->where("status", "Yes");
        $data['companies'] = Companies::all()->where("status", "Yes");
        $data['discounts'] = Discounts::all()->where("status", "Yes");
        return view('admin.deal-edit',["data" => $data]);
    }
    public function create_deal(Request $request)
    {
        
        $data = $request->all();
        if($request->hasFile('deal_img')){
            $file = request()->file('deal_img');
            $extension = $file->getClientOriginalExtension();
            $destination = 'deals_img/';
            $filename = uniqid() . '.' . $extension;
            $file->move($destination, $filename);
             $data['deal_img'] = $filename;
        }
        unset($data['_token']);
        $deal_insert = Deals::create($data);
        if($deal_insert){
            return redirect("/admin/deals-view")->with("success", "Deals added Successfully");
        }
    }
    public function update_deal(Request $request)
    {
        
        $data = $request->all();
        if($request->hasFile('deal_img')){
            $file = request()->file('deal_img');
            $extension = $file->getClientOriginalExtension();
            $destination = 'deals_img/';
            $filename = uniqid() . '.' . $extension;
            $file->move($destination, $filename);
             $data['deal_img'] = $filename;
        }
        unset($data['_token']);
        $deal_insert = Deals::where('id',$data['id'])->update($data);
        if($deal_insert){
            return redirect("/admin/deals-view")->with("success", "Deal updated Successfully");
        }
    }
    
    public function delete_deal($id)
    {
        $deal_delete = Deals::where('id',$id)->delete();
        if($deal_delete){
            return redirect("/admin/deals-view")->with("success", "Deal Deleted Successfully");
        }
    }
}
