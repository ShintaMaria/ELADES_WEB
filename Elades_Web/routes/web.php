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
use App\Http\Controllers\surat\SkckController;
use App\Http\Controllers\surat\Sktmcontroller;
use App\Http\Controllers\surat\PenghasilanController;
use App\Http\Controllers\surat\KehilanganBarangController;
use App\Http\Controllers\surat\IzinKerjaController;
use App\Http\Controllers\surat\IzinKeramaianController;
use App\Http\Controllers\TampilanSuratController;
use App\Http\Controllers\laporan\LaporanPengajuanController;
use App\Http\Controllers\laporan\LaporanPengaduanController;
use App\Http\Controllers\NotifikasiController;

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
    Route::get('/dashboardd', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::put('/profile/email', [ProfileController::class, 'updateEmail'])->name('profile.updateEmail');
    
    //Pengajuan Surat
    //PENGANTAR SKCK
    Route::get('/skck', [SkckController::class, 'index'])->name('skck');
    Route::put('/skck/{id}/selesai', [SkckController::class, 'selesai'])->name('skck.selesai');
    Route::put('/skck/{id}/tolak', [SkckController::class, 'tolak'])->name('skck.tolak');
    Route::get('/skck/{id}/preview', [SkckController::class, 'preview'])->name('skck.preview');
    Route::get('/skck/{id}/cetak', [SkckController::class, 'cetak'])->name('skck.cetak');

    //Kehilangan Barang
    Route::get('/kehilangan-barang', [KehilanganBarangController::class, 'index'])->name('kehilangan');
    Route::put('/kehilangan/{id}/selesai', [KehilanganBarangController::class, 'selesai'])->name('kehilangan.selesai');
    Route::put('/kehilangan/{id}/tolak', [KehilanganBarangController::class, 'tolak'])->name('kehilangan.tolak');
    Route::get('/kehilangan/{id}/preview', [KehilanganBarangController::class, 'preview'])->name('kehilangan.preview');
    Route::get('/kehilangan/{id}/cetak', [KehilanganBarangController::class, 'cetak'])->name('kehilangan.cetak');

    //SKTM
    Route::get('/sktm', [SktmController::class, 'index'])->name('sktm');
    Route::put('/sktm/{id}/selesai', [SktmController::class, 'selesai'])->name('sktm.selesai');
    Route::put('/sktm/{id}/tolak', [SktmController::class, 'tolak'])->name('sktm.tolak');
    Route::get('/sktm/{id}/preview', [SktmController::class, 'preview'])->name('sktm.preview');
    Route::get('/sktm/{id}/cetak', [SktmController::class, 'cetak'])->name('sktm.cetak');

    //Penghasilan Ortu
    Route::get('/penghasilan', [PenghasilanController::class, 'index'])->name('penghasilan');
    Route::put('/penghasilan/{id}/selesai', [PenghasilanController::class, 'selesai'])->name('penghasilan.selesai');
    Route::put('/penghasilan/{id}/tolak', [PenghasilanController::class, 'tolak'])->name('penghasilan.tolak');
    Route::get('/penghasilan/{id}/preview', [PenghasilanController::class, 'preview'])->name('penghasilan.preview');
    Route::get('/penghasilan/{id}/cetak', [PenghasilanController::class, 'cetak'])->name('penghasilan.cetak');

    //Izin Kerja
    Route::get('/izin-kerja', [IzinKerjaController::class, 'index'])->name('izinkerja');
    Route::put('/izin-kerja/{id}/selesai', [IzinKerjaController::class, 'selesai'])->name('izinkerja.selesai');
    Route::put('/izin-kerja/{id}/tolak', [IzinKerjaController::class, 'tolak'])->name('izinkerja.tolak');
    Route::get('/izin-kerja/{id}/preview', [IzinKerjaController::class, 'preview'])->name('izinkerja.preview');
    Route::get('/izin-kerja/{id}/cetak', [IzinKerjaController::class, 'cetak'])->name('izinkerja.cetak');

    //Izin Keramaian
    Route::get('/izin-keramaian', [IzinKeramaianController::class, 'index'])->name('keramaian');
    Route::put('/izin-keramaian/{id}/selesai', [IzinKeramaianController::class, 'selesai'])->name('keramaian.selesai');
    Route::put('/izin-keramaian/{id}/tolak', [IzinKeramaianController::class, 'tolak'])->name('keramaian.tolak');
    Route::get('/izin-keramaian/{id}/preview', [IzinKeramaianController::class, 'preview'])->name('keramaian.preview');
    Route::get('/izin-keramaian/{id}/cetak', [IzinKeramaianController::class, 'cetak'])->name('keramaian.cetak');

    //Laporan pengajuan
    // Route::get('/laporan', [LaporanPengajuanController::class, 'show'])->name('laporan_pengajuan');
    Route::get('/laporan/pengajuan', [LaporanPengajuanController::class, 'show'])->name('laporan_pengajuan');
Route::get('/laporan/pengajuan/download', [LaporanPengajuanController::class, 'download'])->name('laporan_pengajuan.download');
    //Pengaduan
    //Pengaduan Infrastruktur
    Route::get('/infrastruktur', [InfrastrukturController::class, 'index'])->name('infrastruktur');
    Route::put('/infrastruktur/{id}/selesai', [InfrastrukturController::class, 'selesai'])->name('infrastruktur.selesai');
    Route::put('/infrastruktur/{id}/tolak', [InfrastrukturController::class, 'tolak'])->name('infrastruktur.tolak');

    //Pengaduan Keamanan
    Route::get('/keamanan', [KeamananController::class, 'index'])->name('keamanan');
    Route::put('/keamanan/{id}/selesai', [KeamananController::class, 'selesai'])->name('keamanan.selesai');
    Route::put('/keamanan/{id}/tolak', [KeamananController::class, 'tolak'])->name('keamanan.tolak');

    //Pengaduan Saran
    Route::get('/saran', [SaranController::class, 'index'])->name('saran');
    Route::put('/saran/{id}/selesai', [SaranController::class, 'selesai'])->name('saran.selesai');
    Route::put('/saran/{id}/tolak', [SaranController::class, 'tolak'])->name('saran.tolak');

    //Laporan Pengaduan
    Route::get('/laporan-pengaduan', [LaporanPengaduanController::class, 'show'])->name('laporan_pengaduan');
    Route::get('/laporan-pengaduan/download', [LaporanPengaduanController::class, 'download'])->name('laporan_pengaduan.download');


     //Notifikasi
    Route::get('/notifications', [NotifikasiController::class, 'getNotifications'])->name('notifications.get');
    Route::post('/notifications/mark-as-read', [NotifikasiController::class, 'markAsRead'])->name('notifications.mark-as-read');
    Route::post('/notifications/mark-all-as-read', [NotifikasiController::class, 'markAllAsRead'])->name('notifications.mark-all-as-read');
    Route::post('/notifikasi/clear', [NotifikasiController::class, 'clearNotifikasi'])->name('notifikasi.clear');


}); // Lek nambah route, tambahin di atas ini ya gaes, biar ikut kebungkus middleware (cuma bisa diakses kalau sudah login)
// oke
