<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = ['title', 'price', 'brand', 'delivery', 'category', 'warranty', 'material', 'power_supply', 'image'];
    
    public $timestamps = false;

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
