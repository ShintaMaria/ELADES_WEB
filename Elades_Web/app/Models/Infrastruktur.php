<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infrastruktur extends Model
{
    use HasFactory;
    
    protected $table = 'infrastruktur'; // Nama tabel
    protected $fillable = ['status', 'media', 'deskripsi', 'alamat']; // Kolom yang bisa diisi
}
