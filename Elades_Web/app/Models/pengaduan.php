<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pengaduan extends Model
{
    protected $table = 'pengaduan';
    public $timestamps = false;

    protected $fillable = [
        'kode_pengaduan', 'nik', 'tanggal', 'nama', 'username', 'no_pengaduan', 'file', 'status', 'alasan'
    ];
}
