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
        Schema::create('pengaduan_keamanan', function (Blueprint $table) {
            $table->increments('no_pengaduan');
            $table->string('username', 20);
            $table->string('kode_pengaduan', 20);
            $table->string('nama');
            $table->string('nik', 16);
            $table->string('jenis_kasus');
            $table->string('lokasi_kejadian');
            $table->string('tanggal', 50);
            $table->string('waktu', 50);
            $table->string('deskripsi');
            $table->string('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keamanan');
    }
};
