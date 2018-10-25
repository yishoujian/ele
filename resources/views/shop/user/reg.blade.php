@extends("shop.layouts.main")
@section("title","用户注册")

@section("content")
    <div class="row">


        <div class="box box-info">

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="用户名" name="name" {{old("name")}}>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">密码</label>

                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="密码" name="password" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">确认密码</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="确认密码" name="password_confirmation">
                        </div>
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<div class="col-sm-offset-2 col-sm-10">--}}
                            {{--<div class="checkbox">--}}
                                {{--<label>--}}
                                    {{--<input type="checkbox"> 记住我--}}
                                {{--</label>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    {{--<button type="submit" class="btn btn-default"></button>--}}
                    <button type="submit" class="btn btn-info pull-right">注册</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>

    </div>
@endsection