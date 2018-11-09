@extends("shop.layouts.main")
@section("title","抽奖活动首页")

@section("content")

    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>标题</th>
            <th>内容</th>
            <th>报名时间</th>
            <th>结束时间</th>
            <th>开奖时间</th>
            <th>报名人数/总数</th>
            <th>开奖状态</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr>
                <td>{{$event->id}}</td>
                <td>{{$event->title}}</td>
                <td>{{$event->content}}</td>
                <td>{{date('Y-m-d H:i:s',$event->start_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$event->end_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$event->prize_time)}}</td>

                <td>{{\App\Models\Event::where("id",$event->id)->get()->pluck("count")}}/{{$event->num}}</td>
                <td>
                    @if($event->is_prize==0)
                        否
                        @endif
                        @if($event->is_prize==1)
                            是
                        @endif

                </td>

                <td>
                    <a href="{{route("shop.event.add",$event)}}" class="btn btn-info">报名</a>
                </td>
            </tr>
        @endforeach
    </table>




@endsection
