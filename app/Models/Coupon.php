<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_code',
        'coupon_channel_id',
        'coupon_type',
        'percentage_off',
        'fixed_amount',
        'description',
        'effectivity',
        'status',
        'username',
        'start_date',
        'end_date',
        'minimum_purchase',
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
    public function isCouponValidForUser($user)
    {
        // Check if the coupon is not expired
        if ($this->isExpired()) { 
            return false;
        }

        // Check if the coupon is already used by the user
        if ($this->isAlreadyUsedByUser($user)) {
            return false;
        }

        // Add any other validation rules for the coupon here
        // For example, if you have a "maximum number of uses" restriction, you can check it here.
        // You can also check if the coupon is valid for first purchases or unlimited usage.

        // If all checks pass, the coupon is valid for the user
        return true;
    }

    public function isExpired()
    {
        // Get the start and end dates from the coupon record
        $start_date = $this->start_date;
        $end_date = $this->end_date;

        if (!$start_date && !$end_date) {
            // If both start_date and end_date are not set, the coupon is considered as not expired.
            return false;
        }

        // Get the current date and time using Carbon
        $now = Carbon::now();

        if ($start_date && $now->isBefore($start_date)) {
            // If 'start_date' is set and the current date is before the 'start_date', the coupon is not valid yet.
            return true;
        }

        if ($end_date && $now->isAfter($end_date)) {
            // If 'end_date' is set and the current date is after the 'end_date', the coupon is expired.
            return true;
        }

        // If none of the above conditions are met, the coupon is still valid.
        return false;
    }
    public function isAlreadyUsedByUser($userId) 
    {
        // Check if a cart item with this coupon ID exists for the specified user
        // and the coupon effectivity is 'first purchases'.
        return Cart::where('user_id', $userId) 
            ->where('coupon_id', $this->id) 
            ->whereHas('coupon', function ($query) {
                $query->where('effectivity', 'first purchases');
            })
            ->exists();
    }
}

