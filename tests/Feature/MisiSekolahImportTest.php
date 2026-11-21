<?php

namespace Tests\Feature;

use App\Exports\MisiSekolahTemplateExport;
use App\Imports\MisiSekolahImport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class MisiSekolahImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_misi_sekolah_rows_using_template_headings(): void
    {
        $path = sys_get_temp_dir().'/misi-sekolah-import-'.bin2hex(random_bytes(8)).'.csv';
        $file = fopen($path, 'w');

        fputcsv($file, ['isi']);
        fputcsv($file, ['Meningkatkan mutu pendidikan']);
        fputcsv($file, ['']);
        fclose($file);

        try {
            Excel::import(new MisiSekolahImport, $path);
        } finally {
            unlink($path);
        }

        $this->assertDatabaseHas('misi_sekolahs', [
            'isi' => 'Meningkatkan mutu pendidikan',
        ]);
        $this->assertDatabaseCount('misi_sekolahs', 1);
    }

    public function test_it_exports_a_template_with_the_import_heading(): void
    {
        $this->assertSame(['isi'], (new MisiSekolahTemplateExport)->headings());
    }
}
