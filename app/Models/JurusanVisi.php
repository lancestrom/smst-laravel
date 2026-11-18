<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JurusanVisi extends Model
{
    protected $table = 'jurusan_visis';

    protected $fillable = [
        'jurusan_id',
        'visi',
    ];

    public function jurusan(): BelongsTo
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id');
    }
}
