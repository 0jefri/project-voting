<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DetailMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;


class AdminController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')
            ->with('detailMahasiswa')
            ->paginate(10); // Tambahkan pagination di sini

        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diimport!');
    }

    public function processImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data Mahasiswa berhasil diimport!');
    }




    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'name' => 'required',
            'nim' => 'required|unique:detail_mahasiswa',
            'prodi' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'role' => 'mahasiswa',
        ]);

        DetailMahasiswa::create([
            'user_id' => $user->id,
            'nim' => $request->nim,
            'name' => $request->name,
            'prodi' => $request->prodi,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mahasiswa = User::where('role', 'mahasiswa')
            ->with('detailMahasiswa')
            ->findOrFail($id);

        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required|unique:detail_mahasiswa,nim,' . $id . ',user_id',
            'prodi' => 'required',
        ]);

        // Cari user berdasarkan ID
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name, // Update nama di tabel users
        ]);

        // Update detail_mahasiswa
        $detailMahasiswa = DetailMahasiswa::where('user_id', $id)->first();
        if ($detailMahasiswa) {
            $detailMahasiswa->update([
                'name' => $request->name, // Update nama di tabel detail_mahasiswa
                'nim' => $request->nim,
                'prodi' => $request->prodi,
            ]);
        }

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diperbarui');
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Hapus detail mahasiswa jika ada
        if ($user->detailMahasiswa) {
            $user->detailMahasiswa->delete();
        }

        $user->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus!');
    }

}

