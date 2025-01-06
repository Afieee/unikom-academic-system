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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('nim_atau_nip')->required()->after('id_users');
	        $table->foreign('nim_atau_nip')->references('nim_atau_nip')->on('akademisi')->onDelete('restrict');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['nim_atau_nip']);
	        $table->dropColumn('nim_atau_nip');

        });
    }
};
