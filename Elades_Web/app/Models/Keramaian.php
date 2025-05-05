<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keramaian extends Model
{
    protected $table = 'keramaian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_surat',
        'nama',
        'nik',
        'hari',
        'tempat',
        'acara',
        'username',

    ];
}
