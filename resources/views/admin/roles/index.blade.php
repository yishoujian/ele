@extends("admin.layouts.main")
@section("title","商铺分类首页")

@section("content")

    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>角色名称</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr>
                <td>{{$role->id}}</td>
                <td>{{$role->name}}</td>

                <td>
                    <a href="" class="btn btn-success">编辑</a>
                    <a href="" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
