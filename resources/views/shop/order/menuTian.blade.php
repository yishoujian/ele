@extends("shop.layouts.main")
@section("title","订单列表")
@section("content")

    <form class="form-inline" method="get">

        <input type="date" name="start" class="form-control" size="2" placeholder="开始日期"
             > -
        <input type="date" name="end" class="form-control" size="2" placeholder="结束日期"
            >
        <input type="submit" value="搜索" class="btn btn-success">
    </form>

    <table class="table table-bordered">
        <tr>
            <th>时间</th>
            <th>菜品名字</th>
            <th>菜品价格</th>
            <th>总数</th>
            <th>总价</th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{$order->day}}</td>
                <td>{{$order->name}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->nums}}</td>
                <td>{{$order->totals}}</td>

                <td>
                    <a href="{{route("shop.order.index")}}" class="btn btn-danger">返回</a>
                </td>

            </tr>
        @endforeach
    </table>

    {{$orders->appends($url)->links()}}
@endsection
