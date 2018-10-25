<?php

namespace App\Http\Controllers\shop;

use App\Models\User;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    public function reg(Request $request)
    {
        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required",
               "password"=>"confirmed",
            ]);
            $data=$request->post();
            $password=$data["password"];
            $password=Hash::make($password);
            $data['password']=$password;
            if (User::create($data)){
                return redirect()->route("shop.user.login")->with("success","注册成功  欢迎登录");
            }
        }else{
            return view("shop.user.reg");
        }


    }

    public function login(Request $request)
    {
        if ($request->isMethod("post")){
           $data= $this->validate($request,[
                "name"=>"required",
                "password"=>"required",
            ]);

            if (Auth::attempt($data,$request->post("remember"))){
                return redirect()->route("shop.index.index")->with("success","登录成功");
            }else{
                return redirect()->back()->with("danger","账号或者密码错误");
            }

        }else{
            return view("shop.user.login");
        }

    }
}
