<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidat;
use App\Models\DetailMahasiswa;
use Illuminate\Support\Facades\Storage;

class KandidatController extends Controller
{
    /**
     * Menampilkan daftar kandidat.
     */
    public function index()
    {
        $kandidat = Kandidat::with(['mahasiswa', 'wakil', 'votes'])->get();
        return response()->json($kandidat);
    }

    /**
     * Menampilkan form pendaftaran kandidat.
     */
    public function create()
    {
        return view('mahasiswa.pendaftaran');
    }

    /**
     * Menyimpan kandidat baru.
     */
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

        return redirect()->route('mahasiswa.pendaftaran.kandidat')
        ->with('success', 'Pendaftaran kandidat berhasil!');
        }

    /**
     * Menampilkan detail kandidat tertentu.
     */
    public function show($id)
    {
        $kandidat = Kandidat::with(['mahasiswa', 'wakil', 'votes'])->findOrFail($id);
        return response()->json($kandidat);
    }

    /**
     * Memperbarui data kandidat.
     */
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
                if ($kandidat->$fileField) {
                    Storage::delete($kandidat->$fileField);
                }
                $data[$fileField] = $request->file($fileField)->store('kandidat_files');
            }
        }

        $kandidat->update($data);
        Kandidat::updateRanking();

        return response()->json($kandidat);
    }

    /**
     * Menghapus kandidat.
     */
    public function destroy($id)
    {
        $kandidat = Kandidat::findOrFail($id);

        foreach (['transkrip_nilai', 'visi_misi', 'prestasi_akademik', 'surat_rekomendasi', 'keikutsertaan_organisasi', 'prestasi_non_akademik'] as $fileField) {
            if ($kandidat->$fileField) {
                Storage::delete($kandidat->$fileField);
            }
        }

        $kandidat->delete();
        Kandidat::updateRanking();

        return response()->json(['message' => 'Kandidat berhasil dihapus']);
    }
}
