<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateCategoryRequest;
use App\Http\Requests\Backend\UpdateCategoryRequest;
use App\Http\Resources\Backend\CategoryResource;
use App\Model\Backend\Category;
use DB;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::paginate(5));

    }
    public function store(CreateCategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            Category::create($request->all());

            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => $e]);
        }
    }
    public function show($id)
    {
        $cate = Category::find(2);
        return $cate;
    }
    public function update(UpdateCategoryRequest $request, $id)
    {
        try {
            DB::beginTransaction();

            $category = Category::findOrFail($id);
            $category->update([
                'name' => $request->name,
                'parent_id' => ((object) $request->parent_id)->id,
            ]);

            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => $e]);
        }

    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $status = $category->delete();

    }
}