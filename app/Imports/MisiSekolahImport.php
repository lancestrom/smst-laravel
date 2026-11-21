<?php

namespace App\Imports;

use App\Models\MisiSekolah;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MisiSekolahImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?MisiSekolah
    {
        if (blank($row['isi'] ?? null)) {
            return null;
        }

        return new MisiSekolah([
            'isi' => $row['isi'],
        ]);
    }
}
