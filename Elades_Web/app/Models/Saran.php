<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Saran extends Model
{
     protected $table = 'pengaduan_saran';
    protected $primaryKey = 'no_pengaduan';
    public $timestamps = false;

    protected $fillable = [
        'kode_pengaduan', 'nama', 'alamat', 'topik',
        'judul_saran', 'deskripsi', 'tanggal', 'file', 'username'
    ];
}