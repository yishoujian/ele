<?php

namespace App\Http\Controllers\Admin;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventPrizeController extends Controller
{
    public function index()
    {

        $events=EventPrize::all();
        return view("admin.event_prize.index",compact("events"));

        }

    public function add(Request $request)
    {
        $events=Event::all();
        if ($request->isMethod("post")){
            $data=$request->post();
            $this->validate($request,[
               "event_id"=>"required"
            ]);
            EventPrize::create($data);
            return redirect()->route("admin.event_prize.index")->with("success","添加成功");

        }else{
            return view("admin.event_prize.add",compact("events"));
            }
            }

    public function edit(Request $request,$id)
    {
        $prize=EventPrize::find($id);
        $events=Event::all();
        if ($request->isMethod("post")){
            $data=$request->post();
            $prize->update($data);
            return redirect()->route("admin.event_prize.index")->with("success","编辑成功");

        }else{
           return view("admin.event_prize.edit",compact("prize","events"));
        }

            }


    public function del(Request $request,$id)
    {
        $prize=EventPrize::find($id);
        $prize->delete();
        return redirect()->route("admin.event_prize.index")->with("success","删除成功");


            }
}
