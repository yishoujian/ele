@extends("admin.layouts.main")
@section("title","管理员列表")

@section("content")

    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>管理员名称</th>
            <th>角色</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>
                    {{json_encode($roles = $admin->getRoleNames(),JSON_UNESCAPED_UNICODE)}}
                </td>

                <td>
                <a href="{{route("admin.admin.save",$admin)}}" class="btn btn-success">编辑</a>
                <a href="{{route("admin.admin.del",$admin)}}" class="btn btn-danger">删除</a>
                </td>

            </tr>
        @endforeach

    </table>

{{--{{$admins->links()}}--}}

@endsection
