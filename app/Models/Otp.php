<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    Protected $table = 'otp_codes';
     protected $primaryKey = 'email';
    
    // Since email is not auto-incrementing
    public $incrementing = false;
    
    // Set the key type as string since email is string
    protected $keyType = 'string';
    protected $fillable = [
        'email', 'otp', 'created_at',
    ];
    public $timestamps = false;
}
