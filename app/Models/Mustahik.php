<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mustahik extends Model
{
    use HasFactory;

    protected $table = 'mustahiks';

    protected $fillable = [
        'identity_number',
        'name',
        'address',
        'phone',
    ];

    /**
     * Relationship: A Mustahik has many distribution aids.
     */
    public function distributions(): HasMany
    {
        return $this->hasMany(UpzDistribution::class, 'mustahik_id');
    }

    public function upzDistributions(): HasMany
    {
        return $this->distributions();
    }

    /**
     * Total assistance amount received by this Mustahik.
     */
    public function getTotalReceivedAttribute(): float
    {
        return (float) $this->distributions()->sum('amount');
    }
}
