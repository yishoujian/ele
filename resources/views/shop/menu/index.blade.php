@extends("shop.layouts.main")
@section("title","菜品首页")
@section("content")
    <div>
        <div class="col-sm-1" >
            <a href="{{route("shop.menu.add")}}" class="btn btn-success">添加</a>
        </div>
        <div class="col-sm-11 ">
            <form class="form-inline pull-right" method="get">

                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Email address</label>
                    <select name="category_id" class="form-control">
                        <option value="">菜品分类</option>
                        @foreach($scs as $sc)
                            <option value="{{$sc->id}}">{{$sc->name}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3"></label>
                    <input type="text" class="form-control" id="exampleInputEmail3" placeholder="请输入最低价" name="min">
                </div>


                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3"></label>
                    <input type="text" class="form-control" id="exampleInputEmail3" placeholder="请输入最高价" name="max">
                </div>


                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword3"></label>
                    <input type="text" class="form-control" id="exampleInputPassword3" placeholder="请输入菜名" name="goods_name">
                </div>
                <button type="submit" class="btn btn-warning">搜索</button>
            </form>
        </div>
    </div>





    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>所属商家ID</th>
            <th>所属分类ID</th>
            <th>价格</th>
            <th>描述</th>
            <th>图片</th>
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($mcs as $mc)
            <tr>
                <td>{{$mc->id}}</td>
                <td>{{$mc->goods_name}}</td>

                <td>
                    @if($mc->shop1)
                    {{$mc->shop1->shop_name}}
                        @endif
                </td>
                <td>
                    @if($mc->cate)
                    {{$mc->cate->name}}
                        @endif
                </td>
                <td>{{$mc->goods_price}}</td>
                <td>{{$mc->description}}</td>
                <td>
                    <img src="{{env("ALIYUN_OSS_URL").$mc->goods_img}}?x-oss-process=image/resize,m_fill,w_80,h_80">
                </td>
                <td>
                    @if($mc->status==1)
                上架
                    @else
                     下架
                    @endif
                </td>
                <td>
                <a href="{{route("shop.menu.edit",$mc->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("shop.menu.del",$mc->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach

    </table>

{{$mcs->appends($url)->links()}}

@endsection
