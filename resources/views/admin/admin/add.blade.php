@extends("admin.layouts.main")
@section("title","添加管理员")

@section("content")
    <form method="post" class="form-horizontal">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputEmail1">账号</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入账号" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码" name="password">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">添加角色</label>
            @foreach($roles as $role)
                <input type="checkbox" name="role[]" value="{{$role->id}}">{{$role->name}}
            @endforeach
        </div>

        <button type="submit" class="btn btn-warning">添加管理员</button>
    </form>
@endsection