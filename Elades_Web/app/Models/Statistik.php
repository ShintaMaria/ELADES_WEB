<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;

    protected $table = 'statistik';

    // field yang bisa diisi
    protected $fillable = [
        'total_jiwa',
        'jumlah_kk',
        'jumlah_dusun',
        'luas_wilayah',
    ];
}
