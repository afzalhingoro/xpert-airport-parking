<?php



namespace App\Http\Controllers;



use App\Models\airport;
use App\Models\customers;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class CustomerLoginController extends Controller

{

    public function index()
    {
        if(Auth::guard('customer')->user()){
           return redirect(route('customer-admin'));
            
        }else{
        return view("layouts.customer_login");
        }
    }

    public function register_customer()
    {
        return view("layouts.register_customer");
    }

    public function forget_customer_pasword()
    {

        return view("layouts.forget_customer_pasword");
    }

    public function change_password()
    {
        return view("layouts.change_customer_password");
    }

    public function sendResetPasswordEmail(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'The email is required.',
        ]);
        $exists_email = customers::where('email', $request->email)->first();
        if ($exists_email) {
            try {
                $token = Str::random(65);
                DB::table('password_resets')->insert([
                    'email' => $exists_email->email,
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
                $resetLink = route('customer.password.reset', ['token' => $token, 'email' => $exists_email->email]);
                $template_data["username"] = $exists_email->first_name . ' ' .$exists_email->last_name;
                $template_data["resetLink"] = "<a href='".$resetLink."'>Click Here</a>";
                $email_send = new EmailController();
                $toemails = [$exists_email->email, 'bookings@airsideparking.uk'];
                foreach ($toemails as $email) {
                    $email_send->sendGmail("Forgot Password", $email, $template_data);
                }
            } catch (Exception $error) {
                return redirect()->back()->with('error', 'A Error Occure while sending email');
            }
        }else{
            return redirect()->back()->with('resetsuccess', 'No account found for the given email');
        }
        return redirect()->back()->with('resetsuccess', 'A Reset Password Email has been sent');
    }
}
