<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UpdateProductRequest;
use App\Http\Resources\Backend\ProductResource;
use App\Model\Backend\Product;
use App\Model\Backend\ProductImage;
use DB;
use Illuminate\Http\Request;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(5));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //image product
        if ($request->image) {
            $image = $request->image;
            $nameImg = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/products/') . $nameImg);
        }
        //categori
        $categories = array();
        $sizes = array();
        $colors = array();
        foreach ($request->categories as $val) {
            array_push($categories, ((object) $val)->id);
        }
        foreach ($request->sizes as $val) {
            array_push($sizes, ((object) $val)->id);
        }
        foreach ($request->colors as $val) {
            array_push($colors, ((object) $val)->id);
        }
        $productImages = array();
        foreach ($request->images as $img) {
            $name = time() . '.' . explode('/', explode(':', substr($img, 0, strpos($img, ';')))[1])[1];
            \Image::make($img)->save(public_path('images/products/') . $name);
            array_push($productImages, $name);
        }
        // return $productImages;
        try {
            DB::beginTransaction();
            $productId = DB::table('products')->insertGetId([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $nameImg,
                'status' => $request->status,
                'sale' => $request->sale,
                'amount' => $request->amount,
            ]);
            $product = Product::findOrFail($productId);
            $product->categories()->attach($categories);
            $product->sizes()->attach($sizes);
            $product->colors()->attach($colors);
            if (count($productImages) > 0) {
                foreach ($productImages as $img) {
                    ProductImage::create([
                        'product_id' => $productId,
                        'image' => $img,
                    ]);
                }
            }
            DB::commit();
            return \response()->json(['status' => true]);

        } catch (Exception $e) {
            DB::rollback();
            unlink(public_path('images/products/') . $nameImg);
            foreach ($productImages as $img) {
                unlink(public_path('images/products/') . $img);
            }
            return $e;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        if (strlen($request->image) > 200) {
            $image = $request->image;
            $nameImg = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/products/') . $nameImg);
        } else {
            $nameImg = $request->image;
        }
        // //categori
        $categories = array();
        $sizes = array();
        $colors = array();
        foreach ($request->categories as $val) {
            array_push($categories, ((object) $val)->id);
        }
        foreach ($request->sizes as $val) {
            array_push($sizes, ((object) $val)->id);
        }
        foreach ($request->colors as $val) {
            array_push($colors, ((object) $val)->id);
        }

        try {
            DB::beginTransaction();
            $product = Product::findOrFail($id);
            ($product->image != '') ? '' : unlink(public_path('images/products/') . $product->image);

            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'image' => $nameImg,
                'status' => $request->status,
                'sale' => $request->sale,
                'amount' => $request->amount,
            ]);

            $product->categories()->sync($categories);
            $product->sizes()->sync($sizes);
            $product->colors()->sync($colors);
            //product-image
            $productImages = array();
            foreach ($request->images as $img) {
                if (gettype($img) == 'string') {
                    $name = time() . '.' . explode('/', explode(':', substr($img, 0, strpos($img, ';')))[1])[1];
                    \Image::make($img)->save(public_path('images/products/') . $name);
                    array_push($productImages, $name);

                } else {
                    array_push($productImages, ((object) $img)->image);
                }

            }
            $productImgOlds = ProductImage::where('product_id', $id)->get();
            $imgstemp = array();

            // $xoas = array();
            // $them = array();
            foreach ($productImgOlds as $imgold) {
                array_push($imgstemp, $imgold->image);
                if (!in_array($imgold->image, $productImages)) {
                    ProductImage::destroy($imgold->id);
                    // array_push($xoas, 'xoa' . $imgold->id);
                }

            }

            if (count($productImages) > 0) {
                foreach ($productImages as $img) {
                    if (!in_array($img, $imgstemp)) {
                        ProductImage::create([
                            'product_id' => $id,
                            'image' => $img,
                        ]);
                        //array_push($them, 'them' . $img);
                    }

                }
            }
            // return \response()->json([ 'productimgs' => $productImages, 'productold' => $productImgOlds, 'xoa' => $xoas, 'them' => $them]);
            DB::commit();
            return \response()->json(['status' => true]);

        } catch (Exception $e) {
            DB::rollback();
            unlink(public_path('images/products/') . $nameImg);
            foreach ($productImages as $imgold) {
                if (!in_array($imgold->image, $imgstemp)) {

                    unlink(public_path('images/products/') . $imgold);
                }
            }
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {

            DB::beginTransaction();
            $product = Product::findOrFail($id);
            unlink(public_path('images/products/') . $product->image);
            $images = ProductImage::where('product_id', $id);
            foreach ($images as $proimg) {
                unlink(public_path('images/products/') . $proimg->image);
                ProductImage::destroy($proimg->id);
            }
            $product->categories()->detach();
            $product->sizes()->detach();
            $product->colors()->detach();
            $product->delete();
            DB::commit();
            return \response()->json(['status' => true]);
        } catch (Expectation $e) {
            DB::rollback();
            return $e;
        }
    }
}
