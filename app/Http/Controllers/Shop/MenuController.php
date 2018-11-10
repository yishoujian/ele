<?php

namespace App\Http\Controllers\Shop;

use App\Models\Menu;
use App\Models\MenuCategory;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MenuController extends BaseController
{
    public function index(Request $request)
    {
        //找到属于用户的所有分类
        $id=Auth::id();
        $url=$request->query();
        $cate=$request->get("category_id");
        $min=$request->get("min");
        $max=$request->get("max");
        $goods_name=$request->get("goods_name");




        $menu=Menu::where("user_id",$id)->orderBy('id');
//        dd($re);
        if ($cate!==null){
            $menu->where("category_id",$cate);
        }
        if ($min!==null){
            $menu->where("goods_price",">=",$min);
        }

        if ($max!==null){
            $menu->where("goods_price","<=",$max);
        }

        if ($goods_name!==null){
            $menu->where("goods_name","like","%{$goods_name}%");
        }


        $scs=MenuCategory::where("user_id",$id)->get();

        //找出商家的所有菜品
        $mcs=$menu->paginate(3);
//        dd($mcs);

        return view("shop.menu.index",compact("mcs","scs","url"));

    }

    public function add(Request $request)
    {
        $id=Auth::id();
        if ($request->isMethod("post")){
            $this->validate($request,[
               "goods_name"=>"required",
//                "goods_img"=>"image",
            ]);
            $data=$request->post();
            $shop_id=Shop::where("user_id",$id)->first();
//            dd($shop_id['id']);
            $data['shop_id']=$shop_id['id'];
          $data['user_id']=$id;

//            $file=$request->file('goods_img');

//            if ($file!==null){
//                //上传文件
//                $fileName= $file->store("ali","oss");
//
//                }
                //            dd($data);
//            $data['goods_img']=$fileName;
            if (Menu::create($data)){
                return redirect()->route("shop.menu.index")->with("success","添加菜品成功");
            }

        }else{
            $id=Auth::id();
            $scs=MenuCategory::where("user_id",$id)->get();

            return view("shop.menu.add",compact("scs"));
        }
        }


    public function edit(Request $request,$id)
    {
        $id1=Auth::id();
        $m=Menu::find($id);
        if ($request->isMethod("post")){
            $data=$request->post();
//            if ($request->file("goods_img")){
//                $data['goods_img']=$request->file("goods_img")->store("menu","image");
//            }

//            dd($data);
            if ($m->update($data)){
                return redirect()->route("shop.menu.index")->with("success","修改成功");
            }

            }else{
            //得到所有菜品分类
           $mc=Menu::find($id);
//            dd($mc);
            $scs=MenuCategory::where("user_id",$id1)->get();
//            dd($scs);
            return view("shop.menu.edit",compact("scs","mc"));



        }

        }


    public function del(Request $request,$id)
    {


        $menu=Menu::find($id);
        $logo=$menu->goods_img;
        Storage::disk("oss")->delete($logo);
        $menu=Menu::find($id);

       if ($menu->delete()) {
           return redirect()->route("shop.menu.index")->with("success","删除菜品成功");
       }
       }


    public function uploade(Request $request)
    {
        //接收input中的name的值是file
        //$file=$request->file("goods_img");
       // if ($file!==null){
            //$fileName = $request->file('goods_img')->store("menu");
//            $data = [
//                'status' => 1,
//                'url' => env("ALIYUN_OSS_URL").$fileName
//            ];
//
//        }else{
//            $data = [
//                'status' => 0,
//                'url' => ""
//            ];
//        }
        $file=$request->file("file");//内部的文件  没有在html中显示
        if($file){
            //有文件进行上传
            $url = $file->store("menu");
            //得到真实地址  把http加载进去

            $data['url']=$url;
            return $data;
        }
    }
}
