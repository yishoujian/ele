<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function index()
    {
        $users=User::all();
//        dd($users);
        return view("admin.user.index",compact("users"));

    }


//商户审核
    public function shenhe(Request $request,$id)
    {
        $shop=User::find($id);
        $status=User::find($id)['status'];
        $status=[];
        $status['status']=1;
        if ($shop->update($status)){
            return redirect()->route("admin.user.index")->with("success","审核通过");
        }

    }


//商户禁用
    public function jinyong(Request $request,$id)
    {
        $shop=User::find($id);
        $status=User::find($id)['status'];
        $status=[];
        $status['status']=-1;
        if ($shop->update($status)){
            return redirect()->route("admin.user.index")->with("danger","已经禁用");
        }

    }


    public function edit(Request $request,$id)
    {
        $user=User::find($id);
//        dd($shop);
        $scs=ShopCategory::all();
        if ($request->isMethod("post")){
                 $data=$this->validate($request,[
                    "name"=>"required",
                    "password"=>"required"
                 ]);
                 $data['password']=Hash::make($data['password']);
//                 dd($data);
                 if ($user->update($data)){

                     return redirect()->route("admin.user.index")->with("success","编辑成功");
                 }


        }else{
            return view("admin.user.edit",compact("shop","user"));
        }

    }
    //密码重置

    public function chongzhi(Request $request,$id)
    {
        $user=User::find($id);
        $password=123456;

        $password1=Hash::make($password);
//        dd($password1);
        $data['password']=$password1;
        if ($user->update($data)){
            return redirect()->route("admin.user.index")->with("success","重置密码成功 新密码为123456");
        }else{
            return redirect()->back()->with("danger","重置失败");
        }

    }
}
