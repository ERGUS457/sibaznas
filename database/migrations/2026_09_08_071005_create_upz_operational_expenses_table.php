<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Perbaznas No. 2/2016 Lampiran 5 (Penggunaan Dana Operasional Amil UPZ)
     */
    public function up(): void
    {
        Schema::create('upz_operational_expenses', function (Blueprint $table) {
            $table->id();
            $table->date('expense_date')->index();
            $table->enum('category', [
                'BELANJA_PEGAWAI',
                'PUBLIKASI_DOKUMENTASI',
                'PERJALANAN_DINAS',
                'ADMINISTRASI_UMUM',
                'PENYUSUTAN',
                'PENGADAAN_ASET',
                'PIHAK_KETIGA',
                'LAINNYA',
            ]);
            $table->decimal('amount', 15, 2);
            $table->text('description');
            $table->foreignId('journal_entry_id')->nullable()->constrained('journal_entries')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upz_operational_expenses');
    }
};
