@extends("admin.layouts.main")
@section("title","奖品添加")

@section("content")
    <form method="post" class="form-horizontal">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputEmail1">活动ID</label>
            <select name="event_id" class="form-control">
              @foreach($events as $event)
                <option value="{{$event->id}}">{{$event->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">奖品名字</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="请输入名字" name="name" value="{{$prize->name}}">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">奖品详情</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="请输入详情" name="description"  value="{{$prize->description}}">
        </div>



        <button type="submit" class="btn btn-warning">编辑奖品</button>
    </form>
@endsection