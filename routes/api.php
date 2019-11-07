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
Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('getuser', 'AuthController@getUser');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group(['namespace' => 'API'], function () {
//     Route::post('/admlogin', 'AuthController@login')->name('admlogin');
//     Route::middleware('auth:api')->post('/admlogout', 'AuthController@logout')->name('admlogout');
// });
Route::group(['prefix' => 'admin', 'namespace' => 'API\Backend'], function () {
    Route::get('/getuser', 'UserController@getuser');
    Route::apiResources(['user' => 'UserController']);
    Route::apiResources(['role' => 'RoleController']);
    Route::apiResources(['permission' => 'PermissionController']);
    Route::apiResources(['product' => 'ProductController']);
    Route::apiResources(['slide' => 'SlideController']);
    Route::apiResources(['category' => 'CategoryController']);
    Route::apiResources(['size' => 'SizeController']);
    Route::apiResources(['color' => 'ColorController']);
    Route::apiResources(['coupon' => 'CouponController']);
    Route::get('getSlides', 'SlideController@getSlides');
});

// fronend

Route::group(['namespace' => 'API\Frontend'], function () {
    Route::get('getCategories', 'CategoryController@getCategories');
    Route::get('getNewProduct', 'GetdataController@getNewProduct');

});