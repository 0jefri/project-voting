<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penilaian;
use App\Models\KandidatBem;

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

        Penilaian::create($request->all());

        return redirect()->back()->with('success', 'Penilaian berhasil ditambahkan!');
    }


}

