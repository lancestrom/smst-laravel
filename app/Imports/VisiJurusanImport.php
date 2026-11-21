<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\JurusanVisi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VisiJurusanImport implements ToModel, WithHeadingRow
{
    public function model(array $row): ?JurusanVisi
    {
        $visi = trim((string) ($row['visi'] ?? ''));

        if ($visi === '') {
            return null;
        }

        $jurusan = null;
        $kodeJurusan = trim((string) ($row['kode_jurusan'] ?? ''));
        $namaJurusan = trim((string) ($row['nama_jurusan'] ?? ''));

        if ($kodeJurusan !== '') {
            $jurusan = Jurusan::where('kode', $kodeJurusan)->first();
        }

        if (! $jurusan && $namaJurusan !== '') {
            $jurusan = Jurusan::where('nama', $namaJurusan)->first();
        }

        if (! $jurusan) {
            return null;
        }

        $record = JurusanVisi::firstOrNew([
            'jurusan_id' => $jurusan->id,
        ]);

        $record->visi = $visi;

        return $record;
    }
}
