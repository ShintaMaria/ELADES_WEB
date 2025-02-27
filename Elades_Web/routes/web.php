<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\landingpage\LandingPageController; // ✅ Pastikan ini ada
use App\Http\Controllers\dashboard\DashboardController;
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

//move ke landing page (LogOut)
Route::get('/landing_page', function () {
    return view('landingpage.landing_page');
})->name('landingpage');