<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ⬅ Tambahkan ini
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory; // ⬅ Tambahkan ini
    use Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
