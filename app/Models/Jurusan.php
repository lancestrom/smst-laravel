<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    use HasUuids;

    protected $fillable = [
        'kode',
        'nama',
    ];

    public function visiJurusans(): HasMany
    {
        return $this->hasMany(JurusanVisi::class, 'jurusan_id');
    }
}
