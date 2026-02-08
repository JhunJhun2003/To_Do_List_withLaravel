<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    Protected $table = 'password_reset_tokens';
    protected $fillable = [
        'email','token','created_at',
];
  public $timestamps = false;
    
    // Add these because email is the primary key
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';
}
