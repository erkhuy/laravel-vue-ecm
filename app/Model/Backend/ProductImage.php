<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'productimages';
    protected $fillable = [
        'image',
        'product_id',
    ];
}
