<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenghasilanOrtu extends Model
{
    protected $table = 'penghasilan_ortu';
    protected $primaryKey = 'no_pengajuan';
    public $timestamps = false;

    protected $fillable = [
        'username', 'kode_surat', 'nama_ortu', 'tempat_tanggal_lahir_ortu',
        'pekerjaan_ortu', 'alamat_ortu', 'nama_anak', 'tempat_tanggal_lahir_anak',
        'alamat_anak', 'keperluan', 'file', 'alasan', 'status'
    ];
}
