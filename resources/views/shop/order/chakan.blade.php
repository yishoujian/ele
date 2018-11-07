@extends("shop.layouts.main")
@section("title","订单列表")
@section("content")

    <form class="form-inline pull-right" method="get">
        <input type="text" class="form-control" id="exampleInputPassword3" placeholder="请输入活动名或者内容" name="keyWord">
        <button type="submit" class="btn btn-warning">搜索</button>
    </form>

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>订单编号</th>
            <th>用户名称</th>
            <th>用户电话</th>
            <th>总价</th>
            <th>详细地址</th>
            <th>状态</th>
            <th>下单时间</th>
            <th>操作</th>
        </tr>
        <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->order_code}}</td>
                <td>{{$order->member->username}}</td>
                <td>{{$order->tel}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->provence.$order->city.$order->area.$order->detail_address}}</td>
                <td>
                    @if($order->status==-1)
                        "已取消"
                        @endif
                        @if($order->status==0)
                          "待付款"
                        @endif
                        @if($order->status==1)
                            "待发货"
                        @endif
                        @if($order->status==2)
                            "待确认"
                        @endif
                        @if($order->status==3)
                            "已完成"
                        @endif
                </td>
                <td>{{$order->created_at}}</td>

                <td>
                    <a href="{{route("shop.order.index",$order)}}" class="btn btn-danger">返回</a>
                </td>

            </tr>

    </table>


@endsection
