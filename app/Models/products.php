<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'product_name',
        'product_price',
        'product_photo',
        'product_description',
        'is_active',
        'product_qty'
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id','id');
    }
}
