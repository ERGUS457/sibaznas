<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Perbaznas No. 2/2016 Lampiran 2, 3, & 7 (Penyaluran Berdasarkan Asnaf & Program)
     */
    public function up(): void
    {
        Schema::create('upz_distributions', function (Blueprint $table) {
            $table->id();
            $table->string('proof_number')->unique(); // Nomor Bukti Penyaluran (Lampiran 7)
            $table->date('transaction_date')->index();
            $table->foreignId('mustahik_id')->nullable()->constrained('mustahiks')->nullOnDelete();
            $table->string('mustahik_name');
            $table->text('mustahik_address')->nullable();
            $table->enum('asnaf', [
                'FAKIR',
                'MISKIN',
                'AMIL',
                'MUALAF',
                'RIQAB',
                'GHARIMIN',
                'FII_SABILILLAH',
                'IBNU_SABIL',
            ]);
            $table->enum('program_category', [
                'PENDIDIKAN',
                'KESEHATAN',
                'KEMANUSIAAN',
                'EKONOMI',
                'DAKWAH_ADVOKASI',
            ]);
            $table->enum('fund_source', [
                'ZAKAT',
                'INFAQ_SEDEKAH',
                'DSKL',
            ]);
            $table->decimal('amount', 15, 2);
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upz_distributions');
    }
};
