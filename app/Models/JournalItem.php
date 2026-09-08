<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JournalItem extends Model
{
    use HasFactory;

    protected $table = 'journal_items';

    protected $fillable = [
        'journal_entry_id',
        'account_id',
        'debit',
        'credit',
        'restriction_type',
    ];

    protected $casts = [
        'debit' => 'decimal:2',
        'credit' => 'decimal:2',
    ];

    public const RESTRICTION_TYPES = [
        'WITHOUT_RESTRICTION',
        'WITH_RESTRICTION',
    ];

    /**
     * Relationship: A journal item belongs to a journal entry.
     */
    public function journalEntry(): BelongsTo
    {
        return $this->belongsTo(JournalEntry::class, 'journal_entry_id');
    }

    public function entry(): BelongsTo
    {
        return $this->journalEntry();
    }

    /**
     * Relationship: A journal item belongs to an account.
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * Set restriction type and normalize legacy values.
     */
    public function setRestrictionTypeAttribute($value): void
    {
        $val = strtoupper((string) $value);
        if (in_array($val, ['WITH_RESTRICTION', 'DENGAN_PEMBATASAN'])) {
            $this->attributes['restriction_type'] = 'WITH_RESTRICTION';
        } else {
            $this->attributes['restriction_type'] = 'WITHOUT_RESTRICTION';
        }
    }
}
