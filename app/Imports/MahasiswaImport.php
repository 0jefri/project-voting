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
        $user = User::create([
            'username' => $row['NAMA MAHASISWA'], // Bisa dibuat lebih unik jika perlu
            'password' => Hash::make($row['NIM']),
            'name' => $row['NAMA MAHASISWA'],
            'role' => 'mahasiswa',
        ]);

        return new DetailMahasiswa([
            'user_id' => $user->id,
            'nim' => $row['NIM'],
            'name' => $row['NAMA MAHASISWA'],
            'prodi' => $row['PROGRAM STUDI'],
            'email' => $row['EMAIL'],
            'phone' => $row['PHONE'],
            'semester' => $row['SEMESTER'],
            'sosial_media' => $row['SOSIAL MEDIA'] ?? null,
        ]);
    }
}

