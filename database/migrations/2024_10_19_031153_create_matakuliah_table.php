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
        Schema::create('matakuliah', function (Blueprint $table) {
            $table->id('id_matakuliah'); // Kolom id_matakuliah
            $table->string('nama_matakuliah'); // Kolom nama_matakuliah
            $table->integer('sks'); // Kolom sks
            $table->foreignId('id_jurusan')
                  ->constrained('jurusan', 'id_jurusan')
                  ->onDelete('cascade')  // Menambahkan opsi cascade saat dihapus
                  ->onUpdate('cascade'); // Menambahkan opsi cascade saat diperbarui
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matakuliah');
    }
};
