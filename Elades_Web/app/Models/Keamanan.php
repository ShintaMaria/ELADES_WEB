<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keamanan extends Model
{
    protected $table = 'pengaduan_keamanan';
    protected $primaryKey = 'no_pengaduan';
    public $timestamps = false;

    protected $fillable = [
        'username', 'kode_pengaduan', 'nama', 'nik', 'jenis_kasus',
        'lokasi_kejadian', 'tanggal', 'waktu', 'deskripsi', 'file'
    ];
}