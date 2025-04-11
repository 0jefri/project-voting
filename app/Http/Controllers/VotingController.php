<?php
namespace App\Http\Controllers;

use App\Models\KandidatBem;
use Illuminate\Http\Request;
use App\Models\Voting; // Pastikan ada model Voting

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

        return view('voting.index', compact('kandidat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kandidat' => 'required|string',
            'nilai' => 'required|numeric',
        ]);

        // Cari kandidat berdasarkan nama ketua
        $kandidat = KandidatBem::whereHas('ketua', function ($query) use ($request) {
            $query->where('name', $request->kandidat);
        })->first();

        if (!$kandidat) {
            return back()->with('error', 'Kandidat tidak ditemukan!');
        }

        // Update status kandidat
        $kandidat->update([
            'status' => 'approved',
            'is_acc' => true
        ]);

        // Simpan ke tabel voting
        Voting::updateOrCreate(
            ['kandidat_id' => $kandidat->id],
            ['nilai' => $request->nilai]
        );

        return redirect()->route('voting.index')->with('success', 'Kandidat berhasil di-ACC!');
    }
}
