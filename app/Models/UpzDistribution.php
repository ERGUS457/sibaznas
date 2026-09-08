<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpzDistribution extends Model
{
    use HasFactory;

    protected $table = 'upz_distributions';

    protected $fillable = [
        'proof_number',
        'transaction_date',
        'mustahik_id',
        'mustahik_name',
        'mustahik_address',
        'asnaf',
        'program_category',
        'fund_source',
        'amount',
        'journal_entry_id',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public const ASNAFS = [
        'FAKIR'          => 'Fakir',
        'MISKIN'         => 'Miskin',
        'AMIL'           => 'Amil',
        'MUALAF'         => 'Mualaf',
        'RIQAB'          => 'Riqab',
        'GHARIMIN'       => 'Gharimin',
        'FII_SABILILLAH' => 'Fii Sabilillah',
        'IBNU_SABIL'     => 'Ibnu Sabil',
    ];

    public const PROGRAM_CATEGORIES = [
        'PENDIDIKAN'       => 'Pendidikan (Beasiswa & Sarana)',
        'KESEHATAN'        => 'Kesehatan (Layanan & Obat)',
        'KEMANUSIAAN'      => 'Kemanusiaan (Bencana & Santunan)',
        'EKONOMI'          => 'Ekonomi (Modal Usaha Produktif)',
        'DAKWAH_ADVOKASI'  => 'Dakwah & Advokasi',
    ];

    public const FUND_SOURCES = [
        'ZAKAT'         => 'Dana Zakat',
        'INFAQ_SEDEKAH' => 'Dana Infak / Sedekah',
        'DSKL'          => 'Dana Sosial Keagamaan Lainnya (DSKL)',
    ];

    /**
     * Relationship: A distribution belongs to a Mustahik.
     */
    public function mustahik(): BelongsTo
    {
        return $this->belongsTo(Mustahik::class, 'mustahik_id');
    }

    /**
     * Relationship: A distribution links to an accounting Journal Entry.
     */
    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class, 'journal_entry_id');
    }

    public function getAsnafLabelAttribute(): string
    {
        return self::ASNAFS[$this->asnaf] ?? $this->asnaf;
    }

    public function getProgramCategoryLabelAttribute(): string
    {
        return self::PROGRAM_CATEGORIES[$this->program_category] ?? $this->program_category;
    }

    public function getFundSourceLabelAttribute(): string
    {
        return self::FUND_SOURCES[$this->fund_source] ?? $this->fund_source;
    }
}
