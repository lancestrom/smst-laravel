<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JurusanMisi;
use App\Models\JurusanVisi;
use App\Models\Jurusan;

class JurusanMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JurusanMisi::with('jurusan')->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Data misi jurusan berhasil diambil',
            'data' => $data,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = JurusanMisi::with('jurusan')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
