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
        Schema::create('upz_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->string('sk_number')->nullable();
            $table->date('sk_date')->nullable();
            $table->date('sk_valid_until')->nullable();
            $table->string('institution_type'); // Instansi Pemerintah, BUMN, BUMD, Swasta, Masjid, Lembaga Pendidikan
            $table->string('parent_baznas_level')->default('BAZNAS RI'); // BAZNAS RI, BAZNAS Provinsi, BAZNAS Kab/Kota
            $table->string('parent_baznas_name')->default('BAZNAS');
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('chairman_name')->nullable();
            $table->string('secretary_name')->nullable();
            $table->string('treasurer_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->decimal('amil_share_percentage', 5, 2)->default(12.50); // Maksimal 12.50% per syariat/regulasi
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upz_profiles');
    }
};
