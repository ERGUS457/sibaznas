<?php

namespace App\Models\Upz;

use App\Models\Accounting\JournalEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class BaznasRemittance extends Model
{
    use HasFactory;

    protected $fillable = [
        'upz_profile_id',
        'remittance_number',
        'remittance_date',
        'period_month',
        'period_year',
        'total_collected',
        'amil_retained',
        'amount_remitted',
        'target_baznas_bank',
        'target_baznas_account_number',
        'proof_file_path',
        'status',
        'notes',
        'verified_at',
        'submitted_by_user_id',
    ];

    protected $casts = [
        'remittance_date' => 'date',
        'period_month' => 'integer',
        'period_year' => 'integer',
        'total_collected' => 'decimal:2',
        'amil_retained' => 'decimal:2',
        'amount_remitted' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    public const MONTH_NAMES = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    public function upzProfile(): BelongsTo
    {
        return $this->belongsTo(UpzProfile::class);
    }

    public function submittedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'submitted_by_user_id');
    }

    public function journalEntry(): MorphOne
    {
        return $this->morphOne(JournalEntry::class, 'reference');
    }

    public function getPeriodLabelAttribute(): string
    {
        return (self::MONTH_NAMES[$this->period_month] ?? $this->period_month) . ' ' . $this->period_year;
    }
}
