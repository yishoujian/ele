@extends("admin.layouts.main")
@section("title","商铺分类首页")

@section("content")

    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>路由名称</th>
            <th>简介</th>
            <th>操作</th>
        </tr>
        @foreach($pers as $per)
            <tr>
                <td>{{$per->id}}</td>
                <td>{{$per->name}}</td>
                <td>{{$per->intro}}</td>
                <td>
                    <a href="{{route("admin.per.edit",$per)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.per.del",$per)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
