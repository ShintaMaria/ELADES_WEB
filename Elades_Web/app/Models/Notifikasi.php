<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifikasi extends Model
{
    use HasFactory;

    protected $table = 'notifikasi_web';
    protected $fillable = ['tanggal', 'kode', 'nama', 'is_read'];

    // Disable Laravel's default timestamps
    public $timestamps = false;
}