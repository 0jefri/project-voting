<?php
namespace App\Http\Controllers;

use App\Exports\HasilVotingExport;
use App\Models\KandidatBem;
use App\Models\NilaiStandar;
use App\Models\Penilaian;
use App\Models\Vote;
use DB;
use Illuminate\Http\Request;
use App\Models\Voting;
use Maatwebsite\Excel\Excel;// Pastikan ada model Voting

class VotingController extends Controller
{
    // app/Http/Controllers/VotingController.php
    public function index()
    {
        // Ambil kandidat yang sudah di-ACC baik dari status maupun is_acc
        $kandidat = KandidatBem::with(['ketua', 'wakilKetua'])
            ->where('status', 'approved')
            ->orWhere('is_acc', true)
            ->get();

        $statuses = \App\Models\VotingStatus::all();

        return view('voting.index', compact('kandidat', 'statuses'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'mahasiswa') {
            abort(403);
        }

        $userId = auth()->id();
        $kandidatId = $request->kandidat_id;

        $existingVote = Vote::where('user_id', auth()->id())->first();

        if ($existingVote) {
            // Jika sudah, beri tahu pengguna bahwa mereka telah memberikan suara
            return redirect()->route('voting.index')->with('already_voted', true);
        }

        $request->validate([
            'kandidat_id' => 'required|exists:kandidat_bem,id',
        ]);


        $kandidat = KandidatBem::find($request->kandidat_id);


        if (!$kandidat) {
            return back()->with('error', 'Kandidat tidak ditemukan!');
        }

        // Update status kandidat (jika memang ini bagian dari logika voting)
        $kandidat->update([
            'status' => 'approved',
            'is_acc' => true
        ]);

        Vote::create([
            'user_id' => $userId,
            'kandidat_id' => $kandidatId,
        ]);


        return redirect()->route('voting.index')->with('voted_successfully', true);
    }

    public function hasil()
    {
        $hasilVoting = Vote::with(['kandidat.ketua', 'kandidat.wakilKetua'])
            ->select('kandidat_id', DB::raw('count(*) as total_suara'))
            ->groupBy('kandidat_id')
            ->get();

        $totalSuara = $hasilVoting->sum('total_suara');

        $labels = [];
        $data = [];
        $colors = [];

        foreach ($hasilVoting as $item) {
            $labels[] = $item->kandidat->ketua->name . ' & ' . $item->kandidat->wakilKetua->name;
            $data[] = $item->total_suara;
            $colors[] = '#' . substr(md5($item->kandidat_id), 0, 6); // Warna unik berdasarkan ID kandidat
        }

        // Data penilaian (new) - hanya ambil nama dan nilai akhir
        $hasilPenilaian = [];
        $penilaians = Penilaian::with('kandidat.ketua', 'kandidat.wakilKetua')->get();

        foreach ($penilaians as $penilaian) {
            $hasilPenilaian[] = [
                'kandidat' => $penilaian->kandidat->ketua->name . " & " . $penilaian->kandidat->wakilKetua->name,
                'nilai_akhir' => $this->hitungNilaiAkhir($penilaian)
            ];
        }

        // Menambahkan nilai akhir pada hasilVoting
        foreach ($hasilVoting as $item) {
            foreach ($hasilPenilaian as $penilaian) {
                if ($item->kandidat->ketua->name . ' & ' . $item->kandidat->wakilKetua->name == $penilaian['kandidat']) {
                    $item->nilai_akhir = $penilaian['nilai_akhir'];
                    break;
                }
            }
        }


        return view('voting.hasil', compact('hasilVoting', 'totalSuara', 'labels', 'data', 'colors', 'hasilPenilaian'));
    }

    // Fungsi untuk menghitung nilai akhir
    private function hitungNilaiAkhir($penilaian)
    {
        $nilaiStandar = NilaiStandar::pluck('nilai_ideal', 'kriteria')->toArray();

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

        // Hitung Core Factor (CF) dan Secondary Factor (SF)
        $CF = ($gap['ipk'] + $gap['visi_misi'] + $gap['kepemimpinan'] + $gap['integritas']) / 4;
        $SF = ($gap['semester'] + $gap['prestasi_akademik'] + $gap['surat_rekomendasi'] +
            $gap['usia'] + $gap['keikutsertaan_organisasi'] + $gap['prestasi_non_akademik'] +
            $gap['loyalitas'] + $gap['kerjasama']) / 8;

        // Hitung Total Skor
        return round((0.6 * $CF) + (0.4 * $SF), 2);
    }

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

}
