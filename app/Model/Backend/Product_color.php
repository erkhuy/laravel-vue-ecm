<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Product_color extends Model
{
    protected $table = 'product_color';

    protected $fillable = [
        'product_id',
        'color_id',
    ];
}
