<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware' => 'jwt.auth'], function () {

});
Route::group(['namespace' => 'API'], function () {
    Route::post('/admlogin', 'AuthController@login')->name('admlogin');
    Route::middleware('auth:api')->post('/admlogout', 'AuthController@logout')->name('admlogout');
});
Route::group(['prefix' => 'admin', 'namespace' => 'API\Backend'], function () {

    Route::apiResources(['user' => 'UserController']);
    Route::apiResources(['role' => 'RoleController']);
    Route::apiResources(['permission' => 'PermissionController']);
    Route::apiResources(['product' => 'ProductController']);
    Route::apiResources(['slide' => 'SlideController']);
    Route::apiResources(['category' => 'CategoryController']);
    Route::apiResources(['size' => 'SizeController']);
    Route::apiResources(['color' => 'ColorController']);
    Route::apiResources(['coupon' => 'CouponController']);
});
