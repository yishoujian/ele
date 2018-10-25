@extends("shop.layouts.main")
@section("title","商铺申请")

@section("content")
    <div class="row">


        <div class="box box-info">

            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺名</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail3" placeholder="请输入店铺名" name="shop_name" {{old("shop_name")}}>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">店铺头像</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="inputEmail3" placeholder="" name="logo">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">起送金额</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="请输入起送金额" name="start_send" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">配送费</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="配送费" name="send_cost">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">店铺公告</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="店铺公告" name="notice">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">优惠信息</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPassword3" placeholder="优惠信息" name="discount">
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">店铺分类</label>
                        <div class="col-sm-10">
                            <select name="shop_category_id" class="form-control">

                                @foreach($scs as $sc)
                                <option value="{{$sc->id}}">{{$sc->name}}</option>

                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="brand" value="1" @if(old('brand')==1) checked @endif> 品牌连锁店
                            </label>


                            <label>
                                <input type="checkbox" name="on_time" value="1" @if(old('on_time')==1) checked @endif> 准时送达
                            </label>

                            <label>
                                <input type="checkbox" name="fengniao" value="1" @if(old('fengniao')==1) checked @endif> 蜂鸟配送
                            </label>

                            <label>
                                <input type="checkbox" name="bao" value="1" @if(old('bao')==1) checked @endif> 保
                            </label>

                            <label>
                                <input type="checkbox" name="piao" value="1" @if(old('piao')==1) checked @endif> 票
                            </label>

                            <label>
                                <input type="checkbox" name="zhun" value="1" @if(old('zhun')==1) checked @endif> 准
                            </label>
                        </div>
                    </div>




                </div>
                <div class="box-footer">
                    {{--<button type="submit" class="btn btn-default"></button>--}}
                    <button type="submit" class="btn btn-info pull-right">申请</button>
                </div>
                <!-- /.box-footer -->
            </form>
        </div>

    </div>
@endsection