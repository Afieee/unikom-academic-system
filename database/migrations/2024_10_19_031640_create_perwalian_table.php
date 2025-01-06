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
        Schema::create('perwalian', function (Blueprint $table) {
            $table->id('id_perwalian'); // Kolom id_perwalian

            // Kolom nim dan nip dengan foreign key
            $table->unsignedBigInteger('nim'); // Kolom nim
            $table->foreign('nim')->references('nim_atau_nip')->on('akademisi')->onDelete('cascade'); // Foreign key nim

            $table->unsignedBigInteger('nip'); // Kolom nip
            $table->foreign('nip')->references('nim_atau_nip')->on('akademisi')->onDelete('cascade'); // Foreign key nip

            $table->unsignedBigInteger('id_matakuliah'); // Kolom id_matakuliah
            $table->foreign('id_matakuliah')->references('id_matakuliah')->on('matakuliah')->onDelete('cascade'); // Foreign key untuk id_matakuliah

            $table->integer('tahun'); // Kolom tahun
            $table->enum('tahun_ajaran', ['ganjil', 'genap']); // Kolom tahun_ajaran
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perwalian');
    }
};
