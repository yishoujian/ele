@extends("admin.layouts.main")
@section("title","活动列表")

@section("content")
    <div>
        <div class="col-sm-1" >
            <a href="{{route("admin.article.add")}}" class="btn btn-success">添加</a>
        </div>
        <div class="col-sm-11 ">
            <form class="form-inline pull-right" method="get">


                <div class="form-group">
                    <label class="sr-only" for="exampleInputPassword3"></label>
                    <input type="text" class="form-control" id="exampleInputPassword3" placeholder="请输入活动名或者内容" name="keyWord">
                </div>

                <div class="form-group">
                    <label class="sr-only" for="exampleInputEmail3">Email address</label>
                    <select name="num" class="form-control">
                        <option value="">活动搜索</option>
                        <option value="1">未开始</option>
                        <option value="2">进行中</option>
                        <option value="3">已结束</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-warning">搜索</button>
            </form>
        </div>
    </div>
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
                <td>{!! $article->content !!}</td>

                <td>{{date('Y-m-d H:i:s',$article->start_time)}}</td>
                <td>{{date('Y-m-d H:i:s',$article->end_time)}}</td>
                <td>
                    {{--<a href="" class="btn btn-info">编辑</a>--}}
                    <a href="{{route("admin.article.del",$article)}}" class="btn btn-danger">删除</a>
                </td>
            </tr>
        @endforeach
    </table>
    {{$articles->appends($url)->links()}}

@endsection
