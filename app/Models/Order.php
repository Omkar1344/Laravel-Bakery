<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'delivery_time',
        'payment_method',
        'payment_id',
        'payment_status',
        'total',
        'delivery_fee'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
} 