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
        Schema::create('pengaduan_infrastruktur', function (Blueprint $table) {
            $table->increments('no_pengaduan');
            $table->string('username', 20);
            $table->string('kode_pengaduan', 20);
            $table->string('nama');
            $table->string('nik', 16);
            $table->string('alamat');
            $table->string('jenis_infrastruktur');
            $table->string('deskripsi');
            $table->string('tanggal_kejadian', 10);
            $table->string('file');
            $table->string('lokasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('infrastruktur');
    }
};
