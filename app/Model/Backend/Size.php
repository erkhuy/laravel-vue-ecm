<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';

    protected $fillable = [
        'size',
    ];
    public $timestamps = false;
}