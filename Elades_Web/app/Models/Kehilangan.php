<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehilangan extends Model
{
    protected $table = 'surat_kehilangan_barang';
    protected $primaryKey = 'no_pengajuan';
    public $timestamps = false;

    protected $fillable = [
        'kode_surat', 'username', 'nama', 'tempat_lahir', 'tanggal_lahir',
        'agama', 'jenis_kelamin', 'pekerjaan', 'alamat', 'barang_yang_hilang',
        'hilang_pada_tanggal', 'tempat_kehilangan', 'file', 'status', 'alasan'
    ];
}
