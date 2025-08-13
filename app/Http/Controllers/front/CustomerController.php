<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\EmailController;
use App\Models\modules_settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use DateTime;
use App\Library\aph_functions;
use Symfony\Component\Console\Terminal;
use Illuminate\Support\Facades\URL;
use Session;
use App\Models\LoyaltyPlan;
use App\Models\User;
use App\Models\airports_bookings;
use App\Models\customers;
use Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Carbon\Carbon;
use Carbon\CarbonInterface;
use Carbon\CarbonInterval;
use Carbon\Exceptions\InvalidFormatException;


class CustomerController extends Controller
{


    public $_setting = [];
    public $_settings = [];
    public $_module_setting = [];

    function __construct()
    {
    }

    public function save(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        // add in users tables
        // $user = User::create([
        //     'name' => $data['first_name'] . ' ' . $data['last_name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     'is_customer' => 1,
        // ]);

        // add in customer tables
        $customer = customers::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::guard('customer')->login($customer);
        return redirect("/");
    }


    public function loginCheck(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve customer by email
        $customer = Customers::where('email', $request->email)->first();

        if (!$customer) {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        // Check if password is MD5 and verify manually
        if (strlen($customer->password) === 32 && ctype_xdigit($customer->password)) {
            // If it's an MD5 hash, check manually
            if ($customer->password === md5($request->password)) {
                // Rehash and update to Bcrypt
                $customer->password = Hash::make($request->password);
                $customer->save();
                
                Auth::guard('customer')->login($customer, $request->remember);
                return redirect()->route('main');
            }
        } 
        // Otherwise, use standard Hash::check for Bcrypt passwords
        elseif (!Hash::check($request->password, $customer->password)) {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

        // Log in the customer
        Auth::guard('customer')->login($customer, $request->remember);
        return redirect()->route('main');

    } catch (Exception $e) {
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}
    
    
    public function customerLoyaltyPlan($customer){
       
        $currentPlanId = $customer->loyalty_planID;
        $checkTotalBookings = airports_bookings::where('email',$customer->email)->where('traffic_src','ORG')->count();
        $regDate = date('Y-m-d', strtotime($customer->created_at));
        $now = Carbon::now();
        $totalYear = $now->diffInYears($regDate);
        $data= array();
        
        if($checkTotalBookings >= 4 && $totalYear < 3 && $currentPlanId == null){
            $data['loyalty_planID'] = 1;
            session()->put('promo', 'ASP-Og-LoyalCrRqU' );
        }elseif($checkTotalBookings > 5  && $totalYear >= 3 && $currentPlanId == 1){
            $data['loyalty_planID'] = 2;
            session()->put('promo', 'ASP-Og-Loyal-waUb' );
        }elseif($checkTotalBookings >= 20 &&  $totalYear >= 7 && $currentPlanId == 2){
            $data['loyalty_planID'] = 3;
            session()->put('promo', 'ASP-Og-Loyal-FnWa' );
        }
        
        $update = customers::where('email', $customer->email)->update($data);
        
        
        return true;
    }
    
    public function applyCustomerLoyaltyPlan($customer){
       
        $currentPlanId = $customer->loyalty_planID;
        $checkTotalBookings = airports_bookings::where('email',$customer->email)->where('traffic_src','ORG')->count();
        $regDate = date('Y-m-d', strtotime($customer->created_at));
        $now = Carbon::now();
        $totalYear = $now->diffInYears($regDate);
        $data= array();
        
        if($checkTotalBookings >= 4 && $totalYear < 3 && $currentPlanId == 1){
            session()->put('promo', 'ASP-Og-LoyalCrRqU' );
        }elseif($checkTotalBookings > 5  && $totalYear >= 3 && $currentPlanId == 2){
            session()->put('promo', 'ASP-Og-Loyal-waUb' );
        }elseif($checkTotalBookings >= 20 &&  $totalYear >= 7 && $currentPlanId == 3){
            session()->put('promo', 'ASP-Og-Loyal-FnWa' );
        }
        
        
        
        
        return true;
    }


    public function submitForgetPassword(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users',
            ]);

            $token = Str::random(20);

            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);

            // $email_send = new EmailController();
            // $email_send->sendEmail("Reset password", $request->email, $token);


            return response()->json([
                'status' => true,
                'msg' => 'password reset link sent',
            ]);

            //   return back()->with('message', 'We have e-mailed your password reset link!');

        } catch (Exception $e) {
            return $e;
        }
    }


    public function submitResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6',
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where(['email' => $request->email])->delete();

        return response()->json([
            'status' => true,
            'msg' => 'password updated Successfully',
        ]);
    }

    public function logout(Request $request)
    {

        Auth::guard("customer")->logout();
        Session::flush();
        return redirect()->route("main");
    }

    public function showResetForm(Request $request, $token = null)
    {

        return view('frontend.password.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    protected function broker()
    {
        return Password::broker('customer');
    }

    protected function guard()
    {
        return Auth::guard('customer');
    }

    public function reset(Request $request, $token = null)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ], [
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email' => $request->email,
            'token' => $request->token
        ])->first();
        if (!$check_token) {
            return redirect()->back()->with('error', 'Error while validation request');
        } else {
            $customer = customers::where('email', $request->email)->first();
            if ($customer) {
                $customer->password = Hash::make($request->password);
                $customer->save();
                DB::table('password_resets')->where([
                    'email' => $request->email,
                    'token' => $request->token
                ])->delete();
                return redirect()->route('customer-login')->with('passsuccessreset', 'Password has been reset');
            } else {
                return redirect()->back()->with('error', 'Invalid email address');
            }
        }
    }



    protected function credentials(Request $request)
    {

        return $request->only(
            'email',
            'password',
            'password_confirmation',
            'token'
        );
    }

    protected function resetPassword($customer, $password)
    {
        dump('resetPassword');
        $customer->password = bcrypt($password);
        $customer->save();
    }
}
