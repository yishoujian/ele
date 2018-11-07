<?php

namespace App\Http\Controllers\Admin;

use App\Models\Nav;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class NavController extends Controller
{
    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            if ($request->isMethod("post")){
                $this->validate($request,[
                   "name"=>"required",
                ]);
                $data=$request->post();
//                dd($data);
                if (Nav::create($data)){
                    return redirect()->route("admin.nav.add")->with("success","添加导航成功");
                }

            }


        }else{
            //得到所有路由
            $routes=Route::getRoutes();
//            dd($routes);
            $url=[];
            foreach ($routes as $k=>$v){
                if ($v->action['namespace']==="App\Http\Controllers\Admin"){
                    if (isset($v->action['as'])){
                        $urls[]=$v->action['as'];
                    }
                }
            }
//            dd($urls);
            //得到所有顶级导航条
            $navs=Nav::where('pid',0)->orderBy('sort')->get();
//            dd($navs);
            return view("admin.nav.add",compact("urls","navs"));

        }

    }
}
