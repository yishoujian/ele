@extends("admin.layouts.main")
@section("title","商品编辑")

@section("content")
    <div class="row">
        <div class="box box-info">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">权限名字</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="权限名字" name="name" {{old("name")}} >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">权限描述</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="描述" name="intro"  >
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">添加权限</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>

    </div>
@endsection