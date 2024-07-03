<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'order_date',
        'order_status',
        'total_price'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
