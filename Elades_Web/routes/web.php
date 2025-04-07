<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingpage\LandingPageController;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\ForgotController;
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


// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//forgot
Route::get('/forgot-password', [ForgotController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotController::class, 'sendResetLinkEmail'])->name('password.email');

// Dashboard
Route::get('/dashboardd', function () {
    return view('dashboard.dashboardd');
})->name('dashboard');

// Pengaduan
Route::get('/infrastruktur', [InfrastrukturController::class, 'index'])->name('infras');
Route::post('/infrastruktur/{id}/update-status', [InfrastrukturController::class, 'updateStatus']);

Route::get('/keamanan', [KeamananController::class, 'index'])->name('keamanan');
Route::get('/saran', [SaranController::class, 'index'])->name('saran');

// Informasi
Route::get('/kabar_desa', [KabarDesaController::class, 'index'])->name('kabardesa');

// Artikel Terkini (CRUD menggunakan resource)
//Route::resource('artikel_terkini', ArtikelTerkiniController::class);
Route::get('/artikel_terkini', [ArtikelTerkiniController::class, 'index'])->name('artikel');

Route::resource('artikels', ArtikelTerkiniController::class);

