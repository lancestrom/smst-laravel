<?php

namespace Tests\Feature;

use App\Models\ProfilSekolah;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfilSekolahApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_the_profil_sekolah_matching_the_requested_id(): void
    {
        ProfilSekolah::create(['nama_sekolah' => 'Sekolah lain']);
        $profilSekolah = ProfilSekolah::create(['nama_sekolah' => 'Sekolah tujuan']);

        $response = $this->getJson("/api/profil-sekolah/{$profilSekolah->id}");

        $response
            ->assertOk()
            ->assertJsonPath('data.id', $profilSekolah->id)
            ->assertJsonPath('data.nama_sekolah', 'Sekolah tujuan');
    }

    public function test_it_returns_not_found_for_an_unknown_profil_sekolah_id(): void
    {
        $this->getJson('/api/profil-sekolah/999999')
            ->assertNotFound();
    }
}
