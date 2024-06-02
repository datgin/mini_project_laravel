<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authen extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'verify_code',
        'authenticated',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
