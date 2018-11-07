@extends("shop.layouts.main")
@section("title","菜品分类首页")
@section("content")
    <a href="{{route("shop.menu_category.add")}}" class="btn btn-success">添加</a>
    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>名称</th>
            <th>所属商家ID</th>
            <th>描述</th>
            <th>是否默认分类</th>
            <th>操作</th>
        </tr>
        @foreach($mcs as $mc)
            <tr>
                <td>{{$mc->id}}</td>
                <td>{{$mc->name}}</td>
                <td>
                    @if($mc->shop2)
                    {{$mc->shop2->shop_name}}
                        @endif
                </td>
                <td>{{$mc->description}}</td>
                <td>
                    @if($mc->is_selected==1)
                默认
                    @else
                     否
                    @endif
                </td>
                <td>
                <a href="{{route("shop.menu_category.edit",$mc->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("shop.menu_category.del",$mc->id)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach

    </table>



@endsection
