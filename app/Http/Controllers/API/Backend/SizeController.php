<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Model\Backend\Size;
use DB;
use Exception;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        return \response()->json(Size::paginate(5));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'size' => 'required|unique:sizes,size',
        ],
            [
                'size.required' => '* Không để trống',
                'size.unique' => ' * Đã có kích cỡ này ! Chọn kích cỡ khác',
            ]);
        try {

            DB::beginTransaction();
            Size::create($request->all());
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
            $size = Size::findOrFail($id);
            $size->delete();

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();
            return $e;
        }
    }

}
