<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailUser;
use App\Jobs\SendEmailTest;

class EmailNewController extends Controller
{
	public function send_email()
	{
	   $user_name = 'fullstack';
	   $to = 'fullstack@seedanalytica.com';
	   //Mail::to($to)->send(new MailUser($user_name));
	   //https://www.itsolutionstuff.com/post/how-to-create-queue-with-mail-in-laravel-5-example.html
	   //nohup php artisan queue:work --daemon > /dev/null 2>&1 &
	   
        $details['email'] = $to;
        $details['name'] = $user_name;
        
        
        dispatch(new SendEmailTest($details));
        
        return 'Mail sent successfully';
	}
}
?>