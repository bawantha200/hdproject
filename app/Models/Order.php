<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = [
    'user_id', 'subtotal', 'tax', 'total', 'amount', 'balance', 'days',
    'name', 'phone', 'address', 'city', 'status','is_shipping_diffrent'
];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
