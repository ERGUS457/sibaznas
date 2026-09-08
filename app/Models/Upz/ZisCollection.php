<?php

namespace App\Models\Upz;

use App\Models\Accounting\JournalEntry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class ZisCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'upz_profile_id',
        'muzakki_id',
        'bsz_number',
        'transaction_date',
        'fund_type',
        'fund_subtype',
        'payment_method',
        'amount',
        'quantity_in_kind',
        'unit_in_kind',
        'amil_percentage',
        'amil_amount',
        'net_fund_amount',
        'description',
        'reference_number',
        'status',
        'received_by_user_id',
    ];

    protected $casts = [
        'transaction_date' => 'date',
        'amount' => 'decimal:2',
        'quantity_in_kind' => 'decimal:2',
        'amil_percentage' => 'decimal:2',
        'amil_amount' => 'decimal:2',
        'net_fund_amount' => 'decimal:2',
    ];

    public const FUND_TYPES = [
        'zakat_maal' => 'Zakat Maal',
        'zakat_fitrah' => 'Zakat Fitrah',
        'infak_terikat' => 'Infak / Sedekah Terikat',
        'infak_tidak_terikat' => 'Infak / Sedekah Tidak Terikat',
        'dskl' => 'DSKL (Dana Sosial Keagamaan Lainnya)',
        'fidyah_kafarat' => 'Fidyah & Kafarat',
    ];

    public const PAYMENT_METHODS = [
        'kas_tunai' => 'Kas / Tunai',
        'transfer_bank' => 'Transfer Bank',
        'qris' => 'QRIS BAZNAS',
        'payroll' => 'Potong Gaji (Payroll)',
    ];

    public function upzProfile(): BelongsTo
    {
        return $this->belongsTo(UpzProfile::class);
    }

    public function muzakki(): BelongsTo
    {
        return $this->belongsTo(Muzakki::class);
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by_user_id');
    }

    public function getJournalEntryAttribute(): ?JournalEntry
    {
        return JournalEntry::where('description', 'like', "%{$this->bsz_number}%")
            ->with('items.account')
            ->first();
    }

    public function getFundTypeLabelAttribute(): string
    {
        return self::FUND_TYPES[$this->fund_type] ?? ucfirst(str_replace('_', ' ', $this->fund_type));
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return self::PAYMENT_METHODS[$this->payment_method] ?? ucfirst(str_replace('_', ' ', $this->payment_method));
    }
}
