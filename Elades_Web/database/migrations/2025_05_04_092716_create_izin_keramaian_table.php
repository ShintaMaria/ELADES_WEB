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
       Schema::create('surat_izin_keramaian', function (Blueprint $table) {
            $table->integer('no_pengajuan')->primary();
            $table->string('username', 20);
            $table->string('kode_surat', 20);
            $table->string('nama', 255);
            $table->string('alamat', 255);
            $table->string('nik', 255);
            $table->string('kegiatan', 255);
            $table->string('tanggal', 50);
            $table->string('waktu', 50);
            $table->string('tempat', 255);
            $table->string('file', 255);
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
