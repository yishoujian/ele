@extends("admin.layouts.main")
@section("title","订单列表按月")
@section("content")

    <form class="form-inline" method="get">

        <input type="month" name="start" class="form-control" size="2" placeholder="开始日期"
             > -
        <input type="month" name="end" class="form-control" size="2" placeholder="结束日期"
            >
        <input type="submit" value="搜索" class="btn btn-success">
    </form>

    <table class="table table-bordered">
        <tr>
            <th>时间</th>
            <th>订单总数</th>
            <th>总价</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->date}}</td>
                <td>{{$order->nums}}</td>
                <td>{{$order->money}}</td>

                <td>
                    <a href="{{route("shop.order.index")}}" class="btn btn-danger">返回</a>
                </td>

            </tr>
        @endforeach
    </table>

    {{--{{$orders->appends($url)->links()}}--}}
@endsection
