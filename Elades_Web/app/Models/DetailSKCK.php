<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSKCK extends Model
{
    protected $table = 'skck';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_surat',
        'nama',
        'nik',
        'jenis_kelamin',
        'tempat_tgl_lahir',
        'status_perkawinan',
        'kebangsaan',
        'agama',
        'pekerjaan',
        'alamat',
        'username',
        'file',
    ];
}
