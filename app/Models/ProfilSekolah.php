<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProfilSekolah extends Model
{
    use HasUuids;

    // protected $table = 'profil_sekolah';

    protected $fillable = [
        'nama_sekolah',
        'npsn',
        'alamat',
        'telepon',
        'email',
        'nama_kepala_sekolah',
        'deskripsi',
        'logo',
    ];
}
