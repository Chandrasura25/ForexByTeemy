<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_code',
        'coupon_channel_id',
        'coupon_type',
        'description',
        'effectivity',
        'username',
    ];
    public function couponChannel()
    {
        return $this->belongsTo(CouponChannel::class, 'coupon_channel_id');
    }
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
