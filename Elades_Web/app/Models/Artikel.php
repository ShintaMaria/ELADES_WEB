<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikels'; // Nama tabel di database

    protected $fillable = ['judul', 'isi', 'gambar', 'link']; // Kolom yang bisa diisi secara massal

}
