<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\DetailMahasiswa;
use Illuminate\Support\Facades\Storage;

class KandidatController extends Controller
{
    public function index()
    {
        $kandidat = Kandidat::with(['mahasiswa', 'wakil', 'votes'])->get();
        return response()->json($kandidat);
    }

    public function create()
    {
       $mahasiswa = DetailMahasiswa::all(); // Ambil semua data dari DetailMahasiswa
    return view('mahasiswa.pendaftaran', compact('mahasiswa'));
}


    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:detail_mahasiswa,id_user',
            'wakil_ketua' => 'required|exists:detail_mahasiswa,id_user',
            'transkrip_nilai' => 'required|file|mimes:pdf',
            'visi_misi' => 'required|file|mimes:pdf',
            'prestasi_akademik' => 'required|file|mimes:pdf',
            'surat_rekomendasi' => 'required|file|mimes:pdf',
            'keikutsertaan_organisasi' => 'required|file|mimes:pdf',
            'prestasi_non_akademik' => 'required|file|mimes:pdf',
            'usia' => 'required|integer',
        ]);

        $data = $request->all();
        $mahasiswa = DetailMahasiswa::where('id_user', $request->id_user)->firstOrFail();
        $data['semester'] = $mahasiswa->semester;

        foreach (['transkrip_nilai', 'visi_misi', 'prestasi_akademik', 'surat_rekomendasi', 'keikutsertaan_organisasi', 'prestasi_non_akademik'] as $fileField) {
            if ($request->hasFile($fileField)) {
                $data[$fileField] = $request->file($fileField)->store('kandidat_files');
            }
        }

        $kandidat = Kandidat::create($data);
        Kandidat::updateRanking();

        return redirect()->route('mahasiswa.pendaftaran.kandidat')->with('success', 'Pendaftaran kandidat berhasil!');
    }

    public function show($id)
    {
        $kandidat = Kandidat::with(['mahasiswa', 'wakil', 'votes'])->findOrFail($id);
        return response()->json($kandidat);
    }

    public function update(Request $request, $id)
    {
        $kandidat = Kandidat::findOrFail($id);

        $request->validate([
            'wakil_ketua' => 'required|exists:detail_mahasiswa,id_user',
            'usia' => 'required|integer',
        ]);

        $data = $request->all();
        $mahasiswa = DetailMahasiswa::where('id_user', $kandidat->id_user)->firstOrFail();
        $data['semester'] = $mahasiswa->semester;

        foreach (['transkrip_nilai', 'visi_misi', 'prestasi_akademik', 'surat_rekomendasi', 'keikutsertaan_organisasi', 'prestasi_non_akademik'] as $fileField) {
            if ($request->hasFile($fileField)) {
                if (!empty($kandidat->$fileField) && Storage::exists($kandidat->$fileField)) {
                    Storage::delete($kandidat->$fileField);
                }
                $data[$fileField] = $request->file($fileField)->store('kandidat_files');
            }
        }

        $kandidat->update($data);
        Kandidat::updateRanking();

        return redirect()->route('mahasiswa.pendaftaran.kandidat')->with('success', 'Data kandidat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kandidat = Kandidat::findOrFail($id);

        foreach (['transkrip_nilai', 'visi_misi', 'prestasi_akademik', 'surat_rekomendasi', 'keikutsertaan_organisasi', 'prestasi_non_akademik'] as $fileField) {
            if (!empty($kandidat->$fileField) && Storage::exists($kandidat->$fileField)) {
                Storage::delete($kandidat->$fileField);
            }
        }

        $kandidat->delete();
        Kandidat::updateRanking();

        return redirect()->route('mahasiswa.pendaftaran.kandidat')->with('success', 'Kandidat berhasil dihapus!');
    }
}
