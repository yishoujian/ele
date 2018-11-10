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



//会员注册
Route::any("member/reg","Api\MemberController@reg");
//登录接口
Route::any("member/login","Api\MemberController@login");
//获取验证码
Route::any("member/sms","Api\MemberController@sms");
//忘记密码
Route::any("member/forgetPassword","Api\MemberController@forgetPassword");
//修改密码
Route::any("member/changePassword","Api\MemberController@changePassword");
//用户详情
Route::any("member/detail","Api\MemberController@detail");
//添加购物车
Route::any("cat/add","Api\CatController@add");
Route::any("cat/index","Api\CatController@index");
//添加收货地址
Route::any("address/add","Api\AddressController@add");
Route::any("address/index","Api\AddressController@index");
Route::any("address/edit","Api\AddressController@edit");
Route::any("address/save","Api\AddressController@save");
//添加订单
Route::any("order/add","Api\OrderController@add");
//订单列表
Route::any("order/list","Api\OrderController@list");
//订单详情
Route::any("order/index","Api\OrderController@index");
//订单支付
Route::any("order/pay","Api\OrderController@pay");
//微信支付
Route::any("order/wxPay","Api\OrderController@wxPay");
//订单状态
Route::any("order/status","Api\OrderController@status");
//微信支付成功
Route::any("order/ok","Api\OrderController@ok");


