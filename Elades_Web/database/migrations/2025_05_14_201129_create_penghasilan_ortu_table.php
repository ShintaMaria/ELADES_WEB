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
        Schema::create('penghasilan_ortu', function (Blueprint $table) {
            $table->integer('no_pengajuan')->primary();
            $table->string('username', 20)->nullable();
            $table->string('kode_surat', 20);
            $table->string('nama_ortu', 255);
            $table->string('tempat_tanggal_lahir_ortu', 50);
            $table->string('pekerjaan_ortu', 255);
            $table->string('alamat_ortu', 255);
            $table->string('nama_anak', 255);
            $table->string('tempat_tanggal_lahir_anak', 50);
            $table->string('alamat_anak', 255);
            $table->string('keperluan', 255);
            $table->string('file', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penghasilan_ortu');
    }
};
