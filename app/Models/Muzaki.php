<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Muzaki extends Model
{
    use HasFactory;

    protected $table = 'muzakis';

    protected $fillable = [
        'npwz',
        'name',
        'identity_number',
        'phone',
        'email',
        'address',
    ];

    /**
     * Relationship: A Muzaki has many ZIS receipts / BSZ.
     */
    public function receipts(): HasMany
    {
        return $this->hasMany(UpzReceipt::class, 'muzaki_id');
    }

    public function upzReceipts(): HasMany
    {
        return $this->receipts();
    }

    /**
     * Total contributed amount across all receipts.
     */
    public function getTotalContributedAttribute(): float
    {
        return (float) $this->receipts()->sum('amount');
    }
}
