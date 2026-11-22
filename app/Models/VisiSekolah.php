<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class VisiSekolah extends Model
{
    use HasUuids;

    protected $fillable = [
        'isi',
    ];
}
