<?php
// FILE: app/Models/CartItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class CartItem extends Model
{
    protected $table    = 'cart_items';
    protected $fillable = ['userId', 'productId', 'quantity'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'id');
    }
}