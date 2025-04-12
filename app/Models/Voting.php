<?php

// app/Models/Voting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'kandidat_id', 'nilai'];

    // Relasi ke KandidatBem
    public function kandidatBem()
    {
        return $this->belongsTo(KandidatBem::class, 'kandidat_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}