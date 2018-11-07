<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function send()
    {
        $content ="你的店铺审核成功";
        $to = '784259775@qq.com';
        $subject = '店铺开通通知';
//        dd($message);
        Mail::send(
            'email.send',
            compact("content"),
            function ($message) use($to, $subject) {
                $message->to($to)->subject($subject);
            }
        );
        }

}
