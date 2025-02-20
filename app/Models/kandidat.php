<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    protected $table = 'detail_kandidat';

    protected $fillable = [
        'id_user',
        'wakil_ketua',
        'transkrip_nilai',
        'visi_misi',
        'semester',
        'prestasi_akademik',
        'surat_rekomendasi',
        'usia',
        'keikutsertaan_organisasi',
        'prestasi_non_akademik',
        'kepemimpinan',
        'integritas',
        'loyalitas',
        'kerjasama',
        'penilaian_akhir',
        'ranking',
    ];

    /**
     * Relasi ke tabel detail_mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(DetailMahasiswa::class, 'id_user', 'id_user');
    }

    /**
     * Relasi untuk mendapatkan data wakil ketua dari user lain
     */
    public function wakil()
    {
        return $this->belongsTo(DetailMahasiswa::class, 'wakil_ketua', 'id_user');
    }

    /**
     * Relasi ke tabel voting
     */
    public function votes()
    {
        return $this->hasMany(Voting::class, 'id_kandidat');
    }

    /**
     * Metode otomatis untuk skoring surat rekomendasi
     */
    public function getSkorSuratRekomendasiAttribute()
    {
        return $this->surat_rekomendasi ? 5 : 1;
    }

    /**
     * Metode otomatis untuk skoring usia
     */
    public function getSkorUsiaAttribute()
    {
        if ($this->usia >= 19 && $this->usia <= 24) {
            return 5;
        } elseif ($this->usia > 24) {
            return 3;
        } else {
            return 1;
        }
    }

    /**
     * Menghitung ranking berdasarkan penilaian_akhir
     */
    public static function updateRanking()
    {
        $kandidat = self::orderByDesc('penilaian_akhir')->get();
        foreach ($kandidat as $index => $item) {
            $item->ranking = $index + 1;
            $item->save();
        }
    }
}
