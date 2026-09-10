<?php

namespace App\Models\Upz;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UpzProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'sk_number',
        'sk_date',
        'sk_valid_until',
        'institution_type',
        'parent_baznas_level',
        'parent_baznas_name',
        'address',
        'city',
        'province',
        'phone',
        'email',
        'chairman_name',
        'secretary_name',
        'treasurer_name',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'amil_share_percentage',
        'is_active',
    ];

    protected $casts = [
        'sk_date' => 'date',
        'sk_valid_until' => 'date',
        'amil_share_percentage' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function muzakkis(): HasMany
    {
        return $this->hasMany(Muzakki::class);
    }

    public function mustahiqs(): HasMany
    {
        return $this->hasMany(Mustahiq::class);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(ZisCollection::class);
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(ZisDistribution::class);
    }

    public function remittances(): HasMany
    {
        return $this->hasMany(BaznasRemittance::class);
    }

    public function zisCollections(): HasMany
    {
        return $this->hasMany(ZisCollection::class);
    }

    public function zisDistributions(): HasMany
    {
        return $this->hasMany(ZisDistribution::class);
    }

    public function journalEntries(): HasMany
    {
        return $this->hasMany(\App\Models\Accounting\JournalEntry::class, 'upz_profile_id');
    }
}
