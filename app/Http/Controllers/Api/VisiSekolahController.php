<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VisiSekolahResource;
use App\Models\VisiSekolah;
use Illuminate\Http\Request;


class VisiSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
     return VisiSekolahResource::collection(
            VisiSekolah::latest()->get()
        );
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
        $visiSekolah = VisiSekolah::findOrFail($id);

        return new VisiSekolahResource($visiSekolah);
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
