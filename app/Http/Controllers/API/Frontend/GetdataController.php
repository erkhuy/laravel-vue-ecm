<?php

namespace App\Http\Controllers\API\Frontend;

use App\Http\Controllers\Controller;
use App\Model\Backend\Product;

class GetdataController extends Controller
{
    public function getNewProduct()
    {
        return Product::orderBy('id', 'desc')->get();
    }
}