<?php

namespace App\Http\Controllers\Shop;

use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends BaseController
{
    public function index(Request $request)
    {
        $id=Auth::id();
        $shop_id=Shop::where("user_id",$id)->first()->id;
//        dd($shop_id);
        $url  = $request->query();
        $orders=Order::where("shop_id",$shop_id)->paginate(5);
//        dd($order);
        return view("shop.order.index",compact("orders","url"));


    }

    //取消
    public function quxiao()
    {
        $id=Auth::id();
        $shop_id=Shop::where("user_id",$id)->first()->id;
        $orders=Order::where("shop_id",$shop_id)->first();
//        dd($orders);
        $orders->status=-1;
        $orders->save();
        return redirect()->route("shop.order.index")->with("success","取消订单成功");

    }



    //发货
    public function fahuo()
    {
        $id=Auth::id();
        $shop_id=Shop::where("user_id",$id)->first()->id;
        $orders=Order::where("shop_id",$shop_id)->first();
//        dd($orders);
        $orders->status=2;
        $orders->save();
        return redirect()->route("shop.order.index")->with("success","发货成功");

        }

    //发货
    public function queren()
    {
        $id=Auth::id();
        $shop_id=Shop::where("user_id",$id)->first()->id;
        $orders=Order::where("shop_id",$shop_id)->first();
//        dd($orders);
        $orders->status=3;
        $orders->save();
        return redirect()->route("shop.order.index")->with("success","收货成功");

    }

    public function del(Request $request,$id)
    {
        Order::find($id)->delete();
        return redirect()->route("shop.order.index")->with("success","删除订单成功");

    }


    public function chakan(Request $request,$id)
    {
        $order=Order::find($id);
        return view("shop.order.chakan",compact("order"));

    }

    //按天查看订单
    public function tian(Request $request)
    {
        $start = $request->post("start");
        $end = $request->post("end");
        $url  = $request->query();

        $id = Auth::id();
        $shop_id = Shop::where("user_id", $id)->first()->id;
//        dd($shop_id);
//      $sql=Select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,COUNT(*) as nums,SUM(total) FROM `orders` WHERE shop_id=$shop_id GROUP BY date"));
        $orders=  Order::where("shop_id",$shop_id)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('date')
            ->get();

        ;if ($start !== null || $end !== null) {
            $orders->whereDate('created_at', '>=', $start);
            $orders->whereDate('created_at', '<=', $end);
            }
            if ($start !==null){
            $orders->where('created_at','>=',$start);
            }
        if ($end !==null){
            $orders->where('created_at','<=',$end);
        }
//    dd($orders);

        return view("shop.order.tian",compact("orders","url"));

    }


    //按月查看订单
    public function yue(Request $request)
    {
        $start = $request->post("start");
        $end = $request->post("end");
        $url  = $request->query();

        $id = Auth::id();
        $shop_id = Shop::where("user_id", $id)->first()->id;
//      $sql=Select(DB::raw("DATE_FORMAT(created_at,'%Y-%m-%d') as date,COUNT(*) as nums,SUM(total) FROM `orders` WHERE shop_id=$shop_id GROUP BY date"));
        $orders =Order::where("shop_id",$shop_id)
            ->select(DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date,COUNT(*) as nums,SUM(total) as money"))
            ->groupBy('date')
            ->get();
        if ($start !== null || $end !== null) {
            $orders->whereDate('created_at', '>=', $start);
            $orders->whereDate('created_at', '<=', $end);
        }
        if ($start !==null){
            $orders->where('created_at','>=',$start);
        }
        if ($end !==null){
            $orders->where('created_at','<=',$end);
        }


        return view("shop.order.yue",compact("orders","url"));

    }


}
