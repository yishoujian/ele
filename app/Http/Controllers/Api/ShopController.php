<?php

namespace App\Http\Controllers\Api;

use App\Models\MenuCategory;
use App\Models\Shop;
use App\Models\ShopCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function list()
    {
        //搜索 得到关键字
        $keyword=\request()->input("keyword");
//        dd($keyword);

        //得到状态是1的所有商家
        $shops=Shop::where("status",1)->where("shop_name","like","%$keyword%")->get();
        foreach ($shops as $k=>$shop){
//            $shops[$k]->shop_img =$shop->shop_img;
            $shops[$k]->distance = rand(1000, 5000);
            $shops[$k]->estimate_time = ceil($shops[$k]['distance'] / 100);
            }
        return $shops;
    }


    public function index()
    {
        $id=\request()->get("id");
        //得到所有店铺信息
       $shop=Shop::find($id);
       $shop->service_code=5;
       $shop->foods_code=4.6;
       $shop->high_or_low=true;
       $shop->high_or_low=20;
//       $shop->shop_img=$shop->shop_img;
        $shop->distance = rand(1000, 5000);
        $shop->estimate_time = ceil($shop['distance'] / 100);
        $shop->evaluate=[

                [
                    "user_id"=> 12344,
                "username"=> "w******k",
                "user_img"=> "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time"=> "2017-2-22",
                "evaluate_code"=> 4.5,
                "send_time"=> 30,
                "evaluate_details"=> "很好吃",
            ],

            [


                "user_id"=> 12344,
                "username"=> "w******k",
                "user_img"=> "http=>//www.homework.com/images/slider-pic4.jpeg",
                "time"=> "2017-2-22",
                "evaluate_code"=> 4.5,
                "send_time"=> 30,
                "evaluate_details"=> "很好吃"

            ]

        ];

        $cates=MenuCategory::where("shop_id",$id)->get();
        //当前分类有哪些商品
        foreach ($cates as $k=>$cate){
            //要在MenuCategory model里面写关联方法
            $cates[$k]->goods_list=$cate->menu;
            foreach ($cates[$k]->goods_list as $i =>$v){
//                ($cates[$k]->goods_list)[$i]->goods_img=($cates[$k]->goods_list)[$i]->goods_img;
                }
                }
        $shop->commodity=$cates;
//        dd($shop);
        return $shop;





        /**
         * "id": "s10001",
         * "shop_name": "上沙麦当劳",
         * "shop_img": "http://www.homework.com/images/shop-logo.png",
         * "shop_rating": 4.5,
         * "service_code": 4.6,// 服务总评分
         * "foods_code": 4.4,// 食物总评分
         * "high_or_low": true,// 低于还是高于周边商家
         * "h_l_percent": 30,// 低于还是高于周边商家的百分比
         * "brand": true,
         * "on_time": true,
         * "fengniao": true,
         * "bao": true,
         * "piao": true,
         * "zhun": true,
         * "start_send": 20,
         * "send_cost": 5,
         * "distance": 637,
         * "estimate_time": 31,
         * "notice": "新店开张，优惠大酬宾！",
         * "discount": "新用户有巨额优惠！",
         * "evaluate": [{评价
        "user_id": 12344
        "username": "w******k"用户名
        "user_img": "http://www.homework.com/images/slider-pic4.jpeg",
        "time": "2017-2-22",
        "evaluate_code": 1,评分
        "send_time": 30,送达时间
        "evaluate_details": "不怎么好吃"
        }
        ],
         * "commodity": [{//店铺商品
        "description": "大家喜欢吃，才叫真好吃。",分类描述
        "is_selected": true,是否选中
        "name": "热销榜",分类名称
        "type_accumulation": "c1",//类型id
        "goods_list": [{类型下的商品
        "goods_id": 100001,
        "goods_name": "吮指原味鸡",
        "rating": 4.67,评分
        "goods_price": 11,
        "description": "",
        "month_sales": 590,月销售
        "rating_count": 91,评分比率
        "tips": "具有神秘配方浓郁的香料所散发的绝佳风味，鲜嫩多汁。",描述
        "satisfy_count": 8,好评数
        "satisfy_rate": 95,好评率
        "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
        }]}}]
         */
        echo <<<JSON
    {
        "id": "s10001",
        "shop_name": "上沙麦当劳",
        "shop_img": "http://www.homework.com/images/shop-logo.png",
        "shop_rating": 4.5,
        "service_code": 4.6,
        "foods_code": 4.4,
        "high_or_low": true,
        "h_l_percent": 30,
        "brand": true,
        "on_time": true,
        "fengniao": true,
        "bao": true,
        "piao": true,
        "zhun": true,
        "start_send": 20,
        "send_cost": 5,
        "distance": 637,
        "estimate_time": 31,
        "notice": "新店开张，优惠大酬宾！",
        "discount": "新用户有巨额优惠！",
        "evaluate": [{
                "user_id": 12344,
                "username": "w******k",
                "user_img": "http://www.homework.com/images/slider-pic4.jpeg",
                "time": "2017-2-22",
                "evaluate_code": 1,
                "send_time": 30,
                "evaluate_details": "不怎么好吃"
            },
            {
                "user_id": 12344,
                "username": "w******k",
                "user_img": "http://www.homework.com/images/slider-pic4.jpeg",
                "time": "2017-2-22",
                "evaluate_code": 4.5,
                "send_time": 30,
                "evaluate_details": "很好吃"
            },
            {
                "user_id": 12344,
                "username": "w******k",
                "user_img": "http://www.homework.com/images/slider-pic4.jpeg",
                "time": "2017-2-22",
                "evaluate_code": 5,
                "send_time": 30,
                "evaluate_details": "很好吃"
            },
            {
                "user_id": 12344,
                "username": "w******k",
                "user_img": "http://www.homework.com/images/slider-pic4.jpeg",
                "time": "2017-2-22",
                "evaluate_code": 4.7,
                "send_time": 30,
                "evaluate_details": "很好吃"
            },
            {
                "user_id": 12344,
                "username": "w******k",
                "user_img": "http://www.homework.com/images/slider-pic4.jpeg",
                "time": "2017-2-22",
                "evaluate_code": 5,
                "send_time": 30,
                "evaluate_details": "很好吃"
            }
        ],
        "commodity": [{
                "description": "大家喜欢吃，才叫真好吃。",
                "is_selected": true,
                "name": "热销榜",
                "type_accumulation": "c1",
                "goods_list": [{
                        "goods_id": 100001,
                        "goods_name": "吮指原味鸡",
                        "rating": 4.67,
                        "goods_price": 11,
                        "description": "",
                        "month_sales": 590,
                        "rating_count": 91,
                        "tips": "具有神秘配方浓郁的香料所散发的绝佳风味，鲜嫩多汁。",
                        "satisfy_count": 8,
                        "satisfy_rate": 95,
                        "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
                    },
                    {
                        "goods_id": 100002,
                        "goods_name": "香辣鸡腿堡",
                        "rating": 5,
                        "goods_price": 17,
                        "description": "",
                        "month_sales": 723,
                        "rating_count": 65,
                        "tips": "整块无骨鸡腿肉, 浓郁汉堡酱，香脆鲜辣多汁。",
                        "satisfy_count": 6,
                        "satisfy_rate": 100,
                        "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
                    },
                    {
                        "goods_id": 100003,
                        "goods_name": "蟹黄堡",
                        "rating": 5,
                        "goods_price": 17,
                        "description": "",
                        "month_sales": 723,
                        "rating_count": 65,
                        "tips": "浓郁汉堡酱，香脆鲜辣多汁。",
                        "satisfy_count": 6,
                        "satisfy_rate": 100,
                        "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
                    }
                ]
            },
            {
                "description": "",
                "is_selected": false,
                "name": "美味汉堡",
                "type_accumulation": "c2",
                "goods_list": [{
                        "goods_id": 100004,
                        "goods_name": "麦香鸡腿堡",
                        "rating": 5,
                        "goods_price": 18,
                        "description": "",
                        "month_sales": 723,
                        "rating_count": 65,
                        "tips": "整块无骨鸡腿肉, 浓郁汉堡酱，香脆鲜辣多汁。",
                        "satisfy_count": 6,
                        "satisfy_rate": 100,
                        "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
                    },
                    {
                        "goods_id": 100005,
                        "goods_name": "腿堡",
                        "rating": 5,
                        "goods_price": 18,
                        "description": "",
                        "month_sales": 723,
                        "rating_count": 65,
                        "tips": "整块无骨鸡腿肉, 浓郁汉堡酱，香脆鲜辣多汁。",
                        "satisfy_count": 6,
                        "satisfy_rate": 100,
                        "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
                    }
                ]
            },
            {
                "description": "",
                "is_selected": false,
                "name": "派",
                "type_accumulation": "c3",
                "goods_list": [{
                        "goods_id": 100006,
                        "goods_name": "红豆派",
                        "rating": 5,
                        "goods_price": 11,
                        "description": "",
                        "month_sales": 723,
                        "rating_count": 65,
                        "tips": "整块无骨鸡腿肉, 浓郁汉堡酱，香脆鲜辣多汁。",
                        "satisfy_count": 6,
                        "satisfy_rate": 100,
                        "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
                    },
                    {
                        "goods_id": 100007,
                        "goods_name": "香芋派",
                        "rating": 5,
                        "goods_price": 11,
                        "description": "",
                        "month_sales": 723,
                        "rating_count": 65,
                        "tips": "整块无骨鸡腿肉, 浓郁汉堡酱，香脆鲜辣多汁。",
                        "satisfy_count": 6,
                        "satisfy_rate": 100,
                        "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
                    }
                ]
            },
            {
                "description": "",
                "is_selected": false,
                "name": "饮料",
                "type_accumulation": "c4",
                "goods_list": [{
                    "goods_id": 100008,
                    "goods_name": "可乐",
                    "rating": 5,
                    "goods_price": 8,
                    "description": "",
                    "month_sales": 723,
                    "rating_count": 65,
                    "tips": "小杯可乐",
                    "satisfy_count": 6,
                    "satisfy_rate": 100,
                    "goods_img": "http://www.homework.com/images/slider-pic4.jpeg"
                }]
            }
        ]
    }
JSON;

    }
}
