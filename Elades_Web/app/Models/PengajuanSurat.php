<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'kode_surat',
        'nik',
        'tanggal',
        'nama',
        'username',
        'no_pengajuan',
        'ktp_file',
        'status',
        'alasan',
    ];
    public function skck()
{
    return $this->hasOne(DetailSKCK::class, 'no_pengajuan');
}

}
