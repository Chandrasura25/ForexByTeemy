<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponChannel extends Model
{
    use HasFactory;
    protected $table = 'coupon_channels';
    
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'coupon_channel_id');
    }
}
