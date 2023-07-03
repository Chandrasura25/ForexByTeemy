<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;
    protected $table = 'credits';
    protected $fillable = [
        'user_id',
        'username',
        'amount',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function referrer()
    {
        return $this->belongsTo(User::class, 'username', 'username');
    }
}
