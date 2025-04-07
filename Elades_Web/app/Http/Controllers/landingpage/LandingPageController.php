<?php

namespace App\Http\Controllers\landingpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel; // Panggil model Artikel
use App\Models\Statistik;
class LandingPageController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->take(4)->get();
        $statistik = Statistik::first(); // atau sesuai ID yang kamu gunakan

        return view('landingpage.landing_page', compact('artikels', 'statistik'));
    }

}
