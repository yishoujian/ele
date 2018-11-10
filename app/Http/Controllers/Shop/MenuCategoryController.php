<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MenuCategoryController extends BaseController
{
    public function index()
    {
        $id=Auth::id();
        $mcs=MenuCategory::where("user_id",$id)->get();
//        dd($mcs);
        return view("shop.menu_category.index",compact("mcs"));

    }

   //添加
    public function add(Request $request)
    {
        $id=Auth::id();
        if ($request->isMethod("post")){
            $s1=Shop::where("user_id",$id)->get();
            if ($s1[0]['status']!==1){
                return back()->with("danger","你的店铺还没通过审核 不能添加分类");
            }

//
            $this->validate($request,[
               "name"=>"required",
            ]);
            $data=$request->post();
//            dd($data);
            $data['user_id']=Auth::id();
            $shop=Shop::where("user_id",$id)->get();
            $data['shop_id']=$shop[0]['id'];
//            dd($data);
            if ($data['is_selected']){

                $mcs = MenuCategory::where("user_id", $id)->update(["is_selected" => 0]);

                }
                if (MenuCategory::create($data)){
//          dd($data);
                return redirect()->route("shop.menu_category.index")->with("success","添加成功");
                }



//            dd($data);
        }else{
            return view("shop.menu_category.add");
        }

    }


    //编辑

    public function edit(Request $request,$id)
    {
        $mc = MenuCategory::find($id);
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name" => "required"
            ]);
            $data = $request->post();
//            dd($data['is_selected']);
            $id = Auth::id();
            if ($data['is_selected'] == 1) {
                $mcs = MenuCategory::where("user_id", $id)->update(["is_selected" => 0]);
            }

            if ($mc->update($data)) {
                return redirect()->route("shop.menu_category.index")->with("success","编辑成功");
            }


        } else {

                return view("shop.menu_category.edit", compact("mc"));
            }


    }

    public function del(Request $request,$id)
    {
       $re= Menu::where("category_id",$id)->first();
//      dd($re);
        if (!$re==null){
            return back()->with("danger","这个分类有菜品 不能删除");
        }
//        dd($id);

        MenuCategory::find($id)->delete();
        return redirect()->route("shop.menu_category.index")->with("success","删除成功");

    }

}
