<?php

namespace App\Http\Controllers\Shop;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    public function index(Request $request)
    {

        $time=time();
        $keyWord=$request->query("keyWord");
//        dd($user);


        $query=Article::orderBy("id");

        $articles=$query->where("start_time","<=","$time")->where("end_time",">",$time)->get();

        if ($keyWord!==null){

           $articles= $query->where("title","like","%{$keyWord}%")->orWhere("content","like","%{$keyWord}%")->get();
//            dd($articles);
        }
//                dd($articles);


        return view("shop.article.index",compact("articles"));

    }
}
