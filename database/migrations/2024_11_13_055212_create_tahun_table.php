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
        Schema::create('tahun', function (Blueprint $table) {
            $table->id('id_tahun'); // Primary key dengan nama id_tahun
            $table->integer('tahun_sekarang'); // Kolom untuk menyimpan tahun
            $table->string('tahun_ajaran'); // Kolom untuk menyimpan tahun


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tahun');
    }
};
