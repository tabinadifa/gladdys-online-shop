<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'name', 'phone', 'address', 'courier', 'payment_method', 'total_price', 'shipping_cost', 'cart_items', 'status',
        'shipping_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
