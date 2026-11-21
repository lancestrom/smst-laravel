<?php

namespace Tests\Feature;

use App\Imports\ProfilSekolahImport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ProfilSekolahImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_profil_sekolah_rows_using_template_headings(): void
    {
        $path = sys_get_temp_dir().'/profil-sekolah-import-'.bin2hex(random_bytes(8)).'.csv';
        $file = fopen($path, 'w');

        fputcsv($file, [
            'nama_sekolah',
            'npsn',
            'alamat',
            'telepon',
            'email',
            'nama_kepala_sekolah',
            'deskripsi',
            'logo',
        ]);
        fputcsv($file, [
            'SMK Contoh',
            '12345678',
            'Jl. Pendidikan',
            '08123456789',
            'sekolah@example.test',
            'Kepala Sekolah',
            'Deskripsi sekolah',
            'logo.png',
        ]);
        fclose($file);

        try {
            Excel::import(new ProfilSekolahImport, $path);
        } finally {
            unlink($path);
        }

        $this->assertDatabaseHas('profil_sekolahs', [
            'nama_sekolah' => 'SMK Contoh',
            'npsn' => '12345678',
            'email' => 'sekolah@example.test',
            'nama_kepala_sekolah' => 'Kepala Sekolah',
        ]);
    }
}
