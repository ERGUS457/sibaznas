<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Perbaznas No. 2/2016 Lampiran 1 & 6 (Penerimaan ZIS & Bukti Setor Zakat / BSZ)
     */
    public function up(): void
    {
        Schema::create('upz_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_number')->unique();
            $table->date('transaction_date')->index();
            $table->foreignId('muzaki_id')->nullable()->constrained('muzakis')->nullOnDelete();
            $table->string('muzaki_name');
            $table->string('npwz')->nullable();
            $table->enum('fund_type', [
                'ZAKAT_MAL_INDIVIDUAL',
                'ZAKAT_MAL_ENTITY',
                'ZAKAT_FITRAH',
                'INFAQ_SEDEKAH',
                'DSKL',
            ]);
            $table->decimal('amount', 15, 2);
            $table->string('bsz_number'); // Nomor Bukti Setor Zakat (Lampiran 6)
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upz_receipts');
    }
};
