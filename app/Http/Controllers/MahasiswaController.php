<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DetailMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    // public function page()
    // {
    //     return view('admin.mahasiswa.page');
    // }


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

