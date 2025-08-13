<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class valet extends Model
{
    //
    protected $table = 'valeting';
    public $timestamps = false;
    protected $fillable = ["pkg","car","4x4","mpv"];

    public function bookings()
    {
        return $this->hasMany("App\Models\airports_bookings","valet_id");
    }
}
