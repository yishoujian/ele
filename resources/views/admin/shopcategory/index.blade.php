@extends("shop.layouts.main")
@section("title","商铺分类首页")

@section("content")

    <a href="{{route('admin.shop_category.add')}}" class="btn btn-success">添加</a>
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>内容</th>
            <th>照片</th>
            <th>操作</th>
        </tr>
        @foreach($scs as $sc)
            <tr>
                <td>{{$sc->id}}</td>
                <td>{{$sc->name}}</td>
                <td>
                    @if($sc->status==1)
                在线
                    @else
                     下线
                    @endif
                </td>

                <td>
                    <img src="/{{$sc->logo}}" alt="" width="100">
                </td>
                <td>
                    <a href="{{route("admin.shop_category.edit",$sc->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.shop_category.del",$sc->id)}}" class="btn btn-danger">删除</a>
                </td>

            </tr>
        @endforeach

    </table>



@endsection
