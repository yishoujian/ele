@extends("admin.layouts.main")
@section("title","修改管理员密码")

@section("content")
    <form method="post" class="form-horizontal">
        {{csrf_field()}}

        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码" name="password">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">确认密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="请输入密码" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-warning">修改密码</button>
    </form>
@endsection