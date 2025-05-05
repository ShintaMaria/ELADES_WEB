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
        Schema::create('izin_keramaian', function (Blueprint $table) {
            $table->id('no_pengajuan')->primary();
            $table->string('kode_surat', 50)->default('keramaian');
            $table->string('nik', 16);
            $table->string('nama', 100);
            $table->string('hari', 20);
            $table->date('tanggal');
            $table->time('waktu');
            $table->string('tempat', 100);
            $table->string('acara', 100);
            $table->string('username', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izin_keramaian');
    }
};
