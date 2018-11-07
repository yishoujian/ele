@extends("shop.layouts.main")
@section("title","菜品分类添加")

@section("content")
    <div class="row">


        <div class="box box-info">

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">菜品分类名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="请输入店铺名" name="name" {{old("shop_name")}}>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">菜品编号（a-z前端使用）</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="请菜品编号" name="type_accumulation" {{old("type_accumulation")}}>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">描述</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail3" placeholder="请写描述" name="description" {{old("description")}}>
                                </div>
                            </div>

                            <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="radio" name="is_selected" value="1" checked>默认
                            </label>
                            <input type="radio" name="is_selected" value="0" >否
                            </label>

                        </div>
                <div class="box-footer">
                    {{--<button type="submit" class="btn btn-default"></button>--}}
                    <button type="submit" class="btn btn-info pull-right">添加</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>

    </div>
@endsection