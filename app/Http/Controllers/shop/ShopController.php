<?php

namespace App\Http\Controllers\shop;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShopController extends BaseController
{
    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            //判断当前用户是否已有店铺
            if (Auth::user()->shop_id){
                return redirect()->back()->with("danger","已有店铺不能再创建");
            }
           $data=$request->post();
           $data['user_id']=Auth::user()->id;
//           dd($data['user_id']);
           $data['status']=0;
//           dd($data);
            $data['logo']=$request->file("logo")->store("images","shop");
            if (Shop::create($data)){
                return redirect()->route("shop.index.index")->with("success","申请成功请耐心等待");
            }else{
                return redirect()->back()->with("danger","申请失败");
            }
//           dd($data);
//           dd($logo);



        }else{
             $scs=ShopCategory::all();
            return view("shop.shop.add",compact("scs"));
        }


    }

}
