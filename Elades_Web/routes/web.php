<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingpage\LandingPageController;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Controllers\login\LoginController;
use App\Http\Controllers\login\GoogleController;
use App\Http\Controllers\login\ForgotPasswordController;
use App\Http\Controllers\login\ResetPasswordController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\pengaduan\InfrastrukturController;
use App\Http\Controllers\pengaduan\KeamananController;
use App\Http\Controllers\pengaduan\SaranController;
use App\Http\Controllers\informasi\KabarDesaController;
use App\Http\Controllers\informasi\ArtikelTerkiniController;
use App\Http\Controllers\informasi\StatistikController;
use App\Http\Controllers\dashboard\ProfileController;
use App\Http\Controllers\pengaduan\LaporanSKCKController;
use App\Http\Controllers\surat\SkckController;
use App\Http\Controllers\surat\SktmController;
use App\Http\Controllers\surat\PenghasilanController;

Route::get('/', function () {
    return view('welcome');
});

// Landing Page
Route::get('/landing_page', [LandingPageController::class, 'index'])->name('landingpage');


// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//forgot
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Dashboard (hanya bisa diakses kalau sudah login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboardd', function () {
        return view('dashboard.dashboardd');
    })->name('dashboard');

    // Pengaduan
Route::get('/infrastruktur', [InfrastrukturController::class, 'index'])->name('infras');
Route::post('/infrastruktur/{id}/update-status', [InfrastrukturController::class, 'updateStatus']);

Route::get('/keamanan', [KeamananController::class, 'index'])->name('keamanan');
Route::get('/saran', [SaranController::class, 'index'])->name('saran');

// Kabar Desa
Route::get('/kabar_desa', [KabarDesaController::class, 'index'])->name('kabardesa');
Route::resource('kabardesa', KabarDesaController::class);

// Artikel Terkini
Route::get('/artikel_terkini', [ArtikelTerkiniController::class, 'index'])->name('artikel');
Route::resource('artikels', ArtikelTerkiniController::class);

// Data Statistik
Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
Route::get('/statistik/edit', [StatistikController::class, 'edit'])->name('statistik.edit');
Route::put('/statistik/update', [StatistikController::class, 'update'])->name('statistik.update');

// Profil
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.deletePhoto');
});

//Pengajuan Surat
Route::get('/skck', [SkckController::class, 'index'])->name('skck');

HEAD
//pengajuan sktm
Route::get('/sktm', [SktmController::class, 'index'])->name('sktm');

//Keterangan Penghasilan
Route::get('/penghasilan', [PenghasilanController::class, 'index'])->name('penghasilan');
<<<<<<< HEAD
    


});//lek nambah route di atase iki ya gaess, biar kebungkus sama midelware (bisa akses halaman saat sudah login saja)







=======

//laporan pengajuan
Route::get('/laporan-skck', [LaporanSKCKController::class, 'index'])->name('laporan-skck.index');
Route::post('/laporan-skck/{id}/update-status', [LaporanSKCKController::class, 'updateStatus']);
>>>>>>> 547d2b52f4a575de5fb7fbbaf62b58113b04c0f4
