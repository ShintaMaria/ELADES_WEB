<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingpage\LandingPageController;
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
<<<<<<< HEAD
use App\Http\Controllers\surat\SktmController;
use App\Http\Controllers\surat\PenghasilanController;
=======
use App\Http\Controllers\TampilanSuratController;
>>>>>>> f1a33bec875c42393996cd2610314019dad8262e

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

// route yang hanya bisa diakses saat sudah login
Route::middleware('auth')->group(function () {
    
    // dashboard
    Route::get('/dashboardd', function () {
        return view('dashboard.dashboardd');
    })->name('dashboard');

    // pengaduan
    Route::get('/infrastruktur', [InfrastrukturController::class, 'index'])->name('infras');
    Route::post('/infrastruktur/{id}/update-status', [InfrastrukturController::class, 'updateStatus']);
    Route::get('/keamanan', [KeamananController::class, 'index'])->name('keamanan');
    Route::get('/saran', [SaranController::class, 'index'])->name('saran');

    // kabar desa
    Route::get('/kabar_desa', [KabarDesaController::class, 'index'])->name('kabardesa');
    Route::resource('kabardesa', KabarDesaController::class);

    // artikel terkini
    Route::get('/artikel_terkini', [ArtikelTerkiniController::class, 'index'])->name('artikel');
    Route::resource('artikels', ArtikelTerkiniController::class);

    // data statistik
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
    Route::get('/statistik/edit', [StatistikController::class, 'edit'])->name('statistik.edit');
    Route::put('/statistik/update', [StatistikController::class, 'update'])->name('statistik.update');

    // profil pengguna
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.deletePhoto');

<<<<<<< HEAD
    // pengajuan surat
    Route::get('/skck', [SkckController::class, 'index'])->name('skck');
    Route::get('/sktm', [SktmController::class, 'index'])->name('sktm');
    Route::get('/penghasilan', [PenghasilanController::class, 'index'])->name('penghasilan');

    // laporan pengajuan
    Route::get('/laporan-skck', [LaporanSKCKController::class, 'index'])->name('laporan-skck.index');
    Route::post('/laporan-skck/{id}/update-status', [LaporanSKCKController::class, 'updateStatus']);

    
});// lek nambah route, tambahin di atas ini ya gaes, biar ikut kebungkus middleware (cuma bisa diakses kalau sudah login)
=======
//Pengajuan Surat
Route::get('/skck', [TampilanSuratController::class, 'skck'])->name('skck');
Route::get('/keramaian', [TampilanSuratController::class, 'keramaian'])->name('keramaian');
Route::get('/kehilangan-barang', [TampilanSuratController::class, 'kehilangan'])->name('kehilangan');

//Detail Pengajuan Surat
Route::get('/skck/{id}', [SkckController::class, 'show'])->name('skck.show');
Route::get('/kehilangan/{id}', [SkckController::class, 'show'])->name('kehilangan.show');
Route::get('/keramaian/{id}', [SkckController::class, 'show'])->name('keramaian.show');


Route::post('/skck/{id}/selesai', [SkckController::class, 'selesai'])->name('skck.selesai');
Route::post('/kehilangan/{id}/selesai', [SkckController::class, 'selesai'])->name('kehilangan.selesai');
Route::post('/keramaian/{id}/selesai', [SkckController::class, 'selesai'])->name('keramaian.selesai');

Route::post('/skck/{id}/tolak', [SkckController::class, 'tolak'])->name('skck.tolak');
Route::post('/kehilangan/{id}/tolak', [SkckController::class, 'tolak'])->name('kehilangan.tolak');
Route::post('/keramaian/{id}/tolak', [SkckController::class, 'tolak'])->name('keramaian.tolak');

//
>>>>>>> f1a33bec875c42393996cd2610314019dad8262e
