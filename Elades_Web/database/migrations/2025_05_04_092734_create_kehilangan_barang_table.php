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
        Schema::create('kehilangan_barang', function (Blueprint $table) {
            $table->id('no_pengajuan')->primary();
            $table->string('kode_surat', 50)->default('kehilangan');
            $table->string('nik', 16);
            $table->string('nama', 100);
            $table->date('ttl');
            $table->string('agama', 50);
            $table->string('jenis_kelamin', 20);
            $table->string('pekerjaan', 100);
            $table->string('alamat', 100);
            $table->string('barang', 100);
            $table->date('hilang_tgl');
            $table->string('tempat_hilang', 100);
            $table->string('username', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehilangan_barang');
    }
};