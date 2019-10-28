<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $table = 'slides';
    protected $fillable = [
        'image',
        'status',
        'description',
    ];
}