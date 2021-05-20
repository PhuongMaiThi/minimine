<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'status',
        'quantity',
        'is_feature',
        'category_id',
    ];
    //relationship to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //relationship to product_detail
    public function product_detail()
    {
        return $this->hasOne(ProductDetail::class);
    }
    //relationship to price
    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    
    public function latestPrice()
    {
        return $this->hasOne(Price::class)
            ->where('begin_date', '<=', date('Y-m-d 00:00:00'))
            ->where('end_date', '>=', date('Y-m-d 00:00:00'))
            ->take(1);
    }
}
