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
        Schema::create('baznas_remittances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_profile_id')->constrained('upz_profiles')->cascadeOnDelete();
            $table->string('remittance_number')->unique(); // e.g. SET/BAZNAS/2026/09/0001
            $table->date('remittance_date')->index();
            $table->integer('period_month');
            $table->integer('period_year');
            $table->decimal('total_collected', 15, 2);
            $table->decimal('amil_retained', 15, 2)->default(0); // Bagian hak amil yang dialokasikan ke UPZ
            $table->decimal('amount_remitted', 15, 2); // Nominal disetor ke BAZNAS
            $table->string('target_baznas_bank')->nullable();
            $table->string('target_baznas_account_number')->nullable();
            $table->string('proof_file_path')->nullable();
            $table->string('status')->default('submitted'); // submitted, verified_by_baznas, rejected
            $table->text('notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->foreignId('submitted_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baznas_remittances');
    }
};
