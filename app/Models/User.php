<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role',
        'phone',
        'upz_profile_id',
        'status',
        'rejection_reason',
        'verified_at',
    ];

    public function upzProfile(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Upz\UpzProfile::class);
    }

    // ─── Role Helpers ───────────────────────────────────────────────────────────

    public function isSuperAdmin(): bool
    {
        return $this->role === 'superadmin';
    }

    public function isPengurusUpz(): bool
    {
        return in_array($this->role, ['superadmin', 'pengurus_upz']);
    }

    public function isAkuntan(): bool
    {
        return in_array($this->role, ['superadmin', 'akuntan']);
    }

    public function isBaznasSupervisor(): bool
    {
        return in_array($this->role, ['superadmin', 'baznas_supervisor']);
    }

    // ─── Status Helpers ──────────────────────────────────────────────────────────

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'Menunggu Verifikasi',
            'active'   => 'Aktif',
            'rejected' => 'Ditolak',
            default    => 'Tidak Diketahui',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'pending'  => 'yellow',
            'active'   => 'emerald',
            'rejected' => 'red',
            default    => 'gray',
        };
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified_at'       => 'datetime',
    ];
}
