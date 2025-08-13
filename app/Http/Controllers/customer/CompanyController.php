<?php

namespace App\Http\Controllers\Back;

use App\Models\Airports;
use App\Models\Companies;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class CompanyController extends Controller
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
        $data['page_title'] = "Companies List";
        $data['companies'] = Companies::with('airports')->get();
        //dd($data);
        return view('admin.companies-view',["data" => $data]);
    }
    public function add_companies()
    {
        $data['page_title'] = "Add Company";
        
        $data['airports'] = Airports::all()->where("status", "Yes");
        return view('admin.companies-add',["data" => $data]);
    }
    public function create_companies(Request $request)
    {
        
        $data = $request->all();
        if($request->hasFile('comp_img')){
            $file = request()->file('comp_img');
            $extension = $file->getClientOriginalExtension();
            $destination = 'companies_img/';
            $filename = uniqid() . '.' . $extension;
            $file->move($destination, $filename);
            $data['comp_img'] = $filename;
        }
        unset($data['_token']);
        $deal_insert = Companies::create($data);
        if($deal_insert){
            return redirect("/admin/companies-view")->with("success", "Company added Successfully");
        }
    }
    
    public function edit_company($id)
    {
        $data['page_title'] = "Edit Company";
        
        $data['company'] = Companies::where('id',$id)->first();
       
        $data['airports'] = Airports::all()->where("status", "Yes");
        return view('admin.companies-edit',["data" => $data]);
    }
    
    public function update_company(Request $request)
    {
        
        $data = $request->all();
        if($request->hasFile('comp_img')){
            $file = request()->file('comp_img');
            $extension = $file->getClientOriginalExtension();
            $destination = 'companies_img/';
            $filename = uniqid() . '.' . $extension;
            $file->move($destination, $filename);
            $data['comp_img'] = $filename;
        }
        unset($data['_token']);
        $deal_insert = Companies::where('id',$data['id'])->update($data);
        if($deal_insert){
            return redirect("/admin/companies-view")->with("success", "Company updated Successfully");
        }
    }
    
    public function delete_company($id)
    {
        $deal_delete = Companies::where('id',$id)->delete();
        if($deal_delete){
            return redirect("/admin/companies-view")->with("success", "Company Deleted Successfully");
        }
    }
}
