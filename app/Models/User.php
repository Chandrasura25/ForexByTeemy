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
        'email',
        'password',
        'username',
        'coupon_code',
        'ref_source',
        'referrer',
        'credits',
        'referral_link',
        'coupon_percent',
        'personal_coupon',
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
        public function credits()
    {
        return $this->hasMany(Credit::class, 'user_id', 'id');
    }
    public function refSources()
    {
        return $this->hasMany(RefSource::class, 'user_id', 'id');
    }
    public function referredCredits()
    {
        return $this->hasMany(Credit::class, 'username', 'username');
    }
    
    public function referredUsers()
    {
        return $this->hasMany(User::class, 'referrer', 'username');
    }
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }
}
