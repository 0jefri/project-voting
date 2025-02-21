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
            'username' => $row['nama'], // Bisa dibuat lebih unik jika perlu
            'password' => Hash::make($row['nim']),
            'name' => $row['nama'],
            'role' => 'mahasiswa',
        ]);

        return new DetailMahasiswa([
            'user_id' => $user->id,
            'nim' => $row['nim'],
            'name' => $row['nama'],
            'prodi' => $row['program_studi'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'semester' => $row['semester'],
            'sosial_media' => $row['sosial_media'] ?? null,
        ]);
    }
}

