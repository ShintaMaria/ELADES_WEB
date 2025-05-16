<?php

use App\Http\Controllers\Api\dashboardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LupaPasswordController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\Pengaduan\PengaduanController;
use App\Http\Controllers\Api\Pengajuan\IzinController;
use App\Http\Controllers\Api\Pengajuan\KeteranganController;
use App\Http\Controllers\Api\Pengajuan\PengantarController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\RegisterController;

Route::controller(LoginController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/save_google_user', 'saveGoogleUser');
});

Route::get('/users', [UserController::class, 'index']);

Route::controller(LupaPasswordController::class)->group(function () {
    Route::post('/LupaPassword_verifikasi_otp', 'verifyOtp');
    Route::post('/LupaPassword', 'resetPassword');
    Route::post('/send_otp_reset', 'sendOtp');
});

Route::controller(RegisterController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/send_otp', 'sendOtp');
});

Route::controller(dashboardController::class)->group(function () {
    Route::get('/kabar_desa', 'kabardesa');
    Route::post('/status_pengajuan', 'statuspengajuan');
});

//pengajuan
Route::controller(PengantarController::class)->group(function () {
    Route::post('/pengajuan_skck', 'skck');
    Route::post('/pengajuan_kehilangan', 'kehilangan');
});
Route::controller(KeteranganController::class)->group(function () {
    Route::post('/pengajuan_sktm', 'sktm');
    Route::post('/pengajuan_penghasilan', 'penghasilan');
});
Route::controller(IzinController::class)->group(function () {
    Route::post('/pengajuan_TidakMasukKerja', 'TidakMasukKerja');
    Route::post('/pengajuan_keramaian', 'keramaian');
});

//pengaduan
Route::controller(PengaduanController::class)->group(function () {
    Route::post('/pengaduan_infrastruktur', 'infrastruktur');
    Route::post('/pengaduan_keamanan', 'keamanan');
    Route::post('/pengaduan_saran', 'saran');
});

//profile
Route::controller(ProfileController::class)->group(function () {
    Route::post('/upload_profile_image', 'upload_profile_image');
    Route::post('/update_profile', 'update_profile');
    Route::post('/update_password', 'update_password');
});