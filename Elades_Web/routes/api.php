<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIMobile\PengajuanSurat;
use App\Http\Controllers\APIMobile\PengajuanSurat\ApiSuratController;

Route::post('/pengajuan-skck', [ApiSuratController::class, 'storeskck']);

// Route::middleware(['api.key'])
