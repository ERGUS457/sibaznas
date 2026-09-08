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
        Schema::create('zis_collections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('upz_profile_id')->constrained('upz_profiles')->cascadeOnDelete();
            $table->foreignId('muzakki_id')->constrained('muzakkis')->cascadeOnDelete();
            $table->string('bsz_number')->unique(); // Nomor Bukti Setor Zakat
            $table->date('transaction_date')->index();
            $table->string('fund_type'); // zakat_maal, zakat_fitrah, infak_terikat, infak_tidak_terikat, dskl, fidyah_kafarat
            $table->string('fund_subtype')->nullable(); // e.g. Zakat Penghasilan/Profesi, Zakat Emas, Zakat Perniagaan
            $table->string('payment_method')->default('kas_tunai'); // kas_tunai, transfer_bank, qris, payroll
            $table->decimal('amount', 15, 2);
            $table->decimal('quantity_in_kind', 10, 2)->nullable(); // e.g. 2.5 kg beras
            $table->string('unit_in_kind')->nullable(); // kg, liter, gram
            $table->decimal('amil_percentage', 5, 2)->default(12.50); // Maksimal 12.50%
            $table->decimal('amil_amount', 15, 2)->default(0);
            $table->decimal('net_fund_amount', 15, 2)->default(0); // Bagian Mustahiq / Dana Terikat
            $table->text('description')->nullable();
            $table->string('reference_number')->nullable(); // No transaksi/struk bank
            $table->string('status')->default('verified'); // verified, posted, cancelled
            $table->foreignId('received_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zis_collections');
    }
};
