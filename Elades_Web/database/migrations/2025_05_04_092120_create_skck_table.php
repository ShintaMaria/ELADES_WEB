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
        Schema::create('skck', function (Blueprint $table) {
            $table->id('no_pengajuan')->primary();
            $table->string('kode_surat', 100)->default('skck');
            $table->string('nama', 100);
            $table->string('nik', 100);
            $table->string('tempat_tgl_lahir', 100);
            $table->string('kebangsaan', 100);
            $table->string('agama', 100);
            $table->string('jenis_kelamin', 10);
            $table->string('status_perkawinan', 100);
            $table->string('pekerjaan', 100);
            $table->string('alamat', 100);
            $table->string('username', 20);
            $table->string('file', 255)->nullable();

            $table->index(['kode_surat', 'nik']);
            $table->index('username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skck');
    }
};