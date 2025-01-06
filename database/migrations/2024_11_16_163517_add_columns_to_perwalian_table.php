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
            $table->integer('uts')->nullable();
            $table->integer('uas')->nullable();
            $table->decimal('na', 8, 2)->nullable();
            $table->string('index', 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perwalian', function (Blueprint $table) {
            $table->dropColumn(['uts', 'uas', 'na', 'index']);
        });
    }
};
