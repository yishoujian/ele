<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


//商户
Route::domain('shop.ele.com')->namespace('Shop')->group(function () {

    Route::get("index/index","IndexController@index")->name("shop.index.index");

    Route::any('user/reg',"UserController@reg")->name("shop.user.reg");
    Route::any('user/login',"UserController@login")->name("shop.user.login");

    Route::any('shop/add',"ShopController@add")->name("shop.shop.add");
});


//管理员
Route::domain('admin.ele.com')->namespace('Admin')->group(function () {

    Route::any("shop_category/add","ShopCategoryController@add")->name("admin.shop_category.add");
    Route::get("shop_category/index","ShopCategoryController@index")->name("admin.shop_category.index");
    Route::any("shop_category/edit/{id}","ShopCategoryController@edit")->name("admin.shop_category.edit");
    Route::any("shop_category/del{id}","ShopCategoryController@del")->name("admin.shop_category.del");


});