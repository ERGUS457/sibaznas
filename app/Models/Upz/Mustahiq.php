<?php

namespace App\Models\Upz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mustahiq extends Model
{
    use HasFactory;

    protected $fillable = [
        'upz_profile_id',
        'nik',
        'name',
        'asnaf_category',
        'gender',
        'phone',
        'address',
        'city',
        'family_dependents_count',
        'monthly_income',
        'eligibility_notes',
        'survey_date',
        'surveyor_name',
        'is_active',
    ];

    protected $casts = [
        'survey_date' => 'date',
        'monthly_income' => 'decimal:2',
        'family_dependents_count' => 'integer',
        'is_active' => 'boolean',
    ];

    public const ASNAF_LABELS = [
        'fakir' => 'Fakir',
        'miskin' => 'Miskin',
        'amil' => 'Amil',
        'mualaf' => 'Mualaf',
        'riqab' => 'Riqab (Memerdekakan Budak/Hamba)',
        'gharimin' => 'Gharimin (Orang Terlilit Utang Kebutuhan Pokok)',
        'fisabilillah' => 'Fisabilillah (Pejuang di Jalan Allah)',
        'ibnu_sabil' => 'Ibnu Sabil (Musafir Kehabisan Bekal)',
    ];

    public function upzProfile(): BelongsTo
    {
        return $this->belongsTo(UpzProfile::class);
    }

    public function distributions(): HasMany
    {
        return $this->hasMany(ZisDistribution::class);
    }

    public function getAsnafLabelAttribute(): string
    {
        return self::ASNAF_LABELS[$this->asnaf_category] ?? ucfirst($this->asnaf_category);
    }

    public function getTotalReceivedAttribute(): float
    {
        return (float) $this->distributions()->sum('amount');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
