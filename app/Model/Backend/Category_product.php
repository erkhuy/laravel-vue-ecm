<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Category_product extends Model
{
    protected $table = 'category_product';
    protected $fillable = [
        'category_id',
        'product_id',

    ];

}