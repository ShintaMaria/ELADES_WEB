<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehilangan extends Model
{
    protected $table = 'kehilangan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_surat',
        'nama',
        'nik',
        'jenis_kelamin',
        'tempat_tgl_lahir',
        'agama',
        'pekerjaan',
        'alamat',
        'barang',
        'hilang_tgl',
        'tempat_hilang',
        'username',
    ];
}
