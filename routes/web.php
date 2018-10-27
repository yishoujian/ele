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
    Route::any('user/logout',"UserController@logout")->name("shop.user.logout");
    Route::any('user/change',"UserController@change")->name("shop.user.change");

    Route::any('shop/add',"ShopController@add")->name("shop.shop.add");

    //商户菜品分类路由
    Route::any('menu_category/index',"MenuCategoryController@index")->name("shop.menu_category.index");

    Route::any('menu_category/add',"MenuCategoryController@add")->name("shop.menu_category.add");
    Route::any('menu_category/edit/{id}',"MenuCategoryController@edit")->name("shop.menu_category.edit");
    Route::any('menu_category/del{id}',"MenuCategoryController@del")->name("shop.menu_category.del");



    //商户菜品路由
    Route::any('menu/index',"MenuController@index")->name("shop.menu.index");

    Route::any('menu/add',"MenuController@add")->name("shop.menu.add");
    Route::any('menu/edit/{id}',"MenuController@edit")->name("shop.menu.edit");
    Route::any('menu/del{id}',"MenuController@del")->name("shop.menu.del");


});


//管理员
Route::domain('admin.ele.com')->namespace('Admin')->group(function () {


    //管理店铺分类
    Route::any("shop_category/add","ShopCategoryController@add")->name("admin.shop_category.add");
    Route::get("shop_category/index","ShopCategoryController@index")->name("admin.shop_category.index");
    Route::any("shop_category/edit/{id}","ShopCategoryController@edit")->name("admin.shop_category.edit");
    Route::any("shop_category/del/{id}","ShopCategoryController@del")->name("admin.shop_category.del");


    //管理员
    //大后台首页
    Route::get("admin/index","IndexController@index")->name("admin.admin.index");
    //管理员登录
    Route::any("admin/login","AdminController@login")->name("admin.admin.login");
    //管理员添加
    Route::any("admin/add","AdminController@add")->name("admin.admin.add");
    //退出登录
    Route::any("admin/logout","AdminController@logout")->name("admin.admin.logout");
    //修改密码
    Route::any("admin/eidt","AdminController@edit")->name("admin.admin.edit");

    //后台店铺管理
    //管理店铺
    Route::get("shop/index","ShopController@index")->name("admin.shop.index");
    Route::any("shop/shenhe/{id}","ShopController@shenhe")->name("admin.shop.shenhe");
    Route::any("shop/edit/{id}","ShopController@edit")->name("admin.shop.edit");
    Route::any("shop/del/{id}","ShopController@del")->name("admin.shop.del");



    //管理商户
    Route::get("user/index","UserController@index")->name("admin.user.index");
    Route::any("user/shenhe/{id}","UserController@shenhe")->name("admin.user.shenhe");
    Route::any("user/jinyong/{id}","UserController@jinyong")->name("admin.user.jinyong");
    Route::any("user/edit/{id}","UserController@edit")->name("admin.user.edit");
    Route::any("user/del/{id}","UserController@del")->name("admin.user.del");
    Route::any("user/chongzhi/{id}","UserController@chongzhi")->name("admin.user.chongzhi");







});