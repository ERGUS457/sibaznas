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
        Schema::create('zis_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_profile_id')->constrained('upz_profiles')->cascadeOnDelete();
            $table->foreignId('mustahiq_id')->nullable()->constrained('mustahiqs')->nullOnDelete();
            $table->string('distribution_number')->unique(); // e.g. DST/2026/09/0001
            $table->date('distribution_date')->index();
            $table->string('fund_type'); // zakat_maal, zakat_fitrah, infak_terikat, infak_tidak_terikat, dskl
            $table->string('asnaf_category'); // fakir, miskin, amil, mualaf, riqab, gharimin, fisabilillah, ibnu_sabil
            $table->string('program_name')->nullable(); // e.g. BAZNAS Cerdas, BAZNAS Peduli, BAZNAS Sehat, BAZNAS Mandiri
            $table->string('distribution_type')->default('konsumtif'); // konsumtif, produktif
            $table->decimal('amount', 15, 2);
            $table->decimal('quantity_in_kind', 10, 2)->nullable();
            $table->string('unit_in_kind')->nullable();
            $table->text('description')->nullable();
            $table->string('recipient_identity_name')->nullable(); // Nama orang yang menerima langsung
            $table->string('status')->default('distributed'); // draft, approved, distributed
            $table->foreignId('approved_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zis_distributions');
    }
};
