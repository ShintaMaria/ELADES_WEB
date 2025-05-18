<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keramaian extends Model
{
    protected $table = 'surat_izin_keramaian';
    protected $primaryKey = 'no_pengajuan';
    public $timestamps = false;

    protected $fillable = [
        'username', 'kode_surat', 'nama', 'alamat', 'nik',
        'kegiatan', 'tanggal', 'waktu', 'tempat', 'file'
    ];
}
