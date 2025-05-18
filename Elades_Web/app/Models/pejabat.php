<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pejabat extends Model
{
    protected $table = 'pejabat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama', 'nip', 'jabatan'
    ];
}
