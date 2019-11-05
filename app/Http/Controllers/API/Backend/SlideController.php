<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateSlideRequest;
use App\Http\Requests\Backend\UpdateSlideRequest;
use App\Model\Backend\Slide;
use DB;
use Illuminate\Http\Request;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Slide::Paginate(5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSlideRequest $request)
    {

        if ($request->image) {
            $image = $request->image;
            $nameImg = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/slides/') . $nameImg);
        } else {
            $nameImg = "";
        }

        try {
            DB::beginTransaction();
            $slide = Slide::create([
                'description' => $request->description,
                'image' => $nameImg,
                'status' => $request->status,
            ]);

            DB::commit();
            return \response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
            unlink(\public_path('images/slides/') . $nameImg);
            return \response()->json(['status' => $e]);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(UpdateSlideRequest $request, $id)
    {
        if (strlen($request->image) > 200) {
            $image = $request->image;
            $nameImg = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/slides/') . $nameImg);
        } else {
            $nameImg = $request->image;
        }
        try {
            DB::beginTransaction();
            $slide = Slide::findOrfail($id);
            unlink(public_path('images/slides/') . $slide->image);
            $slide->update([
                'description' => $request->description,
                'image' => $nameImg,
                'status' => $request->status,
            ]);

            DB::commit();
            return \response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
            unlink(\public_path('images/slides/') . $nameImg);
            return \response()->json(['status' => $e]);
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
            $slide = Slide::findorFail($id);
            unlink(public_path('images/slides/') . $slide->image);
            $slide->delete();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();

        }
    }
    public function getSlides()
    {
        return Slide::all()->where('status', 1);
    }
}