<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpzOperationalExpense extends Model
{
    use HasFactory;

    protected $table = 'upz_operational_expenses';

    protected $fillable = [
        'expense_date',
        'category',
        'amount',
        'description',
        'journal_entry_id',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public const CATEGORIES = [
        'BELANJA_PEGAWAI'       => 'Belanja Pegawai (Honor / Insentif Amil UPZ)',
        'PUBLIKASI_DOKUMENTASI' => 'Biaya Publikasi dan Dokumentasi',
        'PERJALANAN_DINAS'      => 'Biaya Perjalanan Dinas',
        'ADMINISTRASI_UMUM'     => 'Beban Administrasi Umum (ATK & Operasional Kantor)',
        'PENYUSUTAN'            => 'Beban Penyusutan Aset Tetap',
        'PENGADAAN_ASET'        => 'Pengadaan Aset Tetap',
        'PIHAK_KETIGA'          => 'Biaya Jasa Pihak Ketiga',
        'LAINNYA'               => 'Penggunaan Lain Dana Operasional',
    ];

    /**
     * Relationship: An operational expense links to an accounting Journal Entry.
     */
    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class, 'journal_entry_id');
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? $this->category;
    }
}
