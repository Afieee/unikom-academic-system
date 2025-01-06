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
        Schema::table('akademisi', function (Blueprint $table) {
            // Pastikan untuk menambahkan kolom jika belum ada
            if (!Schema::hasColumn('akademisi', 'id_jurusan')) {
                $table->unsignedBigInteger('id_jurusan')->nullable()->after('semester');

                // Menambahkan foreign key constraint jika perlu
                $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('akademisi', function (Blueprint $table) {
            $table->dropForeign(['id_jurusan']); // Menghapus foreign key jika rollback
            $table->dropColumn('id_jurusan'); // Menghapus kolom id_jurusan
        });
    }
};
