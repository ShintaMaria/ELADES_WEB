<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSKCK extends Model
{
    protected $table = 'skck';
    protected $primaryKey = 'no_pengajuan';
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
//     public function pengajuan()
// {
//     return $this->belongsTo(PengajuanSurat::class, 'no_pengajuan');
// }

}
