<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends BaseController
{
    public function index(Request $request)
    {

        $url = $request->query();
        //接受
        $num = $request->get("num");
        $con = $request->get("keyWord");
        //得到所有并要有分页
        $query=Article::orderBy("id");
//        dd($query);
        //当前时间
        $time =time();
//        dd($time);
        //判断 时间 3过期 1未开始 2正在进行

        if($num ==3){
            $query->where("end_time","<","$time");
        }
        if($num ==1){
            $query->where("start_time",">","$time");
        }
        if($num ==2){
            $query->where("start_time","<=","$time")->where("end_time",">",$time);
        }
        //内容
        if($con !==null){
            $query->where("title","like","%{$con}%")->orWhere("content","like","%{$con}%");
        }
        $articles = $query->paginate(2);

        return view("admin.article.index",compact("articles","url"));

    }

    public function add(Request $request)
    {
        if ($request->isMethod("post")){
            $this->validate($request,[
                "title"=>"required",
            ]);
            $data = $request->post();

//            dd($data);

            $data['start_time'] = strtotime($data['start_time']);
            $data['end_time'] = strtotime($data['end_time']);
            if ($data['start_time']>=$data['end_time']){
                return back()->with("danger","开始时间不能大于结束时间啊")->withInput();
            }

            if (Article::create($data)){
                return redirect()->route("admin.article.index")->with("success","添加活动成功");
            }

        }else{

            return view("admin.article.add");
        }

    }


    public function del(Request $request,$id)
    {
        Article::find($id)->delete();
        return redirect()->route("admin.article.index")->with("success","删除活动成功");

    }
}
