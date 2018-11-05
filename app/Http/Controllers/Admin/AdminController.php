<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminController extends BaseController
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


    //管理员列表
    public function list()
    {

        $admins=Admin::all();
        return view("admin.admin.list",compact("admins"));

    }

    //添加管理员
    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required",
            ]);
            $data=$request->post();
//            dd($data);
            $role=$request->post("role");

            $password=$request->post("password");
            $data['password']=Hash::make($password);
            $re=Admin::create($data);
            if ($re){
                //给管理员添加角色
                $re->syncRoles($role);
                return redirect()->route("admin.admin.index");
            }

        }else{
            $roles=Role::all();
            return view("admin.admin.add",compact("roles"));
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


    public function del(Request $request,$id)
    {

       Admin::find($id)->delete();

        return redirect()->route("admin.admin.list")->with("success","删除成功");

    }

    //编辑

    public function save(Request $request,$id)
    {
        if ($id==4){
            return exit("我是超级管理员 不能删除");
        }
        $admin=Admin::find($id);
        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required",
            ]);
            $data=$request->post();
//            dd($data)
            $data1['name']=$data['name'];
            $data1['password']=$data['password'];

            $admin->update($data1);
//            dd($request->post('role'));
            $admin->syncRoles($request->post('role'));

            return redirect()->route("admin.admin.list")->with("success","编辑成功");

            }else{
            $admin=Admin::find($id);
            $roles = $admin->getRoleNames()->toArray();
//            dd($roles);
            $jiaoses=Role::all();
//            dd($jiaose);
//            dd($roles);
            return view("admin.admin.save",compact("roles","admin","jiaoses"));




        }


        
    }
    
    
}
