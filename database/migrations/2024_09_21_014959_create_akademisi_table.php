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
        Schema::create('akademisi', function (Blueprint $table) {
            $table->id('nim_atau_nip');
            $table->string('name', 50);
            $table->string('email', 50);
            $table->string('no_handphone', 50);
            $table->string('role', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('akademisi');
    }
};
