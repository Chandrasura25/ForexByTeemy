<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    public $fillable = [
        'payment_id',
        'status',
        'reference',
        'amount',
        'paid_at',
        'channel',
        'currency',
        'user_id',
        'email',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
