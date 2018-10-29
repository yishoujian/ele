<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopController extends BaseController
{
    public function add(Request $request)
    {
        $id=Auth::user()->id;
//        dd($id);
        if ($request->isMethod("post")){
            //判断当前用户是否已有店铺
            if (Shop::where("user_id",$id)){
                return redirect()->back()->with("danger","已有店铺不能再创建");
            }
           $data=$request->post();
           $data['user_id']=Auth::user()->id;
//           dd($data['user_id']);
            $data['user_id']=Auth::id();
           $data['status']=0;
//           dd($data);
            if ($request->file("goods_img")){
                $data['goods_img']=$request->file("goods_img")->store("images","image");
            }
            //第一个参数的存本地的地址 第二个参数才是驱动名称

            if (Shop::create($data)){
                return redirect()->route("shop.index.index")->with("success","申请成功请耐心等待");
            }else{
                return redirect()->back()->with("danger","申请失败");
            }

        }else{
             $scs=ShopCategory::all();
            return view("shop.shop.add",compact("scs"));
        }


    }

}
