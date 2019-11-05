<?php

namespace App\Http\Controllers\API\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Backend\Category;
use App\Http\Resources\Backend\CategoryResource;
class CategoryController extends Controller
{
    public  function getCategories()
    {
        return CategoryResource::collection(Category::all());
    }
}
