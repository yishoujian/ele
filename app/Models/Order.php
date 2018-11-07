<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    //声明静态属性
    static public $statusText = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];

    protected $fillable=["user_id","shop_id","order_code","provence","city","area","detail_address","tel","name","total","status"];

    public function shop()
    {
        return $this->belongsTo(Shop::class,"shop_id");
    }
    public function goods()
    {
        return $this->hasMany(OrderGoods::class, "order_id");
    }


    //读取器 不存在的字段
    public function getOrderStatusAttribute()
    {
        //$arr = [-1 => "已取消", 0 => "代付款", 1 => "待发货", 2 => "待确认", 3 => "完成"];
        return self::$statusText[$this->status];//-1 0 1 2 3
    }

    public function member()
    {
        return $this->belongsTo(Member::class,"user_id");

    }
}