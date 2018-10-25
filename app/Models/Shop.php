<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Shop
 *
 * @mixin \Eloquent
 */
class Shop extends Model
{
    protected $fillable=["shop_category_id","shop_name","logo","shop_rating","brand","on_time","fengniao","bao","piao","zhun","start_send","send_cost","notice","discount","status","user_id"];

    public function category()
    {
        return $this->belongsTo(ShopCategory::class,"shop_category_id");
        
    }

    public function user()
    {
        return $this->belongsTo(User::class,"user_id");

    }




}
