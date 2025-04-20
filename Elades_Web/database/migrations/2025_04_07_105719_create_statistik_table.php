<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('statistik', function (Blueprint $table) {
            $table->id();
            $table->integer('total_jiwa');
            $table->integer('jumlah_kk');
            $table->integer('jumlah_dusun');
            $table->float('luas_wilayah'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('statistik');
    }
};
