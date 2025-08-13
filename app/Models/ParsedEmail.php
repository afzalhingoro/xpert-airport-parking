<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParsedEmail extends Model
{
    protected $table = 'parsed_emails_report';  
    
    protected $fillable = [
        "ref_no", "agent_email", "phone_number", "booking_email_time", "cron_start_time", "cron_end_time", "status"
    ];
}
