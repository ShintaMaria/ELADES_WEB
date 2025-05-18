<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        // Ambil data notifikasi
        $notifikasi = DB::table('notifikasi_web')->orderBy('tanggal', 'desc')->get();
        $jumlahNotifikasi = $notifikasi->count();

        // Bagikan ke semua view
        View::share('notifikasi', $notifikasi);
        View::share('jumlahNotifikasi', $jumlahNotifikasi);
    }
}