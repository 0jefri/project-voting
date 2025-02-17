<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DetailMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;


class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = User::where('role', 'mahasiswa')->with('detailMahasiswa')->get();
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    public function import(Request $request)
    {
        if ($request->isMethod('get')) {
            // Jika request GET, tampilkan halaman import
            return view('admin.mahasiswa.import');
        }

        // Jika request POST, proses file import
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new MahasiswaImport, $request->file('file'));

        return redirect()->route('admin.mahasiswa.import')->with('success', 'Data Mahasiswa berhasil diimport!');
    }



    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'name' => 'required',
            'nim' => 'required|unique:detail_mahasiswa',
            'prodi' => 'required',
            'email' => 'required|email|unique:detail_mahasiswa',
            'phone' => 'required',
            'semester' => 'required|integer',
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
            'email' => $request->email,
            'phone' => $request->phone,
            'semester' => $request->semester,
            'sosial_media' => $request->sosial_media,
        ]);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }
}

