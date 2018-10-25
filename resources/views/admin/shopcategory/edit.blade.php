@extends("shop.layouts.main")
@section("title","商铺分类编辑")

@section("content")
    <div class="row">


        <div class="box box-info">

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺分类名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="请输入店铺分类名" name="name"  value="{{$shop->name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺分类头像</label>
                        <div class="col-sm-10">
                            {{--<input type="file" class="form-control" id="inputEmail3" placeholder="" name="logo" >--}}
                            <img src="{{$shop->logo}}" alt="" width="80">
                        </div>
                    </div>


                <div class="box-footer">
                    {{--<button type="submit" class="btn btn-default"></button>--}}
                    <button type="submit" class="btn btn-info pull-right">编辑分类</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>

    </div>
@endsection