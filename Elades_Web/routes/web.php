<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingpage\LandingPageController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\pengaduan\InfrastrukturController;
use App\Http\Controllers\pengaduan\KeamananController;
use App\Http\Controllers\pengaduan\SaranController;
use App\Http\Controllers\informasi\KabarDesaController;
use App\Http\Controllers\informasi\ArtikelTerkiniController;

Route::get('/', function () {
    return view('welcome');
});

// Landing Page
Route::get('/landing_page', [LandingPageController::class, 'index'])->name('landingpage');

// Dashboard
Route::get('/dashboardd', function () {
    return view('dashboard.dashboardd');
})->name('dashboard');

// Pengaduan
Route::get('/infrastruktur', [InfrastrukturController::class, 'index'])->name('infras');
Route::get('/keamanan', [KeamananController::class, 'index'])->name('keamanan');
Route::get('/saran', [SaranController::class, 'index'])->name('saran');

// Informasi
Route::get('/kabar_desa', [KabarDesaController::class, 'index'])->name('kabardesa');
Route::get('/artikel_terkini', [ArtikelTerkiniController::class, 'index'])->name('artikel');
