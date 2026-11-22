<?php

namespace Tests\Feature;

use App\Imports\VisiJurusanImport;
use App\Models\Jurusan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class VisiJurusanImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_visi_jurusan_for_an_existing_jurusan(): void
    {
        $jurusan = Jurusan::create([
            'kode' => 'RPL',
            'nama' => 'Rekayasa Perangkat Lunak',
        ]);

        $path = sys_get_temp_dir().'/visi-jurusan-import-'.bin2hex(random_bytes(8)).'.csv';
        $file = fopen($path, 'w');

        fputcsv($file, ['kode_jurusan', 'nama_jurusan', 'visi']);
        fputcsv($file, ['RPL', 'Rekayasa Perangkat Lunak', 'Menjadi jurusan unggul']);
        fclose($file);

        try {
            Excel::import(new VisiJurusanImport, $path);
        } finally {
            unlink($path);
        }

        $this->assertDatabaseHas('jurusan_visis', [
            'jurusan_id' => $jurusan->id,
            'visi' => 'Menjadi jurusan unggul',
        ]);
    }
}
