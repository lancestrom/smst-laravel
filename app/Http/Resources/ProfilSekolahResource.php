<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilSekolahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_sekolah' => $this->nama_sekolah,
            'npsn' => $this->npsn,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'email' => $this->email,
            'nama_kepala_sekolah' => $this->nama_kepala_sekolah,
            'deskripsi' => $this->deskripsi,
            'logo' => $this->logo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
