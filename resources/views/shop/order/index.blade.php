@extends("shop.layouts.main")
@section("title","订单列表")
@section("content")



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
        @foreach($orders as $order)
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
                    <a href="{{route("shop.order.chakan",$order)}}" class="btn btn-danger">查看订单</a>

                    @if($order->status==0)
                        <a href="{{route("shop.order.quxiao",$order)}}" class="btn btn-danger">取消订单</a>
                    @endif
                    @if($order->status==1)
                        <a href="{{route("shop.order.fahuo",$order)}}" class="btn btn-danger">发货</a>
                        @endif
                    @if($order->status==2)
                    <a href="{{route("shop.order.queren",$order)}}" class="btn btn-danger">确认</a>
                        @endif
                        @if($order->status==3)
                            <a href="#" class="btn btn-danger">已经完成</a>
                        @endif
                        @if($order->status==-1)
                            <a href="{{route("shop.order.del",$order)}}" class="btn btn-danger">删除</a>
                        @endif

                </td>

            </tr>
        @endforeach
    </table>

    {{$orders->appends($url)->links()}}
@endsection
