<?php
namespace App\Http\Controllers;

use App\Exports\HasilVotingExport;
use App\Models\KandidatBem;
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

        return view('voting.hasil', compact('hasilVoting', 'totalSuara', 'labels', 'data', 'colors'));
    }

    public function export()
    {
        return Excel::download(new HasilVotingExport, 'hasil_voting.xlsx');
    }
}
