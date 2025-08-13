<?php



namespace App\Http\Controllers;



use App\Models\roles;

use App\Models\partners;
use App\Models\User;
use App\Models\ApiClient;

use App\Models\users_menus;

use App\Models\users_roles;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Input;

use Illuminate\Support\Facades\Validator;





class UserController extends Controller

{

    //

    public $pages = ["Dashboard", "Daily Operations", "Companies", "Plan Setting", "Set Plan","Company Commision Reports","Detail Commision Reports", "Booking","Booking List","All Booking","Banner","Invoice All","Operations Invoices", "Add Booking", "Incomplete Booking","Booking Histroy","Valet Pricing Plan","Text Pages","Dsp","Dsp View","Price Plan","Valet Request Report","Set Plan","Airports","Companies","Reports","Departure Report","Return Report","Departure and Return Report","Day Wise Report", "Over Night","Print Cards","Company Setting","Awards","Setting","Pages", "Reviews", "Faqs", "Subscribers", "Settings", "Email Settings", "Seo Settings", "Footer Settings", "Social Settings", "Analytics Settings", "General Settings", "Email Templates", "Ticketing System", "Parsed Emails","Discount Codes", "Price Statistics Report", "Agent Booking"];







    public $permissions = ["add", "edit", "delete", "view", "Sources", "SMS", "Email", "Cancel", "Refund", "Downloads", "Amounts", "Assign Ticket","Totals"];



    public function __construct()

    {

        $this->middleware('auth');



    }



    public function index(Request $request)

    {

        set_time_limit(0);

        $users = new User();

        $users = $users->select(DB::raw("users.*,r.name as rolename"));

        $users = $users->leftJoin("users_roles as ur","ur.user_id","=","users.id");

        $users = $users->leftJoin("roles as r","r.id","=","ur.role_id");

        if ($request->has("name")) {

            $name = $request->input("name");

            $users = $users->where("name", $name);

        }

        //dd($users->toSql(););

        $users = $users->get();



        return view("admin.users.list", ["users" => $users]);

    }



    public function register_form()

    {



        $roles = roles::all()->toArray();





        $rolesList = [];

        $rolesList[""] = "Select Role";

        foreach ($roles as $u) {

            $rolesList[$u["id"]] = $u["name"];

        }



        return view("admin.users.create", ["rolesList" => $rolesList, "permissions" => $this->permissions, "pages" => $this->pages]);

    }





    public function edit_register_form($id)

    {



        $user = User::findOrFail($id);



        $roles = roles::all()->toArray();



        $users_permissions  =  users_roles::where("user_id", $user->id)->first();

        $users_hide_pages  =  users_menus::where("user_id", $user->id)->get();

        $role_id=0;

        $userspermissions=[];
        $bk_source=[];


        if($users_permissions){



            $role_id =$users_permissions->role_id;

            $userspermissions =explode(",",$users_permissions["permissions"]);

        }

        if($users_permissions){
            $role_id =$users_permissions->role_id;
            $bk_source =explode(",",$users_permissions["bk_source"]);
        }

        $users_hide_pages_list = [];

       // dd($users_hide_pages);

        foreach ($users_hide_pages as $u) {



            $users_hide_pages_list[$u->id] = $u->menu_name;

        }



        $rolesList = [];

        $rolesList[""] = "Select Role";

        foreach ($roles as $u) {

            $rolesList[$u["id"]] = $u["name"];

        }

        $sourceList = array("all"=>"All",
        "paid"=>"Paid",
        "ORG"=>"Organic",
        "API"=>"API",
        "PPC"=>"PPC",
        "BING"=>"BING",
        "EM"=>"E Marketing",
        "POR"=>"POR",
        "FB"=>"FaceBook",
        "Ln"=>"LinkedIn",
        "In"=>"Instagram",
        "G+"=>"Google+",
        "Pi"=>"Pinterest",
        "Tw"=>"Twitter",
        "Yt"=>"Youtube",
        "Blg"=>"Blogging",
        "BK"=>"Backend",
        "Agent"=>"Agent");



        return view("admin.users.edit", ["rolesList" => $rolesList, "permissions" => $this->permissions,"bk_source" => $bk_source, "sourceList"=>$sourceList , "pages" => $this->pages, "user" => $user,"userspermissions"=>$userspermissions,"users_hide_pages_list"=>$users_hide_pages_list,"role_id"=>$role_id]);

    }







    public function update_user(Request $request,$id){

        $User = User::findOrFail($id);



        $messages = [

            'required' => 'This field is required.'

        ];

        $request->validate([

            'name' => 'required|max:255',

             'role_id'=>'required',

            'email' => 'required|email|max:255'

           



        ], $messages);







        $User->name = $request->input("name");

        $User->email = $request->input("email");

        if(!empty($request->input("password"))) {

            $User->password = Hash::make($request->input("password"));

        }

        $User->active = $request->input("status");

        //$userdata = $User->save();

        if ($User->save()) {

            //print_r($User); die();



            $user_id = $User->id;

            //insert user role and permissions

            $role_id = $request->input("role_id");



            $permissions = "";
            $bk_source = "";
            if (count($request->input("permissions")) > 0) {

                $permissions = implode(",", $request->input("permissions"));

            }

            
            if (count($request->input("bk_source")) > 0) {
                $bk_source = implode(",", $request->input("bk_source"));
            }
            $data = array("user_id" => $user_id, "role_id" => $role_id, "permissions" => $permissions,'bk_source'=>$bk_source);



            if (count($data) > 0) {

               // DB::table("")->delete()

                users_roles::where('user_id', '=' ,$id)->delete();



                DB::table('users_roles')->insert($data);

            }



            //insert pages or menu

            $data = [];

            if ($request->input("pages")!=""){

             if (count($request->input("pages")) > 0) {

                 foreach ($request->input("pages") as $page) {

                     if ($page != "") {

                         $data[] = array("user_id" => $user_id, "menu_name" => $page);

                     }

                 }

             }

        }





            if (count($data) > 0) {

                users_menus::where('user_id', '=' ,$id)->delete();

                DB::table('users_menus')->insert($data);

            }



            return redirect(route("user_list"))->with('success', 'Data Update  successfully');



        }





    }

    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request $request

     * @return \Illuminate\Http\Response

     */

    public function register(Request $request)

    {

        //

        // dd($request->all());

        $messages = [

            'required' => 'This field is required.'

        ];

        $request->validate([

            'name' => 'required|max:255',

            'email' => 'required|email|max:255|unique:users',

            'role_id'=>'required',

            'password' => 'required_with:confirm_password|same:confirm_password',



        ], $messages);



        $User = new User();

        $User->name = $request->input("name");

        $User->email = $request->input("email");

        $User->password = Hash::make($request->input("password"));

        $User->active = $request->input("status");

        //$userdata = $User->save();

        if ($User->save()) {

            //print_r($User); die();

            $data = [];

            $user_id = $User->id;

            //insert user role and permissions

            $role_id = $request->input("role_id");

            $permissions = "";
            $bk_source = "";
            if (count($request->input("permissions")) > 0) {

                $permissions = implode(",", $request->input("permissions"));

            }

            if (count($request->input("bk_source")) > 0) {
                $bk_source = implode(",", $request->input("bk_source"));
            }
            
            $data[] = array("user_id" => $user_id, "role_id" => $role_id, "permissions" => $permissions, "bk_source" => $bk_source);



            if (count($data) > 0) {

                DB::table('users_roles')->insert($data);

            }



            //insert pages or menu

            $data = [];

            if ($request->input("pages")!=""){

            if (count($request->input("pages")) > 0) {

                foreach ($request->input("pages") as $page) {

                    if ($page != "") {

                        $data[] = array("user_id" => $user_id, "menu_name" => "$page");

                    }

                }

            }

        }





            if (count($data) > 0) {

                DB::table('users_menus')->insert($data);

            }



        }

        return redirect(route("user_list"))->with('success', 'Data Inserted  successfully');

    }



    public function getRolesPermissions($role_name)

    {



        $data = roles::where("name", $role_name)->get();

        $per_arr = ["add", "edit", "delete", "view", "Sources", "SMS", "Email", "Cancel", "Refund", "Downloads", "Amounts"];



        if ($data) {

            if ($data[0]->permissions != null) {

                $permissions = explode(",", $data[0]->permissions);

                foreach ($per_arr as $permission) {

                    //$per_arr[] = $permission;

                    $checked = "";

                    if (in_array($permission, $permissions)) {

                        $checked = "checked='checked'";

                    }



                    echo '<input type="checkbox" name="permissions[]" ' . $checked . ' value="' . $permission . '" >';

                    echo ucfirst($permission) . " <br/>";

                }

            }

        }

        //return response()->json($per_arr);

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  \App\airport $airport

     * @return \Illuminate\Http\Response

     */

    public function delete($id)

    {

        //



        DB::table('users')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Information Deleted successfully');



    }

   
public function api_client()
{
    $users = ApiClient::with('partner')->get(); // Eager load partner details
    return view("admin.users.api_client", compact('users'));
}
public function register_api_client ()
{
    $agents = Partners::where('id', '!=', 7)->pluck('username', 'id'); // Fetch agents as key-value pair

    return view("admin.users.api_client_register", compact('agents')); 
}
 
 
public function storeapiclient(Request $request)
{
    $request->validate([
        
        'email' => 'required|email|max:255|unique:api_client,email',
        'access_token' => 'required|string|max:255',
        
    ]);
    

     ApiClient::create([
        'name' => $request->name,
        'email' => $request->email,
        'access_token' => $request->access_token,
        'supplier_id' => $request->agent_id,
        'status' => $request->status,
    ]);

    return redirect()->route('api_client')->with('success', 'API Client created successfully!');
}

public function deleteapiclient(Request $request,$id)
{
 $client = ApiClient::find($id);
if ($client) {
    $client->delete();
}    return redirect()->back()->with('success', 'Information Deleted successfully');
}

public function edit_api_client($id) 
{
    $user = ApiClient::with('partner')->where('id', $id)->firstOrFail(); 
    $agents = Partners::where('id', '!=', 7)->pluck('username', 'id'); // Fetch agents as key-value pair
    return view("admin.users.api_client_edit", compact('user', 'agents')); 
}
public function editapiclient(Request $request, $id)
{
    // Validate input
    $request->validate([
        'email' => 'required|email|max:255|unique:api_client,email,' . $id,
        'access_token' => 'required|string|max:255',
    ]);

    // Find the existing record
    $apiClient = ApiClient::findOrFail($id);

    // Update fields
    $apiClient->update([
        'name' => $request->name,
        'email' => $request->email,
        'access_token' => $request->access_token,
        'supplier_id' => $request->agent_id,
        'status' => $request->status,
    ]);

    return redirect()->route('api_client')->with('success', 'API Client updated successfully!');
}


}

