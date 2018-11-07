@extends("shop.layouts.main")
@section("title","活动列表")
@section("content")

            <form class="form-inline pull-right" method="get">
                <input type="text" class="form-control" id="exampleInputPassword3" placeholder="请输入活动名或者内容" name="keyWord">
                <button type="submit" class="btn btn-warning">搜索</button>
            </form>


    <table class="table table-bordered">
        <tr>
            <th>Id</th>
            <th>标题</th>
            <th>内容</th>
            <th>开始时间</th>
            <th>结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($articles as $article)
            <tr>
                <td>{{$article->id}}</td>
                <td>{{$article->title}}</td>
                <td>{!!$article->content!!}</td>
                <td>{{date('Y-m-d H:i:s',$article->start_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$article->end_time)}}</td>
                <td>
                    <a href="{{route("admin.article.del",$article)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>


@endsection
