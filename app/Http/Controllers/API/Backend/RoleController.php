<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CreateRoleRequest;
use App\Http\Resources\Backend\RoleResource;
use App\Model\Backend\Role;
use DB;
use Exception;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $role = Role::Paginate(5);

        // $role = Role::find(1);

        // return new RoleResource($role);
        return RoleResource::collection(Role::Paginate(5));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {

        try {

            DB::beginTransaction();
            $role = Role::create([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role->permissions()->attach($request->permissions);
            DB::commit();
            return \response()->json(['status' => true]);

        } catch (Exception $e) {
            DB::rollback();
            return \response()->json(['status' => false]);
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
    public function update(Request $request, $id)
    {
        $pers = array();
        foreach ($request->permissions as $val) {
            array_push($pers, ((object) $val)->id);
        }
        try {

            DB::beginTransaction();
            $role = Role::findorFail($id);
            $role->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            $role->permissions()->detach();
            $role->permissions()->attach($pers);
            DB::commit();
            return \response()->json(['status' => true]);

        } catch (Exception $e) {
            DB::rollback();
            return \response()->json(['status' => false]);
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
            $role = Role::findorFail($id);
            $role->permissions()->detach();
            $role->delete();

            DB::commit();

        } catch (Exception $e) {
            DB::rollback();

        }

    }

}
