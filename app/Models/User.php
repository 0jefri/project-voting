<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['username', 'password', 'name', 'role'];
    protected $hidden = ['password'];

    public function detailMahasiswa()
    {
        return $this->hasOne(DetailMahasiswa::class, 'user_id');
    }
}

