<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastruktur extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_infrastruktur';
    protected $primaryKey = 'no_pengaduan';
    public $timestamps = false;

    protected $fillable = [
        'username', 'kode_pengaduan', 'nama', 'nik', 'alamat',
        'jenis_infrastruktur', 'deskripsi', 'tanggal_kejadian',
        'file', 'lokasi', 'alasan', 'status'
    ];
}
