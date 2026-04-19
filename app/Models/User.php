<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'points_balance',
    ];

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
        'password' => 'hashed',
    ];

    public function rewardRedemptions(): HasMany
    {
        return $this->hasMany(RewardRedemption::class);
    }

    public function pointActivityLogs(): HasMany
    {
        return $this->hasMany(PointActivityLog::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getActivePointsAttribute()
    {
        return $this->pointActivityLogs()
            ->where('point_status', 'active')
            ->where('expired_at', '>', now())
            ->sum('points_earned');
    }

    public function getPointsExpiringSoonAttribute()
    {
        return $this->pointActivityLogs()
            ->where('point_status', 'active')
            ->where('expired_at', '<=', now()->addDays(30))
            ->where('expired_at', '>', now())
            ->sum('points_earned');
    }
    
    public function getTotalPointsEarnedAttribute()
    {
        return $this->pointActivityLogs()
            ->where('points_earned', '>', 0)
            ->sum('points_earned');
    }
}
