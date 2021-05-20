<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $table = 'order_details';

    protected $fillable = [
        'product_id',
        'order_id',
        'price_id',
        'quantity',
    ];

    /**
     * one Order_Detail belongsTo one Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    /**
     * one Order_Detail belongsTo one Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * one Order_Detail belongsTo one Price
     */
    public function price()
    {
        return $this->belongsTo(Price::class, 'price_id', 'id');
    }
}
