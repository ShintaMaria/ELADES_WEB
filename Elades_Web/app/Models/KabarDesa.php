<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabarDesa extends Model
{
    use HasFactory;

    protected $table = 'kabar_desa'; // Sesuaikan dengan nama tabel di database

    protected $fillable = [
        'judul', 
        'deskripsi', 
        'tanggal', 
        'gambar'
    ];

    public $timestamps = false;
}
