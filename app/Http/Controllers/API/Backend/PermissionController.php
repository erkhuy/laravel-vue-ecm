<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreatePermissionRequest;
use App\Http\Requests\Backend\UpdatePermissionRequest;
use App\Model\Backend\Permission;
use DB;
use Exception;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(5);
        return \response()->json($permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePermissionRequest $request)
    {
        try {
            DB::beginTransaction();

            Permission::create($request->all());

            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => $e]);
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
    public function update(UpdatePermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        try {
            DB::beginTransaction();

            $permission->update($request->all());

            DB::commit();
            return response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
            return response()->json(['status' => $e]);
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
        $premision = Permission::findOrFail($id);
        $status = $premision->delete();
        // return \response()->json(['status'=>$status]);

    }

}
