<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSktmTable extends Migration
{
    public function up()
    {
        Schema::create('sktm', function (Blueprint $table) {
            $table->integer('no_pengajuan')->primary();
            $table->string('username', 20)->nullable();
            $table->string('kode_surat', 20)->default('sktm');
            $table->string('nama_bapak', 50)->nullable();
            $table->string('tempat_tanggal_lahir_bapak', 50)->nullable();
            $table->string('pekerjaan_bapak', 50)->nullable();
            $table->string('alamat_bapak', 100)->nullable();
            $table->string('nama_ibu', 50)->nullable();
            $table->string('tempat_tanggal_lahir_ibu', 50)->nullable();
            $table->string('pekerjaan_ibu', 50)->nullable();
            $table->string('alamat_ibu', 100)->nullable();
            $table->string('nama', 50)->nullable();
            $table->string('nik', 25);
            $table->string('tempat_tanggal_lahir_anak', 50)->nullable();
            $table->string('jenis_kelamin_anak', 10)->nullable();
            $table->string('alamat', 100)->nullable();
            $table->text('keperluan');
            $table->string('file', 255)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sktm');
    }
}
