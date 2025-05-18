<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailSKCK extends Model
{
    protected $table = 'skck';
    protected $primaryKey = 'no_pengajuan';
    public $timestamps = false;

    protected $fillable = [
        'kode_surat', 'nama', 'nik', 'tempat_lahir', 'tanggal_lahir',
        'kebangsaan', 'agama', 'jenis_kelamin', 'status_perkawinan',
        'pekerjaan', 'alamat', 'username', 'file', 'status', 'alasan'
    ];
//     public static function getPengajuanSKCK(){
//     return self::join('surat', 'pengajuan_surat.kode_surat', '=', 'surat.kode_surat')
//     ->join('laporan', 'pengajuan_surat.id', '=', 'laporan.id')
//     ->where('laporan.status', 'Masuk')
//     ->select('pengajuan_surat.nik', 'pengajuan_surat.nama', 'pengajuan_surat.tanggal', 'skck.id', 'surat.kode_surat')
//     ->orderBy('pengajuan_surat.tanggal', 'desc') // Add this line to sort by tanggal in descending order
//     ->get();

// }
}