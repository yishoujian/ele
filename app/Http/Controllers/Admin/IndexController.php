<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends BaseController
{
    //大后台首页
    public function index()
    {
        return view("admin.admin.index");

    }
}
