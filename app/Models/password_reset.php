<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class password_reset extends Model
{
    use HasFactory;
    protected $table = 'password_resets';

    protected $fillable = [
        'id', 'email', 'code','expires_at'
    ];
    public $timestamps = false;
}
