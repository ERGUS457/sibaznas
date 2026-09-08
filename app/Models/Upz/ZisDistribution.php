<?php

namespace App\Models\Upz;

use App\Models\Accounting\JournalEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ZisDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'upz_profile_id',
        'mustahiq_id',
        'distribution_number',
        'distribution_date',
        'fund_type',
        'asnaf_category',
        'program_name',
        'distribution_type',
        'amount',
        'quantity_in_kind',
        'unit_in_kind',
        'description',
        'recipient_identity_name',
        'status',
        'approved_by_user_id',
    ];

    protected $casts = [
        'distribution_date' => 'date',
        'amount' => 'decimal:2',
        'quantity_in_kind' => 'decimal:2',
    ];

    public function upzProfile(): BelongsTo
    {
        return $this->belongsTo(UpzProfile::class);
    }

    public function mustahiq(): BelongsTo
    {
        return $this->belongsTo(Mustahiq::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_user_id');
    }

    public function journalEntry(): MorphOne
    {
        return $this->morphOne(JournalEntry::class, 'reference');
    }
}
