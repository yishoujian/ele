<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesController extends BaseController
{

    public function index()
    {
        $roles=Role::all();

        return view("admin.roles.index",compact("roles"));


    }



    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            $per=$request->post("per");

            $data['name']=$request->post("name");
            $data['guard_name']="admin";
//            dd($data);
            $re=Role::create($data);

            if ($per){
                //给角色添加权限
           $re->syncPermissions($request->post("per"));
           }
            return redirect()->route('admin.roles.index')->with('success','创建'.$re->name."成功");




        }else{

            $pers=Permission::all();
            return view("admin.roles.add",compact("pers"));

        }

    }





}
