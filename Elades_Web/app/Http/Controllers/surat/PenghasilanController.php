<?php

namespace App\Http\Controllers\surat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PenghasilanController extends Controller
{
    public function index()
    {
        return view('surat.keterangan.penghasilan');
    }
}