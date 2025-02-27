<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiStandarSeeder extends Seeder
{
    public function run()
    {
        DB::table('nilai_standar')->insert([
            ['kriteria' => 'ipk', 'nilai_ideal' => 5],
            ['kriteria' => 'visi_misi', 'nilai_ideal' => 5],
            ['kriteria' => 'semester', 'nilai_ideal' => 5],
            ['kriteria' => 'prestasi_akademik', 'nilai_ideal' => 5],
            ['kriteria' => 'surat_rekomendasi', 'nilai_ideal' => 5],
            ['kriteria' => 'usia', 'nilai_ideal' => 5],
            ['kriteria' => 'keikutsertaan_organisasi', 'nilai_ideal' => 5],
            ['kriteria' => 'prestasi_non_akademik', 'nilai_ideal' => 5],
            ['kriteria' => 'kepemimpinan', 'nilai_ideal' => 5],
            ['kriteria' => 'integritas', 'nilai_ideal' => 5],
            ['kriteria' => 'loyalitas', 'nilai_ideal' => 5],
            ['kriteria' => 'kerjasama', 'nilai_ideal' => 5],
        ]);
    }
}

