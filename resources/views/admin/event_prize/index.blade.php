@extends("admin.layouts.main")
@section("title","奖品首页")

@section("content")
    <a href="{{route('admin.event_prize.add')}}" class="btn btn-primary">添加</a>
    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>活动ID</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家账号id</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->event_id}}</td>
                <td>
                    {{$event->name}}
                </td>
                <td>{{$event->description}}</td>
                <td>
                    {{$event->user_id}}
                </td>

                <td>
                    <a href="{{route("admin.event_prize.edit",$event)}}" class="btn btn-info">编辑</a>
                    <a href="{{route("admin.event_prize.del",$event)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>




@endsection
