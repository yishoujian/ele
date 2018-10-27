<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="/shop/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{route("shop.shop.add")}}"><i class="fa fa-book"></i> <span>申请店铺</span></a></li>
            {{--<li><a href="/shop/add"><i class="fa fa-book"></i> <span>申请店铺</span></a></li>--}}
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>菜品管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route("shop.menu_category.index")}}"><i class="fa fa-circle-o"></i> 菜品分类管理</a></li>
                    <li><a href="{{route("shop.menu.index")}}"><i class="fa fa-circle-o"></i> 菜品管理</a></li>
                </ul>
            </li>



            <li class="header">LABELS</li>
            <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>