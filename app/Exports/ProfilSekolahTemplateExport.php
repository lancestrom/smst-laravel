<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProfilSekolahTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [];
    }

    public function headings(): array
    {
        return [
            'nama_sekolah',
            'npsn',
            'alamat',
            'telepon',
            'email',
            'nama_kepala_sekolah',
            'deskripsi',
            'logo',
        ];
    }
}
