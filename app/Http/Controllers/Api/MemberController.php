<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Mrgoon\AliSms\AliSms;

class MemberController extends Controller
{
    
    
    //注册
    public function reg(Request $request)
    {
        $data=\request()->post();
        $validator=Validator::make($data,[
            'username'=>"required|unique:members",
            'tel'=>[
                "required",
                'regex:/^0?(13|14|16|15|17|18|19)[0-9]{9}$/',
                "unique:members"
            ]
        ]);
//        dd($data);
        $username=\request()->post("username");
        $tel=\request()->post("tel");
//        dd($tel);
        $sms=\request()->post("sms");
        $password=\request()->post("password");
        $this->validate($request,[
        "tel"=>"required|unique:members"
    ]);
        $data['password']=Hash::make($data['password']);
        //把redis里面的验证码取出来
        $yzm=Redis::get("tel_".$tel);
        if ($yzm==$sms){
            //加入数据库
            Member::create($data);
            return $data=[
                "status"=>"true",
                "massage"=>"注册成功",

            ];
        }else{
            return $data=[
                "status"=>"false",
                "massage"=>"验证码错误"

            ];

        }
        return $data;

        }

    //获取验证码

    public function sms()
    {
        //得到手机号
        $tel=\request()->get("tel");
        //生成四位的验证码
        $code=rand(1000,9999);
        //把验证码存到redis 第一个参数是字段名 第二个是过期时间 秒 第三个值
        Redis::setex("tel_" . $tel, 60*5, $code);
        //验证验发送给手机
        $config = [
            'access_key' => env("ACCESS_ID"),
            'access_secret' => env("ACCESS_KEY"),
            'sign_name' => env("ALIYUN_SMS_SIGN_NAME"),
        ];
        $sms=New AliSms();
        $response = $sms->sendSms($tel, env("ALIYUN_SMS_MOBANCODE"), ['code'=> $code], $config);
        //返回
        $data=[
            'status'=>"true",
            "message"=>"发送验证码成功".$code,
        ];
        return $data;

        }

        //登录
    public function login()
    {
        $data=\request()->post();

//        dd($data);
        $name=$data['name'];
        $password=$data['password'];

        $user=Member::where("username",$name)->first();
//        dd($user);
        $result=Hash::check($password,$user['password']);
//        dd($result);
        if ($result==true){
            $data=[
              "status"=>"true",
              "massage"=>"登录成功",
                'user_id'=>$user->id,
                'username'=>$user->username
            ];

        }else{
           $data=[
                "status"=>"false",
                "massage"=>"登录失败",
            ];
        }

        return $data;

    }
    
    
    //忘记密码

    public function forgetPassword()
    {
        $data=\request()->post();
        $tel=$data['tel'];
        //通过电话号码 找到用户信息
        $user=Member::where("tel",$data['tel'])->first();
        $password=$user['password'];
        //通过redis找到验证码
        $yzm=Redis::get("tel_".$tel);
        if ($data['sms']==$yzm){
            //把以前的密码修改成现在的密码
            $data['password']=Hash::make($data['password']);
          if ($user->update($data)) {

                    $data1=[
                  "status"=>true,
                  "massage"=>"重置密码成功",
                ];

            }else{

              $data1=[
                  "status"=>"false",
                  "massage"=>"重置密码失败",
              ];
          }
          }else{
            return $data=[
               "status"=>"false",
               "massage"=>"验证码错误",
            ];
        }
        return $data1;



    }
   //修改密码
    public function changePassword()
    {
        $data=\request()->post();
        $id=$data['id'];
        $user=Member::find($id);
        $data['newPassword']=Hash::make($data['newPassword']);



}

    public function detail(Request $request)
    {
      return Member::find($request->get('user_id'));

}


}
