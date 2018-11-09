@extends("shop.layouts.main")
@section("title","添加抽奖活动")

@section("content")
    <form method="post" class="form-horizontal">
        {{csrf_field()}}
        <div class="form-group" >
            <label for="exampleInputEmail1">标题</label>
            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="请输入标题" name="title">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">内容</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="请输入活动内容" name="content">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">开始时间</label>
            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="请输入开始时间" name="start_time">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">结束时间</label>
            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="请输入结束时间" name="end_time">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">开奖时间</label>
            <input type="date" class="form-control" id="exampleInputPassword1" placeholder="请输入开奖时间" name="prize_time">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">最大参加人数</label>
            <input type="text" class="form-control" id="exampleInputPassword1" placeholder="请输入最大参加人数" name="num">
        </div>
        <button type="submit" class="btn btn-warning">添加抽奖活动</button>
    </form>
@endsection