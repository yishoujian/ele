<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    //管理员登录
    public function login(Request $request)
    {
        if ($request->isMethod("post")){

           $data=$this->validate($request,[
              "name"=>"required",
              "password"=>"required",
           ]);
           if (Auth::guard("admin")->attempt($data)){
               return redirect()->route("admin.admin.index")->with("success","登录成功");
           }else{
               return redirect()->back()->with("danger","你不是管理员");
           }

        }else{
//            dd(11);
            return view("admin.admin.login");
        }


    }
//退出登录
    public function logout()
    {
        Auth::guard("admin")->logout();
      return redirect()->route("admin.admin.login")->with("success","退出登录成功");

    }



 //添加管理员
    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required",
            ]);
            $data=$request->post();
            $password=$request->post("password");
            $data['password']=Hash::make($password);


            if (Admin::create($data)){
                return redirect()->route("admin.admin.login");
            }

        }else{
            return view("admin.admin.add");
        }

    }


    //修改管理员密码
    public function edit(Request $request)
    {
        if ($request->isMethod("post")){
            $data=$this->validate($request,[
               "password"=>"confirmed"
            ]);
            //得到登录的账号
            $id=Auth::guard("admin")->id();
//            dd($id);
            $admin=Admin::find($id);

            if ($admin->update($data)){
                return redirect()->route("admin.admin.index")->with("success","修改成功");
            }else{
                return redirect()->route("admin.admin.edit")->withInput()->with("danger","修改失败");
            }

        }else{

            return view("admin.admin.edit");
        }


    }
}
