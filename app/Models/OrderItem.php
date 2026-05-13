<?php
// FILE: app/Models/OrderItem.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table    = 'order_items';
    protected $fillable = ['orderId', 'productId', 'productCategoryId', 'quantity', 'unitPrice', 'totalPrice'];

    public function product()
    {
        return $this->belongsTo(\App\Models\AstromallProduct::class, 'productId', 'id');
    }

    public function order()
    {
        return $this->belongsTo(\App\Models\UserModel\UserOrder::class, 'orderId', 'id');
    }
}