<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'product_type_id',
        'quantity',
        'price',
        'image_path',
        'description',
        'commission',
        'expiration_date',
    ];
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }
}
