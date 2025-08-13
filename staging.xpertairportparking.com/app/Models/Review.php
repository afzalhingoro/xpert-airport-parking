<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
