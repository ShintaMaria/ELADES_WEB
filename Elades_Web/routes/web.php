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
use App\Http\Controllers\DetailPengajuanController;
use App\Http\Controllers\pengaduan\LaporanSKCKController;
use App\Http\Controllers\surat\SkckController;
use App\Http\Controllers\surat\SktmController;
use App\Http\Controllers\surat\PenghasilanController;
use App\Http\Controllers\TampilanSuratController;
use App\Http\Controllers\laporan\laporan_pengajuan\LaporanPengajuanController;


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

// Forgot Password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

// Route yang hanya bisa diakses saat sudah login
Route::middleware('auth')->group(function () {

    // Dashboard
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

    // Statistik
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik');
    Route::get('/statistik/edit', [StatistikController::class, 'edit'])->name('statistik.edit');
    Route::put('/statistik/update', [StatistikController::class, 'update'])->name('statistik.update');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.deletePhoto');

    //Pengajuan Surat
    Route::get('/skck', [TampilanSuratController::class, 'skck'])->name('skck');
    Route::get('/keramaian', [TampilanSuratController::class, 'keramaian'])->name('keramaian');
    Route::get('/kehilangan-barang', [TampilanSuratController::class, 'kehilangan'])->name('kehilangan');

    //Detail Pengajuan Surat
    Route::get('/skck/{id}', [SkckController::class, 'show'])->name('skck.show');
    Route::get('/kehilangan/{id}', [SkckController::class, 'show'])->name('kehilangan.show');
    Route::get('/keramaian/{id}', [SkckController::class, 'show'])->name('keramaian.show');

    Route::post('detail-pengajuan', [DetailPengajuanController::class, 'detailpengajuan'])->name('detailpengajuan');

    Route::post('/skck/{id}/selesai', [SkckController::class, 'selesai'])->name('skck.selesai');
    Route::post('/kehilangan/{id}/selesai', [SkckController::class, 'selesai'])->name('kehilangan.selesai');
    Route::post('/keramaian/{id}/selesai', [SkckController::class, 'selesai'])->name('keramaian.selesai');

    Route::post('/skck/{id}/tolak', [SkckController::class, 'tolak'])->name('skck.tolak');
    Route::post('/kehilangan/{id}/tolak', [SkckController::class, 'tolak'])->name('kehilangan.tolak');
    Route::post('/keramaian/{id}/tolak', [SkckController::class, 'tolak'])->name('keramaian.tolak');

    // pengajuan surat
    Route::get('/sktm', [Sktmcontroller::class, 'index'])->name('sktm');
    Route::get('/penghasilan', [PenghasilanController::class, 'index'])->name('penghasilan');

    // Tampilan Pengajuan Surat
    Route::get('/keramaian', [TampilanSuratController::class, 'keramaian'])->name('keramaian');
    Route::get('/kehilangan-barang', [TampilanSuratController::class, 'kehilangan'])->name('kehilangan');

    //Detail Pengajuan Surat
    Route::get('/skck/{id}', [SkckController::class, 'show'])->name('skck.show');
    Route::get('/kehilangan/{id}', [SkckController::class, 'show'])->name('kehilangan.show');
    Route::get('/keramaian/{id}', [SkckController::class, 'show'])->name('keramaian.show');

    Route::post('detail-pengajuan', [DetailPengajuanController::class, 'detailpengajuan'])->name('detailpengajuan');

    Route::post('/skck/{id}/selesai', [SkckController::class, 'selesai'])->name('skck.selesai');
    Route::post('/kehilangan/{id}/selesai', [SkckController::class, 'selesai'])->name('kehilangan.selesai');
    Route::post('/keramaian/{id}/selesai', [SkckController::class, 'selesai'])->name('keramaian.selesai');

    Route::post('/skck/{id}/tolak', [SkckController::class, 'tolak'])->name('skck.tolak');
    Route::post('/kehilangan/{id}/tolak', [SkckController::class, 'tolak'])->name('kehilangan.tolak');
    Route::post('/keramaian/{id}/tolak', [SkckController::class, 'tolak'])->name('keramaian.tolak');

    //Laporan pengajuan
    Route::prefix('laporan_pengajuan')->group(function () {
        Route::get('/kehilangan', [LaporanPengajuanController::class, 'kehilangan'])->name('laporan_pengajuan.kehilangan');
        Route::get('/sktm', [LaporanPengajuanController::class, 'sktm'])->name('laporan_pengajuan.sktm');
        Route::get('/skck', [LaporanPengajuanController::class, 'skck'])->name('laporan_pengajuan.skck');
        Route::get('/penghasilan', [LaporanPengajuanController::class, 'penghasilan'])->name('laporan_pengajuan.penghasilan');
        Route::get('/tidakMasuk', [LaporanPengajuanController::class, 'tidakMasuk'])->name('laporan_pengajuan.tidak_masuk_kerja');
        Route::get('/keramaian', [LaporanPengajuanController::class, 'keramaian'])->name('laporan_pengajuan.keramaian');
    });
}); // Lek nambah route, tambahin di atas ini ya gaes, biar ikut kebungkus middleware (cuma bisa diakses kalau sudah login)
// oke