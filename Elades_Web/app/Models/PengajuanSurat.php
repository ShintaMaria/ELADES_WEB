<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_surat',
        'nama',
        'nik',
        'tanggal',
        'username',

    ];

}
