<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'total_price',
        'payment_status',
        'payment_date',
        'reference',
        'channel',
        'currency',
        'amount',
        'payment_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with the Product model (Many-to-One)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
