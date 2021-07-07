<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;

    protected $hidden = [
        'password', 'remember_token', 'token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
