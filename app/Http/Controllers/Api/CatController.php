<?php

namespace App\Http\Controllers\Api;

use App\Models\Cat;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatController extends Controller
{
    public function add(Request $request)
    {
        $user_id=$request->post("user_id");
        $goodslists=$request->post("goodsList");
        $goodsCounts=$request->post("goodsCount");
//        dd($goodsCount);
        //添加之前 清空购物车
        Cat::where("user_id",$user_id)->delete();
        foreach ($goodslists as $k=>$goodslist){
            $data=[
                "user_id"=>$user_id,
                "goods_id"=>$goodslist,
                "amount"=>$goodsCounts[$k],
            ];
                Cat::create($data);
        }
        return $data1=[
               "status"=>"true",
            "massage"=>'添加购物车成功',
        ];

    }

    public function index(Request $request)
    {
        //接收参数
        $user_id=$request->get("user_id");
//        dd($user_id);
        $cats=Cat::where("user_id",$user_id)->get();
//        dd($cats);
        $goodsList=[];
        $totalCost=0;

        foreach ($cats as $k=>$v){
            $goods=Menu::where("id",$v->goods_id)->first();
//            dd($goods);
            $goods->amount=$v->amount;
//            dd($goods->amount);
            $goodsList[]=$goods;
//            $goodsList[$k]['goods_img']=env("ALIYUN_OSS_URL").$goodsList[$k]['goods_img'];
            $totalCost += $goods->goods_price * $goods->amount;
            }

        return [
          "goods_list"=>$goodsList,
            "totalCost"=>$totalCost,
        ];



    }
}
