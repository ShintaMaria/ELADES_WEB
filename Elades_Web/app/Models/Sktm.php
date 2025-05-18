<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sktm extends Model
{
    protected $table = 'sktm';
    protected $primaryKey = 'no_pengajuan';
    public $timestamps = false;

    protected $fillable = [
        'username', 'kode_surat', 'nama_bapak', 'tempat_tanggal_lahir_bapak',
        'pekerjaan_bapak', 'alamat_bapak', 'nama_ibu', 'tempat_tanggal_lahir_ibu',
        'pekerjaan_ibu', 'alamat_ibu', 'nama', 'nik', 'tempat_tanggal_lahir_anak',
        'jenis_kelamin_anak', 'alamat', 'keperluan', 'file'
    ];
}
