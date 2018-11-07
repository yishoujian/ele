<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    protected $fillable=["order_id","goods_id","amount","goods_name","goods_img","goods_price","created_at"];


    public function Menu()
    {
        return $this->belongsTo(Menu::class,"goods_id");
        
    }
}
