<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalBooking extends Model
{
     protected $table = 'external_bookings';
     
    public  function partner()
    { 
        return $this->belongsTo("App\Models\partners", "agentID");
    }
    
   
}
