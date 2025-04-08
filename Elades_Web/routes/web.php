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
use App\Http\Controllers\dashboard\ProfileController;

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
Route::resource('kabardesa', KabarDesaController::class);
// Artikel Terkini (CRUD menggunakan resource)
//Route::resource('artikel_terkini', ArtikelTerkiniController::class);
Route::get('/artikel_terkini', [ArtikelTerkiniController::class, 'index'])->name('artikel');

Route::resource('artikels', ArtikelTerkiniController::class);


use App\Http\Controllers\informasi\StatistikController;

Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
Route::get('/statistik/edit', [StatistikController::class, 'edit'])->name('statistik.edit');
Route::put('/statistik/update', [StatistikController::class, 'update'])->name('statistik.update');

// Route::get('/statistikk', function () {
//     return view('informasi.statistik.statistikk');
// })->name('statistik');

use App\Http\Controllers\login\GoogleController;

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
});
