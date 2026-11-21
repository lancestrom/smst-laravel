<?php

namespace App\Imports;

use App\Models\VisiSekolah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VisiSekolahImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?VisiSekolah
    {
        if (blank($row['isi'] ?? null)) {
            return null;
        }

        return new VisiSekolah([
            'isi' => $row['isi'],
        ]);
    }
}
