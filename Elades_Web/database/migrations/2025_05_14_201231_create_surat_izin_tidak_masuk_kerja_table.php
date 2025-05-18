<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('surat_izin_tidak_masuk_kerja', function (Blueprint $table) {
    $table->integer('no_pengajuan')->primary();
    $table->string('username', 20);
    $table->string('kode_surat', 20);
    $table->string('nama', 255);
    $table->string('tempat_tanggal_lahir', 50);
    $table->string('alamat', 255);
    $table->string('tanggal_izin', 50);
    $table->string('alasan', 255);
    $table->string('file', 255);
    $table->string('instansi', 255);
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_izin_tidak_masuk_kerja');
    }
};
