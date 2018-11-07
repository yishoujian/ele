<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cat;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mrgoon\AliSms\AliSms;

class OrderController extends Controller
{
    //获得指定
    public function index()
    {
        $orderId=\request()->get("id");
        $order=Order::find($orderId);
        //通过订单id 查出订单商品
       $goods= OrderGoods::where("order_id",$orderId)->get();
//       dd($goods);
        $data['id']=$order->id;
        $data['order_code']=$order->order_code;
        $data['order_address']=$order->provence.$order->city.$order->area.$order->detail_address;
        $data['order_birth_time']=(string)$order->created_at;
        $data['order_price']=$order->total;
        $data['shop_id']=$order->shop_id;
        $data['shop_img']=$order->shop->shop_img;
        $data['shop_name']=$order->shop->shop_name;
        $data['order_status']=$order->order_status;
        $data['goods_list']=$order->goods;
        return $data;

        }

 //订单添加
    public function add(Request $request)
    {
        $user_id=$request->post("user_id");
        $address_id=$request->post("address_id");
        //检查是否有地址
        $address=Address::find($address_id);

        if ($address == null){
            return [
                "status" => "false",
                "message" => "请选择正确的地址"
            ];
        }

        $data=[];
        $data['user_id']=$user_id;
       $cats= Cat::where("user_id",$user_id)->get();
//       dd($cats);
       $menu=Menu::where("id",$cats[0]['goods_id'])->get();
//       dd($menu);
        $data['shop_id']=$menu[0]['shop_id'];
//        dd($data);
        //生成订单编号
        $order_code=date("ymdhis").rand(1000,9999);
//        dd($order_code);
        $data['order_code']=$order_code;

        $data['provence']=$address->provence;
//        dd($data);
        $data['city']=$address->city;
        $data['area']=$address->area;
        $data['detail_address']=$address->detail_address;
        $data['tel']=$address->tel;
        $data['name']=$address->name;
        $total=0;
//        dd($cats);
        foreach ($cats as $k=>$v){
//            dd($v);
            $good=Menu::find($v->goods_id);
            $total+=$v->amount * $good->goods_price;
        }
//        dd($total);
        $data['total']=$total;


         DB::beginTransaction();
         try{
             //数据入库
             $order= Order::create($data);
//        dd($order);
             foreach ($cats as $i=>$j) {

                 $menus1 = Menu::find($j->goods_id);
//            dd($j);
//            dd($menus1);
                 if ($menus1->stock < $j->amount) {
//               //抛出异常
                     throw new \Exception($menus1->goods_name."库存不足") ;

                 }
                 //减去库存
                 $menus1->stock = $menus1->stock - $j->amount;
                 $menus1->save();
                 $time=date("Y-m-d H:i:s");
//            dd($time);
                 //订单商品入库
                 OrderGoods::insert([
                     "order_id" => $order->id,
                     "created_at"=>$time,
                     "goods_id" => $j->goods_id,
                     "amount" => $j->amount,
                     "goods_name" => $menus1->goods_name,
                     "goods_img" => $menus1->goods_img,
                     "goods_price" => $menus1->goods_price,

                 ]);
             }

             //添加订单成功后 清空购物车
             Cat::where("user_id",$user_id)->delete();
             //提交事务
             DB::commit();

         }catch (\Exception $exception){
             //回滚
             DB::rollBack();
             return [
               "status"=>"false",
                 "message"=>$exception->getMessage(),
             ];

         };
        //得到手机号
        $tel=$address->tel;
//        dd($tel);
        //得到店铺id
        $sp=$data['shop_id'];
//        $code=Shop::where("id",$data['shop_id'])->get();
//        dd($sp);
        //得到店铺信息
        $shop=Shop::where("id",$sp)->first();
        $code="全球最大订餐网站饱了么的".$shop->shop_name;
//        //把验证码存到redis 第一个参数是字段名 第二个是过期时间 秒 第三个值
//        Redis::setex("tel_" . $tel, 60*5, $code);
        //验证验发送给手机
        $config = [
            'access_key' => env("ACCESS_ID"),
            'access_secret' => env("ACCESS_KEY"),
            'sign_name' => env("ALIYUN_SMS_SIGN_NAME"),
        ];

        $sms=New AliSms();
//        dd($tel);
        $response = $sms->sendSms($tel, "SMS_150184963", ['name'=> $code], $config);

        return [
          "status"=>"true",
              "message"=>"添加订单成功",
            "order_id"=>$order->id,

        ];
        }

   //订单列表
    public function list(Request $request)
    {
        $orders = Order::where("user_id", $request->input('user_id'))->get();
        $datas=[];
        foreach ($orders as $order) {
            $data['id'] = $order->id;
            $data['order_code'] = $order->order_code;
            $data['order_birth_time'] = (string)$order->created_at;
            $data['order_status'] = $order->order_status;
            $data['shop_id'] = (string)$order->shop_id;
            $data['shop_name'] = $order->shop->shop_name;
            $data['shop_img'] = $order->shop->shop_img;
            $data['order_price'] = $order->total;
            $data['order_address'] = $order->provence . $order->city . $order->area . $order->detail_address;
            $data['goods_list'] = $order->goods;
            $datas[] = $data;
        }
        return $datas;


        }


        //支付
    public function pay(Request $request)
    {
        $order_id=$request->get("id");
        //查出订单
        $cost=Order::find($order_id);
        $user_id=Order::find($order_id)->user_id;
        $shop_id=Order::find($order_id)->shop_id;
        //查出用户
        $member=Member::find($user_id);
        if ($member->money <$cost->total){
            return [
                'status' => 'false',
                "message" => "用户余额不够，请充值"
            ];
        }
        //开启食物
        DB::transaction(function () use($member,$cost){
           //扣钱
            $member->money=$member->money - $cost->total;
            $member->save();


            //更改订单状态
            $cost->status=1;
            $cost->save();

        });
        return [
          "status"=>"true",
          "message"=>"支付成功"
        ];


    }
}
