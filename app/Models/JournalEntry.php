<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JournalEntry extends Model
{
    use HasFactory;

    protected $table = 'journal_entries';

    protected $fillable = [
        'entry_date',
        'voucher_number',
        'description',
        'source_module',
    ];

    protected $casts = [
        'entry_date' => 'date',
    ];

    public const SOURCE_MODULES = [
        'UPZ_RECEIPT',
        'UPZ_DISTRIBUTION',
        'UPZ_OPERATIONAL',
        'GENERAL',
    ];

    /**
     * Relationship: A journal entry has many journal items.
     */
    public function journalItems(): HasMany
    {
        return $this->hasMany(JournalItem::class, 'journal_entry_id');
    }

    public function items(): HasMany
    {
        return $this->journalItems();
    }

    /**
     * Total debit sum of all items in this entry.
     */
    public function getTotalDebitAttribute(): float
    {
        return (float) ($this->relationLoaded('items') ? $this->items->sum('debit') : $this->items()->sum('debit'));
    }

    /**
     * Total credit sum of all items in this entry.
     */
    public function getTotalCreditAttribute(): float
    {
        return (float) ($this->relationLoaded('items') ? $this->items->sum('credit') : $this->items()->sum('credit'));
    }

    /**
     * Check if debits equal credits.
     */
    public function isBalanced(): bool
    {
        return round($this->total_debit, 2) === round($this->total_credit, 2);
    }

    // Backward compatibility aliases
    public function getEntryNumberAttribute(): ?string
    {
        return $this->voucher_number;
    }

    public function setEntryNumberAttribute(?string $value): void
    {
        $this->attributes['voucher_number'] = $value;
    }

    public function getMemoAttribute(): ?string
    {
        return $this->description;
    }

    public function setMemoAttribute(?string $value): void
    {
        $this->attributes['description'] = $value;
    }
}
