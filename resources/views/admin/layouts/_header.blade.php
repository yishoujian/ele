<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">首页</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                {{--<li><a href="">文章分类</a></li>--}}
                <li class="active"><a href="{{route("admin.shop_category.index")}}">店铺分类列表<span class="sr-only">(current)</span></a></li>

                <li class="active"><a href="{{route("admin.shop.index")}}">店铺列表<span class="sr-only">(current)</span></a></li>
                <li><a href="{{route("admin.user.index")}}">商户列表</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">订单详情 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.order.tian")}}">按天查看</a></li>
                        <li><a href="{{route("admin.order.yue")}}">按月查看</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">权限管理 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route("admin.per.add")}}">添加权限</a></li>
                        <li><a href="{{route("admin.per.index")}}">权限列表</a></li>
                        <li><a href="{{route("admin.roles.add")}}">给管理员添加权限</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>


            </ul>

            <ul class="nav navbar-nav ">
            <li><a href="{{route("admin.article.index")}}">活动列表</a></li>
            <li><a href="">会员充值记录</a></li>
            </ul>

            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">搜索</button>
            </form>
            @auth("admin")


                <ul class="nav navbar-nav navbar-right">


                    <li><a href="{{route("admin.admin.list")}}">管理员列表</a></li>
                    <li><a href="{{route("admin.admin.add")}}">管理员添加</a></li>
                    {{--<li class="active"><a href="{{route("user.recharge")}}">消费/充值<span class="sr-only">(current)</span></a></li>--}}

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            欢迎:{{ Illuminate\Support\Facades\Auth::guard("admin")->user()->name}}
                            <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{route("admin.admin.edit")}}">修改密码</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{route("admin.admin.logout")}}">退出登录</a></li>
                        </ul>
                    </li>
                </ul>
            @endauth

            @guest("admin")

                <ul class="nav navbar-nav navbar-right">

                    <li><a href="{{route("admin.admin.login")}}">管理员登录</a></li>
                </ul>
            @endguest




















        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
