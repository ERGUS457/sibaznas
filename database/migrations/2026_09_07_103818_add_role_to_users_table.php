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
            $table->string('role')->default('pengurus_upz')->after('password'); // superadmin, pengurus_upz, akuntan, baznas_supervisor
            $table->string('phone')->nullable()->after('role');
            $table->unsignedBigInteger('upz_profile_id')->nullable()->index()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'phone', 'upz_profile_id']);
        });
    }
};
