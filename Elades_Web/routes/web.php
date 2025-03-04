<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingpage\LandingPageController; // ✅ Pastikan ini ada
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\pengaduan\InfrastrukturController;
use App\Http\Controllers\pengaduan\KeamananController;
use App\Http\Controllers\pengaduan\SaranController;
use App\Http\Controllers\informasi\KabarDesaController;
// use App\Http\Controllers\informasi\ArtikelTerkiniController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['namespace'=>'App\Http\Controllers\landingpage'],function()
{
    Route::resource('/landing_page',LandingPageController::class);
});

Route::group(['namespace'=>'App\Http\Controllers\dashboard'],function()
{
    Route::resource('/dashboarddd',DashboardController::class);
});

Route::group(['namespace'=>'App\Http\Controllers\pengaduan'],function()
{
    Route::resource('/coba',InfrastrukturController::class);
});

Route::group(['namespace'=>'App\Http\Controllers\pengaduan'],function()
{
    Route::resource('/keamanan',KeamananController::class);
});

Route::group(['namespace'=>'App\Http\Controllers\pengaduan'],function()
{
    Route::resource('/saran',SaranController::class);
});

Route::group(['namespace'=>'App\Http\Controllers\informasi'],function()
{
    Route::resource('/kabardesa',KabarDesaController::class);
});

// Route::group(['namespace'=>'App\Http\Controllers\informasi'],function()
// {
//     Route::resource('/artikel',ArtikelTerkiniController::class);
// });


Route::get('/dashboardd', function () {
    return view('dashboard.dashboardd');
})->name('dashboard');

//move ke landing page (LogOut)
Route::get('/landing_page', function () {
    return view('landingpage.landing_page');
})->name('landingpage');

Route::get('/infrastruktur', function () {
    return view('pengaduan.infrastruktur');
})->name('infras');

Route::get('/keamanan', function () {
    return view('pengaduan.keamanan');
})->name('keamanan');

Route::get('/saran', function () {
    return view('pengaduan.saran');
})->name('saran');

Route::get('/informasi', function () {
    return view('informasi.kabar_desa');
})->name('kabardesa');

// Route::get('/informasi', function () {
//     return view('informasi.artikel_terkini');
// })->name('artikel');