<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'detail_mahasiswa';
    protected $fillable = ['user_id', 'nim', 'name', 'prodi', 'email', 'phone', 'semester', 'sosial_media'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

