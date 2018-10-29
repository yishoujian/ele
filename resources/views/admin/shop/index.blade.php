@extends("admin.layouts.main")
@section("title","商铺分类首页")

@section("content")

    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>分类名称</th>
            <th>状态</th>
            <th>照片</th>
            <th>操作</th>
        </tr>
        @foreach($shops as $shop)
            <tr>
                <td>{{$shop->id}}</td>
                <td>{{$shop->shop_name}}</td>
                <td>{{$shop->category->name}}</td>
                <td>
                    @if($shop->status==1)
                在线
                    @else
                     下线
                    @endif
                </td>

                <td>
                    <img src="{{env("ALIYUN_OSS_URL").$shop->shop_img}}" alt="" width="100">
                </td>
                <td>
                    @if($shop->status==0)
                        <a href="{{route("admin.shop.shenhe",$shop->id)}}" class="btn btn-success

" >审核</a>

                   @endif

                    <a href="{{route("admin.shop.edit",$shop->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.shop.del",$shop->id)}}" class="btn btn-danger">删除</a>
                </td>

            </tr>
        @endforeach

    </table>

{{$shops->links()}}

@endsection
