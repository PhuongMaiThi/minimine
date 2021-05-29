<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'status',
        'quantity',
        'is_feature',
        'category_id',
        'price',
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
    
    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }
    
    public function latestPrice()
    {
        $currentdate = date('Y-m-01 H:i:s');

        return $this->hasOne(Price::class)
            ->where('end_date', '>=', $currentdate)
            ->where('status', Price::STATUS[1])
            ->first();
    }
}
