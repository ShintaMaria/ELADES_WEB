<?php

namespace App\Http\Controllers\pengaduan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class KeamananController extends Controller
{
    public function index()
    {
        return view('pengaduan.keamanan');
    }
}
