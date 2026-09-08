<?php

namespace App\Models\Upz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Muzakki extends Model
{
    use HasFactory;

    protected $fillable = [
        'upz_profile_id',
        'type',
        'npwz',
        'nik_or_npwp',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'workplace_or_agency',
        'payroll_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function upzProfile(): BelongsTo
    {
        return $this->belongsTo(UpzProfile::class);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(ZisCollection::class);
    }

    public function getTotalContributedAttribute(): float
    {
        return (float) $this->collections()->sum('amount');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
