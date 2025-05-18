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
        Schema::create('surat_kehilangan_barang', function (Blueprint $table) {
            $table->increments('no_pengajuan');
            $table->string('kode_surat', 100)->nullable();
            $table->string('username');
            $table->string('nama');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('jenis_kelamin')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat')->nullable();
            $table->string('barang_yang_hilang')->nullable();
            $table->date('hilang_pada_tanggal')->nullable();
            $table->string('tempat_kehilangan')->nullable();
            $table->text('file')->nullable();
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
