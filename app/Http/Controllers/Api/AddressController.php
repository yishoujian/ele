<?php

namespace App\Http\Controllers\Api;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function add(Request $request)
    {
        $data=\request()->post();
       $re=Validator::make($data,[
           'tel'=>[
               "required",
               'regex:/^0?(13|14|16|15|17|18|19)[0-9]{9}$/',
           ]
       ]);

       if ($re->fails()){
           return $data=[
                "status"=>'false',
                "massage"=>$re->errors()->first()
            ];
       }
        Address::create($data);

        return [
          "status"=>"true",
          "massage"=>'添加地址成功',
        ];



        
    }

    public function index(Request $request)
    {
        $user_id=$request->post();
//        dd($user_id);
       return Address::where("user_id",$user_id)->get();


    }


    //编辑回显

    public function save(Request $request)
    {
        $id=$request->post("id");
//        dd($id);
        $datas= Address::where("id",$id)->get();
        foreach ($datas as $data){
            return $data;

        }

    }



    public function edit(Request $request)
    {
        $id=$request->get('id');
//        dd($data);
//        dd($id);
        $address=Address::where("id",$id)->first();
//        dd($address);
        $data=$request->post();
        if ($address->update($data)){
            return [
              "status"=>"true",
              "massage"=>"编辑地址成功",
            ];
        }else{
            return [
                "status"=>"false",
                "massage"=>"编辑地址失败",
            ];
        }


    }
}
