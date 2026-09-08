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
        Schema::create('muzakkis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_profile_id')->constrained('upz_profiles')->cascadeOnDelete();
            $table->string('type')->default('individu'); // individu, badan
            $table->string('npwz')->nullable()->index(); // Nomor Pokok Wajib Zakat
            $table->string('nik_or_npwp')->nullable()->index();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('workplace_or_agency')->nullable();
            $table->string('payroll_id')->nullable(); // NIP/Employee ID if payroll deduction
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muzakkis');
    }
};
