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
            $table->renameColumn('id', 'id_users');
            $table->dropColumn('email');
            $table->string('role')->after('password')->require();
            $table->dropColumn('email_verified_at');
            $table->dropColumn('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('id_users', 'id');
            $table->string('email');
            $table->dropColumn('role');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
        });
    }
};
