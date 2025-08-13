<?php



namespace App\Http\Controllers;



use App\Models\airport;
use App\Models\partners;

use App\Models\companies_product_price;

use App\Models\companies_products;

use App\Models\companies_set_assign_price_plan;

use App\Models\companies_set_price_plan;

use App\Models\Company;

use App\Models\valet;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class CompaniesProductPriceController extends Controller

{





    public function __construct()

    {

        $this->middleware('auth');

    }



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //
        $agent = partners::where('id', '!=', 7)->get();
         
          $selfPlanCompanies = Company::whereIn('id', [3,117,120,121,123,124,125])->get();
    $apiPlanCompanies = Company::whereIn('id', [118])->get();

        return view("admin.company.plan_setting",[ "selfPlanCompanies" => $selfPlanCompanies,
        "apiPlanCompanies" => $apiPlanCompanies,"agent"=>$agent]);
      

       // $airports = airport::all()->toArray();

       



    }

    //viewEditPlan

    public function viewEditPlan()

    {
        //

        $companies = Company::all()->toArray();
        $agent = partners::where('id', '!=', 7)->get();

        // Filter companies based on predefined IDs
        $selfPlanCompanies = Company::whereIn('id', [3,117,120,121,123,124,125])->get();
        $apiPlanCompanies = Company::whereIn('id', [118])->get();
       // $airports = airport::all()->toArray();

        return view("admin.company.plan_editview",["companies"=>$companies, "selfPlanCompanies" => $selfPlanCompanies,
        "apiPlanCompanies" => $apiPlanCompanies,
        "agent" => $agent]);

    }



    public function getPlanPrices(Request $request,$id){
		
		//DB::enableQueryLog(); 

        $planType = $request->input('plan_type');
        $agentId = $request->input('agent_id');
            $prices = companies_set_price_plan::

            select(DB::raw("companies_set_price_plans.*,c.name as company_name"))

            ->leftJoin('companies as c', 'companies_set_price_plans.cid', '=', 'c.id')

            ->where("companies_set_price_plans.cid",$id)->where("plan_type",$planType)->where("agent_id",$agentId)->get();
			
			//dd(DB::getQueryLog());

            $html ='<table class="table responsive table-hover"><thead><tr><th>Company</th><th>Year</th><th>Month</th><th>Action</th></tr></thead><tbody>';

            foreach ($prices as $key => $value) {

                $monthName = date('F', mktime(0, 0, 0, $value->cmp_month, 10));

                $html .='

                <tr><td>'.$value->company_name.' </td><td>'.$value->cmp_year.'</td><td>'.$monthName.'</td><td>

                  <a id="edit" class="btn btn-info btn-xs" href="setPlan?month='.$value->cmp_month.'&year='.$value->cmp_year.'&cid='.$value->cid.'&plan_type='.$value->plan_type.'&agent_id='.$value->agent_id.'&mode=edit" }}" title="Edit"><i class="fa fa-pencil bigger-120"></i></a>

                  <a id="delete" class="btn btn-danger btn-xs" href="delPlan/'.$value->id.'" title="Delete"><i class="ace-icon  ace-icon fa fa-trash-o bigger-120"></i></a>

                  </td></tr>';

            }

            $html .='</tbody></table>';

            echo $html;

    }

   public function setPlan()
{
    // Get agents excluding ID 7
    $agent = partners::where('id', '!=', 7)->get();

    // Filter companies based on predefined IDs
    $selfPlanCompanies = Company::whereIn('id', [3,117,120,121,123,124,125])->get();
    $apiPlanCompanies = Company::whereIn('id', [118 ])->get();

    return view("admin.company.company_set_plan", [
        "selfPlanCompanies" => $selfPlanCompanies,
        "apiPlanCompanies" => $apiPlanCompanies,
        "agent" => $agent
    ]);
}

    // public function companyprices(Request $request )
    // {
        

    //     return response()->json([
    //         'status' => 'success',
    //         'data' => dd($request)
    //     ], 200);
    // }
    public function valetPlan()
    {

        //return dd("testing");

        $valet = valet::all()->toArray();
        
        return view("admin.company.valet_pricing",["valet"=>$valet]);

    }


    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        //

    }



    /**

     * Display the specified resource.

     *

     * @param  \App\companies_product_price  $companies_product_price

     * @return \Illuminate\Http\Response

     */

    public function show(companies_product_price $companies_product_price)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\companies_product_price  $companies_product_price

     * @return \Illuminate\Http\Response

     */

    public function edit(companies_product_price $companies_product_price)

    {

        //

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\companies_product_price  $companies_product_price

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, companies_product_price $companies_product_price)

    {

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\companies_product_price  $companies_product_price

     * @return \Illuminate\Http\Response

     */

    public function destroy(companies_product_price $companies_product_price)

    {

        //

    }





    public function getProductPricePlanView($id, $plan_type, $agent_id)
    {
        $current_month=date('m');
        $current_year=date('Y');
        // Fetch products with filters applied before converting to array
        $products = companies_products::where("company_id", "=", $id)
                                      ->where("plan_type", "=", $plan_type)
                                      ->get();  
        
           
        return view("admin.company.product_price_plain_view", [
            "products" => $products,
            "id" => $id,
            "plan_type" => $plan_type,
            "agent_id" => $agent_id
        ]);
    }
    


    public function delPlan($id)

    {

//dd($id);

        DB::table('companies_set_price_plans')->where('id', $id)->delete();

        DB::table('companies_set_assign_price_plans')->where('plan_id', $id)->delete();

        return redirect()->back()->with("success","Successfully Delete");



    }



    public function getCompanySetPlanView($id,$year,$month,$plan_type,$agent_id)

    {
        $products = companies_products::all()->where("company_id","=",$id)->where("plan_type","=",$plan_type)->toArray();

       if($agent_id==0){
        $agent_id='';
       }else{
        $agent_id;
       }
        $is_exist = companies_set_price_plan::where("cid", $id)
        ->where("cmp_year", $year)
        ->where("plan_type", $plan_type)
        ->where("cmp_month", $month)
        ->when($agent_id != '', function ($query) use ($agent_id) {
            return $query->where("agent_id", $agent_id);
        })
        ->first();
    

        $p = [];

        $p[""]="Select Brand";

        $p["fully_booked"]="Full Booked";

        $p["fully_closed"]="Fully Closed";



        foreach ($products as $product)

        {

            $p[$product["product_name"]] = $product["product_name"];

        }





        return view("admin.company.company_set_plan_view",["products"=>$p,"id"=>$id,"plan_type"=>$plan_type,"agent_id"=>$agent_id,"month"=>$month,"year"=>$year,"is_exist"=>$is_exist]);

    }




    public function updateValetProductPrices(Request $request){




            $data = [];
            $data2 = [];
            $data3 = [];

            $data["car"] =$request->input("st_car");

            $data["4x4"] =$request->input("st_4");

            $data["mpv"] =$request->input("st_mpv");

            
            
            $data2["car"] =$request->input("ex_car");

            $data2["4x4"] =$request->input("ex_4");

            $data2["mpv"] =$request->input("ex_mpv");


            $data3["car"] =$request->input("pre_car");

            $data3["4x4"] =$request->input("pre_4");

            $data3["mpv"] =$request->input("pre_mpv");


            $updated = valet::where('id', '=', 1)->update($data);
            $updated2 = valet::where('id', '=', 2)->update($data2);
            $updated3 = valet::where('id', '=', 3)->update($data3);
            

            if($updated || $updated2 || $updated3){

                return response()->json(['success' => true, 'message' => "<div class='alert alert-success'><p>Successfully Update Price</p></div>"]);

            }else {

                return response()->json(['success' => false, 'message' => "<div class='alert alert-danger'><p>Error updating price.</p></div>  "]);

            }

    }


    public function updateProductPrices(Request $request){
    
        if($request->input("action")=="add"){

            $data = [];

            $data["brand_name"] =$request->input("product_name");
            $data["plan_type"] = $request->input("plan_type") ;
            $data["brand_id"] =$request->input("product_id");
            if($request->input("agent_id")==0){
                $data["agent_id"]=0;
            }else{
                $data["agent_id"] = $request->input("agent_id");

            }

            $data["cid"] =$request->input("company_id");

            $data["after_30_days"] =$request->input("after_30_days");



            for($i=1;$i<=31;$i++){

                $data["day_".$i] = $request->input("p_day_".$i);

            }





            if(companies_product_price::create($data)){

                return response()->json(['success' => true, 'message' => "<div class='alert alert-success'><p>Successfully Created Price</p></div>"]);

            }else {

                return response()->json(['success' => false, 'message' => "<div class='alert alert-danger'><p>Error Creating Price.</p></div>  "]);

            }





        }

                if($request->input("action")=="update"){

            $data = [];
            $data["brand_name"] =$request->input("product_name");
            $data["brand_id"] =$request->input("product_id");
            $data["cid"] =$request->input("company_id");
            $data["plan_type"] = $request->input("plan_type");
            if($request->input("agent_id")==0){
                $data["agent_id"]=0;
            }else{
                $data["agent_id"] = $request->input("agent_id");

            }
            
            $data["after_30_days"] =$request->input("after_30_days");

            for($i=1;$i<=31;$i++){
                $data["day_".$i] = $request->input("p_day_".$i);
            }

            $product_check = companies_product_price::select('id', 'brand_id')
            ->where('cid', '=', $request->input("company_id"))
            ->where('brand_id', '=', $request->input("product_id"))
            ->where('plan_type', '=', $request->input("plan_type")) // Fixing column name
            ->first();
        
        if ($product_check && $request->input("agent_id") != 0) {
            $product_check = companies_product_price::select('id', 'brand_id')
                ->where('cid', '=', $request->input("company_id"))
                ->where('brand_id', '=', $request->input("product_id"))
                ->where('plan_type', '=', $request->input("plan_type")) // Fixing column name
                ->where("agent_id", "=", $request->input("agent_id"))
                ->first();
        }
        
        
             
            //echo "<pre>"; print_r($product_check); echo "</pre>"; exit;
            if(isset($product_check['id'])){
                //echo "found";
                $updated = companies_product_price::where('cid', '=', $request->input("company_id"))->where('brand_id', '=', $request->input("product_id"))->where('plan_type', '=', $request->input("plan_type"))->update($data);
                if($updated){
                    return response()->json(['success' => true, 'message' => "<div class='alert alert-success'><p>Successfully Update Price</p></div>"]);
                }else {
                    return response()->json(['success' => false, 'message' => "<div class='alert alert-danger'><p>Error updating price.</p></div>  "]);
                }
            }else{
                $query = DB::table('companies_product_prices')
                ->where('cid', '=', $request->input("company_id"))
                ->where('brand_name', "=", $request->input("product_name"))
                ->where('plan_type', '=', $request->input("plan_type"));

            // Apply agent_id condition if it's not 0
            if ($request->input("agent_id") != 0) {
                $query->where("agent_id", "=", $request->input("agent_id"));
            }

            $query->delete();
            
                 
                $added = companies_product_price::create($data);
                if($added){
                    return response()->json(['success' => true, 'message' => "<div class='alert alert-success'><p>Successfully Add Price</p></div>"]);
                }else {
                    return response()->json(['success' => false, 'message' => "<div class='alert alert-danger'><p>Error Adding price.</p></div>  "]);
                }
            }
        }


    }





    public function setCompanyPlanPrices(Request $request){

        if($request->input("action")=="add") {

            $data = [];

            $data["cid"] = $request->input("id");

            $data["cmp_month"] = $request->input("month");
            $data["plan_type"] = $request->input("plan_type");
            if($request->input("agent_id")==''){
                $data["agent_id"]="0";
            }else{
                $data["agent_id"] = $request->input("agent_id");

            }

            $data["cmp_year"] = $request->input("year");

            $extra= $request->input("extra");

            if($extra==""){

                $extra= 0;

            }

            $data["extra"] = $extra;





            if ($plain_id = companies_set_price_plan::create($data)) {

              $plain_id = $plain_id->id;

                $data = [];

                $data["plan_id"] = $plain_id;



                for ($i = 1; $i <= 31; $i++) {

                    $data["day_no"] = "day_" . $i;

                    $data["brand_name"] = $request->input("p_day_" . $i);

                    companies_set_assign_price_plan::create($data);

                }

               // print_r($data); die();







                return response()->json(['success' => true, 'message' => "<div class='alert alert-success'><p>Successfully Update Price</p></div>"]);

            } else {

                return response()->json(['success' => false, 'message' => "<div class='alert alert-danger'><p>Error updating price.</p></div>  "]);

            }



        }



        if($request->input("action")=="update"){

            $data = [];

            $data["cid"] = $request->input("id");

            $data["cmp_month"] = $request->input("month");
            if($request->input("agent_id")==''){
                $data["agent_id"]="0";
            }else{
                $data["agent_id"] = $request->input("agent_id");

            }
            $data["cmp_year"] = $request->input("year");
            $data["plan_type"] = $request->input("plan_type");

            $extra= $request->input("extra");

            if($extra==""){

                $extra= 0;

            }

            $data["extra"] = $extra;







            $updated = companies_set_price_plan::where('id', "=",$request->input("plain_id"))->update($data);



            if($updated){

                DB::table('companies_set_assign_price_plans')->where('plan_id', "=",$request->input("plain_id"))->delete();



                $data = [];

                $data["plan_id"] =$request->input("plain_id");
              



                for ($i = 1; $i <= 31; $i++) {

                    $data["day_no"] = "day_" . $i;

                    $data["brand_name"] = $request->input("p_day_" . $i);

                    companies_set_assign_price_plan::create($data);

                }





                return response()->json(['success' => true, 'message' => "<div class='alert alert-success'><p>Successfully Update Price</p></div>"]);

            }else {

                return response()->json(['success' => false, 'message' => "<div class='alert alert-danger'><p>Error updating price.</p></div>  "]);

            }



        }

    }

}

