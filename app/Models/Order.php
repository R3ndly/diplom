<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['user_id', 'product_id', 'quantity', 'order_status', 'shipping_address', 'shipping_cost', 'order_date', 'delivery', 'payment_method'];

    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
}
