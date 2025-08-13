<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoyaltyPlan extends Model
{
    protected $table = 'loyatly_plans';

    public function customer()
    {
        return $this->belongsTo(customers::class);
    }
}
