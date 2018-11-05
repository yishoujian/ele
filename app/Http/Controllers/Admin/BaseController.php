<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mockery\Matcher\Closure;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin')->except("login");

        //判断用户有没有权限
        $this->middleware(function ($request,\Closure $next){
          //得到当前访问的用户
           $user= Auth::guard("admin")->user();

           if (!in_array(Route::currentRouteName(),['admin.admin.login','admin.admin.logout'])&& $user->id !==1){
               //判断当前用户有没有访问权限 路由名称就是权限名称
               if ($user->can(Route::currentRouteName())==false){
                   exit(view('admin.fuck'));
               }


           }





            return $next($request);

        });

    }

}
