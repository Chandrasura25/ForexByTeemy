<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'public_id',
        'product_id',
        'file_path',
        'file_type',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
