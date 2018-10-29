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
//商户列表
Route::any("shop/list","Api\ShopController@list");
//商家详情
Route::any("shop/index","Api\ShopController@index");
//登录接口
Route::any("user/login","Api\UserController@login");
