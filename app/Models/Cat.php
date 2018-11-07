<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    protected $fillable=["user_id","goods_id","goods_name","goods_img","amount","goods_price","totalCost"];
}
