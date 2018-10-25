@extends("admin.layouts.main")
@section("title","商铺分类首页")

@section("content")

    <table class="table table-striped">
        <tr>
            <th>id</th>
            <th>商户名称</th>
            <th>店铺名称</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                {{--<td>{{$user->shop->shop_name}}</td>--}}
                <td>
                    @if($user->status==1)
                在线
                    @elseif($user->status==-1)
                     禁用
                        @else
                          等待审核
                    @endif
                </td>

                <td>
                    <img src="/{{$user->logo}}" alt="" width="100">
                </td>
                <td>
                    @if($user->status==0)
                            <a href="{{route("admin.user.shenhe",$user->id)}}" class="btn btn-success

" >通过</a>
                        @endif
                        @if($user->status==-1)
                            <a href="{{route("admin.user.shenhe",$user->id)}}" class="btn btn-success

" >启用</a>
                        @endif

                        @if($user->status==1)
                            <a href="{{route("admin.user.jinyong",$user->id)}}" class="btn btn-success

" >禁用</a>


                   @endif
                        <a href="{{route("admin.user.chongzhi",$user->id)}}" class="btn btn-success">重置密码</a>
                    <a href="{{route("admin.user.edit",$user->id)}}" class="btn btn-success">编辑</a>
                    <a href="{{route("admin.user.del",$user->id)}}" class="btn btn-danger">删除</a>
                </td>

            </tr>
        @endforeach

    </table>

{{--{{$users->links()}}--}}

@endsection
