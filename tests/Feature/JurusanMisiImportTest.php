<?php

namespace Tests\Feature;

use App\Imports\JurusanMisiImport;
use App\Models\Jurusan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class JurusanMisiImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_imports_misi_jurusan_for_an_existing_jurusan(): void
    {
        $jurusan = Jurusan::create([
            'kode' => 'RPL',
            'nama' => 'Rekayasa Perangkat Lunak',
        ]);

        $path = sys_get_temp_dir().'/misi-jurusan-import-'.bin2hex(random_bytes(8)).'.csv';
        $file = fopen($path, 'w');

        fputcsv($file, ['kode_jurusan', 'nama_jurusan', 'misi']);
        fputcsv($file, ['RPL', 'Rekayasa Perangkat Lunak', 'Mencetak lulusan kompeten']);
        fputcsv($file, ['RPL', 'Rekayasa Perangkat Lunak', 'Mengembangkan inovasi teknologi']);
        fclose($file);

        try {
            Excel::import(new JurusanMisiImport, $path);
            Excel::import(new JurusanMisiImport, $path);
        } finally {
            unlink($path);
        }

        $this->assertDatabaseHas('misi_jurusans', [
            'jurusan_id' => $jurusan->id,
            'misi' => 'Mencetak lulusan kompeten',
        ]);
        $this->assertDatabaseHas('misi_jurusans', [
            'jurusan_id' => $jurusan->id,
            'misi' => 'Mengembangkan inovasi teknologi',
        ]);
        $this->assertDatabaseCount('misi_jurusans', 2);
    }
}
