<?php

namespace App\Imports;

use App\Models\Jurusan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class JurusanImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?Jurusan
    {
        if (blank($row['kode'] ?? null) || blank($row['nama'] ?? null)) {
            return null;
        }

        return new Jurusan([
            'kode' => $row['kode'],
            'nama' => $row['nama'],
        ]);
    }
}
