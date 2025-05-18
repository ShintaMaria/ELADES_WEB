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
    $table->integer('no_pengajuan')->primary();
    $table->string('kode_surat', 100)->nullable();
    $table->string('username', 255);
    $table->string('nama', 255);
    $table->string('tempat_lahir', 100)->nullable();
    $table->date('tanggal_lahir')->nullable();
    $table->string('agama', 100)->nullable();
    $table->string('jenis_kelamin', 100)->nullable();
    $table->string('pekerjaan', 100)->nullable();
    $table->string('alamat', 255)->nullable();
    $table->string('barang_yang_hilang', 255)->nullable();
    $table->date('hilang_pada_tanggal')->nullable();
    $table->string('tempat_kehilangan', 255)->nullable();
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
