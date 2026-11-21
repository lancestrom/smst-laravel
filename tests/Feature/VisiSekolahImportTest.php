<?php

namespace Tests\Feature;

use App\Imports\VisiSekolahImport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class VisiSekolahImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_visi_sekolah_rows_using_template_headings(): void
    {
        $path = sys_get_temp_dir().'/visi-sekolah-import-'.bin2hex(random_bytes(8)).'.csv';
        $file = fopen($path, 'w');

        fputcsv($file, ['isi']);
        fputcsv($file, ['Menjadi sekolah unggul dan berkarakter']);
        fputcsv($file, ['']);
        fclose($file);

        try {
            Excel::import(new VisiSekolahImport, $path);
        } finally {
            unlink($path);
        }

        $this->assertDatabaseHas('visi_sekolahs', [
            'isi' => 'Menjadi sekolah unggul dan berkarakter',
        ]);
        $this->assertDatabaseCount('visi_sekolahs', 1);
    }
}
