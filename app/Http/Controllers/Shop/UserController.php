<?php

namespace App\Http\Controllers\Shop;

use App\Models\User;
use Faker\Provider\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    //商户注册
    public function reg(Request $request)
    {
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name" => "required",
                "password" => "confirmed",
            ]);
            $data['status'] = 0;
            $data = $request->post();
            $password = $data["password"];
            $password = Hash::make($password);
            $data['password'] = $password;
            if (User::create($data)) {
                return redirect()->route("shop.user.login")->with("success", "注册成功  欢迎登录");
            }
        } else {
            return view("shop.user.reg");
        }


    }

    //商户登录

    public function login(Request $request)
    {
        if ($request->isMethod("post")) {
            $user = Auth::user();
//            dd($user);
//            if ($user['status']==0) {
//                return redirect()->back()->exceptInput()->with("danger", "你的账号还未通过审核或者已被禁用");
//                }
            $data = $this->validate($request, [
                "name" => "required",
                "password" => "required",
            ]);


            if (Auth::attempt($data, $request->post("remember"))) {
                return redirect()->route("shop.index.index")->with("success", "登录成功");


            } else {
                return redirect()->back()->with("danger", "账号或者密码错误");
            }

        } else {
            return view("shop.user.login");
        }

    }


    //商户退出登录

    public function logout()
    {
        Auth::logout();
        return redirect()->route("shop.user.login")->with("success", "退出登录成功");

    }


    //商户修改密码
    public function change(Request $request)
    {

        if ($request->isMethod("post")) {
            //不加密的旧密码

            $password2=$request->post()['oldPassword'];
            $password = $request->post()['password'];
//            dd($password);
            $this->validate($request, [
                "oldPassword" => "required",
                "password" => "required|confirmed",
            ]);
            //得到以前登录的信息
            $user=Auth::user();
            //得到以前的密码
            $password1=$user->password;
            $re=Hash::check($password2,$password1);
//            dd($re);
            if ($re){
               $password1=bcrypt($password);
               Auth::logout();
               $data['password']=$password1;
                $user->update($data);
                return redirect()->route("shop.user.login")->with("success","修改密码成功");
            }else{
                return back()->with("danger","原来的密码不对");
            }
            } else {

            return view("shop.user.change");
        }


    }
}
