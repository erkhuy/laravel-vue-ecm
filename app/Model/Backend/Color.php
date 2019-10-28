<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';

    protected $fillable = [
        'color',
    ];
    public $timestamps = false;
}
