<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UpzReceipt extends Model
{
    use HasFactory;

    protected $table = 'upz_receipts';

    protected $fillable = [
        'transaction_number',
        'transaction_date',
        'muzaki_id',
        'muzaki_name',
        'npwz',
        'fund_type',
        'amount',
        'bsz_number',
        'journal_entry_id',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public const FUND_TYPES = [
        'ZAKAT_MAL_INDIVIDUAL' => 'Zakat Mal Perorangan',
        'ZAKAT_MAL_ENTITY'     => 'Zakat Mal Badan/Entitas',
        'ZAKAT_FITRAH'         => 'Zakat Fitrah',
        'INFAQ_SEDEKAH'        => 'Infak / Sedekah',
        'DSKL'                 => 'Dana Sosial Keagamaan Lainnya (DSKL)',
    ];

    /**
     * Relationship: An UPZ receipt belongs to a Muzaki.
     */
    public function muzaki(): BelongsTo
    {
        return $this->belongsTo(Muzaki::class, 'muzaki_id');
    }

    /**
     * Relationship: An UPZ receipt links to an accounting Journal Entry.
     */
    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class, 'journal_entry_id');
    }

    public function getFundTypeLabelAttribute(): string
    {
        return self::FUND_TYPES[$this->fund_type] ?? $this->fund_type;
    }
}
