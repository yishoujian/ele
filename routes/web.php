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
    return view('index');
});

Route::get("test",function (){

    dd(env("MAIL_FROM_NAME"));
});



//商户
Route::domain('shop.ele.com')->namespace('Shop')->group(function () {


    Route::get("index/index","IndexController@index")->name("shop.index.index");

    Route::any('user/reg',"UserController@reg")->name("shop.user.reg");

    Route::any('user/login',"UserController@login")->name("shop.user.login");
    Route::any('user/logout',"UserController@logout")->name("shop.user.logout");
    Route::any('user/change',"UserController@change")->name("shop.user.change");

    Route::any('shop/add',"ShopController@add")->name("shop.shop.add");
    //发送邮箱
    Route::any('email/send',"EmailController@send")->name("shop.eamil.send");

    //商户菜品分类路由
    Route::any('menu_category/index',"MenuCategoryController@index")->name("shop.menu_category.index");

    Route::any('menu_category/add',"MenuCategoryController@add")->name("shop.menu_category.add");
    Route::any('menu_category/edit/{id}',"MenuCategoryController@edit")->name("shop.menu_category.edit");
    Route::any('menu_category/del/{id}',"MenuCategoryController@del")->name("shop.menu_category.del");

    //商户菜品路由
    Route::any('menu/index',"MenuController@index")->name("shop.menu.index");

    Route::any('menu/add',"MenuController@add")->name("shop.menu.add");
    Route::any('menu/uploade',"MenuController@uploade")->name("shop.menu.uploade");
    Route::any('menu/edit/{id}',"MenuController@edit")->name("shop.menu.edit");
    Route::any('menu/del/{id}',"MenuController@del")->name("shop.menu.del");

    //商户活动
    Route::any('article/index',"ArticleController@index")->name("shop.article.index");
 //商户订单
    Route::any('order/index',"OrderController@index")->name("shop.order.index");

//商户订单 按天查看
    Route::any('order/tian',"OrderController@tian")->name("shop.order.tian");

    //商户订单 按月查看
    Route::any('order/yue',"OrderController@yue")->name("shop.order.yue");

    //商户订单 按天查看菜品
    Route::any('order_menu/tian',"OrderController@menuTian")->name("shop.order_menu.tian");
    Route::any('order_menu/yue',"OrderController@menuYue")->name("shop.order_menu.tian");

    //点击取消订单
    Route::any('order/quxiao/{id}',"OrderController@quxiao")->name("shop.order.quxiao");
    //点击发货
    Route::any('order/fahuo/{id}',"OrderController@fahuo")->name("shop.order.fahuo");
    //点击确认
    Route::any('order/queren/{id}',"OrderController@queren")->name("shop.order.queren");
    //点击完成
    Route::any('order/wancheng/{id}',"OrderController@wancheng")->name("shop.order.wancheng");

    //点击删除
    Route::any('order/del/{id}',"OrderController@del")->name("shop.order.del");

    //查看订单详情
    Route::any('order/chakan/{id}',"OrderController@chakan")->name("shop.order.chakan");

});


//管理员
Route::domain('admin.ele.com')->namespace('Admin')->group(function () {

    //活动添加
    Route::any("article/index","ArticleController@index")->name("admin.article.index");
    Route::any("article/add","ArticleController@add")->name("admin.article.add");
    Route::any("article/del/{id}","ArticleController@del")->name("admin.article.del");


    //权限添加
    Route::any("per/index","PerController@index")->name("admin.per.index");
    Route::any("per/add","PerController@add")->name("admin.per.add");
    Route::any("per/edit/{id}","PerController@edit")->name("admin.per.edit");
    Route::any("per/del/{id}","PerController@del")->name("admin.per.del");

    Route::any("roles/add","RolesController@add")->name("admin.roles.add");
    Route::any("roles/index","RolesController@index")->name("admin.roles.index");


    //菜单管理 导航条
    Route::any("nav/index","NavController@index")->name("admin.nav.index");
    Route::any("nav/add","NavController@add")->name("admin.nav.add");







    //管理店铺分类
    Route::any("shop_category/add","ShopCategoryController@add")->name("admin.shop_category.add");
    Route::get("shop_category/index","ShopCategoryController@index")->name("admin.shop_category.index");
    Route::any("shop_category/edit/{id}","ShopCategoryController@edit")->name("admin.shop_category.edit");
    Route::any("shop_category/del/{id}","ShopCategoryController@del")->name("admin.shop_category.del");


    //管理员
    //大后台首页
    Route::get("admin/index","IndexController@index")->name("admin.admin.index");
    //管理员列表
    Route::get("admin/list","AdminController@list")->name("admin.admin.list");
    //管理员登录
    Route::any("admin/login","AdminController@login")->name("admin.admin.login");
    //管理员添加
    Route::any("admin/add","AdminController@add")->name("admin.admin.add");
    //管理员编辑
    Route::any("admin/save/{id}","AdminController@save")->name("admin.admin.save");

    //退出登录
    Route::any("admin/logout","AdminController@logout")->name("admin.admin.logout");
    //修改密码
    Route::any("admin/eidt","AdminController@edit")->name("admin.admin.edit");
    //删除管理员
    Route::any("admin/del/{id}","AdminController@del")->name("admin.admin.del");

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


//商户订单 按天查看
    Route::any('order/tian',"OrderController@tian")->name("admin.order.tian");

    //商户订单 按月查看
    Route::any('order/yue',"OrderController@yue")->name("admin.order.yue");

    //商户订单 按天查看菜品
    Route::any('order_menu/tian',"OrderController@menuTian")->name("admin.order_menu.tian");
    Route::any('order_menu/yue',"OrderController@menuYue")->name("admin.order_menu.tian");






});