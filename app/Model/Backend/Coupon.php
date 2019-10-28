<?php

namespace App\Model\Backend;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $table = 'coupons';

    protected $fillable = [
        'code',
        'expiry_date',
        'amount',
        'status',
        'type',
        'discount',
    ];
    public $timestamps = false;
}