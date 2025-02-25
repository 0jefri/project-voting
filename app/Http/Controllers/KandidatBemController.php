<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KandidatBem;
use Illuminate\Support\Facades\Storage;

class KandidatBemController extends Controller
{

    public function create()
    {
        $mahasiswa = \App\Models\User::where('role', 'mahasiswa')->get();
        return view('mahasiswa.pendaftaran', compact('mahasiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
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
}

