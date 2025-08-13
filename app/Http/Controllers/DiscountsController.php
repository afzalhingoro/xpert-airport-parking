<?php



namespace App\Http\Controllers;

use App\Models\airport;

use App\Models\users_roles;

use Illuminate\Support\Facades\Auth;

use App\Models\airports_terminals;

use App\Models\Awards;

use App\Models\companies_assign_awards;

use App\Models\companies_products;

use App\Models\companies_special_features;

use App\Models\Company;

use App\Models\facilities;

use App\Models\User;

use App\Models\discounts;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;



class DiscountsController extends Controller

{

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index(Request $request)

    {

       
        $role_nam = users_roles::get_user_role(Auth::user()->id)->name;
        $discounts = new discounts();



          if ($request->has("parking_type")) {

            $name = $request->input("parking_type");



            if ($name != "" && $name != "all") {

                $discounts = $discounts->where('parking_type', '=',$name );

              

            }

        } 





        if ($request->has("discount_for")) {

            $name = $request->input("discount_for");



            if ($name != "" && $name != "all") {

                $discounts = $discounts->where('discount_for', '=',$name );

              

            }

        } 





        if ($request->has("status")) {

            $name = $request->input("status");



            if ($name != "" && $name != "all") {

                $discounts = $discounts->where('status', '=',$name );

              

            }

        } 




        if($role_nam == 'Operations' || $role_nam == 'Controller'){
        $discounts = $discounts->where("discount_for","BK")->orderByDesc('id')->get();
        }else{
        $discounts = $discounts->orderByDesc('id')->get();    
        }
        // $discounts = date("d-m-Y",strtotime($discounts->start_date));

        // $discounts =date("d-m-Y",strtotime($discounts->end_date));
        
       

        return view("admin.discounts.list", ["discounts" => $discounts, "role_nam" => $role_nam]);

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

    $role_nam = users_roles::get_user_role(Auth::user()->id)->name;

       return  view("admin.discounts.create",["role_nam" => $role_nam]);

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





        $messages = [

            'required' => 'This field is required.',

        ];

        $validatedData = $request->validate([

            'parking_type' => 'required|string',

            'discount_for' => 'required|string',

            'pre_promo' => 'required|string',

            'promo' => 'required|string',

            'status' => 'required|string',

            'discount_type' => 'required|string',

            'discount_value' => 'required|string',

            'start_date' => 'required|string',

            'end_date' => 'required|string'

        ], $messages);

$date = explode('/', $request->input("start_date"));
$date1 =  explode('/', $request->input("end_date"));



        $discounts = new discounts();

        $discounts->promo = $request->input("pre_promo")."-".$request->input("promo");

        $discounts->status = "Yes";

        $discounts->discount_campaign = "General";

        $discounts->start_date = $date[2].'-'.$date[1] .'-'. $date[0];

        $discounts->end_date = $date1[2].'-'.$date1[1] .'-'. $date1[0];



        $discounts->discount_value = $request->input("discount_value");

        $discounts->discount_type = $request->input("discount_type");

        $discounts->parking_type = $request->input("parking_type");

        $discounts->discount_for = $request->input("discount_for");
        $discounts->admin_id = Auth::user()->id;



        if ($discounts->save()) {

            return redirect(route("discounts.index"))->with('success', 'Data Inserted  successfully');

        }

    }



    /**

     * Display the specified resource.

     *

     * @param  \App\discounts  $discounts

     * @return \Illuminate\Http\Response

     */

    public function show(discounts $discounts)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  \App\discounts  $discounts

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //


        $role_nam = users_roles::get_user_role(Auth::user()->id)->name;
        $model = discounts::findOrFail($id);





        return view("admin.discounts.edit",["discount"=>$model, "role_nam" => $role_nam]);

    }



    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request  $request

     * @param  \App\discounts  $discounts

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {
        //
     

        $discounts = discounts::findOrFail($id);

        $messages = [

            'required' => 'This field is required.',

        ];

        $validatedData = $request->validate([



            'parking_type' => 'required|string',

            'discount_for' => 'required|string',



            'promo' => 'required|string',

            'status' => 'required|string',

            'discount_type' => 'required|string',

            'discount_value' => 'required|string',

            'start_date' => 'required|string',

            'end_date' => 'required|string'

        ],$messages);


$date = explode('/', $request->input("start_date"));
$date1 =  explode('/', $request->input("end_date"));




        $discounts->promo = $request->input("pre_promo")."-".$request->input("promo");

        $discounts->status = $request->input("status");
        if(isset($date[2]))
        {
              $discounts->start_date = $date[2].'-'.$date[1] .'-'. $date[0];
        }
        else
        {
        $discounts->start_date = date("Y-m-d",strtotime($request->input("start_date")));
        }
         if(isset($date1[2]))
        {
             $discounts->end_date = $date1[2].'-'.$date1[1] .'-'. $date1[0];
        }
        else
       {
               $discounts->end_date =date("Y-m-d",strtotime($request->input("end_date")));
       }
    

      

 

     


        $discounts->discount_value = $request->input("discount_value");

        $discounts->discount_type = $request->input("discount_type");

        $discounts->parking_type = $request->input("parking_type");

        $discounts->discount_for = $request->input("discount_for");

        if ($discounts->save()) {

            return redirect(route("discounts.index"))->with('success', 'Data Updated  successfully');

        }

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\discounts  $discounts

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

        $aid = $id;

        DB::table('discounts')->where('id', $aid)->delete();

        return redirect()->back()->with('success', 'Information Deleted successfully');

    }

}

