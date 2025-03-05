<?php

namespace App\Http\Controllers\landingpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel; // Panggil model Artikel
class LandingPageController extends Controller
{
    public function index()
    {
        $artikels = Artikel::latest()->take(4)->get(); // Ambil 4 artikel terbaru
        return view('landingpage.landing_page', compact('artikels'));
    }
}
