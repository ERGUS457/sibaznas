<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Account extends Model
{
    use HasFactory;

    protected $table = 'accounts';

    protected $fillable = [
        'code',
        'name',
        'category',
        'sub_category',
        'normal_balance',
    ];

    public const CATEGORIES = [
        'ASSET',
        'LIABILITY',
        'NET_ASSET',
        'REVENUE',
        'EXPENSE',
    ];

    public const SUB_CATEGORIES = [
        'CURRENT_ASSET',
        'NON_CURRENT_ASSET',
        'CURRENT_LIABILITY',
        'NON_CURRENT_LIABILITY',
        'NET_ASSET_UNRESTRICTED_SURPLUS',
        'NET_ASSET_UNRESTRICTED_OCI',
        'NET_ASSET_RESTRICTED',
    ];

    public const NORMAL_BALANCES = [
        'DEBIT',
        'CREDIT',
    ];

    /**
     * Relationship: An account has many journal items.
     */
    public function journalItems(): HasMany
    {
        return $this->hasMany(JournalItem::class, 'account_id');
    }

    public function items(): HasMany
    {
        return $this->journalItems();
    }

    /**
     * Scope to keep compatibility with existing active queries.
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query;
    }

    /**
     * Calculate current net balance according to normal balance (DEBIT / CREDIT).
     */
    public function getBalanceAttribute(): float
    {
        $debit = (float) $this->journalItems()->sum('debit');
        $credit = (float) $this->journalItems()->sum('credit');

        return strtoupper($this->normal_balance ?? '') === 'DEBIT' ? ($debit - $credit) : ($credit - $debit);
    }

    /**
     * Calculate balance within a given date range.
     */
    public function getBalanceBetween(?string $startDate = null, ?string $endDate = null): float
    {
        $query = $this->journalItems()->whereHas('journalEntry', function ($q) use ($startDate, $endDate) {
            if ($startDate) {
                $q->where('entry_date', '>=', $startDate);
            }
            if ($endDate) {
                $q->where('entry_date', '<=', $endDate);
            }
        });

        $debit = (float) $query->sum('debit');
        $credit = (float) $query->sum('credit');

        return strtoupper($this->normal_balance ?? '') === 'DEBIT' ? ($debit - $credit) : ($credit - $debit);
    }

    /**
     * Backward compatibility classification accessor for DE ISAK 35 report groupings.
     */
    public function getClassificationAttribute(): string
    {
        return match ($this->sub_category) {
            'CURRENT_ASSET' => 'aset_lancar',
            'NON_CURRENT_ASSET' => 'aset_tidak_lancar',
            'CURRENT_LIABILITY' => 'liabilitas_jangka_pendek',
            'NON_CURRENT_LIABILITY' => 'liabilitas_jangka_panjang',
            'NET_ASSET_UNRESTRICTED_SURPLUS' => ($this->category === 'REVENUE' ? 'pendapatan_tanpa_pembatasan' : ($this->category === 'EXPENSE' ? 'beban_manajemen_umum' : 'aset_bersih_tanpa_pembatasan')),
            'NET_ASSET_UNRESTRICTED_OCI' => 'aset_bersih_tanpa_pembatasan',
            'NET_ASSET_RESTRICTED' => ($this->category === 'REVENUE' ? 'pendapatan_dengan_pembatasan' : ($this->category === 'EXPENSE' ? 'beban_program' : 'aset_bersih_dengan_pembatasan')),
            default => strtolower((string) ($this->sub_category ?? $this->category ?? '')),
        };
    }

    public function getClassificationLabelAttribute(): string
    {
        return ucwords(str_replace('_', ' ', $this->sub_category ?? $this->category ?? ''));
    }
}
