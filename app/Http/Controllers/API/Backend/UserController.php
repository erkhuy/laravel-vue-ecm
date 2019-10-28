<?php

namespace App\Http\Controllers\API\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Resources\Backend\UserResource;
use App\Model\User;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::paginate(5));
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
    public function store(CreateUserRequest $request)
    {

        if ($request->image) {
            $image = $request->image;
            $nameImg = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/users/') . $nameImg);
        } else {
            $nameImg = "";
        }

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'address' => $request->address,
                'role_id' => $request->role_id,
                'phone' => $request->phone,
                'userID' => Hash::make($request->id),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image' => $nameImg,
                'status' => $request->status,
            ]);

            DB::commit();
            return \response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
            unlink(\public_path('images/users/') . $nameImg);
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
        //
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
    public function update(UpdateUserRequest $request, $id)
    {
        if (strlen($request->image) > 200) {
            $image = $request->image;
            $nameImg = time() . '.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->image)->save(public_path('images/users/') . $nameImg);
        } else {
            $nameImg = $request->image;
        }
        try {
            DB::beginTransaction();
            $user = User::findOrfail($id);
            unlink(public_path('images/users/') . $user->image);
            $user->update([
                'name' => $request->name,
                'address' => $request->address,
                'role_id' => $request->role_id,
                'phone' => $request->phone,
                'image' => $nameImg,
                'status' => $request->status,
            ]);

            DB::commit();
            return \response()->json(['status' => true]);
        } catch (Exception $e) {
            DB::rollback();
            unlink(\public_path('images/users/') . $nameImg);
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
            $user = User::findorFail($id);
            unlink(public_path('images/users/') . $user->image);
            $user->delete();
            DB::commit();

        } catch (Exception $e) {
            DB::rollback();

        }

    }
}