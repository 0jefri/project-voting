<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KandidatBem extends Model
{
    use HasFactory;

    protected $table = 'kandidat_bem';
    protected $fillable = [
        'ketua_id',
        'wakil_ketua_id',
        'transkrip_nilai',
        'visi_misi',
        'prestasi_akademik',
        'surat_rekomendasi',
        'keikutsertaan_organisasi',
        'prestasi_non_akademik',
        'usia',
        'status',
        'foto'
    ];

    // Relasi ke User (Ketua)
    public function ketua()
    {
        return $this->belongsTo(User::class, 'ketua_id');
    }

    // Relasi ke User (Wakil Ketua)
    public function wakilKetua()
    {
        return $this->belongsTo(User::class, 'wakil_ketua_id');
    }
}

