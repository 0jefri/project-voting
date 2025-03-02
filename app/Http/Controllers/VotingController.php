<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting; // Pastikan ada model Voting

class VotingController extends Controller
{

    public function index()
    {
        // Ambil semua kandidat yang telah di-ACC
        $votingData = Voting::all();

        return view('voting.index', compact('votingData'));
    }

    public function store(Request $request)
    {
        // Simpan kandidat ke database
        Voting::create([
            'kandidat' => $request->kandidat,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('voting.index')->with('success', 'Kandidat berhasil ditambahkan!');
    }

}