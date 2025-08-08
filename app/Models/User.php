<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // <— tambahkan ini

class User extends Authenticatable
{
    use Notifiable, HasRoles; // <— pakai trait

    protected $fillable = ['name','email','password'];
    protected $hidden   = ['password','remember_token'];
    protected $casts    = ['email_verified_at' => 'datetime'];
}
