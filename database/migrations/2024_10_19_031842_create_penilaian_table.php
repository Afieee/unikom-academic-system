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
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id('id_penilaian'); // Kolom id_penilaian
            $table->foreignId('id_perwalian')
                  ->constrained('perwalian', 'id_perwalian')
                  ->onDelete('cascade') // Menambahkan opsi cascade saat dihapus
                  ->onUpdate('cascade'); // Menambahkan opsi cascade saat diperbarui
            $table->integer('uts'); // Kolom untuk UTS
            $table->integer('uas'); // Kolom untuk UAS
            $table->decimal('na', 5, 2); // Kolom untuk nilai akhir dengan presisi 5 dan skala 2
            $table->char('indeks', 1) // Kolom untuk indeks, bertipe CHAR
                  ->check('indeks IN ("A", "B", "C", "D", "E")'); // Membatasi nilai indeks
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian');
    }
};
