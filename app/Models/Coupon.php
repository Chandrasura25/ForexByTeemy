<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_code',
        'coupon_channel',
        'coupon_type',
        'discount',
        'effectivity',
        'description',
        'status',
        'username',
        'start_date',
        'end_date',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
