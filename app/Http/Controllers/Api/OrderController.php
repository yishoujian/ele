<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use App\Models\Cat;
use App\Models\Member;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderGoods;
use App\Models\Shop;
use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mrgoon\AliSms\AliSms;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Symfony\Component\HttpFoundation\Response;


class OrderController extends BaseController
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

//        $sms=New AliSms();
////        dd($tel);
//        $response = $sms->sendSms($tel, "SMS_150184963", ['name'=> $code], $config);

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


    public function wxPay(Request $request)
    {
        //1.得到订单信息
        $order1=Order::find($request->get("id"));
     //   dd($order1->order_code);
//        dd($order1);
        //2.创建订单
        $attributes = [
            'trade_type'       => 'NATIVE', // JSAPI，NATIVE，APP...
            'body'             => '全球最大的点餐平台',
            'detail'           => '全球最大的点餐平台,饱了么',
            'out_trade_no'     => $order1->order_code,
            'total_fee'        => $order1->total * 100, // 单位：分
            'notify_url'       => 'http://www.ysj1.cn/api/order/ok', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
           // 'openid'           => '当前用户的 openid', // trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识，
            // ...
        ];
        $order = new \EasyWeChat\Payment\Order($attributes);
        $app = new Application(config('wechat'));
        $payment = $app->payment;
        //3.统一下单
        $result = $payment->prepare($order);
//        dd($result);
        if ($result->return_code == 'SUCCESS' && $result->result_code == 'SUCCESS'){
            $prepayId = $result->prepay_id;
            //取出code
            $payUrl=  $result->code_url;



// Create a basic QR code
            $qrCode = new QrCode($payUrl);
            $qrCode->setSize(300);

// Set advanced options
            $qrCode
                ->setWriterByName('png')
                ->setMargin(10)
                ->setEncoding('UTF-8')
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)
                ->setForegroundColor(['r' => 0, 'g' => 0, 'b' => 0])
                ->setBackgroundColor(['r' => 255, 'g' => 255, 'b' => 255])
                ->setLabel('微信扫码支付', 16, public_path("font/simhei.ttf"), LabelAlignment::CENTER)
                ->setLogoPath(public_path("image/1.jpeg"))
                ->setLogoWidth(150)
                ->setValidateResult(false)
            ;
            header('Content-Type: '.$qrCode->getContentType());
            exit($qrCode->writeString());

            }




    }

    public function status()
    {
        $order=Order::find(\request()->get("id"));
        return [
            "status"=>$order->status,
        ];

    }

    //微信异步通知方法
    public function ok()
    {
        //创建操作微信的对象
        $app=new Application(config("wechat"));
        $response = $app->payment->handleNotify(function($notify, $successful){
            // 使用通知里的 "微信支付订单号" 或者 "商户订单号" 去自己的数据库找到订单
//            $order = 查询订单($notify->out_trade_no);
            $order=Order::where("order_code",$notify->out_trade_no)->first();

            if (!$order) { // 如果订单不存在
                return 'Order not exist.'; // 告诉微信，我已经处理完了，订单没找到，别再通知我了
            }

            // 如果订单存在
            // 检查订单是否已经更新过支付状态
            if ($order->status==1) { // 假设订单字段“支付时间”不为空代表已经支付
                return true; // 已经支付成功了就不再更新了
            }

            // 用户是否支付成功
            if ($successful) {
                // 不是已经支付状态则修改为已经支付状态
               // $order->paid_at = time(); // 更新支付时间为当前时间
                $order->status = 1;
            }

            $order->save(); // 保存订单

            return true; // 返回处理完成
        });

        return $response;

    }


}
