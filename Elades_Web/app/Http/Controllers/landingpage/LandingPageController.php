<?php

namespace App\Http\Controllers\landingpage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class LandingPageController extends Controller
{
    public function index()
    {
        return view('landingpage.landing_page');
    }
}
