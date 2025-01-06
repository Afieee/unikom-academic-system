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
        Schema::dropIfExists('penilaian');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_perwalian');
            $table->string('nilai');
            $table->timestamps();

            // Menambahkan kembali foreign key (jika perlu)
            $table->foreign('id_perwalian')->references('id')->on('perwalian')->onDelete('cascade');
        });
    }
};
