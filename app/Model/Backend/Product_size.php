<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Product_size extends Model
{
    protected $table = 'product_size';

    protected $fillable = [
        'product_id',
        'size_id',
    ];
}