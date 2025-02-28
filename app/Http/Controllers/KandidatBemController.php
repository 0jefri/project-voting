<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KandidatBem;
use Illuminate\Support\Facades\Storage;

class KandidatBemController extends Controller
{

    public function index()
    {
        $kandidat = \App\Models\KandidatBem::with(['ketua', 'wakilKetua'])->get();
        return view('admin.kandidat.index', compact('kandidat'));
    }

    public function create()
    {
        $mahasiswa = \App\Models\User::where('role', 'mahasiswa')
            ->where('id', '!=', auth()->id()) // Exclude user yang login
            ->get();
        return view('mahasiswa.pendaftaran', compact('mahasiswa'));
    }


    public function store(Request $request)
    {
        // Cek apakah mahasiswa sudah terdaftar sebagai kandidat
        $sudahTerdaftar = KandidatBem::where('ketua_id', auth()->id())->exists();

        if ($sudahTerdaftar) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar sebagai kandidat dan tidak bisa mendaftar lagi.');
        }

        $request->validate([
            'wakil_ketua' => 'required|exists:users,id|different:id_user',
            'transkrip_nilai' => 'required|mimes:pdf|max:2048',
            'visi_misi' => 'required|mimes:pdf|max:2048',
            'prestasi_akademik' => 'required|mimes:pdf|max:2048',
            'surat_rekomendasi' => 'required|mimes:pdf|max:2048',
            'keikutsertaan_organisasi' => 'required|mimes:pdf|max:2048',
            'prestasi_non_akademik' => 'required|mimes:pdf|max:2048',
            'usia' => 'required|in:1,2,3',
        ]);

        // Simpan file ke storage/app/public/berkas
        $data = $request->all();
        $data['transkrip_nilai'] = $request->file('transkrip_nilai')->store('berkas', 'public');
        $data['visi_misi'] = $request->file('visi_misi')->store('berkas', 'public');
        $data['prestasi_akademik'] = $request->file('prestasi_akademik')->store('berkas', 'public');
        $data['surat_rekomendasi'] = $request->file('surat_rekomendasi')->store('berkas', 'public');
        $data['keikutsertaan_organisasi'] = $request->file('keikutsertaan_organisasi')->store('berkas', 'public');
        $data['prestasi_non_akademik'] = $request->file('prestasi_non_akademik')->store('berkas', 'public');

        KandidatBem::create([
            'ketua_id' => $request->id_user,
            'wakil_ketua_id' => $request->wakil_ketua,
            'transkrip_nilai' => $data['transkrip_nilai'],
            'visi_misi' => $data['visi_misi'],
            'prestasi_akademik' => $data['prestasi_akademik'],
            'surat_rekomendasi' => $data['surat_rekomendasi'],
            'keikutsertaan_organisasi' => $data['keikutsertaan_organisasi'],
            'prestasi_non_akademik' => $data['prestasi_non_akademik'],
            'usia' => $request->usia,
        ]);

        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }

    public function edit($id)
    {
        $kandidat = KandidatBem::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('kandidat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $kandidat = KandidatBem::findOrFail($id);
        $kandidat->update(['status' => $request->status]);

        return redirect()->route('admin.mahasiswa.kandidat')->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kandidat = KandidatBem::findOrFail($id);
        $kandidat->delete();

        return redirect()->route('admin.mahasiswa.kandidat')->with('success', 'Kandidat berhasil dihapus.');
    }


}

