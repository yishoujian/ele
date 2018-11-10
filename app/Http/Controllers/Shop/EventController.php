<?php

namespace App\Http\Controllers\Shop;

use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class EventController extends BaseController
{
    //查看
    public function index()
    {

        //得到当前时间
        $time=time();
//        dd($time);
        $events=\App\Models\Event::where("start_time","<",$time)->where("end_time",'>',$time)->get();
//        dd($events);


        return view("shop.event.index",compact("events"));

    }


    //报名

    public function add(Request $request,$id)
    {
        //得到当前用户
        $user_id=Auth::id();
//        dd($user_id);
        //总数
//       $event= Event::where("id",$id)->pluck("num");
////       dd($event);
//        //已经报名的数量
//       $num= EventUser::where("event_id",$id)->count();
//       dd($num);
//        $num=Redis::get("event_num",15);
       //得到限制的人数
       $num= Redis::get("event_num:".$id);
       //得到已经报名的人数
       $count =Redis::scard("event:".$id)??EventUser::where("event_id",$id)->count();
       //如果已经报名的人少于限制得人
        if ($count < $num){
            //把报名人的user_id存到redis  用集合
            Redis::sadd("event:".$id,$user_id);
            return redirect()->route("shop.event.index")->with("success","报名成功,等待开奖");
        }else{
            return redirect()->route("shop.event.index")->with("danger","报名失败,人数已经满了");
        }








//        $event=Event::find($id);
////        不能超过人数
//        $nums=EventUser::where("event_id",$id)->count();
////        dd($nums);
//        if (Event::where("id",$id)->first()->num <$nums){
//            return redirect()->route("shop.event.index")->with("danger","你来迟了");
//            }
//
//        $user_id=Auth::guard()->id();
////        dd($user_id);
//
////        dd($event);
//        查出同一用户 不能报名二次
//       $user= EventUser::where("user_id",$user_id)->get();
//       if ($id==$user[0]['event_id']){
//           return redirect()->route("shop.event.index")->with("danger","你已经报名了");
//       }
//
//       //得到报名人数
//        $count=EventUser::where("event_id",$id)->where("user_id",$user_id)->count();
////       dd($count);
//
//
//
//        $data=[];
//        $data['event_id']=$event['id'];
//        $data['user_id']=$user_id;
//        EventUser::create($data);
//
//       $event['count']= $event['count']+1;
//       $event->save();
//        return redirect()->route("shop.event.index")->with("success","报名成功,等待开奖");
//
//
    }

}
