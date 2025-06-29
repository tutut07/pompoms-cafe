<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false; // Menonaktifkan timestamps

    protected $fillable = [
        'username', 'password',
    ];
}
