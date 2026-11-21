<?php

namespace App\Imports;

use App\Models\ProfilSekolah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProfilSekolahImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?ProfilSekolah
    {
        if (blank($row['nama_sekolah'] ?? null)) {
            return null;
        }

        return new ProfilSekolah([
            'nama_sekolah' => $row['nama_sekolah'],
            'npsn' => $row['npsn'] ?? null,
            'alamat' => $row['alamat'] ?? null,
            'telepon' => $row['telepon'] ?? null,
            'email' => $row['email'] ?? null,
            'nama_kepala_sekolah' => $row['nama_kepala_sekolah'] ?? null,
            'deskripsi' => $row['deskripsi'] ?? null,
            'logo' => $row['logo'] ?? null,
        ]);
    }
}
