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
        Schema::create('mustahiqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_profile_id')->constrained('upz_profiles')->cascadeOnDelete();
            $table->string('nik')->nullable()->index();
            $table->string('name');
            $table->string('asnaf_category'); // fakir, miskin, amil, mualaf, riqab, gharimin, fisabilillah, ibnu_sabil
            $table->string('gender')->nullable(); // L, P
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->integer('family_dependents_count')->default(0);
            $table->decimal('monthly_income', 15, 2)->default(0);
            $table->text('eligibility_notes')->nullable();
            $table->date('survey_date')->nullable();
            $table->string('surveyor_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mustahiqs');
    }
};
