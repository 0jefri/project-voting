<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = ['user_id', 'kandidat_id'];

    public function kandidat()
    {
        return $this->belongsTo(KandidatBem::class, 'kandidat_id', 'id');
    }

    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

    public function wakilKetua()
    {
        return $this->belongsTo(User::class, 'wakil_ketua_id');
    }

}
