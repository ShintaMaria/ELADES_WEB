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
       Schema::table('notifikasi_web', function (Blueprint $table) {
            // Add is_read column after nama column
            $table->boolean('is_read')->default(0)->after('nama');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifikasi_web', function (Blueprint $table) {
            $table->dropColumn('is_read');
        });
    }
};