<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory;

    protected $table = 'prices';

    protected $fillable = [
        'price',
        'product_id',
        'begin_date',
        'end_date',
        'status',
    ];

    public const STATUS = [
        0, // Private
        1, // Public 
    ];
}
