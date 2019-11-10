<?php

namespace App\Http\Controllers\API\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\ProductResource;
use App\Model\Backend\Product;

class GetdataController extends Controller
{
    // product
    public function getNewProduct()
    {
        return Product::where('status', 1)->orderBy('id', 'desc')->get();
    }
    public function getProduct($id)
    {
        $product = new ProductResource(Product::findOrFail($id));
        return \response()->json($product);
    }

}