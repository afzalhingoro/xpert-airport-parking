<?php

namespace App\Http\Controllers\Back;

use App\Models\Airports;
use App\Models\Discounts;
use App\Models\Deals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DiscountController extends Controller
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
        $data['page_title'] = "Promo Codes List";
        $data['discounts'] = Discounts::all();
        return view('admin.discount-view',["data" => $data]);
    }
    public function add_discount()
    {
        $data['page_title'] = "Add Promo Codes";
        
        return view('admin.discount-add',["data" => $data]);
    }
    public function edit_discount($id)
    {
        $data['page_title'] = "Edit Promo Codes";
        
        $data['discount'] = Discounts::where('id',$id)->first();
        
        return view('admin.discount-edit',["data" => $data]);
    }
    public function create_discount(Request $request)
    {
        
        $data = $request->all();
        unset($data['_token']);
        $deal_insert = Discounts::create($data);
        if($deal_insert){
            return redirect("/admin/discount-view")->with("success", "Promo Code added Successfully");
        }
    }
    
    public function update_discount(Request $request)
    {
        
        $data = $request->all();
        
        unset($data['_token']);
        $deal_insert = Discounts::where('id',$data['id'])->update($data);
        if($deal_insert){
            return redirect("/admin/discount-view")->with("success", "Promo Code updated Successfully");
        }
    }
    
    public function delete_discount($id)
    {
        $deal_delete = Discounts::where('id',$id)->delete();
        if($deal_delete){
            return redirect("/admin/discount-view")->with("success", "Promo Code Deleted Successfully");
        }
    }
}
