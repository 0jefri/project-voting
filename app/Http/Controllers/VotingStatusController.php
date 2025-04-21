<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VotingStatus;

class VotingStatusController extends Controller
{
    public function index()
    {
        $statuses = VotingStatus::all();
        return view('admin.voting_status.index', compact('statuses'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'status_name' => 'required|in:registration_open,registration_closed',
        ]);

        // Reset semua status ke false
        VotingStatus::where('name', $request->status_name)->update(['is_active' => true]);
        VotingStatus::where('name', '!=', $request->status_name)->update(['is_active' => false]);

        return redirect()->back()->with('success', 'Status voting berhasil diperbarui.');
    }
}
