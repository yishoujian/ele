<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class ShopController extends BaseController
{
    public function index()
    {
        $shops=Shop::paginate(3);
        return view("admin.shop.index",compact("shops"));


    }

    public function edit(Request $request,$id)
    {
        $scs=ShopCategory::all();
        $shop=Shop::find($id);
//        dd($shop);
        if ($request->isMethod("post")){
            $data=$request->post();
//            dd($data);
            $data['shop_img']=$request->file("shop_img")->store("shop");
            $data['status']=1;
            if ($shop->update($data)){
                return redirect()->route("admin.shop.index")->with("success","修改成功");
            }else{
                return redirect()->back()->withInput()->with("danger","编辑失败");
            }

        }else{
            return view("admin.shop.edit",compact("shop","scs"));
        }



    }

    //店铺审核
    public function shenhe(Request $request,$id)
    {
        $shop=Shop::find($id);
//        dd($shop);
        $status=Shop::find($id)['status'];
        $status=[];
        $status['status']=1;
        if ($shop->update($status)){
            $content ="你的店铺".$shop->shop_name."审核成功";
            $to = '784259775@qq.com';
            $subject = '店铺开通通知';
            Mail::send(
                'email.send',
                compact("content"),
                function ($message) use($to, $subject) {
                    $message->to($to)->subject($subject);
                }
            );
            return redirect()->route("admin.shop.index")->with("success","审核通过");
        }

    }
}
