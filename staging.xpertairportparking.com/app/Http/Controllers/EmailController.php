<?php



namespace App\Http\Controllers;

use App\Models\email_templates;
use App\Models\modules_settings;
use App\Models\settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Google\Client as GoogleClient;
use Google\Service\Gmail;
use Google\Service\Gmail\Message;



class EmailController extends Controller

{
    public function testEmail()
    {
        $toEmail = "marketingfiveg@gmail.com"; // Change this to your test email
        $subject = "Test Email from MZT";
        $body = "This is a test email to check SMTP settings.";

        try {
            Mail::raw($body, function ($message) use ($toEmail, $subject) {
                $message->to($toEmail)
                        ->subject($subject)
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });

            return "Test email sent successfully to " . $toEmail;
        } catch (\Exception $e) {
            return "Error sending email: " . $e->getMessage();
        }
    }
    public $_setting = [];


 public function __construct()
{
    $modules_settings = settings::all();

    foreach ($modules_settings as $setting) {
        $this->_setting[$setting->field_name] = $setting->field_value;
    }

    config([
        'mail.mailer' => 'smtp',
        'mail.host' => $this->_setting["email_host"],
        'mail.port' => $this->_setting["email_port"],
        'mail.encryption' => $this->_setting["email_encryption_type"],
        'mail.username' => $this->_setting["email_username"],
        'mail.password' => $this->_setting["email_password"],
        'mail.from.address' => $this->_setting["email_username"], // Ensure this is set
        'mail.from.name' => 'Xpert Airport Parking', // Custom name
    ]);



}





    public function get_template($template_title, $template_data = [])

    {

        $template = email_templates::where("title", $template_title)->first();
        //dd($template);

        $data = $template["description"];

        if (count($template_data) > 0) {

            foreach ($template_data as $key => $val) {

                $data = str_replace('[' . $key . ']', $val, $data);
            }
        }

        return ["data" => $data, "subject" => $template["subject"]];
    }



    public function send()

    {

        $template_data = [];

        $template_data["username"] = "Ali";

        $template_data["ref"] = "1000022222000";

        //$this->sendEmail("Update Booking", "pakingzone@gmail.com", "pakingzone@gmail.com", $template_data);
        $this->sendEmail("Update Booking", "helpdesk@xpertairportparking.com", "helpdesk@xpertairportparking.com", $template_data);
    }



public function sendEmail($template_title, $to, $template_data)
{
    $template = $this->get_template($template_title, $template_data);
     
    try {
        Mail::send([], [], function ($message) use ($template, $to) {
            $message->from($this->_setting["email_username"], 'Xpert Airport Parking');
            $message->to($to);
            $message->subject($template["subject"]);
    $message->html($template["data"], 'text/html');
        });

        return response()->json(['message' => 'Email sent successfully']);
    } catch (\Exception $e) {
        \Log::error('Error sending email', ['error' => $e->getMessage()]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



    // public function sendEmail($template_title, $to, $template_data)

    // {
       

    //     set_time_limit(0);
    //     $template = $this->get_template($template_title, $template_data);
        
    //     try {
    //         Mail::send([], [], function ($message) use ($template, $to) {
    //             $message->from($this->_setting["email_username"], 'Manchester Airport Spaces');
    //             $message->to($to);
    //             $message->subject($template["subject"]);
    //             $message->setBody($template["data"], 'text/html');
    //         });
    //     } catch (\Exception $e) {
    //         Log::error('Error sending email', ['error' => $e->getMessage()]);
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }


    //     return true;
    // }



  public function sendEmailWithFile($template_title, $to, $template_data, $pathToFile)
{
    set_time_limit(0);
    $template = $this->get_template($template_title, $template_data);

    try {
        Mail::send([], [], function ($message) use ($template, $to, $pathToFile) {
            $message->from($this->_setting["email_username"], 'Xpert Airport Parking');

        
            if (is_array($to)) {
                $message->to($to); 
            } else {
                $message->to(trim($to));  
            }

            $message->subject($template["subject"]);
            $message->html($template["data"]);

        
            if (!empty($pathToFile) && file_exists($pathToFile)) {
                $message->attach($pathToFile);
            }
        });

        return response()->json(['message' => 'Email sent successfully']);
    } catch (\Exception $e) {
        \Log::error('Error sending email with attachment', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    
    public function sendGmail($template_title, $to, $template_data)
{
    $template = $this->get_template($template_title, $template_data);

    $subject = $template['subject'];
    $body = $template['data'];

    try {
        Mail::send([], [], function ($message) use ($to, $subject, $body) {
            $message->to($to)
                    ->subject($subject)
                    ->html($body) // ✅ Correct method to set HTML body
                    ->from(config('mail.from.address'), config('mail.from.name')); // Explicit from
        });

        return response()->json(['message' => 'Email sent successfully']);
    } catch (\Exception $e) {
        \Log::error('Error sending email', ['error' => $e->getMessage()]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
public function sendGmailWithAttachment($template_title, $to, $template_data, $attachmentPath)
{
    $template = $this->get_template($template_title, $template_data);

    $subject = $template['subject'];
    $body = $template['data'];

    try {
        Mail::send([], [], function ($message) use ($to, $subject, $body, $attachmentPath) {
            $message->to($to)
                    ->subject($subject)
                    ->html($body) // ✅ Correct way for HTML content
                    ->from(config('mail.from.address'), config('mail.from.name')); // Explicit from

            if ($attachmentPath && file_exists($attachmentPath)) {
                $message->attach($attachmentPath);
            }
        });

        return response()->json(['message' => 'Email sent successfully']);
    } catch (\Exception $e) {
        \Log::error('Error sending email', ['error' => $e->getMessage()]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

   
    
    private function createMessageWithAttachment($fromName, $fromEmail, $to, $subject, $body, $attachmentPath)
    {
        $email = new Message();
        $rawMessage = $this->createRawMessageWithAttachment($fromName, $fromEmail, $to, $subject, $body, $attachmentPath);
        
        $email->setRaw($rawMessage);
        $email->setLabelIds(['SENT']);
        
        return $email;
    }
    
    private function createRawMessageWithAttachment($fromName, $fromEmail, $to, $subject, $body, $attachmentPath)
    {
        $boundary = uniqid(rand(), true);
        
        // Create the main part of the message
        $message = "--{$boundary}\r\n";
        $message .= "Content-Type: text/html; charset=utf-8\r\n";
        $message .= "\r\n";
        $message .= $body . "\r\n";
        
        // Add the attachment
        $attachmentContent = file_get_contents($attachmentPath);
        $base64Attachment = base64_encode($attachmentContent);
        $attachmentName = pathinfo($attachmentPath, PATHINFO_BASENAME);
        
        $message .= "--{$boundary}\r\n";
        $message .= "Content-Type: application/octet-stream; name=\"{$attachmentName}\"\r\n";
        $message .= "Content-Disposition: attachment; filename=\"{$attachmentName}\"\r\n";
        $message .= "Content-Transfer-Encoding: base64\r\n";
        $message .= "\r\n";
        $message .= $base64Attachment . "\r\n";
        
        $message .= "--{$boundary}--\r\n";
        
        // Construct the raw message
        $rawMessage = "From: \"$fromName\" <$fromEmail>\r\n";
        $rawMessage .= "To: $to\r\n";
        $rawMessage .= "Subject: $subject\r\n";
        $rawMessage .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n\r\n";
        $rawMessage .= $message;
        
        return base64_encode($rawMessage);
    }

}