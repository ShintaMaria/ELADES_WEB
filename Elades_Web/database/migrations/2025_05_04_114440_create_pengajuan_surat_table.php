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
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id();
            $table->string('kode_surat', 100);
            $table->string('nik', 255);
            $table->date('tanggal')->useCurrent();
            $table->string('nama', 100);
            $table->string('username', 20);
            $table->integer('no_pengajuan');
            $table->string('ktp_file', 255);

            $table->index(['kode_surat', 'nik']);
            $table->index('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};
