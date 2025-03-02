<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting; // Pastikan ada model Voting

class VotingController extends Controller
{
    public function store(Request $request)
    {
        // Simpan kandidat yang disetujui ke tabel voting
        Voting::create([
            'kandidat' => $request->kandidat,
            'nilai' => $request->nilai,
        ]);

        return redirect()->back()->with('success', 'Kandidat berhasil dikirim ke voting!');
    }
}