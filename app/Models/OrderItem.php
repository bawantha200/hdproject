<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //
    public function product()
    {
        return $this->belongsTo(Vehicle::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }   
    
    // public function review()
    // {
    //     return $this->hasOne(Review::class,'order_item_id');
    // }
}
