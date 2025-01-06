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
        Schema::table('perwalian', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tahun'); // Menambahkan kolom id_tahun sebagai foreign key

            // Menambahkan foreign key constraint dengan onUpdate dan onDelete cascade
            $table->foreign('id_tahun')
                ->references('id_tahun')
                ->on('tahun')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perwalian', function (Blueprint $table) {
            $table->dropForeign(['id_tahun']); // Menghapus foreign key
            $table->dropColumn('id_tahun');    // Menghapus kolom id_tahun
        });
    }
};
