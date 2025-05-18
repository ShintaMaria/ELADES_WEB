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
        Schema::create('pengaduan_saran', function (Blueprint $table) {
            $table->increments('no_pengaduan');
            $table->string('kode_pengaduan', 20);
            $table->string('nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('topik');
            $table->string('judul_saran');
            $table->string('deskripsi');
            $table->string('tanggal', 20);
            $table->string('file')->nullable();
            $table->string('username', 50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saran');
    }
};
