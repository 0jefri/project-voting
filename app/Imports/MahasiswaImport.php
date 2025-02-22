<?php

namespace App\Imports;

use App\Models\User;
use App\Models\DetailMahasiswa;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        $namaMahasiswa = $row['NAMA MAHASISWA'] ?? $row['nama_mahasiswa'] ?? null;
        $nim = $row['NIM'] ?? $row['nim'] ?? null;
        $prodi = $row['PROGRAM STUDI'] ?? $row['program_studi'] ?? null;

        if (!$namaMahasiswa || !$nim || !$prodi) {
            return null; // Lewati jika ada data yang kosong
        }

        $user = User::create([
            'username' => strtolower(str_replace(' ', '', $namaMahasiswa)),
            'password' => Hash::make($nim),
            'name' => $namaMahasiswa,
            'role' => 'mahasiswa',
        ]);

        DetailMahasiswa::create([
            'user_id' => $user->id,
            'nim' => $nim,
            'name' => $namaMahasiswa,
            'prodi' => $prodi,
        ]);

        return $user;
    }

}
