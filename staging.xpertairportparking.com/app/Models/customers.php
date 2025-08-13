<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;

class customers extends Authenticatable

{
    use Notifiable, CanResetPassword;

    protected $fillable = ["title", "first_name", "last_name", "email", "phone_number", "password", "loyalty_planID", "postal_code", "address", "address2", "town", "status", "created_at", "updated_at"];

    public function loyaltyPlan()
    {
        return $this->belongsTo(LoyaltyPlan::class, 'loyalty_planID');
    }
}
