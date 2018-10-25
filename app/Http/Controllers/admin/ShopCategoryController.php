<?php

namespace App\Http\Controllers\admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopCategoryController extends Controller
{

    //分类首页
    public function index()
    {
        $scs=ShopCategory::all();
//        dd($scs);
        return view("admin.shopcategory.index",compact("scs"));

    }




    //分类添加
    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            $this->validate($request,[
                'name' => 'unique:shop_categories',
               "logo"=>"image" ,
            ]);

            $data=$request->post();

            $data['logo']=$request->file("logo")->store("image","image");
//            dd($data);


             if (ShopCategory::create($data)){
                 return redirect()->route("admin.shop_category.index")->with("success","添加分组成功");
             }

        }else{
            return view("admin.shopcategory.add");
        }

    }


    public function edit(Request $request,$id)
    {
        $shop=ShopCategory::find($id);
        if ($request->isMethod("post")){
            $this->validate($request,[
               "name"=>"required"
            ]);

        }else{

            return view("admin.shopcategory.edit",compact("shop"));

        }

    }


    public function del($id){
        //得到当前分类
        $cate=ShopCategory::findOrFail($id);
        //得到当前分类对应的店铺数
        $shopCount=Shop::where('shop_category_id',$cate->id)->count();
        //判断当前分类店铺数
        if ($shopCount){
            //回跳
            return  back()->with("danger","当前分类下有店铺，不能删除");
        }
        //否则删除
        $cate->delete();
        //跳转
        return redirect()->route('admin.shop_category.index')->with('success',"删除成功");
    }
}
