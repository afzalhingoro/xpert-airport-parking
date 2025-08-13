<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ref_tracking extends Model
{
    //
    protected $fillable = ["id","ref_url","current_url","user_ip","m_source","created_at","updated_at","is_internal_url"];

}
