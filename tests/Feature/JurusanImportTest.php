<?php

namespace Tests\Feature;

use App\Imports\JurusanImport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class JurusanImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_jurusan_rows_using_template_headings(): void
    {
        $path = sys_get_temp_dir().'/jurusan-import-'.bin2hex(random_bytes(8)).'.csv';
        $file = fopen($path, 'w');

        fputcsv($file, ['kode', 'nama']);
        fputcsv($file, ['RPL', 'Rekayasa Perangkat Lunak']);
        fputcsv($file, [' ', '']);
        fclose($file);

        try {
            Excel::import(new JurusanImport, $path);
        } finally {
            unlink($path);
        }

        $this->assertDatabaseHas('jurusans', [
            'kode' => 'RPL',
            'nama' => 'Rekayasa Perangkat Lunak',
        ]);
        $this->assertDatabaseCount('jurusans', 1);
    }
}
