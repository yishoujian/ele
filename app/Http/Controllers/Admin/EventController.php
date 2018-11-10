<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventPrize;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Redis;

class EventController extends BaseController
{
    public function index()
    {

 $events=\App\Models\Event::all();


        return view("admin.event.index",compact("events"));

    }

    //添加活动
    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            $data=$request->post();
//            dd(strtotime($data['end_time']));
//            dd($data['num']);
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['prize_time']=strtotime($data['prize_time']);
            $this->validate($request,[
                "title"=>"required",
                "content"=>"required",
                "num"=>"required",
                ]);
            if ($data['start_time'] >=$data['end_time']){
                return  redirect()->route("admin.event.add")->with("danger","还没开始就结束?");
            }
          $event= \App\Models\Event::create($data);
//            dd($event);

            //把总的报名人数和现在已经报名的人数 存在redis中
            Redis::set("event_num:".$event->id,$event->num);
           return redirect()->route("admin.event.index")->with("success","添加成功");


        }else{
            return view("admin.event.add");
            }

    }


    public function edit(Request $request,$id)
    {
        $event=\App\Models\Event::find($id);
        if ($request->isMethod("post")){

            $data=$request->post();
            $data['start_time']=strtotime($data['start_time']);
            $data['end_time']=strtotime($data['end_time']);
            $data['prize_time']=strtotime($data['prize_time']);
            if ($event->update($data)) {
                return redirect()->route("admin.event.index")->with("success","编辑成功");
            }


        }else{



            return view("admin.event.edit",compact("event"));


        }

    }


    public function del(Request $request,$id)
    {
        $event=\App\Models\Event::find($id);
        $event->delete();
        return redirect()->route("admin.event.index")->with("success","删除成功");

        }

        //开奖
    public function open(Request $request,$id)
    {
        //取出redis中的所有成员 加入到event_user表中
        $event_user=Redis::smembers("event:".$id);
//        dd($event_user);
        foreach ($event_user as $user){

            EventUser::insert([
                "event_id"=>$id,
                "user_id"=>$user
            ]);


        }



        //取出奖品
        $prize= EventPrize::where("event_id",$id)->get();
       $liwu=$prize[0]->name;
//       dd($liwu);
        $user=EventUser::where("event_id",$id)->pluck('user_id')->toArray();
        shuffle($user);
//        dd($user);

        //得到名字
        $name=User::where("id",$user[0])->pluck("name");
//       dd($name[0]);
        $name=$name[0];
       //改变状态
        $status=\App\Models\Event::where("id",$id)->first();
        if ($status->is_prize==1){
            return redirect()->route("admin.event.index")->with("danger","已经开过奖了");
        }

       $status->is_prize=1;
       $status->save();
       //把礼物也改变
        $prize_id=EventPrize::where("event_id",$id)->first();
        $prize_id->user_id=$user[0];
        $prize_id->save();
//        dd($prize_id);

       return view("admin.event.ok",compact("liwu","name"))->with("success","开奖成功,恭喜");

       }

}
