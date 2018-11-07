<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class PerController extends BaseController
{
    public function index()
    {
       $pers= Permission::all();
        return view("admin.per.index",compact("pers"));

        }

    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            $data=$request->post();
            $data['guard_name']="admin";
            Permission::create($data);
            }
            return view("admin.per.add");

    }

    public function del(Request $request,$id)
    {
        Permission::find($id)->delete();
        return redirect()->route("admin.per.index")->with("success","删除成功");

    }
}
