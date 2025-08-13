<?php

namespace App\Models;
use App\Models\partners;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiClient extends Model
{
    use HasFactory;

    protected $table = 'api_client';
    public $timestamps = false; // Disable Laravel's automatic timestamps
 
    protected $fillable = [
        'name',
        'email',
        'supplier_id',
        'status',
        'access_token',
    ];

  
      public function partner()
    {
        return $this->belongsTo(partners::class, 'supplier_id');
    }
}
