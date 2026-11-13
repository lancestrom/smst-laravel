<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfilSekolahResource;
use App\Models\ProfilSekolah;
use Illuminate\Http\Request;

class ProfilSekolahController extends Controller
{
    // GET: Semua data
    public function index()
    {
        $data = ProfilSekolah::latest()->get();

        return ProfilSekolahResource::collection($data);
    }

    // POST: Tambah data
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'nama_kepala_sekolah' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|string|max:255',
        ]);

        $data = ProfilSekolah::create($validated);

        return (new ProfilSekolahResource($data))
            ->response()
            ->setStatusCode(201);
    }

    // GET: Detail berdasarkan ID
    public function show(ProfilSekolah $profilSekolah)
    {
        return new ProfilSekolahResource($profilSekolah);
    }

    // PUT/PATCH: Update data
    public function update(Request $request, ProfilSekolah $profilSekolah)
    {
        $validated = $request->validate([
            'nama_sekolah' => 'sometimes|required|string|max:255',
            'npsn' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'nama_kepala_sekolah' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'logo' => 'nullable|string|max:255',
        ]);

        $profilSekolah->update($validated);

        return new ProfilSekolahResource($profilSekolah);
    }

    // DELETE: Hapus data
    public function destroy(ProfilSekolah $profilSekolah)
    {
        $profilSekolah->delete();

        return response()->json([
            'message' => 'Data profil sekolah berhasil dihapus',
        ]);
    }
}
