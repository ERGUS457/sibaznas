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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. '1101', '3101'
            $table->string('name');
            $table->enum('category', [
                'ASSET',
                'LIABILITY',
                'NET_ASSET',
                'REVENUE',
                'EXPENSE'
            ]);
            $table->enum('sub_category', [
                'CURRENT_ASSET',
                'NON_CURRENT_ASSET',
                'CURRENT_LIABILITY',
                'NON_CURRENT_LIABILITY',
                'NET_ASSET_UNRESTRICTED_SURPLUS',
                'NET_ASSET_UNRESTRICTED_OCI',
                'NET_ASSET_RESTRICTED'
            ]);
            $table->enum('normal_balance', [
                'DEBIT',
                'CREDIT'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
