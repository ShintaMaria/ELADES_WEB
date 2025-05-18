<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IzinKerja extends Model
{
    protected $table = 'surat_izin_tidak_masuk_kerja';
    protected $primaryKey = 'no_pengajuan';
    public $timestamps = false;

    protected $fillable = [
        'username', 'kode_surat', 'nama', 'tempat_tanggal_lahir',
        'alamat', 'tanggal_izin', 'alasan', 'file', 'instansi'
    ];
}
