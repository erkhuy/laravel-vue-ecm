<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Model\Backend\Color;
use DB;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        return \response()->json(Color::paginate(5));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'color' => 'required|unique:colors,color',
        ],
            [
                'color.required' => '* Không để trống',
                'color.unique' => ' * Đã có màu này ! Chọn màu khác',
            ]);
        try {
            DB::beginTransaction();
            Color::create($request->all());
            DB::commit();
            return \response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
        }
    }
    public function destroy($id)
    {
        try {

            DB::beginTransaction();
            $color = Color::findOrFail($id);
            $color->delete();

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }
}
