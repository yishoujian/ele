<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable=["goods_name","rating","shop_id","category_id","goods_price","description","month_sales","rating_count","tips","satisfy_count","satisfy_rate","goods_img","status","user_id"];

    //菜品属于菜品分类
    public function cate()
    {
      return  $this->belongsTo(MenuCategory::class,"category_id");

    }

    //菜品属于店铺
    public function shop1()
    {
        return $this->belongsTo(Shop::class,"shop_id");

    }
}
