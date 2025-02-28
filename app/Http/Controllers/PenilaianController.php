<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\KandidatBem;
use App\Models\NilaiStandar;

class PenilaianController extends Controller
{
    public function index()
    {
        $penilaian = Penilaian::with('kandidat')->get();
        return view('admin.kandidat.penilaian', compact('penilaian'));
    }

    public function create($id)
    {
        $kandidat = KandidatBem::with(['ketua', 'wakilKetua'])->findOrFail($id);
        return view('admin.kandidat.tambah_penilaian', compact('kandidat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kandidat_id' => 'required|exists:kandidat_bem,id',
            'ipk' => 'required|integer|min:1|max:5',
            'visi_misi' => 'required|integer|min:1|max:5',
            'semester' => 'required|integer|min:1|max:5',
            'prestasi_akademik' => 'required|integer|min:1|max:5',
            'surat_rekomendasi' => 'required|integer|min:1|max:5',
            'usia' => 'required|integer|min:1|max:5',
            'keikutsertaan_organisasi' => 'required|integer|min:1|max:5',
            'prestasi_non_akademik' => 'required|integer|min:1|max:5',
            'kepemimpinan' => 'required|integer|min:1|max:5',
            'integritas' => 'required|integer|min:1|max:5',
            'loyalitas' => 'required|integer|min:1|max:5',
            'kerjasama' => 'required|integer|min:1|max:5',
        ]);

        // Cek apakah kandidat sudah memiliki penilaian
        $existingPenilaian = Penilaian::where('kandidat_id', $request->kandidat_id)->first();

        if ($existingPenilaian) {
            return redirect()->back()->with('already_scored', 'Kandidat ini sudah dinilai.');
        }

        Penilaian::create($request->all());

        return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan!');
    }

    // 🔹 FUNGSI UNTUK KONVERSI GAP KE BOBOT
    private function konversiGAP($gap)
    {
        if ($gap == 0)
            return 5.0;
        elseif ($gap == 1 || $gap == -1)
            return 4.5;
        elseif ($gap == 2 || $gap == -2)
            return 4.0;
        elseif ($gap == 3 || $gap == -3)
            return 3.5;
        elseif ($gap == 4 || $gap == -4)
            return 3.0;
        elseif ($gap == 5 || $gap == -5)
            return 2.5;
        else
            return 2.0;
    }

    // 🔹 HITUNG GAP UNTUK SETIAP KANDIDAT
    public function hitungGAP()
    {
        $penilaians = Penilaian::all();
        $nilaiStandar = NilaiStandar::pluck('nilai_ideal', 'kriteria')->toArray();

        $hasil = [];

        foreach ($penilaians as $penilaian) {
            $gap = [
                'kandidat' => $penilaian->kandidat->ketua->name . " & " . $penilaian->kandidat->wakilKetua->name,
                'ipk' => $penilaian->ipk - $nilaiStandar['ipk'],
                'visi_misi' => $penilaian->visi_misi - $nilaiStandar['visi_misi'],
                'semester' => $penilaian->semester - $nilaiStandar['semester'],
                'prestasi_akademik' => $penilaian->prestasi_akademik - $nilaiStandar['prestasi_akademik'],
                'surat_rekomendasi' => $penilaian->surat_rekomendasi - $nilaiStandar['surat_rekomendasi'],
                'usia' => $penilaian->usia - $nilaiStandar['usia'],
                'keikutsertaan_organisasi' => $penilaian->keikutsertaan_organisasi - $nilaiStandar['keikutsertaan_organisasi'],
                'prestasi_non_akademik' => $penilaian->prestasi_non_akademik - $nilaiStandar['prestasi_non_akademik'],
                'kepemimpinan' => $penilaian->kepemimpinan - $nilaiStandar['kepemimpinan'],
                'integritas' => $penilaian->integritas - $nilaiStandar['integritas'],
                'loyalitas' => $penilaian->loyalitas - $nilaiStandar['loyalitas'],
                'kerjasama' => $penilaian->kerjasama - $nilaiStandar['kerjasama'],
            ];
            $hasil[] = $gap;
        }

        return view('admin.kandidat.hasil_gap', compact('hasil'));
    }

    // 🔹 HITUNG CORE FACTOR (CF), SECONDARY FACTOR (SF), DAN TOTAL SKOR
    public function hitungCF_SF()
    {
        $penilaians = Penilaian::all();
        $nilaiStandar = NilaiStandar::pluck('nilai_ideal', 'kriteria')->toArray();

        $hasil = [];

        foreach ($penilaians as $penilaian) {
            // Periksa apakah nilai standar tersedia
            if (!isset($nilaiStandar['ipk']) || !isset($nilaiStandar['visi_misi'])) {
                continue; // Lewati kandidat jika ada nilai standar yang tidak ditemukan
            }

            // Konversi GAP ke Bobot Nilai
            $gap = [
                'ipk' => $this->konversiGAP($penilaian->ipk - ($nilaiStandar['ipk'] ?? 0)),
                'visi_misi' => $this->konversiGAP($penilaian->visi_misi - ($nilaiStandar['visi_misi'] ?? 0)),
                'semester' => $this->konversiGAP($penilaian->semester - ($nilaiStandar['semester'] ?? 0)),
                'prestasi_akademik' => $this->konversiGAP($penilaian->prestasi_akademik - ($nilaiStandar['prestasi_akademik'] ?? 0)),
                'surat_rekomendasi' => $this->konversiGAP($penilaian->surat_rekomendasi - ($nilaiStandar['surat_rekomendasi'] ?? 0)),
                'usia' => $this->konversiGAP($penilaian->usia - ($nilaiStandar['usia'] ?? 0)),
                'keikutsertaan_organisasi' => $this->konversiGAP($penilaian->keikutsertaan_organisasi - ($nilaiStandar['keikutsertaan_organisasi'] ?? 0)),
                'prestasi_non_akademik' => $this->konversiGAP($penilaian->prestasi_non_akademik - ($nilaiStandar['prestasi_non_akademik'] ?? 0)),
                'kepemimpinan' => $this->konversiGAP($penilaian->kepemimpinan - ($nilaiStandar['kepemimpinan'] ?? 0)),
                'integritas' => $this->konversiGAP($penilaian->integritas - ($nilaiStandar['integritas'] ?? 0)),
                'loyalitas' => $this->konversiGAP($penilaian->loyalitas - ($nilaiStandar['loyalitas'] ?? 0)),
                'kerjasama' => $this->konversiGAP($penilaian->kerjasama - ($nilaiStandar['kerjasama'] ?? 0)),
            ];

            // Periksa apakah semua nilai dalam $gap sudah benar
            if (!isset($gap['ipk']) || !isset($gap['visi_misi']) || !isset($gap['kepemimpinan']) || !isset($gap['integritas'])) {
                continue; // Lewati jika ada nilai yang tidak valid
            }

            // Hitung Core Factor (CF) dan Secondary Factor (SF)
            $CF = ($gap['ipk'] + $gap['visi_misi'] + $gap['kepemimpinan'] + $gap['integritas']) / 4;
            $SF = ($gap['semester'] + $gap['prestasi_akademik'] + $gap['surat_rekomendasi'] +
                $gap['usia'] + $gap['keikutsertaan_organisasi'] + $gap['prestasi_non_akademik'] +
                $gap['loyalitas'] + $gap['kerjasama']) / 8;

            // Hitung Total Skor
            $nilai_akhir = (0.6 * $CF) + (0.4 * $SF);

            $hasil[] = [
                'kandidat' => $penilaian->kandidat->ketua->name . " & " . $penilaian->kandidat->wakilKetua->name,
                'CF' => round($CF, 2),
                'SF' => round($SF, 2),
                'nilai_akhir' => round($nilai_akhir, 2)
            ];
        }

        // Urutkan berdasarkan nilai akhir (ranking)
        usort($hasil, fn($a, $b) => $b['nilai_akhir'] <=> $a['nilai_akhir']);

        return view('admin.kandidat.hasil_penilaian', compact('hasil'));
    }

    public function show($id)
    {
        // Ambil data penilaian berdasarkan kandidat_id
        $penilaian = Penilaian::where('kandidat_id', $id)->first();

        if (!$penilaian) {
            return view('admin.kandidat.detail_penilaian')->with('error', 'Data penilaian belum tersedia.');
        }

        return view('admin.kandidat.detail_penilaian', compact('penilaian'));
    }

}
