<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'kandidat_id',
        // Akademik
        'ipk',
        'visi_misi',
        'semester',
        'prestasi_akademik',
        // Non Akademik
        'surat_rekomendasi',
        'usia',
        'keikutsertaan_organisasi',
        'prestasi_non_akademik',
        // Sikap & Perilaku
        'kepemimpinan',
        'integritas',
        'loyalitas',
        'kerjasama'
    ];

    public function kandidat()
    {
        return $this->belongsTo(KandidatBem::class, 'kandidat_id');
    }
}




